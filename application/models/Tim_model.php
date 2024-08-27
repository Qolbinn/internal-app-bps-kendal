<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tim_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_data($id = NULL)
    {
        if ($id === NULL) {
            $query = $this->db->get('tim');
            return $query->result();
        } else {
            $query = $this->db->get_where('tim', array('id' => $id));
            return $query->row();
        }
    }

    public function get_by_bidang($id)
    {
        $query = $this->db->get_where('tim', array('id_bidang' => $id));

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }

    public function get_by_name($name)
    {
        $query = $this->db->get_where('tim', array('nama_tim' => $name));

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return null;
        }
    }

    public function insert_data($data)
    {
        return $this->db->insert('tim', $data);
    }

    public function update_data($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('tim', $data);
    }

    public function delete_data($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('tim');
    }
}
