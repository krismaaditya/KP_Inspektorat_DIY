<?php
class Semua_berita extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->helper(array('url','form','file'));
    $this->load->model('semua_berita_model');
    $this->load->library(array('form_validation','session', 'image_lib'));
  }

  public function index()
  {
    $data['berita_items'] = $this->semua_berita_model->get_berita();
    $data['kategori_berita'] = $this->semua_berita_model->get_kategori_berita();
    $this->load->view('semua_berita', $data);
  }

  function tulis()
  {
  	// $today = date("Y-m-d H:i:s");
    $is_an_admin = $this->session->userdata('is_admin');

    if ($is_an_admin) {
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

          //buat thumbnailnya
          $thumbnail_config = array(
            'source_image' => $data['upload_data']['full_path'],
            'new_image' => './uploads/berita/thumbnails',
            'maintain_ratio' => true,
            'width' => 168,
            'height' => 94
          );

          $this->image_lib->initialize($thumbnail_config);
          $this->image_lib->resize();
        }

        $this->semua_berita_model->insert_image($image);
        $this->session->set_flashdata('success','Foto telah terupload');
        redirect('semua_berita');
      }
    }
    else {
    $this->load->view('unauthorized_access');
    }
  }
}

?>
