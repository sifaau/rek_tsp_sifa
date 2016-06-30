<?php

/**
 * User: Awan Tengah
 * Date: 05/11/2015
 * Time: 15:23
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth
{

  protected $ci;

  public function __construct()
  {
    $this->ci = &get_instance();
  }

  public function is_login() {
   if($this->ci->session->userdata('is_login')==TRUE) {
     return TRUE;
   } else {
     redirect('login');
   }       
 }

 public function is_member() {
   $this->ci->load->model('member_model');
  $username = $this->ci->session->userdata('username');
  $level = $this->ci->member_model->get_data_by_field('level',array('username'=>$username));
  if( ($this->ci->session->userdata('is_login')==TRUE) AND ($level == '2')) {
   return TRUE;
 } else {
   redirect('login/logout');
 }       
 }

 public function is_admin() {
  $this->ci->load->model('member_model');
  $username = $this->ci->session->userdata('username');
  $level = $this->ci->member_model->get_data_by_field('level',array('username'=>$username));
  if( ($this->ci->session->userdata('is_login')==TRUE) AND ($level == '1')) {
   return TRUE;
 } else {
   redirect('login/logout');
 }       
}




}