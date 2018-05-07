<?php
class Komentar extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->helper('url');
    $this->load->model('komentar_model');
    $this->load->library('session');
  }

  public function index()
  {
    $this->load->view('berita');
    //$this->fetchkomentar($this->session->userdata('id_berita'));

    // $this->fetchkomentar($this->session->userdata('id_berita'));
  }

  public function tulis($id_berita)
  {
    $today = date("Y-m-d H:i:s");

    $komentar = array(
      'id_user'=>$this->session->userdata('id_user'),
      'id_berita'=>$id_berita,
      'isi_komentar'=>$this->input->post('isi_komentar'),
      'waktu_komentar'=>$today
    );

    $this->komentar_model->tulis($komentar);
    if ($komentar)
    {
      redirect("berita/baca/$id_berita",'refresh');
    }
    else {
      $this->session->set_flashdata('error_msg','Error');
      print_r("ERROR , tidak ada komen diantara kita");
    }

  }

  public function fetchkomentar($id_berita)
  {
    $datakomentar = $this->komentar_model->fetchkomentar($id_berita);

    if ($datakomentar) {
      $this->session->set_userdata('id_komentar', $datakomentar['id_komentar']);
      $this->session->set_userdata('nama_user_komentar', $datakomentar['nama_user']);
      $this->session->set_userdata('waktu_komentar', $datakomentar['waktu_komentar']);
      $this->session->set_userdata('isi_komentar', $datakomentar['isi_komentar']);
      // $this->session->set_userdata('kategori_pengaduan', $data['kategori_pengaduan']);
      // $this->session->set_userdata('waktu_pengaduan', $data['waktu_pengaduan']);
      // $this->session->set_userdata('nama_user', $data['nama_user']);
    }
    else {
      $this->session->set_flashdata('error_msg','Komentar tidak ditemukan');
    }

    $this->load->view('berita');
  }
}

?>
