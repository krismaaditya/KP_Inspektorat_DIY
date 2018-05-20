<?php
class M_download_center extends CI_model
{
  public function unggahfile($file_data){
    $this->db->insert('unduhan',$file_data);
  }

  public function jumlah_data()
  {
    return $this->db->get('unduhan')->num_rows();
  }

  public function get_kategori_files()
  {
    $glquery = "SELECT * FROM kategori_doc";
    return $this->db->query($glquery)->result();
  }

  public function get_kategori_files_for_editing()
  {
    $glquery = "SELECT * FROM kategori_doc LIMIT 1, 100";
    return $this->db->query($glquery)->result();
  }

  public function get_files($limit, $start)
  {
    $this->db->select('unduhan.* , kategori_doc.*');
    $this->db->where('unduhan.id_kategori_doc = kategori_doc.id_kategori_doc');
    $this->db->order_by('unduhan.id_dokumen', 'desc');
    $query = $this->db->get('unduhan, kategori_doc', $limit, $start);
		return $query->result();
  }

  public function delete($id_dokumen)
  {
    $this->db->where('id_dokumen', $id_dokumen);
    $this->db->delete('unduhan');
  }

  public function tambahkategori($kategori){
    $this->db->insert('kategori_doc',$kategori);
  }

  public function hapuskategori($id_kategori_doc)
  {
    $this->db->where('id_kategori_doc', $id_kategori_doc);
    $this->db->delete('kategori_doc');
  }

  public function update($id_dokumen , $data_edit_dokumen)
  {
    $this->db->where('id_dokumen', $id_dokumen);
    $this->db->update('unduhan', $data_edit_dokumen);
  }

  public function caridokumen($katakunci , $limit, $start)
  {
    $this->db->select('unduhan.* , kategori_doc.*');
    $this->db->where('unduhan.id_kategori_doc = kategori_doc.id_kategori_doc');
    $this->db->like('unduhan.judul_dokumen', $katakunci);
    $this->db->order_by('unduhan.id_dokumen', 'desc');
    $query = $this->db->get('unduhan, kategori_doc', $limit, $start);
		return $query->result();
  }

  public function filter($filter , $limit, $start)
  {
    $this->db->select('unduhan.* , kategori_doc.*');
    $this->db->where('unduhan.id_kategori_doc = kategori_doc.id_kategori_doc');
    $this->db->where('unduhan.id_kategori_doc', $filter);
    $this->db->order_by('unduhan.id_dokumen', 'desc');
    $query = $this->db->get('unduhan, kategori_doc', $limit, $start);
		return $query->result();
  }
}
?>
