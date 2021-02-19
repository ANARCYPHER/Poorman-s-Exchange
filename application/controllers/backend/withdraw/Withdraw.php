<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Withdraw extends CI_Controller {
 	
 	public function __construct()
 	{
 		parent::__construct();
 		$this->load->model(array(
 			'backend/withdraw/withdraw_model'  
 		));
 		
 		if (!$this->session->userdata('isAdmin')) 
        redirect('logout');
 		
		if (!$this->session->userdata('isLogin') 
			&& !$this->session->userdata('isAdmin'))
			redirect('admin');
 	}
 
	public function withdraw_list()
	{  
		$data['title'] = display('withdraw_list');
 		#-------------------------------#
        #
        #pagination starts
        #
        $config["base_url"] = base_url('backend/withdraw/withdraw/withdraw_list');
        $config["total_rows"] = $this->db->count_all('withdraw');
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
        $data['withdraw'] = $this->withdraw_model->read($config["per_page"], $page);

        $data["links"] = $this->pagination->create_links();
        #
        #pagination ends
        #    
		$data['content'] = $this->load->view("backend/withdraw/withdraw_list", $data, true);
		$this->load->view("backend/layout/main_wrapper", $data);
	
	}


	public function pending_withdraw()
	{
		$data['title'] = display('pending_withdraw');
        #-------------------------------#
        #
        #pagination starts
        #
        $config["base_url"] = base_url('backend/withdraw/withdraw/pending_withdraw');
        $config["total_rows"] = $this->db->get_where('withdraw', array('status'=>1))->num_rows();
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
        $data['withdraw'] = $this->db->select('*')->from('withdraw')
        ->where('status',1)
        ->limit($config["per_page"], $page)
        ->get()
        ->result();
        $data["links"] = $this->pagination->create_links();
        #
        #pagination ends
        #

		$data['content'] = $this->load->view("backend/withdraw/pending_withdraw", $data, true);
		$this->load->view("backend/layout/main_wrapper", $data);
	
	}


	public function confirm_withdraw()
	{
		$set_status = $_GET['set_status'];
		$user_id = $_GET['user_id'];
		$id = $_GET['id'];
		$data = array(
			'success_date' =>date('Y-m-d h:is'),
			'status' => $set_status,
		);
		$this->db->where('withdraw_id',$id)->where('user_id',$user_id)->update('withdraw',$data);
		
		redirect('backend/withdraw/withdraw/withdraw_list');
	}


    public function cancel_withdraw()
    {
        $set_status = $_GET['set_status'];
        $user_id = $_GET['user_id'];
        $id = $_GET['id'];

        $data = array(
            'cancel_date' =>date('Y-m-d h:is'),
            'status' => $set_status,
        );

        $this->db->set('status',0)
        ->where('transection_category','withdraw')
        ->where('user_id',$user_id)
        ->where('releted_id',$id)
        ->update('transections');

        $this->db->where('withdraw_id',$id)
        ->where('user_id',$user_id)
        ->update('withdraw',$data);
        
        redirect('backend/withdraw/withdraw/withdraw_list');
    }
 


}
