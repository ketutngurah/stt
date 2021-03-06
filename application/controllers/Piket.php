<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Piket extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('table', 'form_validation'));
        $this->load->helper(array('form', 'url'));
        $this->load->model('piket_model', '', TRUE);
    }

    public function index($offset = 0, $order_column = 'id_piket', $order_type = 'asc')
    {
        $data['title'] = 'List Piket';
        $this->load->view('templates/new_header', $data);
        $this->load->view('templates/new_sidebar');
        $this->load->view('templates/new_topbar');

        if (empty($offset)) $offset = 0;
        if (empty($order_column)) $order_column = 'id_piket';
        if (empty($order_type)) $order_type = 'asc';
        //TODO: check for valid column

        // load data
        $pikets = $this->piket_model->get_paged_list(10, $offset, $order_column, $order_type)->result();

        // generate pagination
        $this->load->library('pagination');
        $config['base_url'] = site_url('piket/index/');
        $config['total_rows'] = $this->piket_model->count_all();
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
            'Nama Piket',
            'Tanggal',
            'Keterangan',
            'File',
            'Actions'
        );

        $i = 0 + (int) $offset;
        foreach ($pikets as $piket) {
            $this->table->add_row(
                ++$i,
                $piket->nama_piket,
                $piket->tgl_piket,
                $piket->ket_piket,
                $piket->file_piket,
                anchor('piket/view/' . $piket->id_piket, ' ', array('class' => 'btn btn-warning nc-icon nc-paper', 'data-toggle' => "tooltip", 'data-placement' => "right", 'title' => "View")) . ' ' .
                    anchor('piket/update/' . $piket->id_piket, ' ', array('class' => 'btn btn-success nc-icon nc-settings', 'data-toggle' => "tooltip", 'data-placement' => "right", 'title' => "Update")) . ' ' .
                    anchor('piket/delete/' . $piket->id_piket, ' ', array('class' => 'btn btn-danger nc-icon nc-basket', 'data-toggle' => "tooltip", 'data-placement' => "right", 'title' => "Delete", 'onclick' => "return confirm('Apakah anda yakin ingin menghapus data piket ini?')"))
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
        $this->load->view('piket/piketList', $data);
        $this->load->view('templates/new_footer');
    }

    function add()
    {
        $data['title'] = 'Tambah Piket';
        $this->load->view('templates/new_header', $data);
        $this->load->view('templates/new_sidebar');
        $this->load->view('templates/new_topbar');

        // set common properties
        $data['action'] = site_url('piket/add');
        $data['link_back'] = anchor('piket/index/', 'Back to list of pikets', array('class' => 'back'));

        $this->_set_rules();

        // run validation
        if ($this->form_validation->run() === FALSE) {
            $data['message'] = '';
            // set common properties
            $data['title'] = 'Tambah Piket Baru';
            $data['message'] = '';
            $data['piket']['id_piket'] = '';
            $data['piket']['nama_piket'] = '';
            $data['piket']['tgl_piket'] = '';
            $data['piket']['ket_piket'] = '';
            $data['piket']['file_piket'] = '';
            $data['link_back'] = anchor('piket/index/', 'Lihat Daftar Piket', array('class' => 'back'));
            $this->load->view('piket/piketEdit', $data);
        } else {

            $config['allowed_types'] = 'doc|docx|pdf|png|jpg|jpeg';
            $config['upload_path'] = './uploads/';
            $config['file_name'] = $_FILES['file_piket']['name'];

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('file_piket')) {
                $this->upload->data('file_name');
            }


            // save data
            $piket = array(
                'id_piket' => $this->input->post('id_piket'),
                'nama_piket' => $this->input->post('nama_piket'),
                'tgl_piket' => $this->input->post('tgl_piket'),
                'ket_piket' => $this->input->post('ket_piket'),
                'file_piket' => $_FILES['file_piket']['name'],
            );
            $id_piket = $this->piket_model->save($piket);

            // set form input 
            $this->validation->id_piket = $id_piket;
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Berhasil Ditambah!</div>');
            redirect('piket');

            redirect('piket/index/add_success');
        }
        $this->load->view('templates/new_footer');
    }

    function view($id_piket)
    {
        $data['title'] = 'Detail Data Piket';
        // $data['user'] = $this->db->get_where('tb_admin', ['username' => $this->session->userdata('username')])->row_array();
        $this->load->view('templates/new_header', $data);
        $this->load->view('templates/new_sidebar');
        $this->load->view('templates/new_topbar');

        // set common properties
        $data['title'] = 'Detail Data Piket';
        $data['link_back'] = anchor('piket/index/', 'Daftar Piket', array('class' => 'back'));

        // get details
        $data['piket'] = $this->piket_model->get_by_id($id_piket)->row();

        // load view
        $this->load->view('piket/piketView', $data);
        $this->load->view('templates/new_footer');
    }



    function update($id_piket)
    {
        $data['title'] = 'Update Data Piket';
        $this->load->view('templates/new_header', $data);
        $this->load->view('templates/new_sidebar');
        $this->load->view('templates/new_topbar');

        // set common properties
        $data['action'] = ('piket/update/' . $id_piket);
        $data['link_back'] = anchor('piket/index/', 'Back to list of pikets', array('class' => 'back'));
        $data['title'] = 'Update Data piket';
        // set validation properties
        $this->_set_rules();

        // run validation
        if ($this->form_validation->run() === FALSE) {
            $data['message'] = '';
            $data['piket'] = (array)$this->piket_model->get_by_id($id_piket)->row();

            // set common properties
            $data['title'] = 'Update Data Piket';
            $data['message'] = '';
        } else {
            $config['allowed_types'] = 'doc|docx|pdf|png|jpg|jpeg';
            $config['upload_path'] = './uploads/';
            $config['file_name'] = $_FILES['file_piket']['name'];


            $this->load->library('upload', $config);
            if ($this->upload->do_upload('file_piket')) {
                $this->upload->data('file_name');
                // save data
                $id_piket = $this->input->post('id_piket');
                $piket = array(
                    'id_piket' => $this->input->post('id_piket'),
                    'nama_piket' => $this->input->post('nama_piket'),
                    'tgl_piket' => $this->input->post('tgl_piket'),
                    'ket_piket' => $this->input->post('ket_piket'),
                    'file_piket' => $_FILES['file_piket']['name'],
                );


                $id_piket = $this->piket_model->update($id_piket, $piket);
                $data['piket'] = (array)$this->piket_model->get_by_id($id_piket)->row();

                $this->validation->id_piket = $id_piket;
                redirect('piket');
                // set user message
                $data['message'] = 'Update Success';
            } else {
                $id_piket = $this->input->post('id_piket');
                $piket = array(
                    'id_piket' => $this->input->post('id_piket'),
                    'nama_piket' => $this->input->post('nama_piket'),
                    'tgl_piket' => $this->input->post('tgl_piket'),
                    'ket_piket' => $this->input->post('ket_piket')
                );


                $id_piket = $this->piket_model->update($id_piket, $piket);
                $data['piket'] = (array)$this->piket_model->get_by_id($id_piket)->row();

                $this->validation->id_piket = $id_piket;
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Berhasil Diubah!</div>');
                redirect('piket');
                // set user message
                $data['message'] = 'Update Success';
            }
        }
        $data['link_back'] = anchor('piket/index/', 'Daftar Data piket', array('class' => 'back'));
        // load view
        $this->load->view('piket/piketEdit', $data);
        $this->load->view('templates/new_footer');
    }

    function delete($id_piket)
    {
        // delete
        $this->piket_model->delete($id_piket);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Berhasil Dihapus!</div>');
        redirect('piket/index/delete_success', 'refresh');
    }

    function piketdownload($offset = 0, $order_column = 'id_piket', $order_type = 'asc')
    {
        $data['title'] = 'List Piket';
        // $data['user'] = $this->db->get_where('tb_pengurus', ['nama_pengurus' => $this->session->userdata('nama_pengurus')])->row_array();
        $this->load->view('templates/new_header', $data);
        $this->load->view('templates/new_sidebar');
        $this->load->view('templates/new_topbar');

        if (empty($offset)) $offset = 0;
        if (empty($order_column)) $order_column = 'id_piket';
        if (empty($order_type)) $order_type = 'asc';
        //TODO: check for valid column

        // load data
        $pikets = $this->piket_model->get_paged_list(10, $offset, $order_column, $order_type)->result();

        // generate pagination
        $this->load->library('pagination');
        $config['base_url'] = site_url('piket/index/');
        $config['total_rows'] = $this->piket_model->count_all();
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
            'Nama piket',
            'Tanggal',
            'Keterangan',
            'File',
            'Actions'
        );

        $i = 0 + (int) $offset;
        foreach ($pikets as $piket) {
            $this->table->add_row(
                ++$i,
                $piket->nama_piket,
                $piket->tgl_piket,
                $piket->ket_piket,
                $piket->file_piket,
                anchor('piket/download/' . $piket->id_piket, ' ', array('class' => 'btn btn-primary nc-icon nc-cloud-download-93', 'data-toggle' => "tooltip", 'data-placement' => "right", 'title' => "Download"))
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
        $this->load->view('piket/piketDownload', $data);
        $this->load->view('templates/new_footer');
    }

    function download($id)
    {
        // SELECT file_piket FROM tb_piket WHERE id_piket = $id
        // $this->db->select('file_piket');
        // $this->db->get('tb_piket');
        // $this->db->where('id_piket', $id); //nama file yg ingin di download

        $query = "SELECT file_piket FROM tb_piket WHERE id_piket = $id";
        // $file = $this->db->select('file_piket')
        //     ->where('id_piket', $id)
        //     ->get('tb_piket')->row()->file_piket;
        $file = $this->db->query($query)->row()->file_piket;

        $this->downloadFile($file);
    }

    function downloadFile($file)
    {
        // force_download(FCPATH . '/uploads/' . $file, NULL);
        $this->load->helper('download');
        $name = $file;
        $data = file_get_contents('./uploads/' . $file);
        force_download($name, $data);
        redirect('piket');
    }

    // validation rules
    function _set_rules()
    {
        $this->form_validation->set_rules('nama_piket', 'Nama Piket', 'required|trim');
        $this->form_validation->set_rules('tgl_piket', 'Tanggal', 'required|trim');
        $this->form_validation->set_rules('ket_piket', 'Keterangan Piket', 'required|trim');
    }
}
