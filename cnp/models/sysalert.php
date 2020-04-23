<?php

class Sysalert extends CI_Model{
	public function __construct() {
		parent::__construct();
		$this->load->database();
	}

  //fungsi ini untuk generate message
 	function message($mode,$text,$active)
 	{
 		//generate message
 		$messagesession = array(
 			'messagemode' => $mode,
 			'messagetext' => $text,
 			'messageactive' => $active);

 		$this->session->set_flashdata($messagesession);
 	}


}
