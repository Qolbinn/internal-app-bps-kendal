<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Proyek_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_data($id = NULL)
    {
        if ($id === NULL) {
            $query = $this->db->get('proyek_tim');
            return $query->result();
        } else {
            $query = $this->db->get_where('proyek_tim', array('id' => $id));
            return $query->row();
        }
    }

    public function get_proyek_tim($id_tim)
    {
        $query = $this->db->get_where('proyek_tim', array('id_tim' => $id_tim));
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }

    public function insert_data($data)
    {
        if ($this->db->insert('proyek_tim', $data)) {
            return $this->db->insert_id();
        } else {
            return null;
        }
    }

    public function update_data($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('proyek_tim', $data);
    }

    public function delete_data($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('proyek_tim');
    }

    public function get_by_id($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('proyek_tim')->row();
    }
}
