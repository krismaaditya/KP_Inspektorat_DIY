<?php
class Galeri_model extends CI_model
{
  //INI DIPAKAI KALAU MAU PUNYA FOTO PROFIL LEBIH DARI 1
  public function upload($upload_data, $image)
  {
    //insert data pegawai
    $this->db->insert('galeri',$upload_data);

    //insert gambar-gambarnya
    //untuk mencegah sql injection pakai query binding
    $insert_id = $this->db->insert_id();
    $image_array = explode(',' , $image);

    if ($image != '') {
      $sql = "INSERT INTO files_galeri(nama_file, id_gal) VALUES (?, ?)";
      //$count = count($image_array);

      for ($i=0; $i < count($image_array) ; $i++) {
        $imagereadytoupload = $image_array[$i];
        $this->db->query($sql , array($imagereadytoupload, $insert_id));
      }
    }
  }

  public function update($id_galeri, $deskripsiedit)
  {
    $sql = "UPDATE galeri SET deskripsi = ? WHERE id_galeri = ?";
    $this->db->query($sql , array($deskripsiedit, $id_galeri));
  }

  public function get_files()
	{
    $this->db->select('g.* , fg.*');
    $this->db->where('g.id_galeri = fg.id_gal');
    $this->db->order_by('id_file', 'desc');
    $query = $this->db->get('galeri AS g, files_galeri AS fg');
		return $query->result();
	}

  public function hapus($id_file)
  {
    $sqldeletefile = "DELETE FROM files_galeri WHERE id_file = ?";

    $sqldeletegaleri = "DELETE FROM galeri WHERE NOT EXISTS(SELECT * FROM files_galeri fg WHERE fg.id_gal = galeri.id_galeri)";

    $this->db->query($sqldeletefile , $id_file);

    $this->db->query($sqldeletegaleri);
  }
}
