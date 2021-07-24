<div class="container-fluid">
	<h1 class="ml-3"><?php echo $title; ?></h1>
	<?php echo $message; ?>
	<?php echo validation_errors(); ?>
	<form action="<?= $action; ?>" method="post" enctype="multipart/form-data">
		<div class="container">
			<div class="form-group">
				<label for="id_kegiatan">ID Kegiatan</label>
				<input type="text" name="id_kegiatan" id="id_kegiatan" disabled="disable" class="form-control" value="<?php echo (isset($kegiatan['id_kegiatan'])) ? $kegiatan['id_kegiatan'] : ''; ?>" />
				<input type="hidden" name="id_kegiatan" value="<?php echo (isset($kegiatan['id_kegiatan'])) ? $kegiatan['id_kegiatan'] : ''; ?>" />
			</div>

			<div class="form-group">
				<label for="nama_kegiatan">Nama Kegiatan</label>
				<input type="text" name="nama_kegiatan" id="nama_kegiatan" class="form-control" value="<?php echo set_value('nama_kegiatan') ? set_value('nama_kegiatan') : $kegiatan['nama_kegiatan']; ?>" />
				<?php echo form_error('nama_kegiatan'); ?>
			</div>


			<div class="form-group">
				<label for="tgl_kegiatan">Tanggal</label>
				<input type="date" name="tgl_kegiatan" id="tgl_kegiatan" class="form-control" value="<?php echo (set_value('tgl_kegiatan')) ? set_value('tgl_kegiatan') : $kegiatan['tgl_kegiatan']; ?>" />
				<?php echo form_error('tgl_kegiatan'); ?>
			</div>

			<div class="form-group">

				<label for="ket_kegiatan">Keterangan</label>
				<input type="text" name="ket_kegiatan" id="ket_kegiatan" class="form-control" value="<?php echo (set_value('ket_kegiatan')) ? set_value('ket_kegiatan') : $kegiatan['ket_kegiatan']; ?>" />
				<?php echo form_error('ket_kegiatan'); ?>
			</div>

			<div class="form-group">
				<label for="file_kegiatan" class="form-label">Upload File</label>
				<input type="file" name="file_kegiatan" id="file_kegiatan" value="<?php echo (set_value('file_kegiatan')) ? set_value('file_kegiatan') : $kegiatan['file_kegiatan']; ?>" />
				<?php echo form_error('file_kegiatan'); ?>
			</div>

			<div class="form-group">
				<input type="submit" class="btn btn-info" value="Save" />
			</div>
		</div>
	</form>
	<div class="ml-3 p-2">
		<a href="<?= base_url('kegiatan'); ?>" class="btn btn-success">
			<i class="fa fa-angle-double-left" aria-hidden="true"></i>
			Kembali
		</a>
	</div>
</div>