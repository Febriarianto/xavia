<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Form extends CI_Controller
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
        $data_view['content'] = 'mobile/form';
        $this->load->view("mobile/part/master", $data_view);
    }
    public function getPekerjaan()
    {
        $this->db->select('keg_Id as id, keg_Nama_Paket as text');
        $this->db->from('kegiatan');
        if (isset($_POST['q'])) {
            $this->db->like('id', $this->input->post('q'));
            $this->db->or_like('nama', $this->input->post('q'));
        }
        $this->db->limit(20);
        $q = $this->db->get();
        $result = [];
        if ($q->num_rows() > 0) {
            $result['results'] = $q->result_array();
        }
        $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode($result));
    }
}
