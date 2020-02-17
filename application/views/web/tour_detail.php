<section id="blog" class="container">

        <div class="blog">
            <div class="row">
                <div class="col-md-9">
                    <div class="blog-item">
                        <img class="img-responsive img-blog" src="<?php echo base_url()?>asset/images/tour/detail/<?= $gambar_detail; ?>" width="100%" alt="" />
                   

                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#home" data-toggle="tab">Highlight</a>
                                </li>
                                <li><a href="#profile" data-toggle="tab">Include</a>
                                </li>
                                <li><a href="#messages" data-toggle="tab">Exclude</a>
                                </li>
                                <li><a href="#settings" data-toggle="tab">Term And Condition</a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="home">
                                    <h4>Highlight</h4>
                                    <p><?=$tour_highlight ?></p><br>
                                    <a target="blank" href="<?php echo base_url()?>asset/file/<?= $file_itinerary?>"><button style="" class="btn btn-primary btn-md" required="required">Download Itinerary</button></a>
                                </div>
                                <div class="tab-pane fade" id="profile">
                                    <h4>Include</h4>
                                    <p><?=$include ?></p>
                                </div>
                                <div class="tab-pane fade" id="messages">
                                    <h4>Exclude</h4>
                                    <p><?=$exclude ?></p>
                                </div>
                                <div class="tab-pane fade" id="settings">
                                    <h4>Term And Condition</h4>
                                    <p><?= $term?></p>
                                </div>
                            </div> 
                        </div><!--/.blog-item-->
                </div><!--/.col-md-8-->

                <aside class="col-md-3">
                        <div class="single-profile-top">
                            <div class="media">
                                <div class="media-body">
                                    <h4><center><?= "$nama_tour" ?></center></h4>                                    
                                    <h4 style="color:red;"><center><?= "$ket1" ?></center></h4>
                                </div>
                            </div><!--/.media -->
                            <hr>
                            <p><?=$highlight ?> </p>

                            <form class="navbar-form navbar-right" method="get" style="margin-left:50px;margin-top:-5px" action="<?php echo base_url()?>web/tour/tour_book/">  
                                <input type="text" name="q" class="form-control" style="display: none" placeholder="" value="<?=$link ?>">
                                <button style="margin-left:-30%" type="submit" class="btn btn-primary btn-md"><i></i> BOOK NOW</button>
                            </form><br><br>

                            <hr>
                            <p>Ada Masalah atau Pertanyaan ?</p>
                            <p><i class="fa fa-phone-square"></i> +6221 3192 5065</p>
                        </div>       				
                </aside>     

            </div><!--/.row-->

         </div><!--/.blog-->

    </section><!--/#blog-->