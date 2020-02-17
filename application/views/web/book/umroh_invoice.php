<?php
foreach ($datainvoice->result() as $r) {
  $f_date = new DateTime(); 
  $t_date = new DateTime($r->dari_tanggal);

  $perbedaan = $t_date->diff($f_date);
  if($perbedaan->m > 0)
    $harilagi = $perbedaan->m.' bulan '.$perbedaan->d;
  else
    $harilagi = $perbedaan->d;
?>
<!DOCTYPE html>
<html lang="zxx">

<!-- Head -->
<head>

<meta name="google-site-verification" content="4P29uSHs7fYMai_sqywTOk4-VNlphvMVZ7QGh_3az_0" />
    <meta name="google-site-verification" content="T9vHs-0GUdWhue22iFWg-C_eCfYEbOnyV43ZrMscbIE" />
<title>Invoice <?= $r->nmpaketumroh ?> | PT Dream Tours and Travel</title>
<link rel="shortcut icon" href="<?php echo base_url()?>asset/images/icon_dream.png">
    <meta charset="utf-8">
    <meta name="description" content="<?= $r->nmpaketumroh." ".strip_tags($r->overview) ?>">
    <link rel="alternate" hreflang="" href="http://www.dreamtour.co/" />
    <link rel="canonical" href="http://www.dreamtour.co/umroh/paket_umroh_exclsive" />
    <meta name="author" content="Dream Tour">
    <meta name="robots" content="index, follow" />
    <meta name="googlebot" content="index, follow" />
    <meta name="keywords" content="umroh, paket umroh, paket Umroh Murah, Paket Umroh Bintang 5, Umroh direct Madinnah, pt dream tour and travel, umroh vip, travel umroh jakarta, <?= $r->nmpaketumroh ?>" />
    <!-- Meta-Tags -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>

<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //Meta-Tags -->

<!-- Custom-Stylesheet-Links -->
<!-- Bootstrap-CSS -->    <link rel="stylesheet" href="<?php echo base_url()?>asset/odyssey/css/bootstrap.css" type="text/css" media="all">
<!-- Index-Page-CSS -->   <link rel="stylesheet" href="<?php echo base_url()?>asset/odyssey/css/style.css"         type="text/css" media="all">
<!-- Owl-Carousel-CSS --> <link rel="stylesheet" href="<?php echo base_url()?>asset/odyssey/css/owl.carousel.css"  type="text/css" media="all">
<!-- Date-Picker-CSS -->  <link rel="stylesheet" href="<?php echo base_url()?>asset/odyssey/css/jquery-ui.css"     type="text/css" media="all">
<!-- Chocolat-CSS -->     <link rel="stylesheet" href="<?php echo base_url()?>asset/odyssey/css/chocolat.css"      type="text/css" media="all">
<!-- //Custom-Stylesheet-Links -->

<!-- //Checkout style -->
    <link href="<?php echo base_url()?>asset/checkout/css/bootstrap-select.css" rel="stylesheet">
    <link href="<?php echo base_url()?>asset/checkout/css/wizard.css" rel="stylesheet">

<!-- midtrans -->
    <link rel="stylesheet" href="<?php echo base_url();?>asset/odyssey/css/jquery.fancybox.css">

    <script type="text/javascript"
            src="https://app.sandbox.midtrans.com/snap/snap.js"
            data-client-key="SB-Mid-client-qEOAMsuS73UHFdRt"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>-->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<!-- midtrans [2] -->
    <script type="text/javascript" src="https://api.sandbox.veritrans.co.id/v2/assets/js/veritrans.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>asset/odyssey/js/jquery.fancybox.pack.js"></script>

<!-- Fonts -->
<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Montserrat:400,700"     type="text/css" media="all">
<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:100,300,400,500" type="text/css" media="all">
<!-- //Fonts -->

<!-- Font-Awesome-File-Links -->
<!-- CSS --> <link rel="stylesheet" href="<?php echo base_url()?>asset/odyssey/css/font-awesome.css"      type="text/css" media="all">
<!-- TTF --> <link rel="stylesheet" href="<?php echo base_url()?>asset/odyssey/fonts/fontawesome-webfont.ttf" type="text/css" media="all">
<!-- //Font-Awesome-File-Links -->

<!-- Supportive-JavaScript -->
<script src="<?php echo base_url()?>asset/odyssey/js/modernizr.js"></script>
<!-- //Supportive-JavaScript -->
        
      <style type="text/css">
        .paychannel{
          background-color: #ffffff;
          padding: 10px 3px 10px 3px;
          
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
      </head>
<!-- //Head -->

<!-- Body -->
<body>

    <!-- Header -->
    <div class="agileheader hidden-xs" id="agileitshome">

        <!-- Navigation -->
        <div class="w3lsnavigation">
            <nav class="navbar navbar-default agilehovereffect wthreehovereffect">
                <div class="navbar-header navbar-left">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <div class="w3_navigation_pos">
                        <a href="<?php echo base_url()?>">
                            <img width="42%"; src="<?php echo base_url()?>asset/odyssey/images/logo-dt.png" alt="dreamtour, dreamtour jakarta, travel umroh terbaik">
                        </a>
                    </div>
                </div>

                <div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
                    <nav class="link-effect-2" id="link-effect-2">
                        <ul class="nav navbar-nav">
                            <li><a class="" href="<?php echo base_url()?>"><span>Home</span></a></li>
                            <li><a class="" href="<?php echo base_url()?>web/produk"><span>Produk</span></a></li>
                            <li><a class="" href="<?php echo base_url()?>umroh"><span>Umroh</span></a></li>
                            <li><a class="" href="<?php echo base_url()?>tour/wisata_tour"><span>Liburan</span></a></li>
                            <li><a target="_blank" class="" href="<?php echo base_url()?>sohibi"><span>Sohibi</span></a></li>
                            <li><a class="" href="<?php echo base_url()?>web/contact"><span>Kontak Kami</span></a></li>
                        </ul>
                    </nav>
                </div>
            </nav>
        </div>
        <!-- //Navigation -->
    </div>
    <!-- //Header -->

    <!-- Slider -->
    <img src="<?php echo base_url()?>asset/odyssey/images/back.jpg" height="200px" class="hidden-xs">
    <!-- //Slider -->
    <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog">
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
                <td>
                  <input type="number" id="txbillpay" class="form-control" placeholder="Hanya Angka..."><input type="hidden" id="txpaychannel"><input type="hidden" id="txidinvoice" value="<?= $r->idinvoice ?>">
                  <small>DP Minimal 10jt</small>
                </td>
              </tr>
              <tr>
                <td colspan="3"><hr></td>
              </tr>
              <tr>
                <td><h4>Bank</h4></td>
                <td><div class="paychannel" onclick="paychannelselected(402)"><img src="<?= base_url()?>asset/images/payment/402.png" class="imgpaychannel"><img src="<?= base_url()?>asset/images/payment/selected.png" id="imgpchannel402" style="display: none; width: 30px; float: right;"></div></td>
              </tr>
              <tr>
                <td></td>
                <td><div class="paychannel" onclick="paychannelselected(408)"><img src="<?= base_url()?>asset/images/payment/408.png" class="imgpaychannel"><img src="<?= base_url()?>asset/images/payment/selected.png" id="imgpchannel408" style="display: none; width: 30px; float: right;"></div></td>
              </tr>
              <tr>
                <td></td>
                <td><div class="paychannel" onclick="paychannelselected(702)"><img src="<?= base_url()?>asset/images/payment/702.png" class="imgpaychannel"><img src="<?= base_url()?>asset/images/payment/selected.png" id="imgpchannel702" style="display: none; width: 30px; float: right;"></div></td>
              </tr>
              <tr>
                <td></td>
                <td><div class="paychannel" onclick="paychannelselected(708)"><img src="<?= base_url()?>asset/images/payment/708.png" class="imgpaychannel"><img src="<?= base_url()?>asset/images/payment/selected.png" id="imgpchannel708" style="display: none; width: 30px; float: right;"></div></td>
              </tr>
              <tr>
                <td></td>
                <td><div class="paychannel" onclick="paychannelselected(800)"><img src="<?= base_url()?>asset/images/payment/800.png" class="imgpaychannel"><img src="<?= base_url()?>asset/images/payment/selected.png" id="imgpchannel800" style="display: none; width: 30px; float: right;"></div></td>
              </tr>
              <tr>
                <td></td>
                <td><div class="paychannel" onclick="paychannelselected(801)"><img src="<?= base_url()?>asset/images/payment/801.png" class="imgpaychannel"><img src="<?= base_url()?>asset/images/payment/selected.png" id="imgpchannel801" style="display: none; width: 30px; float: right;"></div></td>
              </tr>
              <tr>
                <td></td>
                <td><div class="paychannel" onclick="paychannelselected(802)"><img src="<?= base_url()?>asset/images/payment/802.png" class="imgpaychannel"><img src="<?= base_url()?>asset/images/payment/selected.png" id="imgpchannel802" style="display: none; width: 30px; float: right;"></div></td>
              </tr>
            </table>
          </div>
          <div class="modal-footer">
            <span id="txloading" style="display: none; color: #ffffff;">Loading...</span>
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
                <td><span id="paytxvanumber"></span></td>
              </tr>
            </table>
            <div class="panel panel-default">
              <div class="panel-heading"><i class="fa fa-info-circle"></i> Cara Bayar</div>
              <div class="panel-body" id="bodypayguide"></div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
          </div>
        </div>
      </div>
    </div>

    <div class="row"></div>
    <div class="container" style="margin-top: 10px; margin-bottom: 10px;">
      <div class="row">
        <!-- Checkout Form -->
        <div class="col-md-12">
          <div class="fuelux">
            <div class="wizard" data-initialize="wizard" id="checkoutWizard">
              <div class="steps-container">
                <ul class="steps">
                  <li data-step="1" class="active">
                    <a href="<?= base_url()?>">Home</a>
                    <span class="chevron"></span>
                  </li>
                </ul>
              </div>
              <div class="step-content">
                <div class="step-pane" data-step="1">
                  <table width="100%" style="background-color: #203d69;">
                      <tr>
                          <td width="80%"><span style="margin: 20px; color: #fff;">INVOICE <?= $r->idinvoice ?></span></td>
                          <td><img style="margin-top: 20px; margin-bottom: 20px;" src="<?php echo base_url()?>asset/odyssey/images/logo-dt.png" alt="dreamtour, dreamtour jakarta, travel umroh terbaik"></td>
                      </tr>
                  </table>
                  <br>
                  <div class="col-sm-6">
                      <table width="100%">
                        <tr>
                            <td style="width: 50%;"><b>Kepada</b></td>
                            <td><?= $r->kontak ?></td>
                        </tr>
                        <tr>
                            <td style="width: 50%;"><b>Nomor Invoice</b></td>
                            <td><?= $r->idinvoice ?></td>
                        </tr>
                        <tr>
                            <td style="width: 50%;"><b>Reference</b></td>
                            <td><?= $r->reference ?></td>
                        </tr>
                        <tr>
                            <td style="width: 50%;"><b>Tanggal Dibuat</b></td>
                            <td><?= tanggal($r->tanggal) ?></td>
                        </tr>
                        <tr>
                            <td style="width: 50%;"><b>Tanggal Berakhir</b></td>
                            <td><?= tanggal($r->dari_tanggal).' <i><small>('.$harilagi.' hari lagi)</small></i>' ?></td>
                        </tr>
                      </table>
                  </div>
                  <div class="col-sm-6 hidden-xs">
                      <table width="100%">
                        <tr>
                            <td style="width: 50%;"><b>Dari</b></td>
                            <td>PT. Dream Tours and Travel</td>
                        </tr>
                        <tr>
                            <td style="width: 50%;"></td>
                            <td>Jl. Matraman Raya nomor 7</td>
                        </tr>
                        <tr>
                            <td style="width: 50%;"></td>
                            <td>Jakarta Timur</td>
                        </tr>
                      </table>
                  </div>
                  <div class="clearfix"></div>
                  <br>
                  <table class="table">
                    <thead>
                      <tr>
                          <td><b>Jamaah</b></td>
                          <td><b>Tipe Kamar</b></td>
                          <td><b>Harga</b></td>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      foreach ($datalineitem->result() as $dli) {
                        echo '<tr>
                            <td>'.$dli->jamaah.'</td>
                            <td>'.roomtype($dli->roomtype).'</td>
                            <td width="40%">'.rupiah($dli->unitprice).'</td>
                        </tr>';
                      }
                      ?>
                      <tr>
                          <td colspan="2" class="text-right"><b>Total :<b></td>
                          <td><?= rupiah($r->amount) ?></td>
                      </tr>
                      <tr>
                          <td colspan="2" class="text-right"><b>Terbayar :<b></td>
                          <td><?= rupiah($amountpayed) ?> <!-- <a onclick="maubayar()" class="btn btn-sm btn-info">Pembayaran</a>

                            <form id="payment-form" method="post" action="snap/finish">
                              <input type="hidden" name="result_type" id="result-type" value=""></div>
                              <input type="hidden" name="result_data" id="result-data" value=""></div>
                            </form>
                            
                            <button id="pay-button">Pay!</button> -->

                            <div id="pembayaranbody"></div>
                          </td>
                      </tr>
                      <tr>
                          <td colspan="2" class="text-right"><b>Sisa :<b></td>
                          <td><b><?= rupiah($r->amount-$amountpayed) ?></b></td>
                      </tr>
                    </tbody>
                  </table>
                  <table class="table">
                    <thead>
                      <tr>
                        <td colspan="4"><b>Riwayat Pembayaran</b></td>
                      </tr>
                      <tr>
                        <td class="hidden-xs"><b>Tanggal</b></td>
                        <td><b>Nominal</b></td>
                        <td><b>Bank</b></td>
                        <td><b>Status</b></td>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      if($datapayment->num_rows() > 0){
                        foreach($datapayment->result() as $payed){
                          echo '<tr>
                            <td class="hidden-xs">'.tanggal($payed->tanggal).'</td>
                            <td>'.rupiah($payed->paybill).'</td>
                            <td><img src="'.base_url().'asset/images/payment/'.$payed->pay_channel.'.png" style="width: 80px;"></td>
                            <td><div id="bodystspay'.$payed->idpayment.'"><button type="button" class="btn btn-sm btn-info" onclick="payinfo(\''.$payed->idpayment.'\',\''.$payed->paybill.'\',\''.$payed->pay_channel.'\',\''.$payed->vanumber.'\')"><i class="fa fa-circle-o-notch"></i> Bayar</button></div></td>
                          </tr>';
                        }
                      }
                      else{
                        echo '<tr>
                          <td colspan="4" class="text-center">Belum ada transaksi!</td>
                        </tr>';
                      }
                      ?>
                      <tr>
                        <td colspan="4" class="text-center"><button type="button" class="btn btn-primary btn-mini" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus-square"></i> Tambah Pembayaran</button></td>
                      </tr>
                    </tbody>
                  </table>

                </div>
                <div class="step-pane" data-step="4">
                  <div class="alert alert-success text-center" role="alert">
                    <h4>Thank You For Your Order !</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deleniti optio voluptatum obcaecati inventore nobis, odit minima sunt odio amet suscipit!</p>
                    <p class="m-t-2"><a href="index.html" class="btn btn-theme"><i class="fa fa-home"></i> Back to Home</a></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


    <!-- Footer -->
    <div class="agilefooterwthree" id="agilefooterwthree">
        <div class="container">

            <div class="agilefooterwthree-grids">
                <div class="col-md-4 agilefooterwthree-grid agilefooterwthree-grid1">
                    <h4>Kantor Pusat</h4>
                    <ul>
                       <li>Dream House</li>
                       <li>Jalan Matraman No 7</li>
                       <li>Kebon Manggis, Matraman </li>
                       <li>Jakarta Timur</li>
                       <li>(021) 21381090, (021) 21381091, 08119333000</li>
                       <li><a class="mail" href="mailto:mail@example.com">info@dreamtour.co</a></li>
                    </ul>
                </div>
                <div class="col-md-4 agilefooterwthree-grid agilefooterwthree-grid2">
                    <h4>Dream Tour Surabaya</h4>
                    <address>
                        <ul>
                           <li>Gedung Intiland Surabaya</li>
                        <li>1st Floor, Suite 12</li>
                        <li>Jl. Panglima Sudirman 101-103</li>
                        <li>Surabaya, Jawa Timur</li>
                        <li>031 5359666,031 5359555, 08113307330 </li>
                        <li><a class="mail" href="mailto:surabaya@dreamtour.co">surabaya@dreamtour.co</a></li>
                        </ul>
                    </address>
                </div>
                <div class="col-md-4 agilefooterwthree-grid agilefooterwthree-grid3">
                    <h4>Dream Tour Bandung</h4>
                    <address>
                        <ul>
                        <li>Dream Tour Bandung</li>
                        <li>Jalan Lengkong Kecil No 2</li>
                        <li>Paledang, Lengkong/li>
                        <li>Kota Bandung, Jawa Barat</li>
                        <li>022 20546868, 022 20542442</li>
                        <li><a class="mail" href="mailto:surabaya@dreamtour.co">bandung@dreamtour.co.id</a></li>
                        </ul>
                    </address>
                    
                </div>
                <div class="clearfix"></div>
            </div>

        </div>

    </div>
    <!-- //Footer -->



    <!-- Copyright -->
    <div class="copyright">
        <p>© 2018 <a href="www.dremtour.co">PT. Dream Tours & Travel</a>. All Rights Reserved </p>
    </div>
    <!-- //Copyright -->
    <!-- Checkout JavaScript -->
    <script src="<?php echo base_url()?>asset/checkout/js/bootstrap-select.js"></script>
    <script src="<?php echo base_url()?>asset/checkout/js/wizard.js"></script>

<!-- Responsive-Slider-JavaScript -->
            <script src="<?php echo base_url()?>asset/odyssey/js/responsiveslides.min.js"></script>
            <script>

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
                  }
                }

                function payinfo(idpayment, paybill, pay_channel, vanumber){
                  $('#paytxpaybill').html(': '+formatMoney(paybill));
                  $('#paytxpaychannel').html(': <img src="<?= base_url()?>asset/images/payment/'+pay_channel+'.png" style="width: 120px;">');
                  $('#paytxvanumber').html(': '+vanumber);
                  $('#payModal').modal('show');

                  $('#bodypayguide').html('Loading...');
                  $.ajax({
                    url: '<?= base_url()?>book/payment/getPaymentGuide/'+pay_channel,
                    success: function(resultdata) {
                      $('#bodypayguide').html(resultdata);
                    }
                  });
                }
  
                $('#pay-button').click(function (event) {
                  event.preventDefault();
                  $(this).attr("disabled", "disabled");
                
                  $.ajax({
                    url: '<?= base_url()?>book/c_umroh/tessnap', //calling this function
                    cache: false,
                    success: function(data) {
                      //location = data;
                      console.log('token = '+data);
                      
                      var resultType = document.getElementById('result-type');
                      var resultData = document.getElementById('result-data');
                      function changeResult(type,data){
                        $("#result-type").val(type);
                        $("#result-data").val(JSON.stringify(data));
                        //resultType.innerHTML = type;
                        //resultData.innerHTML = JSON.stringify(data);
                      }
                      snap.pay(data, {
                        
                        onSuccess: function(result){
                          changeResult('success', result);
                          console.log(result.status_message);
                          console.log(result);
                          $("#payment-form").submit();
                        },
                        onPending: function(result){
                          changeResult('pending', result);
                          console.log(result.status_message);
                          $("#payment-form").submit();
                        },
                        onError: function(result){
                          changeResult('error', result);
                          console.log(result.status_message);
                          $("#payment-form").submit();
                        }
                      });
                    }
                  });
                });

                function maubayar(){
                    var rtrans = '<br><small><ul><?php foreach($datapayment->result() as $payed){
                        echo '<li>Pembayaran '.rupiah($payed->paybill).' pada '.tanggal($payed->tanggal).' | '.$payed->redirect.$payed->isApproved.'</li>';
                      }
                      ?></ul></small>';
                    $('#pembayaranbody').html(rtrans+'<hr><form action="<?php echo site_url()?>book/c_umroh/reqpayment" method="POST" id="payment-form"><input type="text" name="amounttopay" class="form-control" placeholder="Nominal pembayaran..."><input type="hidden" name="idinvoice" value="<?= $r->idinvoice ?>"><i><small>Untuk pembayaran dengan pemberangkatan H-30 adalah 50% total biaya</small></i><br><button type="submit" class="btn btn-sm btn-success">Bayar</button></form>');
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

                $(function () {
                    $("#slider").responsiveSlides({
                        auto: true,
                        nav: true,
                        speed: 2000,
                        namespace: "callbacks",
                        pager: true,
                    });
                });
            </script>
        <!-- //Responsive-Slider-JavaScript -->
        

        <!-- Review-Slider-JavaScript -->
            <script src="<?php echo base_url()?>asset/odyssey/js/main.js"></script>
        <!-- //Review-Slider-JavaScript -->

        <!-- Tour-Locations-JavaScript -->
            <script src="<?php echo base_url()?>asset/odyssey/js/classie.js"></script>
            <script src="<?php echo base_url()?>asset/odyssey/js/helper.js"></script>
            <script src="<?php echo base_url()?>asset/odyssey/js/grid3d.js"></script>
            <script>
                new grid3D( document.getElementById( 'grid3d' ) );
            </script>
        <!-- //Tour-Locations-JavaScript -->

        <!-- Owl-Carousel-JavaScript -->
            <script src="<?php echo base_url()?>asset/odyssey/js/owl.carousel.js"></script>
            <script>
                $(document).ready(function() {
                    $("#owl-demo, #owl-demo1, #owl-demo2, #owl-demo3, #owl-demo4").owlCarousel({
                        autoPlay: 4000,
                        items : 3,
                        itemsDesktop : [568,2],
                        itemsDesktopSmall : [414,1]
                    });
                });
            </script>
        <!-- //Owl-Carousel-JavaScript -->

        <!-- Pricing-Popup-Box-JavaScript -->
            <script src="<?php echo base_url()?>asset/odyssey/js/jquery.magnific-popup.js" type="text/javascript"></script>
            <script>
                $(document).ready(function() {
                    $('.popup-with-zoom-anim').magnificPopup({
                        type: 'inline',
                        fixedContentPos: false,
                        fixedBgPos: true,
                        overflowY: 'auto',
                        closeBtnInside: true,
                        preloader: false,
                        midClick: true,
                        removalDelay: 300,
                        mainClass: 'my-mfp-zoom-in'
                    });
                });
            </script>
        <!-- //Pricing-Popup-Box-JavaScript -->

        <!-- Date-Picker-JavaScript -->
            <script src="<?php echo base_url()?>asset/odyssey/js/jquery-ui.js"></script>
            <script>
                $(function() {
                    $( "#datepicker,#datepicker1,#datepicker2" ).datepicker();
                });
            </script>
        <!-- //Date-Picker-JavaScript -->

        <!-- Portfolio-Popup-Box-JavaScript -->
            <script src="<?php echo base_url()?>asset/odyssey/js/jquery.chocolat.js"></script>
            <script type="text/javascript">
                $(function() {
                    $('.w3portfolioaits-item a').Chocolat();
                });
            </script>
        <!-- //Portfolio-Popup-Box-JavaScript -->

        <!-- Smooth-Scrolling-JavaScript -->
            <script type="text/javascript">
                jQuery(document).ready(function($) {
                    $(".scroll").click(function(event){
                        event.preventDefault();
                        $('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
                    });
                });
            </script>
        <!-- //Smooth-Scrolling-JavaScript -->

        <!-- Slide-To-Top JavaScript -->
            <script type="text/javascript">
                $(document).ready(function() {
                    var defaults = {
                        containerID: 'toTop',
                        containerHoverID: 'toTopHover',
                        scrollSpeed: 100,
                        easingType: 'linear',
                    };
                });
            </script>
            <a href="#agileitshome" id="toTop" class="stuoyal3w scroll stieliga" style="display: block;"> <span id="toTopHover" style="opacity: 0;"> </span></a>
        <!-- //Slide-To-Top JavaScript -->

    <!-- //Custom-JavaScript-File-Links -->

</body>
<!-- //Body -->
    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
        var $_Tawk_API={},$_Tawk_LoadStart=new Date();
        (function(){
        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src='https://embed.tawk.to/54f6c518bd5fa428704c793c/default';
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);
        })();
    </script>
    <!--End of Tawk.to Script-->
<script type="text/javascript">
    (function () {
        var options = {
            whatsapp: "628119333000", // WhatsApp number
            call: "02121381090", // Call phone number
            company_logo_url: "//static.whatshelp.io/img/flag.png", // URL of company logo (png, jpg, gif)
            greeting_message: "Assalammu'alaikum. Ada yang bisa kami bantu? Silahkan klik icon WhatsApp untuk mengirim pesan dan icon Telepon untuk menghubungi kami...", // Text of greeting message
            call_to_action: "Kontak Kami Sekarang", // Call to action
            button_color: "#45aa40", // Color of button
            position: "left", // Position may be 'right' or 'left'
            order: "whatsapp,call" // Order of buttons
        };
        var proto = document.location.protocol, host = "whatshelp.io", url = proto + "//static." + host;
        var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = url + '/widget-send-button/js/init.js';
        s.onload = function () { WhWidgetSendButton.init(host, proto, options); };
        var x = document.getElementsByTagName('script')[0]; x.parentNode.insertBefore(s, x);
    })();
</script>

</html>
<?php } ?>