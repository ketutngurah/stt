<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

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
                    <h5 class="font-weight-bold">Username</h5>
                    <p class="card-text"><?= $user['email']; ?></p>
                    <h5 class="font-weight-bold">Alamat</h5>
                    <p class="card-text"><?= $user['alamat']; ?></p>
                    <h5 class="font-weight-bold">Telepon</h5>
                    <p class="card-text"><?= $user['telp']; ?></p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->