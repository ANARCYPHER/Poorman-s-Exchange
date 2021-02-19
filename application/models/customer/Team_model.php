<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Team_model extends CI_Model {


	public function my_team($user_id)
	{
		$result1 = $this->db->select("*")
		->from('user_registration')
		->where('sponsor_id',$user_id)
		->get()
		->result();

		$level_one 	= array();
		$level_two 	= array();
		$level_three= array();
		$level_four = array();
		$level_five = array();


		$l  = 1;
		$l2 = 1;
		$l3 = 1;
		$l4 = 1;
		$l5 = 1;
		foreach ($result1 as $lv1) {
			$amount1 = $this->db->select("*")->from('investment')->where('user_id',$lv1->user_id)->get()->result();
			$level_one['user_id_'.$l] 	= $lv1->user_id;
			$level_one['username_'.$l] 	= $lv1->username;
			$level_one['name_'.$l] 		= $lv1->f_name.' '.$lv1->l_name;
			$level_one['sponser_id_'.$l]= $lv1->sponsor_id;
			$level_one['amount_'.$l] 	= $amount1;
			
			#------------------------------
			# Laver Two Start             #
			#------------------------------
			$result2 = $this->db->select("*")
			->from('user_registration')
			->where('sponsor_id',$lv1->user_id)
			->get()
			->result();

			
			$l2 = $l2;
			foreach ($result2 as $lv2) {
				$amount2 = $this->db->select("*")->from('investment')->where('user_id',$lv2->user_id)->get()->result();

				$level_two['user_id_'.$l2] 		= $lv2->user_id;
				$level_two['username_'.$l2] 	= $lv2->username;
				$level_two['name_'.$l2] 		= $lv2->f_name.' '.$lv2->l_name;
				$level_two['sponser_id_'.$l2]	= $lv2->sponsor_id;
				$level_two['amount_'.$l2] 		= $amount2;
				
				#------------------------------
				# Lever Three Start           #
				#------------------------------

				$result3 = $this->db->select("*")
				->from('user_registration')
				->where('sponsor_id',$lv2->user_id)
				->get()
				->result();

				$l3 = $l3;
				foreach ($result3 as $lv3) {
					$amount3 = $this->db->select("*")->from('investment')->where('user_id',$lv3->user_id)->get()->result();

					$level_three['user_id_'.$l3] 	= $lv3->user_id;
					$level_three['username_'.$l3] 	= $lv3->username;
					$level_three['name_'.$l3] 		= $lv3->f_name.' '.$lv3->l_name;
					$level_three['sponser_id_'.$l3]	= $lv3->sponsor_id;
					$level_three['amount_'.$l3] 	= $amount3;
					
					#------------------------------
					# Lever Four Start           #
					#------------------------------
					$result4 = $this->db->select("*")
					->from('user_registration')
					->where('sponsor_id',$lv3->user_id)
					->get()
					->result();


					$l4 = $l4;
					foreach ($result4 as $lv4) {
						$amount4 = $this->db->select("*")->from('investment')->where('user_id',$lv4->user_id)->get()->result();

						$level_four['user_id_'.$l4] 	= $lv4->user_id;
						$level_four['username_'.$l4] 	= $lv4->username;
						$level_four['name_'.$l4] 		= $lv4->f_name.' '.$lv4->l_name;
						$level_four['sponser_id_'.$l4]	= $lv4->sponsor_id;
						$level_four['amount_'.$l4] 		= $amount4;
						
						#------------------------------
						# Lever Five Start           #
						#------------------------------
						$result5 = $this->db->select("*")
						->from('user_registration')
						->where('sponsor_id',$lv4->user_id)
						->get()
						->result();

						$l5 = $l5;
						foreach ($result5 as $lv5) {
							$amount5 = $this->db->select("*")->from('investment')->where('user_id',$lv5->user_id)->get()->result();

							$level_five['user_id_'.$l5] 	= $lv5->user_id;
							$level_five['username_'.$l5] 	= $lv5->username;
							$level_five['name_'.$l5] 		= $lv5->f_name.' '.$lv5->l_name;
							$level_five['sponser_id_'.$l5]	= $lv5->sponsor_id;
							$level_five['amount_'.$l5] 		= $amount5;

							$level_five['num'] = $l5;
							$l5++;

						}
						#--------End Level Five--------------------#
						$level_four['num'] = $l4;
						$l4++;

					}					
					#--------End Level Four--------------------#
					$level_three['num'] = $l3;
					$l3++;

				}				
				#--------End Level Three--------------------#
				$level_two['num'] = $l2;
				$l2++;

			}			
			#--------------End Level Two----------------#
			$level_one['num'] = $l;
			$l++;

		}		
		#--------------End Level one----------------#

		$data = array(
			'level_one'=>@$level_one,
			'level_two'=>@$level_two,
			'level_three'=>@$level_three,
			'level_four'=>@$level_four,
			'level_five'=>@$level_five,
		);

		return $data;

	}

}
// class Team_model extends CI_Model {


// 	public function my_team($user_id)
// 	{
// 		$result1 = $this->db->select("t1.user_id as userid,t1.username,t1.f_name,t1.l_name,t1.sponsor_id as sid,
// 			investment.*")
// 			->from('user_registration t1')
// 			->join('investment','investment.user_id=t1.user_id','left')
// 			->where('t1.sponsor_id',$user_id)
// 			->get()
// 			->result();


// 		$level_one = array();
// 		$level_two = array();
// 		$level_three = array();
// 		$level_four = array();
// 		$level_five = array();
		
// 		$l  = 1;
// 		$l2 = 1;
// 		$l3 = 1;
// 		$l4 = 1;
// 		$l5 = 1;
// 		foreach ($result1 as $lv1) {

// 			$level_one['user_id_'.$l] 	= $lv1->userid;
// 			$level_one['username_'.$l] 	= $lv1->username;
// 			$level_one['name_'.$l] 		= $lv1->f_name.' '.$lv1->l_name;
// 			$level_one['sponser_id_'.$l]= $lv1->sid;
// 			$level_one['order_id_'.$l] 	= $lv1->order_id;
// 			$level_one['amount_'.$l] 	= $lv1->amount;
// 			// $level_one['num'] = +$l;
// 			#------------------------------
// 			# Laver Two Start             #
// 			#------------------------------
// 			$result2 = $this->db->select("t1.user_id as userid,t1.username,t1.f_name,t1.l_name,t1.sponsor_id as sid,
// 			investment.*")
// 			->from('user_registration t1')
// 			->join('investment','investment.user_id=t1.user_id','left')
// 			->where('t1.sponsor_id',$lv1->userid)
// 			->get()
// 			->result();

// 			$l2 = $l2;
// 			foreach ($result2 as $lv2) {

// 				$level_two['user_id_'.$l2] 	= $lv2->userid;
// 				$level_two['username_'.$l2] 	= $lv2->username;
// 				$level_two['name_'.$l2] 		= $lv2->f_name.' '.$lv2->l_name;
// 				$level_two['sponser_id_'.$l2]= $lv2->sid;
// 				$level_two['order_id_'.$l2] 	= $lv2->order_id;
// 				$level_two['amount_'.$l2] 	= $lv2->amount;
// 				// $level_two['num'] = +$l2;
// 				#------------------------------
// 				# Lever Three Start           #
// 				#------------------------------

// 				$result3 = $this->db->select("t1.user_id as userid,t1.username,t1.f_name,t1.l_name,t1.sponsor_id as sid,
// 				investment.*")
// 				->from('user_registration t1')
// 				->join('investment','investment.user_id=t1.user_id','left')
// 				->where('t1.sponsor_id',$lv2->userid)
// 				->get()
// 				->result();

// 				$l3 = $l3;
// 				foreach ($result3 as $lv3) {

// 					$level_three['user_id_'.$l3] 	= $lv3->userid;
// 					$level_three['username_'.$l3] 	= $lv3->username;
// 					$level_three['name_'.$l3] 		= $lv3->f_name.' '.$lv3->l_name;
// 					$level_three['sponser_id_'.$l3]= $lv3->sid;
// 					$level_three['order_id_'.$l3] 	= $lv3->order_id;
// 					$level_three['amount_'.$l3] 	= $lv3->amount;
// 					// $level_three['num'] = +$l3;
// 					#------------------------------
// 					# Lever Four Start           #
// 					#------------------------------
// 					$result4 = $this->db->select("t1.user_id as userid,t1.username,t1.f_name,t1.l_name,t1.sponsor_id as sid,
// 					investment.*")
// 					->from('user_registration t1')
// 					->join('investment','investment.user_id=t1.user_id','left')
// 					->where('t1.sponsor_id',$lv3->userid)
// 					->get()
// 					->result();

// 					$l4 = $l4;
// 					foreach ($result4 as $lv4) {

// 						$level_four['user_id_'.$l4] 	= $lv4->userid;
// 						$level_four['username_'.$l4] 	= $lv4->username;
// 						$level_four['name_'.$l4] 		= $lv4->f_name.' '.$lv4->l_name;
// 						$level_four['sponser_id_'.$l4]= $lv4->sid;
// 						$level_four['order_id_'.$l4] 	= $lv4->order_id;
// 						$level_four['amount_'.$l4] 	= $lv4->amount;
// 						// $level_four['num'] = +$l4;
// 						#------------------------------
// 						# Lever Five Start           #
// 						#------------------------------
// 						$result5 = $this->db->select("t1.user_id as userid,t1.username,t1.f_name,t1.l_name,t1.sponsor_id as sid,
// 						investment.*")
// 						->from('user_registration t1')
// 						->join('investment','investment.user_id=t1.user_id','left')
// 						->where('t1.sponsor_id',$lv4->userid)
// 						->get()
// 						->result();
						
// 						$l5 = $l5;
// 						foreach ($result5 as $lv5) {
// 							$level_five['user_id_'.$l5] 	= $lv5->userid;
// 							$level_five['username_'.$l5] 	= $lv5->username;
// 							$level_five['name_'.$l5] 		= $lv5->f_name.' '.$lv5->l_name;
// 							$level_five['sponser_id_'.$l5]= $lv5->sid;
// 							$level_five['order_id_'.$l5] 	= $lv5->order_id;
// 							$level_five['amount_'.$l5] 	= $lv5->amount;
// 							// $level_five['num'] = +$l5;

// 							$level_five['num'] = $l5;
// 							$l5++;

// 						}#--------End Level Five--------------------#
// 						$level_four['num'] = $l4;
// 						$l4++;

// 					}#--------End Level Four--------------------#
// 					$level_three['num'] = $l3;
// 					$l3++;

// 				}#--------End Level Three--------------------#
// 				$level_two['num'] = $l2;
// 				$l2++;

// 			}#--------------End Level Two----------------#
// 			$level_one['num'] = $l;
// 			$l++;

// 		}#--------------End Level one----------------#

// 		$data = array(
// 			'level_one'=>@$level_one,
// 			'level_two'=>@$level_two,
// 			'level_three'=>@$level_three,
// 			'level_four'=>@$level_four,
// 			'level_five'=>@$level_five,
// 		);

// 		return $data;

// 	}

// }





// class Team_model extends CI_Model {


// 	public function my_team($user_id)
// 	{
// 		$result1 = $this->db->select("*")
// 			->from('user_registration')
// 			//->join('investment','investment.user_id=t1.user_id','left')
// 			->where('sponsor_id',$user_id)
// 			->get()
// 			->result();
// //echo $this->db->last_query();


// 		$level_one 	= array();
// 		$level_two 	= array();
// 		$level_three= array();
// 		$level_four = array();
// 		$level_five = array();


// 		$l  = 1;
// 		$l2 = 1;
// 		$l3 = 1;
// 		$l4 = 1;
// 		$l5 = 1;
// 		foreach ($result1 as $lv1) {

// 			$level_one['user_id_'.$l] 	= $lv1->user_id;
// 			$level_one['username_'.$l] 	= $lv1->username;
// 			$level_one['name_'.$l] 		= $lv1->f_name.' '.$lv1->l_name;
// 			$level_one['sponser_id_'.$l]= $lv1->sponsor_id;
// 			//$level_one['order_id_'.$l] 	= $lv1->order_id;
// 			//$level_one['amount_'.$l] 	= $lv1->amount;
			
// 			#------------------------------
// 			# Laver Two Start             #
// 			#------------------------------
// 			$result2 = $this->db->select("*")
// 			->from('user_registration')
// 			//->join('investment','investment.user_id=t1.user_id','left')
// 			->where('sponsor_id',$lv1->user_id)
// 			->get()
// 			->result();

			
// 			$l2 = $l2;
// 			foreach ($result2 as $lv2) {

// 				$level_two['user_id_'.$l2] 	= $lv2->user_id;
// 				$level_two['username_'.$l2] 	= $lv2->username;
// 				$level_two['name_'.$l2] 		= $lv2->f_name.' '.$lv2->l_name;
// 				$level_two['sponser_id_'.$l2]= $lv2->sponsor_id;
// 				//$level_two['order_id_'.$l2] 	= $lv2->order_id;
// 				//$level_two['amount_'.$l2] 	= $lv2->amount;
				
// 				#------------------------------
// 				# Lever Three Start           #
// 				#------------------------------

// 				$result3 = $this->db->select("*")
// 				->from('user_registration')
// 				//->join('investment','investment.user_id=t1.user_id','left')
// 				->where('sponsor_id',$lv2->user_id)
// 				->get()
// 				->result();

// 				$l3 = $l3;
// 				foreach ($result3 as $lv3) {

// 					$level_three['user_id_'.$l3] 	= $lv3->user_id;
// 					$level_three['username_'.$l3] 	= $lv3->username;
// 					$level_three['name_'.$l3] 		= $lv3->f_name.' '.$lv3->l_name;
// 					$level_three['sponser_id_'.$l3]= $lv3->sponsor_id;
// 					//$level_three['order_id_'.$l3] 	= $lv3->order_id;
// 					//$level_three['amount_'.$l3] 	= $lv3->amount;
					
// 					#------------------------------
// 					# Lever Four Start           #
// 					#------------------------------
// 					$result4 = $this->db->select("*")
// 					->from('user_registration')
// 					//->join('investment','investment.user_id=t1.user_id','left')
// 					->where('sponsor_id',$lv3->user_id)
// 					->get()
// 					->result();


// 					$l4 = $l4;
// 					foreach ($result4 as $lv4) {

// 						$level_four['user_id_'.$l4] 	= $lv4->user_id;
// 						$level_four['username_'.$l4] 	= $lv4->username;
// 						$level_four['name_'.$l4] 		= $lv4->f_name.' '.$lv4->l_name;
// 						$level_four['sponser_id_'.$l4]= $lv4->sponsor_id;
// 						//$level_four['order_id_'.$l4] 	= $lv4->order_id;
// 						//$level_four['amount_'.$l4] 	= $lv4->amount;
						
// 						#------------------------------
// 						# Lever Five Start           #
// 						#------------------------------
// 						$result5 = $this->db->select("*")
// 						->from('user_registration')
// 						//->join('investment','investment.user_id=t1.user_id','left')
// 						->where('sponsor_id',$lv4->user_id)
// 						->get()
// 						->result();

// 						$l5 = $l5;
// 						foreach ($result5 as $lv5) {
// 							$level_five['user_id_'.$l5] 	= $lv5->user_id;
// 							$level_five['username_'.$l5] 	= $lv5->username;
// 							$level_five['name_'.$l5] 		= $lv5->f_name.' '.$lv5->l_name;
// 							$level_five['sponser_id_'.$l5]= $lv5->sponsor_id;
// 							//$level_five['order_id_'.$l5] 	= $lv5->order_id;
// 							//$level_five['amount_'.$l5] 	= $lv5->amount;

// 							$level_five['num'] = $l5;
// 							$l5++;

// 						}
// 						#--------End Level Five--------------------#
// 						$level_four['num'] = $l4;
// 						$l4++;

// 					}					
// 					#--------End Level Four--------------------#
// 					$level_three['num'] = $l3;
// 					$l3++;

// 				}				
// 				#--------End Level Three--------------------#
// 				$level_two['num'] = $l2;
// 				$l2++;

// 			}			
// 			#--------------End Level Two----------------#
// 			$level_one['num'] = $l;
// 			$l++;

// 		}		
// 		#--------------End Level one----------------#

// 		$data = array(
// 			'level_one'=>@$level_one,
// 			'level_two'=>@$level_two,
// 			'level_three'=>@$level_three,
// 			'level_four'=>@$level_four,
// 			'level_five'=>@$level_five,
// 		);

// 		return $data;

// 	}

// }