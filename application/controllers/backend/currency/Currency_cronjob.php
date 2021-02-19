<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Currency_cronjob extends CI_Controller {
 	
 	public function __construct()
 	{
 		parent::__construct();

 		$this->load->model(array(
 			'backend/currency/currency_model'  
 		));
 	}

	public function updateCurency(){
		$jsoncurrency = file_get_contents('https://api.coinmarketcap.com/v1/ticker/');

		$jcurrency=json_decode($jsoncurrency);

		foreach ($jcurrency as $jkey => $jvalue) {
			$data['id']= $jvalue->id;
			$data['name']= $jvalue->name;
			$data['symbol']= $jvalue->symbol;
			$data['rank']= $jvalue->rank;
			$data['price_usd']= $jvalue->price_usd;
			$data['price_btc']= $jvalue->price_btc;
			//$24h_volume_usd = $value->24h_volume_usd;
			$data['market_cap_usd']= $jvalue->market_cap_usd;
			$data['available_supply']= $jvalue->available_supply;
			$data['total_supply']= $jvalue->total_supply;
			$data['max_supply']= $jvalue->max_supply;
			$data['percent_change_1h']= $jvalue->percent_change_1h;
			$data['percent_change_24h']= $jvalue->percent_change_24h;
			$data['percent_change_7d']= $jvalue->percent_change_7d;
			$data['last_updated']= $jvalue->last_updated;

			$this->currency_model->updateCurency($data);
		}
		
		$this->session->set_flashdata('message', display('update_successfully'));
		redirect("backend/currency/currency/");

	}
}
