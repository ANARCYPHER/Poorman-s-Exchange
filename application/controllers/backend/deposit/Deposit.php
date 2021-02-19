<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Deposit extends CI_Controller {
 	
 	public function __construct()
 	{
 		parent::__construct();
 		$this->load->model(array(

 			'backend/deposit/deposit_model',
            'customer/diposit_model',
            'customer/transections_model',
            'common_model',  
 		));
 		
 		if (!$this->session->userdata('isAdmin')) 
        redirect('logout');
 		
		if (!$this->session->userdata('isLogin') 
			&& !$this->session->userdata('isAdmin'))
			redirect('admin');
 	}
 
	public function deposit_list()
	{  
		$data['title'] = display('deposit_list');
 		#-------------------------------#
        #
        #pagination starts
        #
        $config["base_url"] = base_url('backend/deposit/deposit/deposit_list');
        $config["total_rows"] = $this->db->get_where('deposit', array('status'=>1, 'deposit_method'=>'phone'))->num_rows();
        $config["per_page"] = 25;
        $config["uri_segment"] = 5;
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
        $page = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
        $data['deposit'] = $this->db->select('*')->from('deposit')
                ->where('status',1)
                ->where('deposit_method','phone')
                ->limit($config["per_page"], $page)
                ->get()
                ->result();
        $data["links"] = $this->pagination->create_links();
        #
        #pagination ends
        #    
		$data['content'] = $this->load->view("backend/deposit/list", $data, true);
		$this->load->view("backend/layout/main_wrapper", $data);
	
	}


	public function pending_deposit()
	{
		$data['title'] = display('pending_deposit');
        #-------------------------------#
        #
        #pagination starts
        #
        $config["base_url"] = base_url('backend/deposit/deposit/pending_deposit');
        $config["total_rows"] = $this->db->get_where('deposit', array('status'=>0, 'deposit_method'=>'phone'))->num_rows();
        $config["per_page"] = 25;
        $config["uri_segment"] = 5;
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
        $page = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
        $data['deposit'] = $this->db->select('*')->from('deposit')
        ->where('status',0)
        ->where('deposit_method','phone')
        ->limit($config["per_page"], $page)
        ->get()
        ->result();
        $data["links"] = $this->pagination->create_links();
        #
        #pagination ends
        #

		$data['content'] = $this->load->view("backend/deposit/list", $data, true);
		$this->load->view("backend/layout/main_wrapper", $data);
	
	}


	public function confirm_deposit()
	{
		$set_status = $_GET['set_status'];
		$user_id = $_GET['user_id'];
		$id = $_GET['id'];
		$data = array(
			'status' => $set_status,
		);

        $this->db->where('deposit_id',$id)->where('user_id',$user_id)->update('deposit',$data);

        $data = $this->db->select('*')->from('deposit')->where('deposit_id',$id)->get()->row();
        $userdata = $this->db->select('*')->from('user_registration')->where('user_id',$user_id)->get()->row();

        if($data!=NULL){
            
            $transections_data = array(
            'user_id'                   => $data->user_id,
            'transection_category'      => 'deposit',
            'releted_id'                => $data->deposit_id,
            'amount'                    => $data->deposit_amount,
            'comments'                  => "Deposite by OM Mobile",
            'transection_date_timestamp'=> date('Y-m-d h:i:s')
            );
            $this->diposit_model->save_transections($transections_data);
            
        }

        $set = $this->common_model->email_sms('email');
        $appSetting = $this->common_model->get_setting();
        #-----------------------------------------------------
        $balance = $this->transections_model->get_cata_wais_transections($userdata->user_id);
       

        #-----------------------------------------------------
        if($set->deposit!=NULL){
            #----------------------------
            #      email verify smtp
            #----------------------------
            $post = array(
                'title'           => $appSetting->title,
                'subject'           => 'Deposit',
                'to'                => $userdata->email,
                'message'           => 'You successfully deposit the amount $'.$data->deposit_amount.'. Your new balance is $'.$balance['balance'],
            );
            $send_email = $this->common_model->send_email($post);

            if($send_email){
                    $n = array(
                    'user_id'                => $userdata->user_id,
                    'subject'                => display('diposit'),
                    'notification_type'      => 'deposit',
                    'details'                => 'You successfully deposit The amount $'.$data->deposit_amount.'. Your new balance is $'.$balance['balance'],
                    'date'                   => date('Y-m-d h:i:s'),
                    'status'                 => '0'
                );
                $this->db->insert('notifications',$n);    
            }

            $this->load->library('sms_lib');
            $template = array( 
                'name'       => $userdata->f_name." ". $userdata->l_name,
                'amount'     => $data->deposit_amount,
                'new_balance'=> $balance['balance'],
                'date'       => date('d F Y')
            );

            #------------------------------
            #   SMS Sending
            #------------------------------
            $send_sms = $this->sms_lib->send(array(
                'to'              => $userdata->phone, 
                'header'         => 'Deposit', 
                'template'        => 'You successfully deposit the amount $%amount% . Your new balance is $%new_balance%.', 
                'template_config' => $template, 
            ));

            if($send_sms){

                $message_data = array(
                    'sender_id' =>1,
                    'receiver_id' => $userdata->user_id,
                    'subject' => 'Deposit',
                    'message' => 'You successfully deposit the amount $'.$data->deposit_amount.'. Your new balance is $'.$balance['balance'],
                    'datetime' => date('Y-m-d h:i:s'),
                );

                $this->db->insert('message',$message_data);    

            }

        }


		
		redirect('backend/deposit/deposit/pending_deposit');


	}


    public function cancel_deposit()
    {
        $set_status = $_GET['set_status'];
        $user_id = $_GET['user_id'];
        $id = $_GET['id'];

        $data = array(
            'status' => $set_status,
        );


        $this->db->where('deposit_id',$id)
        ->where('user_id',$user_id)
        ->update('deposit',$data);
        
        redirect('backend/deposit/deposit/pending_deposit');
    }
 

}
