<?php defined('BASEPATH') OR exit('No direct script access allowed');

class common_model extends CI_Model {

//Send email via SMTP server in CodeIgniter
	public function send_email($post=array()){

		//Load email library
		$this->load->library('email');

		$email = $this->db->select('*')->from('email_sms_gateway')->where('es_id', 2)->get()->row();

		//SMTP & mail configuration
		$config = array(
		    'protocol'  => $email->protocol,
		    'smtp_host' => $email->host,
		    'smtp_port' => $email->port,
		    'smtp_user' => $email->user,
		    'smtp_pass' => $email->password,
		    'mailtype'  => $email->mailtype,
		    'starttls'  => true,
		    'charset'   => $email->charset
		);
		$this->email->initialize($config);
		$this->email->set_mailtype("html");
		$this->email->set_newline("\r\n");

		//Email content
		$htmlContent = $post['message'];

		$this->email->to($post['to']);
		$this->email->from($email->user, $post['title']);
		$this->email->subject($post['subject']);
		$this->email->message($htmlContent);
		
		//Send email
		if($this->email->send()){
			return 1;

		} else{
			return 0;

		}
	}


	public function email_sms($method)
	{
        
	   return $this->db->select('*')
       ->from('sms_email_send_setup')
       ->where('method',$method)
       ->get()
       ->row();

	}


	public function get_setting(){
		return $settings = $this->db->select("email,phone,time_zone,title")
    		->get('setting')
    		->row();
	}


	public function get_all_transection_by_user($user_id)
	{

		$data = $this->db->select('*')
		->from('transections')
		->where('user_id',$user_id)
		->where('status',1)
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
				->where('user_id',$user_id)
				->where('earning_type','type2')
				->get()
				->row();
			$individule['my_payout'] = $my_payout->earns2;

			//Package Commission
			$commission = $this->db->select("sum(amount) as earns1")
				->from('earnings')
				->where('user_id',$user_id)
				->where('earning_type','type1')
				->get()
				->row();
			$individule['commission'] = $commission->earns1;

			//team bonus
			$bonus = $this->db->select("sum(bonus) as bonuss")
				->from('user_level')
				->where('user_id',$user_id)
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


	public function payment_gateway()
	{
		return $this->db->select('*')
		->from('payment_gateway')
		->where('status', 1)
		->get()
		->result();
	}


}