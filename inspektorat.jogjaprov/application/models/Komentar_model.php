<?php
class Komentar_model extends CI_model
{
  public function tulis($komentar){
    $this->db->insert('komentar',$komentar);
  }

  public function hapus($id_komentar)
  {
    $this->db->where('id_komentar', $id_komentar);
    $this->db->delete('komentar');
  }
}
?>
