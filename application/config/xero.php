<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Configuration options for Xero private application
 */

$config = array(
	'consumer'	=> array(
    	'key'		=> '6LDYSLJYAHXYTBOWSOPPUZFKJP1XQY',
    	'secret'	=> '5LFOIUMT9RPEOU3QWUOQIDPMQKQSZA'
    ),
    'certs'		=> array(
    	'private'  	=> APPPATH.'cert/public_privatekey.pfx',
    	'public'  	=> APPPATH.'cert/publickey.cer'
    ),
    'format'    => 'xml'
);