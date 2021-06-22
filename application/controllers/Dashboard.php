<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();


        $this->load->view('templates/new_header', $data);
        $this->load->view('templates/new_sidebar', $data);
        $this->load->view('templates/new_topbar', $data);
        $this->load->view('dashboard/index', $data);
        $this->load->view('templates/new_footer');
    }
}
