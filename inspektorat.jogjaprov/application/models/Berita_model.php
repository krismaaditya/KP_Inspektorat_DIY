<?php
/**
 *
 */
class Berita_model extends CI_Model
{
  public function baca($id_berita)
  {
    $this->db->select('b.*, kb.nama_kategori, u.nama_user')
      ->from('berita AS b, kategori_berita AS kb, user AS u')
      ->where('kb.id_kategori = b.kategori_berita')
      ->where('b.penulis_berita = u.id_user')
      ->where('b.id_berita', $id_berita);

    $query = $this->db->get();
    return $query->result();
  }

  public function get_komentars($id_berita)
  {
    $this->db->select('k.*, u.*')
      ->from('komentar AS k, user AS u')
      ->where('k.id_user = u.id_user')
      ->where('k.id_berita', $id_berita)
      ->order_by('k.id_komentar');

    $query = $this->db->get();
    return $query->result();
  }

  public function get_jumlah_komentar($id_berita){
    //$btquery = $this->db->query("SELECT * FROM berita WHERE kategori_berita = 0 ORDER BY id_berita DESC LIMIT 0,3 ");
    $btquery = $this->db->query("SELECT COUNT(*) AS jumlah_komentar FROM komentar WHERE id_berita = $id_berita");
		return $btquery->result();
  }

  public function baca_juga(){
    //$btquery = $this->db->query("SELECT * FROM berita WHERE kategori_berita = 0 ORDER BY id_berita DESC LIMIT 0,3 ");
    $btquery = $this->db->query("SELECT b.*, kb.nama_kategori FROM berita b, kategori_berita  kb WHERE kb.id_kategori = b.kategori_berita ORDER BY id_berita DESC LIMIT 10 ");
		return $btquery->result();
  }

  public function hapus($id_berita)
  {
    $this->db->where('id_berita', $id_berita);
    $this->db->delete('berita');
  }
}

?>
