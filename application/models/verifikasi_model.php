<?php

class verifikasi_model extends CI_Model
{

    private $primary_key = 'id_verifikasi';
    private $table_name = 'tb_verifikasi';

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

    function get_by_id($id_verifikasi)
    {
        $this->db->where($this->primary_key, $id_verifikasi);
        return $this->db->get($this->table_name);
    }

    function save($person)
    {
        $this->db->insert($this->table_name, $person);
        return $this->db->insert_id();
    }

    function update($id_verifikasi, $verifikasi)
    {
        $this->db->where($this->primary_key, $id_verifikasi);
        $this->db->update($this->table_name, $verifikasi);
    }

    function delete($id_verifikasi)
    {
        $this->db->where($this->primary_key, $id_verifikasi);
        $this->db->delete($this->table_name);
    }

    function getVerfikasiJoin()
    {
        $query = "SELECT id_verifikasi, nama, nama_iuran, tb_verifikasi.status FROM tb_verifikasi 
        INNER JOIN tb_user ON tb_user.id_user = tb_verifikasi.id_user
        INNER JOIN tb_iuran ON tb_iuran.id_iuran = tb_verifikasi.id_iuran";

        return $this->db->query($query)->result();
    }

    function getVerifikasiJoinById($id_verifikasi)
    {
        $this->db->select("*");
        $this->db->from('tb_verifikasi');
        $this->db->join('tb_user', 'tb_verifikasi.id_user = tb_user.id_user');
        $this->db->join('tb_iuran', 'tb_verifikasi.id_iuran = tb_iuran.id_iuran');
        $this->db->where('tb_verifikasi.id_verifikasi', $id_verifikasi);
        return $this->db->get()->row_array();
    }
}
