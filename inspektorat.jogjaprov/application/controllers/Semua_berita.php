<?php
class Semua_berita extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->helper(array('url','form','file'));
    $this->load->model('semua_berita_model');
    $this->load->library(array('form_validation','session'));
  }

  public function index()
  {
    $data['berita_items'] = $this->semua_berita_model->get_berita();
    $this->load->view('semua_berita', $data);
  }

  function tulis()
  {
  	// $today = date("Y-m-d H:i:s");

    $this->form_validation->set_rules('isi-berita', 'ISI ARTIKEL', 'required');

    if ($this->form_validation->run() == FALSE) {
      $this->load->view('semua_berita');
      //print_r("GAGAL");
    }
    else {

      $config['upload_path'] = './uploads/berita/images';
      $config['allowed_types'] = 'jpg|jpeg|png';
      $config['max_size'] = '10048000'; //10 MB
      $config['overwrite'] = TRUE;
      $config['encrypt_name'] = TRUE;

      $this->load->library('upload', $config);

      if (!$this->upload->do_upload()) {
        $errors = array('error' => $this->upload->display_errors());

      }
      else {
        $data = array('upload_data' => $this->upload->data());
        //$image = $_FILES['userfile']['name'];
        $image = $this->upload->data('file_name');
      }

      $this->semua_berita_model->insert_image($image);
      $this->session->set_flashdata('success','Foto telah terupload');
      redirect('semua_berita');
      //print_r("berhasil");

    }
  }
}

?>
