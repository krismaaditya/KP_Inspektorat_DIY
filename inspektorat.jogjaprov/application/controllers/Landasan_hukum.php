<?php
class Landasan_hukum extends CI_Controller
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
    $this->load->view('landasan-hukum');

  }
}

?>
