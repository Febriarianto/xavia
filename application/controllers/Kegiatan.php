<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kegiatan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // $this->load->library('form_validation');
        if ($this->session->userdata('authenticated') != TRUE) {
            redirect(base_url("auth"));
        }
    }
    public function index()
    {
        $data_view['content'] = 'mobile/kegiatan/list';
        $data_view['script'] = 'mobile/kegiatan/script';
        $this->load->view("mobile/part/master", $data_view);
    }

    public function getList()
    {
        $nama = $this->input->post("nama");
        // var_dump($nama);
        $this->db->select('keg_Id , keg_Nama_Paket, keg_No_Kontrak , keg_Tahun_Anggaran');
        $this->db->from('kegiatan');
        if ($nama == "") {
        } else {
            $this->db->like('keg_Nama_Paket', $nama);
        }
        $q = $this->db->get();
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
        }
        $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode($data));
    }

    public function progress($id_kegiatan)
    {
        $kegiatan_q = $this->db->get_where('kegiatan', ['keg_Id' => $id_kegiatan]);
        if ($kegiatan_q->num_rows() <= 0) {
            show_404();
        }
        $kegiatan = $kegiatan_q->row();

        $data_view['kegiatan'] = $kegiatan;
        $data_view['content'] = 'mobile/progress/progress';
        $data_view['script'] = 'mobile/progress/script';
        $this->load->view("mobile/part/master", $data_view);
    }
}
