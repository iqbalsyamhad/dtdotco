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
<html lang="zxx">

<!-- Head -->
<head>

<meta name="google-site-verification" content="4P29uSHs7fYMai_sqywTOk4-VNlphvMVZ7QGh_3az_0" />
    <meta name="google-site-verification" content="T9vHs-0GUdWhue22iFWg-C_eCfYEbOnyV43ZrMscbIE" />

    <title>Travel Umroh Terbaik di Jakarta | PT Dream Tours and Travel</title>
    <link rel="shortcut icon" href="<?php echo base_url()?>asset/images/icon_dream.png">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="PT Dream Tours & Travel adalah Travel Umroh Terbaik di Jakarta yang akan membantu Anda untuk mendapatkan pelayanan yang terbaik untuk perjalanan Umroh dan Liburan. ">
    <link rel="alternate" hreflang="" href="http://www.dreamtour.co/" />
    <link rel="canonical" href="http://www.dreamtour.co/" />
    <meta name="author" content="Dream Tour">
    <meta name="robots" content="index, follow" />
    <meta name="googlebot" content="index, follow" />
    <meta name="keywords" content="travel umroh, travel umroh terbaik, travel umroh terbaik di jakarta" />
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

<!-- Supportive-JavaScript -->
<script src="<?php echo base_url()?>asset/odyssey/js/modernizr.js"></script>
<!-- //Supportive-JavaScript -->
        
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
                            <li><a class="" href="#w3portfolioaits"><span>Liburan</span></a></li>
                            <li><a class="" href="<?php echo base_url()?>sohibi"><span>Sohibi</span></a></li>
                            <li><a class="" href="<?php echo base_url()?>web/contact"><span>Kontak Kami</span></a></li>
                        </ul>
                    </nav>
                </div>
            </nav>
        </div>
        <div class="belakang" id="belakang">

    </div>
        <!-- //Navigation -->

    <!-- Contact -->
    <div class="agilecontactw3ls" id="agilecontactw3ls">
        <div class="container"><br><br><br>
            <div style="width:75%;margin:auto;" class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <strong>Success!</strong> Thank you for contacting us. We will be in touch with you very soon.
              </div>
            <h3>Kirimkan Pesan Anda Pada Kami</h3>
            <form method="post" action="<?php echo base_url(); ?>index.php/web/contact/contact_send">
                <div class="col-md-6 agilecontactw3ls-grid agilecontactw3ls-grid-1">
                    <input type="text" Name="full_name" placeholder="Nama Lengkap" required="">
                    <input type="text" Name="phone" placeholder="Nomor Telpon" required="">
                    <input type="email" Name="email" placeholder="Email" required="">
                </div>
                <div class="col-md-6 agilecontactw3ls-grid agilecontactw3ls-grid-2">
                    <textarea name="comments" placeholder="MESSAGE" required=""></textarea>
                    <div class="send-button">
                        <input type="submit" value="SEND">
                    </div>
                </div>
                <div class="clearfix"></div>
            </form>
        </div>
    </div>
    <!-- //Contact -->

    <!-- Map -->
    <div class="row">
        <div class="col-lg-6">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.4801524324694!2d106.85127131547273!3d-6.200209662467463!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f4661cf87789%3A0x7d1183faf37c685c!2sPT+Dream+Tours+%26+Travel+(Dreamtour)!5e0!3m2!1sen!2sid!4v14570032676315" width="100%" height="450" frameborder="1" style="border:1" allowfullscreen></iframe>
        </div>
        <div class="col-lg-6">
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15830.868923306183!2d112.742766!3d-7.272983!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xd1f0f164d1b54d29!2sPT+Dream+Tours+%26+Travel+(+Dreamtour+Surabaya)!5e0!3m2!1sen!2sid!4v1522124118524" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
        </div>
        
    </div>
        <!-- <div id="map"></div> -->
        

    <!-- //Map -->

    <!-- Social-Icons -->
    <div class="agilesocialwthree">
        <ul class="social-icons">
            <li><a href="#" class="facebook w3ls" title="Go to Our Facebook Page"><i class="fa w3ls fa-facebook-square" aria-hidden="true"></i></a></li>
            <li><a href="#" class="twitter w3l" title="Go to Our Twitter Account"><i class="fa w3l fa-twitter-square" aria-hidden="true"></i></a></li>
            <li><a href="#" class="googleplus w3" title="Go to Our Google Plus Account"><i class="fa w3 fa-google-plus-square" aria-hidden="true"></i></a></li>
            <li><a href="#" class="instagram wthree" title="Go to Our Instagram Account"><i class="fa wthree fa-instagram" aria-hidden="true"></i></a></li>
            <li><a href="#" class="youtube w3layouts" title="Go to Our Youtube Channel"><i class="fa w3layouts fa-youtube-square" aria-hidden="true"></i></a></li>
            <li><a href="#" class="pinterest w3layouts" title="Go to Our Pinterest Account"><i class="fa w3layouts fa-pinterest-square" aria-hidden="true"></i></a></li>
            <li><a href="#" class="tumblr w3layouts" title="Go to Our Tumblr Account"><i class="fa fa-tumblr-square" aria-hidden="true"></i></a></li>
        </ul>
    </div>
    <!-- //Social-Icons -->



    <!-- Footer -->
    <div class="agilefooterwthree" id="agilefooterwthree">
        <div class="container">

            <div class="agilefooterwthree-grids">
                <div class="col-md-4 agilefooterwthree-grid agilefooterwthree-grid1">
                    <h4>LINKS</h4>
                    <ul>
                       <li><a class="" href="<?php echo base_url()?>"><span>Home</span></a></li>
                        <li><a class="" href="<?php echo base_url()?>web/produk"><span>Produk</span></a></li>
                        <li><a class="" href="<?php echo base_url()?>umroh"><span>Umroh</span></a></li>
                        <li><a class="" href="<?php echo base_url()?>tour/wisata_tour"><span>Liburan</span></a></li>
                        <li><a class="" href="<?php echo base_url()?>web/sohibi"><span>Sohibi</span></a></li>
                        <li><a class="" href="<?php echo base_url()?>web/contact"><span>Kontak Kami</span></a></li>
                    </ul>
                </div>
                <div class="col-md-4 agilefooterwthree-grid agilefooterwthree-grid2">
                    <h4>Kantor Pusat</h4>
                    <address>
                        <ul>
                            <li>Dream House</li>
                            <li>Jalan Matraman No 7</li>
                            <li>Kebon Manggis, Matraman </li>
                            <li>Jakarta Timur</li>
                            <li>(021) 21381090, (021) 21381091, 0811933300</li>
                            <li><a class="mail" href="mailto:mail@example.com">info@dreamtour.co</a></li>
                        </ul>
                    </address>
                </div>
                <div class="col-md-4 agilefooterwthree-grid agilefooterwthree-grid3">
                    <h4>Kantor Cabang</h4>
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
            //telegram: "coba", // Telegram bot username
            company_logo_url: "//static.whatshelp.io/img/flag.png", // URL of company logo (png, jpg, gif)
            //greeting_message: "Assalammualaikum Wr Wb. Ada yang bisa kami bantu?", // Text of greeting message
            //call_to_action: "Message us", // Call to action
            button_color: "#E74339", // Color of button
            position: "left", // Position may be 'right' or 'left'
            order: "whatsapp" // Order of buttons
        };
        var proto = document.location.protocol, host = "whatshelp.io", url = proto + "//static." + host;
        var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = url + '/widget-send-button/js/init.js';
        s.onload = function () { WhWidgetSendButton.init(host, proto, options); };
        var x = document.getElementsByTagName('script')[0]; x.parentNode.insertBefore(s, x);
    })();
</script>

</html>

<?php
 
}
 
?>