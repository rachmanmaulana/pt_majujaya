<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Dashboard Controller
 * Halaman utama setelah login, berbeda konten per role
 */
class Dashboard extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('Product_model', 'Customer_model', 'Order_model'));
    }

    /**
     * Index — tampilkan dashboard sesuai role
     */
    public function index()
    {
        $this->requireLogin();

        $user = $this->session->userdata('user');
        $data = array();

        // Statistik untuk admin & manager
        $data['total_products']  = $this->Product_model->countProducts();
        $data['total_customers'] = $this->Customer_model->countCustomers();
        $data['total_revenue']   = $this->Order_model->totalRevenue();
        $data['status_counts']   = $this->Order_model->countByStatus();

        // Untuk sales: hanya order miliknya
        if ($user['role'] === 'sales') {
            $data['total_orders'] = $this->Order_model->countOrders($user['id']);
            $data['recent_orders'] = $this->Order_model->getAllOrders($user['id']);
        } else {
            $data['total_orders'] = $this->Order_model->countOrders();
            $data['recent_orders'] = $this->Order_model->getAllOrders();
        }

        // Batasi recent orders hanya 5 baris
        $data['recent_orders'] = array_slice($data['recent_orders'], 0, 5);

        $data['title'] = 'Dashboard';
        $this->loadView('dashboard/index', $data);
    }
}