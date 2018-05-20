<?php
class Pegawai_model extends CI_model
{
  public function tambah($data_pegawai)
  {
    //insert data pegawai
    $this->db->insert('pegawai',$data_pegawai);
  }

  public function update($id_pegawai, $data_edit_pegawai)
  {
    $this->db->where('id_pegawai', $id_pegawai);
    $this->db->update('pegawai', $data_edit_pegawai);
  }

  public function get_pegawai()
	{
		//$this->db->select('p.* , jp.* , fp.*');
    //$this->db->where('fp.id_pegawai = p.id_pegawai');
		//$query = $this->db->get('pegawai AS p, jabatan_pegawai AS jp , foto_profil_pegawai AS fp');
    $this->db->select('p.* , jp.*');
    $this->db->where('p.jabatan_pegawai = jp.id_jabatan');
    $query = $this->db->get('pegawai AS p, jabatan_pegawai AS jp');
		return $query->result();
	}

  public function get_jabatan_pegawai()
	{
		$this->db->select('*');
		$query = $this->db->get('jabatan_pegawai');
		return $query->result();
	}
}

?>
