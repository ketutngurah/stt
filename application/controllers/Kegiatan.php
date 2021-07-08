<?php
defined('BASEPATH') or exit('No direct script access allowed');

class kegiatan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('table', 'form_validation'));
        $this->load->helper(array('form', 'url'));
        $this->load->model('kegiatan_model', '', TRUE);
    }

    public function index($offset = 0, $order_column = 'id_kegiatan', $order_type = 'asc')
    {
        $data['title'] = 'List Kegiatan';
        // $data['user'] = $this->db->get_where('tb_pengurus', ['nama_pengurus' => $this->session->userdata('nama_pengurus')])->row_array();
        $this->load->view('templates/new_header', $data);
        $this->load->view('templates/new_sidebar');
        $this->load->view('templates/new_topbar');

        if (empty($offset)) $offset = 0;
        if (empty($order_column)) $order_column = 'id_kegiatan';
        if (empty($order_type)) $order_type = 'asc';
        //TODO: check for valid column

        // load data
        $kegiatans = $this->kegiatan_model->get_paged_list(10, $offset, $order_column, $order_type)->result();

        // generate pagination
        $this->load->library('pagination');
        $config['base_url'] = site_url('kegiatan/index/');
        $config['total_rows'] = $this->kegiatan_model->count_all();
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
            anchor('kegiatan/index/' . $offset . '/nama_kegiatan/' . $new_order, 'Nama Kegiatan'),
            anchor('kegiatan/index/' . $offset . '/tgl_kegiatan/' . $new_order, 'Tanggal'),
            anchor('kegiatan/index/' . $offset . '/ket_kegiatan/' . $new_order, 'Keterangan'),
            anchor('kegiatan/index/' . $offset . '/file_kegiatan/' . $new_order, 'File'),
            'Actions'
        );

        $i = 0 + (int) $offset;
        foreach ($kegiatans as $kegiatan) {
            $this->table->add_row(
                ++$i,
                $kegiatan->nama_kegiatan,
                $kegiatan->tgl_kegiatan,
                $kegiatan->ket_kegiatan,
                $kegiatan->file_kegiatan,
                anchor('kegiatan/view/' . $kegiatan->id_kegiatan, 'view', array('class' => 'btn btn-warning')) . ' ' .
                    anchor('kegiatan/update/' . $kegiatan->id_kegiatan, 'update', array('class' => 'btn btn-success')) . ' ' .
                    anchor('kegiatan/delete/' . $kegiatan->id_kegiatan, 'delete', array('class' => 'btn btn-danger', 'onclick' => "return confirm('Apakah anda yakin ingin menghapus data kegiatan ini?')"))
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
        $this->load->view('kegiatan/kegiatanList', $data);
        $this->load->view('templates/new_footer');
    }

    function add()
    {
        $data['title'] = 'Tambah Kegiatan';
        // $data['user'] = $this->db->get_where('tb_admin', ['username' => $this->session->userdata('username')])->row_array();
        $this->load->view('templates/new_header', $data);
        $this->load->view('templates/new_sidebar');
        $this->load->view('templates/new_topbar');

        // set common properties
        $data['action'] = site_url('kegiatan/add');
        $data['link_back'] = anchor('kegiatan/index/', 'Back to list of kegiatans', array('class' => 'back'));

        $this->_set_rules();

        // run validation
        if ($this->form_validation->run() === FALSE) {
            $data['message'] = '';
            // set common properties
            $data['title'] = 'Tambah Kegiatan Baru';
            $data['message'] = '';
            $data['kegiatan']['id_kegiatan'] = '';
            $data['kegiatan']['nama_kegiatan'] = '';
            $data['kegiatan']['tgl_kegiatan'] = '';
            $data['kegiatan']['ket_kegiatan'] = '';
            $data['kegiatan']['file_kegiatan'] = '';
            $data['link_back'] = anchor('kegiatan/index/', 'Lihat Daftar kegiatan', array('class' => 'back'));
            $this->load->view('kegiatan/kegiatanEdit', $data);
        } else {

            $config['allowed_types'] = 'doc|docx|pdf|png|jpg|jpeg';
            $config['upload_path'] = './uploads/';
            $config['file_name'] = $_FILES['file_kegiatan']['name'];

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('file_kegiatan')) {
                $this->upload->data('file_name');
            }


            // save data
            $kegiatan = array(
                'id_kegiatan' => $this->input->post('id_kegiatan'),
                'nama_kegiatan' => $this->input->post('nama_kegiatan'),
                'tgl_kegiatan' => $this->input->post('tgl_kegiatan'),
                'ket_kegiatan' => $this->input->post('ket_kegiatan'),
                'file_kegiatan' => $_FILES['file_kegiatan']['name'],
            );
            $id_kegiatan = $this->kegiatan_model->save($kegiatan);

            // set form input 
            $this->validation->id_kegiatan = $id_kegiatan;
            redirect('kegiatan');

            redirect('kegiatan/index/add_success');
        }
        $this->load->view('templates/new_footer');
    }

    function view($id_kegiatan)
    {
        $data['title'] = 'Detail Data Kegiatan';
        // $data['user'] = $this->db->get_where('tb_admin', ['username' => $this->session->userdata('username')])->row_array();
        $this->load->view('templates/new_header', $data);
        $this->load->view('templates/new_sidebar');
        $this->load->view('templates/new_topbar');

        // set common properties
        $data['title'] = 'Detail Data Kegiatan';
        $data['link_back'] = anchor('kegiatan/index/', 'Daftar kegiatan', array('class' => 'back'));

        // get details
        $data['kegiatan'] = $this->kegiatan_model->get_by_id($id_kegiatan)->row();

        // load view
        $this->load->view('kegiatan/kegiatanView', $data);
        $this->load->view('templates/new_footer');
    }



    function update($id_kegiatan)
    {
        $data['title'] = 'Update Data Kegiatan';
        // $data['user'] = $this->db->get_where('tb_admin', ['username' => $this->session->userdata('username')])->row_array();
        $this->load->view('templates/new_header', $data);
        $this->load->view('templates/new_sidebar');
        $this->load->view('templates/new_topbar');

        // set common properties
        $data['action'] = ('kegiatan/update/' . $id_kegiatan);
        $data['link_back'] = anchor('kegiatan/index/', 'Back to list of kegiatans', array('class' => 'back'));
        $data['title'] = 'Update Data kegiatan';
        // set validation properties
        $this->_set_rules();

        // run validation
        if ($this->form_validation->run() === FALSE) {
            $data['message'] = '';
            $data['kegiatan'] = (array)$this->kegiatan_model->get_by_id($id_kegiatan)->row();

            // set common properties
            $data['title'] = 'Update Data Kegiatan';
            $data['message'] = '';
        } else {
            $config['allowed_types'] = 'doc|docx|pdf|png|jpg|jpeg';
            $config['upload_path'] = './uploads/';
            $config['file_name'] = $_FILES['file_kegiatan']['name'];

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('file_kegiatan')) {
                $this->upload->data('file_name');
            }

            // save data
            $id_kegiatan = $this->input->post('id_kegiatan');
            $kegiatan = array(
                'id_kegiatan' => $this->input->post('id_kegiatan'),
                'nama_kegiatan' => $this->input->post('nama_kegiatan'),
                'tgl_kegiatan' => $this->input->post('tgl_kegiatan'),
                'ket_kegiatan' => $this->input->post('ket_kegiatan'),
                'file_kegiatan' => $_FILES['file_kegiatan']['name'],
            );

            $id_kegiatan = $this->kegiatan_model->update($id_kegiatan, $kegiatan);
            $data['kegiatan'] = (array)$this->kegiatan_model->get_by_id($id_kegiatan)->row();

            $this->validation->id_kegiatan = $id_kegiatan;
            redirect('kegiatan');
            // set user message
            $data['message'] = 'Update Success';
        }
        $data['link_back'] = anchor('kegiatan/index/', 'Daftar Data kegiatan', array('class' => 'back'));
        // load view
        $this->load->view('kegiatan/kegiatanEdit', $data);
        $this->load->view('templates/new_footer');
    }

    function delete($id_kegiatan)
    {
        // delete
        $this->kegiatan_model->delete($id_kegiatan);
        // redirect to list page
        redirect('kegiatan/index/delete_success', 'refresh');
    }

    function kegiatandownload($offset = 0, $order_column = 'id_kegiatan', $order_type = 'asc')
    {
        $data['title'] = 'List Kegiatan';
        // $data['user'] = $this->db->get_where('tb_pengurus', ['nama_pengurus' => $this->session->userdata('nama_pengurus')])->row_array();
        $this->load->view('templates/new_header', $data);
        $this->load->view('templates/new_sidebar');
        $this->load->view('templates/new_topbar');

        if (empty($offset)) $offset = 0;
        if (empty($order_column)) $order_column = 'id_kegiatan';
        if (empty($order_type)) $order_type = 'asc';
        //TODO: check for valid column

        // load data
        $kegiatans = $this->kegiatan_model->get_paged_list(10, $offset, $order_column, $order_type)->result();

        // generate pagination
        $this->load->library('pagination');
        $config['base_url'] = site_url('kegiatan/index/');
        $config['total_rows'] = $this->kegiatan_model->count_all();
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
            anchor('kegiatan/index/' . $offset . '/nama_kegiatan/' . $new_order, 'Nama Kegiatan'),
            anchor('kegiatan/index/' . $offset . '/tgl_kegiatan/' . $new_order, 'Tanggal'),
            anchor('kegiatan/index/' . $offset . '/ket_kegiatan/' . $new_order, 'Keterangan'),
            anchor('kegiatan/index/' . $offset . '/file_kegiatan/' . $new_order, 'File'),
            'Actions'
        );

        $i = 0 + (int) $offset;
        foreach ($kegiatans as $kegiatan) {
            $this->table->add_row(
                ++$i,
                $kegiatan->nama_kegiatan,
                $kegiatan->tgl_kegiatan,
                $kegiatan->ket_kegiatan,
                $kegiatan->file_kegiatan,
                anchor('kegiatan/download/' . $kegiatan->id_kegiatan, 'download file', array('class' => 'btn btn-primary'))
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
        $this->load->view('kegiatan/kegiatanDownload', $data);
        $this->load->view('templates/new_footer');
    }

    // validation rules
    function _set_rules()
    {
        $this->form_validation->set_rules('nama_kegiatan', 'Nama Kegiatan', 'required|trim');
        $this->form_validation->set_rules('tgl_kegiatan', 'Tanggal', 'required|trim');
        $this->form_validation->set_rules('ket_kegiatan', 'Keterangan Kegiatan', 'required|trim');
    }

    function download($id)
    {
        // SELECT file_kegiatan FROM tb_kegiatan WHERE id_kegiatan = $id
        // $this->db->select('file_kegiatan');
        // $this->db->get('tb_kegiatan');
        // $this->db->where('id_kegiatan', $id); //nama file yg ingin di download

        $query = "SELECT file_kegiatan FROM tb_kegiatan WHERE id_kegiatan = $id";
        // $file = $this->db->select('file_kegiatan')
        //     ->where('id_kegiatan', $id)
        //     ->get('tb_kegiatan')->row()->file_kegiatan;
        $file = $this->db->query($query)->row()->file_kegiatan;

        $this->downloadFile($file);
    }

    function downloadFile($file)
    {
        // force_download(FCPATH . '/uploads/' . $file, NULL);
        $this->load->helper('download');
        $name = $file;
        $data = file_get_contents('./uploads/' . $file);
        force_download($name, $data);
        redirect('kegiatan');
    }
}
