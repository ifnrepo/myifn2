<?php
class Muser extends CI_Model
{
    public function getuser()
    {
        $query = $this->db->query("select * from user_manajemen order by id");
        return $query;
    }
    public function hapus($id)
    {
        $query = $this->db->query("delete from user_manajemen where id = " . $id);
        return $query;
    }
    public function getdatauser($id){
        $query = $this->db->query("Select * from user_manajemen where person_id = '" . $id."' ");
        return $query;
    }
}
