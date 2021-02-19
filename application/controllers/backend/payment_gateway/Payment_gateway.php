<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment_gateway extends CI_Controller {
 	
 	public function __construct()
 	{
 		parent::__construct();
 		if (!$this->session->userdata('isAdmin')) 
        redirect('logout');

		if (!$this->session->userdata('isLogin') 
			&& !$this->session->userdata('isAdmin'))
			redirect('admin');

 		$this->load->model(array(
 			'backend/payment_gateway/payment_gateway_model',
 		));
 		
 	}
 
	public function index()
	{
		$data['title']  = display('payment_gateway');
 		#-------------------------------#
        #
        #pagination starts
        #
        $config["base_url"] = base_url('backend/payment_gateway/payment_gateway/index');
        $config["total_rows"] = $this->db->count_all('payment_gateway');
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
        $data['payment_gateway'] = $this->payment_gateway_model->read($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
        #
        #pagination ends
        #    
		$data['content'] = $this->load->view("backend/payment_gateway/list", $data, true);
		$this->load->view("backend/layout/main_wrapper", $data);
	}
 
	public function form($id = null)
	{ 
		$data['title']  = display('add_payment_gateway');

		#------------------------#		
		$this->form_validation->set_rules('public_key', display('public_key'),'required|max_length[1000]');
		$this->form_validation->set_rules('private_key', display('private_key'),'required|max_length[1000]');
		
		/*-----------------------------------*/ 
		$data['payment_gateway']   = (object)$userdata = array(
			'id'      		=> $this->input->post('id'),
			'agent'   		=> $this->input->post('agent'),
			'public_key'   	=> $this->input->post('public_key'),
			'private_key' 	=> $this->input->post('private_key'),
			'secret_key' 	=> $this->input->post('secret_key'),
			'status' 		=> $this->input->post('status')
		);

		/*-----------------------------------*/
		if ($this->form_validation->run()) 
		{
			if ($this->payment_gateway_model->update($userdata)) {
				$this->session->set_flashdata('message', display('update_successfully'));
			} else {
				$this->session->set_flashdata('exception', display('please_try_again'));
			}
			redirect("backend/payment_gateway/payment_gateway/form/$id");
		} 
		else
		{
			if(!empty($id)) {
				$data['title'] = display('edit_payment_gateway');
				$data['payment_gateway']   = $this->payment_gateway_model->single($id);
			}			
		}
		$data['content'] = $this->load->view("backend/payment_gateway/form", $data, true);
		$this->load->view("backend/layout/main_wrapper", $data);
	}


}
