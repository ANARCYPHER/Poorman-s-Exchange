<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Local_currency extends CI_Controller {
 	
 	public function __construct()
 	{
 		parent::__construct();
 		if (!$this->session->userdata('isAdmin')) 
        redirect('logout');

		if (!$this->session->userdata('isLogin') 
			&& !$this->session->userdata('isAdmin'))
			redirect('admin');

 		$this->load->model(array(
 			'backend/local_currency/local_currency_model'  
 		));
 		
 	}
 
	public function index()
	{
		$data['title']  = display('local_currency');

		#------------------------#
		$this->form_validation->set_rules('currency_name', display('currency_name'),'required|trim');
		$this->form_validation->set_rules('currency_iso_code', display('currency_iso_code'),'required|trim');
		$this->form_validation->set_rules('usd_exchange_rate', display('usd_exchange_rate'),'required|trim');
		$this->form_validation->set_rules('currency_symbol', display('currency_symbol'),'required|trim');
		$this->form_validation->set_rules('currency_position', display('currency_position'),'required|trim');
		
		/*-----------------------------------*/ 
		$data['local_currency']   = (object)$userdata = array(
			'currency_id'      		=> $this->input->post('currency_id'),
			'currency_name'   		=> $this->input->post('currency_name'),
			'currency_iso_code' 	=> $this->input->post('currency_iso_code'), 
			'usd_exchange_rate'  	=> $this->input->post('usd_exchange_rate'), 
			'currency_symbol' 		=> $this->input->post('currency_symbol'),
			'currency_position' 	=> $this->input->post('currency_position')
		);

		/*-----------------------------------*/
		if ($this->form_validation->run()) 
		{
			if ($this->local_currency_model->update($userdata)) {
				$this->session->set_flashdata('message', display('update_successfully'));

			} else {
				$this->session->set_flashdata('exception', display('please_try_again'));
				
			}
			redirect("backend/local_currency/local_currency");

		} 
		else
		{
			$data['title'] = display('local_currency');
			$data['local_currency']   = $this->local_currency_model->single(1);
			
		}
		$data['content'] = $this->load->view("backend/local_currency/form", $data, true);
		$this->load->view("backend/layout/main_wrapper", $data);

	}

}
