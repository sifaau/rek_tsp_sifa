<?php 
if ($this->session->flashdata('message') != NULL) {
	$message = $this->session->flashdata('message');
	echo '<div class="success callout" data-closable="slide-out-right">
		<button class="close-button" aria-label="Dismiss alert" type="button" data-close>
			<span aria-hidden="true">&times;</span>
		</button>
		<p>'.$message['message'].'</p>
	</div>
	';
	
}

if ($this->session->flashdata('message_error') != NULL) {
	$message = $this->session->flashdata('message_error');
	echo '<div class="success callout" data-closable="slide-out-right">
		<button class="close-button" aria-label="Dismiss alert" type="button" data-close>
			<span aria-hidden="true">&times;</span>
		</button>
		<p>'.$message['message_error'].'</p>
	</div>
	';
}

echo validation_errors('<div class="success callout" data-closable="slide-out-right">
		<p>','</p>
		<button class="close-button" aria-label="Dismiss alert" type="button" data-close>
			<span aria-hidden="true">&times;</span>
		</button>
	</div>');
?>









