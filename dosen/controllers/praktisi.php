<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Praktisi extends CI_Controller {
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
				'inputcheck' => 'nama_praktisi,nominal',
				'mode' => '1',
				'ictexterror' => 'Nama Praktisi,Nominal',
				'checkdata' => 'nama_praktisi',
				'controller' => 'praktisi',
				'redirect' => '/praktisi'
			);

			$this->sysctrl->proses('m_praktisi', $data, $check);
		}

		$data['loadpraktisi'] = $this->global_model->find_all('m_praktisi');
 		$this->load->view('header/dash');
 		$this->load->view('konten/praktisi/index', $data);
 		$this->load->view('footer/dash');
 	}

	public function hapus(){
		$data = $this->input->post('check');
		$config = array(
			'controller' => 'praktisi',
			'redirect' => '/praktisi',
			'field' => 'id_praktisi'
		);

		$this->sysctrl->hapus('m_praktisi',$data,$config);

	}

	public function tampil($id){
		$tampil = $this->global_model->find_by('m_praktisi', array('id_praktisi' => $id));
		echo json_encode($tampil);
	}

	public function ubah($id){
		if($this->input->post('ubah')){
			$data = $this->input->post();
			unset($data['ubah']);

			$check = array(
				'inputcheck' => 'nama_praktisi,nominal',
				'ictexterror' => 'Nama Praktisi,Nominal',
				'mode' => '2',
				'idfield' => 'id_praktisi',
				'id' => $id,
				'checkdata' => 'nama_praktisi',
				'controller' => 'praktisi',
				'redirect' => '/praktisi'
			);

			$this->sysctrl->proses('m_praktisi', $data, $check);
		}
	}

}
