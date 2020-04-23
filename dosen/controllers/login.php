<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Login extends CI_Controller {
	function __construct()
 	{
 		parent::__construct();
 		$this->load->model('global_model');
		$this->load->model('sysctrl');
		$this->load->model('sysalert');
 		$this->load->helper('url');
 		$this->load->library('session');
 		if(!$this->session->userdata('id_akun')||$this->session->userdata('status')!=2||$this->session->userdata('id_divisi')!=1){
			$this->sysalert->message('danger','Login dengan akun yg sesuai','login');
 			redirect(base_url()."index.php");
 		}
 	}

 	public function index(){
		if($this->input->post('login')){
			$data = $this->input->post();
			unset($data['login']);

			// sample data check
			$check = array(
				'inputcheck' => 'nama_pengguna,kata_sandi',
				'mode' => '3',
				'ictexterror' => 'Nama pengguna,Kata sandi',
				'checkdata' => 'nama_pengguna,kata_sandi',
				'controller' => 'login',
				'redirect' => '/',
			);

			$this->sysctrl->proses('akun_login', $data, $check);

		}

 		$this->load->view('header/login');
 		$this->load->view('konten/login/index');
 		$this->load->view('footer/login');
 	}

	public function logout(){
		$this->session->sess_destroy();
 		redirect(base_url()."index.php");
	}
}
