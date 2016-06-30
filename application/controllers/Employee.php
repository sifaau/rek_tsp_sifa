<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee extends CI_Controller {

	private $id_member,$username;

	public function __construct() {
		parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
		$this->auth->is_member();
		$this->load->model('member_model');
		$this->load->model('complaint_model');
		$this->username=$this->session->userdata('username');
		$this->id_member=$this->member_model->get_data_by_field('id',array('username'=>$this->username));
	}

	public function index()
	{	
		
		redirect('employee/list_/new');
	}

	public function list_($param){
		$cek_url=is_numeric($this->uri->segment(4));
		if ( $this->uri->segment(4) !=NULL AND  $cek_url == FALSE){
			redirect('employee/list_/new');
		}

		if ($param === 'new') {
			$condition = array('id_member'=>$this->id_member,'status'=>0);
		} else if ($param === 'process'){
			$condition = array('id_member'=>$this->id_member,'status'=>1);
		} else if ($param === 'done'){
			$condition = array('id_member'=>$this->id_member,'status'=>2);
		} else {
			redirect('employee/list_/new');
		}

		$jml=$this->complaint_model->count_rows($condition);
		$this->load->library('paging');
		$base_url = base_url().'employee/list_/'.$param;
		$total_rows = $jml;
		$per_page = 10;
		$segment = 4;
		$page = $this->paging->create($base_url, $total_rows, $per_page, $segment);
		$list = $this->complaint_model->list_complaint('*',$condition,$page,$per_page);
		
		$data	= array(
			'list'=>$list,
			'paging'=>$this->pagination->create_links()
			);

		$sidebar='layout/sidebar';
		$this->template->main_layout('employee/list_complaint',$sidebar, $data);
	}

	

	public function complaint(){
		$this->form_validation->set_rules('title', 'Judul', 'required|xss_clean');
		$this->form_validation->set_rules('description', 'Keterangan', 'required|xss_clean');
		$this->form_validation->set_rules('description', 'Keterangan', 'required|xss_clean');
		if($this->form_validation->run() == false) {
			$this->index();
		} else {
			$data=array(
				'id_member'=>$this->id_member,
				'title'=>$this->input->post('title'),
				'desc'=>$this->input->post('description'),
				'status'=>0,
				'date_create'=>date('Y-m-d H:i:s')
				);
			$this->complaint_model->insert_data($data);
			$this->session->set_flashdata('message', array('message' => 'Kerusakan telah dilaporkan.'));
			redirect('employee');
		}
	}
}
