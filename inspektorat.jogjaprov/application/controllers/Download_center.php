<?php
class Download_center extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->helper(array('form','url','download'));
    $this->load->model('m_download_center');
    $this->load->library('session');
  }

  public function index()
  {
    $this->load->view('downloadcenter');
  }

  public function unggahfile()
  {
    //struggle with this shit
    $this->load->library('upload');

    $config['upload_path'] = './uploads/download_center/';
    $config['allowed_types'] = 'pdf|doc|docx|mp4';
    $config['max_size'] = 100000000000;

    $this->upload->initialize($config);

    if (!$this->upload->do_upload('file-unduhan')) {
      echo $this->upload->display_errors();
    }

    $file_name = $this->upload->file_name;

    //ext
    $file_ext = $this->upload->file_ext;
    $file_size = $this->upload->file_size;

    $file_data = array(
      'judul_dokumen' =>$this->input->post('judul-dokumen'),
      'deskripsi_dokumen' =>$this->input->post('deskripsi-dokumen'),
      // 'tipe_dokumen' =>$this->input->post('tipe-dokumen'),
      // 'ukuran_dokumen' =>$this->input->post('ukuran-dokumen'),
      'tipe_dokumen' => $file_ext,
      'ukuran_dokumen' => $file_size,
      //struggle with this shit also
      // 'file_unduhan' =>$this->input->upload('file-unduhan')
      'file_unduhan' => $file_name
    );

    //print_r($user);

    $this->m_download_center->unggahfile($file_data);

    if ($file_data) {
      redirect('download_center');
      $data = array('upload_data' => $this->upload->data());
      print_r($data);
    }
    else {
      print_r('Unggah File GAGAL, silahkan coba lagi');
      print_r($this->upload->display_errors());
    }
  }


  public function tampildownload($id_unduhan)
  {
    $this->load->library('pagination');
    $config['base_url'] = 'downloadcenter/';
    $config['total_rows'] = 200;
    $config['per_page'] = 20;
    $this->pagination->initialize($config);

    echo $this->pagination->create_links();

    $data = $this->m_download_center->tampildownload($id_unduhan);

      if ($data) {
        $this->session->set_userdata('id_dokumen', $data['id_dokumen']);
        $this->session->set_userdata('judul_dokumen', $data['judul_dokumen']);
        $this->session->set_userdata('deskripsi_dokumen', $data['deskripsi_dokumen']);
        $this->session->set_userdata('tipe_dokumen', $data['tipe_dokumen']);
        $this->session->set_userdata('ukuran_dokumen', $data['ukuran_dokumen']);
        $this->session->set_userdata('file_unduhan', $data['file_unduhan']);
      }
      else {
        $this->session->set_flashdata('error_msg','Dokumen Kosong');
      }

      $this->load->view('downloadcenter');
    }

    public function do_download($file)
    {
      force_download('uploads/downloadcenter/'.$file, NULL);
    }
  }




?>
