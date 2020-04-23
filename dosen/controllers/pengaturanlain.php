<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Pengaturanlain extends CI_Controller {
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
			$textalert = "";
			$inputcheck = array('pph_npwp','pph_nonpwp','0_3thn','3_5thn','5_10thn','10_15thn','l15thn','2sks','4sks','puts','puas','dsn_favorit');
			$ictexterror = array('PPh Jika Ada Npwp','PPh Jika Tidak Ada Npwp','Masa Kerja 0-3 Tahun','Masa Kerja 3-5 Tahun','Masa Kerja 5-10 Tahun','Masa Kerja 10-15 Tahun','Masa Kerja > 15 Tahun','Koreksi 2 SKS','Koreksi 4 SKS','UTS','UAS','Dosen Favorit');
			//utk checking input yg required
	    for($i=0; $i < count($inputcheck); $i++){
	      if($this->input->post($inputcheck[$i]) == ""){
	        $textalert = $textalert.",".$ictexterror[$i];
	      }
	    }

			if(!empty($textalert)){
				$textalert = ltrim($textalert, ',')." tidak boleh kosong";
				$this->sysalert->message("danger",$textalert,'pengaturanlain');
			}else{
				$this->global_model->update('p_lain',$data,array('id'=>1));
				$this->sysalert->message("success",'Data berhasil di perbarui','pengaturanlain');
			}

			redirect(site_url('/pengaturanlain'));
		}
		$data['loaddata'] = $this->global_model->find_by('p_lain', array('id'=>1));
 		$this->load->view('header/dash');
 		$this->load->view('konten/pengaturanlain/index',$data);
 		$this->load->view('footer/dash');
 	}

}
