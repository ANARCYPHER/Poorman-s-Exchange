<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Package_model extends CI_Model {
 
	public function create($data = array())
	{
		return $this->db->insert('package', $data);
	}

	public function read($limit, $offset)
	{
		return $this->db->select("*")
			->from('package')
			->order_by('package_name', 'asc')
			->limit($limit, $offset)
			->get()
			->result();
	}

	public function single($package_id = null)
	{
		return $this->db->select('*')
			->from('package')
			->where('package_id', $package_id)
			->get()
			->row();
	}

	public function update($data = array())
	{
		return $this->db->where('package_id', $data["package_id"])
			->update("package", $data);
	}

	public function delete($package_id = null)
	{
		return $this->db->where('package_id', $package_id)
			->delete("package");
	}

	// public function dropdown()
	// {
	// 	$data = $this->db->select("user_id, CONCAT_WS(' ', f_name, l_name) AS fullname")
	// 		->from("package")
	// 		->where('status', 1)
	// 		->get()
	// 		->result();
	// 	$list[''] = display('select_option');
	// 	if (!empty($data)) {
	// 		foreach($data as $value)
	// 			$list[$value->id] = $value->fullname;
	// 		return $list;
	// 	} else {
	// 		return false; 
	// 	}
	// }
 


}
