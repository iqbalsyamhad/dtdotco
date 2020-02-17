<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_umroh extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Usermodel');
		$this->load->model('model_crud');
	}

	public function index()
	{
		$data['paketumroh'] = $this->db->query("select * from ol_paketumroh a join ol_pemberangkatan b on a.idpaketumroh = b.idpaketumroh where dari_tanggal > '".date('Y-m-d')."' group by a.idpaketumroh order by a.idpaketumroh desc");
		$this->load->view('web/book/umroh', $data);
	}

	public function paket($uri)
	{
		$geturi = explode("_", $uri);
		$idpaketumroh = $geturi[0];

		$data['dataumroh'] = $this->db->query("select * from ol_paketumroh where idpaketumroh = ".$idpaketumroh);
		$data['pemberangkatan'] = $this->db->query("select * from ol_pemberangkatan where idpaketumroh = ".$idpaketumroh." and dari_tanggal > '".date('Y-m-d')."' order by dari_tanggal asc");
		$this->load->view('web/book/umroh_detail', $data);
	}

	public function checkout($uri)
	{
		$geturi = explode("_", $uri);
		$idpaketumroh = $geturi[0];
		$idpemberangkatan = $geturi[1];

		$data['dataumroh'] = $this->db->query("select * from ol_paketumroh a join ol_pemberangkatan b on a.idpaketumroh = b.idpaketumroh where a.idpaketumroh = ".$idpaketumroh." and b.idpemberangkatan = ".$idpemberangkatan);
		$this->load->view('web/book/umroh_checkout', $data);
	}

	public function invoice($idinvoice)
	{
		//$params = array('server_key' => 'SB-Mid-server-EEV-ywGOxxFof-s8Y4eLPSrl', 'production' => false);
		//$this->load->library('veritrans');
		//$this->veritrans->config($params);

		$this->load->model('model_crud_server');

		$data['datainvoice'] = $this->db->query("select * from ol_invoice a join ol_paketumroh b on a.idpaketumroh = b.idpaketumroh join ol_pemberangkatan c on a.idpemberangkatan = c.idpemberangkatan where idinvoice = '".$idinvoice."'");
		$data['datalineitem'] = $this->db->query("select * from ol_invoice_lineitems where idinvoice = '".$idinvoice."'");
		$data['datapayment'] = $this->db->query("select * from ol_invoice_payment where idinvoice = '".$idinvoice."'");

		$payed = $this->db->query("select sum(paybill) as terbayar from ol_invoice_payment where idinvoice = '".$idinvoice."' and isApproved = 2");
		foreach ($payed->result() as $pay) {
			$data['amountpayed'] = $pay->terbayar;
		}
		$this->load->view('web/book/newumroh_invoice', $data);
	}

	public function pushinvoice(){
		$sliresult = 1;
		$data['idpaketumroh'] = $this->input->post('idpaketumroh');
		$data['idpemberangkatan'] = $this->input->post('idpemberangkatan');
		$data['kontak'] = $this->input->post('nmkontak');
		$data['email'] = $this->input->post('emailkontak');
		$data['nohp'] = $this->input->post('nohpkontak');
		$data['reference'] = tanggalsingkat($this->input->post('tgl_berangkat'));
		$data['tanggal'] = date('Y-m-d');
		$data['expired'] = $this->input->post('tgl_berangkat');
		$data['amount'] = $this->input->post('txgrandtotal');
		$data['idinvoice'] = $this->model_crud->newInv();

		$sinv = $this->model_crud->simpan('ol_invoice', $data);
		if($sinv){
			for($i = 0; $i < $this->input->post('qtyjamaah'); $i++){
				$li['idlineitem'] = $this->model_crud->newId('ol_invoice_lineitems','idlineitem');
				$li['idinvoice'] = $data['idinvoice'];
				$li['jamaah'] = $this->input->post('nmjamaah')[$i];
				$li['gender'] = $this->input->post('gender')[$i];
				$li['roomtype'] = $this->input->post('roomtype')[$i];
				$li['deskripsi'] = '';
				$li['unitprice'] = $this->input->post('upricejamaah')[$i];

				$sli = $this->model_crud->simpan('ol_invoice_lineitems', $li);
				if($sli){
					//
				}
				else{
					$sliresult = 0;
				}
			}

			$li['idlineitem'] = $this->model_crud->newId('ol_invoice_lineitems','idlineitem');
			$li['idinvoice'] = $data['idinvoice'];
			$li['jamaah'] = 'Perlengkapan '.$this->input->post('qtyjamaah').' Pc(s)';
			$li['gender'] = '';
			$li['roomtype'] = '-';
			$li['deskripsi'] = '';
			$li['unitprice'] = $this->input->post('hrgperlengkapan')*$this->input->post('qtyjamaah');

			$sli = $this->model_crud->simpan('ol_invoice_lineitems', $li);
			if($sli){
				//
			}
			else{
				$sliresult = 0;
			}
			
			if($sliresult == 1){
				$sendemail = $this->sendmail($data['idinvoice']);
				if($sendemail == true){
					$this->session->set_flashdata("peringatan","<div class='alert bg-success' role='alert'>
						Invoice telah dikirim ke email anda!
					</div>");
					redirect(base_url().'invoice/'.$data['idinvoice']);
				}
				else{
					$sentfail['kind'] = "INVOICE";
					$sentfail['idcontent'] = $data['idinvoice'];
					$this->model_crud->simpan('ol_failedmailsender', $sentfail);
					redirect(base_url().'invoice/'.$data['idinvoice']);
				}
			}
			else{
				redirect(base_url());
			}
		}
		else{
			redirect(base_url());
		}
	}

	public function sendmail($idinvoice){
		$datainvoice = $this->db->query("select * from ol_invoice a join ol_paketumroh b on a.idpaketumroh = b.idpaketumroh where idinvoice = '".$idinvoice."'");
		$datalineitem = $this->db->query("select * from ol_invoice_lineitems where idinvoice = '".$idinvoice."'");
		$terbayar = $this->model_crud->GetValue('ol_invoice_payment','sum(paybill)','idinvoice','"'.$idinvoice.'" and isApproved = 2');
		$addaddr = '';

		$this->load->library('email');
        
        $subject = 'Informasi Pemesanan Paket';

		foreach ($datainvoice->result() as $r) {
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
				      text-align: center;
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
				            <td class="header-lg" style="color: #0e2c66;">
				              Terimakasih telah memesan!
				            </td>
				          </tr>
				          <tr>
				            <td class="free-text">
				              Detail pesanan anda sudah kami simpan, segera lakukan pembayaran melalui invoice online Dreamtour. Customer Service kami akan menghubungi anda untuk tahap selanjutnya.
				            </td>
				          </tr>
				          <tr>
				            <td class="button">
				              <div><!--[if mso]>
				                <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="http://" style="height:45px;v-text-anchor:middle;width:155px;" arcsize="15%" strokecolor="#ffffff" fillcolor="#ff6f6f">
				                  <w:anchorlock/>
				                  <center style="color:#ffffff;font-family:Helvetica, Arial, sans-serif;font-size:14px;font-weight:regular;">My Account</center>
				                </v:roundrect>
				              <![endif]--><a href="https://dreamtour.co/invoice/'.$idinvoice.'"
				              style="background-color:#0e2c66;border-radius:5px;color:#ffffff;display:inline-block;font-family:\'Cabin\', Helvetica, Arial, sans-serif;font-size:14px;font-weight:regular;line-height:45px;text-align:center;text-decoration:none;width:155px;-webkit-text-size-adjust:none;mso-hide:all;">Invoice Online</a></div>
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
				                                <img src="http://admin.dreamtour.co/assets/images/gbrpaket/'.$r->imgpaketumroh.'" width="100%">
				                              </td>
				                            </tr>
				                          </table>
				                        </td>
				                      </tr>
				                    </table>
				                  </td>
				                </tr>
				                <tr>
				                  <td class="mini-container-left">
				                    <table cellpadding="0" cellspacing="0" width="100%">
				                      <tr>
				                        <td class="mini-block-padding">
				                          <table cellspacing="0" cellpadding="0" width="100%" style="border-collapse:separate !important;">
				                            <tr>
				                              <td class="mini-block">
				                                <span class="header-sm">'.$r->kontak.'</span><br /><br />
				                                '.$r->nohp.' <br />
				                                '.$r->email.' <br />
				                                '.tanggal($r->tanggal).'
				                              </td>
				                            </tr>
				                          </table>
				                        </td>
				                      </tr>
				                    </table>
				                  </td>
				                  <td class="mini-container-right">
				                    <table cellpadding="0" cellspacing="0" width="100%">
				                      <tr>
				                        <td class="mini-block-padding">
				                          <table cellspacing="0" cellpadding="0" width="100%" style="border-collapse:separate !important;">
				                            <tr>
				                              <td class="mini-block">
				                                <span class="header-sm">Invoice</span><br />
				                                '.$idinvoice.' <br />
				                                <br />
				                                <span class="header-sm">Pemberangkatan</span> <br />
				                                '.tanggal($r->expired).'
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
				                <a href="https://dreamtour.co/invoice/'.$idinvoice.'?aksi=bayar"
				                style="background-color:#0dc143;border-radius:5px;color:#ffffff;display:inline-block;font-family:\'Cabin\', Helvetica, Arial, sans-serif;font-size:14px;font-weight:regular;line-height:35px;text-align:center;text-decoration:none;width:120px;-webkit-text-size-adjust:none;mso-hide:all;">Bayar</a>
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

	public function getdetail($idpemberangkatan){
		$flashsale = false;
		$diskon = 0;
		if(date('Y-m-d') == '2019-12-07' && ($idpemberangkatan == 282 || $idpemberangkatan == 97 || $idpemberangkatan == 251 || $idpemberangkatan == 95)){
			$flashsale = true;
			$diskon = 5000000;
		}

		$data = $this->model_crud->selectData('ol_pemberangkatan','*','idpemberangkatan',$idpemberangkatan);
		foreach ($data->result() as $r) {
			$nmpaketumroh = $this->model_crud->GetValue('ol_paketumroh','nmpaketumroh','idpaketumroh',$r->idpaketumroh);
			if($r->avail_slot > 0){
                $bookbtn = '<a href="'.base_url('checkout/'.$r->idpaketumroh.'_'.$r->idpemberangkatan.'_'.str_replace(" ", "_", $nmpaketumroh)).'" class="btn btn-sm btn-success">Daftar</a> - '.$r->avail_slot.' Seat available';
            }
            else if($r->max_slot == 0){
                $bookbtn = '<button class="btn btn-sm btn-default">Seat belum dibuka</button>';
            }
            else{
                $bookbtn = '<button class="btn btn-sm btn-danger">Seat penuh</button>';
            }
            if($flashsale){
            	$hrgquad = '<span style="text-decoration: line-through;">'.rupiah($r->hrgquad).'</span> '.rupiah($r->hrgquad-$diskon);
            	$hrgtriple = '<span style="text-decoration: line-through;">'.rupiah($r->hrgtriple).'</span> '.rupiah($r->hrgtriple-$diskon);
            	$hrgdouble = '<span style="text-decoration: line-through;">'.rupiah($r->hrgdouble).'</span> '.rupiah($r->hrgdouble-$diskon);
            }
            else{
            	$hrgquad = rupiah($r->hrgquad);
            	$hrgtriple = rupiah($r->hrgtriple);
            	$hrgdouble = rupiah($r->hrgdouble);
            }
			echo '                <table width="100%">
                    <tr>
                        <td><b>Pemberangkatan</b></td>
                        <td>: '.tanggalsingkat($r->dari_tanggal).' - '.tanggalsingkat($r->sampai_tanggal).'</td>
                    </tr>
                    <tr>
                        <td><b>Harga Quad</b></td>
                        <td>: '.$hrgquad.'</td>
                    </tr>
                    <tr>
                        <td><b>Harga Triple</b></td>
                        <td>: '.$hrgtriple.'</td>
                    </tr>
                    <tr>
                        <td><b>Harga Double</b></td>
                        <td>: '.$hrgdouble.'</td>
                    </tr>
                    <tr>
                        <td colspan="2"><hr>'.$bookbtn.'</td>
                    </tr>
                </table>';
		}
	}

	public function jadwal(){
        $this->load->view('web/book/jadwalumroh');
    }
}