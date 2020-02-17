
<div id="page-wrapper">

  <div class="row">

    <div class="col-lg-12">
      <h1 class="page-header">KPI</h1>
      <!-- <ol class="breadcrumb">
        <li class="active">Data Lemburan</li>
      </ol>   -->                 
    </div>
    <!-- /.col-lg-12 -->
  </div>
<?php 
// untuk mengetahui siapa yang login
$level = $this->session->userdata('level');
$user_id = $this->session->userdata('user_id');
//form jika yang login adalah BOD
if ($level == 3) {
?>
    
    <h2> <span class="label label-info">View Update Performa BOD & GM</span> </h2>
    <form action="<?php echo base_url()?>kpi/updateperformabod" name="addem" method="POST"  id="addem">
      <div class="row">
      <div class="col-lg-12">       
          <div class="col-lg-4">
          <input type="hidden"  name="penilai" value="<?= $user_id ?>" />
          <h3>Ketertiban</h3>
            <label>- Seragam</label>
            <div>
              <input type="radio" name="satu1" id="kpi1.1"  value="20"> Iya &nbsp
              <input type="radio" name="satu1" id="kpi1.1"  value="0"> Tidak 
            </div>
            <label>- Ramah</label>
            <div>
              <input type="radio" name="satu2" id="kpi1.2"  value="20"> Iya &nbsp
              <input type="radio" name="satu2" id="kpi1.2"  value="0"> Tidak 
            </div>
            <label>- Kebersihan</label>
            <div>
              <input type="radio" name="satu3" id="kpi1.3"  value="20"> Iya &nbsp
              <input type="radio" name="satu3" id="kpi1.3"  value="0"> Tidak 
            </div>
            <label>- Ketenangan</label>
            <div>
              <input type="radio" name="satu4" id="kpi1.3"  value="20"> Iya &nbsp
              <input type="radio" name="satu4" id="kpi1.3"  value="0"> Tidak 
            </div>
            <label>- Kepatuhan</label>
            <div>
              <input type="radio" name="satu5" id="kpi1.3"  value="20"> Iya &nbsp
              <input type="radio" name="satu5" id="kpi1.3"  value="0"> Tidak  
            </div>
          </div>

          <!--<div class="col-lg-4">
          <h3> Kedisiplinan </h3>
            <label> Total Keterlambatan Bulan ini</label>
            <input type="number" name="dua1" value="" id="kpi2.1" onkeyup="calc(this)" class="form-control" disabled>
            <label> Total Masuk Bulan ini</label>
            <input type="number" name="dua2" value="" id="kpi2.2" onkeyup="calc(this)" class="form-control" disabled>
          </div> -->

          <div class="col-lg-4">
          <h3> Kecepatan</h3>
            <label> Range Nilai (1-10)</label>
            <input type="text" name="tiga" id="kpi3" name="kecepatan" onkeyup="calc(this)" class="form-control"/>
            <br>
            <h3> Kejujuran</h3>
            <label> Range Nilai (1-10)</label>
            <input type="text" id="kpi5" name="lima" onkeyup="calc(this)" class="form-control"/>
          </div>



      </div>
      </div>

      <!--<h1 class="page-header"> </h1>
      <div class="row">
      <div class="col-lg-12">
         <div class="col-lg-4">
          <h3> Absensi </h3>
            <label> Total tidak masuk (inc: izin & sakit)</label>
            <input type="number" name="empat"  id="kpi4.1" onkeyup="calc(this)" class="form-control" disabled />
         </div> 

         <div class="col-lg-4">
          <h3> Kejujuran</h3>
            <label> Range Nilai (1-10)</label>
            <input type="text" id="kpi5" name="lima" onkeyup="calc(this)" class="form-control"/>
          </div>

          <div class="col-lg-4">
          <h3> Total</h3>
            <label>Nilai Rata-Rata</label>
            <input type="" id="total" name="total" value="0" class="form-control"/>
            <input type="hidden" id="total" name="total" value="0" />
          </div> 
      </div>
      </div> -->
      <h1 class="page-header"> </h1>
      <div class="row">
      <div class="col-lg-12">
         <div class="col-lg-4">
          <label> Nama Karyawan</label>
          <select class="form-control" style="width:" name="karyawan" required>
            <option value="">-- Silahkan Pilih --</option>
              <?php
                $where['id_status'] = 1;
                $a = $this->db->get_where('status',$where)->row();
                $q = mysql_query("SELECT nama, user_lembur FROM `lembur_user` group by nama order by nama asc"); //choose the city from indonesia only
                  while ($row1 = mysql_fetch_array($q)){ ?>
                  <option value= <?=$row1['user_lembur']?>> <?= $row1['nama']?> </option>;                                                  
                <?php }?>
          </select><br>
         </div>
         <div class="col-lg-4">
            <label class="control-label" for="include">Bulan</label>
            <select name="bulan" class="form-control" required>
                <option>-- Pilih Bulan --</option>
                <option value="1">Januari</option>
                <option value="2">Februari</option>                                                    
                <option value="3">Maret</option>
                <option value="4">April</option>
                <option value="5">Mei</option>
                <option value="6">Juni</option>
                <option value="7">Juli</option>
                <option value="8">Agustus</option>
                <option value="9">September</option>
                <option value="10">Oktober</option>
                <option value="11">November</option>
                <option value="12">Desember</option>
            </select><br>

            <select name="tahun" class="form-control" required>
                <?php
                date_default_timezone_set('Asia/Jakarta');
                $year=date("Y");

                for ($i=2014; $i <= $year ; $i++) { 
                  if ($i == $year) { ?>
                   <option value='<?= $i?>' selected><?= $i?></option>
                <?php  }else{ ?>
                     <option value='<?= $i?>'><?= $i?></option>                                   
                <?php  }}  ?>
           </select>
        </div>

      </div>
      </div>
      <input type="submit" value="Simpan" name="tambah" class="btn btn-primary">

      

    </form>


    <script>
        var x = 0;
        var y = 0;
        var z = 0;
        function calc(obj) {
            var e = obj.id.toString();
            if (e == 'kpi3') {
                x = Number(obj.value);
                y = Number(document.getElementById('kpi5').value);
            } else {
                x = Number(document.getElementById('kpi3').value);
                y = Number(obj.value);
            }
            z = (x + y) / 2;
            document.getElementById('total').value = z;
            document.getElementById('update').innerHTML = z;
        }
    </script>
<?php 
}
// view untuk Login HR
if ($user_id == 12){ ?>
    <h2> <span class="label label-info">View Update Performa HR</span> </h2>
    <form action="<?php echo base_url()?>kpi/updateperformahr" name="addem" method="POST"  id="addem">
      <div class="row">
      <div class="col-lg-12">       
          <div class="col-lg-4">
          <input type="hidden"  name="penilai" value="<?= $user_id ?>" />
          <h3>Ketertiban</h3>
            <label>- Seragam</label>
            <div>
              <input type="radio" name="satu1" id="kpi1.1"  value="20"> Iya &nbsp
              <input type="radio" name="satu1" id="kpi1.1"  value="0"> Tidak 
            </div>
            <label>- Ramah</label>
            <div>
              <input type="radio" name="satu2" id="kpi1.2"  value="20"> Iya &nbsp
              <input type="radio" name="satu2" id="kpi1.2"  value="0"> Tidak 
            </div>
            <label>- Kebersihan</label>
            <div>
              <input type="radio" name="satu3" id="kpi1.3"  value="20"> Iya &nbsp
              <input type="radio" name="satu3" id="kpi1.3"  value="0"> Tidak 
            </div>
            <label>- Ketenangan</label>
            <div>
              <input type="radio" name="satu4" id="kpi1.3"  value="20"> Iya &nbsp
              <input type="radio" name="satu4" id="kpi1.3"  value="0"> Tidak 
            </div>
            <label>- Kepatuhan</label>
            <div>
              <input type="radio" name="satu5" id="kpi1.3"  value="20"> Iya &nbsp
              <input type="radio" name="satu5" id="kpi1.3"  value="0"> Tidak  
            </div>
          </div>

          <div class="col-lg-4">
          <h3> Kedisiplinan </h3>
            <label> Total Keterlambatan Bulan ini</label>
            <input type="number" name="dua1" value="" id="kpi2.1" onkeyup="calc(this)" class="form-control" >
            <label> Total Masuk Bulan ini</label>
            <input type="number" name="dua2" value="" id="kpi2.2" onkeyup="calc(this)" class="form-control" >
            <br>

            <h3> Absensi </h3>
            <label> Total tidak masuk (inc: izin & sakit)</label>
            <input type="number" name="empat1"  id="kpi4.1" onkeyup="calc(this)" class="form-control"  />
            <label> Total hari kerja bulan ini (inc: izin & sakit)</label>
            <input type="number" name="empat2"  id="kpi4.1" onkeyup="calc(this)" class="form-control"  />
          </div> 

          <div class="col-lg-4">
          
          </div> 


        
      </div>
      </div>

      <!--<h1 class="page-header"> </h1>
      <div class="row">
      <div class="col-lg-12">
         <div class="col-lg-4">
          <h3> Absensi </h3>
            <label> Total tidak masuk (inc: izin & sakit)</label>
            <input type="number" name="empat"  id="kpi4.1" onkeyup="calc(this)" class="form-control" disabled />
         </div> 

         <div class="col-lg-4">
          <h3> Kejujuran</h3>
            <label> Range Nilai (1-10)</label>
            <input type="text" id="kpi5" name="lima" onkeyup="calc(this)" class="form-control"/>
          </div>

          <div class="col-lg-4">
          <h3> Total</h3>
            <label>Nilai Rata-Rata</label>
            <input type="" id="total" name="total" value="0" class="form-control"/>
            <input type="hidden" id="total" name="total" value="0" />
          </div> 
      </div>
      </div> -->
      <h1 class="page-header"> </h1>
      <div class="row">
      <div class="col-lg-12">
         <div class="col-lg-4">
          <label> Nama Karyawan</label>
          <select class="form-control" style="width:" name="karyawan" required>
            <option value="">-- Silahkan Pilih --</option>
              <?php
                $where['id_status'] = 1;
                $a = $this->db->get_where('status',$where)->row();
                $q = mysql_query("SELECT nama, user_lembur FROM `lembur_user` group by nama order by nama asc"); //choose the city from indonesia only
                  while ($row1 = mysql_fetch_array($q)){ ?>
                  <option value= <?=$row1['user_lembur']?>> <?= $row1['nama']?> </option>;                                                  
                <?php }?>
          </select><br>
         </div>
         <div class="col-lg-4">
            <label class="control-label" for="include">Bulan</label>
            <select name="bulan" class="form-control" required>
                <option>-- Pilih Bulan --</option>
                <option value="1">Januari</option>
                <option value="2">Februari</option>                                                    
                <option value="3">Maret</option>
                <option value="4">April</option>
                <option value="5">Mei</option>
                <option value="6">Juni</option>
                <option value="7">Juli</option>
                <option value="8">Agustus</option>
                <option value="9">September</option>
                <option value="10">Oktober</option>
                <option value="11">November</option>
                <option value="12">Desember</option>
            </select><br>

            <select name="tahun" class="form-control" required>
                <?php
                date_default_timezone_set('Asia/Jakarta');
                $year=date("Y");

                for ($i=2014; $i <= $year ; $i++) { 
                  if ($i == $year) { ?>
                   <option value='<?= $i?>' selected><?= $i?></option>
                <?php  }else{ ?>
                     <option value='<?= $i?>'><?= $i?></option>                                   
                <?php  }}  ?>
           </select>
        </div>

      </div>
      </div>
      <input type="submit" value="Simpan" name="tambah" class="btn btn-primary">
    </form>


    <script>
        var x = 0;
        var y = 0;
        var z = 0;
        function calc(obj) {
            var e = obj.id.toString();
            if (e == 'kpi3') {
                x = Number(obj.value);
                y = Number(document.getElementById('kpi5').value);
            } else {
                x = Number(document.getElementById('kpi3').value);
                y = Number(obj.value);
            }
            z = (x + y) / 2;
            document.getElementById('total').value = z;
            document.getElementById('update').innerHTML = z;
        }
    </script>


  <?php 

  }  ?>
<!--
    <script>
        var x = 0;
        var y = 0;
        var z = 0;
        function calc(obj) {
            var e = obj.id.toString();
            if (e == 'tb1') {
                x = Number(obj.value);
                y = Number(document.getElementById('tb2').value);
            } else {
                x = Number(document.getElementById('tb1').value);
                y = Number(obj.value);
            }
            z = x + y;
            document.getElementById('total').value = z;
            document.getElementById('update').innerHTML = z;
        }
    </script>
</head>
<form name="addem" action="" id="addem" >    
    <span id="update">0</span>
    <p><input type="text" id="tb1" name="tb1" onkeyup="calc(this)"/>first textbox</p>
    <p><input type="text" id="tb2" name="tb2" onkeyup="calc(this)"/>second textbox</p>
    <input type="hidden" id="total" name="total" value="0" />
</form> -->




   
            <!-- /#page-wrapper -->

