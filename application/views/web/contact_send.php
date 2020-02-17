<?php
 
if(isset($_POST['email'])) {
 
     
 
    // EDIT THE 2 LINES BELOW AS REQUIRED
 
    $email_to = "info@dreamtour.co";
 
    $email_subject = "Your email subject line";
 
     
 
     
 
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
 
        !isset($_POST['email']) ||
 
        !isset($_POST['phone']) ||
     
        !isset($_POST['comments'])) {
 
        died('We are sorry, but there appears to be a problem with the form you submitted.');       
 
    }
 
     
 
    $full_name = $_POST['full_name']; // required
 
    $email = $_POST['email']; // required
 
    $phone = $_POST['phone']; // required

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
 
     
 
    $email_message .= "Full Name: ".clean_string($full_name)."\n";
 
    $email_message .= "Email Address: ".clean_string($email)."\n";
 
    $email_message .= "Phone Number: ".clean_string($phone)."\n";

    $email_message .= "Comments: ".clean_string($comments)."\n";     
 
     
 
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
    <title>Kontak Kami | PT Dream Tours and Travel</title>
    
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
                                <li><a href="<?php echo base_url()?>umroh/paket_umroh_stop_over">Paket Umroh Stop Over</a></li>
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
                        <li class="active"><a href="<?php echo base_url()?>web/contact">Kontak Kami</a></li>                        
                    </ul>
                </div>
            </div><!--/.container-->
        </nav><!--/nav-->
        
    </header><!--/header-->
<section id="contact-info">
        <div class="center">                
            <h2>Bagaimana Cara Menjangkau Kami ?</h2>
        </div>
        <div class="gmap-area">
            <div class="container">
                <div class="row">
                    <div class="col-sm-5 text-center">
                        <div class="gmap">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.4801524324694!2d106.85127131547273!3d-6.200209662467463!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f4661cf87789%3A0x7d1183faf37c685c!2sPT+Dream+Tours+%26+Travel+(Dreamtour)!5e0!3m2!1sen!2sid!4v14570032676315" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                        </div>
                    </div>

                    <div class="col-sm-7 map-content">
                        <ul class="row">
                            <li class="col-sm-6">
                                <address>
                                    <h5>Head Office</h5>
                                    <p>Dream House, 1st Floor<br>
                                        Jl. Matraman, No 7, Jakarta Timur</p>
                                    <p>Telp +62 21 21381090, 21381095, 08119333000<br>
                                    Email : hello@dreamtour.co</p>
                                </address>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>  <!--/gmap_area -->

    <section id="contact-page">
        <div class="container">
            <div class="center">        
                <h2>Drop Your Message</h2>
            </div> 
            <div class="row contact-wrap"> 
                <form method="post" action="<?php echo base_url(); ?>index.php/web/contact/contact_send">
                    <div class="col-sm-5 col-sm-offset-1">
                        <div class="form-group">
                            <label>Full Name *</label>
                            <input type="text" name="full_name" class="form-control" required="required">
                        </div>
                        <div class="form-group">
                            <label>Email *</label>
                            <input type="email" name="email" class="form-control" required="required">
                        </div>
                        <div class="form-group">
                            <label>Phone</label>
                            <input type="number" name="phone" class="form-control" required="required">
                        </div>                       
                    </div>
                    <div class="col-sm-5">
                        <div class="form-group">
                            <label>Message *</label>
                            <textarea name="comments" id="comments" required="required" class="form-control" rows="8"></textarea>
                        </div>                        
                        <div class="form-group">
                            <button type="submit" name="submit" class="btn btn-primary btn-lg" required="required">Submit Message</button>
                        </div>
                    </div>
                </form> 
            </div><!--/.row-->
        </div><!--/.container-->
    </section><!--/#contact-page-->
    
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
 
<!-- include your own success html here -->
 
 
 
 
 
<?php
 
}
 
?>