<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TimController extends CI_Controller
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

        $this->load->model('UserRole_model', 'user_role');
    }

    public function tambah_anggota($id_tim)
    {
        $id_pegawai = $this->input->post('id_pegawai');

        $data = array(
            'id_user' => $id_pegawai,
            'id_role' => 4,
            'id_tim' => $id_tim
        );

        // Menyimpan data ke database
        if ($this->user_role->insert_data($data)) {
            $this->session->set_flashdata('success', 'Anggota berhasil ditambahkan.');
        } else {
            $this->session->set_flashdata('warning', 'Silakan pilih anggota sebelum submit.');
        }
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function delete_anggota($id)
    {
        if ($this->user_role->delete_data($id)) {
            $this->session->set_flashdata('success', 'Anggota berhasil dihapus.');
        } else {
            $this->session->set_flashdata('warning', 'Anggota gagal dihapus');
        }
        redirect($_SERVER['HTTP_REFERER']);
    }
}
