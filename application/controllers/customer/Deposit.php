<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Deposit extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
  
        if (!$this->session->userdata('isLogIn')) 
        redirect('login');

        if (!$this->session->userdata('user_id')) 
        redirect('login');  
 
		$this->load->model(array(
            
            'customer/diposit_model',
            'customer/transections_model',
            'common_model',
        ));
	}


/*
|-----------------------------------
|   Add new Deposit form
|-----------------------------------
*/
    public function index()
    {   
        $data['title']   = display('diposit'); 
        $data['payment_gateway'] = $this->common_model->payment_gateway();
        $data['content'] = $this->load->view('customer/pages/diposit', $data, true);
        $this->load->view('customer/layout/main_wrapper', $data);  
    }

/*
|-----------------------------------
|   Save Deposit 
|-----------------------------------
*/

    public function store($diposit_id=NULL)
    { 
    
        $data = $this->db->select('*')->from('deposit')->where('deposit_id',$diposit_id)->get()->row();

        $this->db->set('status',1)->where('deposit_id',$diposit_id)->update('deposit');
        
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
            
        }

        $set = $this->common_model->email_sms('email');
        $appSetting = $this->common_model->get_setting();
        #-----------------------------------------------------
        $balance = $this->transections_model->get_cata_wais_transections();
       

        #-----------------------------------------------------
        if($set->deposit!=NULL){

            #----------------------------
            #      email verify smtp
            #----------------------------
            $post = array(
                'title'             => $appSetting->title,
                'subject'           => 'Deposit',
                'to'                => $this->session->userdata('email'),
                'message'           => 'You successfully deposit the amount $'.$data->deposit_amount.'. Your new balance is $'.$balance['balance'],
            );
            $send_email = $this->common_model->send_email($post);

            if($send_email){
                    $n = array(
                    'user_id'                => $this->session->userdata('user_id'),
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
                'name'       => $this->session->userdata('fullname'),
                'amount'     => $data->deposit_amount,
                'new_balance'=> $balance['balance'],
                'date'       => date('d F Y')
            );

            #------------------------------
            #   SMS Sending
            #------------------------------
            $send_sms = $this->sms_lib->send(array(
                'to'              => $this->session->userdata('phone'), 
                'header'         => 'Deposit', 
                'template'        => 'You successfully deposit the amount $%amount% . Your new balance is $%new_balance%.', 
                'template_config' => $template, 
            ));

            if($send_sms){

                $message_data = array(
                    'sender_id' =>1,
                    'receiver_id' => $this->session->userdata('user_id'),
                    'subject' => 'Deposit',
                    'message' => 'You successfully deposit the amount $'.$data->deposit_amount.'. Your new balance is $'.$balance['balance'],
                    'datetime' => date('Y-m-d h:i:s'),
                );

                $this->db->insert('message',$message_data);    

            }

        }


        $this->session->set_flashdata('message', display('deopsit_add_msg'));
        redirect('customer/deposit');

    }

/*
|-----------------------------------
|   View deposit list
|-----------------------------------
*/

    public function show()
    {   
        $data['title']   = display('deposit_list');
        #-------------------------------#
        #
        #pagination starts
        #
        $config["base_url"] = base_url('customer/deposit/show');
        $config["total_rows"] = $this->db->get_where('deposit', array('user_id'=>$this->session->userdata('user_id')))->num_rows();
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
        $data['deposit'] = $this->diposit_model->read($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
        #
        #pagination ends
        #
        //$data['deposit'] = $this->diposit_model->all_deposit();
        $data['content'] = $this->load->view('customer/pages/diposit_list', $data, true);
        $this->load->view('customer/layout/main_wrapper', $data);  
    }


}
