<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Customer Controller
 * CRUD pelanggan — hanya admin
 */
class Customer extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Customer_model');
        $this->load->library('form_validation');
    }

    /**
     * Daftar semua pelanggan
     */
    public function index()
    {
        $this->requireRole('admin');
        $data['customers'] = $this->Customer_model->getAllCustomers();
        $data['title']     = 'Data Pelanggan';
        $this->loadView('customer/index', $data);
    }

    /**
     * Form tambah pelanggan
     */
    public function create()
    {
        $this->requireRole('admin');
        $data['title'] = 'Tambah Pelanggan';
        $this->loadView('customer/form', $data);
    }

    /**
     * Proses simpan pelanggan
     */
    public function store()
    {
        $this->requireRole('admin');

        $this->form_validation->set_rules('nama',    'Nama',    'required|trim|max_length[150]');
        $this->form_validation->set_rules('alamat',  'Alamat',  'trim');
        $this->form_validation->set_rules('telepon', 'Telepon', 'trim|max_length[20]');

        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', validation_errors('<ul><li>', '</li></ul>'));
            redirect(base_url('customer/create'));
            return;
        }

        $data = array(
            'nama'    => $this->input->post('nama', TRUE),
            'alamat'  => $this->input->post('alamat', TRUE),
            'telepon' => $this->input->post('telepon', TRUE),
        );

        if ($this->Customer_model->createCustomer($data)) {
            $this->session->set_flashdata('success', 'Pelanggan berhasil ditambahkan.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menyimpan pelanggan.');
        }
        redirect(base_url('customer'));
    }

    /**
     * Form edit pelanggan
     * @param int $id
     */
    public function edit($id)
    {
        $this->requireRole('admin');
        $data['customer'] = $this->Customer_model->getCustomerById($id);
        if (!$data['customer']) {
            $this->session->set_flashdata('error', 'Pelanggan tidak ditemukan.');
            redirect(base_url('customer'));
            return;
        }
        $data['title'] = 'Edit Pelanggan';
        $this->loadView('customer/form', $data);
    }

    /**
     * Proses update pelanggan
     * @param int $id
     */
    public function update($id)
    {
        $this->requireRole('admin');

        $this->form_validation->set_rules('nama',    'Nama',    'required|trim|max_length[150]');
        $this->form_validation->set_rules('alamat',  'Alamat',  'trim');
        $this->form_validation->set_rules('telepon', 'Telepon', 'trim|max_length[20]');

        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', validation_errors('<ul><li>', '</li></ul>'));
            redirect(base_url('customer/edit/' . $id));
            return;
        }

        $data = array(
            'nama'    => $this->input->post('nama', TRUE),
            'alamat'  => $this->input->post('alamat', TRUE),
            'telepon' => $this->input->post('telepon', TRUE),
        );

        if ($this->Customer_model->updateCustomer($id, $data)) {
            $this->session->set_flashdata('success', 'Pelanggan berhasil diperbarui.');
        } else {
            $this->session->set_flashdata('error', 'Gagal memperbarui pelanggan.');
        }
        redirect(base_url('customer'));
    }

    /**
     * Hapus pelanggan
     * @param int $id
     */
    public function delete($id)
    {
        $this->requireRole('admin');
        if ($this->Customer_model->deleteCustomer($id)) {
            $this->session->set_flashdata('success', 'Pelanggan berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus pelanggan. Mungkin masih memiliki order.');
        }
        redirect(base_url('customer'));
    }
}