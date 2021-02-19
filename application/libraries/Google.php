<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Google{
    
    public function __construct(){
        
        $CI =& get_instance();
        $CI->config->load('google');
        
        require APPPATH .'third_party/google-api-client/apiClient.php';
        require APPPATH .'third_party/google-api-client/contrib/apiOauth2Service.php';
        
        $this->client = new apiClient();
        $this->client->setApplicationName($CI->config->item('application_name', 'google'));
        $this->client->setClientId($CI->config->item('client_id', 'google'));
        $this->client->setClientSecret($CI->config->item('client_secret', 'google'));
        $this->client->setRedirectUri($CI->config->item('redirect_uri', 'google'));
        $this->client->setDeveloperKey($CI->config->item('api_key', 'google'));
        $this->client->setScopes($CI->config->item('scopes', 'google'));
        $this->client->setAccessType('online');
        $this->client->setApprovalPrompt('auto');
        $this->oauth2 = new apiOauth2Service($this->client);
    }
    
    public function loginURL() {
        return $this->client->createAuthUrl();
    }
    
    public function getAuthenticate() {
        return $this->client->authenticate();
    }
    
    public function getAccessToken() {
        return $this->client->getAccessToken();
    }
    
    public function setAccessToken() {
        return $this->client->setAccessToken();
    }
    
    public function revokeToken() {
        return $this->client->revokeToken();
    }
    
    public function getUserInfo() {
        return $this->oauth2->userinfo->get();
    }
    
}