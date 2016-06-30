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
			<a href="<?php echo base_url();?>index.php/admin/list_/wait">Menunggu</a>
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
					<a href="#" class="label success" data-open="modal_tangani">TANGANI</a>

					<div class="reveal text-center" id="modal_tangani" data-reveal>
						<div class="large-12 columns">
							<?php echo form_open('admin/add_task/'.$row->id,'data-abide novalidate');?>
							<Br>
								<div data-abide-error class="alert callout" style="display: none;">
									<p><i class="fi-alert"></i> Ada beberapa kesalahan input, silakan cek lagi..</p>
								</div>

								<div class="row">
									<div class="small-12 columns text-center">
										<b>Tambah tugas ke IT Support</b><hr>
									</div>
								</div>


								<div class="row">
									<div class="small-12 columns">
										<div class="row">
											<div class="small-3 columns">
												<label for="right-label" class="text-right">IT support</label>
											</div>
											<div class="small-9 columns">
												<select name="id_member_respon" required >
													<option value=""> - Pilih IT Support - </option>
													<?php foreach ($it_support->result() as $row2):?>
														<option value="<?php echo $row2->id;?>"> <?php echo $row2->name;?> </option>
													<?php endforeach;?>
												</select>
												<span class="form-error">IT Support harus dipilih</span>
											</div>

										</div>
									</div>
								</div>


								<div class="row">
									<div class="small-12 columns">
										<div class="row">
											<div class="small-3 columns">
												<label for="right-label" class="text-right">&nbsp;</label>
											</div>
											<div class="small-9 columns">
												<button class="button large" type="submit" >SIMPAN</button>
											</div>
										</div>
									</div>
								</div>
								<?php echo form_close();?>
							</div>

						<?php elseif ($row->status === '1'):?>
							<?php $username_perespon = data_member_by_field('name',array('id'=>$row->id_member_respon));?>
							<br>oleh <?php echo $username_perespon;?>  
						<?php elseif ($row->status === '2'):?>
							<?php $username_perespon = data_member_by_field('name',array('id'=>$row->id_member_respon));?>
							<small>#ditangani <?php echo str_replace($en,$day,date('d M Y',strtotime($row->date_respon))); ?></small>
							<br>oleh <?php echo $username_perespon;?>  	
						<?php elseif ($row->status === '3'):?>	
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








