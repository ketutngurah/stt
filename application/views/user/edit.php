<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <!-- /.container-fluid -->

    <div class="row">
        <div class="col-lg-8">
            <?php echo form_open_multipart('user/edit'); ?>
            <div class="form-group">
                <label for="nama">Nama Lengkap</label>
                <input type="text" name="nama" id="nama" class="form-control" value="<?php echo set_value('nama') ? set_value('nama') : $tb_user['nama']; ?>" />
                <?php echo form_error('nama'); ?>
            </div>

            <div class="form-group">
                <label for="tgl_lahir">Tanggal Lahir</label>
                <input type="date" name="tgl_lahir" id="tgl_lahir" class="form-control" value="<?php echo (set_value('tgl_lahir')) ? set_value('tgl_lahir') : $tb_user['tgl_lahir']; ?>" />
                <?php echo form_error('tgl_lahir'); ?>
            </div>

            <div class="form-group">
                <label for="jk">Jenis Kelamin</label>
            </div>
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <div class="custom-control custom-radio">
                        <input id="laki-laki" name="jk" type="radio" class="custom-control-input" checked="" value="laki-laki">
                        <label class="custom-control-label" for="laki-laki">Laki-Laki</label>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="custom-control custom-radio">
                        <input id="perempuan" name="jk" type="radio" class="custom-control-input" value="perempuan">
                        <label class="custom-control-label" for="perempuan">Perempuan</label>
                    </div>
                </div>
                <?=
                form_error('jk', '<small class="text-danger pl-2">', '</small>');
                ?>
            </div>

            <div class="form-group">
                <label for="hobi">Hobi</label>
                <input type="text" name="hobi" id="hobi" class="form-control" value="<?php echo set_value('hobi') ? set_value('hobi') : $tb_user['hobi']; ?>" />
                <?php echo form_error('hobi'); ?>
            </div>

            <div class="form-group">
                <label for="telp">Telepon</label>
                <input type="text" name="telp" id="telp" class="form-control" value="<?php echo set_value('telp') ? set_value('telp') : $tb_user['telp']; ?>" />
                <?php echo form_error('telp'); ?>
            </div>

            <div class="form-group">
                <label for="pekerjaan">Pekerjaan</label>
                <input type="text" name="pekerjaan" id="pekerjaan" class="form-control" value="<?php echo set_value('pekerjaan') ? set_value('pekerjaan') : $tb_user['pekerjaan']; ?>" />
                <?php echo form_error('pekerjaan'); ?>
            </div>

            <div class="form-group">
                <label for="nama_ortu">Nama Orang Tua</label>
                <input type="text" name="nama_ortu" id="nama_ortu" class="form-control" value="<?php echo set_value('nama_ortu') ? set_value('nama_ortu') : $tb_user['nama_ortu']; ?>" />
                <?php echo form_error('nama_ortu'); ?>
            </div>

            <div class="form-group">
                <label for="telp_ortu">Telepon Orang Tua</label>
                <input type="text" name="telp_ortu" id="telp_ortu" class="form-control" value="<?php echo set_value('telp_ortu') ? set_value('telp_ortu') : $tb_user['telp_ortu']; ?>" />
                <?php echo form_error('telp_ortu'); ?>
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-info" value="Save" />
            </div>
            <div class="form-group">
                <a href="<?= base_url('user'); ?>" class="btn btn-success">
                    <i class="fa fa-angle-double-left" aria-hidden="true"></i>
                    Kembali
                </a>
            </div>

        </div>
        </form>
    </div>
</div>
</div>
<!-- End of Main Content -->