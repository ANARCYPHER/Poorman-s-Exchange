<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Social_app extends CI_Controller {
 	
 	public function __construct()
 	{
 		parent::__construct();
 		if (!$this->session->userdata('isAdmin')) 
        redirect('logout');

		if (!$this->session->userdata('isLogin') 
			&& !$this->session->userdata('isAdmin'))
			redirect('admin');

 		$this->load->model(array(
 			'backend/cms/social_app_model',
 			'backend/cms/category_model',
 			'backend/cms/language_model',
 		));

 	}
 
	public function index()
	{
		$data['title']  = display('social_app');

 		/******************************
        * Pagination Start
        ******************************/
        $config["base_url"] = base_url('backend/cms/social_app/index');
        $config["total_rows"] = $this->db->count_all('social_app');
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
        $data['social_app'] = $this->social_app_model->read($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
        /******************************
        * Pagination ends
        ******************************/

		$data['content'] = $this->load->view("backend/social_app/list", $data, true);
		$this->load->view("backend/layout/main_wrapper", $data);
	}
 
	public function form($id = null)
	{ 
		$data['title']  = display('social_app');

		$data['web_language'] = $this->language_model->single('1');

		//Set Rules From validation
		$this->form_validation->set_rules('app_id', display('app_id'),'required|max_length[1000]');
		$this->form_validation->set_rules('app_secret', display('app_secret'),'required|max_length[1000]');
		if ($id==2) {
			$this->form_validation->set_rules('api_key', display('api_key'),'required|max_length[1000]');
		}

		$data['social_app']   = (object)$userdata = array(
			'id'      		=> $this->input->post('id'),
			'app_id'   		=> $this->input->post('app_id'),
			'app_secret' 	=> $this->input->post('app_secret'), 
			'api_key'  		=> $this->input->post('api_key'), 
			'status' 		=> $this->input->post('status')
		);

		//From Validation Check
		if ($this->form_validation->run()) 
		{
			if ($this->social_app_model->update($userdata)) {
				$this->session->set_flashdata('message', display('update_successfully'));
			} else {
				$this->session->set_flashdata('exception', display('please_try_again'));
			}
			redirect("backend/cms/social_app/form/$id");
		} 
		else
		{
			if(!empty($id)) {
				$data['title'] = display('edit_social_app');
				$data['social_app']   = $this->social_app_model->single($id);
			}
			
		}
		$data['content'] = $this->load->view("backend/social_app/form", $data, true);
		$this->load->view("backend/layout/main_wrapper", $data);
		
	}

}
