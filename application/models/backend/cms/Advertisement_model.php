<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Advertisement_model extends CI_Model {
 
	public function create($data = array())
	{
		return $this->db->insert('advertisement', $data);
	}

	public function read($limit, $offset)
	{
		return $this->db->select("*")
			->from('advertisement')
			->order_by('page', 'asc')
			->limit($limit, $offset)
			->get()
			->result();
	}

	public function single($id = null)
	{
		return $this->db->select('*')
			->from('advertisement')
			->where('id', $id)
			->get()
			->row();
	}

	public function all()
	{
		return $this->db->select('*')
			->from('advertisement')
			->get()
			->result();
	}

	public function update($data = array())
	{
		return $this->db->where('id', $data["id"])
			->update("advertisement", $data);
	}

	public function delete($id = null)
	{
		return $this->db->where('id', $id)
			->delete("advertisement");
	}
	
}
