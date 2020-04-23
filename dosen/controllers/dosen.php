<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Dosen extends CI_Controller {
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
		$data['tahunajaran'] = $this->global_model->query("select thn_ajaran from sesi_dosen group by thn_ajaran");
 		$this->load->view('header/dash');
 		$this->load->view('konten/dosen/index', $data);
 		$this->load->view('footer/dash');
 	}

	public function tambah(){
		if($this->input->post('simpan')){
			$data = $this->input->post();
			$newfilename = "";
			$a = $_FILES['img']['name'];
			$b = explode('.',$a);
			$newfilename = round(microtime(true)).'.'.end($b);
			unset($data['simpan']);

			$check = array(
				'inputcheck' => 'nama_lengkap,tempat_lahir,tgl_lahir,tgl_kerja,agama,email,pend_akhir,id_praktisi,id_japung',
				'mode' => '1',
				'ictexterror' => 'Nama Lengkap,Tempat Lahir,Tanggal Lahir,Tanggal Mulai Kerja,Agama,Email,Pendidikan Akhir,Praktisi,Japung',
				'checkdata' => 'nama_lengkap,tempat_lahir,tgl_lahir,tgl_kerja,agama,email,pend_akhir,gelar',
				'controller' => 'dosen',
				'redirect' => '/dosen/tambah'
			);

			if($a != ""){
				$data['img'] = $newfilename;
			}

			$this->sysctrl->proses('dosen_profil', $data, $check);
		}

		$data['loadpraktisi'] = $this->global_model->find_all('m_praktisi');
		$data['loadjapung'] = $this->global_model->find_all('m_japung');
		$this->load->view('header/dash');
 		$this->load->view('konten/dosen/tambah',$data);
 		$this->load->view('footer/dash');
	}

	public function view($id){
		//auto redirect jika data kosong di db
		$checkdb = $this->global_model->find_by('dosen_profil', array('id_dosen'=>$id));
		if($checkdb == null){
			$this->sysalert->message('info','Data tidak ditemukan di database', 'dosen');
			redirect(site_url('/dosen'));
		}

		$data['view'] = $this->global_model->find_by('dosen_profil', array('id_dosen'=>$id));
		$this->load->view('header/dash');
 		$this->load->view('konten/dosen/view',$data);
 		$this->load->view('footer/dash');
	}

	public function ubah($id){
		//auto redirect jika data kosong di db
		$checkdb = $this->global_model->find_by('dosen_profil', array('id_dosen'=>$id));
		if($checkdb == null){
			$this->sysalert->message('info','Data tidak ditemukan di database', 'dosen');
			redirect(site_url('/dosen'));
		}


		if($this->input->post('ubah')){
			$data = $this->input->post();
			$get = $this->global_model->find_by('dosen_profil',array('id_dosen' => $id));
			$a = $_FILES['img']['name'];
			$b = explode('.',$a);
			$newfilename = round(microtime(true)).'.'.end($b);

			if($get['img'] != ""){
				$c = explode('.',$get['img']);
				$newfilename = $c[0].'.'.$b[1];
			}
			unset($data['ubah']);

			$check = array(
				'inputcheck' => 'nama_lengkap,tempat_lahir,tgl_lahir,tgl_kerja,tgl_kerja,agama,email,pend_akhir,id_praktisi,id_japung',
				'ictexterror' => 'Nama Lengkap,Tempat Lahir,Tanggal Lahir,Tanggal Kerja,Agama,Email,Pendidikan Akhir,Praktisi,Japung',
				'mode' => '2',
				'idfield' => 'id_dosen',
				'id' => $id,
				'checkdata' => 'nama_lengkap,tempat_lahir,tgl_lahir,tgl_kerja,agama,email,pend_akhir,gelar',
				'controller' => 'dosen',
				'redirect' => '/dosen/ubah/'.$id
			);

			if($a != ""){
				$data['img'] = $newfilename;
			}

			$this->sysctrl->proses('dosen_profil', $data, $check);

		}

		$data['detail'] = $this->global_model->find_by('dosen_profil', array('id_dosen'=>$id));
		$data['loadpraktisi'] = $this->global_model->find_all('m_praktisi');
		$data['loadjapung'] = $this->global_model->find_all('m_japung');
		$this->load->view('header/dash');
 		$this->load->view('konten/dosen/ubah',$data);
 		$this->load->view('footer/dash');
	}

	public function hapus(){
		$data = $this->input->post('check');
		$config = array(
			'field' => 'id_dosen',
			'controller' => 'dosen',
			'redirect' => '/dosen'
		);
		$this->sysctrl->hapus('dosen_profil',$data,$config);
	}

	public function cetak(){
		$data['load'] = $this->global_model->find_all_by('dosen_profil', array('id_dosen'=>$this->input->post('id_dosen')));
		$data['inithnajaran'] = $this->input->post('thnajaran');

		if($this->input->post('id_dosen')=="all"){
			$data['load'] = $this->global_model->query('select *from dosen_profil');
		}

		$viewnya = "konten/dosen/cetak";
		$orientation = 'potrait'; //tipe format kertas
		if($this->input->post('tipecetakan')=="rekap"){
			$viewnya = "konten/dosen/cetakall";
			$orientation = 'landscape';
		}

		$this->load->view($viewnya,$data);
		$paper_size  = 'A4'; //paper size
		$html = $this->output->get_output();
		$this->dompdf->set_paper($paper_size, $orientation);
		//Convert to PDF
		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("datadosen.pdf", array('Attachment'=>0));
	}

}
