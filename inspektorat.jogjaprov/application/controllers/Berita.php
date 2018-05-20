<?php
class Berita extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->helper('url');
    $this->load->model('berita_model');
    $this->load->library(array('session', 'image_lib'));
  }

  public function index()
  {
    $this->load->view('berita');
  }

  public function baca($id_berita)
  {
    $data['item_berita'] = $this->berita_model->baca($id_berita);
    $data['item_komentar'] = $this->berita_model->get_komentars($id_berita);
    $data['item_baca_juga'] = $this->berita_model->baca_juga();
    $data['jumlah_komentar'] = $this->berita_model->get_jumlah_komentar($id_berita);
    $this->load->view('berita', $data);
    $this->session->set_flashdata('id_berita_dibaca', $id_berita);
  }

  public function hapus()
  {
    $is_an_admin = $this->session->userdata('is_admin');

    if ($is_an_admin) {
      $id_berita = $this->uri->segment(3);
      $query = $this->db->query("SELECT * FROM berita WHERE id_berita = $id_berita");
      foreach ($query->result() as $row) {
        unlink('./uploads/berita/images/'.$row->gambar_berita);
        unlink('./uploads/berita/thumbnails/'.$row->gambar_berita);
      }

      $this->berita_model->hapus($id_berita);
      redirect('semua_berita','refresh');
    }
    else {
      $this->load->view('unauthorized_access');
    }
  }
}

?>
