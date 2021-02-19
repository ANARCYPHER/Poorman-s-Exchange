<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller {
 	
 	public function __construct()
 	{
 		parent::__construct();

 		if (!$this->session->userdata('isAdmin')) 
        	redirect('logout');

		if (!$this->session->userdata('isLogin') 
			&& !$this->session->userdata('isAdmin'))
			redirect('admin');

 		$this->load->model(array(
 			'backend/cms/article_model',
 			'backend/cms/category_model',
 			'backend/cms/language_model',

 		));

 	}
 
	public function index()
	{  
		$data['title']  = display('edit_contact');

		$data['web_language'] = $this->language_model->single('1');

		$slug3 		= $this->uri->segment(3);
		$cat_id     = $this->article_model->catidBySlug($slug3)->cat_id;
		$article_id = $this->article_model->articleByCatid($cat_id)->article_id;

		//Set Rules From validation		
		$this->form_validation->set_rules('headline_en', display('headline_en'),'required|max_length[255]');


		$data['article']   = (object)$userdata = array(
			'article_id'      	=> $this->input->post('article_id'),
			'headline_en'   	=> $this->input->post('headline_en'),
			'headline_fr' 		=> $this->input->post('headline_fr'), 
			'article1_en' 		=> $this->input->post('article1_en'),
			'article1_fr' 		=> $this->input->post('article1_fr'),
			'article2_en' 		=> $this->input->post('article2_en'),
			'cat_id' 			=> $cat_id,
			'publish_date' 		=> date("Y-m-d h:i:sa"),
			'publish_by' 		=> $this->session->userdata('email')
		);

		//From Validation Check
		if ($this->form_validation->run()) 
		{

			if ($this->article_model->update($userdata)) {
				$this->session->set_flashdata('message', display('update_successfully'));

			} else {
				$this->session->set_flashdata('exception', display('please_try_again'));

			}
			redirect("backend/cms/contact");

		} 
		else
		{
			if(!empty($article_id)) {
				$data['title'] = display('edit_contact');
				$data['article']   = $this->article_model->single($article_id);

			}
		}
		
		$data['content'] = $this->load->view("backend/article/contact", $data, true);
		$this->load->view("backend/layout/main_wrapper", $data);
	}


}
