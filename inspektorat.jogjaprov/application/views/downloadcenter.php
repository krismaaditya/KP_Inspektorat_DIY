<?php
  $sql = "SELECT * FROM unduhan ORDER BY id_dokumen ASC LIMIT 10";
  $query = $this->db->query($sql);
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Inspektorat DIY</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/downloadcenter.css">
  </head>
  <body>
    <header>
      <?php include'header.php'; ?>
    </header>
    <nav>
      <?php include'nav.php'; ?>
    </nav>
    <div class="download_Center">
      <h2>Download Center</h2>

      <!-- Trigger/Open The Modal -->
      <button id="dcBtn">Unggah File</button>
      <!-- The Modal -->
      <div id="dcModal" class="dcmodal">
      <!-- Modal content -->
        <div class="dcmodal-content">
          <div class="dcmodal-header">
            <span class="dcclose">&times;</span>
            <h2>Unggah File</h2>
          </div>
        <div class="dcmodal-body">
          <!-- <form class="unggahForm" action="<?php //echo base_url('download_center/unggahfile'); ?>" method="post"> -->
          <?php echo form_open_multipart('download_center/unggahfile'); ?>
            <input class="judulDokumen" type="text" name="judul-dokumen" placeholder="Judul Dokumen" required>
            <input class="deskripsiDokumen" type="text" name="deskripsi-dokumen" placeholder="Deskripsi Dokumen" required>
            <input class="tipeDokumen" type="text" name="tipe-dokumen" placeholder="Tipe Dokumen">
            <input class="ukuranDokumen" type="text" name="ukuran-dokumen" placeholder="Ukuran Dokumen">
            <input class="pilihDokumen" type="file" name="file-unduhan" size="20"/>
            <img src="" alt=""/>
            <br>
            <input class="unggahButton" type="submit" name="submit" value="Unggah File">
          </form>
        </div>
        <div class="dcmodal-footer">
          <h3>Inspektorat DIY</h3>
        </div>
        </div>
      </div>

    </div>
    <div class="body_Download_Center">
      <h1>Daftar Dokumen</h1>
      <hr>
      <h2>Kategori</h2>
      <table class="tabel_Download_Center">
        <tbody>
          <tr class="header_Table">
            <th>No.</th>
  					<th>Keterangan File</th>
  					<th>Tipe</th>
  					<th>Ukuran</th>
  					<th>Link</th>
          </tr>
          <tr class="kolom_Body">
            <?php
    				if ($query->num_rows() > 0)
    				{
    					foreach ($query->result() as $row) {?>
            <td class="kolom_Body_Nomor">
              <?php echo $row->id_dokumen ?>
            </td>
            <td class="kolom_Body_Judul">
              <span>Nama dokumen :</span><?php echo $row->judul_dokumen ?>
              <ul>
                <li><span>Deskripsi :</span><?php echo $row->deskripsi_dokumen ?></li>
              </ul>
            </td>
            <td class="kolom_Body_Tipe">
              <?php echo $row->tipe_dokumen ?>
            </td>
            <td class="kolom_Body_Ukuran">
              <?php echo $row->ukuran_dokumen ?><span> KB</span>
            </td>
            <td class="kolom_Body_Link">
              <a class="document-download-link" href="<?php
              echo base_url('uploads/download_center/'.$row->file_unduhan);
              ?>"><img class="download_icon" src="<?php echo base_url(); ?>assets/icons/utilities icons/download.png"/> Download</a>

            </td>
          </tr>
          <?php }
            }
          ?>
        </tbody>
      </table>
    </div>
    <footer>
      <?php include'footer.php'; ?>
    </footer>

    <script>
    // Get the modal
    var dcmodal = document.getElementById('dcModal');

    // Get the button that opens the modal
    var dcbtn = document.getElementById("dcBtn");

    // Get the <span> element that closes the modal
    var dcspan = document.getElementsByClassName("dcclose")[0];

    // When the user clicks the button, open the modal
    dcbtn.onclick = function() {
        dcmodal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    dcspan.onclick = function() {
        dcmodal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(dcevent) {
        if (dcevent.target == dcmodal) {
            dcmodal.style.display = "none";
        }
    }
    </script>
  </body>
</html>
