<?php
class Mcaribarang extends CI_Model
{
    public function getdata(){
        $kata = '';
        $dept = $this->session->userdata('filterstok');
        $po = $this->session->userdata('caripo');
        if(isset($dept) && $dept != ''){
            $kata .= " WHERE b.dept_id = '".$dept."' ";
        }
        if(isset($po) && $po != ''){
            if(isset($dept) && $dept != ''){
                $kata .= " AND a.po LIKE '%".$po."%' ";
            }else{
                $kata .= " WHERE a.po LIKE '%".$po."%' ";
            }
        }
        $query = $this->db->query("SELECT a.*,b.dept_id,e.departemen,c.kode as kodesatuan,b.ket as ketx,a.ket as kety,d.sublok FROM tb_detail_stokopname a 
        LEFT JOIN tb_stokopname b ON a.id_stokopname = b.id 
        LEFT JOIN referensi_satuan c ON a.id_satuan = c.id 
        LEFT JOIN tb_sublok d ON b.ket = d.kode 
        LEFT JOIN referensi_departemen e ON b.dept_id = e.dept_id ".$kata);
        return $query;
    }
}
