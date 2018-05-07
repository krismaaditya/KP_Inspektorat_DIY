<?php
class Users_model extends CI_model
{
  public function daftar($user){
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

  public function login($email, $password)
  {
    $hashed_password_query_str = "SELECT password FROM user WHERE email = '$email'";
    $hashedpassword_query = $this->db->query($hashed_password_query_str);

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
}
?>
