<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_asesor extends CI_Model
{
    public function getAllData()
    {
        $this->datatables->select('id, nama_asesor, no_reg, create_date, expire_date, status_delete');
        $this->datatables->from('tb_asesor');
        $this->datatables->where('status_delete = 0');
        return $this->datatables->generate();
    }

    public function getData()
    {
        $this->db->select('*');
        $this->db->from('tb_asesor');
        $this->db->where('status_delete = 0');
        $this->db->order_by('id', 'desc');
        return $this->db->get()->result();
    }

    public function addData($data)
    {
        $this->db->insert('tb_asesor', $data);
        return $this->db->affected_rows() > 0 ? $this->db->insert_id() : FALSE;
    }

    public function get_by_id($id)
    {
        return $this->db->get_where('tb_asesor ap', array('ap.id' => $id))->result();
    }

    public function getById($id)
    {
        $this->db->select('*');
        $this->db->from('tb_asesor');
        // $this->db->where('status_delete = 0');
        $this->db->where('id', $id);
        return $this->db->get()->row();
    }


    public function getByIdUser($id_user)
    {
        $this->db->select('*');
        $this->db->from('tb_asesor');
        $this->db->where('id_user', $id_user);
        // $this->db->where('status_delete = 0');
        return $this->db->get()->row();
    }

    public function checkUserOnAsesor($id_user)
    {
        $this->db->select('*');
        $this->db->from('tb_asesor');
        $this->db->where('id_user', $id_user);
        $this->db->where('status_delete = 0');
        return $this->db->get()->row();
    }

    public function updateTandaTangan($id, $var, $data)
    {
        if ($var == 'tanda_tangan') {
            $this->_deleteTandaTangan($id);
        }
        return $this->db->query('update tb_asesor set ' . $var . ' = "' . $data . '" where id_user = "' . $id . '"');
    }


    public function _deleteTandaTangan($id)
    {
        $product = $this->getByIdUser($id);
        $filename = explode(".", $product->tanda_tangan)[0];
        if (empty($product->tanda_tangan)) {
            return '';
        } else {
            return array_map('unlink', glob(FCPATH . "/g_ttd_asesor/$filename.*"));
        }
    }


    function update($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('tb_asesor', $data);
        return $this->db->affected_rows();
    }
    function updateByIdUser($id_user, $data)
    {
        $this->db->where('id_user', $id_user);
        $this->db->update('tb_asesor', $data);
        return $this->db->affected_rows();
    }

    public function update_delete($id)
    {
        return $this->db->query('update tb_asesor set status_delete = 1 where id = "' . $id . '"');
    }

    function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('tb_asesor');
    }
}

/* End of file M_tb_asesor.php */
