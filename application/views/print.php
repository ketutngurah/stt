<html>

<head>
    <title>Cetak PDF</title>
    <style>
        table {
            border-collapse: collapse;
            table-layout: fixed;
            width: 630px;
        }

        table td {
            word-wrap: break-word;
            width: 20%;
        }
    </style>
</head>

<body>
    <b><?php echo $ket; ?></b><br /><br />

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
    </table>
</body>

</html>