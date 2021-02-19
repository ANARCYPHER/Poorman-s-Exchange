<?php
// Settings

$ci =& get_instance();
$gateway = $ci->db->select('*')->from('payment_gateway')->where('id',3)->where('status',1)->get()->row();

define('CIPG_PROTOCOL', 'https');
define('CIPG_HOST', 'ucollect.ubagroup.com');
define('CIPG_CONTEXT', 'cipg-payportal');
define('CIPG_MERCHANTID', $gateway->public_key);
define('CIPG_SERVICEKEY', $gateway->private_key);

define('CIPG_URL', CIPG_PROTOCOL . '://' . CIPG_HOST . '/' . CIPG_CONTEXT);

define('CIPG_URL_REGISTER_JSON', CIPG_PROTOCOL . '://' . CIPG_HOST . '/' . CIPG_CONTEXT . "/regjtran");

define('CIPG_URL_REGISTER_XML', CIPG_PROTOCOL . '://' . CIPG_HOST . '/' . CIPG_CONTEXT . "/regxtran");

define('CIPG_URL_REGISTER_POST_PARAM', CIPG_PROTOCOL . '://' . CIPG_HOST . '/' . CIPG_CONTEXT . "/regptran");


define('CIPG_URL_PAY', CIPG_PROTOCOL . '://' . CIPG_HOST . '/' . CIPG_CONTEXT . "/paytran");
?>