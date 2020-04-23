<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Sliphonor extends CI_Controller {
	function __construct()
 	{
 		parent::__construct();
 		$this->load->model('global_model');
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
		$data['loaddata'] = $this->global_model->query("select thn_ajaran from sesi_dosen group by thn_ajaran");
    $data['loaddosen'] = $this->global_model->find_all('dosen_profil');
		$this->load->view('header/dash');
    $this->load->view('konten/sliphonor/index', $data);
		$this->load->view('footer/dash');
 	}

	public function cetak(){
		$textalert = "";
		$inputcheck = array('bulan','tahun','id_dosen','thn_ajaran','periode_dari','periode_sampai');
		$ictexterror = array('Bulan','Tahun','Nama Dosen','Tahun Ajaran','Periode Dari','Periode Sampai');
		//utk checking input yg required
    for($i=0; $i < count($inputcheck); $i++){
      if($this->input->post($inputcheck[$i]) == ""){
        $textalert = $textalert.",".$ictexterror[$i];
      }
    }

		if(!empty($textalert)){
			$textalert = ltrim($textalert, ',')." tidak boleh kosong";
			$this->sysalert->message("danger",$textalert,'sliphonor');
			redirect(site_url('/sliphonor'));
		}else{
			if($this->input->post('id_dosen')=="all"){
				$data['loaddosen'] = $this->global_model->find_all('dosen_profil');
			}else{
				$data['loaddosen'] = $this->global_model->find_all_by('dosen_profil', array('id_dosen'=>$this->input->post('id_dosen')));
			}

			$thnajaran = $this->input->post('thn_ajaran');
			$periodedari = $this->input->post('periode_dari');
			$periodesampai = $this->input->post('periode_sampai');

			$acheck = 0;
			if($this->input->post('rekamcetak')!=null){
				$acheck = 1;
			}

			//session
			$sessiondata = array (
					'bulan' => $this->input->post('bulan'),
					'tahun' => $this->input->post('tahun'),
					'thnajaran' => $this->input->post('thn_ajaran'),
					'periodedari' => $this->input->post('periode_dari'),
					'periodesampai' => $this->input->post('periode_sampai'),
					'backup' => $acheck
			);

			$this->session->set_userdata($sessiondata);
			$this->load->view('konten/sliphonor/cetak',$data);

			$paper_size  = 'A4'; //paper size
			$orientation = 'potrait'; //tipe format kertas
			$html = $this->output->get_output();

			$this->dompdf->set_paper($paper_size, $orientation);
			//Convert to PDF
			$this->dompdf->load_html($html);
			$this->dompdf->render();
			$this->dompdf->stream("sliphonor.pdf", array('Attachment'=>0));

		}
	}

  public function cetak2(){
    $this->load->view('konten/sliphonor/print');
  }
}
