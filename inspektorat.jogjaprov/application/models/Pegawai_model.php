<?php
class Pegawai_model extends CI_model
{
  public function tambah($foto_pegawai)
  {
    $data_pegawai = array(
  		'nik_pegawai' =>$this->input->post('tambah-nik-pegawai'),
  		'nama_pegawai' =>$this->input->post('tambah-nama-pegawai'),
  		'jabatan_pegawai' => $this->input->post('tambah-jabatan-pegawai'),
      'foto_pegawai' => $foto_pegawai
  	);

    $this->db->insert('pegawai',$data_pegawai);
  }

  public function edit($id_pegawai){
    
  }

  public function get_pegawai()
	{
		$this->db->select('p.* , jp.*');
    $this->db->where('p.jabatan_pegawai = jp.id_jabatan');
		$query = $this->db->get('pegawai AS p, jabatan_pegawai AS jp');
		return $query->result();
	}

  public function get_jabatan_pegawai()
	{
		$this->db->select('*');
		$query = $this->db->get('jabatan_pegawai');
		return $query->result();
	}
}

?>
