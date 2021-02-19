<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category_model extends CI_Model {
 
	public function create($data = array())
	{
		return $this->db->insert('web_category', $data);

	}

	public function read($limit, $offset)
	{
		return $this->db->select("*")
			->from('web_category')
			->order_by('cat_name_en', 'asc')
			->limit($limit, $offset)
			->get()
			->result();
			
	}

	public function single($cat_id = null)
	{
		return $this->db->select('*')
			->from('web_category')
			->where('cat_id', $cat_id)
			->get()
			->row();
	}

	public function all()
	{
		return $this->db->select('*')
			->from('web_category')
			->get()
			->result();
	}

	public function update($data = array())
	{
		return $this->db->where('cat_id', $data["cat_id"])
			->update("web_category", $data);
	}

	public function delete($cat_id = null)
	{
		return $this->db->where('cat_id', $cat_id)
			->delete("web_category");
	}
	
}
