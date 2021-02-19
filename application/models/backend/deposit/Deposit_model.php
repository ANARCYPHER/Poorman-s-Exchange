<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Deposit_model extends CI_Model {
 
	public function create($data = array())
	{
		return $this->db->insert('deposit', $data);
	}

	public function read($limit, $offset)
	{
		return $this->db->select("*")
			->from('deposit')
			->order_by('deposit_date', 'asc')
			->limit($limit, $offset)
			->get()
			->result();
	}

	public function single($deposit_id = null)
	{
		return $this->db->select('*')
			->from('deposit')
			->where('deposit_id', $deposit_id)
			->get()
			->row();
	}

	public function all()
	{
		return $this->db->select('*')
			->from('deposit')
			->get()
			->result();
	}

	public function update($data = array())
	{
		return $this->db->where('deposit_id', $data["deposit_id"])
			->update("deposit", $data);
	}

	public function delete($deposit_id = null)
	{
		return $this->db->where('deposit_id', $deposit_id)
			->delete("deposit");
	}
}
