<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Slider extends CI_Controller {
 	
 	public function __construct()
 	{
 		parent::__construct();

 		if (!$this->session->userdata('isAdmin')) 
        	redirect('logout');

		if (!$this->session->userdata('isLogin') 
			&& !$this->session->userdata('isAdmin'))
			redirect('admin');

 		$this->load->model(array(
 			'backend/cms/slider_model',
 			'backend/cms/language_model',

 		));

 	}
 
	public function index()
	{
		$data['title']  = display('slider_list');

		$data['web_language'] = $this->language_model->single('1');

 		/******************************
        * Pagination Start
        ******************************/
        $config["base_url"] = base_url('backend/cms/slider/index');
        $config["total_rows"] = $this->db->count_all('web_slider');
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
        $data['slider'] = $this->slider_model->read($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
        /******************************
        * Pagination ends
        ******************************/

		$data['content'] = $this->load->view("backend/slider/list", $data, true);
		$this->load->view("backend/layout/main_wrapper", $data);

	}
 
	public function form($slider_id = null)
	{ 
		$data['title']  = display('add_slider');

		$data['web_language'] = $this->language_model->single('1');

		//Set Rules From validation
		$this->form_validation->set_rules('slider_h1_en', display('slider_h1_en'),'required|max_length[1000]');

		//Set Upload File Config 
        $config = [
            'upload_path'   	=> 'upload/slider/',
            'allowed_types' 	=> 'gif|jpg|png|jpeg', 
            'overwrite'     	=> false,
            'maintain_ratio' 	=> true,
            'encrypt_name'  	=> true,
            'remove_spaces' 	=> true,
            'file_ext_tolower' 	=> true 
        ]; 
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('slider_img')) {  
            $data = $this->upload->data();  
            $image = $config['upload_path'].$data['file_name'];

            $config['image_library']  = 'gd2';
            $config['source_image']   = $image;
            $config['create_thumb']   = false;
            $config['encrypt_name']   = TRUE;
            $config['width']          = 1200;
            $config['height']         = 800;
            $this->load->library('image_lib', $config);
            $this->image_lib->resize();
            
        }

		$data['slider']   = (object)$sliderdata = array(
			'slider_id'      	=> $this->input->post('slider_id'),
			'slider_h1_en'   	=> $this->input->post('slider_h1_en'),
			'slider_h1_fr' 		=> $this->input->post('slider_h1_fr'), 
			'slider_h2_en'  	=> $this->input->post('slider_h2_en'), 
			'slider_h2_fr' 		=> $this->input->post('slider_h2_fr'),
			'slider_h3_en' 		=> $this->input->post('slider_h3_en'),
			'slider_h3_fr' 		=> $this->input->post('slider_h3_fr'),
			'slider_img' 		=> (!empty($image)?$image:$this->input->post('slider_img_old')),
			'custom_url' 		=> $this->input->post('custom_url'),
			'status' 			=> $this->input->post('status')
		);

		//From Validation Check
		if ($this->form_validation->run()) 
		{
			if (empty($slider_id)) 
			{
				if ($this->slider_model->create($sliderdata)) {
					$this->session->set_flashdata('message', display('save_successfully'));

				} else {
					$this->session->set_flashdata('exception', display('please_try_again'));

				}
				redirect("backend/cms/slider/form/");

			} 
			else 
			{
				if ($this->slider_model->update($sliderdata)) {
					$this->session->set_flashdata('message', display('update_successfully'));

				} else {
					$this->session->set_flashdata('exception', display('please_try_again'));

				}
				redirect("backend/cms/slider/form/$slider_id");

			}

		}
		else {
			if(!empty($slider_id)) {
				$data['title'] = display('edit_slider');
				$data['slider']   = $this->slider_model->single($slider_id);

			}
		}

		$data['content'] = $this->load->view("backend/slider/form", $data, true);
		$this->load->view("backend/layout/main_wrapper", $data);

	}


	public function delete($slider_id = null)
	{  
		if ($this->slider_model->delete($slider_id)) {
			$this->session->set_flashdata('message', display('delete_successfully'));

		} else {
			$this->session->set_flashdata('exception', display('please_try_again'));

		}
		redirect("backend/cms/slider/");

	}

}