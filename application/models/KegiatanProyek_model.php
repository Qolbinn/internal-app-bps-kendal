<?php
defined('BASEPATH') or exit('No direct script access allowed');

class KegiatanProyek_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_data($id = NULL)
    {
        if ($id === NULL) {
            $query = $this->db->get('kegiatan_proyek');
            return $query->result();
        } else {
            $query = $this->db->get_where('kegiatan_proyek', array('id' => $id));
            return $query->row();
        }
    }

    public function get_kegiatan_by_proyek($id_proyek)
    {
        $query = $this->db->get_where('kegiatan_proyek', array('id_proyek' => $id_proyek));

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }


    public function insert_data($data)
    {
        return $this->db->insert('kegiatan_proyek', $data);
    }

    public function update_data($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('kegiatan_proyek', $data);
    }

    public function delete_data($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('kegiatan_proyek');
    }
}
