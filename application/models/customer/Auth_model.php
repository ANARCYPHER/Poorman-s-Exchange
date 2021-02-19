<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {


	public function checkUser($data = array())
	{
	   $where = "(email ='".$data['email']."' OR username = '".$data['email']."')";

		return $this->db->select("*")
			->from('user_registration')
			->where('password', md5($data['password']))
			->where('status', 1)
			->where($where)
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
 