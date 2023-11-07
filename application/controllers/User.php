<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('getinifn') != true) {
            $url = base_url('login');
            redirect($url);
        }

        $this->load->model('muser');
        $this->load->model('mprofile');
    }
    function index()
    {
        $data['profil'] = $this->muser->getuser();
        $header['submodul'] = 3;
        $header['modul'] = 'main';
        $footer['footer'] = 'user';
        $data['personil'] = $this->mprofile->getprofile($this->session->userdata('iduser'))->row_array();
        $header['personil'] = $data['personil'];
        $this->load->view('header', $header);
        $this->load->view('page/user', $data);
        $this->load->view('footer', $footer);
    }
    function updateprofil()
    {
        $induk = cekinput($_POST['induk']);
        $nama = cekinput($_POST['nama']);
        $bagi = cekinput($_POST['bagi']);
        $jaba = cekinput($_POST['jaba']);
        $leve = cekinput($_POST['leve']);
        $logi = cekinput($_POST['logi']);
        $pass = cekinput($_POST['pass']);
        $dept = cekinput($_POST['dept']);
        $aidi = cekinput($_POST['aidi']);
        $kel = cekinput($_POST['kel']);
        $query = $this->mprofile->updateprofil($induk, $nama, $bagi, $jaba, $leve, $logi, $pass, $dept, $aidi, $kel);
        if ($query) {
            $arr = ['1'];
            echo json_encode($arr);
        }
    }
    function adduser()
    {
        $data['dep'] = $this->mprofile->getdept();
        $data['person']['noinduk'] = null;
        $data['person']['id'] = null;
        $data['person']['nama_user'] = null;
        $data['person']['bagian'] = null;
        $data['person']['jabatan'] = null;
        $data['person']['level'] = 0;
        $data['person']['jenkel'] = null;
        $data['person']['login'] = null;
        $data['person']['password'] = null;
        $data['mode'] = 'simpan';
        $data['kembali'] = base_url() . 'user';
        $data['kembalinama'] = 'Kembali';
        $header['personil'] = $this->mprofile->getprofile($this->session->userdata('iduser'))->row_array();
        $header['submodul'] = 3;
        $header['modul'] = 'main';
        $footer['footer'] = 'user';

        $this->load->view('header', $header);
        $this->load->view('page/profile', $data);
        $this->load->view('footer', $footer);
    }
    function hapus($id)
    {
        $query = $this->muser->hapus($id);
        if ($query) {
            $url = base_url() . 'user';
            redirect($url);
        }
    }
    function edituser($id = 0)
    {
        $data['dep'] = $this->mprofile->getdept();
        $data['person'] = $this->mprofile->getprofile2($id)->row_array();
        $data['mode'] = 'ubah';
        $data['kembali'] = base_url() . 'user';
        $data['kembalinama'] = 'Kembali';
        $header['personil'] = $this->mprofile->getprofile($this->session->userdata('iduser'))->row_array();
        $header['submodul'] = 3;
        $header['modul'] = 'main';
        $footer['footer'] = 'user';

        $this->load->view('header', $header);
        $this->load->view('page/profile', $data);
        $this->load->view('footer', $footer);
    }
    function simpanuser()
    {
        $induk = cekinput($_POST['induk']);
        $nama = cekinput($_POST['nama']);
        $bagi = cekinput($_POST['bagi']);
        $jaba = cekinput($_POST['jaba']);
        $leve = cekinput($_POST['leve']);
        $logi = cekinput($_POST['logi']);
        $pass = cekinput($_POST['pass']);
        $dept = cekinput($_POST['dept']);
        $aidi = cekinput($_POST['aidi']);
        $kel = cekinput($_POST['kel']);
        $query = $this->mprofile->simpanprofile($induk, $nama, $bagi, $jaba, $leve, $logi, $pass, $dept, $aidi, $kel);
        if ($query) {
            $arr = ['1'];
            echo json_encode($arr);
        }
    }
    function viewuser($id)
    {
        $data['person'] = $this->mprofile->getprofile($id)->row_array();
        $data['dep'] = $this->mprofile->getdept();
        $this->load->view('page/addprofile', $data);
    }
}
