<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MasterKegiatan_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_data($id = NULL)
    {
        if ($id === NULL) {
            $query = $this->db->get('master_kegiatan');
            return $query->result();
        } else {
            $query = $this->db->get_where('master_kegiatan', array('id' => $id));
            return $query->row();
        }
    }

    public function insert_data($data)
    {
        return $this->db->insert('master_kegiatan', $data);
    }

    public function update_data($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('master_kegiatan', $data);
    }

    public function delete_data($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('master_kegiatan');
    }
}
