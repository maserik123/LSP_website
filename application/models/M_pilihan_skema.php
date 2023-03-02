<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_pilihan_skema extends CI_Model
{

    /** 
     * @Author: Fitra Arrafiq
     * @Date: 2020-12-29 07:39:35 
     * @Desc: Model Skema Sertifikasi 
     */
    // Untuk persetujuan APL01 pada admin
    public function getAllData()
    {
        $this->datatables->select('ps.id, ps.id_data_diri, dd.dd_nama_lengkap, s.judul_skema, ps.tujuan_sertifikasi, a.nama_asesor,  ps.upload_ktm, ps.upload_transkrip, ps.upload_ktp_sim, ps.sertifikat_pelatihan, ps.upload_pengalaman_kerja, ps.upload_bukti_relevan_1, ps.upload_bukti_relevan_2, ps.upload_bukti_relevan_3, ps.upload_bukti_relevan_4, ps.upload_bukti_relevan_5, ps.tanda_tangan_asesi, ps.tanda_tangan_admin, ps.tanggal_pengajuan, ps.status_diterima, u.first_name, ps.nik_lsp, ps.tanda_tangan_admin, ps.tanggal_diterima, ps.keterangan_status,ps.keterangan_status ');
        $this->datatables->from('tb_pilihan_skema ps');
        $this->datatables->join('tb_skema s', 's.id = ps.id_skema', 'left');
        $this->datatables->join('tb_data_diri dd', 'dd.id = ps.id_data_diri', 'left');
        $this->datatables->join('tb_asesor a', 'a.id = ps.id_asesor', 'left');
        $this->datatables->join('users u', 'u.id = ps.id_user_admin', 'left');
        $this->datatables->where('ps.status_delete = 0');
        $this->datatables->where('ps.status_dokumen = 1');

        return $this->datatables->generate();
    }

    // Untuk persetujuan APL02 pada admin
    public function getAllData1()
    {
        $this->datatables->select('ps.id, dd.dd_nama_lengkap, s.judul_skema, ps.tujuan_sertifikasi, a.nama_asesor,  ps.upload_ktm, ps.upload_transkrip, ps.upload_ktp_sim, ps.sertifikat_pelatihan, ps.upload_pengalaman_kerja, ps.upload_bukti_relevan_1, ps.upload_bukti_relevan_2, ps.upload_bukti_relevan_3, ps.upload_bukti_relevan_4, ps.upload_bukti_relevan_5, ps.tanda_tangan_asesi, ps.tanda_tangan_admin, ps.tanggal_pengajuan, ps.status_diterima, ad.nama_lengkap, ps.nik_lsp, ps.tanda_tangan_admin, ps.tanggal_diterima, ps.keterangan_status,ps.keterangan_status ');
        $this->datatables->from('tb_pilihan_skema ps');
        $this->datatables->join('tb_skema s', 's.id = ps.id_skema', 'left');
        $this->datatables->join('tb_data_diri dd', 'dd.id = ps.id_data_diri', 'left');
        $this->datatables->join('tb_asesor a', 'a.id = ps.id_asesor', 'left');
        $this->datatables->join('tb_data_admin ad', 'ad.id_user = ps.id_user_admin', 'left');
        $this->datatables->where('ps.status_delete = 0');
        $this->datatables->where('ps.status_dokumen = 1');
        $this->datatables->where('ps.status_diterima = 1');

        return $this->datatables->generate();
    }

    public function getAllData1_1()
    {
        $this->db->select('ps.id, dd.dd_nama_lengkap, s.judul_skema, ps.tujuan_sertifikasi, a.nama_asesor,  ps.upload_ktm, ps.upload_transkrip, ps.upload_ktp_sim, ps.sertifikat_pelatihan, ps.upload_pengalaman_kerja, ps.upload_bukti_relevan_1, ps.upload_bukti_relevan_2, ps.upload_bukti_relevan_3, ps.upload_bukti_relevan_4, ps.upload_bukti_relevan_5, ps.tanda_tangan_asesi, ps.tanda_tangan_admin, ps.tanggal_pengajuan, ps.status_diterima, ad.nama_lengkap, ps.nik_lsp, ps.tanda_tangan_admin, ps.tanggal_diterima, ps.keterangan_status,ps.keterangan_status ');
        $this->db->from('tb_pilihan_skema ps');
        $this->db->join('tb_skema s', 's.id = ps.id_skema', 'left');
        $this->db->join('tb_data_diri dd', 'dd.id = ps.id_data_diri', 'left');
        $this->db->join('tb_asesor a', 'a.id = ps.id_asesor', 'left');
        $this->db->join('tb_data_admin ad', 'ad.id_user = ps.id_user_admin', 'left');
        $this->db->where('ps.status_delete = 0');
        $this->db->where('ps.status_dokumen = 1');
        $this->db->where('ps.status_diterima = 1');

        return $this->db->get()->result();
    }

    public function getAllData2()
    {
        $this->datatables->select('dd.dd_nama_lengkap, 
        dd.dd_nik, 
        dd.dd_tempat_lahir, 
        dd.dd_tgl_lahir, 
        dd.dd_jenis_kelamin, 
        dd.dd_kebangsaan, 
        dd.dd_alamat_rumah, 
        dd.dd_no_hp, 
        dd.dd_no_telp, 
        dd.dd_email, 
        dd.dd_kode_pos, dd.dd_kantor, 
        dd.dd_pendidikan_terakhir, 
        dd.dd_tanda_tangan_asesi, 
        dd.dd_foto,
        dd.k_lembaga,
        dd.k_jabatan,
        dd.k_alamat,
        dd.k_kode_pos,
        dd.k_fax,
        dd.k_telp,
        dd.k_email,
        s.judul_skema,
        ps.id,
        ps.id_skema,
        ps.tujuan_sertifikasi,
        ps.upload_ktm,
        ps.upload_transkrip,
        ps.upload_ktp_sim,
        ps.sertifikat_pelatihan,
        ps.upload_pengalaman_kerja,
        ps.upload_bukti_relevan_1,
        ps.keterangan_bukti_1,
        ps.upload_bukti_relevan_2,
        ps.keterangan_bukti_2,
        ps.upload_bukti_relevan_3,
        ps.keterangan_bukti_3,
        ps.upload_bukti_relevan_4,
        ps.keterangan_bukti_4,
        ps.upload_bukti_relevan_5,
        ps.keterangan_bukti_5,
        ps.tanda_tangan_asesi,
        ps.tanggal_pengajuan,
        ps.tutup_pendaftaran,
        ps.tanggal_pelaksanaan,
        ps.id_asesor,
        ps.id_user_admin,
        ps.nik_lsp,
        ps.tanda_tangan_admin,
        ps.tanggal_diterima,
        ps.status_diterima,
        ps.status_dokumen,
        ps.keterangan_status,
        ps.status_selesai');
        $this->datatables->from('tb_pilihan_skema ps');
        $this->datatables->join('tb_skema s', 's.id = ps.id_skema', 'left');
        $this->datatables->join('tb_data_diri dd', 'dd.id = ps.id_data_diri', 'left');
        $this->datatables->join('tb_asesor a', 'a.id = ps.id_asesor', 'left');
        $this->datatables->join('tb_data_admin ad', 'ad.id_user = ps.id_user_admin', 'left');
        $this->datatables->where('ps.status_delete = 0');
        $this->datatables->where('ps.status_dokumen = 1');
        $this->datatables->where('ps.status_diterima = 1');

        return $this->datatables->generate();
    }

    // Untuk persetujuan APL02 pada asesor
    public function getAllDataForAsesor()
    {
        $id_user = $this->session->userdata('id');
        $this->db->select('ps.id, dd.dd_nama_lengkap, s.judul_skema, ps.tujuan_sertifikasi, a.nama_asesor,  ps.upload_ktm, ps.upload_transkrip, ps.upload_ktp_sim, ps.sertifikat_pelatihan, ps.upload_pengalaman_kerja, ps.upload_bukti_relevan_1, ps.upload_bukti_relevan_2, ps.upload_bukti_relevan_3, ps.upload_bukti_relevan_4, ps.upload_bukti_relevan_5, ps.tanda_tangan_asesi, ps.tanda_tangan_admin, ps.tanggal_pengajuan, ps.tanggal_pelaksanaan, ps.status_diterima, u.first_name, ps.nik_lsp, ps.tanda_tangan_admin, ps.tanggal_diterima, ps.keterangan_status,ps.keterangan_status ');
        $this->db->from('tb_pilihan_skema ps');
        $this->db->join('tb_skema s', 's.id = ps.id_skema', 'left');
        $this->db->join('tb_data_diri dd', 'dd.id = ps.id_data_diri', 'left');
        $this->db->join('tb_asesor a', 'a.id = ps.id_asesor', 'left');
        $this->db->join('users u', 'u.id = ps.id_user_admin', 'left');
        $this->db->where('ps.status_delete = 0');
        $this->db->where('ps.status_dokumen = 1');
        $this->db->where('ps.status_diterima = 1');
        $this->db->where('a.id_user', $id_user);
        $this->db->order_by('ps.id', 'desc');

        return $this->db->get()->result();
    }

    public function cekDataById($id)
    {
        $this->db->select('dd.dd_nama_lengkap, 
        dd.dd_nik, 
        dd.dd_tempat_lahir, 
        dd.dd_tgl_lahir, 
        dd.dd_jenis_kelamin, 
        dd.dd_kebangsaan, 
        dd.dd_alamat_rumah, 
        dd.dd_no_hp, 
        dd.dd_no_telp, 
        dd.dd_email, 
        dd.dd_kode_pos, dd.dd_kantor, 
        dd.dd_pendidikan_terakhir, 
        dd.dd_tanda_tangan_asesi, 
        dd.dd_foto,
        dd.k_lembaga,
        dd.k_jabatan,
        dd.k_alamat,
        dd.k_kode_pos,
        dd.k_fax,
        dd.k_telp,
        dd.k_email,
        s.judul_skema,
        ps.id,
        ps.id_skema,
        ps.tujuan_sertifikasi,
        ps.upload_ktm,
        ps.upload_transkrip,
        ps.upload_ktp_sim,
        ps.sertifikat_pelatihan,
        ps.upload_pengalaman_kerja,
        ps.upload_bukti_relevan_1,
        ps.keterangan_bukti_1,
        ps.upload_bukti_relevan_2,
        ps.keterangan_bukti_2,
        ps.upload_bukti_relevan_3,
        ps.keterangan_bukti_3,
        ps.upload_bukti_relevan_4,
        ps.keterangan_bukti_4,
        ps.upload_bukti_relevan_5,
        ps.keterangan_bukti_5,
        ps.tanda_tangan_asesi,
        ps.tanggal_pengajuan,
        ps.tutup_pendaftaran,
        ps.tanggal_pelaksanaan,
        ps.id_asesor,
        ps.id_user_admin,
        ps.nik_lsp,
        ps.tanda_tangan_admin,
        ps.tanggal_diterima,
        ps.status_diterima,
        ps.status_dokumen,
        ps.keterangan_status,
        ps.status_selesai');
        $this->db->from('tb_pilihan_skema ps');
        $this->db->join('tb_data_diri dd', 'dd.id = ps.id_data_diri', 'left');
        $this->db->join('tb_skema s', 's.id = ps.id_skema', 'left');
        $this->db->where('ps.status_dokumen = 1');
        $this->db->where('ps.status_delete = 0');
        $this->db->where('ps.id', $id);
        // $this->db->order_by('dd.id', 'desc');
        return $this->db->get()->row();
    }

    public function getAllDataForAsesorByIdPilSkema($id)
    {
        $id_user = $this->session->userdata('id');
        $this->db->select('ps.id, dd.dd_nama_lengkap, s.judul_skema, ps.tujuan_sertifikasi, a.nama_asesor,  ps.upload_ktm, ps.upload_transkrip, ps.upload_ktp_sim, ps.sertifikat_pelatihan, ps.upload_pengalaman_kerja, ps.upload_bukti_relevan_1, ps.upload_bukti_relevan_2, ps.upload_bukti_relevan_3, ps.upload_bukti_relevan_4, ps.upload_bukti_relevan_5, ps.tanda_tangan_asesi, ps.tanda_tangan_admin, ps.tanggal_pengajuan, ps.tanggal_pelaksanaan, ps.status_diterima, u.first_name, ps.nik_lsp, ps.tanda_tangan_admin, ps.tanggal_diterima, ps.keterangan_status,ps.keterangan_status ');
        $this->db->from('tb_pilihan_skema ps');
        $this->db->join('tb_skema s', 's.id = ps.id_skema', 'left');
        $this->db->join('tb_data_diri dd', 'dd.id = ps.id_data_diri', 'left');
        $this->db->join('tb_asesor a', 'a.id = ps.id_asesor', 'left');
        $this->db->join('users u', 'u.id = ps.id_user_admin', 'left');
        $this->db->where('ps.status_delete = 0');
        $this->db->where('ps.status_dokumen = 1');
        $this->db->where('ps.status_diterima = 1');
        $this->db->where('a.id_user', $id_user);
        $this->db->where('ps.id', $id);

        $this->db->order_by('ps.id', 'desc');

        return $this->db->get()->result();
    }

    public function getData()
    {
        $this->db->select('ps.id as id_ps, s.id as id_s, dd.id as id_dd, dd.dd_nama_lengkap, ps.id_skema, s.judul_skema, ps.tujuan_sertifikasi, ps.upload_ktm, ps.upload_transkrip, ps.upload_ktp_sim, ps.sertifikat_pelatihan, ps.upload_pengalaman_kerja, ps.upload_bukti_relevan_1, ps.upload_bukti_relevan_2, ps.upload_bukti_relevan_3, ps.upload_bukti_relevan_4, ps.upload_bukti_relevan_5, ps.tanda_tangan_asesi, ps.tanda_tangan_admin, ps.tanggal_pengajuan, ps.tanda_tangan_asesor, ps.tanggal_pengajuan, ps.tanggal_diterima, ps.keterangan_status, ps.status_diterima, a.nama_asesor');
        $this->db->from('tb_pilihan_skema ps');
        $this->db->join('tb_skema s', 's.id = ps.id_skema', 'left');
        $this->db->join('tb_data_diri dd', 'dd.id = ps.id_data_diri', 'left');
        $this->db->join('tb_asesor a', 'a.id = ps.id_asesor', 'left');
        $this->db->where('ps.status_delete = 0');

        return $this->db->get()->result();
    }

    public function getStatSelesaiByIdSkema($id_user, $id_skema)
    {
        $this->db->select('ps.status_selesai');
        $this->db->from('tb_pilihan_skema ps');
        $this->db->join('tb_skema s', 's.id = ps.id_skema', 'left');
        $this->db->join('tb_data_diri dd', 'dd.id = ps.id_data_diri', 'left');
        $this->db->join('tb_asesor a', 'a.id = ps.id_asesor', 'left');
        $this->db->where('ps.status_delete = 0');
        $this->db->where('dd.id_user', $id_user);
        $this->db->where('ps.id_skema', $id_skema);
        return $this->db->get()->result();
    }

    public function getTglPengajuanByIdSkema($id_user, $id_skema)
    {
        $this->db->select('ps.tanggal_pengajuan');
        $this->db->from('tb_pilihan_skema ps');
        $this->db->join('tb_skema s', 's.id = ps.id_skema', 'left');
        $this->db->join('tb_data_diri dd', 'dd.id = ps.id_data_diri', 'left');
        $this->db->join('tb_asesor a', 'a.id = ps.id_asesor', 'left');
        $this->db->where('ps.status_delete = 0');
        $this->db->where('dd.id_user', $id_user);
        $this->db->where('ps.id_skema', $id_skema);
        return $this->db->get()->result();
    }

    public function getDataByIdSkema($id_skema)
    {
        $this->db->select('ps.id_skema');
        $this->db->from('tb_pilihan_skema ps');
        $this->db->join('tb_skema s', 's.id = ps.id_skema', 'left');
        $this->db->join('tb_data_diri dd', 'dd.id = ps.id_data_diri', 'left');
        $this->db->join('tb_asesor a', 'a.id = ps.id_asesor', 'left');
        $this->db->where('ps.status_delete = 0');
        $this->db->where('ps.id_skema', $id_skema);
        return $this->db->get()->result();
    }

    public function getDataSampahPilihanSkema($id_user)
    {
        $this->db->select('ps.id as id_ps, s.id as id_s, dd.id as id_dd, ps.id_skema, dd.dd_nama_lengkap, ps.status_selesai, s.judul_skema, ps.tujuan_sertifikasi, ps.upload_ktm, ps.upload_transkrip, ps.upload_ktp_sim, ps.sertifikat_pelatihan, ps.upload_pengalaman_kerja, ps.upload_bukti_relevan_1, ps.upload_bukti_relevan_2, ps.upload_bukti_relevan_3, ps.upload_bukti_relevan_4, ps.upload_bukti_relevan_5, ps.tanda_tangan_asesi, ps.tanggal_pengajuan, ps.tutup_pendaftaran, ps.tanda_tangan_asesor, ps.tanda_tangan_admin, ps.tanggal_pengajuan, ps.tanggal_diterima, ps.tanggal_pelaksanaan, ps.keterangan_status, ps.status_diterima,ps.status_selesai, ps.status_dokumen, a.nama_asesor');
        $this->db->from('tb_pilihan_skema ps');
        $this->db->join('tb_skema s', 's.id = ps.id_skema', 'left');
        $this->db->join('tb_data_diri dd', 'dd.id = ps.id_data_diri', 'left');
        $this->db->join('tb_asesor a', 'a.id = ps.id_asesor', 'left');
        $this->db->where('ps.status_delete = 1');
        $this->db->where('dd.id_user', $id_user);

        return $this->db->get()->result();
    }

    public function getSkemaSaya($id_user)
    {
        $this->db->select('ps.id as id_ps, s.id as id_s, dd.id as id_dd, ps.id_skema, dd.dd_nama_lengkap, ps.status_selesai, s.judul_skema, ps.tujuan_sertifikasi, ps.upload_ktm, ps.upload_transkrip, ps.upload_ktp_sim, ps.sertifikat_pelatihan, ps.upload_pengalaman_kerja, ps.upload_bukti_relevan_1, ps.upload_bukti_relevan_2, ps.upload_bukti_relevan_3, ps.upload_bukti_relevan_4, ps.upload_bukti_relevan_5, ps.tanda_tangan_asesi, ps.tanggal_pengajuan, ps.tutup_pendaftaran, ps.tanda_tangan_asesor, ps.tanda_tangan_admin, ps.tanggal_pengajuan, ps.tanggal_diterima, ps.tanggal_pelaksanaan, ps.keterangan_status, ps.status_diterima,ps.status_selesai, ps.status_dokumen, a.nama_asesor');
        $this->db->from('tb_pilihan_skema ps');
        $this->db->join('tb_skema s', 's.id = ps.id_skema', 'left');
        $this->db->join('tb_data_diri dd', 'dd.id = ps.id_data_diri', 'left');
        $this->db->join('tb_asesor a', 'a.id = ps.id_asesor', 'left');
        $this->db->where('ps.status_delete = 0');
        $this->db->where('dd.id_user', $id_user);

        return $this->db->get()->result();
    }

    public function getDataByIdUser($id_user)
    {
        $this->db->select('ps.id as id_ps, s.id as id_s, dd.id as id_dd, ps.id_skema, dd.dd_nama_lengkap, ps.status_selesai, s.judul_skema, ps.tujuan_sertifikasi, ps.upload_ktm, ps.upload_transkrip, ps.upload_ktp_sim, ps.sertifikat_pelatihan, ps.upload_pengalaman_kerja, ps.upload_bukti_relevan_1, ps.upload_bukti_relevan_2, ps.upload_bukti_relevan_3, ps.upload_bukti_relevan_4, ps.upload_bukti_relevan_5, ps.tanda_tangan_asesi, ps.tanggal_pengajuan, ps.tutup_pendaftaran, ps.tanda_tangan_asesor, ps.tanda_tangan_admin, ps.tanggal_pengajuan, ps.tanggal_diterima, ps.tanggal_pelaksanaan, ps.keterangan_status, ps.status_diterima,ps.status_selesai, ps.status_dokumen, a.nama_asesor');
        $this->db->from('tb_pilihan_skema ps');
        $this->db->join('tb_skema s', 's.id = ps.id_skema', 'left');
        $this->db->join('tb_data_diri dd', 'dd.id = ps.id_data_diri', 'left');
        $this->db->join('tb_asesor a', 'a.id = ps.id_asesor', 'left');
        $this->db->where('ps.status_delete = 0');
        // $this->db->where('ps.status_selesai = "on_progres"');
        $this->db->where('dd.id_user', $id_user);
        $this->db->order_by('ps.id', 'desc');
        return $this->db->get()->result();
    }


    public function getDataByIdUserSkema($id_user, $id_skema)
    {
        $this->db->select('ps.id_skema, ps.tanggal_pengajuan, ps.tutup_pendaftaran, ps.status_selesai');
        $this->db->from('tb_pilihan_skema ps');
        $this->db->join('tb_skema s', 's.id = ps.id_skema', 'left');
        $this->db->join('tb_data_diri dd', 'dd.id = ps.id_data_diri', 'left');
        $this->db->join('tb_asesor a', 'a.id = ps.id_asesor', 'left');
        $this->db->where('ps.status_delete = 0');
        $this->db->where('dd.id_user', $id_user);
        $this->db->where('ps.id_skema', $id_skema);
        return $this->db->get()->row();
    }

    public function getDataByIdUserSkema1($id_user, $id_skema, $status_selesai)
    {
        $this->db->select('count(ps.status_selesai) as hitungStatus');
        $this->db->from('tb_pilihan_skema ps');
        $this->db->join('tb_skema s', 's.id = ps.id_skema', 'left');
        $this->db->join('tb_data_diri dd', 'dd.id = ps.id_data_diri', 'left');
        $this->db->join('tb_asesor a', 'a.id = ps.id_asesor', 'left');
        $this->db->where('ps.status_delete = 0');
        $this->db->where('dd.id_user', $id_user);
        $this->db->where('ps.id_skema', $id_skema);
        $this->db->where('ps.status_selesai', $status_selesai);
        // $this->db->group_by('ps.status_selesai');
        return $this->db->get()->result();
    }


    public function getDataDiriByIdUser($id_user)
    {
        $this->db->select('*');
        $this->db->from('tb_data_diri');
        $this->db->where('id_user', $id_user);
        return $this->db->get()->row();
    }

    public function checkUserOnAsesi($id_user)
    {
        $this->db->select('*');
        $this->db->from('tb_pilihan_skema');
        $this->db->where('id_user', $id_user);
        return $this->db->get()->row();
    }

    public function addData($data)
    {
        $this->db->insert('tb_pilihan_skema', $data);
        return $this->db->affected_rows() > 0 ? $this->db->insert_id() : FALSE;
    }

    public function get_by_id($id)
    {
        return $this->db->get_where('tb_pilihan_skema ap', array('ap.id' => $id))->result();
    }

    public function getById($id)
    {
        $this->db->select('*');
        $this->db->from('tb_pilihan_skema');
        $this->db->where('id', $id);
        return $this->db->get()->row();
    }

    public function getBySkemaId($id)
    {
        $this->db->select('id_skema');
        $this->db->from('tb_pilihan_skema');
        $this->db->where('id', $id);
        return $this->db->get()->result();
    }

    public function getById1($id)
    {
        $this->db->select('ps.id as id_ps, k.id as id_k, e.id as id_e, pe.id as id_pe, ps.keterangan_bukti_1, ps.keterangan_bukti_2, ps.keterangan_bukti_3, ps.keterangan_bukti_4, ps.keterangan_bukti_5, ps.upload_bukti_relevan_1, ps.upload_bukti_relevan_2, ps.upload_bukti_relevan_3, ps.upload_bukti_relevan_4, ps.upload_bukti_relevan_5, ps.tanda_tangan_asesi, s.judul_skema, s.no_skema, ps.id_skema');
        $this->db->from('tb_pilihan_skema ps');
        $this->db->join('tb_skema s', 's.id = ps.id_skema', 'left');
        $this->db->join('tb_unit_kompetensi k', 'k.id_skema = s.id', 'left');
        $this->db->join('tb_unit_elemen e', 'e.id_unit_kompetensi = k.id', 'left');
        $this->db->join('tb_unit_pertanyaan_elemen pe', 'pe.id_unit_elemen = e.id', 'left');
        $this->db->where('ps.id', $id);
        return $this->db->get()->row();
    }

    public function getByIdOnAPL02($id)
    {
        $this->db->select('ps.id as id_ps, a.id as id_a, s.id as id_s, da.nama_lengkap, ps.nik_lsp, dd.id as id_dd, ps.id_user_admin, dd.dd_nama_lengkap, dd.dd_nik, dd.dd_tempat_lahir, dd.dd_tgl_lahir, dd.dd_jenis_kelamin, dd.dd_kebangsaan, dd.dd_alamat_rumah, dd.dd_no_hp, dd.dd_no_telp, dd.dd_email, dd.dd_kode_pos, dd.dd_kantor, dd.dd_pendidikan_terakhir, dd.dd_tanda_tangan_asesi, dd.dd_foto, dd.k_lembaga, dd.k_jabatan, dd.k_alamat, dd.k_kode_pos, dd.k_fax, dd.k_telp, dd.k_email, ps.id_skema, s.judul_skema, s.no_skema, ps.tujuan_sertifikasi, ps.upload_ktm, ps.upload_transkrip, ps.upload_ktp_sim, ps.sertifikat_pelatihan, ps.upload_pengalaman_kerja, ps.upload_bukti_relevan_1, ps.upload_bukti_relevan_2, ps.upload_bukti_relevan_3, ps.upload_bukti_relevan_4, ps.upload_bukti_relevan_5, ps.tanda_tangan_asesi, ps.tanggal_pengajuan, ps.tanda_tangan_asesor, ps.tanda_tangan_admin, ps.tanggal_pengajuan, ps.tanggal_diterima, ps.keterangan_status, ps.status_diterima, a.nama_asesor');
        $this->db->from('tb_pilihan_skema ps');
        $this->db->join('tb_skema s', 's.id = ps.id_skema', 'left');
        $this->db->join('tb_data_admin da', 'da.id = ps.id_user_admin', 'left');
        $this->db->join('tb_data_diri dd', 'dd.id = ps.id_data_diri', 'left');
        $this->db->join('tb_asesor a', 'a.id = ps.id_asesor', 'left');
        $this->db->where('ps.id', $id);
        return $this->db->get()->row();
    }

    public function getByIdUser($id_user)
    {
        $this->db->select('*');
        $this->db->from('tb_pilihan_skema');
        $this->db->where('id_user', $id_user);
        return $this->db->get()->row();
    }

    function update($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('tb_pilihan_skema', $data);
        return $this->db->affected_rows();
    }

    public function _deleteTandaTanganAsesor($id)
    {
        $product = $this->getById($id);
        $filename = explode(".", $product->tanda_tangan_asesor)[0];
        if (empty($product->tanda_tangan_asesor)) {
            return '';
        } else {
            return array_map('unlink', glob(FCPATH . "/g_ttd_asesor/$filename.*"));
        }
    }

    public function _deleteTandaTanganAdmin($id)
    {
        $product = $this->getById($id);
        $filename = explode(".", $product->tanda_tangan_admin)[0];
        if (empty($product->tanda_tangan_admin)) {
            return '';
        } else {
            return array_map('unlink', glob(FCPATH . "/g_ttd_admin/$filename.*"));
        }
    }

    public function _deleteTandaTanganAsesi($id)
    {
        $product = $this->getById($id);
        $filename = explode(".", $product->tanda_tangan_asesi)[0];
        if (empty($product->tanda_tangan_asesi)) {
            return '';
        } else {
            return array_map('unlink', glob(FCPATH . "/g_ttd_asesi/$filename.*"));
        }
    }

    public function _deleteBuktiRelevan5($id)
    {
        $product = $this->getById($id);
        $filename = explode(".", $product->upload_bukti_relevan_5)[0];
        if (empty($product->upload_bukti_relevan_5)) {
            return '';
        } else {
            return array_map('unlink', glob(FCPATH . "/g_kompetensi/$filename.*"));
        }
    }

    public function _deleteBuktiRelevan4($id)
    {
        $product = $this->getById($id);
        $filename = explode(".", $product->upload_bukti_relevan_4)[0];
        if (empty($product->upload_bukti_relevan_4)) {
            return '';
        } else {
            return array_map('unlink', glob(FCPATH . "/g_kompetensi/$filename.*"));
        }
    }

    public function _deleteBuktiRelevan3($id)
    {
        $product = $this->getById($id);
        $filename = explode(".", $product->upload_bukti_relevan_3)[0];
        if (empty($product->upload_bukti_relevan_3)) {
            return '';
        } else {
            return array_map('unlink', glob(FCPATH . "/g_kompetensi/$filename.*"));
        }
    }

    public function _deleteBuktiRelevan2($id)
    {
        $product = $this->getById($id);
        $filename = explode(".", $product->upload_bukti_relevan_2)[0];
        if (empty($product->upload_bukti_relevan_2)) {
            return '';
        } else {
            return array_map('unlink', glob(FCPATH . "/g_kompetensi/$filename.*"));
        }
    }

    public function _deleteBuktiRelevan1($id)
    {
        $product = $this->getById($id);
        $filename = explode(".", $product->upload_bukti_relevan_1)[0];
        if (empty($product->upload_bukti_relevan_1)) {
            return '';
        } else {
            return array_map('unlink', glob(FCPATH . "/g_kompetensi/$filename.*"));
        }
    }

    public function _deletePengalamanKerja($id)
    {
        $product = $this->getById($id);
        $filename = explode(".", $product->upload_pengalaman_kerja)[0];
        if (empty($product->upload_pengalaman_kerja)) {
            return '';
        } else {
            return array_map('unlink', glob(FCPATH . "/g_pengalaman_kerja/$filename.*"));
        }
    }

    public function _deleteSertifikatPelatihan($id)
    {
        $product = $this->getById($id);
        $filename = explode(".", $product->sertifikat_pelatihan)[0];
        if (empty($product->sertifikat_pelatihan)) {
            return '';
        } else {
            return array_map('unlink', glob(FCPATH . "/g_sertifikat_pelatihan/$filename.*"));
        }
    }

    public function _deleteKtpSim($id)
    {
        $product = $this->getById($id);
        $filename = explode(".", $product->upload_ktp_sim)[0];
        if (empty($product->upload_ktp_sim)) {
            return '';
        } else {
            return array_map('unlink', glob(FCPATH . "/g_ktp_sim/$filename.*"));
        }
    }

    public function _deleteKTM($id)
    {
        $product = $this->getById($id);
        $filename = explode(".", $product->upload_ktm)[0];
        if (empty($product->upload_ktm)) {
            return '';
        } else {
            return array_map('unlink', glob(FCPATH . "/g_ktm/$filename.*"));
        }
    }

    public function _deleteTranskrip($id)
    {
        $product = $this->getById($id);
        $filename = explode(".", $product->upload_transkrip)[0];
        if (empty($product->upload_transkrip)) {
            return '';
        } else {
            return array_map('unlink', glob(FCPATH . "/g_transkrip_nilai/$filename.*"));
        }
    }


    public function updateDokumen($id, $var, $data)
    {
        if ($var == 'upload_ktm') {
            $this->_deleteKTM($id);
        } else if ($var == 'upload_transkrip') {
            $this->_deleteTranskrip($id);
        } else if ($var == 'upload_ktp_sim') {
            $this->_deleteKtpSim($id);
        } else if ($var == 'sertifikat_pelatihan') {
            $this->_deleteSertifikatPelatihan($id);
        } else if ($var == 'upload_pengalaman_kerja') {
            $this->_deletePengalamanKerja($id);
        } else if ($var == 'upload_bukti_relevan_1') {
            $this->_deleteBuktiRelevan1($id);
        } else if ($var == 'upload_bukti_relevan_2') {
            $this->_deleteBuktiRelevan2($id);
        } else if ($var == 'upload_bukti_relevan_3') {
            $this->_deleteBuktiRelevan3($id);
        } else if ($var == 'upload_bukti_relevan_4') {
            $this->_deleteBuktiRelevan4($id);
        } else if ($var == 'upload_bukti_relevan_5') {
            $this->_deleteBuktiRelevan5($id);
        } else if ($var == 'tanda_tangan_asesi') {
            $this->_deleteTandaTanganAsesi($id);
        } else if ($var == 'tanda_tangan_admin') {
            $this->_deleteTandaTanganAdmin($id);
        } else if ($var == 'tanda_tangan_asesor') {
            $this->_deleteTandaTanganAsesor($id);
        }
        return $this->db->query('update tb_pilihan_skema set ' . $var . ' = "' . $data . '" where id = "' . $id . '"');
    }

    public function uploadBuktiRelevan($id, $var, $data, $bukti, $value)
    {
        if ($var == 'upload_bukti_relevan_1') {
            $this->_deleteBuktiRelevan1($id);
        } else if ($var == 'upload_bukti_relevan_2') {
            $this->_deleteBuktiRelevan2($id);
        } else if ($var == 'upload_bukti_relevan_3') {
            $this->_deleteBuktiRelevan3($id);
        } else if ($var == 'upload_bukti_relevan_4') {
            $this->_deleteBuktiRelevan4($id);
        } else if ($var == 'upload_bukti_relevan_5') {
            $this->_deleteBuktiRelevan5($id);
        }
        return $this->db->query('update tb_pilihan_skema set ' . $var . ' = "' . $data . '", ' . $bukti . '="' . $value . '" where id = "' . $id . '"');
    }

    public function update_ttd($id, $data)
    {
        return $this->db->query('update tb_pilihan_skema set tanda_tangan_asesi = "' . $data . '" where id = "' . $id . '"');
    }

    public function update_delete($id)
    {
        return $this->db->query('update tb_pilihan_skema set status_delete = 1 where id = "' . $id . '"');
    }

    public function pulihkan_delete($id)
    {
        return $this->db->query('update tb_pilihan_skema set status_delete = 0 where id = "' . $id . '"');
    }

    public function accept_confirm($id, $ttd)
    {
        date_default_timezone_set('Asia/Jakarta');
        return $this->db->query('update tb_pilihan_skema set status_diterima = 1, tanggal_diterima = "' . date('Y-m-d') . '", tanda_tangan_admin = "' . $ttd . '" where id = "' . $id . '"');
    }

    public function deny_confirm($id)
    {
        return $this->db->query('update tb_pilihan_skema set status_diterima = 2 where id = "' . $id . '"');
    }

    public function confirm_lengkap($id)
    {
        return $this->db->query('update tb_pilihan_skema set status_dokumen = 1 where id = "' . $id . '"');
    }

    public function confirm_selesai($id)
    {
        return $this->db->query('update tb_pilihan_skema set status_selesai = "selesai" where id = "' . $id . '"');
    }

    function delete($id)
    {
        $this->_deleteKTM($id);
        $this->_deleteTranskrip($id);
        $this->_deleteKtpSim($id);
        $this->_deleteSertifikatPelatihan($id);
        $this->_deletePengalamanKerja($id);
        $this->_deleteBuktiRelevan1($id);
        $this->_deleteBuktiRelevan2($id);
        $this->_deleteBuktiRelevan3($id);
        $this->_deleteBuktiRelevan4($id);
        $this->_deleteBuktiRelevan5($id);
        // $this->_deleteTandaTanganAsesi($id);
        // $this->_deleteTandaTanganAdmin($id);
        // $this->_deleteTandaTanganAsesor($id);

        $this->db->where('id', $id);
        $this->db->delete('tb_pilihan_skema');
    }
}

/* End of file M_tb_pilihan_skema.php */
