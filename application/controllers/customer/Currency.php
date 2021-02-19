<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Currency extends CI_Controller {
 	
 	public function __construct()
 	{
        	parent::__construct();

        	if (!$this->session->userdata('isLogIn')) 
                redirect('login');

                if (!$this->session->userdata('user_id')) 
                redirect('login'); 

        	$this->load->model(array(
        		'customer/currency_model'  
        	));
 	}
 
        public function index()
	{
                
                $data['title']  = display('cryptocurrency');
                #-------------------------------#
                #
                #pagination starts
                #
                $config["base_url"] = base_url('customer/currency/index');
                $config["total_rows"] = $this->db->count_all('crypto_currency');
                $config["per_page"] = 25;
                $config["uri_segment"] = 4;
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
                $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
                $data['localcurrency'] = $this->currency_model->findlocalCurrency();
                $data['currency'] = $this->currency_model->read($config["per_page"], $page);
                $data["links"] = $this->pagination->create_links();
                #
                #pagination ends
                #    
                $data['content'] = $this->load->view("customer/currency/list", $data, true);
                $this->load->view("customer/layout/main_wrapper", $data);

	}

}
