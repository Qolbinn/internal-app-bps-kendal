<?php
defined('BASEPATH') or exit('No direct script access allowed');

class KegiatanController extends CI_Controller
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

        $this->load->model('KegiatanProyek_model', 'kegiatan_proyek');
        $this->load->model('Pekerjaan_model', 'pekerjaan');
    }

    public function tambah_kegiatan($id_proyek)
    {
        // Validasi input
        $this->form_validation->set_rules('master_kegiatan', 'Master Kegiatan', 'required');
        $this->form_validation->set_rules('pic_kegiatan', 'PIC Kegiatan', 'required');
        $this->form_validation->set_rules('start_kegiatan', 'Start Kegiatan', 'required');
        $this->form_validation->set_rules('end_kegiatan', 'End Kegiatan', 'required');
        $this->form_validation->set_rules('iku_kegiatan', 'IKU Kegiatan', 'required');

        if ($this->form_validation->run() == FALSE) {
            // Jika validasi gagal
            $this->session->set_flashdata('warning', validation_errors());
            redirect($_SERVER['HTTP_REFERER']);
            return;
        }

        // Proses data validasi utama
        list($id_master_kegiatan, $nama_kegiatan) = explode('|', urldecode($this->input->post('master_kegiatan')));
        $pic_kegiatan = $this->input->post('pic_kegiatan');
        $start_kegiatan = $this->input->post('start_kegiatan');
        $end_kegiatan = $this->input->post('end_kegiatan');
        $id_iku = $this->input->post('iku_kegiatan');

        $data_kegiatan = array(
            'nama_kegiatan' => $nama_kegiatan,
            'start_date' => $start_kegiatan,
            'end_date' => $end_kegiatan,
            'pic' => $pic_kegiatan,
            'id_iku' => $id_iku,
            'id_proyek' => $id_proyek,
            'id_master_kegiatan' => $id_master_kegiatan
        );

        $id_kegiatan = $this->kegiatan_proyek->insert_data($data_kegiatan);

        if ($id_kegiatan) {
            // Validasi pekerjaan
            $pekerjaanIndexArray = $this->input->post('pegawaiKegiatanIndex');

            foreach ($pekerjaanIndexArray as $index) {
                $this->form_validation->set_rules('pegawai_pekerjaan-' . $index, 'Pegawai Pekerjaan ' . $index, 'required');
                $this->form_validation->set_rules('master_satuan-' . $index, 'Master Satuan ' . $index, 'required');
                $this->form_validation->set_rules('target_pekerjaan-' . $index, 'Target Pekerjaan ' . $index, 'required');

                if ($this->form_validation->run() == FALSE) {
                    // Jika validasi gagal untuk pekerjaan tertentu
                    $this->session->set_flashdata('warning', validation_errors());
                    $this->kegiatan_proyek->delete_data($id_kegiatan); // Hapus kegiatan yang sudah ditambahkan
                    redirect($_SERVER['HTTP_REFERER']);
                }

                $pegawai = urldecode($this->input->post('pegawai_pekerjaan-' . $index));
                $id_satuan = $this->input->post('master_satuan-' . $index);
                $target = $this->input->post('target_pekerjaan-' . $index);

                $data_pekerjaan = array(
                    'pegawai' => $pegawai,
                    'target' => $target,
                    'id_satuan' => $id_satuan,
                    'id_kegiatan' => $id_kegiatan
                );

                if (!$this->pekerjaan->insert_data($data_pekerjaan)) {
                    // Jika gagal insert pekerjaan, hapus kegiatan proyek yang sudah ditambahkan
                    $this->kegiatan_proyek->delete_data($id_kegiatan);
                    $this->session->set_flashdata('warning', 'Gagal menambahkan pekerjaan. Kegiatan telah dihapus.');
                    redirect($_SERVER['HTTP_REFERER']);
                }
            }

            // Setelah berhasil menyimpan data
            $this->session->set_flashdata('success', 'Kegiatan berhasil ditambahkan');
        } else {
            // Jika gagal menyimpan kegiatan
            $this->session->set_flashdata('warning', 'Kegiatan gagal ditambahkan');
        }

        redirect($_SERVER['HTTP_REFERER']);
    }



    public function delete_kegiatan($id_kegiatan)
    {
        if ($this->kegiatan_proyek->delete_data($id_kegiatan)) {
            $this->session->set_flashdata('success', 'Kegiatan Proyek berhasil dihapus');
        } else {
            $this->session->set_flashdata('warning', 'Kegiatan Proyek gagal dihapus');
        }

        redirect($_SERVER['HTTP_REFERER']);
    }
}
