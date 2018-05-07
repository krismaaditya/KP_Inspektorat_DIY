<?php
/**
 *
 */
class Agenda_model extends CI_Model
{

  public function tulis($data_agenda){
    $this->db->insert('agenda',$data_agenda);
  }

  public function get_agenda()
  {
    $this->db->select('*');
    $this->db->order_by('tanggal');
		$query = $this->db->get('agenda');
		return $query->result();
  }

  public function jumlah_data()
  {
    return $this->db->get('agenda')->num_rows();
  }

  public function data($number, $offset)
  {
    return $query = $this->db->get('agenda', $number, $offset)->result();
  }

  public function delete($id_agenda)
  {
    $this->db->where('id_agenda', $id_agenda);
    $this->db->delete('agenda');
  }

  public function update($id_agenda , $agenda)
  {
    $this->db->where('id_agenda', $id_agenda);
    $this->db->update('agenda', $agenda);
  }
}

?>
