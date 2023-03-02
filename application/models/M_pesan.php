<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_pesan extends CI_Model
{

    public function getAllData()
    {
        $this->datatables->select('id, nama, email, isi_pesan,isi_pesan');
        $this->datatables->from('tb_contact_us');
        return $this->datatables->generate();
    }

    public function getData()
    {
        $this->db->select('*');
        $this->db->from('tb_contact_us');
        return $this->db->get()->result();
    }

    public function addData($data)
    {
        $this->db->insert('tb_contact_us', $data);
        return $this->db->affected_rows() > 0 ? $this->db->insert_id() : FALSE;
    }

    public function get_by_id($id)
    {
        return $this->db->get_where('tb_contact_us ap', array('ap.id' => $id))->result();
    }

    public function getById($id)
    {
        $this->db->select('*');
        $this->db->from('tb_contact_us');
        $this->db->where('id', $id);
        return $this->db->get()->row();
    }

    function update($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('tb_contact_us', $data);
        return $this->db->affected_rows();
    }

    function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('tb_contact_us');
    }
}

/* End of file M_jadwal.php */
