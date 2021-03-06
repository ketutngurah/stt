<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <!-- <?php echo $this->session->userdata('id_user'); ?> -->
    <div class="ml-2 p-2">
        <a href="<?= base_url('user/edit'); ?>" class="btn btn-success">
            Edit
        </a>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <?= $this->session->flashdata('message'); ?>
        </div>
    </div>
    <div class="card mb-3 col-lg-8" style="max-width: 540px;">
        <div class="row no-gutters">
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="font-weight-bold">Nama Lengkap</h5>
                    <p class="card-title"><?= $user['nama']; ?></p>
                    <h5 class="font-weight-bold">Tanggal Lahir</h5>
                    <p class="card-text"><?= $user['tgl_lahir']; ?></p>
                    <h5 class="font-weight-bold">Alamat</h5>
                    <p class="card-text"><?= $user['alamat']; ?></p>
                    <h5 class="font-weight-bold">Jenis Kelamin</h5>
                    <p class="card-text"><?= $user['jk']; ?></p>
                    <h5 class="font-weight-bold">Hobi</h5>
                    <p class="card-text"><?= $user['hobi']; ?></p>
                    <h5 class="font-weight-bold">Telepon</h5>
                    <p class="card-text"><?= $user['telp']; ?></p>
                    <h5 class="font-weight-bold">Pekerjaan</h5>
                    <p class="card-text"><?= $user['pekerjaan']; ?></p>
                    <h5 class="font-weight-bold">Nama Orang Tua</h5>
                    <p class="card-text"><?= $user['nama_ortu']; ?></p>
                    <h5 class="font-weight-bold">Telepon Orang Tua</h5>
                    <p class="card-text"><?= $user['telp_ortu']; ?></p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->