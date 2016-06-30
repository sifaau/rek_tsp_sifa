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
			<a href="<?php echo base_url();?>index.php/technician/list_/wait">Tugas Baru</a>
		</div>
		<div class='large-2 columns'>
			<a href="<?php echo base_url();?>index.php/technician/list_/process">Proses</a>
		</div>
		<div class='large-2 columns'>
			<a href="<?php echo base_url();?>index.php/technician/list_/done">Selesai</a>
		</div>
		<div class='end'>
		</div>
	</div>

	<?php foreach ($list->result() as $row) : ?>
		<div class="large-12 columns" style="border-bottom: solid 1px #ddd;padding: 15px;">

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
				<?php if ($row->status === '2' OR $row->status === '3'):?>
					(<small>ditangani tgl <?php echo str_replace($en,$day,date('d M Y',strtotime($row->date_respon))); ?></small>)
				<?php endif;?>
			</div>
			<div class='large-3 columns' >
				<?php if ($row->status === '1'):?>
					<a href="#" class="label success" data-open="modal_tangani">TANGANI</a>

					<div class="reveal text-center" id="modal_tangani" data-reveal>
						<h4>Ingin menangani kerusakan ini?</h4>
						<a href="<?php echo base_url();?>index.php/technician/respon_complaint/<?php echo $row->id;?>"class="large button">TANGANI SEKARANG</a>
						<button class="close-button" data-close aria-label="Close modal" type="button">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>

				<?php elseif ($row->status === '2'):?>
					<a href="#" class="label warning" data-open="modal_selesai">KONFIRMASI SELESAI</a>

					<div class="reveal text-center" id="modal_selesai" data-reveal>
						<h4>Penanganan kerusakan telah selesai ?</h4>
						<a href="<?php echo base_url();?>index.php/technician/finish_complaint/<?php echo $row->id;?>"class="large button">SELESAI</a>
						<button class="close-button" data-close aria-label="Close modal" type="button">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>

				<?php elseif ($row->status === '3'):?>
					<span style="color:green">Selesai</span><br>(<small><?php echo str_replace($en,$day,date('d M Y',strtotime($row->date_finish))); ?></small>)
					
				<?php endif;?>
			</div>
		</div>
	<?php endforeach;?>

	<div class="large-12 columns">
		<?php echo $paging;?>
	</div>
</div>








