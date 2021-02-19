<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {
 	
 	public function __construct()
 	{
 		parent::__construct();

 		if (!$this->session->userdata('isAdmin')) 
        redirect('logout');

		if (!$this->session->userdata('isLogin') 
			&& !$this->session->userdata('isAdmin'))
			redirect('admin');

 		$this->load->model(array(
 			'backend/cms/category_model',
 			'backend/cms/language_model',

 		)); 
 				
 	}
 
	public function index()
	{  
		$data['title']  = display('cat_list');

		$data['web_language'] = $this->language_model->single('1');
 		
 		/******************************
        * Pagination Start
        ******************************/
        $config["base_url"] = base_url('backend/cms/category/index');
        $config["total_rows"] = $this->db->count_all('web_category');
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
        $data['category'] = $this->category_model->read($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
        /******************************
        * Pagination ends
        ******************************/

		$data['content'] = $this->load->view("backend/category/list", $data, true);
		$this->load->view("backend/layout/main_wrapper", $data);

	}

	public function slug_check($cat_name_en, $cat_id)
    { 
        $packageExists = $this->db->select('*')
            ->where('cat_name_en',$cat_name_en) 
            ->where_not_in('cat_id',$cat_id) 
            ->get('web_category')
            ->num_rows();

        if ($packageExists > 0) {
            $this->form_validation->set_message('cat_name_en', 'The {field} is already registered.');
            return false;
            
        } else {
            return true;

        }

    }
 
	public function form($cat_id = null)
	{ 
		$data['title']  = display('add_cat');	

		$data['web_language'] = $this->language_model->single('1');	

		//Set Rules From validation
		if (!empty($cat_id)) {   
       		$this->form_validation->set_rules('cat_name_en', display("cat_name_en"), "required|max_length[255]|callback_slug_check[$cat_id]"); 

		} else {
			$this->form_validation->set_rules('cat_name_en', display('cat_name_en'),'required|is_unique[web_category.cat_name_en]|max_length[255]');

		}

		$slug = url_title($this->input->post('cat_name_en'), 'dash', TRUE);

		//Set Upload File Config 
        $config = [
            'upload_path'   	=> 'upload/',
            'allowed_types' 	=> 'gif|jpg|png|jpeg', 
            'overwrite'     	=> false,
            'maintain_ratio' 	=> true,
            'encrypt_name'  	=> true,
            'remove_spaces' 	=> true,
            'file_ext_tolower' 	=> true 
        ]; 
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('cat_image')) {  
            $data = $this->upload->data();  
            $image = $config['upload_path'].$data['file_name'];

            $config['image_library']  = 'gd2';
            $config['source_image']   = $image;
            $config['create_thumb']   = false;
            $config['encrypt_name']   = TRUE;
            $config['width']          = 1200;
            $config['height']         = 393;
            $this->load->library('image_lib', $config);
            $this->image_lib->resize();
            
        }

		
		$data['category']   = (object)$userdata = array(
			'cat_id'      	=> $this->input->post('cat_id'),
			'slug'      	=> $slug,
			'cat_name_en'   => $this->input->post('cat_name_en'),
			'cat_name_fr' 	=> $this->input->post('cat_name_fr'), 
			'parent_id'  	=> $this->input->post('parent_id'), 
			'cat_image' 	=> (!empty($image)?$image:$this->input->post('cat_image_old')),
			'cat_title1_en' => $this->input->post('cat_title1_en'),
			'cat_title1_fr' => $this->input->post('cat_title1_fr'),
			'cat_title2_en' => $this->input->post('cat_title2_en'),
			'cat_title2_fr' => $this->input->post('cat_title2_fr'),
			'menu'			=> $this->input->post('menu'),
			'position_serial'=> $this->input->post('position_serial'),
			'status' 		=> $this->input->post('status')
		);
		
		//From Validation Check
		if ($this->form_validation->run()) 
		{

			if (empty($cat_id)) 
			{
				if ($this->category_model->create($userdata)) {
					$this->session->set_flashdata('message', display('save_successfully'));

				} else {
					$this->session->set_flashdata('exception', display('please_try_again'));

				}
				redirect("backend/cms/category/form");

			} 
			else 
			{
				if ($this->category_model->update($userdata)) {
					$this->session->set_flashdata('message', display('update_successfully'));

				} else {
					$this->session->set_flashdata('exception', display('please_try_again'));

				}
				redirect("backend/cms/category/form/$cat_id");

			}

		} 
		else
		{ 
			$data['parent_cat'] = $this->category_model->all();
			if(!empty($cat_id)) {
				$data['title'] = display('edit_cat');
				$data['category']   = $this->category_model->single($cat_id);

			}

		}

		
		$data['content'] = $this->load->view("backend/category/form", $data, true);
		$this->load->view("backend/layout/main_wrapper", $data);

	}


	public function delete($cat_id = null)
	{  
		if ($this->category_model->delete($cat_id)) {
			$this->session->set_flashdata('message', display('delete_successfully'));

		} else {
			$this->session->set_flashdata('exception', display('please_try_again'));

		}
		redirect("backend/cms/category/");

	}


}
