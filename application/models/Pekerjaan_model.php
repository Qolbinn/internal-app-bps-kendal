<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pekerjaan_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_data($id = NULL)
    {
        if ($id === NULL) {
            $query = $this->db->get('model');
            return $query->result();
        } else {
            $query = $this->db->get_where('model', array('id' => $id));
            return $query->row();
        }
    }

    public function get_pekerjaan_by_kegiatan($id_kegiatan)
    {
        $query = $this->db->get_where('pekerjaan', array('id_kegiatan' => $id_kegiatan));

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }


    public function insert_data($data)
    {
        return $this->db->insert('model', $data);
    }

    public function update_data($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('model', $data);
    }

    public function delete_data($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('model');
    }
}
