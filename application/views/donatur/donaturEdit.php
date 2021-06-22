	<div class="container-fluid">
		<h1 class="ml-3"><?php echo $title; ?></h1>
		<?php echo $message; ?>
		<?php echo validation_errors(); ?>
		<?php echo form_open($action); ?>
		<div class="container">
			<form>
				<div class="form-group">
					<label for="id_donatur">ID Donatur</label>
					<input type="text" name="id_donatur" id="id_donatur" disabled="disable" class="form-control" value="<?php echo (isset($donatur['id_donatur'])) ? $donatur['id_donatur'] : ''; ?>" />
					<input type="hidden" name="id_donatur" value="<?php echo (isset($donatur['id_donatur'])) ? $donatur['id_donatur'] : ''; ?>" />
				</div>

				<div class="form-group">
					<label for="nama_donatur">Nama Donatur</label>
					<input type="text" name="nama_donatur" id="nama_donatur" class="form-control" value="<?php echo set_value('nama_donatur') ? set_value('nama_donatur') : $donatur['nama_donatur']; ?>" />
					<?php echo form_error('nama_donatur'); ?>
				</div>


				<div class="form-group">
					<label for="jumlah_donasi">Jumlah Donasi</label>
					<input type="text" name="jumlah_donasi" id="jumlah_donasi" class="form-control" value="<?php echo set_value('jumlah_donasi') ? set_value('jumlah_donasi') : $donatur['jumlah_donasi']; ?>" />
					<?php echo form_error('jumlah_donasi'); ?>
				</div>

				<div class="form-group">
					<label for="tgl_donasi">Tanggal Donasi</label>
					<input type="date" name="tgl_donasi" id="tgl_donasi" class="form-control" value="<?php echo (set_value('tgl_donasi')) ? set_value('tgl_donasi') : $donatur['tgl_donasi']; ?>" />
					<?php echo form_error('tgl_donasi'); ?>
				</div>

				<div class="form-group">
					<label for="ket_donasi">Keterangan</label>
					<input type="text" name="ket_donasi" id="ket_donasi" class="form-control" value="<?php echo (set_value('ket_donasi')) ? set_value('ket_donasi') : $donatur['ket_donasi']; ?>" />
					<?php echo form_error('ket_donasi'); ?>
				</div>

				<div class="form-group">
					<input type="submit" class="btn btn-info" value="Save" />
				</div>
			</form>
		</div>
		</form>
		<div class="ml-3 p-2">
			<a href="<?= base_url('donatur'); ?>" class="btn btn-success">
				<i class="fa fa-angle-double-left" aria-hidden="true"></i>
				Daftar Data Donatur
			</a>
		</div>
	</div>