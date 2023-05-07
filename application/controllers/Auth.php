<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_mobile');
    }

    public function index()
    {
        if ($this->session->userdata('authenticated')) {
            redirect('Dashboard');
        } // Jika user sudah login (Session authenticated ditemukan)

        // function render_login tersebut dari file core/MY_Controller.php
        $this->load->view("mobile/login");
    }

    public function login()
    {
        $username = $this->input->post('username'); // Ambil isi dari inputan username pada form login
        $password = $this->input->post('password'); // Ambil isi dari inputan password pada form login dan encrypt dengan md5

        $user = $this->User_mobile->get($username); // Panggil fungsi get yang ada di UserModel.php

        if (empty($user)) { // Jika hasilnya kosong / user tidak ditemukan
            $this->session->set_flashdata('fail', 'Username tidak ditemukan'); // Buat session flashdata
            redirect('/'); // Redirect ke halaman login
        } else {
            if (password_verify($password, $user->user_Password)) { // Jika password yang diinput sama dengan password yang didatabase
                $session = array(
                    'authenticated' => true, // Buat session authenticated dengan value true
                    'id_admin' => $username,  // Buat session username
                    'username' => $username,  // Buat session username
                    'nama' => "users input", // Buat session nama
                    'id_sup' => ""
                );

                $this->session->set_userdata($session); // Buat session sesuai $session
                redirect('dashboard');
            } else {
                $this->session->set_flashdata('fail', 'Password salah'); // Buat session flashdata
                redirect('/'); // Redirect ke halaman login
            }
        }
    }

    public function logout()
    {
        $this->session->sess_destroy(); // Hapus semua session
        redirect('auth'); // Redirect ke halaman login
    }
}
