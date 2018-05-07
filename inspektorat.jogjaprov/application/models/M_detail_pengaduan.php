<?php
/**
 *
 */
class M_detail_pengaduan extends CI_Model
{

  public function selengkapnya($id_pengaduan)
  {
    // $this->db->select('*');
    // // $this->db->select('nama_kategori');
    // $this->db->from('pengaduan','user');
    // // $this->db->from('kategori');
    // $this->db->where('id_pengaduan', $id_pengaduan);
    // $this->db->where('kategori.id_kategori', 'berita.kategori_berita');

    $this->db->select('p.*, u.nama_user')
          ->from('pengaduan AS p, user AS u')
          ->where('p.nama_pengadu = u.id_user')
          ->where('p.id_pengaduan', $id_pengaduan);


    if ($query = $this->db->get())
    {
      return $query->row_array();
    }
    else {
      return false;
    }
  }

  public function tindaklanjut($tindaklanjut) {
    $this->db->insert('tindak_lanjut',$tindaklanjut);

  }

  public function gantistatus($status, $id_p)
  {
    $this->db->where('id_pengaduan', $id_p);
    $this->db->update('pengaduan',$status);

  }

}

?>
