<div class="container-fluid">
    <h1 class="ml-2">DATA VERIFIKASI</h1>
    <div><?= $this->session->flashdata('message'); ?></div>
    <div class="paging"><?php echo $pagination; ?></div>
    <div class="data"><?php echo $table; ?></div>
    <div class="paging"><?php echo $pagination; ?></div>
</div>
</div>