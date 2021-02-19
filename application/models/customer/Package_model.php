<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Package_model extends CI_Model {


	public function all_package()
	{
		return $this->db->select("*")
			->from('package')
			->get()
			->result();
	}

	public function package_info_by_id($package_id=NULL)
	{
		return $this->db->select("*")
			->from('package')
			->where('package_id',$package_id)
			->get()
			->row();
	}

	public function buy_package($data)
	{
		$this->db->insert('investment',$data);
		return array('investment_id'=>$this->db->insert_id());
	}


}
 