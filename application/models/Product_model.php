<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Product_model
 * CRUD untuk data produk
 */
class Product_model extends CI_Model
{
    protected $table = 'products';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Ambil semua produk
     * @return array
     */
    public function getAllProducts()
    {
        return $this->db->order_by('kode_produk', 'ASC')->get($this->table)->result();
    }

    /**
     * Ambil produk berdasarkan ID
     * @param int $id
     * @return object|null
     */
    public function getProductById($id)
    {
        return $this->db->get_where($this->table, array('id' => $id))->row();
    }

    /**
     * Ambil produk berdasarkan kode
     * @param string $kode
     * @return object|null
     */
    public function getProductByKode($kode)
    {
        return $this->db->get_where($this->table, array('kode_produk' => $kode))->row();
    }

    /**
     * Tambah produk baru
     * @param array $data
     * @return bool
     */
    public function createProduct($data)
    {
        return $this->db->insert($this->table, $data);
    }

    /**
     * Update produk
     * @param int   $id
     * @param array $data
     * @return bool
     */
    public function updateProduct($id, $data)
    {
        return $this->db->update($this->table, $data, array('id' => $id));
    }

    /**
     * Hapus produk
     * @param int $id
     * @return bool
     */
    public function deleteProduct($id)
    {
        return $this->db->delete($this->table, array('id' => $id));
    }

    /**
     * Kurangi stok produk
     * @param int $product_id
     * @param int $qty
     * @return bool
     */
    public function decreaseStock($product_id, $qty)
    {
        $this->db->set('stok', 'stok - ' . (int)$qty, FALSE);
        $this->db->where('id', $product_id);
        return $this->db->update($this->table);
    }

    /**
     * Kembalikan stok produk
     * @param int $product_id
     * @param int $qty
     * @return bool
     */
    public function increaseStock($product_id, $qty)
    {
        $this->db->set('stok', 'stok + ' . (int)$qty, FALSE);
        $this->db->where('id', $product_id);
        return $this->db->update($this->table);
    }

    /**
     * Hitung total produk (untuk dashboard)
     * @return int
     */
    public function countProducts()
    {
        return $this->db->count_all($this->table);
    }
}