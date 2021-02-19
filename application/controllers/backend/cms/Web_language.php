<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Web_language extends CI_Controller {
 	
 	public function __construct()
 	{
 		parent::__construct();

 		if (!$this->session->userdata('isAdmin')) 
        	redirect('logout');

		if (!$this->session->userdata('isLogin') 
			&& !$this->session->userdata('isAdmin'))
			redirect('admin');

 		$this->load->model(array(
 			'backend/cms/language_model',

 		));

 	}
 
	public function index($id = 1)
	{  
		$data['title']  = display('update_website_language');

		//Set Rules From validation		
		$this->form_validation->set_rules('name', display('name'),'required|max_length[100]');
		$this->form_validation->set_rules('flag', display('flag'),'required|max_length[10]');


		$data['language'] = (object)$userdata = array(
			'id'			=> $this->input->post('id'),
			'name'   		=> $this->input->post('name'),
			'flag'   		=> $this->input->post('flag')
		);

		//From Validation Check
		if ($this->form_validation->run()) 
		{

			if ($this->language_model->update($userdata)) {
				$this->session->set_flashdata('message', display('update_successfully'));

			} else {
				$this->session->set_flashdata('exception', display('please_try_again'));

			}
			redirect("backend/cms/web_language");

		} 
		else
		{
			if(!empty($id)) {
				$data['title'] = display('update_website_language');
				$data['language']   = $this->language_model->single($id);

			}
		}
		
		$data['content'] = $this->load->view("backend/article/language", $data, true);
		$this->load->view("backend/layout/main_wrapper", $data);
	}


}
