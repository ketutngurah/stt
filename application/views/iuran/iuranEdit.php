<div class="container-fluid">
    <h1 class="ml-3"><?php echo $title; ?></h1>
    <?php echo $message; ?>
    <?php echo validation_errors(); ?>
    <?php echo form_open($action); ?>
    <div class="container">
        <form>
            <div class="form-group">
                <label for="id_iuran">ID Iuran</label>
                <input type="text" name="id_iuran" id="id_iuran" disabled="disable" class="form-control" value="<?php echo (isset($iuran['id_iuran'])) ? $iuran['id_iuran'] : ''; ?>" />
                <input type="hidden" name="id_iuran" value="<?php echo (isset($iuran['id_iuran'])) ? $iuran['id_iuran'] : ''; ?>" />
            </div>

            <div class="form-group">
                <label for="nama_iuran">Nama Iuran</label>
                <input type="text" name="nama_iuran" id="nama_iuran" class="form-control" value="<?php echo set_value('nama_iuran') ? set_value('nama_iuran') : $iuran['nama_iuran']; ?>" />
                <?php echo form_error('nama_iuran'); ?>
            </div>


            <div class="form-group">
                <label for="tgl_iuran">Tanggal</label>
                <input type="date" name="tgl_iuran" id="tgl_iuran" class="form-control" value="<?php echo (set_value('tgl_iuran')) ? set_value('tgl_iuran') : $iuran['tgl_iuran']; ?>" />
                <?php echo form_error('tgl_iuran'); ?>
            </div>

            <div class="form-group">

                <label for="ket_iuran">Keterangan</label>
                <input type="text" name="ket_iuran" id="ket_iuran" class="form-control" value="<?php echo (set_value('ket_iuran')) ? set_value('ket_iuran') : $iuran['ket_iuran']; ?>" />
                <?php echo form_error('ket_iuran'); ?>
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-info" value="Save" />
            </div>
        </form>
    </div>
    </form>
    <div class="ml-3 p-2">
        <a href="<?= base_url('iuran'); ?>" class="btn btn-success">
            <i class="fa fa-angle-double-left" aria-hidden="true"></i>
            Daftar Data Iuran
        </a>
    </div>
</div>