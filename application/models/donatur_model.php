<?php

class donatur_model extends CI_Model
{

    private $primary_key = 'id_donatur';
    private $table_name = 'tb_donatur';

    function __construct()
    {
        parent::__construct();
    }

    public function view_by_date($date)
    {
        $this->db->where('DATE(tgl_donasi)', $date); // Tambahkan where tanggal nya

        return $this->db->get('tb_donatur')->result(); // Tampilkan data transaksi sesuai tanggal yang diinput oleh user pada filter
    }

    public function view_by_month($month, $year)
    {
        $this->db->where('MONTH(tgl_donasi)', $month); // Tambahkan where bulan
        $this->db->where('YEAR(tgl_donasi)', $year); // Tambahkan where tahun

        return $this->db->get('tb_donatur')->result(); // Tampilkan data transaksi sesuai bulan dan tahun yang diinput oleh user pada filter
    }

    public function view_by_year($year)
    {
        $this->db->where('YEAR(tgl_donasi)', $year); // Tambahkan where tahun

        return $this->db->get('tb_donatur')->result(); // Tampilkan data transaksi sesuai tahun yang diinput oleh user pada filter
    }

    public function view_all()
    {
        return $this->db->get('tb_donatur')->result(); // Tampilkan semua data transaksi
    }

    public function option_tahun()
    {
        $this->db->select('YEAR(tgl_donasi) AS tahun'); // Ambil Tahun dari field tgl_donasi
        $this->db->from('tb_donatur'); // select ke tabel transaksi
        $this->db->order_by('YEAR(tgl_donasi)'); // Urutkan berdasarkan tahun secara Ascending (ASC)
        $this->db->group_by('YEAR(tgl_donasi)'); // Group berdasarkan tahun pada field tgl_donasi

        return $this->db->get()->result(); // Ambil data pada tabel transaksi sesuai kondisi diatas
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

    function get_by_id($id_donatur)
    {
        $this->db->where($this->primary_key, $id_donatur);
        return $this->db->get($this->table_name);
    }

    function save($person)
    {
        $this->db->insert($this->table_name, $person);
        return $this->db->insert_id();
    }

    function update($id_donatur, $person)
    {
        $this->db->where($this->primary_key, $id_donatur);
        $this->db->update($this->table_name, $person);
    }

    function delete($id_donatur)
    {
        $this->db->where($this->primary_key, $id_donatur);
        $this->db->delete($this->table_name);
    }
}
