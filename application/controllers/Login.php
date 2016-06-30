<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('member_model');
		date_default_timezone_set("Asia/Jakarta");
	}

	public function index() {
		$this->form_validation->set_rules('username', 'username', 'required|xss_clean');
		$this->form_validation->set_rules('password', 'password', 'required|xss_clean');
		if($this->form_validation->run() == false) {
			$data='';
			$sidebar='';
			$this->template->main_layout('login',$sidebar, $data);
		} else {
			$username=$this->input->post('username');
			$password=$this->input->post('password');
			$cek=$this->member_model->count_rows(array('username'=>$username,'password'=>md5($password),'status'=>1));
			if($cek > 0){
				$data='';
				$detail=$this->member_model->select_data('id,username,level,id_division',array('username'=>$username,'password'=>md5($password)));
				$sesdata['username'] = $detail->row()->username;
				$sesdata['is_login'] = TRUE;
				$this->session->set_userdata($sesdata);
				$this->session->set_flashdata('message', array('message' => 'SUKSES LOGIN'));

				$level = $detail->row()->level;
				$divisi = $detail->row()->id_division;
				if ($level === '1'){
					redirect('admin');
				} else if ($level === '2'){
					if ( $divisi == '5' ) {
						redirect('technician');
					} else {
						redirect('employee');
					}	
					
				} 

				
			} else {
				$data='';
				$this->session->set_flashdata('message', array('message' => 'Username atau password salah'));
				redirect('login');
			}
		}
	}

	function logout() {
		$this->session->sess_destroy();
		redirect('login');
	}
}
