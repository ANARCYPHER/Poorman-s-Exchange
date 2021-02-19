<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Slider_model extends CI_Model {
 
	public function create($data = array())
	{
		return $this->db->insert('web_slider', $data);
	}

	public function read($limit, $offset)
	{
		return $this->db->select("*")
			->from('web_slider')
			->order_by('slider_h1_en', 'asc')
			->limit($limit, $offset)
			->get()
			->result();
	}

	public function single($slider_id = null)
	{
		return $this->db->select('*')
			->from('web_slider')
			->where('slider_id', $slider_id)
			->get()
			->row();
	}

	public function all()
	{
		return $this->db->select('*')
			->from('web_slider')
			->get()
			->result();
	}

	public function update($data = array())
	{
		return $this->db->where('slider_id', $data["slider_id"])
			->update("web_slider", $data);
	}

	public function delete($slider_id = null)
	{
		return $this->db->where('slider_id', $slider_id)
			->delete("web_slider");
	}
}
