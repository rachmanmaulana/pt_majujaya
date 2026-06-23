<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Customer_model
 * CRUD untuk data pelanggan
 */
class Customer_model extends CI_Model
{
    protected $table = 'customers';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Ambil semua pelanggan
     * @return array
     */
    public function getAllCustomers()
    {
        return $this->db->order_by('nama', 'ASC')->get($this->table)->result();
    }

    /**
     * Ambil pelanggan berdasarkan ID
     * @param int $id
     * @return object|null
     */
    public function getCustomerById($id)
    {
        return $this->db->get_where($this->table, array('id' => $id))->row();
    }

    /**
     * Tambah pelanggan baru
     * @param array $data
     * @return bool
     */
    public function createCustomer($data)
    {
        return $this->db->insert($this->table, $data);
    }

    /**
     * Update pelanggan
     * @param int   $id
     * @param array $data
     * @return bool
     */
    public function updateCustomer($id, $data)
    {
        return $this->db->update($this->table, $data, array('id' => $id));
    }

    /**
     * Hapus pelanggan
     * @param int $id
     * @return bool
     */
    public function deleteCustomer($id)
    {
        return $this->db->delete($this->table, array('id' => $id));
    }

    /**
     * Hitung total pelanggan (untuk dashboard)
     * @return int
     */
    public function countCustomers()
    {
        return $this->db->count_all($this->table);
    }
}