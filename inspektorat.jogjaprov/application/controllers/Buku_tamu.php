<?php
class Buku_tamu extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->helper(array('form','url','download'));
    $this->load->model('buku_tamu_model');
    $this->load->library('session');
    $this->load->library('pagination');
  }

  public function index()
  {
    $is_an_admin = $this->session->userdata('is_admin');

    if ($is_an_admin) {
      $jumlah_data_tamu = $this->buku_tamu_model->jumlah_data();
      $this->load->library('pagination');
      $config['base_url'] = base_url().'buku_tamu/index';
      $config['total_rows'] = $jumlah_data_tamu;
      $config['per_page'] = 20;
      $config['full_tag_open'] = '<ul class="page">';
      $config['full_tag_close'] = '</ul>';
      $config['cur_tag_open'] = '<li class="current">';
      $config['cur_tag_close'] = '</li>';
      $config['num_tag_open'] = '<li>';
      $config['num_tag_close'] = '</li>';
      $config['next_tag_open'] = '<li>';
      $config['next_tag_close'] = '</li>';
      $config['prev_tag_open'] = '<li>';
      $config['prev_tag_close'] = '</li>';
      $from = $this->uri->segment(3);
      $this->pagination->initialize($config);
      $data['buku_tamu'] = $this->buku_tamu_model->data($config['per_page'], $from);

      $this->load->view('buku-tamu', $data);
    }
    else {
    $this->load->view('unauthorized_access');
    }

  }

  public function catat()
  {
    $is_an_admin = $this->session->userdata('is_admin');

    if ($is_an_admin) {
    $this->load->library('upload');

    $config['upload_path'] = './uploads/lampiran_buku_tamu/';
    $config['allowed_types'] = 'pdf|doc|docx';
    $config['max_size'] = 1000000;

    $this->upload->initialize($config);

    if (!$this->upload->do_upload('dokumentasi')) {
      echo $this->upload->display_errors();
    }

    $file_name = $this->upload->file_name;

    $data_tamu = array(
      'asal_instansi' =>$this->input->post('asal-instansi'),
      'nama_pengunjung' =>$this->input->post('nama-lengkap'),
      'tanggal_kunjungan' =>$this->input->post('tanggal-kunjungan'),
      'keperluan_instansi' =>$this->input->post('keperluan'),
      // 'dokumentasi' =>$this->input->post('dokumentasi')

      'dokumentasi' => $file_name
    );

    //print_r($user);

    $this->buku_tamu_model->catat($data_tamu);

    if ($data_tamu) {
      redirect('buku_tamu');
      //print_r('Berhasil dicatat');
      $data = array('upload_data' => $this->upload->data());
    }
    else {
      redirect('buku_tamu');
      //print_r($this->upload->display_errors());

    }
  }
  else {
    $this->load->view('unauthorized_access');
  }

  }

  public function hapus()
  {
    $is_an_admin = $this->session->userdata('is_admin');

    if ($is_an_admin) {
      $id_buku_tamu = $this->uri->segment('3');

      $query = $this->db->query("SELECT * FROM buku_tamu WHERE id_buku_tamu = $id_buku_tamu");
      foreach ($query->result() as $row) {
        unlink('./uploads/lampiran_buku_tamu/'.$row->dokumentasi);
      }

      $this->buku_tamu_model->hapus($id_buku_tamu);

      redirect('buku_tamu','refresh');
    }
    else {
      $this->load->view('unauthorized_access');
    }
  }
}

?>
