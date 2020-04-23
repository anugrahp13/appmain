<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Konsentrasi extends CI_Controller {
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
		if($this->input->post('simpan')){
			$data = $this->input->post();
			unset($data['simpan']);

			$check = array(
				'inputcheck' => 'nama_konsentrasi,kd_konsentrasi',
				'mode' => '1',
				'ictexterror' => 'Nama Konsentrasi,Kode Konsentrasi',
				'checkdata' => 'kd_konsentrasi',
				'controller' => 'konsentrasi',
				'redirect' => '/konsentrasi'
			);

			$this->sysctrl->proses('m_konsentrasi', $data, $check);
		}

		$data['loadkonsentrasi'] = $this->global_model->find_all('m_konsentrasi');
 		$this->load->view('header/dash');
 		$this->load->view('konten/konsentrasi/index',$data);
 		$this->load->view('footer/dash');
 	}

	public function hapus(){
		$data = $this->input->post('check');
		$config = array(
			'controller' => 'konsentrasi',
			'redirect' => '/konsentrasi',
			'field' => 'id_konsentrasi'
		);

		$this->sysctrl->hapus('m_konsentrasi',$data,$config);

	}

	public function tampil($id){
		$tampil = $this->global_model->find_by('m_konsentrasi', array('id_konsentrasi' => $id));
		echo json_encode($tampil);
	}

	public function ubah($id){
		if($this->input->post('ubah')){
			$data = $this->input->post();
			unset($data['ubah']);

			$check = array(
				'inputcheck' => 'nama_konsentrasi,kd_konsentrasi',
				'ictexterror' => 'Nama Konsentrasi,Kode Konsentrasi',
				'mode' => '2',
				'idfield' => 'id_konsentrasi',
				'id' => $id,
				'checkdata' => 'kd_konsentrasi',
				'controller' => 'konsentrasi',
				'redirect' => '/konsentrasi'
			);

			$this->sysctrl->proses('m_konsentrasi', $data, $check);
		}
	}


}
