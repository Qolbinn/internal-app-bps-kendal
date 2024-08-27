<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MasterProyek_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_data($id = NULL)
    {
        if ($id === NULL) {
            $query = $this->db->get('master_proyek');
            return $query->result();
        } else {
            $query = $this->db->get_where('master_proyek', array('id' => $id));
            return $query->row();
        }
    }

    public function get_data_by_bidang($bidang)
    {
        $this->db->select("id, nama_proyek");
        $this->db->from("master_proyek");
        $this->db->where('bidang', $bidang);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }

    public function insert_data($data)
    {
        return $this->db->insert('master_proyek', $data);
    }

    public function update_data($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('master_proyek', $data);
    }

    public function delete_data($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('master_proyek');
    }
}
