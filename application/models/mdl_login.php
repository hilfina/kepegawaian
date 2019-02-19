<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_login extends CI_Model
{
	//fungsi cek session
    function logged_id()
    {
        return $this->session->userdata('myId');
    }

	//fungsi check login
    function check_login($table, $field1, $field2)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($field1);
        $this->db->where($field2);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }
    }

    function daftar($table,$data)
    {
        $query = $this->db->insert($table, $data);
        return $this->db->insert_id();// return last insert id
    }

    function getlast()
    {
        $query = $this->db->query('select max(id_karyawan) as id_karyawan from karyawan');
        return $query->result_array();
    }

    function changeActiveState($key)
    {
        $this->load->database();
        $data = array(
        'aktif' => 1
        );

        $this->db->where('id_karyawan', $key);
        $this->db->update('login', $data);

        return true;
    }
}