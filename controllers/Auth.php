<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Auth Controller
 * Menangani login dan logout
 */
class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('form_validation');
    }

    /**
     * Halaman login
     * GET  → tampilkan form
     * POST → proses login
     */
    public function login()
    {
        // Jika sudah login, redirect ke dashboard
        if ($this->session->userdata('logged_in')) {
            redirect(base_url('dashboard'));
        }

        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $this->_processLogin();
        } else {
            $this->load->view('auth/login');
        }
    }

    /**
     * Proses autentikasi login
     */
    private function _processLogin()
    {
        $username = $this->input->post('username', TRUE);
        $password = $this->input->post('password');

        if (empty($username) || empty($password)) {
            $this->session->set_flashdata('error', 'Username dan password wajib diisi.');
            redirect(base_url('auth/login'));
            return;
        }

        $user = $this->User_model->getUserByUsername($username);

        if (!$user) {
            $this->session->set_flashdata('error', 'Username tidak ditemukan.');
            redirect(base_url('auth/login'));
            return;
        }

        if (!password_verify($password, $user->password)) {
            $this->session->set_flashdata('error', 'Password salah.');
            redirect(base_url('auth/login'));
            return;
        }

        // Set session
        $session_data = array(
            'logged_in' => TRUE,
            'user'      => array(
                'id'       => $user->id,
                'nama'     => $user->nama,
                'username' => $user->username,
                'role'     => $user->role,
            ),
        );
        $this->session->set_userdata($session_data);
        redirect(base_url('dashboard'));
    }

    /**
     * Logout — hapus session dan redirect ke login
     */
    public function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url('auth/login'));
    }
}