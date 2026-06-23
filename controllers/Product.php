<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Product Controller
 * CRUD produk — hanya admin yang boleh akses
 */
class Product extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Product_model');
        $this->load->library('form_validation');
    }

    /**
     * Daftar semua produk
     */
    public function index()
    {
        $this->requireRole('admin');
        $data['products'] = $this->Product_model->getAllProducts();
        $data['title']    = 'Data Produk';
        $this->loadView('product/index', $data);
    }

    /**
     * Form tambah produk
     */
    public function create()
    {
        $this->requireRole('admin');
        $data['title'] = 'Tambah Produk';
        $this->loadView('product/form', $data);
    }

    /**
     * Proses simpan produk baru
     */
    public function store()
    {
        $this->requireRole('admin');

        $this->form_validation->set_rules('kode_produk', 'Kode Produk', 'required|trim|max_length[20]');
        $this->form_validation->set_rules('nama_produk', 'Nama Produk', 'required|trim|max_length[150]');
        $this->form_validation->set_rules('harga',       'Harga',       'required|numeric');
        $this->form_validation->set_rules('stok',        'Stok',        'required|integer');

        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', validation_errors('<ul><li>', '</li></ul>'));
            redirect(base_url('product/create'));
            return;
        }

        // Cek duplikasi kode
        $existing = $this->Product_model->getProductByKode($this->input->post('kode_produk', TRUE));
        if ($existing) {
            $this->session->set_flashdata('error', 'Kode produk sudah digunakan.');
            redirect(base_url('product/create'));
            return;
        }

        $data = array(
            'kode_produk' => $this->input->post('kode_produk', TRUE),
            'nama_produk' => $this->input->post('nama_produk', TRUE),
            'harga'       => $this->input->post('harga'),
            'stok'        => $this->input->post('stok'),
        );

        if ($this->Product_model->createProduct($data)) {
            $this->session->set_flashdata('success', 'Produk berhasil ditambahkan.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menyimpan produk.');
        }
        redirect(base_url('product'));
    }

    /**
     * Form edit produk
     * @param int $id
     */
    public function edit($id)
    {
        $this->requireRole('admin');
        $data['product'] = $this->Product_model->getProductById($id);
        if (!$data['product']) {
            $this->session->set_flashdata('error', 'Produk tidak ditemukan.');
            redirect(base_url('product'));
            return;
        }
        $data['title'] = 'Edit Produk';
        $this->loadView('product/form', $data);
    }

    /**
     * Proses update produk
     * @param int $id
     */
    public function update($id)
    {
        $this->requireRole('admin');

        $this->form_validation->set_rules('nama_produk', 'Nama Produk', 'required|trim|max_length[150]');
        $this->form_validation->set_rules('harga',       'Harga',       'required|numeric');
        $this->form_validation->set_rules('stok',        'Stok',        'required|integer');

        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', validation_errors('<ul><li>', '</li></ul>'));
            redirect(base_url('product/edit/' . $id));
            return;
        }

        $data = array(
            'nama_produk' => $this->input->post('nama_produk', TRUE),
            'harga'       => $this->input->post('harga'),
            'stok'        => $this->input->post('stok'),
        );

        if ($this->Product_model->updateProduct($id, $data)) {
            $this->session->set_flashdata('success', 'Produk berhasil diperbarui.');
        } else {
            $this->session->set_flashdata('error', 'Gagal memperbarui produk.');
        }
        redirect(base_url('product'));
    }

    /**
     * Hapus produk
     * @param int $id
     */
    public function delete($id)
    {
        $this->requireRole('admin');
        if ($this->Product_model->deleteProduct($id)) {
            $this->session->set_flashdata('success', 'Produk berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus produk.');
        }
        redirect(base_url('product'));
    }

    /**
     * API endpoint: ambil harga produk (JSON, untuk form order)
     * @param int $id
     */
    public function getPrice($id)
    {
        $this->requireLogin();
        $product = $this->Product_model->getProductById($id);
        if ($product) {
            echo json_encode(array('status' => 'ok', 'harga' => $product->harga, 'stok' => $product->stok, 'nama' => $product->nama_produk));
        } else {
            echo json_encode(array('status' => 'error'));
        }
    }
}