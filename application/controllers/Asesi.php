<?php

/** 
 * @Author: FItra Arrafiq (fitraarrafiq@gmail.com)
 * @Date  : 2021-01-28 06: 59: 33
 * @Desc  : COntroller Asesi
 */
defined('BASEPATH') or exit('No direct script access allowed');

class Asesi extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        // Load google oauth library
        $this->load->library('google');
        $this->load->helper('notif&log');
        $this->load->helper('my_function');
        // Load user model
        $this->load->model(array('User', 'M_jadwal', 'M_pemberitahuan', 'B_notif_model', 'B_user_log_model', 'M_data_diri', 'M_skema', 'M_unit_pertanyaan', 'M_unit_element', 'M_pilihan_skema', 'M_apl_02_finish', 'M_unit_kompetensi', 'M_apl_02'));
    }

    public function index()
    {
        // Redirect to login page if the user not logged in
        $temp = $this->User->getuserById($this->session->userdata('id'));
        if (!$this->session->userdata('loggedIn')) {
            $this->session->set_flashdata('result_login', 'Silahkan Log in untuk mengakses sistem !');
            redirect('/auth/');
        } else if ($temp[0]->online_status != "online") {
            $this->session->set_flashdata('result_login', 'Silahkan Log in kembali untuk mengakses sistem !');
            redirect('auth/force_logout');
        } else {
            $view['title']            = 'Halaman Home';
            $view['pageName']         = 'home';
            $view['checkUserOnAsesi'] = $this->M_data_diri->checkUserOnAsesi($this->session->userdata('id'));
            $view['getPilihanSkema']  = $this->M_pilihan_skema->getDataByIdUser($this->session->userdata('id'));
            $view['getJadwal']        = $this->M_jadwal->getData();
            $view['getPemberitahuan'] = $this->M_pemberitahuan->getData();

            $this->load->view('index_asesi', $view);
        }
    }

    public function dataDiri($param = '', $id = '')
    {
        // Redirect to login page if the user not logged in
        $temp = $this->User->getuserById($this->session->userdata('id'));
        if (!$this->session->userdata('loggedIn')) {
            $this->session->set_flashdata('result_login', 'Silahkan Log in untuk mengakses sistem !');
            redirect('/auth/');
        } else if ($temp[0]->online_status != "online") {
            $this->session->set_flashdata('result_login', 'Silahkan Log in kembali untuk mengakses sistem !');
            redirect('auth/force_logout');
        } else {
            $view['title']            = 'Halaman Data Diri';
            $view['pageName']         = 'dataDiri';
            $view['checkUserOnAsesi'] = $this->M_data_diri->checkUserOnAsesi($this->session->userdata('id'));
            $view['getByIdUser']      = $this->M_data_diri->getByIdUser($this->session->userdata('id'));
            if ($param == 'formUpdate') {
            } else if ($param == 'getById') {
                $data = $this->Jabatan->getById($id);
                echo json_encode(array('data' => $data));
                die;
            } else if ($param == 'addData') {
                $this->form_validation->set_rules("dd_nik", "NIK", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("dd_tempat_lahir", "Tempat Lahir", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("dd_tgl_lahir", "Tanggal Lahir", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("dd_jenis_kelamin", "Jenis Kelamin", "trim|required", array('required' => '{field} Wajib diisi !', 'matches' => 'Password tidak cocok !'));
                $this->form_validation->set_rules("dd_kebangsaan", "Kebangsaan", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("dd_alamat_rumah", "Alamat Rumah", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("dd_no_hp", "No Hp", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("dd_kode_pos", "Kode Pos", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("dd_email", "Email pribadi", "trim|required|valid_email", array('required' => '{field} Wajib diisi !', 'valid_email' => 'Email harus diisi dengan benar !'));
                $this->form_validation->set_rules("dd_pendidikan_terakhir", "Pendidikan Terakhir", "trim|required", array('required' => '{field} Wajib diisi !'));

                $this->form_validation->set_error_delimiters('<br><small id="text-error" style="color:red;font-size:10px">*', '</small>');
                if ($this->form_validation->run() == FALSE) {
                    $result = array('status' => 'error', 'msg' => 'Data yang anda isi Belum Benar!');
                    foreach ($_POST as $key => $value) {
                        $result['messages'][$key] = form_error($key);
                    }
                } else {
                    $data['id_user']          = $this->session->userdata('id');
                    $data['dd_nama_lengkap']  = htmlspecialchars($this->input->post('dd_nama_lengkap'));
                    $data['dd_nik']           = htmlspecialchars($this->input->post('dd_nik'));
                    $data['dd_tempat_lahir']  = htmlspecialchars($this->input->post('dd_tempat_lahir'));
                    $data['dd_tgl_lahir']     = htmlspecialchars($this->input->post('dd_tgl_lahir'));
                    $data['dd_jenis_kelamin'] = htmlspecialchars($this->input->post('dd_jenis_kelamin'));
                    $data['dd_kebangsaan']    = htmlspecialchars($this->input->post('dd_kebangsaan'));
                    $data['dd_alamat_rumah']  = htmlspecialchars($this->input->post('dd_alamat_rumah'));
                    $data['dd_no_hp']         = htmlspecialchars($this->input->post('dd_no_hp'));
                    if (empty($this->input->post('dd_no_telp'))) {
                        $data['dd_no_telp'] = '0';
                    } else {
                        $data['dd_no_telp'] = htmlspecialchars($this->input->post('dd_no_telp'));
                    }
                    $data['dd_email']               = htmlspecialchars($this->input->post('dd_email'));
                    $data['dd_kode_pos']            = htmlspecialchars($this->input->post('dd_kode_pos'));
                    $data['dd_kantor']              = htmlspecialchars($this->input->post('dd_kantor'));
                    $data['dd_pendidikan_terakhir'] = htmlspecialchars($this->input->post('dd_pendidikan_terakhir'));
                    $data['k_lembaga']              = htmlspecialchars($this->input->post('k_lembaga'));
                    $data['k_jabatan']              = htmlspecialchars($this->input->post('k_jabatan'));
                    $data['k_alamat']               = htmlspecialchars($this->input->post('k_alamat'));
                    $data['k_kode_pos']             = htmlspecialchars($this->input->post('k_kode_pos'));
                    $data['k_fax']                  = htmlspecialchars($this->input->post('k_fax'));
                    $data['k_telp']                 = htmlspecialchars($this->input->post('k_telp'));
                    $data['k_email']                = htmlspecialchars($this->input->post('k_email'));
                    $data['create_date']            = htmlspecialchars($this->input->post('create_date'));
                    $result['messages']               = '';
                    $getByIdUser              = $this->M_data_diri->getByIdUser($data['id_user']);
                    if (!$getByIdUser) {
                        $result = array('status' => 'success', 'msg' => 'Berhasil mendaftar ! <br> <small>Anda dapat memilih skema untuk melakukan sertifikasi !</small>');
                        $this->M_data_diri->addData($data);
                    } else {
                        $result = array('status' => 'error', 'msg' => 'Gagal, anda telah terdaftar !');
                    }
                }
                $csrf = array(
                    'token' => $this->security->get_csrf_hash()
                );
                echo json_encode(array('result' => $result, 'csrf' => $csrf));
                die;
            } else if ($param == 'update') {
                $this->form_validation->set_rules("dd_nama_lengkap", "Nama Lengkap", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("dd_nik", "NIK", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("dd_tempat_lahir", "Tempat Lahir", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("dd_tgl_lahir", "Tanggal Lahir", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("dd_jenis_kelamin", "Jenis Kelamin", "trim|required", array('required' => '{field} Wajib diisi !', 'matches' => 'Password tidak cocok !'));
                $this->form_validation->set_rules("dd_kebangsaan", "Kebangsaan", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("dd_alamat_rumah", "Alamat Rumah", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("dd_no_hp", "No Hp", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("dd_kode_pos", "Kode Pos", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("dd_email", "Email pribadi", "trim|required|valid_email", array('required' => '{field} Wajib diisi !', 'valid_email' => 'Email harus diisi dengan benar !'));
                $this->form_validation->set_rules("dd_pendidikan_terakhir", "Pendidikan Terakhir", "trim|required", array('required' => '{field} Wajib diisi !'));
                // $this->form_validation->set_rules("k_lembaga", "Lembaga/Perusahaan", "trim|required", array('required' => '{field} Wajib diisi !'));
                // $this->form_validation->set_rules("k_jabatan", "Jabatan", "trim|required", array('required' => '{field} Wajib diisi !'));
                // $this->form_validation->set_rules("k_alamat", "Alamat", "trim|required", array('required' => '{field} Wajib diisi !'));
                // $this->form_validation->set_rules("k_kode_pos", "Kode Pos", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">*', '</small>');
                if ($this->form_validation->run() == FALSE) {
                    $result = array('status' => 'error', 'msg' => 'Data yang anda isi belum benar !');
                    foreach ($_POST as $key => $value) {
                        $result['messages'][$key] = form_error($key);
                    }
                } else {
                    $data['id']               = decrypt($this->input->post('id'));
                    $data['id_user']          = $this->session->userdata('id');
                    $data['dd_nama_lengkap']  = htmlspecialchars($this->input->post('dd_nama_lengkap'));
                    $data['dd_nik']           = htmlspecialchars($this->input->post('dd_nik'));
                    $data['dd_tempat_lahir']  = htmlspecialchars($this->input->post('dd_tempat_lahir'));
                    $data['dd_tgl_lahir']     = htmlspecialchars($this->input->post('dd_tgl_lahir'));
                    $data['dd_jenis_kelamin'] = htmlspecialchars($this->input->post('dd_jenis_kelamin'));
                    $data['dd_kebangsaan']    = htmlspecialchars($this->input->post('dd_kebangsaan'));
                    $data['dd_alamat_rumah']  = htmlspecialchars($this->input->post('dd_alamat_rumah'));
                    $data['dd_no_hp']         = htmlspecialchars($this->input->post('dd_no_hp'));
                    if (empty($this->input->post('dd_no_telp'))) {
                        $data['dd_no_telp'] = '0';
                    } else {
                        $data['dd_no_telp'] = htmlspecialchars($this->input->post('dd_no_telp'));
                    }
                    $data['dd_email']    = htmlspecialchars($this->input->post('dd_email'));
                    $data['dd_kode_pos'] = htmlspecialchars($this->input->post('dd_kode_pos'));
                    if (empty($this->input->post('dd_kantor'))) {
                        $data['dd_kantor'] = '0';
                    } else {
                        $data['dd_kantor'] = htmlspecialchars($this->input->post('dd_kantor'));
                    }
                    $data['dd_pendidikan_terakhir'] = htmlspecialchars($this->input->post('dd_pendidikan_terakhir'));
                    $data['k_lembaga']              = htmlspecialchars($this->input->post('k_lembaga'));
                    $data['k_jabatan']              = htmlspecialchars($this->input->post('k_jabatan'));
                    $data['k_alamat']               = htmlspecialchars($this->input->post('k_alamat'));
                    $data['k_kode_pos']             = htmlspecialchars($this->input->post('k_kode_pos'));
                    if (empty($this->input->post('k_fax'))) {
                        $data['k_fax'] = '0';
                    } else {
                        $data['k_fax'] = htmlspecialchars($this->input->post('k_fax'));
                    }
                    if (empty($this->input->post('k_telp'))) {
                        $data['k_telp'] = '0';
                    } else {
                        $data['k_telp'] = htmlspecialchars($this->input->post('k_telp'));
                    }
                    if (empty($this->input->post('k_email'))) {
                        $data['k_email'] = '-';
                    } else {
                        $data['k_email'] = htmlspecialchars($this->input->post('k_email'));
                    }
                    $data['create_date'] = htmlspecialchars($this->input->post('create_date'));
                    $result['messages']    = '';
                    $result        = array('status' => 'success', 'msg' => 'Data Berhasil diubah');
                    $this->M_data_diri->update($data['id'], $data);
                }
                $csrf = array(
                    'token' => $this->security->get_csrf_hash()
                );
                echo json_encode(array('result' => $result, 'csrf' => $csrf));
                die;
            } else if ($param == 'uploadTandaTangan') {
                if (isset($_FILES['dd_tanda_tangan_asesi']['size']) != 0) {
                    $config['upload_path']           = 'g_ttd_asesi';
                    $config['allowed_types']         = 'gif|jpg|png|jpeg';
                    $config['max_size']              = '2048';
                    $new_name                = time() . $_FILES["dd_tanda_tangan_asesi"]['name'];
                    $config['file_name']             = str_replace(array('-', ' '), '_', $new_name);
                    $data['id']                    = $this->input->post('id');
                    $data['dd_tanda_tangan_asesi'] = str_replace(array('-', ' '), '_', $new_name);
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload('dd_tanda_tangan_asesi')) {
                        $this->session->set_flashdata('error', 'Tanda Tangan gagal diupload. ' . $this->upload->display_errors());
                        redirect('data_diri');
                    } else {
                        $this->M_data_diri->updateTandaTangan($data['id'], 'dd_tanda_tangan_asesi', $data['dd_tanda_tangan_asesi']);
                        $this->session->set_flashdata('success', 'Tanda Tangan berhasil diupload!' . $this->upload->display_errors());
                        redirect('data_diri');
                    }
                }
            } else if ($param == 'uploadFoto') {
                if (isset($_FILES['dd_foto']['size']) != 0) {
                    $config['upload_path']   = 'g_foto_asesi';
                    $config['allowed_types'] = 'gif|jpg|png|jpeg';
                    $config['max_size']      = '2048';
                    $new_name        = time() . $_FILES["dd_foto"]['name'];
                    $config['file_name']     = str_replace(array('-', ' '), '_', $new_name);
                    $data['id']            = $this->input->post('id');
                    $data['dd_foto']       = str_replace(array('-', ' '), '_', $new_name);
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload('dd_foto')) {
                        $this->session->set_flashdata('error', 'Foto gagal diupload. ' . $this->upload->display_errors());
                        redirect('data_diri');
                    } else {
                        $this->M_data_diri->updateFoto($data['id'], 'dd_foto', $data['dd_foto']);
                        $this->session->set_flashdata('success', 'Foto berhasil diupload!' . $this->upload->display_errors());
                        redirect('data_diri');
                    }
                }
            } else if ($param == 'delete') {
                $cekJabatan = $this->Jabatan->getIdJabByGolongan($id);
                if (empty($cekJabatan)) {
                    $this->Jabatan->delete($id);
                    $result = array('status' => 'success', 'msg' => 'Data berhasil dihapus !');
                } else {
                    $result = array('status' => 'error', 'msg' => 'Gagal, Dokumen sedang digunakan oleh data golongan!');
                }
                echo json_encode(array('result' => $result));
                die;
            }

            $this->load->view('index_asesi', $view);
        }
    }

    public function apl_01($param = '', $id = '')
    {
        date_default_timezone_set('Asia/Jakarta');
        // Redirect to login page if the user not logged in
        $temp = $this->User->getuserById($this->session->userdata('id'));
        if (!$this->session->userdata('loggedIn')) {
            $this->session->set_flashdata('result_login', 'Silahkan Log in untuk mengakses sistem !');
            redirect('/auth/');
        } else if ($temp[0]->online_status != "online") {
            $this->session->set_flashdata('result_login', 'Silahkan Log in kembali untuk mengakses sistem !');
            redirect('auth/force_logout');
        } else {
            $view['title']            = 'Halaman APL 01';
            $view['pageName']         = 'apl_01';
            $view['checkUserOnAsesi'] = $this->M_data_diri->checkUserOnAsesi($this->session->userdata('id'));
            $view['getByIdUser']      = $this->M_data_diri->getByIdUser($this->session->userdata('id'));
            $view['getDataSkema']     = $this->M_skema->getData();
            $view['getPilihanSkema']  = $this->M_pilihan_skema->getDataByIdUser($this->session->userdata('id'));
            $view['getJadwal']        = $this->M_jadwal->getData();
            if ($param == 'addData') {
                $this->form_validation->set_rules("id_skema", "Skema Sertifikasi", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("tujuan_sertifikasi", "Tujuan Sertifikasi", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_error_delimiters('<br><small id="text-error" style="color:red;font-size:10px">*', '</small>');
                if ($this->form_validation->run() == FALSE) {
                    $result = array('status' => 'error', 'msg' => 'Data yang anda isi Belum Benar!');
                    foreach ($_POST as $key => $value) {
                        $result['messages'][$key] = form_error($key);
                    }
                } else {
                    $getDataDiriByIdUser  = $this->M_pilihan_skema->getDataDiriByIdUser($this->session->userdata('id'));
                    $data['id_data_diri']       = $getDataDiriByIdUser->id;
                    $data['id_skema']           = htmlspecialchars($this->input->post('id_skema'));
                    $getJadwalByIdSkema   = $this->M_jadwal->getMulaiJadwalByIdSkema($data['id_skema']);
                    $data['tujuan_sertifikasi'] = htmlspecialchars($this->input->post('tujuan_sertifikasi'));
                    $data['tanggal_pengajuan']  = date('Y-m-d H:i:s');
                    $data['tutup_pendaftaran']  = !empty($getJadwalByIdSkema->akhir_daftar) ? $getJadwalByIdSkema->akhir_daftar : '0';
                    // $data['tanggal_pelaksanaan'] = !empty($getJadwalByIdSkema->tanggal_pelaksanaan) ? $getJadwalByIdSkema->tanggal_pelaksanaan : '0';
                    $data['create_date'] = htmlspecialchars($this->input->post('create_date'));
                    $result['messages']    = '';
                    $cekData       = $this->M_pilihan_skema->getDataByIdUserSkema1($this->session->userdata('id'), $data['id_skema'], 'on_progres');
                    if (empty($getJadwalByIdSkema)) {
                        $result = array('status' => 'error', 'msg' => '<h3>Skema yang anda pilih belum dijadwalkan !</h3>');
                    } else if ($cekData[0]->hitungStatus >= 1) {
                        $result = array('status' => 'error', 'msg' => '<h3>Gagal, Sertifikasi yang anda pilih sedang berlangsung !</h3>');
                    } else {
                        if ($getJadwalByIdSkema->akhir_daftar < date('Y-m-d')) {
                            $result = array('status' => 'error', 'msg' => '<h3>Skema yang anda pilih tidak aktif !</h3>');
                        } else {
                            $result = array('status' => 'success', 'msg' => '<h3>Anda telah berhasil mendaftar sertifikasi !</h3>');
                            $this->M_pilihan_skema->addData($data);
                            $cekData = $this->M_skema->getById($data['id_skema']);
                            regisEmail($this->session->userdata('email'), $cekData->judul_skema);
                        }
                    }
                }
                $csrf = array(
                    'token' => $this->security->get_csrf_hash()
                );
                echo json_encode(array('result' => $result, 'csrf' => $csrf));
                die;
            } else if ($param == 'getById') {
                $data = $this->M_pilihan_skema->getById($id);
                echo json_encode(array('data' => $data));
                die;
            } else if ($param == 'getByIdOnAPL02') {
                $data = $this->M_pilihan_skema->getByIdOnAPL02($id);
                echo json_encode(array('data' => $data));
                die;
            } else if ($param == 'update') {
                $this->form_validation->set_rules("id_skema", "Skema", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("tujuan_sertifikasi", "Tujuan Sertifikasi", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">*', '</small>');
                if ($this->form_validation->run() == FALSE) {
                    $result = array('status' => 'error', 'msg' => 'Data yang anda isi belum benar !');
                    foreach ($_POST as $key => $value) {
                        $result['messages'][$key] = form_error($key);
                    }
                } else {
                    $data['id']                 = $this->input->post('id');
                    $data['id_skema']           = htmlspecialchars($this->input->post('id_skema'));
                    $data['tujuan_sertifikasi'] = htmlspecialchars($this->input->post('tujuan_sertifikasi'));
                    $data['create_date']        = htmlspecialchars($this->input->post('create_date'));
                    $result['messages']           = '';
                    $getDataByIdSkema     = $this->M_pilihan_skema->getDataByIdUserSkema($this->session->userdata('id'), $data['id_skema']);
                    $getJadwalByIdSkema   = $this->M_jadwal->getMulaiJadwalByIdSkema($data['id_skema']);
                    $cekData              = $this->M_pilihan_skema->getDataByIdUserSkema1($this->session->userdata('id'), $data['id_skema'], 'on_progres');
                    $cekByIdSkema         = $this->M_jadwal->cekByIdSkema($data['id_skema']);
                    if (empty($getJadwalByIdSkema)) {
                        $result = array('status' => 'error', 'msg' => '<h3>Skema yang anda pilih belum dijadwalkan !</h3>');
                    } else if ($cekData[0]->hitungStatus >= 1) {
                        $result = array('status' => 'error', 'msg' => '<h3>Gagal, Sertifikasi yang anda pilih sedang berlangsung !</h3>');
                    } else {
                        if ($getJadwalByIdSkema->akhir_daftar < date('Y-m-d')) {
                            $result = array('status' => 'error', 'msg' => '<h3>Skema yang anda pilih tidak aktif !</h3>');
                        } else {
                            $result = array('status' => 'success', 'msg' => '<h3>Anda telah berhasil mengubah data sertifikasi !</h3>');
                            $this->M_pilihan_skema->update($data['id'], $data);
                            $cekData = $this->M_skema->getById($data['id_skema']);
                            regisEmail($this->session->userdata('email'), $cekData->judul_skema);
                        }
                    }
                }
                $csrf = array(
                    'token' => $this->security->get_csrf_hash()
                );
                echo json_encode(array('result' => $result, 'csrf' => $csrf));
                die;
            } else if ($param == 'uploadDokumen') {
                if (isset($_FILES['upload_ktm']['size']) != 0) {
                    $config['upload_path']   = 'g_ktm';
                    $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
                    $config['max_size']      = '2048';
                    $config['overwrite']     = TRUE;
                    $config['remove_space']  = TRUE;
                    $new_name        = time() . $_FILES["upload_ktm"]['name'];
                    $config['file_name']     = str_replace(array('-', ' '), '_', $new_name);
                    $data['id']            = $this->input->post('id');
                    $data['upload_ktm']    = str_replace(array('-', ' '), '_', $new_name);
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload('upload_ktm')) {
                        $this->session->set_flashdata('error', 'KTM gagal diupload. ' . $this->upload->display_errors());
                        redirect('asesi/apl_01');
                    } else {
                        $this->M_pilihan_skema->updateDokumen($data['id'], 'upload_ktm', $data['upload_ktm']);
                        $this->session->set_flashdata('success', 'KTM berhasil diupload!');
                        redirect('asesi/apl_01');
                    }
                } else if (isset($_FILES['upload_transkrip']['size']) != 0) {
                    $config['upload_path']      = 'g_transkrip_nilai';
                    $config['allowed_types']    = 'gif|jpg|png|jpeg|pdf';
                    $config['max_size']         = '2048';
                    $config['overwrite']        = TRUE;
                    $new_name           = time() . $_FILES["upload_transkrip"]['name'];
                    $config['file_name']        = str_replace(array('-', ' '), '_', $new_name);
                    $data['id']               = $this->input->post('id');
                    $data['upload_transkrip'] = str_replace(array('-', ' '), '_', $new_name);
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload('upload_transkrip')) {
                        $this->session->set_flashdata('error', 'Transkrip Nilai gagal diupload. ' . $this->upload->display_errors());
                        redirect('asesi/apl_01');
                    } else {
                        $this->M_pilihan_skema->updateDokumen($data['id'], 'upload_transkrip', $data['upload_transkrip']);
                        $this->session->set_flashdata('success', 'Transkrip Nilai berhasil diupload!');
                        redirect('asesi/apl_01');
                    }
                } else if (isset($_FILES['upload_ktp_sim']['size']) != 0) {
                    $config['upload_path']    = 'g_ktp_sim';
                    $config['allowed_types']  = 'gif|jpg|png|jpeg|pdf';
                    $config['max_size']       = '2048';
                    $config['overwrite']      = TRUE;
                    $new_name         = time() . $_FILES["upload_ktp_sim"]['name'];
                    $config['file_name']      = str_replace(array('-', ' '), '_', $new_name);
                    $data['id']             = $this->input->post('id');
                    $data['upload_ktp_sim'] = str_replace(array('-', ' '), '_', $new_name);
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload('upload_ktp_sim')) {
                        $this->session->set_flashdata('error', 'KTP/SIM gagal diupload. ' . $this->upload->display_errors());
                        redirect('asesi/apl_01');
                    } else {
                        $this->M_pilihan_skema->updateDokumen($data['id'], 'upload_ktp_sim', $data['upload_ktp_sim']);
                        $this->session->set_flashdata('success', 'KTP/SIM berhasil diupload!');
                        redirect('asesi/apl_01');
                    }
                } else if (isset($_FILES['sertifikat_pelatihan']['size']) != 0) {
                    $config['upload_path']          = 'g_sertifikat_pelatihan';
                    $config['allowed_types']        = 'gif|jpg|png|jpeg|pdf';
                    $config['max_size']             = '2048';
                    $config['overwrite']            = TRUE;
                    $new_name               = time() . $_FILES["sertifikat_pelatihan"]['name'];
                    $config['file_name']            = str_replace(array('-', ' '), '_', $new_name);
                    $data['id']                   = $this->input->post('id');
                    $data['sertifikat_pelatihan'] = str_replace(array('-', ' '), '_', $new_name);
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload('sertifikat_pelatihan')) {
                        $this->session->set_flashdata('error', 'Sertifikat gagal diupload. ' . $this->upload->display_errors());
                        redirect('asesi/apl_01');
                    } else {
                        $this->M_pilihan_skema->updateDokumen($data['id'], 'sertifikat_pelatihan', $data['sertifikat_pelatihan']);
                        $this->session->set_flashdata('success', 'Sertifikat berhasil diupload!');
                        redirect('asesi/apl_01');
                    }
                } else if (isset($_FILES['upload_pengalaman_kerja']['size']) != 0) {
                    $config['upload_path']             = 'g_pengalaman_kerja';
                    $config['allowed_types']           = 'gif|jpg|png|jpeg|pdf';
                    $config['max_size']                = '2048';
                    $new_name                  = time() . $_FILES["upload_pengalaman_kerja"]['name'];
                    $config['file_name']               = str_replace(array('-', ' '), '_', $new_name);
                    $data['id']                      = $this->input->post('id');
                    $data['upload_pengalaman_kerja'] = str_replace(array('-', ' '), '_', $new_name);
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload('upload_pengalaman_kerja')) {
                        $this->session->set_flashdata('error', 'Pengalaman Kerja gagal diupload. ' . $this->upload->display_errors());
                        redirect('asesi/apl_01');
                    } else {
                        $this->M_pilihan_skema->updateDokumen($data['id'], 'upload_pengalaman_kerja', $data['upload_pengalaman_kerja']);
                        $this->session->set_flashdata('success', 'Pengalaman Kerja berhasil diupload!' . $this->upload->display_errors());
                        redirect('asesi/apl_01');
                    }
                } else if (isset($_FILES['upload_bukti_relevan_1']['size']) != 0) {
                    $config['upload_path']            = 'g_kompetensi';
                    $config['allowed_types']          = 'gif|jpg|png|jpeg|pdf';
                    $config['max_size']               = '2048';
                    $new_name                 = time() . $_FILES["upload_bukti_relevan_1"]['name'];
                    $config['file_name']              = str_replace(array('-', ' '), '_', $new_name);
                    $data['id']                     = $this->input->post('id');
                    $data['keterangan_bukti_1']     = htmlspecialchars($this->input->post('keterangan_bukti_1'));
                    $data['upload_bukti_relevan_1'] = str_replace(array('-', ' '), '_', $new_name);
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload('upload_bukti_relevan_1')) {
                        $this->session->set_flashdata('error', 'Bukti Kompetensi Relevan 1 gagal diupload. ' . $this->upload->display_errors());
                        redirect('asesi/apl_01');
                    } else {
                        $this->M_pilihan_skema->uploadBuktiRelevan($data['id'], 'upload_bukti_relevan_1', $data['upload_bukti_relevan_1'], 'keterangan_bukti_1', $data['keterangan_bukti_1']);
                        $this->session->set_flashdata('success', 'Bukti Kompetensi Relevan 1 berhasil diupload!');
                        redirect('asesi/apl_01');
                    }
                } else if (isset($_FILES['upload_bukti_relevan_2']['size']) != 0) {
                    $config['upload_path']            = 'g_kompetensi';
                    $config['allowed_types']          = 'gif|jpg|png|jpeg|pdf';
                    $config['max_size']               = '2048';
                    $new_name                 = time() . $_FILES["upload_bukti_relevan_2"]['name'];
                    $config['file_name']              = str_replace(array('-', ' '), '_', $new_name);
                    $data['id']                     = $this->input->post('id');
                    $data['keterangan_bukti_2']     = htmlspecialchars($this->input->post('keterangan_bukti_2'));
                    $data['upload_bukti_relevan_2'] = str_replace(array('-', ' '), '_', $new_name);
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload('upload_bukti_relevan_2')) {
                        $this->session->set_flashdata('error', 'Bukti Kompetensi Relevan 2 gagal diupload. ' . $this->upload->display_errors());
                        redirect('asesi/apl_01');
                    } else {
                        $this->M_pilihan_skema->uploadBuktiRelevan($data['id'], 'upload_bukti_relevan_2', $data['upload_bukti_relevan_2'], 'keterangan_bukti_2', $data['keterangan_bukti_2']);

                        // $this->M_pilihan_skema->updateDokumen($data['id'], 'upload_bukti_relevan_2', $data['upload_bukti_relevan_2']);
                        $this->session->set_flashdata('success', 'Bukti Kompetensi Relevan 2 berhasil diupload!');
                        redirect('asesi/apl_01');
                    }
                } else if (isset($_FILES['upload_bukti_relevan_3']['size']) != 0) {
                    $config['upload_path']        = 'g_kompetensi';
                    $config['allowed_types']      = 'gif|jpg|png|jpeg|pdf';
                    $config['max_size']           = '2048';
                    $new_name             = time() . $_FILES["upload_bukti_relevan_3"]['name'];
                    $config['file_name']          = str_replace(array('-', ' '), '_', $new_name);
                    $data['id']                 = htmlspecialchars($this->input->post('id'));
                    $data['keterangan_bukti_3'] = htmlspecialchars($this->input->post('keterangan_bukti_3'));

                    $data['upload_bukti_relevan_3'] = str_replace(array('-', ' '), '_', $new_name);
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload('upload_bukti_relevan_3')) {
                        $this->session->set_flashdata('error', 'Bukti Kompetensi Relevan 3 gagal diupload. ' . $this->upload->display_errors());
                        redirect('asesi/apl_01');
                    } else {
                        $this->M_pilihan_skema->uploadBuktiRelevan($data['id'], 'upload_bukti_relevan_3', $data['upload_bukti_relevan_3'], 'keterangan_bukti_3', $data['keterangan_bukti_3']);
                        // $this->M_pilihan_skema->updateDokumen($data['id'], 'upload_bukti_relevan_3', str_replace(' ', '_', $data['upload_bukti_relevan_3']));
                        $this->session->set_flashdata('success', 'Bukti Kompetensi Relevan 3 berhasil diupload!' . $this->upload->display_errors());
                        redirect('asesi/apl_01');
                    }
                } else if (isset($_FILES['upload_bukti_relevan_4']['size']) != 0) {
                    $config['upload_path']        = 'g_kompetensi';
                    $config['allowed_types']      = 'gif|jpg|png|jpeg|pdf';
                    $config['max_size']           = '2048';
                    $new_name             = time() . $_FILES["upload_bukti_relevan_4"]['name'];
                    $config['file_name']          = str_replace(array('-', ' '), '_', $new_name);
                    $data['id']                 = $this->input->post('id');
                    $data['keterangan_bukti_4'] = htmlspecialchars($this->input->post('keterangan_bukti_4'));

                    $data['upload_bukti_relevan_4'] = str_replace(array('-', ' '), '_', $new_name);
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload('upload_bukti_relevan_4')) {
                        $this->session->set_flashdata('error', 'Bukti Kompetensi Relevan 4 gagal diupload. ' . $this->upload->display_errors());
                        redirect('asesi/apl_01');
                    } else {
                        $this->M_pilihan_skema->uploadBuktiRelevan($data['id'], 'upload_bukti_relevan_4', $data['upload_bukti_relevan_4'], 'keterangan_bukti_4', $data['keterangan_bukti_4']);
                        // $this->M_pilihan_skema->updateDokumen($data['id'], 'upload_bukti_relevan_4', $data['upload_bukti_relevan_4']);
                        $this->session->set_flashdata('success', 'Bukti Kompetensi Relevan 4 berhasil diupload!');
                        redirect('asesi/apl_01');
                    }
                } else if (isset($_FILES['upload_bukti_relevan_5']['size']) != 0) {
                    $config['upload_path']        = 'g_kompetensi';
                    $config['allowed_types']      = 'gif|jpg|png|jpeg|pdf';
                    $config['max_size']           = '2048';
                    $new_name             = time() . $_FILES["upload_bukti_relevan_5"]['name'];
                    $config['file_name']          = str_replace(array('-', ' '), '_', $new_name);
                    $data['id']                 = $this->input->post('id');
                    $data['keterangan_bukti_5'] = htmlspecialchars($this->input->post('keterangan_bukti_5'));

                    $data['upload_bukti_relevan_5'] = str_replace(array('-', ' '), '_', $new_name);
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload('upload_bukti_relevan_5')) {
                        $this->session->set_flashdata('error', 'Bukti Kompetensi Relevan 5 gagal diupload. ' . $this->upload->display_errors());
                        redirect('asesi/apl_01');
                    } else {
                        $this->M_pilihan_skema->uploadBuktiRelevan($data['id'], 'upload_bukti_relevan_5', $data['upload_bukti_relevan_5'], 'keterangan_bukti_5', $data['keterangan_bukti_5']);
                        // $this->M_pilihan_skema->updateDokumen($data['id'], 'upload_bukti_relevan_5', $data['upload_bukti_relevan_5']);
                        $this->session->set_flashdata('success', 'Bukti Kompetensi Relevan 5 berhasil diupload!');
                        redirect('asesi/apl_01');
                    }
                } else if (isset($_FILES['tanda_tangan_asesi']['size']) != 0) {
                    $config['upload_path']        = 'g_ttd_asesi';
                    $config['allowed_types']      = 'gif|jpg|png|jpeg|pdf';
                    $config['max_size']           = '2048';
                    $config['overwrite']          = TRUE;
                    $new_name             = time() . $_FILES["tanda_tangan_asesi"]['name'];
                    $config['file_name']          = str_replace(array('-', ' '), '_', $new_name);
                    $data['id']                 = $this->input->post('id');
                    $data['tanda_tangan_asesi'] = str_replace(array('-', ' '), '_', $new_name);
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload('tanda_tangan_asesi')) {
                        $this->session->set_flashdata('error', 'Tanda Tangan Asesi gagal diupload. ' . $this->upload->display_errors());
                        redirect('asesi/apl_01');
                    } else {
                        $this->M_pilihan_skema->updateDokumen($data['id'], 'tanda_tangan_asesi', $data['tanda_tangan_asesi']);
                        $this->session->set_flashdata('success', 'Tanda Tangan Asesi berhasil diupload!');
                        redirect('asesi/apl_01');
                    }
                }
            } else if ($param == 'confirmLengkap') {
                // $this->M_pilihan_skema->update_delete($id);
                $this->M_pilihan_skema->confirm_lengkap($id);
                $result = array('status' => 'success', 'msg' => 'Berhasil di Konfirmasi !');
                echo json_encode(array('result' => $result));
                die;
            } else if ($param == 'confirmSelesai') {
                // $this->M_pilihan_skema->update_delete($id);
                $getApl02FinishByIdPilihanSkema = $this->M_apl_02_finish->getDataByIdPilSkema($id);
                if (empty($getApl02FinishByIdPilihanSkema->tanda_tangan_asesor)) {
                    $result = array('status' => 'error', 'msg' => 'Maaf, anda belum melakukan asesmen mandiri atau belum diases oleh asesor !');
                } else {
                    $this->M_pilihan_skema->confirm_selesai($id);
                    $getPilSkema  = $this->M_pilihan_skema->getById($id);
                    $getSkemaById = $this->M_skema->getById($getPilSkema->id_skema);
                    selesaiSertifikasiEmail($this->session->userdata('email'), $getSkemaById->judul_skema);
                    $result = array('status' => 'success', 'msg' => 'Berhasil dikonfirmasi !');
                }
                echo json_encode(array('result' => $result));
                die;
            } else if ($param == 'delete') {
                $this->M_pilihan_skema->update_delete($id);
                // $this->M_pilihan_skema->delete($id);
                $result = array('status' => 'success', 'msg' => 'Data berhasil dihapus !');
                echo json_encode(array('result' => $result));
                die;
            } else if ($param == 'verifikasiTandaTangan') {
                $id_ttd       = htmlspecialchars($this->input->post('id'));
                $tanda_tangan = htmlspecialchars($this->input->post('tanda_tangan_asesi'));
                $cekData      = $this->M_pilihan_skema->getById($id_ttd);
                if (empty($tanda_tangan)) {
                    $result = array('status' => 'error', 'msg' => '<h3>Gagal, file tanda tangan tidak ditemukan, silahkan lengkapi tanda tangan anda terlebih dahulu pada menu data diri !</h3>');
                } else if (empty($cekData->upload_ktm) || empty($cekData->upload_transkrip) || empty($cekData->upload_ktp_sim)) {
                    $result = array('status' => 'error', 'msg' => '<h3>Silahkan upload dokumen penting terlebih dahulu !</h3>');
                } else {
                    $this->M_pilihan_skema->update_ttd($id_ttd, $tanda_tangan);
                    $result = array('status' => 'success', 'msg' => 'Berhasil mengkonfirmasi dokumen permohonan asesi !');
                }
                $csrf = array(
                    'token' => $this->security->get_csrf_hash()
                );
                echo json_encode(array('result' => $result, 'csrf' => $csrf));
                die;
            }
            $this->load->view('index_asesi', $view);
        }
    }

    public function apl_02_finish($param = '', $id = '')
    {
        date_default_timezone_set('Asia/Jakarta');
        // Redirect to login page if the user not logged in
        $temp = $this->User->getuserById($this->session->userdata('id'));
        if (!$this->session->userdata('loggedIn')) {
            $this->session->set_flashdata('result_login', 'Silahkan Log in untuk mengakses sistem !');
            redirect('/auth/');
        } else if ($temp[0]->online_status != "online") {
            $this->session->set_flashdata('result_login', 'Silahkan Log in kembali untuk mengakses sistem !');
            redirect('auth/force_logout');
        } else {
            $view['title']            = 'Dokumen APL-02';
            $view['pageName']         = 'apl_02';
            $view['checkUserOnAsesi'] = $this->M_data_diri->checkUserOnAsesi($this->session->userdata('id'));
            $view['getByIdUser']      = $this->M_data_diri->getByIdUser($this->session->userdata('id'));
            $view['getDataSkema']     = $this->M_skema->getData();
            $view['getPilihanSkema']  = $this->M_pilihan_skema->getDataByIdUser($this->session->userdata('id'));

            if ($param == 'getByIdPilSkema') {
                $data = $this->M_apl_02_finish->getByIdPilSkema($id);
                echo json_encode(array('preg' => $data));
                die;
            } else if ($param == 'getTukByIdPilSkema') {
                $data = $this->M_apl_02_finish->getDataByIdPilSkema($id);
                echo json_encode(array('preg' => $data));
                die;
            } else if ($param == 'addData_apl02_finish') {
                $this->form_validation->set_rules("tuk", "TUK", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("nama_asesor", "Nama Asesor", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("nama_asesi", "Nama Peserta", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("tanggal", "Tanggal", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("judul_skema", "Judul Skema", "trim|required", array('required' => '{field} Wajib diisi !'));

                $this->form_validation->set_error_delimiters('<br><small id="text-error" style="color:red;font-size:11px">*', '</small>');
                if ($this->form_validation->run() == FALSE) {
                    $result = array('status' => 'error', 'msg' => 'Data Belum Lengkap !');
                    foreach ($_POST as $key => $value) {
                        $result['messages'][$key] = form_error($key);
                    }
                } else {
                    $data['id_asesi']         = htmlspecialchars($this->input->post('id_asesi'));
                    $data['id_asesor']        = htmlspecialchars($this->input->post('id_asesor'));
                    $data['tuk']              = htmlspecialchars($this->input->post('tuk'));
                    $data['nama_asesor']      = htmlspecialchars($this->input->post('nama_asesor'));
                    $data['nama_asesi']       = htmlspecialchars($this->input->post('nama_asesi'));
                    $data['tanggal']          = htmlspecialchars($this->input->post('tanggal'));
                    $data['id_pilihan_skema'] = htmlspecialchars($this->input->post('id_ps'));
                    $data['judul_skema']      = htmlspecialchars($this->input->post('judul_skema'));
                    $data['create_date']      = date('Y-m-d');
                    $data['status_delete']    = '0';
                    $getByIdPilSkema    = $this->M_apl_02_finish->getByIdPilSkema($data['id_pilihan_skema']);
                    $result['messages']         = '';
                    if (($getByIdPilSkema)) {
                        $result = array('status' => 'error', 'msg' => 'Anda sudah melengkapi data asesor !');
                    } else {
                        $result = array('status' => 'success', 'msg' => 'Data berhasil ditambahkan');
                        $this->M_apl_02_finish->addData($data);
                        $this->B_user_log_model->addLog(userLog('add_data',  $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name') . ' Menambahkan data pada tabel apl_02_finish ' . $data['id_pilihan_skema'] . '', $this->session->userdata('id')));
                    }
                }
                $csrf = array(
                    'token' => $this->security->get_csrf_hash()
                );
                echo json_encode(array('result' => $result, 'csrf' => $csrf));
                die;
            } else if ($param == 'uploadDokumen') {
                if (isset($_FILES['tanda_tangan_asesi']['size']) != 0) {
                    $config['upload_path']                = 'g_ttd_asesi_apl_02';
                    $config['allowed_types']              = 'gif|jpg|png|jpeg|pdf';
                    $config['max_size']                   = '2048';
                    $new_name                     = time() . $_FILES["tanda_tangan_asesi"]['name'];
                    $config['file_name']                  = str_replace(array('-', ' '), '_', $new_name);
                    $data['id_pilihan_skema']           = htmlspecialchars($this->input->post('id_pilihan_skema'));
                    $data['tanda_tangan_asesi']         = str_replace(array('-', ' '), '_', $new_name);
                    $data['tanggal_tanda_tangan_asesi'] = htmlspecialchars($this->input->post('tanggal_tanda_tangan_asesi'));

                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload('tanda_tangan_asesi')) {
                        $this->session->set_flashdata('error', 'Tanda Tangan gagal diupload. ' . $this->upload->display_errors());
                        redirect('asesi/apl_02_finish');
                    } else {
                        $this->M_apl_02_finish->updateDokumen($data['id_pilihan_skema'], 'tanda_tangan_asesi', $data['tanda_tangan_asesi']);
                        $this->M_apl_02_finish->updateTanggalUploadTTD($data['id_pilihan_skema']);
                        $this->session->set_flashdata('success', 'Tanda Tangan berhasil diupload!' . $this->upload->display_errors());
                        redirect('asesi/apl_02_finish');
                    }
                }
            } else if ($param == 'uploadTTD') {
                $this->form_validation->set_rules("tanda_tangan_asesi", "Skema", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">*', '</small>');
                if ($this->form_validation->run() == FALSE) {
                    $result = array('status' => 'error', 'msg' => 'File Tanda tangan tidak ditemukan !');
                    foreach ($_POST as $key => $value) {
                        $result['messages'][$key] = form_error($key);
                    }
                } else {
                    $data['id_pilihan_skema']           = htmlspecialchars($this->input->post('id_pilihan_skema'));
                    $data['tanda_tangan_asesi']         = htmlspecialchars($this->input->post('tanda_tangan_asesi'));
                    $data['tanggal_tanda_tangan_asesi'] = htmlspecialchars($this->input->post('tanggal_tanda_tangan_asesi'));
                    $result['messages']                   = '';
                    $result                       = array('status' => 'success', 'msg' => '<h3>Konfirmasi Dokumen Asessment Berhasil dilakukan !</h3>');
                    $this->M_apl_02_finish->updateTTD($data['id_pilihan_skema'], $data);
                }
                $csrf = array(
                    'token' => $this->security->get_csrf_hash()
                );
                echo json_encode(array('result' => $result, 'csrf' => $csrf));
                die;
            }

            $this->load->view('index_asesi', $view);
        }
    }

    public function apl_02($param = '', $id = '')
    {
        date_default_timezone_set('Asia/Jakarta');
        // Redirect to login page if the user not logged in
        $temp = $this->User->getuserById($this->session->userdata('id'));
        if (!$this->session->userdata('loggedIn')) {
            $this->session->set_flashdata('result_login', 'Silahkan Log in untuk mengakses sistem !');
            redirect('/auth/');
        } else if ($temp[0]->online_status != "online") {
            $this->session->set_flashdata('result_login', 'Silahkan Log in kembali untuk mengakses sistem !');
            redirect('auth/force_logout');
        } else {
            $view['title']               = 'Dokumen APL-02';
            $view['pageName']            = 'apl_02_form';
            $view['checkUserOnAsesi']    = $this->M_data_diri->checkUserOnAsesi($this->session->userdata('id'));
            $view['getByIdUser']         = $this->M_data_diri->getByIdUser($this->session->userdata('id'));
            $view['getDataSkema']        = $this->M_skema->getData();
            $view['getPilihanSkema']     = $this->M_pilihan_skema->getDataByIdUser($this->session->userdata('id'));
            $idSkemaPilihan        = $this->input->post('id');
            $view['getPilihanById']      = $this->M_pilihan_skema->getBySkemaId($idSkemaPilihan);
            $view['getPilihanSkemaById'] = $this->M_pilihan_skema->getById1($idSkemaPilihan);
            $view['cekByIdPilihanSkema'] = $this->M_apl_02->cekByIdPilihanSkema($idSkemaPilihan);

            if ($param == 'getByIdPilSkema') {
                $data = $this->M_apl_02_finish->getByIdPilSkema($id);
                echo json_encode(array('preg' => $data));
                die;
            } else if ($param == 'getTukByIdPilSkema') {
                $data = $this->M_apl_02_finish->getDataByIdPilSkema($id);
                echo json_encode(array('preg' => $data));
                die;
            } else if ($param == 'addData') {
                $idSkemaPilihan         = $this->input->post('id_skema');
                $getPertanyaanByIdSkema = $this->M_apl_02->getByIdSkema($idSkemaPilihan);
                $i                      = 1;
                foreach ($getPertanyaanByIdSkema as $row) {
                    $this->form_validation->set_rules('daftar_pertanyaan[' . $row->id_pe . ']', "Daftar Pertanyaan", "trim|required", array('required' => '{field} Wajib diisi !'));
                    $this->form_validation->set_rules('penilaian_kompeten[' . $row->id_pe . ']', "Penilaian Kompeten", "trim|required", array('required' => '{field} Wajib diisi !'));
                    $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">*', '</small>');
                    if ($this->form_validation->run() == FALSE) {
                        $result = array('status' => 'error', 'msg' => 'Seluruh data wajib diisi !');
                        foreach ($_POST as $key => $value) {
                            $result['messages'][$key] = form_error($key);
                        }
                    } else {
                        $data['id_pilihan_skema']          = htmlspecialchars($this->input->post('id_pilihan_skema'));
                        $data['id_unit_kompetensi']        = htmlspecialchars($this->input->post('id_unit_kompetensi[' . $row->id_pe . ']'));
                        $data['id_skema']                  = htmlspecialchars($this->input->post('id_skema'));
                        $data['id_unit_elemen']            = htmlspecialchars($this->input->post('id_unit_elemen[' . $row->id_pe . ']'));
                        $data['id_unit_pertanyaan_elemen'] = htmlspecialchars($this->input->post('id_unit_pertanyaan_elemen[' . $row->id_pe . ']'));
                        $data['judul_skema']               = htmlspecialchars($this->input->post('judul_skema[' . $row->id_pe . ']'));
                        $data['judul_unit_kompetensi']     = htmlspecialchars($this->input->post('judul_unit_kompetensi[' . $row->id_pe . ']'));
                        $data['judul_unit_elemen']         = htmlspecialchars($this->input->post('judul_unit_elemen[' . $row->id_pe . ']'));
                        $data['daftar_pertanyaan']         = htmlspecialchars($this->input->post('daftar_pertanyaan[' . $row->id_pe . ']'));
                        $data['penilaian_kompeten']        = htmlspecialchars($this->input->post('penilaian_kompeten[' . $row->id_pe . ']'));
                        $data['bukti_kompeten']            = htmlspecialchars($this->input->post('bukti_kompeten[' . $row->id_pe . ']'));
                        $data['create_date']               = date('Y-m-d');
                        $data['status_delete']             = '0';
                        $result['messages']                = '';

                        // $cekByIdPilihanSkema = $this->M_apl_02->cekByIdPilihanSkema($data['id_pilihan_skema']);
                        $cekAPL02ByIdPertanyaan = $this->M_apl_02->cekAPL02ByIdPertanyaanAndPilSkema($data['id_unit_pertanyaan_elemen'], $data['id_pilihan_skema']);
                        if ((!empty($cekAPL02ByIdPertanyaan[0]->id_pilihan_skema)) && (!empty($cekAPL02ByIdPertanyaan[0]->id_unit_pertanyaan_elemen))) {
                            $result = array('status' => 'error', 'msg' => 'Gagal, data sudah ada !');
                        } else {
                            $this->M_apl_02->addData($data);
                            $this->B_user_log_model->addLog(userLog('add_data',  $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name') . ' Menambahkan data pada asesmen mandiri untuk pilihan skema' . $data['id_pilihan_skema'] . '', $this->session->userdata('id')));
                            $result = array('status' => 'success', 'msg' => 'Data berhasil ditambahkan');
                        }
                    }
                }
                $csrf = array(
                    'token' => $this->security->get_csrf_hash()
                );
                echo json_encode(array('result' => $result, 'csrf' => $csrf));
                die;
            }

            $this->load->view('index_asesi', $view);
        }
    }

    public function skema($param = '', $id = '')
    {

        date_default_timezone_set('Asia/Jakarta');
        // Redirect to login page if the user not logged in
        $temp = $this->User->getuserById($this->session->userdata('id'));
        if (!$this->session->userdata('loggedIn')) {
            $this->session->set_flashdata('result_login', 'Silahkan Log in untuk mengakses sistem !');
            redirect('/auth/');
        } else if ($temp[0]->online_status != "online") {
            $this->session->set_flashdata('result_login', 'Silahkan Log in kembali untuk mengakses sistem !');
            redirect('auth/force_logout');
        } else {
            $view['title']            = 'Dokumen Skema Sertifikasi';
            $view['pageName']         = 'skema';
            $view['checkUserOnAsesi'] = $this->M_data_diri->checkUserOnAsesi($this->session->userdata('id'));
            $view['getByIdUser']      = $this->M_data_diri->getByIdUser($this->session->userdata('id'));
            $view['getDataSkema']     = $this->M_skema->getData();

            $this->load->view('index_asesi', $view);
        }
    }

    public function skema_saya($param = '', $id = '')
    {
        date_default_timezone_set('Asia/Jakarta');
        // Redirect to login page if the user not logged in
        $temp = $this->User->getuserById($this->session->userdata('id'));
        if (!$this->session->userdata('loggedIn')) {
            $this->session->set_flashdata('result_login', 'Silahkan Log in untuk mengakses sistem !');
            redirect('/auth/');
        } else if ($temp[0]->online_status != "online") {
            $this->session->set_flashdata('result_login', 'Silahkan Log in kembali untuk mengakses sistem !');
            redirect('auth/force_logout');
        } else {
            $view['title']            = 'Skema Saya';
            $view['pageName']         = 'skema_saya';
            $view['checkUserOnAsesi'] = $this->M_data_diri->checkUserOnAsesi($this->session->userdata('id'));
            $view['getByIdUser']      = $this->M_data_diri->getByIdUser($this->session->userdata('id'));
            $view['getPilihanSkema']  = $this->M_pilihan_skema->getSkemaSaya($this->session->userdata('id'));
            if ($param == 'delete') {
                $this->M_pilihan_skema->update_delete($id);
                // $this->M_pilihan_skema->delete($id);
                $result = array('status' => 'success', 'msg' => 'Data berhasil dihapus !');
                echo json_encode(array('result' => $result));
                die;
            }
            $this->load->view('index_asesi', $view);
        }
    }

    public function tempat_sampah($param = '', $id = '')
    {
        date_default_timezone_set('Asia/Jakarta');
        // Redirect to login page if the user not logged in
        $temp = $this->User->getuserById($this->session->userdata('id'));
        if (!$this->session->userdata('loggedIn')) {
            $this->session->set_flashdata('result_login', 'Silahkan Log in untuk mengakses sistem !');
            redirect('/auth/');
        } else if ($temp[0]->online_status != "online") {
            $this->session->set_flashdata('result_login', 'Silahkan Log in kembali untuk mengakses sistem !');
            redirect('auth/force_logout');
        } else {
            $view['title']            = 'Halaman Tempat Sampah';
            $view['pageName']         = 'tempatSampah';
            $view['checkUserOnAsesi'] = $this->M_data_diri->checkUserOnAsesi($this->session->userdata('id'));
            $view['getByIdUser']      = $this->M_data_diri->getByIdUser($this->session->userdata('id'));
            $view['getPilihanSkema']  = $this->M_pilihan_skema->getDataSampahPilihanSkema($this->session->userdata('id'));
            if ($param == 'delete') {
                $this->M_pilihan_skema->delete($id);
                $result = array('status' => 'success', 'msg' => 'Data berhasil dihapus !');
                echo json_encode(array('result' => $result));
                die;
            } else if ($param == 'pulihkan') {
                $this->M_pilihan_skema->pulihkan_delete($id);
                $result = array('status' => 'success', 'msg' => 'Data telah dipulihkan !');
                echo json_encode(array('result' => $result));
                die;
            }
            $this->load->view('index_asesi', $view);
        }
    }

    public function jadwal($param = '', $id = '')
    {
        date_default_timezone_set('Asia/Jakarta');
        // Redirect to login page if the user not logged in
        $temp = $this->User->getuserById($this->session->userdata('id'));
        if (!$this->session->userdata('loggedIn')) {
            $this->session->set_flashdata('result_login', 'Silahkan Log in untuk mengakses sistem !');
            redirect('/auth/');
        } else if ($temp[0]->online_status != "online") {
            $this->session->set_flashdata('result_login', 'Silahkan Log in kembali untuk mengakses sistem !');
            redirect('auth/force_logout');
        } else {
            $view['title']            = 'Jadwal';
            $view['pageName']         = 'jadwal';
            $view['checkUserOnAsesi'] = $this->M_data_diri->checkUserOnAsesi($this->session->userdata('id'));
            $view['getByIdUser']      = $this->M_data_diri->getByIdUser($this->session->userdata('id'));
            $view['getJadwal']        = $this->M_jadwal->getData();

            $this->load->view('index_asesi', $view);
        }
    }

    public function updateDataDiri($id = '')
    {
        $v['title']            = 'Update Data diri';
        $v['pageName']         = 'editDataDiri';
        $v['checkUserOnAsesi'] = $this->M_data_diri->checkUserOnAsesi($this->session->userdata('id'));
        $v['getByIdUser']      = $this->M_data_diri->getByIdUser($this->session->userdata('id'));
        $v['getById']          = $this->M_data_diri->getById(decrypt($id));

        $this->load->view('index_asesi', $v);
    }
}
/* End of file Asesi.php */