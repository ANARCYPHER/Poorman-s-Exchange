<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buy extends CI_Controller {
 	
 	public function __construct()
 	{
 		parent::__construct();

 		if (!$this->session->userdata('isLogIn')) 
        redirect('login');

        if (!$this->session->userdata('user_id')) 
        redirect('login'); 
    
 		$this->load->model(array(

 			'customer/buy_model',
 			'customer/diposit_model',
 			'customer/profile_model',
            'common_model',  
 		));
 		
 	}
 
	public function index()
	{
		$data['currency'] = $this->buy_model->findExcCurrency();
		
		$data['title']  = display('buy_list');
 		#-------------------------------#
        #
        #pagination starts
        #
        $config["base_url"] = base_url('customer/buy/index');
        $config["total_rows"] = $this->db->count_all('ext_exchange');
        $config["per_page"] = 25;
        $config["uri_segment"] = 4;
        $config["last_link"] = "Last"; 
        $config["first_link"] = "First"; 
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Prev';  
        $config['full_tag_open'] = "<ul class='pagination col-xs pull-right'>";
        $config['full_tag_close'] = "</ul>";
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open'] = "<li>";
        $config['next_tag_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tagl_close'] = "</li>";
        /* ends of bootstrap */
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $data['buy'] = $this->buy_model->read($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
        #
        #pagination ends
        #    
		$data['content'] = $this->load->view("customer/buy/list", $data, true);
		$this->load->view("customer/layout/main_wrapper", $data);
	}
 
	public function form()
	{ 
		$data['title']  = display('buy');

		if ($this->session->userdata('buy')) {
			$this->session->unset_userdata('buy');
		}

		$data['payment_gateway'] = $this->common_model->payment_gateway();
		$data['currency'] = $this->buy_model->findExcCurrency();
		$data['selectedlocalcurrency'] = $this->buy_model->findlocalCurrency();
		#------------------------#

		$this->form_validation->set_rules('cid', display('coin_name'),'required');
		$this->form_validation->set_rules('buy_amount', display('buy_amount'),'required');
		$this->form_validation->set_rules('wallet_id', display('wallet_data'),'required');
		$this->form_validation->set_rules('payment_method', display('payment_method'),'required');
		$this->form_validation->set_rules('usd_amount', display('usd_amount'),'required');
		$this->form_validation->set_rules('rate_coin', display('rate_coin'),'required');
		$this->form_validation->set_rules('local_amount', display('local_amount'),'required');

        if ($this->input->post('payment_method')=='bitcoin' || $this->input->post('payment_method')=='payeer') {
            $this->form_validation->set_rules('comments', display('comments'),'required');
        }
        if ($this->input->post('payment_method')=='phone') {
			$this->form_validation->set_rules('om_name', display('om_name'),'required');
			$this->form_validation->set_rules('om_mobile', display('om_mobile'),'required');
			$this->form_validation->set_rules('transaction_no', display('transaction_no'),'required');
			$this->form_validation->set_rules('idcard_no', display('idcard_no'),'required');
		}

		if (!$this->input->valid_ip($this->input->ip_address())){
            return false;
        }

		/*-----------------------------------*/ 
		$sdata['buy']   = (object)$userdata = array(
			'coin_id'      			=> $this->input->post('cid'),
			'user_id'      			=> $this->session->userdata('user_id'),
			'coin_wallet_id'      	=> $this->input->post('wallet_id'),
			'transection_type'      => "buy",
			'coin_amount'      		=> $this->input->post('buy_amount'),
			'usd_amount'      		=> $this->input->post('usd_amount'),
			'local_amount'      	=> $this->input->post('local_amount'),
			'payment_method'      	=> $this->input->post('payment_method'),
			'request_ip'      		=> $this->input->ip_address(),
			'verification_code'     => "",
			'payment_details'      	=> $this->input->post('comments'),
			'rate_coin'      		=> $this->input->post('rate_coin'),
			'document_status'      	=> 0,
			'om_name'				=> $this->input->post('om_name'),
			'om_mobile'				=> $this->input->post('om_mobile'),
			'transaction_no'		=> $this->input->post('transaction_no'),
			'idcard_no'				=> $this->input->post('idcard_no'),
			'status'      			=> 1
		);

		/*-----------------------------------*/
		if ($this->form_validation->run()) 
		{
			$this->session->set_userdata($sdata);
			redirect("customer/buy/paymentform/");
		}
		$data['content'] = $this->load->view("customer/buy/form", $data, true);
		$this->load->view("customer/layout/main_wrapper", $data);
	}

	public function paymentform(){

		$data['sbuypayment']=$this->session->userdata('buy');

		if (!$this->session->userdata('buy')) {
			redirect("customer/buy/form/");
		}


		if ($this->session->userdata('buy')->payment_method=='bitcoin') {

			/******************************
            * GoUrl Cryptocurrency Payment API
            ******************************/
			$gateway = $this->db->select('*')->from('payment_gateway')->where('identity', 'bitcoin')->where('status',1)->get()->row();
			$date = new DateTime();
			$invoice = $date->getTimestamp();
			
			$ulang = $this->db->select('language')->where('user_id', $data['sbuypayment']->user_id)->get('user_registration')->row();
			if ($ulang->language=='french') {
				$lang = 'fr';

			}
			else{
				$lang = 'en';
			}

			/**
			 * @category    Basic Example
			 * @package     GoUrl Cryptocurrency Payment API 
			 * copyright 	(c) 2014-2018 Delta Consultants
			 * @crypto      Supported Cryptocoins -	Bitcoin, BitcoinCash, Litecoin, Dash, Dogecoin, Speedcoin, Reddcoin, Potcoin, Feathercoin, Vertcoin, Peercoin, MonetaryUnit, UniversalCurrency
			 * @website     https://gourl.io/api-php.html
			 */
			
			require_once APPPATH.'libraries/cryptobox/cryptobox.class.php';
			$orderID	=  "ex_".$invoice;
			$userID		= $data['sbuypayment']->user_id;
			$def_language	= $lang;	// default payment box language; en - English, es - Spanish, fr - French, de - German, nl - Dutch, it - Italian, ru - Russian, pl - Polish, pt - Portuguese, fa - Persian, ko - Korean, ja - Japanese, id - Indonesian, tr - Turkish, ar - Arabic, cn - Simplified Chinese, zh - Traditional Chinese, hi - Hindi
			// Remove all the characters from the string other than a..Z0..9_-@. 
			$orderID = preg_replace('/[^A-Za-z0-9\.\_\-\@]/', '', $orderID);
			$userID = preg_replace('/[^A-Za-z0-9\.\_\-\@]/', '', $userID);
			$options = array( 
			"public_key"  	=> 	@$gateway->public_key, 		// place your public key from gourl.io
			"private_key" 	=> 	@$gateway->private_key, 		// place your private key from gourl.io
			"webdev_key"	=>  "DEV1124G19CFB313A993D68G453342148", 		// optional, gourl affiliate key
			"orderID"     	=> $orderID,  // few your users can have the same orderID but combination 'orderID'+'userID' should be unique. 
										// for example, on premium page you can use for all visitors: orderID="premium" and userID="" (empty).
			"userID" 	  	=> $userID, 	// optional; when userID value is empty - system will autogenerate unique identifier for every user and save it in cookies
			"userFormat"  	=> "COOKIE", 	// save your user identifier userID in cookies. Available values: COOKIE, SESSION, IPADDRESS, MANUAL 
			"amount" 	  	=> 0,			// amount in cryptocurrency or in USD below
			"amountUSD"   	=> $data['sbuypayment']->usd_amount,  		// price is 2 USD; it will convert to cryptocoins amount, using Live Exchange Rates
										// *** For convert Euro/GBP/etc. to USD/Bitcoin, use function convert_currency_live() with Google Finance
										// *** examples: convert_currency_live("EUR", "BTC", 22.37) - convert 22.37 Euro to Bitcoin
										// *** convert_currency_live("EUR", "USD", 22.37) - convert 22.37 Euro to USD
			"period"      => "24 HOUR",	// payment valid period, after 1 day user need to pay again
			"iframeID"    => "",    	// optional; when iframeID value is empty - system will autogenerate iframe html payment box id
			"language" 	  => $def_language // default language
			);  
			// IMPORTANT: Please read description of options here - https://gourl.io/api-php.html#options  
			
			// Initialise Payment Class
			$box1 = new Cryptobox ($options);
			// Display Payment Box or successful payment result   
			$data['paymentbox'] = $box1->display_cryptobox();
			// Language selection list for payment box (html code)
			$data['languages_list'] = display_language_box($def_language);
			// Log
			$data['message'] = "";
			
			// A. Process Received Payment
			if ($box1->is_paid()) 
			{ 
				$data['message'] .= "A. User will see this message during ".$options["period"]." period after payment has been made!";
				
				$data['message'] .= "<br>".$box1->amount_paid()." ".$box1->coin_label()."  received<br>";
				
				// Your code here to handle a successful cryptocoin payment/captcha verification
				// For example, give user 24 hour access to your member pages
			
			}  
			else $data['message'] .= "The payment has not been made yet";
			
			// B. One-time Process Received Payment
			if ($box1->is_paid() && !$box1->is_processed()) 
			{
				$data['message'] .= "B. User will see this message one time after payment has been made!";	
			
				// Your code here - for example, publish order number for user
				// !!For update db records, please use function cryptobox_new_payment()!!
				// ...

				$payment_details = $this->session->userdata('buy');
				cryptobox_new_payment("", $payment_details, "");

				// Also you can use $box1->is_confirmed() - return true if payment confirmed 
				// Average transaction confirmation time - 10-20min for 6 confirmations  
				
				// Set Payment Status to Processed
				$box1->set_status_processed(); 
				
				// Optional, cryptobox_reset() will delete cookies/sessions with userID and 
				// new cryptobox with new payment amount will be show after page reload.
				// Cryptobox will recognize user as a new one with new generated userID
				// $box1->cryptobox_reset(); 
			}

		}
		else if ($this->session->userdata('buy')->payment_method=='payeer') {

			/******************************
            * Payeer Payment Gateway API
            ******************************/

			$date = new DateTime();
			$invoice = $date->getTimestamp();
			$comment = $data['sbuypayment']->user_id.'/buy/'.'ex_'.$invoice.'/'.$date->format('Y-m-d H:i:s');
			
			$gateway = $this->db->select('*')->from('payment_gateway')->where('identity', 'payeer')->where('status',1)->get()->row();

			$data['m_shop'] 	= @$gateway->public_key;
		    $data['m_orderid'] 	= 'ex_'.$invoice;;
		    $data['m_amount'] 	= number_format($data['sbuypayment']->usd_amount, 2, '.', '');
		    $data['m_curr'] 	= 'USD';
		    $data['m_desc'] 	= base64_encode($comment);
		    $data['m_key'] 		= @$gateway->private_key;

		    $arHash = array(
		        $data['m_shop'],
		        $data['m_orderid'],
		        $data['m_amount'],
		        $data['m_curr'],
		        $data['m_desc']
		    );

			$arHash[] = $data['m_key'];

		    $data['sign'] = strtoupper(hash('sha256', implode(':', $arHash)));

		}
		else if ($this->session->userdata('buy')->payment_method=='paypal') {

			/******************************
            * Paypal Payment Gateway API
            ******************************/
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
            $item1->setName(display('buy'));
            $item1->setCurrency('USD');
            $item1->setQuantity(1);
            $item1->setPrice($data['sbuypayment']->usd_amount);

            $itemList = new \PayPal\Api\ItemList();
            $itemList->setItems(array($item1));

            $amount = new \PayPal\Api\Amount();
            $amount->setCurrency("USD");
            $amount->setTotal($data['sbuypayment']->usd_amount);

            $transaction = new \PayPal\Api\Transaction();
            $transaction->setAmount($amount);
            $transaction->setItemList($itemList);
            $transaction->setDescription(display('buy'));

            $redirectUrls = new \PayPal\Api\RedirectUrls();
            $redirectUrls->setReturnUrl(base_url('customer/buy/paypal_confirm/'))->setCancelUrl(base_url('customer/buy/form'));

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

            }
            catch (\PayPal\Exception\PayPalConnectionException $ex) {
                // This will print the detailed information on the exception.
                //REALLY HELPFUL FOR DEBUGGING
                echo $ex->getData();
                echo $ex->getData();
            }			

		}
		else if ($this->session->userdata('buy')->payment_method=='stripe') {

			/******************************
            * Stripe Payment Gateway API
            ******************************/

            $gateway = $this->db->select('*')->from('payment_gateway')->where('identity', 'stripe')->where('status',1)->get()->row();


            require_once APPPATH.'libraries/stripe/vendor/autoload.php';
            // Use below for direct download installation

            $stripe = array(
              "secret_key"      => @$gateway->private_key,
              "publishable_key" => @$gateway->public_key
            );

            \Stripe\Stripe::setApiKey($stripe['secret_key']);

            $data['description']="Buy";
            $data['stripe'] = $stripe;

		}else if($this->session->userdata('buy')->payment_method=='paystack'){

			/******************************
            * Paystack Payment Gateway API
            ******************************/

			$gateway = $this->db->select('*')->from('payment_gateway')->where('identity', 'paystack')->where('status',1)->get()->row();

            //$deposit_amount = $this->input->post('deposit_amount');
            $curl       = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL            => "https://free.currencyconverterapi.com/api/v6/convert?q=USD_NGN&compact=y",
            CURLOPT_RETURNTRANSFER => true,));
            $response = curl_exec($curl);
            $err = curl_error($curl);
            $res = json_decode($response,true);
            $usd = $res["USD_NGN"]["val"];
            $converamount = $data['sbuypayment']->usd_amount*$usd;
            // $deposit_data = array(
            //     'user_id'           => $this->session->userdata('user_id'),
            //     'deposit_amount'    => $this->input->post('deposit_amount'),
            //     'deposit_method'    => $this->input->post('method'),
            //     'fees'              => $this->input->post('fees'),
            //     'comments'          => $this->input->post('comments'),
            //     'deposit_date'      => date('Y-m-d h:i:s'),
            //     'deposit_ip'        => $this->input->ip_address()
            // );

            //$result = $this->diposit_model->save_deposit($deposit_data);
            //$this->session->set_userdata('paystack_deposit_id', $result['deposit_id']);
            // $gateway = $this->db->select('*')->from('payment_gateway')->where('identity', 'paystack')->where('status',1)->get()->row();

            $paystack = array(
              "secret_key"      => @$gateway->private_key,
              "publishable_key" => @$gateway->public_key
            );

            $payment_amount = $converamount*100;
            curl_setopt_array($curl, array(
            CURLOPT_URL            => "https://api.paystack.co/transaction/initialize",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST  => "POST",
            CURLOPT_POSTFIELDS     => json_encode([
                'amount'=>$payment_amount,
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
            $this->session->set_userdata("paystack_payment_type","buy");//use for call back url
            header('Location: ' . $tranx['data']['authorization_url']);




        }
        else if($this->session->userdata('buy')->payment_method=='phone'){

        	/******************************
            * Mobile Payment (Manual)
            ******************************/
        	if ($this->buy_model->create($this->session->userdata('buy'))) {
				$this->session->unset_userdata('buy');
				$this->session->set_flashdata('message', display('payment_successfully'));
				redirect("customer/buy/form");

			}
			else{
				$this->session->unset_userdata('buy');
				$this->session->set_flashdata('exception', display('please_try_again'));
				redirect("customer/buy/form");

			}
        }
		else{
			$this->session->unset_userdata('buy');
			$this->session->set_flashdata('exception', display('please_try_again'));
			redirect("customer/buy/form");

		}

		$data['content'] = $this->load->view("customer/buy/paymentform", $data, true);
		$this->load->view("customer/layout/main_wrapper", $data);

	}

	public function buyPayable()
	{  
		$cid 	= $this->input->post('cid');
		$amount = $this->input->post('amount');

		$data['selectedcryptocurrency'] = $this->buy_model->findCurrency($cid);
		$data['selectedexccurrency'] 	= $this->buy_model->findExchangeCurrency($cid);
		$data['selectedlocalcurrency'] 	= $this->buy_model->findlocalCurrency();
		if (!empty($amount)) {
			$data['price_usd'] 		= $this->getPercentOfNumber($data['selectedcryptocurrency']->price_usd, $data['selectedexccurrency']->buy_adjustment)+$data['selectedcryptocurrency']->price_usd;
			$payableusd 			= $data['price_usd']*$amount;
			$data['payableusd'] 	= $payableusd;
			$data['payablelocal'] 	= $payableusd*$data['selectedlocalcurrency']->usd_exchange_rate;
		}
		else{
			$data['payableusd']     = 0;
            $data['payablelocal']   = 0;
            if (empty($cid)) {
                $data['price_usd']  = 0;
            }else{
                $data['price_usd']      = $this->getPercentOfNumber($data['selectedcryptocurrency']->price_usd, $data['selectedexccurrency']->buy_adjustment)+$data['selectedcryptocurrency']->price_usd;

            }

		}

		$this->load->view("customer/buy/ajaxpayable", $data);

	}

	public function getPercentOfNumber($number, $percent){
    	return ($percent / 100) * $number;

	} 

	public function payeerStatus()
	{
		// $request = $this->input->get();
		// if (isset($request["m_operation_id"]) && isset($request["m_sign"]))
		// {

		// }
		
   	}   	

   	public function paystackSuccess()
   	{
   		$payment_type = $this->session->userdata("paystack_payment_type");
   		$this->session->unset_userdata("paystack_payment_type");

   		if($payment_type == 'buy'){
   			$reference = $this->input->get("reference");
   			$this->paystack_confirm($reference);
   		}
   		else if($payment_type == 'deposit'){
   			$reference = $this->input->get("reference");
   			redirect("customer/home/paystack_confirm?reference=".$reference);
   		}
   		else{
   			$reference = $this->input->get("reference");
   			redirect("home/paystack_confirm?reference=".$reference);
   		}
   	}


    public function payeerSuccess() 
	{
		$request = $this->input->get();
		$orderID = $request['m_orderid'];
		$order_id = explode('_', $orderID);

		// Payeer Tranction log
		$this->buy_model->payeerPayment($request);

		if($order_id['0']=='dp'){
			$this->deposit_confirm($order_id['1']);
		}

		if($order_id['0']=='ex'){
			$this->exchange_confirm($order_id['1']);
		}



 //    [m_operation_id] => 474205085
 //    [m_operation_ps] => 2609
 //    [m_operation_date] => 25.01.2018 12:43:58
 //    [m_operation_pay_date] => 25.01.2018 12:44:11
 //    [m_shop] => 474181962
 //    [m_orderid] => invoice1516873427
 //    [m_amount] => 0.13
 //    [m_curr] => USD
 //    [m_desc] => VGVzdA==
 //    [m_status] => success
 //    [m_sign] => CF5AE9EEDE210CE7657275C101A86F2A1D9DB92E747A2984B79B998D525579CF
 //    [lang] => en

	}

	public function payeerFail() 
	{

		$this->session->unset_userdata('buy');
		$this->session->set_flashdata('exception', display('payment_cancel'));
		redirect("customer/home/");
	}

	public function stripe_confirm(){

        $token  = $this->input->post('stripeToken');
        $email  = $this->input->post('stripeEmail');


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
          'amount'   => round($this->session->userdata('buy')->usd_amount*100),
          'currency' => 'usd'
        ));

        if ($charge) {
            if ($this->buy_model->create($this->session->userdata('buy'))) {
				$this->session->unset_userdata('buy');
				$this->session->set_flashdata('message', display('payment_successfully'));
				redirect("customer/buy/form");
			}
			else{
				$this->session->unset_userdata('buy');
				$this->session->set_flashdata('exception', display('please_try_again'));
			}
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
					if ($this->buy_model->create($this->session->userdata('buy'))) {
						$this->session->unset_userdata('buy');
						$this->session->set_flashdata('message', display('payment_successfully'));
						redirect("customer/buy/form");
					}
					else{
						$this->session->unset_userdata('buy');
						$this->session->set_flashdata('exception', display('please_try_again'));
					}
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

    public function paystack_confirm($reference)
    {
    	if($reference!=NULL) {

            $deposit_id = $this->session->userdata('paystack_deposit_id');
            $this->session->unset_userdata('paystack_deposit_id');

            $gateway = $this->db->select('*')->from('payment_gateway')->where('identity', 'paystack')->where('status',1)->get()->row();
            $data = $this->db->select('*')->from('deposit')->where('deposit_id', $deposit_id)->get()->row();

            $paystack = array(
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
            $paystack = new Yabacon\Paystack($paystack['secret_key']);
            $trx = $paystack->transaction->verify(
                [
                 'reference'=>$reference
                ]
            );

            if(!$trx->status){
                exit($trx->message);
            }

            if('success' == $trx->data->status){

                if ($this->buy_model->create($this->session->userdata('buy'))) {
					$this->session->unset_userdata('buy');
					$this->session->set_flashdata('message', display('payment_successfully'));
					redirect("customer/buy/form");
				}
				else{
					$this->session->unset_userdata('buy');
					$this->session->set_flashdata('exception', display('please_try_again'));
				}

            }
    	}
	}

    
    public function exchange_confirm($diposit_id=NULL){

	    if ($this->buy_model->create($this->session->userdata('buy'))) {
			$this->session->unset_userdata('buy');
			$this->session->set_flashdata('message', display('payment_successfully'));
			redirect("customer/buy/form");
		}
		else{
			$this->session->unset_userdata('buy');
			$this->session->set_flashdata('exception', display('please_try_again'));
			redirect("customer/buy/form");
		}
	}





	public function deposit_confirm($diposit_id=NULL){

	    $data = $this->db->select('*')->from('deposit')->where('deposit_id',$diposit_id)->get()->row();

        $this->db->set('status',1)->where('deposit_id',$diposit_id)->update('deposit');
        
        if($data!=NULL){
            
            $transections_data = array(
            'user_id'                   	=> $data->user_id,
            'transection_category'      	=> 'deposit',
            'releted_id'                	=> $data->deposit_id,
            'amount'                    	=> $data->deposit_amount,
            'comments'                  	=> $data->comments,
            'transection_date_timestamp'	=> date('Y-m-d h:i:s')
            );

            $this->diposit_model->save_transections($transections_data);    
        }

        $set = $this->common_model->email_sms('email');
        $appSetting = $this->common_model->get_setting();

        if($set->deposit!=NULL){

            #----------------------------
            #      email verify smtp
            #----------------------------
            $post = array(
                'title'             => $appSetting->title,
                'subject'           => 'Deposit',
                'to'                => $this->session->userdata('email'),
                'message'           => 'You Deposit The Amount Is '.$data->deposit_amount.'.',
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

}