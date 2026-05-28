<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Order Controller
 * Membuat dan mengelola Sales Order
 */
class Order extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('Order_model', 'Product_model', 'Customer_model'));
        $this->load->library('form_validation');
    }

    /**
     * Daftar order
     * Admin: semua order
     * Sales: order miliknya saja
     */
    public function index()
    {
        $this->requireRole(array('admin', 'sales'));
        $user = $this->session->userdata('user');

        if ($user['role'] === 'sales') {
            $data['orders'] = $this->Order_model->getAllOrders($user['id']);
        } else {
            $data['orders'] = $this->Order_model->getAllOrders();
        }

        $data['title'] = 'Daftar Sales Order';
        $this->loadView('order/index', $data);
    }

    /**
     * Form buat order baru — hanya sales
     */
    public function create()
    {
        $this->requireRole(array('admin', 'sales'));
        $data['customers'] = $this->Customer_model->getAllCustomers();
        $data['products']  = $this->Product_model->getAllProducts();
        $data['title']     = 'Buat Sales Order';
        $this->loadView('order/form', $data);
    }

    /**
     * Proses simpan order baru
     */
    public function store()
    {
        $this->requireRole(array('admin', 'sales'));

        $customer_id = $this->input->post('customer_id');
        $catatan     = $this->input->post('catatan', TRUE);
        $product_ids = $this->input->post('product_id');   // array
        $qtys        = $this->input->post('qty');          // array

        if (empty($customer_id) || empty($product_ids)) {
            $this->session->set_flashdata('error', 'Pelanggan dan minimal 1 produk wajib dipilih.');
            redirect(base_url('order/create'));
            return;
        }

        $user = $this->session->userdata('user');

        // Header order
        $order_data = array(
            'no_order'    => $this->Order_model->generateNoOrder(),
            'customer_id' => $customer_id,
            'user_id'     => $user['id'],
            'status'      => 'draft',
            'catatan'     => $catatan,
            'total'       => 0,
        );
        $order_id = $this->Order_model->createOrder($order_data);

        if (!$order_id) {
            $this->session->set_flashdata('error', 'Gagal membuat order.');
            redirect(base_url('order/create'));
            return;
        }

        // Detail order
        $total = 0;
        foreach ($product_ids as $index => $product_id) {
            $qty     = isset($qtys[$index]) ? intval($qtys[$index]) : 1;
            $product = $this->Product_model->getProductById($product_id);

            if (!$product || $qty < 1) continue;

            $subtotal = $product->harga * $qty;
            $total   += $subtotal;

            $detail = array(
                'order_id'   => $order_id,
                'product_id' => $product_id,
                'qty'        => $qty,
                'harga'      => $product->harga,
                'subtotal'   => $subtotal,
            );
            $this->Order_model->createOrderDetail($detail);

            // Kurangi stok
            $this->Product_model->decreaseStock($product_id, $qty);
        }

        // Update total
        $this->Order_model->updateTotal($order_id, $total);

        $this->session->set_flashdata('success', 'Sales Order berhasil dibuat.');
        redirect(base_url('order'));
    }

    /**
     * Detail order
     * @param int $id
     */
    public function detail($id)
    {
        $this->requireRole(array('admin', 'sales', 'manager'));
        $user  = $this->session->userdata('user');
        $order = $this->Order_model->getOrderById($id);

        if (!$order) {
            $this->session->set_flashdata('error', 'Order tidak ditemukan.');
            redirect(base_url('order'));
            return;
        }

        // Sales hanya bisa lihat order miliknya
        if ($user['role'] === 'sales' && $order->user_id != $user['id']) {
            $this->session->set_flashdata('error', 'Anda tidak berhak melihat order ini.');
            redirect(base_url('order'));
            return;
        }

        $data['order']   = $order;
        $data['details'] = $this->Order_model->getOrderDetails($id);
        $data['title']   = 'Detail Order: ' . $order->no_order;
        $this->loadView('order/detail', $data);
    }

    /**
     * Update status order — hanya admin
     * @param int $id
     */
    public function updateStatus($id)
    {
        $this->requireRole('admin');
        $status = $this->input->post('status');
        $allowed = array('draft', 'dikirim', 'selesai', 'dibatalkan');

        if (!in_array($status, $allowed)) {
            $this->session->set_flashdata('error', 'Status tidak valid.');
            redirect(base_url('order/detail/' . $id));
            return;
        }

        // Jika dibatalkan, kembalikan stok
        if ($status === 'dibatalkan') {
            $details = $this->Order_model->getOrderDetails($id);
            foreach ($details as $d) {
                $this->Product_model->increaseStock($d->product_id, $d->qty);
            }
        }

        if ($this->Order_model->updateStatus($id, $status)) {
            $this->session->set_flashdata('success', 'Status order berhasil diperbarui.');
        } else {
            $this->session->set_flashdata('error', 'Gagal memperbarui status.');
        }
        redirect(base_url('order/detail/' . $id));
    }

    /**
     * Hapus order — hanya admin
     * @param int $id
     */
    public function delete($id)
    {
        $this->requireRole('admin');

        // Kembalikan stok sebelum hapus
        $details = $this->Order_model->getOrderDetails($id);
        foreach ($details as $d) {
            $this->Product_model->increaseStock($d->product_id, $d->qty);
        }

        if ($this->Order_model->deleteOrder($id)) {
            $this->session->set_flashdata('success', 'Order berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus order.');
        }
        redirect(base_url('order'));
    }
}