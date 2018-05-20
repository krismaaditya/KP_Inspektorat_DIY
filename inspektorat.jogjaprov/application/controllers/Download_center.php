<?php
class Download_center extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->helper(array('form','url','download'));
    $this->load->model('m_download_center');
    $this->load->library(array('form_validation','session','pagination'));
  }

  public function index()
  {
    $this->load->library('pagination');
    $jumlah_data_doc = $this->m_download_center->jumlah_data();
    $config = array();
    $config['base_url'] = base_url().'download_center/index';
    $config['total_rows'] = $jumlah_data_doc;
    $config['per_page'] = 10;
    $start = $this->uri->segment(3);

    $config['full_tag_open'] = '<ul class = "dc-pagination-ul">';
    $config['full_tag_close'] = '</ul>';
    $config['cur_tag_open'] = '<li class="current">';
    $config['cur_tag_close'] = '</li>';
    $config['num_tag_open'] = '<li>';
    $config['num_tag_close'] = '</li>';
    $config['next_tag_open'] = '<li>';
    $config['next_tag_close'] = '</li>';
    $config['prev_tag_open'] = '<li>';
    $config['prev_tag_close'] = '</li>';

    $this->pagination->initialize($config);
    $data['dokumen'] = $this->m_download_center->get_files($config['per_page'], $start);
    $data['kategori'] = $this->m_download_center->get_kategori_files();
    $data['kategoriforedit'] = $this->m_download_center->get_kategori_files_for_editing();
    $this->load->view('downloadcenter', $data);
  }

  public function unggahfile()
  {
    $is_an_admin = $this->session->userdata('is_admin');

    if ($is_an_admin) {
    $this->load->library('upload');

    $config['upload_path'] = './uploads/download_center/';
    $config['allowed_types'] = 'pdf|doc|docx|xlsx|ppt|pptx|odf|odt|txt|rtf|xps';
    $config['max_size'] = 100000000000;
    $config['overwrite'] = TRUE;
    $config['remove_spaces'] = TRUE;
    // $config['encrypt_name'] = TRUE;

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
      'id_kategori_doc' => $this->input->post('kategori-doc-option'),
      'url' => $this->input->post('url'),
      'tipe_dokumen' => $file_ext,
      'ukuran_dokumen' => $file_size,
      'file_unduhan' => $file_name
    );

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
    else
    {
      $this->load->view('unauthorized_access');
    }
  }

    public function edit($id_dokumen)
    {
      $is_an_admin = $this->session->userdata('is_admin');

      if ($is_an_admin) {

      $this->form_validation->set_rules('edit-judul-dokumen', 'judul dokumen', 'trim|required');
      $this->form_validation->set_rules('edit-deskripsi-dokumen', 'deskripsi dokumen', 'trim|required');

      $config['upload_path'] = './uploads/download_center/';
      $config['allowed_types'] = 'pdf|doc|docx|mp4';
      $config['max_size'] = '10048000'; //10 MB
      $config['overwrite'] = TRUE;
      $config['remove_spaces'] = TRUE;
      // $config['encrypt_name'] = TRUE;
      $this->load->library('upload', $config);
      $this->upload->initialize($config);

      //jika dokumen diedit
      if($this->form_validation->run() == TRUE && !empty($_FILES['userfile']['name'][0]))
      {
        //$this->upload->do_upload();
        if (!$this->upload->do_upload()) {
          //kalau upload gagal
          $errors = array('error' => $this->upload->display_errors());
        }

        $data = array('upload_data' => $this->upload->data());
        //$foto_edit_pegawai = $this->upload->data('file_name');

        $query = $this->db->query("SELECT * FROM unduhan WHERE id_dokumen = $id_dokumen");
        foreach ($query->result() as $row) {
          unlink('./uploads/download_center/'.$row->file_unduhan);
        }

        $data_edit_dokumen = array(
        		'judul_dokumen' =>$this->input->post('edit-judul-dokumen'),
        		'deskripsi_dokumen' =>$this->input->post('edit-deskripsi-dokumen'),
            'tipe_dokumen' => $data['upload_data']['file_ext'],
            'ukuran_dokumen' => $data['upload_data']['file_size'],
            'file_unduhan' => $data['upload_data']['file_name']
        );

        $this->m_download_center->update($id_dokumen, $data_edit_dokumen);
        $this->session->set_flashdata('success','Data dan foto berhasil diedit');
        redirect('download_center','refresh');
      }
      else if ($this->form_validation->run() == TRUE && empty($_FILES['userfile']['name'][0]))
      {
        $data_edit_dokumen = array(
        		'judul_dokumen' =>$this->input->post('edit-judul-dokumen'),
        		'deskripsi_dokumen' =>$this->input->post('edit-deskripsi-dokumen')
        );

        $this->m_download_center->update($id_dokumen, $data_edit_dokumen);
        $this->session->set_flashdata('success','Data dan foto berhasil diedit');
        redirect('download_center','refresh');
      }
    }
    else {
      $this->load->view('unauthorized_access');
    }
  }

    public function hapus($id_dokumen)
    {
      $is_an_admin = $this->session->userdata('is_admin');

      if ($is_an_admin) {
      $query= $this->db->query("SELECT * FROM unduhan WHERE id_dokumen = $id_dokumen");
      foreach ($query->result() as $row) {
        unlink('./uploads/download_center/'.$row->file_unduhan);
      }
      $this->m_download_center->delete($id_dokumen);
      redirect('download_center','refresh');
      }
      else {
        $this->load->view('unauthorized_access');
      }
    }

    public function cari()
    {
      $katakunci = $this->input->GET('query', TRUE);

      $this->load->library('pagination');
      $jumlah_data_doc = $this->m_download_center->jumlah_data();
      $config = array();
      $config['base_url'] = base_url().'download_center/index';
      $config['total_rows'] = $jumlah_data_doc;
      $config['per_page'] = 10;
      $start = $this->uri->segment(3);

      $config['full_tag_open'] = '<ul class = "dc-pagination-ul">';
      $config['full_tag_close'] = '</ul>';
      $config['cur_tag_open'] = '<li class="current">';
      $config['cur_tag_close'] = '</li>';
      $config['num_tag_open'] = '<li>';
      $config['num_tag_close'] = '</li>';
      $config['next_tag_open'] = '<li>';
      $config['next_tag_close'] = '</li>';
      $config['prev_tag_open'] = '<li>';
      $config['prev_tag_close'] = '</li>';

      $this->pagination->initialize($config);
      $data['dokumen'] = $this->m_download_center->caridokumen($katakunci, $config['per_page'], $start);
      $data['kategori'] = $this->m_download_center->get_kategori_files();
      $data['kategoriforedit'] = $this->m_download_center->get_kategori_files_for_editing();
      $data['katakuncilempar'] = $katakunci;
      $this->load->view('downloadcenter', $data);
    }

    public function filter()
    {
      $filter = $this->input->GET('document-filter', TRUE);

      $this->load->library('pagination');
      $jumlah_data_doc = $this->m_download_center->jumlah_data();
      $config = array();
      $config['base_url'] = base_url().'download_center/index';
      $config['total_rows'] = $jumlah_data_doc;
      $config['per_page'] = 10;
      $start = $this->uri->segment(3);

      $config['full_tag_open'] = '<ul class = "dc-pagination-ul">';
      $config['full_tag_close'] = '</ul>';
      $config['cur_tag_open'] = '<li class="current">';
      $config['cur_tag_close'] = '</li>';
      $config['num_tag_open'] = '<li>';
      $config['num_tag_close'] = '</li>';
      $config['next_tag_open'] = '<li>';
      $config['next_tag_close'] = '</li>';
      $config['prev_tag_open'] = '<li>';
      $config['prev_tag_close'] = '</li>';

      $this->pagination->initialize($config);
      $data['dokumen'] = $this->m_download_center->filter($filter, $config['per_page'], $start);
      $data['kategori'] = $this->m_download_center->get_kategori_files();
      $data['kategoriforedit'] = $this->m_download_center->get_kategori_files_for_editing();
      $data['katakuncilempar'] = $filter;
      $this->load->view('downloadcenter', $data);
    }

    public function tambahkategori()
    {
      $is_an_admin = $this->session->userdata('is_admin');

      if ($is_an_admin) {
        $kategori = array(
          'nama_kategori_doc' =>$this->input->post('tambahkategori')
        );

        $this->m_download_center->tambahkategori($kategori);

          if ($kategori) {
            redirect('download_center');
          }
          else {
            print_r('Penambahan kategori gagal, silahkan coba lagi');
          }
      }
      else {
        $this->load->view('unauthorized_access');
      }
    }

    public function hapuskategori($id_kategori_doc)
    {
      $is_an_admin = $this->session->userdata('is_admin');

      if ($is_an_admin) {
        $query= $this->db->query("SELECT * FROM unduhan WHERE id_kategori_doc = $id_kategori_doc");
        foreach ($query->result() as $row) {
          unlink('./uploads/download_center/'.$row->file_unduhan);
        }

      $this->m_download_center->hapuskategori($id_kategori_doc);
      redirect('download_center','refresh');
      }
      else {
        $this->load->view('unauthorized_access');
      }
    }
}
?>
