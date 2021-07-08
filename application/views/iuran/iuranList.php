<div class="container-fluid">
    <h1 class="ml-2">DATA IURAN</h1>
    <?= $this->session->flashdata('message'); ?>
    <div class="paging"><?php echo $pagination; ?></div>
    <div class="data"><?php echo $table; ?></div>
    <div class="paging"><?php echo $pagination; ?></div>

    <?php if ($this->session->userdata('role_id') == 1) { ?>

        <div class="ml-2 p-2">
            <a href="<?= base_url('iuran/add'); ?>" class="btn btn-success">
                <i class="fa fa-plus" aria-hidden="true"></i>
                Tambah Iuran Baru
            </a>
        </div>
    <?php } ?>

</div>