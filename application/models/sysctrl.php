<?php

class Sysctrl extends CI_Model{
	public function __construct() {
		parent::__construct();
		$this->load->database();
    	$this->load->model('sysalert');
		$this->load->model('sysimg');
		$this->load->helper('url');
		$this->load->library('session');

	}

  //fungsi ini untuk generate control input
 	function proses($table,$data,$check) {
		/* sample data check
		$check = array(
			'inputcheck' => 'nama_input,kelas',
			'idfield' => 'id_jabatan' //hanya required di mode update
			'id' => '2' //hanya required di mode update
			'mode' => '1', //1 utk tambah, 2 update data, 3 untuk login
			'ictexterror' => 'nama,kelas',
			'checkdata' => 'nama',
			'controller' => 'login',
			'redirect' => '/'
		)*/

		$inputcheck = explode(",", $check['inputcheck']);
		$ictexterror = explode(",", $check['ictexterror']);
		$checkdata = explode(",", $check['checkdata']);
		$d_check = array();
		$status = 0;

    	$textalert = "";

	    //utk checking input yg required
	    for($i=0; $i < count($inputcheck); $i++){
	      if($data[$inputcheck[$i]] == ""){
	        $textalert = $textalert.",".$ictexterror[$i];
					$status = $status + 1;
	      }
	    }

		if($status == 0){
			if(isset($check['checkdata'])){
				//add field yang mau dicheck
				for ($j=0; $j < count($checkdata); $j++) {
					$d_check[$checkdata[$j]] = $data[$checkdata[$j]];
				}
			}

			//patch login sementara utk hash
			if($check['mode'] == "3"){
				$d_check['password'] = md5($d_check['password']);
			}

			$gobs = "";			//checking ada data image atau tidak
			if(!empty($data['img'])){
				$gobs = $this->sysimg->check('img', $check['controller'],$data['img']);
			}

	    	//untuk check tidak boleh sama di db tergantung mode
			$sql = 0;
			$bcot = 0;
			if(isset($check['checkdata'])){
				$sql = $this->global_model->find_by($table, $d_check);
			}
			if($check['mode'] == "1"){ //input
				if(count($sql) > 0){
		      $textalert = "Data sudah tersedia";
		    }else{
		    	$bcot = 1;
					//simpan
					//$this->global_model->create($table, $data);
				}

			}else if($check['mode'] == "2"){ //update
				if(!empty($gobs)){
					$textalert = $gobs;
				}else if(count($sql) > 0 && $sql[$check['idfield']] != $check['id']){
		      		$textalert = "Data sudah tersedia";
		    	}else{
		    		$bcot = 2;
					//simpan
					//$this->global_model->update($table, $data, array($check['idfield'] => $check['id']));
				}

			}else if($check['mode'] == "3"){ //login
				if(count($sql) > 0){
		      	$check['redirect'] = "/camplog";
		    }else{
					$textalert = "Akun tidak valid";
				}
			}

		}

	    //action setelah proses gagal & login
	    if(!empty($textalert)){
	    	if($status > 0){
				$textalert = ltrim($textalert, ',')." tidak boleh kosong";
			}

	      	$this->sysalert->message("danger",$textalert,$check['controller']);

			//history form
			$this->session->set_flashdata($data);

	    }else{ //sukses proses
			if($check['mode'] == "3"){ //login
				//buat session login
				$sessiondata = array (
					'id_users' => $sql['id_users']);

					$this->session->set_userdata($sessiondata);
			}

	    }

	    //Action Prosess Success
	    if($bcot == 1){
	    	$this->global_model->create($table, $data);
	    	$this->sysalert->message("success","Data berhasil ditambahkan",$check['controller']);
	    }else if($bcot == 2){
	    	$this->global_model->update($table, $data, array($check['idfield'] => $check['id']));
	    	$this->sysalert->message("success","Data berhasil diperbarui",$check['controller']);
	    }

			redirect(site_url($check['redirect']));

 	}

	function hapus($table,$data,$config){
		if(is_array($data)){
			for($i = 0; $i < count($data); $i++){
				$this->global_model->delete($table, array($config['field'] => $data[$i]));
			}
			$this->sysalert->message("success","Data berhasil dihapus",$config['controller']);
		}

		redirect(site_url($config['redirect']));

	}

}
