<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
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

    // public function edit()
    // {
    //     $data['title'] = 'Edit Profile';
    //     $data['user'] = $this->db->get_where('tb_admin', ['username' => $this->session->userdata('username')])->row_array();

    //     $this->form_validation->set_rules('nama_admin', 'Nama Lengkap', 'required|trim');

    //     if ($this->form_validation->run() == false) {
    //         $this->load->view('templates/header', $data);
    //         $this->load->view('templates/sidebar', $data);
    //         $this->load->view('templates/topbar', $data);
    //         $this->load->view('user/edit', $data);
    //         $this->load->view('templates/footer');
    //     } else {
    //         $nama_admin = $this->input->post('nama_admin');
    //         $username = $this->input->post('username');

    //         $this->db->set('nama_admin', $nama_admin);
    //         $this->db->where('username', $username);
    //         $this->db->update('tb_admin');

    //         $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
    //         Your profile has been updated!</div>');
    //         redirect('user');
    //     }
    // }
}
