<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Autoload {
	public function paystack_autoload(){
		
		require_once __DIR__ . '/composer/autoload_real.php';
		return ComposerAutoloaderInit7af4f3afd646dd2e1569874cc0c9bbb8::getLoader();
		
	}
}
