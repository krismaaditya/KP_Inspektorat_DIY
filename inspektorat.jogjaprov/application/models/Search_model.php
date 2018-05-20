<?php
class Search_model extends CI_Model{

  public function cariberita($katakunci)
  {
    $this->db->select('b.*, kb.*');
    $this->db->where('b.kategori_berita = kb.id_kategori');
    $this->db->like('judul_berita', $katakunci);
		$query = $this->db->get('berita as b , kategori_berita as kb');
		return $query->result();
  }

  public function caripengaduan($katakunci)
  {
    $this->db->select('p.*, kp.*, u.nama_user');
    $this->db->where('p.kategori_pengaduan = kp.id_kategoripnd');
    $this->db->where('p.nama_pengadu = u.id_user');
    $this->db->like('judul_pengaduan', $katakunci);
		$query = $this->db->get('pengaduan AS p, kategoripnd AS kp, user AS u');
		return $query->result();
  }

  public function caridokumen($katakunci)
  {
    $this->db->select('*');
    $this->db->like('judul_dokumen', $katakunci);
		$query = $this->db->get('unduhan');
		return $query->result();
  }

  public function carigaleri($katakunci)
  {
    $this->db->select('fg.*, g.*');
    $this->db->where('fg.id_gal = g.id_galeri');
    $this->db->like('g.deskripsi', $katakunci);
		$query = $this->db->get('galeri as g , files_galeri as fg');
		return $query->result();
  }

  public function cariuser($katakunci)
  {
    $this->db->select('*');
    $this->db->like('nama_user', $katakunci);
		$query = $this->db->get('user');
		return $query->result();
  }
}
?>
