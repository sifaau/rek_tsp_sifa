

<div class="row">
<div class="medium-5 medium-centered columns">
<?php $this->load->view('template/layout/message'); ?>
</div>
</div>
<div class="row">
<div class="medium-5 medium-centered columns text-center">
<?php if( $this->session->userdata('is_login')==TRUE ): ?>
  <br><br><br>
  <?php
$this->load->helper('member_helper');
$username=$this->session->userdata('username');
$level = data_member_by_field('level',array('username'=>$username));

if ($level === '1'){
  $url_dashboard = 'index.php/admin';
} else if ($level === '2'){
  $url_dashboard = 'index.php/technician';
} else if ($level === '3'){
  $url_dashboard = 'index.php/employee';
}
?>
  <a href="<?php echo base_url().$url_dashboard;?>">Dashboard</a>
<?php else:?>
  <br><br>
  <?php echo form_open('login','data-abide novalidate');?>
  <div class="row">
    <div class="medium-12 columns">
      <label>Username
        <input type="text" name="username" required>
        <span class="form-error">Username harus diisi</span>
      </label>
    </div>
    <div class="medium-12 columns">
      <label>Password
        <input type="password" name="password" required>
        <span class="form-error">Password harus diisi</span>
      </label>
    </div>
    <div class="medium-12 columns">
      <input type="submit" class="button" value="LOGIN">
    </div>
  </div>
  <?php echo form_close();?>
<?php endif;?>
</div>
</div>
