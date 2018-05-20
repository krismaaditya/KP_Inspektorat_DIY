<?php

class Home_model extends CI_model
{
  public function berita_terbaru(){
    $btquery = $this->db->query("SELECT * FROM berita WHERE kategori_berita = 0 ORDER BY id_berita DESC LIMIT 0,3 ");
		return $btquery->result();
  }

  public function berita_lainnya(){
    $blquery = $this->db->query("SELECT * FROM berita WHERE kategori_berita = 0 ORDER BY id_berita DESC LIMIT 3,4");
    return $blquery->result();
  }

  public function kegiatan()
  {
    $blquery = $this->db->query("SELECT * FROM berita WHERE kategori_berita = 1 ORDER BY id_berita DESC LIMIT 6");
    return $blquery->result();
  }


}
?>
