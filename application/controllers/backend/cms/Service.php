<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Service extends CI_Controller {
 	
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
		$data['title']  = display('service_list');

		$slug3 = $this->uri->segment(3);
		$cat_id     = $this->article_model->catidBySlug($slug3)->cat_id;
 		
 		/******************************
        * Pagination Start
        ******************************/
        $config["base_url"] = base_url('backend/cms/service/index');
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

 	public function slug_check($headline_en, $article_id)
    { 
        $packageExists = $this->db->select('*')
            ->where('headline_en',$headline_en) 
            ->where_not_in('article_id',$article_id) 
            ->get('web_article')
            ->num_rows();

        if ($packageExists > 0) {
            $this->form_validation->set_message('headline_en', 'The {field} is already registered.');
            return false;
        } else {
            return true;
        }

    }


	public function form($article_id = null)
	{
		$data['title']  = display('add_service');

		$data['web_language'] = $this->language_model->single('1');

		$slug3 		= $this->uri->segment(3);
		$cat_id     = $this->article_model->catidBySlug($slug3)->cat_id;

		//Set Rules From validation
		if (!empty($article_id)) {   
       		$this->form_validation->set_rules('headline_en', display("headline_en"), "required|max_length[255]|callback_slug_check[$article_id]"); 

		} else {
			$this->form_validation->set_rules('headline_en', display('headline_en'),'required|is_unique[web_article.headline_en]|max_length[255]');
			
		}

		$slug = url_title(strip_tags($this->input->post('headline_en')), 'dash', TRUE);

		$data['article']   = (object)$userdata = array(
			'article_id'      	=> $this->input->post('article_id'),
			'slug'      		=> $slug,
			'headline_en'   	=> $this->input->post('headline_en'),
			'headline_fr' 		=> $this->input->post('headline_fr'),
			'article1_en' 		=> $this->input->post('article1_en'),
			'article1_fr' 		=> $this->input->post('article1_fr'),
			'article2_en' 		=> $this->input->post('article2_en'),
			'article2_fr' 		=> $this->input->post('article2_fr'),
			'video' 			=> $this->input->post('video'),
			'cat_id' 			=> $cat_id,
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
				redirect("backend/cms/service/form");

			} 
			else 
			{
				if ($this->article_model->update($userdata)) {
					$this->session->set_flashdata('message', display('update_successfully'));

				} else {
					$this->session->set_flashdata('exception', display('please_try_again'));

				}
				redirect("backend/cms/service/form/$article_id");

			}

		} 
		else
		{
			if(!empty($article_id)) {
				$data['title'] = display('edit_service');
				$data['article']   = $this->article_model->single($article_id);

			}
		}
		
		$data['content'] = $this->load->view("backend/article/service", $data, true);
		$this->load->view("backend/layout/main_wrapper", $data);

	}


	public function delete($article_id = null)
	{  
		if ($this->article_model->delete($article_id)) {
			$this->session->set_flashdata('message', display('delete_successfully'));

		} else {
			$this->session->set_flashdata('exception', display('please_try_again'));

		}
		redirect("backend/cms/service");

	}


}
