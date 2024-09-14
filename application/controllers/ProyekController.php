<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ProyekController extends CI_Controller
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

        $this->load->model('Proyek_model', 'proyek');
        $this->load->model('KegiatanProyek_model', 'kegiatan_proyek');
    }

    // public function tambah_proyek($id_tim)
    // {
    //     $id_master_proyek = $this->input->post('master_proyek');
    //     $nama_proyek = $this->input->post('nama_akhir_proyek');
    //     // $strategi = $this->input->post('strategi');
    //     $strategi = "Masih dummy strategi";
    //     $start_proyek = $this->input->post('start_proyek');
    //     $end_proyek = $this->input->post('end_proyek');
    //     $tahun = (new DateTime($start_proyek))->format('Y');

    //     $data_proyek = array(
    //         'nama_proyek' => $nama_proyek,
    //         'strategi' => $strategi,
    //         'start_date' => $start_proyek,
    //         'end_date' => $end_proyek,
    //         'tahun' => $tahun,
    //         'id_master_proyek' => $id_master_proyek,
    //         'id_tim' => $id_tim
    //     );

    //     $id_proyek = $this->proyek->insert_data($data_proyek);

    //     if ($id_proyek) {
    //         $kegiatanIndexArray = $this->input->post('kegiatanIndex');

    //         foreach ($kegiatanIndexArray as $index) {
    //             $id_master_kegiatan = $this->input->post('master_kegiatan-' . $index);
    //             $pic = $this->input->post('pic-' . $index);
    //             $start_kegiatan = $this->input->post('start_kegiatan-' . $index);
    //             $end_kegiatan = $this->input->post('end_kegiatan-' . $index);
    //             $indikator_kinerja = $this->input->post('indikator_kinerja-' . $index);

    //             $data_kegiatan = array(
    //                 'nama_kegiatan' => $id_master_kegiatan,
    //                 'start_date' => $start_kegiatan,
    //                 'end_date' => $end_kegiatan,
    //                 'id_proyek' => $id_proyek,
    //                 'id_master_kegiatan' => $id_master_kegiatan,
    //                 'pic' => $pic,
    //                 'id_iku' => $indikator_kinerja
    //             );

    //             // Jika gagal insert kegiatan dalam proyek
    //             if (!($this->kegiatan_proyek->insert_data($data_kegiatan))) {
    //                 if ($this->proyek->delete_data($id_proyek)) {
    //                     $this->session->set_flashdata('warning', 'Proyek Gagal ditambahkan karena gagal kegiatan');
    //                 } else {
    //                     $this->session->set_flashdata('warning', 'Gagal kegiatan dan Proyek belum terhapus juga !!!! ');
    //                 }
    //             }
    //         }
    //         $this->session->set_flashdata('success', 'Proyek berhasil ditambahkan');
    //     } else {
    //         $this->session->set_flashdata('warning', 'Proyek GAGAL ditambahkan');
    //     }
    //     redirect($_SERVER['HTTP_REFERER']);
    // }

    public function tambah_proyek($id_tim)
    {
        // Validasi input
        $this->form_validation->set_rules('master_proyek', 'Master Proyek', 'required');
        // $this->form_validation->set_rules('nama_akhir_proyek', 'Nama Proyek', 'required');
        $this->form_validation->set_rules('start_proyek', 'Start Proyek', 'required');
        $this->form_validation->set_rules('end_proyek', 'End Proyek', 'required');

        if ($this->form_validation->run() == FALSE) {
            // Jika validasi gagal
            $this->session->set_flashdata('warning', validation_errors());
            redirect($_SERVER['HTTP_REFERER']);
        }

        $id_master_proyek = $this->input->post('master_proyek');
        $nama_proyek = $this->input->post('nama_akhir_proyek');
        $strategi = "Masih dummy strategi";
        $start_proyek = $this->input->post('start_proyek');
        $end_proyek = $this->input->post('end_proyek');
        $tahun = (new DateTime($start_proyek))->format('Y');

        $data_proyek = array(
            'nama_proyek' => $nama_proyek,
            'strategi' => $strategi,
            'start_date' => $start_proyek,
            'end_date' => $end_proyek,
            'tahun' => $tahun,
            'id_master_proyek' => $id_master_proyek,
            'id_tim' => $id_tim
        );

        $id_proyek = $this->proyek->insert_data($data_proyek);

        if ($id_proyek) {
            $kegiatanIndexArray = $this->input->post('kegiatanIndex');

            foreach ($kegiatanIndexArray as $index) {
                // Validasi untuk setiap kegiatan
                $this->form_validation->set_rules('master_kegiatan-' . $index, 'Master Kegiatan ' . $index, 'required');
                $this->form_validation->set_rules('pic-' . $index, 'PIC ' . $index, 'required');
                $this->form_validation->set_rules('start_kegiatan-' . $index, 'Start Kegiatan ' . $index, 'required');
                $this->form_validation->set_rules('end_kegiatan-' . $index, 'End Kegiatan ' . $index, 'required');
                $this->form_validation->set_rules('indikator_kinerja-' . $index, 'Indikator Kinerja ' . $index, 'required');

                if ($this->form_validation->run() == FALSE) {
                    // Jika validasi gagal untuk kegiatan tertentu
                    $this->proyek->delete_data($id_proyek); // Hapus proyek yang sudah ditambahkan
                    $this->session->set_flashdata('warning', validation_errors());
                    redirect($_SERVER['HTTP_REFERER']);
                    return;
                }

                $id_master_kegiatan = $this->input->post('master_kegiatan-' . $index);
                $pic = $this->input->post('pic-' . $index);
                $start_kegiatan = $this->input->post('start_kegiatan-' . $index);
                $end_kegiatan = $this->input->post('end_kegiatan-' . $index);
                $indikator_kinerja = $this->input->post('indikator_kinerja-' . $index);

                $data_kegiatan = array(
                    'nama_kegiatan' => $id_master_kegiatan,
                    'start_date' => $start_kegiatan,
                    'end_date' => $end_kegiatan,
                    'id_proyek' => $id_proyek,
                    'id_master_kegiatan' => $id_master_kegiatan,
                    'pic' => $pic,
                    'id_iku' => $indikator_kinerja
                );

                if (!$this->kegiatan_proyek->insert_data($data_kegiatan)) {
                    // Jika gagal insert kegiatan, hapus proyek yang sudah ditambahkan
                    $this->proyek->delete_data($id_proyek);
                    $this->session->set_flashdata('warning', 'Gagal menambahkan kegiatan. Proyek telah dihapus.');
                    redirect($_SERVER['HTTP_REFERER']);
                }
            }
            $this->session->set_flashdata('success', 'Proyek berhasil ditambahkan');
        } else {
            $this->session->set_flashdata('warning', 'Proyek gagal ditambahkan');
        }

        redirect($_SERVER['HTTP_REFERER']);
    }

    public function get_data_proyek_by_id($id)
    {
        $data = $this->proyek->get_by_id($id);
        if ($data) {
            echo json_encode($data);
        } else {
            $this->session->set_flashdata('warning', 'Gagal mengambil data proyek');
        }
    }

    public function delete_proyek($id_proyek)
    {
        if ($this->proyek->delete_data($id_proyek)) {
            $this->session->set_flashdata('success', 'Proyek berhasil dihapus');
        } else {
            $this->session->set_flashdata('warning', 'Proyek gagal dihapus');
        }

        redirect($_SERVER['HTTP_REFERER']);
    }
}
