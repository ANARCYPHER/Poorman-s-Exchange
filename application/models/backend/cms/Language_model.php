<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Language_model extends CI_Model {
 
	public function single($id = null)
	{
		return $this->db->select('*')
			->from('web_language')
			->where('id', $id)
			->get()
			->row();
	}

	public function update($data = array())
	{
		return $this->db->where('id', $data["id"])
			->update("web_language", $data);
	}

	
}
