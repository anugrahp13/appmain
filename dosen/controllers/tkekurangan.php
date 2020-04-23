<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Tkekurangan extends CI_Controller {
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
				'inputcheck' => 'id_dosen,banyak,nominal_satuan,periode_dari,periode_sampai,thn_ajaran',
				'mode' => '1',
				'ictexterror' => 'Nama Dosen,Banyak,Nominal Satuan,Periode Dari,Periode Sampai,Tahun ajaran',
				'checkdata' => 'id_dosen,periode_dari,periode_sampai,thn_ajaran',
				'controller' => 'tkekurangan',
				'redirect' => '/tkekurangan'
			);

			$this->sysctrl->proses('dosen_kekurangan', $data, $check);
		}

		$data['loadkekurangan'] = $this->global_model->find_all('dosen_kekurangan');
		$data['loaddosen'] = $this->global_model->find_all('dosen_profil');
		$data['loadthnajaran'] = $this->global_model->query("select distinct thn_ajaran from sesi_dosen group by thn_ajaran");
 		$this->load->view('header/dash');
 		$this->load->view('konten/tkekurangan/index',$data);
 		$this->load->view('footer/dash');
 	}

	public function hapus(){
		$data = $this->input->post('check');
		$config = array(
			'controller' => 'tkekurangan',
			'redirect' => '/tkekurangan',
			'field' => 'id_kekurangan'
		);

		$this->sysctrl->hapus('dosen_kekurangan',$data,$config);

	}

	public function tampil($id){
		$tampil = $this->global_model->find_by('dosen_kekurangan', array('id_kekurangan' => $id));
		echo json_encode($tampil);
	}

	public function ubah($id){
		if($this->input->post('simpan')){
			$data = $this->input->post();
			unset($data['simpan']);

			$check = array(
				'inputcheck' => 'id_dosen,banyak,nominal_satuan,periode_dari,periode_sampai,thn_ajaran',
				'ictexterror' => 'Nama Dosen,Banyak,Nominal Satuan,Periode Dari,Periode Sampai,Tahun ajaran',
				'mode' => '2',
				'idfield' => 'id_kekurangan',
				'id' => $id,
				'checkdata' => 'id_dosen,periode_dari,periode_sampai,thn_ajaran',
				'controller' => 'tkekurangan',
				'redirect' => '/tkekurangan'
			);

			$this->sysctrl->proses('dosen_kekurangan', $data, $check);
		}
	}
}
