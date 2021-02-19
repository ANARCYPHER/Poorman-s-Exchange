<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Exchange_wallet_model extends CI_Model {
 
	public function create($data = array())
	{
		return $this->db->insert('ext_exchange_wallet', $data);
	}

	public function read($limit, $offset)
	{
		return $this->db->select("*")
			->from('ext_exchange_wallet')
			->order_by('coin_name', 'asc')
			->limit($limit, $offset)
			->get()
			->result();
	}

	public function single($ext_exchange_wallet_id = null)
	{
		return $this->db->select('*')
			->from('ext_exchange_wallet')
			->where('ext_exchange_wallet_id', $ext_exchange_wallet_id)
			->get()
			->row();
	}

	public function all()
	{
		return $this->db->select('*')
			->from('ext_exchange_wallet')
			->get()
			->result();
	}

	public function update($data = array())
	{
		return $this->db->where('ext_exchange_wallet_id', $data["ext_exchange_wallet_id"])
			->update("ext_exchange_wallet", $data);
	}

	public function delete($ext_exchange_wallet_id = null)
	{
		return $this->db->where('ext_exchange_wallet_id', $ext_exchange_wallet_id)
			->delete("ext_exchange_wallet");
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
}
