<?php
function data_member_by_field($field,$condition) {
    $ci = & get_instance();
    $ci->load->model('member_model');
    $name = $ci->member_model->get_data_by_field($field,$condition);
    return  $name;
}

function get_division_member($username) {
    $ci = & get_instance();
    $ci->load->model('member_model');
    $division = $ci->member_model->select_data('(SELECT division.name from division WHERE division.id = member.id_division) as division',array('member.username'=>$username));
    return  $division->row()->division;
}
?>