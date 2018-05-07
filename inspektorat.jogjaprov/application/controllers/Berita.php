<?php
class Berita extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->helper('url');
    $this->load->model('berita_model');
    $this->load->library('session');
  }

  public function index()
  {
    $this->load->view('berita');
  }

  public function baca($id_berita)
  {
    $data['item_berita'] = $this->berita_model->baca($id_berita);
    $this->load->view('berita', $data);
  }

  public function delete($id_berita)
  {
    $data = $this->berita_model->delete($id_berita);

    if ($data) {
      $this->session->set_flashdata('Berita berhasil didelete');
    }
    else {
      $this->session->set_flashdata('Berita tidak berhasil didelete');
    }
  }
}

?>
