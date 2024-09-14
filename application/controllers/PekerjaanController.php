<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PekerjaanController extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/userguide3/general/urls.html
     */
    public function __construct()
    {
        parent::__construct();

        $this->load->model('Pekerjaan_model', 'pekerjaan');
    }

    public function tambah_pekerjaan($id_kegiatan)
    {
        $pekerjaanIndexArray = $this->input->post('pekerjaanPegawaiIndex');

        if ($pekerjaanIndexArray) {

            foreach ($pekerjaanIndexArray as $index) {
                $this->form_validation->set_rules('pekerjaan_pegawai-' . $index, 'Pegawai Pekerjaan ' . $index, 'required');
                $this->form_validation->set_rules('pekerjaan_satuan-' . $index, 'Master Satuan ' . $index, 'required');
                $this->form_validation->set_rules('pekerjaan_target-' . $index, 'Target Pekerjaan ' . $index, 'required');

                if ($this->form_validation->run() == FALSE) {
                    // Jika validasi gagal untuk pekerjaan tertentu
                    $this->session->set_flashdata('warning', validation_errors());
                    redirect($_SERVER['HTTP_REFERER']);
                }

                $pegawai = urldecode($this->input->post('pekerjaan_pegawai-' . $index));
                $id_satuan = $this->input->post('pekerjaan_satuan-' . $index);
                $target = $this->input->post('pekerjaan_target-' . $index);

                $data_pekerjaan = array(
                    'pegawai' => $pegawai,
                    'target' => $target,
                    'id_satuan' => $id_satuan,
                    'id_kegiatan' => $id_kegiatan
                );

                if (!$this->pekerjaan->insert_data($data_pekerjaan)) {
                    $this->session->set_flashdata('warning', 'Gagal menambahkan pekerjaan');
                    redirect($_SERVER['HTTP_REFERER']);
                    return;
                }
            }

            // Setelah berhasil menyimpan data
            $this->session->set_flashdata('success', 'Pekerjaan pegawai berhasil ditambahkan');
        } else {
            // Jika gagal menyimpan kegiatan
            $this->session->set_flashdata('warning', 'Pekerjaan pegawai gagal ditambahkan');
        }

        redirect($_SERVER['HTTP_REFERER']);
    }



    public function delete_pekerjaan($id_pekerjaan)
    {
        if ($this->pekerjaan->delete_data($id_pekerjaan)) {
            $this->session->set_flashdata('success', 'Pekerjaan pegawai berhasil dihapus');
        } else {
            $this->session->set_flashdata('warning', 'Pekerjaan pegawai gagal dihapus');
        }

        redirect($_SERVER['HTTP_REFERER']);
    }

    public function edit_pekerjaan($id)
    {
        $config['upload_path']          = './bukti_pekerjaan/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 2048;
        $config['max_width']            = 1024;
        $config['max_height']           = 768;

        $this->load->library('upload', $config);

        if (! $this->upload->do_upload('file_bukti')) {
            // Handle error
            $error = $this->upload->display_errors();
            $this->session->set_flashdata('warning', $error);
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            $bukti = $this->upload->data();
            $bukti = $bukti['file_name'];

            // ambil realisasi, temp_progress, 
            $realisasi = $this->input->post('realisasi');
            $target = $this->input->post('target');
            $temp_progress = ($realisasi / $target) * 100;

            $data = [
                'status' => 'Pending',
                'temp_progress' => $temp_progress,
                'realisasi' => $realisasi,
                'bukti' => $bukti,
                'submit_date' => date('Y-m-d H:i:s')
            ];

            if ($this->pekerjaan->update_data($id, $data)) {
                $this->session->set_flashdata('success', 'Pekerjaan pegawai berhasil diedit');
            } else {
                $this->session->set_flashdata('warning', 'Pekerjaan pegawai gagal diedit');
            }
            redirect($_SERVER['HTTP_REFERER']);
        }
    }


    public function approve_pekerjaan($id)
    {
        $temp_progress = $this->input->post('temp_progress');
        $data = [
            'status' => 'Approve',
            'temp_progress' => 0,
            'progress' => $temp_progress
        ];

        if ($this->pekerjaan->update_data($id, $data)) {
            $this->session->set_flashdata('success', 'Pekerjaan pegawai berhasil disetujui');
        } else {
            $this->session->set_flashdata('warning', 'Pekerjaan pegawai gagal disetujui');
        }
        redirect($_SERVER['HTTP_REFERER']);
    }
}
