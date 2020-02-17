<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Sales Request | PT Dream Tours and Travel</title>
    
    <!-- core CSS -->
    <link href="<?php echo base_url()?>asset/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url()?>asset/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo base_url()?>asset/css/prettyPhoto.css" rel="stylesheet">
    <link href="<?php echo base_url()?>asset/css/animate.min.css" rel="stylesheet">
    <link href="<?php echo base_url()?>asset/css/main.css" rel="stylesheet">
    <link href="<?php echo base_url()?>asset/css/responsive.css" rel="stylesheet">
    
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="<?php echo base_url()?>asset/images/icon_dream.png">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">

    
    <!-- JAVASCRIPT INCLUDE HOTEL -->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script type="text/javascript">
        $(function () {
            $("input[name='include_hotel']").click(function () {
                if ($("#inchotelYes").is(":checked")) {
                    $("#info_hotel").show();
                } else {
                    $("#info_hotel").hide();
                }
            });
        });
    </script>

    <!-- JAVASCRIPT FLIGHT -->
    <script type="text/javascript" src="https://code.jquery.com/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $("select[name='jumlah_flight']").change(function(){
                $(this).find("option:selected").each(function(){
                    if($(this).attr("value")=="1"){
                        $(".total_flight").not(".1,.pnr").hide();
                        $(".1,.pnr").show();
                    }
                    else if($(this).attr("value")=="2"){
                        $(".total_flight").not(".1,.2,.pnr").hide();
                        $(".1,.2,.pnr").show();
                    }
                    else if($(this).attr("value")=="3"){
                        $(".total_flight").not(".1,.2,.3,.pnr").hide();
                        $(".1,.2,.3,.pnr").show();
                    }
                    else if($(this).attr("value")=="4"){
                        $(".total_flight").not(".1,.2,.3,.4,.pnr").hide();
                        $(".1,.2,.3,.4,.pnr").show();
                    }
                    else if($(this).attr("value")=="5"){
                        $(".total_flight").not(".1,.2,.3,.4,.5,.pnr").hide();
                        $(".1,.2,.3,.4,.5,.pnr").show();
                    }
                    else if($(this).attr("value")=="6"){
                        $(".total_flight").not(".1,.2,.3,.4,.5,.6,.pnr").hide();
                        $(".1,.2,.3,.4,.5,.6,.pnr").show();
                    }
                    else{
                        $(".total_flight").hide();
                    }
                });
            }).change();
        });
        </script>
</head><!--/head-->

<body>

    <header id="header">
        <div class="top-bar">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-xs-4">
                        <div class="top-number"><p><i class="fa fa-phone-square"></i> +6221 21381090</p></div>
                    </div>
                    <div class="col-sm-6 col-xs-8">
                       <div class="social">
                            <ul class="social-share">
                                <li><a title="Dream Tour Youtube Channel" target="blank" href="https://www.youtube.com/DreamTourTravel"><i class="fa fa-youtube-play"></i></a></li>
                                <li><a title="Like Fan Page Dream Tour" target="blank" href="https://www.facebook.com/pages/Dream-Tour/523025174479221?fref=ts"><i class="fa fa-facebook"></i></a></li>
                                <li><a title="Ikuti Kami di Twitter" target="blank" href="https://twitter.com/dreamtour_co"><i class="fa fa-twitter"></i></a></li>
                                <li><a title="Ikuti Kami di Instagram" target="blank" href="https://instagram.com/dreamtour_co"><i class="fa fa-instagram"></i></a></li>
                            </ul>
                            <div class="search">
                                <form role="form">
                                    <input type="text" class="search-form" autocomplete="off" placeholder="Search">
                                    <i class="fa fa-search"></i>
                                </form>
                           </div>
                       </div>
                    </div>
                </div>
            </div><!--/.container-->
        </div><!--/.top-bar-->

        <nav class="navbar navbar-inverse" role="banner">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo base_url()?>web/home"><img width="220" src="<?php echo base_url()?>asset/images/logo_dream.png" alt="logo"></a>
                </div>
                
                <div class="collapse navbar-collapse navbar-right">
                    <ul class="nav navbar-nav">
                        <li><a href="<?php echo base_url()?>web/home">Home</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Umroh <i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo base_url()?>umroh/paket_umroh_reguler">Paket Umroh Reguler</a></li>
                                <li><a href="<?php echo base_url()?>umroh/paket_umroh_plus">Paket Umroh Plus</a></li>
                                <li><a href="<?php echo base_url()?>umroh/biaya_umroh">Biaya Umroh</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Liburan<i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo base_url()?>tour/muslim_tour">Muslim Tour</a></li>
                                <li><a href="<?php echo base_url()?>tour/internasional">Internasional Tour</a></li>
                                <li><a href="<?php echo base_url()?>tour/domestik">Domestik Tour</a></li>
                                <li><a href="<?php echo base_url()?>tour/open_trip">Open Trip</a></li>
                                <li><a href="<?php echo base_url()?>tour/honeymoon">Honeymoon</a></li>
                            </ul>
                        </li>
                        <li><a href="<?php echo base_url()?>corporate">Corporate</a></li> 
                        <li><a href="http://happartners.com/id/dreamtour/" target="_blank">Sewa Mobil</a></li> 
                        <li><a href="<?php echo base_url()?>sohibi">Sohibi</a></li>
                        <!-- <li><a href="<?php echo base_url()?>web/hotel">Hotel</a></li> -->
                        <li><a href="<?php echo base_url()?>web/contact">Kontak Kami</a></li>                        
                    </ul>
                </div>
            </div><!--/.container-->
        </nav><!--/nav-->
        
    </header><!--/header-->
<section id="contact-info">
        <div class="center">                
            <h2>Sales Request B2B</h2>
        </div>
        <div class="row contact-wrap"> 
            <form method="post" action="<?php echo base_url();?>requestb2b/requestb2b_send">
                <div class="col-sm-5 col-sm-offset-1">

                    <div class="form-group">
                        <label>Nama Sales *</label>
                        <input type="text" name="nama_sales" class="form-control" required="required">
                    </div>

                    <div class="form-group">
                        <label>Email *</label>
                        <input type="email" name="email" class="form-control" required="required">
                    </div>

                    <div class="form-group">
                        <label>Include Visa *</label>
                        <label class="radio-inline">
                            <input type="radio" name="include_visa" id="incvisa" value="Yes" required="required"> Yes
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="include_visa" id="incvisa" value="No" required="required"> No
                        </label>
                    </div>

                    <div class="form-group">
                        <label>Include Hotel *</label>
                        <label class="radio-inline">
                            <input type="radio" name="include_hotel" id="inchotelYes" value="Yes" required="required"> Yes
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="include_hotel" id="inchotelNo" value="No" required="required"> No
                        </label>
                    </div>

                        <div id="info_hotel" style="display:none;border: 1px solid #000;padding:10px;">
                            Nama Hotel Mekkah * : <input type="text" name="namaHotelMekkah" id="namaHotelMekkah"/><br>
                            Jumlah Malam *      : <input type="text" name="malamHotelMekkah" id="malamHotelMekkah" style="margin-left:39px"/><br>
                                <input type="hidden" name="makananHotelMekkah" value="-" />
                                <input type="radio" name="makananHotelMekkah" id="makananHotelMekkah" value="RO"> RO
                                <input type="radio" name="makananHotelMekkah" id="makananHotelMekkah" value="BB"> BB
                                <input type="radio" name="makananHotelMekkah" id="makananHotelMekkah" value="FB"> FB<br>
                            Double * : <input  type="text" name="jumlahKamarDoubleHotelMekkah" id="jumlahKamarDoubleHotelMekkah" style="width:30px" />
                            Triple * : <input  type="text" name="jumlahKamarTripleHotelMekkah" id="jumlahKamarTripleHotelMekkah" style="width:30px" />
                            Quad *   : <input  type="text" name="jumlahKamarQuadHotelMekkah" id="jumlahKamarQuadHotelMekkah" style="width:30px" /><br>
                            <hr>
                            Nama Hotel Madinah * : <input type="text" name="namaHotelMadinah" id="namaHotelMadinah"/><br>
                            Jumlah Malam *       : <input type="text" name="malamHotelMadinah" id="malamHotelMadinah" style="margin-left:44px"/><br>
                                <input type="hidden" name="makananHotelMadinah" value="-" />
                                <input type="radio" name="makananHotelMadinah" id="makananHotelMadinah" value="RO"> RO
                                <input type="radio" name="makananHotelMadinah" id="makananHotelMadinah" value="BB"> BB
                                <input type="radio" name="makananHotelMadinah" id="makananHotelMadinah" value="FB"> FB<br>
                            Double * : <input type="text" name="jumlahKamarDoubleHotelMadinah" id="jumlahKamarDoubleHotelMadinah" style="width:30px" />
                            Triple * : <input type="text" name="jumlahKamarTripleHotelMadinah" id="jumlahKamarTripleHotelMadinah" style="width:30px" />
                            Quad *   : <input type="text" name="jumlahKamarQuadHotelMadinah" id="jumlahKamarQuadHotelMadinah" style="width:30px" /><br>
                            <hr>
                            Nama Hotel Lain * : <input type="text" name="namaHotelLain" id="namaHotelLain" /><br>
                            Jumlah Malam *    : <input type="text" name="malamHotelLain" id="malamHotelLain" style="margin-left:16px" /><br>
                                <input type="hidden" name="makananHotelLain" value="-" />
                                <input type="radio" name="makananHotelLain" id="makananHotelLain" value="RO"> RO
                                <input type="radio" name="makananHotelLain" id="makananHotelLain" value="BB"> BB
                                <input type="radio" name="makananHotelLain" id="makananHotelLain" value="FB"> FB<br>
                            Double * : <input type="text" name="jumlahKamarDoubleHotelLain" id="jumlahKamarDoubleHotelLain" style="width:30px" />
                            Triple * : <input type="text" name="jumlahKamarTripleHotelLain" id="jumlahKamarTripleHotelLain" style="width:30px" />
                            Quad *   : <input type="text" name="jumlahKamarQuadHotelLain" id="jumlahKamarQuadHotelLain" style="width:30px" /><br>
                        </div>

                    <div style="" class="form-group" id="">
                        <label>Total Flight *</label>
                        <select type="search" name="jumlah_flight" class="dropdown-kategori span3 form-control" required="required">
                            <option value="">--Pilih--</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                        </select>
                        <!-- <input type="text" name="paket" class="form-control" required="required"> -->
                    </div>

                        <div class="total_flight 1" style="display:none;border: 1px solid #000;padding:5px;">
                            Flight Pertama *<br>
                            Maskapai : <input type="text" name="maskapaiFlight1" id="maskapaiFlight1" /><br>
                            Flight : <input type="text" name="flightFlight1" id="flightFlight1" style="margin-left:27px" /><br>
                            Tanggal : <input type="date" name="tanggalFlight1" id="tanggalFlight1" style="margin-left:11px" /><br>
                        </div>
                        <div class="total_flight 2" style="display:none;border: 1px solid #000;padding:10px;">
                            Flight Kedua *<br>
                            Maskapai : <input type="text" name="maskapaiFlight2" id="maskapaiFlight2" /><br>
                            Flight : <input type="text" name="flightFlight2" id="flightFlight2" style="margin-left:27px" /><br>
                            Tanggal : <input type="date" name="tanggalFlight2" id="tanggalFlight2" style="margin-left:11px" /><br>
                        </div>                        
                        <div class="total_flight 3" style="display:none;border: 1px solid #000;padding:10px;">
                            Flight Ketiga *<br>
                            Maskapai : <input type="text" name="maskapaiFlight3" id="maskapaiFlight3" /><br>
                            Flight : <input type="text" name="flightFlight3" id="flightFlight3" style="margin-left:27px" /><br>
                            Tanggal : <input type="date" name="tanggalFlight3" id="tanggalFlight3" style="margin-left:11px" /><br>
                        </div>                        
                        <div class="total_flight 4" style="display:none;border: 1px solid #000;padding:10px;">
                            Flight Keempat *<br>
                            Maskapai : <input type="text" name="maskapaiFlight4" id="maskapaiFlight4" /><br>
                            Flight : <input type="text" name="flightFlight4" id="flightFlight4" style="margin-left:27px" /><br>
                            Tanggal : <input type="date" name="tanggalFlight4" id="tanggalFlight4" style="margin-left:11px" /><br>
                        </div>                    
                        <div class="total_flight 5" style="display:none;border: 1px solid #000;padding:10px;">
                            Flight Kelima *<br>
                            Maskapai : <input type="text" name="maskapaiFlight5" id="maskapaiFlight5" /><br>
                            Flight : <input type="text" name="flightFlight5" id="flightFlight5" style="margin-left:27px" /><br>
                            Tanggal : <input type="date" name="tanggalFlight5" id="tanggalFlight5" style="margin-left:11px" /><br>
                        </div>                   
                        <div class="total_flight 6" style="display:none;border: 1px solid #000;padding:10px;">
                            Flight Keenam *<br>
                            Maskapai : <input type="text" name="maskapaiFlight6" id="maskapaiFlight6" /><br>
                            Flight : <input type="text" name="flightFlight6" id="flightFlight6" style="margin-left:27px" /><br>
                            Tanggal : <input type="date" name="tanggalFlight6" id="tanggalFlight6" style="margin-left:11px" /><br>
                        </div>                
                        <div class="total_flight pnr" style="display:none;border: 1px solid #000;padding:10px;">
                            PnR (optional) : <input type="text" name="pnr" id="pnr" style="margin-left:10px" /><br>
                        </div><br>

                    <div class="form-group">
                        <label>Jumlah Seat *</label>
                        <table class="table table-bordered">
                            <tr>
                                <th>Jumlah Seat</th>
                                <th>Bisnis</th>
                                <th>Ekonomi</th>
                            </tr>
                            <tr>
                                <td>Dewasa</td>
                                <td><input type="text" name="dewasa_bisnis" class="form-control" required="required" /></td>
                                <td><input type="text" name="dewasa_promo" class="form-control" required="required" /></td>
                            </tr>
                            <tr>
                                <td>Anak-anak</td>
                                <td><input type="text" name="anak_bisnis" class="form-control" required="required" /></td>
                                <td><input type="text" name="anak_promo" class="form-control" required="required" /></td>
                            </tr>
                            <tr>
                                <td>Bayi</td>
                                <td><input type="text" name="bayi_bisnis" class="form-control" required="required" /></td>
                                <td><input type="text" name="bayi_promo" class="form-control" required="required" /></td>
                            </tr>
                        </table>
                    </div>  

                    <div class="form-group">
                        <label>Harga Ditawarkan (optional)</label>
                        <input type="text" name="harga_ditawarkan" class="form-control" >
                    </div>

                    <div class="form-group">
                        <label>Notes (optional)</label>
                        <textarea name="notes" class="form-control" rows="8"></textarea>
                    </div>   

                    <div class="form-group">
                        <button type="submit" name="submit" class="btn btn-primary btn-lg" required="required">Submit Request</button>
                    </div>
                </div>
            </form> 
        </div><!--/.row-->
    </section>  <!--/gmap_area -->

    <section id="bottom">
        <div class="container wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
            <div class="row">
                <div class="col-md-4 col-sm-6">
                    <div class="widget">
                        <h3>Paket Umroh</h3>
                        <ul>
                            <li><a href="<?php echo base_url()?>umroh/paket_umroh_reguler">Paket Umroh Reguler 2016</a></li>
                            <li><a href="<?php echo base_url()?>umroh/paket_umrah_plus_turki">Paket Umroh Plus Turki 2016</a></li>
                            <li><a href="<?php echo base_url()?>umroh/paket_umrah_plus_dubai">Paket Umroh Plus Dubai 2016</a></li>
                            <li><a href="<?php echo base_url()?>umroh/paket_umrah_plus_maroko">Paket Umroh Plus Maroko 2016</a></li>
                        </ul>
                    </div>    
                </div><!--/.col-md-3-->

                <div class="col-md-4 col-sm-6">
                    <div class="widget">
                        <h3>Paket Wisata</h3>
                        <ul>
                            <li><a href="<?php echo base_url()?>tour/muslim_tour">Paket Wisata Muslim Tour</a></li>
                            <li><a href="<?php echo base_url()?>tour/internasional">Paket Wisata Internasional Tour</a></li>
                            <li><a href="<?php echo base_url()?>tour/domestik">Paket Wisata Domestik Tour</a></li>
                            <li><a href="<?php echo base_url()?>tour/open_trip">Paket Wisata Open Trip</a></li>
                            <li><a href="<?php echo base_url()?>tour/honeymoon">Paket WIsata Honeymoon</a></li>
                        </ul>
                    </div>    
                </div><!--/.col-md-3-->

                <div class="col-md-4 col-sm-6">
                    <div class="widget">
                        <h3>Newsletter</h3>
                        <!-- Begin MailChimp Signup Form -->
                            <link href="//cdn-images.mailchimp.com/embedcode/classic-081711.css" rel="stylesheet" type="text/css">
                            <style type="text/css">
                                #mc_embed_signup{background:; clear:; font:14px Helvetica,Arial,sans-serif; }
                                /* Add your own MailChimp form style overrides in your site stylesheet or in this style block.
                                   We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */
                            </style>
                            <div id="mc_embed_signup">
                            <form action="//dreamtour.us12.list-manage.com/subscribe/post?u=a2ecdfab375a3f9a8e95cd3cb&amp;id=46aa5fb932" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                                <div id="mc_embed_signup_scroll">
                                <p>Daftar dan Dapatkan Daftar Paket Umroh dan Paket Wisata Terbaru </p>
                            <div class="mc-field-group">
                                <label for="mce-EMAIL"><span class="asterisk"></span>
                            </label>
                                <input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL" placeholder="Alamat Email">
                            </div>
                                <div id="mce-responses" class="clear">
                                    <div class="response" id="mce-error-response" style="display:none"></div>
                                    <div class="response" id="mce-success-response" style="display:none"></div>
                                </div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                                <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_a2ecdfab375a3f9a8e95cd3cb_46aa5fb932" tabindex="-1" value=""></div>
                                <div class="clear"><input type="submit" value="Berlangganan" name="subscribe" id="mc-embedded-subscribe" class="button button-primary"></div>
                                </div>
                            </form>
                            </div>
                            <script type='text/javascript' src='//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js'></script><script type='text/javascript'>(function($) {window.fnames = new Array(); window.ftypes = new Array();fnames[0]='EMAIL';ftypes[0]='email';fnames[1]='FNAME';ftypes[1]='text';fnames[2]='LNAME';ftypes[2]='text';}(jQuery));var $mcj = jQuery.noConflict(true);</script>
                            <!--End mc_embed_signup-->
                    </div>    
                </div><!--/.col-md-3-->

            </div>
        </div>
    </section><!--/#bottom-->  
    
    <section id="bottom">
        <div class="container wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
            <div class="row">
                <div class="col-md-4 col-sm-6">
                    <div class="widget">
                        <h3>Paket Umroh</h3>
                        <ul>
                            <li><a href="<?php echo base_url()?>umroh/paket_umroh_reguler">Paket Umroh Reguler </a></li>
                            <li><a href="<?php echo base_url()?>umroh/paket_umrah_plus_turki">Paket Umroh Plus </a></li>
                        </ul>
                    </div>    
                </div><!--/.col-md-3-->

                <div class="col-md-4 col-sm-6">
                    <div class="widget">
                        <h3>Paket Wisata</h3>
                        <ul>
                            <li><a href="<?php echo base_url()?>tour/muslim_tour">Paket Wisata Muslim Tour</a></li>
                            <li><a href="<?php echo base_url()?>tour/internasional">Paket Wisata Internasional Tour</a></li>
                            <li><a href="<?php echo base_url()?>tour/domestik">Paket Wisata Domestik Tour</a></li>
                            <li><a href="<?php echo base_url()?>tour/honeymoon">Paket WIsata Honeymoon</a></li>
                        </ul>
                    </div>    
                </div><!--/.col-md-3-->

                <div class="col-md-4 col-sm-6">
                    <div class="widget">
                        <h3>Newsletter</h3>
                        <!-- Begin MailChimp Signup Form -->
                            <link href="//cdn-images.mailchimp.com/embedcode/classic-081711.css" rel="stylesheet" type="text/css">
                            <style type="text/css">
                                #mc_embed_signup{background:; clear:; font:14px Helvetica,Arial,sans-serif; }
                                /* Add your own MailChimp form style overrides in your site stylesheet or in this style block.
                                   We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */
                            </style>
                            <div id="mc_embed_signup">
                            <form action="//dreamtour.us12.list-manage.com/subscribe/post?u=a2ecdfab375a3f9a8e95cd3cb&amp;id=46aa5fb932" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                                <div id="mc_embed_signup_scroll">
                                <p>Daftar dan Dapatkan Daftar Paket Umroh dan Paket Wisata Terbaru </p>
                            <div class="mc-field-group">
                                <label for="mce-EMAIL"><span class="asterisk"></span>
                            </label>
                                <input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL" placeholder="Alamat Email">
                            </div>
                                <div id="mce-responses" class="clear">
                                    <div class="response" id="mce-error-response" style="display:none"></div>
                                    <div class="response" id="mce-success-response" style="display:none"></div>
                                </div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                                <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_a2ecdfab375a3f9a8e95cd3cb_46aa5fb932" tabindex="-1" value=""></div>
                                <div class="clear"><input type="submit" value="Berlangganan" name="subscribe" id="mc-embedded-subscribe" class="button button-primary"></div>
                                </div>
                            </form>
                            </div>
                            <script type='text/javascript' src='//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js'></script><script type='text/javascript'>(function($) {window.fnames = new Array(); window.ftypes = new Array();fnames[0]='EMAIL';ftypes[0]='email';fnames[1]='FNAME';ftypes[1]='text';fnames[2]='LNAME';ftypes[2]='text';}(jQuery));var $mcj = jQuery.noConflict(true);</script>
                            <!--End mc_embed_signup-->
                    </div>    
                </div><!--/.col-md-3-->

            </div>
        </div>
    </section><!--/#bottom-->  

    <footer id="footer" class="midnight-blue">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <?php 
                date_default_timezone_set('Asia/Jakarta');
                $tanggal=date("Y");
                ?>
                    &copy; 2014 - <?= $tanggal; ?> <a target="_blank" href="#" >PT. Dream Tours and Travel</a>. All Rights Reserved.
                </div>
                <div class="col-sm-6">
                    <ul class="pull-right">
                        <li><a href="<?php echo base_url()?>web/home">Home</a></li>
                        <li><a href="<?php echo base_url()?>web/home#content">About Us</a></li>
                        <li><a href="#">Faq</a></li>
                        <li><a href="<?php echo base_url()?>web/contact">Contact Us</a></li> 
                        <li><a href="<?php echo base_url()?>career">Career</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer><!--/#footer-->

    <script src="<?php echo base_url()?>asset/js/jquery.js"></script>
    <script src="<?php echo base_url()?>asset/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url()?>asset/js/jquery.prettyPhoto.js"></script>
    <script src="<?php echo base_url()?>asset/js/jquery.isotope.min.js"></script>
    <script src="<?php echo base_url()?>asset/js/main.js"></script>
    <script src="<?php echo base_url()?>asset/js/wow.min.js"></script>
    
    <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-69298361-1', 'auto');
  ga('send', 'pageview');

</script>
    
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
</body>
</html>

