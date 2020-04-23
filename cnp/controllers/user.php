<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User extends CI_Controller {
  function __construct()
  {
    parent::__construct();
    $this->load->model('global_model');
    $this->load->helper('url');
    $this->load->library('session');
    $this->load->model('sysalert');
    $this->load->model('sysctrl');
    $this->load->helper('date');

    if(!$this->session->userdata('id_jabatan') == "404" && !$this->session->userdata('id_divisi') == "2"){
      redirect(base_url());
    }
  }

  public function index()
  {
    date_default_timezone_set("Asia/Jakarta");
    $tglnow = date("m/d/Y");

    $akun = $this->global_model->find_by('pkt_akun', array('id_akun'=>$this->session->userdata('id_akun')));
    $idprofil = "";
    if(!empty($akun)){
      if(!empty($akun['id_profil'])){
        $idprofil = $this->global_model->find_by('pkt_profil', array('id_profil'=>$akun['id_profil']));
        $data['loadwaktudasar'] = $this->global_model->find_by('p_waktu', array('id_profil'=>$akun['id_profil'],'tanggal'=>$tglnow));
        if($data['loadwaktudasar'] == null){
          $data['loadwaktudasar'] = $this->global_model->find_by('p_waktudasar', array('id_waktudasar'=>1));
        }
      }
    }

    if(!empty($idprofil)){
      if(!empty($idprofil['periode_dari'] || !empty($idprofil['periode_sampai']))){
        if(strtotime($tglnow) > strtotime($idprofil['periode_dari']) && strtotime($tglnow) > strtotime($idprofil['periode_sampai'])){
          redirect(site_url('user/semua'));
        }
      }
    }

    $data['agendasekarang'] = $this->global_model->find_all_by('u_aktifitas', array('tanggal'=>$tglnow,'id_profil'=>$idprofil['id_profil']));
    $this->load->view('header/user');
    $this->load->view('konten/user/index',$data);
    $this->load->view('footer/user');
  }

  public function review($id = null){
    $akun = $this->global_model->find_by('pkt_akun', array('id_akun'=>$this->session->userdata('id_akun')));
    $idprofil = "";
    $periode = "";
    $data = "";
    if(!empty($akun)){
      if(!empty($akun['id_profil'])){
        $idprofil = $akun['id_profil'];
        $data['id_profilbro'] = $akun['id_profil'];
        $periode = $this->global_model->find_by('pkt_profil', array('id_profil'=>$idprofil));
      }
    }

    if($id != null){
      $checkah = $this->global_model->find_by('header_ujian', array('id_headersoal'=>$id));
      if(!empty($checkah)){
        $data['loadheader'] = $checkah;
      }else{
        redirect(site_url('user/tes'));
      }

      $this->load->view('header/user');
      $this->load->view('konten/user/review',$data);
      $this->load->view('footer/user');
    }else{
      redirect(site_url('user/tes'));
    }

  }

  public function tes($id = null){

    $akun = $this->global_model->find_by('pkt_akun', array('id_akun'=>$this->session->userdata('id_akun')));
    $idprofil = "";
    $periode = "";
    $data = "";
    if(!empty($akun)){
      if(!empty($akun['id_profil'])){
        $idprofil = $akun['id_profil'];
        $data['id_profilbro'] = $akun['id_profil'];
        $periode = $this->global_model->find_by('pkt_profil', array('id_profil'=>$idprofil));
      }
    }

    $konten = "konten/user/tes";
    if($id != null){
      $konten = "konten/user/jawabsoal";
      $checkah = $this->global_model->find_by('header_ujian', array('id_headersoal'=>$id));
      if($checkah != null){
        $data['loadheader'] = $checkah;
        if($this->input->post('simpan')){
          $loadbab = $this->global_model->query("select id_headersoal,bab_soal,bobot from konten_ujian where id_headersoal='".$id."' group by bab_soal");
          foreach ($loadbab as $keybab) {
            foreach ($this->global_model->find_all_by('konten_ujian', array('bab_soal'=>$keybab['bab_soal'])) as $keysub) {
              if(!empty($this->input->post($keysub['id_kontenujian']))){
                $send = array(
                  'id_kontenujian' => $keysub['id_kontenujian'],
                  'id_headersoal' => $id,
                  'jawaban' => $this->input->post($keysub['id_kontenujian']),
                  'id_profil' => $idprofil
                );

                $this->global_model->create('j_pesertaujian', $send);
              }
            }
          }

          redirect(site_url('user/tes'));
        }

      }else{
        redirect(site_url('user/tes'));
      }
    }else{
      $pktperiode = $periode['periode_dari']."-".$periode['periode_sampai'];
    }

    $this->load->view('header/user');
    $this->load->view($konten,$data);
    $this->load->view('footer/user');
  }

  public function profil(){
    $akun = $this->global_model->find_by('pkt_akun', array('id_akun'=>$this->session->userdata('id_akun')));
    $dataload['loaddata'] = "";
    $parameter = "";
    if(!empty($akun)){
      if(!empty($akun['id_profil'])){
        $dataload['loaddata'] = $this->global_model->find_by('pkt_profil', array('id_profil'=>$akun['id_profil']));
        $parameter = $akun['id_profil'];
      }
    }

    if($this->input->post('simpan')){
      //utk pkt_akun
      $username = $this->input->post('nama_pengguna');
      $sandiini = $this->input->post('sandi_ini');
      $sandibaru = $this->input->post('sandi_baru');

      $texterror = "";
      if($username == ""){
        $texterror = "Nama Pengguna tidak boleh kosong";
      }else if($username != ""){
        $cusername = $this->global_model->find_by('pkt_akun', array('nama_pengguna'=>$username));
        if($cusername != null && $cusername['id_akun'] != $this->session->userdata('id_akun')){
          $texterror = "Nama Pengguna telah tersedia";
        }
      }

      if($sandibaru != "" && $sandiini == ""){
        $texterror = "Isi sandi saat ini jika ingin mengganti kata sandi";
      }

      if($sandiini != "" && $sandibaru != ""){
        $csandiini = $this->global_model->find_by('pkt_akun', array('id_akun'=>$this->session->userdata('id_akun'),'kata_sandi'=>md5($sandiini)));
        if($csandiini == null){
          $texterror = "Kata Sandi saat ini salah";
        }
      }

      if($texterror != ""){
        $this->sysalert->message('danger', $texterror, 'profil');
        redirect(site_url('user/profil'));
      }else{
        $apos = array(
          'nama_pengguna' => $username,
          'kata_sandi' => md5($sandibaru)
        );

        if(($sandiini == "" && $sandibaru == "") || ($sandiini != "" && $sandibaru == "")){
          unset($apos['kata_sandi']);
        }

        $this->global_model->update('pkt_akun', $apos, array('id_akun'=>$this->session->userdata('id_akun')));

        //utk pkt_profil
        $data = $this->input->post();
        $data['id_profil'] = $parameter;
        $get = $this->global_model->find_by('pkt_profil',array('id_profil' => $parameter));
        $a = $_FILES['img']['name'];
        $b = explode('.',$a);
        $newfilename = round(microtime(true)).'.'.end($b);

        if($get['img'] != ""){
          $c = explode('.',$get['img']);
          $newfilename = $c[0].'.'.$b[1];
        }
        unset($data['simpan']);
        unset($data['sandi_ini']);
        unset($data['sandi_baru']);
        unset($data['nama_pengguna']);

        $check = array(
          'inputcheck' => 'tempat_lahir,tgl_lahir,email',
          'ictexterror' => 'Tempat Lahir,Tanggal Lahir,Email',
          'mode' => '2',
          'idfield' => 'id_profil',
          'id' => $parameter,
          'checkdata' => 'id_profil',
          'controller' => 'profil',
          'redirect' => 'user/profil'
        );

        if($a != ""){
          $data['img'] = $newfilename;
        }

        $this->sysctrl->proses('pkt_profil', $data, $check);
      }
    }

    $this->load->view('header/user');
    $this->load->view('konten/user/profil',$dataload);
    $this->load->view('footer/user');
  }
  public function tambah(){
    $akun = $this->global_model->find_by('pkt_akun', array('id_akun'=>$this->session->userdata('id_akun')));
    $idprofil = "";
    if(!empty($akun)){
      if(!empty($akun['id_profil'])){
        $idprofil = $akun['id_profil'];
      }
    }

    date_default_timezone_set("Asia/Jakarta");
    $tglnow = date("m/d/Y");

    if($this->input->post('simpan')){
      $kegiatan = $this->input->post('kegiatan');
      $darijam = $this->input->post('darijam');
      $sampaijam = $this->input->post('sampaijam');

      for ($i=0; $i < 10 ; $i++) {
        if($kegiatan[$i] != "" && $darijam[$i] != "" && $sampaijam[$i] != ""){
          $data = array(
            'kegiatan' => $kegiatan[$i],
            'darijam' => $darijam[$i],
            'sampaijam' => $sampaijam[$i],
            'status' => 0,
            'keterangan' => '',
            'tanggal' => $tglnow,
            'id_profil' => $idprofil
          );

          $this->global_model->create('u_aktifitas', $data);
          $this->sysalert->message('success','Agenda Kerja berhasil di tambahkan','agenda');
        }
      }

      redirect(site_url('user'));
    }
    $this->load->view('header/user');
    $this->load->view('konten/user/tambahagenda');
    $this->load->view('footer/user');
  }

  public function ubah(){
    date_default_timezone_set("Asia/Jakarta");
    $tglnow = date("m/d/Y");
    $jamsekarang = date("H:i");
    $jammenutampil = "09:00";
    $jamupdate = "17:00";

    $idprofil = "";
    $loadwaktudasar = $this->global_model->find_by('p_waktudasar', array('id_waktudasar'=>1));
    $akun = $this->global_model->find_by('pkt_akun', array('id_akun'=>$this->session->userdata('id_akun')));
    if(!empty($akun)){
      if(!empty($akun['id_profil'])){
        $idprofil = $akun['id_profil'];
        $a = $this->global_model->find_by('p_waktu', array('id_profil'=>$akun['id_profil'],'tanggal'=>$tglnow));
        if($a != null){
          $loadwaktudasar = $a;
        }
      }
    }

    $jammenutampil = $loadwaktudasar['jam_buat'];
    $jamupdate = $loadwaktudasar['evaluasi_jam'];

    $data['loadwaktudasar'] = $loadwaktudasar;

    if($this->input->post('btnubah')){
      $id_aktifitas = $this->input->post('id_aktifitas');
      $kegiatan = $this->input->post('kegiatan');
      $darijam = $this->input->post('darijam');
      $sampaijam = $this->input->post('sampaijam');
      $status = $this->input->post('status');
      $keterangan = $this->input->post('keterangan');

      $jmlhdidb = count($this->global_model->find_all_by('u_aktifitas', array('tanggal'=>$tglnow)));

      for ($i=0; $i < $jmlhdidb ; $i++) {
        $datasend = array(
          'kegiatan' => $kegiatan[$i],
          'darijam' => $darijam[$i],
          'sampaijam' => $sampaijam[$i],
          'status' => $status[$i],
          'keterangan' => $keterangan[$i]
        );

        if($jamsekarang >= $jammenutampil && $jamsekarang <= $jamupdate){
          unset($datasend['kegiatan']);
          unset($datasend['darijam']);
          unset($datasend['sampaijam']);
        }else{
          unset($datasend['status']);
          unset($datasend['keterangan']);
        }


        $this->global_model->update('u_aktifitas', $datasend, array('id_aktifitas' => $id_aktifitas[$i]));
        $this->sysalert->message('success','Agenda Kerja berhasil di perbarui','agenda');
      }

      redirect(site_url('user'));

    }
    $data['agenda'] = $this->global_model->find_all_by('u_aktifitas', array('tanggal'=>$tglnow,'id_profil'=> $idprofil));
    $this->load->view('header/user');
    $this->load->view('konten/user/ubahagenda',$data);
    $this->load->view('footer/user');
  }

  public function hapus($id){
    if($this->global_model->delete('u_aktifitas', array('id_aktifitas' => $id))){
      $this->sysalert->message('danger', 'Gagal menghapus agenda', 'agenda');
    }else{
      $this->sysalert->message('success', 'Agenda berhasil di hapus', 'agenda');
    }

    redirect(site_url('user'));
  }

  public function semua($id = null,$tgl = null){
    //ini utk configurasi tampilan berdasarkan parameter url
    $idprofil = "";
    $akun = $this->global_model->find_by('pkt_akun', array('id_akun'=>$this->session->userdata('id_akun')));
    if(!empty($akun)){
      if(!empty($akun['id_profil'])){
        $idprofil = $akun['id_profil'];
      }
    }

    $konten = "";
    $q = "";

    if($id != null && $tgl == null){
      redirect(site_url('user/semua'));
    }
    $tgl = str_replace("-","/",$tgl);

    switch ($id) {
      case 'lihat':
        $konten = "konten/user/lihatsemua";
        $q = $this->global_model->find_all_by('u_aktifitas', array('tanggal'=> $tgl, 'id_profil' => $idprofil));
        $asess = array('tglcheck' => $tgl);
        $this->session->set_userdata($asess);

        break;
      default:
        $konten = "konten/user/tsemua";
        $q = $this->global_model->query("select tanggal, count(tanggal) as jmlh from u_aktifitas group by tanggal");
        break;
    }
    //end

    $data['loaddata'] = $q;
    $akun = $this->global_model->find_by('pkt_akun', array('id_akun'=>$this->session->userdata('id_akun')));
    if(!empty($akun)){
      if(!empty($akun['id_profil'])){
        $data['pktprofil'] = $this->global_model->find_by('pkt_profil', array('id_profil'=>$akun['id_profil']));
      }
    }

    $this->load->view('header/user');
    $this->load->view($konten,$data);
    $this->load->view('footer/user');
  }

  public function tampil($id){
    $c = $this->global_model->find_by('u_aktifitas', array('id_aktifitas'=>$id));
    switch ($c['status']) {
      case 0:
        $c['status'] = "Belum Dievaluasi";
        break;
      case 1:
        $c['status'] = "Selesai";
        break;
      case 2:
        $c['status'] = "Tidak Selesai";
        break;
      default:
        $c['status'] = "Belum Dievaluasi";
        break;
    }

    $c['tanggal'] = date("j F Y", strtotime($c['tanggal']));
    echo json_encode($c);
  }

  public function selesai(){
    $akun = $this->global_model->find_by('pkt_akun', array('id_akun'=>$this->session->userdata('id_akun')));
    $idprofil = "";
    if(!empty($akun)){
      if(!empty($akun['id_profil'])){
        $idprofil = $akun['id_profil'];
      }
    }

    $data['loaddata'] = $this->global_model->find_all_by('u_aktifitas', array('status'=> 1,'id_profil'=>$idprofil));
    $this->load->view('header/user');
    $this->load->view('konten/user/terealisasi',$data);
    $this->load->view('footer/user');
  }

  public function tidakselesai(){
    $akun = $this->global_model->find_by('pkt_akun', array('id_akun'=>$this->session->userdata('id_akun')));
    $idprofil = "";
    if(!empty($akun)){
      if(!empty($akun['id_profil'])){
        $idprofil = $akun['id_profil'];
      }
    }

    $data['loaddata'] = $this->global_model->find_all_by('u_aktifitas', array('status'=> 2,'id_profil'=>$idprofil));
    $this->load->view('header/user');
    $this->load->view('konten/user/tterealisasi',$data);
    $this->load->view('footer/user');
  }

  public function belumevaluasi(){
    $akun = $this->global_model->find_by('pkt_akun', array('id_akun'=>$this->session->userdata('id_akun')));
    $idprofil = "";
    if(!empty($akun)){
      if(!empty($akun['id_profil'])){
        $idprofil = $akun['id_profil'];
      }
    }

    $data['loaddata'] = $this->global_model->find_all_by('u_aktifitas', array('status'=> 0,'id_profil'=>$idprofil));
    $this->load->view('header/user');
    $this->load->view('konten/user/tbelum',$data);
    $this->load->view('footer/user');
  }

}
