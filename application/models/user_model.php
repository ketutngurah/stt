<?php
defined('BASEPATH') or exit('No direct script access allowed');


class user_model extends CI_Model
{
    public function user()
    {
        return $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
    }

    function countAllAnggota()
    {
        return $this->db->count_all('tb_user');
    }
}
