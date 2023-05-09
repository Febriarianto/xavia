<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('authenticated') != TRUE) {
            redirect(base_url("auth"));
        }
    }
    public function index()
    {
        $data_view['script'] = 'mobile/dashboard/script';
        $data_view['content'] = 'mobile/dashboard/dashboard';
        $this->load->view("mobile/part/master", $data_view);
    }
}
