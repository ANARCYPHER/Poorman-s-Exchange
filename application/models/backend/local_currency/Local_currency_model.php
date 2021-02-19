<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Local_currency_model extends CI_Model {
 
	public function create($data = array())
	{
		return $this->db->insert('local_currency', $data);
	}

	public function read($limit, $offset)
	{
		return $this->db->select("*")
			->from('local_currency')
			->order_by('currency_name', 'asc')
			->limit($limit, $offset)
			->get()
			->result();
	}

	public function single($currency_id = null)
	{
		return $this->db->select('*')
			->from('local_currency')
			->where('currency_id', $currency_id)
			->get()
			->row();
	}

	public function all()
	{
		return $this->db->select('*')
			->from('local_currency')
			->get()
			->result();
	}

	public function update($data = array())
	{
		return $this->db->where('currency_id', $data["currency_id"])
			->update("local_currency", $data);
	}

	public function delete($currency_id = null)
	{
		return $this->db->where('currency_id', $currency_id)
			->delete("local_currency");
	}
}
