<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Japung extends CI_Controller {
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
				'inputcheck' => 'nama_japung,nominal',
				'mode' => '1',
				'ictexterror' => 'Nama Japung,Nominal',
				'checkdata' => 'nama_japung',
				'controller' => 'japung',
				'redirect' => '/japung'
			);

			$this->sysctrl->proses('m_japung', $data, $check);
		}

		$data['loadjapung'] = $this->global_model->find_all('m_japung');
 		$this->load->view('header/dash');
 		$this->load->view('konten/japung/index',$data);
 		$this->load->view('footer/dash');
 	}

	public function hapus(){
		$data = $this->input->post('check');
		$config = array(
			'controller' => 'japung',
			'redirect' => '/japung',
			'field' => 'id_japung'
		);

		$this->sysctrl->hapus('m_japung',$data,$config);

	}

	public function tampil($id){
		$tampil = $this->global_model->find_by('m_japung', array('id_japung' => $id));
		echo json_encode($tampil);
	}

	public function ubah($id){
		if($this->input->post('ubah')){
			$data = $this->input->post();
			unset($data['ubah']);

			$check = array(
				'inputcheck' => 'nama_japung,nominal',
				'ictexterror' => 'Nama Japung,Nominal',
				'mode' => '2',
				'idfield' => 'id_japung',
				'id' => $id,
				'checkdata' => 'nama_japung',
				'controller' => 'japung',
				'redirect' => '/japung'
			);

			$this->sysctrl->proses('m_japung', $data, $check);
		}
	}
}
