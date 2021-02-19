<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Team extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
  
        if (!$this->session->userdata('isLogIn')) 
        redirect('login');

        if (!$this->session->userdata('user_id')) 
        redirect('login');  
 
		$this->load->model(array(
            'customer/team_model' 
        ));

	}


    public function index()
    { 
        $user_id = $this->session->userdata('user_id');  
        $data = $this->team_model->my_team($user_id);
        $data['title']   = display('my_generation'); 
        $data['content'] = $this->load->view('customer/pages/team', $data, true);
        $this->load->view('customer/layout/main_wrapper', $data);  
    }

}
