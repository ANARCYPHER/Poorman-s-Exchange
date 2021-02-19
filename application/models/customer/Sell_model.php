<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sell_model extends CI_Model {
 
	public function create($data = array())
	{
		return $this->db->insert('ext_exchange', $data);
	}
	public function documentcreate($data = array())
	{
		return $this->db->insert('ext_document', $data);
	}

	public function read($limit, $offset)
	{
		return $this->db->select("*")
			->from('ext_exchange')
			->where('transection_type', 'sell')
			->order_by('ext_exchange_id', 'asc')
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
			->where('transection_type', 'sell')
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
		return $this->db->select('price_usd')
			->from('crypto_currency')
			->where('cid', $cid)
			->where('status', 1)
			->get()
			->row();
	}
	public function findExcCurrency()
	{
		return $this->db->select('*')
			->from('ext_exchange_wallet')
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
	public function findExchangeCurrency($coin_id = null)
	{
		return $this->db->select('sell_adjustment, wallet_data, coin_name')
			->from('ext_exchange_wallet')
			->where('coin_id', $coin_id)
			->where('status', 1)
			->get()
			->row();
	}
}
