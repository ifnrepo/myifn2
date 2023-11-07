<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
// C:\xampp\htdocs\myifn2\application\third_party\vendor
require('./application/third_party/vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Caribarang extends CI_Controller
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
        $this->load->model('mcaribarang');
    }
    function index()
    {
        $dept = $this->session->userdata('filterstok');
        $po = $this->session->userdata('caripo');
        if(isset($dept) || isset($po)){
            $data['datacari'] = $this->mcaribarang->getdata();
        }
        $data['departemen'] = $this->mopname->getdepartemen()->result_array();
        $data['personil'] = $this->mprofile->getprofile($this->session->userdata('iduser'))->row_array();
        $header['personil'] = $data['personil'];
        $header['submodul'] = 5;
        $header['modul'] = 'main';
        $footer['footer'] = 'cari';
        $this->session->set_userdata('depopn', '');
        $this->session->unset_userdata('blnmachine');
        $this->session->unset_userdata('thnmachine');
        $this->session->unset_userdata('lokmachine');
        $this->load->view('header', $header);
        $this->load->view('page/caribarangpo', $data);
        $this->load->view('footer', $footer);
    }
    function clear(){
        $this->session->unset_userdata('filterstok');
        $this->session->unset_userdata('caripo');
        $url = base_url().'caribarang';
        redirect($url);
    }
    function exportexcel(){
        $semuadata = $data['datacari'] = $this->mcaribarang->getdata()->result();
        $spreadsheet = new Spreadsheet;
        $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'No')
                    ->setCellValue('B1', 'PO')
                    ->setCellValue('C1', 'Item')
                    ->setCellValue('D1', 'Dis')
                    ->setCellValue('E1', 'Brg ID')
                    ->setCellValue('F1', 'SKU')
                    ->setCellValue('G1', 'Spek')
                    ->setCellValue('H1', 'Qty')
                    ->setCellValue('I1', 'Sat')
                    ->setCellValue('J1', 'Kgs')
                    ->setCellValue('K1', 'Dep')
                    ->setCellValue('L1', 'SBL')
                    ->setCellValue('M1', 'Sublok')
                    ->setCellValue('N1', 'Ket');
        $kolom = 2;
        $nomor = 1;
        foreach($semuadata as $pengguna) {

            $spreadsheet->setActiveSheetIndex(0)
                        ->setCellValue('A' . $kolom, $nomor)
                        ->setCellValue('B' . $kolom, $pengguna->po)
                        ->setCellValue('C' . $kolom, $pengguna->item)
                        ->setCellValue('D' . $kolom, $pengguna->dis)
                        ->setCellValue('E' . $kolom, $pengguna->kode_brg)
                        ->setCellValue('F' . $kolom, ponodis($pengguna->po,$pengguna->item,$pengguna->dis,$pengguna->kode_brg))
                        ->setCellValue('G' . $kolom, $pengguna->spek)
                        ->setCellValue('H' . $kolom, $pengguna->pcs)
                        ->setCellValue('I' . $kolom, $pengguna->kodesatuan)
                        ->setCellValue('J' . $kolom, $pengguna->kgs)
                        ->setCellValue('K' . $kolom, $pengguna->departemen)
                        ->setCellValue('L' . $kolom, $pengguna->ketx)
                        ->setCellValue('M' . $kolom, $pengguna->sublok)
                        ->setCellValue('N' . $kolom, $pengguna->kety);

            $kolom++;
            $nomor++;

        }

        $writer = new Xlsx($spreadsheet);

        header('Content-Type: application/vnd.ms-excel');
	    header('Content-Disposition: attachment;filename="DataSO.xlsx"');
	    header('Cache-Control: max-age=0');

	    $writer->save('php://output');
    }
    function cari(){
        $dta = $_POST['dta'];
        $atd = $_POST['atd'];
        if(isset($dta)){
            $this->session->set_userdata('caripo', $dta);
        }
        if(isset($atd)){
            $this->session->set_userdata('filterstok', $atd);
        }
        echo $dta;
    }
    function reset(){
        $this->session->unset_userdata('caripo');
        echo $dta;
    }
}
