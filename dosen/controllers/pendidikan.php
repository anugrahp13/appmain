<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Pendidikan extends CI_Controller {
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
		$data['loaddata'] = $this->global_model->find_all('m_pendidikan');
 		$this->load->view('header/dash');
 		$this->load->view('konten/pendidikan/index',$data);
 		$this->load->view('footer/dash');
 	}

	public function tampil($id){
		$tampil = $this->global_model->find_by('m_pendidikan', array('id_pendidikan' => $id));
		echo json_encode($tampil);
	}

	public function ubah($id){
		if($this->input->post('ubah')){
			$data = $this->input->post();
			unset($data['ubah']);

			$check = array(
				'inputcheck' => 'nominal',
				'ictexterror' => 'Nominal',
				'mode' => '2',
				'idfield' => 'id_pendidikan',
				'id' => $id,
				'checkdata' => 'nama_pendidikan',
				'controller' => 'pendidikan',
				'redirect' => '/pendidikan'
			);

			$this->sysctrl->proses('m_pendidikan', $data, $check);
		}
	}
}
