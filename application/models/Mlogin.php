<?php
class Mlogin extends CI_Model
{
    public function ceklogin($a, $b)
    {
        $query = $this->db->query("Select * from user_manajemen where login = '" . $a . "' and password = '" . $b . "' and login != '' and password != '' ");
        return $query;
    }
}
