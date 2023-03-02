<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Asesor extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        // Load google oauth library
        $this->load->library('google');
        $this->load->library('cetak_pdf');

        $this->load->helper('notif&log');
        $this->load->helper('my_function');
        // Load user model
        $this->load->model(array('User', 'Home_model', 'M_jadwal', 'M_asesor', 'M_apl_02', 'B_notif_model', 'M_apl_02_finish', 'B_user_log_model', 'M_data_diri', 'M_skema', 'M_pilihan_skema', 'M_unit_kompetensi'));
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        // Redirect to login page if the user not logged in
        $temp = $this->User->getuserById($this->session->userdata('id'));
        if (!$this->session->userdata('loggedIn_asesor')) {
            $this->session->set_flashdata('result_login', 'Silahkan Log in untuk mengakses sistem !');
            redirect('/auth/');
        } else if ($temp[0]->online_status != "online") {
            $this->session->set_flashdata('result_login', 'Silahkan Log in kembali untuk mengakses sistem !');
            redirect('auth/force_logout_asesor');
        } else {
            $id_user             = $this->session->userdata('id');
            $view['title']             = 'Halaman Home';
            $view['pageName']          = 'home';
            $view['active_home']       = 'active';
            $view['pageBreadCrumb']    = array();
            $view['checkUserOnAsesor'] = $this->M_asesor->checkUserOnAsesor($id_user);
            $view['getTotalSkema']        = $this->Home_model->totalSkema();
            $view['totalAsesor']          = $this->Home_model->totalAsesor();
            $view['totalPermohonanAsesi'] = $this->Home_model->totalPermohonanAsesi();
            $view['totalAsesiDiterima']   = $this->Home_model->totalAsesiDiterima();
            $view['totalAsesiDitolak']    = $this->Home_model->totalAsesiDitolak();
            $view['totalPenggunaOnline']  = $this->Home_model->totalPenggunaOnline();
            $view['getAllOnlineUser']   = $this->User->getAllOnlineUser();
            $view['getAllData1_1'] = $this->M_pilihan_skema->getAllData1_1();

            $this->load->view('index_asesor', $view);
        }
    }

    // Function untuk menampilkan data permohonan asesi pada halamana home
    public function getDataPermohonanHome()
    {
        $dt    = $this->M_pilihan_skema->getAllData();
        $start = $this->input->post('start');
        $data  = array();
        foreach ($dt['data'] as $row) {
            $id  = encrypt($row->id);
            $th1 = '<div style="font-size:11px;">' . ++$start . '</div>';
            $th2 = '<div style="font-size:11px;">' . $row->dd_nama_lengkap . '</div>';
            $th3 = '<div style="font-size:11px;">' . $row->judul_skema . '</div>';
            $th4 = '<div style="font-size:11px;">' . $row->tujuan_sertifikasi . '</div>';
            $th5 = '<div style="font-size:11px;">' . tgl_indo($row->tanggal_pengajuan) . '</div>';
            $data[]    = gathered_data(array($th1, $th2, $th3, $th4, $th5));
        }
        $dt['data'] = $data;
        echo json_encode($dt);
        die;
    }

    public function jadwal($param = '', $id = '')
    {
        // Redirect to login page if the user not logged in
        $temp = $this->User->getuserById($this->session->userdata('id'));
        if (!$this->session->userdata('loggedIn_asesor')) {
            $this->session->set_flashdata('result_login', 'Silahkan Log in untuk mengakses sistem !');
            redirect('/auth/');
        } else if ($temp[0]->online_status != "online") {
            $this->session->set_flashdata('result_login', 'Silahkan Log in kembali untuk mengakses sistem !');
            redirect('auth/force_logout_asesor');
        } else {
            $view['title']             = 'Halaman Jadwal';
            $view['pageName']          = 'jadwal';
            $view['active_jadwal']     = 'active';
            $view['pageBreadCrumb']    = array('jadwal');
            $id_user             = $this->session->userdata('id');
            $view['checkUserOnAsesor'] = $this->M_asesor->checkUserOnAsesor($id_user);
            $view['getDataJadwal']     = $this->M_jadwal->getData();


            $this->load->view('index_asesor', $view);
        }
    }

    public function data_saya($param = '', $id = '')
    {
        // Redirect to login page if the user not logged in
        $temp = $this->User->getuserById($this->session->userdata('id'));
        if (!$this->session->userdata('loggedIn_asesor')) {
            $this->session->set_flashdata('result_login', 'Silahkan Log in untuk mengakses sistem !');
            redirect('/auth/');
        } else if ($temp[0]->online_status != "online") {
            $this->session->set_flashdata('result_login', 'Silahkan Log in kembali untuk mengakses sistem !');
            redirect('auth/force_logout_asesor');
        } else {
            $view['title']             = 'LSP PCR | Profil Saya';
            $view['pageName']          = 'data_saya';
            $view['active_data_saya']  = 'active';
            $view['pageBreadCrumb']    = array('data_saya');
            $id_user             = $this->session->userdata('id');
            $view['checkUserOnAsesor'] = $this->M_asesor->checkUserOnAsesor($id_user);

            if ($param == 'addData') {
                $this->form_validation->set_rules("nama_asesor", "Nama Asesor", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("no_reg", "No Reg", "trim|required", array('required' => '{field} Wajib diisi !'));

                $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">*', '</small>');
                if ($this->form_validation->run() == FALSE) {
                    $result = array('status' => 'error', 'msg' => 'Data yang anda isi Belum Benar!');
                    foreach ($_POST as $key => $value) {
                        $result['messages'][$key] = form_error($key);
                    }
                } else {
                    $data['id_user']       = htmlspecialchars($this->input->post('id_user'));
                    $data['nama_asesor']   = htmlspecialchars($this->input->post('nama_asesor'));
                    $data['no_reg']        = htmlspecialchars($this->input->post('no_reg'));
                    $data['status_delete'] = '0';
                    $data['create_date']   = date('Y-m-d');

                    $result['messages'] = '';
                    $result     = array('status' => 'success', 'msg' => 'Data berhasil ditambahkan');
                    $this->M_asesor->addData($data);
                    $this->B_user_log_model->addLog(userLog('add_data',  $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name') . ' Menambahkan data skema baru dengan judul ' . $data['nama_asesor'] . '', $this->session->userdata('id')));
                }
                $csrf = array(
                    'token' => $this->security->get_csrf_hash()
                );
                echo json_encode(array('result' => $result, 'csrf' => $csrf));
                die;
            } else if ($param == 'update') {
                $this->form_validation->set_rules("nama_asesor", "Nama Asesor", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("no_reg", "No Reg", "trim|required", array('required' => '{field} Wajib diisi !'));

                $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">*', '</small>');
                if ($this->form_validation->run() == FALSE) {
                    $result = array('status' => 'error', 'msg' => 'Data yang anda isi Belum Benar!');
                    foreach ($_POST as $key => $value) {
                        $result['messages'][$key] = form_error($key);
                    }
                } else {
                    $id_user       = htmlspecialchars($this->input->post('id_user'));
                    $data['nama_asesor']   = htmlspecialchars($this->input->post('nama_asesor'));
                    $data['no_reg']        = htmlspecialchars($this->input->post('no_reg'));

                    $result['messages'] = '';
                    $result     = array('status' => 'success', 'msg' => 'Data berhasil diubah');
                    $this->M_asesor->updateByIdUser($id_user, $data);
                    $this->B_user_log_model->addLog(userLog('add_data',  $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name') . ' Menambahkan data skema baru dengan judul ' . $data['nama_asesor'] . '', $this->session->userdata('id')));
                }
                $csrf = array(
                    'token' => $this->security->get_csrf_hash()
                );
                echo json_encode(array('result' => $result, 'csrf' => $csrf));
                die;
            } else if ($param == 'uploadTandaTangan') {
                if (isset($_FILES['tanda_tangan']['size']) != 0) {
                    $config['upload_path']   = 'g_ttd_asesor';
                    $config['allowed_types'] = 'gif|jpg|png|jpeg';
                    $config['max_size']      = '2048';
                    $new_name        = time() . $_FILES["tanda_tangan"]['name'];
                    $config['file_name']     = str_replace(array('-', ' '), '_', $new_name);
                    $data['id_user']            = $this->input->post('id_user');
                    $data['tanda_tangan']  = str_replace(array('-', ' '), '_', $new_name);
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload('tanda_tangan')) {
                        $this->session->set_flashdata('error', 'Tanda Tangan gagal diupload. ' . $this->upload->display_errors());
                        redirect('asesor');
                    } else {
                        $this->M_asesor->updateTandaTangan($data['id_user'], 'tanda_tangan', $data['tanda_tangan']);
                        $this->session->set_flashdata('success', 'Tanda Tangan berhasil diupload!' . $this->upload->display_errors());
                        redirect('asesor');
                    }
                }
            } else if ($param == 'updatePassword') {
                $this->form_validation->set_rules("password", "Password", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("password_repeat", "Konfirmasi Password", "trim|required|matches[password]", array('required' => '{field} Wajib diisi !'));

                $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">*', '</small>');
                if ($this->form_validation->run() == FALSE) {
                    $result = array('status' => 'error', 'msg' => 'Data yang anda isi belum benar !');
                    foreach ($_POST as $key => $value) {
                        $result['messages'][$key] = form_error($key);
                    }
                } else {

                    $data['id']                  = $this->session->userdata('id');
                    $data['password'] = md5($this->input->post('password'));
                    $result['messages']            = '';
                    $this->User->update_userdata($data['id'], $data);
                    $this->B_user_log_model->addLog(userLog('update_data',  $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name') . ' Mengubah password dengan ID ' . $data['id'] . '', $this->session->userdata('id')));
                    $result = array('status' => 'success', 'msg' => '<h3>Password berhasil diperbarui!</h3>');
                }
                $csrf = array(
                    'token' => $this->security->get_csrf_hash()
                );
                echo json_encode(array('result' => $result, 'csrf' => $csrf));
                die;
            } else if ($param == 'update') {
            }

            $this->load->view('index_asesor', $view);
        }
    }

    public function permintaanAPL02($param = '', $id = '')
    {
        // Redirect to login page if the user not logged in
        $temp = $this->User->getuserById($this->session->userdata('id'));
        if (!$this->session->userdata('loggedIn_asesor')) {
            $this->session->set_flashdata('result_login', 'Silahkan Log in untuk mengakses sistem !');
            redirect('/auth/');
        } else if ($temp[0]->online_status != "online") {
            $this->session->set_flashdata('result_login', 'Silahkan Log in kembali untuk mengakses sistem !');
            redirect('auth/force_logout_asesor');
        } else {
            $view['title']                   = 'Halaman Home';
            $view['pageName']                = 'permintaanAPL02';
            $view['active_permintaan_apl02'] = 'active';
            $view['pageBreadCrumb']          = array('permintaanAPL02');
            $id_user                   = $this->session->userdata('id');
            $view['checkUserOnAsesor']       = $this->M_asesor->checkUserOnAsesor($id_user);
            $view['getAllDataForAsesor']     = $this->M_pilihan_skema->getAllDataForAsesor();

            if ($param == 'getById') {
                $id_decrypt = decrypt($id);
                $data       = $this->M_pilihan_skema->getById($id_decrypt);
                echo json_encode(array('data' => $data));
                die;
            } else if ($param == 'update') {
                $this->form_validation->set_rules("tanggal_pelaksanaan", "Tanggal Pelaksanaan", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">*', '</small>');
                if ($this->form_validation->run() == FALSE) {
                    $result = array('status' => 'error', 'msg' => 'Data yang anda isi belum benar !');
                    foreach ($_POST as $key => $value) {
                        $result['messages'][$key] = form_error($key);
                    }
                } else {

                    $data['id']                  = htmlspecialchars($this->input->post('id'));
                    $data['tanggal_pelaksanaan'] = htmlspecialchars($this->input->post('tanggal_pelaksanaan'));
                    $result['messages']            = '';
                    if ($data['tanggal_pelaksanaan'] < date('Y-m-d')) {
                        $result = array('status' => 'error', 'msg' => '<h3>Tanggal yang diberikan tidak tepat !</h3>');
                    } else {
                        $this->M_pilihan_skema->update($data['id'], $data);
                        $this->B_user_log_model->addLog(userLog('update_data',  $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name') . ' Mengubah data skema dengan ID ' . $data['id'] . '', $this->session->userdata('id')));
                        $result = array('status' => 'success', 'msg' => '<h3>Tanggal Ujian Berhasil ditentukan !</h3>');
                    }
                }
                $csrf = array(
                    'token' => $this->security->get_csrf_hash()
                );
                echo json_encode(array('result' => $result, 'csrf' => $csrf));
                die;
            }

            $this->load->view('index_asesor', $view);
        }
    }

    public function detailAsesi($id)
    {
        $temp = $this->User->getuserById($this->session->userdata('id'));
        if (!$this->session->userdata('loggedIn_asesor')) {
            $this->session->set_flashdata('result_login', 'Silahkan Log in untuk mengakses sistem !');
            redirect('/auth/');
        } else if ($temp[0]->online_status != "online") {
            $this->session->set_flashdata('result_login', 'Silahkan Log in kembali untuk mengakses sistem !');
            redirect('auth/force_logout_asesor');
        } else {
            $view['title']                   = 'Halaman Home';
            $view['pageName']                = 'detailAsesi';
            $view['active_permintaan_apl02'] = 'active';
            $view['pageBreadCrumb']          = array('detailAsesi');
            $id_user                         = $this->session->userdata('id');
            $view['checkUserOnAsesor']       = $this->M_asesor->checkUserOnAsesor($id_user);
            $view['cekDataAsesi']            = $this->M_pilihan_skema->cekDataById(decrypt($id));

            $this->load->view('index_asesor', $view);
        }
    }

    public function asesmenMandiri($param = '', $id = '')
    {
        // Redirect to login page if the user not logged in
        $temp = $this->User->getuserById($this->session->userdata('id'));
        if (!$this->session->userdata('loggedIn_asesor')) {
            $this->session->set_flashdata('result_login', 'Silahkan Log in untuk mengakses sistem !');
            redirect('/auth/');
        } else if ($temp[0]->online_status != "online") {
            $this->session->set_flashdata('result_login', 'Silahkan Log in kembali untuk mengakses sistem !');
            redirect('auth/force_logout_asesor');
        } else {
            $view['title']                  = 'Halaman Home';
            $view['pageName']               = 'asesmenMandiri';
            $view['active_asesmen_mandiri'] = 'active';
            $view['pageBreadCrumb']         = array('asesmenMandiri');
            $id_user                  = $this->session->userdata('id');
            $view['checkUserOnAsesor']      = $this->M_asesor->checkUserOnAsesor($id_user);
            $view['getAllDataForAsesor']    = $this->M_pilihan_skema->getAllDataForAsesor();


            $this->load->view('index_asesor', $view);
        }
    }

    public function lakukanAsesmen($id = '')
    {
        // Redirect to login page if the user not logged in
        $temp = $this->User->getuserById($this->session->userdata('id'));
        if (!$this->session->userdata('loggedIn_asesor')) {
            $this->session->set_flashdata('result_login', 'Silahkan Log in untuk mengakses sistem !');
            redirect('/auth/');
        } else if ($temp[0]->online_status != "online") {
            $this->session->set_flashdata('result_login', 'Silahkan Log in kembali untuk mengakses sistem !');
            redirect('auth/force_logout_asesor');
        } else {
            $view['title']                           = 'Halaman Home';
            $view['pageName']                        = 'lakukanAsesmen';
            $view['active_asesmen_mandiri']          = 'active';
            $view['pageBreadCrumb']                  = array('asesmenMandiri');
            $id_user                           = $this->session->userdata('id');
            $view['id']                              = $id;
            $id_dec                            = decrypt($id);
            $view['checkUserOnAsesor']               = $this->M_asesor->checkUserOnAsesor($id_user);
            $view['getAllDataForAsesorByIdPilSkema'] = $this->M_pilihan_skema->getAllDataForAsesorByIdPilSkema($id_dec);
            $view['getDataByIdPilihanSkema']         = $this->M_apl_02->getDataByIdPilihanSkema($id_dec);
            $view['getDataByIdPilSkema']             = $this->M_apl_02_finish->getDataByIdPilSkema($id_dec);

            $this->load->view('index_asesor', $view);
        }
    }

    public function penilaian_v_a_t_m($param = '', $id = '')
    {

        $temp = $this->User->getuserById($this->session->userdata('id'));
        if (!$this->session->userdata('loggedIn_asesor')) {
            $this->session->set_flashdata('result_login', 'Silahkan Log in untuk mengakses sistem !');
            redirect('/auth/');
        } else if ($temp[0]->online_status != "online") {
            $this->session->set_flashdata('result_login', 'Silahkan Log in kembali untuk mengakses sistem !');
            redirect('auth/force_logout_asesor');
        } else {
            if ($param == 'asesor_v') {
                $this->M_apl_02->asesor_v($id);
                $result = array('status' => 'success', 'msg' => 'Berhasil dikonfirmasi !');
                echo json_encode(array('result' => $result));
                die;
            } else if ($param == 'asesor_a') {
                $this->M_apl_02->asesor_a($id);
                $result = array('status' => 'success', 'msg' => 'Berhasil dikonfirmasi !');
                echo json_encode(array('result' => $result));
                die;
            } else if ($param == 'asesor_t') {
                $this->M_apl_02->asesor_t($id);
                $result = array('status' => 'success', 'msg' => 'Berhasil dikonfirmasi !');
                echo json_encode(array('result' => $result));
                die;
            } else if ($param == 'asesor_m') {
                $this->M_apl_02->asesor_m($id);
                $result = array('status' => 'success', 'msg' => 'Berhasil dikonfirmasi !');
                echo json_encode(array('result' => $result));
                die;
            }
        }
    }

    public function apl_02_finish($param = '', $id = '')
    {
        $temp = $this->User->getuserById($this->session->userdata('id'));
        if (!$this->session->userdata('loggedIn_asesor')) {
            $this->session->set_flashdata('result_login', 'Silahkan Log in untuk mengakses sistem !');
            redirect('/auth/');
        } else if ($temp[0]->online_status != "online") {
            $this->session->set_flashdata('result_login', 'Silahkan Log in kembali untuk mengakses sistem !');
            redirect('auth/force_logout_asesor');
        } else {
            $view['title']                  = 'Halaman Home';
            $view['pageName']               = 'lakukanAsesmen';
            $view['active_asesmen_mandiri'] = 'active';
            $view['pageBreadCrumb']         = array('asesmenMandiri');
            $getDataByUserId = $this->M_asesor->checkUserOnAsesor($this->session->userdata('id'));
            if ($param == 'add_catatan_asesmen_portofolio') {

                $data['id']                         = $this->input->post('id');
                $data['catatan_asesmen_portofolio'] = htmlspecialchars($this->input->post('catatan_asesmen_portofolio'));
                $result['messages']                   = '';
                $result                       = array('status' => 'success', 'msg' => '<h3>Catatan telah diubah !</h3>');
                $this->M_apl_02_finish->updateByIdPilSkema($data['id'], $data);
                $csrf = array(
                    'token' => $this->security->get_csrf_hash()
                );
                echo json_encode(array('result' => $result, 'csrf' => $csrf));
                die;
            } else if ($param == 'add_catatan_uji_kompetensi') {

                $data['id']                     = $this->input->post('id');
                $data['catatan_uji_kompetensi'] = htmlspecialchars($this->input->post('catatan_uji_kompetensi'));
                $result['messages']               = '';
                $result                   = array('status' => 'success', 'msg' => '<h3>Catatan telah diubah !</h3>');
                $this->M_apl_02_finish->updateByIdPilSkema($data['id'], $data);
                $csrf = array(
                    'token' => $this->security->get_csrf_hash()
                );
                echo json_encode(array('result' => $result, 'csrf' => $csrf));
                die;
            } else if ($param == 'terimaKonfirmasi') {
                $this->form_validation->set_rules("no_reg", "No Registrasi", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("tanda_tangan_asesor", "Tanda Tangan", "trim|required", array('required' => '{field} belum ditentukan !'));

                $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">*', '</small>');
                if ($this->form_validation->run() == FALSE) {
                    $result = array('status' => 'error', 'msg' => 'Data yang anda isi Belum Benar!');
                    foreach ($_POST as $key => $value) {
                        $result['messages'][$key] = form_error($key);
                    }
                } else {
                    $data['id_pilihan_skema']       = htmlspecialchars($this->input->post('id'));
                    $data['no_reg']        = htmlspecialchars($this->input->post('no_reg'));
                    $data['tanda_tangan_asesor']   = htmlspecialchars($this->input->post('tanda_tangan_asesor'));
                    $data['tanggal_tanda_tangan_asesor']   = date('Y-m-d');

                    $result['messages'] = '';
                    $result     = array('status' => 'success', 'msg' => 'Data berhasil diubah');
                    $this->M_apl_02_finish->updateByIdPilSkema($data['id_pilihan_skema'], $data);
                    $this->B_user_log_model->addLog(userLog('update_data',  $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name') . ' Mengubah data apl_02_finish dengan id skema pilihan ' . $data['id_pilihan_skema'] . '', $this->session->userdata('id')));
                }
                $csrf = array(
                    'token' => $this->security->get_csrf_hash()
                );
                echo json_encode(array('result' => $result, 'csrf' => $csrf));
                die;
            }

            $this->load->view('index_asesor', $view);
        }
    }

    public function asesi_saya($param = '', $id = '')
    {
        // Redirect to login page if the user not logged in
        $temp = $this->User->getuserById($this->session->userdata('id'));
        if (!$this->session->userdata('loggedIn_asesor')) {
            $this->session->set_flashdata('result_login', 'Silahkan Log in untuk mengakses sistem !');
            redirect('/auth/');
        } else if ($temp[0]->online_status != "online") {
            $this->session->set_flashdata('result_login', 'Silahkan Log in kembali untuk mengakses sistem !');
            redirect('auth/force_logout_asesor');
        } else {
            $id_user             = $this->session->userdata('id');
            $view['checkUserOnAsesor'] = $this->M_asesor->checkUserOnAsesor($id_user);
            $view['title']             = 'Halaman Home';
            $view['pageName']          = 'asesi_saya';
            $view['active_asesi_saya'] = 'active';
            $view['pageBreadCrumb']    = array('asesi_saya');

            $this->load->view('index_asesor', $view);
        }
    }

    public function cetakAsesmenMandiri($id = '')
    {
        $view['title'] = 'Asesmen Mandiri';
        $view['getSkemaAsesi'] = $this->M_apl_02_finish->getDataSkemaByIdPilihan($id);
        $view['getDataByIdPilihanSkema'] = $this->M_apl_02->groupByIdElemen($id);
        $view['groupByUnitKompetensi'] = $this->M_apl_02->groupByUnitKompetensi($id);
        $view['groupByUnitElemen'] = $this->M_apl_02->groupByUnitElemen($id);

        $this->load->library('pdf');
        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->filename = "Dokumen-APl-02-AsesmenMandiri.pdf";

        $this->pdf->loadView('pages_asesor/cetakAsesmenMandiri', $view);
    }
}

/* End of file Asesor.php */
