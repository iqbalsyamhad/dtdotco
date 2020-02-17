    <div id="page-wrapper">



        <div id="wrapper">
            <div id="page-wrapper-adm">

                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">List PNR</h1>                        
                    </div>
                    <!-- /.col-lg-12 -->
                </div>

                <div>
                   <form action="<?php echo base_url()?>lobc/lihat_pnr" name="addem" method="POST"  id="addem">
                       <div class="col-md-3">
                           <div class="form-group">
                               <label class="control-label" for="include">Tanggal Awal</label>
                               <input type="date"  name="tanggal_awal" class="form-control" required> 
                           </div> 
                       </div> 

                       <div class="col-md-3"> 
                           <div class="form-group">
                               <label class="control-label" for="include">Sampai Tanggal</label>
                               <input type="date"  name="tanggal_akhir" class="form-control" required>                           
                       </div>
                   </div> 
                   <div class="col-md-1"> 
                       <div class="form-group">
                           <label class="control-label" for="include">Lihat</label><br>
                           <input type="submit" value="Lihat" name="tambah" class="btn btn-primary">
                       </div>
                   </div>
               </form>        
               </div>

               <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            List LOBC
                        </div>
                        <!-- /.panel-heading -->  

                        <div>
                             <form action="<?php echo base_url()?>lobc/lihat_seat_tersedia" name="addem" method="POST"  id="addem">                                  
                                 <div class="row">
                                 <div class="col-lg-8"> 
                                    <div class="col-lg-4">
                                     <div class="form-group"><br>
                                         <label class="control-label" for="include">Cek PNR Tersedia</label><br>
                                         <input type="submit" value="Cek" name="tambah" class="btn btn-primary">
                                     </div>
                                     </div>
                                     </form> 
                                    <div class="col-lg-4">
                                    <form action="<?php echo base_url()?>lobc/lihat_seat_terpakai" name="addem" method="POST"  id="addem">
                                     <div class="form-group"><br>
                                         <label class="control-label" for="include">Cek PNR Terpakai (0)</label><br>
                                         <input type="submit" value="Cek" name="tambah" class="btn btn-primary">
                                     </div>
                                 </div>
                                 </div>
                                 </div>
                             </form>        
                         </div>                          

                        <div class="panel-body">     
                            <div class="row">
                                <div class="col-lg-12"> 
                                   <table class="table table-bordered" border="1">
                                    <tbody>
                                        <tr>
                                            <td align="center" rowspan="2" width="5%"><b>No.</td>
                                            <td align="center" rowspan="2" width="10%"><b>PNR</td>
                                            <td align="center" colspan="3" width="20%"><b>Tanggal Berangkat</td>
                                            <td align="center" colspan="3" width="20%"><b>Tanggal Pulang</td>
                                            <td align="center" rowspan="2" width="8%"><b>Sisa Seat</td>
                                            <td align="center" rowspan="2" width="7%"><b>Seat Terpakai</td>
                                            <td align="center" rowspan="2" width="15%"><b>Total Seat</td>
                                            <td align="center" rowspan="2" width="10%"><b>Aksi</td>
                                        </tr> 
                                        <tr>
                                            <td align="center"><b>Tanggal</b></td>
                                            <td align="center"><b>Flight </b></td>
                                            <td align="center"><b>Dep</b></td>

                                            <td align="center"><b>Tanggal</b></td>
                                            <td align="center"><b>Flight </b></td>
                                            <td align="center"><b>Arr</b></td>
                                        </tr>

                                        <?php 
                                        $i = 0;                                            
                                        foreach($list as $row){ 
                                            $i++; 
                                            //hitung sisa seat & seat terpakai
                                            $pnr = $row->pnr;
                                            $tanggal = $row->tanggal_berangkat;
                                            $tanggal_pulang = $row->tanggal_pulang;
                                            $total_seat = $row->kuota_seat;
                                            $id = $row->id;
                                            $flight_no_berangkat = $row->flight_no_berangkat;
                                            $dep_berangkat = $row->dep_berangkat;
                                            $flight_no_pulang = $row->flight_no_pulang;
                                            $arr_pulang = $row->arr_pulang;

                                            //seat terpakai
                                            $sum ="select sum(seat_booked) as sum
                                            from lobc, lobc_pnr
                                            where  lobc_pnr.pnr = '$pnr' and lobc.pnr = lobc_pnr.id ";
                                            $maxquery= mysql_query($sum);
                                            if ($row = mysql_fetch_assoc($maxquery)) {
                                                $seat_terpakai=$row['sum']; }
                                                else {
                                                    $seat_terpakai = 0 ;
                                                }

                                            //sisa seat
                                                $sisa_seat = $total_seat - $seat_terpakai; 

                                                ?>
                                                <tr>
                                                    <td><?= $i; ?></td>
                                                    <td><?= $pnr?></td>
                                                    <td><?= date("d-M-Y",strtotime($tanggal)); ?></td>
                                                    <td><?= $flight_no_berangkat; ?></td>
                                                    <td><?= $dep_berangkat; ?></td>

                                                    <td><?= date("d-M-Y",strtotime($tanggal_pulang)); ?></td>
                                                    <td><?= $flight_no_pulang ?></td>
                                                    <td><?= $arr_pulang ?></td>
                                                    <td><?= $sisa_seat ?></td>
                                                    <td><?= $seat_terpakai ?></td>
                                                    <td><?= $total_seat ?></td>
                                                    <td>
                                                        <a  href="<?php echo base_url()?>lobc/editPNR/<?php echo $id?>" class="btn-sm btn-warning" title="Ubah">Edit <span class="fa fa-edit fa-fw"> </span></a>
                                                    </td>
                                                
                                                    
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>     
                                    </div>     
                                </div> 
                            </div>      
                        </div>
                    </div>
                </div>                
            </div>
            <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->


        <!-- Core Scripts - Include with every page -->
        <script type="text/javascript" src="<?php echo base_url()?>asset/js/jquery-1.10.2.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url()?>asset/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url()?>asset/js/jquery.metisMenu.js"></script>

        <!-- SB Admin Scripts - Include with every page -->

        <script type="text/javascript" src="<?php echo base_url()?>asset/js/sb-admin.js"></script>


        <!-- Page-Level Demo Scripts - Dashboard - Use for reference -->
        <script type="text/javascript" src="<?php echo base_url()?>asset/js/dashboard-demo.js"></script>
        <script src="text/javascript" src="<?php echo base_url()?>asset/js/jqBootstrapValidation.js"></script>














