<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Payment extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_crud');
	}

	public function getPaymentGuide($pay_channel){
		$guide = $this->model_crud->GetValue('ol_payment_guide','guide','pay_channel',$pay_channel);
		if($guide == null){
			echo "Tidak ada data!";
		}
		else{
			echo $guide;
		}
	}

	public function inquiryfaspay2(){
		$url="https://web.faspay.co.id/cvr/100001/10";
 
		$data = array(
		    "request" => "Daftar Payment Channel",
		    "merchant_id" => "32316",
		    "merchant" => "Dream Tour",
		    "signature" => sha1(md5('bot32316n8su9aR3'))
		);
		$ch = curl_init( $url );
		# Setup request to send json via POST.
		$payload = json_encode($data);
		
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
		# Return response instead of printing.
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		# Send request.
		$result = curl_exec($ch);
		curl_close($ch);
		# Print response.
		echo "<pre>" . $result. "</pre>";

		//$hhasil = json_decode($result);
		//echo $hhasil->merchant_id;
	}

	public function reqpayments($paychannel, $maininvoice, $amount){
		/*if($paychannel == '000'){
			echo "banktransfer";
		}
		else{*/

		$invoice = $this->model_crud->newPayId($maininvoice);

		$datajual = $this->model_crud->ambilData('ol_invoice','*','idinvoice = "'.$maininvoice.'"');
		if($datajual == null){
			echo 3;
		}
		else{
			foreach ($datajual as $rj) {
				$kontak = $rj->kontak;
				$nohp = $rj->nohp;
				$email = $rj->email;
				$fromdate = $rj->tanggal;
				$todate = $rj->expired;
				$billtotal = ($amount*100);
				$paket = $this->model_crud->GetValue('ol_paketumroh','nmpaketumroh','idpaketumroh',$rj->idpaketumroh);
			}

			$arrproduk = array(
				"product" => 'Deposit '.$paket,
				"qty" => 1,
				"amount" => ($amount*100),
				"payment_plan" => "1",
				"merchant_id" => "32316",
				"tenor" => "00"
			);

			$url="https://web.faspay.co.id/cvr/300011/10";
	 
			$data = array(
			    "request" => "Transmisi Info Detil Pembelian",
			    "merchant_id" => "32316",
			    "merchant" => "Dream Tour",
			    "bill_no" => $invoice,
			    "bill_date" => $fromdate.' '.date('H:i:s'),
			    "bill_expired" => $todate.' 00:00:00',
			    "bill_desc" => "Deposit #".$maininvoice,
			    "bill_currency" => "IDR",
			    "bill_total" => $billtotal,
			    "cust_no" => $nohp,
			    "cust_name" => $kontak,
			    "payment_channel" => $paychannel,
			    "pay_type" => "1",
			    "msisdn" => $nohp,
			    "email" => $email,
			    "terminal" => "10",
			    "item" => $arrproduk,
				"signature" => sha1(md5("bot32316n8su9aR3".$invoice))
			);
			$ch = curl_init( $url );
			# Setup request to send json via POST.
			$payload = json_encode($data);
			
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
			# Return response instead of printing.
			curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
			# Send request.
			$result = curl_exec($ch);
			curl_close($ch);

			//echo "<pre>" . $result. "</pre>";

			$hhasil = json_decode($result);

			if($hhasil->response_code == '00'){
				$pussh['idpayment'] = $invoice;
				$pussh['idinvoice'] = $maininvoice;
				$pussh['paybill'] = $amount;
				$pussh['pay_channel'] = $paychannel;
				$pussh['tanggal'] = date('Y-m-d');
				$pussh['vanumber'] = $hhasil->trx_id;
				$pussh['redirect'] = $hhasil->redirect_url;

				$simpan = $this->model_crud->simpan('ol_invoice_payment',$pussh);
				if($simpan > 0){
					echo $invoice;
				}
				else{
					echo 0;
				}
			}
			else{
				echo 2;
			}
		}
	}

	public function reqpayxendit(){
		require_once APPPATH . '/third_party/XenditClient/XenditPHPClient.php';

        $options['secret_api_key'] = 'eG5kX2RldmVsb3BtZW50X1lMakpzWGtpdzVvbEN5aFFST01Sc2NHR0gyMFowWUtVVDRjWWJHdENpSDZha0FKcTRjVExCZ282M2REOFN6OTo=';
        //$options['secret_api_key'] = 'xnd_development_P4qDfOss0OCpl8RtKrROHjaQYNCk9dN5lSfk+R1l9Wbe+rSiCwZ3jw==';

		$xenditPHPClient = new XenditClient\XenditPHPClient($options);

		$response = $xenditPHPClient->getBalance();
		//print_r($response);
		echo $response;
	}

	public function createvabniecoll(){
		require_once APPPATH . '/third_party/BNIecoll/BniEnc.php';

		// FROM BNI
		$client_id = '00841';
		$secret_key = 'c6998b9ec0a47020a955992a7d7f38d2';
		$url = 'https://apibeta.bni-ecollection.com/';


		$data_asli = array(
			'client_id' => $client_id,
			'trx_id' => mt_rand(), // fill with Billing ID
			'trx_amount' => 10000,
			'billing_type' => 'c',
			'datetime_expired' => date(), // billing will be expired in 2 hours
			'virtual_account' => '',
			'customer_name' => 'Mr. X',
			'customer_email' => '',
			'customer_phone' => '',
		);

		$hashed_string = BniEnc::encrypt(
			$data_asli,
			$client_id,
			$secret_key
		);

		$data = array(
			'client_id' => $client_id,
			'data' => $hashed_string,
		);

		//GET CONTENT
		//$usecookie = __DIR__ . "/cookie.txt";
		$post = json_encode($data);
		$header[] = 'Content-Type: application/json';
		$header[] = "Accept-Encoding: gzip, deflate";
		$header[] = "Cache-Control: max-age=0";
		$header[] = "Connection: keep-alive";
		$header[] = "Accept-Language: en-US,en;q=0.8,id;q=0.6";

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_VERBOSE, false);
		// curl_setopt($ch, CURLOPT_NOBODY, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_ENCODING, true);
		curl_setopt($ch, CURLOPT_AUTOREFERER, true);
		curl_setopt($ch, CURLOPT_MAXREDIRS, 5);

		curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.120 Safari/537.36");

		if ($post)
		{
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
		}

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

		$rs = curl_exec($ch);

		if(empty($rs)){
			var_dump($rs, curl_error($ch));
			curl_close($ch);
		}
		curl_close($ch);

		//GET RESPONSE
		$response_json = json_decode($rs, true);

		if ($response_json['status'] !== '000') {
			// handling jika gagal
			var_dump($response_json);
		}
		else {
			$data_response = BniEnc::decrypt($response_json['data'], $client_id, $secret_key);
			// $data_response will contains something like this: 
			// array(
			// 	'virtual_account' => 'xxxxx',
			// 	'trx_id' => 'xxx',
			// );
			var_dump($data_response);
		}
	}

	public function canceltrx($trx_id){
		$url="https://web.faspay.co.id/cvr/100005/10";

		$idpayment = $this->model_crud->GetValue('ol_invoice_payment', 'idpayment', 'vanumber', '"'.$trx_id.'"');

		$data = array(
		    "request"=>"Canceling Payment",
			"trx_id"=>$trx_id,
			"merchant_id"=>"32316",
			"merchant" => "Dream Tour",
			"bill_no"=>$idpayment,
			"payment_cancel" => "Cancel by User",
			"signature"=>sha1(md5("bot32316n8su9aR3".$idpayment))
		);
		$ch = curl_init( $url );
		# Setup request to send json via POST.
		$payload = json_encode($data);

		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
		# Return response instead of printing.
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		# Send request.
		$result = curl_exec($ch);
		curl_close($ch);

		//echo "<pre>" . $result. "</pre>";

		$hhasil = json_decode($result);

		$pussh['isApproved'] = $hhasil->payment_status_code;
		$simpanupdate = $this->model_crud->update('ol_invoice_payment', $pussh, 'idpayment', '"'.$idpayment.'"');
		if($simpanupdate){
			if($pussh['isApproved'] == 8){
				echo 1;
			}
			else{
				echo 'Transaksi tidak dibatalkan!';
			}
		}
		else{
			echo 'Gagal membatalkan transaksi!';
		}
	}

	public function reqpaymentdata($idpayment){
		$datapayment = $this->model_crud->selectData("ol_invoice_payment","*","idpayment",$idpayment);
		foreach ($datapayment->result() as $r) {
			$trx_id = $r->vanumber;
			$payment_channel = $r->pay_channel;
		}

		$url="https://web.faspay.co.id/cvr/100004/10";
 
		$data = array(
		    "request" => "Pengecekan Status Pembayaran",
		    "trx_id" => $trx_id,
		    "merchant_id" => "32316",
		    "bill_no" => $idpayment,
			"signature" => sha1(md5("bot32316n8su9aR3".$idpayment))
		);
		$ch = curl_init( $url );
		# Setup request to send json via POST.
		$payload = json_encode($data);
		
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
		# Return response instead of printing.
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		# Send request.
		$result = curl_exec($ch);
		curl_close($ch);

		//echo "<pre>" . $result. "</pre>";

		$hhasil = json_decode($result);

		$pussh['isApproved'] = $hhasil->payment_status_code;
		$simpanupdate = $this->model_crud->update('ol_invoice_payment', $pussh, 'idpayment', $idpayment);
		if($simpanupdate){
			echo 1;
		}
		else{
			echo 'Gagal menyimpan! Silahkan coba lagi!';
		}

		/*
		if($hhasil->payment_status_code == 0)
            $statuspaygateway = 'Belum diproses';
        else if($hhasil->payment_status_code == 1)
            $statuspaygateway = 'Dalam proses';
        else if($hhasil->payment_status_code == 2){
            $statuspaygateway = 'Pembayaran berhasil';

            $pussh['tglstatus'] = $hhasil->payment_date;
            $pussh['kdstatustransaksi'] = 1;
            $pussh['gambarterima'] = $payment_channel.'.png';

            if($this->model_crud->cekData('tbstatusjual', 'where notajual = "'.$invoice.'"') > 0){
            	$simpan = $this->model_crud->update('tbstatusjual',$pussh,'notajual',$invoice);
            }
            else{
            	$pussh['notajual'] = $invoice;
            	$simpan = $this->model_crud->simpan('tbstatusjual',$pussh);
            }
        }
        else if($hhasil->payment_status_code == 3)
            $statuspaygateway = 'Pembayaran gagal';
        else if($hhasil->payment_status_code == 4)
            $statuspaygateway = 'Payment reversal';
        else if($hhasil->payment_status_code == 5)
            $statuspaygateway = 'Tagihan tidak ditemukan';
        else if($hhasil->payment_status_code == 7)
            $statuspaygateway = 'Pembayaran kadaluarsa';
        else if($hhasil->payment_status_code == 8)
            $statuspaygateway = 'Pembayaran dibatalkan';
        else
            $statuspaygateway = 'Status pembayaran tidak diketahui';

        if($hhasil->payment_status_code == 2){
        	if($simpan > 0)
				echo '<label class="label label-default">'.$statuspaygateway.'</label>';
			else
				echo '<label class="label label-default">'.$statuspaygateway.' | Gagal menyimpan. Hubungi admin</label>';
        }
		else
			echo '<label class="label label-default">'.$statuspaygateway.'</label>';
			*/
	}

	public function callback(){
		$idinvoice = $this->model_crud->GetValue('ol_invoice_payment', 'idinvoice', 'idpayment', '"'.$_GET['bill_no'].'"');
		redirect(base_url().'invoice/'.$idinvoice);
	}

	public function notif(){
		$xml = file_get_contents('php://input');
        $jdata = simplexml_load_string($xml);
        
        $idpayment = (string)$jdata->bill_no;
		$data['isApproved'] = $jdata->payment_status_code;
		$sign = $jdata->signature;

		$arridpayment = explode("-", $idpayment);
		if($arridpayment[0] == 'SMART'){
			redirect('https://smartsumrah.com/dev/payment/notiffromdtt/'.$idpayment.'/'.$data['isApproved'].'/'.$sign, 'refresh');
		}
		else{
			$update = $this->model_crud->update('ol_invoice_payment', $data, 'idpayment', $idpayment);
			if($update){
				if($data['isApproved'] == 2){
					$sendemail = $this->sendpaymentsuccess($idpayment);
					if($sendemail == true){
						//
					}
					else{
						$sentfail['kind'] = "PAYMENT NOTIF";
						$sentfail['idcontent'] = $idpayment;
						$this->model_crud->simpan('ol_failedmailsender', $sentfail);
					}
				}
				else{
					//masih dipikirin
				}
			}
			else{
				//kirim notif gagal update status ke iqbaluddinsh@gmail.com
				$this->load->library('email');
				$this->email
		            ->from('iqbaluddin@dreamtour.co.id', 'Dreamtour Online Support')
		            ->reply_to('iqbaluddin@dreamtour.co.id')    // Optional, an account where a human being reads.
		            ->to('iqbaluddinsh@gmail.com')
		            ->subject('Payment Gateway Crash - Dreamtour')
		            ->message('ID Payment : '.$idpayment.', Status code : '.$data['isApproved'])
		            ->send();
			}

			$paymentdate=date('Y-m-d h:i:s');
			$xml ="<faspay>"."\n";
			$xml.="<response>Payment Notification</response>"."\n";
			$xml.="<trx_id>$jdata->trx_id</trx_id>"."\n";
			$xml.="<merchant_id>$jdata->merchant_id</merchant_id>"."\n";
			$xml.="<bill_no>$jdata->bill_no</bill_no>"."\n";
			$xml.="<response_code>00</response_code>"."\n";
			$xml.="<response_desc>Sukses</response_desc>"."\n";
			$xml.="<response_date>$paymentdate</response_date>"."\n";
			$xml.="</faspay>"."\n";
			
			echo "$xml";
		}
	}

	//++++++++++++ MIDTRANS +++++++++++++++++++
	/*
	public function notifhandling()
	{
		$paymentid = $_GET['order_id'];
		if($_GET['transaction_status'] == "settlement")
			$data['isApproved'] = 1;
		else if($_GET['transaction_status'] == "pending")
			$data['isApproved'] = 0;
		else
			$data['isApproved'] = 2;

		$update = $this->model_crud->update('ol_invoice_payment', $data, 'idpayment', $paymentid);
	}

	public function finish()
	{
		$paymentid = $_GET['order_id'];
		if($_GET['transaction_status'] == "settlement")
			$data['isApproved'] = 1;
		else if($_GET['transaction_status'] == "pending")
			$data['isApproved'] = 0;
		else
			$data['isApproved'] = 2;

		$update = $this->model_crud->update('ol_invoice_payment', $data, 'idpayment', $paymentid);
		if($update){
			$idinvoice = $this->model_crud->GetValue('ol_invoice_payment','idinvoice','idpayment','"'.$paymentid.'"');
			redirect('invoice/'.$idinvoice);
		}
		else{
			redirect('/');
		}
	}

	public function unfinish()
	{
		$paymentid = $_GET['order_id'];
		$idinvoice = $this->model_crud->GetValue('ol_invoice_payment','idinvoice','idpayment','"'.$paymentid.'"');
		redirect('invoice/'.$idinvoice);
	}

	public function error()
	{
		$paymentid = $_GET['order_id'];
		$idinvoice = $this->model_crud->GetValue('ol_invoice_payment','idinvoice','idpayment','"'.$paymentid.'"');
		redirect('invoice/'.$idinvoice);
	}*/

	public function sendpaymentmail($idpayment){
		$datapayment = $this->db->query("select * from ol_invoice_payment a join ol_invoice b on a.idinvoice = b.idinvoice join ol_payment_guide c on a.pay_channel = c.pay_channel where idpayment = '".$idpayment."'");
		$addaddr = '';

		$this->load->library('email');
        
        $subject = 'Informasi Pembayaran Dreamtour';

		foreach ($datapayment->result() as $r) {
			$nmpaketumroh = '';
			$imgpaketumroh = '';
			$paketquery = $this->model_crud->ambilData('ol_paketumroh', 'nmpaketumroh, imgpaketumroh', 'idpaketumroh = '.$r->idpaketumroh);
			foreach ($paketquery as $rpu) {
				$nmpaketumroh = $rpu->nmpaketumroh;
				$imgpaketumroh = $rpu->imgpaketumroh;
			}
			$addaddr = $r->email;
			$mcontent = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
				<html xmlns="http://www.w3.org/1999/xhtml">
				<head>
				  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
				  <meta name="viewport" content="width=device-width, initial-scale=1" />
				  <title>Dreamtour.co</title>

				  <style type="text/css">
				    /* Take care of image borders and formatting, client hacks */
				    img { max-width: 600px; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic;}
				    a img { border: none; }
				    table { border-collapse: collapse !important;}
				    #outlook a { padding:0; }
				    .ReadMsgBody { width: 100%; }
				    .ExternalClass { width: 100%; }
				    .backgroundTable { margin: 0 auto; padding: 0; width: 100% !important; }
				    table td { border-collapse: collapse; }
				    .ExternalClass * { line-height: 115%; }
				    .container-for-gmail-android { min-width: 600px; }


				    /* General styling */
				    * {
				      font-family: Helvetica, Arial, sans-serif;
				    }

				    body {
				      -webkit-font-smoothing: antialiased;
				      -webkit-text-size-adjust: none;
				      width: 100% !important;
				      margin: 0 !important;
				      height: 100%;
				      color: #676767;
				    }

				    td {
				      font-family: Helvetica, Arial, sans-serif;
				      font-size: 14px;
				      color: #777777;
				      line-height: 21px;
				    }

				    a {
				      color: #676767;
				      text-decoration: none !important;
				    }

				    .pull-left {
				      text-align: left;
				    }

				    .pull-right {
				      text-align: right;
				    }

				    .header-lg,
				    .header-md,
				    .header-sm {
				      font-size: 32px;
				      font-weight: 700;
				      line-height: normal;
				      padding: 35px 0 0;
				      color: #4d4d4d;
				    }

				    .header-md {
				      font-size: 24px;
				    }

				    .header-sm {
				      padding: 5px 0;
				      font-size: 18px;
				      line-height: 1.3;
				    }

				    .content-padding {
				      padding: 20px 0 5px;
				    }

				    .mobile-header-padding-right {
				      width: 290px;
				      text-align: right;
				      padding-left: 10px;
				    }

				    .mobile-header-padding-left {
				      width: 290px;
				      text-align: left;
				      padding-left: 10px;
				    }

				    .free-text {
				      width: 100% !important;
				      padding: 10px 60px 0px;
				    }

				    .button {
				      padding: 30px 0;
				    }

				    .mini-block {
				      border: 1px solid #e5e5e5;
				      border-radius: 5px;
				      background-color: #ffffff;
				      padding: 12px 15px 15px;
				      text-align: left;
				      width: 253px;
				    }

				    .mini-container-left {
				      width: 278px;
				      padding: 10px 0 10px 15px;
				    }

				    .mini-container-right {
				      width: 278px;
				      padding: 10px 14px 10px 15px;
				    }

				    .product {
				      text-align: left;
				      vertical-align: top;
				      width: 175px;
				    }

				    .total-space {
				      padding-bottom: 8px;
				      display: inline-block;
				    }

				    .item-table {
				      padding: 50px 20px;
				      width: 560px;
				    }

				    .item {
				      width: 300px;
				    }

				    .mobile-hide-img {
				      text-align: left;
				      width: 125px;
				    }

				    .mobile-hide-img img {
				      border: 1px solid #e6e6e6;
				      border-radius: 4px;
				    }

				    .title-dark {
				      text-align: left;
				      border-bottom: 1px solid #cccccc;
				      color: #4d4d4d;
				      font-weight: 700;
				      padding-bottom: 5px;
				    }

				    .item-col {
				      padding-top: 20px;
				      text-align: left;
				      vertical-align: top;
				    }

				    .force-width-gmail {
				      min-width:600px;
				      height: 0px !important;
				      line-height: 1px !important;
				      font-size: 1px !important;
				    }

				  </style>

				  <style type="text/css" media="screen">
				    @import url(http://fonts.googleapis.com/css?family=Oxygen:400,700);
				  </style>

				  <style type="text/css" media="screen">
				    @media screen {
				      /* Thanks Outlook 2013! */
				      * {
				        font-family: \'Oxygen\', \'Helvetica Neue\', \'Arial\', \'sans-serif\' !important;
				      }
				    }
				  </style>

				  <style type="text/css" media="only screen and (max-width: 480px)">
				    /* Mobile styles */
				    @media only screen and (max-width: 480px) {

				      table[class*="container-for-gmail-android"] {
				        min-width: 290px !important;
				        width: 100% !important;
				      }

				      img[class="force-width-gmail"] {
				        display: none !important;
				        width: 0 !important;
				        height: 0 !important;
				      }

				      table[class="w320"] {
				        width: 320px !important;
				      }

				      td[class*="mobile-header-padding-left"] {
				        width: 160px !important;
				        padding-left: 0 !important;
				      }

				      td[class*="mobile-header-padding-right"] {
				        width: 160px !important;
				        padding-right: 0 !important;
				      }

				      td[class="header-lg"] {
				        font-size: 24px !important;
				        padding-bottom: 5px !important;
				      }

				      td[class="content-padding"] {
				        padding: 5px 0 5px !important;
				      }

				       td[class="button"] {
				        padding: 5px 5px 30px !important;
				      }

				      td[class*="free-text"] {
				        padding: 10px 18px 30px !important;
				      }

				      td[class~="mobile-hide-img"] {
				        display: none !important;
				        height: 0 !important;
				        width: 0 !important;
				        line-height: 0 !important;
				      }

				      td[class~="item"] {
				        width: 140px !important;
				        vertical-align: top !important;
				      }

				      td[class~="quantity"] {
				        width: 50px !important;
				      }

				      td[class~="price"] {
				        width: 90px !important;
				      }

				      td[class="item-table"] {
				        padding: 30px 20px !important;
				      }

				      td[class="mini-container-left"],
				      td[class="mini-container-right"] {
				        padding: 0 15px 15px !important;
				        display: block !important;
				        width: 290px !important;
				      }

				    }
				  </style>
				</head>

				<body bgcolor="#f7f7f7">
				<table align="center" cellpadding="0" cellspacing="0" class="container-for-gmail-android" width="100%">
				  <tr>
				    <td align="left" valign="top" width="100%" style="background:repeat-x url(http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg) #ffffff;">
				      <center>
				      <img src="http://s3.amazonaws.com/swu-filepicker/SBb2fQPrQ5ezxmqUTgCr_transparent.png" class="force-width-gmail">
				        <table cellspacing="0" cellpadding="0" width="100%" bgcolor="#ffffff" background="http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg" style="background-color:transparent">
				          <tr>
				            <td width="100%" height="80" valign="top" style="text-align: center; vertical-align:middle;">
				            <!--[if gte mso 9]>
				            <v:rect xmlns:v="urn:schemas-microsoft-com:vml" fill="true" stroke="false" style="mso-width-percent:1000;height:80px; v-text-anchor:middle;">
				              <v:fill type="tile" src="http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg" color="#ffffff" />
				              <v:textbox inset="0,0,0,0">
				            <![endif]-->
				              <center>
				                <table cellpadding="0" cellspacing="0" width="600" class="w320">
				                  <tr>
				                    <td class="pull-left mobile-header-padding-left" style="vertical-align: middle;">
				                      <a href="https://dreamtour.co/"><img width="155" height="47" src="https://dreamtour.co/asset/odyssey/images/logo-pgateway.png"></a>
				                    </td>
				                    <td class="pull-right mobile-header-padding-right" style="color: #0e2c66;">
				                      <a href="https://www.instagram.com/dreamtour_co/" target="_blank" style="padding: 5px;"><img width="24" height="24" src="https://dreamtour.co/asset/odyssey/images/instagram.png"></a>
				                      <a href="https://twitter.com/dreamtour_co" target="_blank" style="padding: 5px;"><img width="24" height="24" src="https://dreamtour.co/asset/odyssey/images/twitter.png"></a>
				                      <a href="https://www.facebook.com/dreamtour.co/" target="_blank" style="padding: 5px;"><img width="24" height="24" src="https://dreamtour.co/asset/odyssey/images/facebook.png"></a>
				                    </td>
				                  </tr>
				                </table>
				              </center>
				              <!--[if gte mso 9]>
				              </v:textbox>
				            </v:rect>
				            <![endif]-->
				            </td>
				          </tr>
				        </table>
				      </center>
				    </td>
				  </tr>
				  <tr>
				    <td align="center" valign="top" width="100%" style="background-color: #f7f7f7;" class="content-padding">
				      <center>
				        <table cellspacing="0" cellpadding="0" width="600" class="w320">
				          <tr>
				            <td class="header-lg" style="color: #0e2c66; text-align: center;">
				              Detail Pembayaran
				            </td>
				          </tr>
				          <tr>
				            <td class="free-text">
				              Berikut adalah detail pembayaran yang anda buat di website <a href="https://dreamtour.co/" target="_blank">Dreamtour</a> untuk pemesanan <b>'.$nmpaketumroh.'</b> atas nama <b>'.$r->kontak.'</b>.<br><br>
				            </td>
				          </tr>
				          <tr>
				            <td class="w320">
				              <table cellpadding="0" cellspacing="0" width="100%">
				                <tr>
				                  <td colspan="2" style="padding: 0 15px 15px !important;">
				                    <table cellpadding="0" cellspacing="0" width="100%">
				                      <tr>
				                        <td class="mini-block-padding">
				                          <table cellspacing="0" cellpadding="0" width="100%" style="border-collapse:separate !important;">
				                            <tr>
				                              <td class="mini-block">
				                              	Pembayaran :<br>
				                              	<span class="header-sm">'.rupiah($r->paybill).'</span><br /><br />
				                                Bank :<br>
				                                <img src="'.base_url('asset/images/payment').'/'.$r->pay_channel.'.png"><br><br>
				                                Nomor VA :<br>
				                              	<span class="header-sm">'.$r->vanumber.'</span><br /><br />
				                              </td>
				                            </tr>
				                          </table>
				                        </td>
				                      </tr>
				                    </table>
				                  </td>
				                </tr>
				              </table>
				            </td>
				          </tr>
				        </table>
				      </center>
				    </td>
				  </tr>
				  <tr>
				    <td align="center" valign="top" width="100%" style="background-color: #ffffff;  border-top: 1px solid #e5e5e5; border-bottom: 1px solid #e5e5e5;">
				      <center>
				        <table cellpadding="0" cellspacing="0" width="600" class="w320">
				            <tr>
				              <td class="item-table">
					              <span class="header-sm">Cara Pembayaran Virtual Account</span><hr>
					              '.$r->guide.'
				              </td>
				            </tr>
				        </table>
				      </center>
				    </td>
				  </tr>
				  <tr>
				    <td valign="top" width="100%" style="background-color: #f7f7f7; height: 100px;">
				      <center>
				        <table cellspacing="0" cellpadding="0" width="600" class="w320">
				          <tr>
				            <td style="padding: 25px 0 25px">
				              <strong>Dream House</strong><br />
				              Jl. Matraman No. 7, Kebon Manggis, Matraman <br />
				              Jakarta Timur <br />
				              <b>(021) 2138 1090</b><br />
				              <b>info@dreamtour.co</b>
				            </td>
				          </tr>
				        </table>
				      </center>
				    </td>
				  </tr>
				</table>
				</div>
				</body>
				</html>';
		}

		//echo $mcontent;

		$result = $this->email
            ->from('iqbaluddin@dreamtour.co.id', 'Dreamtour Online Support')
            ->reply_to('iqbaluddin@dreamtour.co.id')    // Optional, an account where a human being reads.
            ->to($addaddr)
            ->subject($subject)
            ->message($mcontent)
            ->send();
		
		if($result == false){
			$sentfail['kind'] = "PAYMENT CONF";
			$sentfail['idcontent'] = $idpayment;
			$this->model_crud->simpan('ol_failedmailsender', $sentfail);
		}

		/*var_dump($result);
        echo '<br />';
        echo $this->email->print_debugger();
        
        echo !extension_loaded('openssl')?"Not Available":"Available";
        
        exit;*/
	}

	public function sendpaymentsuccess($idpayment){
		$datapayment = $this->db->query("select *,a.tanggal as tglpayment from ol_invoice_payment a join ol_invoice b on a.idinvoice = b.idinvoice join ol_payment_guide c on a.pay_channel = c.pay_channel where idpayment = '".$idpayment."'");
		$addaddr = '';

		$this->load->library('email');
        
        $subject = 'Pembayaran Diterima - Dreamtour';

		foreach ($datapayment->result() as $r) {
			$datalineitem = $this->db->query("select * from ol_invoice_lineitems where idinvoice = '".$r->idinvoice."'");
			$terbayar = $this->model_crud->GetValue('ol_invoice_payment','sum(paybill)','idinvoice','"'.$r->idinvoice.'" and isApproved = 2');
			$nmpaketumroh = '';
			$imgpaketumroh = '';
			$paketquery = $this->model_crud->ambilData('ol_paketumroh', 'nmpaketumroh, imgpaketumroh', 'idpaketumroh = '.$r->idpaketumroh);
			foreach ($paketquery as $rpu) {
				$nmpaketumroh = $rpu->nmpaketumroh;
				$imgpaketumroh = $rpu->imgpaketumroh;
			}
			$addaddr = $r->email;
			$mcontent = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
				<html xmlns="http://www.w3.org/1999/xhtml">
				<head>
				  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
				  <meta name="viewport" content="width=device-width, initial-scale=1" />
				  <title>Dreamtour.co</title>

				  <style type="text/css">
				    /* Take care of image borders and formatting, client hacks */
				    img { max-width: 600px; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic;}
				    a img { border: none; }
				    table { border-collapse: collapse !important;}
				    #outlook a { padding:0; }
				    .ReadMsgBody { width: 100%; }
				    .ExternalClass { width: 100%; }
				    .backgroundTable { margin: 0 auto; padding: 0; width: 100% !important; }
				    table td { border-collapse: collapse; }
				    .ExternalClass * { line-height: 115%; }
				    .container-for-gmail-android { min-width: 600px; }


				    /* General styling */
				    * {
				      font-family: Helvetica, Arial, sans-serif;
				    }

				    body {
				      -webkit-font-smoothing: antialiased;
				      -webkit-text-size-adjust: none;
				      width: 100% !important;
				      margin: 0 !important;
				      height: 100%;
				      color: #676767;
				    }

				    td {
				      font-family: Helvetica, Arial, sans-serif;
				      font-size: 14px;
				      color: #777777;
				      line-height: 21px;
				    }

				    a {
				      color: #676767;
				      text-decoration: none !important;
				    }

				    .pull-left {
				      text-align: left;
				    }

				    .pull-right {
				      text-align: right;
				    }

				    .header-lg,
				    .header-md,
				    .header-sm {
				      font-size: 32px;
				      font-weight: 700;
				      line-height: normal;
				      padding: 35px 0 0;
				      color: #4d4d4d;
				    }

				    .header-md {
				      font-size: 24px;
				    }

				    .header-sm {
				      padding: 5px 0;
				      font-size: 18px;
				      line-height: 1.3;
				    }

				    .content-padding {
				      padding: 20px 0 5px;
				    }

				    .mobile-header-padding-right {
				      width: 290px;
				      text-align: right;
				      padding-left: 10px;
				    }

				    .mobile-header-padding-left {
				      width: 290px;
				      text-align: left;
				      padding-left: 10px;
				    }

				    .free-text {
				      width: 100% !important;
				      padding: 10px 60px 0px;
				    }

				    .button {
				      padding: 30px 0;
				    }

				    .mini-block {
				      border: 1px solid #e5e5e5;
				      border-radius: 5px;
				      background-color: #ffffff;
				      padding: 12px 15px 15px;
				      text-align: left;
				      width: 253px;
				    }

				    .mini-container-left {
				      width: 278px;
				      padding: 10px 0 10px 15px;
				    }

				    .mini-container-right {
				      width: 278px;
				      padding: 10px 14px 10px 15px;
				    }

				    .product {
				      text-align: left;
				      vertical-align: top;
				      width: 175px;
				    }

				    .total-space {
				      padding-bottom: 8px;
				      display: inline-block;
				    }

				    .item-table {
				      padding: 50px 20px;
				      width: 560px;
				    }

				    .item {
				      width: 300px;
				    }

				    .mobile-hide-img {
				      text-align: left;
				      width: 125px;
				    }

				    .mobile-hide-img img {
				      border: 1px solid #e6e6e6;
				      border-radius: 4px;
				    }

				    .title-dark {
				      text-align: left;
				      border-bottom: 1px solid #cccccc;
				      color: #4d4d4d;
				      font-weight: 700;
				      padding-bottom: 5px;
				    }

				    .item-col {
				      padding-top: 20px;
				      text-align: left;
				      vertical-align: top;
				    }

				    .force-width-gmail {
				      min-width:600px;
				      height: 0px !important;
				      line-height: 1px !important;
				      font-size: 1px !important;
				    }

				  </style>

				  <style type="text/css" media="screen">
				    @import url(http://fonts.googleapis.com/css?family=Oxygen:400,700);
				  </style>

				  <style type="text/css" media="screen">
				    @media screen {
				      /* Thanks Outlook 2013! */
				      * {
				        font-family: \'Oxygen\', \'Helvetica Neue\', \'Arial\', \'sans-serif\' !important;
				      }
				    }
				  </style>

				  <style type="text/css" media="only screen and (max-width: 480px)">
				    /* Mobile styles */
				    @media only screen and (max-width: 480px) {

				      table[class*="container-for-gmail-android"] {
				        min-width: 290px !important;
				        width: 100% !important;
				      }

				      img[class="force-width-gmail"] {
				        display: none !important;
				        width: 0 !important;
				        height: 0 !important;
				      }

				      table[class="w320"] {
				        width: 320px !important;
				      }

				      td[class*="mobile-header-padding-left"] {
				        width: 160px !important;
				        padding-left: 0 !important;
				      }

				      td[class*="mobile-header-padding-right"] {
				        width: 160px !important;
				        padding-right: 0 !important;
				      }

				      td[class="header-lg"] {
				        font-size: 24px !important;
				        padding-bottom: 5px !important;
				      }

				      td[class="content-padding"] {
				        padding: 5px 0 5px !important;
				      }

				       td[class="button"] {
				        padding: 5px 5px 30px !important;
				      }

				      td[class*="free-text"] {
				        padding: 10px 18px 30px !important;
				      }

				      td[class~="mobile-hide-img"] {
				        display: none !important;
				        height: 0 !important;
				        width: 0 !important;
				        line-height: 0 !important;
				      }

				      td[class~="item"] {
				        width: 140px !important;
				        vertical-align: top !important;
				      }

				      td[class~="quantity"] {
				        width: 50px !important;
				      }

				      td[class~="price"] {
				        width: 90px !important;
				      }

				      td[class="item-table"] {
				        padding: 30px 20px !important;
				      }

				      td[class="mini-container-left"],
				      td[class="mini-container-right"] {
				        padding: 0 15px 15px !important;
				        display: block !important;
				        width: 290px !important;
				      }

				    }
				  </style>
				</head>

				<body bgcolor="#f7f7f7">
				<table align="center" cellpadding="0" cellspacing="0" class="container-for-gmail-android" width="100%">
				  <tr>
				    <td align="left" valign="top" width="100%" style="background:repeat-x url(http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg) #ffffff;">
				      <center>
				      <img src="http://s3.amazonaws.com/swu-filepicker/SBb2fQPrQ5ezxmqUTgCr_transparent.png" class="force-width-gmail">
				        <table cellspacing="0" cellpadding="0" width="100%" bgcolor="#ffffff" background="http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg" style="background-color:transparent">
				          <tr>
				            <td width="100%" height="80" valign="top" style="text-align: center; vertical-align:middle;">
				            <!--[if gte mso 9]>
				            <v:rect xmlns:v="urn:schemas-microsoft-com:vml" fill="true" stroke="false" style="mso-width-percent:1000;height:80px; v-text-anchor:middle;">
				              <v:fill type="tile" src="http://s3.amazonaws.com/swu-filepicker/4E687TRe69Ld95IDWyEg_bg_top_02.jpg" color="#ffffff" />
				              <v:textbox inset="0,0,0,0">
				            <![endif]-->
				              <center>
				                <table cellpadding="0" cellspacing="0" width="600" class="w320">
				                  <tr>
				                    <td class="pull-left mobile-header-padding-left" style="vertical-align: middle;">
				                      <a href="https://dreamtour.co/"><img width="155" height="47" src="https://dreamtour.co/asset/odyssey/images/logo-pgateway.png"></a>
				                    </td>
				                    <td class="pull-right mobile-header-padding-right" style="color: #0e2c66;">
				                      <a href="https://www.instagram.com/dreamtour_co/" target="_blank" style="padding: 5px;"><img width="24" height="24" src="https://dreamtour.co/asset/odyssey/images/instagram.png"></a>
				                      <a href="https://twitter.com/dreamtour_co" target="_blank" style="padding: 5px;"><img width="24" height="24" src="https://dreamtour.co/asset/odyssey/images/twitter.png"></a>
				                      <a href="https://www.facebook.com/dreamtour.co/" target="_blank" style="padding: 5px;"><img width="24" height="24" src="https://dreamtour.co/asset/odyssey/images/facebook.png"></a>
				                    </td>
				                  </tr>
				                </table>
				              </center>
				              <!--[if gte mso 9]>
				              </v:textbox>
				            </v:rect>
				            <![endif]-->
				            </td>
				          </tr>
				        </table>
				      </center>
				    </td>
				  </tr>
				  <tr>
				    <td align="center" valign="top" width="100%" style="background-color: #f7f7f7;" class="content-padding">
				      <center>
				        <table cellspacing="0" cellpadding="0" width="600" class="w320">
				          <tr>
				            <td class="header-lg" style="color: #43d637; text-align: center;">
				              Terimakasih telah melakukan pembayaran
				            </td>
				          </tr>
				          <tr>
				            <td class="free-text">
				              Berikut adalah detail pembayaran yang anda buat di website <a href="https://dreamtour.co/" target="_blank">Dreamtour</a> untuk pemesanan <b>'.$nmpaketumroh.'</b> atas nama <b>'.$r->kontak.'</b>.<br><br>
				            </td>
				          </tr>
				          <tr>
				            <td class="w320">
				              <table cellpadding="0" cellspacing="0" width="100%">
				                <tr>
				                  <td colspan="2" style="padding: 0 15px 15px !important;">
				                    <table cellpadding="0" cellspacing="0" width="100%">
				                      <tr>
				                        <td class="mini-block-padding">
				                          <table cellspacing="0" cellpadding="0" width="100%" style="border-collapse:separate !important;">
				                            <tr>
				                              <td class="mini-block">
				                              	Pembayaran :<br>
				                              	<span class="header-sm">'.rupiah($r->paybill).'</span><br /><br />
				                                Bank :<br>
				                                <img src="'.base_url('asset/images/payment').'/'.$r->pay_channel.'.png"><br><br>
				                                Tanggal :<br>
				                              	<span class="header-sm">'.tanggal($r->tglpayment).'</span><br /><br />
				                              </td>
				                            </tr>
				                          </table>
				                        </td>
				                      </tr>
				                    </table>
				                  </td>
				                </tr>
				              </table>
				            </td>
				          </tr>
				        </table>
				      </center>
				    </td>
				  </tr>
				  <tr>
				    <td align="center" valign="top" width="100%" style="background-color: #ffffff;  border-top: 1px solid #e5e5e5; border-bottom: 1px solid #e5e5e5;">
				      <center>
				        <table cellpadding="0" cellspacing="0" width="600" class="w320">
				            <tr>
				              <td class="item-table">
					            <span class="header-sm">Detail Invoice '.$nmpaketumroh.' '.$r->kontak.'</span><hr>
					            <table cellspacing="0" cellpadding="0" width="100%">
				                  <tr>
				                    <td class="title-dark" width="300">
				                      Jamaah
				                    </td>
				                    <td class="title-dark" width="163">
				                      Room Type
				                    </td>
				                    <td class="title-dark" width="97">
				                      Harga
				                    </td>
				                  </tr>';

			foreach ($datalineitem->result() as $li) {
				$mcontent = $mcontent.'<tr>
				                    <td class="item-col item">
				                      <table cellspacing="0" cellpadding="0" width="100%">
				                        <tr>
				                          <td class="product">
				                            <span style="color: #4d4d4d; font-weight:bold;">'.$li->jamaah.'</span> <br />
				                            <!--Hot city looks-->
				                          </td>
				                        </tr>
				                      </table>
				                    </td>
				                    <td class="item-col quantity">
				                      '.roomtype($li->roomtype).'
				                    </td>
				                    <td class="item-col">
				                      '.rupiah($li->unitprice).'
				                    </td>
				                  </tr>';
			}

			$mcontent = $mcontent.'<tr>
				                    <td class="item-col item mobile-row-padding"></td>
				                    <td class="item-col quantity"></td>
				                    <td class="item-col price"></td>
				                  </tr>


				                  <tr>
				                    <td class="item-col item">
				                    </td>
				                    <td class="item-col quantity" style="text-align:right; padding-right: 10px; border-top: 1px solid #cccccc;">
				                      <span class="total-space">Total</span> <br />
				                      <span class="total-space">Terbayar</span>  <br />
				                      <span class="total-space" style="font-weight: bold; color: #4d4d4d">Sisa</span>
				                    </td>
				                    <td class="item-col price" style="text-align: left; border-top: 1px solid #cccccc;">
				                      <span class="total-space">'.rupiah($r->amount).'</span> <br />
				                      <span class="total-space">'.rupiah($terbayar).'</span>  <br />
				                      <span class="total-space" style="font-weight:bold; color: #4d4d4d">'.rupiah($r->amount-$terbayar).'</span>
				                    </td>
				                  </tr>  
				                </table>
				                <center>
				                <a href="https://dreamtour.co/invoice/'.$r->idinvoice.'"
				                style="background-color:#0e2c66;border-radius:5px;color:#ffffff;display:inline-block;font-family:\'Cabin\', Helvetica, Arial, sans-serif;font-size:14px;font-weight:regular;line-height:35px;text-align:center;text-decoration:none;width:120px;-webkit-text-size-adjust:none;mso-hide:all;">Online Invoice</a>
				                </center>
				              </td>
				            </tr>
				        </table>
				      </center>
				    </td>
				  </tr>
				  <tr>
				    <td valign="top" width="100%" style="background-color: #f7f7f7; height: 100px;">
				      <center>
				        <table cellspacing="0" cellpadding="0" width="600" class="w320">
				          <tr>
				            <td style="padding: 25px 0 25px">
				              <strong>Dream House</strong><br />
				              Jl. Matraman No. 7, Kebon Manggis, Matraman <br />
				              Jakarta Timur <br />
				              <b>(021) 2138 1090</b><br />
				              <b>info@dreamtour.co</b>
				            </td>
				          </tr>
				        </table>
				      </center>
				    </td>
				  </tr>
				</table>
				</div>
				</body>
				</html>';
		}

		//echo $mcontent;

		$result = $this->email
            ->from('iqbaluddin@dreamtour.co.id', 'Dreamtour Online Support')
            ->reply_to('iqbaluddin@dreamtour.co.id')    // Optional, an account where a human being reads.
            ->to($addaddr)
            ->cc('umrah@dreamtour.co')
            ->cc('encep.sunarya@dreamtour.co')
            ->subject($subject)
            ->message($mcontent)
            ->send();
		
		return $result;

		/*var_dump($result);
        echo '<br />';
        echo $this->email->print_debugger();
        
        echo !extension_loaded('openssl')?"Not Available":"Available";
        
        exit;*/
	}
}