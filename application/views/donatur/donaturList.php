<div class="container-fluid">
	<h1 class="ml-2">DATA DONATUR</h1>
	<div class="paging"><?php echo $pagination; ?></div>
	<div class="data"><?php echo $table; ?></div>
	<div class="paging"><?php echo $pagination; ?></div>


	<div class="row">
		<div class="col-lg">
			<a href="<?= base_url('donatur/add'); ?>" class="btn btn-success">
				<i class="fa fa-plus" aria-hidden="true"></i>
				Tambah Donatur Baru
			</a>

			<a href="<?= base_url('laporan'); ?>" class="btn btn-info">
				Print
			</a>
		</div>
		<div class="col-lg text-right">
			<p>Total Donasi</p>
			<h5>Rp. <?= $total_donasi; ?></h5>

		</div>
	</div>

</div>