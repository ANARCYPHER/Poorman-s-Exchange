<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Package extends CI_Controller {
 	
 	public function __construct()
 	{
 		parent::__construct();
 		$this->load->model(array(
 			'backend/package/package_model'  
 		));
 		
 		if (!$this->session->userdata('isAdmin')) 
        redirect('logout');
 		
		if (!$this->session->userdata('isLogin') 
			&& !$this->session->userdata('isAdmin'))
			redirect('admin');
 	}
 
	public function index()
	{  
		$data['title']  = display('package_list');
 		#-------------------------------#
        #
        #pagination starts
        #
        $config["base_url"] = base_url('backend/package/package/index');
        $config["total_rows"] = $this->db->count_all('package');
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
        $data['package'] = $this->package_model->read($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
        #
        #pagination ends
        #    
		$data['content'] = $this->load->view("backend/package/list", $data, true);
		$this->load->view("backend/layout/main_wrapper", $data);
	}
 

    public function package_check($package_name, $package_id)
    { 
        $packageExists = $this->db->select('*')
            ->where('package_name',$package_name) 
            ->where_not_in('package_id',$package_id) 
            ->get('package')
            ->num_rows();

        if ($packageExists > 0) {
            $this->form_validation->set_message('package_check', 'The {field} is already registered.');
            return false;
        } else {
            return true;
        }
    } 

 
	public function form($package_id = null)
	{ 
		$data['title']  = display('add_package');
		/*-----------------------------------*/
		if (!empty($package_id)) {   
       		$this->form_validation->set_rules('package_name', display("package_name"), "required|max_length[250]|callback_package_check[$package_id]"); 
		} else {
			$this->form_validation->set_rules('package_name', display('package_name'),'required|is_unique[package.package_name]|max_length[250]');
		}  
		#------------------------#
		$this->form_validation->set_rules('package_details', display('package_details'),'max_length[1000]');
		$this->form_validation->set_rules('package_amount', display('package_amount'),'required|max_length[11]');
		$this->form_validation->set_rules('daily_roi', display('daily_roi'),'required|max_length[11]');
		$this->form_validation->set_rules('weekly_roi', display('weekly_roi'),'required|max_length[11]');
		$this->form_validation->set_rules('monthly_roi', display('monthly_roi'),'required|max_length[11]');
		$this->form_validation->set_rules('yearly_roi', display('yearly_roi'),'required|max_length[11]');
		$this->form_validation->set_rules('total_percent', display('total_percent'),'required|max_length[11]');
		$this->form_validation->set_rules('status', display('status'),'required|max_length[1]');
		$this->form_validation->set_rules('period', display('period'),'required');

		/*-----------------------------------*/ 
		$data['package'] = (object)$userdata = array(
			'package_id'      => $this->input->post('package_id'),
			'package_name'    => $this->input->post('package_name'),
			'period'    		=> $this->input->post('period'),
			'package_deatils' => $this->input->post('package_deatils'), 
			'package_amount'  => $this->input->post('package_amount'), 
			'daily_roi' 	  => $this->input->post('daily_roi'),
			'weekly_roi' 	  => $this->input->post('weekly_roi'),
			'monthly_roi' 	  => $this->input->post('monthly_roi'), 
			'yearly_roi' 	  => $this->input->post('yearly_roi'), 
			'total_percent'   => $this->input->post('total_percent'), 
			'status'          => $this->input->post('status'),
		);
 
		/*-----------------------------------*/
		if ($this->form_validation->run()) 
		{

			if (empty($package_id)) 
			{
				if ($this->package_model->create($userdata)) {
					$this->session->set_flashdata('message', display('save_successfully'));
				} else {
					$this->session->set_flashdata('exception', display('please_try_again'));
				}
				redirect("backend/package/package/form/");

			} 
			else 
			{
				if ($this->package_model->update($userdata)) {
					$this->session->set_flashdata('message', display('update_successfully'));
				} else {
					$this->session->set_flashdata('exception', display('please_try_again'));
				}
				redirect("backend/package/package/form/$package_id");
			}
		} 
		else 
		{ 
			if(!empty($package_id)) {
				$data['title'] = display('edit_package');
				$data['package']   = $this->package_model->single($package_id);
			}
			$data['content'] = $this->load->view("backend/package/form", $data, true);
			$this->load->view("backend/layout/main_wrapper", $data);
		}
	}


	public function delete($user_id = null)
	{  
		if ($this->package_model->delete($user_id)) {
			$this->session->set_flashdata('message', display('delete_successfully'));
		} else {
			$this->session->set_flashdata('exception', display('please_try_again'));
		}
		redirect("backend/package/package/");
	}

    /*
    |----------------------------------------------
    |        id genaretor
    |----------------------------------------------     
    */
    public function randomID($mode = 2, $len = 6)
    {
        $result = "";
        if($mode == 1):
            $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
        elseif($mode == 2):
            $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        elseif($mode == 3):
            $chars = "abcdefghijklmnopqrstuvwxyz0123456789";
        elseif($mode == 4):
            $chars = "0123456789";
        endif;

        $charArray = str_split($chars);
        for($i = 0; $i < $len; $i++) {
                $randItem = array_rand($charArray);
                $result .="".$charArray[$randItem];
        }
        return $result;
    }
    /*
    |----------------------------------------------
    |         Ends of id genaretor
    |----------------------------------------------
    */


}
