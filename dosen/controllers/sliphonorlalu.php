<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Sliphonorlalu extends CI_Controller {
	function __construct()
 	{
 		parent::__construct();
 		$this->load->model('global_model');
		$this->load->model('sysctrl');
		$this->load->model('sysalert');
 		$this->load->helper('url');
 		$this->load->library('session');
		// Load library
		$this->load->library('dompdf_gen');
		if(!$this->session->userdata('id_akun')||$this->session->userdata('status')!=2||$this->session->userdata('id_divisi')!=0 && $this->session->userdata('id_divisi')!=1){
			$this->sysalert->message('danger','Login dengan akun yg sesuai','login');
 			redirect(base_url()."index.php");
 		}
 	}
 	public function index(){
		$data['loaddosen'] = $this->global_model->find_all('dosen_profil');
    $data['thnajaran'] = $this->global_model->query('select thn_ajaran from sesi_dosen group by thn_ajaran');
 		$this->load->view('header/dash');
 		$this->load->view('konten/sliphonorlalu/index',$data);
 		$this->load->view('footer/dash');
 	}

  public function loaddata(){
    $id = $this->input->post('id');
    $thn = $this->input->post('thn');

    $datacheck = array(
      'id_dosen' => $id,
      'thn_ajaran' => $thn
    );
    if($thn == ""){
      unset($datacheck['thn_ajaran']);
    }

		if($id == ""){
      unset($datacheck['id_dosen']);
    }

		$data['load'] = $this->global_model->find_all_by('backup_honordosen', $datacheck);
		if(empty($datacheck)){
			$data['load'] = $this->global_model->find_all('backup_honordosen');
		}

		$this->load->view('konten/sliphonorlalu/view',$data);

  }

	public function cetak($id){
		$data['bro'] = $this->global_model->find_by('backup_honordosen', array('id_backup'=>$id));
		$a = $this->global_model->find_by('backup_honordosen', array('id_backup'=>$id));
		$this->load->view('konten/sliphonorlalu/cetak',$data);
		$paper_size  = 'A4'; //paper size
		$orientation = 'potrait'; //tipe format kertas
		$html = $this->output->get_output();

		$this->dompdf->set_paper($paper_size, $orientation);
		//Convert to PDF
		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("sliphonorlalu.pdf", array('Attachment'=>0));
	}

}
