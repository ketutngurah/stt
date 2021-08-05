<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('user_model');
    }

    public function index()
    {
        $data['title'] = 'PROFIL';
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/new_header', $data);
        $this->load->view('templates/new_sidebar', $data);
        $this->load->view('templates/new_topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/new_footer');
    }

    public function edit()
    {
        $data['title'] = 'Edit Profile';
        $data['tb_user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/new_header', $data);
            $this->load->view('templates/new_sidebar', $data);
            $this->load->view('templates/new_topbar', $data);
            $this->load->view('user/edit', $data);
            $this->load->view('templates/new_footer');
        } else {

            $nama = $this->input->post('nama');
            $tgl_lahir = $this->input->post('tgl_lahir');
            $jk = $this->input->post('jk');
            $hobi = $this->input->post('hobi');
            $telp = $this->input->post('telp');
            $pekerjaan = $this->input->post('pekerjaan');
            $nama_ortu = $this->input->post('nama_ortu');
            $telp_ortu = $this->input->post('telp_ortu');

            $this->db->set('nama', $nama);
            $this->db->set('tgl_lahir', $tgl_lahir);
            $this->db->set('jk', $jk);
            $this->db->set('hobi', $hobi);
            $this->db->set('telp', $telp);
            $this->db->set('pekerjaan', $pekerjaan);
            $this->db->set('nama_ortu', $nama_ortu);
            $this->db->set('telp_ortu', $telp_ortu);

            $this->db->where('email', $this->session->userdata('email'));
            $this->db->update('tb_user');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Profil Berhasil Diubah!</div>');
            redirect('user');
        }
    }
}
