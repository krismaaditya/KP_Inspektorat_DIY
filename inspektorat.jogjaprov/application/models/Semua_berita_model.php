<?php
class Semua_berita_model extends CI_model
{
	public function insert_image($image){

		$today = date("Y-m-d H:i:s");

		$data_berita = array(
  		'judul_berita' =>$this->input->post('judul-berita'),
  		'isi_berita' =>$this->input->post('isi-berita'),
  		'waktu_berita' => $today,
      'gambar_berita' => $image,
  		'kategori_berita' =>$this->input->post('berita-category'),
			'penulis_berita' =>$this->session->userdata('id_user')
  	);

    $this->db->insert('berita',$data_berita);
  }

	public function get_berita()
	{
		$btquery = $this->db->query("SELECT b.*, kb.nama_kategori FROM berita b, kategori_berita  kb WHERE kb.id_kategori = b.kategori_berita ORDER BY id_berita DESC");
		return $btquery->result();
	}

	public function get_kategori_berita()
	{
		$this->db->select('*');
		$query = $this->db->get('kategori_berita');
		return $query->result();
	}
}
