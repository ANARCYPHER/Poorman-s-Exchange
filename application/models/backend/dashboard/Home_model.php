<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home_model extends CI_Model {

	private $table = "admin"; 

	public function profile($id = null)
	{
		return $this->db->select("
				admin.*, 
				CONCAT_WS(' ', firstname, lastname) AS fullname, 
				IF (admin.is_admin=1, 'Admin', 'User') as user_level")
			->from("admin") 
			->where('id', $id)
			->get()
			->row();
	} 

	public function update_profile($data = array())
	{
		return $this->db->where('id', $data['id'])
			->update('admin', $data);
	}

  
}
