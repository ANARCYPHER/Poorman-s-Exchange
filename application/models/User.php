<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Model{
    function __construct() {
        $this->tableName = 'user_registration';
        $this->primaryKey = 'uid';
    }
    public function checkUser($data = array()){
        return $this->db->select('uid,user_id,sponsor_id,phone,email,username,status,oauth_provider,oauth_uid')
        ->from($this->tableName)
        ->where(array('oauth_provider'=>$data['oauth_provider'],'oauth_uid'=>$data['oauth_uid']))
        ->get();
    }

    public function checkUserId($uid){
        return $this->db->select('user_id')
        ->from($this->tableName)
        ->where(array('uid'=>$uid))
        ->get();
    }

    public function insertUser($data = array()){
        $data['created'] = date("Y-m-d H:i:s");
        $data['modified'] = date("Y-m-d H:i:s");
        $insert = $this->db->insert($this->tableName,$data);
        $userID = $this->db->insert_id();
        return $userID?$userID:FALSE;
    }
    public function updateUser($data = array(), $primarykey=''){
        $data['modified'] = date("Y-m-d H:i:s");
        $this->db->update($this->tableName,$data,array('uid'=>$primarykey));
        $userID = $primarykey;
        return $userID?$userID:FALSE;
    }
    public function checkDuplictemail($data = [])
    {    
        return $this->db->select("user_registration.email")
            ->from('user_registration')
            ->where('email', $data['email'])
            ->get();
    }

}