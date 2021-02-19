<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model {


	

	public function withdraw_all_request()
	{
		return $this->db->select("*")
			->from('withdraw')
			->where('status',1)
			->limit(10)
			->order_by('request_date', 'DESC')
			->get()
			->result();
	}
	public function exchange_all_request()
	{
		return $this->db->select("*")
			->from('ext_exchange')
			->where('status',1)
			->limit(10)
			->order_by('date_time', 'DESC')
			->get()
			->result();
	}
	public function crypto_all_request()
	{
		return $this->db->select("cid, name, symbol")
			->from('crypto_currency')
			->where('status',1)
			->get()
			->result();
	}

	public function get_cata_wais_transections()
	{

		//all users
		$users = $this->db->select('user_id')
				->from('user_registration')
				->get()
				->num_rows();

		//all investment
		$invest = $this->db->select("sum(amount) as invest")
				->from('investment')
				->get()
				->row();		
		// My Payout
		$earn = $this->db->select("sum(amount) as earns")
			->from('earnings')
			->where('earning_type','type2')
			->get()
			->row();
		$pay = $earn->earns;

		//Package Commission
		$commission = $this->db->select("sum(amount) as earns")
			->from('earnings')
			->where('earning_type','type1')
			->get()
			->row();
		$pack_commission = $commission->earns;



		$data = array();
		$data['total_user'] = @$users;
		$data['total_investment'] = @$invest->invest;
		$data['total_roi'] = @$pay;
		$data['commission'] = @$pack_commission;


		return $data;
		
	}

		

}
 