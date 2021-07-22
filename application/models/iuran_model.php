<?php

class iuran_model extends CI_Model
{

    private $primary_key = 'id_iuran';
    private $table_name = 'tb_iuran';

    function __construct()
    {
        parent::__construct();
    }

    function get_paged_list($limit = 10, $offset = 0, $order_column = '', $order_type = 'asc')
    {
        if (empty($order_column) || empty($order_type))
            $this->db->order_by($this->primary_key, 'asc');
        else
            $this->db->order_by($order_column, $order_type);
        return $this->db->get($this->table_name, $limit, $offset);
    }

    function count_all()
    {
        return $this->db->count_all($this->table_name);
    }

    function get_by_id($id_iuran)
    {
        $this->db->where($this->primary_key, $id_iuran);
        return $this->db->get($this->table_name);
    }

    function get_iuran()
    {
        $this->db->select('*');
        $this->db->from('tb_user');
        $this->db->join('tb_verifikasi', 'tb_user.id_user = tb_verifikasi.id_user');
        $this->db->join('tb_iuran', 'tb_iuran.id_iuran = tb_verifikasi.id_iuran');
        $this->db->where(['email' => $this->session->userdata('email'), 'status' => 0]);
        return $this->db->get();
    }

    function save($person)
    {
        $this->db->insert($this->table_name, $person);
        return $this->db->insert_id();
    }

    function update($id_iuran, $person)
    {
        $this->db->where($this->primary_key, $id_iuran);
        $this->db->update($this->table_name, $person);
    }

    function delete($id_iuran)
    {
        $this->db->where($this->primary_key, $id_iuran);
        $this->db->delete($this->table_name);
    }

    public function sudahBayar()
    {
        # code...
        $this->db->select('*');
        $this->db->from('tb_user');
        $this->db->join('tb_verifikasi', 'tb_user.id_user = tb_verifikasi.id_user');
        $this->db->join('tb_iuran', 'tb_iuran.id_iuran = tb_verifikasi.id_iuran');
        $this->db->where(['email' => $this->session->userdata('email'), 'status' => 0]);
        $this->db->group_by('tb_iuran.id_iuran');
        $this->db->order_by('tb_iuran.id_iuran', 'ASC');
        return $this->db->get();
    }
}
