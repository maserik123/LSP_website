<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Administrator extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('');
        // $this->load->helper('');
        $this->load->library('google');
        $this->load->helper('notif&log');
        $this->load->helper('my_function');
        $this->load->model(array('User', 'M_jadwal', 'M_tentang', 'M_pesan', 'Home_model', 'M_pemberitahuan', 'M_data_admin', 'M_apl_02_finish', 'M_asesor', 'B_notif_model', 'B_user_log_model', 'M_apl_02', 'M_data_diri', 'M_skema', 'M_pilihan_skema', 'M_unit_element', 'M_unit_pertanyaan', 'M_unit_kompetensi'));
    }

    public function index()
    {
        // Redirect to login page if the user not logged in
        $temp = $this->User->getuserById($this->session->userdata('id'));
        if (!$this->session->userdata('loggedIn_admin')) {
            $this->session->set_flashdata('result_login', 'Silahkan Log in untuk mengakses sistem !');
            redirect('/auth/');
        } else if ($temp[0]->online_status != "online") {
            $this->session->set_flashdata('result_login', 'Silahkan Log in kembali untuk mengakses sistem !');
            redirect('auth/force_logout_admin');
        } else {
            $id_user                = $this->session->userdata('id');
            $view['title']                = 'Halaman Home';
            $view['pageName']             = 'home';
            $view['cekDataByIdUser']      = $this->M_data_admin->cekDataByIdUser($id_user);
            $view['getTotalSkema']        = $this->Home_model->totalSkema();
            $view['totalAsesor']          = $this->Home_model->totalAsesor();
            $view['totalPermohonanAsesi'] = $this->Home_model->totalPermohonanAsesi();
            $view['totalAsesiDiterima']   = $this->Home_model->totalAsesiDiterima();
            $view['totalAsesiDitolak']    = $this->Home_model->totalAsesiDitolak();
            $view['totalPenggunaOnline']  = $this->Home_model->totalPenggunaOnline();
            $view['getAllOnlineUser']   = $this->User->getAllOnlineUser();


            $this->load->view('index_admin', $view);
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

    public function konfirmasi_apl01($param = '', $id = '')
    {
        // Redirect to login page if the user not logged in
        $temp = $this->User->getuserById($this->session->userdata('id'));
        if (!$this->session->userdata('loggedIn_admin')) {
            $this->session->set_flashdata('result_login', 'Silahkan Log in untuk mengakses sistem !');
            redirect('/auth/');
        } else if ($temp[0]->online_status != "online") {
            $this->session->set_flashdata('result_login', 'Silahkan Log in kembali untuk mengakses sistem !');
            redirect('auth/force_logout_admin');
        } else {
            $view['title']     = 'Halaman Home';
            $view['pageName']  = 'permintaan_apl01';
            $view['getAsesor'] = $this->M_asesor->getData();
            if ($param == 'getAllData') {
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
                    $th6 = ($row->status_diterima == "1") ? '<div class="badge bg-green">Telah Diterima</div>' : ($row->status_diterima == "2" ? '<div class="badge bg-red">Telah Ditolak</div>' : '<div class="badge bg-warning">Sedang diajukan</div>');
                    $th7 = '<div style="font-size:11px;">' . $row->keterangan_status . '</div>';
                    $th8 = '<button type="button" class="btn btn-sm btn-primary" style="font-size:11px;" onclick=cekPermohonan("' . $id . '")><li class="fa fa-search"></li> Cek Data</button>';
                    $data[]    = gathered_data(array($th1, $th2, $th3, $th4, $th5, $th6, $th7, $th8));
                }
                $dt['data'] = $data;
                echo json_encode($dt);
                die;
            } else if ($param == 'getById') {
                $id_decrypt = decrypt($id);
                $data       = $this->M_pilihan_skema->getById($id_decrypt);
                echo json_encode(array('data' => $data));
                die;
            } else if ($param == 'getById1') {
                $data = $this->M_pilihan_skema->getById($id);
                echo json_encode(array('data' => $data));
                die;
            } else if ($param == 'update') {
                $this->form_validation->set_rules("id_asesor", "Asesor", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("nik_lsp", "NIK LSP", "trim|required", array('required' => '{field} Wajib diisi !'));
                // $this->form_validation->set_rules("keterangan_status", "Keterangan", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">*', '</small>');
                if ($this->form_validation->run() == FALSE) {
                    $result = array('status' => 'error', 'msg' => 'Data yang anda isi belum benar !');
                    foreach ($_POST as $key => $value) {
                        $result['messages'][$key] = form_error($key);
                    }
                } else {
                    $data['id']                = $this->input->post('id');
                    $data['id_asesor']         = htmlspecialchars($this->input->post('id_asesor'));
                    $data['id_user_admin']     = $this->session->userdata('id');
                    $data['nik_lsp']           = htmlspecialchars($this->input->post('nik_lsp'));
                    $data['keterangan_status'] = htmlspecialchars($this->input->post('keterangan_status'));
                    $data['tanggal_diterima']  = htmlspecialchars($this->input->post('tanggal_diterima'));
                    $result['messages']          = '';
                    $this->B_user_log_model->addLog(userLog('update_data',  $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name') . ' Melengkapi Dokumen Asesor dengan ID data ' . $data['id'] . '', $this->session->userdata('id')));

                    $result = array('status' => 'success', 'msg' => '<h3>Data Telah di record !</h3>');
                    $this->M_pilihan_skema->update($data['id'], $data);
                }
                $csrf = array(
                    'token' => $this->security->get_csrf_hash()
                );
                echo json_encode(array('result' => $result, 'csrf' => $csrf));
                die;
            } else if ($param == 'cekDataByIdPilSkema') {
                $id_decrypt = decrypt($id);
                $data       = $this->M_pilihan_skema->cekDataById($id_decrypt);
                echo json_encode(array('data' => $data));
                die;
            } else if ($param == 'update_keterangan') {
                $this->form_validation->set_rules("keterangan_status", "Keterangan", "trim");
                $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">*', '</small>');
                if ($this->form_validation->run() == FALSE) {
                    $result = array('status' => 'error', 'msg' => 'Keterangan Wajib isi !');
                    foreach ($_POST as $key => $value) {
                        $result['messages'][$key] = form_error($key);
                    }
                } else {
                    $data['id']                = $this->input->post('id');
                    $data['keterangan_status'] = htmlspecialchars($this->input->post('keterangan_status'));
                    $result['messages']          = '';
                    $this->B_user_log_model->addLog(userLog('update_data',  $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name') . ' Menambahkan data keterangan pada ID data ' . $data['id'] . '', $this->session->userdata('id')));

                    $result = array('status' => 'success', 'msg' => '<h3>Keterangan telah ditambahkan !</h3>');
                    $this->M_pilihan_skema->update($data['id'], $data);
                }
                $csrf = array(
                    'token' => $this->security->get_csrf_hash()
                );
                echo json_encode(array('result' => $result, 'csrf' => $csrf));
                die;
            } else if ($param == 'upload_ttd') {
                if (isset($_FILES['tanda_tangan_admin']['size']) != 0) {
                    $config['upload_path']        = 'g_ttd_admin';
                    $config['allowed_types']      = 'gif|jpg|png|jpeg|pdf';
                    $config['max_size']           = '2048';
                    $config['overwrite']          = TRUE;
                    $data['id']                 = htmlspecialchars($this->input->post('id'));
                    $data['tanda_tangan_admin'] = str_replace(' ', '_', $_FILES['tanda_tangan_admin']['name']);
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload('tanda_tangan_admin')) {
                        $this->session->set_flashdata('error', 'TTD gagal diupload. ' . $this->upload->display_errors());
                        $this->B_user_log_model->addLog(userLog('update_data',  $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name') . ' Error pada saat upload Tanda Tangan admin untuk keperluan APL 01 pada ID data ' . $data['id'] . '', $this->session->userdata('id')));
                        redirect('asesi_confirmation');
                    } else {
                        $this->M_pilihan_skema->updateDokumen($data['id'], 'tanda_tangan_admin', $data['tanda_tangan_admin']);
                        $this->session->set_flashdata('success', 'TTD berhasil diupload!');
                        $this->B_user_log_model->addLog(userLog('update_data',  $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name') . ' Mengupload Tanda Tangan admin untuk keperluan APL 01 pada ID data ' . $data['id'] . '', $this->session->userdata('id')));
                        redirect('asesi_confirmation');
                    }
                }
            } else if ($param == 'terima_konfirmasi') {
                $id_decrypt          = $this->input->post('id_ps');
                $id_user             = $this->session->userdata('id');
                $getByIdPilihanSkema = $this->M_pilihan_skema->getById($id_decrypt);
                $cekDataByIdUser     = $this->M_data_admin->cekDataByIdUser($id_user);
                $result              = '';
                $this->M_pilihan_skema->accept_confirm($id_decrypt, $cekDataByIdUser[0]->tanda_tangan);
                $this->B_user_log_model->addLog(userLog('update_data',  $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name') . ' Menerima Konfirmasi pada data permintaan APL01 dengan ID ' . $id_decrypt . '', $this->session->userdata('id')));
                $result = array('status' => 'success', 'msg' => 'Permintaan diterima !');
                $email = $this->input->post('dd_email1');
                _notifEmail($email, 'diterima');
                $csrf = array(
                    'token' => $this->security->get_csrf_hash()
                );
                echo json_encode(array('result' => $result, 'csrf' => $csrf));
                die;
            } else if ($param == 'tolak_konfirmasi') {
                $id_decrypt          = $this->input->post('id_ps');
                $getByIdPilihanSkema = $this->M_pilihan_skema->getById($id_decrypt);
                $this->M_pilihan_skema->deny_confirm($id_decrypt);
                $this->M_pilihan_skema->confirm_selesai($id_decrypt);
                $this->B_user_log_model->addLog(userLog('update_data',  $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name') . ' Menolak Konfirmasi pada data permintaan APL01 dengan ID ' . $id_decrypt . '', $this->session->userdata('id')));
                $result = array('status' => 'success', 'msg' => 'Permintaan ditolak !');
                $email = $this->input->post('dd_email1');
                _notifEmail($email, 'ditolak');
                $csrf = array(
                    'token' => $this->security->get_csrf_hash()
                );
                echo json_encode(array('result' => $result, 'csrf' => $csrf));
                die;
            } else if ($param == 'delete') {
                $id_decrypt = decrypt($id);
                $this->M_pilihan_skema->update_delete($id_decrypt);
                // $this->M_pilihan_skema->delete($id_decrypt);
                $this->B_user_log_model->addLog(userLog('delete_data',  $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name') . ' Menghapus data permintaan APL01 dengan ID ' . $id_decrypt . '', $this->session->userdata('id')));

                $result = array('status' => 'success', 'msg' => 'Data berhasil dihapus !');
                echo json_encode(array('result' => $result));
                die;
            }
            $this->load->view('index_admin', $view);
        }
    }

    public function konfirmasi_apl02($param = '', $id = '')
    {
        // Redirect to login page if the user not logged in
        $temp = $this->User->getuserById($this->session->userdata('id'));
        if (!$this->session->userdata('loggedIn_admin')) {
            $this->session->set_flashdata('result_login', 'Silahkan Log in untuk mengakses sistem !');
            redirect('/auth/');
        } else if ($temp[0]->online_status != "online") {
            $this->session->set_flashdata('result_login', 'Silahkan Log in kembali untuk mengakses sistem !');
            redirect('auth/force_logout_admin');
        } else {
            $id_user           = $this->session->userdata('id');
            $view['title']           = 'Halaman Konfirmasi Asesmen';
            $view['pageName']        = 'permintaan_apl02';
            $view['getAsesor']       = $this->M_asesor->getData();
            $view['cekDataByIdUser'] = $this->M_data_admin->cekDataByIdUser($id_user);
            if ($param == 'getAllData') {
                $dt    = $this->M_pilihan_skema->getAllData1();
                $start = $this->input->post('start');
                $data  = array();
                foreach ($dt['data'] as $row) {
                    $id  = encrypt($row->id);
                    $th1 = '<div style="font-size:11px;">' . ++$start . '</div>';
                    $th2 = '<div style="font-size:11px;">' . $row->dd_nama_lengkap . '</div>';
                    $th3 = '<div style="font-size:11px;">' . $row->judul_skema . '</div>';
                    $th4 = '<div style="font-size:11px;">' . $row->tujuan_sertifikasi . '</div>';
                    $th5 = $row->nama_asesor == '' ? '<div style="font-size:11px;" class="red">Asesor belum ditentukan</div>' : '<div style="font-size:11px;">' . $row->nama_asesor . '</div>';
                    $th6                 = '<div style="font-size:11px;">' . tgl_indo($row->tanggal_pengajuan) . '</div>';
                    $cekAsesmen          = $this->M_apl_02_finish->getDataByIdPilSkema($row->id);
                    $cekByIdPilihanSkema = $this->M_apl_02->cekByIdPilihanSkema($row->id);
                    $th7                 = empty($cekByIdPilihanSkema[0]->id_pilihan_skema) ? '<div class="btn btn-danger badge btn-sm" style="font-size:10px">Belum asesmen mandiri</div>' : ((!empty($cekByIdPilihanSkema[0]->id_pilihan_skema)) && (!empty($cekAsesmen->tanda_tangan_asesor)) ? '<div class="btn btn-success badge btn-sm" style="font-size:10px">Sudah diases asesor</div>' : ((!empty($cekByIdPilihanSkema[0]->id_pilihan_skema)) && (empty($cekAsesmen->tanda_tangan_asesor)) ? '<div class="btn btn-info badge btn-sm" style="font-size:10px">Belum diases oleh asesor</div>' : ''));
                    $th8                 = get_btn_verifikasi1('ubah("' . $id . '")', 'cekPermohonan("' . $id . '")', 'cetakPermohonanAsesi("' . $row->id . '")');

                    $data[] = gathered_data(array($th1, $th2, $th3, $th4, $th5, $th6, $th7, $th8));
                }
                $dt['data'] = $data;
                echo json_encode($dt);
                die;
            } else if ($param == 'getById') {
                $id_decrypt = decrypt($id);
                $data       = $this->M_pilihan_skema->getById($id_decrypt);
                echo json_encode(array('data' => $data));
                die;
            } else if ($param == 'update') {
                $this->form_validation->set_rules("id_asesor", "Asesor", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("nik_lsp", "NIK LSP", "trim|required", array('required' => '{field} Wajib diisi !'));
                // $this->form_validation->set_rules("keterangan_status", "Keterangan", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">*', '</small>');
                if ($this->form_validation->run() == FALSE) {
                    $result = array('status' => 'error', 'msg' => 'Data yang anda isi belum benar !');
                    foreach ($_POST as $key => $value) {
                        $result['messages'][$key] = form_error($key);
                    }
                } else {
                    $data['id']                = $this->input->post('id');
                    $data['id_asesor']         = htmlspecialchars($this->input->post('id_asesor'));
                    $data['id_user_admin']     = $this->session->userdata('id');
                    $data['nik_lsp']           = htmlspecialchars($this->input->post('nik_lsp'));
                    $data['keterangan_status'] = htmlspecialchars($this->input->post('keterangan_status'));
                    $data['tanggal_diterima']  = htmlspecialchars($this->input->post('tanggal_diterima'));
                    $result['messages']          = '';
                    $this->B_user_log_model->addLog(userLog('update_data',  $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name') . ' Melengkapi Dokumen Asesor dengan ID data ' . $data['id'] . '', $this->session->userdata('id')));

                    $result = array('status' => 'success', 'msg' => '<h3>Data Telah di record !</h3>');
                    $this->M_pilihan_skema->update($data['id'], $data);
                }
                $csrf = array(
                    'token' => $this->security->get_csrf_hash()
                );
                echo json_encode(array('result' => $result, 'csrf' => $csrf));
                die;
            } else if ($param == 'update_keterangan') {
                $this->form_validation->set_rules("keterangan_status", "Keterangan", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">*', '</small>');
                if ($this->form_validation->run() == FALSE) {
                    $result = array('status' => 'error', 'msg' => 'Keterangan Wajib isi !');
                    foreach ($_POST as $key => $value) {
                        $result['messages'][$key] = form_error($key);
                    }
                } else {
                    $data['id']                = $this->input->post('id');
                    $data['keterangan_status'] = htmlspecialchars($this->input->post('keterangan_status'));
                    $result['messages']          = '';
                    $this->B_user_log_model->addLog(userLog('update_data',  $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name') . ' Menambahkan data keterangan pada ID data ' . $data['id'] . '', $this->session->userdata('id')));

                    $result = array('status' => 'success', 'msg' => '<h3>Keterangan telah ditambahkan !</h3>');
                    $this->M_pilihan_skema->update($data['id'], $data);
                }
                $csrf = array(
                    'token' => $this->security->get_csrf_hash()
                );
                echo json_encode(array('result' => $result, 'csrf' => $csrf));
                die;
            } else if ($param == 'upload_ttd') {
                if (isset($_FILES['tanda_tangan_admin']['size']) != 0) {
                    $config['upload_path']        = 'g_ttd_admin';
                    $config['allowed_types']      = 'gif|jpg|png|jpeg|pdf';
                    $config['max_size']           = '2048';
                    $config['overwrite']          = TRUE;
                    $data['id']                 = htmlspecialchars($this->input->post('id'));
                    $data['tanda_tangan_admin'] = str_replace(' ', '_', $_FILES['tanda_tangan_admin']['name']);
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload('tanda_tangan_admin')) {
                        $this->session->set_flashdata('error', 'TTD gagal diupload. ' . $this->upload->display_errors());
                        $this->B_user_log_model->addLog(userLog('update_data',  $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name') . ' Error pada saat upload Tanda Tangan admin untuk keperluan APL 01 pada ID data ' . $data['id'] . '', $this->session->userdata('id')));
                        redirect('asesi_confirmation');
                    } else {
                        $this->M_pilihan_skema->updateDokumen($data['id'], 'tanda_tangan_admin', $data['tanda_tangan_admin']);
                        $this->session->set_flashdata('success', 'TTD berhasil diupload!');
                        $this->B_user_log_model->addLog(userLog('update_data',  $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name') . ' Mengupload Tanda Tangan admin untuk keperluan APL 01 pada ID data ' . $data['id'] . '', $this->session->userdata('id')));
                        redirect('asesi_confirmation');
                    }
                }
            } else if ($param == 'terima_konfirmasi') {
                $id_decrypt          = decrypt($id);
                $id_user             = $this->session->userdata('id');
                $getByIdPilihanSkema = $this->M_pilihan_skema->getById($id_decrypt);
                $cekDataByIdUser     = $this->M_data_admin->cekDataByIdUser($id_user);
                // if (($getByIdPilihanSkema->id_asesor == 0) && ($getByIdPilihanSkema->id_user_admin == 0) && ($getByIdPilihanSkema->nik_lsp == '')) {
                //     $result = array('status' => 'error', 'msg' => '<h3>Gagal, silahkan lengkapi data asesor terlebih dahulu !</h3>');
                // } else if (($getByIdPilihanSkema->tanda_tangan_admin == '')) {
                //     $result = array('status' => 'error', 'msg' => '<h3>Gagal, Anda belum mengupload tanda tangan !</h3>');
                // } else {
                $this->M_pilihan_skema->accept_confirm($id_decrypt, $cekDataByIdUser[0]->tanda_tangan);
                $this->B_user_log_model->addLog(userLog('update_data',  $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name') . ' Menerima Konfirmasi pada data permintaan APL01 dengan ID ' . $id_decrypt . '', $this->session->userdata('id')));
                $result = array('status' => 'success', 'msg' => 'Permintaan Telah diterima !');
                // }
                echo json_encode(array('result' => $result));
                die;
            } else if ($param == 'tolak_konfirmasi') {
                $id_decrypt          = decrypt($id);
                $getByIdPilihanSkema = $this->M_pilihan_skema->getById($id_decrypt);
                // if (($getByIdPilihanSkema->id_asesor == 0) && ($getByIdPilihanSkema->id_user_admin == 0) && ($getByIdPilihanSkema->nik_lsp == '') && ($getByIdPilihanSkema->tanda_tangan_admin == '')) {
                //     $result = array('status' => 'error', 'msg' => '<h3>Gagal, silahkan lengkapi data asesor terlebih dahulu !</h3>');
                // } else if (($getByIdPilihanSkema->tanda_tangan_admin == '')) {
                //     $result = array('status' => 'error', 'msg' => '<h3>Gagal, Anda belum mengupload tanda tangan !</h3>');
                // } else {
                $this->M_pilihan_skema->deny_confirm($id_decrypt);
                $this->M_pilihan_skema->confirm_selesai($id_decrypt);
                $this->B_user_log_model->addLog(userLog('update_data',  $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name') . ' Menolak Konfirmasi pada data permintaan APL01 dengan ID ' . $id_decrypt . '', $this->session->userdata('id')));
                $result = array('status' => 'success', 'msg' => 'Permintaan Telah ditolak !');
                // }
                echo json_encode(array('result' => $result));
                die;
            } else if ($param == 'delete') {
                $id_decrypt = decrypt($id);
                $this->M_pilihan_skema->update_delete($id_decrypt);
                // $this->M_pilihan_skema->delete($id_decrypt);
                $this->B_user_log_model->addLog(userLog('delete_data',  $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name') . ' Menghapus data permintaan APL01 dengan ID ' . $id_decrypt . '', $this->session->userdata('id')));

                $result = array('status' => 'success', 'msg' => 'Data berhasil dihapus !');
                echo json_encode(array('result' => $result));
                die;
            }
            $this->load->view('index_admin', $view);
        }
    }

    public function cetakPermohonanAsesi($id = '')
    {
        $view['title'] = 'Permohonan Asesi';
        $view['getDataDiri'] = $this->M_pilihan_skema->getByIdOnAPL02($id);

        $this->load->library('pdf');
        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->filename = "Dokumen-APl-01-PermohonanAsesi.pdf";

        $this->pdf->loadView('pages_admin/cetakPermohonanAsesi', $view);
    }

    public function downloadDataAsesi($param = '', $id = '')
    {
        // Redirect to login page if the user not logged in
        $temp = $this->User->getuserById($this->session->userdata('id'));
        if (!$this->session->userdata('loggedIn_admin')) {
            $this->session->set_flashdata('result_login', 'Silahkan Log in untuk mengakses sistem !');
            redirect('/auth/');
        } else if ($temp[0]->online_status != "online") {
            $this->session->set_flashdata('result_login', 'Silahkan Log in kembali untuk mengakses sistem !');
            redirect('auth/force_logout_admin');
        } else {
            $view['title']    = 'Download Daftar Asesi';
            $view['pageName'] = 'downloadAllAsesi';
            if ($param == 'getAllData') {
                $dt    = $this->M_pilihan_skema->getAllData2();
                $start = $this->input->post('start');
                $data  = array();
                foreach ($dt['data'] as $row) {
                    convert_to($row);
                    $id   = encrypt($row->id);
                    $th1  = '<div style="font-size:11px;">' . ++$start . '</div>';
                    $th2  = '<div style="font-size:11px;">' . $row->dd_nama_lengkap . '</div>';
                    $th3  = '<div style="font-size:11px;">' . $row->dd_nik . '</div>';
                    $th4  = '<div style="font-size:11px;">' . $row->dd_tempat_lahir . '</div>';
                    $th5  = '<div style="font-size:11px;">' . $row->dd_tgl_lahir . '</div>';
                    $th6  = '<div style="font-size:11px;">' . $row->dd_jenis_kelamin . '</div>';
                    $th7  = '<div style="font-size:11px;">' . $row->dd_kebangsaan . '</div>';
                    $th8  = '<div style="font-size:11px;">' . $row->dd_alamat_rumah . '</div>';
                    $th9  = '<div style="font-size:11px;">' . $row->dd_no_hp . '</div>';
                    $th10 = '<div style="font-size:11px;">' . $row->dd_no_telp . '</div>';
                    $th11 = '<div style="font-size:11px;">' . $row->dd_email . '</div>';
                    $th12 = '<div style="font-size:11px;">' . $row->dd_kode_pos . '</div>';
                    $th13 = '<div style="font-size:11px;">' . $row->dd_kantor . '</div>';
                    $th14 = '<div style="font-size:11px;">' . $row->dd_pendidikan_terakhir . '</div>';
                    $th15 = '<div style="font-size:11px;">' . $row->k_lembaga . '</div>';
                    $th16 = '<div style="font-size:11px;">' . $row->k_jabatan . '</div>';
                    $th17 = '<div style="font-size:11px;">' . $row->k_alamat . '</div>';
                    $th18 = '<div style="font-size:11px;">' . $row->k_kode_pos . '</div>';
                    $th19 = '<div style="font-size:11px;">' . $row->k_fax . '</div>';
                    $th20 = '<div style="font-size:11px;">' . $row->k_telp . '</div>';
                    $th21 = '<div style="font-size:11px;">' . $row->k_email . '</div>';
                    // $th22 = '<div style="font-size:11px;">' . $row->dd_foto . '</div>';
                    // $th23 = '<div style="font-size:11px;">' . $row->dd_tanda_tangan_asesi . '</div>';
                    $th24 = '<div style="font-size:11px;">' . $row->judul_skema . '</div>';
                    $th25 = '<div style="font-size:11px;">' . $row->tujuan_sertifikasi . '</div>';
                    // $th26 = '<div style="font-size:11px;">' . $row->upload_ktm . '</div>';
                    // $th27 = '<div style="font-size:11px;">' . $row->upload_transkrip . '</div>';
                    // $th28 = '<div style="font-size:11px;">' . $row->upload_ktp_sim . '</div>';
                    // $th29 = '<div style="font-size:11px;">' . $row->sertifikat_pelatihan . '</div>';
                    // $th30 = '<div style="font-size:11px;">' . $row->upload_pengalaman_kerja . '</div>';
                    // $th31 = '<div style="font-size:11px;">' . $row->upload_bukti_relevan_1 . '</div>';
                    // $th32 = '<div style="font-size:11px;">' . $row->keterangan_bukti_1 . '</div>';
                    // $th33 = '<div style="font-size:11px;">' . $row->upload_bukti_relevan_2 . '</div>';
                    // $th34 = '<div style="font-size:11px;">' . $row->keterangan_bukti_2 . '</div>';
                    // $th35 = '<div style="font-size:11px;">' . $row->upload_bukti_relevan_3 . '</div>';
                    // $th36 = '<div style="font-size:11px;">' . $row->keterangan_bukti_3 . '</div>';
                    // $th37 = '<div style="font-size:11px;">' . $row->upload_bukti_relevan_4 . '</div>';
                    // $th38 = '<div style="font-size:11px;">' . $row->keterangan_bukti_4 . '</div>';
                    // $th39 = '<div style="font-size:11px;">' . $row->upload_bukti_relevan_5 . '</div>';
                    // $th40 = '<div style="font-size:11px;">' . $row->keterangan_bukti_5 . '</div>';
                    $th41 = '<div style="font-size:11px;">' . $row->tanggal_pengajuan . '</div>';
                    $th42 = '<div style="font-size:11px;">' . $row->tanggal_diterima . '</div>';
                    // $th43 = '<div style="font-size:11px;">' . $row->status_dokumen . '</div>';
                    // $th44 = '<div style="font-size:11px;">' . $row->status_diterima . '</div>';

                    $data[] = gathered_data(array($th1, $th2, $th3, $th4, $th5, $th6, $th7, $th8, $th9, $th10, $th11, $th12, $th13, $th14, $th15, $th16, $th17, $th18, $th19, $th20, $th21,  $th24, $th25,  $th41, $th42));
                }
                $dt['data'] = $data;
                echo json_encode($dt);
                die;
            }
            $this->load->view('index_admin', $view);
        }
    }

    public function skema($param = '', $id = '')
    {
        // Redirect to login page if the user not logged in
        $temp = $this->User->getuserById($this->session->userdata('id'));
        if (!$this->session->userdata('loggedIn_admin')) {
            $this->session->set_flashdata('result_login', 'Silahkan Log in untuk mengakses sistem !');
            redirect('/auth/');
        } else if ($temp[0]->online_status != "online") {
            $this->session->set_flashdata('result_login', 'Silahkan Log in kembali untuk mengakses sistem !');
            redirect('auth/force_logout_admin');
        } else {
            $view['title']    = 'Halaman Home';
            $view['pageName'] = 'skema';
            if ($param == 'getAllData') {
                $dt    = $this->M_skema->getAllData();
                $start = $this->input->post('start');
                $data  = array();
                foreach ($dt['data'] as $row) {
                    convert_to($row);
                    $id  = encrypt($row->id);
                    $th1 = '<div style="font-size:11px;">' . ++$start . '</div>';
                    $th2 = '<div style="font-size:11px;">' . $row->judul_skema . '</div>';
                    $th3 = '<div style="font-size:11px;">' . $row->no_skema . '</div>';
                    $th4 = '<div style="font-size:11px;">' . tgl_indo($row->create_date) . '</div>';
                    $th5 = get_btn_group1('ubah("' . $id . '")', 'hapus("' . $id . '")');

                    $data[] = gathered_data(array($th1, $th2, $th3, $th4, $th5));
                }
                $dt['data'] = $data;
                echo json_encode($dt);
                die;
            } else if ($param == 'getById') {
                $id_decrypt = decrypt($id);
                $data       = $this->M_skema->getById($id_decrypt);
                echo json_encode(array('data' => $data));
                die;
            } else if ($param == 'addData') {
                $this->form_validation->set_rules("judul_skema", "Nama Asesor", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("no_skema", "No Reg", "trim|required", array('required' => '{field} Wajib diisi !'));

                $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">*', '</small>');
                if ($this->form_validation->run() == FALSE) {
                    $result = array('status' => 'error', 'msg' => 'Data yang anda isi Belum Benar!');
                    foreach ($_POST as $key => $value) {
                        $result['messages'][$key] = form_error($key);
                    }
                } else {
                    $data['judul_skema']   = htmlspecialchars($this->input->post('judul_skema'));
                    $data['no_skema']      = htmlspecialchars($this->input->post('no_skema'));
                    $data['delete_status'] = '0';
                    $data['create_date']   = date('Y-m-d');

                    $result['messages'] = '';
                    $result     = array('status' => 'success', 'msg' => 'Data berhasil ditambahkan');
                    $this->M_skema->addData($data);
                    $this->B_user_log_model->addLog(userLog('add_data',  $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name') . ' Menambahkan data skema baru dengan judul ' . $data['judul_skema'] . '', $this->session->userdata('id')));
                }
                $csrf = array(
                    'token' => $this->security->get_csrf_hash()
                );
                echo json_encode(array('result' => $result, 'csrf' => $csrf));
                die;
            } else if ($param == 'update') {
                $this->form_validation->set_rules("judul_skema", "Nama Asesor", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("no_skema", "No Reg", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">*', '</small>');
                if ($this->form_validation->run() == FALSE) {
                    $result = array('status' => 'error', 'msg' => 'Data yang anda isi belum benar !');
                    foreach ($_POST as $key => $value) {
                        $result['messages'][$key] = form_error($key);
                    }
                } else {
                    $data['id']            = htmlspecialchars($this->input->post('id'));
                    $data['judul_skema']   = htmlspecialchars($this->input->post('judul_skema'));
                    $data['no_skema']      = htmlspecialchars($this->input->post('no_skema'));
                    $data['delete_status'] = '0';
                    $data['create_date']   = date('Y-m-d');
                    $result['messages']      = '';
                    $result          = array('status' => 'success', 'msg' => '<h3>Data Telah diubah !</h3>');
                    $this->M_skema->update($data['id'], $data);
                    $this->B_user_log_model->addLog(userLog('update_data',  $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name') . ' Mengubah data skema dengan ID ' . $data['id'] . '', $this->session->userdata('id')));
                }
                $csrf = array(
                    'token' => $this->security->get_csrf_hash()
                );
                echo json_encode(array('result' => $result, 'csrf' => $csrf));
                die;
            } else if ($param == 'delete') {
                $id_decrypt = decrypt($id);
                $this->M_skema->update_delete($id_decrypt);
                // $this->M_skema->delete($id_decrypt);
                $this->B_user_log_model->addLog(userLog('delete_data',  $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name') . ' Menghapus data skema dengan ID ' . $id_decrypt . '', $this->session->userdata('id')));

                $result = array('status' => 'success', 'msg' => 'Data berhasil dihapus !');
                echo json_encode(array('result' => $result));
                die;
            }
            $this->load->view('index_admin', $view);
        }
    }

    public function unit_kompetensi($param = '', $id = '')
    {
        // Redirect to login page if the user not logged in
        $temp = $this->User->getuserById($this->session->userdata('id'));
        if (!$this->session->userdata('loggedIn_admin')) {
            $this->session->set_flashdata('result_login', 'Silahkan Log in untuk mengakses sistem !');
            redirect('/auth/');
        } else if ($temp[0]->online_status != "online") {
            $this->session->set_flashdata('result_login', 'Silahkan Log in kembali untuk mengakses sistem !');
            redirect('auth/force_logout_admin');
        } else {
            $view['title']    = 'Halaman Unit Kompetensi';
            $view['pageName'] = 'unit_kompetensi';
            $view['getSkema'] = $this->M_skema->getData();
            if ($param == 'getAllData') {
                $dt    = $this->M_unit_kompetensi->getAllData();
                $start = $this->input->post('start');
                $data  = array();
                foreach ($dt['data'] as $row) {
                    // convert_to($row);
                    $id  = encrypt($row->id);
                    $th1 = '<div style="font-size:11px;">' . ++$start . '</div>';
                    $th2 = '<div style="font-size:11px;">' . $row->judul_skema . '</div>';
                    $th3 = '<div style="font-size:11px;">' . $row->kode_unit . '</div>';
                    $th4 = '<div style="font-size:11px;">' . $row->judul_unit . '</div>';
                    $th5 = '<div style="font-size:11px;">' . $row->jenis_standar . '</div>';
                    $th6 = '<div style="font-size:11px;">' . tgl_indo($row->create_date) . '</div>';
                    $th7 = get_btn_group1('ubah("' . $id . '")', 'hapus("' . $id . '")');

                    $data[] = gathered_data(array($th1, $th2, $th3, $th4, $th5, $th6, $th7));
                }
                $dt['data'] = $data;
                echo json_encode($dt);
                die;
            } else if ($param == 'getById') {
                $id_decrypt = decrypt($id);
                $data       = $this->M_unit_kompetensi->getById($id_decrypt);
                echo json_encode(array('data' => $data));
                die;
            } else if ($param == 'addData') {
                $this->form_validation->set_rules("id_skema", "Judul Skema", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("kode_unit", "Kode Unit", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("judul_unit", "Judul Unit", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("jenis_standar", "Jenis Standar", "trim|required", array('required' => '{field} Wajib diisi !'));

                $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">*', '</small>');
                if ($this->form_validation->run() == FALSE) {
                    $result = array('status' => 'error', 'msg' => 'Data yang anda isi Belum Benar!');
                    foreach ($_POST as $key => $value) {
                        $result['messages'][$key] = form_error($key);
                    }
                } else {
                    $data['id_skema']      = htmlspecialchars($this->input->post('id_skema'));
                    $data['kode_unit']     = htmlspecialchars($this->input->post('kode_unit'));
                    $data['judul_unit']    = htmlspecialchars($this->input->post('judul_unit'));
                    $data['jenis_standar'] = htmlspecialchars($this->input->post('jenis_standar'));
                    $data['create_date']   = date('Y-m-d');
                    $data['status_delete'] = '0';

                    $result['messages'] = '';
                    $result     = array('status' => 'success', 'msg' => 'Data berhasil ditambahkan');
                    $this->M_unit_kompetensi->addData($data);
                    $this->B_user_log_model->addLog(userLog('add_data',  $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name') . ' Menambahkan data Unit Kompetensi dengan kode_unit ' . $data['kode_unit'] . '', $this->session->userdata('id')));
                }
                $csrf = array(
                    'token' => $this->security->get_csrf_hash()
                );
                echo json_encode(array('result' => $result, 'csrf' => $csrf));
                die;
            } else if ($param == 'update') {
                $this->form_validation->set_rules("id_skema", "Judul Skema", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("kode_unit", "Kode Unit", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("judul_unit", "Judul Unit", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("jenis_standar", "Jenis Standar", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">*', '</small>');
                if ($this->form_validation->run() == FALSE) {
                    $result = array('status' => 'error', 'msg' => 'Data yang anda isi belum benar !');
                    foreach ($_POST as $key => $value) {
                        $result['messages'][$key] = form_error($key);
                    }
                } else {
                    $data['id']            = $this->input->post('id');
                    $data['id_skema']      = htmlspecialchars($this->input->post('id_skema'));
                    $data['kode_unit']     = htmlspecialchars($this->input->post('kode_unit'));
                    $data['judul_unit']    = htmlspecialchars($this->input->post('judul_unit'));
                    $data['jenis_standar'] = htmlspecialchars($this->input->post('jenis_standar'));
                    $data['create_date']   = date('Y-m-d');
                    $data['status_delete'] = '0';
                    $result['messages']      = '';
                    $result          = array('status' => 'success', 'msg' => '<h3>Data Telah diubah !</h3>');
                    $this->M_unit_kompetensi->update($data['id'], $data);
                    $this->B_user_log_model->addLog(userLog('update_data',  $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name') . ' Mengubah data Unit Kompetensi pada id data ' . $data['id'] . '', $this->session->userdata('id')));
                }
                $csrf = array(
                    'token' => $this->security->get_csrf_hash()
                );
                echo json_encode(array('result' => $result, 'csrf' => $csrf));
                die;
            } else if ($param == 'delete') {
                $id_decrypt = decrypt($id);
                $this->M_unit_kompetensi->update_delete($id_decrypt);
                $this->B_user_log_model->addLog(userLog('delete_data',  $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name') . ' Menghapus data Unit Kompetensi dengan id data ' . $id_decrypt . '', $this->session->userdata('id')));

                // $this->M_skema->delete($id_decrypt);
                $result = array('status' => 'success', 'msg' => 'Data berhasil dihapus !');
                echo json_encode(array('result' => $result));
                die;
            }
            $this->load->view('index_admin', $view);
        }
    }

    public function unit_elemen($param = '', $id = '')
    {
        // Redirect to login page if the user not logged in
        $temp = $this->User->getuserById($this->session->userdata('id'));
        if (!$this->session->userdata('loggedIn_admin')) {
            $this->session->set_flashdata('result_login', 'Silahkan Log in untuk mengakses sistem !');
            redirect('/auth/');
        } else if ($temp[0]->online_status != "online") {
            $this->session->set_flashdata('result_login', 'Silahkan Log in kembali untuk mengakses sistem !');
            redirect('auth/force_logout_admin');
        } else {
            $view['title']                 = 'Halaman Unit Elemen';
            $view['pageName']              = 'unit_elemen';
            $view['getSkema']              = $this->M_skema->getData();
            $view['getDataUnitKompetensi'] = $this->M_unit_kompetensi->getData();
            if ($param == 'getAllData') {
                $dt    = $this->M_unit_element->getAllData();
                $start = $this->input->post('start');
                $data  = array();
                foreach ($dt['data'] as $row) {
                    convert_to($row);
                    $id  = encrypt($row->id);
                    $th1 = '<div style="font-size:11px;">' . ++$start . '</div>';
                    $th2 = '<div style="font-size:11px;">' . $row->elemen_kompetensi . '</div>';
                    $th3 = '<div style="font-size:11px;">' . $row->judul_unit . '</div>';
                    $th4 = '<div style="font-size:11px;">' . tgl_indo($row->create_date) . '</div>';
                    $th5 = get_btn_group1('ubah("' . $id . '")', 'hapus("' . $id . '")');

                    $data[] = gathered_data(array($th1, $th2, $th3, $th4, $th5));
                }
                $dt['data'] = $data;
                echo json_encode($dt);
                die;
            } else if ($param == 'getById') {
                $id_decrypt = decrypt($id);
                $data       = $this->M_unit_element->getById($id_decrypt);
                echo json_encode(array('data' => $data));
                die;
            } else if ($param == 'getJSONskema') {
                $id   = $this->input->post('id');
                $data = $this->M_unit_kompetensi->getDataByIdSkema($id);
                $csrf = array(
                    'token' => $this->security->get_csrf_hash()
                );
                echo json_encode(array('result' => $data, 'csrf' => $csrf));
                die;
            } else if ($param == 'addData') {
                $this->form_validation->set_rules("elemen_kompetensi", "Judul Skema", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("id_unit_kompetensi", "Kode Unit", "trim|required", array('required' => '{field} Wajib diisi !'));

                $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">*', '</small>');
                if ($this->form_validation->run() == FALSE) {
                    $result = array('status' => 'error', 'msg' => 'Data yang anda isi Belum Benar!');
                    foreach ($_POST as $key => $value) {
                        $result['messages'][$key] = form_error($key);
                    }
                } else {
                    $data['elemen_kompetensi']  = htmlspecialchars($this->input->post('elemen_kompetensi'));
                    $data['id_unit_kompetensi'] = htmlspecialchars($this->input->post('id_unit_kompetensi'));
                    $data['create_date']        = date('Y-m-d');
                    $data['status_delete']      = '0';

                    $result['messages'] = '';
                    $result     = array('status' => 'success', 'msg' => 'Data berhasil ditambahkan');
                    $this->M_unit_element->addData($data);
                    $this->B_user_log_model->addLog(userLog('add_data',  $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name') . ' Menambahkan data Unit ELement dengan elemen kompetensi ' . $data['elemen_kompetensi'] . '', $this->session->userdata('id')));
                }
                $csrf = array(
                    'token' => $this->security->get_csrf_hash()
                );
                echo json_encode(array('result' => $result, 'csrf' => $csrf));
                die;
            } else if ($param == 'update') {
                $this->form_validation->set_rules("elemen_kompetensi", "Judul Skema", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("id_unit_kompetensi", "Kode Unit", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">*', '</small>');
                if ($this->form_validation->run() == FALSE) {
                    $result = array('status' => 'error', 'msg' => 'Data yang anda isi belum benar !');
                    foreach ($_POST as $key => $value) {
                        $result['messages'][$key] = form_error($key);
                    }
                } else {
                    $data['id']                 = $this->input->post('id');
                    $data['elemen_kompetensi']  = htmlspecialchars($this->input->post('elemen_kompetensi'));
                    $data['id_unit_kompetensi'] = htmlspecialchars($this->input->post('id_unit_kompetensi'));
                    $data['create_date']        = date('Y-m-d');
                    $data['status_delete']      = '0';
                    $result['messages']           = '';
                    $result               = array('status' => 'success', 'msg' => '<h3>Data Telah diubah !</h3>');
                    $this->M_unit_element->update($data['id'], $data);
                    $this->B_user_log_model->addLog(userLog('update_data',  $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name') . ' Mengubah data Unit Element pada id data ' . $data['id'] . '', $this->session->userdata('id')));
                }
                $csrf = array(
                    'token' => $this->security->get_csrf_hash()
                );
                echo json_encode(array('result' => $result, 'csrf' => $csrf));
                die;
            } else if ($param == 'delete') {
                $id_decrypt = decrypt($id);
                $this->M_unit_element->update_delete($id_decrypt);
                $this->B_user_log_model->addLog(userLog('delete_data',  $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name') . ' Menghapus data Unit Element dengan id data ' . $id_decrypt . '', $this->session->userdata('id')));
                $result = array('status' => 'success', 'msg' => 'Data berhasil dihapus !');
                echo json_encode(array('result' => $result));
                die;
            }
            $this->load->view('index_admin', $view);
        }
    }

    public function unit_pertanyaan($param = '', $id = '')
    {
        // Redirect to login page if the user not logged in
        $temp = $this->User->getuserById($this->session->userdata('id'));
        if (!$this->session->userdata('loggedIn_admin')) {
            $this->session->set_flashdata('result_login', 'Silahkan Log in untuk mengakses sistem !');
            redirect('/auth/');
        } else if ($temp[0]->online_status != "online") {
            $this->session->set_flashdata('result_login', 'Silahkan Log in kembali untuk mengakses sistem !');
            redirect('auth/force_logout_admin');
        } else {
            $view['title']                 = 'Halaman Unit Elemen';
            $view['pageName']              = 'unit_pertanyaan';
            $view['getSkema']              = $this->M_skema->getData();
            $view['getDataUnitKompetensi'] = $this->M_unit_kompetensi->getData();
            if ($param == 'getAllData') {
                $dt    = $this->M_unit_pertanyaan->getAllData();
                $start = $this->input->post('start');
                $data  = array();
                foreach ($dt['data'] as $row) {
                    convert_to($row);
                    $id  = encrypt($row->id);
                    $th1 = '<div style="font-size:11px;">' . ++$start . '</div>';
                    $th2 = '<div style="font-size:11px;">' . $row->daftar_pertanyaan . '</div>';
                    $th3 = '<div style="font-size:11px;">' . $row->elemen_kompetensi . '</div>';
                    $th4 = '<div style="font-size:11px;">' . tgl_indo($row->create_date) . '</div>';
                    $th5 = get_btn_group1('ubah("' . $id . '")', 'hapus("' . $id . '")');
                    $data[]    = gathered_data(array($th1, $th2, $th3, $th4, $th5));
                }
                $dt['data'] = $data;
                echo json_encode($dt);
                die;
            } else if ($param == 'getById') {
                $id_decrypt = decrypt($id);
                $data       = $this->M_unit_pertanyaan->getById($id_decrypt);
                echo json_encode(array('result' => $data));
                die;
            } else if ($param == 'getJSONkompetensi') {
                $id   = $this->input->post('id');
                $data = $this->M_unit_kompetensi->getDataByIdSkema($id);
                $csrf = array(
                    'token' => $this->security->get_csrf_hash()
                );
                echo json_encode(array('result' => $data, 'csrf' => $csrf));
                die;
            } else if ($param == 'getJSONelemen') {
                $id   = $this->input->post('id');
                $data = $this->M_unit_element->getDataByIdKompetensi($id);
                $csrf = array(
                    'token' => $this->security->get_csrf_hash()
                );
                echo json_encode(array('result' => $data, 'csrf' => $csrf));
                die;
            } else if ($param == 'addData') {
                $this->form_validation->set_rules("daftar_pertanyaan", "Judul Skema", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("id_skema", "Skema", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("id_unit_kompetensi", "Unit Kompetensi", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("id_unit_elemen", "Unit Elemen", "trim|required", array('required' => '{field} Wajib diisi !'));

                $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">*', '</small>');
                if ($this->form_validation->run() == FALSE) {
                    $result = array('status' => 'error', 'msg' => 'Data yang anda isi Belum Benar!');
                    foreach ($_POST as $key => $value) {
                        $result['messages'][$key] = form_error($key);
                    }
                } else {
                    $data['daftar_pertanyaan']  = htmlspecialchars($this->input->post('daftar_pertanyaan'));
                    $data['id_skema']           = htmlspecialchars($this->input->post('id_skema'));
                    $pertanyaanByIdSkema = $this->M_unit_pertanyaan->pertanyaanByIdSkema($data['id_skema']);
                    $getSkema = $this->M_skema->getById($data['id_skema']);
                    if (empty($pertanyaanByIdSkema[0]->judul_skema)) {
                        $data['judul_skema'] = $getSkema->judul_skema;
                    }
                    $data['id_unit_kompetensi'] = htmlspecialchars($this->input->post('id_unit_kompetensi'));
                    $pertanyaanByIdKompetensi = $this->M_unit_pertanyaan->pertanyaanByIdKompetensi($data['id_unit_kompetensi']);
                    $getKompetensi = $this->M_unit_kompetensi->getById($data['id_unit_kompetensi']);
                    if (empty($pertanyaanByIdKompetensi[0]->judul_unit_kompetensi)) {
                        $data['judul_unit_kompetensi'] = $getKompetensi[0]->judul_unit;
                    }

                    $data['id_unit_elemen']     = htmlspecialchars($this->input->post('id_unit_elemen'));
                    $pertanyaanByIdElemen = $this->M_unit_pertanyaan->pertanyaanByIdElemen($data['id_unit_elemen']);
                    $getElemen = $this->M_unit_element->getById($data['id_unit_elemen']);
                    if (empty($pertanyaanByIdElemen[0]->judul_unit_elemen)) {
                        $data['judul_unit_elemen'] = $getElemen->elemen_kompetensi;
                    }
                    $data['create_date']        = date('Y-m-d');
                    $data['status_delete']      = '0';

                    $result['messages'] = '';
                    $result     = array('status' => 'success', 'msg' => 'Data berhasil ditambahkan');
                    $this->M_unit_pertanyaan->addData($data);
                    $this->B_user_log_model->addLog(userLog('add_data',  $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name') . ' Menambahkan data Unit pertanyaan dengan pertanyaan ' . $data['daftar_pertanyaan'] . '', $this->session->userdata('id')));
                }
                $csrf = array(
                    'token' => $this->security->get_csrf_hash()
                );
                echo json_encode(array('result' => $result, 'csrf' => $csrf));
                die;
            } else if ($param == 'update') {
                $this->form_validation->set_rules("daftar_pertanyaan", "Judul Skema", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("id_skema", "Skema", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("id_unit_kompetensi", "Unit Kompetensi", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("id_unit_elemen", "Unit Elemen", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">*', '</small>');
                if ($this->form_validation->run() == FALSE) {
                    $result = array('status' => 'error', 'msg' => 'Data yang anda isi belum benar !');
                    foreach ($_POST as $key => $value) {
                        $result['messages'][$key] = form_error($key);
                    }
                } else {
                    $data['id']                 = $this->input->post('id');
                    $data['daftar_pertanyaan']  = htmlspecialchars($this->input->post('daftar_pertanyaan'));
                    $data['id_skema']           = htmlspecialchars($this->input->post('id_skema'));
                    $data['id_unit_kompetensi'] = htmlspecialchars($this->input->post('id_unit_kompetensi'));
                    $data['id_unit_elemen']     = htmlspecialchars($this->input->post('id_unit_elemen'));
                    $data['create_date']        = date('Y-m-d');
                    $data['status_delete']      = '0';
                    $result['messages']           = '';
                    $result               = array('status' => 'success', 'msg' => '<h3>Data Telah diubah !</h3>');
                    $this->M_unit_pertanyaan->update($data['id'], $data);
                    $this->B_user_log_model->addLog(userLog('update_data',  $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name') . ' Mengubah data Unit Element pada id data ' . $data['id'] . '', $this->session->userdata('id')));
                }
                $csrf = array(
                    'token' => $this->security->get_csrf_hash()
                );
                echo json_encode(array('result' => $result, 'csrf' => $csrf));
                die;
            } else if ($param == 'delete') {
                $id_decrypt = decrypt($id);
                $this->M_unit_pertanyaan->update_delete($id_decrypt);
                $this->B_user_log_model->addLog(userLog('delete_data',  $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name') . ' Menghapus data Unit Element dengan id data ' . $id_decrypt . '', $this->session->userdata('id')));
                $result = array('status' => 'success', 'msg' => 'Data berhasil dihapus !');
                echo json_encode(array('result' => $result));
                die;
            }
            $this->load->view('index_admin', $view);
        }
    }

    public function asesor($param = '', $id = '')
    {
        // Redirect to login page if the user not logged in
        $temp = $this->User->getuserById($this->session->userdata('id'));
        if (!$this->session->userdata('loggedIn_admin')) {
            $this->session->set_flashdata('result_login', 'Silahkan Log in untuk mengakses sistem !');
            redirect('/auth/');
        } else if ($temp[0]->online_status != "online") {
            $this->session->set_flashdata('result_login', 'Silahkan Log in kembali untuk mengakses sistem !');
            redirect('auth/force_logout_admin');
        } else {
            $view['title']    = 'Halaman Asesor';
            $view['pageName'] = 'asesor';
            if ($param == 'getAllData') {
                $dt    = $this->M_asesor->getAllData();
                $start = $this->input->post('start');
                $data  = array();
                foreach ($dt['data'] as $row) {
                    // convert_to($row);
                    $id  = encrypt($row->id);
                    $th1 = '<div style="font-size:11px;">' . ++$start . '</div>';
                    $th2 = '<div style="font-size:11px;">' . $row->nama_asesor . '</div>';
                    $th3 = '<div style="font-size:11px;">' . $row->no_reg . '</div>';
                    $th4 = '<div style="font-size:11px;">' . tgl_indo($row->expire_date) . '</div>';
                    $th5 = get_btn_group1('ubah("' . $id . '")', 'hapus("' . $id . '")');

                    $data[] = gathered_data(array($th1, $th2, $th3, $th4, $th5));
                }
                $dt['data'] = $data;
                echo json_encode($dt);
                die;
            } else if ($param == 'getById') {
                $id_decrypt = decrypt($id);
                $data       = $this->M_asesor->getById($id_decrypt);
                echo json_encode(array('data' => $data));
                die;
            } else if ($param == 'addData') {
                $this->form_validation->set_rules("nama_asesor", "Judul Skema", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("no_reg", "Nomor Skema", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("expire_date", "Masa Berlaku Sertifikat", "trim|required", array('required' => '{field} Wajib diisi !'));

                $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">*', '</small>');
                if ($this->form_validation->run() == FALSE) {
                    $result = array('status' => 'error', 'msg' => 'Data yang anda isi Belum Benar!');
                    foreach ($_POST as $key => $value) {
                        $result['messages'][$key] = form_error($key);
                    }
                } else {
                    $data['nama_asesor'] = htmlspecialchars($this->input->post('nama_asesor'));
                    $data['no_reg']      = htmlspecialchars($this->input->post('no_reg'));
                    $data['expire_date'] = htmlspecialchars($this->input->post('expire_date'));

                    $data['status_delete'] = '0';
                    $data['create_date']   = date('Y-m-d');

                    $result['messages'] = '';
                    $result     = array('status' => 'success', 'msg' => 'Data berhasil ditambahkan');
                    $this->M_asesor->addData($data);
                    $this->B_user_log_model->addLog(userLog('add_data',  $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name') . ' Menambahkan data Asesor dengan nama asesor ' . $data['nama_asesor'] . '', $this->session->userdata('id')));
                }
                $csrf = array(
                    'token' => $this->security->get_csrf_hash()
                );
                echo json_encode(array('result' => $result, 'csrf' => $csrf));
                die;
            } else if ($param == 'update') {
                $this->form_validation->set_rules("nama_asesor", "Judul Skema", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("no_reg", "Nomor Skema", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("expire_date", "Masa Berlaku Sertifikat", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">*', '</small>');
                if ($this->form_validation->run() == FALSE) {
                    $result = array('status' => 'error', 'msg' => 'Data yang anda isi belum benar !');
                    foreach ($_POST as $key => $value) {
                        $result['messages'][$key] = form_error($key);
                    }
                } else {
                    $data['id']          = $this->input->post('id');
                    $data['nama_asesor'] = htmlspecialchars($this->input->post('nama_asesor'));
                    $data['no_reg']      = htmlspecialchars($this->input->post('no_reg'));
                    $data['expire_date'] = htmlspecialchars($this->input->post('expire_date'));

                    $result['messages'] = '';

                    $result = array('status' => 'success', 'msg' => '<h3>Data Telah diubah !</h3>');
                    $this->M_asesor->update($data['id'], $data);
                    $this->B_user_log_model->addLog(userLog('update_data',  $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name') . ' Mengubah data Asesor pada id data' . $data['id'] . '', $this->session->userdata('id')));
                }
                $csrf = array(
                    'token' => $this->security->get_csrf_hash()
                );
                echo json_encode(array('result' => $result, 'csrf' => $csrf));
                die;
            } else if ($param == 'delete') {
                $id_decrypt = decrypt($id);
                $this->M_asesor->update_delete($id_decrypt);
                // $this->M_asesor->delete($id_decrypt);
                $this->B_user_log_model->addLog(userLog('delete_data',  $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name') . ' Menghapus data Asesor dengan id asespr ' . $id_decrypt . '', $this->session->userdata('id')));

                $result = array('status' => 'success', 'msg' => 'Data berhasil dihapus !');
                echo json_encode(array('result' => $result));
                die;
            }
            $this->load->view('index_admin', $view);
        }
    }

    public function asesi($param = '', $id = '')
    {
        // Redirect to login page if the user not logged in
        $temp = $this->User->getuserById($this->session->userdata('id'));
        if (!$this->session->userdata('loggedIn_admin')) {
            $this->session->set_flashdata('result_login', 'Silahkan Log in untuk mengakses sistem !');
            redirect('/auth/');
        } else if ($temp[0]->online_status != "online") {
            $this->session->set_flashdata('result_login', 'Silahkan Log in kembali untuk mengakses sistem !');
            redirect('auth/force_logout_admin');
        } else {
            $view['title']    = 'Halaman Asesi';
            $view['pageName'] = 'asesi';
            if ($param == 'getAllData') {
                $dt    = $this->M_data_diri->getAllData();
                $start = $this->input->post('start');
                $data  = array();
                foreach ($dt['data'] as $row) {
                    convert_to($row);
                    $id  = encrypt($row->id);
                    $th1 = '<div style="font-size:11px;">' . ++$start . '</div>';
                    // $th2  = get_btn_delete('hapus("' . $id . '")');
                    $th3  = '<div style="font-size:11px;">' . $row->dd_nama_lengkap . '</div>';
                    $th4  = '<div style="font-size:11px;">' . $row->dd_tempat_lahir . '</div>';
                    $th5  = '<div style="font-size:11px;">' . $row->dd_tgl_lahir . '</div>';
                    $th6  = '<div style="font-size:11px;">' . $row->dd_jenis_kelamin . '</div>';
                    $th7  = '<div style="font-size:11px;">' . $row->dd_kebangsaan . '</div>';
                    $th8  = '<div style="font-size:11px;">' . $row->dd_alamat_rumah . '</div>';
                    $th9  = '<div style="font-size:11px;">' . $row->dd_no_hp . '</div>';
                    $th10 = '<div style="font-size:11px;">' . $row->dd_no_telp . '</div>';
                    $th11 = '<div style="font-size:11px;">' . $row->dd_email . '</div>';
                    $th12 = '<div style="font-size:11px;">' . $row->dd_kode_pos . '</div>';
                    $th13 = '<div style="font-size:11px;">' . $row->dd_kantor . '</div>';
                    $th14 = '<div style="font-size:11px;">' . $row->dd_pendidikan_terakhir . '</div>';
                    $th15 = '<div style="font-size:11px;">' . $row->k_lembaga . '</div>';
                    $th16 = '<div style="font-size:11px;">' . $row->k_jabatan . '</div>';
                    $th17 = '<div style="font-size:11px;">' . $row->k_alamat . '</div>';
                    $th18 = '<div style="font-size:11px;">' . $row->k_kode_pos . '</div>';
                    $th19 = '<div style="font-size:11px;">' . $row->k_fax . '</div>';
                    $th20 = '<div style="font-size:11px;">' . $row->k_telp . '</div>';
                    $th21 = '<div style="font-size:11px;">' . $row->k_email . '</div>';
                    $th22 = '<div style="font-size:11px;">' . $row->create_date . '</div>';

                    $data[] = gathered_data(array($th1,  $th3, $th4, $th5, $th6, $th7, $th8, $th9, $th10, $th11, $th12, $th13, $th14, $th15, $th16, $th17, $th18, $th19, $th20, $th21, $th22));
                }
                $dt['data'] = $data;
                echo json_encode($dt);
                die;
            } else if ($param == 'delete') {
                $id_decrypt = decrypt($id);
                $this->M_data_diri->update_delete($id_decrypt);
                // $this->M_data_diri->delete($id_decrypt);
                $this->B_user_log_model->addLog(userLog('delete_data',  $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name') . ' Menghapus data Asesi dengan id asesi ' . $id_decrypt . '', $this->session->userdata('id')));

                $result = array('status' => 'success', 'msg' => 'Data berhasil dihapus !');
                echo json_encode(array('result' => $result));
                die;
            }
            $this->load->view('index_admin', $view);
        }
    }

    public function jadwal($param = '', $id = '')
    {
        // Redirect to login page if the user not logged in
        $temp = $this->User->getuserById($this->session->userdata('id'));
        if (!$this->session->userdata('loggedIn_admin')) {
            $this->session->set_flashdata('result_login', 'Silahkan Log in untuk mengakses sistem !');
            redirect('/auth/');
        } else if ($temp[0]->online_status != "online") {
            $this->session->set_flashdata('result_login', 'Silahkan Log in kembali untuk mengakses sistem !');
            redirect('auth/force_logout_admin');
        } else {
            $view['title']    = 'Halaman Jadwal';
            $view['pageName'] = 'jadwal';
            $view['getSkema'] = $this->M_skema->getData();
            if ($param == 'getAllData') {
                $dt    = $this->M_jadwal->getAllData();
                $start = $this->input->post('start');
                $data  = array();
                foreach ($dt['data'] as $row) {
                    // convert_to($row);
                    $id  = encrypt($row->id);
                    $th1 = '<div style="font-size:11px;">' . ++$start . '</div>';
                    $th2 = '<div style="font-size:11px;">' . $row->judul_skema . '</div>';
                    $th3 = '<div style="font-size:11px;">' . tgl_indo($row->mulai_daftar) . '</div>';
                    $th4 = '<div style="font-size:11px;">' . tgl_indo($row->akhir_daftar) . '</div>';
                    // $th6 = '<div style="font-size:11px;">' . tgl_indo($row->tanggal_pelaksanaan) . '</div>';
                    // $th7 = '<div style="font-size:11px;">' . tgl_indo($row->create_date) . '</div>';
                    $th5 = get_btn_edit('ubah("' . $id . '")');
                    $data[]    = gathered_data(array($th1, $th2, $th3, $th4, $th5));
                }
                $dt['data'] = $data;
                echo json_encode($dt);
                die;
            } else if ($param == 'getById') {
                $id_decrypt = decrypt($id);
                $data       = $this->M_jadwal->getById($id_decrypt);
                echo json_encode(array('data' => $data));
                die;
            } else if ($param == 'addData') {
                $this->form_validation->set_rules("id_skema", "Judul Skema", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("mulai_daftar", "Nomor Skema", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("akhir_daftar", "Nomor Skema", "trim|required", array('required' => '{field} Wajib diisi !'));
                // $this->form_validation->set_rules("tanggal_pelaksanaan", "Nomor Skema", "trim|required", array('required' => '{field} Wajib diisi !'));

                $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">*', '</small>');
                if ($this->form_validation->run() == FALSE) {
                    $result = array('status' => 'error', 'msg' => 'Data yang anda isi Belum Benar!');
                    foreach ($_POST as $key => $value) {
                        $result['messages'][$key] = form_error($key);
                    }
                } else {
                    $data['id_skema']     = htmlspecialchars($this->input->post('id_skema'));
                    $data['mulai_daftar'] = htmlspecialchars($this->input->post('mulai_daftar'));
                    $data['akhir_daftar'] = htmlspecialchars($this->input->post('akhir_daftar'));
                    // $data['tanggal_pelaksanaan'] = htmlspecialchars($this->input->post('tanggal_pelaksanaan'));
                    $data['create_date'] = date('Y-m-d');

                    $result['messages']         = '';
                    $getJadwalByIdSkema = $this->M_jadwal->getDataByIdSkema1($data['id_skema']);

                    if ($getJadwalByIdSkema) {
                        $result = array('status' => 'error', 'msg' => 'Data sudah ditambahkan, hanya dapat melakukan update jadwal !');
                    } else {
                        if ($data['akhir_daftar'] < $data['mulai_daftar']) {
                            $result = array('status' => 'error', 'msg' => 'Tanggal belum tepat, silahkan cek kembali !');
                        } else {
                            $result = array('status' => 'success', 'msg' => 'Data berhasil ditambahkan');
                            $this->M_jadwal->addData($data);
                        }
                    }
                }
                $csrf = array(
                    'token' => $this->security->get_csrf_hash()
                );
                echo json_encode(array('result' => $result, 'csrf' => $csrf));
                die;
            } else if ($param == 'update') {
                $this->form_validation->set_rules("id_skema", "Judul Skema", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("mulai_daftar", "Nomor Skema", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("akhir_daftar", "Nomor Skema", "trim|required", array('required' => '{field} Wajib diisi !'));
                // $this->form_validation->set_rules("tanggal_pelaksanaan", "Nomor Skema", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">*', '</small>');
                if ($this->form_validation->run() == FALSE) {
                    $result = array('status' => 'error', 'msg' => 'Data yang anda isi belum benar !');
                    foreach ($_POST as $key => $value) {
                        $result['messages'][$key] = form_error($key);
                    }
                } else {
                    $data['id']           = $this->input->post('id');
                    $data['id_skema']     = htmlspecialchars($this->input->post('id_skema'));
                    $data['mulai_daftar'] = htmlspecialchars($this->input->post('mulai_daftar'));
                    $data['akhir_daftar'] = htmlspecialchars($this->input->post('akhir_daftar'));
                    // $data['tanggal_pelaksanaan'] = htmlspecialchars($this->input->post('tanggal_pelaksanaan'));
                    $data['create_date'] = date('Y-m-d');

                    $result['messages'] = '';
                    if (($data['akhir_daftar'] < $data['mulai_daftar'])) {
                        $result = array('status' => 'error', 'msg' => 'Tanggal belum tepat, silahkan cek kembali !');
                    } else if ($data['akhir_daftar'] < date('Y-m-d')) {
                        $result = array('status' => 'error', 'msg' => 'Tanggal berakhir belum tepat !');
                    } else {
                        $result = array('status' => 'success', 'msg' => '<h3>Data Telah diubah !</h3>');
                        $this->M_jadwal->update($data['id'], $data);
                    }
                }
                $csrf = array(
                    'token' => $this->security->get_csrf_hash()
                );
                echo json_encode(array('result' => $result, 'csrf' => $csrf));
                die;
            } else if ($param == 'delete') {
                $id_decrypt = decrypt($id);
                // $this->M_pilihan_skema->update_delete($id);
                $this->M_jadwal->delete($id_decrypt);
                $result = array('status' => 'success', 'msg' => 'Data berhasil dihapus !');
                echo json_encode(array('result' => $result));
                die;
            }
            $this->load->view('index_admin', $view);
        }
    }

    public function dataDiri($param = '', $id = '')
    {
        // Redirect to login page if the user not logged in
        $temp = $this->User->getuserById($this->session->userdata('id'));
        if (!$this->session->userdata('loggedIn_admin')) {
            $this->session->set_flashdata('result_login', 'Silahkan Log in untuk mengakses sistem !');
            redirect('/auth/');
        } else if ($temp[0]->online_status != "online") {
            $this->session->set_flashdata('result_login', 'Silahkan Log in kembali untuk mengakses sistem !');
            redirect('auth/force_logout_admin');
        } else {
            $id_user           = $this->session->userdata('id');
            $view['title']           = 'Halaman Data Diri';
            $view['pageName']        = 'dataDiri';
            $view['getSkema']        = $this->M_skema->getData();
            $view['cekDataByIdUser'] = $this->M_data_admin->cekDataByIdUser($id_user);

            if ($param == 'getAllData') {
                $dt    = $this->M_jadwal->getAllData();
                $start = $this->input->post('start');
                $data  = array();
                foreach ($dt['data'] as $row) {
                    // convert_to($row);
                    $id  = encrypt($row->id);
                    $th1 = '<div style="font-size:11px;">' . ++$start . '</div>';
                    $th2 = get_btn_edit('ubah("' . $id . '")');
                    $th3 = '<div style="font-size:11px;">' . $row->judul_skema . '</div>';
                    $th4 = '<div style="font-size:11px;">' . tgl_indo($row->mulai_daftar) . '</div>';
                    $th5 = '<div style="font-size:11px;">' . tgl_indo($row->akhir_daftar) . '</div>';
                    $th6 = '<div style="font-size:11px;">' . tgl_indo($row->tanggal_pelaksanaan) . '</div>';
                    $th7 = '<div style="font-size:11px;">' . tgl_indo($row->create_date) . '</div>';
                    $data[]    = gathered_data(array($th1, $th2, $th3, $th4, $th5, $th6, $th7));
                }
                $dt['data'] = $data;
                echo json_encode($dt);
                die;
            } else if ($param == 'getById') {
                $id_decrypt = decrypt($id);
                $data       = $this->M_jadwal->getById($id_decrypt);
                echo json_encode(array('data' => $data));
                die;
            } else if ($param == 'addData') {
                $this->form_validation->set_rules("nama_lengkap", "Judul Skema", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("email", "Nomor Skema", "trim|required", array('required' => '{field} Wajib diisi !'));

                $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">*', '</small>');
                if ($this->form_validation->run() == FALSE) {
                    $result = array('status' => 'error', 'msg' => 'Data yang anda isi Belum Benar!');
                    foreach ($_POST as $key => $value) {
                        $result['messages'][$key] = form_error($key);
                    }
                } else {
                    $data['id_user']      = $id_user;
                    $data['nama_lengkap'] = htmlspecialchars($this->input->post('nama_lengkap'));
                    $data['email']        = htmlspecialchars($this->input->post('email'));
                    $data['create_date']  = date('Y-m-d');
                    $result['messages']     = '';
                    $result         = array('status' => 'success', 'msg' => 'Data berhasil ditambahkan');
                    $this->M_data_admin->addData($data);
                }
                $csrf = array(
                    'token' => $this->security->get_csrf_hash()
                );
                echo json_encode(array('result' => $result, 'csrf' => $csrf));
                die;
            } else if ($param == 'upload_ttd') {
                if (isset($_FILES['tanda_tangan']['size']) != 0) {
                    $config['upload_path']   = 'g_ttd_admin';
                    $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
                    $config['max_size']      = '2048';
                    $config['overwrite']     = TRUE;
                    $new_name        = time() . $_FILES["tanda_tangan"]['name'];
                    $config['file_name']     = str_replace(array('-', ' '), '_', $new_name);
                    $data['id_user']       = htmlspecialchars($this->input->post('id_user'));
                    $data['tanda_tangan']  = str_replace(array('-', ' '), '_', $new_name);
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload('tanda_tangan')) {
                        $this->session->set_flashdata('error', 'TTD gagal diupload. ' . $this->upload->display_errors());
                        $this->B_user_log_model->addLog(userLog('update_data',  $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name') . ' Error pada saat upload Tanda Tangan admin untuk keperluan APL 01 pada ID data ' . $data['id'] . '', $this->session->userdata('id')));
                        redirect('administrator/dataDiri');
                    } else {
                        $this->M_data_admin->update_ttd($data['id_user'], $data['tanda_tangan']);
                        $this->session->set_flashdata('success', 'TTD berhasil diupload!');
                        $this->B_user_log_model->addLog(userLog('update_data',  $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name') . ' Mengupload Tanda Tangan admin untuk keperluan APL 01 pada ID data ' . $data['id'] . '', $this->session->userdata('id')));
                        redirect('administrator/dataDiri');
                    }
                }
            } else if ($param == 'update') {
                $this->form_validation->set_rules("nama_lengkap", "Judul Skema", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("email", "Nomor Skema", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">*', '</small>');
                if ($this->form_validation->run() == FALSE) {
                    $result = array('status' => 'error', 'msg' => 'Data yang anda isi belum benar !');
                    foreach ($_POST as $key => $value) {
                        $result['messages'][$key] = form_error($key);
                    }
                } else {
                    $data['id']           = htmlspecialchars($this->input->post('id'));
                    $data['id_user']      = $id_user;
                    $data['nama_lengkap'] = htmlspecialchars($this->input->post('nama_lengkap'));
                    $data['email']        = htmlspecialchars($this->input->post('email'));
                    $data['create_date']  = date('Y-m-d');
                    $result['messages']     = '';
                    $result         = array('status' => 'success', 'msg' => '<h3>Data Telah diubah !</h3>');
                    $this->M_data_admin->update($data['id'], $data);
                }
                $csrf = array(
                    'token' => $this->security->get_csrf_hash()
                );
                echo json_encode(array('result' => $result, 'csrf' => $csrf));
                die;
            } else if ($param == 'delete') {
                $id_decrypt = decrypt($id);
                // $this->M_pilihan_skema->update_delete($id);
                $this->M_jadwal->delete($id_decrypt);
                $result = array('status' => 'success', 'msg' => 'Data berhasil dihapus !');
                echo json_encode(array('result' => $result));
                die;
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
            }
            $this->load->view('index_admin', $view);
        }
    }

    public function pemberitahuan($param = '', $id = '')
    {
        // Redirect to login page if the user not logged in
        $temp = $this->User->getuserById($this->session->userdata('id'));
        if (!$this->session->userdata('loggedIn_admin')) {
            $this->session->set_flashdata('result_login', 'Silahkan Log in untuk mengakses sistem !');
            redirect('/auth/');
        } else if ($temp[0]->online_status != "online") {
            $this->session->set_flashdata('result_login', 'Silahkan Log in kembali untuk mengakses sistem !');
            redirect('auth/force_logout_admin');
        } else {
            $view['title']    = 'Halaman Pemberitahuan';
            $view['pageName'] = 'pemberitahuan';
            if ($param == 'getAllData') {
                $dt    = $this->M_pemberitahuan->getAllData();
                $start = $this->input->post('start');
                $data  = array();
                foreach ($dt['data'] as $row) {
                    // convert_to($row);
                    $id  = encrypt($row->id);
                    $th1 = '<div style="font-size:11px;">' . ++$start . '</div>';
                    $th2 = '<div style="font-size:11px;">' . $row->pemberitahuan . '</div>';
                    $th3 = get_btn_group1('ubah("' . $id . '")', 'hapus("' . $id . '")');

                    $data[] = gathered_data(array($th1, $th2, $th3));
                }
                $dt['data'] = $data;
                echo json_encode($dt);
                die;
            } else if ($param == 'getById') {
                $id_decrypt = decrypt($id);
                $data       = $this->M_pemberitahuan->getById($id_decrypt);
                echo json_encode(array('data' => $data));
                die;
            } else if ($param == 'addData') {
                $this->form_validation->set_rules("pemberitahuan", "Judul Skema", "trim|required", array('required' => '{field} Wajib diisi !'));

                $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">*', '</small>');
                if ($this->form_validation->run() == FALSE) {
                    $result = array('status' => 'error', 'msg' => 'Data yang anda isi Belum Benar!');
                    foreach ($_POST as $key => $value) {
                        $result['messages'][$key] = form_error($key);
                    }
                } else {
                    $data['pemberitahuan'] = htmlspecialchars($this->input->post('pemberitahuan'));

                    $data['create_date'] = date('Y-m-d');

                    $result['messages'] = '';
                    $result     = array('status' => 'success', 'msg' => 'Data berhasil ditambahkan');
                    $this->M_pemberitahuan->addData($data);
                    $this->B_user_log_model->addLog(userLog('add_data',  $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name') . ' Menambahkan data Pemberitahuan ' . $data['pemberitahuan'] . '', $this->session->userdata('id')));
                }
                $csrf = array(
                    'token' => $this->security->get_csrf_hash()
                );
                echo json_encode(array('result' => $result, 'csrf' => $csrf));
                die;
            } else if ($param == 'update') {
                $this->form_validation->set_rules("pemberitahuan", "Pemberitahuan", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">*', '</small>');
                if ($this->form_validation->run() == FALSE) {
                    $result = array('status' => 'error', 'msg' => 'Data yang anda isi belum benar !');
                    foreach ($_POST as $key => $value) {
                        $result['messages'][$key] = form_error($key);
                    }
                } else {
                    $data['id']            = $this->input->post('id');
                    $data['pemberitahuan'] = htmlspecialchars($this->input->post('pemberitahuan'));
                    $result['messages']      = '';

                    $result = array('status' => 'success', 'msg' => '<h3>Data Telah diubah !</h3>');
                    $this->M_pemberitahuan->update($data['id'], $data);
                    $this->B_user_log_model->addLog(userLog('update_data',  $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name') . ' Mengubah data Pemberitahuan pada id data' . $data['id'] . '', $this->session->userdata('id')));
                }
                $csrf = array(
                    'token' => $this->security->get_csrf_hash()
                );
                echo json_encode(array('result' => $result, 'csrf' => $csrf));
                die;
            } else if ($param == 'delete') {
                $id_decrypt = decrypt($id);
                // $this->M_pemberitahuan->update_delete($id_decrypt);
                $this->M_pemberitahuan->delete($id_decrypt);
                $this->B_user_log_model->addLog(userLog('delete_data',  $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name') . ' Menghapus data Pemberitahuan dengan id ' . $id_decrypt . '', $this->session->userdata('id')));

                $result = array('status' => 'success', 'msg' => 'Data berhasil dihapus !');
                echo json_encode(array('result' => $result));
                die;
            }
            $this->load->view('index_admin', $view);
        }
    }

    public function tentang_kami($param = '', $id = '')
    {
        // Redirect to login page if the user not logged in
        $temp = $this->User->getuserById($this->session->userdata('id'));
        if (!$this->session->userdata('loggedIn_admin')) {
            $this->session->set_flashdata('result_login', 'Silahkan Log in untuk mengakses sistem !');
            redirect('/auth/');
        } else if ($temp[0]->online_status != "online") {
            $this->session->set_flashdata('result_login', 'Silahkan Log in kembali untuk mengakses sistem !');
            redirect('auth/force_logout_admin');
        } else {


            $view['title']    = 'Tentang Kami';
            $view['pageName'] = 'tentang_kami';
            $view['getData'] = $this->M_tentang->getData();
            if ($param == 'getAllData') {
                $dt    = $this->M_tentang->getAllData();
                $start = $this->input->post('start');
                $data  = array();
                foreach ($dt['data'] as $row) {
                    convert_to($row);
                    $id  = encrypt($row->id);
                    $th1 = '<div style="font-size:11px;">' . ++$start . '</div>';
                    $th2 = '<div style="font-size:11px;">' . $row->judul . '</div>';
                    $th3 = '<div style="font-size:11px;">' . $row->isi . '</div>';
                    $th4 = get_btn_group1('ubah("' . $id . '")', 'hapus("' . $id . '")');

                    $data[] = gathered_data(array($th1, $th2, $th3, $th4));
                }
                $dt['data'] = $data;
                echo json_encode($dt);
                die;
            } else if ($param == 'getById') {
                $id_decrypt = decrypt($id);
                $data       = $this->M_tentang->getById($id_decrypt);
                echo json_encode(array('data' => $data));
                die;
            } else if ($param == 'addData') {
                $this->form_validation->set_rules("judul", "Judul", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("isi", "Isi", "trim|required", array('required' => '{field} Wajib diisi !'));

                $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">*', '</small>');
                if ($this->form_validation->run() == FALSE) {
                    $result = array('status' => 'error', 'msg' => 'Data yang anda isi Belum Benar!');
                    foreach ($_POST as $key => $value) {
                        $result['messages'][$key] = form_error($key);
                    }
                } else {
                    $data['judul']   = htmlspecialchars($this->input->post('judul'));
                    $data['isi']      = ($this->input->post('isi'));
                    $data['create_date']   = date('Y-m-d');

                    $result['messages'] = '';
                    $result     = array('status' => 'success', 'msg' => 'Data berhasil ditambahkan');
                    $this->M_tentang->addData($data);
                    $this->B_user_log_model->addLog(userLog('add_data',  $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name') . ' Menambahkan data tentang judul ' . $data['judul'] . '', $this->session->userdata('id')));
                }
                $csrf = array(
                    'token' => $this->security->get_csrf_hash()
                );
                echo json_encode(array('result' => $result, 'csrf' => $csrf));
                die;
            } else if ($param == 'update') {
                $this->form_validation->set_rules("judul", "Judul", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("isi", "Isi", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">*', '</small>');
                if ($this->form_validation->run() == FALSE) {
                    $result = array('status' => 'error', 'msg' => 'Data yang anda isi belum benar !');
                    foreach ($_POST as $key => $value) {
                        $result['messages'][$key] = form_error($key);
                    }
                } else {
                    $data['id']            = htmlspecialchars($this->input->post('id'));
                    $data['judul']   = htmlspecialchars($this->input->post('judul'));
                    $data['isi']      = ($this->input->post('isi'));
                    $data['create_date']   = date('Y-m-d');
                    $result['messages']      = '';
                    $result          = array('status' => 'success', 'msg' => '<h3>Data Telah diubah !</h3>');
                    $this->M_tentang->update($data['id'], $data);
                    $this->B_user_log_model->addLog(userLog('update_data',  $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name') . ' Mengubah data tentang dengan ID ' . $data['id'] . '', $this->session->userdata('id')));
                }
                $csrf = array(
                    'token' => $this->security->get_csrf_hash()
                );
                echo json_encode(array('result' => $result, 'csrf' => $csrf));
                die;
            } else if ($param == 'delete') {
                $id_decrypt = decrypt($id);
                $this->M_tentang->delete($id_decrypt);
                $this->B_user_log_model->addLog(userLog('delete_data',  $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name') . ' Menghapus data tentang dengan ID ' . $id_decrypt . '', $this->session->userdata('id')));

                $result = array('status' => 'success', 'msg' => 'Data berhasil dihapus !');
                echo json_encode(array('result' => $result));
                die;
            }
            $this->load->view('index_admin', $view);
        }
    }

    public function pesan($param = '', $id = '')
    {
        // Redirect to login page if the user not logged in
        $temp = $this->User->getuserById($this->session->userdata('id'));
        if (!$this->session->userdata('loggedIn_admin')) {
            $this->session->set_flashdata('result_login', 'Silahkan Log in untuk mengakses sistem !');
            redirect('/auth/');
        } else if ($temp[0]->online_status != "online") {
            $this->session->set_flashdata('result_login', 'Silahkan Log in kembali untuk mengakses sistem !');
            redirect('auth/force_logout_admin');
        } else {
            $view['title']    = 'Tentang Kami';
            $view['pageName'] = 'pesan';
            if ($param == 'getAllData') {
                $dt    = $this->M_pesan->getAllData();
                $start = $this->input->post('start');
                $data  = array();
                foreach ($dt['data'] as $row) {
                    convert_to($row);
                    $id  = encrypt($row->id);
                    $th1 = '<div style="font-size:11px;">' . ++$start . '</div>';
                    $th2 = '<div style="font-size:11px;">' . $row->nama . '</div>';
                    $th3 = '<div style="font-size:11px;">' . $row->email . '</div>';
                    $th4 = '<div style="font-size:11px;">' . $row->isi_pesan . '</div>';
                    $th5 = get_btn_delete('hapus("' . $id . '")', 'Hapus');

                    $data[] = gathered_data(array($th1, $th2, $th3, $th4, $th5));
                }
                $dt['data'] = $data;
                echo json_encode($dt);
                die;
            } else if ($param == 'delete') {
                $id_decrypt = decrypt($id);
                $this->M_pesan->delete($id_decrypt);
                $this->B_user_log_model->addLog(userLog('delete_data',  $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name') . ' Menghapus data tentang dengan ID ' . $id_decrypt . '', $this->session->userdata('id')));

                $result = array('status' => 'success', 'msg' => 'Data berhasil dihapus !');
                echo json_encode(array('result' => $result));
                die;
            }
            $this->load->view('index_admin', $view);
        }
    }
}

/* End of file Administrator.php */
