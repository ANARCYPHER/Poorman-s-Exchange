<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Social_link_model extends CI_Model {

	public function read($limit, $offset)
	{
		return $this->db->select("*")
			->from('web_social_link')
			->order_by('id', 'asc')
			->limit($limit, $offset)
			->get()
			->result();
	}

	public function single($id = null)
	{
		return $this->db->select('*')
			->from('web_social_link')
			->where('id', $id)
			->get()
			->row();
	}

	public function all()
	{
		return $this->db->select('*')
			->from('web_social_link')
			->get()
			->result();
	}

	public function update($data = array())
	{
		return $this->db->where('id', $data["id"])
			->update("web_social_link", $data);
	}

}