<?php
class Struktur_organisasi extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->helper(array('form','url','file'));
    $this->load->model('pegawai_model');
    $this->load->library(array('form_validation','session'));
  }

  public function index()
  {
    $data['jabatan_pegawai'] = $this->pegawai_model->get_jabatan_pegawai();
    $data['pegawai'] = $this->pegawai_model->get_pegawai();
    $this->load->view('struktur-organisasi' , $data);
  }

  public function tambah()
  {
    $is_an_admin = $this->session->userdata('is_admin');

    if ($is_an_admin) {
    $this->form_validation->set_rules('tambah-nik-pegawai', 'nik pegawai', 'required');
    $this->form_validation->set_rules('tambah-nama-pegawai', 'nama pegawai', 'required');
    $this->form_validation->set_rules('tambah-jabatan-pegawai', 'jabatan pegawai', 'required');

    if ($this->form_validation->run() == FALSE) {
      $this->load->view('struktur-organisasi');
    }
    else{
      $config['upload_path'] = './uploads/foto_profil/pejabat_struktural';
      $config['allowed_types'] = 'jpg|jpeg|png';
      $config['max_size'] = '10048000'; //10 MB
      $config['overwrite'] = TRUE;
      $config['encrypt_name'] = TRUE;

      $this->load->library('upload', $config);
      $this->upload->initialize($config);

      //$this->upload->do_upload();
      if (!$this->upload->do_upload()) {
        //kalau upload gagal
        $errors = array('error' => $this->upload->display_errors());
      }

      $data = array('upload_data' => $this->upload->data());
      //$foto_pegawai = $this->upload->data('file_name');

      $data_pegawai = array(
    		'nik_pegawai' =>$this->input->post('tambah-nik-pegawai'),
    		'nama_pegawai' =>$this->input->post('tambah-nama-pegawai'),
    		'jabatan_pegawai' => $this->input->post('tambah-jabatan-pegawai'),
        'foto_pegawai' => $data['upload_data']['file_name']
    	);

      $this->pegawai_model->tambah($data_pegawai);
      $this->session->set_flashdata('success','Foto telah terupload');
      redirect('struktur_organisasi','refresh');
    }
  }
  else {
    $this->load->view('unauthorized_access');
  }
  }

  public function edit($id_pegawai)
  {
    $is_an_admin = $this->session->userdata('is_admin');

    if ($is_an_admin) {
    $this->form_validation->set_rules('edit-nik-pegawai', 'nik pegawai', 'trim|required');
    $this->form_validation->set_rules('edit-nama-pegawai', 'nama pegawai', 'trim|required');
    $this->form_validation->set_rules('edit-jabatan-pegawai', 'jabatan pegawai', 'required');

    $config['upload_path'] = './uploads/foto_profil/pejabat_struktural';
    $config['allowed_types'] = 'jpg|jpeg|png';
    $config['max_size'] = '10048000'; //10 MB
    $config['overwrite'] = TRUE;
    $config['encrypt_name'] = TRUE;
    $this->load->library('upload', $config);
    $this->upload->initialize($config);

    //jika foto profil diedit
    if($this->form_validation->run() == TRUE && !empty($_FILES['userfile']['name'][0]))
    {
      //$this->upload->do_upload();
      if (!$this->upload->do_upload()) {
        //kalau upload gagal
        $errors = array('error' => $this->upload->display_errors());
      }

      $data = array('upload_data' => $this->upload->data());
      //$foto_edit_pegawai = $this->upload->data('file_name');

      $query = $this->db->query("SELECT * FROM pegawai WHERE id_pegawai = $id_pegawai");
      foreach ($query->result() as $row) {
        unlink('./uploads/foto_profil/pejabat_struktural/'.$row->foto_pegawai);
      }

      $data_edit_pegawai = array(
      		'nik_pegawai' =>$this->input->post('edit-nik-pegawai'),
      		'nama_pegawai' =>$this->input->post('edit-nama-pegawai'),
      		'jabatan_pegawai' => $this->input->post('edit-jabatan-pegawai'),
          'foto_pegawai' => $data['upload_data']['file_name']
      );

      $this->pegawai_model->update($id_pegawai, $data_edit_pegawai);
      $this->session->set_flashdata('success','Data dan foto berhasil diedit');
      redirect('struktur_organisasi','refresh');
    }
    else if ($this->form_validation->run() == TRUE && empty($_FILES['userfile']['name'][0]))
    {
      $data_edit_pegawai = array(
      		'nik_pegawai' =>$this->input->post('edit-nik-pegawai'),
      		'nama_pegawai' =>$this->input->post('edit-nama-pegawai'),
      		'jabatan_pegawai' => $this->input->post('edit-jabatan-pegawai')
      );

      $this->pegawai_model->update($id_pegawai, $data_edit_pegawai);
      $this->session->set_flashdata('success','Data berhasil diedit');
      redirect('struktur_organisasi','refresh');
    }
    }
    else {
      $this->load->view('unauthorized_access');
    }
  }
}

?>
