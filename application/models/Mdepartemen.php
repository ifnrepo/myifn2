<?php
class Mdepartemen extends CI_Model
{
    public function getdata()
    {
        $this->db->where('inv > 0');
        $this->db->order_by('dept_id');
        $query = $this->db->get("referensi_departemen");
        return $query;
    }
    public function getdatabykode($id)
    {
        $this->db->where('dept_id',$id);
        $query = $this->db->get("referensi_departemen");
        return $query;
    }
    public function updatepersen($data){
        $this->db->where('dept_id',$data['dept_id']);
        $query = $this->db->update('referensi_departemen',$data);
        return $query;
    }
    public function getprofile2($id)
    {
        $query = $this->db->query("select * from user_manajemen where id = '" . $id . "' ");
        return $query;
    }
    public function updateprofil($induk, $nama, $bagi, $jaba, $leve, $logi, $pass, $dept, $aidi, $jenkel,$aktif)
    {
        $query = $this->db->query("update user_manajemen set noinduk = '" . $induk . "' , nama_user = '" . $nama . "', bagian = '" . $bagi . "', jabatan ='" . $jaba . "',
        level = " . $leve . ",login = '" . $logi . "' , password = '" . encrypto($pass) . "', dep_akses= '" . $dept . "',jenkel= '" . $jenkel . "',aktif='".$aktif."' where id = " . $aidi . " ");
        return $query;
    }
    public function simpanprofile($induk, $nama, $bagi, $jaba, $leve, $logi, $pass, $dept, $aidi, $jenkel,$aktif)
    {
        $unik = (new DateTime())->getTimestamp();
        $query = $this->db->query("insert into user_manajemen (person_id,noinduk, nama_user,bagian,jabatan,level,login,password,dep_akses,jenkel,aktif)values('" . $unik . "' ,'" . $induk . "' , 
        '" . $nama . "', '" . $bagi . "', '" . $jaba . "', " . $leve . ",'" . $logi . "' , '" . encrypto($pass) . "', '" . $dept . "','" . $jenkel . "',".$aktif.") ");
        return $query;
    }
}
