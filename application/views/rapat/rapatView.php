<div class="container-fluid">
	<h1 class="ml-2"><?php echo $title; ?></h1>
	<div class="table">
		<table class="table table-borderless">
			<tr>
				<td width="30%">ID Rapat</td>
				<td><?php echo $rapat->id_rapat; ?></td>
			</tr>
			<tr>
				<td valign="top">Nama Rapat</td>
				<td><?php echo $rapat->nama_rapat; ?></td>
			</tr>
			<tr>
				<td valign="top">Tanggal</td>
				<td><?php echo $rapat->tgl_rapat; ?></td>
			</tr>
			<tr>
				<td valign="top">Keterangan</td>
				<td><?php echo $rapat->ket_rapat; ?></td>
			</tr>
			<tr>
				<td valign="top">File</td>
				<td><?php echo $rapat->file_rapat; ?></td>
			</tr>
		</table>
	</div>
	<br />
	<div class="ml-2 p-2">
		<a href="<?= base_url('rapat'); ?>" class="btn btn-success">
			<i class="fa fa-angle-double-left" aria-hidden="true"></i>
			Kembali
		</a>
	</div>

</div>