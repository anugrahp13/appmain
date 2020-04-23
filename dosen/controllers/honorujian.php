<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Honorujian extends CI_Controller {
	function __construct()
 	{
 		parent::__construct();
 		$this->load->model('global_model');
		$this->load->model('sysalert');
		$this->load->model('sysctrl');
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
		if($this->input->post('simpan')){
			$data = $this->input->post();
			unset($data['simpan']);

			$check = array(
				'inputcheck' => 'id_dosen,tgl,thn_ajaran',
				'mode' => '1',
				'ictexterror' => 'Nama Dosen,Tanggal Input,Tahun Ajaran',
				'checkdata' => 'id_dosen,tgl,thn_ajaran',
				'controller' => 'honorujian',
				'redirect' => '/honorujian'
			);

			$this->sysctrl->proses('hu_dosen', $data, $check);
		}
		$data['loaddata'] = $this->global_model->find_all('hu_dosen');
		$data['loaddosen'] = $this->global_model->find_all('dosen_profil');
		$data['loadthnajaran'] = $this->global_model->query("select thn_ajaran from sesi_dosen group by thn_ajaran");
 		$this->load->view('header/dash');
 		$this->load->view('konten/honorujian/index',$data);
 		$this->load->view('footer/dash');
 	}

	public function view(){
		$id = $this->input->post('id');
		$data['loadmatkul'] = $this->global_model->find_all_by('hu_data', array('id_hudosen'=>$id));
		$data['loaddosen'] = $this->global_model->find_by('hu_dosen', array('id_hudosen'=>$id));
		$this->load->view('konten/honorujian/view',$data);
	}

	public function cetakhonor($id){
		$data['loadmatkul'] = $this->global_model->find_all_by('hu_data', array('id_hudosen'=>$id));
		$data['loaddosen'] = $this->global_model->find_by('hu_dosen', array('id_hudosen'=>$id));
		$this->load->view('konten/honorujian/cetakitem',$data);

		$paper_size  = 'A4'; //paper size
		$orientation = 'potrait'; //tipe format kertas
		$html = $this->output->get_output();

		$this->dompdf->set_paper($paper_size, $orientation);
		//Convert to PDF
		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("sliphonorujianuser.pdf", array('Attachment'=>0));
	}

	public function cetak(){
		$idcheck = $this->input->post('id_dosen');
		$dari = $this->input->post('periode_dari');
		$sampai = $this->input->post('periode_sampai');
		$thn_ajaran = $this->input->post('thn_ajaran');
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');

		$sqlid = "";
		$sqlthn = "";
		if($idcheck != "all"){$sqlid = " and id_dosen='".$idcheck."'";}
		if($thn_ajaran != "all"){$sqlthn = " and thn_ajaran='".$thn_ajaran."'";}

		$sql = "select *from hu_dosen where (tgl between '".$dari."' and '".$sampai."')".$sqlid.$sqlthn;

		$data['loaddosen'] = $this->global_model->query($sql);

		//session
		$sessiondata = array (
				'bulan' => $this->input->post('bulan'),
				'tahun' => $this->input->post('tahun')
		);

		$this->session->set_userdata($sessiondata);

		$this->load->view('konten/honorujian/cetak',$data);

		$paper_size  = 'A4'; //paper size
		$orientation = 'potrait'; //tipe format kertas
		$html = $this->output->get_output();

		$this->dompdf->set_paper($paper_size, $orientation);
		//Convert to PDF
		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("sliphonorujian.pdf", array('Attachment'=>0));

	}

	public function viewdata($id){
		if($this->input->post('simpan')){
			$data = $this->input->post();
			$data['id_hudosen'] = $id;
			unset($data['simpan']);

			$check = array(
				'inputcheck' => 'qty_koreksi,qty_buat,qty_asistensi',
				'mode' => '1',
				'ictexterror' => 'Qty Koreksi,Qty buat,Qty Mengawas',
				'controller' => 'honorujian',
				'checkdata' => 'id_matkul,id_konsentrasi,semester,id_hudosen',
				'redirect' => '/honorujian/viewdata/'.$id
			);

			$this->sysctrl->proses('hu_data', $data, $check);

		}
		$acheck = $this->global_model->find_by('hu_dosen', array('id_hudosen'=>$id));
		$d = array('ujiantahun' => $acheck['thn_ajaran']);
		$this->session->set_userdata($d);
		$data['loaddosen'] = $this->global_model->find_by('hu_dosen', array('id_hudosen'=>$id));
		$data['loadmatkul'] = $this->global_model->find_all('m_matakuliah');
		$data['loadkonsentrasi'] = $this->global_model->find_all('m_konsentrasi');
		$data['loaddata'] = $this->global_model->find_all_by('hu_data', array('id_hudosen'=>$id));
		$this->load->view('header/dash');
 		$this->load->view('konten/honorujian/viewdata',$data);
 		$this->load->view('footer/dash');
	}

	public function hapus($id){
		$data = array($id);
		$idredirect = $this->global_model->find_by('hu_data', array('id_hud'=>$id));
		$config = array(
			'controller' => 'honorujian',
			'redirect' => '/honorujian/viewdata/'.$idredirect['id_hudosen'],
			'field' => 'id_hud'
		);

		$this->sysctrl->hapus('hu_data',$data,$config);
	}

	public function hapusujian(){
		$data = $this->input->post('check');

		if(is_array($data)){
			for($i = 0; $i < count($data); $i++){
				$this->global_model->delete('hu_dosen', array('id_hudosen' => $data[$i]));
				$this->global_model->delete('hu_data', array('id_hudosen' => $data[$i]));
			}

			$this->sysalert->message('success','Data berhasil di hapus','honorujian');
		}

		redirect(site_url('/honorujian'));
	}

	public function loadhonor($id){
		$databro = $this->global_model->find_by('dosen_profil', array('id_dosen'=>$id));
		$plain = $this->global_model->find_by('p_lain', array('id'=>1));
    //pendidikan
    $np = 0;
    $checkdidik = $this->global_model->find_by('m_pendidikan', array('id_pendidikan'=>$databro['pend_akhir']));
    if($checkdidik!=null){
      $np = $checkdidik['nominal'];
    }

    //praktisi
    $npr = 0;
    $checkpraktisi = $this->global_model->find_by('m_praktisi', array('id_praktisi'=>$databro['id_praktisi']));
    if($checkpraktisi!=null){
      $npr = $checkpraktisi['nominal'];
    }

    //japung
    $nj = 0;
    $checkjapung = $this->global_model->find_by('m_japung', array('id_japung'=>$databro['id_japung']));
    if($checkjapung!=null){
      $nj = $checkjapung['nominal'];
    }

    //nidn
    $nidn = 0;
    if($databro['nidn']!=""&&$databro['nidn']!="0"){
      $nidn = $plain['nidn'];
    }

    //masakerja
    $birthDate = $databro['tgl_kerja'];
    //explode the date to get month, day and year
    $birthDate = explode("/", $birthDate);
    //get age from date or birthdate
    $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
      ? ((date("Y") - $birthDate[2]) - 1)
      : (date("Y") - $birthDate[2]));

    $masakerja = 0;
    if($age > 0 ){
      $masakerja = $age;
    }

    $nm = 0;
    if($masakerja > 0 && $masakerja <= 3){
      $nm = $plain['0_3thn'];
    }else if($masakerja > 3 && $masakerja <= 5){
      $nm = $plain['3_5thn'];
    }else if($masakerja > 5 && $masakerja <= 10){
      $nm = $plain['5_10thn'];
    }else if($masakerja > 10 && $masakerja <= 15){
      $nm = $plain['10_15thn'];
    }else if($masakerja > 15){
      $nm = $plain['l15thn'];
    }

		//bahasa inggris
		$nb = 0;
		$matakul = $this->global_model->find_by('sesi_dosen', array('id_dosen'=>$databro['id_dosen'], 'thn_ajaran'=>$this->session->userdata('ujiantahun')));
		if(!empty($matakul)){
			$checknb = $this->global_model->query("select sum(nominal_inggris) as jumlah from sesi_data where id_sesi='".$matakul['id_sesi']."'");
			if(!empty($checknb)){
				$nb = $checknb[0]['jumlah'];
			}
		}

    //output honor
    $honor = intval($np+$npr+$nj+$nidn+$nm+$nb);
		//dsn_favorit
    if($databro['dsn_favorit']=="1"){
      $honor = $plain['dsn_favorit'];
    }
		$adata = array('honor'=>$honor);
		echo json_encode($adata);
	}

}
