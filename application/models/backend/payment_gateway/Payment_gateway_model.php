<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment_gateway_model extends CI_Model {
 
	public function create($data = array())
	{
		return $this->db->insert('payment_gateway', $data);
	}

	public function read($limit, $offset)
	{
		return $this->db->select("*")
			->from('payment_gateway')
			->order_by('id', 'asc')
			->limit($limit, $offset)
			->get()
			->result();
	}

	public function single($id = null)
	{
		return $this->db->select('*')
			->from('payment_gateway')
			->where('id', $id)
			->get()
			->row();
	}

	public function all()
	{
		return $this->db->select('*')
			->from('payment_gateway')
			->get()
			->result();
	}

	public function update($data = array())
	{
		return $this->db->where('id', $data["id"])
			->update("payment_gateway", $data);
	}

	public function delete($slider_id = null)
	{
		return $this->db->where('id', $slider_id)
			->delete("payment_gateway");
	}
}
