<?php
class Pengaduan_model extends CI_model
{
	public function tulispengaduan($pengaduan) {
    $this->db->insert('pengaduan',$pengaduan);
  }

	public function tampilpengaduan($id_pengaduan) {
    $this->db->select('*');
    // $this->db->select('nama_kategori');
    $this->db->from('pengaduan');
    // $this->db->from('kategori');
    $this->db->where('id_pengaduan', $id_pengaduan);
    // $this->db->where('kategori.id_kategori', 'berita.kategori_berita');


    if ($query = $this->db->get()) {
      return $query->row_array();
    }
    else {
      return false;
  	}
  }

	public function tambahkategoripengaduan($kategoripnd) {
		$this->db->insert('kategoripnd',$kategoripnd);
	}


  public function delete($id_kategoripnd)
  {
    $this->db->where('id_kategoripnd', $id_kategoripnd);
    $this->db->delete('kategoripnd');
  }
}
?>
