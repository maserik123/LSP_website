<?php

/** 
 * @Author: Fitra Arrafiq
 * @Date: 2020-12-29 07:39:35 
 * @Desc: Model Skema Sertifikasi 
 */

defined('BASEPATH') or exit('No direct script access allowed');

class M_pemberitahuan extends CI_Model
{
    public function getAllData()
    {
        $this->datatables->select('id, pemberitahuan, create_date');
        $this->datatables->from('tb_pemberitahuan');
        return $this->datatables->generate();
    }

    public function getData()
    {
        $this->db->select('*');
        $this->db->from('tb_pemberitahuan');
        $this->db->order_by('id', 'desc');
        return $this->db->get()->result();
    }

    public function addData($data)
    {
        $this->db->insert('tb_pemberitahuan', $data);
        return $this->db->affected_rows() > 0 ? $this->db->insert_id() : FALSE;
    }

    public function get_by_id($id)
    {
        return $this->db->get_where('tb_pemberitahuan ap', array('ap.id' => $id))->result();
    }

    public function getById($id)
    {
        $this->db->select('*');
        $this->db->from('tb_pemberitahuan');
        $this->db->where('id', $id);
        return $this->db->get()->row();
    }

    public function getByIdUser($id_user)
    {
        $this->db->select('*');
        $this->db->from('tb_pemberitahuan');
        $this->db->where('id_user', $id_user);
        return $this->db->get()->row();
    }

    function update($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('tb_pemberitahuan', $data);
        return $this->db->affected_rows();
    }

    public function update_delete($id)
    {
        return $this->db->query('update tb_pemberitahuan set delete_status = 1 where id = "' . $id . '"');
    }

    function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('tb_pemberitahuan');
    }
}

/* End of file M_tb_skema.php */
