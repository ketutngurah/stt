<div class="container-fluid">
	<h1 class="ml-2"><?php echo $title; ?></h1>
	<div class="table">
		<table class="table table-borderless">
			<tr>
				<td width="30%">ID Kegiatan</td>
				<td><?php echo $kegiatan->id_kegiatan; ?></td>
			</tr>
			<tr>
				<td valign="top">Nama Kegiatan</td>
				<td><?php echo $kegiatan->nama_kegiatan; ?></td>
			</tr>
			<tr>
				<td valign="top">Tanggal</td>
				<td><?php echo $kegiatan->tgl_kegiatan; ?></td>
			</tr>
			<tr>
				<td valign="top">Keterangan</td>
				<td><?php echo $kegiatan->ket_kegiatan; ?></td>
			</tr>
			<tr>
				<td valign="top">File</td>
				<td><?php echo $kegiatan->file_kegiatan; ?></td>
			</tr>
		</table>
	</div>
	<br />
	<div class="ml-2 p-2">
		<a href="<?= base_url('kegiatan'); ?>" class="btn btn-success">
			<i class="fa fa-angle-double-left" aria-hidden="true"></i>
			Kembali
		</a>
	</div>

</div>