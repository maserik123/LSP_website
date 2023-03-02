<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_unit_kompetensi extends CI_Model
{
    public function getAllData()
    {
        $this->datatables->select('tk.id, s.judul_skema, tk.kode_unit, tk.judul_unit, tk.jenis_standar, tk.create_date');
        $this->datatables->from('tb_unit_kompetensi tk');
        $this->datatables->join('tb_skema s', 's.id = tk.id_skema', 'left');
        $this->datatables->where('tk.status_delete = 0');
        return $this->datatables->generate();
    }

    public function getDataByIdSkema($id_skema)
    {
        $this->db->select('tk.id, tk.id_skema, s.judul_skema, tk.kode_unit, tk.judul_unit, tk.jenis_standar, tk.create_date');
        $this->db->from('tb_unit_kompetensi tk');
        $this->db->join('tb_skema s', 's.id = tk.id_skema', 'left');
        $this->db->where('tk.status_delete = 0');
        $this->db->where('tk.id_skema', $id_skema);
        return $this->db->get()->result();
    }

    public function getData()
    {
        $this->db->select('tk.id, s.judul_skema, tk.kode_unit, tk.judul_unit, tk.jenis_standar, tk.create_date');
        $this->db->from('tb_unit_kompetensi tk');
        $this->db->join('tb_skema s', 's.id = tk.id_skema', 'left');
        $this->db->where('tk.status_delete = 0');
        return $this->db->get()->result();
    }

    public function addData($data)
    {
        $this->db->insert('tb_unit_kompetensi', $data);
        return $this->db->affected_rows() > 0 ? $this->db->insert_id() : FALSE;
    }

    public function get_by_id($id)
    {
        return $this->db->get_where('tb_unit_kompetensi ap', array('ap.id' => $id))->result();
    }

    public function getByIdData($id)
    {
        $this->db->select('count(id) as jumlah, judul_unit');
        $this->db->from('tb_unit_kompetensi');
        $this->db->where('id', $id);
        return $this->db->get()->row();
    }

    public function getById($id)
    {
        $this->db->select('tk.id as id_kompetensi, s.id as id_skema, s.judul_skema, tk.kode_unit, tk.judul_unit, tk.jenis_standar, tk.create_date');
        $this->db->from('tb_unit_kompetensi tk');
        $this->db->join('tb_skema s', 's.id = tk.id_skema', 'left');
        $this->db->where('tk.status_delete = 0');
        $this->db->where('tk.id', $id);
        return $this->db->get()->result();
    }

    public function getByIdUser($id_user)
    {
        $this->db->select('*');
        $this->db->from('tb_unit_kompetensi');
        $this->db->where('id_user', $id_user);
        return $this->db->get()->row();
    }

    function update($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('tb_unit_kompetensi', $data);
        return $this->db->affected_rows();
    }

    public function update_delete($id)
    {
        return $this->db->query('update tb_unit_kompetensi set status_delete = 1 where id = "' . $id . '"');
    }

    function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('tb_unit_kompetensi');
    }
}

/* End of file M_unit_kompetensi.php */
