<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {
 
	public function create($data = array())
	{
		return $this->db->insert('admin', $data);
	}

	public function read()
	{
		return $this->db->select("
				admin.*, 
				CONCAT_WS(' ', firstname, lastname) AS fullname 
			")
			->from('admin')
			->order_by('id', 'desc')
			->get()
			->result();
	}

	public function single($id = null)
	{
		return $this->db->select('*')
			->from('admin')
			->where('id', $id)
			->get()
			->row();
	}

	public function update($data = array())
	{
		return $this->db->where('id', $data["id"])
			->where_not_in('is_admin',1)
			->update("admin", $data);
	}

	public function delete($id = null)
	{
		return $this->db->where('id', $id)
			->where_not_in('is_admin',1)
			->delete("admin");
	}

	public function dropdown()
	{
		$data = $this->db->select("id, CONCAT_WS(' ', firstname, lastname) AS fullname")
			->from("admin")
			->where('status', 1)
			->where_not_in('is_admin', 1)
			->get()
			->result();
		$list[''] = display('select_option');
		if (!empty($data)) {
			foreach($data as $value)
				$list[$value->id] = $value->fullname;
			return $list;
		} else {
			return false; 
		}
	}
 


}
