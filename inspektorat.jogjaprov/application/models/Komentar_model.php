<?php
class Komentar_model extends CI_model
{
  public function tulis($komentar){
    $this->db->insert('komentar',$komentar);
  }

  public function fetchkomentar($id_berita)
  {
    $this->db->select('k.*, u.nama_user')
          ->from('komentar AS k, user AS u')
          ->where('k.id_user = u.id_user')
          ->where('k.id_berita', $id_berita);

    if ($query = $this->db->get())
    {
      return $query->row_array();
    }
    else {
      return false;
    }
  }


}
?>
