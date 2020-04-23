<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ttransport extends CI_Controller {
	function __construct()
 	{
 		parent::__construct();
 		$this->load->model('global_model');
		$this->load->model('sysctrl');
		$this->load->model('sysalert');
 		$this->load->helper('url');
 		$this->load->library('session');
		if(!$this->session->userdata('id_akun')||$this->session->userdata('status')!=2||$this->session->userdata('id_divisi')!=0 && $this->session->userdata('id_divisi')!=1){
			$this->sysalert->message('danger','Login dengan akun yg sesuai','login');
 			redirect(base_url()."index.php");
 		}
 	}
 	public function index(){
		if($this->input->post('simpan')){
			$data = $this->input->post();
			unset($data['simpan']);

			$check = array(
				'inputcheck' => 'id_matkul,banyak_transport,periode_dari,periode_sampai',
				'mode' => '1',
				'ictexterror' => 'Mata Kuliah,Banyak Transport,Periode Dari,Periode Sampai',
				'checkdata' => 'id_dosen,thn_ajaran,periode_dari,periode_sampai,id_matkul',
				'controller' => 'ttransport',
				'redirect' => '/ttransport'
			);

			$this->sysctrl->proses('dosen_transport', $data, $check);
		}

		$data['loadtransport'] = $this->global_model->find_all('dosen_transport');
		$data['loadmatkul'] = $this->global_model->find_all('m_matakuliah');
		$data['loaddosen'] = $this->global_model->find_all('dosen_profil');
		$data['loadthnajaran'] = $this->global_model->query("select distinct thn_ajaran from sesi_dosen group by thn_ajaran");
 		$this->load->view('header/dash');
 		$this->load->view('konten/ttransport/index',$data);
 		$this->load->view('footer/dash');
 	}

	public function hapus(){
		$data = $this->input->post('check');
		$config = array(
			'controller' => 'ttransport',
			'redirect' => '/ttransport',
			'field' => 'id_transport'
		);

		$this->sysctrl->hapus('dosen_transport',$data,$config);

	}

	public function tampil($id){
		$tampil = $this->global_model->find_by('dosen_transport', array('id_transport' => $id));
		echo json_encode($tampil);
	}

	public function ubah($id){
		if($this->input->post('simpan')){
			$data = $this->input->post();
			unset($data['simpan']);

			$check = array(
				'inputcheck' => 'id_matkul,banyak_transport,periode_dari,periode_sampai',
				'ictexterror' => 'Mata Kuliah Banyak Transport,Periode Dari,Periode Sampai',
				'mode' => '2',
				'idfield' => 'id_transport',
				'id' => $id,
				'checkdata' => 'id_dosen,thn_ajaran,periode_dari,periode_sampai,id_matkul',
				'controller' => 'ttransport',
				'redirect' => '/ttransport'
			);

			$this->sysctrl->proses('dosen_transport', $data, $check);
		}
	}
}
