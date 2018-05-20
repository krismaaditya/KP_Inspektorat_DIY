<?php

class Search extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->helper("url");
    $this->load->model('search_model');
  }

  public function index()
  {
    $katakunci = $this->input->GET('query', TRUE);

    $searchresult['berita'] = $this->search_model->cariberita($katakunci);
    $searchresult['pengaduan'] = $this->search_model->caripengaduan($katakunci);
    // $searchresult['dokumen'] = $this->search_model->caridokumen($katakunci);
    $searchresult['galeri'] = $this->search_model->carigaleri($katakunci);
    $searchresult['user'] = $this->search_model->cariuser($katakunci);

    $searchresult['katakuncilempar'] = $katakunci;

    $this->load->view('hasil-pencarian', $searchresult);
  }
}

?>
