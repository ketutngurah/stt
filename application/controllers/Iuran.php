<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Iuran extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('table', 'form_validation'));
        $this->load->helper(array('form', 'url'));
        $this->load->model('iuran_model', '', TRUE);
    }

    public function index($offset = 0, $order_column = 'id_iuran', $order_type = 'asc')
    {
        $data['title'] = 'List Iuran';
        $this->load->view('templates/new_header', $data);
        $this->load->view('templates/new_sidebar');
        $this->load->view('templates/new_topbar');

        if (empty($offset)) $offset = 0;
        if (empty($order_column)) $order_column = 'id_iuran';
        if (empty($order_type)) $order_type = 'asc';
        //TODO: check for valid column

        // load data
        $iurans = $this->iuran_model->get_paged_list(10, $offset, $order_column, $order_type)->result();

        // generate pagination
        $this->load->library('pagination');
        $config['base_url'] = site_url('iuran/index/');
        $config['total_rows'] = $this->iuran_model->count_all();
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
            anchor('iuran/index/' . $offset . '/nama_iuran/' . $new_order, 'Nama Iuran'),
            anchor('iuran/index/' . $offset . '/tgl_iuran/' . $new_order, 'Tanggal'),
            anchor('iuran/index/' . $offset . '/ket_iuran/' . $new_order, 'Keterangan'),
            'Actions'
        );

        $i = 0 + (int) $offset;
        foreach ($iurans as $iuran) {
            $this->table->add_row(
                ++$i,
                $iuran->nama_iuran,
                $iuran->tgl_iuran,
                $iuran->ket_iuran,
                anchor('iuran/view/' . $iuran->id_iuran, ' ', array('class' => 'btn btn-warning nc-icon nc-paper', 'data-toggle' => "tooltip", 'data-placement' => "right", 'title' => "View")) . ' ' .
                    anchor('iuran/update/' . $iuran->id_iuran, ' ', array('class' => 'btn btn-success nc-icon nc-settings', 'data-toggle' => "tooltip", 'data-placement' => "right", 'title' => "Update")) . ' ' .
                    anchor('iuran/delete/' . $iuran->id_iuran, ' ', array('class' => 'btn btn-danger nc-icon nc-basket', 'data-toggle' => "tooltip", 'data-placement' => "right", 'title' => "Delete", 'onclick' => "return confirm('Apakah anda yakin ingin menghapus data iuran ini?')"))
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
        $this->load->view('iuran/iuranList', $data);
        $this->load->view('templates/new_footer');
    }

    function add()
    {
        $data['title'] = 'Tambah Iuran';
        $this->load->view('templates/new_header', $data);
        $this->load->view('templates/new_sidebar');
        $this->load->view('templates/new_topbar');

        // set common properties
        $data['action'] = site_url('iuran/add');
        $data['link_back'] = anchor('iuran/index/', 'Back to list of iurans', array('class' => 'back'));

        $this->_set_rules();

        // run validation
        if ($this->form_validation->run() === FALSE) {
            $data['message'] = '';
            // set common properties
            $data['title'] = 'Tambah Iuran Baru';
            $data['message'] = '';
            $data['iuran']['id_iuran'] = '';
            $data['iuran']['nama_iuran'] = '';
            $data['iuran']['tgl_iuran'] = '';
            $data['iuran']['ket_iuran'] = '';
            $data['link_back'] = anchor('iuran/index/', 'Lihat Daftar Iuran', array('class' => 'back'));
            $this->load->view('iuran/iuranEdit', $data);
        } else {

            // save data
            $iuran = array(
                'id_iuran' => $this->input->post('id_iuran'),
                'nama_iuran' => $this->input->post('nama_iuran'),
                'tgl_iuran' => $this->input->post('tgl_iuran'),
                'ket_iuran' => $this->input->post('ket_iuran'),
            );
            $id_iuran = $this->iuran_model->save($iuran);

            // set form input 
            $this->validation->id_iuran = $id_iuran;
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Berhasil Ditambah!</div>');
            redirect('iuran');

            redirect('iuran/index/add_success');
        }
        $this->load->view('templates/new_footer');
    }

    function view($id_iuran)
    {
        $data['title'] = 'Detail Data Iuran';
        // $data['user'] = $this->db->get_where('tb_admin', ['username' => $this->session->userdata('username')])->row_array();
        $this->load->view('templates/new_header', $data);
        $this->load->view('templates/new_sidebar');
        $this->load->view('templates/new_topbar');

        // set common properties
        $data['title'] = 'Detail Data Iuran';
        $data['link_back'] = anchor('iuran/index/', 'Daftar Iuran', array('class' => 'back'));

        // get details
        $data['iuran'] = $this->iuran_model->get_by_id($id_iuran)->row();

        // load view
        $this->load->view('iuran/iuranView', $data);
        $this->load->view('templates/new_footer');
    }

    function update($id_iuran)
    {
        $data['title'] = 'Update Data Iuran';
        $this->load->view('templates/new_header', $data);
        $this->load->view('templates/new_sidebar');
        $this->load->view('templates/new_topbar');

        // set common properties
        $data['title'] = 'Update Data Iuran';
        $this->load->library('form_validation');
        // set validation properties
        $this->_set_rules();
        $data['action'] = ('iuran/update/' . $id_iuran);

        // run validation
        if ($this->form_validation->run() === FALSE) {

            $data['message'] = '';
            $data['iuran'] = (array)$this->iuran_model->get_by_id($id_iuran)->row();

            // set common properties
            $data['title'] = 'Update Data Iuran';
            $data['message'] = '';
        } else {
            // save data
            $id_iuran = $this->input->post('id_iuran');
            $iuran = array(
                'id_iuran' => $this->input->post('id_iuran'),
                'nama_iuran' => $this->input->post('nama_iuran'),
                'tgl_iuran' => $this->input->post('tgl_iuran'),
                'ket_iuran' => $this->input->post('ket_iuran'),
            );

            $this->iuran_model->update($id_iuran, $iuran);
            $data['iuran'] = (array)$this->iuran_model->get_by_id($id_iuran)->row();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Berhasil Diubah!</div>');
            redirect('iuran');
            // set user message
            $data['message'] = 'Update Success';
        }
        $data['link_back'] = anchor('iuran/index/', 'Daftar Data Iuran', array('class' => 'back'));
        // load view
        $this->load->view('iuran/iuranEdit', $data);
        $this->load->view('templates/new_footer');
    }

    function delete($id_iuran)
    {
        // delete
        $this->iuran_model->delete($id_iuran);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Berhasil Dihapus!</div>');
        // redirect to list page
        redirect('iuran/index/delete_success', 'refresh');
    }

    // validation rules
    function _set_rules()
    {
        $this->form_validation->set_rules('nama_iuran', 'Nama Iuran', 'required|trim');
        $this->form_validation->set_rules('tgl_iuran', 'Tanggal', 'required|trim');
        $this->form_validation->set_rules('ket_iuran', 'Keterangan Iuran', 'required|trim');
    }

    function bayar_iuran($offset = 0, $order_column = 'id_iuran', $order_type = 'asc')
    {
        $data['title'] = 'List Bayar Iuran';
        $this->load->view('templates/new_header', $data);
        $this->load->view('templates/new_sidebar');
        $this->load->view('templates/new_topbar');

        if (empty($offset)) $offset = 0;
        if (empty($order_column)) $order_column = 'id_iuran';
        if (empty($order_type)) $order_type = 'asc';
        //TODO: check for valid column

        // load data
        // $iurans = $this->iuran_model->get_paged_list(10, $offset, $order_column, $order_type)->result();
        $iurans = $this->iuran_model->get_iuran()->result();
        // var_dump($iurans);
        // die;

        // generate pagination
        $this->load->library('pagination');
        $config['base_url'] = site_url('iuran/bayar_iuran/');
        $config['total_rows'] = $this->iuran_model->count_all();
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
            anchor('iuran/index/' . $offset . '/nama_iuran/' . $new_order, 'Nama Iuran'),
            anchor('iuran/index/' . $offset . '/tgl_iuran/' . $new_order, 'Tanggal'),
            anchor('iuran/index/' . $offset . '/ket_iuran/' . $new_order, 'Keterangan'),
            'Actions'
        );

        $i = 0 + (int) $offset;
        foreach ($iurans as $iuran) {
            $this->table->add_row(
                ++$i,
                $iuran->nama_iuran,
                $iuran->tgl_iuran,
                $iuran->ket_iuran,
                anchor('iuran/viewUser/' . $iuran->id_iuran, ' ', array('class' => 'btn btn-warning nc-icon nc-zoom-split', 'data-toggle' => "tooltip", 'data-placement' => "right", 'title' => "Lihat"))
            );
        }
        $data['table'] = $this->table->generate();

        // load view
        $this->load->view('iuran/iuranList', $data);
        $this->load->view('templates/new_footer');
    }

    function viewUser($id_iuran)
    {
        $data['title'] = 'Bayar Iuran';
        $this->load->view('templates/new_header', $data);
        $this->load->view('templates/new_sidebar');
        $this->load->view('templates/new_topbar');

        // get details
        $data['iuran'] = $this->iuran_model->get_by_id($id_iuran)->row();
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();

        // load view
        $this->load->view('iuran/iuranUpload', $data);
        $this->load->view('templates/new_footer');
    }

    function uploadfile()
    {

        $id_user = $this->input->post('id_user');
        $id_iuran = $this->input->post('id_iuran');
        $file_verifikasi = $_FILES['file_verifikasi']['name'];

        if ($file_verifikasi) {
            $config['allowed_types'] = 'pdf|docx|jpg|jpeg|png|gif';
            $config['upload_path'] = './uploads/';
            $config['max_size'] = '2048';

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('file_verifikasi')) {
                $upload = $this->upload->data('file_name');

                $data = array(
                    'id_user' => $id_user,
                    'id_iuran' => $id_iuran,
                    'file_verifikasi' => $upload,
                );

                $this->db->insert('tb_verifikasi', $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Foto Berhasil diupload. Tunggu Verifikasi!</div>');
                redirect('iuran/bayar_iuran');
            } else {
                // echo "image gagal di upload";
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
                redirect('iuran/bayar_iuran');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-dsnger" role="alert">Failed upload</div>');
            redirect('iuran/bayar_iuran');
        }
    }
}
