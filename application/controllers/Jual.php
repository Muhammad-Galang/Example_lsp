<?php
class Jual extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Jual_model');
        $this->load->model('Beli_model');
    }

    public function index()
    {
        $data['penjualan'] = $this->Jual_model->get_all_penjualan();
        $data['get_nama_brg'] = $this->Jual_model->get_nama_brg();
        $data['get_jual'] = $this->Jual_model->get_jual();
        $this->load->view('home/header');
        $this->load->view('jual', $data);
        $this->load->view('home/footer');
    }

    public function add_sale()
    {
        if ($this->input->post()) {
            $nofaktur = $this->Jual_model->get_jual();
            $tgl = date('Y-m-d');

            $data = array(
                'nofaktur' => $nofaktur,
                'tgl' => $tgl,
                'kode_brg' => $this->input->post('kodebrg'),
                'qty' => $this->input->post('qty')
            );

            $this->Jual_model->tambah_penjualan($data);
            $this->session->set_flashdata('success_message', 'Berhasil pembelian barang');

            redirect('jual');
        }
    }
}
