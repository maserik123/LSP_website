<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_jadwal extends CI_Model
{

    public function getAllData()
    {
        $this->datatables->select('j.id, j.id_skema, s.judul_skema, j.mulai_daftar, j.akhir_daftar, j.tanggal_pelaksanaan, j.create_date ');
        $this->datatables->from('tb_jadwal j');
        $this->datatables->join('tb_skema s', 's.id = j.id_skema', 'left');
        $this->datatables->where('status_delete = 0');
        return $this->datatables->generate();
    }

    public function getData()
    {
        $this->db->select('s.judul_skema, j.mulai_daftar, j.akhir_daftar, j.tanggal_pelaksanaan, j.create_date');
        $this->db->from('tb_jadwal j');
        $this->db->join('tb_skema s', 's.id = j.id_skema', 'left');
        $this->db->where('status_delete = 0');

        $this->db->order_by('j.id', 'desc');
        return $this->db->get()->result();
    }

    public function getDataByIdSkema($id_skema)
    {
        $this->db->select('s.judul_skema, j.id_skema, j.mulai_daftar, j.akhir_daftar, j.tanggal_pelaksanaan, j.create_date');
        $this->db->from('tb_jadwal j');
        $this->db->join('tb_skema s', 's.id = j.id_skema', 'left');
        $this->db->where('status_delete = 0');
        $this->db->where('j.id_skema', $id_skema);
        return $this->db->get()->result();
    }

    public function getDataByIdSkema1($id_skema)
    {
        $this->db->select('j.id_skema');
        $this->db->from('tb_jadwal j');
        $this->db->join('tb_skema s', 's.id = j.id_skema', 'left');
        $this->db->where('status_delete = 0');
        $this->db->where('j.id_skema', $id_skema);
        return $this->db->get()->result();
    }

    public function getMulaiJadwalByIdSkema($id_skema)
    {
        $this->db->select('mulai_daftar, akhir_daftar, tanggal_pelaksanaan');
        $this->db->from('tb_jadwal');
        $this->db->where('id_skema', $id_skema);
        return $this->db->get()->row();
    }

    public function cekByIdSkema($id_skema)
    {
        $this->db->select('id_skema');
        $this->db->from('tb_jadwal');
        $this->db->where('id_skema', $id_skema);
        return $this->db->get()->row();
    }

    public function addData($data)
    {
        $this->db->insert('tb_jadwal', $data);
        return $this->db->affected_rows() > 0 ? $this->db->insert_id() : FALSE;
    }

    public function get_by_id($id)
    {
        return $this->db->get_where('tb_jadwal ap', array('ap.id' => $id))->result();
    }

    public function getById($id)
    {
        $this->db->select('*');
        $this->db->from('tb_jadwal');
        $this->db->where('id', $id);
        return $this->db->get()->row();
    }

    public function getByIdUser($id_user)
    {
        $this->db->select('*');
        $this->db->from('tb_jadwal');
        $this->db->where('id_user', $id_user);
        return $this->db->get()->row();
    }

    function update($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('tb_jadwal', $data);
        return $this->db->affected_rows();
    }

    function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('tb_jadwal');
    }
}

/* End of file M_jadwal.php */
