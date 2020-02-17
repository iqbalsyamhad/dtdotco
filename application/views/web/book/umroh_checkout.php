<?php
foreach ($dataumroh->result() as $r) {
$flashsale = false;
if(date('Y-m-d') == '2019-12-07' && ($r->idpemberangkatan == 282 || $r->idpemberangkatan == 97 || $r->idpemberangkatan == 251 || $r->idpemberangkatan == 95)){
      $flashsale = true;
      $diskon = 5000000;
      $newhrgquad = $r->hrgquad-$diskon;
      $newhrgtriple = $r->hrgtriple-$diskon;
      $newhrgdouble = $r->hrgdouble-$diskon;
}
else{
      $diskon = 0;
      $newhrgquad = $r->hrgquad;
      $newhrgtriple = $r->hrgtriple;
      $newhrgdouble = $r->hrgdouble;
}
?>
<!DOCTYPE html>
<html lang="zxx">

<!-- Head -->
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<meta name="google-site-verification" content="4P29uSHs7fYMai_sqywTOk4-VNlphvMVZ7QGh_3az_0" />
    <meta name="google-site-verification" content="T9vHs-0GUdWhue22iFWg-C_eCfYEbOnyV43ZrMscbIE" />
<title>Checkout <?= $r->nmpaketumroh ?> | PT Dream Tours and Travel</title>
<link rel="shortcut icon" href="<?php echo base_url()?>asset/images/icon_dream.png">
    
    <meta name="description" content="<?= $r->nmpaketumroh." ".strip_tags($r->overview) ?>">
    <link rel="alternate" hreflang="" href="http://www.dreamtour.co/" />
    <link rel="canonical" href="http://www.dreamtour.co/umroh/paket_umroh_exclsive" />
    <meta name="author" content="Dream Tour">
    <meta name="robots" content="index, follow" />
    <meta name="googlebot" content="index, follow" />
    <meta name="keywords" content="umroh, paket umroh, paket Umroh Murah, Paket Umroh Bintang 5, Umroh direct Madinnah, pt dream tour and travel, umroh vip, travel umroh jakarta, <?= $r->nmpaketumroh ?>" />
    <!-- Meta-Tags -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

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
    background-color: #eef7fb;
    /*padding: 10px;
    border-radius: 10px;
    border-color: solid 5px #3a87ad;*/
    cursor: pointer;
  }
</style>
        
      </head>
<!-- //Head -->

<!-- Body -->
<body>

    <!-- Header -->
    <div class="agileheader" id="agileitshome">

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
<img src="<?php echo base_url()?>asset/odyssey/images/back.jpg" height="200px">
    <!-- //Slider -->
    <div class="row"></div>
    <div class="container" style="margin-top: 10px; margin-bottom: 10px;">
      <div class="row">
        <!-- Checkout Form -->
        <div class="col-md-12">
          <div class="fuelux">
            <div class="wizard" data-initialize="wizard" id="checkoutWizard">
              <div class="steps-container">
                <ul class="steps">
                  <li data-step="1" class="active" id="btstep1">
                    <span class="badge">1</span>Paket
                    <span class="chevron"></span>
                  </li>
                  <li data-step="3">
                    <span class="badge">2</span>Konfirmasi
                    <span class="chevron"></span>
                  </li>
                  <li data-step="4">
                    <span class="badge">3</span>Selesai
                    <span class="chevron"></span>
                  </li>
                </ul>
              </div>
              <form method="post" id="frbooking" action="<?php echo base_url()?>book/c_umroh/pushinvoice">
              <div class="step-content">
                <div class="step-pane active" data-step="1">
                  <h4 style="text-align: left;">Detail Paket Umroh</h4>
                  <hr>
                  <div class="row">
                      <div class="col-md-6">
                          <font size="4"><?= $r->nmpaketumroh ?></font> <a href="<?php echo base_url()?>paketumroh/<?= $r->idpaketumroh."_".str_replace(" ", "_", $r->nmpaketumroh) ?>" target="_blank">[Lihat Detail]</a>
                      </div>
                      <div class="col-md-6 hidden-xs hidden-sm" style="text-align: right;">
                          <b><font size="4"><?= rupiah($r->hrgquad).' ~ '.rupiah($r->hrgdouble) ?></font></b>
                      </div>
                  </div>
                  <br><br>
                  <div class="form-group col-sm-6">
                    <label>Nama Kontak (*)</label>
                    <input type="text" class="form-control" name="nmkontak" id="srckontak">
                    <input type="hidden" class="form-control" name="tgl_berangkat" value="<?= $r->dari_tanggal ?>">
                    <input type="hidden" class="form-control" name="idpaketumroh" value="<?= $r->idpaketumroh ?>">
                    <input type="hidden" class="form-control" name="idpemberangkatan" value="<?= $r->idpemberangkatan ?>">
                    <input type="hidden" class="form-control" name="hrgperlengkapan" value="<?= $r->hrgperlengkapan ?>">
                  </div>
                  <div class="form-group col-sm-6">
                    <label>Email (*)</label>
                    <input type="text" class="form-control" name="emailkontak" id="srcemail">
                  </div>
                  <div class="form-group col-sm-6">
                    <label>Nomor Handphone (*)</label>
                    <input type="text" class="form-control" name="nohpkontak" id="srcnohp">
                  </div>
                  <div class="form-group col-sm-6">
                    <label>Jumlah (*)</label>
                    <input type="number" name="qtyjamaah" id="qtyjamaah" class="form-control" value="1" min="1">
                  </div>
                  <div class="col-xs-12">
                    <a class="btn btn-primary" id="btnproses" onclick="tampildtljamaah()">Proses</a>
                  </div>
                  <div class="clearfix"></div>
                  <div class="col-md-12">
                    <hr>
                    <div id="dtljamaah"></div>
                  </div>
                  <center id="grandtotal" style="display: none;">
                      <h4>Grand Total</h4>
                      <input type="hidden" name="txgrandtotal" id="txgrandtotal" value="0">
                      <font size="4" id="vwgrandtotal">0</font>
                  </center>
                  <div class="col-xs-12">
                    <a class="btn btn-success" id="btnnext" onclick="bookreview()" style="display: none;">Next <span aria-hidden="true">→</span></a>
                  </div>
                </div>
                <!--<div class="step-pane" data-step="2">
                  <h4 style="text-align: left;">Metode Pembayaran</h4>
                  <hr>
                  <div class="row">
                      <div class="col-md-12">
                        <table>
                          <tr>
                            <td><img src="asset/images/payment/selected.png" id="imgpchannel1"></td>
                            <td><div class="paychannel" onclick="paychannelselected(1)"><img src="asset/images/payment/bca_klikpay.png"></div></td>
                          </tr>
                          <tr>
                            <td colspan="2"><hr></td>
                          </tr>
                          <tr>
                            <td><img src="asset/images/payment/selected.png" id="imgpchannel2" style="display: none;"></td>
                            <td><div class="paychannel" onclick="paychannelselected(2)"><img src="asset/images/payment/cimb_click.png"></div></td>
                          </tr>
                          <tr>
                            <td colspan="2"><hr></td>
                          </tr>
                        </table>
                        <input type="hidden" name="txpaychannel" id="idpaychannel">
                      </div>
                  </div>-->

                  <!-- <div class="form-group col-sm-6">
                    <label for="">Delivery Option</label>
                    <div class="radio"><label><input type="radio" name="radio-product" checked="checked"><span>Regular $10 (14 Days)</span></label></div>
                    <div class="radio"><label><input type="radio" name="radio-product"><span>Priority $15 (7 Days)</span></label></div>
                    <div class="radio"><label><input type="radio" name="radio-product"><span>Express $20 (3 Days)</span></label></div>
                  </div> -->

                  <!--<div class="col-xs-12">
                    <a class="btn btn-success" onclick="bookreview()">Next <span aria-hidden="true">→</span></a>
                  </div>
                </div>-->
                <div class="step-pane" data-step="3">
                  <div class="col-sm-12">
                    <div class="title"><span>Informasi Kontak</span></div>
                    <ul class="list-group list-group-nav">
                      <li class="list-group-item" id="rvkontak"></li>
                      <li class="list-group-item" id="rvemail"></li>
                      <li class="list-group-item" id="rvnohp"></li>
                    </ul>
                  </div>
                  <div class="clearfix"></div>
                  <div class="col-sm-6">
                    <div class="title"><span>Paket</span></div>
                    <ul class="list-group list-group-nav">
                      <li class="list-group-item"><?= $r->nmpaketumroh.' ('.tanggal($r->dari_tanggal).' - '.tanggal($r->sampai_tanggal).')' ?></li>
                    </ul>
                  </div>
                  <div class="col-sm-6">
                    <div class="title"><span>Harga</span></div>
                    <ul class="list-group list-group-nav">
                      <li class="list-group-item"><?= rupiah($r->hrgquad).' ~ '.rupiah($r->hrgdouble) ?></li>
                    </ul>
                  </div>
                  <div class="col-xs-12">
                    <div class="table-responsive">
                      <table class="table table-bordered table-cart">
                        <thead>
                          <tr>
                            <th>Jamaah</th>
                            <th>Room Type</th>
                            <th>Harga</th>
                          </tr>
                        </thead>
                        <tbody id="rincianjamaahbody"></tbody>
                        <tr><td colspan="2" class="text-right">Grand Total</td><td><b id="rvgrandtotal"></b></td></tr>
                      </table>
                    </div>
                  </div>
                  <div class="col-xs-12">
                    <button class="btn btn-primary" type="button" onclick="submitfrm()">Pesan</button>
                  </div>
                </div>
                <div class="step-pane" data-step="4">
                  <div class="alert alert-success text-center" role="alert">
                    <h4>Thank You For Your Order !</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deleniti optio voluptatum obcaecati inventore nobis, odit minima sunt odio amet suscipit!</p>
                    <p class="m-t-2"><a href="index.html" class="btn btn-theme"><i class="fa fa-home"></i> Back to Home</a></p>
                  </div>
                </div>
              </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>


    <!-- Footer -->
    <div class="agilefooterwthree" id="agilefooterwthree">
        <div class="container">

            <div class="agilefooterwthree-grids">
                <div class="col-md-3 agilefooterwthree-grid agilefooterwthree-grid1">
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
                <div class="col-md-3 agilefooterwthree-grid agilefooterwthree-grid2">
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
                <div class="col-md-3 agilefooterwthree-grid agilefooterwthree-grid3">
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
                <div class="col-md-3 agilefooterwthree-grid agilefooterwthree-grid3">
                    <h4>Dream Tour Pekanbaru</h4>
                    <address>
                        <ul>
                        <li>Dream Tour Pekanbaru</li>
                        <li>Jl. Arifin Ahmad no 90c</li>
                        <li>Tangkerang Tengah, Marpoyan Damai/li>
                        <li>Pekanbaru-Riau</li>
                        <li>(0761) 6709535, 082272206660, 082272206661</li>
                        <li><a class="mail" href="mailto:pekanbaru@dreamtour.co.id">pekanbaru@dreamtour.co.id</a></li>
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

                function tampildtljamaah(){
                    var qtyjamaah = $('#qtyjamaah').val();
                    if(qtyjamaah > <?= $r->avail_slot ?>){
                        alert('Mohon maaf qty jamaah tidak lebih dari available seat.');
                    }
                    else{
                        var lythtml = '';
                        for(var it=1; it<=qtyjamaah; it++){
                            $('#dtljamaah').append('<div class="panel panel-info"><div class="panel-heading">Detail Jamaah ke-'+it+'</div><div class="panel-body"><div class="form-group col-sm-6"><label>Nama Jamaah (*)</label><input type="text" name="nmjamaah[]" id="nmjamaah'+it+'" class="form-control"></div><div class="form-group col-sm-6"><label>Room Type (*)</label><select id="cmbroomtype'+it+'" class="form-control" onchange="setroomtype('+it+', this)"><option value="0" id="defsr'+it+'">Pilih Room Type...</option><option value="2">Double</option><option value="3">Triple</option><option value="4">Quad</option></select><input type="hidden" name="roomtype[]" id="txroomtype'+it+'"></div><div class="form-group col-sm-6"><label class="radio-inline"><input type="radio" name="gender['+(it-1)+']" value="M" checked>Laki-laki</label><label class="radio-inline"><input type="radio" name="gender['+(it-1)+']" value="F">Perempuan</label></div><div class="form-group col-sm-6"><label>Harga : </label> <span id="pricejamaah'+it+'">Rp0,-</span><input type="hidden" name="upricejamaah[]" id="txpricejamaah'+it+'"></div></div></div>');
                        }
                        $('#btnproses').hide();
                        $('#btnnext').show();
                        $('#grandtotal').show();
                    }
                }

                function setroomtype(id, type){
                    var vgtotal = $('#txgrandtotal').val();
                    var vdouble = "<?= $newhrgdouble ?>";
                    var vtripple = "<?= $newhrgtriple ?>";
                    var vquad = "<?= $newhrgquad ?>";
                    var vperl = "<?= $r->hrgperlengkapan ?>";
                    var vprice = "";
                    if(type.value == 2)
                        vprice = vdouble;
                    else if(type.value == 3)
                        vprice = vtripple;
                    else if(type.value == 4)
                        vprice = vquad;
                    else
                        vprice = "";
                    vgtotal = (parseFloat(vgtotal)+parseFloat(vprice)+parseFloat(vperl));
                    $('#pricejamaah'+id).html(formatMoney(parseFloat(vprice)+parseFloat(<?= $diskon ?>))+" + <b>Perlengkapan :</b> "+formatMoney(vperl)+" | <button class='btn btn-xs btn-flat btn-warning' onclick='batalsetroomtype(\""+id+"\")'><i class='fa fa-refresh'></i></button>");
                    $('#txpricejamaah'+id).val(vprice);
                    $('#txgrandtotal').val(vgtotal);
                    $('#vwgrandtotal').html('<span style=\'text-decoration: line-through;\'>'+formatMoney(vgtotal+(<?= $diskon ?>*$('#qtyjamaah').val()))+'</span> '+formatMoney(vgtotal));
                    $('#txroomtype'+id).val(type.value);
                    $('#cmbroomtype'+id).prop('disabled','disabled');
                    $('#defsr'+id).prop('disabled','disabled');
                }

                function batalsetroomtype(id){
                    var vgtotal = $('#txgrandtotal').val();
                    var vprice = $('#txpricejamaah'+id).val();
                    var hasil = (parseFloat(vgtotal)-parseFloat(vprice)-parseFloat(<?= $r->hrgperlengkapan ?>));

                    $('#txgrandtotal').val(hasil);
                    $('#vwgrandtotal').html(formatMoney(hasil));
                    $('#txpricejamaah'+id).val('');
                    $('#pricejamaah'+id).html('Rp0,-');
                    $('#cmbroomtype'+id).prop('disabled', false);
                }

                function paychannelselected(id){
                    kosongkanpchannel();
                    $('#imgpchannel'+id).show();
                    $('#idpaychannel').val(id);
                }

                function bookreview(){
                    $('#rvkontak').html($('#srckontak').val());
                    $('#rvemail').html($('#srcemail').val());
                    $('#rvnohp').html($('#srcnohp').val());
                    //$('#rvnmpchannel').html(getPaygateway($('#idpaychannel').val()));
                    var qtyjamaah = $('#qtyjamaah').val();
                    $('#rincianjamaahbody').html('');
                    for(var iter=1; iter<=qtyjamaah; iter++){
                        $('#rincianjamaahbody').append('<tr><td class="img-cart">'+$('#nmjamaah'+iter).val()+'</td><td>'+getRoomType($('#txroomtype'+iter).val())+'</td><td class="sub">'+formatMoney(parseFloat($('#txpricejamaah'+iter).val())+parseFloat(<?= $diskon ?>))+'</td></tr>');
                    }
                    $('#rincianjamaahbody').append('<tr><td class="img-cart">Perlengkapan '+qtyjamaah+' Pc(s)</td><td>-</td><td class="sub"><?= rupiah($r->hrgperlengkapan) ?></td></tr>');
                    $('#rvgrandtotal').html($('#vwgrandtotal').html());
                    $('#checkoutWizard').wizard('next');
                }

                function kosongkanpchannel(){
                    $('#imgpchannel1').hide();
                    $('#imgpchannel2').hide();
                }

                function submitfrm(){
                  if($('#srckontak').val() == ''){
                    $('#btstep1').click();
                    alert('Isi nama kontak!');
                  }
                  else if($('#srcemail').val() == ''){
                    $('#btstep1').click();
                    alert('Isi email kontak!');
                  }
                  else if($('#srcnohp').val() == ''){
                    $('#btstep1').click();
                    alert('Isi nomor handphone kontak!');
                  }
                  else{
                    $('#frbooking').submit();
                  }
                }

                function getRoomType(roomtype){
                    if(roomtype == 2)
                        return "Double";
                    else if(roomtype == 3)
                        return "Triple";
                    else if(roomtype == 4)
                        return "Quad";
                    else
                        return "-";
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