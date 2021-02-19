<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News_model extends CI_Model {
 
	public function create($data = array())
	{
		return $this->db->insert('web_news', $data);
		
	}

	public function read($limit, $offset)
	{
		return $this->db->select("*")
			->from('web_news')
			->order_by('article_id', 'desc')
			->limit($limit, $offset)
			->get()
			->result();

	}

	public function single($article_id = null)
	{
		return $this->db->select('*')
			->from('web_news')
			->where('article_id', $article_id)
			->get()
			->row();

	}

	public function all()
	{
		return $this->db->select('*')
			->from('web_news')
			->get()
			->result();

	}

	public function update($data = array())
	{
		return $this->db->where('article_id', $data["article_id"])
			->update("web_news", $data);

	}

	public function delete($article_id = null)
	{
		return $this->db->where('article_id', $article_id)
			->delete("web_news");

	}
}
