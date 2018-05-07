<?php
class Tulis_artikel extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
    $this->load->helper('url');
    $this->load->view('tulis-artikel');
  }
}

?>
