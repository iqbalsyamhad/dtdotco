
<section class="pricing-page">
        <div class="container">
            <div class="center">        
                <h2>Enterance Ticket Reservation Form</h2>
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