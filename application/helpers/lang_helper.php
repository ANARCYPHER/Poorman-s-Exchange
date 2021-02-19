<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('display')) {

    function display($text = null)
    {
        $ci =& get_instance();
        $ci->load->database();
        $table  = 'language';
        $phrase = 'phrase';

        #---------------------------------------
        #   modify function 30-01-2018
        #--------------------------------------
        $user_id = $ci->session->userdata('user_id');
        if(!empty($user_id)){
            $default_lang  = 'english';
            $setting_table = 'user_registration';
            $data = $ci->db->where('user_id',$user_id)->get($setting_table)->row();
        } else {

            $default_lang  = 'english';
            $setting_table = 'setting';
                    //set language  
            $data = $ci->db->get($setting_table)->row();
        }#end

        if (!empty($data->language)) {
            $language = $data->language; 
        } else {
            $language = $default_lang; 
        } 
 
        if (!empty($text)) {

            if ($ci->db->table_exists($table)) { 

                if ($ci->db->field_exists($phrase, $table)) { 

                    if ($ci->db->field_exists($language, $table)) {

                        $row = $ci->db->select($language)
                              ->from($table)
                              ->where($phrase, $text)
                              ->get()
                              ->row(); 

                        if (!empty($row->$language)) {
                            return $row->$language;
                        } else {
                            return false;
                        }

                    } else {
                        return false;
                    }

                } else {
                    return false;
                }

            } else {
                return false;
            }            
        } else {
            return false;
        }  

    }
 
}


 

// $autoload['helper'] =  array('language_helper');

/*display a language*/
// echo display('helloworld'); 

/*display language list*/
// $lang = languageList(); 
