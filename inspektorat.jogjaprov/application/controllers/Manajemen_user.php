<?php
class Manajemen_user extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->helper(array('form','url','download'));
    $this->load->model('manajemen_user_model');
    $this->load->library('session');
    $this->load->library('pagination');
  }

  public function index()
  {
    $is_an_admin = $this->session->userdata('is_admin');

    if ($is_an_admin) {
      $jumlah_data_user = $this->manajemen_user_model->jumlah_data();
      $this->load->library('pagination');
      $config['base_url'] = base_url().'manajemen_user/index';
      $config['total_rows'] = $jumlah_data_user;
      $config['per_page'] = 20;
      $config['full_tag_open'] = '<ul class="page">';
      $config['full_tag_close'] = '</ul>';
      $config['cur_tag_open'] = '<li class="current">';
      $config['cur_tag_close'] = '</li>';
      $config['num_tag_open'] = '<li>';
      $config['num_tag_close'] = '</li>';
      $config['next_tag_open'] = '<li>';
      $config['next_tag_close'] = '</li>';
      $config['prev_tag_open'] = '<li>';
      $config['prev_tag_close'] = '</li>';
      $from = $this->uri->segment(3);
      $this->pagination->initialize($config);
      $datau['user'] = $this->manajemen_user_model->data($config['per_page'], $from);

      $this->load->view('manajemen-user', $datau);
    }
    else {
      $this->load->view('unauthorized_access');
    }
  }

  public function cari()
  {
    $is_an_admin = $this->session->userdata('is_admin');

    if ($is_an_admin) {
    $katakunci = $this->input->GET('query', TRUE);

    $jumlah_data_user = $this->manajemen_user_model->jumlah_data();
    $this->load->library('pagination');
    $config['base_url'] = base_url().'manajemen_user/index';
    $config['total_rows'] = $jumlah_data_user;
    $config['per_page'] = 20;
    $config['full_tag_open'] = '<ul class="page">';
    $config['full_tag_close'] = '</ul>';
    $config['cur_tag_open'] = '<li class="current">';
    $config['cur_tag_close'] = '</li>';
    $config['num_tag_open'] = '<li>';
    $config['num_tag_close'] = '</li>';
    $config['next_tag_open'] = '<li>';
    $config['next_tag_close'] = '</li>';
    $config['prev_tag_open'] = '<li>';
    $config['prev_tag_close'] = '</li>';
    $from = $this->uri->segment(3);
    $this->pagination->initialize($config);
    $datau['user'] = $this->manajemen_user_model->cariuser($katakunci, $config['per_page'], $from);
    $datau['katakuncilempar'] = $katakunci;
    $this->load->view('manajemen-user', $datau);
  }
  else {
    $this->load->view('unauthorized_access');
  }
  }

  public function hapus($id_user)
  {
    $is_an_admin = $this->session->userdata('is_admin');

    if ($is_an_admin) {
      $query = $this->db->query("SELECT * FROM user WHERE id_user = $id_user");
      foreach ($query->result() as $row) {
        unlink('./uploads/foto_profil/users/'.$row->foto_profil_user);
        unlink('./uploads/foto_ktp/users/'.$row->foto_ktp_user);
      }

      $this->manajemen_user_model->delete($id_user);

      redirect('manajemen_user','refresh');
    }
    else {
    $this->load->view('unauthorized_access');
    }
  }

  public function tambah()
  {
    $is_an_admin = $this->session->userdata('is_admin');

    if ($is_an_admin) {
      $password = $this->input->post('password');
      $hashed_password = password_hash($password, PASSWORD_DEFAULT);

      $user = array(
        'no_ktp' =>$this->input->post('no_ktp'),
        'nama_user' =>$this->input->post('nama_user'),
        'alamat' =>$this->input->post('alamat'),
        'no_hp' =>$this->input->post('no_hp'),
        'email' =>$this->input->post('email'),
        // 'password' =>$this->input->post('password')
        'password' =>$hashed_password,
        'status' =>'1'
      );

    $ktp_check = $this->manajemen_user_model->ktp_check($user['no_ktp']);
    if ($ktp_check)
    {
      $this->manajemen_user_model->tambah($user);
      $this->session->set_flashdata('success_msg','PENDAFTARAN BERHASIL');
    }
    else {
      $this->session->set_flashdata('error_msg','GAGAL');
    }
    redirect('manajemen_user','refresh');
  }
  else {
    $this->load->view('unauthorized_access');
  }
  }

  public function verify($id_user){
    $is_an_admin = $this->session->userdata('is_admin');

    if ($is_an_admin)
    {
      $this->manajemen_user_model->verify($id_user);
      redirect('manajemen_user','refresh');
    }
    else {
    $this->load->view('unauthorized_access');
    }
  }

  public function unverify($id_user){
    $is_an_admin = $this->session->userdata('is_admin');

    if ($is_an_admin)
    {
      $this->manajemen_user_model->unverify($id_user);
      redirect('manajemen_user','refresh');
    }
    else {
      $this->load->view('unauthorized_access');
    }
  }
}

?>
