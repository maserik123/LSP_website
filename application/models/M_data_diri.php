<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_data_diri extends CI_Model
{
    public function getAllData()
    {
        $this->datatables->select('id, id_user, dd_nama_lengkap, dd_tempat_lahir, dd_tgl_lahir, dd_jenis_kelamin, dd_kebangsaan, dd_alamat_rumah, dd_no_hp, dd_no_telp, dd_email, dd_kode_pos, dd_kantor, dd_pendidikan_terakhir, k_lembaga, k_jabatan, k_alamat, k_kode_pos, k_fax, k_telp, k_email, create_date');
        $this->datatables->from('tb_data_diri');
        $this->datatables->where('status_delete = 0');
        return $this->datatables->generate();
    }

    public function getData()
    {
        $this->db->select('*');
        $this->db->from('tb_data_diri');
        $this->db->order_by('id', 'desc');
        return $this->db->get()->result();
    }

    public function checkUserOnAsesi($id_user)
    {
        $this->db->select('*');
        $this->db->from('tb_data_diri');
        $this->db->where('id_user', $id_user);
        return $this->db->get()->row();
    }

    public function addData($data)
    {
        $this->db->insert('tb_data_diri', $data);
        return $this->db->affected_rows() > 0 ? $this->db->insert_id() : FALSE;
    }

    public function get_by_id($id)
    {
        return $this->db->get_where('tb_data_diri ap', array('ap.id' => $id))->result();
    }

    public function getById($id)
    {
        $this->db->select('*');
        $this->db->from('tb_data_diri');
        $this->db->where('id', $id);
        return $this->db->get()->row();
    }

    public function getByIdUser($id_user)
    {
        $this->db->select('*');
        $this->db->from('tb_data_diri');
        $this->db->where('id_user', $id_user);
        return $this->db->get()->row();
    }

    function update($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('tb_data_diri', $data);
        return $this->db->affected_rows();
    }

    public function update_delete($id)
    {
        return $this->db->query('update tb_data_diri set status_delete = 1 where id = "' . $id . '"');
    }

    function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('tb_data_diri');
    }


    public function updateTandaTangan($id, $var, $data)
    {
        if ($var == 'dd_tanda_tangan_asesi') {
            $this->_deleteTandaTangan($id);
        }
        return $this->db->query('update tb_data_diri set ' . $var . ' = "' . $data . '" where id = "' . $id . '"');
    }

    public function updateFoto($id, $var, $data)
    {
        if ($var == 'dd_foto') {
            $this->deleteFoto($id);
        }
        return $this->db->query('update tb_data_diri set ' . $var . ' = "' . $data . '" where id = "' . $id . '"');
    }

    public function _deleteTandaTangan($id)
    {
        $product = $this->getById($id);
        $filename = explode(".", $product->dd_tanda_tangan_asesi)[0];
        if (empty($product->dd_tanda_tangan_asesi)) {
            return '';
        } else {
            return array_map('unlink', glob(FCPATH . "/g_ttd_asesi/$filename.*"));
        }
    }

    public function deleteFoto($id)
    {
        $product = $this->getById($id);
        $filename = explode(".", $product->dd_foto)[0];
        if (empty($product->dd_foto)) {
            return '';
        } else {
            return array_map('unlink', glob(FCPATH . "/g_foto_asesi/$filename.*"));
        }
    }
}

/* End of file M_tb_data_diri.php */
