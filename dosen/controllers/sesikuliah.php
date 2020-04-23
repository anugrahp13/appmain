<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Sesikuliah extends CI_Controller {
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
		$data['loaddosen'] = $this->global_model->find_all('dosen_profil');
		$data['loadmatkul'] = $this->global_model->query('select thn_ajaran from sesi_dosen group by thn_ajaran');
 		$this->load->view('header/dash');
 		$this->load->view('konten/sesikuliah/index',$data);
 		$this->load->view('footer/dash');
 	}

	public function t($id){
		//auto redirect jika data kosong di db
		$checkdb = $this->global_model->find_by('dosen_profil', array('id_dosen'=>$id));
		if($checkdb == null){
			$this->sysalert->message('info','Data dosen tidak ditemukan di database', 'sesikuliah');
			redirect(site_url('/sesikuliah'));
		}

		if($this->input->post('simpan')){
			$data = $this->input->post();
			$data['id_dosen'] = $id;
			unset($data['simpan']);

			$check = array(
				'inputcheck' => 'thn_ajaran',
				'mode' => '1',
				'ictexterror' => 'Tahun Ajaran',
				'checkdata' => 'id_dosen,thn_ajaran',
				'controller' => 'sesikuliah',
				'redirect' => '/sesikuliah/t/'.$id
			);

			$this->sysctrl->proses('sesi_dosen', $data, $check);
		}

		$d = array('tid' => $id);
		$this->session->set_userdata($d);
		$data['loadsesi'] = $this->global_model->query("select id_sesi,thn_ajaran from sesi_dosen where id_dosen='".$id."' group by thn_ajaran");
 		$this->load->view('header/dash');
 		$this->load->view('konten/sesikuliah/tahun',$data);
 		$this->load->view('footer/dash');
	}

	public function thapus(){
		$data = $this->input->post('check');
		$session = $this->session->userdata('tid');
		if(is_array($data)){
			for($i = 0; $i < count($data); $i++){
				$this->global_model->delete('sesi_dosen', array('id_sesi' => $data[$i]));
				$this->global_model->delete('sesi_data', array('id_sesi' => $data[$i]));
			}

			$this->sysalert->message('success','Data berhasil di hapus','sesikuliah');
		}

		redirect(site_url('/sesikuliah/t/'.$session));
	}

	public function view($id){
		//auto redirect jika data kosong di db
		$checkdb = $this->global_model->find_by('sesi_dosen', array('id_sesi'=>$id));
		if($checkdb == null){
			$this->sysalert->message('info','Tahun ajaran tidak ditemukan di database', 'sesikuliah');
			redirect(site_url('/sesikuliah/t/'.$this->session->userdata('tid')));
		}

		if($this->input->post('simpan')){
			$data = $this->input->post();
			$data['id_sesi'] = $id;
			unset($data['simpan']);

			$check = array(
				'inputcheck' => 'id_matkul,id_konsentrasi,sks,semester,nominal_inggris',
				'mode' => '1',
				'ictexterror' => 'Mata Kuliah,Konsentrasi,SKS,Semester,Nominal Inggris',
				'checkdata' => 'id_matkul,id_konsentrasi,sks,semester,id_sesi',
				'controller' => 'sesikuliah',
				'redirect' => '/sesikuliah/view/'.$id
			);

			$this->sysctrl->proses('sesi_data', $data, $check);
		}

		$data['loaddata'] = $this->global_model->find_all_by('sesi_data', array('id_sesi'=>$id));
		$data['loaddosen'] = $this->global_model->find_by('sesi_dosen', array('id_sesi'=> $id));
		$data['loadmatkul'] = $this->global_model->find_all('m_matakuliah');
		$data['loadkonsentrasi'] = $this->global_model->find_all('m_konsentrasi');
		$this->load->view('header/dash');
 		$this->load->view('konten/sesikuliah/matkul',$data);
 		$this->load->view('footer/dash');
	}

	public function hapus($id){
		$idredirect = $this->global_model->find_by('sesi_data', array('id_sesid'=>$id));

		$this->global_model->delete('sesi_data', array('id_sesid'=>$id));
		$this->global_model->delete('sesi_d', array('id_sesid'=>$id));

		$this->sysalert->message('success','Data berhasil di hapus','sesikuliah');

		redirect(site_url('sesikuliah/view/'.$idredirect['id_sesi']));
	}

	public function sesi($id){
		$idredirect = $this->global_model->find_by('sesi_data', array('id_sesid'=>$id));

		if($this->input->post('simpan')){
			$data = $this->input->post();
			$data['id_sesid'] = $id;
			unset($data['simpan']);

			if($data['tgl_sesi']==""){
				$this->sysalert->message('danger','Tanggal Pertemuan tidak boleh kosong', 'sesikuliah');
			}else if($data['jmlhsesi']==""){
				$this->sysalert->message('danger','Banyak Sesi tidak boleh kosong', 'sesikuliah');
			}else{
				$this->global_model->create('sesi_d', $data);
				$this->sysalert->message('success','Sesi berhasil di tambahkan', 'sesikuliah');
			}

			redirect(site_url('/sesikuliah/view/'.$idredirect['id_sesi']));
		}
	}

	public function hapussesi(){
		$data = $this->input->post('check');

		if(is_array($data)){
			for($i = 0; $i < count($data); $i++){
				$this->global_model->delete('sesi_dosen', array('id_sesi' => $data[$i]));
				$this->global_model->delete('sesi_data', array('id_sesi' => $data[$i]));
			}

			$this->sysalert->message('success','Data berhasil di hapus','sesikuliah');
		}

		redirect(site_url('/sesikuliah'));
	}

	public function checksesi(){
		$iddosen = $this->input->post('id');
		$thn = $this->input->post('tahun');
		$dari = $this->input->post('dari');
		$sampai = $this->input->post('sampai');

		$jml = 0;
		$sesidosen = $this->global_model->find_by('sesi_dosen', array('id_dosen'=>$iddosen,'thn_ajaran'=>$thn));
		if($sesidosen!=null){
			$sesi_data = $this->global_model->find_all_by('sesi_data', array('id_sesi'=>$sesidosen['id_sesi']));
			if(!empty($sesi_data)){
				foreach ($sesi_data as $key) {
					$a = $this->global_model->query("select sum(jmlhsesi) as jmlh from sesi_d where (tgl_sesi between '".$dari."' and '".$sampai."') and id_sesid='".$key['id_sesid']."'");
					$get = $a[0]['jmlh'];
					$jml = intval($jml+$get);
				}
			}
		}

		echo "<label>Jumlah Sesi</label>";
		echo "<input type='text' class='form-control' disabled value='".$jml."'>";

	}

	public function viewsesi($id){
		$data['loaddata'] = $this->global_model->find_all_by('sesi_d', array('id_sesid'=>$id));
		$data['loadsesidata'] = $this->global_model->find_by('sesi_data', array('id_sesid'=>$id));
		$this->load->view('header/dash');
 		$this->load->view('konten/sesikuliah/view', $data);
 		$this->load->view('footer/dash');
	}

	public function hapussesid($id){
		$data = array($id);
		$idredirect = $this->global_model->find_by('sesi_d', array('id_d'=>$id));
		$config = array(
			'controller' => 'sesikuliah',
			'redirect' => '/sesikuliah/viewsesi/'.$idredirect['id_sesid'],
			'field' => 'id_d'
		);

		$this->sysctrl->hapus('sesi_d',$data,$config);
	}

	public function tampil($id){
		$tampil = $this->global_model->find_by('sesi_data', array('id_sesid' => $id));
		echo json_encode($tampil);
	}

	public function ubah($id){
		$idredirect = $this->global_model->find_by('sesi_data', array('id_sesid'=>$id));
		if($this->input->post('simpan')){
			$data = $this->input->post();
			unset($data['simpan']);

			$check = array(
				'inputcheck' => 'id_matkul,id_konsentrasi,sks,semester,nominal_inggris',
				'ictexterror' => 'Mata Kuliah,Konsentrasi,SKS,Semester,Nominal Inggris',
				'mode' => '2',
				'idfield' => 'id_sesid',
				'id' => $id,
				'checkdata' => 'id_matkul,id_konsentrasi,sks,semester,id_sesi',
				'controller' => 'sesikuliah',
				'redirect' => '/sesikuliah/view/'.$idredirect['id_sesi']
			);

			$this->sysctrl->proses('sesi_data', $data, $check);
		}
	}

}
