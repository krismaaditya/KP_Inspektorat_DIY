<?php
class Pengaduan extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->helper('url');
    $this->load->model('pengaduan_model');
    $this->load->library('session');
    $this->load->library('encrypt');
  }

  public function index()
  {
    $this->load->view('form-pengaduan');
  }

  function tulispengaduan()
  {
  	$today = date("Y-m-d H:i:s");

    $id_pengadu = $this->session->userdata('id_user');
    $nama_pengadu = $this->session->userdata('nama_user');
    $email_pengadu = $this->session->userdata('email');
    $isi_pengaduan = $this->input->post('pengaduan-textarea');
    $judul_pengaduan = $this->input->post('judul-pengaduan');


  	$pengaduan = array(
  		'nama_pengadu' => $id_pengadu,
  		'judul_pengaduan' =>$judul_pengaduan,
  		'isi_pengaduan' =>$isi_pengaduan,
  		'kategori_pengaduan' =>$this->input->post('pilihan-kategori-pengaduan'),
  		'waktu_pengaduan' => $today );

    $this->pengaduan_model->tulispengaduan($pengaduan);

    if ($pengaduan) {
      // config email yang akan dikirim ke pengadu
      $config = Array(
        'protocol' => 'smtp',
        'smtp_host' => 'ssl://smtp.googlemail.com',
        'smtp_port' => 465,
        'smtp_user' => 'inspektorat.diy@gmail.com',
        'smtp_pass' => '2ykt4f0b'
      );

      $this->load->library('email', $config);
      $this->email->set_newline("\r\n");

      $this->email->from('inspektorat.diy@gmail.com','Inspektorat DIY');
      $this->email->to($email_pengadu);
      $this->email->cc('inspektorat.diy@gmail.com');
      $this->email->subject('Laporan telah kami terima');
      $this->email->message('Terima Kasih atas laporan Bapak/Ibu '.$nama_pengadu.' yang berisi sebagai berikut: " '.$isi_pengaduan.' ". Kami akan menindak lanjuti permasalahan ini secepatnya.');

        if ($this->email->send()) {
          echo "E-mail pemberitahuan telah terkirim ke email anda.";
          redirect('pengaduan','refresh');
        }
        else {
          show_error($this->email->print_debugger());
          echo "Laporan telah kami terima namun E-mail pemberitahuan gagal terkirim.";
          redirect('pengaduan','refresh');
        }
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
    $is_an_admin = $this->session->userdata('is_admin');

    if ($is_an_admin) {

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
    else {
    $this->load->view('unauthorized_access');
    }
  }

  public function hapus($id_kategoripnd)
  {
    $is_an_admin = $this->session->userdata('is_admin');

    if ($is_an_admin) {
    $this->pengaduan_model->delete($id_kategoripnd);
    redirect('pengaduan','refresh');
    }
    else {
    $this->load->view('unauthorized_access');
    }
  }

  }

?>
