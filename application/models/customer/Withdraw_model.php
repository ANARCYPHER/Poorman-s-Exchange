<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Withdraw_model extends CI_Model {

	public function withdraw($data)
	{
		$this->db->insert('withdraw',$data);
		return array('withdraw_id'=>$this->db->insert_id());
	}


	public function get_verify_data($id)
	{
		$v = $this->db->select('*')
		->from('verify_tbl')
		->where('id',$id)
		->where('session_id', $this->session->userdata('isLogIn'))
		->where('ip_address', $this->input->ip_address())
		->get()
		->row();

		return $v;
	}


	public function get_withdraw_by_user($user_id)
	{
		return $this->db->select('*')
		->from('withdraw')->where('user_id',$user_id)->get()->result();
	}
	public function get_withdraw_by_id($id)
	{
		return $this->db->select('*')
		->from('withdraw')
		->where('withdraw_id',$id)
		->where('user_id',$this->session->userdata('user_id'))
		->get()->row();
	}
}