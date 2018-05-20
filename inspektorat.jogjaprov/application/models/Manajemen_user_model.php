<?php
class Manajemen_user_model extends CI_model
{
  public function data($number, $offset)
  {
    return $query = $this->db->get('user', $number, $offset)->result();
  }

  // Count all record of table "contact_info" in database.
  public function jumlah_data()
  {
    return $this->db->get('user')->num_rows();
  }

  public function cariuser($katakunci, $number, $offset)
  {
    $this->db->select('*');
    $this->db->like('nama_user', $katakunci);
		$query = $this->db->get('user' , $number, $offset);
		return $query->result();
  }

  public function tambah($user){
    $this->db->insert('user',$user);
  }

  public function ktp_check($noktp){
    $this->db->select('*');
    $this->db->from('user');
    $this->db->where('no_ktp', $noktp);

    $query = $this->db->get();

    if($query->num_rows()>0)
    {
      return false;
    }
    else {
      return true;
    }
  }

  public function delete($id_user)
  {
    $this->db->where('id_user', $id_user);
    $this->db->delete('user');
  }

  public function verify($id_user){
    $sql = "UPDATE user SET verified = ? WHERE id_user = ?";
    $this->db->query($sql , array(1, $id_user));
  }

  public function unverify($id_user){
    $sql = "UPDATE user SET verified = ? WHERE id_user = ?";
    $this->db->query($sql , array(0, $id_user));
  }
}
?>
