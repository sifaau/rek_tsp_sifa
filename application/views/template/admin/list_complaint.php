<?php 
$en=array('Sun','Mon','Tue','Wed','Thu','Fri','Sat','Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
$day=array('Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');

$this->load->helper('member_helper');

?>


<div class="row">
	<div class="large-12 columns" style="padding:20px">
		<?php $this->load->view('template/layout/message'); ?>
		
	</div>

	<div class="large-12 columns" style="padding: 5px;margin-bottom: 30px;background: #FFF;border-radius: 5px;box-shadow: 1px 1px 1px #ddd;">
		<div class='large-2 columns'>
			<a href="<?php echo base_url();?>index.php/admin/list_/new">Kerusakan Baru</a>
		</div>
		<div class='large-2 columns'>
			<a href="<?php echo base_url();?>index.php/admin/list_/process">Proses</a>
		</div>
		<div class='large-2 columns'>
			<a href="<?php echo base_url();?>index.php/admin/list_/done">Selesai</a>
		</div>
		<div class='end'>
		</div>
	</div>

	<?php foreach ($list->result() as $row) : ?>
		<div class="large-12 columns" style="border-bottom: solid 1px #ddd;padding: 5px;">

			<div class='large-3 columns'>
				<small><?php echo str_replace($en,$day,date('d M Y',strtotime($row->date_create))); ?><br>
					<?php 
					$username_pelapor = data_member_by_field('username',array('id'=>$row->id_member));
					$name_pelapor = data_member_by_field('name',array('id'=>$row->id_member));
					echo 'Pelapor : '.$name_pelapor;
					?><br>
					<?php echo 'Divisi : '.get_division_member($username_pelapor);?><br>
				</small>
			</div>
			<div class='large-6 columns'>
				<?php echo $row->title;?><br>
				<small><blockquote><?php echo $row->desc;?></blockquote></small>
				<?php if ($row->status === '1' OR $row->status === '2'):?>
					
				<?php endif;?>
			</div>
			<div class='large-3 columns' >
				<?php if ($row->status === '0'):?>
					<span style="color:green">Belum ditangani</span>

				<?php elseif ($row->status === '1'):?>
					<?php $username_perespon = data_member_by_field('name',array('id'=>$row->id_member_respon));?>
					<small>#ditangani <?php echo str_replace($en,$day,date('d M Y',strtotime($row->date_respon))); ?></small>
					<br>oleh <?php echo $username_perespon;?>  
				<?php elseif ($row->status === '2'):?>
					<?php $username_perespon = data_member_by_field('name',array('id'=>$row->id_member_respon));?>
					<small>#ditangani <?php echo str_replace($en,$day,date('d M Y',strtotime($row->date_respon))); ?></small><br>
					<small>#selesai <?php echo str_replace($en,$day,date('d M Y',strtotime($row->date_finish))); ?></small>
					<br>oleh <?php echo $username_perespon;?>  					
				<?php endif;?>
			</div>
		</div>
	<?php endforeach;?>

	<div class="large-12 columns">
		<?php echo $paging;?>
	</div>
</div>








