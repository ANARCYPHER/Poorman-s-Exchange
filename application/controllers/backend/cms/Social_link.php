<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Social_link extends CI_Controller {
 	
 	public function __construct()
 	{
 		parent::__construct();
 		if (!$this->session->userdata('isAdmin')) 
        redirect('logout');

		if (!$this->session->userdata('isLogin') 
			&& !$this->session->userdata('isAdmin'))
			redirect('admin');

 		$this->load->model(array(
 			'backend/cms/social_link_model',
 			'backend/cms/category_model',
 			'backend/cms/language_model',
 		));

 	}
 
	public function index()
	{
		$data['title']  = display('social_link');
 		
 		/******************************
        * Pagination Start
        ******************************/
        $config["base_url"] = base_url('backend/cms/social_link/index');
        $config["total_rows"] = $this->db->count_all('web_social_link');
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
        $data['social_link'] = $this->social_link_model->read($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
        /******************************
        * Pagination ends
        ******************************/

		$data['content'] = $this->load->view("backend/social_link/list", $data, true);
		$this->load->view("backend/layout/main_wrapper", $data);
	}
 
	public function form($id = null)
	{ 
		$data['title']  = display('add_link');

		$data['web_language'] = $this->language_model->single('1');

		//Set Rules From validation
		$this->form_validation->set_rules('name', display('name'),'required|max_length[100]');
		$this->form_validation->set_rules('link', display('link'),'required|max_length[100]');
		$this->form_validation->set_rules('icon', display('icon'),'required|max_length[100]');
		
		$data['social_link']   = (object)$userdata = array(
			'id'      		=> $this->input->post('id'),
			'name'   		=> $this->input->post('name'),
			'link' 			=> $this->input->post('link'), 
			'icon'  		=> $this->input->post('icon'), 
			'status' 		=> $this->input->post('status')
		);

		//From Validation Check
		if ($this->form_validation->run()) 
		{
			if ($this->social_link_model->update($userdata)) {
				$this->session->set_flashdata('message', display('update_successfully'));
			} else {
				$this->session->set_flashdata('exception', display('please_try_again'));
			}
			redirect("backend/cms/social_link/form/$id");
		} 
		else
		{
			if(!empty($id)) {
				$data['title'] = display('edit_social_link');
				$data['social_link']   = $this->social_link_model->single($id);
			}
			
		}
		$data['content'] = $this->load->view("backend/social_link/form", $data, true);
		$this->load->view("backend/layout/main_wrapper", $data);
		
	}

}
