<!-- <div class="container-fluid">
    <h1 class="ml-2">IURAN</h1>
    <div class="paging"><?php echo $pagination; ?></div>
    <div class="data"><?php echo $table; ?></div>
    <div class="paging"><?php echo $pagination; ?></div>
</div>
</div> -->

<div class="container-fluid">
    <h1 class="ml-2"><?php echo $title; ?></h1>
    <div class="table">
        <table class="table table-borderless">
            <tr>
                <td valign="top">Nama Iuran</td>
                <td><?php echo $iuran->nama_iuran; ?></td>
            </tr>
            <tr>
                <td valign="top">Tanggal</td>
                <td><?php echo $iuran->tgl_iuran; ?></td>
            </tr>
            <tr>
                <td valign="top">Keterangan</td>
                <td><?php echo $iuran->ket_iuran; ?></td>
            </tr>
        </table>
        <form action="<?= base_url(); ?>iuran/uploadfile" method="post" enctype="multipart/form-data">
            <input type="hidden" value="<?php echo $user['id_user']; ?>" name="id_user">
            <input type="hidden" value="<?php echo $iuran->id_iuran; ?>" name="id_iuran">
            <div class="form-group">
                <input type="file" class="form-control" name="file_verifikasi" id="file_verifikasi">
            </div>
            <button type="submit" class="btn btn-primary" href="">Save</button>
        </form>
    </div>
    <br />
    <div class="ml-2 p-2">
        <a href="<?= base_url('iuran/bayar_iuran'); ?>" class="btn btn-success">
            <i class="fa fa-angle-double-left" aria-hidden="true"></i>
            Daftar Data Iuran
        </a>
    </div>

</div>