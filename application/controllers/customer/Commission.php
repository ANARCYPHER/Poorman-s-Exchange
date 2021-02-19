<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Commission extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
  
        if (!$this->session->userdata('isLogIn')) 
        redirect('login');

        if (!$this->session->userdata('user_id')) 
        redirect('login');  
 
		$this->load->model(array(
            'customer/Profile_model', 
            'customer/package_model', 
            'customer/transections_model', 
            'customer/investment_model', 
        ));

	}

    public function my_payout()
    {   


        $user_id = $this->session->userdata('user_id');
        $data['title']   = display('my_payout'); 
        #-------------------------------#
        #
        #pagination starts
        #
        $config["base_url"] = base_url('customer/commission/my_payout');
        $config["total_rows"] = $this->db->get_where('earnings', array('user_id'=>$user_id, 'earning_type'=>'type2'))->num_rows();
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
        $data['my_payout'] = $this->db->select("*")
                        ->from('earnings')
                        ->where('user_id',$user_id)
                        ->where('earning_type','type2')
                        ->limit($config["per_page"], $page)
                        ->get()
                        ->result();
        $data["links"] = $this->pagination->create_links();
        #
        #pagination ends
        #
        $data['content'] = $this->load->view('customer/pages/my_payout', $data, true);
        $this->load->view('customer/layout/main_wrapper', $data);  
    }

    public function payout_receipt($id=NULL)
    {
        $user_id = $this->session->userdata('user_id');
        $data['title']   = display('receipt'); 
        $data['my_payout'] = $this->db->select("earnings.*,package.*")
                        ->from('earnings')
                        ->join('package','package.package_id=earnings.package_id')
                        ->where('earnings.user_id',$user_id)
                        ->where('earnings.earning_type','type2')
                        ->where('earnings.earning_id',$id)
                        ->get()
                        ->row();

        $data['my_info'] = $this->Profile_model->my_info();
        $data['content'] = $this->load->view('customer/pages/payout_receipt', $data, true);
        $this->load->view('customer/layout/main_wrapper', $data);  
    }



    public function my_commission()
    {   
        $user_id = $this->session->userdata('user_id');
        $data['title'] = display('my_commission');
        #-------------------------------#
        #
        #pagination starts
        #
        $config["base_url"] = base_url('customer/commission/my_commission');
        $config["total_rows"] = $this->db->select("earnings.*,user_registration.*,package.*")
                        ->from('earnings')
                        ->join('user_registration','user_registration.user_id=earnings.Purchaser_id')
                        ->join('package','package.package_id=earnings.package_id')
                        ->where('earnings.user_id',$user_id)
                        ->where('earnings.earning_type','type1')
                        ->get()->num_rows();
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
        $data['my_commission'] = $this->db->select("earnings.*,user_registration.*,package.*")
                        ->from('earnings')
                        ->join('user_registration','user_registration.user_id=earnings.Purchaser_id')
                        ->join('package','package.package_id=earnings.package_id')
                        ->where('earnings.user_id',$user_id)
                        ->where('earnings.earning_type','type1')
                        ->limit($config["per_page"], $page)
                        ->get()
                        ->result();
        $data["links"] = $this->pagination->create_links();
        #
        #pagination ends
        #

        $data['content'] = $this->load->view('customer/pages/my_commission', $data, true);
        $this->load->view('customer/layout/main_wrapper', $data);  
    }


    public function commission_receipt($id=NULL)
    {
        $user_id = $this->session->userdata('user_id');
        $data['title'] = display('my_commission'); 
        $data['my_commission'] = $this->db->select("earnings.*,user_registration.*,package.*")
                        ->from('earnings')
                        ->join('user_registration','user_registration.user_id=earnings.Purchaser_id')
                        ->join('package','package.package_id=earnings.package_id')
                        ->where('earnings.user_id',$user_id)
                        ->where('earnings.earning_type','type1')
                        ->where('earnings.earning_id',$id)
                        ->get()
                        ->row();

        $data['my_info'] = $this->Profile_model->my_info();
        $data['content'] = $this->load->view('customer/pages/commission_receipt', $data, true);
        $this->load->view('customer/layout/main_wrapper', $data);  
    }


    public function team_bonus()
    {

        $user_id = $this->session->userdata('user_id');        
        $data['title'] = display('team_bonus');
        #-------------------------------#
        #
        #pagination starts
        #
        $config["base_url"] = base_url('customer/commission/team_bonus');
        $config["total_rows"] = $this->db->select('user_level.*,setup_commission.*')
                            ->from('user_level')
                            ->join('setup_commission','setup_commission.level_name=user_level.level_id','left')
                            ->where('user_level.user_id',$user_id)
                            ->get()->num_rows();
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
        $data['team_bonus'] =$this->db->select('user_level.*,setup_commission.*')
                            ->from('user_level')
                            ->join('setup_commission','setup_commission.level_name=user_level.level_id','left')
                            ->where('user_level.user_id',$user_id)
                            ->limit($config["per_page"], $page)
                            ->get()
                            ->result();
        $data["links"] = $this->pagination->create_links();
        #
        #pagination ends
        #
        $data['my_info'] = $this->Profile_model->my_info();

        $data['content'] = $this->load->view('customer/pages/team_bonus', $data, true);
        $this->load->view('customer/layout/main_wrapper', $data);
    }


    public function my_level_info()
    {
        $user_id = $this->session->userdata('user_id');
        $data['title'] = display('my_level_info'); 
        #-------------------------------#
        #
        #pagination starts
        #
        $config["base_url"]         = base_url('customer/commission/my_level_info');
        $config["total_rows"]       = $this->db->select("*")
                                      ->from('user_level')
                                      ->where('user_id',$user_id)->get()->num_rows();
        $config["per_page"]         = 25;
        $config["uri_segment"]      = 4;
        $config["last_link"]        = "Last"; 
        $config["first_link"]       = "First"; 
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';  
        $config['full_tag_open']    = "<ul class='pagination col-xs pull-right'>";
        $config['full_tag_close']   = "</ul>";
        $config['num_tag_open']     = '<li>';
        $config['num_tag_close']    = '</li>';
        $config['cur_tag_open']     = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close']    = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open']    = "<li>";
        $config['next_tag_close']   = "</li>";
        $config['prev_tag_open']    = "<li>";
        $config['prev_tagl_close']  = "</li>";
        $config['first_tag_open']   = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open']    = "<li>";
        $config['last_tagl_close']  = "</li>";
        /* ends of bootstrap */
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $data['level_info'] =$this->db->select("*")
                            ->from('user_level')
                            ->where('user_id',$user_id)
                            ->limit($config["per_page"], $page)
                            ->get()
                            ->result();
        $data["links"]  = $this->pagination->create_links();
        #
        #pagination ends
        #
        $data['content'] = $this->load->view('customer/pages/my_level_info', $data, true);
        $this->load->view('customer/layout/main_wrapper', $data);

    }

}