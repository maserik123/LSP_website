<?php

/** 
 * @Author: Fitra Arrafiq 
 * @Date: 2020-12-28 07:06:21 
 * @Desc:  Model Asesi, untuk melakukan authentication pada user asesi
 */
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{


    function __construct()
    {
        parent::__construct();
        // Load google oauth library
        $this->load->library('google');
        $this->load->helper('notif&log');
        $this->load->helper('my_function');
        // Load user model
        $this->load->model(array('User', 'B_notif_model', 'B_user_log_model', 'M_data_diri'));
    }

    public function index()
    {
        // Redirect to profile page if the user already logged in
        if ($this->session->userdata('loggedIn') == true) {
            redirect('asesi');
        } else if ($this->session->userdata('loggedIn_asesor') == true) {
            redirect('asesor');
        } else if ($this->session->userdata('loggedIn_admin') == true) {
            redirect('administrator');
        } else if ($this->session->userdata('loggedIn_superAdmin') == true) {
            redirect('superAdmin');
        }
        //Melakukan validasi untuk username dan password
        $this->form_validation->set_rules('email', 'Email', 'required|trim|xss_clean|min_length[6]', array('required' => '{field} Wajib diisi !', 'min_length' => 'Karakter {field} terlalu pendek !'));
        $this->form_validation->set_rules('password', 'Password', 'required|trim|xss_clean|min_length[6]', array('required' => '{field} Wajib diisi !', 'min_length' => 'Karakter {field} terlalu pendek !'));
        $this->form_validation->set_error_delimiters('<h6 style="color:red;" class="font-red-haze error"> *', '</h6>');

        //Jika validasi input username dan password bernilai false
        if ($this->form_validation->run() == FALSE) {
        } else {
            $email = htmlspecialchars($this->input->post('email'));
            $password = htmlspecialchars($this->input->post('password'));

            $email = $email;
            $pass = md5($password);
            $cek  = $this->User->cek_user_pwd($email, $pass);
            if ($cek->num_rows() != 0) {
                foreach ($cek->result() as $qad) {
                    $sess_data['id']            = $qad->id;
                    $sess_data['first_name']    = $qad->first_name;
                    $sess_data['last_name']     = $qad->last_name;
                    $sess_data['email']         = $qad->email;
                    $sess_data['address']       = $qad->address;
                    $sess_data['phone_number']  = $qad->phone_number;
                    $sess_data['picture']       = $qad->picture;
                    $sess_data['role']          = $qad->role;
                    $sess_data['time_online']   = $qad->time_online;
                    $sess_data['online_status'] = $qad->online_status;
                    $sess_data['block_status']  = $qad->block_status;
                    $this->session->set_userdata($sess_data);
                }
                if (($sess_data['block_status'] != 1) && ($sess_data['role'] == 'asesi')) {
                    $this->session->set_userdata('loggedIn', TRUE);
                    $this->session->set_flashdata('success', 'Selamat datang ' . $sess_data['first_name'] . ' ! <br> Anda telah login ke LSP Information System');
                    $this->User->change_on_off($sess_data['id'], online_status('online'));
                    $this->B_user_log_model->addLog(userLog('Login System',  $sess_data['first_name'] . ' ' . $sess_data['last_name'] . ' Login ke System', $sess_data['id']));
                    redirect(base_url('asesi'));
                } else if (($sess_data['block_status'] != 1) && ($sess_data['role'] == 'asesor')) {
                    $this->session->set_userdata('loggedIn_asesor', TRUE);
                    $this->session->set_flashdata('success', 'Selamat datang ' . $sess_data['first_name'] . ' ! <br> Anda telah login ke LSP Information System');
                    $this->User->change_on_off($sess_data['id'], online_status('online'));
                    $this->B_user_log_model->addLog(userLog('Login System',  $sess_data['first_name'] . ' ' . $sess_data['last_name'] . ' Login ke System', $sess_data['id']));
                    redirect(base_url('asesor'));
                } else if (($sess_data['block_status'] != 1) && ($sess_data['role'] == 'administrator')) {
                    $this->session->set_userdata('loggedIn_admin', TRUE);
                    $this->session->set_flashdata('success', 'Selamat datang ' . $sess_data['first_name'] . ' ! <br> Anda telah login ke LSP Information System');
                    $this->User->change_on_off($sess_data['id'], online_status('online'));
                    $this->B_user_log_model->addLog(userLog('Login System',  $sess_data['first_name'] . ' ' . $sess_data['last_name'] . ' Login ke System', $sess_data['id']));
                    redirect(base_url('administrator'));
                } else if (($sess_data['block_status'] != 1) && ($sess_data['role'] == 'super_admin')) {
                    $this->session->set_userdata('loggedIn_superAdmin', TRUE);
                    $this->session->set_flashdata('success', 'Selamat datang ' . $sess_data['first_name'] . ' ! <br> Anda telah login ke LSP Information System');
                    $this->User->change_on_off($sess_data['id'], online_status('online'));
                    $this->B_user_log_model->addLog(userLog('Login System',  $sess_data['first_name'] . ' ' . $sess_data['last_name'] . ' Login ke System', $sess_data['id']));
                    redirect(base_url('superAdmin'));
                } else {
                    $this->session->set_flashdata('result_login', 'This user has blocked, you can not login ! ');
                    redirect('auth/');
                }
            } else {
                $this->session->set_flashdata('result_login', 'Email atau Password salah !');
                redirect('auth/');
            }
        }

        if (isset($_GET['code'])) {
            // Authenticate user with google
            if ($this->google->getAuthenticate()) {
                // Get user info from google
                $gpInfo = $this->google->getUserInfo();
                // Preparing data for database insertion
                $userData['oauth_provider'] = 'google';
                $userData['oauth_uid']      = $gpInfo['id'];
                $userData['first_name']     = $gpInfo['given_name'];
                $userData['last_name']      = $gpInfo['family_name'];
                $userData['email']          = $gpInfo['email'];
                $userData['link']           = !empty($gpInfo['link']) ? $gpInfo['link'] : '';
                $userData['picture']        = $gpInfo['picture'];
                $cek_auth         = $this->User->cek_auth($userData['email']);

                if ($cek_auth->num_rows() != 0) {
                    foreach ($cek_auth->result() as $qck) {
                        $sess_data['id']            = $qck->id;
                        $sess_data['first_name']    = $qck->first_name;
                        $sess_data['last_name']     = $qck->last_name;
                        $sess_data['email']         = $qck->email;
                        $sess_data['address']       = $qck->address;
                        $sess_data['phone_number']  = $qck->phone_number;
                        $sess_data['picture']       = $qck->picture;
                        $sess_data['role']          = $qck->role;
                        $sess_data['time_online']   = $qck->time_online;
                        $sess_data['online_status'] = $qck->online_status;
                        $sess_data['block_status']  = $qck->block_status;
                        $this->session->set_userdata($sess_data);
                    }
                    if (($sess_data['block_status'] != 1) && ($sess_data['role'] == 'asesi')) {
                        // Insert or update user data to the database
                        $this->User->checkUser($userData);
                        // Store the status and user profile info into session
                        $this->session->set_userdata('loggedIn', true);
                        $this->session->set_userdata('userData', $userData);
                        $id = $this->session->userdata('id');
                        $this->session->set_flashdata('success', 'Selamat datang ' . $sess_data['first_name'] . ' ! <br> Anda telah login ke LSP Information System');
                        $this->User->change_on_off($id, online_status('online'));
                        $this->B_user_log_model->addLog(userLog('Login System',  $sess_data['first_name'] . ' ' . $sess_data['last_name'] . ' Login ke System', $sess_data['id']));
                        redirect('asesi');
                    } else if (($sess_data['block_status'] != 1) && ($sess_data['role'] == 'asesor')) {
                        // Insert or update user data to the database
                        $this->User->checkUser($userData);
                        // Store the status and user profile info into session
                        $this->session->set_userdata('loggedIn_asesor', true);
                        $this->session->set_userdata('userData', $userData);
                        $id = $this->session->userdata('id');
                        $this->session->set_flashdata('success', 'Selamat datang ' . $sess_data['first_name'] . ' ! <br> Anda telah login ke LSP Information System');
                        $this->User->change_on_off($id, online_status('online'));
                        $this->B_user_log_model->addLog(userLog('Login System',  $sess_data['first_name'] . ' ' . $sess_data['last_name'] . ' Login ke System', $sess_data['id']));
                        redirect('asesor');
                    } else if (($sess_data['block_status'] != 1) && ($sess_data['role'] == 'administrator')) {
                        // Insert or update user data to the database
                        $this->User->checkUser($userData);
                        // Store the status and user profile info into session
                        $this->session->set_userdata('loggedIn_admin', true);
                        $this->session->set_userdata('userData', $userData);
                        $id = $this->session->userdata('id');
                        $this->session->set_flashdata('success', 'Selamat datang ' . $sess_data['first_name'] . ' ! <br> Anda telah login ke LSP Information System');
                        $this->User->change_on_off($id, online_status('online'));
                        $this->B_user_log_model->addLog(userLog('Login System',  $sess_data['first_name'] . ' ' . $sess_data['last_name'] . ' Login ke System', $sess_data['id']));
                        redirect('administrator');
                    } else if (($sess_data['block_status'] != 1) && ($sess_data['role'] == 'super_admin')) {
                        // Insert or update user data to the database
                        $this->User->checkUser($userData);
                        // Store the status and user profile info into session
                        $this->session->set_userdata('loggedIn_superAdmin', true);
                        $this->session->set_userdata('userData', $userData);
                        $id = $this->session->userdata('id');
                        $this->session->set_flashdata('success', 'Selamat datang ' . $sess_data['first_name'] . ' ! <br> Anda telah login ke LSP Information System');
                        $this->User->change_on_off($id, online_status('online'));
                        $this->B_user_log_model->addLog(userLog('Login System',  $sess_data['first_name'] . ' ' . $sess_data['last_name'] . ' Login ke System', $sess_data['id']));
                        redirect('superAdmin');
                    } else {
                        $this->session->set_flashdata('result_login', 'This user has blocked, you can not login ! ');
                        redirect('auth/');
                    }
                } else {
                    // Redirect to profile page
                    $this->session->set_flashdata('result_login', 'Akun Pengguna Belum Terdaftar !');
                    redirect('auth/');
                }
            }
        }

        // Google authentication url
        $data['loginURL']       = $this->google->loginURL();
        // $data['jenis_user_log'] = $this->B_user_log_model->countUserLogbyJenisAksi('jenis_aksi');

        $this->load->view('auth/index', $data);
    }


    public function logout()
    {
        // Reset OAuth access token
        $this->google->revokeToken();
        // Remove token and user data from the session
        $this->session->unset_userdata('loggedIn');
        $this->session->unset_userdata('userData');
        // Destroy entire session data
        $this->session->sess_destroy();
        $user_id = $this->session->userdata('id');
        $this->B_user_log_model->addLog(userLog('Logout System',  $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name') . ' Logout dari System', $this->session->userdata('id')));
        $this->User->change_on_off($user_id, online_status('offline'));
        // Redirect to login page
        echo json_encode(array("status" => 'success', 'msg' => 'Terimakasih telah menggunakan sistem LSP !'));
    }

    public function logout_asesor()
    {
        // Reset OAuth access token
        $this->google->revokeToken();
        // Remove token and user data from the session
        $this->session->unset_userdata('loggedIn_asesor');
        $this->session->unset_userdata('userData');
        // Destroy entire session data
        $this->session->sess_destroy();
        $user_id = $this->session->userdata('id');
        $this->B_user_log_model->addLog(userLog('Logout System',  $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name') . ' Logout dari System', $this->session->userdata('id')));
        $this->User->change_on_off($user_id, online_status('offline'));
        // Redirect to login page
        echo json_encode(array("status" => 'success', 'msg' => 'Terimakasih telah menggunakan sistem LSP !'));
    }

    public function logout_admin()
    {
        // Reset OAuth access token
        $this->google->revokeToken();
        // Remove token and user data from the session
        $this->session->unset_userdata('loggedIn_admin');
        $this->session->unset_userdata('userData');
        // Destroy entire session data
        $this->session->sess_destroy();
        $user_id = $this->session->userdata('id');
        $this->B_user_log_model->addLog(userLog('Logout System',  $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name') . ' Logout dari System', $this->session->userdata('id')));
        $this->User->change_on_off($user_id, online_status('offline'));
        // Redirect to login page
        echo json_encode(array("status" => 'success', 'msg' => 'Terimakasih telah menggunakan sistem LSP !'));
    }

    public function force_logout()
    {
        // Reset OAuth access token
        $this->google->revokeToken();
        // Remove token and user data from the session
        $this->session->unset_userdata('loggedIn');
        $this->session->unset_userdata('userData');
        $this->session->sess_destroy();
        $user_id = $this->session->userdata('id');
        $this->B_user_log_model->addLog(userLog('Logout System',  $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name') . ' Logout dari System', $this->session->userdata('id')));
        $this->User->change_on_off($user_id, online_status('offline'));
        // Destroy entire session data

        // Redirect to login page
        redirect('auth');
    }

    public function force_logout_asesor()
    {
        // Reset OAuth access token
        $this->google->revokeToken();
        // Remove token and user data from the session
        $this->session->unset_userdata('loggedIn_asesor');
        $this->session->unset_userdata('userData');
        $this->session->sess_destroy();
        $user_id = $this->session->userdata('id');
        $this->B_user_log_model->addLog(userLog('Logout System',  $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name') . ' Logout dari System', $this->session->userdata('id')));
        $this->User->change_on_off($user_id, online_status('offline'));
        // Destroy entire session data

        // Redirect to login page
        redirect('auth');
    }

    public function force_logout_admin()
    {
        // Reset OAuth access token
        $this->google->revokeToken();
        // Remove token and user data from the session
        $this->session->unset_userdata('loggedIn_admin');
        $this->session->unset_userdata('userData');
        $this->session->sess_destroy();
        $user_id = $this->session->userdata('id');
        $this->B_user_log_model->addLog(userLog('Logout System',  $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name') . ' Logout dari System', $this->session->userdata('id')));
        $this->User->change_on_off($user_id, online_status('offline'));
        // Destroy entire session data

        // Redirect to login page
        redirect('auth');
    }

    public function registrasi($param = '', $id = '')
    {
        $view['title'] = 'Registrasi';
        if ($param == 'getAllData') {
            $dt    = $this->Jabatan->getAllData();
            $start = $this->input->post('start');
            $data  = array();
            foreach ($dt['data'] as $row) {
                $id  = $row->id;
                $th1 = '<div style="font-size:12px;">' . ++$start . '</div>';
                $th2 = get_btn_group1('ubah("' . $id . '")', 'hapus("' . $id . '")');
                $th3 = '<div style="font-size:12px;">' . $row->nama_jabatan . '</div>';
                $th4 = '<div style="font-size:12px;">' . $row->tingkat_jabatan . '</div>';
                $th5 = '<div style="font-size:12px;">' . tgl_indo($row->create_date) . '</div>';
                $data[]    = gathered_data(array($th1, $th2, $th3, $th4, $th5));
            }
            $dt['data'] = $data;
            echo json_encode($dt);
            die;
        } else if ($param == 'getById') {
            $data = $this->Jabatan->getById($id);
            echo json_encode(array('data' => $data));
            die;
        } else if ($param == 'addData') {
            $this->form_validation->set_rules("first_name", "Nama Awalan", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("last_name", "Nama Akhiran", "trim|required", array('required' => '{field} Wajib diisi !'));
            // $this->form_validation->set_rules("username", "Username", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("password", "Password", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("confirm", "Password Confirmation", "trim|required|matches[password]", array('required' => '{field} Wajib diisi !', 'matches' => 'Password tidak cocok !'));
            $this->form_validation->set_rules("email", "Email", "trim|required|valid_email", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("phone_number", "Nomor Handphone", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("address", "Tingkat Jabatan", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("gender", "Tingkat Jabatan", "trim|required", array('required' => '{field} Wajib diisi !'));

            $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">*', '</small>');
            if ($this->form_validation->run() == FALSE) {
                $result = array('status' => 'error', 'msg' => 'Data yang anda isi Belum Benar!');
                foreach ($_POST as $key => $value) {
                    $result['messages'][$key] = form_error($key);
                }
            } else {
                $data['first_name']   = htmlspecialchars($this->input->post('first_name'));
                $data['last_name']    = htmlspecialchars($this->input->post('last_name'));
                // $data['username']     = htmlspecialchars($this->input->post('username'));
                $data['password']     = htmlspecialchars(md5($this->input->post('password')));
                $data['email']        = htmlspecialchars($this->input->post('email'));
                $data['phone_number'] = htmlspecialchars($this->input->post('phone_number'));
                $data['address']      = htmlspecialchars($this->input->post('address'));
                $data['gender']       = htmlspecialchars($this->input->post('gender'));
                $data['role']         = htmlspecialchars($this->input->post('role'));
                $data['created']      = htmlspecialchars($this->input->post('created'));
                $result['messages']     = '';
                $checkUser = $this->User->cekByEmailUserNamePhone($this->input->post('email'), $this->input->post('phone_number'));
                if ($checkUser) {
                    $result         = array('status' => 'error', 'msg' => 'Gagal ! <br> <small>Pengguna sudah terdaftar !</small>');
                } else {
                    $result         = array('status' => 'success', 'msg' => 'Berhasil mendaftar ! <br> <small>Silahkan login untuk melanjutkan !</small>');
                    $this->User->add_users($data);
                }
            }
            $csrf = array(
                'token' => $this->security->get_csrf_hash()
            );
            echo json_encode(array('result' => $result, 'csrf' => $csrf));
            die;
        } else if ($param == 'update') {
            $this->form_validation->set_rules("nama_jabatan", "Nama Jabatan", "trim|required", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_rules("tingkat_jabatan", "Tingkat Jabatan", "trim|required", array('required' => '{field} Wajib diisi !'));

            $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">*', '</small>');
            if ($this->form_validation->run() == FALSE) {
                $result = array('status' => 'error', 'msg' => 'Data yang anda isi belum benar !');
                foreach ($_POST as $key => $value) {
                    $result['messages'][$key] = form_error($key);
                }
            } else {
                $data['id']                 = htmlspecialchars($this->input->post('id'));
                $data['nama_jabatan']       = htmlspecialchars($this->input->post('nama_jabatan'));
                $data['id_tingkat_jabatan'] = htmlspecialchars($this->input->post('tingkat_jabatan'));
                $data['create_date']        = htmlspecialchars($this->input->post('create_date'));
                $result['messages']           = '';
                $result               = array('status' => 'success', 'msg' => 'Data Berhasil diubah');
                $this->Jabatan->update($data['id'], $data);
            }
            $csrf = array(
                'token' => $this->security->get_csrf_hash()
            );
            echo json_encode(array('result' => $result, 'csrf' => $csrf));
            die;
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
        $this->load->view('auth/registrasiAkun', $view);
    }

    public function forgotPassword($param = '', $id = '')
    {
        $view['title'] = 'Forgot Password';
        if ($param == 'changePass') {
            // Form Validation
            $this->form_validation->set_rules("email", "Email", "trim|required|valid_email", array('required' => '{field} Wajib diisi !'));
            $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">*', '</small>');
            if ($this->form_validation->run() == FALSE) {
                $result = array('status' => 'error', 'msg' => 'Silahkan masukkan email anda !');
                foreach ($_POST as $key => $value) {
                    $result['messages'][$key] = form_error($key);
                }
            } else {
                $data['email'] = htmlspecialchars($this->input->post('email'));
                $newPass = uniqid();
                $result['messages']           = '';
                $getUserByEmail = $this->User->getUserByEmail($data['email']);
                if (($getUserByEmail)) {
                    $result               = array('status' => 'success', 'msg' => 'Password baru telah dikirimkan ke email anda !');
                    _sendEmail($data['email'], $newPass);
                    $this->User->updateByEmail($data['email'], md5($newPass));
                } else {
                    $result               = array('status' => 'error', 'msg' => 'Email anda tidak terdaftar !');
                }
            }
            $csrf = array(
                'token' => $this->security->get_csrf_hash()
            );
            echo json_encode(array('result' => $result, 'csrf' => $csrf));
            die;
        }
        $this->load->view('auth/forgotPassword', $view);
    }
}
