<?php
class Users_model extends CI_model
{
  public function daftar($user){
    $this->db->insert('user',$user);
  }

  public function jumlah_data()
  {
    return $this->db->get('users')->num_rows();
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

  public function login($email, $password)
  {
    $hashed_password_query_str = "SELECT password FROM user WHERE email = ?";
    $hashedpassword_query = $this->db->query($hashed_password_query_str, $email);

    $record=$hashedpassword_query->row();

    $hashedPasswordResult = $record->password;

    if (password_verify($password , $hashedPasswordResult)) {
      // echo 'Password benar';
      // echo "password plain : $password";
      // echo "password hash : $hashedPasswordResult";
      $this->db->select('*');
      $this->db->from('user');
      $this->db->where('email', $email);
      $this->db->where('password', $hashedPasswordResult);

      if ($query = $this->db->get())
      {
        return $query->row_array();
      }
      else {
        return false;
      }
    }
    else {
      // echo "Password salah";
      // $this->session->set_flashdata('error_msg','Password salah');
    }
  }

  public function update($id_user, $data_edit_profile)
  {
    $this->db->where('id_user', $id_user);
    $this->db->update('user', $data_edit_profile);
  }

  public function updatefotoprofil($id_user, $foto_profil_user)
  {
    $this->db->where('id_user', $id_user);
    $this->db->update('user', $foto_profil_user);
  }

  public function updatefotoktp($id_user, $foto_ktp_user)
  {
    $this->db->where('id_user', $id_user);
    $this->db->update('user', $foto_ktp_user);
  }

  public function get_data_for_profil($id_user)
  {
    $sql = "SELECT * FROM user WHERE id_user = ?";
    $query = $this->db->query($sql , $id_user);
    return $query->result();
  }
}
?>
