<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Withdraw extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
  
        if (!$this->session->userdata('isLogIn')) 
        redirect('login');

        if (!$this->session->userdata('user_id')) 
        redirect('login'); 
 
		$this->load->model(array(
            'customer/Profile_model',
            'customer/withdraw_model',
            'customer/transections_model',
            'customer/transfer_model',
            'common_model',
        ));

	}


    public function index()
    {   

        $data['title']   = display('withdraw');
        $data['payment_gateway'] = $this->common_model->payment_gateway();
        $data['content'] = $this->load->view('customer/pages/withdraw', $data, true);
        $this->load->view('customer/layout/main_wrapper', $data);  
    }


public function withdraw_list()
{
    $user_id = $this->session->userdata('user_id');
    $data['title']   = display('withdraw_list'); 
    #-------------------------------#
    #
    #pagination starts
    #
    $config["base_url"]     = base_url('customer/transfer/transfar/transfer_list');
    $config["total_rows"]   = $this->db->get_where('withdraw', array('user_id'=>$user_id))->num_rows();
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
    $data['withdraw'] = $this->db->select("*")
                        ->from('withdraw')
                        ->where('user_id',$user_id)
                        ->limit($config["per_page"], $page)
                        ->get()
                        ->result();
    $data["links"] = $this->pagination->create_links();
    #
    #pagination ends
    #

    $data['content'] = $this->load->view('customer/withdraw/withdraw_list', $data, true);
    $this->load->view('customer/layout/main_wrapper', $data);  

}

public function withdraw_details($id=NULL)
{
    $user_id = $this->session->userdata('user_id');
    $data['title']   = display('withdraw_details'); 
    $data['my_info'] = $this->Profile_model->my_info();
    $data['withdraw'] = $this->withdraw_model->get_withdraw_by_id($id);
    $data['content'] = $this->load->view('customer/withdraw/withdraw_details', $data, true);
    $this->load->view('customer/layout/main_wrapper', $data);  

}


    public function store()
    {
        $this->form_validation->set_rules('amount', display('amount'), 'required'); 
        $this->form_validation->set_rules('varify_media', 'OTP Send To', 'required'); 
        $this->form_validation->set_rules('walletid', 'Wallet id', 'required'); 
       
        $appSetting = $this->common_model->get_setting();

        if($this->form_validation->run()){

            $varify_media = $this->input->post('varify_media');
            $varify_code = $this->randomID();
            #----------------------------
            // check balance 
            $blance = $this->check_balance($this->input->post('amount'));
            #----------------------------
            if($blance!=true){

                $this->session->set_flashdata('exception', display('balance_is_unavailable'));
                redirect('customer/withdraw');

            } else {


                if($varify_media==2){

                #----------------------------
                #      email verify smtp
                #----------------------------
                $post = array(
                    'title'             => $appSetting->title,
                    'subject'           => 'Withdraw Verification!',
                    'to'                => $this->session->userdata('email'),
                    'message'           => 'You Withdraw The Amount Is '.$this->input->post('amount').'. The Verification Code is <h1>'.$varify_code.'</h1>',
                );
                $code_send = $this->common_model->send_email($post);
               
                } else {
                    #----------------------------
                    #      Sms verify
                    #----------------------------                    
                    $this->load->library('sms_lib');

                        $template = array( 
                            'name'      => $this->session->userdata('fullname'),
                            'amount'    => $this->input->post('amount'),
                            'code'      => $varify_code,
                            'date'      => date('d F Y')
                        );

                     $code_send = $this->sms_lib->send(array(
                        'to'       => $this->session->userdata('phone'), 
                        'template' => 'Hello! %name% You Withdraw The Amount Is %amount%, The Verification Code is %code% ', 
                        'template_config' => $template, 
                    ));
                }


                if($code_send!=NULL){

                    // get withdraw fees
                    $fees = $this->fees_load($this->input->post('amount'),$this->input->post('method'),'withdraw');
                    #-----------------------
                    $withdraw = array(
                        'user_id  ' => $this->session->userdata('user_id'),
                        'amount' => $this->input->post('amount'),
                        'fees' => @$fees,
                        'walletid' => $this->input->post('walletid'),
                        'request_ip' => $this->input->ip_address(),
                        'request_date' => date('Y-m-d h:i:s'),
                        'method' => $this->input->post('method')
                    );


                        $varify_data = array(

                            'ip_address' => $this->input->ip_address(),
                            'user_id' => $this->session->userdata('user_id'),
                            'session_id' => $this->session->userdata('isLogIn'),
                            'verify_code' => $varify_code,
                            'data' => json_encode($withdraw)

                        );

                    $result = $this->transfer_model->save_transfer_verify($varify_data);
                 
                    redirect('customer/withdraw/confirm_withdraw/'.$result['id']);
                }    
            }     

        } else {

            $data['old'] = (object)$_POST;
            $data['title']   = display('withdraw'); 
            $data['content'] = $this->load->view('customer/pages/withdraw', $data, true);
            $this->load->view('customer/layout/main_wrapper', $data);  
        
        }
    }



    /*
    |---------------------------------
    |   Fees Load and deposit amount 
    |---------------------------------
    */
    public function fees_load($amount=null,$method=null,$level)
    {   

        $result = $this->db->select('*')
        ->from('fees_tbl')
        ->where('level',$level)
        ->get()
        ->row();
       return $fees = ($amount/100)*$result->fees;
        
    }

    /*
    |-----------------------------------
    |   confirm_withdraw
    |-----------------------------------
    */

    public function confirm_withdraw($id = null)
    {

        $data['v'] = $this->withdraw_model->get_verify_data($id);

        if($data['v']!=NULL){

            $data['title']   = display('confirm_withdraw'); 

            $data['content'] = $this->load->view('customer/pages/confirm_withdraw', $data, true);
            
            $this->load->view('customer/layout/main_wrapper', $data);
            
        } else {
            redirect('customer/withdraw');
        }
    }    

    /*
    |-----------------------------------
    |   verify the code
    |-----------------------------------
    */
    public function withdraw_verify()
    {

        $code = $this->input->post('code');
        $id = $this->input->post('id');


        // check verify code
        $data = $this->db->select('*')
        ->from('verify_tbl')
        ->where('verify_code',$code)
        ->where('id',$id)
        ->where('session_id',$this->session->userdata('isLogIn'))
        ->where('status',1)
        ->get()
        ->row();


        if($data!=NULL) {

            $t_data = ((array) json_decode($data->data));
 
            $result = $this->withdraw_model->withdraw($t_data);

            $set = $this->common_model->email_sms('email');
            $appSetting = $this->common_model->get_setting();

            if($set->withdraw!=NULL){

                $balance = $this->transections_model->get_cata_wais_transections();

                $new_balance = ($balance['balance']-$t_data['amount']);
                #----------------------------
                #      email verify smtp
                #----------------------------
                $post = array(
                    'title'             => $appSetting->title,
                    'subject'           => 'Withdraw',
                    'to'                => $this->session->userdata('email'),
                    'message'           => 'You successfully withdraw the amount Is $'.$t_data['amount'].'. from your account. Your new balance is $'.$new_balance,
                );
                $send = $this->common_model->send_email($post);
                
                if($send){
                        $n = array(
                        'user_id'                => $this->session->userdata('user_id'),
                        'subject'                => display('withdraw'),
                        'notification_type'      => 'withdraw',
                        'details'                => 'You successfully withdraw the amount Is $'.$t_data['amount'].'. from your account. Your new balance is $'.$new_balance,
                        'date'                   => date('Y-m-d h:i:s'),
                        'status'                 => '0'
                    );
                    $this->db->insert('notifications',$n);    
                }

                #----------------------------
                #      Sms verify
                #----------------------------
                    
                    $this->load->library('sms_lib');

                        $template = array( 
                            'name'      => $this->session->userdata('fullname'),
                            'amount'    => $t_data['amount'],
                            'new_balance' => $new_balance,
                            'date'      => date('d F Y')
                        );

                     $send_sms = $this->sms_lib->send(array(
                        'to'       => $this->session->userdata('phone'), 
                        'subject'         => 'Withdraw',
                        'template'         => 'You successfully withdraw the amount is $%amount% from your account. Your new balance is $%new_balance%', 
                        'template_config' => $template, 
                    ));
                    if($send_sms){
                        $message_data = array(
                            'sender_id' =>1,
                            'receiver_id' => $this->session->userdata('user_id'),
                            'subject' => 'Withdraw',
                            'message' => 'You successfully withdraw the amount is $'.$t_data['amount'].'. from your account. Your new balance is $'.$new_balance,
                            'datetime' => date('Y-m-d h:i:s'),
                        );

                        $this->db->insert('message',$message_data);
                    }
            }

            $transections_data = array(
                'user_id'                   => $this->session->userdata('user_id'),
                'transection_category'      => 'withdraw',
                'releted_id'                => $result['withdraw_id'],
                'amount'                    => $t_data['amount'],
                'transection_date_timestamp'=> date('Y-m-d h:i:s')
            );

            $this->transections_model->save_transections($transections_data);
            $this->db->set('status',0)
            ->where('id',$this->input->post('id'))
            ->where('session_id',$this->session->userdata('isLogIn'))
            ->update('verify_tbl');


            $this->session->set_flashdata('message', display('withdraw_successfull'));

            echo $result['withdraw_id'];

        } else {
            echo '';
        }
        
    }



    public function withdraw_recite($id=NULL)
    {
        $data['v'] = $this->withdraw_model->get_verify_data($id);

        $data['title']   = display('withdraw_recite'); 
        $data['my_info'] = $this->Profile_model->my_info();

        $data['content'] = $this->load->view('customer/pages/withdraw_recite', $data, true);
        
        $this->load->view('customer/layout/main_wrapper', $data);
    }

    /*
    |-----------------------------------
    |   Balance Check
    |-----------------------------------
    */

    public function check_balance($amount=NULL)
    {
        $data = $this->transections_model->get_cata_wais_transections();
        $amount += $this->fees_load($amount,NULL,'withdraw');
        
        if($amount < $data['balance']){
            return true;
        } else {
            return false;
        }
    }



    /*
    |----------------------------------------------
    |        id genaretor
    |----------------------------------------------     
    */
    public function randomID($mode = 2, $len = 6)
    {
        $result = "";
        if($mode == 1):
            $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
        elseif($mode == 2):
            $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        elseif($mode == 3):
            $chars = "abcdefghijklmnopqrstuvwxyz0123456789";
        elseif($mode == 4):
            $chars = "0123456789";
        endif;

        $charArray = str_split($chars);
        for($i = 0; $i < $len; $i++) {
                $randItem = array_rand($charArray);
                $result .="".$charArray[$randItem];
        }
        return $result;
    }
    /*
    |----------------------------------------------
    |         Ends of id genaretor
    |----------------------------------------------
    */    
    

}
