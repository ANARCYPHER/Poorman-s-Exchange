<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transection extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
  
        if (!$this->session->userdata('isLogIn')) 
        redirect('login');

        if (!$this->session->userdata('user_id')) 
        redirect('login');  
 
		$this->load->model(array(
            'customer/transections_model', 
            'customer/Profile_model', 
        ));

	}

    public function index()
    { 

        $data = $this->transections_model->get_cata_wais_transections();
        $data['transection'] = $this->transections_model->all_transection();
        $data['title']   = display('transection'); 
        $data['content'] = $this->load->view('customer/pages/transection', $data, true);
        $this->load->view('customer/layout/main_wrapper', $data);  
    
    }

    public function transection_details($id=NULL,$table=NULL)
    { 


        $data['title']   = display('transection_details');
        $data['my_info'] = $this->Profile_model->my_info(); 
        $data['transection'] = $this->transections_model->transection_by_id($id,$table);
        $data['content'] = $this->load->view('customer/pages/transection_details', $data, true);
        $this->load->view('customer/layout/main_wrapper', $data);  
    
    }    

}
