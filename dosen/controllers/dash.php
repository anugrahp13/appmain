<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Dash extends CI_Controller {
	function __construct()
 	{
 		parent::__construct();
 		$this->load->model('global_model');
 		$this->load->helper('url');
 		$this->load->library('session');

 	}
 	public function index() 
 	{

 		$this->load->view('header/dash');
 		$this->load->view('konten/dash/index');
 		$this->load->view('footer/dash');
 	}
}
