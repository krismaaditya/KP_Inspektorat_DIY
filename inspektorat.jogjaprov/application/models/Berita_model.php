<?php
/**
 *
 */
class Berita_model extends CI_Model
{

  public function baca($id_berita)
  {
    $this->db->select('b.*, u.nama_user')
      ->from('berita AS b, user AS u')
      ->where('b.penulis_berita = u.id_user')
      ->where('b.id_berita', $id_berita);

    $query = $this->db->get();
    return $query->result();
  }

  public function delete($id_berita)
  {
    $this->db->delete('berita', array('id_berita' => $id_berita));
    $this->db->where('id_berita', $id_berita);
  }

  public function update($id_berita)
  {
    $this->db->update('*');
  }
}

?>
