<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_unit_element extends CI_Model
{
    public function getAllData()
    {
        $this->datatables->select('te.id, te.elemen_kompetensi, tk.judul_unit, te.create_date, te.status_delete');
        $this->datatables->from('tb_unit_elemen te');
        $this->datatables->join('tb_unit_kompetensi tk', 'tk.id = te.id_unit_kompetensi', 'left');
        $this->datatables->where('te.status_delete = 0');
        return $this->datatables->generate();
    }

    public function getDataByIdKompetensi($id_kompetensi)
    {
        $this->db->select('e.id, e.elemen_kompetensi, k.judul_unit, e.id_unit_kompetensi, e.create_date, e.status_delete');
        $this->db->from('tb_unit_elemen e');
        $this->db->join('tb_unit_kompetensi k', 'k.id = e.id_unit_kompetensi', 'left');
        $this->db->where('e.id_unit_kompetensi', $id_kompetensi);
        $this->db->where('e.status_delete = 0');
        return $this->db->get()->result();
    }

    public function getData()
    {
        $this->db->select('*');
        $this->db->from('tb_unit_elemen');
        $this->db->order_by('id', 'desc');
        $this->db->where('status_delete = 0');
        return $this->db->get()->result();
    }

    public function addData($data)
    {
        $this->db->insert('tb_unit_elemen', $data);
        return $this->db->affected_rows() > 0 ? $this->db->insert_id() : FALSE;
    }

    public function get_by_id($id)
    {
        return $this->db->get_where('tb_unit_elemen ap', array('ap.id' => $id))->result();
    }

    public function getById($id)
    {
        $this->db->select('*');
        $this->db->from('tb_unit_elemen');
        $this->db->where('id', $id);
        $this->db->where('status_delete = 0');
        return $this->db->get()->row();
    }

    function update($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('tb_unit_elemen', $data);
        return $this->db->affected_rows();
    }

    public function update_delete($id)
    {
        return $this->db->query('update tb_unit_elemen set status_delete = 1 where id = "' . $id . '"');
    }

    function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('tb_unit_elemen');
    }
}

/* End of file M_unit_element.php */
