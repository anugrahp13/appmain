<?php
  $id_divisi = $this->session->userdata('id_divisi');
?>
<!-- Jumbotron -->
<div class="jumbotron text-center" style="background-image:url('<?php echo base_url(); ?>assets/admin/skin/img/doodle.jpg')">
  <img src="<?php echo base_url();?>assets/admin/skin/img/logo_lp3i.png" class="img-circle">
  <h1>Politeknik LP3I Jakarta Kampus Pondok Gede</h1>
  <p>LP3I Tepat & Cepat Kerja</p>
</div>
<!-- Akhir Jumbotron -->

<!-- About -->
<section class="about" id="about">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <h2 class="text-center">Tentang</h2>
        <hr>
      </div>
    </div>

    <div class="row">
      <div class="col-sm-5 col-sm-offset-1">
        <p class="pLeft">Terilhami oleh rasa Nasionalisme yang tinggi dan sangat peduli dengan dunia pendidikan maka pada tahun 1997, LP3I menambah cabang di wilayah Pondok Gede. Kampus Pondok Gede Pertama kali diresmikan oleh Menteri Pendidikan dan Kebudayaan Republik Indonesia Prof.Dr.Ing.Wardiman Djojonegoro pada tanggal 27 Maret 1997 di Plaza Mall Pondok Gede. Pada Tahun 2006, seiring dengan perkembangannya, bergabung seorang pengusaha muda yang bernama Ir.Pung Parmadi,M.Si. Beliau adalah seorang Master of Science lulusan sebuah universitas di negara Sakura. Beliau pula yang menggagas visi kampus Pondok Gede menjadi kampus yang ber-Cahaya Illahi. Atas usaha dan dedikasi yang dilakukan oleh beliau maka pada tahun 2009, kampus Pondok Gede menempati gedung baru di Jl. Raya Hankam No.39 Pondok Gede. Saat ini kampus Pondok Gede dikelola oleh manajemen dengan payung hukum PT. Anak Bangsa Gemilang dengan No.SIUP : 510/41-BPPT/PM/I/2012 dan No.NPWP : 31.439.460.2-432.000. Kampus Pondok Gede dipimpin oleh bapak A.Suarna Dijaya sebagai Kepala Kampus. Beliau merupakan Master Of Mind Provocator dan peraih Rekor MURI.</p>
      </div>
      <div class="col-sm-5">
        <p class="pRight">Manajemen Operasional Politeknik LP3I Jakarta Kampus Pondok Gede terdiri dari tiga bidang utama yaitu Bidang Akademik (BAK) dipimpin oleh Kepala Bidang Akademik yang bertanggung jawab dalam Kegiatan Operasional Pelayanan Akademik. Kedua, Bidang Keuangan (BKU) yang dipimpin oleh Kepala Bidang Keuangan yang bertanggung jawab dalam Kegiatan Operasional Keuangan meliputi kegiatan Transaksi dan Akutansi. Dan ketiga, adalah Bidang Kerjasama dan Kemahasiswaan (BKM) yang dipimpin oleh Kepala Bidang Kerjasama dan Kemahasiswaan yang bertanggung jawab dalam kegiatan operasional kerjasama dan penempatan kerja di perusahaan serta bertanggung jawab dalam kegiatan kemahasiswaan dan alumni. Kampus Pondok Gede memiliki 8 ruang kelas, dengan 2 ruang laboratorium komputer, 1 ruang aula yang dapat menampung � 100 orang, 1 ruang radio, 1 ruang perpustakaan berikut ruang baca, 1 mushola yang dapat menampung � 50 orang, 1 ruang klinik konsultasi dan pemeriksaan kesehatan, 1 lapangan badminton indoor, 1 ruang kantin yang dapat menampung � 50 orang, ruang HIMA terbuka, ruang basement yang dapat menampung 10 kendaraan dan 100 buah motor. Insya Allah dalam waktu dekat, kampus Pondok Gede akan menambah sarana dan fasilitasnya seperti cafe corner, ruang alumni, perluasan parkir dan asrama mahasiswa bagi mahasiswa yang berasal dari luar kota.</p>
      </div>
    </div>
  </div>
</section>
<!-- Akhir About -->

<!-- Program -->
<section class="program" id="program">
  <div class="container">
    <div class="row">
      <div class="col-sm-12 text-center">
        <h2>Program</h2>
        <hr>
      </div>
    </div>

    <div class="row">
      <div class="col-sm-4">
        <a href="<?php if($id_divisi == "1" || $id_divisi == "0"){ echo base_url()."d.php/dash";}else{echo "#";} ?>" class="<?php if($id_divisi == "1" || $id_divisi == "0"){ echo "thumbnail";}else{ echo "imggelap thumbnail";} ?>">
          <img src="<?php echo base_url();?>assets/admin/skin/img/iconapp/academic.jpg">
        </a>
      </div>
      <div class="col-sm-4">
        <?php
          $url = "#";
          if($id_divisi == "2" || $id_divisi == "0"){
            if($this->session->userdata('id_jabatan') == "404"){
              $url = base_url()."c.php/user";
            }else{
              $url = base_url()."c.php/admin/rencanakerja";
            }
          }
        ?>
        <a href="<?php echo $url; ?>" class="<?php if($id_divisi == "2" || $id_divisi == "0"){ echo "thumbnail";}else{ echo "imggelap thumbnail";} ?>">
          <img src="<?php echo base_url();?>assets/admin/skin/img/iconapp/cnp.jpg">
        </a>
      </div>
      <div class="col-sm-4">
        <a href="#" class="<?php if($id_divisi == "3" || $id_divisi == "0"){ echo "thumbnail";}else{ echo "imggelap thumbnail";} ?>">
          <img src="<?php echo base_url();?>assets/admin/skin/img/iconapp/ict-soon.jpg">
        </a>
      </div>
      <div class="col-sm-4">
        <a href="#" class="<?php if($id_divisi == "4" || $id_divisi == "0"){ echo "thumbnail";}else{ echo "imggelap thumbnail";} ?>">
          <img src="<?php echo base_url();?>assets/admin/skin/img/iconapp/finance-soon.jpg">
        </a>
      </div>
      <div class="col-sm-4">
        <a href="#" class="<?php if($id_divisi == "5" || $id_divisi == "0"){ echo "thumbnail";}else{ echo "imggelap thumbnail";} ?>">
          <img src="<?php echo base_url();?>assets/admin/skin/img//iconapp/marketing-soon.jpg">
        </a>
      </div>
      <div class="col-sm-4">
        <a href="#" class="<?php if($id_divisi == "6" || $id_divisi == "0"){ echo "thumbnail";}else{ echo "imggelap thumbnail";} ?>">
          <img src="<?php echo base_url();?>assets/admin/skin/img/iconapp/personalia-soon.jpg">
        </a>
      </div>
    </div>
  </div>
</section>
<!-- Akhir Program -->

<!-- Modal Message to ICT -->
<div class="modal fade" id="message">
  <div class="vertical-alignment-helper">
    <div class="modal-dialog modal-sm vertical-align-center">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" arial-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Kirim Pesan Untuk ICT</h4>
        </div>
        <div class="modal-body">
          <form method="post" action="<?php echo base_url();?>index.php/pesan/kirim">
            <div class="form-group">
              <label>Nama Lengkap</label>
              <input type="text" id="namalengkaptambah" name="nama_lengkap" class="form-control" placeholder="Nama Lengkap" required>
            </div>
            <div class="form-group">
              <label>Pesan</label>
              <textarea class="form-control" rows="3"></textarea>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <input type="submit" class="btn btn-primary" name="simpandata" value="Kirim">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Akhir Modal Message to ICT -->

<script type="text/javascript">
  function openmodal(id){
    $('#'+id).modal('show');
  }
</script>
