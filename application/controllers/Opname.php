<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Opname extends CI_Controller
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
    }
    function index()
    {
        $data['dataopname'] = $this->mopname->dataopname();
        $data['jumlahrec'] = $this->mopname->dataopname()->num_rows();
        $data['jumlahonprogress'] = $this->mopname->dataprogress()->num_rows();
        $data['jumlahselesai'] = $this->mopname->dataselesai()->num_rows();
        $data['jumlahverif'] = $this->mopname->dataverif()->num_rows();
        $data['personil'] = $this->mprofile->getprofile($this->session->userdata('iduser'))->row_array();
        $data['departemen'] = $this->mopname->getdepartemen()->result_array();
        $header['personil'] = $data['personil'];
        $header['submodul'] = 4;
        $header['modul'] = 'main';
        $footer['footer'] = 'stokopname';
        $this->session->set_userdata('depopn', '');
        $this->session->unset_userdata('blnmachine');
        $this->session->unset_userdata('thnmachine');
        $this->session->unset_userdata('lokmachine');
        $this->load->view('header', $header);
        $this->load->view('page/opname', $data);
        $this->load->view('footer', $footer);
    }
    function addopname()
    {
        $data['personil'] = $this->mprofile->getprofile($this->session->userdata('iduser'))->row_array();
        // $data['departemen'] = $this->mopname->departemeninv()->result_array();
        $data['departemen'] = $this->mopname->getdepartemen()->result_array();
        $data['sublok'] = $this->mopname->getsubloknotuse()->result_array();
        $this->load->view('page/addopname', $data);
    }
    function hapusstokopname($id)
    {
        $query = $this->mopname->hapusstokopname($id);
        $url = base_url() . 'opname';
        redirect($url);
    }
    function stokopname($id = 0)
    {
        $data['namastok'] = $this->mopname->datastokopname($id)->row_array();
        $data['satuan'] = $this->mopname->getsatuan()->result_array();
        $data['barangstok'] = $this->mopname->getdatastokopname($id);
        $data['barangverif'] = $this->mopname->getdatastokopnameverif($id)->row_array();
        $header['submodul'] = 4;
        $header['personil'] = $this->mprofile->getprofile($this->session->userdata('iduser'))->row_array();
        $footer['footer'] = 'stokopname';
        $carkod = $this->mopname->carinorut($this->session->userdata('depopn'),$id)->row_array();
        $data['norut'] = (int) $carkod['kode'] + 1;
        $this->session->set_userdata('depopn', $data['namastok']['dept_id']);
        $this->load->view('header', $header);
        $this->load->view('page/stokopname', $data);
        $this->load->view('footer', $footer);
    }
    function caribarangnya()
    {
        $idx = $_POST['id'];
        $tbl = $_POST['tbl'];
        if ($tbl == 'tb_poe') {
            $query = $this->mopname->getdatapo($idx);
        } else {
            $query = $this->mopname->getdatabrg($idx);
        }
        echo json_encode($query->result_array());
    }
    function caribarang($brg,$brg1='',$brg2='',$brg3='')
    {
        $data['barang'] = $this->mopname->caridatabarang($brg.' '.$brg1.' '.$brg2.' '.$brg3)->result_array();
        $this->load->view('page/caribarang', $data);
    }
    function adddataopname()
    {
        $dept = cekinput($_POST['dep']);
        $nama = cekinput($_POST['nama']);
        $tgl = cekinput($_POST['tgl']);
        $person = cekinput($_POST['person']);
        $ket = cekinput(strtoupper($_POST['ket']));
        $query = $this->mopname->adddataopname($dept, $nama, $ket, $tgl, $person);
        // if ($query) {
        echo json_encode($query->result_array());
        //     $arr = ['1'];
        //     echo json_encode($arr);
        // }
    }
    function hapusdataopname($id, $ide)
    {
        $query = $this->mopname->hapusdataopname($id);
        $url = base_url() . 'opname/stokopname/' . $ide;
        redirect($url);
    }
    function caridatabarang()
    {
        $brg = $_POST['sku'];
        $query = $this->mopname->caridatabarang($brg);
        echo json_encode($query->result_array());
        // echo $query;
    }
    function caribarangset()
    {
        $po = $_POST['xpo'];
        $item = $_POST['xitem'];
        $query = $this->mopname->caribarangset($po,$item);
        echo json_encode($query->result());
        // echo $query;
    }
    function caribale(){
        $bale = $_POST['sku'];
        $po = $_POST['uks'];
        $query = $this->mopname->caribale($po.' '.$bale);
        echo json_encode($query->result_array());
    }
    function caridatabale($brg,$brg1='',$brg2='',$brg3='')
    {
        $data['barang'] = $this->mopname->caribale($brg.' '.$brg1.' '.$brg2.' '.$brg3)->result_array();
        $this->load->view('page/caribarang', $data);
    }
    function isidata()
    {
        $id = cekinput($_POST['xid']);
        $po = cekinput($_POST['xpo']);
        $item = cekinput($_POST['xitem']);
        $dis = cekinput($_POST['xdis']);
        $brg = cekinput($_POST['xbrg']);
        $spe = cekinput($_POST['xspe']);
        $pcs = cekinput(toangka($_POST['xpcs']));
        $stn = cekinput($_POST['xstn']);
        $kgs = cekinput(toangka($_POST['xkgs']));
        $ket = cekinput($_POST['xket']);
        $dok = cekinput($_POST['xdok']);
        $pc2 = cekinput(toangka($_POST['xpc2']));
        $hlm = cekinput(toangka($_POST['xhlm']));
        $ins = cekinput($_POST['xins']);
        $ble = cekinput($_POST['xble']);
        $br = cekinput($_POST['xbr']);
        $xnt = cekinput($_POST['xnt']);
        $carkod = $this->mopname->carinorut($this->session->userdata('depopn'),$id)->row_array();
        $norut = (int) $carkod['kode'] + 1;
        $query = $this->mopname->isidata($id, $po, $item, $dis, $brg, $spe, $pcs, $stn, $kgs, $ket, $pc2, $hlm, $dok, $ins,$ble,$br,$xnt,$norut);
        if ($query) {
            $arr = ['1'];
            echo json_encode($arr);
        }
    }
    function editdata()
    {
        $id = cekinput($_POST['xid']);
        $po = cekinput($_POST['xpo']);
        $item = cekinput($_POST['xitem']);
        $dis = cekinput($_POST['xdis']);
        $brg = cekinput($_POST['xbrg']);
        $spe = cekinput($_POST['xspe']);
        $pcs = cekinput(toangka($_POST['xpcs']));
        $stn = cekinput($_POST['xstn']);
        $kgs = cekinput(toangka($_POST['xkgs']));
        $ket = cekinput($_POST['xket']);
        $pc2 = cekinput(toangka($_POST['xpc2']));
        $id2 = cekinput($_POST['xid2']);
        $dok = cekinput($_POST['xdok']);
        $hlm = cekinput(toangka($_POST['xhlm']));
        $ins = cekinput($_POST['xins']);
        $ble = cekinput($_POST['xble']);
        $br = cekinput($_POST['xbr']);
        $xnt = cekinput($_POST['xnt']);
        $norut = cekinput($_POST['xru']);
        $query = $this->mopname->editdata($id, $po, $item, $dis, $brg, $spe, $pcs, $stn, $kgs, $ket, $pc2, $id2, $hlm, $dok,$ins,$ble,$br,$xnt,$norut);
        if ($query) {
            $arr = ['1'];
            echo json_encode($arr);
        }
    }
    function caridatabrgopname()
    {
        $id = $_POST['id'];
        $query = $this->mopname->caridatabrgopname($id);
        echo json_encode($query->result_array());
    }
    function selesaiopname($id)
    {
        $query = $this->mopname->selesaiopname($id);
        if ($query) {
            $url = base_url() . 'opname/stokopname/' . $id;
            redirect($url);
        }
    }
    function verifopname($id)
    {
        $query = $this->mopname->verifopname($id);
        if ($query) {
            $url = base_url() . 'opname/stokopname/' . $id;
            redirect($url);
        }
    }
    function editopname($id)
    {
        $query = $this->mopname->editopname($id);
        if ($query) {
            $url = base_url() . 'opname/stokopname/' . $id;
            redirect($url);
        }
    }
    function editverifopname($id)
    {
        $query = $this->mopname->editverifopname($id);
        if ($query) {
            $url = base_url() . 'opname/stokopname/' . $id;
            redirect($url);
        }
    }
    function filterstokopname()
    {
        $dat = $_POST['dta'];
        $this->session->set_userdata('filterstok', $dat);
        echo $this->session->userdata('filterstok');
    }
    function cekverif($id,$ide){
        $query = $this->mopname->cekverif($id);
        if($query){
            $url = base_url() . 'opname/stokopname/' . $ide;
            redirect($url);
        }
    }
    function editcekverif($id,$ide){
        $query = $this->mopname->editcekverif($id);
        if($query){
            $url = base_url() . 'opname/stokopname/' . $ide;
            redirect($url);
        }
    }
    function carisublok(){
        $dat = $_POST['dta'];
        $this->session->set_userdata('filtersublok', $dat);
        echo $this->session->userdata('filtersublok');
    }
    function kosongkansublok(){
        $dat = $_POST['dta'];
        $this->session->unset_userdata('filtersublok');
        echo $this->session->userdata('filtersublok');
    }
}
