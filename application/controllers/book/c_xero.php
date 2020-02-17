<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
use XeroPHP\Application\PrivateApplication;

class C_xero extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function wrapper(){
		//These are the minimum settings - for more options, refer to examples/config.php
		$config = [
		    'oauth' => [
		        'callback'         => 'http://localhost/',
		        'consumer_key'     => '6LDYSLJYAHXYTBOWSOPPUZFKJP1XQY',
		        'consumer_secret'  => '5LFOIUMT9RPEOU3QWUOQIDPMQKQSZA',
		        'rsa_private_key'  => APPPATH.'cert/publickey.cer',
		    ],
		];
		$xero = new PrivateApplication($config);
		print_r($xero->load('Accounting\\Organisation')->execute());
	}

	public function invoice()
	{
		$url="https://api.xero.com/api.xro/2.0/Invoices";

		$contact = array(
			"Name" => "Martin Hudson2"
		);
		$lineitems = array(
			"LineItem" => array(
				"Description" => "Monthly rental for property at 56a Wilkins Avenue",
				"Quantity" => "4.3400",
				"UnitAmount" => "395.00",
				"AccountCode" => "200"
			)
		);
 
		$data = array(
		    "Type" => "ACCREC",
		    "Contact" => $contact,
		    "Date" => "2018-11-08T00:00:00",
		    "DueDate" => "2018-11-15T00:00:00",
		    "LineAmountTypes" => "Exclusive",
		    "LineItems" => $lineitems
		);
		$ch = curl_init( $url );
		# Setup request to send json via POST.
		$payload = json_encode($data);
		
		//https baypass
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		
		curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
		# Return response instead of printing.
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

		//VERBOSE
		curl_setopt($ch, CURLOPT_VERBOSE, true);
		$verbose = fopen('php://temp', 'w+');
		curl_setopt($ch, CURLOPT_STDERR, $verbose);

		# Send request.
		$result = curl_exec($ch);
		curl_close($ch);

		//PRINT VERBOSE ERROR INFORMATION [1]
		/*if ($result === FALSE) {
		    printf("cUrl error (#%d): %s<br>\n", curl_errno($ch), htmlspecialchars(curl_error($ch)));
		}
		else{
		}*/

		//PRINT VERBOSE ERROR INFORMATION [2]
		/*rewind($verbose);
		$verboseLog = stream_get_contents($verbose);
		echo "Verbose information:\n<pre>", htmlspecialchars($verboseLog), "</pre>\n";*/

		# Print response.
		echo "<pre>" . $result. "</pre>";
	}
}