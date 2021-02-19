<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajaxload extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
  
        if (!$this->session->userdata('isLogIn')) 
        redirect('login');

        if (!$this->session->userdata('user_id')) 
        redirect('login'); 
 
		$this->load->model(array(
            'customer/diposit_model' 
        ));

	}

/*
|---------------------------------
|   Fees Load and deposit amount 
|---------------------------------
*/
    public function fees_load()
    {   
        $amount = $this->input->post('amount'); 
        $level = $this->input->post('level'); 

        $result = $this->db->select('fees')
        ->from('fees_tbl')
        ->where('level',$level)
        ->get()
        ->row();

        $fees = ($amount/100)*$result->fees;
        $new_amount = $amount-$fees;
        echo json_encode(array('fees'=>$fees,'amount'=>$new_amount));    
    }

/*
|---------------------------------
|   check reciver user Id
|---------------------------------
*/
    public function checke_reciver_id()
    {   
        $receiver_id = $this->input->post('receiver_id'); 
        
        $result = $this->db->select('*')
        ->from('user_registration')
        ->where('user_id',$receiver_id)
        ->get()
        ->num_rows();

       echo $result;
    }

/*
|---------------------------------
|   check reciver user Id
|---------------------------------
*/
    public function walletid()
    {   
        $method = $this->input->post('method'); 
        $user_id = $this->session->userdata('user_id'); 
       
        $result = $this->db->select('*')
        ->from('payment_metod_setting')
        ->where('method',$method)
        ->where('user_id',$user_id)
        ->get()
        ->row();
        echo json_encode($result);

    }

}
