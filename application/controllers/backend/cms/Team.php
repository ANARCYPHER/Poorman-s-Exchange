<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Team extends CI_Controller {
 	
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
		$data['title']  = display('team_list');

		$slug3 = $this->uri->segment(3);
		$cat_id     = $this->article_model->catidBySlug($slug3)->cat_id;
 		
 		/******************************
        * Pagination Start
        ******************************/
        $config["base_url"] = base_url('backend/cms/team/index');
        $config["total_rows"] = $this->db->get_where('web_article', array('cat_id'=>$cat_id))->num_rows();
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
        $data['article'] = $this->db->select("*")
                            ->from('web_article')
                            ->where('cat_id', $cat_id)
                            ->limit($config["per_page"], $page)
                            ->get()
                            ->result();
        $data["links"] = $this->pagination->create_links();
        /******************************
        * Pagination ends
        ******************************/

		$data['content'] = $this->load->view("backend/article/list", $data, true);
		$this->load->view("backend/layout/main_wrapper", $data);
	}
 
	public function form($article_id = null)
	{
		$data['title']  = display('add_teammember');

		$data['web_language'] = $this->language_model->single('1');

		$slug3 		= $this->uri->segment(3);
		$cat_id     = $this->article_model->catidBySlug($slug3)->cat_id;

		//Set Rules From validation		
		$this->form_validation->set_rules('headline_en', display('headline_en'),'required|max_length[255]');
		$this->form_validation->set_rules('position_serial', display('position_serial'),'required|max_length[10]|trim');

		//Set Upload File Config
        $config = [
            'upload_path'   	=> 'upload/team/',
            'allowed_types' 	=> 'gif|jpg|png|jpeg', 
            'overwrite'     	=> false,
            'maintain_ratio' 	=> true,
            'encrypt_name'  	=> true,
            'remove_spaces' 	=> true,
            'file_ext_tolower' 	=> true 
        ]; 
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('article_image')) {  
            $data = $this->upload->data();  
            $image = $config['upload_path'].$data['file_name'];            

        }

		$data['article']   = (object)$userdata = array(
			'article_id'      	=> $this->input->post('article_id'),
			'headline_en'   	=> $this->input->post('headline_en'),
			'article_image'  	=> (!empty($image)?$image:$this->input->post('article_image_old')), 
			'article1_en' 		=> $this->input->post('article1_en'),
			'article1_fr' 		=> $this->input->post('article1_fr'),
			'cat_id' 			=> $cat_id,
			'position_serial' 	=> $this->input->post('position_serial'),
			'publish_date' 		=> date("Y-m-d h:i:sa"),
			'publish_by' 		=> $this->session->userdata('email')
		);

		//From Validation Check
		if ($this->form_validation->run()) 
		{

			if (empty($article_id)) 
			{
				if ($this->article_model->create($userdata)) {
					$this->session->set_flashdata('message', display('save_successfully'));

				} else {
					$this->session->set_flashdata('exception', display('please_try_again'));

				}
				redirect("backend/cms/team/form/");

			} 
			else 
			{
				if ($this->article_model->update($userdata)) {
					$this->session->set_flashdata('message', display('update_successfully'));

				} else {
					$this->session->set_flashdata('exception', display('please_try_again'));

				}
				redirect("backend/cms/team/form/$article_id");

			}

		} 
		else
		{
			if(!empty($article_id)) {
				$data['title'] = display('edit_teammember');
				$data['article']   = $this->article_model->single($article_id);

			}
		}
		
		$data['content'] = $this->load->view("backend/article/team", $data, true);
		$this->load->view("backend/layout/main_wrapper", $data);

	}


	public function delete($article_id = null)
	{  
		if ($this->article_model->delete($article_id)) {
			$this->session->set_flashdata('message', display('delete_successfully'));

		} else {
			$this->session->set_flashdata('exception', display('please_try_again'));

		}
		redirect("backend/cms/team/");

	}


}
