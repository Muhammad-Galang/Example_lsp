<?php
class Beli_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_all_beli()
    {
        return $this->db->get('tbl_beli')->result();
    }

    public function add_pembelian($data)
    {
        // Lakukan validasi dan penambahan stok di sini
        $this->db->insert('tbl_beli', $data);
    }
    public function get_beli()
    {
        $this->db->select('RIGHT(tbl_beli.nofaktur,3) as nofaktur', FALSE);
        $this->db->order_by('nofaktur', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('tbl_beli');
        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $kode = intval($data->nofaktur) + 1;
        } else {
            $kode = 1;
        }
        $batas = str_pad($kode, 3, "0", STR_PAD_LEFT);
        $kodetampil = "BR" . $batas;
        return $kodetampil;
    }
    // Tambahkan fungsi lain sesuai kebutuhan
    public function get_nama_beli()
    {
    // Mengambil data nama barang dari tabel tbl_barang untuk digunakan dalam opsi select
        $this->db->select('kode_brg, nama');
        $query = $this->db->get('tbl_brg');
        return $query->result();
    }


}
