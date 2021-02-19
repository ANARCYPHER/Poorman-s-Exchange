<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User_Authentication extends CI_Controller
{
    function __construct() {
        parent::__construct();

        // Load facebook && google login library
        $this->load->library('facebook');
        $this->load->library('google');
        
        //load user model
        $this->load->model('user');
    }

    public function fblogin(){
        $userData = array();
        $this->load->helper('string');

        // Check if user is logged in
        if($this->facebook->is_authenticated()){
            // Get user facebook profile details
            $userProfile = $this->facebook->request('get', '/me?fields=id,first_name,last_name,email,gender,locale,picture');
            if (!isset($userProfile['email']) || empty($userProfile['email'])) {
                $this->session->set_flashdata('exception', "Your Facebook account have no Email Address. Plese Register With Email");
                redirect("register");

            }

            if (!empty($userProfile['id'])) {
                                
                // Preparing data for database insertion
                $userData['oauth_provider'] = 'facebook';
                $userData['oauth_uid']      = $userProfile['id'];
                $userData['f_name']         = $userProfile['first_name'];
                $userData['l_name']         = $userProfile['last_name'];
                $userData['email']          = $userProfile['email'];
                $userData['gender']         = $userProfile['gender'];
                $userData['locale']         = $userProfile['locale'];
                $userData['profile_url']    = 'https://www.facebook.com/'.$userProfile['id'];
                $userData['picture_url']    = $userProfile['picture']['data']['url'];

                // Insert or update user data
                $prevQuery = $this->user->checkUser($userData);

                $prevCheck = $prevQuery->num_rows();

                if ($prevCheck > 0){
                    if ($prevQuery->row()->oauth_provider=='facebook' && $prevQuery->row()->status==0) {
                        $this->session->set_flashdata('exception', display('already_clicked'));
                        redirect("register");

                    }
                    else{
                        $prevResult = $prevQuery->row_array();
                        $userID = $this->user->updateUser($userData, $prevResult['uid']);
                        
                        if (!empty($userID)) {
                            $user_id = $this->user->checkUserId($prevResult['uid']);
                            $sData = array(
                                'isLogIn'     => true,
                                'id'          => $userID,
                                'user_id'     => $user_id->row()->user_id,
                                'fullname'    => $userData['f_name'].' '.$userData['l_name'],
                                'email'       => $userData['email'],
                                'sponsor_id'  => $prevResult['sponsor_id'],
                                'phone'       => $prevResult['phone'],
                            );  

                            //store date to session 
                            $this->session->set_userdata($sData);
                            $this->session->set_flashdata('message', display('welcome_back').' '.$userData['f_name'].' '.$userData['l_name']);
                            redirect(base_url());

                        }
                    }

                }else{

                    $duplicatemail=$this->user->checkDuplictemail($userData);  

                    if ($duplicatemail->num_rows() > 0){
                        $this->session->set_flashdata('exception', display('email_used'));
                        redirect("register");
                        return false;

                    }else{
                        if (!$this->input->valid_ip($this->input->ip_address())){
                            return false;

                        }

                        $username            = strtolower($userProfile['first_name'].random_string('alnum', 3));
                        $userid              = strtoupper(random_string('alnum', 6));
                        $userData['username']= $username;
                        $userData['user_id'] = $userid; 
                        $userData['status']  = 0; 
                        $userData['reg_ip']  = $this->input->ip_address(); 
                        $userID              = $this->user->insertUser($userData);
                    }

                    // Check user data insert or update status
                    if(!empty($userID)){
                        $data['userData'] = $userData;
                        $this->session->set_userdata('userData',$userData);

                    }else{
                       $data['userData'] = array();

                    }

                }
                // Get logout URL
                $data['logoutUrl'] = $this->facebook->logout_url();

            }

        }else{
            $fbuser = '';

            // Get login URL
            $data['authUrl'] =  $this->facebook->login_url();

        }

        // Load login & profile view
        redirect('register');

    }

    public function glogin(){
        //redirect to profile page if user already logged in
        if($this->session->userdata('loggedIn') == true){
            redirect(base_url());

        }
        
        if(isset($_GET['code'])){

            $this->load->helper('string');

            //authenticate user
            $this->google->getAuthenticate();
            
            //get user info from google
            $gpInfo = $this->google->getUserInfo();
            
            //preparing data for database insertion
            $userData['oauth_provider'] = 'google';
            $userData['oauth_uid']      = $gpInfo['id'];
            $userData['f_name']         = $gpInfo['given_name'];
            $userData['l_name']         = $gpInfo['family_name'];
            $userData['email']          = $gpInfo['email'];
            $userData['gender']         = !empty($gpInfo['gender'])?$gpInfo['gender']:'';
            $userData['locale']         = !empty($gpInfo['locale'])?$gpInfo['locale']:'';
            $userData['profile_url']    = !empty($gpInfo['link'])?$gpInfo['link']:'';
            $userData['picture_url']    = !empty($gpInfo['picture'])?$gpInfo['picture']:'';

            $prevQuery = $this->user->checkUser($userData);
            $prevCheck = $prevQuery->num_rows();
            if($prevCheck > 0){
                if ($prevQuery->row()->oauth_provider=='google' && $prevQuery->row()->status==0) {
                    $this->session->set_flashdata('exception', display('already_clicked'));
                    redirect("register");

                }
                else{

                    $prevResult = $prevQuery->row_array();
                    $userID = $this->user->updateUser($userData, $prevResult['uid']);

                    if (!empty($userID)) {
                        $user_id = $this->user->checkUserId($prevResult['uid']);
                         
                        $sData = array(
                                'isLogIn'     => true,
                                'id'          => $userID,
                                'user_id'     => $user_id->row()->user_id,
                                'fullname'    => $userData['f_name'].' '.$userData['l_name'],
                                'email'       => $userData['email'],
                                'sponsor_id'  => $prevResult['sponsor_id'],
                                'phone'       => $prevResult['phone'],
                            );  

                        //store date to session 
                        $this->session->set_userdata($sData);
                        $this->session->set_flashdata('message', display('welcome_back').' '.$userData['f_name'].' '.$userData['l_name']);
                        redirect(base_url());

                    }

                }

            }else{
                $duplicatemail=$this->user->checkDuplictemail($userData);          
                if ($duplicatemail->num_rows() > 0){
                    $this->session->set_flashdata('exception', display('email_used'));
                    redirect("register");

                }else{
                    if (!$this->input->valid_ip($this->input->ip_address())){
                        redirect("register");
                        
                    }

                    $username   = strtolower($gpInfo['given_name'].random_string('alnum', 3));
                    $userid     = strtoupper(random_string('alnum', 6));
                    $userData['username']  = $username;
                    $userData['user_id']   = $userid; 
                    $userData['status']    = 0; 
                    $userData['reg_ip']    = $this->input->ip_address(); 
                    $userID     = $this->user->insertUser($userData);
                }

            }
            //store status & user info in session
            $this->session->set_userdata('userData', $userData);

            //redirect to profile page
            redirect('register');
        } 
        
        //google login url
        $data['loginURL'] = $this->google->loginURL();
        
        //load google login view
        redirect('register');
    }

}