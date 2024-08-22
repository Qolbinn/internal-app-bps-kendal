<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bidang_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_data($id = NULL)
    {
        if ($id === NULL) {
            $query = $this->db->get('bidang');
            return $query->result();
        } else {
            $query = $this->db->get_where('bidang', array('id' => $id));
            return $query->row();
        }
    }

    public function get_id_by_name($name)
    {
        $this->db->select('id');
        $query = $this->db->get_where('bidang', array('nama_bidang' => $name));

        if ($query->num_rows() > 0) {
            return $query->row()->id;
        } else {
            return null;
        }
    }


    public function insert_data($data)
    {
        return $this->db->insert('nama_tabel', $data);
    }

    public function update_data($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('nama_tabel', $data);
    }

    public function delete_data($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('nama_tabel');
    }
}
