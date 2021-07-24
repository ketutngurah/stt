<div class="container-fluid">
	<h1 class="ml-3"><?php echo $title; ?></h1>
	<?php echo $message; ?>
	<?php echo validation_errors(); ?>
	<form action="<?= $action; ?>" method="post" enctype="multipart/form-data">
		<div class="container">

			<div class="form-group">
				<label for="id_rapat">ID Rapat</label>
				<input type="text" name="id_rapat" id="id_rapat" disabled="disable" class="form-control" value="<?php echo (isset($rapat['id_rapat'])) ? $rapat['id_rapat'] : ''; ?>" />
				<input type="hidden" name="id_rapat" value="<?php echo (isset($rapat['id_rapat'])) ? $rapat['id_rapat'] : ''; ?>" />
			</div>

			<div class="form-group">
				<label for="nama_rapat">Nama Rapat</label>
				<input type="text" name="nama_rapat" id="nama_rapat" class="form-control" value="<?php echo set_value('nama_rapat') ? set_value('nama_rapat') : $rapat['nama_rapat']; ?>" />
				<?php echo form_error('nama_rapat'); ?>
			</div>

			<div class="form-group">
				<label for="tgl_rapat">Tanggal</label>
				<input type="date" name="tgl_rapat" id="tgl_rapat" class="form-control" value="<?php echo (set_value('tgl_rapat')) ? set_value('tgl_rapat') : $rapat['tgl_rapat']; ?>" />
				<?php echo form_error('tgl_rapat'); ?>
			</div>

			<div class="form-group">

				<label for="ket_rapat">Keterangan</label>
				<input type="text" name="ket_rapat" id="ket_rapat" class="form-control" value="<?php echo (set_value('ket_rapat')) ? set_value('ket_rapat') : $rapat['ket_rapat']; ?>" />
				<?php echo form_error('ket_rapat'); ?>
			</div>

			<div class="form-group">
				<label for="file_rapat" class="form-label">Upload File</label>
				<input type="file" name="file_rapat" id="file_rapat" value="<?php echo (set_value('file_rapat')) ? set_value('file_rapat') : $rapat['file_rapat']; ?>" />
				<?php echo form_error('file_rapat'); ?>
			</div>

			<div class="form-group">
				<input type="submit" class="btn btn-info" value="Save" />
			</div>
		</div>
	</form>
	<div class="ml-3 p-2">
		<a href="<?= base_url('rapat'); ?>" class="btn btn-success">
			<i class="fa fa-angle-double-left" aria-hidden="true"></i>
			Kembali
		</a>
	</div>
</div>