<div class="container-fluid">
    <h1 class="ml-3"><?php echo $title; ?></h1>
    <?php echo $message; ?>
    <?php echo validation_errors(); ?>
    <form action="<?= $action; ?>" method="post" enctype="multipart/form-data">

        <div class="container">
            <div class="form-group">
                <label for="id_verifikasi">ID Verifikasi</label>
                <input type="text" name="id_verifikasi" id="id_verifikasi" disabled="disable" class="form-control" value="<?php echo (isset($verifikasi['id_verifikasi'])) ? $verifikasi['id_verifikasi'] : ''; ?>" />
                <input type="hidden" name="id_verifikasi" value="<?php echo (isset($verifikasi['id_verifikasi'])) ? $verifikasi['id_verifikasi'] : ''; ?>" />
            </div>

            <div class="form-group">
                <label for="nama">Nama Anggota</label>
                <input type="hidden" name="id_user" value="<?php echo (isset($verifikasi['id_user'])) ? $verifikasi['id_user'] : ''; ?>" />
                <input type="text" name="nama" id="nama" disabled="disable" class="form-control" value="<?php echo (isset($verifikasi['nama'])) ? $verifikasi['nama'] : ''; ?>" />
                <?php echo form_error('nama'); ?>
            </div>

            <div class="form-group">
                <label for="nama_iuran">Nama Iuran</label>
                <input type="hidden" name="id_iuran" value="<?php echo (isset($verifikasi['id_iuran'])) ? $verifikasi['id_iuran'] : ''; ?>" />
                <input type="text" name="nama_iuran" id="nama_iuran" disabled="disable" class="form-control" value="<?php echo (isset($verifikasi['nama_iuran'])) ? $verifikasi['nama_iuran'] : ''; ?>" />
                <?php echo form_error('nama_iuran'); ?>
            </div>

            <div class="form-group">
                <label for="file_verifikasi">File</label>
                <input type="text" name="file_verifikasi" id="file_verifikasi" disabled="disable" class="form-control" value="<?php echo (set_value('file_verifikasi')) ? set_value('file_verifikasi') : $verifikasi['file_verifikasi']; ?>" />
                <?php echo form_error('file_verifikasi'); ?>
            </div>
            <div class="col-md-12">
                <a href="" data-toggle="modal" data-target="#exampleModal"><img class="img-thumbnail" src="<?= base_url() ?>uploads/<?= $verifikasi['file_verifikasi'] ?>" /></a>
            </div>

            <div class="d-block ml-2">
                <label for="jk">Status</label>
            </div>
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <div class="custom-control custom-radio">
                        <input id="belum lunas" name="status" type="radio" class="custom-control-input" checked="" value="belum lunas" value="0">
                        <label class="custom-control-label" for="belum lunas">Belum Lunas</label>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="custom-control custom-radio">
                        <input id="lunas" name="status" type="radio" class="custom-control-input" value="1">
                        <label class="custom-control-label" for="lunas">Lunas</label>
                    </div>
                </div>
                <?=
                form_error('status', '<small class="text-danger pl-2">', '</small>');
                ?>
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-info" value="Save" />
            </div>
    </form>
</div>
<div class="ml-3 p-2">
    <a href="<?= base_url('verifikasi'); ?>" class="btn btn-success">
        <i class="fa fa-angle-double-left" aria-hidden="true"></i>
        Kembali
    </a>
</div>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img class="img-fluid" src="<?= base_url() ?>uploads/<?= $verifikasi['file_verifikasi'] ?>" />
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>