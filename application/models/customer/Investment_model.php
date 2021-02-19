<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Investment_model extends CI_Model {


	public function all_investment()
	{
		return $this->db->select("investment.*,
			package.package_name,
			package.package_id,
			package.package_amount,
			package.weekly_roi,
			package.package_deatils")
			->from('investment')
			->join('package','package.package_id=investment.package_id')
			->where('investment.user_id',$this->session->userdata('user_id'))
			->get()
			->result();
	}

}
 