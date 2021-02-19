<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
 	
 	public function __construct()
 	{
 		parent::__construct();

 		$this->load->model(array(
 			'customer/auth_model' 
 		));

		$this->load->helper('captcha');
 	}
 

	public function login()
	{  

		if ($this->session->userdata('isLogIn'))
			redirect('customer/home');

		$data['title']    = display('customer'); 
		#-------------------------------------#
		$this->form_validation->set_rules('email', display('email'), 'required');
		$this->form_validation->set_rules('password', display('password'), 'required|max_length[32]|md5|trim');
		

		$this->form_validation->set_rules('captcha', display('captcha'),
		    array(
		        'matches[captcha]', 
		        function($captcha)
		        { 
		        	$oldCaptcha = $this->session->userdata('captcha');
		        	
		        	if ($captcha == $oldCaptcha) {
		        		return true;
		        	}
		        }
		    )
		);



		#-------------------------------------#
		$data['user'] = (object)$userData = array(
			'email' 	 => $this->input->post('email'),
			'password'   => $this->input->post('password'),
		);
		
		
		#-------------------------------------#
		if ( $this->form_validation->run())
		{
			$this->session->unset_userdata('captcha');
			$user = $this->auth_model->checkUser($userData);

			if($user->num_rows() > 0) 
			{ 

				$sData = array(
					'isLogIn' 	  => true,
					'id' 		  => $user->row()->uid,
					'user_id' 	  => $user->row()->user_id,
					'sponsor_id'  => $user->row()->sponsor_id,
					'fullname'	  => $user->row()->f_name.' '.$user->row()->l_name,
					'email' 	  => $user->row()->email,
					'phone' 	  => $user->row()->phone,
				);	
				
			

				//store date to session 
				$this->session->set_userdata($sData);
				//update database status
				//$this->auth_model->last_login();
				//welcome message
				$this->session->set_flashdata('message', display('welcome_back').' '.$user->row()->f_name.' '.$user->row()->l_name);

				redirect('customer/home');

			} else {
				$this->session->set_flashdata('exception', display('incorrect_email_password'));
				redirect('customer');
				
			} 

		} else {

			$captcha = create_captcha(array(
			    'img_path'      => './assets/images/captcha/',
			    'img_url'       => base_url('assets/images/captcha/'),
			    'font_path'     => './assets/fonts/captcha.ttf',
			    'img_width'     => '300',
			    'img_height'    => 64,
			    'expiration'    => 600, //5 min
			    'word_length'   => 4,
			    'font_size'     => 26,
			    'img_id'        => 'Imageid',
			    'pool'          => '0123456789abcdefghijklmnopqrstuvwxyz',

			    // White background and border, black text and red grid
			    'colors'        => array(
			            'background' => array(255, 255, 255),
			            'border' => array(228, 229, 231),
			            'text' => array(49, 141, 1),
			            'grid' => array(241, 243, 246)
			    )
			));
			$data['captcha_word'] = $captcha['word'];
			$data['captcha_image'] = $captcha['image'];

			$this->session->set_userdata('captcha', $captcha['word']);
			$this->load->view("customer/layout/login_wrapper", $data);
		}
	}
  
	public function logout()
	{ 
		//update database status
		//$this->auth_model->last_logout();
		//destroy session
		$this->session->sess_destroy();
		redirect(base_url());
	}

}
