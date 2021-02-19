<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller 
{
    
    public function __construct()
    {
        parent::__construct();
  
        if (!$this->session->userdata('isLogIn')) 
        redirect('login');

        if (!$this->session->userdata('user_id')) 
        redirect('login');  
 
        $this->load->model(array(
            'customer/transfer_model',
        ));

    }




public function language_setting()
{
    $user_id = $this->session->userdata('user_id');
    $data['lang'] =$this->db->select('language')->from('user_registration')->where('user_id',$user_id)->get()->row();
 
    $data['title']   = display('language_setting'); 
    $data['languageList'] = $this->languageList(); 
    
    $data['content'] = $this->load->view('customer/settings/language_setting', $data, true);
    $this->load->view('customer/layout/main_wrapper', $data); 
}

public function update_language()
{
    $language = $this->input->post('language');
    $user_id = $this->session->userdata('user_id');

    $this->db->set('language',$language)->where('user_id',$user_id)->update('user_registration');
    $this->session->set_flashdata('message',display('update_successfully')); 
        
    redirect('customer/settings/language_setting');
}

    /*
    |-----------------------------------
    |   Bitcoin Settings View
    |-----------------------------------
    */
    public function payment_method_setting()
    {   
        $user_id = $this->session->userdata('user_id');
        $data['bitcoin'] = $this->db->select('*')->from('payment_metod_setting')->where('user_id',$user_id)->where('method','bitcoin')->get()->row();
        $data['payeer'] = $this->db->select('*')->from('payment_metod_setting')->where('user_id',$user_id)->where('method','payeer')->get()->row();
        $data['phone'] = $this->db->select('*')->from('payment_metod_setting')->where('user_id',$user_id)->where('method','phone')->get()->row();
        $data['paypal'] = $this->db->select('*')->from('payment_metod_setting')->where('user_id',$user_id)->where('method','paypal')->get()->row();
        $data['stripe'] = $this->db->select('*')->from('payment_metod_setting')->where('user_id',$user_id)->where('method','stripe')->get()->row();
        $data['paystack'] = $this->db->select('*')->from('payment_metod_setting')->where('user_id',$user_id)->where('method','paystack')->get()->row();
        
        $data['title']   = display('payment_method_setting'); 
        $data['content'] = $this->load->view('customer/settings/bitcoin_settings', $data, true);
        $this->load->view('customer/layout/main_wrapper', $data);  
    }


    /*
    |-----------------------------------
    |   Payeer Settings View
    |-----------------------------------
    */
    public function payment_method_update()
    { 

         $bitcoin = $this->input->post('bitcoin');  
         $payeer = $this->input->post('payeer');
         $phone = $this->input->post('phone');
         $paypal = $this->input->post('paypal');
         $stripe = $this->input->post('stripe');
         $paystack = $this->input->post('paystack');
         $user_id = $this->session->userdata('user_id');

        if($bitcoin!=NULL) {

            $data = array('user_id'=>$user_id,'method'=>$bitcoin,'wallet_id'=>$this->input->post('bitcoin_wallet_id'));
            $check = $this->db->select('*')->from('payment_metod_setting')->where('user_id',$user_id)->where('method',$bitcoin)->get()->row();
            if($check!=NULL) {
               $this->db->where('user_id',$user_id)->where('method',$bitcoin)->update('payment_metod_setting',$data); 
            } else {
                $this->db->insert('payment_metod_setting',$data); 
            }
        } 


        if($payeer!=NULL) {

            $data = array('user_id'=>$user_id,'method'=>$payeer,'wallet_id'=>$this->input->post('payeer_wallet_id'));
            $check = $this->db->select('*')->from('payment_metod_setting')->where('user_id',$user_id)->where('method',$payeer)->get()->row();
           
            if($check!=NULL) {
               $this->db->where('user_id',$user_id)->where('method',$payeer)->update('payment_metod_setting',$data); 
            } else {
                $this->db->insert('payment_metod_setting',$data); 
            }
        }


        if($phone!=NULL) {

            $data = array('user_id'=>$user_id,'method'=>$phone,'wallet_id'=>$this->input->post('phone_no'));
            $check = $this->db->select('*')->from('payment_metod_setting')->where('user_id',$user_id)->where('method',$phone)->get()->row();
           
            if($check!=NULL) {
               $this->db->where('user_id',$user_id)->where('method',$phone)->update('payment_metod_setting',$data); 
            } else {
                $this->db->insert('payment_metod_setting',$data); 
            }
        } 


        if($paypal!=NULL) {

            $data = array('user_id'=>$user_id,'method'=>$paypal,'wallet_id'=>$this->input->post('phone_no'));
            $check = $this->db->select('*')->from('payment_metod_setting')->where('user_id',$user_id)->where('method',$paypal)->get()->row();
           
            if($check!=NULL) {
               $this->db->where('user_id',$user_id)->where('method',$paypal)->update('payment_metod_setting',$data); 
            } else {
                $this->db->insert('payment_metod_setting',$data); 
            }
        }


        if($paystack!=NULL) {

            $data = array('user_id'=>$user_id,'method'=>$paystack,'wallet_id'=>$this->input->post('phone_no'));
            $check = $this->db->select('*')->from('payment_metod_setting')->where('user_id',$user_id)->where('method',$paystack)->get()->row();
           
            if($check!=NULL) {
               $this->db->where('user_id',$user_id)->where('method',$paystack)->update('payment_metod_setting',$data); 
            } else {
                $this->db->insert('payment_metod_setting',$data); 
            }
        }


        if($stripe!=NULL) {

            $data = array('user_id'=>$user_id,'method'=>$stripe,'wallet_id'=>$this->input->post('phone_no'));
            $check = $this->db->select('*')->from('payment_metod_setting')->where('user_id',$user_id)->where('method',$stripe)->get()->row();
           
            if($check!=NULL) {
               $this->db->where('user_id',$user_id)->where('method',$stripe)->update('payment_metod_setting',$data); 
            } else {
                $this->db->insert('payment_metod_setting',$data); 
            }
        } 

        $this->session->set_flashdata('message',display('update_successfully')); 
        
        redirect('customer/settings/payment_method_setting');
    }

    /*
    |-----------------------------------
    |   Bank Information View
    |-----------------------------------
    */
    public function bank_info()
    {   
        $user_id = $this->session->userdata('user_id');
        $data['my_bangk_info'] = $this->db->select("*")
            ->from('bank_info')
            ->where('user_id',$user_id)
            ->get()
            ->row();

         $data['title']   = display('bank_details'); 
         $data['content'] = $this->load->view('customer/settings/bank_info', $data, true);
         $this->load->view('customer/layout/main_wrapper', $data);  
    }

    public function bank_info_update(){

        $user_id = $this->session->userdata('user_id');

        $bank_data = array(
            'user_id'           => $this->session->userdata('user_id'),
            'beneficiary_name'    => $this->input->post('beneficiary_name'),
            'bank_name'    => $this->input->post('bank_name'),
            'branch'              => $this->input->post('branch'),
            'account_number' => $this->input->post('account_number'),
            'ifsc_code' => $this->input->post('code'),
        );

        $data = $this->db->select('*')->from('bank_info')->where('user_id',$user_id)->get()->num_rows();
        if($data > 0){
            $this->db->where('user_id',$user_id)->update('bank_info',$bank_data);
        }else{
           $this->db->insert('bank_info',$bank_data); 
        }
        $this->session->set_flashdata('message','Bank Information Update Successfully!');
        redirect("customer/settings/bank_info");
        

    }

    public function languageList()
    { 
        if ($this->db->table_exists("language")) { 

                $fields = $this->db->field_data("language");
                $i = 1;
                foreach ($fields as $field)
                {  
                    if ($i++ > 2)
                    $result[$field->name] = ucfirst($field->name);
                }

                if (!empty($result)) return $result;
 

        } else {
            return false; 
            
        }
    }    


}
