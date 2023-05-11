<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kegiatan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // $this->load->library('form_validation');
        $this->load->helper(array('form', 'url'));
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

    public function satuan()
    {
        $this->db->select('id as id, ket as nama');
        $this->db->from('satuan');
        $q = $this->db->get();
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
        }
        $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode($data));
    }

    public function save()
    {

        $jarak = $this->distHaversine($this->input->post('curLocation'), $this->input->post('pekerjaanLokasi'));

        if ($jarak < 1) {
            $status = 500;
            $messages = [];

            $this->form_validation->set_rules('tanggal', 'tanggal', 'required');
            $this->form_validation->set_rules('hari_ke', 'hari_ke', 'required');
            $this->form_validation->set_rules('minggu_ke', 'minggu_ke', 'required');
            // $this->form_validation->set_rules('pekerja[]', 'pekerja', 'required');
            // $this->form_validation->set_rules('alat[]', 'alat', 'required');
            // $this->form_validation->set_rules('material[]', 'material', 'required');
            $this->form_validation->set_rules('jam_mulai_cuaca', 'jam_mulai_cuaca', 'required');
            $this->form_validation->set_rules('jam_selesai_cuaca', 'jam_selesai_cuaca', 'required');
            $this->form_validation->set_rules('cuaca', 'cuaca', 'required');
            $this->form_validation->set_rules('jam_mulai_kerja', 'jam_mulai_kerja', 'required');
            $this->form_validation->set_rules('jam_selesai_kerja', 'jam_selesai_kerja', 'required');
            $this->form_validation->set_rules('catatan_pekerjaan', 'catatan_pekerjaan', 'required');
            // $this->form_validation->set_rules('photoFile', 'photoFile', 'required');


            $this->form_validation->set_error_delimiters('<p class="error">', '</p>');
            if ($this->form_validation->run() == FALSE) {
                $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(403)
                    ->set_output(json_encode(['error' => 'Forbidden Access', 'message' => 'Please complete field.', 'data' => $this->form_validation->error_string()]));
            } else {

                $config['upload_path']          = './upload/';
                $config['allowed_types']        = 'gif|jpg|png';
                // $config['max_size']             = 100;
                // $config['max_width']            = 1024;
                // $config['max_height']           = 768;

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('photoFile')) {
                    $error = array('error' => $this->upload->display_errors());
                } else {
                    $data =  $this->upload->data();
                    $fileName = $data['file_name'];
                }

                $insertFormHarian = [
                    'pekerjaan' => $_POST['keg_Id'],
                    'tanggal' => $_POST['tanggal'],
                    'hari_ke' => $_POST['hari_ke'],
                    'minggu_ke' => $_POST['minggu_ke'],
                    'jam_mulai_cuaca' => $_POST['jam_mulai_cuaca'],
                    'jam_selesai_cuaca' => $_POST['jam_selesai_cuaca'],
                    'cuaca' => $_POST['cuaca'],
                    'jam_mulai_kerja' => $_POST['jam_mulai_kerja'],
                    'jam_selesai_kerja' => $_POST['jam_selesai_kerja'],
                    'catatan_pekerjaan' => $_POST['catatan_pekerjaan'],
                    'foto_pekerjaan' => $fileName,
                ];

                //if($mode=='insert'){

                $iId = $this->db->insert('form_harian', $insertFormHarian);

                //simpan progress pekerja
                $pekerja = $this->input->post('pekerja');

                for ($i = 0; $i < count($pekerja['keahlian']); $i++) {
                    $this->db->insert('progress_tenaga_ahli', [
                        'tgl' => $_POST['tanggal'],
                        'progren_Keg_id' => $_POST['keg_Id'],
                        'progren_Week' => $_POST['minggu_ke'],
                        'keahlian' => $pekerja['keahlian'][$i],
                        'jml' => $pekerja['jumlah'][$i],
                    ]);
                }

                //simpan progress material

                $material = $this->input->post('material');

                for ($i = 0; $i < count($material['uraian']); $i++) {
                    $this->db->insert('progress_material', [
                        'tgl' => $_POST['tanggal'],
                        'progren_Keg_id' => $_POST['keg_Id'],
                        'progren_Week' => $_POST['minggu_ke'],
                        'material' => $material['uraian'][$i],
                        'sat' => $material['satuan'][$i],
                        'jml' => $material['jumlah'][$i],
                    ]);
                }

                //simpan progress peralatan
                $peralatan = $this->input->post('peralatan');

                for ($i = 0; $i < count($peralatan['alat']); $i++) {
                    $this->db->insert('progress_peralatan', [
                        'tgl' => $_POST['tanggal'],
                        'progren_Keg_id' => $_POST['keg_Id'],
                        'progren_Week' => $_POST['minggu_ke'],
                        'peralatan' => $peralatan['alat'][$i],
                        'jml' => $peralatan['jumlah'][$i],
                        'sat' => $peralatan['satuan'][$i],
                    ]);
                }

                //simpan uraian pekerjaan
                // $uraian = $this->input->post('uraian');

                // for ($i = 0; $i < count($uraian['alat']); $i++) {
                //     $this->db->insert('progress_peralatan', [
                //         'tgl' => $_POST['tanggal'],
                //         'progren_Keg_id' => $_POST['keg_Id'],
                //         'progren_Week' => $_POST['minggu_ke'],
                //         'peralatan' => $uraian['alat'][$i],
                //         'jml' => $uraian['jumlah'][$i],
                //         'sat' => $uraian['satuan'][$i],
                //     ]);
                // }

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
        } else {
            $this->output
                ->set_content_type('application/json')
                ->set_status_header(501)
                ->set_output(json_encode(['error' => 'Forbidden Access', 'message' => 'Please complete field.']));
        }
    }

    private function rad($x)
    {
        return $x * M_PI / 180;
    }

    private function distHaversine($coord_a, $coord_b)
    {
        # jarak kilometer dimensi (mean radius) bumi
        $R = 6371;
        $coord_a = explode(",", $coord_a);
        $coord_b = explode(",", $coord_b);
        $dLat = $this->rad(($coord_b[0]) - ($coord_a[0]));
        $dLong = $this->rad($coord_b[1] - $coord_a[1]);
        $a = sin($dLat / 2) * sin($dLat / 2) + cos($this->rad($coord_a[0])) * cos($this->rad($coord_b[0])) * sin($dLong / 2) * sin($dLong / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        $d = $R * $c;
        # hasil akhir dalam satuan kilometer
        return $d;
    }
}
