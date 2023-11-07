<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('getinifn') != true) {
            $url = base_url('login');
            redirect($url);
        }
        $this->load->model('mprofile');
    }
    function index()
    {
        $header['personil'] = $this->mprofile->getprofile($this->session->userdata('iduser'))->row_array();
        $header['submodul'] = 1;
        $header['modul'] = 'main';
        $this->load->view('header', $header);
        $this->load->view('page/main');
        $this->load->view('footer');
    }
}
