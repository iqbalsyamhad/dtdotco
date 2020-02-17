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

                <h2 style="color:white">Check Your Point <b>Here!</b></h2>

                <div class="row"> 
                    <form class="form-inline" method="get" action="<?php echo base_url();?>member/cekPoin">
                        <div class="form-group">
                            <label for="" style="color:white">Masukkan Nomer Kartu</label>
                            <input type="text" class="form-control" name="q" placeholder="--.----.---" value="<?php if (isset($_GET['q'])){ echo $_GET['q']; } ?>">
                        </div>
                        <button type="submit" class="btn-primary">Cek</button>
                    </form> 
                </div><!--/.row-->
            </div> 
            <hr>

            <div class="row">
                <?php foreach ($poin as $row){ ?>
                <h2 style="color:yellow">Assalamualaikum <b><u><?= $row->nama; ?></u></b>. Jumlah Poin Anda adalah <b><u><?= $row->poin; ?></u></b> Poin.</h2>
                <?php } ?>

                <?php if (empty($poin)) { echo "<strong style='color:yellow'>Data tidak Ditemukan";} ?>
            </div>
                <!-- <div class="row">
                    <u><a href="#" data-toggle="modal" data-target="#myModal">Syarat dan Ketentuan*</a></u>
                </div> -->

                <div class="panel-body table_responsive">
                    <table class="table " style="background-color:white;">
                        <tr>                                    
                            <td align="center"><b>No.</b></td>
                            <td align="center"><b>Jenis Transaksi</b></td>    
                            <td align="center"><b>Poin</b></td>
                            <td align="center"><b>Transaksi</b></td>   
                            <td align="center"><b>Tanggal Transaksi</b></td>        
                        </tr>

                        <?php         
                        $a=0;
                        foreach($history as $row){
                        $a++; 
                            ?>
                            <tr><?php if ($row->kode_transaksi<>'-'){
                            ?>
                                <td style="color:green" align="center"><?= $a; ?></td>
                                <td style="color:green" align="center">Penambahan Poin</td>
                                <td style="color:green" align="center"><?= $row->poin; ?></td>
                                <td style="color:green" align="center"><?= $row->transaksi; ?></td>
                                <td style="color:green" align="center"><?= date("d-M-Y  ,   H:i",strtotime($row->time)); ?></td>
                            <?php }else{ ?>
                                <td style="color:red" align="center"><?= $a; ?></td>
                                <td style="color:red" align="center">Pengurangan Poin</td>
                                <td style="color:red" align="center"><?= $row->poin; ?></td>
                                <td style="color:red" align="center"><?= $row->transaksi; ?></td>
                                <td style="color:red" align="center"><?= date("d-M-Y  ,   H:i",strtotime($row->time)); ?></td>
                            <?php } 
                            ?>
                            </tr>
                            <?php
                        }
                        ?>

                    </table> 
                </div><!--/.row-->
            </div>
        </div><!--/.container-->
    </section><!--/#contact-page-->
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Syarat dan Ketentuan</h4>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-lg-12">
              <p>1. Matahari Club Card ("Kartu MCC") adalah kartu keanggotaan yang diterbitkan oleh PT Matahari Department Store Tbk  ("Matahari") yang ditujukan kepada konsumen yang berbelanja di Matahari Department Store dan telah memenuhi persyaratan keanggotaan MCC.
                2. Keanggotaan  MCC  terbuka untuk konsumen yang berdomisili di Indonesia dan telah memiliki Kartu Tanda Penduduk ("KTP") atau tanda pengenal lain yang sah dan masih berlaku. sesuai ketentuan pada syarat pendaftaran
                3. Kartu MCC hanya dapat dipergunakan oleh nama yang tertera pada Kartu MCC untuk maksud dan tujuan yang terkait dengan keanggotaan MCC. Anggota MCC bertanggungjawab penuh atas penggunaan Kartu MCC dan penggunaannya tunduk pada ketentuan yang ditentukan oleh Matahari.
                4. Nama yang dituliskan pada saat pendaftaran harus sama dengan nama yang tercantum pada KTP atau tanda pengenal yang diberikan.
                5. Matahari berhak menolak formulir pendaftaran yang tidak lengkap dan tidak memenuhi persyaratan tanpa pemberitahuan
                6. Matahari setiap saat berhak untuk membuat dan atau mengubah dan atau mengartikan dan atau menerapkan kebijakan dan mekanisme untuk keanggotaan MCC.
                7. Setiap aturan yang dibuat oleh Matahari mengikat bagi anggota MCC.
                8. Segala ketentuan dan pelaksanaan keanggotaan MCC tunduk pada hukum yang berlaku di Negara Republik Indonesia.
                9. Keanggotaan MCC tidak dapat dipindahtangankan atau diperjualbelikan.
                10. Kartu MCC adalah milik Matahari, apabila menemukan harap mengembalikan ke Matahari terdekat. 
                11. Semua manfaat dan keistimewaan masing-masing Kartu MCC berlaku sesuai dengan jenis kartu dan tidak dapat digabungkan.
                12. Dalam hal terdapat klausul pada Syarat dan Ketentuan keanggotaan MCC ini yang bertentangan dengan undang-undang yang berlaku, maka hal ini tidak akan mempengaruhi efektifitas klausul-klausul lain yang tidak bertentangan dengan undang-undang yang berlaku.
                13. Atas persetujuan calon atau Anggota MCC, Matahari berhak menggunakan dan memberikan informasi dan data personal anggota MCC untuk keperluan kerjasama dengan partner Matahari dan kepentingan operasional serta marketing Matahari, dan dengan ini Anggota MCC melepaskan Matahari dari segala risiko yang telah atau akan timbul sehubungan dengan penggunaan atau pemberian data Anggota MCC tersebut.
                14. Matahari tidak bertanggungjawab atas produk atau layanan yang diberikan atau ditawarkan oleh partner Matahari sebagai manfaat atau keistimewaan keanggotaan MCC.
                15. Program-program pemasaran atau program MCC lainnya yang dilaksanakan oleh Matahari hanya berlaku bagi anggota MCC yang ditentukan dalam program tersebut.
                16. Matahari tidak bertanggung jawab atas segala risiko yang ditimbulkan akibat penyalahgunaan keanggotaan MCC, termasuk tetapi tidak terbatas pada penyalahgunaan Kartu MCC dan manfaat serta keistimewaan keanggotaan MCC.
                17. Matahari berhak untuk melakukan pemeriksaan terhadap data anggota MCC setiap saat, tanpa memerlukan ijin dari anggota MCC. Apabila terdapat ketidaksesuaian informasi atau data, maka pemberian manfaat dan keistimewaan akan ditunda sampai Matahari mengeluarkan keputusan mengenai hal itu.
                18. Matahari memiliki kewenangan untuk melakukan tindakan apapun terhadap tiap pelanggaran peraturan dan ketentuan keanggotaan MCC.
                19. Semua keputusan yang dibuat oleh Matahari yang berkaitan dengan keanggotaan MCC bersifat mutlak dan tidak dapat diganggu gugat.
                20. Segala perselisihan yang timbul antara Matahari dan anggota MCC akan diselesaikan melalui musyawarah untuk mencapai mufakat. Apabila tidak tercapai kesepakatan maka penyelesaiannya akan dilakukan melalui Pengadilan Negeri Jakarta Selatan di Jakarta.
                KETENTUAN KHUSUS
                Keanggotaan Matahari  Club  Card (“Anggota MCC”)
                1. Persyaratan  untuk menjadi Anggota MCC adalah sebagai  berikut  :
                a. Mengisi formulir pendaftaran  dengan jujur, akurat dan tepat
                b. Membayar biaya pendaftaran keanggotaan MCC sesuai dengan jenis keanggotaan MCC.
                c. Menyerahkan dan menunjukkan KTP atau  tanda pengenal  lainnya yang masih berlaku.
                2.  Jenis keanggotaan MCC, adalah sebagai berikut :
                a. Beauty
                b. Premium
                c. Reguler
                3. Masa Berlaku Keanggotaan MCC
                Kecuali ditentukan lain oleh Matahari, masa berlaku keanggotaan MCC adalah sebagai berikut :
                a. Keanggotaan Beauty dan Premium : 1 (satu) tahun sejak tanggal pendaftaran keanggotaan MCC.
                Agar Anggota MCC tetap dapat menikmati manfaat dan keistimewaan keanggotaan MCC, perlu dilakukan perpanjangan keanggotaan MCC sebelum masa berlakunya berakhir.
                b. Keanggotaan Reguler : tidak ada pembatasan masa berlaku keanggotaan.
                4. Perpanjangan Keanggotaan MCC
                a. Perpanjangan kartu dilakukan sebagai tanda perpanjangan keanggotaan MCC. Perpanjangan dilakukan di Counter Informasi Matahari dengan membayar biaya  iuran tahunan dan mengisi ulang form aplikasi keanggotaan MCC.
                b. Kartu MCC dinyatakan aktif apabila telah dilakukan perpanjangan keanggotaan atau belum jatuh tempo dan tidak ada keputusan yang menyatakan lain.
                5. Perubahan Jenis Keanggotaan MCC
                a. Anggota MCC dapat mengubah jenis keanggotaan MCC dari Reguler ke Premium atau Beauty, dari keanggotaan Premium ke Beauty.
                b. Perubahan keanggotaan MCC dapat dilakukan apabila keanggotaan dalam keadaan aktif, mengisi  form aplikasi perubahan keanggotaan MCC, dan membayar biaya perubahan kartu sesuai dengan ketentuan. Poin  yang ada di kartu sebelumnya akan langsung berpindah ke Kartu MCC  yang baru dan kartu sebelumnya menjadi tidak berlaku. Matahari berhak menarik Kartu MCC yang sudah tidak berlaku.
                6. Pengakhiran Keanggotaan MCC
                Keanggotaan MCC akan berakhir apabila :
                a. Informasi dan atau data yang diberikan pada saat pendaftaran tidak benar.
                b. Anggota MCC meninggal dunia atau tidak berhak lagi menjalankan hak dan kewajibannya berdasarkan ketentuan undang-undang atau peraturan hukum yang berlaku.
                c. Penggunaan Kartu MCC yang tidak sesuai dengan kepemilikan dan peruntukan kartu.
                d. Melakukan atau terlibat perbuatan yang mencemarkan atau merusak nama Matahari.
                e. Mengundurkan diri atau diberhentikan dari keanggotaan MCC.

                7. Penggunaan MCC
                a. MCC berlaku di seluruh gerai Matahari,  Anggota MCC akan diminta untuk menunjukkan atau menyerahkan Kartu MCC kepada kasir sebelum melakukan pembayaran. Dengan menunjukkan atau menyerahkan Kartu MCC,  Anggota MCC dapat memperoleh Poin berdasarkan nilai transaksi.
                b. Pemegang kartu Beauty dan  Premium akan memperoleh berbagai fasilitas dan keuntungan sebagaimana tercantum pada form aplikasi pendaftaran keanggotaan dan katalog MCC berikut fasilitas dan keuntungan tambahan atau perubahannya.
                c. Anggota MCC dapat memperoleh fasilitas dan keuntungan lainnya baik yang diselenggarakan oleh Matahari atau partner Matahari dalam periode tertentu dan dengan memenuhi syarat dan ketentuan tertentu.
                d. Kartu MCC  tidak  dapat  dipergunakan sebagai  kartu debit, kartu kredit, kartu garansi, atau kartu lainnya, kecuali ditentukan lain oleh Matahari.
                8. Perolehan Poin
                a. Poin diperoleh dari  pembayaran pembelanjaan ("Transaksi") jumlah tertentu melalui mesin register  kasir di seluruh gerai Matahari ("Poin").
                b. Untuk dapat memperoleh Poin, Anggota MCC terlebih dahulu menunjukkan Kartu MCC kepada kasir sebelum melakukan Transaksi. Bila tidak, Transaksi tidak dicatat dan Anggota MCC tidak memperoleh Poin dari Transaksi yang dilakukan.
                c. Poin tidak dapat dipindahtangankan atau diperjualbelikan.
                d. Penghitungan Poin tidak berhubungan dengan alat pembayaran yang dipergunakan, kecuali  jika ditentukan lain oleh Matahari .
                e. Penghitungan Poin Anggota MCC dilakukan per Transaksi yang dilakukan oleh Anggota MCC, dimana pembelian setiap kelipatan Transaksi sebesar Rp 20.000,- akan mendapatkan poin, dengan ketentuan bahwa kartu Regular  mendapatkan 1 (satu) poin dan kartu Beauty dan Premium mendapatkan 2 (dua) poin  atau jumlah lain yang akan ditentukan oleh Matahari.
                f. Nilai Transaksi akan dibulatkan ke kelipatan Rp.20.000 (dua puluh ribu) terdekat dibawahnya untuk tujuan penghitungan Poin.
                g. Transaksi yang dilakukan dengan menggunakan atau menukarkan Poin, tidak akan mendapatkan Poin lagi.
                h. Poin yang diperoleh minimal 100 poin dapat ditukar dengan voucher MCC senilai Rp 10.000,- (sepuluh ribu rupiah) atau produk MCC lainnya yang ditentukan oleh Matahari.
                i. Anggota MCC dapat mengetahui jumlah Poin yang dikumpulkan melalui Call Centre Matahari, Customer Service di gerai Matahari atau Website Matahari Department Store.( www.matahari.co.id)
                9. Masa Berlaku Poin
                a. Apabila dalam waktu 12(dua belas) bulan sejak tanggal pembelanjaan terakhir, anggota MCC tidak menggunakan kartu MCC untuk berbelanja di gerai Matahari, maka poin akan dihapuskan
                b. Poin yang tidak ditukarkan dalam waktu 24 (dua puluh empat) bulan dari tanggal perolehan poin, maka poin tersebut akan dihapuskan (poin akan hangus dan tidak dapat dipergunakan lagi)
                10. Penukaran/Penggunaan Poin
                a. Penukaran atau penggunaan Poin harus dilakukan oleh Anggota MCC yang namanya tercantum pada Kartu MCC. Apabila terdapat keragu-raguan, Matahari akan meminta pembawa Kartu MCC untuk menunjukkan atau menyerahkan KTP atau kartu identitas lain yang sah dan berlaku sesuai dengan nama yang tercantum di Kartu MCC sebelum memberikan manfaat atau keistimewaan keanggotaan MCC.
                c. Poin dapat ditukarkan dengan produk lainnya sesuai dengan program dan ketentuan yang berlaku di Matahari.
                d. Bagi Anggota MCC yang hendak melakukan penukaran Poin, maka Kartu MCC harus dalam keadaan aktif dan jumlah Poin yang akan dipergunakan atau ditukarkan mencukupi.
                e. Anggota MCC tidak dapat menggunakan Poin yang diperoleh pada hari yang sama, Poin tersebut dapat digunakan minimum 1 (satu) bulan sejak tanggal perolehannya.
                f. Matahari dapat menentukan penggunaan atau penukaran Poin sebagai media pembayaran biaya perpanjangan keanggotaan MCC, perubahan jenis kartu, atau biaya lainnya yang terkait dengan keanggotaan MCC.
                g. Poin  tidak dapat ditukar dengan uang tunai dan hanya dapat digunakan sesuai dengan ketentuan yang berlaku di Matahari .
                h. Nilai dan penukaran Poin adalah sesuai dengan ketentuan yang ditetapkan oleh Matahari, dan dapat diubah sesuai dengan ketentuan yang ditetapkan Matahari. Setiap perubahan kebijakan atau ketentuan penukaran Poin tidak mempengaruhi jumlah Poin yang telah tercatat dalam system MCC sebelum tanggal perubahan kebijakan atau ketentuan tersebut.

                11.   Pembatalan Poin
                Apabila terjadi pengembalian barang ataupun pembatalan transaksi, maka  Matahari akan mengurangi setiap poin yang diperoleh dari pengembalian barang atau pembatalan transaksi tersebut.
                12.  Perubahan Data Pribadi Anggota MCC
                Anggota MCC dapat melakukan perubahan data pribadi dengan cara-cara sebagai berikut :
                a. Anggota MCC datang langsung ke Customer Service Matahari terdekat, mengisi formulir perubahan  data dan menandatanganinya sesuai dengan KTP / kartu identitas lain atas namanya yang sah dan masih berlaku, atau
                b. Anggota MCC dapat mengirim perubahan data melalui fax ke nomor (021) 5536110 dengan melampirkan foto copy MCC beserta foto copy KTP/kartu identitas lain atas namanya yang sah dan masih berlaku, atau
                c. Anggota MCC melakukan perubahan data langsung di website Matahari Department Store : ( www.matahari.co.id ) dan atau HALO MATAHARI 500838.
                13.  Lain-lain
                a. Kartu MCC diterbitkan dan dimiliki oleh Matahari sehingga Matahari memiliki hak untuk menerbitkan dan atau membatalkan dan atau memblokir Kartu MCC setiap saat tanpa persetujuan atau pemberitahuan kepada Anggota MCC.
                b. Tidak ada perubahan, perbaikan atau pengakhiran program yang akan mempengaruhi Poin yang telah diberikan.
                c. Dengan menandatangani form aplikasi keanggotaan MCC, Anggota / calon Anggota MCC dengan ini menyatakan telah memahami, menerima, dan menyetujui semua isi yang terdapat dalam ketentuan dan persyaratan ini.
                d. Ketentuan dan persyaratan ini merupakan satu kesatuan dan bagian yang tidak terpisahkan dari formulir pendaftaran keanggotaan MCC.

            </p>
        </div>
    </div>
</div>
</div>
</div>
</div>
</div>
</div>
