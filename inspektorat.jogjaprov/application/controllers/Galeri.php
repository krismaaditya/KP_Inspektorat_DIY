<?php
class Galeri extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->helper(array('form','url','file'));
    $this->load->model('galeri_model');
    $this->load->library(array('form_validation','session', 'image_lib'));
  }

  public function index()
  {
    // $data['jabatan_pegawai'] = $this->pegawai_model->get_jabatan_pegawai();
    $data['galeri'] = $this->galeri_model->get_files();
    $this->load->view('galeri', $data);
  }

  public function upload()
  {
    $is_an_admin = $this->session->userdata('is_admin');

    if ($is_an_admin) {
      $files = $_FILES;
      $count = count($_FILES['userfile']['name']);
        for($i = 0; $i < $count; $i++)
        {
          $_FILES['userfile']['name']= time().$files['userfile']['name'][$i];
          $_FILES['userfile']['type']= $files['userfile']['type'][$i];
          $_FILES['userfile']['tmp_name']= $files['userfile']['tmp_name'][$i];
          $_FILES['userfile']['error']= $files['userfile']['error'][$i];
          $_FILES['userfile']['size']= $files['userfile']['size'][$i];

          $config['upload_path'] = './uploads/gallery/photos';
          $config['allowed_types'] = 'jpg|jpeg|png';
          $config['max_size'] = '10048000'; //10 MB
          $config['overwrite'] = TRUE;
          $config['encrypt_name'] = TRUE;

          $this->load->library('upload', $config);
          // $this->upload->initialize($config);
          //$this->upload->do_upload();
          if (!$this->upload->do_upload()) {
            //kalau upload gagal
            $errors = array('error' => $this->upload->display_errors());
          }

          $data = array('upload_data' => $this->upload->data());
          $fileName = $data['upload_data']['file_name'];

          //buat thumbnailnya
          $thumbnail_config = array(
            'source_image' => $data['upload_data']['full_path'],
            'new_image' => './uploads/gallery/photo-thumbnails',
            'maintain_ratio' => false,
            'width' => 226,
            'height' => 188
          );

          $this->image_lib->initialize($thumbnail_config);
          $this->image_lib->resize();

          //memasukan file yang mau diupload ke array
          //$images[] merupakan sebuah ARRAY yang nampung file upload
          $images[] = $fileName;
        }
        $today = date("Y-m-d H:i:s");

        $upload_data = array(
      		'deskripsi' =>$this->input->post('gallery-description'),
      		'waktu_upload' =>$today
      	);

        //karena array gak bisa dimasukkin ke db
        //kita ubah ke string dengan implode
        $fileName = implode(',',$images);

        $this->galeri_model->upload($upload_data ,$fileName);
        $this->session->set_flashdata('success','File galeri berhasil terupload');
        redirect('galeri');
    }
      else {
        $this->load->view('unauthorized_access');
      }

    }

  public function edit($id_galeri)
  {
    $is_an_admin = $this->session->userdata('is_admin');

    if ($is_an_admin) {

      $deskripsiedit = $this->input->post('edit-caption-galeri');

      $this->galeri_model->update($id_galeri , $deskripsiedit);

      if ($deskripsiedit) {
          redirect('galeri','refresh');
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
      $id_file = $this->uri->segment(3);
      $sql = "SELECT * FROM files_galeri WHERE id_file = ?";
      $query = $this->db->query($sql, $id_file);

      foreach ($query->result() as $row) {
        unlink('./uploads/gallery/photos/'.$row->nama_file);
        unlink('./uploads/gallery/photo-thumbnails/'.$row->nama_file);
      }

      $this->galeri_model->hapus($id_file);
      redirect('galeri','refresh');
    }
    else {
      $this->load->view('unauthorized_access');
    }
  }
}

?>
