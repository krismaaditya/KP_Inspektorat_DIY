<?php
class M_download_center extends CI_model
{
  public function unggahfile($file_data){
    $this->db->insert('unduhan',$file_data);
  }

  public function tampildownload($id_unduhan)
  {
    $this->db->select('*');
    // $this->db->select('nama_kategori');
    $this->db->from('unduhan');
    // $this->db->from('kategori');
    $this->db->where('id_unduhan', $id_unduhan);
    // $this->db->where('kategori.id_kategori', 'berita.kategori_berita');

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
