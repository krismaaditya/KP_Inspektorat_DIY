<?php
class User extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->helper('url');
    $this->load->model('users_model');
    $this->load->library('session');
    $this->load->library('form_validation');
  }

  public function index()
  {
    $this->load->view('home');
  }

  public function daftar()
  {
    $password = $this->input->post('password');

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $user = array(
      'no_ktp' =>$this->input->post('no_ktp'),
      'nama_user' =>$this->input->post('nama_user'),
      'alamat' =>$this->input->post('alamat'),
      'no_hp' =>$this->input->post('no_hp'),
      'email' =>$this->input->post('email'),
      // 'password' =>$this->input->post('password')
      'password' =>$hashed_password

    );

    // print_r($user);

    $ktp_check = $this->users_model->ktp_check($user['no_ktp']);

    if ($ktp_check) {
      $this->users_model->daftar($user);
      $this->session->set_flashdata('success_msg','PENDAFTARAN BERHASIL');

      //setelah pendaftaran berhasil, redirect ke login
      $redirectlogin = $this->users_model->login($user['email'], $password );
      if ($redirectlogin) {
        $this->session->set_userdata('id_user', $redirectlogin['id_user']);
        $this->session->set_userdata('no_ktp', $redirectlogin['no_ktp']);
        $this->session->set_userdata('nama_user', $redirectlogin['nama_user']);
        $this->session->set_userdata('alamat', $redirectlogin['alamat']);
        $this->session->set_userdata('no_hp', $redirectlogin['no_hp']);
        $this->session->set_userdata('email', $redirectlogin['email']);
        print_r("Pendaftaran berhasil, mengarahkan anda, silahkan tunggu...");
        redirect('welcome','refresh');
      }
      else {
        print_r("ERROR , Can't login");
      }
    }
    else {
      $this->session->set_flashdata('error_msg','GAGAL');
    }

  }

  public function login()
  {
    $login_data_array = array(
      'email'=>$this->input->post('email'),
      'password'=>$this->input->post('password')
    );

    // print_r($login_data_array);

    $data = $this->users_model->login($login_data_array['email'], $login_data_array['password']);
    if ($data)
    {
      $this->session->set_userdata('id_user', $data['id_user']);
      $this->session->set_userdata('no_ktp', $data['no_ktp']);
      $this->session->set_userdata('nama_user', $data['nama_user']);
      $this->session->set_userdata('alamat', $data['alamat']);
      $this->session->set_userdata('no_hp', $data['no_hp']);
      $this->session->set_userdata('email', $data['email']);
      // $this->session->set_userdata('user_profilepicture', $data['user_profilepicture']);
      // redirect('welcome','refresh');
      echo 1;
    }
    else {
      $this->session->set_flashdata('error_msg','Username atau password salah!');
      // print_r("ERROR , Can't login");
      //redirect('welcome');
      echo 0;
    }
  }

  public function profile()
  {
    $this->load->view('user-profil');
  }

  public function logout()
  {
    $this->session->sess_destroy();
    redirect('welcome','refresh');
  }
}

?>
