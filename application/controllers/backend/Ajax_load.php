<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax_load extends CI_Controller {
 	
 	public function __construct()
 	{
 		parent::__construct();
 		$this->load->model(array(
 			'backend/withdraw/withdraw_model'  
 		));
 		
		if (!$this->session->userdata('isLogin') 
			&& !$this->session->userdata('isAdmin'))
			redirect('admin');
 	}

	public function user_info_load($id)
	{  

		$user_id = $this->input->get('id');
		$data = $this->db->select('*')
		->from('user_registration')
		->where('user_id',$user_id)
		->get()
		->row();
		
		echo json_encode($data);
	
	}

}