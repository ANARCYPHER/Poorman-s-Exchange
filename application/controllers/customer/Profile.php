<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {
 	
 	public function __construct()
 	{
 		parent::__construct();
        
        if (!$this->session->userdata('isLogIn')) 
        redirect('login');

        if (!$this->session->userdata('user_id')) 
        redirect('login'); 

 		$this->load->model(array(
            'customer/profile_model',  
            'customer/transfer_model',
 			'common_model',  
 		));

 	}
 

 
/*
|----------------------------------
|   view profile
|----------------------------------
*/ 
	public function index()
	{  
		$data['title']  = display('profile');
        $data['languageList'] = $this->languageList(); 
		$data['profile'] = $this->profile_model->my_info();
		$data['content'] = $this->load->view("customer/pages/profile", $data, true);
		$this->load->view("customer/layout/main_wrapper", $data);
	}

/*
|----------------------------------
|   Update save profile 
|----------------------------------
*/
	public function update()
	{
		$userdata = array(
            
			'language'    => $this->input->post('language'),
			'f_name' 	  => $this->input->post('f_name'),
			'l_name' 	  => $this->input->post('l_name'),
			'email' 	  => $this->input->post('email'),
			'phone' 	  => $this->input->post('mobile'),
		
        );

        $email = $this->db->select('email')->from('user_registration')->where('user_id',$this->session->userdata('user_id'))->get()->row();

        $varify_code = $this->randomID();

        #----------------------------
        #      email verify
        #----------------------------
        $appSetting = $this->common_model->get_setting();

        $post = array(
            'title'             => $appSetting->title,
            'subject'           => 'Profile Change Verification!',
            'to'                => $email->email,
            'message'           => 'The Verification Code is <h1>'.$varify_code.'</h1>'
        );

        $send = $this->common_model->send_email($post);
        
        #-----------------------------
        if(isset($send)){

            $varify_data = array(

                'ip_address'    => $this->input->ip_address(),
                'user_id'       => $this->session->userdata('user_id'),
                'session_id'    => $this->session->userdata('isLogIn'),
                'verify_code'   => $varify_code,
                'data'          => json_encode($userdata)

            );

            $this->db->insert('verify_tbl',$varify_data);
            $id = $this->db->insert_id();

            redirect('customer/profile/profile_verify/'.$id);
                
        } 

	}


    public function profile_verify($id=NULL)
    {
        $data['title']   = display('change_verify'); 
        $data['content'] = $this->load->view('customer/pages/profile_verify', $data, true);
        $this->load->view('customer/layout/main_wrapper', $data);
    }


    public function profile_update()
    {
        $code = $this->input->post('code');
        $id   = $this->input->post('id');

        $data = $this->db->select('*')
        ->from('verify_tbl')
        ->where('verify_code',$code)
        ->where('id',$id)
        ->where('session_id',$this->session->userdata('isLogIn'))
        ->get()
        ->row();

        if($data!=NULL) {
            $p_data = ((array) json_decode($data->data));

            $user_id = $this->session->userdata('user_id');
            $this->db->where('user_id',$user_id)
            ->update('user_registration',$p_data);

            $this->session->set_flashdata('message',display('update_successfully'));
            
            echo 1;

        }else{

            echo 2;
        }
    }

    public function change_password()
    {
        $data['title']   = display('change_password'); 
        $data['content'] = $this->load->view('customer/pages/change_password', $data, true);
        $this->load->view('customer/layout/main_wrapper', $data);
    }


    public function change_save(){

        $this->form_validation->set_rules('old_pass', display('enter_old_password'), 'required');
        $this->form_validation->set_rules('new_pass', display('enter_new_password'), 'required|max_length[32]|matches[confirm_pass]|trim');
        $this->form_validation->set_rules('confirm_pass', display('enter_confirm_password'), 'required|max_length[32]|trim');
        
        if ( $this->form_validation->run())
        {
            $oldpass = MD5($this->input->post('old_pass'));

            $new_pass['password'] = MD5($this->input->post('new_pass'));

            $query = $this->db->select('password')
            ->from('user_registration')
            ->where('user_id',$this->session->userdata('user_id'))
            ->where('password',$oldpass)
            ->get()
            ->num_rows();

            if($query > 0) {

                $this->db->where('user_id',$this->session->userdata('user_id'))
                ->update('user_registration',$new_pass);

                $this->session->set_flashdata('message', display('password_change_successfull'));
                redirect('customer/profile/change_password');

            } else {
                $this->session->set_flashdata('exception',display('old_password_is_wrong'));
                redirect('customer/profile/change_password');
            }

        } else {

            $data['set_old'] = (object)$_POST;
            
            $data['title']   = display('change_password'); 
            
            $data['content'] = $this->load->view('customer/pages/change_password', $data, true);
            
            $this->load->view('customer/layout/main_wrapper', $data);
        
        }

    }



    public function email_check($email, $uid)
    { 
        $emailExists = $this->db->select('email')
            ->where('email',$email) 
            ->where_not_in('uid',$uid) 
            ->get('user_registration')
            ->num_rows();

        if ($emailExists > 0) {
            $this->form_validation->set_message('email_check', 'The {field} is already registered.');
            return false;
        } else {
            return true;
        }
    } 

    public function username_check($username, $uid)
    { 
        $usernameExists = $this->db->select('username')
            ->where('username',$username) 
            ->where_not_in('uid',$uid) 
            ->get('user_registration')
            ->num_rows();

        if ($usernameExists > 0) {
            $this->form_validation->set_message('username_check', 'The {field} is already registered.');
            return false;
        } else {
            return true;
        }
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
