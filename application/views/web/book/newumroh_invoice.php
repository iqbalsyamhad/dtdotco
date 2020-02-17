<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
foreach ($datainvoice->result() as $r) {
  $f_date = new DateTime(); 
  $t_date = new DateTime($r->dari_tanggal);

  $perbedaan = $t_date->diff($f_date);
  if($perbedaan->m > 0)
    $harilagi = $perbedaan->m.' bulan '.$perbedaan->d;
  else
    $harilagi = $perbedaan->d;

  if($r->idpembadmin != 0 && $r->isMigrated == 0){
    $this->model_crud_server->sendtoseries($r->idinvoice);
  }
?>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Invoice <?= $r->nmpaketumroh ?> | PT Dream Tours and Travel</title>

  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

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
      /*text-align: center;*/
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
      padding: 10px 0 5px;
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

    .paychannel{
      background-color: #ffffff;
      padding: 5px 3px 5px 3px;
      
      border-radius: 5px;
      /*border-color: solid 5px #3a87ad;*/
      cursor: pointer;
      margin-bottom: 4px;
      box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.2), 0 2px 3px 0 rgba(0, 0, 0, 0.19);
    }
    .imgpaychannel{
      width: 150px;
    }

  </style>

  <style type="text/css" media="screen">
    @import url(http://fonts.googleapis.com/css?family=Oxygen:400,700);
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
        width: 90% !important;
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
        width: 100% !important;
      }

    }
  </style>
</head>

<body bgcolor="#f7f7f7">
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Pembayaran</h4>
      </div>
      <div class="modal-body" style="background-color: #ffffff;">
        <table width="100%">
          <tr>
            <td><h4>Nominal</h4></td>
            <td><input type="number" id="txbillpay" class="form-control" placeholder="Hanya Angka..."><input type="hidden" id="txpaychannel"><input type="hidden" id="txidinvoice" value="<?= $r->idinvoice ?>"><small>DP Minimal 10jt</small></td>
          </tr>
          <tr>
            <td colspan="3"><hr></td>
          </tr>
          <tr>
            <td><h4>Bank</h4></td>
            <td><div class="paychannel" onclick="paychannelselected(802)"><img src="<?= base_url()?>asset/images/payment/selected.png" id="imgpchannel802" style="display: none; width: 30px; float: left;"><img src="<?= base_url()?>asset/images/payment/802.png" class="imgpaychannel"></div></td>
          </tr>
          <!--<tr>
            <td></td>
            <td><div class="paychannel" onclick="paychannelselected(702)"><img src="base_url()asset/images/payment/selected.png" id="imgpchannel702" style="display: none; width: 30px; float: left;"><img src="base_url()asset/images/payment/702.png" class="imgpaychannel"></div></td>
          </tr>-->
          <tr>
            <td></td>
            <td><div class="paychannel" onclick="paychannelselected(801)"><img src="<?= base_url()?>asset/images/payment/selected.png" id="imgpchannel801" style="display: none; width: 30px; float: left;"><img src="<?= base_url()?>asset/images/payment/801.png" class="imgpaychannel"></div></td>
          </tr>
          <!--<tr>
            <td></td>
            <td><div class="paychannel" onclick="paychannelselected(800)"><img src="base_url()asset/images/payment/selected.png" id="imgpchannel800" style="display: none; width: 30px; float: left;"><img src="base_url()asset/images/payment/800.png" class="imgpaychannel"></div></td>
          </tr>-->
          <tr>
            <td></td>
            <td><div class="paychannel" onclick="paychannelselected(402)"><img src="<?= base_url()?>asset/images/payment/selected.png" id="imgpchannel402" style="display: none; width: 30px; float: left;"><img src="<?= base_url()?>asset/images/payment/402.png" class="imgpaychannel"></div></td>
          </tr>
          <tr>
            <td></td>
            <td><div class="paychannel" onclick="paychannelselected(408)"><img src="<?= base_url()?>asset/images/payment/selected.png" id="imgpchannel408" style="display: none; width: 30px; float: left;"><img src="<?= base_url()?>asset/images/payment/408.png" class="imgpaychannel"></div></td>
          </tr>
        </table>
      </div>
      <div class="modal-footer">
        <span id="txloading" style="display: none;">Loading...</span>
        <!--<button type="button" id="btinquiry" class="btn btn-warning" onclick="inquiry()">Inq</button>-->
        <button type="button" id="btsimpan" class="btn btn-success" onclick="pushpayment()">Proses</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
      </div>
    </div>
  </div>
</div>

<div id="payModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Pembayaran</h4>
      </div>
      <div class="modal-body" style="background-color: #ffffff;">
        <table width="100%" class="table">
          <tr>
            <td>Nominal</td>
            <td><span id="paytxpaybill"></span></td>
          </tr>
          <tr>
            <td>Bank</td>
            <td><span id="paytxpaychannel"></span></td>
          </tr>
          <tr>
            <td>VA Number</td>
            <td><b>: <span id="paytxvanumber"></span></b></td>
          </tr>
        </table>
        <div class="panel panel-default">
          <div class="panel-heading"><i class="fa fa-info-circle"></i> Cara Bayar</div>
          <div class="panel-body" id="bodypayguide"></div>
        </div>
      </div>
      <div class="modal-footer">
      	<span id="cancelloading" style="display: none;">Loading...</span>
        <button type="button" id="cancelbtn" class="btn btn-danger" onclick="cancelpayment()">Batalkan Pembayaran</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>
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
        <table cellspacing="0" cellpadding="0" width="600" class="w320" style="margin-top: -30px;">
          <tr>
            <td class="header-md text-center" style="color: #0e2c66;">
              <?php echo $this->session->flashdata("peringatan"); ?>
              Customer Invoice
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
                                <img src="http://admin.dreamtour.co/assets/images/gbrpaket/<?= $r->imgpaketumroh ?>" width="100%">
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
                                <span class="header-sm"><?= $r->kontak ?></span><br /><br />
                                <?= $r->nohp ?> <br />
                                <?= $r->email ?> <br />
                                <?= tanggal($r->tanggal) ?>
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
                                <?= $r->idinvoice ?> <br />
                                <br />
                                <span class="header-sm">Pemberangkatan</span> <br />
                                <?= tanggal($r->expired) ?>
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
                  </tr>
<?php
foreach ($datalineitem->result() as $li) {
?>
                  <tr>
                    <td class="item-col item">
                      <table cellspacing="0" cellpadding="0" width="100%">
                        <tr>
                          <td class="product">
                            <span style="color: #4d4d4d; font-weight:bold;"><?= $li->jamaah ?></span> <br />
                            <!--Hot city looks-->
                          </td>
                        </tr>
                      </table>
                    </td>
                    <td class="item-col quantity">
                      <?= roomtype($li->roomtype) ?>
                    </td>
                    <td class="item-col">
                      <?= rupiah($li->unitprice) ?>
                    </td>
                  </tr>
<?php } ?>
                  <tr>
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
                      <span class="total-space"><?= rupiah($r->amount) ?></span> <br />
                      <span class="total-space"><?= rupiah($amountpayed) ?></span>  <br />
                      <span class="total-space" style="font-weight:bold; color: #4d4d4d"><?= rupiah($r->amount-$amountpayed) ?></span>
                    </td>
                  </tr>  
                </table>
                <hr>
                <h4>Riwayat Pembayaran</h4>
              </td>
            </tr>
            <tr>
              <td class="item-table">
                <table cellspacing="0" cellpadding="0" width="100%" style="margin-top: -50px;">
                  <tr>
                    <td class="title-dark" width="300">
                      Pembayaran
                    </td>
                    <td class="title-dark" width="163">
                      Bank
                    </td>
                    <td class="title-dark" width="97">
                      Status
                    </td>
                  </tr>
<?php
foreach ($datapayment->result() as $payed) {
                  echo '<tr>
                    <td class="item-col item">
                      <table cellspacing="0" cellpadding="0" width="100%">
                        <tr>
                          <td class="product">
                            <span style="color: #4d4d4d; font-weight:bold;">'.rupiah($payed->paybill).'</span> <br />
                            '.tanggal($payed->tanggal).'
                          </td>
                        </tr>
                      </table>
                    </td>
                    <td class="item-col quantity">
                      <img src="'.base_url().'asset/images/payment/'.$payed->pay_channel.'.png" style="width: 80px;">
                    </td>
                    <td class="item-col">';
                    if($payed->isApproved == 2){
                    	echo '<label class="label label-success">Pembeyaran Diterima</span>';
                    }
                    elseif($payed->isApproved == 0 or $payed->isApproved == 1){
                    	echo '<div id="bodystspay'.$payed->idpayment.'"><button type="button" class="btn btn-sm btn-info" onclick="payinfo(\''.$payed->idpayment.'\',\''.$payed->paybill.'\',\''.$payed->pay_channel.'\',\''.$payed->vanumber.'\')">Bayar</button> <span style="cursor: pointer;" id="getstatbtn'.$payed->idpayment.'" onclick="getstatuspayment(\''.$payed->idpayment.'\')"><i class="fa fa-refresh"></i></span><span id="getstatloading'.$payed->idpayment.'" style="display: none;">Loading...</span></div>';
                    }
                    elseif($payed->isApproved == 8){
                    	echo '<label class="label label-danger">Dibatalkan</span>';
                    }
                    else{
                    	if($payed->isApproved == 3)
				            $statuspaygatewayview = 'Pembayaran Gagal';
				        elseif($payed->isApproved == 4)
				            $statuspaygatewayview = 'Payment Reversal';
				        elseif($payed->isApproved == 5)
				            $statuspaygatewayview = 'Tagihan tidak ditemukan';
				        elseif($payed->isApproved == 7)
				            $statuspaygatewayview = 'Pembayaran Kadaluarsa';
				        else
				            $statuspaygatewayview = 'Status pembayaran tidak diketahui';

                    	echo '<label class="label label-default">'.$statuspaygatewayview.'</span>';
                    }
                    echo '</td>
                  </tr>';
} ?>
                </table>
                <br>
                <center>
                  <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus-square"></i> Tambah Pembayaran</button>
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
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script>
  $(document).ready(function(){
    //
    <?php
    if(isset($_GET['aksi'])){
      if($_GET['aksi'] == 'bayar'){
        echo '$(\'#myModal\').modal(\'show\');';
      }
    }
    if(isset($_GET['payid'])){
  		$gdata = $this->model_crud->ambilData('ol_invoice_payment', '*', 'idpayment = "'.$_GET['payid'].'"');
  		foreach ($gdata as $rdata) {
  			echo 'payinfo(\''.$_GET['payid'].'\', \''.$rdata->paybill.'\', \''.$rdata->pay_channel.'\', \''.$rdata->vanumber.'\');';
  		}
      if(isset($_GET['mail'])){
        echo '$.ajax({
          url: \''.base_url().'book/payment/sendpaymentmail/'.$_GET['payid'].'\',
          success: function(result) {
          }
        });';
      }
    }
    ?>
  });

  function paychannelselected(id){
      kosongkanpchannel();
      $('#imgpchannel'+id).show();
      $('#txpaychannel').val(id);
  }

  function kosongkanpchannel(){
      $('#imgpchannel402').hide();
      $('#imgpchannel408').hide();
      $('#imgpchannel702').hide();
      $('#imgpchannel708').hide();
      $('#imgpchannel800').hide();
      $('#imgpchannel801').hide();
      $('#imgpchannel802').hide();
  }

  function pushpayment(){
    if($('#txbillpay').val() == ''){
      alert("Isi Nominal Pembayaran!");
    }
    else if($('#txpaychannel').val() == ''){
      alert("Pilih Bank Pembayaran!");
    }
    else{
      $('#btsimpan').hide();
      $('#txloading').show();

      $.ajax({
        url: '<?= base_url()?>book/payment/reqpayments/'+$('#txpaychannel').val()+'/<?= $this->uri->segment(2)?>/'+$('#txbillpay').val(),
        success: function(resultdata) {
          $('#btsimpan').show();
          $('#txloading').hide();

          if(resultdata == 2){
            alert('Gagal mengirim data!');
          }
          else if(resultdata == 0){
            alert('Gagal menyimpan data!');
          }
          else if(resultdata == 3){
            alert('Data invoice tidak ditemukan, kontak admin!');
          }
          else{
            window.location.replace("<?= base_url('invoice/'.$this->uri->segment(2))?>?payid="+resultdata+"&mail=true");
          }
        }
      });
    }
  }

  function payinfo(idpayment, paybill, pay_channel, vanumber){
    $('#paytxpaybill').html(': '+formatMoney(paybill));
    $('#paytxpaychannel').html(': <img src="<?= base_url()?>asset/images/payment/'+pay_channel+'.png" style="width: 120px;">');
    $('#paytxvanumber').html(vanumber);
    $('#payModal').modal('show');

    $('#bodypayguide').html('Loading...');
    $.ajax({
      url: '<?= base_url()?>book/payment/getPaymentGuide/'+pay_channel,
      success: function(resultdata) {
        $('#bodypayguide').html(resultdata);
      }
    });
  }

  function getstatuspayment(idpayment){
  	$('#getstatbtn'+idpayment).hide();
  	$('#getstatloading'+idpayment).show();
  	$.ajax({
      url: '<?= base_url()?>book/payment/reqpaymentdata/'+idpayment,
      success: function(resultdata) {
      	if(resultdata == 1){
      		window.location.replace("<?= base_url('invoice')?>/"+$('#txidinvoice').val());
      	}
      	else{
      		alert(resultdata);
      	}
      }
    });
  }

  function cancelpayment(){
  	$('#cancelbtn').hide();
  	$('#cancelloading').show();

  	$.ajax({
      url: '<?= base_url()?>book/payment/canceltrx/'+$('#paytxvanumber').html(),
      success: function(resultdata) {
      	if(resultdata == 1){
      		window.location.replace("<?= base_url('invoice')?>/"+$('#txidinvoice').val());
      	}
      	else{
      		alert(resultdata);
      	}
      }
    });
  }

  function inquiry(){
    $.ajax({
      url: '<?= base_url()?>book/payment/inquiryfaspay2',
      success: function(resultdata) {
        alert(resultdata);
      }
    });
  }

  function formatMoney(n, c, d, t) {
      var c = isNaN(c = Math.abs(c)) ? 2 : c,
      d = d == undefined ? "," : d,
      t = t == undefined ? "." : t,
      s = n < 0 ? "-" : "",
      i = String(parseInt(n = Math.abs(Number(n) || 0).toFixed(c))),
      j = (j = i.length) > 3 ? j % 3 : 0;

      return "Rp" + s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + ",-";
  };
</script>

<?php
}
?>
</html>