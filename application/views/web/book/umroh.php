<!DOCTYPE html>
<html lang="zxx">

<!-- Head -->
<head>

    <meta name="google-site-verification" content="4P29uSHs7fYMai_sqywTOk4-VNlphvMVZ7QGh_3az_0" />
    <meta name="google-site-verification" content="T9vHs-0GUdWhue22iFWg-C_eCfYEbOnyV43ZrMscbIE" />
    <?php 
    date_default_timezone_set('Asia/Jakarta');
    $sekarang = Date('Y');
    $depan = $sekarang + 1;
    $tahun = $sekarang.' - '. $depan;
    $flashsale = false;
    ?>
    <title>Paket dan Biaya Umroh <?= $tahun ?> | Travel Umroh di Jakarta</title>
    <link rel="shortcut icon" href="<?php echo base_url()?>asset/images/icon_dream.png">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="PT Dream Tours and Travel adalah Travel Umroh Terbaik di Jakarta yang akan membantu Anda untuk mendapatkan pelayanan yang terbaik untuk perjalanan Umroh dan Liburan. 
    Menyediakan berbagai pilihan paket dengan biaya umroh <?= $tahun ?> yang kompetitif dan relatif murah / hemat.Pilihan paket yang kami tawarkan mulai dari paket umroh exclusive (VIP), Umroh Signature (VIP), paket umroh plus wisata seperti, umroh plus turki, umroh plus aqsa, umroh plus dubai, umroh plus cairo, umroh plus eropa, dan banyak lainnya.
    Pada halaman ini selain dapat melihat paket paket umroh <?= $tahun ?> kamu juga dapat melihat biaya-biaya paket umroh yang di tawarkan oleh dream tour travel umroh terbaik di jakarta, bandung, surabaya, Indonesia ">
    <link rel="alternate" hreflang="" href="http://www.dreamtour.co/" />
    <link rel="canonical" href="http://www.dreamtour.co/" />
    <meta name="author" content="Dream Tour">
    <meta name="robots" content="index, follow" />
    <meta name="googlebot" content="index, follow" />
    <meta name="keywords" content="travel umroh, travel umroh terbaik, travel umroh terbaik di jakarta, paket umroh, umroh murah, umroh pomo, umroh hemat umroh resmi" />
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

    <!-- Fonts -->
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Montserrat:400,700"     type="text/css" media="all">
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:100,300,400,500" type="text/css" media="all">
    <!-- //Fonts -->

    <!-- Font-Awesome-File-Links -->
    <!-- CSS --> <link rel="stylesheet" href="<?php echo base_url()?>asset/odyssey/css/font-awesome.css"      type="text/css" media="all">
    <!-- TTF --> <link rel="stylesheet" href="<?php echo base_url()?>asset/odyssey/fonts/fontawesome-webfont.ttf" type="text/css" media="all">
    <!-- //Font-Awesome-File-Links -->

    <style type="text/css">
        .vtimer{
            color: #ffad4d;
            font-weight: bold;
        }
        .newprice{
            background-color: #ffad4d;
            color: #000000;
            padding: 5px;
            border-radius: 5px;
        }
    </style>

    <!-- Supportive-JavaScript -->
    <script src="<?php echo base_url()?>asset/odyssey/js/modernizr.js"></script>
    <!-- //Supportive-JavaScript -->

    <script>
        // Set the date we're counting down to
        <?php
        if(date('Y-m-d') >= '2019-12-07'){
            echo 'var countDownDate = new Date("Dec 8, 2019 00:00:00").getTime();';
        }
        else{
            echo 'var countDownDate = new Date("Dec 7, 2019 00:00:00").getTime();';
        }
        ?>
        var now = new Date("<?php echo date('M d, Y, H:i:s') ?>").getTime();

        // Update the count down every 1 second
        var x = setInterval(function() {

          // Get today's date and time
          now = now + 1000;

          // Find the distance between now and the count down date
          var distance = countDownDate - now;

          // Time calculations for days, hours, minutes and seconds
          var days = Math.floor(distance / (1000 * 60 * 60 * 24));
          var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
          var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
          var seconds = Math.floor((distance % (1000 * 60)) / 1000);

          // Display the result in the element with id="demo"
          document.getElementById("vwcountdown").innerHTML = "<span class=\"vtimer\">" + days + "</span> <small>Hari</small>, <span class=\"vtimer\">" + hours + "</span> <small>Jam</small>, <span class=\"vtimer\">"
          + minutes + "</span> <small>Menit</small>, <span class=\"vtimer\">" + seconds + "</span> <small>Detik</small>.";

          // If the count down is finished, write some text
          if (distance < 0) {
            clearInterval(x);
            document.getElementById("vwcountdown").innerHTML = "EXPIRED";
          }
        }, 1000);
    </script>

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

    <div class="belakang" id="belakang">

    </div>

    <div class="modal fade" id="modalskfsale" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body" style="background-color: #ffffff; text-align: center;">
                    <h2>Syarat dan Ketentuan Flash Sale 07.12</h2>
                    <hr>
                    <ul>
                        <li>Diskon hanya berlaku untuk pemesanan tanggal 7 Desember 2019 melalui website</li>
                        <li>Diskon berlaku untuk pemberangkatan terpilih (20 dan 22 Desember 2019)</li>
                        <li>Diskon tidak dapat digabungkan dengan promo lainnya</li>
                        <li>Diskon hanya berlaku untuk transaksi yang dibayar lunas pada tanggal 7 Desember 2019</li>
                        <li>Dreamtour dapat membatalkan diskon apabila ditemukan hal yang tidak sesuai ketentuan</li>
                        <li>Syarat dan Ketentuan dapat berubah sewaktu-waktu</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>


        <!-- Packages -->
    <div class="wthreelocationsaits" id="wthreelocationsaits">
        <div class="container">
            <br><br><br><br>
            <?php
            if(date('Y-m-d') < '2019-12-08'){
                if(date('Y-m-d') >= '2019-12-07'){
                    $textfsale = 'Berakhir dalam';
                    $flashsale = true;
                }
                else{
                    $textfsale = 'Nantikan';
                }
                echo '<div style="background-color: #031e4b; padding: 20px;">
                    <span style="font-size: 18pt; color: #ffffff;">'.$textfsale.' : <span id="vwcountdown"></span></span>
                    <!--<button type="button" class="btn btn-default pull-right" data-toggle="modal" data-target="#modalskfsale">S&K</button>-->
                </div>
                <image src="'.base_url().'/asset/odyssey/images/LANDSCAPE HEADER.JPG" width="100%">';
            }
            else{
                echo '<h1 style="color: white;">Paket Umroh</h1><br><br>';
            }
            ?>
            
            <div id="owl-demo" class="owl-carousel text-center">
                <?php
                foreach ($paketumroh->result() as $paket) {
                if($flashsale == true && ($paket->idpaketumroh == 97 || $paket->idpaketumroh == 3 || $paket->idpaketumroh == 90)){
                    $harganya = '<h5><span style="text-decoration: line-through;">'.rupiah($paket->hrgquad).'</span> <span class="newprice">'.rupiah($paket->hrgquad-5000000).'</span></h5><br>';
                    $badges = '<br><br><img src="'.base_url().'/asset/odyssey/images/fs_flashsale.png" style="width: 120px">';
                }
                else{
                    $harganya = '<h5>'.rupiah($paket->hrgquad).'</h5>';
                    $badges = '';
                }
                ?>
                <div class="item w3-agile">
                    <div class="agilegrid agilegrid1">
                        <img src="http://admin.dreamtour.co/assets/images/gbrpaket/<?= $paket->imgpaketumroh ?>" alt="umroh plus turki, umroh plus aqsa, umroh plus aqso, umroh plus mesir, umroh plus eropa, paket umroh, Paket umroh <?= $tahun ?>, Biaya Umroh <?= $tahun ?>, umroh promo, dream tour, brosur umroh, spanduk mroh, umroh murah, umroh hemat, umroh promo, umroh exclusive, travel umroh jakarta, travel umroh terbaik, travel umroh resmi, pt dream tour & travel">
                        <?= $badges ?>
                        <h4><?= $paket->nmpaketumroh ?></h4>
                        <?= $harganya ?>
                        <?= $paket->overview ?>
                        <div class="sign w3-agile text-center">
                            <!-- <a class="popup-with-zoom-anim" href="#small-dialog">BOOK NOW</a> -->
                            <a class="" href="<?php echo base_url()?>paketumroh/<?= $paket->idpaketumroh."_".str_replace(" ", "_", $paket->nmpaketumroh) ?>"><button style="" class="btn btn-primary btn-md" required="required">Detail</button></a>
                            <!--<a class="" href=""><button style="" class="btn btn-success btn-md" required="required">Booking</button></a>-->
                        </div>
                    </div>
                </div>
                <?php
                }
                ?>
            </div>
                    
            <br><br>

            <!--<h4><font color="White">Jadwal & Biaya Umroh </h4> -->
            <div class="tabel-umroh">
            <p style="text-align:justify;">
                
                <h3>Jadwal & Biaya Umroh 2019 - 2020</h3>
            <!--<select class="form-control">
                <option>Januari</option>
            </select>
            <br>-->

            <h4><font color="White"></h4>
            <div class="tabel-umroh">
            <p style="text-align:justify;">

                <div class="table-responsive">
                    <table class="table .table-hover" style="width:100%;" class="table">
                        <tr>
                            <td align="center" rowspan="2"><strong>PAKET UMROH</strong></td> 
                            <td align="center" rowspan="2"><strong>SEAT</strong></td> 
                            <td align="center" colspan="3"><strong>BIAYA</strong></td>
                        </tr>
                        <tr>
                            <td align="center"><strong>QUAD</strong></td>
                            <td align="center"><strong>TRIPLE</strong></td>
                            <td align="center"><strong>DOUBLE</strong></td>
                        </tr>
                        <?php
                        /*if(isset($_GET['bln'])){
                            $crntmonth = $_GET['bln'];
                            $crntyear = $_GET['thn'];
                        }
                        else{
                            $crntmonth = date('m');
                            $crntyear = date('Y');
                        }

                        for ($i=0; $i < cal_days_in_month(CAL_GREGORIAN, $crntmonth, $crntyear); $i++) {
                            if($i == 0)
                                $crntdate = $crntyear.'-'.$crntmonth.'-01';
                            else
                                $crntdate = date('Y-m-d', strtotime('+1 days', strtotime($crntdate)));

                            $bdata = $this->db->query('select * from ol_pemberangkatan a join ol_paketumroh b on a.idpaketumroh = b.idpaketumroh where dari_tanggal = "'.$crntdate.'"');
                            if($bdata->num_rows() > 0){
                                foreach ($bdata->result() as $rdata) {
                                    echo '<tr>
                                        <td colspan="4">'.tanggal($crntdate).'</td>
                                    </tr>
                                    <tr style="background-color: #ffffff; color: #000000;">
                                        <td><a href="'.base_url('paketumroh').'/'.$rdata->idpaketumroh.'_'.str_replace(" ", "_", $rdata->nmpaketumroh).'">- '.$rdata->nmpaketumroh.'</a></td>
                                        <td>'.rupiah($rdata->hrgquad).'</td>
                                        <td>'.rupiah($rdata->hrgtriple).'</td>
                                        <td>'.rupiah($rdata->hrgquad).'</td>
                                    </tr>';
                                }
                            }
                        }*/

                        $bdata = $this->db->query('select * from ol_pemberangkatan a join ol_paketumroh b on a.idpaketumroh = b.idpaketumroh where dari_tanggal >= "'.date('Y-m-d').'" order by dari_tanggal asc');
                        if($bdata->num_rows() > 0){
                            $crntdate = '';
                            foreach ($bdata->result() as $rdata) {
                                if($flashsale == true && ($rdata->idpemberangkatan == 282 || $rdata->idpemberangkatan == 97 || $rdata->idpemberangkatan == 251 || $rdata->idpemberangkatan == 95)){
                                    $newhrgquad = '<span style="text-decoration: line-through;">'.rupiah($rdata->hrgquad).'</span> '.rupiah($rdata->hrgquad-5000000);
                                    $newhrgtriple = '<span style="text-decoration: line-through;">'.rupiah($rdata->hrgtriple).'</span> '.rupiah($rdata->hrgtriple-5000000);
                                    $newhrgdouble = '<span style="text-decoration: line-through;">'.rupiah($rdata->hrgdouble).'</span> '.rupiah($rdata->hrgdouble-5000000);

                                    $buttonbookstyle = 'btn-warning">Book</a> <i class="fa fa-flash" style="color: orange;"></i>';
                                }
                                else{
                                    $newhrgquad = rupiah($rdata->hrgquad);
                                    $newhrgtriple = rupiah($rdata->hrgtriple);
                                    $newhrgdouble = rupiah($rdata->hrgdouble);

                                    $buttonbookstyle = 'btn-info">Book</a>';
                                }
                                if($rdata->avail_slot > 0 && $rdata->isLocked == 0){
                                    $bookbtn = $rdata->avail_slot.' Seat - <a href="'.base_url('checkout/'.$rdata->idpaketumroh.'_'.$rdata->idpemberangkatan.'_'.str_replace(" ", "_", $rdata->nmpaketumroh)).'" class="btn-sm '.$buttonbookstyle;
                                }
                                else if($rdata->max_slot == 0){
                                    //$bookbtn = 'Seat belum dibuka';
                                    $bookbtn = 'Full';
                                }
                                else{
                                    //$bookbtn = 'Seat penuh atau dikunci';
                                    $bookbtn = 'Full';
                                }
                                if($crntdate == $rdata->dari_tanggal){
                                    echo '<tr style="background-color: #ffffff; color: #000000;">
                                        <td><a href="'.base_url('paketumroh').'/'.$rdata->idpaketumroh.'_'.str_replace(" ", "_", $rdata->nmpaketumroh).'">- '.$rdata->nmpaketumroh.'</a></td>
                                        <td>'.$bookbtn.'</td>
                                        <td>'.$newhrgquad.'</td>
                                        <td>'.$newhrgtriple.'</td>
                                        <td>'.$newhrgdouble.'</td>
                                    </tr>';
                                }
                                else{
                                    echo '<tr>
                                        <td colspan="5">Paket Umroh '.tanggal($rdata->dari_tanggal).'</td>
                                    </tr>
                                    <tr style="background-color: #ffffff; color: #000000;">
                                        <td><a href="'.base_url('paketumroh').'/'.$rdata->idpaketumroh.'_'.str_replace(" ", "_", $rdata->nmpaketumroh).'">- '.$rdata->nmpaketumroh.'</a></td>
                                        <td>'.$bookbtn.'</td>
                                        <td>'.$newhrgquad.'</td>
                                        <td>'.$newhrgtriple.'</td>
                                        <td>'.$newhrgdouble.'</td>
                                    </tr>';
                                }
                                $crntdate = $rdata->dari_tanggal;
                            }
                        }
                        else{
                            echo '<tr>
                                <td colspan="5" align="center">Tidak ada data!</td>
                            </tr>';
                        }
                        ?>
                    </table>
                </div>
            </div>

            </div>



            <!-- Popup-Box -->
            <div id="popup">
                <div id="small-dialog" class="mfp-hide agileinfo">
                    <div class="pop_up">
                        <div class="payment-online-form-left w3-agileits">

                            <h4><span class=""></span>Detail perjalanan</h4>
                            <div class="row">
                                <div class="col-md-3">
                                    <img class="img-responsive img-blog" src="<?php echo base_url()?>asset/images/umrah/itin/day1.jpg" width="100%" alt="umroh, paket umroh, paket Umroh <?= $tahun ?> pt dream tour and travel" />
                                </div>
                                <div class="col-md-9">
                                    <b>Hari ke-1  : JAKARTA – MADINAH<br></b>
                                    Berkumpul di Bandara Soekarno – Hatta 3 (tiga) jam sebelum keberangkatan untuk penerbangan dari Jakarta menuju Madinah. Setibanya di airport Madinah, jama’ah langsung di antar menuju Hotel. Tiba di Hotel Grand Mercure Madinah untuk berisitirahat. ( Makan Malam )<br><br>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-3">
                                    <img class="img-responsive img-blog" src="<?php echo base_url()?>asset/images/umrah/itin/day2.jpg" width="100%" alt="umroh, paket umroh, paket Umroh <?= $tahun ?>, pt dream tour and travel" />
                                </div>
                                <div class="col-md-9">
                                    <b>Hari ke-2 : MADINAH<br></b>
                                    Setelah sarapan, berziarah ke Makam Rasullulah SAW & para sahabat dengan di damping Mutawif wanita dan laki – laki kemudian melaksanakan shalat sunah dan berdoa di Raudah. Setelah itu shalat Jum’at dan memperbanyak Ibadah di Masjid Nabawi. (Free Program). ( Makan Pagi, Makan Siang & Makan Malam )<br><br>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-3">
                                    <img class="img-responsive img-blog" src="<?php echo base_url()?>asset/images/umrah/itin/day3.jpg" width="100%" alt="umroh, paket umroh, paket Umroh <?= $tahun ?>, pt dream tour and travel" />
                                </div>
                                <div class="col-md-9">
                                    <b>Hari ke-3 : MADINAH<br></b>
                                    Setelah sarapan persiapan untuk ziarah kota Madinah. Ziarah mengunjungi Jabal Uhud, Masjid Quba dan Pasar Kurma. Setelah itu kembali ke hotel dan kembali memperbanyak ibadah di Masjid Nabawi. ( Makan Pagi, Makan Siang & Makan Malam ) <br><br>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-3">
                                    <img class="img-responsive img-blog" src="<?php echo base_url()?>asset/images/umrah/itin/day4.jpg" width="100%" alt="umroh, paket umroh, paket Umroh <?= $tahun ?>, pt dream tour and travel" />
                                </div>
                                <div class="col-md-9">
                                    <b>Hari ke-4 : MADINAH – MAKKAH<br></b>
                                    Mandi sunah ikhram dan persiapan untuk cek out. Setelah makan siang persiapan berangkat menuju ke Makkah dan mengambil Miqot di Biir Ali. Tiba di Makkah, langsung ke hotel Fairmont Makkah untuk menyimpan barang-barang dan makan malam, kemudian melaksanakan ibadah Umroh. Setelah ibadah umroh selesai jamaah kembali ke hotel untuk beristirahat. ( Makan Pagi, Makan Siang & Makan Malam )<br><br>
                                </div>
                            </div> 
                            <hr>
                            <div class="row">
                                <div class="col-md-3">
                                    <img class="img-responsive img-blog" src="<?php echo base_url()?>asset/images/umrah/itin/day5.jpg" width="100%" alt="umroh, paket umroh, paket Umroh <?= $tahun ?>, pt dream tour and travel" />
                                </div>
                                <div class="col-md-9">
                                    <b>Hari ke-5 : MAKKAH<br></b>
                                    Memperbanyak Ibadah di Masjidil Haram. (Free Program). ( Makan Pagi, Makan Siang & Makan Malam )<br><br>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-3">
                                    <img class="img-responsive img-blog" src="<?php echo base_url()?>asset/images/umrah/itin/day6.jpg" width="100%" alt="umroh, paket umroh, paket Umroh <?= $tahun ?>, pt dream tour and travel" />
                                </div>
                                <div class="col-md-9">
                                    <b>Hari ke-6 : MAKKAH<br></b>
                                    Setelah sarapan pagi, persiapan ziarah kota Makkah. Ziarah mengunjungi Padang Arafah, Jabal Rahmah, Muzdalifah, Mina dan Jabal Tsur. Kemudian berakhir di Ja’ronah (bagi yang akan melaksanakan umroh kedua mengambil silahkan untuk miqot) bagi yang tidak mengikuti umrah kedua memperbanyak ibadah di Makkah. ( Makan Pagi, Makan Siang & Makan Malam )<br><br>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-3">
                                    <img class="img-responsive img-blog" src="<?php echo base_url()?>asset/images/umrah/itin/day7.jpg" width="100%" alt="umroh, paket umroh, paket Umroh <?= $tahun ?>, pt dream tour and travel" />
                                </div>
                                <div class="col-md-9">
                                    <b>Hari ke-7 : MAKKAH<br></b>
                                    Memperbanyak ibadah di Masjidil Haram. (Free Program). ( Makan Pagi, Makan Siang & Makan Malam )<br><br>
                                </div>
                            </div>  
                            <hr>
                            <div class="row">
                                <div class="col-md-3">
                                    <img class="img-responsive img-blog" src="<?php echo base_url()?>asset/images/umrah/itin/day8.jpg" width="100%" alt="umroh, paket umroh, paket Umroh <?= $tahun ?>, pt dream tour and travel" />
                                </div>
                                <div class="col-md-9">
                                    <b>Hari ke-8  : MAKKAH – JEDDAH<br></b>
                                    Setelah shalat Subuh dan Thawaf Wada’ persiapan untuk cek out hotel. Jamaah bertolak menuju Jeddah dan city tour, kemudian Setelah itu 4 jam sebelum take off jamaah menuju airport Jeddah untuk keberangkatan ke Jakarta. ( Makan Pagi, Makan Siang & Makan Malam )<br><br>
                                </div>
                            </div>  
                            <hr>
                            <div class="row">
                                <div class="col-md-3">
                                    <img class="img-responsive img-blog" src="<?php echo base_url()?>asset/images/umrah/itin/day9.jpg" width="100%" alt="umroh, paket umroh, paket Umroh <?= $tahun ?>, pt dream tour and travel" />
                                </div>
                                <div class="col-md-9">
                                    <b>Hari ke-9 : JAKARTA<br></b>
                                    Tiba di Jakarta dan Insha Allah membawa “Umrah Maqbullah“ dan kenangan yang indah bersama Dream Tour. Terimakasih atas keikutsertaan anda dalam memilih DREAM TOUR sebagai teman perjalananan Ibadah Umroh anda. Sampai bertemu kembali di acara tour yang lain.<br><br>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <button title="Close (Esc)" type="button" class="mfp-close w3-agileits">×</button>
                <!-- //Popup-Box --> 
            </div>

        </div>
        <!-- //Packages -->



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
                       <li>(021) 21381090, (021) 21381091</li>
                       <li>08119333000, 08170033300</li>
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
                        <li>031 5359666,031 5359555 </li>
                        <li>08113307330</li>
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
                        <li>Paledang, Lengkong</li>
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
                        <li>Tangkerang Tengah, Marpoyan Damai</li>
                        <li>Pekanbaru-Riau</li>
                        <li>(0761) 6709535</li>
                        <li>082272206660, 082272206661</li>
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
        <p>© <?= Date('Y')?> <a href="www.dremtour.co">PT. Dream Tours & Travel</a>. All Rights Reserved </p>
    </div>
    <!-- //Copyright -->



    <!-- Custom-JavaScript-File-Links -->
    
    <!-- Default-JavaScript -->   <script type="text/javascript" src="<?php echo base_url()?>asset/odyssey/js/jquery-2.1.4.min.js"></script>
    <!-- Bootstrap-JavaScript --> <script type="text/javascript" src="<?php echo base_url()?>asset/odyssey/js/bootstrap.js"></script>

<!-- Responsive-Slider-JavaScript -->
            <script src="<?php echo base_url()?>asset/odyssey/js/responsiveslides.min.js"></script>
            <script>
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

        <!-- Map-JavaScript -->
            <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>        
            <script type="text/javascript">
                google.maps.event.addDomListener(window, 'load', init);
                function init() {
                    var mapOptions = {
                        zoom: 11,
                        center: new google.maps.LatLng(43.73333, 7.41667),
                        styles: [{"featureType":"all","elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#000000"},{"lightness":40}]},{"featureType":"all","elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#000000"},{"lightness":16}]},{"featureType":"all","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":17},{"weight":1.2}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":21}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":16}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":19}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":17}]}]
                    };
                    var mapElement = document.getElementById('map');
                    var map = new google.maps.Map(mapElement, mapOptions);
                    var marker = new google.maps.Marker({
                        position: new google.maps.LatLng(43.73333, 7.41667),
                        map: map,
                    });
                }
            </script>
        <!-- //Map-JavaScript -->

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