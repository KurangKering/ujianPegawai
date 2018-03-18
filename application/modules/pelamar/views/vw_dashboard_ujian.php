<div class="row">
	<div class="col-md-4 col-md-offset-4">
		
		<form method="post">
			<?php if ($this->session->flashdata('error') != null ): ?>
				<div class="alert alert-danger alert-dismissible">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<?php echo $this->session->flashdata('error') ?>
				</div>
			<?php endif ?>
			<input type="text" name="nik"  placeholder="NIK" class="form-control">

			<div class="form-group">
				<button class="btn btn-primary btn-block" type="submit">Mulai Ujian</button>
			</div>    
		</form>

		
	</div>
</div>

<script type="text/javascript">


	$(document).ready(function() {
		$('#btn-ujian').click();

	});
</script>