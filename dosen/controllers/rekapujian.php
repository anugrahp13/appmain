<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Rekapujian extends CI_Controller {
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
		$this->load->view('header/dash');
    $this->load->view('konten/rekapujian/index', $data);
		$this->load->view('footer/dash');
 	}

	public function cetak(){
		$textalert = "";
		$inputcheck = array('bulan','tahun','thn_ajaran','periode_dari','periode_sampai');
		$ictexterror = array('Bulan','Tahun','Tahun Ajaran','Periode Dari','Periode Sampai');

		$dari = $this->input->post('periode_dari');
		$sampai = $this->input->post('periode_sampai');
		$thn_ajaran = $this->input->post('thn_ajaran');

		//utk checking input yg required
    for($i=0; $i < count($inputcheck); $i++){
      if($this->input->post($inputcheck[$i]) == ""){
        $textalert = $textalert.",".$ictexterror[$i];
      }
    }

		if(!empty($textalert)){
			$textalert = ltrim($textalert, ',')." tidak boleh kosong";
			$this->sysalert->message("danger",$textalert,'rekapslip');
			redirect(site_url('/rekapujian'));
		}else{
			$sql = "select *from hu_dosen where (tgl between '".$dari."' and '".$sampai."') and thn_ajaran='".$thn_ajaran."'";

			$data['loaddosen'] = $this->global_model->query($sql);;
			$thnajaran = $this->input->post('thn_ajaran');
			$periodedari = $this->input->post('periode_dari');
			$periodesampai = $this->input->post('periode_sampai');

			//session
			$sessiondata = array (
					'bulan' => $this->input->post('bulan'),
					'tahun' => $this->input->post('tahun'),
					'thnajaran' => $this->input->post('thn_ajaran'),
					'periodedari' => $this->input->post('periode_dari'),
					'periodesampai' => $this->input->post('periode_sampai')
			);
			$this->session->set_userdata($sessiondata);
			$this->load->view('konten/rekapujian/cetak',$data);

			 $paper_size  = 'A4'; //paper size
			 $orientation = 'landscape'; //tipe format kertas
			 $html = $this->output->get_output();

			 $this->dompdf->set_paper($paper_size, $orientation);
			 //Convert to PDF
			 $this->dompdf->load_html($html);
			 $this->dompdf->render();
			 $this->dompdf->stream("rekapslipujian.pdf", array('Attachment'=>0));

		}
	}
}
