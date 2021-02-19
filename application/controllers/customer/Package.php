<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Package extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
  
        if (!$this->session->userdata('isLogIn')) 
        redirect('login');

        if (!$this->session->userdata('user_id')) 
        redirect('login');  
 
        $this->load->model(array(
            'customer/auth_model', 
            'customer/package_model', 
            'customer/transections_model', 
            'customer/transfer_model', 
            'customer/Profile_model', 
            'common_model', 
        ));
    }


    public function index()
    {   
        $data['title']   = display('package'); 
        $data['package'] = $this->package_model->all_package();
        $data['content'] = $this->load->view('customer/pages/package', $data, true);
        $this->load->view('customer/layout/main_wrapper', $data);  
    }

    public function confirm_package($package_id=NULL)
    {   
        $data['title']   = display('package'); 
        $data['my_info'] = $this->Profile_model->my_info();
        $data['package'] = $this->package_model->package_info_by_id($package_id);
        $data['content'] = $this->load->view('customer/pages/package_confirmation', $data, true);
        $this->load->view('customer/layout/main_wrapper', $data);  
    }



/*
|--------------------------------------------------------------
|   BUY PACKAGE 
|--------------------------------------------------------------
*/
    public function buy($package_id=NULL)
    { 

        // balance chcck
        $blance = $this->check_balance($package_id);

        if($blance!=NULL){

            $user_id = $this->session->userdata('user_id');
            if($this->check_investment($user_id)==''){
                $saveLevel = array(
                    'user_id'           => $this->session->userdata('user_id'),
                    'sponser_commission'=> 0.0,
                    'team_commission'   => 0.0,
                    'level'             => 1,
                    'last_update'       => date('Y-m-d h:i:s')
                );

                /*********************************
                *   Data Store Details Table
                **********************************/
                $this->db->insert('team_bonus_details',$saveLevel);
                $this->db->insert('team_bonus',$saveLevel);

            }

            $buy_data = array(
                'user_id'       => $this->session->userdata('user_id'),
                'sponsor_id'    => $this->session->userdata('sponsor_id'),
                'package_id'    => $package_id,
                'amount'        => $blance->package_amount,
                'invest_date'   => date('Y-m-d'),
                'day'           => date('N'),
            );
            
            $result = $this->package_model->buy_package($buy_data);
            // check investment by customent
            $customent_investment = $this->db->select('*')->from('investment')->where('user_id',$this->session->userdata('user_id'))->get()->num_rows();


            $sponsor_id = $this->session->userdata('sponsor_id');
            // get sponsert information by id
            $sponsers_info = $this->db->select('*')->from('user_registration')->where('user_id',$sponsor_id)->get()->row();
            // check invesment by sponser
            $investment = $this->db->select('*')->from('investment')->where('user_id',$sponsor_id)->get()->num_rows();


            if($this->session->userdata('sponsor_id')!=NULL){

                if($investment > 0 ){
                    // get package informaion by package id
                    $pack_info = $this->package_model->package_info_by_id($package_id);
                    #--------------------------------
                    #    commission data save
                    $commission_amount = ($blance->package_amount/100)*6;
                    $commission = array(

                        'user_id'       => $this->session->userdata('sponsor_id'),
                        'Purchaser_id'  => $this->session->userdata('user_id'),
                        'earning_type'  => 'type1',
                        'package_id'    => $pack_info->package_id,
                        'amount'        => $commission_amount,
                        'date'          => date('Y-m-d'),
                        
                    );

                    $this->db->insert('earnings',$commission);
                    #   end commission
                    #---------------------------------

                    //get total balance
                    $balance = $this->common_model->get_all_transection_by_user($sponsers_info->user_id);   
                    $new_balance = ($balance['balance']+$commission_amount);
                    #----------------------------
                    # sms send to commission received
                    #----------------------------
                        
                    $this->load->library('sms_lib');
                    $template = array( 
                        'name'      => $sponsers_info->f_name.' '.$sponsers_info->l_name,
                        'amount'    => $commission_amount,
                        'new_balance'=> $new_balance,
                        'date'      => date('d F Y')
                    );

                    $send_sms = $this->sms_lib->send(array(

                        'to'              => $sponsers_info->phone, 
                        'template'        => 'You received a referral commission of $%amount% . Your new balance is $%new_balance%', 
                        'template_config' => $template,
                        
                    ));

                    #----------------------------------
                    #   sms insert to received commission
                    #---------------------------------
                    if($send_sms){
                        $message_data = array(
                            'sender_id' =>1,
                            'receiver_id' => $sponsers_info->user_id,
                            'subject' => 'Commission',
                            'message' => 'You received a referral commission of $'.$commission_amount.'. Your new balance is $'.$new_balance,
                            'datetime' => date('Y-m-d h:i:s'),
                        );

                        $this->db->insert('message',$message_data);
                    }
                    #-------------------------------------     


                    #---------------------------------
                    #   Won Sponser set personal and team commission set heare

                    $sponsers = $this->db->select('*')
                    ->from('team_bonus')
                    ->where('user_id',$sponsor_id)
                    ->get()
                    ->row();

                    if($sponsers!=NULL){

                        $scom = @$sponsers->sponser_commission + $blance->package_amount;
                        $tcom = @$sponsers->team_commission + $blance->package_amount;
                        $sdata = array(
                            'sponser_commission'=>$scom,
                            'team_commission'=>$tcom,
                            'last_update'=>date('Y-m-d h:i:s')
                        );
                        $detailsdata = array(
                            'user_id'=>$sponsor_id,
                            'sponser_commission'=>$scom,
                            'team_commission'=>$tcom,
                            'last_update'=>date('Y-m-d h:i:s')
                        );

                        /******************************
                        *   Data Store Details Table
                        ******************************/
                        $this->db->insert('team_bonus_details',$detailsdata);


                        $this->db->where('user_id',$sponsor_id)->update('team_bonus',$sdata);

                    } else {

                        $scom = @$sponsers->sponser_commission + @$blance->package_amount;
                        $tcom = @$sponsers->team_commission + @$blance->package_amount;
                        
                        $sdata = array(
                            'user_id'=>$sponsor_id,
                            'sponser_commission'=>$scom,
                            'team_commission'=>$tcom,
                            'last_update'=>date('Y-m-d h:i:s')
                        );

                        /******************************
                        *   Data Store Details Table
                        ******************************/
                        $this->db->insert('team_bonus_details',$sdata);
                        $this->db->insert('team_bonus',$sdata);

                    }

                    # END 
                    #---------------------------------
                
                    #-----------------------------
                    # Level bonus heare with level
                    $getBool = $this->setlevel_withbonus($sponsor_id);
                    #-----------------------------

                    #-----------------------------------
                    # Leveling heare without level bonus
                    // if($getBool!=TRUE){
                    //     $this->setUserLevel($sponsor_id);
                    // }
                    #
                    #-----------------------------------

                    #---------------------------------
                   #    sponser leveling check and set commission
                    $lc = $this->db->select('user_id,level')
                    ->from('team_bonus')
                    ->where('user_id',$sponsor_id)
                    ->where('level >=',2)
                    ->get()
                    ->row();
                   
                    if(@$lc!=NULL){

                        $referral_bonous = $this->db->select('*')
                        ->from('setup_commission')
                        ->where('level_name',1)
                        ->get()
                        ->row();

                        $commission_amount = ($pack_info->package_amount/100)*$referral_bonous->referral_bonous;
                        
                        $commission = array(
                            'user_id'       => $sponsor_id,
                            'Purchaser_id'  => $this->session->userdata('user_id'),
                            'earning_type'  => 'type1',
                            'package_id'    => $package_id,
                            'amount'        => $commission_amount,
                            'date'          => date('Y-m-d'),
                        );
                        
                        $this->db->insert('earnings',$commission);
                    }

                }
                #
                #-----------------------------------
                
                #--------------------------------
                #
                $tuSdata = array(

                    'genaretion'    =>2,
                    'package_id'    =>$package_id,
                    'amount'        =>$blance->package_amount,
                    'sponsor_id'    =>$sponsor_id
                );

                $this->recursive_data($tuSdata);
                #
                #--------------------------------

            }

            if($result!=NULL){
                $transections_data = array(
                    'user_id'                   => $this->session->userdata('user_id'),
                    'transection_category'      => 'investment',
                    'releted_id'                => $result['investment_id'],
                    'amount'                    => $blance->package_amount,
                    'transection_date_timestamp'=> date('Y-m-d h:i:s')
                    );

                $this->transections_model->save_transections($transections_data);

                #----------------------------
                # sms send to commission received
                #----------------------------
                    
                $this->load->library('sms_lib');

                $template = array( 
                    'name'      => $this->session->userdata('fullname'),
                    'amount'    =>$blance->package_amount,
                    'date'      => date('d F Y')
                );

                $send_sms = $this->sms_lib->send(array(
                    'to'              => $this->session->userdata('phone'), 
                    'template'        => 'You bought a $%amount% package successfully', 
                    'template_config' => $template, 
                ));

                #----------------------------------
                #   sms insert to received commission
                #---------------------------------
                if($send_sms){

                    $message_data = array(
                        'sender_id' =>1,
                        'receiver_id' => $this->session->userdata('user_id'),
                        'subject' => 'Package Buy',
                        'message' => 'You bought a '.$blance->package_amount.' package successfully',
                        'datetime' => date('Y-m-d h:i:s'),
                    );

                    $this->db->insert('message',$message_data);
                }
                #------------------------------------- 

                $set = $this->common_model->email_sms('email');
                $appSetting = $this->common_model->get_setting();
                    #----------------------------
                    #      email verify smtp
                    #----------------------------
                     $post = array(
                        'title'           => $appSetting->title,
                        'subject'           => 'Package Buy',
                        'to'                => $this->session->userdata('email'),
                        'message'           => 'You bought a '.$blance->package_amount.' package successfully',
                    );
                    $send_email = $this->common_model->send_email($post);

                    if($send_email){
                            $n = array(
                            'user_id'                => $this->session->userdata('user_id'),
                            'subject'                => 'Package Buy',
                            'notification_type'      => 'package_by',
                            'details'                => 'You bought a '.$blance->package_amount.' package successfully',
                            'date'                   => date('Y-m-d h:i:s'),
                            'status'                 => '0'
                        );
                        $this->db->insert('notifications',$n);    
                    }


            }

            $this->session->set_flashdata('message', display('package_buy_successfully'));
            redirect('customer/package/buy_success/'.$package_id.'/'.$result['investment_id']);

        } else{

                $this->session->set_flashdata('exception', display('balance_is_unavailable'));
                redirect('customer/package/confirm_package/'.$package_id);

        }// END FCHECK BALANCE
       
    } // END FUNCTION




    /**
    * recursive function
    *
    * @param   array  $sp
    * @return   1 and finish recursive function
    */

    public function recursive_data($sp=NULL){

        $data = $this->db->select('user_id,sponsor_id')
        ->from('user_registration')
        ->where('user_id', @$sp['sponsor_id'])
        ->get()->row();


        if(@$data->sponsor_id!=NULL && @$sp['genaretion']<=5 ){

            $investment = $this->db->select('*')->from('investment')->where('user_id',$data->sponsor_id)->get()->num_rows();
    
    
            if($investment !=NUll){

                $sponsers = $this->db->select('*')
                ->from('team_bonus')
                ->where('user_id',$data->sponsor_id)
                ->get()
                ->row();

                if($sponsers!=NULL){
                    $scom = @$sponsers->sponser_commission + @$sp['amount'];
                    $tcom = @$sponsers->team_commission + @$sp['amount'];


                    $detailsdata = array('user_id'=>@$data->sponsor_id,'team_commission'=>$tcom,'sponser_commission'=>$scom,'last_update'=>date('Y-m-d h:i:s'));
                    /*
                    |
                    |   Data Store Details Table
                    |
                    */
                    $this->db->insert('team_bonus_details',$detailsdata);
                    
                    $sdata = array('team_commission'=>$tcom,'last_update'=>date('Y-m-d h:i:s'));
                    $this->db->where('user_id',@$data->sponsor_id)->update('team_bonus',$sdata);
                } else {

                    //$scom = @$sponsers->sponser_commission + $sp['amount'];
                    $tcom = @$sponsers->team_commission + @$sp['amount'];
                    $sdata = array('user_id'=>@$data->sponsor_id,'team_commission'=>$tcom,'last_update'=>date('Y-m-d h:i:s'));

                    /*
                    |
                    |   Data Store Details Table
                    |
                    */
                    $this->db->insert('team_bonus_details',$team_bonus_details);


                    $this->db->insert('team_bonus',$sdata);
                
                }

                //$this->level_complit($data->sponsor_id);

                #-----------------------------
                # Level bonus heare with level
                $getBool = $this->setlevel_withbonus($data->sponsor_id);
                #-----------------------------

                #-----------------------------------
                # Leveling heare without level bonus
                // if($getBool!=TRUE){
                //     $this->setUserLevel($data->sponsor_id);
                // }
                #
                #-----------------------------------

                #---------------------------------
                #    sponser leveling check and set commission
                $lc = $this->db->select('user_id,level')
                ->from('team_bonus')
                ->where('user_id',$data->sponsor_id)
                ->where('level >=',2)
                ->get()
                ->row();
               
                if(@$lc!=NULL){

                    $referral_bonous = $this->db->select('*')
                    ->from('setup_commission')
                    ->where('level_name',$lc->level)
                    ->get()
                    ->row();

                    $pack_info = $this->package_model->package_info_by_id(@$sp['package_id']);

                    $commission_amount = ($pack_info->package_amount/100)*$referral_bonous->referral_bonous;
                    
                    $commission = array(
                        'user_id'       => $data->sponsor_id,
                        'Purchaser_id'  => $this->session->userdata('user_id'),
                        'earning_type'  => 'type1',
                        'package_id'    => @$sp['package_id'],
                        'amount'        => $commission_amount,
                        'date'          => date('Y-m-d'),
                    );
                    
                    $this->db->insert('earnings',$commission);
                }

            }

            $tuSdata = array(
                'genaretion' => @$sp['genaretion']+1,
                'amount' => @$sp['amount'],
                'package_id' => @$sp['package_id'],
                'sponsor_id' => @$data->sponsor_id,
            );  

            $this->recursive_data($tuSdata);  

        } else {

            return 1;

        }

    } 

    /**
    * level_complit function
    *
    * @param   sponser id  $user_id
    * @return   1 and finish level_complit function
    */

    public function level_complit($user_id=NULL){

        $investment = $this->db->select('*')->from('investment')->where('user_id',$user_id)->get()->num_rows();
            
        if($investment !=NUll){

            $sponsers = $this->db->select('*')
                        ->from('team_bonus')
                        ->where('user_id',$user_id)
                        ->get()
                        ->row();

            $sponsers_info = $this->db->select('*')->from('user_registration')->where('user_id',$user_id)->get()->row();
            $balance = $this->common_model->get_all_transection_by_user($sponsers_info->user_id);

            if($sponsers->sponser_commission!=0 && $sponsers->team_commission!=0){

                $level = @$sponsers->level;

                $set_com = $this->db->select('*')
                            ->from('setup_commission')
                            ->where('personal_invest<=',@$sponsers->sponser_commission)
                            ->where('total_invest<=',@$sponsers->team_commission)
                            ->where('level_name',$level)
                            ->get()
                            ->row();
           
                if($set_com){

                    $data = $this->db->set('level',$level)->where('user_id',$user_id)->update('team_bonus'); 

                    $level_data = array(
                        'user_id'=>@$user_id,
                        'level_id'=>$level,
                        'achive_date'=>date('Y-m-d h:i:s'),
                        'bonus'=>@$set_com->team_bonous,
                        'status'=>1);
   
                    $this->db->insert('user_level',$level_data); 

                    #----------------------------
                    # sms send for  team bonus
                    #----------------------------
                    $new_balance = ($balance['balance']+$set_com->team_bonous);    

                    $this->load->library('sms_lib');

                    $template = array( 
                        'name'      => $sponsers_info->f_name.' '.$sponsers_info->l_name,
                        'amount'    => $set_com->team_bonous,
                        'new_balance'=> $new_balance,
                        'stage'     => $level,
                        'date'      => date('d F Y')
                    );

                     $send_sms = $this->sms_lib->send(array(
                        'to'              => $sponsers_info->phone, 
                        'template'        => 'Congrats! You received the amount $%amount% for team bonus. Your new balance is $%new_balance% . You are now in Stage %stage%', 
                        'template_config' => $template, 
                    ));

                    #----------------------------------
                    #   sms insert for team bonus
                    #---------------------------------
                    if($send_sms){

                        $message_data = array(
                            'sender_id' =>1,
                            'receiver_id' => $sponsers_info->user_id,
                            'subject' => 'Team Bonus',
                            'message' => 'Congrats! You received the amount $'.$set_com->team_bonous.' for team bonus. Your new balance is $'.$new_balance.'. You are now in Stage '.$level,
                            'datetime' => date('Y-m-d h:i:s'),
                        );

                        $this->db->insert('message',$message_data);

                    }


                    $set = $this->common_model->email_sms('email');
                    $appSetting = $this->common_model->get_setting();

                    #----------------------------
                    #      email verify smtp
                    #----------------------------
                     $post = array(
                        'title'           => $appSetting->title,
                        'subject'           => 'Team Bonus',
                        'to'                => $sponsers_info->email,
                        'message'           => 'Congrats! You received the amount '.$set_com->team_bonous.'.for team bonus. Your new balance is $'.$new_balance.'. You are now in Stage '.$level,
                    );
                    $send_email = $this->common_model->send_email($post);

                    if($send_email){
                            $n = array(
                            'user_id'                => $sponsers_info->user_id,
                            'subject'                => 'Team Bonus',
                            'notification_type'      => 'Team_Bonus',
                            'details'                => 'Congrats! You received the amount '.$set_com->team_bonous.'.for team bonus. Your new balance is $'.$new_balance.'. You are now in Stage '.$level,
                            'date'                   => date('Y-m-d h:i:s'),
                            'status'                 => '0'
                        );
                        $this->db->insert('notifications',$n);    
                    }
                }
            }

        }

        return 1;

    }


    /***************************
    * buy_success function
    *
    * @param $package_id  $investment_id
    ***************************/

    public function buy_success($package_id,$investment_id)
    {
        $data['title']   = display('package'); 
        $data['my_info'] = $this->Profile_model->my_info();
        $data['package'] = $this->package_model->package_info_by_id($package_id);
        $data['content'] = $this->load->view('customer/pages/package_buy_recite', $data, true);
        $this->load->view('customer/layout/main_wrapper', $data);

    }

    /***************************
    *   check customer balance 
    *   @param pacakate id
    *   return array()
    ***************************/
    public function check_balance($package_id=NULL)
    {

        $pak_info = $this->package_model->package_info_by_id($package_id); 
        $data = $this->transections_model->get_cata_wais_transections();
       
        if($pak_info->package_amount <=$data['balance']){
            return $pak_info;

        }else {

            return $pak_info = array();

        }
        
    }

    /***************************
    *   check investment  
    *   @param user Id
    *   return number of rows
    ***************************/
    public function check_investment($user_id=NULL)
    {

        return $this->db->select('*')
         ->from('investment')
         ->where('user_id',$user_id)
         ->get()
         ->num_rows();
        
    }

    /***************************
    *   SET LEVEL BY SPONSER  
    *   @param sponser id
    *   return ture or false
    ***************************/
    public function setUserLevel($sponsor_id)
    {

        $investment = $this->db->select('*')->from('investment')->where('user_id',$sponsor_id)->get()->num_rows();
            
        if($investment !=NUll){

        $sponsers_info = $this->db->select('*')->from('user_registration')->where('user_id',$sponsor_id)->get()->row();  
        $sponsers = $this->db->select('*')
                    ->from('team_bonus')
                    ->where('user_id',$sponsor_id)
                    ->get()
                    ->row();

            if(@$sponsers->sponser_commission!=0 && @$sponsers->team_commission!=0){
                            
                $level = @$sponsers->level;
                $setLevel = $this->db->select('*')
                            ->from('setup_commission')
                            ->where('total_invest<=',@$sponsers->team_commission)
                            ->where('level_name',$level)
                            ->get()
                            ->row();

                if($setLevel!=NULL){

                    $new_level = $level+1;
                    $data = $this->db->set('level',$new_level)
                    ->where('user_id',$sponsor_id)
                    ->update('team_bonus');
                     
                    $levelChack = $this->db->select('*')->from('user_level')->where('user_id',$sponsor_id)->where('level_id',$level)->get()->row();
                    if(empty($levelChack)){
                        $level_data = array(
                            'user_id'       => @$sponsor_id,
                            'level_id'      => @$level,
                            'achive_date'   => date('Y-m-d h:i:s'),
                            'bonus'         => 0.0,
                            'status'        => 1,
                        );
                        $this->db->insert('user_level',$level_data);
                    }

                    #----------------------------
                    # sms send for  team bonus
                    #----------------------------
                    $balance2 = $this->common_model->get_all_transection_by_user($sponsor_id);
                    
                    $new_balance2 = $balance2['balance'];

                    $this->load->library('sms_lib');

                    $template = array( 
                        'name'          => $sponsers_info->f_name.' '.$sponsers_info->l_name,
                        'amount'        => 0.0,
                        'new_balance'   => $new_balance2,
                        'stage'         => $new_level,
                        'date'          => date('d F Y')
                    );

                     $send_sms = $this->sms_lib->send(array(
                        'to'              => $sponsers_info->phone, 
                        'template'        => 'Congrats! You received the amount $%amount% for team bonus. Your new balance is $%new_balance% . You are now in Stage %stage%', 
                        'template_config' => $template, 
                    ));

                    #----------------------------------
                    #   sms insert for team bonus
                    #------------------------------------- 
                    if($send_sms){
                        $message_data = array(
                            'sender_id'     => 1,
                            'receiver_id'   => $sponsers_info->user_id,
                            'subject'       => 'Team Bonus',
                            'message'       => 'Congrats! You received the amount $0.0 for team bonus. Your new balance is $'.$new_balance2.'. You are now in Stage '.$new_level,
                            'datetime'      => date('Y-m-d h:i:s'),
                        );
                        $this->db->insert('message',$message_data);
                    }

                    #-------------------------------------
                    #      email verify
                    #------------------------------------- 
                    $appSetting = $this->common_model->get_setting();

                    #----------------------------
                    #      email verify smtp
                    #----------------------------
                    $post = array(
                        'title'           => $appSetting->title,
                        'subject'           => 'Team Bonus',
                        'to'                => $sponsers_info->email,
                        'message'           => 'Congrats! You received the amount $0.0 for team bonus. Your new balance is $'.$new_balance2.'. You are now in Stage '.$new_level,
                    );
                    $send_email = $this->common_model->send_email($post);

                    if($send_email){
                            $n = array(
                            'user_id'                => $sponsers_info->user_id,
                            'subject'                => 'Team Bonus',
                            'notification_type'      => 'Team_Bonus',
                            'details'                => 'Congrats! You received the amount $0.0 for team bonus. Your new balance is $'.$new_balance2.'. You are now in Stage '.$new_level,
                            'date'                   => date('Y-m-d h:i:s'),
                            'status'                 => '0'
                        );
                        $this->db->insert('notifications',$n);

                    }

                    return TRUE;

                } else {

                    return FALSE;
                    
                }

            } else{

                return FALSE;

            }

        }

    }

    /*
    |   SET LEVEL with Level bonus 
    |   @param sponser id
    |   return ture or false
    */
    public function setlevel_withbonus($sponsor_id)
    {
        $appSetting = $this->common_model->get_setting();

        $investment = $this->db->select('*')->from('investment')->where('user_id',$sponsor_id)->get()->num_rows();
            
        if($investment !=NUll){

            $sponsers_info = $this->db->select('*')->from('user_registration')->where('user_id',$sponsor_id)->get()->row();  
        
            $sponsers2 = $this->db->select('*')
                    ->from('team_bonus')
                    ->where('user_id',$sponsor_id)
                    ->get()
                    ->row();

            if(@$sponsers2->sponser_commission!=0 && @$sponsers2->team_commission!=0){
                            
                $level = @$sponsers2->level;

                $get_commi = $this->db->select('*')
                            ->from('setup_commission')
                            ->where('personal_invest<=',@$sponsers2->sponser_commission)
                            ->where('total_invest<=',@$sponsers2->team_commission)
                            ->where('level_name',$level)
                            ->get()
                            ->row();                            
                                       
                if($get_commi!=NULL){

                    $new_level = $level+1;
                    $data = $this->db->set('level',$new_level)
                    ->where('user_id',$sponsor_id)
                    ->update('team_bonus');     
                    
                    $level_data = array(
                        'user_id'       => @$sponsor_id,
                        'level_id'      => @$level,
                        'achive_date'   => date('Y-m-d h:i:s'),
                        'bonus'         => @$get_commi->team_bonous,
                        'status'        => 1,
                    );
                    $this->db->insert('user_level',$level_data);

                    #----------------------------
                    # sms send for  team bonus
                    #----------------------------
                    $balance2 = $this->common_model->get_all_transection_by_user($sponsor_id);
                    $new_balance2 = $balance2['balance']+$get_commi->team_bonous;

                    $this->load->library('sms_lib');

                        $template = array( 
                            'name'          => $sponsers_info->f_name.' '.$sponsers_info->l_name,
                            'amount'        => $get_commi->team_bonous,
                            'new_balance'   => $new_balance2,
                            'stage'         => $new_level,
                            'date'          => date('d F Y')
                        );

                         $send_sms = $this->sms_lib->send(array(
                            'to'              => $sponsers_info->phone, 
                            'template'        => 'Congrats! You received the amount $%amount% for team bonus. Your new balance is $%new_balance% . You are now in Stage %stage%', 
                            'template_config' => $template, 
                        ));

                    #----------------------------------
                    #   sms insert for team bonus
                    #----------------------------------
                    if($send_sms){
                        $message_data = array(
                            'sender_id'     => 1,
                            'receiver_id'   => $sponsers_info->user_id,
                            'subject'       => 'Team Bonus',
                            'message'       => 'Congrats! You received the amount $'.$get_commi->team_bonous.' for team bonus. Your new balance is $'.$new_balance2.'. You are now in Stage '.$new_level,
                            'datetime'      => date('Y-m-d h:i:s'),
                        );
                        $this->db->insert('message',$message_data);
                     }

                    #----------------------------
                    #      email verify smtp
                    #----------------------------
                     $post = array(
                        'title'           => $appSetting->title,
                        'subject'           => 'Team Bonus',
                        'to'                => $sponsers_info->email,
                        'message'           => 'Congrats! You received the amount $'.$get_commi->team_bonous.' for team bonus. Your new balance is $'.$new_balance2.'. You are now in Stage '.$new_level,
                    );                       
                    $send_email = $this->common_model->send_email($post);                    

                    if($send_email){

                            $n = array(
                            'user_id'                => $sponsers_info->user_id,
                            'subject'                => 'Team Bonus',
                            'notification_type'      => 'Team_Bonus',
                            'details'                => 'Congrats! You received the amount $'.$get_commi->team_bonous.' for team bonus. Your new balance is $'.$new_balance2.'. You are now in Stage '.$new_level,
                            'date'                   => date('Y-m-d h:i:s'),
                            'status'                 => '0'
                        );
                        $this->db->insert('notifications', $n);    
                    }

                    return TRUE;

                }else {

                    return FALSE;
                
                }

            }else{
                return FALSE;

            } 
                       
        }

    }

}