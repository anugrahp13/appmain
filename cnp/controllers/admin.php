<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin extends CI_Controller {
  function __construct()
  {
    parent::__construct();
    $this->load->model('global_model');
    $this->load->helper('url');
    $this->load->library('session');
    $this->load->model('sysalert');
    $this->load->model('sysctrl');

    $sidjabatan = $this->session->userdata('id_jabatan');
    $siddivisi = $this->session->userdata('id_divisi');
    if((!$siddivisi == "2" && !$sidjabatan=="3") || (!$siddivisi == "2" && !$sidjabatan=="4") || !$this->session->userdata('id_jabatan') == "99" || !$this->session->userdata('id_jabatan') == "100"){
      redirect(base_url());
    }

    // Load library
		$this->load->library('dompdf_gen');
  }

  public function index()
  {
    redirect(site_url('admin/rencanakerja'));
    $this->load->view('header/admin');
    $this->load->view('konten/admin/index');
    $this->load->view('footer/admin');
  }

  public function ajaxnamaujian(){
    $idhead = $this->input->post('idhead');
    $data['loadpartisipasi'] = $this->global_model->find_all('partisipasi_ujian');

    if($idhead != "semua"){
      $data['loadpartisipasi'] = $this->global_model->find_all_by('partisipasi_ujian', array('id_headersoal'=>$idhead));
    }

    $this->load->view('konten/admin/loadnamaujian',$data);
  }
  public function reviewjawaban($id = null){
    $konten = "konten/admin/reviewjawaban";
    $data['loadnamaujian'] = $this->global_model->find_all('header_ujian');
    $data['loadpartisipasi'] = $this->global_model->find_all('partisipasi_ujian');
    if($id != null){
      $check = $this->global_model->find_by('partisipasi_ujian', array('id_partisipasi'=>$id));
      if(empty($check)){
        redirect(site_url('admin/reviewjawaban'));
      }

      $konten = "konten/admin/lihatjawaban";
      $data['loadheader'] = $this->global_model->find_by('header_ujian', array('id_headersoal'=>$check['id_headersoal']));
      $data['idnih'] = $check['id_profil'];
    }
    $data['loaddata'] = $this->global_model->find_all('partisipasi_ujian');
    $this->load->view('header/admin');
    $this->load->view($konten,$data);
    $this->load->view('footer/admin');
  }

  //pengaturan waktu
  public function p_waktu(){
    if($this->input->post('simpan')){
      $data = $this->input->post();
      unset($data['simpan']);

      $status = 0;
      if($data['jam_buat'] > $data['evaluasi_jam']){
        $this->sysalert->message('danger','Batas Jam Buat tidak boleh melebihi Batas Jam Evaluasi','pwaktu');
        $status = 1;
      }else if($data['jam_buat'] == $data['evaluasi_jam']){
        $this->sysalert->message('danger','Batas Jam Buat tidak boleh sama dengan Batas Jam Evaluasi','pwaktu');
        $status = 1;
      }

      if($status == 0){
        $check = array(
          'inputcheck' => 'id_profil,tanggal,jam_buat,evaluasi_jam',
          'mode' => '1',
          'ictexterror' => 'Nama Peserta,Tanggal,Batas Jam Buat,Batas Jam Evaluasi',
          'checkdata' => 'id_profil,tanggal',
          'controller' => 'pwaktu',
          'redirect' => 'admin/p_waktu'
        );

        $this->sysctrl->proses('p_waktu', $data, $check);
      }else{
        redirect(site_url('admin/p_waktu'));
      }
    }

    $data['loadpeserta'] = $this->global_model->find_all('pkt_profil');
    $data['loaddata'] = $this->global_model->find_all('p_waktu');
    $data['loadwaktudasar'] = $this->global_model->find_by('p_waktudasar', array('id_waktudasar'=>1));
    $this->load->view('header/admin');
    $this->load->view('konten/admin/p_waktu',$data);
    $this->load->view('footer/admin');
  }

  public function hapusaturwaktu($id){
    if($this->global_model->delete('p_waktu', array('id_pwaktu' => $id))){
      $this->sysalert->message('danger', 'Gagal menghapus rencana kerja', 'pwaktu');
    }else{
      $this->sysalert->message('success', 'Rencana kerja berhasil di hapus', 'pwaktu');
    }

    redirect(site_url('admin/p_waktu'));
  }

  public function tampilatur($id){
    $a = $this->global_model->find_by('p_waktu', array('id_pwaktu'=>$id));
    echo json_encode($a);
  }

  public function editatur($id){
    if($this->input->post('simpan')){
      $data = $this->input->post();
      $data['id_pwaktu'] = $id;
      unset($data['simpan']);

      $status = 0;
      if($data['jam_buat'] > $data['evaluasi_jam']){
        $this->sysalert->message('danger','Batas Jam Buat tidak boleh melebihi Batas Jam Evaluasi','pwaktu');
        $status = 1;
      }else if($data['jam_buat'] == $data['evaluasi_jam']){
        $this->sysalert->message('danger','Batas Jam Buat tidak boleh sama dengan Batas Jam Evaluasi','pwaktu');
        $status = 1;
      }

      if($status == 0){
        $check = array(
          'inputcheck' => 'jam_buat,evaluasi_jam',
          'ictexterror' => 'Batas jam buat,Batas jam evaluasi',
          'mode' => '2',
          'idfield' => 'id_pwaktu',
          'id' => $id,
          'checkdata' => 'id_pwaktu',
          'controller' => 'pwaktu',
          'redirect' => 'admin/p_waktu'
        );

        $this->sysctrl->proses('p_waktu', $data, $check);
      }else{
        redirect(site_url('admin/p_waktu'));
      }

    }
  }
  public function waktuawal(){
    if($this->input->post('simpan')){
      $data = $this->input->post();
      unset($data['simpan']);
      if($this->input->post('jam_buat')==null){
        $this->sysalert->message('danger', 'Batas Jam Buat tidak boleh kosong','pwaktu');
      }else if($this->input->post('evaluasi_jam')==null){
        $this->sysalert->message('danger', 'Batas Jam Evaluasi tidak boleh kosong','pwaktu');
      }else if($data['jam_buat'] == $data['evaluasi_jam']){
        $this->sysalert->message('danger','Batas Jam Buat tidak boleh sama dengan Batas Jam Evaluasi','pwaktu');
      }else if($data['jam_buat'] > $data['evaluasi_jam']){
        $this->sysalert->message('danger','Batas Jam Buat tidak boleh melebihi Batas Jam Evaluasi','pwaktu');
      }else{
        $this->global_model->update('p_waktudasar', $data, array('id_waktudasar'=>1));
        $this->sysalert->message('success', 'Data berhasil di perbarui','pwaktu');
      }

      redirect(site_url('admin/p_waktu'));
    }
  }
  //end pengaturan waktu

  //cetak
  public function ajaxcetakperiode(){
    $a = $this->input->post('tahun');
    $b = $this->input->post('bidang');
    echo "<option disabled selected>Pilih</option>";
    $loaddata = $this->global_model->find_all_by('pkt_profil', array('tahun_ajaran'=>$a,'id_bidang'=>$b));
    if(!empty($loaddata)){
      foreach ($loaddata as $key) {
        echo "<option value='".$key['periode_dari']."-".$key['periode_sampai']."'>".$key['periode_dari']." - ".$key['periode_sampai']."</option>";
      }
    }
  }

  public function ajaxcetakpeserta(){
    $a = $this->input->post('tahun');
    $b = $this->input->post('bidang');
    $c = $this->input->post('periode');
    echo "<option disabled selected>Pilih</option>";

    if(!empty($c)){
      $pecahperiode = explode('-',$c);
      if(!empty($pecahperiode)){
        $periodedari = $pecahperiode[0];
        $periodesampai = $pecahperiode[1];
        $loaddata = $this->global_model->find_all_by('pkt_profil', array('tahun_ajaran'=>$a,'id_bidang'=>$b,'periode_dari'=>$periodedari,'periode_sampai'=>$periodesampai));
        if(!empty($loaddata)){
          foreach ($loaddata as $key) {
            echo "<option value='semua'>Semua</option>";
            echo "<option value='".$key['id_profil']."'>".$key['nama_lengkap']."</option>";
          }
        }
      }
    }
  }

  public function cetakpkt(){
    if($this->input->post('btnsend')){
      $textalert = "";
      $inputcheck = array('tahun_ajaran','bidang','nama_peserta','periode');
      $inputtext = array('Tahun Ajaran ', ' Bidang ', ' Peserta ','Periode');

      //utk checking input yg required
      for($i=0; $i < count($inputcheck); $i++){
        if($this->input->post($inputcheck[$i]) == ""){
          $textalert = $textalert.",".$inputtext[$i];
        }
      }

      //action setelah proses
      if(!empty($textalert)){ //gagal proses
  			$textalert = ltrim($textalert, ',')." tidak boleh kosong";
        $this->sysalert->message("danger",$textalert,'cetakpkt');
        redirect(site_url('admin/cetakpkt'));
      }else{
        $pecahperiode = explode('-',$this->input->post('periode'));
        if(!empty($pecahperiode)){
          $periodedari = $pecahperiode[0];
          $periodesampai = $pecahperiode[1];

          $query = array(
            'tahun_ajaran' => $this->input->post('tahun_ajaran'),
            'id_bidang' => $this->input->post('bidang'),
            'id_profil' => $this->input->post('nama_peserta'),
            'periode_dari' => $periodedari,
            'periode_sampai' => $periodesampai
          );

          if($this->input->post('nama_peserta')=="semua"){
            unset($query['id_profil']);
          }

          $nihload['loadpeserta'] = $this->global_model->find_all_by('pkt_profil',$query);

          $this->load->view('konten/admin/printpkt',$nihload);
          $orientation = 'potrait'; //tipe format kertas
      		$paper_size  = 'A4'; //paper size
      		$html = $this->output->get_output();
      		$this->dompdf->set_paper($paper_size, $orientation);
      		//Convert to PDF
      		$this->dompdf->load_html($html);
      		$this->dompdf->render();
      		$this->dompdf->stream("cetakbiodata.pdf", array('Attachment'=>0));

        }else{
          $this->sysalert->message("danger","Periode tidak valid",'cetakpkt');
          redirect(site_url('admin/cetakpkt'));
        }

      }
    }

    $data['loadtahun'] = $this->global_model->query("select tahun_ajaran from pkt_profil group by tahun_ajaran");
    $data['loadbidang'] = $this->global_model->find_all('m_bidang');
    $this->load->view('header/admin');
    $this->load->view('konten/admin/cetakpkt',$data);
    $this->load->view('footer/admin');
  }

  public function cetakrencana(){
    $this->load->view('header/admin');
    $this->load->view('konten/admin/cetakrencana');
    $this->load->view('footer/admin');
  }
  public function cetakpenilaian(){
    $this->load->database('acc_app', TRUE);
    $nihload['kabidcnp']  = $this->global_model->find_by('akun_login', array('id_jabatan'=>3));

    $this->load->database('default', TRUE);
    if($this->input->post('btnsend')){
      $textalert = "";
      $inputcheck = array('tahun_ajaran','bidang','nama_peserta','periode');
      $inputtext = array('Tahun Ajaran ', ' Bidang ', ' Peserta ','Periode');

      //utk checking input yg required
      for($i=0; $i < count($inputcheck); $i++){
        if($this->input->post($inputcheck[$i]) == ""){
          $textalert = $textalert.",".$inputtext[$i];
        }
      }

      //action setelah proses
      if(!empty($textalert)){ //gagal proses
  			$textalert = ltrim($textalert, ',')." tidak boleh kosong";
        $this->sysalert->message("danger",$textalert,'cetakpenilaian');
        redirect(site_url('admin/cetakpenilaian'));
      }else{
        $pecahperiode = explode('-',$this->input->post('periode'));
        if(!empty($pecahperiode)){
          $periodedari = $pecahperiode[0];
          $periodesampai = $pecahperiode[1];

          $query = array(
            'tahun_ajaran' => $this->input->post('tahun_ajaran'),
            'id_bidang' => $this->input->post('bidang'),
            'id_profil' => $this->input->post('nama_peserta'),
            'periode_dari' => $periodedari,
            'periode_sampai' => $periodesampai
          );

          if($this->input->post('nama_peserta')=="semua"){
            unset($query['id_profil']);
          }

          $nihload['loadpeserta'] = $this->global_model->find_all_by('pkt_profil',$query);

          $this->load->view('konten/admin/printpenilaian',$nihload);
          $orientation = 'potrait'; //tipe format kertas
      		$paper_size  = 'A4'; //paper size
      		$html = $this->output->get_output();
      		$this->dompdf->set_paper($paper_size, $orientation);
      		//Convert to PDF
      		$this->dompdf->load_html($html);
      		$this->dompdf->render();
      		$this->dompdf->stream("cetakpenilaian.pdf", array('Attachment'=>0));

        }else{
          $this->sysalert->message("danger","Periode tidak valid",'cetakpenilaian');
          redirect(site_url('admin/cetakpenilaian'));
        }

      }
    }

    $data['loadtahun'] = $this->global_model->query("select tahun_ajaran from pkt_profil group by tahun_ajaran");
    $data['loadbidang'] = $this->global_model->find_all('m_bidang');
    $this->load->view('header/admin');
    $this->load->view('konten/admin/cetakpenilaian',$data);
    $this->load->view('footer/admin');

  }

  public function cetaksoal(){
    $this->load->view('header/admin');
    $this->load->view('konten/admin/cetaksoal');
    $this->load->view('footer/admin');
  }
  //end cetak

  public function tampilbab($id){
    $check = $this->global_model->find_by('konten_ujian', array('bab_soal'=>$id));
    $check['babsoal'] = str_replace('-',' ',$check['bab_soal']);
    echo json_encode($check);
  }

  public function hapuspesertaujian(){
    $checkcount = count($this->global_model->find_all_by('partisipasi_ujian',array('id_headersoal'=>$this->session->userdata('lihatsoal'))));
    $data = $this->input->post('check');
    if($checkcount == count($data)){
      $this->sysalert->message('danger','Peserta yang mengikuti ujian tidak boleh kosong','lihatsoal');
      redirect(site_url('admin/ujian/soal/'.$this->session->userdata('lihatsoal')));
    }else{
      $config = array(
  			'field' => 'id_partisipasi',
  			'controller' => 'lihatsoal',
  			'redirect' => 'admin/ujian/lihat/'.$this->session->userdata('lihatsoal')
  		);
  		$this->sysctrl->hapus('partisipasi_ujian',$data,$config);
    }
  }

  public function ubahbab($id){
    if($this->input->post('ubahbab')){
      $babsoal = $this->input->post('bab_soal');
      $bobot = $this->input->post('bobot');

      $err = 0;
      $message = 0;
      if($babsoal == ""){
        $err = 1;
        $message = "Bab Soal tidak boleh kosong";
      }else if($bobot == ""){
        $err = 1;
        $message = "Bobot tidak boleh kosong";
      }

      /*ini patch bobots*/
      $sqlurut = $this->global_model->query("select bobot from konten_ujian where bab_soal != '".$id."' and id_headersoal='".$this->session->userdata('lihatsoal')."' group by bab_soal");
      $bobotsskrng = 0;
      foreach ($sqlurut as $keybobot) {
        $bobotsskrng = intval($bobotsskrng+$keybobot['bobot']);
      }

      $bobots = 100;
      if(intval($bobotsskrng+$bobot) > $bobots){
        $err = 1;
        $message = "Kapasitas Bobot hanya sampai 100%";
      }
      /*end ini patch bobots*/

      if($err == 1){
        $this->sysalert->message('danger',$message,'lihatsoal');
      }else{
        $data = array(
          'bab_soal' => str_replace(' ','-',$this->input->post('bab_soal')),
          'bobot' => $this->input->post('bobot')
        );

        $this->global_model->update('konten_ujian',$data,array('bab_soal'=>$id));
        $this->sysalert->message('success',"Data berhasil diperbarui",'lihatsoal');
      }

      redirect(site_url('admin/ujian/soal/'.$this->session->userdata('lihatsoal')));
    }
  }

  public function hapusbab($id){
    if($this->global_model->delete('konten_ujian', array('bab_soal' => $id))){
      $this->sysalert->message('danger', 'Gagal menghapus Bab Soal', 'lihatsoal');
    }else{
      $this->sysalert->message('success', 'Bab Soal berhasil di hapus', 'lihatsoal');
    }

    redirect(site_url('admin/ujian/soal/'.$this->session->userdata('lihatsoal')));
  }

  public function ajaxujian($id){
    $load = $this->global_model->find_by('header_ujian', array('id_headersoal'=>$id));
    echo json_encode($load);
  }

  public function eujian($id){
    if($this->input->post('ubahujian')){
      $textalert = "";
      $message = "";
      $inputcheck = array('nama_ujian','tgl_ujian','jam_mulai','jam_akhir');
      $inputtext = array('Nama Ujian','Tanggal Ujian','Jam Mulai','Jam Akhir');

      //utk checking input yg required
      for($i=0; $i < count($inputcheck); $i++){
        if($this->input->post($inputcheck[$i]) == ""){
          $textalert = $textalert.",".$inputtext[$i];
        }
      }

      //action setelah proses
      if(!empty($textalert)){ //gagal proses
        $textalert = ltrim($textalert, ',')." tidak boleh kosong";
        $this->sysalert->message("danger",$textalert,'ujian');
        redirect(site_url('admin/ujian'));
      }

      if($this->input->post('jam_mulai') > $this->input->post('jam_akhir')){
        $message = "Jam Mulai tidak boleh melebihi Jam Akhir";
      }else if($this->input->post('jam_mulai') == $this->input->post('jam_akhir')){
        $message = "Jam Mulai tidak boleh sama dengan Jam Akhir";
      }

      if(!empty($message)){ //gagal proses
        $this->sysalert->message("danger",$message,'ujian');
        redirect(site_url('admin/ujian'));
      }

      $dcheckdong = array(
        'nama_ujian' => $this->input->post('nama_ujian'),
        'tgl_ujian' => $this->input->post('tgl_ujian')
      );

      $checkbro = $this->global_model->find_by('header_ujian', $dcheckdong);
      if(!empty($checkbro) && $chekbro['id_headersoal'] == $id){
        $this->sysalert->message("danger","Data telah tersedia",'ujian');
        redirect(site_url('admin/ujian'));
      }

      $datastore = array(
        'nama_ujian' => $this->input->post('nama_ujian'),
        'tgl_ujian' => $this->input->post('tgl_ujian'),
        'jam_mulai' => $this->input->post('jam_mulai'),
        'jam_akhir' => $this->input->post('jam_akhir')
      );

      $this->global_model->update('header_ujian',$datastore,array('id_headersoal'=>$id));
      $this->sysalert->message("success","Data berhasil diperbarui",'ujian');

      redirect(site_url('admin/ujian'));
    }
  }

  public function ujianuser($id){
    $data['loadpkt'] = $this->global_model->find_all('pkt_profil');
    $this->load->view('konten/admin/ujianloadsoal',$data);
  }
  public function ujian($id = null, $parameter = null){
    $konten = 'konten/admin/ujian';
    $data['loaddata'] = $this->global_model->find_all('header_ujian');
    $data['loadpkt'] = $this->global_model->find_all('pkt_profil');

    switch ($id) {
      case 'soal':
        if($parameter ==  null){
          redirect(site_url('admin/ujian'));
        }else{
          $sesscoy = array('lihatsoal'=>$parameter);
          $this->session->set_userdata($sesscoy);
          $konten = 'konten/admin/liatsoal';
          $data['loadbab'] = $this->global_model->query("select bab_soal,bobot from konten_ujian where id_headersoal='".$parameter."' group by urut_bab");
          $data['loaddata'] = $this->global_model->find_all_by('konten_ujian', array('id_headersoal'=>$parameter),'urut_bab ASC');
          $data['loadheader'] = $this->global_model->find_by('header_ujian', array('id_headersoal'=>$parameter));
          $data['jumlahpeserta'] = count($this->global_model->find_all_by('partisipasi_ujian', array('id_headersoal'=>$parameter)));
        }
        break;
      case 'peserta':
          if($parameter ==  null){
            redirect(site_url('admin/ujian'));
          }else{
            if($this->input->post('hapuskuy')){
              $data = $this->input->post('check');
              $okey = 0;
              //hapuskonten_ujian
              if(is_array($this->input->post('check'))){
          			for($i = 0; $i < count($this->input->post('check')); $i++){
          				$bro = $this->global_model->delete('partisipasi_ujian', array('id_profil' => $data[$i],'id_headersoal'=>$parameter));
                  if(!$bro){
                    $okey = 1;
                  }
          			}
          		}

              if($okey == 1){
                $this->sysalert->message('success', 'Peserta berhasil dihapus','ujianpeserta');
              }

              redirect(site_url('admin/ujian/peserta/'.$parameter));
            }

            if($this->input->post('simpan')){
              if(empty($this->input->post('tambahpeserta'))){
                $this->sysalert->message('danger','Peserta tidak boleh kosong','lihatsoal');
              }else{
                if(is_array($this->input->post('tambahpeserta'))){
                  $dd = $this->input->post('tambahpeserta');
                  $k = 0;
                  for($i = 0; $i < count($this->input->post('tambahpeserta')); $i++){
                    $b = array(
                      'id_headersoal' => $parameter,
                      'id_profil' => $dd[$i]);

                    $checkgun = $this->global_model->find_by('partisipasi_ujian', $b);
                    if(empty($checkgun)){
                      $this->global_model->create('partisipasi_ujian', $b);
                      $k = $k + 1;
                    }
                  }

                  if($k > 0){
                    $this->sysalert->message('success','Peserta berhasil ditambahkan','ujianpeserta');
                  }
                }
              }

              redirect(site_url('admin/ujian/peserta/'.$parameter));
            }

            $konten = 'konten/admin/ujianuser';
            $data['loadpeserta'] = $this->global_model->find_all_by('partisipasi_ujian', array('id_headersoal' => $parameter));
            $data['loadheader'] = $this->global_model->find_by('header_ujian', array('id_headersoal'=>$parameter));
            $data['jumlahpeserta'] = count($this->global_model->find_all_by('partisipasi_ujian', array('id_headersoal'=>$parameter)));
          }
          break;
      case 'tambahsoal':
        if(!$this->session->userdata('lihatsoal')){
          redirect(site_url('admin/ujian'));
        }else{
          $konten = 'konten/admin/tambahsoal';
          if($this->input->post('simpan')){
            $babsoal = $this->input->post('bab_soal');
            $bobot = $this->input->post('bobot');
            $soal = $this->input->post('soal');

            $err = 0;
            $message = 0;
            if($babsoal == ""){
              $err = 1;
              $message = "Bab Soal tidak boleh kosong";
            }else if($bobot == ""){
              $err = 1;
              $message = "Bobot tidak boleh kosong";
            }

            /*ini patch bobots*/
            $sqlurut = $this->global_model->query("select bobot from konten_ujian where id_headersoal='".$this->session->userdata('lihatsoal')."' group by bab_soal");
            $bobotsskrng = 0;
            foreach ($sqlurut as $keybobot) {
              $bobotsskrng = intval($bobotsskrng+$keybobot['bobot']);
            }

            $bobots = 100;
            if(intval($bobotsskrng+$bobot) > $bobots){
              $err = 1;
              $message = "Kapasitas Bobot hanya sampai 100%";
            }
            /*end ini patch bobots*/

            if($err == 1){
              $this->sysalert->message('danger',$message,'tambahsoal');
            }else{
              $nourut = count($this->global_model->query("select *from konten_ujian where id_headersoal='".$this->session->userdata('lihatsoal')."' group by bab_soal"));
              if($nourut == "0"){
                $nourut = 1;
              }
              $checkurut = $this->global_model->find_by('konten_ujian', array('id_headersoal'=>$this->session->userdata('lihatsoal'),'bab_soal'=>$babsoal,'bobot'=>$bobot));

              if(!empty($checkurut)){
                $nourut = $checkurut['urut_bab'];
              }

              for ($i=0; $i < 10 ; $i++) {
                $datacheck = array(
                  'id_headersoal' => $this->session->userdata('lihatsoal'),
                  'bab_soal' => str_replace(' ','-',$babsoal),
                  'bobot' => $bobot,
                  'soal' => $soal[$i]
                );

                $acheck = $this->global_model->find_by('konten_ujian', $datacheck);

                if($soal[$i] != "" && $acheck == null){
                  $okbos = array(
                    'id_headersoal' => $this->session->userdata('lihatsoal'),
                    'bab_soal' => str_replace(' ','-',$babsoal),
                    'bobot' => $bobot,
                    'soal' => $soal[$i],
                    'urut_bab' => $nourut
                  );

                  $this->global_model->create('konten_ujian', $okbos);
                  $this->sysalert->message('success','Soal berhasil di tambahkan','tambahsoal');
                }
              }
            }

            redirect(site_url('admin/ujian/tambahsoal'));
          }
        }
        break;
      default:
        $konten = 'konten/admin/ujian';
        if($this->input->post('simpan')){
          $textalert = "";
          $inputcheck = array('nama_ujian','tgl_ujian','jam_mulai','jam_akhir');
          $inputtext = array('Nama Ujian','Tanggal Ujian','Jam Mulai','Jam Akhir');

          //utk checking input yg required
          for($i=0; $i < count($inputcheck); $i++){
            if($this->input->post($inputcheck[$i]) == ""){
              $textalert = $textalert.",".$inputtext[$i];
            }
          }

          //action setelah proses
          if(!empty($textalert)){ //gagal proses
      			$textalert = ltrim($textalert, ',')." tidak boleh kosong";
            $this->sysalert->message("danger",$textalert,'ujian');
            redirect(site_url('admin/ujian'));
          }

          $dcheckdong = array(
            'nama_ujian' => $this->input->post('nama_ujian'),
            'tgl_ujian' => $this->input->post('tgl_ujian')
          );

          $checkbro = $this->global_model->find_by('header_ujian', $dcheckdong);
          if(!empty($checkbro)){
            $this->sysalert->message("danger","Data telah tersedia",'ujian');
            redirect(site_url('admin/ujian'));
          }

          $data = $this->input->post();
          unset($data['simpan']);

          $status = 0;
          if($data['jam_mulai'] > $data['jam_akhir']){
            $this->sysalert->message('danger','Jam Mulai tidak boleh melebihi Jam Akhir','ujian');
            $status = 1;
          }else if($data['jam_mulai'] == $data['jam_akhir']){
            $this->sysalert->message('danger','Jam Mulai tidak boleh sama dengan Jam Akhir','ujian');
            $status = 1;
          }

          if($status == 0){
            $getheader = $this->global_model->query("SELECT *from header_ujian order by id_headersoal DESC limit 1");
            $idheadersoal = 1;
            if(!empty($getheader)){
              $idheadersoal = intval($getheader[0]['id_headersoal']+1);
            }

            $periodeoke = explode('-',$this->input->post('periode'));
            $datastore = array(
              'id_headersoal' => $idheadersoal,
              'nama_ujian' => $this->input->post('nama_ujian'),
              'tgl_ujian' => $this->input->post('tgl_ujian'),
              'jam_mulai' => $this->input->post('jam_mulai'),
              'jam_akhir' => $this->input->post('jam_akhir')
            );

            $this->global_model->create('header_ujian', $datastore);

            $this->sysalert->message('success','Data Berhasil di Tambahkan','ujian');
            redirect(site_url('admin/ujian'));

          }else{
            redirect(site_url('admin/ujian'));
          }

        }
        break;
    }
    $this->load->view('header/admin');
    $this->load->view($konten,$data);
    $this->load->view('footer/admin');
  }

  public function tampilujian($id){
    $a = $this->global_model->find_by('header_ujian', array('id_headersoal'=>$id));
    echo json_encode($a);
  }

  public function hapusujian($id){
    $data = $this->input->post('check');
    //hapuskonten_ujian
    if(is_array($this->input->post('check'))){
			for($i = 0; $i < count($this->input->post('check')); $i++){
				$this->global_model->delete('konten_ujian', array('id_headersoal' => $data[$i]));
        $this->global_model->delete('partisipasi_ujian', array('id_headersoal' => $data[$i]));
			}
		}

    //hapus header ujian
		$config = array(
			'field' => 'id_headersoal',
			'controller' => 'ujian',
			'redirect' => 'admin/ujian'
		);
		$this->sysctrl->hapus('header_ujian',$data,$config);
  }

  public function editujian($id){
    if($this->input->post('simpan')){
      $data = $this->input->post();
      unset($data['simpan']);

      $check = array(
        'inputcheck' => 'nama_ujian,tgl_ujian,tahun_ajaran,id_bidang,jam_mulai,jam_akhir',
        'ictexterror' => 'Nama Ujian,Tanggal Ujian,Tahun Ajaran,Bidang,Jam Mulai,Jam Akhir',
        'mode' => '2',
        'idfield' => 'id_headersoal',
        'id' => $id,
        'checkdata' => 'nama_ujian,tgl_ujian,tahun_ajaran,id_bidang,jam_mulai,jam_akhir',
        'controller' => 'ujian',
        'redirect' => 'admin/ujian'
      );

      $this->sysctrl->proses('header_ujian', $data, $check);
    }
  }

  public function ajaxloadsoal(){
    $bab = $this->input->post('babsoal');
    $acheck = array(
      'bab_soal' => $bab,
      'id_headersoal' => $this->session->userdata('lihatsoal'),
    );

    if(empty($acheck['bab_soal']) || $bab == "semua"){
      unset($acheck['bab_soal']);
    }

    $data['loaddata'] = $this->global_model->find_all_by('konten_ujian', $acheck,'urut_bab ASC');
    $this->load->view('konten/admin/ujianloadsoal',$data);
  }

  public function hapussoalujian($id){
    if($this->global_model->delete('konten_ujian', array('id_kontenujian' => $id))){
      $this->sysalert->message('danger', 'Gagal menghapus soal', 'lihatsoal');
    }else{
      $this->sysalert->message('success', 'Soal berhasil di hapus', 'lihatsoal');
    }

    redirect(site_url('admin/ujian/soal/'.$this->session->userdata('lihatsoal')));
  }

  public function tampilsoalujian($id){
    $a = $this->global_model->find_by('konten_ujian', array('id_kontenujian'=>$id));
    $a['babsoal'] = str_replace('-',' ',$a['bab_soal']);
    echo json_encode($a);
  }

  public function ubahsoalujian($id){
    if($this->input->post('simpan')){
      $data = $this->input->post();
      unset($data['simpan']);
      $check = array(
  			'inputcheck' => 'soal',
  			'ictexterror' => 'Soal',
  			'mode' => '2',
  			'idfield' => 'id_kontenujian',
  			'id' => $id,
  			'checkdata' => 'soal',
  			'controller' => 'lihatsoal',
  			'redirect' => 'admin/ujian/lihat/'.$this->session->userdata('lihatsoal')
  		);

  		$this->sysctrl->proses('konten_ujian', $data, $check);
    }
  }
  public function penilaian($id = null,$parameter = null){
    $konten = "";
    if($this->input->post('btnsimpan')){
      $nama = $this->input->post('namapeserta');
      $sess = array(
        'idtrigger' => $nama
      );
      $this->session->set_userdata($sess);
    }

    switch ($id) {
      case 'peserta':
      $checkready = $this->global_model->find_by('pkt_profil', array('id_profil'=>$parameter));
      if(empty($checkready)){
        redirect(site_url('admin/penilaian'));
      }

      $getbidang = $this->global_model->find_by('pkt_profil', array('id_profil'=>$parameter));

      $sql = "select *from m_indikator where id_bidang='".$getbidang['id_bidang']."' order by id_kategori";

      $q = $this->global_model->query($sql);
      $data['loaddata'] = $q;
      $data['idprofilnih'] = $parameter;
      $konten = "konten/admin/penilaianpeserta";

      break;
      case 'kelola':
        $konten = "konten/admin/kelolanilai";
        $getidprofil = $this->session->userdata('idtrigger');
        if($this->input->post('simpan')){
          $check = $this->global_model->find_by('pkt_profil', array('id_profil'=>$getidprofil));
          if($check != null){
            $loadindikator = $this->global_model->query("select id_indikator from m_indikator where id_bidang='".$check['id_bidang']."'");
            foreach ($loadindikator as $keycheck) {
              if($this->input->post($keycheck['id_indikator']) != null){
                $nilai = $this->input->post($keycheck['id_indikator']);
                $datapost = array(
                  'id_indikator' => $keycheck['id_indikator'],
                  'id_profil' => $check['id_profil'],
                  'nilai' => $nilai
                );

                //check di table pkt_nilai ada recordnya atau ngga
                $checktbl = $this->global_model->find_by('pkt_nilai', array('id_indikator'=>$keycheck['id_indikator'],'id_profil'=>$check['id_profil']));
                if($checktbl == null){
                  $this->global_model->create('pkt_nilai', $datapost); //gk ada buat baru
                }else{
                  //ada di update
                  unset($datapost['id_indikator']);
                  unset($datapost['id_profil']);
                  $this->global_model->update('pkt_nilai', $datapost, array('id_indikator'=>$keycheck['id_indikator'],'id_profil'=>$check['id_profil']));
                }
              }
            }

            $this->sysalert->message('success','Data berhasil di perbarui', 'kelolanilai');
          }

          redirect(site_url('admin/penilaian/kelola'));
        }
        break;

      default:
        $konten = "konten/admin/penilaian";
        break;
    }

    $data['loadtahun'] = $this->global_model->query("select tahun_ajaran from pkt_profil group by tahun_ajaran");
    $data['loadkategori'] = $this->global_model->find_all('m_kategori');
    $data['loadpeserta'] = $this->global_model->find_all('pkt_profil');
    $data['loadbidang'] = $this->global_model->find_all('m_bidang');
    $this->load->view('header/admin');
    $this->load->view($konten,$data);
    $this->load->view('footer/admin');
  }

  public function ajaxperiode(){
    $tahun_ajaran = $this->input->post('tahun_ajaran');
    $bidang = $this->input->post('bidang');

    $dcheck = array(
      'tahun_ajaran' => $tahun_ajaran,
      'id_bidang' => $bidang
    );

    if(empty($bidang) || $bidang == "semua"){
      unset($dcheck['id_bidang']);
    }

    if(empty($tahun_ajaran) || $tahun_ajaran == "semua"){ unset($dcheck['tahun_ajaran']);}

    $loaddata = $this->global_model->find_all_by('pkt_profil', $dcheck);

    if($tahun_ajaran ==  "semua" && $bidang == "semua"){
      $loaddata = $this->global_model->find_all('pkt_profil');
    }

    echo "<option disabled selected>Pilih Periode</option>";
    foreach ($loaddata as $key) {
      echo "<option value='".$key['periode_dari']."-".$key['periode_sampai']."'>".$key['periode_dari']." - ".$key['periode_sampai']."</option>";
    }


  }

  public function ajaxloadData(){
    $tahun = $this->input->post('tahun');
    $bidang = $this->input->post('bidang');
    $periode = $this->input->post('periode');
    $active = $this->input->post('active');
    $acheck = array(
      'tahun_ajaran' => $tahun,
      'id_bidang' => $bidang
    );

    if(!empty($periode)){
      $periodeasli = explode('-',$periode);
      if(!empty($periodeasli)){
        $acheck['periode_dari'] = $periodeasli[0];
        $acheck['periode_sampai'] = $periodeasli[1];
      }
    }

    if(empty($bidang)||$bidang == "semua"){
      unset($acheck['id_bidang']);
    }

    if(empty($tahun)||$tahun == "semua"){
      unset($acheck['tahun_ajaran']);
    }

    $data['loadpeserta'] = $this->global_model->find_all_by('pkt_profil',$acheck);
    $data['activedi'] = $active;

    if(empty($acheck)){
      $data['loadpeserta'] = $this->global_model->find_all('pkt_profil');
    }

    $this->load->view('konten/admin/loadviewData',$data);

  }

  public function ajaxloadData3(){
    $tahun = $this->input->post('tahun');
    $bidang = $this->input->post('bidang');
    $periode = $this->input->post('periode');
    $acheck = array(
      'tahun_ajaran' => $tahun,
      'id_bidang' => $bidang,
      'periode' => $periode
    );

    if(empty($periode)){
      unset($acheck['periode']);
    }

    if(empty($bidang)||$bidang == "semua"){
      unset($acheck['id_bidang']);
    }

    if(empty($tahun)||$tahun == "semua"){
      unset($acheck['tahun_ajaran']);
    }

    $data['loaddata'] = $this->global_model->find_all_by('header_ujian',$acheck);
    if(empty($acheck)){
      $data['loaddata'] = $this->global_model->find_all('header_ujian');
    }

    $this->load->view('konten/admin/loadviewReview',$data);

  }

  public function ajaxloadData2(){
    $tahun = $this->input->post('tahun');
    $bidang = $this->input->post('bidang');
    $periode = $this->input->post('periode');
    $acheck = array(
      'tahun_ajaran' => $tahun,
      'id_bidang' => $bidang
    );

    if(!empty($periode)){
      $periodeasli = explode('-',$periode);
      if(!empty($periodeasli)){
        $acheck['periode_dari'] = $periodeasli[0];
        $acheck['periode_sampai'] = $periodeasli[1];
      }
    }

    if(empty($bidang)||$bidang == "semua"){
      unset($acheck['id_bidang']);
    }

    if(empty($tahun)||$tahun == "semua"){
      unset($acheck['tahun_ajaran']);
    }

    $loadpeserta = $this->global_model->find_all_by('pkt_profil',$acheck);

    if(empty($acheck)){
      $loadpeserta = $this->global_model->find_all('pkt_profil');
    }

    foreach ($loadpeserta as $key) {
      echo "<option value='".$key['id_profil']."'>".$key['nama_lengkap']."</option>";
    }
  }


  /* master */
  public function master($id = null){
    $konten = "";
    $data['loaddata'] = "";
    switch ($id) {
      case 'konsentrasi':
        if($this->input->post('simpan')){
          $data = $this->input->post();
          unset($data['simpan']);

          $check = array(
            'inputcheck' => 'nama_konsentrasi',
            'mode' => '1',
            'ictexterror' => 'Nama Konsentrasi',
            'checkdata' => 'nama_konsentrasi',
            'controller' => 'mkonsentrasi',
            'redirect' => 'admin/master/konsentrasi'
          );

          $this->sysctrl->proses('m_konsentrasi', $data, $check);
        }

        $konten = "konten/admin/m_konsentrasi";
        $data['loaddata'] = $this->global_model->find_all('m_konsentrasi');
        break;
      case 'bidang':
        if($this->input->post('simpan')){
          $data = $this->input->post();
          unset($data['simpan']);

          $check = array(
            'inputcheck' => 'nama_bidang',
            'mode' => '1',
            'ictexterror' => 'Nama Bidang',
            'checkdata' => 'nama_bidang',
            'controller' => 'mbidang',
            'redirect' => 'admin/master/bidang'
          );

          $this->sysctrl->proses('m_bidang', $data, $check);
        }
        $konten = "konten/admin/m_bidang";
        $data['loaddata'] = $this->global_model->find_all('m_bidang');
        break;
      case 'kategoripenilaian':
        if($this->input->post('simpan')){
          $data = $this->input->post();
          unset($data['simpan']);

          $check = array(
            'inputcheck' => 'nama_kategori',
            'mode' => '1',
            'ictexterror' => 'Nama Kategori',
            'checkdata' => 'nama_kategori',
            'controller' => 'mkategori',
            'redirect' => 'admin/master/kategoripenilaian'
          );

          $this->sysctrl->proses('m_kategori', $data, $check);
        }
        $konten = "konten/admin/m_kategori";
        $data['loaddata'] = $this->global_model->find_all('m_kategori');
        break;
    }

    if($id == null){
      redirect(site_url('admin'));
    }

    $this->load->view('header/admin');
    $this->load->view($konten,$data);
    $this->load->view('footer/admin');
  }

  public function tampilkonsentrasi($id){
    $a = $this->global_model->find_by('m_konsentrasi', array('id_konsentrasi'=>$id));
    echo json_encode($a);
  }
  public function tampilbidang($id){
    $a = $this->global_model->find_by('m_bidang', array('id_bidang'=>$id));
    echo json_encode($a);
  }
  public function tampilkategori($id){
    $a = $this->global_model->find_by('m_kategori', array('id_kategori'=>$id));
    echo json_encode($a);
  }

  public function hapuskonsentrasi($id){
    $data = $this->input->post('check');
		$config = array(
			'field' => 'id_konsentrasi',
			'controller' => 'mkonsentrasi',
			'redirect' => 'admin/master/konsentrasi'
		);
		$this->sysctrl->hapus('m_konsentrasi',$data,$config);
  }

  public function hapusbidang($id){
    $data = $this->input->post('check');
		$config = array(
			'field' => 'id_bidang',
			'controller' => 'mbidang',
			'redirect' => 'admin/master/bidang'
		);
		$this->sysctrl->hapus('m_bidang',$data,$config);
  }

  public function hapuskategori($id){
    $data = $this->input->post('check');
		$config = array(
			'field' => 'id_kategori',
			'controller' => 'mkategori',
			'redirect' => 'admin/master/kategoripenilaian'
		);
		$this->sysctrl->hapus('m_kategori',$data,$config);
  }

  public function editkonsentrasi($id){
    if($this->input->post('simpan')){
      $data = $this->input->post();
      unset($data['simpan']);

      $check = array(
        'inputcheck' => 'nama_konsentrasi',
        'ictexterror' => 'Nama Konsentrasi',
        'mode' => '2',
        'idfield' => 'id_konsentrasi',
        'id' => $id,
        'checkdata' => 'nama_konsentrasi',
        'controller' => 'mkonsentrasi',
        'redirect' => 'admin/master/konsentrasi'
      );

      $this->sysctrl->proses('m_konsentrasi', $data, $check);
    }
  }

  public function editbidang($id){
    if($this->input->post('simpan')){
      $data = $this->input->post();
      unset($data['simpan']);

      $check = array(
        'inputcheck' => 'nama_bidang',
        'ictexterror' => 'Nama Bidang',
        'mode' => '2',
        'idfield' => 'id_bidang',
        'id' => $id,
        'checkdata' => 'nama_bidang',
        'controller' => 'mbidang',
        'redirect' => 'admin/master/bidang'
      );

      $this->sysctrl->proses('m_bidang', $data, $check);
    }
  }

  public function editkategori($id){
    if($this->input->post('simpan')){
      $data = $this->input->post();
      unset($data['simpan']);

      $check = array(
        'inputcheck' => 'nama_kategori',
        'ictexterror' => 'Nama Kategori',
        'mode' => '2',
        'idfield' => 'id_kategori',
        'id' => $id,
        'checkdata' => 'nama_kategori',
        'controller' => 'mkategori',
        'redirect' => 'admin/master/kategoripenilaian'
      );

      $this->sysctrl->proses('m_kategori', $data, $check);
    }
  }

  /* akhir master */


  public function rencanakerja($id = null,$parameter = null){
    $konten = "";
    $data['loaddata'] = "";
    $data['loadpeserta'] = $this->global_model->find_all('pkt_profil');
    $data['loadbidang'] = $this->global_model->find_all('m_bidang');
    $data['loadtahun'] = $this->global_model->query("select tahun_ajaran from pkt_profil group by tahun_ajaran");
    switch ($id) {
      case 'peserta':
      $checkready = $this->global_model->find_by('pkt_profil', array('id_profil'=>$parameter));
      if(empty($checkready)){
        redirect(site_url('admin/rencanakerja'));
      }

      $data['loaddata'] = $this->global_model->find_all_by('u_aktifitas', array('id_profil'=>$parameter));
      $data['idprofilnih'] = $parameter;
      $konten = "konten/admin/rencanapeserta";

      break;
      case 'tambah':
        if($this->input->post('simpan')){
          $kegiatan = $this->input->post('kegiatan');
          $darijam = $this->input->post('darijam');
          $sampaijam = $this->input->post('sampaijam');
          $idprofil = $this->input->post('id_profil');
          $tanggal = $this->input->post('tanggal');

          $err = 0;
          $message = 0;
          if($idprofil == ""){
            $err = 1;
            $message = "Nama Peserta tidak boleh kosong";
          }else if($this->input->post('tanggal') == ""){
            $err = 1;
            $message = "Tanggal tidak boleh kosong";
          }

          if($err == 1){
            $this->sysalert->message('danger',$message,'tambahrencana');
          }else{
            for ($i=0; $i < 10 ; $i++) {
              $datacheck = array(
                'kegiatan' => $kegiatan[$i],
                'darijam' => $darijam[$i],
                'sampaijam' => $sampaijam[$i],
                'id_profil' => $idprofil,
                'tanggal' => $tanggal
              );
              $acheck = $this->global_model->find_by('u_aktifitas', $datacheck);

              if($kegiatan[$i] != "" && $darijam[$i] != "" && $sampaijam[$i] != "" && $acheck == null){
                $okbos = array(
                  'kegiatan' => $kegiatan[$i],
                  'darijam' => $darijam[$i],
                  'sampaijam' => $sampaijam[$i],
                  'status' => 0,
                  'keterangan' => '',
                  'tanggal' => $tanggal,
                  'id_profil' => $idprofil
                );

                $this->global_model->create('u_aktifitas', $okbos);
                $this->sysalert->message('success','Rencana Kerja berhasil di tambahkan','tambahrencana');
              }
            }
          }

          redirect(site_url('admin/rencanakerja/tambah'));
        }

        $konten = "konten/admin/tambahrencana";
        break;
      default:
        $konten = "konten/admin/rencanakerja";
        $data['loaddata'] = $this->global_model->find_all('u_aktifitas');
        break;
    }

    $this->load->view('header/admin');
    $this->load->view($konten,$data);
    $this->load->view('footer/admin');
  }

  public function datapkt($id = null,$parameter = null){
    $konten = "";
    $data['loaddata'] = "";
    $data['loadpeserta'] = $this->global_model->find_all('pkt_profil');
    $data['loadkonsentrasi'] = $this->global_model->find_all('m_konsentrasi');
    $data['loadbidang'] = $this->global_model->find_all('m_bidang');
    $data['loadtahun'] = $this->global_model->query("select *from pkt_profil group by tahun_ajaran");
    $q = $this->global_model->find_by('pkt_profil', array('id_profil'=> $parameter));
    switch ($id) {
      case 'tambah':
        $konten = "konten/admin/tambahpkt";
        break;
      case 'ubah':
        $konten = "konten/admin/ubahpkt";
        if($q == null){
          $parameter = null;
        }else{
          $data['loaddata'] = $q;
        }
        break;
      default:
        $konten = "konten/admin/datapkt";
        $data['loaddata'] = $this->global_model->find_all('pkt_profil');
        break;
    }

    if($id == "ubah" && $parameter == null){
      redirect(site_url('admin/datapkt'));
    }

    if($id == "tambah"){
      if($this->input->post('simpan')){
        $data = $this->input->post();
  			$newfilename = "";
  			$a = $_FILES['img']['name'];
  			$b = explode('.',$a);
  			$newfilename = round(microtime(true)).'.'.end($b);
  			unset($data['simpan']);

        $check = array(
  				'inputcheck' => 'nama_lengkap,nim,semester,tahun_ajaran,periode_dari,periode_sampai,id_konsentrasi,id_bidang',
  				'mode' => '1',
  				'ictexterror' => 'Nama Lengkap,NIM,Semester,Tahun Ajaran,Periode Dari,Periode Sampai,Konsentrasi,Bidang',
  				'checkdata' => 'nama_lengkap,nim,semester,tahun_ajaran,periode_dari,periode_sampai,id_konsentrasi,id_bidang',
  				'controller' => 'tambahpkt',
  				'redirect' => 'admin/datapkt/tambah'
  			);

  			if($a != ""){
  				$data['img'] = $newfilename;
  			}

  			$this->sysctrl->proses('pkt_profil', $data, $check);
      }
    }

    if($id == "ubah"){
      if($this->input->post('simpan')){
        $data = $this->input->post();
  			$get = $this->global_model->find_by('pkt_profil',array('id_profil' => $parameter));
  			$a = $_FILES['img']['name'];
  			$b = explode('.',$a);
  			$newfilename = round(microtime(true)).'.'.end($b);

  			if($get['img'] != ""){
  				$c = explode('.',$get['img']);
  				$newfilename = $c[0].'.'.$b[1];
  			}
  			unset($data['simpan']);

  			$check = array(
          'inputcheck' => 'nama_lengkap,nim,semester,tahun_ajaran,periode_dari,periode_sampai,id_konsentrasi,id_bidang',
          'ictexterror' => 'Nama Lengkap,NIM,Semester,Tahun Ajaran,Periode Dari,Periode Sampai,Konsentrasi,Bidang',
  				'mode' => '2',
  				'idfield' => 'id_profil',
  				'id' => $parameter,
  				'checkdata' => 'nama_lengkap,nim,semester,tahun_ajaran,periode_dari,periode_sampai,id_konsentrasi,id_bidang',
  				'controller' => 'ubahpkt',
  				'redirect' => 'admin/datapkt/ubah/'.$parameter
  			);

  			if($a != ""){
  				$data['img'] = $newfilename;
  			}

  			$this->sysctrl->proses('pkt_profil', $data, $check);
      }
    }

    $this->load->view('header/admin');
    $this->load->view($konten,$data);
    $this->load->view('footer/admin');
  }

  public function hapuspkt(){
		$data = $this->input->post('check');
		$config = array(
			'field' => 'id_profil',
			'controller' => 'datapkt',
			'redirect' => 'admin/datapkt'
		);
		$this->sysctrl->hapus('pkt_profil',$data,$config);
	}

  public function ajaxloadpkt(){
    $tahun = $this->input->post('tahun');
    $bidang = $this->input->post('bidang');
    if($tahun != ""){

      $sql = "select *from pkt_profil where tahun_ajaran='".$tahun."' and id_bidang='".$bidang."'";

      if($bidang == ""){
        $sql = "select *from pkt_profil where tahun_ajaran='".$tahun."'";
      }

      $q = $this->global_model->query($sql);
      $data['loaddata'] = $q;
      $this->load->view('konten/admin/pktloadview',$data);

    }else{
      $this->load->view('konten/admin/defaultloadpkt');
    }
  }

  public function kelolaakun(){
    if($this->input->post('simpan')){
      $data = $this->input->post();
      $data['kata_sandi'] = md5($this->input->post('kata_sandi'));
      unset($data['simpan']);

      $check = array(
        'inputcheck' => 'id_profil,nama_pengguna,kata_sandi,status',
        'mode' => '1',
        'ictexterror' => 'Nama Lengkap,Nama Pengguna,Kata Sandi,Status',
        'checkdata' => 'id_profil',
        'controller' => 'kelolaakun',
        'redirect' => 'admin/kelolaakun'
      );

      $this->sysctrl->proses('pkt_akun', $data, $check);
    }
    $data['peserta'] = $this->global_model->find_all('pkt_profil');
    $data['loaddata'] = $this->global_model->find_all('pkt_akun');
    $this->load->view('header/admin');
    $this->load->view('konten/admin/kelolaakun',$data);
    $this->load->view('footer/admin');
  }

  public function tampil($id){
    $a = $this->global_model->find_by('pkt_akun', array('id_akun'=>$id));
    echo json_encode($a);
  }

  public function editakun($id){
    if($this->input->post('simpan')){
      $data = $this->input->post();
      $data['kata_sandi'] = md5($this->input->post('kata_sandi'));
      unset($data['simpan']);
			if($this->input->post('kata_sandi')==""){
				unset($data['kata_sandi']);
			}

      $check = array(
				'inputcheck' => 'id_profil,nama_pengguna,status',
				'ictexterror' => 'Nama Lengkap,Nama Pengguna,Status',
				'mode' => '2',
				'idfield' => 'id_akun',
				'id' => $id,
				'checkdata' => 'id_profil',
				'controller' => 'kelolaakun',
				'redirect' => 'admin/kelolaakun'
			);

			$this->sysctrl->proses('pkt_akun', $data, $check);
    }
  }

  public function hapusakun($id){
    $data = $this->input->post('check');
		$config = array(
			'field' => 'id_akun',
			'controller' => 'kelolaakun',
			'redirect' => 'admin/kelolaakun'
		);
		$this->sysctrl->hapus('pkt_akun',$data,$config);
  }

  public function tampilrencana($id){
    $a = $this->global_model->find_by('u_aktifitas', array('id_aktifitas'=>$id));
    echo json_encode($a);
  }

  public function hapusrencana($id){
    $getprofil = $this->global_model->find_by('u_aktifitas',array('id_aktifitas'=>$id));

    if($this->global_model->delete('u_aktifitas', array('id_aktifitas' => $id))){
      $this->sysalert->message('danger', 'Gagal menghapus rencana kerja', 'rencanakerja');
    }else{
      $this->sysalert->message('success', 'Rencana kerja berhasil di hapus', 'rencanakerja');
    }

    redirect(site_url('admin/rencanakerja/peserta/'.$getprofil['id_profil']));
  }

  public function ajaxloadrencana(){
    $tgl = $this->input->post('tanggal');
    $idprofil = $this->input->post('id_profil');
    if($idprofil != ""){
      $data['loaddata'] = $this->global_model->find_all_by('u_aktifitas', array('id_profil'=>$idprofil,'tanggal'=>$tgl));
      $this->load->view('konten/admin/rencanaviewload',$data);
    }
  }

  public function ubahrencana($id){
    if($this->input->post('simpan')){
      $data = $this->input->post();
      $q = $this->global_model->find_by('u_aktifitas', array('id_aktifitas'=>$id));
      if($q != null){
        $data['id_profil'] = $q['id_profil'];
        $data['tanggal'] = $q['tanggal'];

        unset($data['simpan']);

        $status = 0;
        if($data['darijam'] > $data['sampaijam']){
          $this->sysalert->message('danger','Waktu Pelaksanaan Dari tidak boleh melebihi Waktu Pelaksanaan Sampai','rencanakerja');
          $status = 1;
        }else if($data['darijam'] == $data['sampaijam']){
          $this->sysalert->message('danger','Waktu Pelaksanaan Dari tidak boleh sama dengan Waktu Pelaksanaan Sampai','rencanakerja');
          $status = 1;
        }

        if($status == 0){
          $check = array(
    				'inputcheck' => 'kegiatan,darijam,sampaijam,status',
    				'ictexterror' => 'Kegiatan,Waktu Pelaksanaan Dari,Waktu Pelaksanaan Sampai,Status',
    				'mode' => '2',
    				'idfield' => 'id_aktifitas',
    				'id' => $id,
    				'checkdata' => 'kegiatan,darijam,sampaijam,id_profil,tanggal',
    				'controller' => 'rencanakerja',
    				'redirect' => 'admin/rencanakerja/peserta/'.$q['id_profil']
    			);

    			$this->sysctrl->proses('u_aktifitas', $data, $check);
        }else{
          redirect(site_url('admin/rencanakerja/peserta/'.$q['id_profil']));
        }

      }else{
        redirect(site_url('admin/rencanakerja/peserta/'.$q['id_profil']));
      }

    }
  }

  public function ajaxloadpeserta(){
    $a = $this->input->post('tahun_ajaran');
    if($a != null){
      $data['loaddata'] = $this->global_model->find_all_by('pkt_profil', array('tahun_ajaran'=>$a));
      $this->load->view('konten/admin/loadpesertatahun',$data);
    }
  }

  public function ajaxloadperiode(){
    $tahun = $this->input->post('tahun');
    $bidang = $this->input->post('bidang');
    if($tahun != "" && $bidang != ""){
      $acheck = $this->global_model->find_all_by('pkt_profil', array('tahun_ajaran'=>$tahun,'id_bidang'=>$bidang));
      echo "<option disabled selected>Pilih Periode</option>";
      if(!empty($acheck)){
        foreach ($acheck as $key) {
          echo "<option value='".$key['periode_dari']."-".$key['periode_sampai']."'>".$key['periode_dari']." - ".$key['periode_sampai']."</option>";
        }
      }
    }
  }

  public function ajaxloadptanggal(){
    $periode = $this->input->post('periode');
    if($periode != ""){
      $pecah = explode("-",$periode);

      // Set timezone
    	date_default_timezone_set('Asia/Jakarta');

    	// Start date
    	$date = $pecah[0];
    	// End date
    	$end_date = $pecah[1];

      echo "<option disabled selected>Pilih Tanggal</option>";
    	while (strtotime($date) <= strtotime($end_date)) {
                    echo "<option value='".$date."'>".$date."</option>";
                    $date = date ("m/d/Y", strtotime("+1 day", strtotime($date)));
    	}
    }
  }

  public function ajaxloadtanggal(){
    $a = $this->input->post('id_nama');
    if($a != null){
      $data['loaddata'] = $this->global_model->find_by('pkt_profil', array('id_profil'=>$a));
      $this->load->view('konten/admin/loadpesertatanggal',$data);
    }
  }

  public function ajaxloadtanggal2(){
    $a = $this->input->post('id_nama');
    if($a != null){

      $loaddata = $this->global_model->find_by('pkt_profil', array('id_profil'=>$a));
      // Set timezone
    	date_default_timezone_set('Asia/Jakarta');

    	// Start date
    	$date = $loaddata['periode_dari'];
    	// End date
    	$end_date = $loaddata['periode_sampai'];

      echo "<option disabled selected>Pilih Tanggal</option>";
    	while (strtotime($date) <= strtotime($end_date)) {
                    echo "<option value='".$date."'>".$date."</option>";
                    $date = date ("m/d/Y", strtotime("+1 day", strtotime($date)));
    	}
    }
  }

  public function indikator($id = null){
    $konten = "";
    $data['loaddata'] = "";
    $data['loadbidang'] = $this->global_model->find_all('m_bidang');
    $data['loadkategori'] = $this->global_model->find_all('m_kategori');
    switch ($id) {
      case 'tambah':
        if($this->input->post('simpan')){
          $namaindikator = $this->input->post('nama_indikator');
          $namakategori = $this->input->post('nama_kategori');
          $namabidang = $this->input->post('nama_bidang');

          $err = 0;
          $message = 0;
          if($namakategori == ""){
            $err = 1;
            $message = "Nama Kategori tidak boleh kosong";
          }else if($namabidang == ""){
            $err = 1;
            $message = "Nama Bidang tidak boleh kosong";
          }

          if($err == 1){
            $this->sysalert->message('danger',$message,'tambahindikator');
          }else{
            for ($i=0; $i < 10 ; $i++) {
              $datacheck = array(
                'id_kategori' => $namakategori,
                'id_bidang' => $namabidang,
                'nama_indikator' => $namaindikator[$i]
              );

              $acheck = $this->global_model->find_by('m_indikator', $datacheck);

              if($namaindikator[$i] != "" && $acheck == null){
                $okbos = array(
                  'id_kategori' => $namakategori,
                  'id_bidang' => $namabidang,
                  'nama_indikator' => $namaindikator[$i]
                );

                $this->global_model->create('m_indikator', $okbos);
                $this->sysalert->message('success','Indikator Penilaian berhasil di tambahkan','tambahindikator');
              }
            }
          }

          redirect(site_url('admin/indikator/tambah'));
        }
        $konten = "konten/admin/tambahindikator";
        break;
      default:
        $konten = "konten/admin/indikator";
        //$data['loaddata'] = $this->global_model->find_all('u_aktifitas');
        break;
    }

    $this->load->view('header/admin');
    $this->load->view($konten,$data);
    $this->load->view('footer/admin');
  }

  public function ubahtim($id){
    $data = array(
      'nama_tim' => $this->input->post('nama_tim'),
      'jabatan_tim' => $this->input->post('jabatan_tim')
    );

    $status = 0;
    if($data['nama_tim'] == ""){
      $this->sysalert->message('danger','Tim Penilai tidak boleh kosong','indikatorpenilaian');
      $status = 1;
    }else if($data['jabatan_tim'] == ""){
      $this->sysalert->message('danger','Jabatan tidak boleh kosong','indikatorpenilaian');
      $status = 1;
    }

    if($status == 0){
      $this->global_model->update('m_indikator', $data, array('id_bidang'=>$id));
      $this->sysalert->message('success','Tim Penilaian berhasil di perbarui','indikatorpenilaian');
    }

    redirect(site_url('admin/indikator'));
  }
  public function tampiltim($id){
    $a = $this->global_model->find_by('m_indikator', array('id_bidang'=>$id));
    echo json_encode($a);
  }

  public function ajaxloadindikator(){
    $bidang = $this->input->post('bidang');
    $kategori = $this->input->post('kategori');
    if($bidang != ""){

      $sql = "select *from m_indikator where id_bidang='".$bidang."' and id_kategori='".$kategori."' order by id_kategori";

      if($kategori == ""){
        $sql = "select *from m_indikator where id_bidang='".$bidang."' order by id_kategori";
      }

      $q = $this->global_model->query($sql);
      $data['loaddata'] = $q;
      $this->load->view('konten/admin/indikatorviewload',$data);

    }else{
      $this->load->view('konten/admin/defaultloadindikator');
    }
  }

  public function hapusindikator($id){
    if($this->global_model->delete('m_indikator', array('id_indikator' => $id))){
      $this->sysalert->message('danger', 'Gagal menghapus rencana kerja', 'indikatorpenilaian');
    }else{
      $this->sysalert->message('success', 'Rencana kerja berhasil di hapus', 'indikatorpenilaian');
    }

    redirect(site_url('admin/indikator'));
  }

  public function tampilindikator($id){
    $a = $this->global_model->find_by('m_indikator', array('id_indikator'=>$id));
    echo json_encode($a);
  }

  public function ubahindikator($id){
    if($this->input->post('simpan')){
      $data = $this->input->post();
      unset($data['simpan']);

      $check = array(
				'inputcheck' => 'id_bidang,id_kategori,nama_indikator',
				'ictexterror' => 'Bidang,Kategori,Nama Indikator',
				'mode' => '2',
				'idfield' => 'id_indikator',
				'id' => $id,
				'checkdata' => 'id_bidang,id_kategori,nama_indikator',
				'controller' => 'indikatorpenilaian',
				'redirect' => 'admin/indikator'
			);

			$this->sysctrl->proses('m_indikator', $data, $check);
    }
  }



}
