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
            'Nama Anggota',
            'Nama Iuran',
            'Status',
            'Actions'
        );

        $i = 0 + (int) $offset;
        foreach ($verifikasis as $verifikasi) {
            if ($verifikasi->status == 0) {
                $status = 'Belum Lunas';
            } else if ($verifikasi->status == 1) {
                $status = 'Lunas';
            }
            $this->table->add_row(
                ++$i,
                $verifikasi->nama,
                $verifikasi->nama_iuran,
                $status,

                anchor('verifikasi/update/' . $verifikasi->id_verifikasi, ' ', array('class' => 'btn btn-success nc-icon nc-zoom-split', 'data-toggle' => "tooltip", 'data-placement' => "right", 'title' => "Detail"))
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

    function view($id_verifikasi)
    {
        $data['title'] = 'Detail Data Verifikasi';
        // $data['user'] = $this->db->get_where('tb_admin', ['username' => $this->session->userdata('username')])->row_array();
        $this->load->view('templates/new_header', $data);
        $this->load->view('templates/new_sidebar');
        $this->load->view('templates/new_topbar');

        // set common properties
        $data['title'] = 'Detail Data Verifikasi';
        $data['link_back'] = anchor('verifikasi/index/', 'Daftar Verifikasi', array('class' => 'back'));

        // get details
        $data['verifikasi'] = $this->verifikasi_model->get_by_id($id_verifikasi)->row();


        // load view
        $this->load->view('verifikasi/verifikasiView', $data);
        $this->load->view('templates/new_footer');
    }

    function update($id_verifikasi)
    {
        $data['title'] = 'Update Data Verifikasi';

        $this->load->view('templates/new_header', $data);
        $this->load->view('templates/new_sidebar');
        $this->load->view('templates/new_topbar');

        // set common properties
        $data['title'] = 'Update Data Verifikasi';
        $this->load->library('form_validation');
        // set validation properties
        $this->_set_rules();
        $data['action'] = ('verifikasi/update/' . $id_verifikasi);

        // run validation
        if ($this->form_validation->run() === FALSE) {

            $data['message'] = '';
            $data['verifikasi'] = (array)$this->verifikasi_model->getVerifikasiJoinById($id_verifikasi);

            // set common properties
            $data['title'] = 'Update Data Verifikasi';
            $data['message'] = '';
        } else {
            // save data
            $id_verifikasi = $this->input->post('id_verifikasi');
            $verifikasi = array(
                'status' => $this->input->post('status'),
            );

            // $this->db->where($this->primary_key, $id_verifikasi);
            $this->verifikasi_model->update($id_verifikasi, $verifikasi);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Berhasil Diubah!</div>');
            redirect('verifikasi');
            // set user message
            $data['message'] = 'Update Success';
        }
        $data['link_back'] = anchor('verifikasi/index/', 'Daftar Data Verifikasi', array('class' => 'back'));
        // load view
        $this->load->view('verifikasi/verifikasiEdit', $data);
        $this->load->view('templates/new_footer');
    }

    // validation rules
    function _set_rules()
    {
        $this->form_validation->set_rules('status', 'Status', 'required|trim');
    }

    function status_ver($offset = 0, $order_column = 'id_verifikasi', $order_type = 'asc')
    {
        // $data['title'] = 'List Verifikasi';
        $data['user'] = $this->db->get_where('tb_user', ['id_user' => $this->session->userdata('id_user')])->row_array();
        $this->load->view('templates/new_header', $data);
        $this->load->view('templates/new_sidebar');
        $this->load->view('templates/new_topbar');

        if (empty($offset)) $offset = 0;
        if (empty($order_column)) $order_column = 'id_iuran';
        if (empty($order_type)) $order_type = 'asc';
        //TODO: check for valid column

        $id = $this->session->userdata('id_user');
        // load data
        $verifikasis = $this->verifikasi_model->getVerifikasiUser($id)->result();

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
            'Nama Iuran',
            'Status'
        );

        $i = 0 + (int) $offset;
        foreach ($verifikasis as $verifikasi) {
            $this->table->add_row(
                ++$i,
                $verifikasi->nama_iuran,
                $verifikasi->status == '0' ? 'Belum Lunas' : 'Lunas'
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
        $this->load->view('verifikasi/verifikasiAnggota', $data);
        $this->load->view('templates/new_footer');
    }
}
