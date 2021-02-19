<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Exchange_model extends CI_Model {
 
	public function create($data = array())
	{
		return $this->db->insert('ext_exchange', $data);
	}

	public function read($limit, $offset)
	{
		return $this->db->select("*")
			->from('ext_exchange')
			->order_by('date_time', 'asc')
			->limit($limit, $offset)
			->get()
			->result();
	}

	public function single($ext_exchange_id = null)
	{
		return $this->db->select('*')
			->from('ext_exchange')
			->where('ext_exchange_id', $ext_exchange_id)
			->get()
			->row();
	}

	public function all()
	{
		return $this->db->select('*')
			->from('ext_exchange')
			->get()
			->result();
	}

	public function update($data = array())
	{
		return $this->db->where('ext_exchange_id', $data["ext_exchange_id"])
			->update("ext_exchange", $data);
	}

	public function delete($ext_exchange_id = null)
	{
		return $this->db->where('ext_exchange_id', $ext_exchange_id)
			->delete("ext_exchange");
	}
	public function activeCurrency()
	{
		return $this->db->select('*')
			->from('crypto_currency')
			->where('status', 1)
			->get()
			->result();
	}
	public function findCurrency($cid = null)
	{
		return $this->db->select('price_usd, id, name')
			->from('crypto_currency')
			->where('cid', $cid)
			->where('status', 1)
			->get()
			->row();
	}
	public function findExcUser($user_id = null)
	{
		return $this->db->select("*")
			->from('user_registration')
			->where('user_id', $user_id)
			->where('status', 1)
			->get()
			->row();
	}
	public function findAllExcUser()
	{
		return $this->db->select("*")
			->from('user_registration')
			->get()
			->result();
	}
}
