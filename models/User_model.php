<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * User_model
 * Menangani semua operasi database terkait users
 */
class User_model extends CI_Model
{
    protected $table = 'users';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Cari user berdasarkan username untuk keperluan login
     * @param string $username
     * @return object|null
     */
    public function getUserByUsername($username)
    {
        return $this->db->get_where($this->table, array('username' => $username))->row();
    }

    /**
     * Ambil semua user
     * @return array
     */
    public function getAllUsers()
    {
        return $this->db->get($this->table)->result();
    }

    /**
     * Ambil user berdasarkan role sales (untuk dropdown di laporan)
     * @return array
     */
    public function getSalesUsers()
    {
        return $this->db->get_where($this->table, array('role' => 'sales'))->result();
    }

    /**
     * Ambil user berdasarkan ID
     * @param int $id
     * @return object|null
     */
    public function getUserById($id)
    {
        return $this->db->get_where($this->table, array('id' => $id))->row();
    }
}