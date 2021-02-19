<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Transections_model extends CI_Model {


	public function save_transections($data)
	{
		$this->db->insert('transections',$data);
	}

	
	public function all_transection()
	{
		return $this->db->select('*')
		->from('transections')
		->where('user_id',$this->session->userdata('user_id'))
		->get()
		->result();
	}

	public function get_cata_wais_transections($user_id="")
	{
		if ($user_id!="") {
			$user_id = $user_id;
		}
		else{
			$user_id = $this->session->userdata('user_id');
		}

		$data = $this->db->select('*')
		->from('transections')
		->where('user_id', $user_id)
		->get()
		->result();
		
		$dep = 0;
		$dep_f = 0;
		$w_f = 0;
		$t_f = 0;
		$we = 0;
		$invest = 0;
		$tras = 0;
		$reciver = 0;
		$individule = array();

		foreach ($data as $value) {

			if(@$value->transection_category=='deposit'){

				$deposit = $this->getFees('deposit',$value->releted_id);
				$dep_f = $dep_f + $deposit->fees;
				$individule['d_fees'] = $dep_f;

				$dep = $dep + $value->amount;
				$individule['deposit'] = $dep;
			}

			if(@$value->transection_category=='withdraw'){

				$withdraw = $this->getFees('withdraw',$value->releted_id);
				$w_f = $w_f + $withdraw->fees;
				$individule['w_fees'] = $w_f;

				$we = $we+$value->amount;
				$individule['withdraw'] = $we;

			}

			if(@$value->transection_category=='transfer'){

				$transfer = $this->getFees('transfer',$value->releted_id);
				$t_f = $t_f + $transfer->fees;
				$individule['t_fees'] = $t_f;

				$tras = $tras+$value->amount;
				$individule['transfar'] = $tras;
			}

			if(@$value->transection_category=='investment'){
				$invest = $invest+$value->amount;
				$individule['investment'] = $invest;
			}

			if(@$value->transection_category=='reciver'){
				$reciver = $reciver+$value->amount;
				$individule['reciver'] = $reciver;
			}
		}

			// My Payout
			$my_payout = $this->db->select("sum(amount) as earns2")
				->from('earnings')
				->where('user_id',$this->session->userdata('user_id'))
				->where('earning_type','type2')
				->get()
				->row();
			$individule['my_payout'] = $my_payout->earns2;

			//Package Commission
			$commission = $this->db->select("sum(amount) as earns1")
				->from('earnings')
				->where('user_id',$this->session->userdata('user_id'))
				->where('earning_type','type1')
				->get()
				->row();
			$individule['commission'] = $commission->earns1;

			//team bonus
			$bonus = $this->db->select("sum(bonus) as bonuss")
				->from('user_level')
				->where('user_id',$this->session->userdata('user_id'))
				->get()
				->row();

			$individule['bonuss'] = $bonus->bonuss;


			// total earning
			$total_earn =  $individule['my_payout']+$individule['commission']+$individule['bonuss'];
			$individule['earn'] = $total_earn;
			#-----------------------
			//TOTAL FEES
			$total_fees = (@$individule['d_fees']+@$individule['w_fees']+@$individule['t_fees']);
			#-----------------------

			#---------------------------
			# TOTAL GRAND BALENCE
			$individule['balance'] = (@$individule['deposit']+@$individule['reciver']+@$total_earn)-(@$individule['withdraw']+@$individule['investment']+@$individule['transfar']+@$total_fees);
			#----------------------------
			return $individule;

	}





	public function getFees($table,$id)
	{
		return $this->db->select('*')
		->from($table)
		->where($table.'_id',$id)
		->get()
		->row();
	}


}
 