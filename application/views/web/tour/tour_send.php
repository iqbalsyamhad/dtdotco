<?php
 
if(isset($_POST['email'])) {
 
     
 
    // EDIT THE 2 LINES BELOW AS REQUIRED
 
    $email_to = "it@dreamtour.co";
 
    $email_subject = "Tour Reservation";
 
     
 
     
 
    function died($error) {
 
        // your error code can go here
 
        echo "We are very sorry, but there were error(s) found with the form you submitted. ";
 
        echo "These errors appear below.<br /><br />";
 
        echo $error."<br /><br />";
 
        echo "Please go back and fix these errors.<br /><br />";
 
        die();
 
    }
 
     
 
    // validation expected data exists
 
    if(!isset($_POST['full_name']) ||
 
        !isset($_POST['phone']) ||
    
        !isset($_POST['tour_name']) ||
 
        !isset($_POST['tanggal_berangkat']) ||
    
        !isset($_POST['tanggal_pulang']) ||
 
        !isset($_POST['email']) ||
     
        !isset($_POST['comments'])) {
 
        died('We are sorry, but there appears to be a problem with the form you submitted.');       
 
    }
 
     
 
    $full_name = $_POST['full_name']; // required
 
    $phone = $_POST['phone']; // required

    $tour_name = $_POST['tour_name']; // required
 
    $tanggal_berangkat = $_POST['tanggal_berangkat']; // required

    $tanggal_pulang = $_POST['tanggal_pulang']; // required
 
    $email = $_POST['email']; // required

    $comments = $_POST['comments']; // required
 
     
 
    $error_message = "";
 
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
  if(!preg_match($email_exp,$email)) {
 
    $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
 
  }
 
    $string_exp = "/^[A-Za-z .'-]+$/";
 
  if(!preg_match($string_exp,$full_name)) {
 
    $error_message .= 'The First Name you entered does not appear to be valid.<br />';
 
  }
 
 
  if(strlen($comments) < 2) {
 
    $error_message .= 'The Comments you entered do not appear to be valid.<br />';
 
  }
 
  if(strlen($error_message) > 0) {
 
    died($error_message);
 
  }
 
    $email_message = "Form details below.\n\n";
 
     
 
    function clean_string($string) {
 
      $bad = array("content-type","bcc:","to:","cc:","href");
 
      return str_replace($bad,"",$string);
 
    }
 
     
 
    $email_message .= "Nama Lengkap: ".clean_string($full_name)."\n";
 
    $email_message .= "Nomor Telepon: ".clean_string($phone)."\n";
 
    $email_message .= "Alamat Email: ".clean_string($email)."\n";
   
    $email_message .= "Nama Tour: ".clean_string($tour_name)."\n";
 
    $email_message .= "Tanggal Berangkat: ".clean_string($tanggal_berangkat)."\n";
   
    $email_message .= "Tanggal Pulang: ".clean_string($tanggal_pulang)."\n";

    $email_message .= "Komentar / Pesan: ".clean_string($comments)."\n";     
 
     
 
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
    <title>Tour Booking | PT Dream Tours and Travel</title>
    
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
                        <li class="active dropdown">
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

    <section class="pricing-page">
        <div class="container">
            <div class="center">        
                <h2>Tour Reservation Form</h2>
              <div style="width:75%;margin:auto;" class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <strong>Success!</strong> Thank you for contacting us. We will be in touch with you very soon.
              </div>
            </div> 
            <div class="row contact-wrap"> 
                <form method="post" action="<?php echo base_url(); ?>tour/tour_send">
                    <div class="col-sm-5 col-sm-offset-1">
                        <div class="form-group">
                            <label>Full Name *</label>
                            <input type="text" name="full_name" class="form-control" required="required">
                        </div>
                        <div class="form-group">
                            <label>Phone *</label>
                            <input type="number" name="phone" class="form-control" required="required">
                        </div>             
                        <div class="form-group">
                            <label>Tour Name *</label>
                            <input type="text" name="tour_name" class="form-control" required="required">
                        </div> 
                        <div class="form-group">
                            <label>Tanggal Mulai *</label>
                            <div class="input-group date form_date" data-date="" data-date-format="dd-mm-yyyy" data-link-field="dtp_input2" data-link-format="dd-mm-yyyy">
                                <input type="text" name="tanggal_berangkat" class="form-control" required="required">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                            </div>
                        </div> 
                        <div class="form-group">
                            <label>Tanggal Selesai *</label>
                            <div class="input-group date form_date" data-date="" data-date-format="dd-mm-yyyy" data-link-field="dtp_input2" data-link-format="dd-mm-yyyy">
                                <input type="text" name="tanggal_pulang" class="form-control" required="required">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                            </div>
                        </div>                 
                    </div>
                    <div class="col-sm-5">
                        <div class="form-group">
                            <label>Email *</label>
                            <input type="email" name="email" class="form-control" required="required">
                        </div>
                        <div class="form-group">
                            <label>Comments *</label>
                            <textarea name="comments" id="comments" required="required" class="form-control" rows="8"></textarea>
                        </div>                        
                        <div class="form-group">
                            <input type="submit" value="SUBMIT" class="btn btn-primary btn-lg" />
                        </div>
                    </div>
                </form> 
            </div><!--/.row-->
        </div><!--/.container-->
    </section><!--/#contact-page-->

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