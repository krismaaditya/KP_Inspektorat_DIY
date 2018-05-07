<?php
class Buku_tamu_model extends CI_model
{
  public function catat($data_tamu){
    $this->db->insert('buku_tamu',$data_tamu);
  }

  public function data($number, $offset)
  {
    return $query = $this->db->get('buku_tamu', $number, $offset)->result();
  }

  // Count all record of table "contact_info" in database.
  public function jumlah_data()
  {
    return $this->db->get('buku_tamu')->num_rows();
  }



// Fetch data according to per_page limit.
// public function fetch_data($limit, $id) {
// $this->db->limit($limit);
// $this->db->where('id_buku_tamu', $id);
// $query = $this->db->get("buku_tamu");
// if ($query->num_rows() > 0) {
// foreach ($query->result() as $row) {
// $data[] = $row;
// }
//
// return $data;
// }
// return false;
// }
}
?>
