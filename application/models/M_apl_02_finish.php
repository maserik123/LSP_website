<?php

/** 
 * @Author: fitraarrafiq@gmail.com
 * @Date: 2021-01-02 09:27:35 
 * @Desc: Model APL_02 
 */
defined('BASEPATH') or exit('No direct script access allowed');

class M_apl_02_finish extends CI_Model
{

    public function getAllData()
    {
        $this->datatables->select('id, id_user, dd_nama_lengkap, dd_tempat_lahir, dd_tgl_lahir, dd_jenis_kelamin, dd_kebangsaan, dd_alamat_rumah, dd_no_hp, dd_no_telp, dd_email, dd_kode_pos, dd_kantor, dd_pendidikan_terakhir, k_lembaga, k_jabatan, k_alamat, k_kode_pos, k_fax, k_telp, k_email, create_date');
        $this->datatables->from('tb_apl_02_finish');
        $this->datatables->where('status_delete = 0');
        return $this->datatables->generate();
    }

    public function getData()
    {
        $this->db->select('*');
        $this->db->from('tb_apl_02_finish');
        $this->db->order_by('id', 'desc');
        return $this->db->get()->result();
    }

    public function addData($data)
    {
        $this->db->insert('tb_apl_02_finish', $data);
        return $this->db->affected_rows() > 0 ? $this->db->insert_id() : FALSE;
    }

    public function get_by_id($id)
    {
        return $this->db->get_where('tb_apl_02_finish ap', array('ap.id' => $id))->result();
    }

    public function getById($id)
    {
        $this->db->select('*');
        $this->db->from('tb_apl_02_finish');
        $this->db->where('id', $id);
        return $this->db->get()->row();
    }

    public function getDataSkemaByIdPilihan($id)
    {
        $this->db->select('s.judul_skema, s.no_skema, af.tuk, af.nama_asesor, as.no_reg, af.tanda_tangan_asesi, af.tanggal_tanda_tangan_asesi, af.tanda_tangan_asesor, af.tanggal_tanda_tangan_asesor, af.catatan_asesmen_portofolio, af.catatan_uji_kompetensi, af.nama_asesi, af.tanggal');
        $this->db->from('tb_apl_02_finish af');
        $this->db->join('tb_pilihan_skema ps', 'ps.id = af.id_pilihan_skema', 'left');
        $this->db->join('tb_skema s', 's.id = ps.id_skema', 'left');
        $this->db->join('tb_asesor as', 'as.id = af.id_asesor', 'left');
        $this->db->where('af.id_pilihan_skema', $id);
        return $this->db->get()->row();
    }

    public function getDataByIdPilSkema($id_pilihan_skema)
    {
        $this->db->select('*');
        $this->db->from('tb_apl_02_finish');
        $this->db->where('id_pilihan_skema', $id_pilihan_skema);
        return $this->db->get()->row();
    }

    public function getByIdPilSkema($id_pilihan_skema)
    {
        $this->db->select('id_pilihan_skema');
        $this->db->from('tb_apl_02_finish');
        $this->db->where('id_pilihan_skema', $id_pilihan_skema);
        return $this->db->get()->row();
    }

    public function getByIdUser($id_user)
    {
        $this->db->select('*');
        $this->db->from('tb_apl_02_finish');
        $this->db->where('id_user', $id_user);
        return $this->db->get()->row();
    }

    function update($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('tb_apl_02_finish', $data);
        return $this->db->affected_rows();
    }

    function updateByIdPilSkema($idPilSkema, $data)
    {
        $this->db->where('id_pilihan_skema', $idPilSkema);
        $this->db->update('tb_apl_02_finish', $data);
        return $this->db->affected_rows();
    }

    function updateTTD($id, $data)
    {
        $this->db->where('id_pilihan_skema', $id);
        $this->db->update('tb_apl_02_finish', $data);
        return $this->db->affected_rows();
    }

    public function _deleteTtdAsesi($id)
    {
        $product = $this->getById($id);
        $filename = explode(".", $product->tanda_tangan_asesi)[0];
        if (empty($product->tanda_tangan_asesi)) {
            return '';
        } else {
            return array_map('unlink', glob(FCPATH . "/g_ttd_asesi_apl_02/$filename.*"));
        }
    }

    public function updateDokumen($id, $var, $data)
    {
        if ($var == 'tanda_tangan_asesi') {
            $this->_deleteTtdAsesi($id);
        }
        return $this->db->query('update tb_apl_02_finish set ' . $var . ' = "' . $data . '" where id_pilihan_skema = "' . $id . '"');
    }

    public function updateTanggalUploadTTD($id)
    {
        return $this->db->query('update tb_apl_02_finish set tanggal_tanda_tangan_asesi = "' . date('Y-m-d') . '" where id_pilihan_skema = "' . $id . '"');
    }

    public function update_delete($id)
    {
        return $this->db->query('update tb_apl_02_finish set status_delete = 1 where id = "' . $id . '"');
    }

    public function terimaKonfirmasi($id_pil_skema, $no_reg, $ttd, $tgl)
    {
        return $this->db->query('update tbl_apl_02_finish set no_reg = "' . $no_reg . '", tanda_tangan_asesor = "' . $ttd . '", tanggal_tanda_tangan_asesor = "' . $tgl . '" where id_pilihan_skema = "' . $id_pil_skema . '"');
    }

    function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('tb_apl_02_finish');
    }
}

/* End of file M_apl_02.php */
