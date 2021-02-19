<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Exchange_wallet extends CI_Controller {
 	
 	public function __construct()
 	{
 		parent::__construct();
 		if (!$this->session->userdata('isAdmin')) 
        redirect('logout');

		if (!$this->session->userdata('isLogin') 
			&& !$this->session->userdata('isAdmin'))
			redirect('admin');

 		$this->load->model(array(
 			'backend/exchange_wallet/exchange_wallet_model'  
 		));
 		
 	}
 
	public function index()
	{
		$data['title']  = display('exchange_wallet_list');
 		
 		/******************************
        * Pagination Start
        ******************************/
        $config["base_url"] = base_url('backend/exchange_wallet/exchange_wallet/index');
        $config["total_rows"] = $this->db->count_all('ext_exchange_wallet');
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
        $data['exchange_wallet'] = $this->exchange_wallet_model->read($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
        #
        #pagination ends
        #    
		$data['content'] = $this->load->view("backend/exchange_wallet/list", $data, true);
		$this->load->view("backend/layout/main_wrapper", $data);
	}
 
	public function form($ext_exchange_wallet_id = null)
	{ 
		$data['title']  = display('add_exchange_wallet');

		$data['currency'] = $this->exchange_wallet_model->activeCurrency();
		$coin = $this->exchange_wallet_model->findCurrency($this->input->post('cid'));
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
		$data['exchange_wallet']   = (object)$userdata = array(
			'ext_exchange_wallet_id'	=> $this->input->post('ext_exchange_wallet_id'),
			'coin_id'   				=> $this->input->post('cid'),
			'coin_name' 				=> $coin_name, 
			'wallet_data'  				=> $this->input->post('wallet_data'), 
			'sell_adjustment' 			=> $this->input->post('sell_adjustment'),
			'buy_adjustment' 			=> $this->input->post('buy_adjustment'),
			'status' 					=> $this->input->post('status')
		);
		
		/*-----------------------------------*/
		if ($this->form_validation->run()) 
		{
			if (empty($ext_exchange_wallet_id)) 
			{
				if ($this->exchange_wallet_model->create($userdata)) {
					$this->session->set_flashdata('message', display('save_successfully'));
				} else {
					$this->session->set_flashdata('exception', display('please_try_again'));
				}
				redirect("backend/exchange_wallet/exchange_wallet/form");
			} 
			else 
			{
				if ($this->exchange_wallet_model->update($userdata)) {
					$this->session->set_flashdata('message', display('update_successfully'));
				} else {
					$this->session->set_flashdata('exception', display('please_try_again'));
				}
				redirect("backend/exchange_wallet/exchange_wallet/form/$ext_exchange_wallet_id");
			}
		} 
		else
		{ 
			if(!empty($ext_exchange_wallet_id)) {
				$data['title'] = display('edit_exchange_wallet');
				$data['exchange_wallet']   = $this->exchange_wallet_model->single($ext_exchange_wallet_id);
			}
		}
		$data['content'] = $this->load->view("backend/exchange_wallet/form", $data, true);
		$this->load->view("backend/layout/main_wrapper", $data);
	}


	public function delete($ext_exchange_wallet_id = null)
	{  
		if ($this->exchange_wallet_model->delete($ext_exchange_wallet_id)) {
			$this->session->set_flashdata('message', display('delete_successfully'));
		} else {
			$this->session->set_flashdata('exception', display('please_try_again'));
		}
		redirect("backend/exchange_wallet/exchange_wallet");
	}


}
