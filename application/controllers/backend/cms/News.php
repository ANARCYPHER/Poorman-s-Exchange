<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News extends CI_Controller {
 	
 	public function __construct()
 	{
 		parent::__construct();

 		if (!$this->session->userdata('isAdmin')) 
        	redirect('logout');

		if (!$this->session->userdata('isLogin') 
			&& !$this->session->userdata('isAdmin'))
			redirect('admin');

 		$this->load->model(array(
 			'backend/cms/news_model',
 			'backend/cms/language_model',

 		));

 	}
 
	public function index()
	{  
		$data['title']  = display('news_list');

		$data['web_language'] = $this->language_model->single('1');
 		
 		/******************************
        * Pagination Start
        ******************************/
        $config["base_url"] = base_url('backend/cms/news/index');
        $config["total_rows"] = $this->db->count_all('web_news');
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
        $data['article'] = $this->news_model->read($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
        /******************************
        * Pagination ends
        ******************************/

		$data['content'] = $this->load->view("backend/news/list", $data, true);
		$this->load->view("backend/layout/main_wrapper", $data);
	}

	public function slug_check($headline_en, $article_id)
    { 
        $packageExists = $this->db->select('*')
            ->where('headline_en',$headline_en) 
            ->where_not_in('article_id',$article_id) 
            ->get('web_news')
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
		$data['title']  = display('post_news');

		$data['web_language'] = $this->language_model->single('1');

		//Set Rules From validation
		if (!empty($article_id)) {   
       		$this->form_validation->set_rules('headline_en', display("headline_en"), "required|max_length[255]|callback_slug_check[$article_id]"); 

		} else {
			$this->form_validation->set_rules('headline_en', display('headline_en'),'required|is_unique[web_news.headline_en]|max_length[255]');
			
		}
		
		$this->form_validation->set_rules('cat_id', display('category'),'required|max_length[10]');

		$slug = url_title(strip_tags($this->input->post('headline_en')), 'dash', TRUE);

		//Set Upload File Config
        $config = [
            'upload_path'   	=> 'upload/news/',
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
			'slug'      		=> $slug,
			'headline_en'   	=> $this->input->post('headline_en'),
			'headline_fr' 		=> $this->input->post('headline_fr'), 
			'article_image'  	=> (!empty($image)?$image:$this->input->post('article_image_old')), 
			'article1_en' 		=> $this->input->post('article1_en'),
			'article1_fr' 		=> $this->input->post('article1_fr'),
			'cat_id' 			=> $this->input->post('cat_id'),
			'publish_date' 		=> date("Y-m-d h:i:sa"),
			'publish_by' 		=> $this->session->userdata('email'),
		);

		//From Validation Check
		if ($this->form_validation->run()) 
		{

			if (empty($article_id)) 
			{
				if ($this->news_model->create($userdata)) {
					$this->session->set_flashdata('message', display('save_successfully'));

				} else {
					$this->session->set_flashdata('exception', display('please_try_again'));

				}
				redirect("backend/cms/news/form/");

			} 
			else 
			{
				if ($this->news_model->update($userdata)) {
					$this->session->set_flashdata('message', display('update_successfully'));

				} else {
					$this->session->set_flashdata('exception', display('please_try_again'));

				}
				redirect("backend/cms/news/form/$article_id");

			}

		} 
		else
		{ 
			$parent_cat = $this->db->select("cat_id")->from('web_category')->where('slug', 'news')->get()->row();
			$child_cat = $this->db->select("*")->from('web_category')->where('parent_id', $parent_cat->cat_id)->get()->result();

			$data['child_cat'] = $child_cat;
			if(!empty($article_id)) {
				$data['title'] = display('edit_news');
				$data['article']   = $this->news_model->single($article_id);

			}
		}
		
		$data['content'] = $this->load->view("backend/news/form", $data, true);
		$this->load->view("backend/layout/main_wrapper", $data);

	}


	public function delete($article_id = null)
	{  
		if ($this->news_model->delete($article_id)) {
			$this->session->set_flashdata('message', display('delete_successfully'));

		} else {
			$this->session->set_flashdata('exception', display('please_try_again'));

		}
		redirect("backend/cms/news/");

	}


}
