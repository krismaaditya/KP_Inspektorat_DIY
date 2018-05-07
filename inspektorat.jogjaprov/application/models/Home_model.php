<?php

class Home_model extends CI_model
{
  public function berita_lainnya(){

    $blquery = $this->db->query("SELECT * FROM berita LIMIT 3,4");

    // foreach ($query->result() as $row)
    // {
    //   $data = array(
    //     'id_berita' => $row->id_berita,
    //     'judul_berita' => $row->judul_berita,
    //     'waktu_berita' => $row->waktu_berita,
    //     'gambar_berita'=> $row->gambar_berita,
    //     'kategori_berita' => $row->kategori_berita
    //   );
    //   return $data;
    // }
    return $blquery->result();
  }

  public function berita_terbaru(){
    $this->db->select('*');
		$this->db->order_by('id_berita');
		$btquery = $this->db->get('berita');
		return $btquery->result();
  }
}
?>
