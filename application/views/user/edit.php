<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <!-- /.container-fluid -->

    <div class="row">
        <div class="col-lg-8">


            <?php echo form_open_multipart('user/edit'); ?>
            <div class="form-group row">
                <label for="username" class="col-sm-2 col-form-label">Username</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="username" name="username" value="<?= $user['username']; ?>" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label for="nama" class="col-sm-2 col-form-label">Nama Lengkap</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nama" name="nama" value="<?= $user['nama']; ?>">
                    <?=
                        form_error('nama', '<small class="text-danger pl-3">', '</small>');
                    ?>
                </div>
            </div>
        </div>
        <div class="form-group row justify-content-end">
            <button type="submit" class="btn btn-primary">Edit</button>
        </div>
        </form>
    </div>
</div>
</div>
<!-- End of Main Content -->