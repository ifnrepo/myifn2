<?php
class Mhelper extends CI_Model{
    public function periodeso(){
        $periode = $this->db->get_where('apps_config',['key' => 'periode_so'])->row_array();
        return $periode['value'];
    }
}