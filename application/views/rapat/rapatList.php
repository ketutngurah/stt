<div class="container-fluid">
	<h1 class="ml-2">DATA RAPAT</h1>
	<div class="paging"><?php echo $pagination; ?></div>
	<div class="data"><?php echo $table; ?></div>
	<div class="paging"><?php echo $pagination; ?></div>


	<div class="ml-2 p-2">
		<a href="<?= base_url('rapat/add'); ?>" class="btn btn-success">
			<i class="fa fa-plus" aria-hidden="true"></i>
			Tambah Rapat Baru
		</a>
	</div>
	<!-- <div class="ml-3 p-2">

		<?php echo anchor('rapat/add/', 'Tambah Rapat Baru', array('class' => 'btn btn-success')); ?>
	</div> -->
</div>