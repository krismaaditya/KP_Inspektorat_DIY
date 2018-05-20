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
        $this->session->set_userdata('logged_in', TRUE);

        $this->session->set_userdata('plainpass', $password);
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

    //validation(tambahan)
      $this->form_validation->set_rules("email", "Email", "trim|required");
      $this->form_validation->set_rules("password", "Password", "trim|required");


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
      $this->session->set_userdata('logged_in', TRUE);

      $this->session->set_userdata('plainpass', $login_data_array['password']);

      if ($data['verified'] == 1) {
        $this->session->set_userdata('is_verified', TRUE);
      }
      else {
        $this->session->set_userdata('is_verified', FALSE);
      }

      if ($data['status'] == 1) {
        $this->session->set_userdata('is_admin', TRUE);
      }
      else {
        $this->session->set_userdata('is_admin', FALSE);
      }
      //ECHO 1 untuk response AJAX
      // echo 1;
      echo "yes";
    }
    else {
      $this->session->set_flashdata('error_msg','Username atau password salah!');
      $this->session->set_userdata('logged_in', FALSE);
      // echo 0;
      echo "no";
    }
  }

  public function profile($id_user = NULL)
  {
    if ($id_user == NULL) {
      $this->load->view("404-not-found");
    }
    else {
      $useryanglagidilihat = $this->uri->segment(3);

      if ($this->session->userdata('id_user') == $useryanglagidilihat)
      {
        //kalau user sedang melihat halaman profilnya sendiri
        $this->session->set_userdata('is_current_user_look', TRUE);
      }
      else{
        $this->session->set_userdata('is_current_user_look', FALSE);
      }

      $data['userprofil'] = $this->users_model->get_data_for_profil($id_user);

      if ($data['userprofil'] == NULL) {
        $this->load->view("404-not-found");
      }
      else {
        $this->load->view('user-profil', $data);
      }

    }
  }

  public function submiteditprofile($id_user)
  {
    //aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa
    $is_this_user_look_at_his_own_profile = $this->session->userdata('is_current_user_look');
    if ($is_this_user_look_at_his_own_profile) {
      $this->form_validation->set_rules('edit-nama-lengkap', 'edit nama lengkap', 'trim|required');
      $this->form_validation->set_rules('edit-noktp', 'edit no ktp', 'trim|required');
      $this->form_validation->set_rules('edit-alamat', 'edit alamat', 'required');
      $this->form_validation->set_rules('edit-telepon', 'edit telepon', 'trim|required');
      $this->form_validation->set_rules('edit-email', 'edit email', 'trim|required');
      $this->form_validation->set_rules('edit-password', 'edit password', 'required');

      if($this->form_validation->run() == TRUE)
      {
        $nama_user = $this->input->post('edit-nama-lengkap');
        $editpassword = $this->input->post('edit-password');

        $hashed_editpassword = password_hash($editpassword, PASSWORD_DEFAULT);

        $data_edit_profil = array(
            'no_ktp' => $this->input->post('edit-noktp'),
            'nama_user' => $nama_user,
            'alamat' => $this->input->post('edit-alamat'),
            'no_hp' => $this->input->post('edit-telepon'),
            'email' => $this->input->post('edit-email'),
            'password' => $hashed_editpassword
        );

        $this->users_model->update($id_user, $data_edit_profil);
        $this->session->set_flashdata('success','Data profil anda berhasil diperbarui');
        $this->session->set_userdata('plainpass', $editpassword);
        $this->session->set_userdata('nama_user', $nama_user);
        redirect('user/profile/'.$id_user ,'refresh');
      }
      else
      {
        $this->session->set_flashdata('success','Data profil anda gagal diperbarui');
        redirect('user/profile/'.$id_user ,'refresh');
      }
    }
    else {
      $this->load->view("404-not-found");
    }

    }

    public function submiteditfotoprofil($id_user)
    {
      //aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa
      $is_this_user_look_at_his_own_profile = $this->session->userdata('is_current_user_look');
      if ($is_this_user_look_at_his_own_profile) {
        $config['upload_path'] = './uploads/foto_profil/users';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size'] = '10048000'; //10 MB
        $config['overwrite'] = TRUE;
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if (!$this->upload->do_upload()) {
          //kalau upload gagal
          $errors = array('error' => $this->upload->display_errors());
        }

        $data = array('upload_data' => $this->upload->data());

        $query = $this->db->query("SELECT * FROM user WHERE id_user = $id_user");
        foreach ($query->result() as $row) {
          unlink('./uploads/foto_profil/users/'.$row->foto_profil_user);
        }

        // $foto_ktp_user = $data['upload_data']['file_name'];
        $foto_profil_user = array(
            'foto_profil_user' => $data['upload_data']['file_name']
        );

        $this->users_model->updatefotoprofil($id_user, $foto_profil_user);
        $this->session->set_flashdata('success','Foto profil anda berhasil diedit');
        redirect('user/profile/'.$id_user ,'refresh');
      }
      else {
        $this->load->view("404-not-found");
      }
    }



    public function submiteditfotoktp($id_user)
    {
      //aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa
      $is_this_user_look_at_his_own_profile = $this->session->userdata('is_current_user_look');
      if ($is_this_user_look_at_his_own_profile) {
        $config['upload_path'] = './uploads/foto_ktp/users';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size'] = '10048000'; //10 MB
        $config['overwrite'] = TRUE;
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if (!$this->upload->do_upload()) {
          //kalau upload gagal
          $errors = array('error' => $this->upload->display_errors());
        }

        $data = array('upload_data' => $this->upload->data());

        $query = $this->db->query("SELECT * FROM user WHERE id_user = $id_user");
        foreach ($query->result() as $row) {
          unlink('./uploads/foto_ktp/users/'.$row->foto_ktp_user);
        }

        // $foto_ktp_user = $data['upload_data']['file_name'];
        $foto_ktp_user = array(
            'foto_ktp_user' => $data['upload_data']['file_name']
        );

        $this->users_model->updatefotoktp($id_user, $foto_ktp_user);
        $this->session->set_flashdata('success','Foto ktp berhasil diedit');
        redirect('user/profile/'.$id_user ,'refresh');
      }
      else {
        $this->load->view("404-not-found");
      }
    }

  public function logout()
  {
    $this->session->sess_destroy();
    redirect('welcome','refresh');
  }
}

?>
