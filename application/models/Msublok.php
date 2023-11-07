<?php
class Msublok extends CI_Model
{
    public function carikode($dept)
    {
        $query = $this->db->query("select * from tb_sublok where dept_id = '" . $dept . "' order by id desc ");
        return $query;
    }
    public function getsublok()
    {
        $query = $this->db->query("Select a.*,b.departemen from tb_sublok a left join referensi_departemen b on b.dept_id = a.dept_id ");
        return $query;
    }
    public function addsublok()
    {
        $data = $_POST;
        $data['dept_id'] = $data['deptsublok'];
        $data['kode'] = $data['kdsublok'];
        $data['sublok'] = strtoupper($data['nmsublok']);

        unset($data['deptsublok']);
        unset($data['kdsublok']);
        unset($data['nmsublok']);
        unset($data['idsublok']);
        unset($data['deptt']);

        $hasil = $this->db->insert('tb_sublok', $data);
        return $hasil;
    }
    public function editsublok()
    {
        $data = $_POST;
        $data['dept_id'] = $data['deptt'];
        $data['kode'] = $data['kdsublok'];
        $data['sublok'] = strtoupper($data['nmsublok']);
        $data['id'] = $data['idsublok'];

        unset($data['deptsublok']);
        unset($data['kdsublok']);
        unset($data['nmsublok']);
        unset($data['idsublok']);
        unset($data['deptt']);


        $hasil = $this->db->where('id', $data['id']);
        $hasil = $this->db->update('tb_sublok', $data);

        return $hasil;
    }
    public function hapussublok($id)
    {
        $hasil = $this->db->delete('tb_sublok', array('id' => $id));
        return $hasil;
    }
    public function getdatasublok($id)
    {
        $query = $this->db->query("select * from tb_sublok where id = " . $id);
        return $query;
    }
    public function ceksubloksama($dept,$nama)
    {
        $query = $this->db->query("select * from tb_sublok where dept_id = '" . $dept."' and sublok = '".$nama."' ");
        return $query;
    }
}
