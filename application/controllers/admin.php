<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin extends CI_Controller {
	function __construct()
 	{
 		parent::__construct();
 		$this->load->model('global_model');
		$this->load->model('sysctrl');
		$this->load->model('sysalert');
 		$this->load->helper('url');
 		$this->load->library('session');
		if(!$this->session->userdata('id_akun')||$this->session->userdata('status')!=1){
			redirect(site_url('/'));
		}

 	}
 	public function index(){
 		$this->load->view('header/admin');
 		$this->load->view('konten/admin/index');
 		$this->load->view('footer/admin');
 	}

	public function kelolaakun(){
		if($this->input->post('simpan')){
			$data = $this->input->post();
			$newfilename = "";
			$a = $_FILES['img']['name'];
			$b = explode('.',$a);
			$newfilename = round(microtime(true)).'.'.end($b);
			unset($data['simpan']);

			$check = array(
				'inputcheck' => 'nama_lengkap,nama_pengguna,status,kata_sandi',
				'mode' => '1',
				'ictexterror' => 'Nama Lengkap,Nama Pengguna,Status,Kata Sandi',
				'checkdata' => 'nama_lengkap,nama_pengguna,status',
				'controller' => 'kelolaakun',
				'redirect' => '/admin/kelolaakun'
			);

			if($a != ""){
				$data['img'] = $newfilename;
			}

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
			'redirect' => '/admin/kelolaakun',
			'field' => 'id_akun'
		);

		$this->sysctrl->hapus('akun_login',$data,$config);

	}

	public function ubah($id){
		if($this->input->post('simpan')){
			$data = $this->input->post();
			$get = $this->global_model->find_by('akun_login',array('id_akun' => $id));
			$a = $_FILES['img']['name'];
			$b = explode('.',$a);
			$newfilename = round(microtime(true)).'.'.end($b);

			if($get['img'] != ""){
				$c = explode('.',$get['img']);
				$newfilename = $c[0].'.'.$b[1];
			}
			unset($data['simpan']);

			$check = array(
				'inputcheck' => 'nama_lengkap,nama_pengguna,status,kata_sandi',
				'ictexterror' => 'Nama Lengkap,Nama Pengguna,Status,Kata Sandi',
				'mode' => '2',
				'idfield' => 'id_akun',
				'id' => $id,
				'checkdata' => 'nama_lengkap,nama_pengguna,status',
				'controller' => 'kelolaakun',
				'redirect' => '/admin/kelolaakun'
			);

			if($a != ""){
				$data['img'] = $newfilename;
			}

			$this->sysctrl->proses('akun_login', $data, $check);

		}
	}

}
