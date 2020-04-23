<?php

class Sysimg extends CI_Model{
	public function __construct() {
		parent::__construct();
		$this->load->database();
    	$this->load->model('sysalert');
		$this->load->helper('url');
		$this->load->library('session');

	}

  function check($img,$controller,$newfilename){
		$textalert = "";
		$a = "";
		$target_dir = "assets/image/";
		$target_file = $target_dir . basename($_FILES[$img]["name"]);
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		// Check if image file is a actual image or fake image
		$check = getimagesize($_FILES[$img]["tmp_name"]);
		if($check == false) {
			$textalert = "File tersebut bukan gambar";
			$uploadOk = 0;
		}

		// Check file size
		if ($_FILES[$img]["size"] > 500000) {
		    $a = "Ukuran foto tidak boleh > 500kb";
		    $uploadOk = 0;
		}
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
		    $a = "Hanya file bertipe JPG, JPEG, dan PNG yang di izinkan";
		    $uploadOk = 0;
		}
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
		    $textalert = $a;
		// if everything is ok, try to upload file
		} else {
		    if (!move_uploaded_file($_FILES[$img]["tmp_name"], 'assets/image/'.$newfilename)) {
		        $textalert = "Terjadi kesalahan saat mengunggah file";
		    }
		}

		return $textalert;

  }
}