<?php
 
if(isset($_POST['email'])) {
 
     
 
    // EDIT THE 2 LINES BELOW AS REQUIRED
 
    $email_to = "tour@dreamtour.co";
 
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
    
        !isset($_POST['person']) ||
     
        !isset($_POST['comments'])) {
        
 
        died('We are sorry, but there appears to be a problem with the form you submitted.');       
 
    }
 
     
 
    $full_name = $_POST['full_name']; // required
 
    $email = $_POST['email']; // required
 
    $phone = $_POST['phone']; // required

    $person = $_POST['person']; // required

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
   
    $email_message .= "Number Of Person: ".clean_string($person)."\n";


    $email_message .= "Comments: ".clean_string($comments)."\n";     
 
     
 
// create email headers
 
$headers = 'From: '.$email."\r\n".
 
'Reply-To: '.$email."\r\n" .
 
'X-Mailer: PHP/' . phpversion();
 
@mail($email_to, $email_subject, $email_message, $headers);  
 
?>
 
<!DOCTYPE html>
<html lang="en">

<body>

   

    <section class="pricing-page">
        <div class="container">
            <div class="center">        
                <h2>Umrah Reservation Form</h2>
              <div style="width:75%;margin:auto;" class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <strong>Success!</strong> Thank you for contacting us. We will be in touch with you very soon.
              </div>
            </div> 
            <div class="row contact-wrap"> 
                <form method="post" action="<?php echo base_url(); ?>index.php/web/ticket/ticket_send">
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
                            <label>Phone *</label>
                            <input type="number" name="phone" class="form-control" required="required">
                        </div>             
                        <div class="form-group">
                            <label>Number of Person *</label>
                            <input type="text" name="person" class="form-control" required="required">
                        </div>       
                                   
                    </div>
                    <div class="col-sm-5">
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
</body>
</html>
 
<!-- include your own success html here -->
 
 
 
 
 
<?php
 
}
 
?>
