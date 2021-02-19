<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Transfer_model extends CI_Model {

	public function transfer($data)
	{
		$this->db->insert('transfer',$data);
		return array('transfer_id'=>$this->db->insert_id());
	}

	public function save_transfer_verify($data)
	{
		$this->db->insert('verify_tbl',$data);
		return array('id'=>$this->db->insert_id());
	}

	public function get_verify_data($id)
	{

		$v = $this->db->select('*')
		->from('verify_tbl')
		->where('id',$id)
		->where('session_id', $this->session->userdata('isLogIn'))
		->where('ip_address', $this->input->ip_address())
		->where('status',1)
		->get()
		->row();

		if($v!=NULL){

		$data = (json_decode($v->data)); 
		$u =$this->db->select('user_id,f_name,l_name,email,phone')
		->from('user_registration')
		->where('user_id',@$data->receiver_user_id)
		->get()
		->row();
		return array('v' =>$v,'u'=>$u);
		} else {

			return 0;

		}
		
	}


	public function get_send($id){
		return $this->db->select('transfer.*,user_registration.*')
		->from('transfer')
		->join('user_registration','user_registration.user_id=transfer.receiver_user_id')
		->where('transfer.sender_user_id',$this->session->userdata('user_id'))
		->where('transfer.transfer_id',$id)
		->get()->row();
	}

	public function get_recieved($id){

		return $this->db->select('transfer.*,user_registration.*')
		->from('transfer')
		->join('user_registration','user_registration.user_id=transfer.sender_user_id')
		->where('transfer.receiver_user_id',$this->session->userdata('user_id'))
		->where('transfer.transfer_id',$id)
		->get()->row();
		
	}


}
 