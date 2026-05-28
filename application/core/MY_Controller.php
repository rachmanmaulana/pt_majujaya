<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * MY_Controller
 * Base controller dengan pengecekan sesi dan role
 * Semua controller extends dari class ini
 */
class MY_Controller extends CI_Controller
{
    protected $session_user = NULL;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Cek apakah user sudah login
     * Jika belum, redirect ke halaman login
     */
    protected function requireLogin()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect(base_url('auth/login'));
        }
        $this->session_user = $this->session->userdata('user');
    }

    /**
     * Cek role user
     * @param array|string $roles - role yang diizinkan
     */
    protected function requireRole($roles)
    {
        $this->requireLogin();
        if (is_string($roles)) {
            $roles = array($roles);
        }
        $user_role = $this->session->userdata('user')['role'];
        if (!in_array($user_role, $roles)) {
            $this->session->set_flashdata('error', 'Anda tidak memiliki akses ke halaman ini.');
            redirect(base_url('dashboard'));
        }
    }

    /**
     * Load view dengan layout
     * @param string $view  - nama file view
     * @param array  $data  - data yang dikirim ke view
     */
    protected function loadView($view, $data = array())
    {
        $data['session_user'] = $this->session->userdata('user');
        $this->load->view('layouts/header', $data);
        $this->load->view('layouts/sidebar', $data);
        $this->load->view($view, $data);
        $this->load->view('layouts/footer', $data);
    }
}