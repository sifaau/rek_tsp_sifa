<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Template
{

    protected $ci,$folder_template,$folder_template_admin,$detail_web;

    public function __construct()
    {
        $this->ci = &get_instance();
        $this->folder_template ='template'; // folder tempat template... bisa diubah2 sesuai nama foldernya kalo ganti template..
    }

    // public function main_layout($content, $data = NULL) {
    //     $data['tittle']= 'Tes Rekrutmen';
    //     $data['motto']= '';
    //     $this->ci->load->view($this->folder_template.'/layout/header', $data);
    //     $this->ci->load->view($this->folder_template.'/layout/menu_header', $data);
    //     $this->ci->load->view($this->folder_template.'/'.$content, $data);
    //     $this->ci->load->view($this->folder_template.'/layout/footer', $data);
    // }

    public function main_layout($content,$sidebar, $data = NULL) {
        $data['tittle']= 'Tes TSP';
        $data['motto']= '';
        $data['name']= '';
        $data['header']=$this->ci->load->view($this->folder_template.'/layout/header', $data, true);
        $data['menu_header']=$this->ci->load->view($this->folder_template.'/layout/menu_header', $data, true);
        $data['sidebar']=$sidebar? $this->ci->load->view($this->folder_template.'/'.$sidebar,$data, true) : '';
        $data['content']=$this->ci->load->view($this->folder_template.'/'.$content,$data, true);
        $data['footer']=$this->ci->load->view($this->folder_template.'/layout/footer', $data, true);
        $this->ci->load->view($this->folder_template.'/wrapper', $data);
    }

    // public function content_layout($content,$bottom_content,$sidebar, $data = NULL) {
    //     $this->ci->load->model('member_model');
    //     $id_member=$this->ci->session->userdata('id_member');
    //     $name=$this->ci->member_model->get_data_by_field('name',array('id'=>$id_member));
    //     $detail_web=$this->ci->web_profile_model->select_data('name,motto',array('id'=>1));
    //     $data['tittle']= $detail_web->row()->name;
    //     $data['motto']= $detail_web->row()->motto;
    //     $data['name']= $name;
    //     $data['header']=$this->ci->load->view($this->folder_template.'/layout/header', $data, true);
    //     $data['menu_header']=$this->ci->load->view($this->folder_template.'/layout/menu_header', $data, true);
    //     $data['sidebar']=$sidebar? $this->ci->load->view($this->folder_template.'/'.$sidebar,$data, true) : '';
    //     $data['content']=$this->ci->load->view($this->folder_template.'/'.$content,$data, true);
    //     $data['bottom_content']=$this->ci->load->view($this->folder_template.'/'.$bottom_content,$data, true);
    //     $data['footer']=$this->ci->load->view($this->folder_template.'/layout/footer', $data, true);
    //     $this->ci->load->view($this->folder_template.'/wrapper', $data);
    // }

    // public function admin_layout($content,$sidebar, $data = NULL) {
    //     $detail_web=$this->ci->web_profile_model->select_data('name,motto',array('id'=>1));
    //     $data['tittle']= $detail_web->row()->name;
    //     $data['motto']= $detail_web->row()->motto;
    //     $data['header']=$this->ci->load->view($this->folder_template.'/layout/header', $data, true);
    //     $data['menu_header']=$this->ci->load->view($this->folder_template.'/layout/menu_header_admin', $data, true);
    //     $data['sidebar']=$sidebar? $this->ci->load->view($this->folder_template.'/'.$sidebar,$data, true) : '';
    //     $data['content']=$this->ci->load->view($this->folder_template.'/'.$content,$data, true);
    //     $data['footer']=$this->ci->load->view($this->folder_template.'/layout/footer', $data, true);
    //     $this->ci->load->view($this->folder_template.'/wrapper', $data);
    // }

    



}