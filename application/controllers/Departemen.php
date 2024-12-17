<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Departemen extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('getinifn') != true) {
            $url = base_url('login');
            redirect($url);
        }

        $this->load->model('mprofile');
        $this->load->model('mdepartemen');
    }
    function index()
    {
        $data['dep'] = $this->mdepartemen->getdata();
        $data['kembali'] = base_url() . 'departemen';
        $data['kembalinama'] = 'Reload';
        $data['mode'] = 'ubah';
        $header['submodul'] = 6;
        $header['modul'] = 'main';
        $footer['footer'] = 'departemen';
        $header['personil'] = $this->mprofile->getprofile($this->session->userdata('iduser'))->row_array();
        $this->load->view('header', $header);
        $this->load->view('page/departemen', $data);
        $this->load->view('footer', $footer);
    }
    function editdepartemen($kode){
        $data['data'] = $this->mdepartemen->getdatabykode($kode)->row_array();
        $this->load->view('page/editdepartemen',$data);
    }
    function updatepersen(){
        $kode = $_POST['xid'];
        $nilai = $_POST['nil'];
        $data = [
            'dept_id' => $kode,
            'persen_so' => $nilai
        ];
        $hasil = $this->mdepartemen->updatepersen($data);
        if($hasil){
            echo 1;
        }
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
    function addprofil()
    {
        $data['dep'] = $this->mprofile->getdept();
        $data['person'] = $this->mprofile->getprofile($this->session->userdata('iduser'))->row_array();
        $data['mode'] = 'simpan';
        $header['personil'] = $this->mprofile->getprofile($this->session->userdata('iduser'))->row_array();
        $header['submodul'] = 2;
        $header['modul'] = 'main';
        $footer['footer'] = 'profile';
        $this->load->view('header', $header);
        $this->load->view('page/profile', $data);
        $this->load->view('footer', $footer);
    }
}
