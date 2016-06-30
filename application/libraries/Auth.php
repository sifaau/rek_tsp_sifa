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
       if(($this->ci->session->userdata('is_login')==TRUE) AND ($this->ci->session->userdata('is_member')==TRUE)) {
         return TRUE;
       } else {
         redirect('login/logout');
       }       
    }

    public function is_admin() {
       if(($this->ci->session->userdata('is_login')==TRUE) AND ($this->ci->session->userdata('is_admin')==TRUE)) {
         return TRUE;
       } else {
         redirect('pawon/login/logout');
       }       
    }
  



}