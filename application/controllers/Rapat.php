<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rapat extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('table', 'form_validation'));
        $this->load->helper(array('form', 'url'));
        $this->load->model('rapat_model', '', TRUE);
    }

    public function index($offset = 0, $order_column = 'id_rapat', $order_type = 'asc')
    {
        $data['title'] = 'List Rapat';
        $this->load->view('templates/new_header', $data);
        $this->load->view('templates/new_sidebar');
        $this->load->view('templates/new_topbar');

        if (empty($offset)) $offset = 0;
        if (empty($order_column)) $order_column = 'id_rapat';
        if (empty($order_type)) $order_type = 'asc';
        //TODO: check for valid column

        // load data
        $rapats = $this->rapat_model->get_paged_list(10, $offset, $order_column, $order_type)->result();

        // generate pagination
        $this->load->library('pagination');
        $config['base_url'] = site_url('rapat/index/');
        $config['total_rows'] = $this->rapat_model->count_all();
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
            anchor('rapat/index/' . $offset . '/nama_rapat/' . $new_order, 'Nama Rapat'),
            anchor('rapat/index/' . $offset . '/tgl_rapat/' . $new_order, 'Tanggal'),
            anchor('rapat/index/' . $offset . '/ket_rapat/' . $new_order, 'Keterangan'),
            anchor('rapat/index/' . $offset . '/file_rapat/' . $new_order, 'File'),
            'Actions'
        );

        $i = 0 + (int) $offset;
        foreach ($rapats as $rapat) {
            $this->table->add_row(
                ++$i,
                $rapat->nama_rapat,
                $rapat->tgl_rapat,
                $rapat->ket_rapat,
                $rapat->file_rapat,
                anchor('rapat/view/' . $rapat->id_rapat, ' ', array('class' => 'btn btn-warning nc-icon nc-paper', 'data-toggle' => "tooltip", 'data-placement' => "right", 'title' => "View")) . ' ' .
                    anchor('rapat/update/' . $rapat->id_rapat, ' ', array('class' => 'btn btn-success nc-icon nc-settings', 'data-toggle' => "tooltip", 'data-placement' => "right", 'title' => "Update")) . ' ' .
                    anchor('rapat/delete/' . $rapat->id_rapat, ' ', array('class' => 'btn btn-danger nc-icon nc-basket', 'data-toggle' => "tooltip", 'data-placement' => "right", 'title' => "Delete", 'onclick' => "return confirm('Apakah anda yakin ingin menghapus data rapat ini?')"))
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
        $this->load->view('rapat/rapatList', $data);
        $this->load->view('templates/new_footer');
    }

    function add()
    {
        $data['title'] = 'Tambah Rapat';
        $this->load->view('templates/new_header', $data);
        $this->load->view('templates/new_sidebar');
        $this->load->view('templates/new_topbar');

        // set common properties
        $data['action'] = site_url('rapat/add');
        $data['link_back'] = anchor('rapat/index/', 'Back to list of rapats', array('class' => 'back'));

        $this->_set_rules();

        // run validation
        if ($this->form_validation->run() === FALSE) {
            $data['message'] = '';
            // set common properties
            $data['title'] = 'Tambah Rapat Baru';
            $data['message'] = '';
            $data['rapat']['id_rapat'] = '';
            $data['rapat']['nama_rapat'] = '';
            $data['rapat']['tgl_rapat'] = '';
            $data['rapat']['ket_rapat'] = '';
            $data['rapat']['file_rapat'] = '';
            $data['link_back'] = anchor('rapat/index/', 'Lihat Daftar Rapat', array('class' => 'back'));
            $this->load->view('rapat/rapatEdit', $data);
        } else {

            $config['allowed_types'] = 'doc|docx|pdf|png|jpg|jpeg';
            $config['upload_path'] = './uploads/';
            $config['file_name'] = $_FILES['file_rapat']['name'];

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('file_rapat')) {
                $this->upload->data('file_name');
            }


            // save data
            $rapat = array(
                'id_rapat' => $this->input->post('id_rapat'),
                'nama_rapat' => $this->input->post('nama_rapat'),
                'tgl_rapat' => $this->input->post('tgl_rapat'),
                'ket_rapat' => $this->input->post('ket_rapat'),
                'file_rapat' => $_FILES['file_rapat']['name'],
            );
            $id_rapat = $this->rapat_model->save($rapat);

            // set form input 
            $this->validation->id_rapat = $id_rapat;
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Berhasil Ditambah!</div>');
            redirect('rapat');
            redirect('rapat/index/add_success');
        }
        $this->load->view('templates/new_footer');
    }

    function view($id_rapat)
    {
        $data['title'] = 'Detail Data Rapat';
        $this->load->view('templates/new_header', $data);
        $this->load->view('templates/new_sidebar');
        $this->load->view('templates/new_topbar');

        // set common properties
        $data['title'] = 'Detail Data Rapat';
        $data['link_back'] = anchor('rapat/index/', 'Daftar rapat', array('class' => 'back'));

        // get details
        $data['rapat'] = $this->rapat_model->get_by_id($id_rapat)->row();

        // load view
        $this->load->view('rapat/rapatView', $data);
        $this->load->view('templates/new_footer');
    }

    function update($id_rapat)
    {
        $data['title'] = 'Update Data Rapat';
        $this->load->view('templates/new_header', $data);
        $this->load->view('templates/new_sidebar');
        $this->load->view('templates/new_topbar');

        // set common properties
        $data['action'] = ('rapat/update/' . $id_rapat);
        $data['link_back'] = anchor('rapat/index/', 'Back to list of rapats', array('class' => 'back'));
        $data['title'] = 'Update Data Rapat';
        // set validation properties
        $this->_set_rules();

        // run validation
        if ($this->form_validation->run() === FALSE) {
            $data['message'] = '';
            $data['rapat'] = (array)$this->rapat_model->get_by_id($id_rapat)->row();

            // set common properties
            $data['title'] = 'Update Data Rapat';
            $data['message'] = '';
        } else {
            $config['allowed_types'] = 'doc|docx|pdf|png|jpg|jpeg';
            $config['upload_path'] = './uploads/';
            $config['file_name'] = $_FILES['file_rapat']['name'];

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('file_rapat')) {
                $this->upload->data('file_name');
                $id_rapat = $this->input->post('id_rapat');
                $rapat = array(
                    'id_rapat' => $this->input->post('id_rapat'),
                    'nama_rapat' => $this->input->post('nama_rapat'),
                    'tgl_rapat' => $this->input->post('tgl_rapat'),
                    'ket_rapat' => $this->input->post('ket_rapat'),
                    'file_rapat' => $_FILES['file_rapat']['name'],
                );

                $id_rapat = $this->rapat_model->update($id_rapat, $rapat);
                $data['rapat'] = (array)$this->rapat_model->get_by_id($id_rapat)->row();

                $this->validation->id_rapat = $id_rapat;
                redirect('rapat');
                // set user message
                $data['message'] = 'Update Success';
            } else {
                $id_rapat = $this->input->post('id_rapat');
                $rapat = array(
                    'id_rapat' => $this->input->post('id_rapat'),
                    'nama_rapat' => $this->input->post('nama_rapat'),
                    'tgl_rapat' => $this->input->post('tgl_rapat'),
                    'ket_rapat' => $this->input->post('ket_rapat'),
                );

                $id_rapat = $this->rapat_model->update($id_rapat, $rapat);
                $data['rapat'] = (array)$this->rapat_model->get_by_id($id_rapat)->row();

                $this->validation->id_rapat = $id_rapat;
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Berhasil Diubah!</div>');
                redirect('rapat');
                // set user message
                $data['message'] = 'Update Success';
            }
        }
        $data['link_back'] = anchor('rapat/index/', 'Daftar Data Rapat', array('class' => 'back'));
        // load view
        $this->load->view('rapat/rapatEdit', $data);
        $this->load->view('templates/new_footer');
    }

    function delete($id_rapat)
    {
        // delete
        $this->rapat_model->delete($id_rapat);
        // redirect to list page
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Berhasil Dihapus!</div>');
        redirect('rapat/index/delete_success', 'refresh');
    }

    function rapatdownload($offset = 0, $order_column = 'id_rapat', $order_type = 'asc')
    {
        $data['title'] = 'List Rapat';
        // $data['user'] = $this->db->get_where('tb_pengurus', ['nama_pengurus' => $this->session->userdata('nama_pengurus')])->row_array();
        $this->load->view('templates/new_header', $data);
        $this->load->view('templates/new_sidebar');
        $this->load->view('templates/new_topbar');

        if (empty($offset)) $offset = 0;
        if (empty($order_column)) $order_column = 'id_rapat';
        if (empty($order_type)) $order_type = 'asc';
        //TODO: check for valid column

        // load data
        $rapats = $this->rapat_model->get_paged_list(10, $offset, $order_column, $order_type)->result();

        // generate pagination
        $this->load->library('pagination');
        $config['base_url'] = site_url('rapat/index/');
        $config['total_rows'] = $this->rapat_model->count_all();
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
            anchor('rapat/index/' . $offset . '/nama_rapat/' . $new_order, 'Nama Rapat'),
            anchor('rapat/index/' . $offset . '/tgl_rapat/' . $new_order, 'Tanggal'),
            anchor('rapat/index/' . $offset . '/ket_rapat/' . $new_order, 'Keterangan'),
            anchor('rapat/index/' . $offset . '/file_rapat/' . $new_order, 'File'),
            'Actions'
        );

        $i = 0 + (int) $offset;
        foreach ($rapats as $rapat) {
            $this->table->add_row(
                ++$i,
                $rapat->nama_rapat,
                $rapat->tgl_rapat,
                $rapat->ket_rapat,
                $rapat->file_rapat,
                anchor('rapat/download/' . $rapat->id_rapat, ' ', array('class' => 'btn btn-primary nc-icon nc-cloud-download-93', 'data-toggle' => "tooltip", 'data-placement' => "right", 'title' => "View", 'data-toggle' => "tooltip", 'data-placement' => "right", 'title' => "Download File"))
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
        $this->load->view('rapat/rapatDownload', $data);
        $this->load->view('templates/new_footer');
    }

    function download($id)
    {
        // SELECT file_rapat FROM tb_rapat WHERE id_rapat = $id
        // $this->db->select('file_rapat');
        // $this->db->get('tb_rapat');
        // $this->db->where('id_rapat', $id); //nama file yg ingin di download

        $query = "SELECT file_rapat FROM tb_rapat WHERE id_rapat = $id";
        // $file = $this->db->select('file_rapat')
        //     ->where('id_rapat', $id)
        //     ->get('tb_rapat')->row()->file_rapat;
        $file = $this->db->query($query)->row()->file_rapat;

        $this->downloadFile($file);
    }

    function downloadFile($file)
    {
        // force_download(FCPATH . '/uploads/' . $file, NULL);
        $this->load->helper('download');
        $name = $file;
        $data = file_get_contents('./uploads/' . $file);
        force_download($name, $data);
        redirect('rapat');
    }

    // validation rules
    function _set_rules()
    {
        $this->form_validation->set_rules('nama_rapat', 'Nama Rapat', 'required|trim');
        $this->form_validation->set_rules('tgl_rapat', 'Tanggal', 'required|trim');
        $this->form_validation->set_rules('ket_rapat', 'Keterangan Rapat', 'required|trim');
    }
}
