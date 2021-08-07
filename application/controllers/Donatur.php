<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Donatur extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('table', 'form_validation'));
        $this->load->helper(array('form', 'url'));
        $this->load->model('donatur_model', '', TRUE);
    }

    public function index($offset = 0, $order_column = 'id_donatur', $order_type = 'asc')
    {

        $query = $this->db->select('SUM(jumlah_donasi) as total_donasi')->from('tb_donatur')->get();
        $data['total_donasi'] = $query->row()->total_donasi;
        $data['title'] = 'List Donatur';
        $this->load->view('templates/new_header', $data);
        $this->load->view('templates/new_sidebar');
        $this->load->view('templates/new_topbar');

        if (empty($offset)) $offset = 0;
        if (empty($order_column)) $order_column = 'id_donatur';
        if (empty($order_type)) $order_type = 'asc';
        //TODO: check for valid column

        // load data
        $donaturs = $this->donatur_model->get_paged_list(10, $offset, $order_column, $order_type)->result();

        // generate pagination
        $this->load->library('pagination');
        $config['base_url'] = site_url('donatur/index/');
        $config['total_rows'] = $this->donatur_model->count_all();
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
            'Nama Donatur',
            'Jumlah Donasi',
            'Tanggal Donasi',
            'Keterangan',
            'Actions'
        );

        $i = 0 + (int) $offset;
        foreach ($donaturs as $donatur) {
            $this->table->add_row(
                ++$i,
                $donatur->nama_donatur,
                $donatur->jumlah_donasi,
                $donatur->tgl_donasi,
                $donatur->ket_donasi,
                anchor('donatur/view/' . $donatur->id_donatur, ' ', array('class' => 'btn btn-warning nc-icon nc-paper', 'data-toggle' => "tooltip", 'data-placement' => "right", 'title' => "View")) . ' ' .
                    anchor('donatur/update/' . $donatur->id_donatur, ' ', array('class' => 'btn btn-success nc-icon nc-settings', 'data-toggle' => "tooltip", 'data-placement' => "right", 'title' => "Update")) . ' ' .
                    anchor('donatur/delete/' . $donatur->id_donatur, ' ', array('class' => 'btn btn-danger nc-icon nc-basket', 'data-toggle' => "tooltip", 'data-placement' => "right", 'title' => "Delete", 'onclick' => "return confirm('Apakah anda yakin ingin menghapus data donatur ini?')"))
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
        $this->load->view('donatur/donaturList', $data);
        $this->load->view('templates/new_footer');
    }

    function add()
    {
        $data['title'] = 'Tambah Donatur';
        // $data['user'] = $this->db->get_where('tb_admin', ['username' => $this->session->userdata('username')])->row_array();
        $this->load->view('templates/new_header', $data);
        $this->load->view('templates/new_sidebar');
        $this->load->view('templates/new_topbar');

        // set common properties
        $data['action'] = site_url('donatur/add');
        $data['link_back'] = anchor('donatur/index/', 'Back to list of donaturs', array('class' => 'back'));

        $this->_set_rules();

        // run validation
        if ($this->form_validation->run() === FALSE) {
            $data['message'] = '';
            // set common properties
            $data['title'] = 'Tambah Donatur Baru';
            $data['message'] = '';
            $data['donatur']['id_donatur'] = '';
            $data['donatur']['nama_donatur'] = '';
            $data['donatur']['jumlah_donasi'] = '';
            $data['donatur']['tgl_donasi'] = '';
            $data['donatur']['ket_donasi'] = '';
            $data['link_back'] = anchor('donatur/index/', 'Lihat Daftar Donatur', array('class' => 'back'));
            $this->load->view('donatur/donaturEdit', $data);
        } else {
            // save data
            $donatur = array(
                'id_donatur' => $this->input->post('id_donatur'),
                'nama_donatur' => $this->input->post('nama_donatur'),
                'jumlah_donasi' => $this->input->post('jumlah_donasi'),
                'tgl_donasi' => $this->input->post('tgl_donasi'),
                'ket_donasi' => $this->input->post('ket_donasi'),
            );
            $id_donatur = $this->donatur_model->save($donatur);

            // set form input nama="Kodebuku"
            $this->validation->id_donatur = $id_donatur;
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Berhasil Ditambah!</div>');
            redirect('donatur');

            redirect('donatur/index/add_success');
        }
        $this->load->view('templates/new_footer');
    }

    function view($id_donatur)
    {
        $data['title'] = 'Detail Data Donatur';
        // $data['user'] = $this->db->get_where('tb_admin', ['username' => $this->session->userdata('username')])->row_array();
        $this->load->view('templates/new_header', $data);
        $this->load->view('templates/new_sidebar');
        $this->load->view('templates/new_topbar');

        // set common properties
        $data['title'] = 'Detail Data Donatur';
        $data['link_back'] = anchor('donatur/index/', 'Daftar donatur', array('class' => 'back'));

        // get details
        $data['donatur'] = $this->donatur_model->get_by_id($id_donatur)->row();

        // load view
        $this->load->view('donatur/donaturView', $data);
        $this->load->view('templates/new_footer');
    }

    function update($id_donatur)
    {
        $data['title'] = 'Update Data Donatur';
        // $data['user'] = $this->db->get_where('tb_admin', ['username' => $this->session->userdata('username')])->row_array();
        $this->load->view('templates/new_header', $data);
        $this->load->view('templates/new_sidebar');
        $this->load->view('templates/new_topbar');

        // set common properties
        $data['title'] = 'Update Data Donatur';
        $this->load->library('form_validation');
        // set validation properties
        $this->_set_rules();
        $data['action'] = ('donatur/update/' . $id_donatur);

        // run validation
        if ($this->form_validation->run() === FALSE) {

            $data['message'] = '';
            $data['donatur'] = (array)$this->donatur_model->get_by_id($id_donatur)->row();

            // set common properties
            $data['title'] = 'Update Data Donatur';
            $data['message'] = '';
        } else {
            // save data
            $id_donatur = $this->input->post('id_donatur');
            $donatur = array(
                'id_donatur' => $this->input->post('id_donatur'),
                'nama_donatur' => $this->input->post('nama_donatur'),
                'jumlah_donasi' => $this->input->post('jumlah_donasi'),
                'tgl_donasi' => $this->input->post('tgl_donasi'),
                'ket_donasi' => $this->input->post('ket_donasi'),
            );

            $this->donatur_model->update($id_donatur, $donatur);
            $data['donatur'] = (array)$this->donatur_model->get_by_id($id_donatur)->row();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Berhasil Diubah!</div>');
            redirect('donatur');
            // set user message
            $data['message'] = 'Update Success';
        }
        $data['link_back'] = anchor('donatur/index/', 'Daftar Data Donatur', array('class' => 'back'));
        // load view
        $this->load->view('donatur/donaturEdit', $data);
        $this->load->view('templates/new_footer');
    }

    function delete($id_donatur)
    {
        // delete
        $this->donatur_model->delete($id_donatur);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Berhasil Dihapus!</div>');
        // redirect to list page
        redirect('donatur/index/delete_success', 'refresh');
    }

    // validation rules
    function _set_rules()
    {
        $this->form_validation->set_rules('nama_donatur', 'Nama Donatur', 'required|trim');
        $this->form_validation->set_rules('jumlah_donasi', 'Jumlah Donasi', 'required|trim');
        $this->form_validation->set_rules('tgl_donasi', 'Tanggal Donasi', 'required|trim');
        $this->form_validation->set_rules('ket_donasi', 'Keterangan', 'required|trim');
    }
}
