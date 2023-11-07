<?php
class Mprofile extends CI_Model
{
    public function getdept()
    {
        $query = $this->db->query("select * from referensi_departemen where inv = 1 order by grup");
        return $query;
    }
    public function getprofile($id)
    {
        $query = $this->db->query("select * from user_manajemen where person_id = '" . $id . "' ");
        return $query;
    }
    public function getprofile2($id)
    {
        $query = $this->db->query("select * from user_manajemen where id = '" . $id . "' ");
        return $query;
    }
    public function updateprofil($induk, $nama, $bagi, $jaba, $leve, $logi, $pass, $dept, $aidi, $jenkel)
    {
        $query = $this->db->query("update user_manajemen set noinduk = '" . $induk . "' , nama_user = '" . $nama . "', bagian = '" . $bagi . "', jabatan ='" . $jaba . "',
        level = " . $leve . ",login = '" . $logi . "' , password = '" . encrypto($pass) . "', dep_akses= '" . $dept . "',jenkel= '" . $jenkel . "' where id = " . $aidi . " ");
        return $query;
    }
    public function simpanprofile($induk, $nama, $bagi, $jaba, $leve, $logi, $pass, $dept, $aidi, $jenkel)
    {
        $unik = (new DateTime())->getTimestamp();
        $query = $this->db->query("insert into user_manajemen (person_id,noinduk, nama_user,bagian,jabatan,level,login,password,dep_akses,jenkel)values('" . $unik . "' ,'" . $induk . "' , 
        '" . $nama . "', '" . $bagi . "', '" . $jaba . "', " . $leve . ",'" . $logi . "' , '" . encrypto($pass) . "', '" . $dept . "','" . $jenkel . "') ");
        return $query;
    }
}
