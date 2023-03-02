<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SuperAdmin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('');
        // $this->load->helper('');
        $this->load->library('google');
        $this->load->helper('notif&log');
        $this->load->helper('my_function');
        $this->load->model(array('User', 'M_jadwal', 'Home_model', 'M_pemberitahuan', 'M_data_admin', 'M_apl_02_finish', 'M_asesor', 'B_notif_model', 'B_user_log_model', 'M_apl_02', 'M_data_diri', 'M_skema', 'M_pilihan_skema', 'M_unit_element', 'M_unit_pertanyaan', 'M_unit_kompetensi'));
    }

    public function index()
    {
        // Redirect to login page if the user not logged in
        $temp = $this->User->getuserById($this->session->userdata('id'));
        if (!$this->session->userdata('loggedIn_superAdmin')) {
            $this->session->set_flashdata('result_login', 'Silahkan Log in untuk mengakses sistem !');
            redirect('/auth/');
        } else if ($temp[0]->online_status != "online") {
            $this->session->set_flashdata('result_login', 'Silahkan Log in kembali untuk mengakses sistem !');
            redirect('auth/force_logout_admin');
        } else {
            $id_user           = $this->session->userdata('id');
            $view['title']           = 'Halaman Home';
            $view['pageName']        = 'home';
            $view['cekDataByIdUser']      = $this->M_data_admin->cekDataByIdUser($id_user);
            $view['getTotalSkema']        = $this->Home_model->totalSkema();
            $view['totalAsesor']          = $this->Home_model->totalAsesor();
            $view['totalPermohonanAsesi'] = $this->Home_model->totalPermohonanAsesi();
            $view['totalAsesiDiterima']   = $this->Home_model->totalAsesiDiterima();
            $view['totalAsesiDitolak']    = $this->Home_model->totalAsesiDitolak();
            $view['totalPenggunaOnline']  = $this->Home_model->totalPenggunaOnline();
            $view['getAllOnlineUser']   = $this->User->getOnlineUser();

            $this->load->view('index_super_admin', $view);
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


    public function kelolaUser($param = '', $id = '')
    {
        $userOnById = $this->User->getOnlineUserById($this->session->userdata('id'));
        $temp = $this->User->getuserById($this->session->userdata('id'));
        if (!$this->session->userdata('loggedIn_superAdmin')) {
            $this->session->set_flashdata('result_login', 'Silahkan Log in untuk mengakses sistem !');
            redirect('/auth/');
        } else if ($temp[0]->online_status != "online") {
            $this->session->set_flashdata('result_login', 'Silahkan Log in kembali untuk mengakses sistem !');
            redirect('auth/force_logout');
        } else if (count_time_since(strtotime($userOnById[0]->time_online)) > 7100) {
            $this->session->set_flashdata('result_login', 'Silahkan Log in kembali untuk mengakses sistem !');
            redirect('auth/force_logout');
        } else {
            $view['pageName'] = 'kelolaUser';
            $view['title']    = 'Data Pengguna';

            if ($param == 'getAllData') {
                $dt    = $this->User->get_all_data_ajax();
                $start = $this->input->post('start');
                $data  = array();
                foreach ($dt['data'] as $row) {
                    $id  = ($row->id);
                    $th1 = ++$start;
                    $th2 = '<div style="font-size:12px">' . $row->first_name . '</div>';
                    $th3 = '<div style="font-size:12px">' . $row->last_name . '</div>';
                    $th4 = '<div style="font-size:12px">' . $row->address . '</div>';
                    $th5 = '<div style="font-size:12px">' . $row->phone_number . '</div>';
                    $th6 = '<div style="font-size:12px">' . $row->role . '</div>';
                    $th7 = $row->role == 'super_admin' ? '<div style="font-size:11px">Tidak diizinkan</div>' : get_btn_group1('ubah(' . $id . ')', 'hapus(' . $id . ')');
                    $data[]    = gathered_data(array($th1, $th2, $th3, $th4, $th5, $th6, $th7));
                }
                $dt['data'] = $data;
                echo json_encode($dt);
                die;
            } else if ($param == 'addData') {
                $this->form_validation->set_rules("first_name", "First Name", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("last_name", "Last Name", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("email", "Username", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("password", "Password", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("address", "Address", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("phone_number", "Phone Number", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("role", "Role", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">*', '</small>');
                if ($this->form_validation->run() == FALSE) {
                    $result = array('status' => 'error', 'msg' => 'Data yang anda isi Belum Benar!');
                    foreach ($_POST as $key => $value) {
                        $result['messages'][$key] = form_error($key);
                    }
                } else {
                    $data['first_name']   = htmlspecialchars($this->input->post('first_name'));
                    $data['last_name']    = htmlspecialchars($this->input->post('last_name'));
                    $data['email']     = htmlspecialchars($this->input->post('email'));
                    $data['password']     = md5($this->input->post('password'));
                    $data['address']      = htmlspecialchars($this->input->post('address'));
                    $data['phone_number'] = htmlspecialchars($this->input->post('phone_number'));
                    $data['role']         = htmlspecialchars($this->input->post('role'));
                    $result['messages']     = '';
                    $result         = array('status' => 'success', 'msg' => 'Data berhasil dikirimkan');
                    $this->User->addData($data);
                    $this->B_user_log_model->addLog(userLog('Add Data', $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name') . ' Memasukkan data pengguna baru', $this->session->userdata('id')));
                }
                $csrf = array(
                    'token' => $this->security->get_csrf_hash()
                );
                echo json_encode(array('result' => $result, 'csrf' => $csrf));
                die;
            } else if ($param == 'getById') {
                $data = $this->User->get_by_id($id);
                echo json_encode(array('data' => $data));
                die;
            } else if ($param == 'update') {
                $this->form_validation->set_rules("first_name", "First Name", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("last_name", "Last Name", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("email", "Email", "trim|required", array('required' => '{field} Wajib diisi !'));
                // $this->form_validation->set_rules("password", "Password", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("address", "Address", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("phone_number", "Phone Number", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_rules("role", "Role", "trim|required", array('required' => '{field} Wajib diisi !'));
                $this->form_validation->set_error_delimiters('<small id="text-error" style="color:red;">*', '</small>');
                if ($this->form_validation->run() == FALSE) {
                    $result = array('status' => 'error', 'msg' => 'Data yang anda isi belum benar !');
                    foreach ($_POST as $key => $value) {
                        $result['messages'][$key] = form_error($key);
                    }
                } else {
                    $data['id']         = ($this->input->post('id'));
                    $data['first_name'] = htmlspecialchars($this->input->post('first_name'));
                    $data['last_name']  = htmlspecialchars($this->input->post('last_name'));
                    $data['email']   = htmlspecialchars($this->input->post('email'));
                    // $data['password']     = md5($this->input->post('password'));
                    $data['address']      = htmlspecialchars($this->input->post('address'));
                    $data['phone_number'] = htmlspecialchars($this->input->post('phone_number'));
                    $data['role']         = htmlspecialchars($this->input->post('role'));
                    $result['messages']     = '';
                    $result         = array('status' => 'success', 'msg' => 'Data Berhasil diubah');
                    $this->User->update($data['id'], $data);
                    $this->B_user_log_model->addLog(userLog('Ubah Data', $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name') . ' Melakukan perubahan data pengguna pada data yang memiliki id = ' . $data['id'], $this->session->userdata('id')));
                }
                $csrf = array(
                    'token' => $this->security->get_csrf_hash()
                );
                echo json_encode(array('result' => $result, 'csrf' => $csrf));
                die;
            } else if ($param == 'delete') {
                $this->User->delete($id);
                $this->B_user_log_model->addLog(userLog('Hapus Data', $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name') . ' menghapus 1 data pada data pengguna', $this->session->userdata('id')));

                $result = array('status' => 'success', 'msg' => 'Data berhasil dihapus !');
                echo json_encode(array('result' => $result));
                die;
            }

            $this->load->view('index_super_admin', $view);
        }
    }
}

/* End of file Administrator.php */
