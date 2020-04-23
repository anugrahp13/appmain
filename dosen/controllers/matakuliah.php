<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Matakuliah extends CI_Controller {
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
				'inputcheck' => 'nama_matkul',
				'mode' => '1',
				'ictexterror' => 'Nama Mata Kuliah',
				'checkdata' => 'nama_matkul',
				'controller' => 'matakuliah',
				'redirect' => '/matakuliah'
			);

			$this->sysctrl->proses('m_matakuliah', $data, $check);
		}

		$data['loadkuliah'] = $this->global_model->find_all('m_matakuliah');
 		$this->load->view('header/dash');
 		$this->load->view('konten/matakuliah/index',$data);
 		$this->load->view('footer/dash');
 	}

	public function hapus(){
		$data = $this->input->post('check');
		$config = array(
			'controller' => 'matakuliah',
			'field' => 'id_matkul',
			'redirect' => '/matakuliah'
		);

		$this->sysctrl->hapus('m_matakuliah',$data,$config);

	}

	public function tampil($id){
		$tampil = $this->global_model->find_by('m_matakuliah', array('id_matkul' => $id));
		echo json_encode($tampil);
	}

	public function ubah($id){
		if($this->input->post('ubah')){
			$data = $this->input->post();
			unset($data['ubah']);

			$check = array(
				'inputcheck' => 'nama_matkul',
				'ictexterror' => 'Nama Mata Kuliah',
				'mode' => '2',
				'idfield' => 'id_matkul',
				'id' => $id,
				'checkdata' => 'nama_matkul',
				'controller' => 'matakuliah',
				'redirect' => '/matakuliah'
			);

			$this->sysctrl->proses('m_matakuliah', $data, $check);
		}
	}
}
