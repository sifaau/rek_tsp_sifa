<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Paging {

    protected $ci;

    public function __construct() {
        $this->ci = & get_instance();
    }
    
    public function create($base_url, $total_rows, $per_page, $segment) {
        $config['per_page']          = $per_page;
        $config['uri_segment']       = $segment;
        $config['base_url']          = $base_url;
        $config['total_rows']        = $total_rows;
        $config['use_page_numbers']  = TRUE;
        $config['num_links'] = 7;

        $config['next_link'] = '&raquo;';
        $config['prev_link'] = '&laquo;';
        $config['first_link'] = 'First';
        $config['last_link'] = 'Last';

        $config['full_tag_open'] = "<ul class='pagination'>";
        $config['full_tag_close'] = "</ul>";
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='current'><a>";
        $config['cur_tag_close'] = "</a></li>";
        $config['next_tag_open'] = "<li class='arrow'>";
        $config['next_tag_close'] = "</li>";
        $config['prev_tag_open'] = "<li class='arrow'>";
        $config['prev_tag_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tag_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tag_close'] = "</li>";

        $this->ci->pagination->initialize($config);
        if (($this->ci->uri->segment($segment))) {
           $page = ($this->ci->uri->segment($segment) - 1) * $config['per_page'];
       } else {
        $page = 0;
    }
    return $page;
}

}