<?php
class Monmachine extends CI_Model
{
    public function carikode($dept)
    {
        $query = $this->db->query("select * from tb_sublok where dept_id = '" . $dept . "' order by id desc ");
        return $query;
    }
    public function getdata()
    {
        $bln = $this->session->userdata('blnmachine');
        $thn = $this->session->userdata('thnmachine');
        $lok = $this->session->userdata('lokmachine');
        $query = $this->db->query("Select tb_onmachine.*,user_manajemen.nama_user 
        from tb_onmachine 
        left join user_manajemen on user_manajemen.person_id = tb_onmachine.verifperson
        where tahbul = '".$thn.$bln."' order by machno ");
        return $query;
    }
    public function getdatabobbin(){
        $query = $this->db->get('referensi_jenis_bobbin');
        return $query;
    }
    public function getdatamesin(){
        $this->db->order_by('mach_no');
        $query = $this->db->get('referensi_msn_netting');
        return $query;
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
            if($z==0){
                $xkata = "concat(spek,sku) like '%".$arrpisah[$z]."%' ";
            }
            else{
                $xkata .= " and concat(spek,sku) like '%".$arrpisah[$z]."%' ";
            }
        }
        $this->session->set_flashdata('cekquery',"select *,if(po='' or po is null,'tb_ref','tb_poe') AS tb from tb_barang_stok where ".$xkata." and id_dept = '" . $dept . "' order by po,item,dis,insno ");
        $data = $this->db->query("select *,if(po='' or po is null,'tb_ref','tb_poe') AS tb from tb_barang_stok where ".$xkata." and id_dept = '" . $dept . "' order by po,item,dis,insno ");
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
    public function addonmachine(){
        $data = $_POST;
        $data['tahbul'] = $this->session->userdata('thnmachine').$this->session->userdata('blnmachine');
        if(isset($_POST['futoito'])){
            $data['futoito'] = '1';
        }
        $data['machno'] = (int) $this->session->userdata('nomesin');
        unset($data['skubarang']);
        unset($data['xid']);
        unset($data['spek']);
        unset($data['sku']);
        unset($data['xmachno']);
        $query = $this->db->insert('tb_onmachine',$data);
        return $query;
    }
    public function editonmachine(){
        $data = $_POST;
        $data['tahbul'] = $this->session->userdata('thnmachine').$this->session->userdata('blnmachine');
        $ide = $data['xid'];
        if(isset($_POST['futoito'])){
            $data['futoito'] = '1';
        }
        $data['machno'] = (int) $this->session->userdata('nomesin');
        unset($data['skubarang']);
        unset($data['xid']);
        unset($data['xmachno']);
        unset($data['spek']);
        unset($data['sku']);
        $this->db->where('id',$ide);
        $query = $this->db->update('tb_onmachine',$data);
        return $query;
    }
    public function selesai(){
        $bl = $this->session->userdata('blnmachine');
        $th = $this->session->userdata('thnmachine');
        $query = $this->db->query("Update tb_onmachine set selesai = 1 where tahbul = '".$th.$bl."' ");
        return $query;
    }
    public function bukaselesai(){
        $bl = $this->session->userdata('blnmachine');
        $th = $this->session->userdata('thnmachine');
        $query = $this->db->query("Update tb_onmachine set selesai = 0 where tahbul = '".$th.$bl."' ");
        return $query;
    }
    public function verifikasi(){
        $bl = $this->session->userdata('blnmachine');
        $th = $this->session->userdata('thnmachine');
        $query = $this->db->query("Update tb_onmachine set verifikasi = 1 where tahbul = '".$th.$bl."' ");
        return $query;
    }
    public function bukaverifikasi(){
        $bl = $this->session->userdata('blnmachine');
        $th = $this->session->userdata('thnmachine');
        $query = $this->db->query("Update tb_onmachine set verifikasi = '0' where tahbul = '".$th.$bl."' ");
        return $query;
    }
    public function cariberatbobbin($id){
        $query = $this->db->get_where('referensi_jenis_bobbin',array('kodebob'=> $id));
        return $query;
    }
    public function hapusdataonmachine($id)
    {
        $hasil = $this->db->delete('tb_onmachine', array('id' => $id));
        return $hasil;
    }
    public function getdataonmachine($id)
    {
        $query = $this->db->query("select a.*,b.bunsen from tb_onmachine a left join referensi_msn_netting b on b.mach_no = a.machno where a.id = " . $id);
        return $query;
    }
    public function getberatbunsen($y){
        $this->db->where('mach_no',$y);
        $query = $this->db->get('referensi_msn_netting')->row_array();
        return $query['bunsen'];
    }
    public function caridataonmachine($id){
        $query = $this->db->get_where('tb_onmachine',array('id'=> $id));
        return $query;
    }
    function cekverif($id){
        $query = $this->db->query("update tb_onmachine set sesuai='1',verifperson='".$this->session->userdata('iduser')."',verifdate=now() where id = '" . $id . "' ");
        return $query;
    }
    function editcekverif($id){
        $query = $this->db->query("update tb_onmachine set sesuai='0' where id = '" . $id . "' ");
        return $query;
    }
}
