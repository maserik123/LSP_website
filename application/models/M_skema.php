<?php

/** 
 * @Author: Fitra Arrafiq
 * @Date: 2020-12-29 07:39:35 
 * @Desc: Model Skema Sertifikasi 
 */

defined('BASEPATH') or exit('No direct script access allowed');

class M_skema extends CI_Model
{
    public function getAllData()
    {
        $this->datatables->select('id, judul_skema, no_skema, create_date, create_date');
        $this->datatables->from('tb_skema');
        $this->datatables->where('delete_status = 0');
        return $this->datatables->generate();
    }

    public function getData()
    {
        $this->db->select('*');
        $this->db->from('tb_skema');
        $this->db->order_by('id', 'desc');
        return $this->db->get()->result();
    }

    public function getSkemaUnit()
    {
        $this->db->select('tk.id, s.judul_skema, tk.kode_unit, tk.judul_unit, tk.jenis_standar, tk.create_date');
        $this->db->from('tb_unit_kompetensi tk');
        $this->db->join('tb_skema s', 's.id = tk.id_skema', 'left');
        $this->db->where('tk.status_delete = 0');
        $this->db->group_by('s.id');
        return $this->db->get()->result();
    }
    public function getUnitOnSkema()
    {
        $this->db->select('tk.id, s.judul_skema, tk.kode_unit, tk.judul_unit, tk.jenis_standar, tk.create_date');
        $this->db->from('tb_unit_kompetensi tk');
        $this->db->join('tb_skema s', 's.id = tk.id_skema', 'left');
        $this->db->where('tk.status_delete = 0');
        // $this->db->where('tk.id_skema', $id_skema);
        return $this->db->get()->result();
    }

    public function checkUserOnAsesi($id_user)
    {
        $this->db->select('*');
        $this->db->from('tb_skema');
        $this->db->where('id_user', $id_user);
        return $this->db->get()->row();
    }

    public function addData($data)
    {
        $this->db->insert('tb_skema', $data);
        return $this->db->affected_rows() > 0 ? $this->db->insert_id() : FALSE;
    }

    public function get_by_id($id)
    {
        return $this->db->get_where('tb_skema ap', array('ap.id' => $id))->result();
    }

    public function getById($id)
    {
        $this->db->select('*');
        $this->db->from('tb_skema');
        $this->db->where('id', $id);
        return $this->db->get()->row();
    }

    public function getByIdUser($id_user)
    {
        $this->db->select('*');
        $this->db->from('tb_skema');
        $this->db->where('id_user', $id_user);
        return $this->db->get()->row();
    }

    function update($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('tb_skema', $data);
        return $this->db->affected_rows();
    }

    public function update_delete($id)
    {
        return $this->db->query('update tb_skema set delete_status = 1 where id = "' . $id . '"');
    }

    function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('tb_skema');
    }
}

/* End of file M_tb_skema.php */
