<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Onmachine extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('getinifn') != true) {
            $url = base_url('login');
            redirect($url);
        }
        $this->load->model('mprofile');
        $this->load->model('msublok');
        $this->load->model('monmachine');
    }
    function index()
    {
        $header['personil'] = $this->mprofile->getprofile($this->session->userdata('iduser'))->row_array();
        $header['submodul'] = 4;
        $header['modul'] = 'main';
        $this->session->set_userdata('nomesin','');
        if($this->session->userdata('blnmachine')==''){
            $this->session->set_userdata('blnmachine',date('m'));
        }
        if($this->session->userdata('thnmachine')==''){
            $this->session->set_userdata('thnmachine',date('Y'));
        }
        if($this->session->userdata('lokmachine')==''){
            $this->session->set_userdata('lokmachine','');
        }
        $data['datamesin'] = $this->monmachine->getdata();
        $this->session->set_userdata('depopn', $this->session->userdata('filterstok'));
        $footer['footer'] = 'onmachine';
        $this->load->view('header', $header);
        $this->load->view('page/onmachine', $data);
        $this->load->view('footer', $footer);
    }
    function addonmachine($id=''){
        $header['personil'] = $this->mprofile->getprofile($this->session->userdata('iduser'))->row_array();
        $header['submodul'] = 4;
        $header['modul'] = 'main';
        $data['mesin'] = $this->monmachine->getdatamesin();
        $data['bobbin'] = $this->monmachine->getdatabobbin();
        if($id!=null){
            $data['mode']="edit";
            $data['action'] = base_url().'Onmachine/editbhn';
            $hasil = $this->monmachine->getdataonmachine($id)->row_array();
            $this->session->set_userdata('nomesin',$hasil['machno']);
            $data['xid'] = $id;
            $data['machno'] = $hasil['machno'];
            $data['po'] = $hasil['po'];
            $data['item'] = $hasil['item'];
            $data['dis'] = $hasil['dis'];
            $data['insno'] = $hasil['insno'];
            $data['bunko'] = $hasil['bunko'];
            $data['bunjmlbox'] = $hasil['bunjmlbox'];
            $data['bunbrtbox'] = $hasil['bunbrtbox'];
            $data['bunjmlmsn'] = $hasil['bunjmlmsn'];
            $data['bunbrtmsn'] = $hasil['bunbrtmsn'];
            $data['jnsbob'] = $hasil['jnsbob'];
            $data['bobko'] = $hasil['bobko'];
            $data['bobisi'] = $hasil['bobisi'];
            $data['bobjmlmsn'] = $hasil['bobjmlmsn'];
            $data['lot_dari'] = $hasil['lot_dari'];
            $data['lot_sampai'] = $hasil['lot_sampai'];
            $data['rpm'] = $hasil['rpm'];
            $data['jmbobspl'] = $hasil['jmbobspl']; 
            $data['brg_id'] = $hasil['brg_id']; 
            $data['sku'] = $hasil['po']=='' ? $hasil['brg_id'] : $hasil['po'].' # '.$hasil['item'].' dis '.$hasil['dis'];
            $data['futoito'] = $hasil['futoito']=='1' ? 'checked' : '';
        }else{
            $data['mode']="tambah";
            $data['action'] = base_url().'Onmachine/addbhn';
            $data['xid']= null;
            $data['machno'] = null;
            $data['po'] = null;
            $data['item'] = null;
            $data['dis'] = null;
            $data['insno'] = null;
            $data['bunko'] = null;
            $data['bunjmlbox'] = null;
            $data['bunbrtbox'] = null;
            $data['bunjmlmsn'] = null;
            $data['bunbrtmsn'] = null;
            $data['jnsbob'] = null;
            $data['bobko'] = null;
            $data['bobisi'] = null;
            $data['bobjmlmsn'] = null;
            $data['lot_dari'] = null;
            $data['lot_sampai'] = null;
            $data['rpm'] = null;
            $data['jmbobspl'] = null;
            $data['brg_id'] = null;
            $data['sku'] = null;
            $data['futoito'] = '';
        }
        $footer['footer'] = 'onmachine';
        $this->load->view('header', $header);
        $this->load->view('page/addonmachine',$data);
        $this->load->view('footer', $footer);
    }
    function simpanmesin(){
        $x = $_POST['msn'];
        $this->session->set_userdata('nomesin',$x);
        // $url = base_url().'onmachine/addonmachine';
        // redirect($url);
        echo $x;
    }
    function caridatabarang()
    {
        $brg = $_POST['sku'];
        $query = $this->monmachine->caridatabarang($brg);
        echo json_encode($query->result_array());
        // echo $query;
    }
    function caribarangnya()
    {
        $idx = $_POST['id'];
        $tbl = $_POST['tbl'];
        if ($tbl == 'tb_poe') {
            $query = $this->monmachine->getdatapo($idx);
        } else {
            $query = $this->monmachine->getdatabrg($idx);
        }
        echo json_encode($query->result_array());
    }
    function caribarang($brg,$brg1='',$brg2='',$brg3='')
    {
        $data['barang'] = $this->monmachine->caridatabarang($brg.' '.$brg1.' '.$brg2.' '.$brg3)->result_array();
        $this->load->view('page/caribarang', $data);
    }
    function carimesin(){
        $data['mesin'] = $this->monmachine->getdatamesin()->result_array();
        $this->load->view('page/carimesin', $data);
    }
    function filterbulan()
    {
        $bln = $_POST['bln'];
        $thn = $_POST['thn'];
        $lok = $_POST['lok'];
        $this->session->set_userdata('blnmachine', $bln);
        $this->session->set_userdata('thnmachine', $thn);
        $this->session->set_userdata('lokmachine', $lok);
        $query = $this->monmachine->getdata($bln,$thn,$lok)->result_array();
        echo json_encode($query);
    }
    function addbhn(){
        $query = $this->monmachine->addonmachine();
        if($query){
            $url = base_url().'onmachine';
            redirect($url);
        }
    }
    function editbhn(){
        $query = $this->monmachine->editonmachine();
        if($query){
            $url = base_url().'onmachine';
            redirect($url);
        }
    }
    function cariberatbobbin()
    {
        $idx = $_POST['id'];
        $query = $this->monmachine->cariberatbobbin($idx);
        echo json_encode($query->result_array());
    }
    function hapusdataonmachine($id)
    {
        $query = $this->monmachine->hapusdataonmachine($id);
        $url = base_url() . 'onmachine';
        redirect($url);
    }
    function caridataonmachine(){
        $idx = $_POST['id'];
        $query = $this->monmachine->getdataonmachine($idx);
        echo json_encode($query->result_array());
    }
}
