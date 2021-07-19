<html>

<head>
    <title>PDF</title>

    <link rel="stylesheet" href="<?php echo base_url('assets/jquery-ui/jquery-ui.min.css'); ?>" /> <!-- Load file css jquery-ui -->
    <script src="<?php echo base_url('assets/jquery.min.js'); ?>"></script> <!-- Load file jquery -->
</head>

<body>
    <h2>Data Transaksi</h2>
    <hr>
    <form method="get" action="">
        <label>Filter Berdasarkan</label><br>
        <select name="filter" id="filter">
            <option value="">Pilih</option>
            <option value="1">Per Tanggal</option>
            <option value="2">Per Bulan</option>
            <option value="3">Per Tahun</option>
        </select>
        <br /><br />
        <div id="form-tanggal">
            <label>Tanggal</label><br>
            <input type="text" name="tanggal" class="input-tanggal" />
            <br /><br />
        </div>
        <div id="form-bulan">
            <label>Bulan</label><br>
            <select name="bulan">
                <option value="">Pilih</option>
                <option value="1">Januari</option>
                <option value="2">Februari</option>
                <option value="3">Maret</option>
                <option value="4">April</option>
                <option value="5">Mei</option>
                <option value="6">Juni</option>
                <option value="7">Juli</option>
                <option value="8">Agustus</option>
                <option value="9">September</option>
                <option value="10">Oktober</option>
                <option value="11">November</option>
                <option value="12">Desember</option>
            </select>
            <br /><br />
        </div>
        <div id="form-tahun">
            <label>Tahun</label><br>
            <select name="tahun">
                <option value="">Pilih</option>
                <?php
                foreach ($option_tahun as $data) { // Ambil data tahun dari model yang dikirim dari controller
                    echo '<option value="' . $data->tahun . '">' . $data->tahun . '</option>';
                }
                ?>
            </select>
            <br /><br />
        </div>
        <button type="submit">Tampilkan</button>
        <a href="<?php echo base_url(); ?>">Reset Filter</a>
    </form>
    <hr />

    <b><?php echo $ket; ?></b><br /><br />
    <a href="<?php echo $url_cetak; ?>">CETAK PDF</a><br /><br />
    <table border="1" cellpadding="8">
        <tr>
            <th>Tanggal</th>
            <th>Nama Donatur</th>
            <th>Jumlah Donasi</th>
            <th>Tanggal</th>
            <th>Keterangan</th>
        </tr>
        <?php
        if (!empty($tb_donatur)) {
            $no = 1;
            foreach ($tb_donatur as $data) {
                $tgl = date('d-m-Y', strtotime($data->tgl));

                echo "<tr>";
                echo "<td>" . $tgl . "</td>";
                echo "<td>" . $data->nama_donatur . "</td>";
                echo "<td>" . $data->jumlah_donasi . "</td>";
                echo "<td>" . $data->tgl_donasi . "</td>";
                echo "<td>" . $data->keterangan . "</td>";
                echo "</tr>";
                $no++;
            }
        }
        ?>

        <script src="<?php echo base_url('assets/jquery-ui/jquery-ui.min.js'); ?>"></script> <!-- Load file plugin js jquery-ui -->
        <script>
            $(document).ready(function() { // Ketika halaman selesai di load
                $('.input-tanggal').datepicker({
                    dateFormat: 'yy-mm-dd' // Set format tanggalnya jadi yyyy-mm-dd
                });
                $('#form-tanggal, #form-bulan, #form-tahun').hide(); // Sebagai default kita sembunyikan form filter tanggal, bulan & tahunnya
                $('#filter').change(function() { // Ketika user memilih filter
                    if ($(this).val() == '1') { // Jika filter nya 1 (per tanggal)
                        $('#form-bulan, #form-tahun').hide(); // Sembunyikan form bulan dan tahun
                        $('#form-tanggal').show(); // Tampilkan form tanggal
                    } else if ($(this).val() == '2') { // Jika filter nya 2 (per bulan)
                        $('#form-tanggal').hide(); // Sembunyikan form tanggal
                        $('#form-bulan, #form-tahun').show(); // Tampilkan form bulan dan tahun
                    } else { // Jika filternya 3 (per tahun)
                        $('#form-tanggal, #form-bulan').hide(); // Sembunyikan form tanggal dan bulan
                        $('#form-tahun').show(); // Tampilkan form tahun
                    }
                    $('#form-tanggal input, #form-bulan select, #form-tahun select').val(''); // Clear data pada textbox tanggal, combobox bulan & tahun
                })
            })
        </script>
    </table>
</body>

</html>