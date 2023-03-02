<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Home_model extends CI_Model
{

    public function totalSkema()
    {
        $this->db->select('count(*) as jlh_skema');
        $this->db->from('tb_skema');
        return $this->db->get()->row();
    }

    public function totalAsesor()
    {
        $this->db->select('count(*) as jlh_asesor');
        $this->db->from('tb_asesor');
        return $this->db->get()->row();
    }

    public function totalPermohonanAsesi()
    {
        $this->db->select('count(*) as jumlah');
        $this->db->from('tb_pilihan_skema');
        $this->db->where('status_diterima', 0);
        return $this->db->get()->row();
    }

    public function totalAsesiDiterima()
    {
        $this->db->select('count(*) as jumlah');
        $this->db->from('tb_pilihan_skema');
        $this->db->where('status_diterima', 1);
        return $this->db->get()->row();
    }

    public function totalAsesiDitolak()
    {
        $this->db->select('count(*) as jumlah');
        $this->db->from('tb_pilihan_skema');
        $this->db->where('status_diterima', 2);
        return $this->db->get()->row();
    }

    public function totalPenggunaOnline()
    {
        $this->db->select('count(*) as jumlah');
        $this->db->from('users');
        $this->db->where('online_status', 'online');
        return $this->db->get()->row();
    }
}

/* End of file Home_model.php */
