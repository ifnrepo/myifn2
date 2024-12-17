<?php
class Mlogin extends CI_Model
{
    public function ceklogin($a, $b)
    {
        $query = $this->db->query("Select * from user_manajemen where login = '" . $a . "' and password = '" . $b . "' and login != '' and password != '' and aktif = 1 ");
        return $query;
    }
    public function getperiodeso(){
        $query = $this->db->get('periode_so')->row_array();
        return $query['tahbul'];
    }
}
