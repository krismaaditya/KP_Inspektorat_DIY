<?php
class Pengaduan extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->helper('url');
    $this->load->model('pengaduan_model');
    $this->load->library('session');
  }

  public function index()
  {
    $this->load->view('form-pengaduan');
  }

  function tulispengaduan()
  {
  	$today = date("Y-m-d H:i:s");

  	$pengaduan = array(
  		'nama_pengadu' =>$this->session->userdata('id_user'),
  		'judul_pengaduan' =>$this->input->post('judul-pengaduan'),
  		'isi_pengaduan' =>$this->input->post('pengaduan-textarea'),
  		'kategori_pengaduan' =>$this->input->post('pilihan-kategori-pengaduan'),
  		'waktu_pengaduan' => $today
  	);
  	// print_r($pengaduan);
  	// print_r($today);

  	$this->pengaduan_model->tulispengaduan($pengaduan);

  	if ($pengaduan) {
      redirect('pengaduan');
  		// print_r("BERHASIL");
      echo 1;
  	}
  	else
  	{
  		print_r("GAGAL");
      echo 0;
  	}
  }


  public function tampilpengaduan($id_list_pengaduan)
  {
    $this->load->library('pagination');
    $config['base_url'] = 'pengaduan/';
    $config['total_rows'] = 200;
    $config['per_page'] = 5;
    $this->pagination->initialize($config);
    echo $this->pagination->create_links();
    $data = $this->Pengaduan_model->tampilpengaduan($id_pengaduan);
    if ($data) {
      $this->session->set_userdata('id_pengaduan', $data['id_pengaduan']);
      $this->session->set_userdata('nama_pengadu', $data['nama_pengadu']);
      $this->session->set_userdata('judul_pengaduan', $data['judul_pengaduan']);
      $this->session->set_userdata('isi_pengaduan', $data['isi_pengaduan']);
      $this->session->set_userdata('kategori_pengaduan', $data['kategori_pengaduan']);
      $this->session->set_userdata('waktu_pengaduan', $data['waktu_pengaduan']);
    }
    else {
      $this->session->set_flashdata('error_msg','List Pengaduan Kosong');
    }
    $this->load->view('form-pengaduan');
  }


  public function tambahkategoripengaduan(){
    $kategoripnd = array (
    'nama_kategoripnd' =>$this->input->post('tambahnama_kategoripnd')
    );

    $this->pengaduan_model->tambahkategoripengaduan($kategoripnd);
    if ($kategoripnd) {
      redirect('pengaduan');
      // print_r("BERHASIL");
      echo 1;
    }
    else {
      print_r("GAGAL");
      echo 0;
    }
  }
  }

?>
