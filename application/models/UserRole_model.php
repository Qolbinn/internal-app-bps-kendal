<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UserRole_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('User_model', 'user');
    }

    public function get_data($id = NULL)
    {
        if ($id === NULL) {
            $query = $this->db->get('user_role');
            return $query->result();
        } else {
            $query = $this->db->get_where('user_role', array('id' => $id));
            return $query->row();
        }
    }

    public function get_ketua_tim($id_tim)
    {
        $this->db->select('user.nama, user.jabatan');
        $this->db->from('user');
        $this->db->join('user_role', 'user_role.id_user = user.id', 'left');
        $this->db->where('user_role.id_role', 3);
        $this->db->where('user_role.id_tim', $id_tim);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return null;
        }
    }

    public function get_list_anggota_tim($id_tim)
    {
        $this->db->select('user.id, user.nama, user.jabatan, user_role.id as user_role_id');
        $this->db->from('user');
        $this->db->join('user_role', 'user_role.id_user = user.id', 'left');
        $this->db->where('user_role.id_role', 4);
        $this->db->where('user_role.id_tim', $id_tim);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }

    public function get_list_non_anggota_tim($id_tim)
    {
        $this->db->select('user.id, user.nama, user.jabatan');
        $this->db->from('user');
        $this->db->join('user_role', 'user_role.id_user = user.id AND user_role.id_tim = ' . $id_tim, 'left');
        $this->db->where('user_role.id_user IS NULL');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }


    public function insert_data($data)
    {
        return $this->db->insert('user_role', $data);
    }

    public function update_data($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('user_role', $data);
    }

    public function delete_data($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('user_role');
    }

    public function get_list_id_anggota_tim($id_tim)
    {
        $this->db->select('id_user');
        $this->db->where('id_tim', $id_tim);
        $this->db->where('id_role', 4);

        $query = $this->db->get('user_role');

        if ($query->num_rows() > 0) {
            return array_column($query->result_array(), 'id_user');
        } else {
            return null;
        }
    }

    public function get_id_ketua_tim($id_tim)
    {
        $this->db->select('id_user');
        $this->db->where('id_tim', $id_tim);
        $this->db->where('id_role', 3);

        $query = $this->db->get('user_role');

        if ($query->num_rows() > 0) {
            return $query->row()->id_user;
        } else {
            return null;
        }
    }
}
