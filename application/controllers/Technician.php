<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Technician extends CI_Controller {

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
		
		redirect('technician/list_/wait');
	}

	public function list_($param){
		$cek_url=is_numeric($this->uri->segment(4));
		if ( $this->uri->segment(4) !=NULL AND  $cek_url == FALSE){
			redirect('technician/list_/wait');
		}

		if ($param === 'wait'){
			$condition = array('id_member_respon'=>$this->id_member,'status'=>1);
		} else if ($param === 'process'){
			$condition = array('id_member_respon'=>$this->id_member,'status'=>2);
		} else if ($param === 'done'){
			$condition = array('id_member_respon'=>$this->id_member,'status'=>3);
		} else {
			redirect('technician/list_/wait');
		}

		$jml=$this->complaint_model->count_rows($condition);
		$this->load->library('paging');
		$base_url = base_url().'technician/list_/'.$param;
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
		$this->template->main_layout('technician/list_complaint',$sidebar, $data);
	}

	public function respon_complaint($id){
		$data=array(
			'id_member_respon'=>$this->id_member,
			'status'=>2,
			'date_respon'=>date('Y-m-d H:i:s')
			);
		$this->complaint_model->update_data($data,array('id'=>$id));
		$this->session->set_flashdata('message', array('message' => 'Kerusakan diproses.'));
		redirect('technician/list_/process');
	}

	public function finish_complaint($id){
		$data=array(
			'status'=>3,
			'date_finish'=>date('Y-m-d H:i:s')
			);
		$this->complaint_model->update_data($data,array('id'=>$id,'id_member_respon'=>$this->id_member,));
		$this->session->set_flashdata('message', array('message' => 'Kerusakan selesai ditangani.'));
		redirect('technician/list_/done');
	}

}
