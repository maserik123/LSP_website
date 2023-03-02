<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        // Load google oauth library
        $this->load->library('google');
        $this->load->helper('notif&log');
        $this->load->helper('my_function');
        // Load user model
        $this->load->model(array('User', 'M_jadwal', 'M_pesan', 'M_tentang', 'M_pemberitahuan', 'B_notif_model', 'B_user_log_model', 'M_data_diri', 'M_skema', 'M_unit_pertanyaan', 'M_unit_element', 'M_pilihan_skema', 'M_apl_02_finish', 'M_unit_kompetensi', 'M_apl_02'));
    }

    public function index()
    {
        $view['title']            = 'Halaman Home';
        $view['pageName']         = 'home';
        $view['getData'] = $this->M_tentang->getData();

        $this->load->view('index_dashboard', $view);
    }

    public function tentang()
    {
        $view['title']            = 'Halaman Tentang';
        $view['pageName']         = 'tentang';
        $view['getData'] = $this->M_tentang->getData();

        $this->load->view('index_dashboard', $view);
    }

    public function daftarSkema()
    {
        $view['title']            = 'Halaman Tentang';
        $view['pageName']         = 'daftarSkema';
        $view['getSkema'] = $this->M_skema->getData();

        $this->load->view('index_dashboard', $view);
    }

    public function contact()
    {
        $view['title']            = 'Halaman Kontak';
        $view['pageName']         = 'contact';
        $view['getSkema'] = $this->M_skema->getData();

        $this->load->view('index_dashboard', $view);
    }

    public function AddPesan()
    {
        $data['nama'] = $this->input->post('nama');
        $data['email'] = $this->input->post('email');
        $data['isi_pesan'] = $this->input->post('isi_pesan');
        $this->M_pesan->addData($data);
        redirect('dashboard/terkirim');
    }

    public function terkirim()
    {
        $view['title']            = 'Berhasil Terkirim';
        $view['pageName']         = 'terkirim';

        $this->load->view('index_dashboard', $view);
    }
}

/* End of file Dashboard.php */
