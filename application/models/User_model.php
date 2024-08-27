<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_data($id = NULL)
    {
        if ($id === NULL) {
            $query = $this->db->get('user');
            return $query->result();
        } else {
            $query = $this->db->get_where('user', array('id' => $id));
            return $query->row();
        }
    }

    // public function get_list_anggota($array_id)
    // {
    //     $this->db->select('nama');
    //     $this->db->where_in('id', $array_id);
    //     $query = $this->db->get('user');

    //     if ($query->num_rows() > 0) {
    //         // $result = array();
    //         // foreach ($query->result() as $row) {
    //         //     $result[] = $row->nama;
    //         // }
    //         // return $result;
    //         return $query->result();
    //     } else {
    //         return null;
    //     }
    // }


    public function insert_data($data)
    {
        return $this->db->insert('user', $data);
    }

    public function update_data($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('user', $data);
    }

    public function delete_data($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('user');
    }
}
