<?php
class Mopname extends CI_Model
{
    public function departemeninv()
    {
        $query = $this->db->query("select * from referensi_departemen where inv = 1 order by grup,dept_id");
        return $query;
    }
    public function getsatuan()
    {
        $query = $this->db->query("select * from referensi_satuan where id > 0 and (id = 13 or id = 25 or id = 28)");
        return $query;
    }
    public function getdepartemen()
    {
        $hak = $this->session->userdata('aksesuser');
        $hak2 = '';
        for ($i = 0; $i < strlen($hak) / 3; $i++) {
            $hak2 .=  "'" . substr($hak, $i * 3, 2) . "',";
        }
        $query = $this->db->query("select * from referensi_departemen where dept_id in (" . substr($hak2, 0, strlen($hak2) - 1) . ")");
        return $query;
    }
    public function adddataopname($dept, $nama, $ket, $tgl, $person)
    {
        $kode_unik = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890zyxwvutsrqponmlkjihgfedcba"), 14, 10);
        $data = $this->db->query("insert into tb_stokopname(dept_id,petugas,ket,tgl,person_id,kode) values ('" . $dept . "','" . $nama . "','" . $ket . "','" . tglmysql($tgl) . "','" . $person . "','" . $kode_unik . "') ");
        if ($data == 1) {
            $query = $this->db->query("select * from tb_stokopname where dept_id = '" . $dept . "' and petugas = '" . $nama . "' and kode = '" . $kode_unik . "' ");
        }
        return $query;
    }
    public function dataopname()
    {
        if (empty($this->session->userdata('filterstok'))) {
            $hak = $this->session->userdata('aksesuser');
            $hak2 = '';
            for ($i = 0; $i < strlen($hak) / 3; $i++) {
                $hak2 .=  "'" . substr($hak, $i * 3, 2) . "',";
            }
        } else {
            $hak2 = "'" . $this->session->userdata('filterstok') . "',";
        }
        if(!empty($this->session->userdata('filtersublok'))){
            $xsublok = " and concat(a.ket,b.sublok) like '%".$this->session->userdata('filtersublok')."%' ";
        }else{
            $xsublok = "";
        }
        if(!empty($this->session->userdata('filterverifikasi'))){
            $nil = $this->session->userdata('filterverifikasi');
            switch ($nil) {
                case 1:
                    $xverif = ' and a.selesai=0 and a.verifikasi=0';
                    break;
                case 2:
                    $xverif = ' and a.selesai=1 and a.verifikasi=0';
                    break;
                default:
                    $xverif = ' and a.selesai=1 and a.verifikasi=1';
                    break;
            }
        }else{
            $xverif = "";
        }
        $levelsuper = $this->session->userdata('leveluser')==3 ? ' and a.selesai = 1 ' : '';
        $query = $this->db->query("select a.*,b.sublok,c.nama_user from tb_stokopname a left join tb_sublok b on b.kode = a.ket left join user_manajemen c on a.verifperson = c.person_id where a.dept_id in (" . substr($hak2, 0, strlen($hak2) - 1) . ")".$levelsuper.$xsublok.$xverif." order by a.dept_id,b.sublok");
        return $query;
    }
    public function dataprogress()
    {
        if (empty($this->session->userdata('filterstok'))) {
            $hak = $this->session->userdata('aksesuser');
            $hak2 = '';
            for ($i = 0; $i < strlen($hak) / 3; $i++) {
                $hak2 .=  "'" . substr($hak, $i * 3, 2) . "',";
            }
        } else {
            $hak2 = "'" . $this->session->userdata('filterstok') . "',";
        }
        $query = $this->db->query("select a.*,b.sublok from tb_stokopname a left join tb_sublok b on b.kode = a.ket where a.dept_id in (" . substr($hak2, 0, strlen($hak2) - 1) . ") and a.selesai=0 and verifikasi=0 order by a.dept_id,b.sublok");
        return $query;
    }
    public function dataselesai()
    {
        if (empty($this->session->userdata('filterstok'))) {
            $hak = $this->session->userdata('aksesuser');
            $hak2 = '';
            for ($i = 0; $i < strlen($hak) / 3; $i++) {
                $hak2 .=  "'" . substr($hak, $i * 3, 2) . "',";
            }
        } else {
            $hak2 = "'" . $this->session->userdata('filterstok') . "',";
        }
        $query = $this->db->query("select a.*,b.sublok from tb_stokopname a left join tb_sublok b on b.kode = a.ket where a.dept_id in (" . substr($hak2, 0, strlen($hak2) - 1) . ") and a.selesai=1 order by a.dept_id,b.sublok");
        return $query;
    }
    public function dataverif()
    {
        if (empty($this->session->userdata('filterstok'))) {
            $hak = $this->session->userdata('aksesuser');
            $hak2 = '';
            for ($i = 0; $i < strlen($hak) / 3; $i++) {
                $hak2 .=  "'" . substr($hak, $i * 3, 2) . "',";
            }
        } else {
            $hak2 = "'" . $this->session->userdata('filterstok') . "',";
        }
        $query = $this->db->query("select a.*,b.sublok from tb_stokopname a left join tb_sublok b on b.kode = a.ket where a.dept_id in (" . substr($hak2, 0, strlen($hak2) - 1) . ") and verifikasi=1 order by a.dept_id,b.sublok");
        return $query;
    }
    public function datastokopname($id)
    {
        $query = $this->db->query("SELECT a.*,b.departemen,c.sublok FROM tb_stokopname a
        LEFT JOIN referensi_departemen b ON a.dept_id = b.dept_id
        LEFT JOIN tb_sublok c ON c.kode = a.ket
        WHERE a.id = " . $id);
        return $query;
    }
    public function caridatabarangex($ske)
    {
        $idu = '';
        $ide = '';
        $sku = trim($ske);
        if (strrpos($sku, ' ') > 0) {
            $idu =  "skuspec like '%" . substr($sku, 0, strrpos($sku, ' ')) . "%' AND ";
            $ide = "skuspec like '%" . substr($sku, strrpos($sku, ' ') + 1, strlen($sku) - strrpos($sku, ' ')) . "%' ";
        } else {
            $idu = "skuspec like '%" . $sku . "%' ";
        }
        // $data = $this->db->query("select * from viewbarang where (" . $idu . " OR spek like '%" . $sku . "%') and spek not like '%CANCEL%' ");
        $data = $this->db->query("select * from viewbarang where " . $idu . $ide . " AND skuspec not like '%CANCEL%' ");
        return $data;
    }
    public function caridatabarang($sku)
    {
        $dept = $this->session->userdata('depopn');
        $str = trim($sku);
        $arrpisah = [];
        $xkata = '';
        if(strpos($str," ") || strpos($str,"/")){
            $spasi = explode(" ",$str);
            for($x=0; $x < count($spasi); $x++){
                if(strpos($spasi[$x],"/")){
                    $garing = explode("/",$spasi[$x]);
                    for($y=0;$y < count($garing);$y++){
                        array_push($arrpisah,$garing[$y]);
                    }
                }else{
                    array_push($arrpisah,$spasi[$x]);
                }
            }
        }else{
            array_push($arrpisah,$str);
            $this->session->set_flashdata('jmarray',count($arrpisah));
        }
        for($z=0;$z < count($arrpisah);$z++){
            $isi = $arrpisah[$z];
            if($z==0){
                $xkata = "concat_ws('',spek,po) like '%".$isi."%' ";
            }
            else{
                $xkata .= " and concat_ws('',spek,po) like '%".$isi."%' ";
            }
        }
        $this->session->set_flashdata('cekquery',$xkata);
        $data = $this->db->query("select *,if(po='' or po is null,'tb_ref','tb_poe') AS tb from tb_barang_stok where ".$xkata." ANd (id_dept = '" . $dept . "' OR id_dept = 'DL') order by po,item,dis,insno ");
        return $data;
    }
    public function getdatapo($id)
    {
        // $query = $this->db->query("select *,'' as brgid,'tb-po' as jntb from tb_po where id = " . $id);
        $query = $this->db->query("select *,'' as brgid,'tb-po' as jntb from tb_po where concat(po,item,dis) = '" . $id . "' ");
        return $query;
    }
    public function getdatabrg($id)
    {
        // $query = $this->db->query("select *,'' as po,'' as item,'' as dis,kode as brgid,namabarang as spek,'' as color,'tb-brg' as jntb from referensi_barang where id = " . $id);
        $query = $this->db->query("select *,'' as po,'' as item,'' as dis,kode as brgid,namabarang as spek,'' as color,'tb-brg' as jntb from referensi_barang where kode = '" . $id . "' ");
        return $query;
    }
    public function isidata($id, $po, $item, $dis, $brg, $spe, $pcs, $stn, $kgs, $ket, $pc2, $hlm, $dok,$ins,$ble,$br,$xnt,$norut,$per)
    {
        $query = $this->db->query("insert into tb_detail_stokopname(id_stokopname,po,item,dis,kode_brg,spek,jumlah,id_satuan,kgs,ket,pcs,hlm,dok,insno,nobale,br,exnet,norut,person_id) values 
        ('" . $id . "', '" . $po . "', '" . $item . "', '" . $dis . "', '" . $brg . "', '" . $spe . "', '" . $pcs . "', '" . $stn . "', '" . $kgs . "', '" . $ket . "', '" . $pc2 . "', '" . $hlm . "', '" . $dok . "', '" . $ins . "', '" . $ble . "', '" . $br . "', '" . $xnt . "', '" . $norut . "',".$per.")");
        return $query;
    }
    public function caribarangset($po,$item){
        $item1 = str_replace('-1','-2',trim($item));
        $item2 = str_replace('-1','-3',trim($item));
        $query = $this->db->query("SELECT SUM(weight) AS berat FROM tb_po WHERE po = '".$po."' AND (trim(item) = '".trim($item)."' OR TRIM(item) = '".trim($item1)."' OR TRIM(item) = '".trim($item2)."')");
        return $query;
    }
    public function caribale($sku)
    {
        $dept = $this->session->userdata('depopn');
        $str = trim($sku);
        $arrpisah = [];
        $xkata = '';
        if(strpos($str," ") || strpos($str,"/")){
            $spasi = explode(" ",$str);
            for($x=0; $x < count($spasi); $x++){
                if(strpos($spasi[$x],"/")){
                    $garing = explode("/",$spasi[$x]);
                    for($y=0;$y < count($garing);$y++){
                        array_push($arrpisah,$garing[$y]);
                    }
                }else{
                    array_push($arrpisah,$spasi[$x]);
                }
            }
        }else{
            array_push($arrpisah,$str);
        }
        $this->session->set_flashdata('jmarray',count($arrpisah));
        for($z=0;$z < count($arrpisah);$z++){
            if($z==0){
                $xkata = "concat(spek,sku,nobale) like '%".$arrpisah[$z]."%' ";
            }
            else{
                $xkata .= " and concat(spek,sku,nobale) like '%".$arrpisah[$z]."%' ";
            }
        }
        $this->session->set_flashdata('cekquery',$xkata);
        $data = $this->db->query("select *,if(po='' or po is null,'tb_ref','tb_poe') AS tb from tb_barang_stok where ".$xkata." ANd (id_dept = '" . $dept . "' OR id_dept = 'DL') order by po,item,dis,insno ");
        return $data;
    }
    public function editdata($id, $po, $item, $dis, $brg, $spe, $pcs, $stn, $kgs, $ket, $pc2, $id2, $hlm, $dok,$ins,$ble,$br,$xnt,$norut)
    {
        $query = $this->db->query("update tb_detail_stokopname set po = '" . $po . "', item='" . $item . "', dis='" . $dis . "', 
        kode_brg='" . $brg . "', spek='" . $spe . "', jumlah='" . $pcs . "', id_satuan='" . $stn . "', kgs='" . $kgs . "', 
        ket='" . $ket . "', pcs='" . $pc2 . "',hlm='" . $hlm . "', dok='" . $dok . "', insno='" . $ins . "', nobale='" . $ble . "', br='" . $br . "', exnet='" . $xnt . "', norut='" . $norut . "' where id = " . $id2);
        return $query;
    }
    public function getdatastokopname($id)
    {
        $user = $this->session->userdata('userinput')=='' ? '' : ' AND a.person_id = "'.$this->session->userdata('userinput').'" ';
        $query = $this->db->query("select *,a.id as xid,a.person_id AS personid from tb_detail_stokopname a 
        left join referensi_satuan b on b.id = a.id_satuan 
        LEFT JOIN user_manajemen c ON a.verifperson = c.person_id
        where a.id_stokopname = " . $id .$user. " order by a.norut");
        return $query;
    }
    public function getuserstokopname($id)
    {
        $query = $this->db->query("select a.person_id,user_manajemen.nama_user 
        from tb_detail_stokopname a 
        left Join user_manajemen on user_manajemen.person_id = a.person_id
        where a.id_stokopname = " . $id . " group by a.person_id order by a.norut");
        return $query;
    }
    public function getdatastokopnameverif($id)
    {
        $query = $this->db->query("SELECT COUNT(*) AS c FROM tb_detail_stokopname WHERE id_stokopname = " . $id . " AND sesuai = '1'");
        return $query;
    }
    public function hapusdataopname($id)
    {
        $query = $this->db->query("delete from tb_detail_stokopname where id = " . $id);
        return $query;
    }
    public function hapusstokopname($id)
    {
        $query = $this->db->query("delete from tb_detail_stokopname where id_stokopname = " . $id);
        if ($query) {
            $hasil = $this->db->query("delete from tb_stokopname where id = " . $id);
        }
        return $hasil;
    }
    public function caridatabrgopname($id)
    {
        $query = $this->db->query("select *,if(kode_brg='','tb-po','tb-brg') AS jntb from tb_detail_stokopname where id = " . $id);
        return $query;
    }
    function selesaiopname($id)
    {
        $query = $this->db->query("update tb_stokopname set selesai=1 where id = " . $id);
        return $query;
    }
    function verifopname($id)
    {
        $query = $this->db->query("update tb_stokopname set verifikasi=1,verifperson='".$this->session->userdata('iduser')."',verifdate=now() where id = " . $id);
        return $query;
    }
    function editopname($id)
    {
        $query = $this->db->query("update tb_stokopname set selesai=0 where id = " . $id);
        return $query;
    }
    function editverifopname($id)
    {
        $query = $this->db->query("update tb_stokopname set verifikasi=0 where id = " . $id);
        return $query;
    }
    function getsublok()
    {
        $id = $this->session->userdata('filterstok');
        $query = $this->db->query("select * from tb_sublok where dept_id = '" . $id . "' ");
        return $query;
    }
    function getsubloknotuse()
    {
        $id = $this->session->userdata('filterstok');
        $query = $this->db->query("select * from tb_sublok where dept_id = '" . $id . "' and kode not in (select ket from tb_stokopname) ");
        return $query;
    }
    function cekverif($id){
        $query = $this->db->query("update tb_detail_stokopname set sesuai='1',verifperson='".$this->session->userdata('iduser')."',verifdate=now() where id = '" . $id . "' ");
        return $query;
    }
    function editcekverif($id){
        $query = $this->db->query("update tb_detail_stokopname set sesuai='0' where id = '" . $id . "' ");
        return $query;
    }
    public function carinorut($dep,$blok){
        $query = $this->db->query("SELECT MAX(a.norut) AS kode FROM tb_detail_stokopname a
        LEFT JOIN tb_stokopname b ON a.id_stokopname = b.id
        WHERE b.dept_id = '".$dep."' AND a.id_stokopname = ".$blok);
        return $query;
    }
}
