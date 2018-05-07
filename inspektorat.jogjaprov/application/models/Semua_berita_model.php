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
		$this->db->select('*');
		$this->db->order_by('waktu_berita');
		$query = $this->db->get('berita');
		return $query->result();
	}
}
