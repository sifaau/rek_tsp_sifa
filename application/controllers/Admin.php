<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	private $id_member,$username;

	public function __construct() {
		parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
		$this->auth->is_admin();
		$this->load->model('member_model');
		$this->load->model('complaint_model');
		$this->username=$this->session->userdata('username');
		$this->id_member=$this->member_model->get_data_by_field('id',array('username'=>$this->username));
	}

	public function index()
	{	
		
		redirect('admin/list_/new');
	}

	public function list_($param){
		$cek_url=is_numeric($this->uri->segment(4));
		if ( $this->uri->segment(4) !=NULL AND  $cek_url == FALSE){
			redirect('admin/list_/new');
		}

		if ($param === 'new') {
			$condition = array('status'=>0);
		} else if ($param === 'wait'){
			$condition = array('status'=>1);
		} else if ($param === 'process'){
			$condition = array('status'=>2);
		} else if ($param === 'done'){
			$condition = array('status'=>3);
		} else {
			redirect('admin/list_/new');
		}

		$jml=$this->complaint_model->count_rows($condition);
		$this->load->library('paging');
		$base_url = base_url().'admin/list_/'.$param;
		$total_rows = $jml;
		$per_page = 10;
		$segment = 4;
		$page = $this->paging->create($base_url, $total_rows, $per_page, $segment);
		$list = $this->complaint_model->list_complaint('*',$condition,$page,$per_page);
		
		$data	= array(
			'it_support'=>$this->member_model->select_data('id,name',array('id_division'=>'5')),
			'list'=>$list,
			'paging'=>$this->pagination->create_links()
			);

		$sidebar='layout/sidebar';
		$this->template->main_layout('admin/list_complaint',$sidebar, $data);
	}

	public function search($param){
		$cek_url=is_numeric($this->uri->segment(4));
		if ( $this->uri->segment(4) !=NULL AND  $cek_url == FALSE){
			redirect('admin/list_/new');
		}

		$start_date = $this->input->post('date_start');
		$date_end =$this->input->post('date_end');

		if ($param === 'new') {
			$condition = "status = '0' AND date_create >= '".$start_date."' AND date_create <= '".$date_end."'";
		} else if ($param === 'wait'){
			$condition = "status = '1' AND date_create >= '".$start_date."' AND date_create <= '".$date_end."'";
		} else if ($param === 'process'){
			$condition = "status = '2' AND date_respon >= '".$start_date."' AND date_respon <= '".$date_end."'";
		} else if ($param === 'done'){
			$condition = "status = '3' AND date_finish >= '".$start_date."' AND date_finish <= '".$date_end."'";
		} else {
			redirect('admin/list_/new');
		}

		$jml=$this->complaint_model->count_rows($condition);
		$this->load->library('paging');
		$base_url = base_url().'admin/list_/'.$param;
		$total_rows = $jml;
		$per_page = 10;
		$segment = 4;
		$page = $this->paging->create($base_url, $total_rows, $per_page, $segment);
		$list = $this->complaint_model->list_complaint('*',$condition,$page,$per_page);
		
		$data	= array(
			'it_support'=>$this->member_model->select_data('id,name',array('id_division'=>'5')),
			'list'=>$list,
			'paging'=>$this->pagination->create_links()
			);

		$sidebar='layout/sidebar';

		$this->template->main_layout('admin/list_complaint',$sidebar, $data);
	}

	public function add_task($id){
		$this->form_validation->set_rules('id_member_respon', 'IT Support', 'required|xss_clean');
		if($this->form_validation->run() == false) {

		} else {
			$data=array(
				'id_member_respon'=>$this->input->post('id_member_respon'),
				'status'=>1
				);
			$this->complaint_model->update_data($data,array('id'=>$id));
			$this->session->set_flashdata('message', array('message' => 'Kerusakan menunggu penanganan IT Support.'));
			redirect('admin/list_/new');
		}
		
	}

}
