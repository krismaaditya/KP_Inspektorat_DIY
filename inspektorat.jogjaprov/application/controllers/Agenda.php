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
    $jumlah_data_agenda = $this->agenda_model->jumlah_data();
    $this->load->library('pagination');
    $config['base_url'] = base_url().'agenda/index';
    $config['total_rows'] = $jumlah_data_agenda;
    $config['per_page'] = 10;
    $from = $this->uri->segment(3);
    $this->pagination->initialize($config);
    $data['agenda'] = $this->agenda_model->data($config['per_page'], $from);

    $this->load->view('agenda', $data);
  }

  public function get_agenda()
  {
    $adata['agenda_items'] = $this->agenda_model->get_agenda();
    $this->load->view('calendar2', $adata);
  }

  public function tulis()
  {
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

  public function edit($id_agenda)
  {
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

  public function hapus($id_agenda)
  {
    $this->agenda_model->delete($id_agenda);
    redirect('agenda','refresh');
  }
}
?>
