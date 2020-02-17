<?php
 
if(isset($_POST['email'])) {
 
     
 
    // EDIT THE 2 LINES BELOW AS REQUIRED
    $recipients = array(
      "april.arkonada@dreamtour.co","holiday.tour@dreamtour.co"
      // more emails
    );
    $email_to = implode(',', $recipients); // your email address
 
    $email_subject = "Sales Request Tour";
 
     
 
     
 
    function died($error) {
 
        // your error code can go here
 
        echo "We are very sorry, but there were error(s) found with the form you submitted. ";
 
        echo "These errors appear below.<br /><br />";
 
        echo $error."<br /><br />";
 
        echo "Please go back and fix these errors.<br /><br />";
 
        die();
 
    }
 
     
 
    // validation expected data exists
 
    if(!isset($_POST['nama_sales']) ||
        !isset($_POST['email']) ||
        !isset($_POST['destination']) ||
 
        !isset($_POST['duration']) ||
 
        !isset($_POST['date']) || 
        !isset($_POST['participant']) ||     
        !isset($_POST['type']) ||     
        !isset($_POST['budget']) ||     
        !isset($_POST['service']) ||
        !isset($_POST['airlanes']) ||
        !isset($_POST['hotel']) ||
     
        !isset($_POST['meal']) ||
        !isset($_POST['breakfast']) ||
        !isset($_POST['pillow']) ||
        !isset($_POST['tl']) ||
        !isset($_POST['foc']) ||
        !isset($_POST['commission']) ||

        !isset($_POST['proposal']) ||
        !isset($_POST['specialrequest']) ||
        !isset($_POST['bidding']) ||
        !isset($_POST['company']) ||
        // !isset($_POST['pic']) ||
        // !isset($_POST['address']) ||
        // !isset($_POST['phone']) ||
        // !isset($_POST['hp']) || 

        !isset($_POST['itinerary']))     
        {
 
        died('We are sorry, but there appears to be a problem with the form you submitted.');       
 
    }
 
    $nama_sales = $_POST['nama_sales']; // required
    $email = $_POST['email']; // required
    $destination = $_POST['destination']; // required
 
    $duration = $_POST['duration']; // required
 
    $date = $_POST['date']; // required 
    $participant = $_POST['participant']; // required 
    $type = $_POST['type']; // required
    $budget = $_POST['budget']; // required 
    $service = $_POST['service']; // required
    $airlanes = $_POST['airlanes']; // required
    $hotel = $_POST['hotel']; // required
 
    $meal = $_POST['meal']; // required
    $breakfast = $_POST['breakfast']; // required
    $pillow = $_POST['pillow']; // required 
    $tl = $_POST['tl']; // required
    $foc = $_POST['foc']; // required
    $commission = $_POST['commission']; // required

    $proposal = $_POST['proposal']; // required
    $specialrequest = $_POST['specialrequest']; // required
    $bidding = $_POST['bidding']; // required 
    $company = $_POST['company']; // required
    // $pic = $_POST['pic']; 
    // $address = $_POST['address']; 
    // $phone = $_POST['phone']; 
    // $hp = $_POST['hp']; 

    $itinerary = $_POST['itinerary']; // required
    
 
    $error_message = "";
 
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
  if(!preg_match($email_exp,$email)) {
 
    $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
 
  }
 
    $string_exp = "/^[A-Za-z .'-]+$/";
 
  if(!preg_match($string_exp,$nama_sales)) {
 
    $error_message .= 'The First Name you entered does not appear to be valid.<br />';
 
  }
 
 
  if(strlen($itinerary) < 2) {
 
    $error_message .= 'The Comments you entered do not appear to be valid.<br />';
 
  }
 
  if(strlen($error_message) > 0) {
 
    died($error_message);
 
  }
 
    $email_message = "Request Tour. Dengan Detail Sebagai Berikut : .\n\n";
 
     
 
    function clean_string($string) {
 
      $bad = array("content-type","bcc:","to:","cc:","href");
 
      return str_replace($bad,"",$string);
 
    }
 
     
 
    $email_message .= "Nama Sales            : ".clean_string($nama_sales)."\n";
    $email_message .= "Email                 : ".clean_string($email)."\n";
    $email_message .= "-----------------------------------------------------------\n";
 
    $email_message .= "Destination           : ".clean_string($destination)."\n";
    $email_message .= "Duration              : ".clean_string($duration)."\n";
    
 
    $email_message .= "Date of Travelling    : ".clean_string($date)."\n"; 
    $email_message .= "Total Participant     : ".clean_string($participant)."\n";
    $email_message .= "Type of Request       : ".clean_string($type)."\n";  
    $email_message .= "Approx. Budget        : ".clean_string($budget)."\n"; 
    $email_message .= "-----------------------------------------------------------\n";

    $email_message .= "Level of Services     : ".clean_string($service)."\n";
    $email_message .= "Preferred Airlines    : ".clean_string($airlanes)."\n";
    $email_message .= "Hotel Category        : ".clean_string($hotel)."\n";  
    $email_message .= "Meal                  : ".clean_string($meal)."\n";     
    $email_message .= "Breakfast             : ".clean_string($breakfast)."\n";
    $email_message .= "Pillow Gift           : ".clean_string($pillow)."\n";  
    $email_message .= "Tour Leader           : ".clean_string($tl)."\n"; 

    $email_message .= "-----------------------------------------------------------\n";
    $email_message .= "FOC Request           : ".clean_string($foc)."\n";
    $email_message .= "Commission Request    : ".clean_string($commission)."\n";  
    $email_message .= "Proposal Deadline     : ".clean_string($proposal)."\n"; 
    $email_message .= "Special Request       : ".clean_string($specialrequest)."\n";
    $email_message .= "Bidding               : ".clean_string($bidding)."\n";  
    $email_message .= "Company Name          : ".clean_string($company)."\n"; 
    // $email_message .= "PIC                   : ".clean_string($pic)."\n";
    // $email_message .= "Address               : ".clean_string($address)."\n";  
    // $email_message .= "Phone / Fax           : ".clean_string($phone)."\n"; 
    // $email_message .= "Handphone             : ".clean_string($hp)."\n";
    $email_message .= "-----------------------------------------------------------\n";
    $email_message .= "Itinerary             : ".clean_string($itinerary)."\n";  
    
 
     
 
// create email headers
 
$headers = 'From: '.$email."\r\n".
 
'Reply-To: '.$email."\r\n" .
 
'X-Mailer: PHP/' . phpversion();
 
@mail($email_to, $email_subject, $email_message, $headers);  
 
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Sales Request Tour | PT Dream Tours and Travel</title>
    
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
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
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
    <script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $("select[name='jumlah_flight']").change(function(){
                $(this).find("option:selected").each(function(){
                    if($(this).attr("value")=="1"){
                        $(".total_hari").not(".1,.pnr").hide();
                        $(".1,.pnr").show();
                    }
                    else if($(this).attr("value")=="2"){
                        $(".total_hari").not(".1,.2,.pnr").hide();
                        $(".1,.2,.pnr").show();
                    }
                    else if($(this).attr("value")=="3"){
                        $(".total_hari").not(".1,.2,.3,.pnr").hide();
                        $(".1,.2,.3,.pnr").show();
                    }
                    else if($(this).attr("value")=="4"){
                        $(".total_hari").not(".1,.2,.3,.4,.pnr").hide();
                        $(".1,.2,.3,.4,.pnr").show();
                    }
                    else if($(this).attr("value")=="5"){
                        $(".total_hari").not(".1,.2,.3,.4,.5,.pnr").hide();
                        $(".1,.2,.3,.4,.5,.pnr").show();
                    }
                    else if($(this).attr("value")=="6"){
                        $(".total_hari").not(".1,.2,.3,.4,.5,.6,.pnr").hide();
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
                        <li class=""><a href="<?php echo base_url()?>web/home">Home</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Umroh <i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo base_url()?>umroh/paket_umroh_reguler">Paket Umroh Reguler</a></li>
                                <li><a href="<?php echo base_url()?>umroh/paket_umroh_plus">Paket Umroh Plus Wisata</a></li>
                                <li><a href="<?php echo base_url()?>umroh/biaya_umroh">Biaya Umroh</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Liburan <i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo base_url()?>tour/muslim_tour">Muslim Tour</a></li>
                                <li><a href="<?php echo base_url()?>tour/internasional">Internasional Tour</a></li>
                                <li><a href="<?php echo base_url()?>tour/domestik">Domestik Tour</a></li>
                                <li><a href="<?php echo base_url()?>tour/honeymoon">Honeymoon</a></li>
                            </ul>
                        </li>
                        <li><a href="<?php echo base_url()?>corporate">Corporate</a></li> 
                         <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Sewa Mobil<i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="http://happartners.com/id/dreamtour/">Internasional</a></li>
                                <li><a href="<?php echo base_url()?>sewa_mobil/indonesia">Indonesia</a></li>
                            </ul>
                        </li>
                        <li><a href="<?php echo base_url()?>sohibi">Sohibi</a></li> 
                        <li><a href="<?php echo base_url()?>web/contact">Kontak Kami</a></li>                        
                    </ul>
                </div>
            </div><!--/.container-->
        </nav><!--/nav-->
        
    </header><!--/header-->
<section id="contact-info">
        <div class="center">                
            <h2>Sales Request Tour</h2>
            <div style="width:75%;margin:auto;" class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <strong>Success!</strong> Thank you for contacting us. We will be in touch with you very soon.
            </div>
        </div>
        <div class="row contact-wrap"> 
            <form method="post" action="<?php echo base_url();?>requesttour/requesttour_send">
                <div class="col-sm-5 col-sm-offset-1">
                    <div class="form-group">
                        <label> Nama Sales * </label>
                        <input type="text" name="nama_sales" class="form-control" required="required">
                    </div>
                    <div class="form-group">
                        <label> Email * </label>
                        <input type="text" name="email" class="form-control" required="required">
                    </div>
                    <div class="form-group">
                        <label> Destination * </label>
                        <input type="text" name="destination" class="form-control" required="required" placeholder="contoh. Jepang">
                    </div>
                    <div class="form-group">
                        <label> Duration * </label>
                        <input type="text" name="duration" class="form-control" required="required" placeholder="contoh. 6 Day">
                    </div>
                    <div class="form-group">
                        <label> Date of Travelling * </label>
                        <input type="text" name="date" class="form-control" required="required" placeholder="contoh. 28/10/2015">
                    </div>
                    <div class="form-group">
                        <label> Total Participant * </label>
                        <input type="text" name="participant" class="form-control" required="required" placeholder="contoh. 6 Pax Adult ">
                    </div>
                    <div class="form-group">
                        <label> Type of Request * </label>
                        <input type="text" name="type" class="form-control" required="required" placeholder="">
                    </div>
                    <div class="form-group">
                        <label> Approx. Budget </label>
                        <input type="text" name="budget" class="form-control" placeholder="">
                    </div>
                    <div class="form-group">
                        <label> Level of Services </label>
                        <input type="text" name="service" class="form-control" placeholder="">
                    </div>
                    <div class="form-group">
                        <label> Preferred Airlines </label>
                        <input type="text" name="airlanes" class="form-control" placeholder="contoh. GARUDA/SQ/CX yang Termurah ">
                    </div>
                    <div class="form-group">
                        <label> Hotel Category </label>
                        <input type="text" name="hotel" class="form-control" placeholder="contoh. 3*/4* Dekat Bandara">
                    </div>
                    <div class="form-group">
                        <label> Meal </label>
                        <input type="text" name="meal" class="form-control" placeholder="contoh. Fullboard ">
                    </div>
                </div>
                
                <div class="col-sm-5">
                    <div class="form-group">
                        <label> Tour Leader * </label>
                        <input type="text" name="tl" class="form-control" required="required" placeholder="contoh. Include ">
                    </div>
                    <div class="form-group">
                        <label> FOC Request * </label>
                        <input type="text" name="foc" class="form-control" required="required" placeholder=" ">
                    </div>
                    <div class="form-group">
                        <label> Commission Request * </label>
                        <input type="text" name="commission" class="form-control" required="required" placeholder=" ">
                    </div>
                    <div class="form-group">
                        <label> Proposal Deadline </label>
                        <input type="text" name="proposal" class="form-control" placeholder="contoh. 3 Hari Setelah Tanggal Email Diterima">
                    </div>
                    <div class="form-group">
                        <label> Special Request </label>
                        <input type="text" name="specialrequest" class="form-control" placeholder=" ">
                    </div>
                    <div class="form-group">
                        <label> Bidding </label>
                        <input type="text" name="bidding" class="form-control" placeholder=" ">
                    </div>
                    <div class="form-group">
                        <label> Company Name * </label>
                        <input type="text" name="company" class="form-control" required="required" placeholder=" ">
                    </div>
                    <div class="form-group">
                        <label> Breakfast </label>
                        <input type="text" name="breakfast" class="form-control" placeholder="contoh. Mix ">
                    </div>
                    <div class="form-group">
                        <label> Pillow Gift </label>
                        <input type="text" name="pillow" class="form-control" placeholder=" ">
                    </div>
                    <!-- <div class="form-group">
                        <label> PIC * </label>
                        <input type="text" name="pic" class="form-control" required="required" placeholder="Pak Rudi ">
                    </div>
                    <div class="form-group">
                        <label> Address * </label>
                        <input type="text" name="address" class="form-control" required="required" placeholder="JL.Maju No. 87 ">
                    </div>
                    <div class="form-group">
                        <label> Phone / Fax * </label>
                        <input type="text" name="phone" class="form-control" required="required" placeholder="021 587855 ">
                    </div>
                    <div class="form-group">
                        <label> Handphone * </label>
                        <input type="text" name="hp" class="form-control" required="required" placeholder="08111222211 ">
                    </div> -->
                    <div class="form-group">
                        <label>Itinerary / Notes</label>
                        <textarea name="itinerary" class="form-control" rows="8"></textarea>
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








 
<!-- include your own success html here -->
 
 
 
 
 
<?php
 
}
 
?>