<?php
class Struktur_organisasi extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->helper(array('form','url','file'));
    // $this->load->helper('url');
    // $this->load->library('session');
    $this->load->model('pegawai_model');
    $this->load->library(array('form_validation','session'));
  }

  public function index()
  {
    $data['jabatan_pegawai'] = $this->pegawai_model->get_jabatan_pegawai();
    $data['pegawai'] = $this->pegawai_model->get_pegawai();
    $this->load->view('struktur-organisasi' , $data);
  }

  public function tambah()
  {
    $this->form_validation->set_rules('tambah-nik-pegawai', 'nik pegawai', 'required');
    $this->form_validation->set_rules('tambah-nama-pegawai', 'nama pegawai', 'required');
    $this->form_validation->set_rules('tambah-jabatan-pegawai', 'jabatan pegawai', 'required');

    if ($this->form_validation->run() == FALSE) {
      $this->load->view('struktur-organisasi');
    }
    else{
      $config['upload_path'] = './uploads/foto_profil/pejabat_struktural';
      $config['allowed_types'] = 'jpg|jpeg|png';
      $config['max_size'] = '10048000'; //10 MB
      $config['overwrite'] = TRUE;
      $config['encrypt_name'] = TRUE;

      $this->load->library('upload', $config);

      if (!$this->upload->do_upload()) {
        //kalau upload gagal
        $errors = array('error' => $this->upload->display_errors());
      }
      else
      {
        //kalau upload berhasil
        $data = array('upload_data' => $this->upload->data());
        $foto_pegawai = $this->upload->data('file_name');
      }

      $this->pegawai_model->tambah($foto_pegawai);
      $this->session->set_flashdata('success','Foto telah terupload');
      redirect('struktur_organisasi','refresh');
    }
  }

  public function edit($id_pegawai)
  {

  }
}

?>
