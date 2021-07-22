<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class LaporanDonatur extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('donatur_model');
    }

    public function index()
    {
        $data['title'] = '';
        $this->load->view('templates/new_header', $data);
        $this->load->view('templates/new_sidebar');
        $this->load->view('templates/new_topbar');

        if (isset($_GET['filter']) && !empty($_GET['filter'])) { // Cek apakah user telah memilih filter dan klik tombol tampilkan
            $filter = $_GET['filter']; // Ambil data filder yang dipilih user

            if ($filter == '1') { // Jika filter nya 1 (per tanggal)
                $tgl = $_GET['tanggal'];

                $ket = 'Data Donatur Tanggal' . date('d-m-y', strtotime($tgl));
                $url_cetak = 'laporandonatur/cetak?filter=1&tanggal=' . $tgl;
                $donatur = $this->donatur_model->view_by_date($tgl); // Panggil fungsi view_by_date yang ada di TransaksiModel
            } else if ($filter == '2') { // Jika filter nya 2 (per bulan)
                $bulan = $_GET['bulan'];
                $tahun = $_GET['tahun'];
                $nama_bulan = array('', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');

                $ket = 'Data Donatur Bulan ' . $nama_bulan[$bulan] . ' ' . $tahun;
                $url_cetak = 'laporandonatur/cetak?filter=2&bulan=' . $bulan . '&tahun=' . $tahun;
                $donatur = $this->donatur_model->view_by_month($bulan, $tahun); // Panggil fungsi view_by_month yang ada di TransaksiModel
            } else { // Jika filter nya 3 (per tahun)
                $tahun = $_GET['tahun'];
                $ket = 'Data Donatur Tahun ' . $tahun;
                $url_cetak = 'laporandonatur/cetak?filter=3&tahun=' . $tahun;
                $donatur = $this->donatur_model->view_by_year($tahun); // Panggil fungsi view_by_year yang ada di TransaksiModel
            }
        } else { // Jika user tidak mengklik tombol tampilkan
            $ket = 'Semua Data Donatur';
            $url_cetak = 'laporandonatur/cetak';
            $donatur = $this->donatur_model->view_all(); // Panggil fungsi view_all yang ada di TransaksiModel
        }

        $data['ket'] = $ket;
        $data['url_cetak'] = base_url('index.php/' . $url_cetak);
        $data['donatur'] = $donatur;
        $data['option_tahun'] = $this->donatur_model->option_tahun();
        $this->load->view('donatur/view', $data);
    }

    public function cetak()
    {
        if (isset($_GET['filter']) && !empty($_GET['filter'])) { // Cek apakah user telah memilih filter dan klik tombol tampilkan
            $filter = $_GET['filter']; // Ambil data filder yang dipilih user

            if ($filter == '1') { // Jika filter nya 1 (per tanggal)
                $tgl = $_GET['tanggal'];

                $ket = 'Data Donatur Tanggal ' . date('d-m-y', strtotime($tgl));
                $donatur = $this->donatur_model->view_by_date($tgl); // Panggil fungsi view_by_date yang ada di TransaksiModel
            } else if ($filter == '2') { // Jika filter nya 2 (per bulan)
                $bulan = $_GET['bulan'];
                $tahun = $_GET['tahun'];
                $nama_bulan = array('', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');

                $ket = 'Data Donatur Bulan ' . $nama_bulan[$bulan] . ' ' . $tahun;
                $donatur = $this->donatur_model->view_by_month($bulan, $tahun); // Panggil fungsi view_by_month yang ada di TransaksiModel
            } else { // Jika filter nya 3 (per tahun)
                $tahun = $_GET['tahun'];

                $ket = 'Data Donatur Tahun ' . $tahun;
                $donatur = $this->donatur_model->view_by_year($tahun); // Panggil fungsi view_by_year yang ada di TransaksiModel
            }
        } else { // Jika user tidak mengklik tombol tampilkan
            $ket = 'Semua Data Donatur';
            $donatur = $this->donatur_model->view_all(); // Panggil fungsi view_all yang ada di TransaksiModel
        }

        $data['ket'] = $ket;
        $data['donatur'] = $donatur;

        ob_start();
        $this->load->view('donatur/print', $data);
        $html = ob_get_contents();
        ob_end_clean();

        $this->load->library('pdfgenerator');

        // title dari pdf
        $this->data['title_pdf'] = 'Laporan Donatur';

        // filename dari pdf ketika didownload
        $file_pdf = 'Laporan Donatur';
        // setting paper
        $paper = 'A4';
        //orientasi paper potrait / landscape
        $orientation = "portrait";

        $html = $this->load->view('donatur/print', $this->data, true);

        // run dompdf
        $this->pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
    }
}
