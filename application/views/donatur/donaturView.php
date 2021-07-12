<div class="container-fluid">
	<h1 class="ml-2"><?php echo $title; ?></h1>
	<div class="table">
		<table class="table table-borderless">
			<tr>
				<td width="30%">ID Donatur</td>
				<td><?php echo $donatur->id_donatur; ?></td>
			</tr>
			<tr>
				<td valign="top">Nama Donatur</td>
				<td><?php echo $donatur->nama_donatur; ?></td>
			</tr>
			<tr>
				<td valign="top">Jumlah Donasi</td>
				<td><?php echo $donatur->jumlah_donasi; ?></td>
			</tr>
			<tr>
				<td valign="top">Tanggal Donasi</td>
				<td><?php echo $donatur->tgl_donasi; ?></td>
			</tr>
			<tr>
				<td valign="top">Keterangan</td>
				<td><?php echo $donatur->ket_donasi; ?></td>
			</tr>
		</table>
	</div>
	<br />
	<div class="ml-2 p-2">
		<a href="<?= base_url('donatur'); ?>" class="btn btn-success">
			<i class="fa fa-angle-double-left" aria-hidden="true"></i>
			Daftar Data Donatur
		</a>
	</div>

</div>