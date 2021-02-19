<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {


	public function checkUser($data = array())
	{
		return $this->db->select("
				admin.id, 
				CONCAT_WS(' ', admin.firstname, admin.lastname) AS fullname,
				admin.email, 
				admin.image, 
				admin.last_login,
				admin.last_logout, 
				admin.ip_address, 
				admin.status, 
				admin.is_admin, 
				IF (admin.is_admin=1, 'Admin', 'User') as user_level
			")
			->from('admin')
			->where('email', $data['email'])
			->where('password', md5($data['password']))
			->get();
	}
 

	public function last_login($id = null)
	{
		return $this->db->set('last_login', date('Y-m-d H:i:s'))
			->set('ip_address', $this->input->ip_address())
			->where('id',$this->session->userdata('id'))
			->update('admin');
	}

	public function last_logout($id = null)
	{
		return $this->db->set('last_logout', date('Y-m-d H:i:s'))
			->where('id', $this->session->userdata('id'))
			->update('admin');
	}

}
 