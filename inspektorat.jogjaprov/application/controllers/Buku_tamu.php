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
    $jumlah_data_tamu = $this->buku_tamu_model->jumlah_data();
    $this->load->library('pagination');
    $config['base_url'] = base_url().'buku_tamu/index';
    $config['total_rows'] = $jumlah_data_tamu;
    $config['per_page'] = 10;
    $from = $this->uri->segment(3);
    $this->pagination->initialize($config);
    $data['buku_tamu'] = $this->buku_tamu_model->data($config['per_page'], $from);

    $this->load->view('buku-tamu', $data);
  }

  public function catat()
  {
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

//   public function contact_info(){
// $config = array();
// $config["base_url"] = base_url() . "index.php/buku_tamu/contact_info";
// $total_row = $this->buku_tamu_model->record_count();
// $config["total_rows"] = $total_row;
// $config["per_page"] = 1;
// $config['use_page_numbers'] = TRUE;
// $config['num_links'] = $total_row;
// $config['cur_tag_open'] = '&nbsp;<a class="current">';
// $config['cur_tag_close'] = '</a>';
// $config['next_link'] = 'Next';
// $config['prev_link'] = 'Previous';
//
// $this->pagination->initialize($config);
//   if($this->uri->segment(3))
//   {
//     $page = ($this->uri->segment(3)) ;
//   }
//     else{
//     $page = 1;
//   }
//
// $data["results"] = $this->buku_tamu_model->fetch_data($config["per_page"], $page);
// $str_links = $this->pagination->create_links();
// $data["links"] = explode('&nbsp;',$str_links );
//
// // View data according to array.
// $this->load->view('buku-tamu', $data);
// }
}

?>
