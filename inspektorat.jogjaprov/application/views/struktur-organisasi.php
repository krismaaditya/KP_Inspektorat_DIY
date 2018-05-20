<?php
$is_loggedin = $this->session->userdata('logged_in');
$is_an_admin = $this->session->userdata('is_admin');
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Struktur Organisasi</title>
    <link rel="stylesheet" href="<?php echo base_url()?>/css/struktur-organisasi.css">
  </head>
  <body>
    <header>
      <?php include 'header.php'; ?>
    </header>

    <nav>
      <?php include 'nav.php'; ?>
    </nav>

    <section>
      <h3>STRUKTUR ORGANISASI</h3>
      <hr>

      <!-- TAMBAH -->
      <!-- tambah button -->
      <?php if ($is_loggedin) { ?>
      <?php if ($is_an_admin) { ?>
      <button id="tambahPegawaiButton" type="button" name="tambahbutton"><img class="tambahpegawai-icon" src="<?php echo base_url()?>/assets/icons/utilities icons/pencil-edit-button.png" alt="">Tambah</button>

      <!-- tambah modal pop-up -->
      <div id="tambahPegawaiModal" class="tambahpegawaimodal">
        <div class="tambahPegawaiModal-content">
          <div class="tambahPegawaiModal-header">
            <span class="tambahPclose">&times;</span>
            <h3>Tambah data pegawai dan jabatan</h3>
          </div>

          <div class="tambahPegawaiModal-body">
            <!-- form tambah pegawai -->
            <form class="tambahp" id="tambahpegawaiform" action="<?php echo base_url('struktur_organisasi/tambah'); ?>" enctype="multipart/form-data" method="post">
              <label for="tambah-nik-pegawai">NIK<span class="wajib_diisi">*</span></label>
              <input class="data-tambah-pegawai" type="number" name="tambah-nik-pegawai" required value="<?php //echo $key->tanggal ?>">

              <label for="tambah-nama-pegawai">Nama Pegawai<span class="wajib_diisi">*</span></label>
              <input class="data-tambah-pegawai" type="text" name="tambah-nama-pegawai" required value="<?php //echo $key->judul_agenda ?>">

              <label for="tambah-jabatan-pegawai">Jabatan Pegawai<span class="wajib_diisi">*</span></label>
              <select class="data-tambah-pegawai" name="tambah-jabatan-pegawai">
  						<?php if (count($jabatan_pegawai)): ?>
                <?php foreach($jabatan_pegawai as $row):?>
                  <option value="<?php echo $row->id_jabatan ?>"><?php echo $row->nama_jabatan ?></option>
                <?php endforeach; ?>
              <?php endif ?>
  						</select>

              <img id="foto-pegawai-preview-before-upload" alt="foto-preview" src="<?php echo base_url()?>assets/photos/default-photo-profile.png">

              <label for="userfile">Upload Foto Pegawai ('.jpg' | '.jpeg' | '.png')</label>
              <input type="file" id="addfotopegawai" name="userfile" required onchange="previewFoto()"/>

              <input class="tambah-pegawai-button" type="submit" name="submit-tambah-pegawai-button" value="simpan">
            </form>
            <!-- end of form tambah pegawai -->
          </div>
        </div>
      </div>

      <!-- EDIT -->
      <!-- edit button -->
      <button id="editPegawaiButton" type="button" name="editbutton"><img class="editpegawai-icon" src="<?php echo base_url()?>/assets/icons/utilities icons/pencil-edit-button.png" alt="">Edit</button>

      <!-- edit modal pop-up -->
      <div id="editPegawaiModal" class="editpegawaimodal">
        <div class="editPegawaiModal-content">
          <div class="editPegawaiModal-header">
            <span class="editPclose">&times;</span>
            <h3>Sunting data pegawai dan jabatan</h3>
          </div>

          <div class="editPegawaiModal-body">
            <?php if (count($pegawai)): ?>
              <?php foreach($pegawai as $row):?>
            <form class="editp" id="editpegawaiform" action="<?php echo base_url('struktur_organisasi/edit/'.$row->id_pegawai); ?>" enctype="multipart/form-data" method="post">
              <img id="edit-foto-pegawai-preview-before-upload" class="edit-foto-pegawai-preview" src="<?php echo base_url()?>uploads/foto_profil/pejabat_struktural/<?php echo $row->foto_pegawai ?>" alt="">

              <label for="userfile">Ganti Foto Pegawai</label>
              <input type="file" id="editfotofile" name="userfile" onchange="previewEditFoto()"/>

              <label for="edit-nik-pegawai">NIK<span class="wajib_diisi">*</span></label>
              <input class="data-edit-pegawai" type="number" name="edit-nik-pegawai" required value="<?php echo $row->nik_pegawai ?>">

              <label for="edit-nama-pegawai">Nama Pegawai<span class="wajib_diisi">*</span></label>
              <input class="data-edit-pegawai" type="text" name="edit-nama-pegawai" required value="<?php echo $row->nama_pegawai ?>">

              <label for="edit-jabatan-pegawai">Jabatan Pegawai<span class="wajib_diisi">*</span></label>
              <select class="data-edit-pegawai readonly-data" name="edit-jabatan-pegawai" readonly>
                <option value="<?php echo $row->id_jabatan ?>"><?php echo $row->nama_jabatan ?></option>
              </select>

              <input class="edit-pegawai-button" type="submit" name="submit-edit-pegawai-button" value="simpan">
            </form>
          <?php endforeach; ?>
        <?php endif ?>
          </div>
        </div>
      </div>
    <?php } else { ?>
    <?php } } else { } ?>


      <!-- BAGAN STRUKTUR ORGANISASI (GRID)-->
      <div class="grid-container">
        <?php if (count($pegawai)): ?>
          <?php foreach($pegawai as $row):?>
            <div id="grid-item" class="grid-item-<?php echo $row->id_jabatan ?>">
              <div class="card-wrapper">
                <img class="card-photo" src="<?php echo base_url()?>uploads/foto_profil/pejabat_struktural/<?php echo $row->foto_pegawai ?>" alt="">
                  <div class="profile-details">
                  <h5><?php echo $row->nama_pegawai ?></h5>
                  <hr>
                  <p><?php echo $row->nama_jabatan ?></p>
                  </div>
             </div>
           </div>
         <?php endforeach; ?>
       <?php endif ?>

       <div id="grid-item" class="grid-item-jabatanfungsional">
         <div class="card-wrapper">
           <img class="card-photo" src="<?php echo base_url()?>assets/photos/default-photo-profile.png" alt="">
             <div class="profile-details">
             <h5>Kelompok Jabatan Fungsional</h5>
             <hr>
             <p>Kelompok Jabatan Fungsional</p>
             </div>
        </div>
        </div>

      </div>
    </section>

    <footer>
      <?php include 'footer.php'; ?>
    </footer>

    <script>
          // Get the modal
          var epModal = document.getElementById("editPegawaiModal");
          var tpModal = document.getElementById("tambahPegawaiModal");

          // Get the button that opens the modal
          var epBtn = document.getElementById("editPegawaiButton");
          var tpBtn = document.getElementById("tambahPegawaiButton");

          // Get the <span> element that closes the modal
          var epspan = document.getElementsByClassName("editPclose")[0];
          var tpspan = document.getElementsByClassName("tambahPclose")[0];

          epBtn.onclick = function() {
            epModal.style.display = "block";

            window.onclick = function(epevent) {
              if (epevent.target == epModal) {
              epModal.style.display = "none";
              }
            }
          }

          tpBtn.onclick = function() {
            tpModal.style.display = "block";

            window.onclick = function(tpevent) {
              if (tpevent.target == tpModal) {
              tpModal.style.display = "none";
              }
            }
          }

          epspan.onclick = function() {
            epModal.style.display = "none";
          }

          tpspan.onclick = function() {
            tpModal.style.display = "none";
          }

          // fungsi preview foto pegawai sebelum diupload
          function previewFoto(){
            document.getElementById("foto-pegawai-preview-before-upload").style.display = "block";
            var oFReader = new FileReader();

            oFReader.readAsDataURL(document.getElementById("addfotopegawai").files[0]);
            oFReader.onload = function(oFREvent){
              document.getElementById("foto-pegawai-preview-before-upload").src = oFREvent.target.result;
            };
          };

          // fungsi preview edit foto pegawai sebelum diupload

          function previewEditFoto(){
            document.getElementById("edit-foto-pegawai-preview-before-upload").style.display = "block";
            var oFReader2 = new FileReader();

            oFReader2.readAsDataURL(document.getElementById("editfotofile").files[0]);
            oFReader2.onload = function(oFREvent2){
              document.getElementById("edit-foto-pegawai-preview-before-upload").src = oFREvent2.target.result;
            };
          };
    </script>
  </body>
</html>
