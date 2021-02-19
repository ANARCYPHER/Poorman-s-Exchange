<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller 
{

    public function __construct()
    {
        parent::__construct();
  
        if (!$this->session->userdata('isLogIn')) 
        redirect('customer'); 
 
        $this->load->model(array(

            'customer/auth_model',
            'customer/diposit_model',
            'customer/deshboard_model',
            'customer/profile_model',
            'customer/buy_model',
            'common_model',

        ));

    }



/*
|-------------------------------------
|   Customer Deshboard
|-------------------------------------
*/
    public function index()
    {   
        
       $user_id = $this->session->userdata('user_id');

        $data = $this->deshboard_model->get_cata_wais_transections();
        $data['package'] = $this->deshboard_model->all_package();
        $data['info'] = $this->deshboard_model->my_info();
        $data['my_payout'] = $this->deshboard_model->my_payout();
        $data['my_sales'] = $this->deshboard_model->my_sales();
        $data['pending_withdraw'] = $this->deshboard_model->pending_withdraw();
        $data['level_info'] = $this->deshboard_model->my_level_information($user_id);

        $data['investment'] = $this->deshboard_model->my_total_investment($user_id);


        $data['title']   = display('home'); 
        $data['content'] = $this->load->view('customer/dashboard/home', $data, true);
        $this->load->view('customer/layout/main_wrapper', $data);  
    }



    public function bank_info_update(){

        $user_id = $this->session->userdata('user_id');

        $bank_data = array(
            'user_id'           => $this->session->userdata('user_id'),
            'beneficiary_name'    => $this->input->post('beneficiary_name'),
            'bank_name'    => $this->input->post('bank_name'),
            'branch'              => $this->input->post('branch'),
            'account_number' => $this->input->post('account_number'),
            'ifsc_code' => $this->input->post('code'),
        );

        $data = $this->db->select('*')->from('bank_info')->where('user_id',$user_id)->get()->num_rows();
        if($data > 0){
            $this->db->where('user_id',$user_id)->update('bank_info',$bank_data);
        }else{
           $this->db->insert('bank_info',$bank_data); 
        }
        $this->session->set_flashdata('message','Bank Information Update Successfully!');
        redirect("customer/home/");
        

    }


/*
|-------------------------------------
|   Diposit pament for bitcoin
|-------------------------------------
*/
    public function payment()
    {    


        if ($this->input->post('method')=='payeer') {

            $deposit_data = array(

                'user_id'           => $this->session->userdata('user_id'),
                'deposit_amount'    => $this->input->post('deposit_amount'),
                'deposit_method'    => $this->input->post('method'),
                'fees'              => $this->input->post('fees'),
                'comments'          => $this->input->post('comments'),
                'deposit_date'      => date('Y-m-d h:i:s'),
                'deposit_ip'        => $this->input->ip_address()

            );


            $result = $this->diposit_model->save_deposit($deposit_data);
        
            if(@$result['deposit_id']!=NULL){

                $gateway = $this->db->select('*')->from('payment_gateway')->where('identity', 'payeer')->where('status',1)->get()->row();

                $data['m_shop']     = @$gateway->public_key;
                $data['m_orderid']  = 'dp_'.(@$result['deposit_id']!=''?@$result['deposit_id']:'');
                $data['m_amount']   = number_format($this->input->post('deposit_amount'), 2, '.', '');
                $data['m_curr']     = 'USD';
                $data['m_desc']     = base64_encode($this->input->post('comments'));
                $data['m_key']      = @$gateway->private_key;
                $data['user_id']    = $this->session->userdata('user_id');

                $arHash = array(
                    $data['m_shop'],
                    $data['m_orderid'],
                    $data['m_amount'],
                    $data['m_curr'],
                    $data['m_desc']
                );
     
                $arHash[] = $data['m_key'];

                $data['sign'] = strtoupper(hash('sha256', implode(':', $arHash)));

                $data['content'] = $this->load->view("customer/dashboard/payeer_form", $data, true);
                $this->load->view("customer/layout/main_wrapper", $data);
            
            } else {

                $this->session->set_flashdata('exception',  display('please_try_again'));
                redirect("customer/deposit");

            }
        
        }


        #----------------------------------
        #   Data send to deposit tbl
        #----------------------------------
        else if($this->input->post('method')=='bitcoin') {

            $gateway = $this->db->select('*')->from('payment_gateway')->where('identity', 'bitcoin')->where('status',1)->get()->row();

            $deposit_data = array(
                'user_id'           => $this->session->userdata('user_id'),
                'deposit_amount'    => $this->input->post('deposit_amount'),
                'deposit_method'    => $this->input->post('method'),
                'fees'              => $this->input->post('fees'),
                'comments'          => $this->input->post('comments'),
                'deposit_date'      => date('Y-m-d h:i:s'),
                'deposit_ip'        => $this->input->ip_address()
            );

            $result = $this->diposit_model->save_deposit($deposit_data);

            $ulang = $this->db->select('language')->where('user_id', $this->session->userdata('user_id'))->get('user_registration')->row();
            if ($ulang->language=='french') {
                $lang = 'fr';
            }
            else{
                $lang = 'en';
            }


            $message    = "";
            require_once APPPATH.'libraries/cryptobox/cryptobox.class.php';
            $userID         = $this->session->userdata('user_id');            // place your registered userID or md5(userID) here (user1, user7, uo43DC, etc).
                                             // you don't need to use userID for unregistered website visitors
                                             // if userID is empty, system will autogenerate userID and save in cookies
            $userFormat     = "COOKIE";      // save userID in cookies (or you can use IPADDRESS, SESSION)
            $orderID        = (@$result['deposit_id']!=''?@$result['deposit_id']:$this->input->post('orderID'));    // invoice number 22
            $amountUSD      = $this->input->post('deposit_amount');          // invoice amount - 2.21 USD
            $period         = "NOEXPIRY";    // one time payment, not expiry
            $def_language   = $lang;          // default Payment Box Language
            $public_key     = @$gateway->public_key;   // from gourl.io
            $private_key    = @$gateway->private_key;  // from gourl.io

            /** PAYMENT BOX **/
            $options = array(
                "public_key"  => $public_key,        // your public key from gourl.io
                "private_key" => $private_key,       // your private key from gourl.io
                "webdev_key"  => "DEV1124G19CFB313A993D68G453342148",                 // optional, gourl affiliate key
                "orderID"     => $orderID,           // order id or product name
                "userID"      => $userID,            // unique identifier for every user
                "userFormat"  => $userFormat,        // save userID in COOKIE, IPADDRESS or SESSION
                "amount"      => 0,                  // product price in coins OR in USD below
                "amountUSD"   => $amountUSD,         // we use product price in USD
                "period"      => $period,            // payment valid period
                "language"    => $def_language       // text on EN - english, FR - french, etc
            );

            // Initialise Payment Class
            $box = new Cryptobox ($options);

            // coin name
            $coinName = $box->coin_name();

            // Payment Received
            if ($box->is_paid()) 
            { 

                $text = "User will see this message during ".$period." period after payment has been made!"; // Example
                
                $text .= "<br>".$box->amount_paid()." ".$box->coin_label()."  received<br>";

                //redirect("customer/deposit/store/".$result['deposit_id']);
                //$this->session->unset_userdata('diposit_id');

            } else {

                $text = "The payment has not been made yet";

            }


            // Notification when user click on button 'Refresh'
            if (isset($_POST["cryptobox_refresh_"]))
            {

                $message = "<div class='gourl_msg'>";
                if (!$box->is_paid()) $message .= '<div style="margin:50px" class="well"><i class="fa fa-info-circle fa-3x fa-pull-left fa-border" aria-hidden="true"></i> '.str_replace(array("%coinName%", "%coinNames%", "%coinLabel%"), array($box->coin_name(), ($box->coin_label()=='DASH'?$box->coin_name():$box->coin_name().'s'), $box->coin_label()), json_decode(CRYPTOBOX_LOCALISATION, true)[CRYPTOBOX_LANGUAGE]["msg_not_received"])."</div>";
                elseif (!$box->is_processed())
                {
                    // User will see this message one time after payment has been made
                    $message .= '<div style="margin:70px" class="alert alert-success" role="alert"> '.str_replace(array("%coinName%", "%coinLabel%", "%amountPaid%"), array($box->coin_name(), $box->coin_label(), $box->amount_paid()), json_decode(CRYPTOBOX_LOCALISATION, true)[CRYPTOBOX_LANGUAGE][($box->cryptobox_type()=="paymentbox"?"msg_received":"msg_received2")])."</div>";
                    $box->set_status_processed();
                }
                $message .="</div>";
            }


            $data['jsurl'] = (object) array(

                'u1'=>$box->cryptobox_json_url(),
                'u2'=>intval($box->is_paid()),
                'u3'=>base_url('bitcoin-plug/'),
                'u4'=>base_url("customer/deposit/store/").$result['deposit_id'],
                'coin_name'=>$box->coin_name(),
                'message'=>$message,
                'text'=>$text,
                'deposit_id'=>(@$result['deposit_id']!=''?@$result['deposit_id']:$this->input->post('orderID')),

            );

            $data['post_info'] = (object)$options;
            $data['title']   = 'Bitcoin Payment'; 
            $data['content'] = $this->load->view('customer/dashboard/json', $data, true);
            $this->load->view('customer/layout/main_wrapper', $data);  

        }
        else if($this->input->post('method')=='phone'){

            $mobiledata =  array(
                'om_name'         => $this->input->post('om_name'),
                'om_mobile'       => $this->input->post('om_mobile'),
                'transaction_no'  => $this->input->post('transaction_no'),
                'idcard_no'       => $this->input->post('idcard_no'),
            );

            $deposit_data = array(
                'user_id'           => $this->session->userdata('user_id'),
                'deposit_amount'    => $this->input->post('deposit_amount'),
                'deposit_method'    => $this->input->post('method'),
                'fees'              => $this->input->post('fees'),
                'comments'          => json_encode($mobiledata),
                'deposit_date'      => date('Y-m-d h:i:s'),
                'deposit_ip'        => $this->input->ip_address()
            );

            $result = $this->diposit_model->save_deposit($deposit_data);

            if ($result) {
                $this->session->set_flashdata('message',  display('payment_successfully'));
                redirect("customer/deposit");
            }else{
                $this->session->set_flashdata('exception',  display('please_try_again'));
                redirect("customer/deposit");
            }
        }
        else if($this->input->post('method')=='paypal'){

            $deposit_data = array(
                'user_id'           => $this->session->userdata('user_id'),
                'deposit_amount'    => $this->input->post('deposit_amount'),
                'deposit_method'    => $this->input->post('method'),
                'fees'              => $this->input->post('fees'),
                'comments'          => $this->input->post('comments'),
                'deposit_date'      => date('Y-m-d h:i:s'),
                'deposit_ip'        => $this->input->ip_address()
            );

            $result = $this->diposit_model->save_deposit($deposit_data);

            $gateway = $this->db->select('*')->from('payment_gateway')->where('identity', 'paypal')->where('status',1)->get()->row();


            require APPPATH.'libraries/paypal/vendor/autoload.php';
            // Use below for direct download installation

            // After Step 1
            $apiContext = new \PayPal\Rest\ApiContext(
                    new \PayPal\Auth\OAuthTokenCredential(
                        @$gateway->public_key,     // ClientID
                        @$gateway->private_key     // ClientSecret
                    )
            );

            // Step 2.1 : Between Step 2 and Step 3
            $apiContext->setConfig(
              array(
                'mode' => @$gateway->secret_key,
                'log.LogEnabled' => true,
                'log.FileName' => 'PayPal.log',
                'log.LogLevel' => 'FINE'
              )
            );

            // After Step 2
            $payer = new \PayPal\Api\Payer();
            $payer->setPaymentMethod('paypal');

            $item1 = new \PayPal\Api\Item();
            $item1->setName(display('diposit'));
            $item1->setCurrency('USD');
            $item1->setQuantity(1);
            $item1->setPrice($this->input->post('deposit_amount'));

            $itemList = new \PayPal\Api\ItemList();
            $itemList->setItems(array($item1));

            $amount = new \PayPal\Api\Amount();
            $amount->setCurrency("USD");
            $amount->setTotal($this->input->post('deposit_amount'));

            $transaction = new \PayPal\Api\Transaction();
            $transaction->setAmount($amount);
            $transaction->setItemList($itemList);
            $transaction->setDescription(display('diposit'));

            $redirectUrls = new \PayPal\Api\RedirectUrls();
            $redirectUrls->setReturnUrl(base_url('customer/home/paypal_confirm/?depositid='.$result['deposit_id']))->setCancelUrl(base_url('customer/deposit'));

            $payment = new \PayPal\Api\Payment();
            $payment->setIntent('sale')
                ->setPayer($payer)
                ->setTransactions(array($transaction))
                ->setRedirectUrls($redirectUrls);


            // After Step 3
            try {
                $payment->create($apiContext);                

                $data['payment']=$payment;
                $data['approval_url']=$payment->getApprovalLink();
                $data['user_id']=$this->session->userdata('user_id');
                $data['deposit_amount']=$this->input->post('deposit_amount');

                $data['content'] = $this->load->view("customer/dashboard/paypal_confirm", $data, true);
                $this->load->view("customer/layout/main_wrapper", $data);
            }
            catch (\PayPal\Exception\PayPalConnectionException $ex) {
                // This will print the detailed information on the exception.
                //REALLY HELPFUL FOR DEBUGGING
                echo $ex->getData();
                echo $ex->getData();
            }            


        }
        else if($this->input->post('method')=='stripe'){

            $deposit_data = array(
                'user_id'           => $this->session->userdata('user_id'),
                'deposit_amount'    => $this->input->post('deposit_amount'),
                'deposit_method'    => $this->input->post('method'),
                'fees'              => $this->input->post('fees'),
                'comments'          => $this->input->post('comments'),
                'deposit_date'      => date('Y-m-d h:i:s'),
                'deposit_ip'        => $this->input->ip_address()
            );

            $result = $this->diposit_model->save_deposit($deposit_data);

            $gateway = $this->db->select('*')->from('payment_gateway')->where('identity', 'stripe')->where('status',1)->get()->row();


            require_once APPPATH.'libraries/stripe/vendor/autoload.php';
            // Use below for direct download installation

            $stripe = array(
              "secret_key"      => @$gateway->private_key,
              "publishable_key" => @$gateway->public_key
            );

            \Stripe\Stripe::setApiKey($stripe['secret_key']);

            $data['deposit_id']=$result['deposit_id'];
            $data['user_id']=$this->session->userdata('user_id');
            $data['deposit_amount']=$this->input->post('deposit_amount');
            $data['description']=$this->input->post('comments');
            $data['stripe'] = $stripe;

            $data['content'] = $this->load->view("customer/dashboard/stripe_confirm", $data, true);
            $this->load->view("customer/layout/main_wrapper", $data);


        }else if($this->input->post('method')=='paystack'){

            $deposit_amount = $this->input->post('deposit_amount');
            $curl       = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL            => "https://free.currencyconverterapi.com/api/v6/convert?q=USD_NGN&compact=y",
            CURLOPT_RETURNTRANSFER => true,));
            $response = curl_exec($curl);
            $err = curl_error($curl);
            $res = json_decode($response,true);
            $usd = $res["USD_NGN"]["val"];
            $converamount = $deposit_amount*$usd;
            $deposit_data = array(
                'user_id'           => $this->session->userdata('user_id'),
                'deposit_amount'    => $this->input->post('deposit_amount'),
                'deposit_method'    => $this->input->post('method'),
                'fees'              => $this->input->post('fees'),
                'comments'          => $this->input->post('comments'),
                'deposit_date'      => date('Y-m-d h:i:s'),
                'deposit_ip'        => $this->input->ip_address()
            );

            $result = $this->diposit_model->save_deposit($deposit_data);

            $this->session->set_userdata('paystack_deposit_id', $result['deposit_id']);

            $gateway = $this->db->select('*')->from('payment_gateway')->where('identity', 'paystack')->where('status',1)->get()->row();

            $paystack = array(
              "secret_key"      => @$gateway->private_key,
              "publishable_key" => @$gateway->public_key
            );

            $deposit_amount = $converamount*100;
            curl_setopt_array($curl, array(
            CURLOPT_URL            => "https://api.paystack.co/transaction/initialize",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST  => "POST",
            CURLOPT_POSTFIELDS     => json_encode([
                'amount'=>$deposit_amount,
                'email' =>$this->session->userdata('email'),
            ]),
            CURLOPT_HTTPHEADER => [
                "authorization: Bearer ".$paystack['secret_key'],
                "content-type: application/json",
                "cache-control: no-cache"
            ],
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);

            if($err){
                die('Curl returned error: ' . $err);
            }

            $tranx = json_decode($response, true);

            if(!$tranx['status']){
                print_r('API returned error: ' . $tranx['message']);
            }
            $this->session->set_userdata("paystack_payment_type","deposit");//use for call back url
            header('Location: ' . $tranx['data']['authorization_url']);


        }
        else{
            $this->session->set_flashdata('exception',  display('please_try_again'));
            redirect("customer/deposit");
        }

    }

    public function callbackBitcoin(){
        require_once APPPATH.'libraries/cryptobox/cryptobox.callback.php';
        
    }


    public function exchange_confirm(){

        if ($this->buy_model->create($this->session->userdata('buy'))) {
            $this->session->unset_userdata('buy');
            $this->session->unset_userdata('deposit_id');
            $this->session->set_flashdata('message', display('payment_successfully'));
            redirect("customer/buy/form");
        }
        else{
            $this->session->unset_userdata('buy');
            $this->session->unset_userdata('deposit_id');
            $this->session->set_flashdata('exception', display('please_try_again'));
            redirect("customer/buy/form");
        }
    }
    public function stripe_confirm(){

        $token  = $this->input->post('stripeToken');
        $email  = $this->input->post('stripeEmail');
        $deposit_id  = $this->input->post('asdfasd');

        $data = $this->db->select('*')->from('deposit')->where('deposit_id', $deposit_id)->get()->row();


        $gateway = $this->db->select('*')->from('payment_gateway')->where('identity', 'stripe')->where('status',1)->get()->row();
        require_once APPPATH.'libraries/stripe/vendor/autoload.php';
        // Use below for direct download installation

        $stripe = array(
          "secret_key"      => @$gateway->private_key,
          "publishable_key" => @$gateway->public_key
        );

        \Stripe\Stripe::setApiKey($stripe['secret_key']);

        $customer = \Stripe\Customer::create(array(
          'email' => $email,
          'source'  => $token
        ));

        $charge = \Stripe\Charge::create(array(
          'customer' => $customer->id,
          'amount'   => round($data->deposit_amount*100),
          'currency' => 'usd'
        ));

        if ($charge) {
            redirect("customer/deposit/store/$data->deposit_id");
        }

    }

    public function paypal_confirm(){


        if (isset($_GET['paymentId'])) {

            $gateway = $this->db->select('*')->from('payment_gateway')->where('identity', 'paypal')->where('status',1)->get()->row();
            require APPPATH.'libraries/paypal/vendor/autoload.php';
            // Use below for direct download installation

            // After Step 1
            $apiContext = new \PayPal\Rest\ApiContext(
                    new \PayPal\Auth\OAuthTokenCredential(
                        @$gateway->public_key,     // ClientID
                        @$gateway->private_key      // ClientSecret
                    )
            );
            // Step 2.1 : Between Step 2 and Step 3
            $apiContext->setConfig(
              array(
                'mode' => @$gateway->secret_key,
                'log.LogEnabled' => true,
                'log.FileName' => 'PayPal.log',
                'log.LogLevel' => 'FINE'
              )
            );

            // Get payment object by passing paymentId
            $paymentId = $_GET['paymentId'];
            $depositid = $_GET['depositid'];
            $payment = \PayPal\Api\Payment::get($paymentId, $apiContext);
            $payerId = $_GET['PayerID'];

            // Execute payment with payer id
            $execution = new \PayPal\Api\PaymentExecution();
            $execution->setPayerId($payerId);

            try {
              // Execute payment
              $result = $payment->execute($execution, $apiContext);
              if ($result) {
                redirect("customer/deposit/store/$depositid");
              }


            } catch (PayPal\Exception\PayPalConnectionException $ex) {
              echo $ex->getCode();
              echo $ex->getData();
              die($ex);

            } catch (Exception $ex) {
              die($ex);

            }

        }

    }


    public function paystack_confirm(){

        if(isset($_GET['reference'])) {

            $deposit_id = $this->session->userdata('paystack_deposit_id');
            $this->session->unset_userdata('paystack_deposit_id');

            $gateway = $this->db->select('*')->from('payment_gateway')->where('identity', 'paystack')->where('status',1)->get()->row();
            $data = $this->db->select('*')->from('deposit')->where('deposit_id', $deposit_id)->get()->row();

            $stripe = array(
              "secret_key"      => @$gateway->private_key,
              "publishable_key" => @$gateway->public_key
            );

            $deposit_amount = $data->deposit_amount;
            $curl       = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL            => "https://free.currencyconverterapi.com/api/v6/convert?q=USD_NGN&compact=y",
            CURLOPT_RETURNTRANSFER => true,));
            $response = curl_exec($curl);
            $err = curl_error($curl);
            $res = json_decode($response,true);
            $usd = $res["USD_NGN"]["val"];
            $converamount = $deposit_amount*$usd;

            $deposit_amount = $converamount*100;
            curl_close($curl);

            $this->load->library("paystack/vendor/autoload");
            $this->autoload->paystack_autoload();
            $paystack = new Yabacon\Paystack($stripe['secret_key']);
            $trx = $paystack->transaction->verify(
                [
                 'reference'=>$_GET['reference']
                ]
            );

            if(!$trx->status){
                exit($trx->message);
            }

            if('success' == $trx->data->status){
                redirect("customer/deposit/store/$data->deposit_id");
            }
        }

    }


    public function deposit_confirm(){


        $data = $this->db->select('*')->from('deposit')->where('deposit_id',$this->session->userdata('deposit_id'))->get()->row();
        $this->db->set('status',1)->where('deposit_id',$this->session->userdata('deposit_id'))->update('deposit');
            
        if($data!=NULL){
            
            $transections_data = array(
            'user_id'                   => $data->user_id,
            'transection_category'      => 'deposit',
            'releted_id'                => $data->deposit_id,
            'amount'                    => $data->deposit_amount,
            'comments'                  => $data->comments,
            'transection_date_timestamp'=> date('Y-m-d h:i:s')
            );

            $this->diposit_model->save_transections($transections_data);
            $this->session->unset_userdata('deposit_id');
        }

        $set = $this->common_model->email_sms('email');

        if($set->deposit!=NULL){
            $appSetting = $this->common_model->get_setting();

            #----------------------------
            #      email verify smtp
            #----------------------------
            $post = array(
                'title'             => $appSetting->title,
                'subject'           => display('diposit'),
                'to'                => $this->session->userdata('email'),
                'message'           => 'You successfully deposit the amount $'.$data->deposit_amount.'.',
            );
            $send_email = $this->common_model->send_email($post);

            if($send_email){
                    $n = array(
                    'user_id'                => $this->session->userdata('user_id'),
                    'subject'                => display('diposit'),
                    'notification_type'      => 'deposit',
                    'details'                => 'You Deposit The Amount Is '.$data->deposit_amount.'.',
                    'date'                   => date('Y-m-d h:i:s'),
                    'status'                 => '0'
                );
                $this->db->insert('notifications',$n);    
            }

            $this->load->library('sms_lib');
            $template = array( 
                'name'      => $this->session->userdata('fullname'),
                'amount'    => $data->deposit_amount,
                'date'      => date('d F Y')
            );

            #------------------------------
            #   SMS Sending
            #------------------------------
            $send_sms = $this->sms_lib->send(array(
                'to'              => $this->session->userdata('phone'), 
                'template'        => 'Hi, %name% You Deposit The Amount Is %amount% ', 
                'template_config' => $template, 
            ));

            if($send_sms){

                $message_data = array(
                    'sender_id' =>1,
                    'receiver_id' => $this->session->userdata('user_id'),
                    'subject' => 'Deposit',
                    'message' => 'Hi,'.$this->session->userdata('fullname').' You Deposit The Amount Is '.$data->deposit_amount,
                    'datetime' => date('Y-m-d h:i:s'),
                );

                $this->db->insert('message',$message_data);

            }

        }

        $this->session->set_flashdata('message', display('deopsit_add_msg'));
        redirect('customer/deposit');

    }



/*
|-------------------------------------
|   View profile 
|-------------------------------------
*/
    public function profile()
    {
        $data['title'] = display('profile'); 
        $data['user']  = $this->home_model->profile($this->session->userdata('id'));
        $data['content'] = $this->load->view('backend/dashboard/profile', $data, true);
        $this->load->view('backend/layout/main_wrapper', $data);  
    }

/*
|-------------------------------------
|   Update profile 
|-------------------------------------
*/
    public function edit_profile()
    { 
        $data['title']    = display('edit_profile');
        $id = $this->session->userdata('id');
        /*-----------------------------------*/
        $this->form_validation->set_rules('firstname', 'First Name','required|max_length[50]');
        $this->form_validation->set_rules('lastname', 'Last Name','required|max_length[50]');
        #------------------------#
        $this->form_validation->set_rules('email', 'Email Address', "required|valid_email|max_length[100]");
        /*---#callback fn not supported#---*/ 
        // $this->form_validation->set_rules('email', 'Email Address', "required|valid_email|max_length[100]|callback_email_check[$id]|trim"); 
        #------------------------#
        $this->form_validation->set_rules('password', 'Password','required|max_length[32]|md5');
        $this->form_validation->set_rules('about', 'About','max_length[1000]');
        /*-----------------------------------*/ 
        //set config 
        $config = [
            'upload_path'   => './assets/images/uploads/',
            'allowed_types' => 'gif|jpg|png|jpeg', 
            'overwrite'     => false,
            'maintain_ratio' => true,
            'encrypt_name'  => true,
            'remove_spaces' => true,
            'file_ext_tolower' => true 
        ]; 
        $this->load->library('upload', $config);
 
        if ($this->upload->do_upload('image')) {  
            $data = $this->upload->data();  
            $image = $config['upload_path'].$data['file_name']; 

            $config['image_library']  = 'gd2';
            $config['source_image']   = $image;
            $config['create_thumb']   = false;
            $config['encrypt_name'] = TRUE;
            $config['width']          = 115;
            $config['height']         = 90;
            $this->load->library('image_lib', $config);
            $this->image_lib->resize();
            $this->session->set_flashdata('message', display("image_upload_successfully"));
        }
        /*-----------------------------------*/
        $data['user'] = (object)$userData = array(
            'id'          => $this->input->post('id'),
            'firstname'   => $this->input->post('firstname'),
            'lastname'    => $this->input->post('lastname'),
            'email'       => $this->input->post('email'),
            'password'    => md5($this->input->post('password')),
            'about'       => $this->input->post('about',true),
            'image'       => (!empty($image)?$image:$this->input->post('old_image')) 
        );

        /*-----------------------------------*/
        if ($this->form_validation->run()) {

            if (empty($userData['image'])) {
                $this->session->set_flashdata('exception', $this->upload->display_errors()); 
            }

            if ($this->home_model->update_profile($userData)) 
            {
                $this->session->set_userdata(array(
                    'fullname'   => $this->input->post('firstname'). ' ' .$this->input->post('lastname'),
                    'email'       => $this->input->post('email'),
                    'image'       => (!empty($image)?$image:$this->input->post('old_image'))
                ));
                $this->session->set_flashdata('message', display('update_successfully'));
            } else {
                $this->session->set_flashdata('exception',  display('please_try_again'));
            }
            redirect("backend/dashboard/home/edit_profile");

        } else { 
            $data['user']   = $this->home_model->profile($id);
            $data['content'] = $this->load->view('backend/dashboard/edit_profile', $data, true);
            $this->load->view('backend/layout/main_wrapper', $data);  
        }
    }
    

}