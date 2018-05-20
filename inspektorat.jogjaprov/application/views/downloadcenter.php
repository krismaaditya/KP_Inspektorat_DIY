<?php
  $is_loggedin = $this->session->userdata('logged_in');
  $is_an_admin = $this->session->userdata('is_admin');
?>

<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="utf-8">
    <title>Inspektorat DIY - Download Center</title>
    <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery/jquery-3.3.1.min.js" async></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>js/nav.js" async></script>
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
      <p>Pencarian : </p>
      <form class="pencarian-form" action="<?php echo base_url('download_center/cari')?>" method="get">
        <input class="txt-input-cari" type="text" name="query" placeholder="Cari...">
        <input class="button-cari" type="submit" name="" value="Cari">
      </form>

      <br>
      <p>Filter : </p>
      <form class="pencarian-form" action="<?php echo base_url('download_center/filter')?>" method="get">
        <select class="kat-filter" name="document-filter">
          <?php foreach ($kategori as $row): ?>
            <option value="<?php echo $row->id_kategori_doc?>"><?php echo $row->nama_kategori_doc ?></option>
          <?php endforeach; ?>
        </select>
        <input class="button-cari" type="submit" name="" value="Filter">
      </form>

      <br>
      <br>

      <!-- Trigger/Open The Modal -->
      <?php if ($is_loggedin) { ?>
			<?php if ($is_an_admin) { ?>
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
          <div class="formuploaddiv">
            <?php echo form_open_multipart('download_center/unggahfile'); ?>
              <input class="judulDokumen" type="text" name="judul-dokumen" placeholder="Judul Dokumen" required>
              <input class="deskripsiDokumen" type="text" name="deskripsi-dokumen" placeholder="Deskripsi Dokumen" required>
              <input class="deskripsiDokumen" type="url" name="url" placeholder="masukkan link url download center lain...">
              <label for="kategori-doc-option">Kategori dokumen : </label>
              <select class="kategoridoclass" name="kategori-doc-option">
                <?php foreach ($kategori as $row): ?>
                  <option value="<?php echo $row->id_kategori_doc?>"><?php echo $row->nama_kategori_doc ?></option>
                <?php endforeach; ?>
              </select>
              <br>
              <br>
              <label class="labelunggah"for="file-unduhan">Unggah dokumen/file ( pdf | doc | docx | xlsx | ppt | pptx | odf | odt | txt | rtf | xps )</label>
              <input class="pilihDokumen" type="file" name="file-unduhan" size="20"/>
              <br>
              <input class="unggahButton" type="submit" name="submit" value="Unggah File">
            </form>
          </div>

          <p>Kategori yang ada</p>
          <?php foreach ($kategoriforedit as $row): ?>
            <br>
            <p class="listkategori"> - <?php echo $row->nama_kategori_doc ?></p>
            <a class="hapuskatbutton" data-hapuskatmodal="hapuskatModal<?php echo $row->id_kategori_doc?>">Hapus</a>
            <div id="hapuskatModal<?php echo $row->id_kategori_doc?>" class="hapuskategori-modal-window modal">
              <div class="hapuskatModal-content">
                <div class="hapuskatModal-header">
                  <h5>Hapus kategori ini?</h5>
                </div>
                <div class="hapuskatModal-body">
                  <p>! File dokumen yang memiliki kategori ini akan terhapus!</p>
                    <form role="form" class="hapuskategoriform" action="<?php echo base_url('download_center/hapuskategori/');?><?php echo $row->id_kategori_doc?>" method="post">
                    <input class="h-button" type="submit" name="submit-tambah-kategori-button" value="Ya">
                    <input class="th-button" data-hapuskatmodal="hapuskatModal<?php echo $row->id_kategori_doc?>" type="button" value="Tidak">
                  </form>
                </div>
              </div>
            </div>
          <?php endforeach; ?>

          <form role="form" class="tambahkategoriform" action="<?php echo base_url('download_center/tambahkategori/');?>" method="post">
            <h4>Tambahkan kategori</h4>
          <input type="text" name="tambahkategori" required>
          <input class="tambahkategori-button" type="submit" name="submit-tambah-kategori-button" value="Tambahkan">
          </form>

        </div>
        </div>
      </div>
    <?php } else { ?>
    <?php } } else { } ?>

    </div>


    <div class="body_Download_Center">
      <!-- <h1>Daftar Dokumen</h1> -->
      <div id="pagination_link">
        <?php echo $this->pagination->create_links(); ?>
      </div>
      <hr>
      <!-- <h2>Kategori</h2> -->
      <table class="tabel_Download_Center" id="download_centerTable">
        <tbody>
          <tr class="header_Table">
            <th class="tdc">No.</th>
  					<th>Nama Dokumen</th>
            <th>Deskripsi</th>
            <th>Kategori</th>
  					<th class="tdc">Tipe</th>
  					<th class="tdc">Ukuran</th>
  					<th id="tdc">Link Download</th>
            <?php if ($is_loggedin) { ?>
      			<?php if ($is_an_admin) { ?>
            <th class="tdc">Action</th>
          <?php } else { ?>
          <?php } } else { } ?>
          </tr>
          <tr class="kolom_Body">
            <?php
            $no = $this->uri->segment('3') + 1;
            foreach ($dokumen as $key){
    				//if ($query->num_rows() > 0) {
              //foreach ($query->result() as $row) {?>
            <td class="kolom_Body_Nomor">
              <?php echo $no++?>
            </td>
            <td class="kolom_Body_Judul">
              <?php echo $key->judul_dokumen ?>
            </td>

            <td>
              <?php echo $key->deskripsi_dokumen ?>
            </td>

            <td>
              <?php if ($key->nama_kategori_doc): ?>
                <?php echo $key->nama_kategori_doc; ?>
                <?php else: ?>
                  <?php echo "Tidak ada"; ?>
              <?php endif; ?>
            </td>

            <td class="kolom_Body_Tipe">
              <?php if ($key->tipe_dokumen == NULL): ?>
                <p>URL</p>
              <?php else: ?>
              <?php echo $key->tipe_dokumen ?>
            <?php endif; ?>

            </td>
            <td class="kolom_Body_Ukuran">
              <?php if ($key->ukuran_dokumen == NULL): ?>
                <p>URL</p>
              <?php else: ?>
              <?php echo $key->ukuran_dokumen ?> <span>KB</span>
            <?php endif; ?>
            </td>

            <td class="kolom_Body_Link">
              <?php if ($key->file_unduhan == NULL): ?>
                <a class="link-to-another-site" href="<?php echo $key->url?>">Link</a>
              <?php else: ?>
                <a class="document-download-link" href="<?php
                echo base_url('uploads/download_center/'.$key->file_unduhan);
                ?>"><img class="download_icon" src="<?php echo base_url(); ?>assets/icons/utilities icons/download.png"/> Download</a>
            <?php endif; ?>
            </td>

            <?php if ($is_loggedin) { ?>
      			<?php if ($is_an_admin) { ?>
            <td class="kolom_Body_Action">
            <a class="editagopen" data-modal="editagendaModal<?php echo $key->id_dokumen?>">Edit</a>
            <div id="editagendaModal<?php echo $key->id_dokumen?>" class="edit-agenda-modal-window modal">
              <div class="editagendaModal-content">

                <div class="editagendaModal-header">
                  <span class="editagclose" data-modal="editagendaModal<?php echo $key->id_dokumen?>">&times;</span>
                  <h3>Sunting Dokumen</h3>
                </div>

                <div class="editagendaModal-body">
                    <form class="tulisagendaform" action="<?php echo base_url('download_center/edit/'.$key->id_dokumen); ?>" enctype="multipart/form-data" method="post">

                    <label for="edit-judul-dokumen">Judul Dokumen<span class="wajib_diisi">*</span></label>
                    <input class="data-agenda" type="text" name="edit-judul-dokumen" required value="<?php echo $key->judul_dokumen ?>">

                    <label for="edit-deskripsi-dokumen">Deskripsi Dokumen<span class="wajib_diisi">*</span></label>
                    <input class="data-agenda" type="text" name="edit-deskripsi-dokumen" required value="<?php echo $key->deskripsi_dokumen ?>">

                    <input class="data-agenda" type="file" name="userfile" size="20"/>

                    <input class="edit-agenda-button" type="submit" name="submit-edit-dokumen-button" value="SUBMIT">
                  </form>
                </div>
              </div>
            </div>
            |
            <!-- =====================DELETE AGENDA =======================-->
            <a class="deleteagopendialogbutton" data-modal="deleteagendaModal<?php echo $key->id_dokumen?>">Hapus</a>

            <!-- ============FORM DELETE AGENDA MODAL ==================== -->
            <div id="deleteagendaModal<?php echo $key->id_dokumen?>" class="edit-agenda-modal-window modal">
              <div class="deleteagendaModal-content">

                <div class="editagendaModal-header">
                  <h4>Hapus Agenda</h4>
                </div>

                <div class="deleteagendaModal-body">
                  <h5>Apakah anda yakin ingin menghapus file ini?</h5>
                    <form role="form" class="tulisagendaform" action="<?php echo base_url('download_center/hapus/'); echo $key->id_dokumen ?>" method="post">
                    <input class="delete-agenda-button" type="submit" name="submit-delete-file-button" value="Ya">
                    <input class="deleteagclose" data-modal="deleteagendaModal<?php echo $key->id_dokumen?>" type="button" value="Tidak">
                  </form>

                </div>
              </div>
            </div>
          </td>
        <?php } else { ?>
        <?php } } else { } ?>
          </tr>
          <?php }
            //}
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

    var editagbtn = document.getElementsByClassName("editagopen");
    var closeagbtn = document.getElementsByClassName("editagclose");

    var deleteagbtn = document.getElementsByClassName("deleteagopendialogbutton");
    var tidakBtn = document.getElementsByClassName("deleteagclose");

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

    //open edit form button
    for (var i = 0; i < editagbtn.length; i++) {
      var editBtn = editagbtn[i];
      editBtn.addEventListener("click", function(){
        editmodal = document.getElementById(this.dataset.modal);
        editmodal.style.display = "block";

        window.onclick = function(edagevent) {
          if (edagevent.target == editmodal) {
          editmodal.style.display = "none";
          }
        }

        }, false);
    }

    //button untuk close EDIT form
    for (var i = 0; i < closeagbtn.length; i++) {
      var closeBtn = closeagbtn[i];
      closeBtn.addEventListener("click", function(){
        var editmodal = document.getElementById(this.dataset.modal);
        editmodal.style.display = "none";
        }, false);
    }

    //open DELETE form button
    for (var i = 0; i < deleteagbtn.length; i++) {
      var deleteBtn = deleteagbtn[i];
      deleteBtn.addEventListener("click", function(){
        deletemodal = document.getElementById(this.dataset.modal);
        deletemodal.style.display = "block";

        window.onclick = function(deagevent) {
          if (deagevent.target == deletemodal) {
          deletemodal.style.display = "none";
          }
        }

        }, false);
    }

    //button untuk close DELETE form
    for (var i = 0; i < tidakBtn.length; i++) {
      var tdkBtn = tidakBtn[i];
      tdkBtn.addEventListener("click", function(){
        var deletemodal = document.getElementById(this.dataset.modal);
        deletemodal.style.display = "none";
        }, false);
    }

    //=============================================//
    //---------------------------------------------------//


  	var deleteagbtn = document.getElementsByClassName("hapuskatbutton");
  	var tidakBtn = document.getElementsByClassName("th-button");
    for (var i = 0; i < deleteagbtn.length; i++) {
          var deleteBtn = deleteagbtn[i];
          deleteBtn.addEventListener("click", function(){
            deletemodal = document.getElementById(this.dataset.hapuskatmodal);
            deletemodal.style.display = "block";

            window.onclick = function(hkevent) {
          		if (hkevent.target == deletemodal) {
          		deletemodal.style.display = "none";
          		}
          	}
            }, false);
        }

    for (var i = 0; i < tidakBtn.length; i++) {
      var tdkBtn = tidakBtn[i];
      tdkBtn.addEventListener("click", function(){
        var deletemodal = document.getElementById(this.dataset.hapuskatmodal);
        deletemodal.style.display = "none";
        }, false);
    }
    </script>
  </body>
</html>
