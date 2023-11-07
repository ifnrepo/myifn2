<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->model('mlogin');
    }
    function index()
    {
        $data['formAction'] = base_url() . 'login/ceklogin';
        $this->load->view('page/login', $data);
    }
    public function ceklogin()
    {
        $user = $this->input->post('username', True);
        $pass = $this->input->post('password', True);
        $ceklogin = $this->mlogin->ceklogin($user, encrypto($pass));
        if ($ceklogin->num_rows() == 1) {
            $this->session->set_flashdata('info', 'Berhasillogin');
            $data = $ceklogin->row_array();
            $this->session->set_userdata('iduser', $data['person_id']);
            $this->session->set_userdata('xid', $data['id']);
            $this->session->set_userdata('aksesuser', $data['dep_akses']);
            $this->session->set_userdata('fullakses', $data['ful_akses']);
            $this->session->set_userdata('leveluser', $data['level']);
            $this->session->set_userdata('getinifn', 1);
            $this->loginberhasil();
        } else {
            $this->session->set_flashdata('info', 'logingagal');
            $url = base_url() . 'Login';
            redirect($url);
        }
    }

    public function loginberhasil()
    {
        $url = base_url();
        redirect($url);
    }

    function logout()
    {
        $this->session->sess_destroy();
        $url = base_url('Login');
        redirect($url);
    }
}
