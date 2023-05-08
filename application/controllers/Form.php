<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Form extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
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

    public function save()
    {
        $status = 500;
        $messages = [];

        $this->form_validation->set_rules('pekerjaan', 'pekerjaan', 'required');
        $this->form_validation->set_rules('lokasi_pekerjaan', 'lokasi_pekerjaan', 'required');
        $this->form_validation->set_rules('tahun_anggaran', 'tahun_anggaran', 'required');
        $this->form_validation->set_rules('tanggal', 'tanggal', 'required');
        $this->form_validation->set_rules('hari_ke', 'hari_ke', 'required');
        $this->form_validation->set_rules('minggu_ke', 'minggu_ke', 'required');
        $this->form_validation->set_rules('no_tenaga_kerja', 'no_tenaga_kerja', 'required');
        $this->form_validation->set_rules('keahlian', 'keahlian', 'required');
        $this->form_validation->set_rules('jumlah', 'jumlah', 'required');
        $this->form_validation->set_rules('no_material', 'no_material', 'required');
        $this->form_validation->set_rules('uraian_material', 'uraian_material', 'required');
        $this->form_validation->set_rules('satuan_material', 'satuan_material', 'required');
        $this->form_validation->set_rules('jumlah_material', 'jumlah_material', 'required');
        $this->form_validation->set_rules('no_alat', 'no_alat', 'required');
        $this->form_validation->set_rules('alat', 'alat', 'required');
        $this->form_validation->set_rules('satuan_alat', 'satuan_alat', 'required');
        $this->form_validation->set_rules('jumlah_alat', 'jumlah_alat', 'required');
        $this->form_validation->set_rules('no_uraian_pekerjaan', 'no_uraian_pekerjaan', 'required');
        $this->form_validation->set_rules('uraian_pekerjaan', 'uraian_pekerjaan', 'required');
        $this->form_validation->set_rules('satuan_uraian_pekerjaan', 'satuan_uraian_pekerjaan', 'required');
        $this->form_validation->set_rules('volume_uraian_pekerjaan', 'volume_uraian_pekerjaan', 'required');
        $this->form_validation->set_rules('jam_mulai_cuaca', 'jam_mulai_cuaca', 'required');
        $this->form_validation->set_rules('jam_selesai_cuaca', 'jam_selesai_cuaca', 'required');
        $this->form_validation->set_rules('cuaca', 'cuaca', 'required');
        $this->form_validation->set_rules('jam_mulai_kerja', 'jam_mulai_kerja', 'required');
        $this->form_validation->set_rules('jam_selesai_kerja', 'jam_selesai_kerja', 'required');
        $this->form_validation->set_rules('catatan_pekerjaan', 'catatan_pekerjaan', 'required');
        // $this->form_validation->set_rules('foto_pekerjaan', 'foto_pekerjaan', 'required');


        $this->form_validation->set_error_delimiters('<p class="error">', '</p>');
        if ($this->form_validation->run() == FALSE) {
            $this->output
                ->set_content_type('application/json')
                ->set_status_header(403)
                ->set_output(json_encode(['error' => 'Forbidden Access', 'message' => 'Please complete field.', 'data' => $this->form_validation->error_string()]));
        } else {
            $mode = isset($_POST['mode']) && !empty($_POST['mode']) ? $this->input->post('mode') : 'insert';

            $insert = [
                'pekerjaan' => $_POST['pekerjaan'],
                'lokasi_pekerjaan' => $_POST['lokasi_pekerjaan'],
                'tahun_anggaran' => $_POST['tahun_anggaran'],
                'tanggal' => $_POST['tanggal'],
                'hari_ke' => $_POST['hari_ke'],
                'minggu_ke' => $_POST['minggu_ke'],
                'no_tenaga_kerja' => $_POST['no_tenaga_kerja'],
                'keahlian' => $_POST['keahlian'],
                'jumlah' => $_POST['jumlah'],
                'no_material' => $_POST['no_material'],
                'uraian_material' => $_POST['uraian_material'],
                'satuan_material' => $_POST['satuan_material'],
                'jumlah_material' => $_POST['jumlah_material'],
                'no_alat' => $_POST['no_alat'],
                'alat' => $_POST['alat'],
                'satuan_alat' => $_POST['satuan_alat'],
                'jumlah_alat' => $_POST['jumlah_alat'],
                'no_uraian_pekerjaan' => $_POST['no_uraian_pekerjaan'],
                'uraian_pekerjaan' => $_POST['uraian_pekerjaan'],
                'satuan_uraian_pekerjaan' => $_POST['satuan_uraian_pekerjaan'],
                'volume_uraian_pekerjaan' => $_POST['volume_uraian_pekerjaan'],
                'jam_mulai_cuaca' => $_POST['jam_mulai_cuaca'],
                'jam_selesai_cuaca' => $_POST['jam_selesai_cuaca'],
                'cuaca' => $_POST['cuaca'],
                'jam_mulai_kerja' => $_POST['jam_mulai_kerja'],
                'jam_selesai_kerja' => $_POST['jam_selesai_kerja'],
                'catatan_pekerjaan' => $_POST['catatan_pekerjaan'],
                'foto_pekerjaan' => $_POST['foto_pekerjaan'],

            ];
            //if($mode=='insert'){

            $iId = $this->db->insert('form_harian', $insert);

            if ($iId == FALSE) {
                $status = 401;
                $messages = ['error' => 'Cannot create', 'message' => 'Gagal menyimpan data'];
            } else {
                $status = 201;
                $messages = ['message' => 'Data berhasil disimpan.', 'ID' => $iId];
            }
            $this->output
                ->set_content_type('application/json')
                ->set_status_header($status)
                ->set_output(json_encode($messages));
        }
    }

    public function setPekerjaan($id)
    {
        // $id =  $_POST['id'];
        $this->db->select('*');
        $this->db->from('kegiatan');
        $this->db->where('keg_Id', $id);
        $q = $this->db->get();
        $result = [];
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
        }
        $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode($data));
    }
}
