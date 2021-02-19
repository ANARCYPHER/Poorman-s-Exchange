<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Web_model extends CI_Model {

	function __construct() {
        $this->tableName = 'user_registration';
        $this->primaryKey = 'uid';
    }

	public function registerUser($data = [])
	{	 
		$data['created'] = date("Y-m-d H:i:s");
        $data['modified'] = date("Y-m-d H:i:s");        
		return $this->db->insert('user_registration',$data);

	}
	
	public function updateUser($data)
	{
        $data['modified'] = date("Y-m-d H:i:s");
		return $this->db->update('user_registration',$data,array('email'=>$data['email']));

	}

	public function checkUser($data = array())
	{
		$where = "(email ='".$data['email']."' OR username = '".$data['email']."')";
		return $this->db->select("*")
			->from('user_registration')
			->where($where)
			->get();
	}

	public function checkDuplictemail($data = [])
	{
		return $this->db->select("user_registration.email")
			->from('user_registration')
			->where('email', $data['email'])
			->get();
	}

	public function activeAccountSelect($activecode='')
	{	 
		return $this->db->select("user_registration.user_id")
			->from('user_registration')
			->where('user_id', $activecode)
			->get();
	}

	public function activeAccount($activecode='')
	{
		return $this->db->set('status', '1')
			->where('user_id', $activecode)
			->update("user_registration");
	}

	public function checkDuplictuser($data = [])
	{	 
		return $this->db->select("user_registration.username")
			->from('user_registration')
			->where('username', $data['username'])
			->get();
	}

	public function subscribe($data = [])
	{	 
		return $this->db->insert('web_subscriber',$data);
	}

	public function checkSubscriber($data = array())
	{
		return $this->db->select("web_subscriber.email")
			->from('web_subscriber')
			->where('email', $data['email'])
			->get();
	}

	public function active_slider()
	{
		return $this->db->select('*')
			->from('web_slider')
			->where('status', 1)
			->order_by('slider_id', 'asc')
			->get()
			->result();
	}

	public function social_link()
	{
		return $this->db->select('*')
			->from('web_social_link')
			->where('status', 1)
			->order_by('id', 'asc')
			->get()
			->result();
	}
	
	public function categoryList()
	{	 
		return $this->db->select('*')
			->from('web_category')
			->where('status', 1)
			->order_by('position_serial', 'asc')
			->get()
			->result();
	}

	public function cat_info($slug=NULL){
		return $this->db->select("*")
			->from('web_category')
			->where('slug', $slug)
			->where('status', 1)
			->get()
			->row();
	}

	public function newsCatListBySlug($slug=NULL)
	{	 
		$cat_id = $this->db->select('cat_id')->from('web_category')->where('slug', $slug)->get()->row();

		return $this->db->select('*')
			->from('web_category')
			->where('status', 1)
			->order_by('cat_id', 'desc')
			->where('parent_id', $cat_id->cat_id)
			->get()
			->result();
	}

	public function catidBySlug($slug=NULL){
		return $this->db->select("cat_id")
			->from('web_category')
			->where('slug', $slug)
			->where('status', 1)
			->get()
			->row();
	}

	public function article($id=NULL, $limit=NULL){
		return $this->db->select("*")
			->from('web_article')
			->where('cat_id', $id)
			->order_by('position_serial', 'asc')
			->limit($limit)
			->get()
			->result();
	}

	public function package(){
		return $this->db->select("*")
			->from('package')
			->get()
			->result();
	}

	public function contentDetails($slug = null)
	{
		return $this->db->select('*')
			->from('web_article')
			->where('slug', $slug)
			->get()
			->row();
	}

	public function newsDetails($slug = null)
	{
		return $this->db->select('*')
			->from('web_news')
			->where('slug', $slug)
			->get()
			->row();
	}

	public function cryptoCoin($limit, $offset)
	{
		return $this->db->select("*")
			->from('cryptolist')
			->order_by('SortOrder', 'asc')
			->limit($limit, $offset)
			->get()
			->result();
	}

	public function cryptoCoinDetails($id = NULL)
	{
		return $this->db->select('*')
			->from('cryptolist')
			->where('Id', $id)
			->get()
			->row();
	}

	public function advertisement($id=NULL){
		return $this->db->select("*")
			->from('advertisement')
			->where('page', $id)
			->where('status', 1)
			->order_by('serial_position', 'asc')
			->get()
			->result();
	}
	public function webLanguage(){
		return $this->db->select('*')
			->from('web_language')
			->where('id', 1)
			->get()
			->row();
	}


}