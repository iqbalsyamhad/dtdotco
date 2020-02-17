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
                <div class="panel-body table_responsive">

                    <h2 style="color:white">Cek Poin Anda <b>Disini!</b></h2>

                    <div class="row"> 
                        <form class="form-inline" method="get" action="<?php echo base_url();?>cek_poin_sales/cekPoin">
                            <div class="form-group">
                                <label for="" style="color:white">Masukkan Nomer Kartu</label>
                                <input type="text" class="form-control" name="q" placeholder="--.----.---" value="<?php if (isset($_GET['q'])){ echo $_GET['q']; } ?>">
                            </div>
                            <button type="submit" class="btn-primary">Kirim</button>
                        </form> 
                    </div><!--/.row-->
                </div> 
                <hr>

                <div class="row">
                    <?php foreach ($poin as $row){ ?>
                        <h2 style="color:yellow">Assalamualaikum <b><u><?= $row->user_nama; ?></u></b>. Jumlah Poin Anda adalah <b><u><?= $row->total_poin; ?></u></b> Poin.</h2>
                    <?php } ?>
                     
                    <?php if (empty($poin)) { echo "<strong style='color:yellow'>Data tidak Ditemukan";} ?>
                </div>
                <!-- <div class="row">
                    <u><a href="#" data-toggle="modal" data-target="#myModal">Syarat dan Ketentuan*</a></u>
                </div> -->
            </div>
        </div><!--/.container-->
    </section><!--/#contact-page-->
