<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Login extends CI_Controller {
	function __construct()
 	{
 		parent::__construct();
 		$this->load->model('global_model');
		$this->load->model('sysalert');
 		$this->load->helper('url');
 		$this->load->library('session');
 	}

 	public function index(){
		//ini utk auto redirect jika ada session yg masih aktif
		if($this->session->userdata('status')==1){
 			redirect("/kelolaakun");
 		}else if($this->session->userdata('status')==2){
			redirect("/dash");
		}

		if($this->input->post('login')){
			$inputcheck = array('nama_pengguna','kata_sandi');
			$inputerror = array('Nama Pengguna', 'Kata Sandi');
			$texterror = "";
			$redirect = "/";
			$status = 0;
			//utk checking input yg required
	    for($i=0; $i < count($inputcheck); $i++){
	      if($this->input->post($inputcheck[$i]) == ""){
	        $texterror = $texterror.",".$inputerror[$i];
					$status = $status+1;
	      }
	    }

			if($status == 0){
				$d_check = array(
					'nama_pengguna' => $this->input->post('nama_pengguna'),
					'kata_sandi' => md5($this->input->post('kata_sandi'))
				);

				$this->load->database('default', TRUE);
				$sql = $this->global_model->find_by('akun_login', $d_check);
				$sql2 = "";
				if(empty($sql)){
					$this->load->database('db_cnp', TRUE);
					$sql2 = $this->global_model->find_by('pkt_akun', $d_check);
				}

				if(count($sql) > 0 && $sql['status']==1){
		      $redirect = "/kelolaakun";
		    }else if(count($sql) > 0 && $sql['status']>1){
					$redirect = "/dash";
				}else if($sql2 != null && $sql2['status'] == 1){
					$redirect = "/dash";
				}else{
						$texterror = "Akun tidak valid";
				}
			}

			if(!empty($texterror)){
				if($status > 0){
					$texterror = ltrim($texterror, ',')." tidak boleh kosong";
				}
				$this->sysalert->message('danger',$texterror,'login');

			}else{
				$imgname = "default.png";
				$idakunpos = "";
				$statuspos = "";
				$namapenggunapos = "";
				$namalengkappos = "";
				$idjabatanpos = "";
				$iddivisipos = "";

				//ubah berdasarkan akun
				if(!empty($sql)){
					if(!empty($sql['img'])){
						$imgname = $sql['img'];
					}
					$idakunpos = $sql['id_akun'];
					$statuspos = $sql['status'];
					$namapenggunapos = $sql['nama_pengguna'];
					$namalengkappos = $sql['nama_lengkap'];
					$idjabatanpos = $sql['id_jabatan'];
					$iddivisipos = $sql['id_divisi'];

				}else{
					if(!empty($sql2)){
						$pktprofil = $this->global_model->find_by('pkt_profil', array('id_profil'=>$sql2['id_profil']));
						if(!empty($pktprofil['img'])){
							$imgname = $pktprofil['img'];
						}
						$idakunpos = $sql2['id_akun'];
						$statuspos = 2;
						$namapenggunapos = $sql2['nama_pengguna'];
						$namalengkappos = $pktprofil['nama_lengkap'];
						$idjabatanpos = 404;
						$iddivisipos = 2;
					}
				}

				$this->load->database('default', TRUE);
				$nkepala = "";
				$nwakil = "";
				$nkbidang = "";
				$qrykepala = $this->global_model->find_by('akun_login', array('id_jabatan'=>'100'));
				$qrywakil = $this->global_model->find_by('akun_login', array('id_jabatan'=>'99'));
				$qrykbidang = $this->global_model->find_by('akun_login', array('id_jabatan'=>'1'));
				if(!empty($qrykepala)){
					$nkepala = $qrykepala['nama_lengkap'];
				}
				if(!empty($qrywakil)){
					$nwakil = $qrywakil['nama_lengkap'];
				}
				if(!empty($qrykbidang)){
					$nkbidang = $qrykbidang['nama_lengkap'];
				}
				$session = array(
					'id_akun' => $idakunpos,
					'status' => $statuspos,
					'nama_pengguna' => $namapenggunapos,
					'nama_lengkap' => $namalengkappos,
					'id_jabatan' => $idjabatanpos,
					'id_divisi' => $iddivisipos,
					'img' => $imgname,
					'nkepala' => $nkepala,
					'nwakil' => $nwakil,
					'nkbidang' => $nkbidang,
					'jkepala' => 'Kepala Kampus',
					'jwakil' => 'Wakil Kepala Kampus',
					'jkbidang' => 'Kepala Bidang Akademik'
				);

				$this->session->set_userdata($session);
			}

			redirect(site_url($redirect));
		}

 		$this->load->view('header/login');
 		$this->load->view('konten/login/index');
 		$this->load->view('footer/login');
 	}

	public function logout(){
		$this->session->sess_destroy();
 		redirect(site_url('/'));
	}

}
