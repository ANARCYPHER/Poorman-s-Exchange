<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Currency extends CI_Controller {
 	
 	public function __construct()
 	{
 		parent::__construct();
 		if (!$this->session->userdata('isAdmin')) 
        redirect('logout');

		if (!$this->session->userdata('isLogin') 
			&& !$this->session->userdata('isAdmin'))
			redirect('admin');
    
 		$this->load->model(array(
 			'backend/currency/currency_model'  
 		));
 		
 	}
 
	public function index()
	{
		$data['title']  = display('cryptocurrency');
 		
 		/******************************
        * Pagination Start
        ******************************/
        $config["base_url"] = base_url('backend/currency/currency/index');
        $config["total_rows"] = $this->db->count_all('crypto_currency');
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
        $data['localcurrency'] = $this->currency_model->findlocalCurrency();
        $data['currency'] = $this->currency_model->read($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
        /******************************
        * Pagination ends
        ******************************/

		$data['content'] = $this->load->view("backend/currency/list", $data, true);
		$this->load->view("backend/layout/main_wrapper", $data);

	}
 
	public function form($cid = null)
	{ 
		$data['title']  = display('cryptocurrency');

		//Set Rules From validation
		$this->form_validation->set_rules('status', display('status'),'required|max_length[1]');

		/*-----------------------------------*/ 
		$data['currency']   = (object)$userdata = array(
			'cid'      	=> $this->input->post('cid'),
			'status' 	=> $this->input->post('status')
		);

		//From Validation Check
		if ($this->form_validation->run()) 
		{
			if (empty($cid)) 
			{
				if ($this->currency_model->create($userdata)) {
					$this->session->set_flashdata('message', display('save_successfully'));
				} else {
					$this->session->set_flashdata('exception', display('please_try_again'));
				}
				redirect("backend/currency/form/");
			} 
			else 
			{
				if ($this->currency_model->update($userdata)) {
					$this->session->set_flashdata('message', display('update_successfully'));
				} else {
					$this->session->set_flashdata('exception', display('please_try_again'));
				}
				redirect("backend/currency/currency/");
			}
		} 
		else
		{
			if(!empty($cid)) {
				$data['title'] = display('edit_currency');
				$data['currency']   = $this->currency_model->single($cid);
			}
		}
		$data['content'] = $this->load->view("backend/currency/form", $data, true);
		$this->load->view("backend/layout/main_wrapper", $data);
	}
	
}
