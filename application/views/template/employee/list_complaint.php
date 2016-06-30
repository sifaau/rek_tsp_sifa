<?php 
$en=array('Sun','Mon','Tue','Wed','Thu','Fri','Sat','Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
$day=array('Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
?>


<div class="row">
	<div class="large-12 columns" style="padding:20px">
		<?php $this->load->view('template/layout/message'); ?>
		<a class="button" href="#" data-open="form_lapor">LAPORKAN KERUSAKAN</a>

		<div class="reveal " id="form_lapor" data-reveal>
			<div class="large-12 columns">
				<?php echo form_open('employee/complaint','data-abide novalidate');?>
				<Br>
					<div data-abide-error class="alert callout" style="display: none;">
						<p><i class="fi-alert"></i> Ada beberapa kesalahan input, silakan cek lagi..</p>
					</div>

					<div class="row">
						<div class="small-12 columns text-center">
							<b>Laporkan Kerusakan Perangkat IT.</b><hr>
						</div>
					</div>


					<div class="row">
						<div class="small-12 columns">
							<div class="row">
								<div class="small-3 columns">
									<label for="right-label" class="text-right">Judul Kerusakan</label>
								</div>
								<div class="small-9 columns">
									<input type="text" name="title" value="<?php echo set_value('title'); ?>" required placeholder="judul, contoh : printer rusak.">
									<span class="form-error">Judul Kerusakan harus diisi</span>
								</div>

							</div>
						</div>
					</div>

					<div class="row">
						<div class="small-12 columns">
							<div class="row">
								<div class="small-3 columns">
									<label for="right-label" class="text-right">Deskripsi</label>
								</div>
								<div class="small-9 columns">
									<textarea  name="description" required style="min-height: 200px;"><?php echo set_value('description'); ?></textarea>
									<span class="form-error">Deskripsikan kerusakan lebih lengkap </span>
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
				<button class="close-button" data-close aria-label="Close modal" type="button">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>


		</div>

		<div class="large-12 columns" style="padding: 5px;margin-bottom: 30px;background: #FFF;border-radius: 5px;box-shadow: 1px 1px 1px #ddd;">
			<div class='large-2 columns'>
				<a href="<?php echo base_url();?>index.php/employee/list_/new">Menunggu</a>
			</div>
			<div class='large-2 columns'>
				<a href="<?php echo base_url();?>index.php/employee/list_/process">Proses</a>
			</div>
			<div class='large-2 columns'>
				<a href="<?php echo base_url();?>index.php/employee/list_/done">Selesai</a>
			</div>
			<div class='end'>
			</div>
		</div>

		<?php foreach ($list->result() as $row) : ?>
			<div class="large-12 columns" style="border-bottom: solid 1px #ddd;padding: 5px;">

				<div class='large-2 columns'>
					<?php echo str_replace($en,$day,date('d M Y',strtotime($row->date_create))); ?>
				</div>
				<div class='large-6 columns'>
					<a  href="#" data-open="desc<?php echo $row->id;?>"><?php echo $row->title;?></a>
					<div class="reveal " id="desc<?php echo $row->id;?>" data-reveal>
					<small><u>Deskripsi</u></small><br>
						<p><?php echo $row->desc;?></p>
						<button class="close-button" data-close aria-label="Close modal" type="button">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				</div>
				<div class='large-4 columns' >
					<?php if ($row->status === '0'){
						echo 'Menunggu';
					} else if ($row->status === '1'){
						$name_perespon = data_member_by_field('name',array('id'=>$row->id_member_respon));
						echo 'Proses ( <small>'.str_replace($en,$day,date('d M Y',strtotime($row->date_respon))).' <i>by</i> '.$name_perespon.'</small> )';
					} else if ($row->status === '2'){
						$name_perespon = data_member_by_field('name',array('id'=>$row->id_member_respon));
						echo 'Selesai ( <small>'.str_replace($en,$day,date('d M Y',strtotime($row->date_finish))).' <i>by</i> '.$name_perespon.'</small>)';
					}
					?>
				</div>
			</div>
		<?php endforeach;?>

		<div class="large-12 columns">
			<?php echo $paging;?>
		</div>
	</div>








