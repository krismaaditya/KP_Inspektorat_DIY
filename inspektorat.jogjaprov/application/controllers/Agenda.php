<?php
class Agenda extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->helper('form');
    $this->load->helper('url');
    $this->load->model('agenda_model');
    $this->load->library('session');
    $this->load->library('pagination');
  }

  public function index()
  {
    $is_an_admin = $this->session->userdata('is_admin');

    if ($is_an_admin) {
      $jumlah_data_agenda = $this->agenda_model->jumlah_data();
      $this->load->library('pagination');
      $config['base_url'] = base_url().'agenda/index';
      $config['total_rows'] = $jumlah_data_agenda;
      $config['per_page'] = 31;

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

      $from = $this->uri->segment(3);
      $this->pagination->initialize($config);
      $data['agenda'] = $this->agenda_model->data($config['per_page'], $from);

      $this->load->view('agenda', $data);
    }
    else {
      $this->load->view('unauthorized_access');
    }
  }

  //untuk di-pass ke kalender
  public function get_agenda()
  {
    $adata['agenda_items'] = $this->agenda_model->get_agenda();
    $this->load->view('calendar2', $adata);
  }

  public function tulis()
  {
    $is_an_admin = $this->session->userdata('is_admin');

    if ($is_an_admin) {
      $agenda = array(
        'tanggal' =>$this->input->post('tanggal-agenda'),
        'judul_agenda' =>$this->input->post('judul-agenda'),
        'rincian_agenda' =>$this->input->post('rincian-agenda')
      );

        $this->agenda_model->tulis($agenda);
        if ($agenda) {
          $this->session->set_flashdata('success_msg','BERHASIL');
          redirect('agenda','refresh');
        }
    }
    else {
      $this->load->view('unauthorized_access');
    }
  }

  public function edit($id_agenda)
  {
    $is_an_admin = $this->session->userdata('is_admin');

    if ($is_an_admin) {
        $agenda = array(
          'tanggal' =>$this->input->post('edit-tanggal-agenda'),
          'judul_agenda' =>$this->input->post('edit-judul-agenda'),
          'rincian_agenda' =>$this->input->post('edit-rincian-agenda')
        );

        $this->agenda_model->update($id_agenda , $agenda);

        if ($agenda) {
          redirect('agenda','refresh');
        }
      }
      else {
        $this->load->view('unauthorized_access');
      }
  }

  public function hapus($id_agenda)
  {
    $is_an_admin = $this->session->userdata('is_admin');

    if ($is_an_admin) {
      $this->agenda_model->delete($id_agenda);
      redirect('agenda','refresh');
    }
    else {
      $this->load->view('unauthorized_access');
    }
  }
}
?>
