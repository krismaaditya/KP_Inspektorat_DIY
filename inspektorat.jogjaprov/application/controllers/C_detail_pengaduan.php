<?php
class C_detail_pengaduan extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->helper('url');
    $this->load->model('m_detail_pengaduan');
    $this->load->library('session');
  }

  public function index()
  {
    $this->load->view('detail-pengaduan');
  }

  public function selengkapnya($id_pengaduan)
  {
    $data = $this->m_detail_pengaduan->selengkapnya($id_pengaduan);

    if ($data) {
      $this->session->set_userdata('id_pengaduan', $data['id_pengaduan']);
      $this->session->set_userdata('nama_pengadu', $data['nama_pengadu']);
      $this->session->set_userdata('judul_pengaduan', $data['judul_pengaduan']);
      $this->session->set_userdata('isi_pengaduan', $data['isi_pengaduan']);
      $this->session->set_userdata('kategori_pengaduan', $data['kategori_pengaduan']);
      $this->session->set_userdata('waktu_pengaduan', $data['waktu_pengaduan']);
      // $this->session->set_userdata('nama_user', $data['nama_user']);
    }
    else {
      $this->session->set_flashdata('error_msg','Pengaduan tidak ditemukan');
    }

    $this->load->view('detail-pengaduan');
  }

  // public function delete($id_berita)
  // {
  //   $data = $this->berita_model->delete($id_berita);
  //
  //   if ($data) {
  //     $this->session->set_flashdata('Berita berhasil didelete');
  //   }
  //   else {
  //     $this->session->set_flashdata('Berita tidak berhasil didelete');
  //   }
  // }

  public function tindaklanjut(){
    $is_an_admin = $this->session->userdata('is_admin');

    if ($is_an_admin) {
      $tindaklanjut = array (
      'isi_tindaklanjut' =>$this->input->post('tindakLanjut-textarea'),
      'id_pengaduantnt' =>$this->session->userdata('id_pengaduan')
      );
      $status = array(
        'id_statuspengaduan' => '1'
      );
      $this->m_detail_pengaduan->tindaklanjut($tindaklanjut);

      $id_p = $this->session->userdata('id_pengaduan');
      $this->m_detail_pengaduan->gantistatus($status, $id_p);

      if ($tindaklanjut) {
        //hh
        redirect('pengaduan');
        // print_r("BERHASIL");
        echo 1;
      }
      else {
        print_r("GAGAL");
        echo 0;
      }
    }
    else {
    $this->load->view('unauthorized_access');
    }
  }

  public function hapus($id_pengaduan)
  {
    $is_an_admin = $this->session->userdata('is_admin');

    if ($is_an_admin) {
    $this->m_detail_pengaduan->delete($id_pengaduan);
    redirect('pengaduan','refresh');
    }
    else {
    $this->load->view('unauthorized_access');
    }
  }
}

?>
