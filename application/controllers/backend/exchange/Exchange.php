<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Exchange extends CI_Controller {
 	
 	public function __construct()
 	{
 		parent::__construct();
 		if (!$this->session->userdata('isAdmin')) 
        redirect('logout');

		if (!$this->session->userdata('isLogin') 
			&& !$this->session->userdata('isAdmin'))
			redirect('admin');

 		$this->load->model(array(
 			'backend/exchange/exchange_model'

 		));
 	}
 
	public function index()
	{
		$data['title']  = display('exchange_list');
 		#-------------------------------#
        #
        #pagination starts
        #
        $config["base_url"] = base_url('backend/exchange/exchange/index');
        $config["total_rows"] = $this->db->count_all('ext_exchange');
        $config["per_page"] = 25;
        $config["uri_segment"] = 5;
        $config["last_link"] = "Last"; 
        $config["first_link"] = "First"; 
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Prev';  
        $config['full_tag_open'] = "<ul class='pagination col-xs pull-right'>";
        $config['full_tag_close'] = "</ul>";
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open'] = "<li>";
        $config['next_tag_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tagl_close'] = "</li>";
        /* ends of bootstrap */
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
        $data['exchange'] = $this->exchange_model->read($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
        $data['currency'] = $this->exchange_model->activeCurrency();
		$data['userinfo'] = $this->exchange_model->findAllExcUser();
        #
        #pagination ends
        #    
		$data['content'] = $this->load->view("backend/exchange/list", $data, true);
		$this->load->view("backend/layout/main_wrapper", $data);
	}
 
	public function form($ext_exchange_id = null)
	{ 
		$data['title']  = display('add_exchange');

		$data['currency'] = $this->exchange_model->activeCurrency();

		$coin = $this->exchange_model->findCurrency($this->input->post('cid'));
		if (!empty($coin)) {
			$coin_name = $coin->name;
		}
		else{
			$coin_name='';
		}

		#------------------------#
		$this->form_validation->set_rules('cid', display('coin_name'),'required');
		$this->form_validation->set_rules('wallet_data', display('wallet_data'),'required');
		$this->form_validation->set_rules('sell_adjustment', display('sell_adjustment'),'required');
		$this->form_validation->set_rules('buy_adjustment', display('buy_adjustment'),'required');
		$this->form_validation->set_rules('status', display('status'),'required');
		
		/*-----------------------------------*/ 
		$data['exchange']   = (object)$userdata = array(
			'ext_exchange_id'			=> $this->input->post('ext_exchange_id'),
			'coin_id'   				=> $this->input->post('cid'),
			'coin_name' 				=> $coin_name, 
			'wallet_data'  				=> $this->input->post('wallet_data'), 
			'sell_adjustment' 			=> $this->input->post('sell_adjustment'),
			'buy_adjustment' 			=> $this->input->post('buy_adjustment'),
			'status' 					=> $this->input->post('status')
		);

		/*-----------------------------------*/
		
		if(!empty($ext_exchange_id)) {
			$data['title'] = display('exchange');
			$data['exchange']   = $this->exchange_model->single($ext_exchange_id);
			$data['userinfo'] = $this->exchange_model->findExcUser($data['exchange']->user_id);
		}
		$data['content'] = $this->load->view("backend/exchange/form", $data, true);
		$this->load->view("backend/layout/main_wrapper", $data);
		
	}


	public function receiveConfirm()
	{  
		$status = $this->input->post('status');
		$receving_status = $this->input->post('receving_status');
		$receving_status_confirm = $this->input->post('receving_status_confirm');
		$payment_status = $this->input->post('payment_status');
		$payment_status_confirm = $this->input->post('payment_status_confirm');

		if ($status) {
			$data['exchange']   = (object)$userdata = array(
				'ext_exchange_id'			=> $this->input->post('ext_exchange_id'),
				'status'   					=> 0,
				'receive_status'   			=> 0,
				'payment_status'   			=> 0,
				'receive_by'   				=> $this->session->userdata('email')
			);
			$this->exchange_model->update($userdata);
		}

		if ($receving_status) {
			if ($receving_status_confirm) {
				$data['exchange']   = (object)$userdata = array(
					'ext_exchange_id'			=> $this->input->post('ext_exchange_id'),
					'receive_status'   			=> 1,
					'payment_status'   			=> 0,
					'receive_by'   				=> $this->session->userdata('email')
				);
				$this->exchange_model->update($userdata);
			}
		}
		
		if ($payment_status_confirm) {			
			$data['exchange']   = (object)$userdata = array(
				'ext_exchange_id'			=> $this->input->post('ext_exchange_id'),
				'status'   					=> 2,
				'payment_status'   			=> 1,
				'payment_by'   				=> $this->session->userdata('email')
			);
			$this->exchange_model->update($userdata);
		}
	}


}
