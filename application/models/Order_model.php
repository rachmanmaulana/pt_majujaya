<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Order_model
 * Operasi database untuk orders dan order_details
 */
class Order_model extends CI_Model
{
    protected $table        = 'orders';
    protected $table_detail = 'order_details';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Generate nomor order otomatis
     * Format: SO-YYYYMMDD-XXX
     * @return string
     */
    public function generateNoOrder()
    {
        $prefix = 'SO-' . date('Ymd') . '-';
        $this->db->like('no_order', $prefix, 'after');
        $this->db->order_by('no_order', 'DESC');
        $last = $this->db->get($this->table)->row();

        if ($last) {
            $parts  = explode('-', $last->no_order);
            $number = intval(end($parts)) + 1;
        } else {
            $number = 1;
        }
        return $prefix . str_pad($number, 3, '0', STR_PAD_LEFT);
    }

    /**
     * Ambil semua order dengan join customer dan user
     * Jika user_id diberikan, filter per sales
     * @param int|null $user_id
     * @return array
     */
    public function getAllOrders($user_id = NULL)
    {
        $this->db->select('o.*, c.nama AS nama_customer, u.nama AS nama_sales');
        $this->db->from('orders o');
        $this->db->join('customers c', 'c.id = o.customer_id');
        $this->db->join('users u', 'u.id = o.user_id');
        if ($user_id !== NULL) {
            $this->db->where('o.user_id', $user_id);
        }
        $this->db->order_by('o.created_at', 'DESC');
        return $this->db->get()->result();
    }

    /**
     * Ambil satu order by ID dengan detail join
     * @param int $id
     * @return object|null
     */
    public function getOrderById($id)
    {
        $this->db->select('o.*, c.nama AS nama_customer, c.alamat, c.telepon, u.nama AS nama_sales');
        $this->db->from('orders o');
        $this->db->join('customers c', 'c.id = o.customer_id');
        $this->db->join('users u', 'u.id = o.user_id');
        $this->db->where('o.id', $id);
        return $this->db->get()->row();
    }

    /**
     * Ambil detail item suatu order
     * @param int $order_id
     * @return array
     */
    public function getOrderDetails($order_id)
    {
        $this->db->select('od.*, p.kode_produk, p.nama_produk');
        $this->db->from('order_details od');
        $this->db->join('products p', 'p.id = od.product_id');
        $this->db->where('od.order_id', $order_id);
        return $this->db->get()->result();
    }

    /**
     * Buat order baru (header)
     * @param array $data
     * @return int  insert_id
     */
    public function createOrder($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    /**
     * Simpan satu baris order_detail
     * @param array $data
     * @return bool
     */
    public function createOrderDetail($data)
    {
        return $this->db->insert($this->table_detail, $data);
    }

    /**
     * Update total order setelah semua detail disimpan
     * @param int   $order_id
     * @param float $total
     * @return bool
     */
    public function updateTotal($order_id, $total)
    {
        return $this->db->update($this->table, array('total' => $total), array('id' => $order_id));
    }

    /**
     * Update status order
     * @param int    $order_id
     * @param string $status
     * @return bool
     */
    public function updateStatus($order_id, $status)
    {
        return $this->db->update($this->table, array('status' => $status), array('id' => $order_id));
    }

    /**
     * Hapus order beserta detailnya
     * @param int $order_id
     * @return bool
     */
    public function deleteOrder($order_id)
    {
        // detail dihapus via ON DELETE CASCADE
        return $this->db->delete($this->table, array('id' => $order_id));
    }

    /**
     * Hitung total order (untuk dashboard)
     * @param int|null $user_id  jika NULL hitung semua
     * @return int
     */
    public function countOrders($user_id = NULL)
    {
        if ($user_id) {
            $this->db->where('user_id', $user_id);
        }
        return $this->db->count_all_results($this->table);
    }

    /**
     * Hitung total revenue (untuk dashboard)
     * @return float
     */
    public function totalRevenue()
    {
        $result = $this->db->select_sum('total')
                           ->where('status', 'selesai')
                           ->get($this->table)
                           ->row();
        return $result ? $result->total : 0;
    }

    /**
     * Hitung order per status (untuk dashboard)
     * @return array
     */
    public function countByStatus()
    {
        $this->db->select('status, COUNT(*) as jumlah');
        $this->db->group_by('status');
        return $this->db->get($this->table)->result();
    }
}