<div class="container-fluid">
    <h1 class="ml-2"><?php echo $title; ?></h1>
    <div class="table">
        <table class="table table-borderless">
            <tr>
                <td width="30%">ID Iuran</td>
                <td><?php echo $iuran->id_iuran; ?></td>
            </tr>
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
    </div>
    <br />
    <div class="ml-2 p-2">
        <a href="<?= base_url('iuran'); ?>" class="btn btn-success">
            <i class="fa fa-angle-double-left" aria-hidden="true"></i>
            Kembali
        </a>
    </div>

</div>