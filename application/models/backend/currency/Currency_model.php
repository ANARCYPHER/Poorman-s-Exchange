<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Currency_model extends CI_Model {
 
	public function create($data = array())
	{
		return $this->db->insert('crypto_currency', $data);
	}
	public function read($limit, $offset)
	{
		return $this->db->select("*")
			->from('crypto_currency')
			->order_by('rank', 'asc')
			->limit($limit, $offset)
			->get()
			->result();
	}
	public function single($cid = null)
	{
		return $this->db->select('*')
			->from('crypto_currency')
			->where('cid', $cid)
			->get()
			->row();
	}
	public function all()
	{
		return $this->db->select('*')
			->from('crypto_currency')
			->get()
			->result();
	}
	public function update($data = array())
	{
		return $this->db->where('cid', $data["cid"])
			->update("crypto_currency", $data);
	}
	public function delete($cid = null)
	{
		return $this->db->where('cid', $cid)
			->delete("crypto_currency");
	}

	public function updateCurency($data = array())
	{
		return $this->db->where('id', $data["id"])
			->update("crypto_currency", $data);
	}

	public function activeCurrency()
	{
		return $this->db->select('*')
			->from('crypto_currency')
			->where('status', 1)
			->get()
			->result();
	}
	public function findlocalCurrency()
	{
		return $this->db->select('usd_exchange_rate, currency_name, currency_iso_code, currency_symbol, currency_position')
			->from('local_currency')
			->where('currency_id', 1)
			->get()
			->row();
	}
}
