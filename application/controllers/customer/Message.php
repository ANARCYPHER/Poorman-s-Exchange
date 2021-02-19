<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Message extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
  
        if (!$this->session->userdata('isLogIn')) 
        redirect('login');

        if (!$this->session->userdata('user_id')) 
        redirect('login');  
 
		$this->load->model(array(
            'customer/auth_model' 
        ));

	}

    public function index()
    {   
        $data['title']   = display('message'); 
        $user_id = $this->session->userdata('user_id');
        #-------------------------------#
        #
        #pagination starts
        #
        $config["base_url"] = base_url('customer/message/index');
        $config["total_rows"] = $this->db->select('*')
        ->from('message')
        ->where('receiver_id',$user_id)
        ->get()->num_rows();
        $config["per_page"] = 15;
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
        
        $data['message'] = $this->db->select('*')
        ->from('message')
        ->where('receiver_id',$user_id)
        ->order_by('id','DESC')
        ->limit($config["per_page"], $page)
        ->get()->result(); 
        
        $data["links"] = $this->pagination->create_links();

        #
        #pagination ends
        #  
        $data['content'] = $this->load->view('customer/email_sms/all_message', $data, true);
        $this->load->view('customer/layout/main_wrapper', $data);  
    }

    public function message_details($message_id)
    {   

        $user_id = $this->session->userdata('user_id');
        $this->db->set('receiver_status',1)->where('receiver_id',$user_id)->where('id',$message_id)->update('message');
        
        $data['message'] = $this->db->select('*')->from('message')->where('receiver_id',$user_id)->where('id',$message_id)->get()->row();
        $data['title']   = display('message'); 
        $data['content'] = $this->load->view('customer/email_sms/sms_details', $data, true);
        $this->load->view('customer/layout/main_wrapper', $data);  
    }

}
