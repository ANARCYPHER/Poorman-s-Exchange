<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
|  Google API Configuration
| -------------------------------------------------------------------
|  client_id         string   Your Google API Client ID.
|  client_secret     string   Your Google API Client secret.
|  redirect_uri      string   URL to redirect back to after login.
|  application_name  string   Your Google application name.
|  api_key           string   Developer key.
|  scopes            string   Specify scopes
*/
$ci =& get_instance();
$google = $ci->db->select('*')->from('social_app')->where('id',2)->get()->row();

$config['google']['client_id']        = @$google->app_id;
$config['google']['client_secret']    = @$google->app_secret;
$config['google']['redirect_uri']     =  base_url().'user_authentication/glogin';
$config['google']['application_name'] = 'Login to BDTASK';
$config['google']['api_key']          = @$google->api_key;
$config['google']['scopes']           = array();