<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Credit extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
        if (!$this->session->userdata('isAdmin')) 
        redirect('logout');
        
        if (!$this->session->userdata('isLogIn')) 
        redirect('admin'); 
    
		$this->load->model(array(
            'backend/dashboard/message_model' 
		));  

	}
 
    public function credit_list()
    {
        $data['title']  =  display('credit_list');

        #
        #pagination starts
        #
        $config["base_url"]       = base_url('backend/dashboard/credit/credit_list/'); 
        $config["total_rows"]     = $this->db->get_where('deposit', array('deposit_method' =>'admin', 'status'=>1))->num_rows(); 
        $config["per_page"]       = 25;
        $config["uri_segment"]    = 5; 
        $config["num_links"]      = 5;  
        /* This Application Must Be Used With BootStrap 3 * */
        $config['full_tag_open']  = "<ul class='pagination col-xs pull-right m-0'>";
        $config['full_tag_close'] = "</ul>";
        $config['num_tag_open']   = '<li>';
        $config['num_tag_close']  = '</li>';
        $config['cur_tag_open']   = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close']  = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open']  = "<li>";
        $config['next_tag_close'] = "</li>";
        $config['prev_tag_open']  = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open']  = "<li>";
        $config['last_tagl_close'] = "</li>"; 
        /* ends of bootstrap */
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;

        $data['credit_info'] = $this->db->select('*')->from('deposit')
        ->where('deposit_method','admin')
        ->where('status',1)
        ->limit($config["per_page"], $page)
        ->get()
        ->result(); 

         $data["links"] = $this->pagination->create_links(); 
        #
        #pagination ends
        #  
        $data["content"] = $this->load->view("backend/credit/credit_list", $data, true);
        $this->load->view("backend/layout/main_wrapper", $data);
    } 


    public function add_credit()
    {  

        $data['title'] = display('add_credit');
        $data['content'] = $this->load->view("backend/credit/add_credit", $data, true);
        $this->load->view("backend/layout/main_wrapper", $data);  
    }

    public function send_credit()
    {
        $data['title'] = display('add_credit');
        /*----------FORM VALIDATION RULES----------*/
        $this->form_validation->set_rules('user_id', display('user_id') ,'required');
        $this->form_validation->set_rules('amount', display('amount'),'required');
        $this->form_validation->set_rules('note', display('note'),'required|trim');
        /*-------------STORE DATA------------*/

        if ($this->form_validation->run()) { 

            $deposit_data = array(
                'user_id'           => $this->input->post('user_id'),
                'deposit_amount'    => $this->input->post('amount'),
                'deposit_method'    => 'admin',
                'fees'              => 0.0,
                'comments'          => $this->input->post('note'),
                'deposit_date'      => date('Y-m-d h:i:s'),
                'deposit_ip'        => $this->input->ip_address(),
                'status'            => 1
            );

            $insert_deposit = $this->db->insert('deposit',$deposit_data);
            $insert_id = $this->db->insert_id();

            if($insert_id){

                $transections_data = array(
                'user_id'                   => $this->input->post('user_id'),
                'transection_category'      => 'deposit',
                'releted_id'                => $insert_id,
                'amount'                    => $this->input->post('amount'),
                'comments'                  => $this->input->post('note'),
                'transection_date_timestamp'=> date('Y-m-d h:i:s')
                );
                $this->db->insert('transections',$transections_data);

            }
            $this->session->set_flashdata('message','Send the amount successfully');
            redirect('backend/dashboard/credit/add_credit');

        } else {

            $data['title'] = display('add_credit');
            $data['content'] = $this->load->view("backend/credit/add_credit", $data, true);
            $this->load->view("backend/layout/main_wrapper", $data);  

        }
    }


    public function credit_details($id=NULL)
    {

        $data['title'] = display('credit_info');

        $data['credit_info'] = $this->db->select('deposit.*,
            user_registration.user_id,
            user_registration.f_name,
            user_registration.l_name,user_registration.phone,user_registration.email')
        ->from('deposit')
        ->join('user_registration','user_registration.user_id=deposit.user_id')
        ->where('deposit.deposit_method','admin')
        ->where('deposit.deposit_id',$id)
        ->where('deposit.status',1)
        ->get()
        ->row(); 

            $data['content'] = $this->load->view("backend/credit/credit_details", $data, true);
            $this->load->view("backend/layout/main_wrapper", $data); 


    }


  
	
}
