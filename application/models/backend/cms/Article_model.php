<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Article_model extends CI_Model {
 
	public function create($data = array())
	{
		return $this->db->insert('web_article', $data);
		
	}

	public function read($limit, $offset)
	{
		return $this->db->select("*")
			->from('web_article')
			->order_by('cat_id', 'desc')
			->limit($limit, $offset)
			->get()
			->result();

	}

	public function single($article_id = null)
	{
		return $this->db->select('*')
			->from('web_article')
			->where('article_id', $article_id)
			->get()
			->row();

	}

	public function all()
	{
		return $this->db->select('*')
			->from('web_article')
			->get()
			->result();

	}

	public function update($data = array())
	{
		return $this->db->where('article_id', $data["article_id"])
			->update("web_article", $data);

	}

	public function delete($article_id = null)
	{
		return $this->db->where('article_id', $article_id)
			->delete("web_article");

	}

	public function catidBySlug($slug=NULL){
		return $this->db->select("cat_id")
			->from('web_category')
			->where('slug', $slug)
			->get()
			->row();
	}

	public function articleByCatid($id=NULLL){
		return $this->db->select("*")
			->from('web_article')
			->where('cat_id', $id)
			->get()
			->row();
	}

}
