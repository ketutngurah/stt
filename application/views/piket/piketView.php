<div class="container-fluid">
    <h1 class="ml-2"><?php echo $title; ?></h1>
    <div class="table">
        <table class="table table-borderless">
            <tr>
                <td width="30%">ID Piket</td>
                <td><?php echo $piket->id_piket; ?></td>
            </tr>
            <tr>
                <td valign="top">Nama Piket</td>
                <td><?php echo $piket->nama_piket; ?></td>
            </tr>
            <tr>
                <td valign="top">Tanggal</td>
                <td><?php echo $piket->tgl_piket; ?></td>
            </tr>
            <tr>
                <td valign="top">Keterangan</td>
                <td><?php echo $piket->ket_piket; ?></td>
            </tr>
            <tr>
                <td valign="top">File</td>
                <td><?php echo $piket->file_piket; ?></td>
            </tr>
        </table>
    </div>
    <br />
    <div class="ml-2 p-2">
        <a href="<?= base_url('piket'); ?>" class="btn btn-success">
            <i class="fa fa-angle-double-left" aria-hidden="true"></i>
            Kembali
        </a>
    </div>

</div>