<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Profile_model extends CI_Model {
	
	public function my_info()
	{
		$user_id =$this->session->userdata('user_id');
		return $this->db->select('*')->from('user_registration')
		->where('user_id',$user_id)
		->get()
		->row();
	}

}
 