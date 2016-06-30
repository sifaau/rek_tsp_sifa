<?php
$username=$this->session->userdata('username');
$this->load->helper('member_helper');
?>

<div class="row">
	<div class="large-12 columns" style="padding:20px">
		<div class="large-12 columns" style="border: 1px solid #DDD;min-height: 100vh;">

			<div class="large-12 columns" style="border-bottom: 1px solid #DDD;padding:10px;">
				<br>
				<h4><b><?php echo ucwords($username);?></b></h4>
				<?php 
				$level = data_member_by_field('level',array('username'=>$username));
				if ($level === '2'){
					echo '<small>Divisi '.get_division_member($username).'</small>';
				} 
				?>
				<br>
				<br>
			</div>
			<div class="large-12 columns" style="border-bottom: 1px solid #DDD;padding:10px;">
			<?php 
				$divisi = data_member_by_field('id_division',array('username'=>$username));
				if ($divisi === '5'):?>
					<a href="<?php echo base_url();?>index.php/technician/list_/new" style="color:#666;">Laporan Kerusakan</a>
				<?php else:?>
					<a href="<?php echo base_url();?>index.php/employee/list_/new" style="color:#666;">Laporkan Kerusakan</a>
				<?php endif;?>
				
			</div>

		</div>
	</div>
</div>



