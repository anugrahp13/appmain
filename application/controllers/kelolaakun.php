<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Kelolaakun extends CI_Controller {
	function __construct()
 	{
 		parent::__construct();
 		$this->load->model('global_model');
		$this->load->model('sysctrl');
		$this->load->model('sysalert');
 		$this->load->helper('url');
 		$this->load->library('session');

 	}
 	public function index(){
		if($this->input->post('simpan')){
			$data = $this->input->post();
			$data['status'] = 2;
			$a = $_FILES['img']['name'];
			$b = explode('.',$a);
			$newfilename = round(microtime(true)).'.'.end($b);

			$data['img'] = "";
			if(!empty($a)){
				$data['img'] = $newfilename;
			}else{
				unset($data['img']);
			}

			$data['kata_sandi'] = md5($this->input->post('kata_sandi'));
			unset($data['simpan']);

			$check = array(
				'inputcheck' => 'nama_lengkap,nama_pengguna,kata_sandi',
				'mode' => '1',
				'ictexterror' => 'Nama Lengkap,Nama Pengguna,Kata Sandi',
				'checkdata' => 'nama_lengkap,nama_pengguna',
				'controller' => 'kelolaakun',
				'redirect' => 'kelolaakun'
			);

			$this->sysctrl->proses('akun_login', $data, $check);

		}
		$data['loadakun'] = $this->global_model->query("select *from akun_login where status != 1");
		$this->load->view('header/admin');
 		$this->load->view('konten/kelolauser/index',$data);
 		$this->load->view('footer/admin');
 	}

	public function tampil($id){
		$tampil = $this->global_model->find_by('akun_login', array('id_akun' => $id));
		echo json_encode($tampil);
	}

	public function hapus(){
		$data = $this->input->post('check');
		$config = array(
			'controller' => 'kelolaakun',
			'redirect' => 'kelolaakun',
			'field' => 'id_akun'
		);

		$this->sysctrl->hapus('akun_login',$data,$config);

	}

	public function ubah($id){
		if($this->input->post('simpan')){
			$data = $this->input->post();
			$data['kata_sandi'] = md5($this->input->post('kata_sandi'));
			unset($data['simpan']);
			if($this->input->post('kata_sandi')==""){
				unset($data['kata_sandi']);
			}

			$get = $this->global_model->find_by('akun_login',array('id_akun' => $id));
			$a = $_FILES['img']['name'];
			$b = explode('.',$a);
			$newfilename = round(microtime(true)).'.'.end($b);

			if(empty($a)){
				unset($data['img']);
			}else{
				if(!empty($get['img'])){
					$c = explode('.',$get['img']);
					$newfilename = $c[0].'.'.$b[1];
				}

				$data['img'] = $newfilename;
			}

			$check = array(
				'inputcheck' => 'nama_lengkap,nama_pengguna,id_divisi,id_jabatan',
				'ictexterror' => 'Nama Lengkap,Nama Pengguna,id_divisi,id_jabatan',
				'mode' => '2',
				'idfield' => 'id_akun',
				'id' => $id,
				'checkdata' => 'nama_lengkap,nama_pengguna',
				'controller' => 'kelolaakun',
				'redirect' => 'kelolaakun'
			);

			$this->sysctrl->proses('akun_login', $data, $check);

		}
	}

}
