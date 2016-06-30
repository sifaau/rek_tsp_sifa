
<style type="text/css">
  #parent_menu_header{
    display: table;height: 50px;font-family:gesta;
  }
  #menu_header{
    display: table-cell;vertical-align: middle;color:#666;
    font-family:gesta;
  }


</style>
<div class="row" style="padding-top: 20px;padding-bottom: 20px;">
  <div class="large-6 medium-6 small-12 columns" id="parent_menu_header">
    <div id="menu_header"><b>PT TRI SINAR PURNAMA</b></div>
    
  </div>
  <div class="large-6 medium-6 small-12 columns text-right" id="parent_menu_header">
    <div class="menu-right" id="menu_header">
      <div class="menu">
        <i class="ion-person"></i>&nbsp;&nbsp;
        <?php if (( $this->session->userdata('is_login')==TRUE )): ?>
          <a href="<?php echo base_url();?>index.php/Login/logout" style="color: #000;">Logout</a>
        <?php else:?>
          <a href="<?php echo base_url();?>index.php/Login" style="color: #000;">Login</a>
        <?php endif;?>  
        
      </div>
    </div>
  </div>
</div>
<div class="row fullscreen" style="border-bottom:solid 1px #ccc;">
</div>

