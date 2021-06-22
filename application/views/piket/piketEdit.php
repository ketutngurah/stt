<div class="container-fluid">
    <h1 class="ml-3"><?php echo $title; ?></h1>
    <?php echo $message; ?>
    <?php echo validation_errors(); ?>
    <?php echo form_open($action); ?>
    <div class="container">
        <form>
            <div class="form-group">
                <label for="id_piket">ID Piket</label>
                <input type="text" name="id_piket" id="id_piket" disabled="disable" class="form-control" value="<?php echo (isset($piket['id_piket'])) ? $piket['id_piket'] : ''; ?>" />
                <input type="hidden" name="id_piket" value="<?php echo (isset($piket['id_piket'])) ? $piket['id_piket'] : ''; ?>" />
            </div>

            <div class="form-group">
                <label for="nama_piket">Nama Piket</label>
                <input type="text" name="nama_piket" id="nama_piket" class="form-control" value="<?php echo set_value('nama_piket') ? set_value('nama_piket') : $piket['nama_piket']; ?>" />
                <?php echo form_error('nama_piket'); ?>
            </div>


            <div class="form-group">
                <label for="tgl_piket">Tanggal</label>
                <input type="date" name="tgl_piket" id="tgl_piket" class="form-control" value="<?php echo (set_value('tgl_piket')) ? set_value('tgl_piket') : $piket['tgl_piket']; ?>" />
                <?php echo form_error('tgl_piket'); ?>
            </div>

            <div class="form-group">

                <label for="ket_piket">Keterangan</label>
                <input type="text" name="ket_piket" id="ket_piket" class="form-control" value="<?php echo (set_value('ket_piket')) ? set_value('ket_piket') : $piket['ket_piket']; ?>" />
                <?php echo form_error('ket_piket'); ?>
            </div>

            <div class="form-group">
                <label for="file_piket" class="form-label">Upload File</label>
                <input type="file" name="file_piket" id="file_piket" />
                <?php echo form_error('file_piket'); ?>
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-info" value="Save" />
            </div>
        </form>
    </div>
    </form>
    <div class="ml-3 p-2">
        <a href="<?= base_url('piket'); ?>" class="btn btn-success">
            <i class="fa fa-angle-double-left" aria-hidden="true"></i>
            Daftar Data Piket
        </a>
    </div>
</div>