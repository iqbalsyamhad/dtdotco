    <style type="text/css">
    .member {
      background-image: url("<?php echo base_url()?>asset/images/member.jpg");
      background-position: 0 0;
      background-repeat: no-repeat;
      background-size: cover ;
      padding: 70px 0;
    }
    </style>
    <div class="member" style="min-height:480px;">
        <div class="container">
            <div class="center">        
                <h2 style="color:white">Check Your Point <b>Here!</b></h2>

                <div class="row"> 
                    <form class="form-inline" method="get" action="<?php echo base_url();?>member/cekPoin">
                        <div class="form-group">
                            <label for="" style="color:white">Masukkan Nomer Kartu</label>
                            <input type="text" class="form-control" name="q" placeholder="--.----.---" value="<?php if (isset($_GET['q'])){ echo $_GET['q']; } ?>">
                        </div>
                        <button type="submit" class="btn-primary">Kirim</button>
                    </form> 
                </div><!--/.row-->
            </div> 
        </div><!--/.container-->
    </div><!--/#contact-page-->

