<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tecnician extends CI_Controller {

	public function __construct() {
		parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
		$this->auth->is_login();
	}

	public function index()
	{
		$data='';
		$sidebar='layout/sidebar';
		$this->template->main_layout('list_complaint',$sidebar, $data);

	}
}
