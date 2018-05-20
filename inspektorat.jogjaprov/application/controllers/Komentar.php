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
  }

  public function tulis($id_berita)
  {
    $is_verified = $this->session->userdata('is_verified');

    if ($is_verified) {
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
    else {
      $this->load->view('unauthorized_access');
    }


  }

  public function hapus()
  {
    $is_an_admin = $this->session->userdata('is_admin');
    $id_berita = $this->session->flashdata('id_berita_dibaca');

    if ($is_an_admin) {
      $id_komentar = $this->uri->segment(3);
      $this->komentar_model->hapus($id_komentar);
      redirect("berita/baca/$id_berita",'refresh');
    }
    else {
      $this->load->view('unauthorized_access');
    }
  }
}

?>
