<?php

/** 
 * @Author: fitraarrafiq@gmail.com
 * @Date: 2021-01-02 09:27:35 
 * @Desc: Model APL_02 
 */
defined('BASEPATH') or exit('No direct script access allowed');

class M_apl_02 extends CI_Model
{

    public function getAllData()
    {
        $this->datatables->select('id, id_user, dd_nama_lengkap, dd_tempat_lahir, dd_tgl_lahir, dd_jenis_kelamin, dd_kebangsaan, dd_alamat_rumah, dd_no_hp, dd_no_telp, dd_email, dd_kode_pos, dd_kantor, dd_pendidikan_terakhir, k_lembaga, k_jabatan, k_alamat, k_kode_pos, k_fax, k_telp, k_email, create_date');
        $this->datatables->from('tb_apl_02');
        $this->datatables->where('status_delete = 0');
        return $this->datatables->generate();
    }

    public function getDataByIdPilihanSkema1($id_pilSkema)
    {
        $this->datatables->select('*');
        $this->datatables->from('tb_apl_02');
        $this->datatables->order_by('id', 'desc');
        $this->datatables->where('id_pilihan_skema', $id_pilSkema);
        return $this->datatables->generate();
    }

    public function getData()
    {
        $this->db->select('*');
        $this->db->from('tb_apl_02');
        $this->db->order_by('id', 'desc');
        return $this->db->get()->result();
    }

    public function getDataByIdPilihanSkema($id_pilSkema)
    {
        $this->db->select('*');
        $this->db->from('tb_apl_02');
        // $this->db->order_by('id', 'desc');
        $this->db->where('id_pilihan_skema', $id_pilSkema);
        return $this->db->get()->result();
    }

    public function getDataByIdPilihanSkema2($id_pilSkema)
    {
        $this->db->select('*');
        $this->db->from('tb_apl_02 a');
        $this->db->join('tb_unit_kompetensi k', 'k.id = a.id_unit_kompetensi', 'left');
        $this->db->where('id_pilihan_skema', $id_pilSkema);
        return $this->db->get()->result();
    }

    public function groupByIdElemen($id_pilSkema)
    {
        $this->db->select('*');
        $this->db->from('tb_apl_02 a');
        $this->db->join('tb_unit_kompetensi k', 'k.id = a.id_unit_kompetensi', 'left');
        $this->db->where('id_pilihan_skema', $id_pilSkema);
        $this->db->group_by('id_unit_elemen');

        return $this->db->get()->result();
    }

    public function getPertanyaanByUnitElemen($id_unit_elemen)
    {
        $this->db->select('*');
        $this->db->from('tb_apl_02');
        $this->db->where('id_unit_elemen', $id_unit_elemen);
        return $this->db->get()->result();
    }

    public function groupByUnitKompetensi($id_pilSkema)
    {
        $this->db->select('*');
        $this->db->from('tb_apl_02');
        $this->db->where('id_pilihan_skema', $id_pilSkema);
        $this->db->group_by('id_unit_kompetensi');
        return $this->db->get()->result();
    }

    public function groupByUnitElemen($id_unit_elemen)
    {
        $this->db->select('*');
        $this->db->from('tb_apl_02');
        $this->db->where('id_unit_elemen', $id_unit_elemen);
        $this->db->group_by('id_unit_elemen');
        return $this->db->get()->result();
    }

    public function cekByIdPilihanSkema($id_pilihan_skema)
    {
        $this->db->select('id, id_pilihan_skema, daftar_pertanyaan, id_unit_kompetensi, id_skema, id_unit_elemen, id_unit_pertanyaan_elemen, penilaian_kompeten, bukti_kompeten, asesor_v, asesor_a, asesor_t, asesor_m');
        $this->db->from('tb_apl_02');
        $this->db->where('id_pilihan_skema', $id_pilihan_skema);
        return $this->db->get()->result();
    }

    public function cekByIdPertanyaan($id_pertanyaan)
    {
        $this->db->select('id');
        $this->db->from('tb_unit_pertanyaan_elemen');
        $this->db->where('id', $id_pertanyaan);
        return $this->db->get()->result();
    }

    public function cekAPL02ByIdPertanyaan($id_pertanyaan)
    {
        $this->db->select('id_unit_pertanyaan_elemen');
        $this->db->from('tb_apl_02');
        $this->db->where('id_unit_pertanyaan_elemen', $id_pertanyaan);
        return $this->db->get()->result();
    }

    public function cekAPL02ByIdPertanyaanAndPilSkema($id_pertanyaan, $id_pilihan_skema)
    {
        $this->db->select('id_unit_pertanyaan_elemen, id_pilihan_skema');
        $this->db->from('tb_apl_02');
        $this->db->where('id_unit_pertanyaan_elemen', $id_pertanyaan);
        $this->db->where('id_pilihan_skema', $id_pilihan_skema);

        return $this->db->get()->result();
    }

    public function getPertanyaanByIdSkemaPilihan($id_pilihan_skema)
    {
        $this->db->select('pe.id, pe.daftar_pertanyaan, pe.id_skema, s.id as id_s, pe.id_unit_elemen, pe.create_date, pe.status_delete');
        $this->db->from('tb_unit_pertanyaan_elemen pe');
        $this->db->join('tb_unit_elemen e', 'e.id = pe.id_unit_elemen', 'left');
        $this->db->join('tb_unit_kompetensi k', 'k.id = e.id_unit_kompetensi', 'left');
        $this->db->join('tb_skema s', 's.id = k.id_skema', 'left');
        $this->db->join('tb_pilihan_skema ps', 'ps.id_skema = s.id', 'left');
        $this->db->where('s.id', $id_pilihan_skema);
        $this->db->where('pe.status_delete = 0');
        return $this->db->get()->result();
    }

    public function getByIdSkema($id_skema)
    {
        $this->db->select('pe.id as id_pe, pe.daftar_pertanyaan, pe.id_unit_elemen, pe.id_skema, pe.id_unit_kompetensi, s.judul_skema, k.judul_unit, e.elemen_kompetensi, pe.create_date, pe.status_delete');
        $this->db->from('tb_unit_pertanyaan_elemen pe');
        $this->db->join('tb_unit_elemen e', 'e.id = pe.id_unit_elemen', 'left');
        $this->db->join('tb_unit_kompetensi k', 'k.id = pe.id_unit_kompetensi', 'left');
        $this->db->join('tb_skema s', 's.id = pe.id_skema', 'left');
        $this->db->where('pe.id_skema', $id_skema);
        return $this->db->get()->result();
    }

    public function addData($data)
    {
        $this->db->insert('tb_apl_02', $data);
        return $this->db->affected_rows() > 0 ? $this->db->insert_id() : FALSE;
    }

    public function get_by_id($id)
    {
        return $this->db->get_where('tb_apl_02 ap', array('ap.id' => $id))->result();
    }

    public function getById($id)
    {
        $this->db->select('*');
        $this->db->from('tb_apl_02');
        $this->db->where('id', $id);
        return $this->db->get()->row();
    }

    public function getByIdUser($id_user)
    {
        $this->db->select('*');
        $this->db->from('tb_apl_02');
        $this->db->where('id_user', $id_user);
        return $this->db->get()->row();
    }

    function update($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('tb_apl_02', $data);
        return $this->db->affected_rows();
    }


    public function asesor_v($id)
    {
        return $this->db->query('update tb_apl_02 set asesor_v = 1 where id = "' . $id . '"');
    }

    public function asesor_a($id)
    {
        return $this->db->query('update tb_apl_02 set asesor_a = 1 where id = "' . $id . '"');
    }

    public function asesor_t($id)
    {
        return $this->db->query('update tb_apl_02 set asesor_t = 1 where id = "' . $id . '"');
    }

    public function asesor_m($id)
    {
        return $this->db->query('update tb_apl_02 set asesor_m = 1 where id = "' . $id . '"');
    }

    public function update_delete($id)
    {
        return $this->db->query('update tb_apl_02 set status_delete = 1 where id = "' . $id . '"');
    }

    function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('tb_apl_02');
    }
}

/* End of file M_apl_02.php */
