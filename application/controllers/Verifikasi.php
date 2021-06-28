<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Verifikasi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('table', 'form_validation'));
        $this->load->helper(array('form', 'url'));
        $this->load->model('verifikasi_model', '', TRUE);
        $this->load->model('iuran_model', '', TRUE);
    }

    public function index($offset = 0, $order_column = 'id_verifikasi', $order_type = 'asc')
    {
        $data['title'] = 'List Verifikasi';
        $data['user'] = $this->db->get_where('tb_user', ['nama' => $this->session->userdata('nama')])->row_array();
        $this->load->view('templates/new_header', $data);
        $this->load->view('templates/new_sidebar');
        $this->load->view('templates/new_topbar');

        if (empty($offset)) $offset = 0;
        if (empty($order_column)) $order_column = 'id_verifikasi';
        if (empty($order_type)) $order_type = 'asc';
        //TODO: check for valid column

        // load data
        $verifikasis = $this->verifikasi_model->getVerfikasiJoin();

        // generate pagination
        $this->load->library('pagination');
        $config['base_url'] = site_url('verifikasi/index/');
        $config['total_rows'] = $this->verifikasi_model->count_all();
        $config['per_page'] = 10;
        $config['uri_segment'] = 3;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();

        // generate table data
        $tmpl = array('table_open'  => '<table class="table table-borderless">');

        $this->table->set_template($tmpl);

        $this->load->library('table');
        $this->table->set_empty("&nbsp;");
        $new_order = ($order_type == 'asc' ? 'desc' : 'asc');
        $this->table->set_heading(
            'No',
            anchor('verifikasi/index/' . $offset . '/id_user/' . $new_order, 'Nama Anggota'),
            anchor('verifikasi/index/' . $offset . '/id_iuran/' . $new_order, 'Nama Iuran'),
            anchor('verifikasi/index/' . $offset . '/status/' . $new_order, 'Status'),
            'Actions'
        );

        $i = 0 + (int) $offset;
        foreach ($verifikasis as $verifikasi) {
            $this->table->add_row(
                ++$i,
                $verifikasi->nama,
                $verifikasi->nama_iuran,
                $verifikasi->status,

                anchor('verifikasi/update/' . $verifikasi->id_verifikasi, 'update', array('class' => 'btn btn-success'))
            );
        }
        $data['table'] = $this->table->generate();

        if ($this->uri->segment(3) == 'delete_success')
            $data['message'] = 'Data berhasil dihapus';
        else if ($this->uri->segment(3) == 'add_success')
            $data['message'] = 'Data berhasil ditambah';
        else
            $data['message'] = '';
        // load view
        $this->load->view('verifikasi/verifikasiList', $data);
        $this->load->view('templates/new_footer');
    }

    function add()
    {
        $data['title'] = 'Tambah Verifikasi';
        // $data['user'] = $this->db->get_where('tb_admin', ['username' => $this->session->userdata('username')])->row_array();
        $this->load->view('templates/new_header', $data);
        $this->load->view('templates/new_sidebar');
        $this->load->view('templates/new_topbar');

        // set common properties
        $data['action'] = site_url('verifikasi/add');
        $data['link_back'] = anchor('verifikasi/index/', 'Back to list of verifikasis', array('class' => 'back'));

        $this->_set_rules();

        // run validation
        if ($this->form_validation->run() === FALSE) {
            $data['message'] = '';
            // set common properties
            $data['title'] = 'Tambah verifikasi Baru';
            $data['message'] = '';
            $data['verifikasi']['id_verifikasi'] = '';
            $data['verifikasi']['nama_verifikasi'] = '';
            $data['verifikasi']['tgl_verifikasi'] = '';
            $data['verifikasi']['ket_verifikasi'] = '';
            $data['link_back'] = anchor('verifikasi/index/', 'Lihat Daftar verifikasi', array('class' => 'back'));
            $this->load->view('verifikasi/verifikasiEdit', $data);
        } else {

            // save data
            $verifikasi = array(
                'id_verifikasi' => $this->input->post('id_verifikasi'),
                'nama_verifikasi' => $this->input->post('nama_verifikasi'),
                'tgl_verifikasi' => $this->input->post('tgl_verifikasi'),
                'ket_verifikasi' => $this->input->post('ket_verifikasi'),
            );
            $id_verifikasi = $this->verifikasi_model->save($verifikasi);

            // set form input 
            $this->validation->id_verifikasi = $id_verifikasi;
            redirect('verifikasi');

            redirect('verifikasi/index/add_success');
        }
        $this->load->view('templates/new_footer');
    }

    function view($id_verifikasi)
    {
        $data['title'] = 'Detail Data verifikasi';
        // $data['user'] = $this->db->get_where('tb_admin', ['username' => $this->session->userdata('username')])->row_array();
        $this->load->view('templates/new_header', $data);
        $this->load->view('templates/new_sidebar');
        $this->load->view('templates/new_topbar');

        // set common properties
        $data['title'] = 'Detail Data verifikasi';
        $data['link_back'] = anchor('verifikasi/index/', 'Daftar verifikasi', array('class' => 'back'));

        // get details
        $data['verifikasi'] = $this->verifikasi_model->get_by_id($id_verifikasi)->row();

        // load view
        $this->load->view('verifikasi/verifikasiView', $data);
        $this->load->view('templates/new_footer');
    }

    function update($id_verifikasi)
    {
        $data['title'] = 'Update Data verifikasi';
        // $data['user'] = $this->db->get_where('tb_admin', ['username' => $this->session->userdata('username')])->row_array();
        $this->load->view('templates/new_header', $data);
        $this->load->view('templates/new_sidebar');
        $this->load->view('templates/new_topbar');

        // set common properties
        $data['title'] = 'Update Data verifikasi';
        $this->load->library('form_validation');
        // set validation properties
        $this->_set_rules();
        $data['action'] = ('verifikasi/update/' . $id_verifikasi);

        // run validation
        if ($this->form_validation->run() === FALSE) {

            $data['message'] = '';
            $data['verifikasi'] = (array)$this->verifikasi_model->get_by_id($id_verifikasi)->row();

            // set common properties
            $data['title'] = 'Update Data verifikasi';
            $data['message'] = '';
        } else {
            // save data
            $id_verifikasi = $this->input->post('id_verifikasi');
            $verifikasi = array(
                'id_verifikasi' => $this->input->post('id_verifikasi'),
                'nama_verifikasi' => $this->input->post('nama_verifikasi'),
                'tgl_verifikasi' => $this->input->post('tgl_verifikasi'),
                'ket_verifikasi' => $this->input->post('ket_verifikasi'),
            );

            $this->verifikasi_model->update($id_verifikasi, $verifikasi);
            $data['verifikasi'] = (array)$this->verifikasi_model->get_by_id($id_verifikasi)->row();
            redirect('verifikasi');
            // set user message
            $data['message'] = 'Update Success';
        }
        $data['link_back'] = anchor('verifikasi/index/', 'Daftar Data verifikasi', array('class' => 'back'));
        // load view
        $this->load->view('verifikasi/verifikasiEdit', $data);
        $this->load->view('templates/new_footer');
    }

    function delete($id_verifikasi)
    {
        // delete
        $this->verifikasi_model->delete($id_verifikasi);
        // redirect to list page
        redirect('verifikasi/index/delete_success', 'refresh');
    }

    // validation rules
    function _set_rules()
    {
        $this->form_validation->set_rules('nama_verifikasi', 'Nama verifikasi', 'required|trim');
        $this->form_validation->set_rules('tgl_verifikasi', 'Tanggal', 'required|trim');
        $this->form_validation->set_rules('ket_verifikasi', 'Keterangan verifikasi', 'required|trim');
    }

    function verifikasi()
    {

        // ini cuma bisa diakses oleh user
    }
    function bayar()
    {
        // ini cumab isa diaskes leh anggota

    }
}
