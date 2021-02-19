<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		
		if (!$this->session->userdata('isAdmin')) 
        redirect('logout');
  
        if (!$this->session->userdata('isLogIn')) 
        redirect('admin'); 
 
		$this->load->model(array(
            'backend/dashboard/home_model',
			'backend/dashboard/dashboard_model',
		));
	}

    public function index()
    {     
        $data = $this->dashboard_model->get_cata_wais_transections();
        $data['title']   = display('home'); 
        $data['wrequest'] = $this->dashboard_model->withdraw_all_request();
        $data['exchange'] = $this->dashboard_model->exchange_all_request();
        $data['cryptocurrency'] = $this->dashboard_model->crypto_all_request();
       
        $data['content'] = $this->load->view('backend/dashboard/home', $data, true);
        $this->load->view('backend/layout/main_wrapper', $data);  
    }

    public function profile()
    {
        $data['title'] = display('profile'); 
        $data['user']  = $this->home_model->profile($this->session->userdata('id'));
        $data['content'] = $this->load->view('backend/dashboard/profile', $data, true);
        $this->load->view('backend/layout/main_wrapper', $data);  
    }

    public function edit_profile()
    { 
        $data['title']    = display('edit_profile');
        $id = $this->session->userdata('id');
        /*-----------------------------------*/
        $this->form_validation->set_rules('firstname', 'First Name','required|max_length[50]');
        $this->form_validation->set_rules('lastname', 'Last Name','required|max_length[50]');
        #------------------------#
        $this->form_validation->set_rules('email', 'Email Address', "required|valid_email|max_length[100]");
        /*---#callback fn not supported#---*/ 
        // $this->form_validation->set_rules('email', 'Email Address', "required|valid_email|max_length[100]|callback_email_check[$id]|trim"); 
        #------------------------#
        $this->form_validation->set_rules('password', 'Password','required|max_length[32]|md5');
        $this->form_validation->set_rules('about', 'About','max_length[1000]');
        /*-----------------------------------*/ 
        //set config 
        $config = [
            'upload_path'   => 'upload/settings/',
            'allowed_types' => 'gif|jpg|png|jpeg', 
            'overwrite'     => false,
            'maintain_ratio' => true,
            'encrypt_name'  => true,
            'remove_spaces' => true,
            'file_ext_tolower' => true 
        ]; 
        $this->load->library('upload', $config);
 
        if ($this->upload->do_upload('image')) {  
            $data = $this->upload->data();  
            $image = $config['upload_path'].$data['file_name']; 

            $config['image_library']  = 'gd2';
            $config['source_image']   = $image;
            $config['create_thumb']   = false;
            $config['encrypt_name']   = TRUE;
            $config['width']          = 115;
            $config['height']         = 90;
            $this->load->library('image_lib', $config);
            $this->image_lib->resize();
            $this->session->set_flashdata('message', display("image_upload_successfully"));
        }
        /*-----------------------------------*/
        $data['user'] = (object)$userData = array(
            'id'          => $this->input->post('id'),
            'firstname'   => $this->input->post('firstname'),
            'lastname'    => $this->input->post('lastname'),
            'email'       => $this->input->post('email'),
            'password'    => md5($this->input->post('password')),
            'about'       => $this->input->post('about',true),
            'image'       => (!empty($image)?$image:$this->input->post('old_image')) 
        );

        /*-----------------------------------*/
        if ($this->form_validation->run()) {

            if (empty($userData['image'])) {
                $this->session->set_flashdata('exception', $this->upload->display_errors()); 
            }

            if ($this->home_model->update_profile($userData)) 
            {
                $this->session->set_userdata(array(
                    'fullname'   => $this->input->post('firstname'). ' ' .$this->input->post('lastname'),
                    'email'       => $this->input->post('email'),
                    'image'       => (!empty($image)?$image:$this->input->post('old_image'))
                ));


                $this->session->set_flashdata('message', display('update_successfully'));
            } else {
                $this->session->set_flashdata('exception',  display('please_try_again'));
            }
            redirect("backend/dashboard/home/edit_profile");

        } else { 
            $data['user']   = $this->home_model->profile($id);
            $data['content'] = $this->load->view('backend/dashboard/edit_profile', $data, true);
            $this->load->view('backend/layout/main_wrapper', $data);  
        }
    }
    

}