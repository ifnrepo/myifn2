<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Sublok extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('getinifn') != true) {
            $url = base_url('login');
            redirect($url);
        }
        $this->load->model('mopname');
        $this->load->model('mprofile');
        $this->load->model('msublok');
    }
    function index()
    {
        $header['personil'] = $this->mprofile->getprofile($this->session->userdata('iduser'))->row_array();
        $header['submodul'] = 4;
        $header['modul'] = 'main';
        $data['departemen'] = $this->mopname->getdepartemen()->result_array();
        $data['datasublok'] = $this->msublok->getsublok();
        $footer['footer'] = 'sublok';
        $this->load->view('header', $header);
        $this->load->view('page/sublok', $data);
        $this->load->view('footer', $footer);
    }
    function carikode()
    {
        $dept = $_POST['dta'];
        $query = $this->msublok->carikode($dept)->result_array();
        echo json_encode($query);
    }
    function addsublok()
    {
        $query = $this->msublok->addsublok();
        if ($query) {
            $url = base_url() . 'sublok';
            redirect($url);
        }
    }
    function editsublok()
    {
        $query = $this->msublok->editsublok();
        if ($query) {
            $url = base_url() . 'sublok';
            redirect($url);
        }
    }
    function hapussublok($id)
    {
        $query = $this->msublok->hapussublok($id);
        if ($query) {
            $url = base_url() . 'sublok';
            redirect($url);
        }
    }
    function getdatasublok()
    {
        $data = $_POST['dta'];
        $query = $this->msublok->getdatasublok($data)->result_array();
        echo json_encode($query);
    }
    function ceksubloksama(){
        $dept = $_POST['dta'];
        $nama = $_POST['nm'];
        $query = $this->msublok->ceksubloksama($dept,$nama)->result();
        echo json_encode($query);
    }
}
