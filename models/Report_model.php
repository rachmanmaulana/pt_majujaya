<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Report_model
 * Query untuk laporan penjualan
 */
class Report_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Laporan per sales (dengan filter tanggal)
     * @param string $date_from
     * @param string $date_to
     * @param int|null $user_id
     * @return array
     */
    public function getReportBySales($date_from, $date_to, $user_id = NULL)
    {
        $this->db->select('u.nama AS nama_sales, COUNT(o.id) AS jumlah_order, SUM(o.total) AS total_penjualan');
        $this->db->from('orders o');
        $this->db->join('users u', 'u.id = o.user_id');
        $this->db->where('o.status !=', 'dibatalkan');
        $this->db->where('DATE(o.created_at) >=', $date_from);
        $this->db->where('DATE(o.created_at) <=', $date_to);
        if ($user_id) {
            $this->db->where('o.user_id', $user_id);
        }
        $this->db->group_by('o.user_id');
        $this->db->order_by('total_penjualan', 'DESC');
        return $this->db->get()->result();
    }

    /**
     * Laporan per produk (dengan filter tanggal)
     * @param string   $date_from
     * @param string   $date_to
     * @param int|null $product_id
     * @return array
     */
    public function getReportByProduct($date_from, $date_to, $product_id = NULL)
    {
        $this->db->select('p.kode_produk, p.nama_produk, SUM(od.qty) AS total_qty, SUM(od.subtotal) AS total_penjualan');
        $this->db->from('order_details od');
        $this->db->join('products p', 'p.id = od.product_id');
        $this->db->join('orders o', 'o.id = od.order_id');
        $this->db->where('o.status !=', 'dibatalkan');
        $this->db->where('DATE(o.created_at) >=', $date_from);
        $this->db->where('DATE(o.created_at) <=', $date_to);
        if ($product_id) {
            $this->db->where('od.product_id', $product_id);
        }
        $this->db->group_by('od.product_id');
        $this->db->order_by('total_penjualan', 'DESC');
        return $this->db->get()->result();
    }

    /**
     * Laporan per periode (harian dalam rentang tanggal)
     * @param string $date_from
     * @param string $date_to
     * @return array
     */
    public function getReportByPeriod($date_from, $date_to)
    {
        $this->db->select('DATE(o.created_at) AS tanggal, COUNT(o.id) AS jumlah_order, SUM(o.total) AS total_penjualan');
        $this->db->from('orders o');
        $this->db->where('o.status !=', 'dibatalkan');
        $this->db->where('DATE(o.created_at) >=', $date_from);
        $this->db->where('DATE(o.created_at) <=', $date_to);
        $this->db->group_by('DATE(o.created_at)');
        $this->db->order_by('tanggal', 'ASC');
        return $this->db->get()->result();
    }

    /**
     * Detail order untuk PDF — semua order dalam rentang tanggal
     * @param string   $date_from
     * @param string   $date_to
     * @param int|null $user_id
     * @return array
     */
    public function getOrdersForPdf($date_from, $date_to, $user_id = NULL)
    {
        $this->db->select('o.no_order, o.created_at, o.total, o.status, c.nama AS nama_customer, u.nama AS nama_sales');
        $this->db->from('orders o');
        $this->db->join('customers c', 'c.id = o.customer_id');
        $this->db->join('users u', 'u.id = o.user_id');
        $this->db->where('o.status !=', 'dibatalkan');
        $this->db->where('DATE(o.created_at) >=', $date_from);
        $this->db->where('DATE(o.created_at) <=', $date_to);
        if ($user_id) {
            $this->db->where('o.user_id', $user_id);
        }
        $this->db->order_by('o.created_at', 'ASC');
        return $this->db->get()->result();
    }
}