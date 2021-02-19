<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Diposit_model extends CI_Model {


	public function save_deposit($data)
	{
		$this->db->insert('deposit',$data);
		return array('deposit_id'=>$this->db->insert_id());
	}
	public function read($limit, $offset)
	{
		return $this->db->select("*")
			->from('deposit')
			->where('user_id',$this->session->userdata('user_id'))
			->limit($limit, $offset)
			->get()
			->result();
	}	
	public function all_deposit()
	{
		return $this->db->select('*')
		->from('deposit')
		->where('user_id',$this->session->userdata('user_id'))
		->get()
		->result();
	}

	public function save_transections($data)
	{
		$this->db->insert('transections',$data);
	}


}
 