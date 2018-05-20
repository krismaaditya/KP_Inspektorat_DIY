<?php
class Buku_tamu_model extends CI_model
{
  public function catat($data_tamu){
    $this->db->insert('buku_tamu',$data_tamu);
  }

  public function data($number, $offset)
  {
    $this->db->order_by('id_buku_tamu', 'desc');
    return $this->db->get('buku_tamu', $number, $offset)->result();
  }

  // Count all record of table "contact_info" in database.
  public function jumlah_data()
  {
    return $this->db->get('buku_tamu')->num_rows();
  }

  public function hapus($id_buku_tamu)
  {
    $this->db->where('id_buku_tamu', $id_buku_tamu);
    $this->db->delete('buku_tamu');
  }
}
?>
