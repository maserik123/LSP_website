<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_unit_pertanyaan extends CI_Model
{
    public function getAllData()
    {
        $this->datatables->select('pe.id, pe.daftar_pertanyaan, e.elemen_kompetensi, pe.create_date, pe.status_delete');
        $this->datatables->from('tb_unit_pertanyaan_elemen pe');
        $this->datatables->join('tb_unit_elemen e', 'e.id = pe.id_unit_elemen', 'left');
        $this->datatables->where('pe.status_delete = 0');
        return $this->datatables->generate();
    }

    public function getData()
    {
        $this->db->select('pe.id, pe.daftar_pertanyaan, pe.id_unit_elemen, e.elemen_kompetensi, pe.create_date, pe.status_delete');
        $this->db->from('tb_unit_pertanyaan_elemen pe');
        $this->db->join('tb_unit_elemen e', 'e.id = pe.id_unit_elemen', 'left');
        $this->db->where('pe.status_delete = 0');
        return $this->db->get()->result();
    }

    public function getPertanyaanByIdUnit()
    {
        $this->db->select('*');
        $this->db->from('tb_unit_pertanyaan_elemen');
        // $this->db->where('id_unit_elemen', $id_unit);
        $this->db->group_by('id_unit_elemen');
        return $this->db->get()->result();
    }

    public function addData($data)
    {
        $this->db->insert('tb_unit_pertanyaan_elemen', $data);
        return $this->db->affected_rows() > 0 ? $this->db->insert_id() : FALSE;
    }

    public function get_by_id($id)
    {
        return $this->db->get_where('tb_unit_pertanyaan_elemen ap', array('ap.id' => $id))->result();
    }

    public function getById($id)
    {
        $this->db->select('pe.id, pe.daftar_pertanyaan, pe.id_unit_elemen, e.elemen_kompetensi, pe.create_date, pe.status_delete');
        $this->db->from('tb_unit_pertanyaan_elemen pe');
        $this->db->join('tb_unit_elemen e', 'e.id = pe.id_unit_elemen', 'left');
        $this->db->where('pe.status_delete = 0');
        $this->db->where('pe.id', $id);
        return $this->db->get()->result();
    }

    public function pertanyaanByIdSkema($id_skema)
    {
        $this->db->select('*');
        $this->db->from('tb_unit_pertanyaan_elemen');
        $this->db->where('id_skema', $id_skema);
        return $this->db->get()->result();
    }

    public function pertanyaanByIdKompetensi($id)
    {
        $this->db->select('*');
        $this->db->from('tb_unit_pertanyaan_elemen');
        $this->db->where('id_unit_kompetensi', $id);
        return $this->db->get()->result();
    }

    public function pertanyaanByIdElemen($id)
    {
        $this->db->select('*');
        $this->db->from('tb_unit_pertanyaan_elemen');
        $this->db->where('id_unit_elemen', $id);
        return $this->db->get()->result();
    }

    public function groupByPertanyaanByIdSkema($id_skema)
    {
        $this->db->select('pe.id, pe.daftar_pertanyaan, pe.id_unit_elemen, pe.id_skema, pe.id_unit_kompetensi, s.judul_skema, k.judul_unit, e.elemen_kompetensi, pe.create_date, pe.status_delete');
        $this->db->from('tb_unit_pertanyaan_elemen pe');
        $this->db->join('tb_unit_elemen e', 'e.id = pe.id_unit_elemen', 'left');
        $this->db->join('tb_unit_kompetensi k', 'k.id = pe.id_unit_kompetensi', 'left');
        $this->db->join('tb_skema s', 's.id = pe.id_skema', 'left');
        $this->db->where('pe.id_skema', $id_skema);
        $this->db->group_by('k.judul_unit');

        return $this->db->get()->result();
    }

    public function getPertanyaanByIdSkema($id_skema)
    {
        $this->db->select('pe.id, pe.daftar_pertanyaan, pe.id_unit_elemen, pe.judul_skema as skema_judul, pe.judul_unit_kompetensi, pe.judul_unit_elemen, pe.id_skema, pe.id_unit_kompetensi, s.judul_skema, k.judul_unit, e.elemen_kompetensi, pe.create_date, pe.status_delete');
        $this->db->from('tb_unit_pertanyaan_elemen pe');
        $this->db->join('tb_unit_elemen e', 'e.id = pe.id_unit_elemen', 'left');
        $this->db->join('tb_unit_kompetensi k', 'k.id = pe.id_unit_kompetensi', 'left');
        $this->db->join('tb_skema s', 's.id = pe.id_skema', 'left');
        $this->db->where('pe.id_skema', $id_skema);

        return $this->db->get()->result();
    }

    public function getGroupByPertanyaanByIdSkema($id_skema)
    {
        $this->db->select('pe.id, pe.daftar_pertanyaan, pe.id_unit_elemen, pe.id_skema, pe.id_unit_kompetensi, s.judul_skema, k.judul_unit, e.elemen_kompetensi, pe.create_date, pe.status_delete');
        $this->db->from('tb_unit_pertanyaan_elemen pe');
        $this->db->join('tb_unit_elemen e', 'e.id = pe.id_unit_elemen', 'left');
        $this->db->join('tb_unit_kompetensi k', 'k.id = pe.id_unit_kompetensi', 'left');
        $this->db->join('tb_skema s', 's.id = pe.id_skema', 'left');
        $this->db->where('pe.id_skema', $id_skema);
        $this->db->group_by('pe.id_unit_kompetensi');
        return $this->db->get()->result();
    }

    public function getGroupByUnitElementByIdSkema($id_skema)
    {
        $this->db->select('pe.id, pe.daftar_pertanyaan, pe.id_unit_elemen, pe.id_skema, pe.id_unit_kompetensi, s.judul_skema, k.judul_unit, e.elemen_kompetensi, pe.create_date, pe.status_delete');
        $this->db->from('tb_unit_pertanyaan_elemen pe');
        $this->db->join('tb_unit_elemen e', 'e.id = pe.id_unit_elemen', 'left');
        $this->db->join('tb_unit_kompetensi k', 'k.id = pe.id_unit_kompetensi', 'left');
        $this->db->join('tb_skema s', 's.id = pe.id_skema', 'left');
        $this->db->where('pe.id_skema', $id_skema);
        $this->db->group_by('pe.id_unit_elemen');
        return $this->db->get()->result();
    }

    public function getPertanyaanBySkemaId($skema_id)
    {
        $this->db->select('*');
        $this->db->from('tb_unit_pertanyaan_elemen');
        $this->db->where('id_skema', $skema_id);
        $this->db->order_by('id', 'desc');
        return $this->db->get()->result();
    }

    public function getDataById($id)
    {
        $this->db->select('*');
        $this->db->from('tb_unit_pertanyaan_elemen');
        $this->db->where('id', $id);
        return $this->db->get()->result();
    }

    function update($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('tb_unit_pertanyaan_elemen', $data);
        return $this->db->affected_rows();
    }

    public function update_delete($id)
    {
        return $this->db->query('update tb_unit_pertanyaan_elemen set status_delete = 1 where id = "' . $id . '"');
    }

    function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('tb_unit_pertanyaan_elemen');
    }
}

/* End of file M_unit_kompetensi.php */
