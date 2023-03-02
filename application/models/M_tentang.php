<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_tentang extends CI_Model
{

    public function getAllData()
    {
        $this->datatables->select('id, judul, isi, create_date');
        $this->datatables->from('tb_tentang');
        return $this->datatables->generate();
    }

    public function getData()
    {
        $this->db->select('*');
        $this->db->from('tb_tentang');
        return $this->db->get()->result();
    }

    public function addData($data)
    {
        $this->db->insert('tb_tentang', $data);
        return $this->db->affected_rows() > 0 ? $this->db->insert_id() : FALSE;
    }

    public function get_by_id($id)
    {
        return $this->db->get_where('tb_tentang ap', array('ap.id' => $id))->result();
    }

    public function getById($id)
    {
        $this->db->select('*');
        $this->db->from('tb_tentang');
        $this->db->where('id', $id);
        return $this->db->get()->row();
    }

    public function getByIdUser($id_user)
    {
        $this->db->select('*');
        $this->db->from('tb_tentang');
        $this->db->where('id_user', $id_user);
        return $this->db->get()->row();
    }

    function update($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('tb_tentang', $data);
        return $this->db->affected_rows();
    }

    function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('tb_tentang');
    }
}

/* End of file M_jadwal.php */
