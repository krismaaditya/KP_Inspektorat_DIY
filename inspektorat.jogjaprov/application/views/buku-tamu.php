<?php
$is_loggedin = $this->session->userdata('logged_in');
$is_an_admin = $this->session->userdata('is_admin');
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Buku Tamu</title>
	</head>
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/buku-tamu.css" />
	<body>
		<header>
			<?php include 'header.php' ?>
		</header>
		<nav>
			<?php include 'nav.php' ?>
		</nav>

    <?php if ($is_loggedin) { ?>
    <?php if ($is_an_admin) { ?>

		<h4 class="h4berita">Buku tamu Inspektorat DIY</h4>
		<hr class="hrdivider">

		<button id="bukutamuBtn">+Catat baru</button>

		<!-- FORM BUKU TAMU MODAL -->
		<div id="bukutamuModal" class="bukutamumodal">
			<div class="bukutamuModal-content">

				<div class="bukutamuModal-header">
					<span class="btclose">&times;</span>
					<h3>Catat buku tamu</h3>
				</div>

				<div class="bukutamuModal-body">
					<!-- <form class="buku-tamu-form" action="<?php //echo base_url('buku_tamu/catat'); ?>" method="post"> -->
            <?php echo form_open_multipart('buku_tamu/catat'); ?>

		        <label for="asal-instansi">Asal Instansi<span class="wajib_diisi">*</span></label>
						<input class="biodata" type="text" name="asal-instansi" required>

		        <label for="nama-lengkap">Nama Lengkap<span class="wajib_diisi">*</span></label>
						<input class="biodata" type="text" name="nama-lengkap" required>

		        <label for="tanggal-kunjungan">Tanggal Kunjungan<span class="wajib_diisi">*</span></label>
						<input class="biodata" type="date" name="tanggal-kunjungan" required>

		        <label for="keperluan">Keperluan<span class="wajib_diisi">*</span></label>
						<textarea name="keperluan" rows="8" cols="40"></textarea>

		        <label for="dokumentasi">Dokumentasi</label>
		        <input class="biodata" type="file" name="dokumentasi" size="20"/>
		        <img src="" alt=""/>

						<input class="registrasi-button" type="submit" name="register-button" value="SUBMIT">
					</form>
				</div>
			</div>
		</div>

		<div class="bt-pagination">
      <?php echo $this->pagination->create_links(); ?>
    </div>

		<div class="table-list-buku-tamu-div">
			<table>
				<tr>
          <th>No.</th>
					<th>Nama pengunjung</th>
					<th>Asal Instansi</th>
					<th>Tanggal kunjungan</th>
					<th>Keperluan kunjungan</th>
					<th>Lampiran</th>
					<th>Action</th>
				</tr>
				<!-- isi -->
				<?php
        $no = $this->uri->segment('3') + 1;
        foreach ($buku_tamu as $key) { ?>
						<tr>
              <td><?php echo $no++?></td>
		    			<td><?php echo $key->nama_pengunjung ?></td>
		    			<td><?php echo $key->asal_instansi ?></td>
		    			<td><?php echo $key->tanggal_kunjungan ?></td>
							<td><?php echo $key->keperluan_instansi ?></td>
              <td>
                <?php if ($key->dokumentasi): ?>
                  <a class="document-download-link" href="<?php echo base_url('uploads/lampiran_buku_tamu/'.$key->dokumentasi);?>">
                  <img class="download_icon" src="assets/icons/utilities icons/download.png"/> Download
                  </a>
                  <?php else: ?>
                    <?php echo "Tidak ada"; ?>
                <?php endif; ?>
              </td>
							<td>
								<a class="deleteagopendialogbutton" data-modal="deleteagendaModal<?php echo $key->id_buku_tamu ?>">Hapus</a>
								<!-- DELETE CATATAN TAMU MODAL -->
								<div id="deleteagendaModal<?php echo $key->id_buku_tamu?>" class="hapus-tamu-modal-window modal">
									<div class="deleteagendaModal-content">
										<div class="editagendaModal-header">
											<h4>Hapus Catatan</h4>
										</div>
										<div class="deleteagendaModal-body">
											<p>Apakah anda yakin ingin menghapus catatan tamu bernama <?php echo $key->nama_pengunjung ?> pada tanggal <?php echo $key->tanggal_kunjungan ?> ? </p>
											<p>Anda tidak dapat mengembalikan action ini.</p>
												<form role="form" class="tulisagendaform" action="<?php echo base_url('buku_tamu/hapus/'); echo $key->id_buku_tamu ?>" method="post">
												<input class="delete-agenda-button" type="submit" name="submit-delete-agenda-button" value="Ya">
												<input class="deleteagclose" data-modal="deleteagendaModal<?php echo $key->id_buku_tamu ?>" type="button" value="Tidak">
											</form>
										</div>
									</div>
								</div>
							</td>
		  			</tr>
						<?php } ?>
			</table>
		</div>


  <?php } else { ?>
    <h3>Maaf, hanya Admin yang bisa melihat halaman ini.</h3>
  <?php } } else { } ?>
  <footer>
  	<?php include 'footer.php' ?>
  </footer>

<script>
	// Get the modal
	var btmodal = document.getElementById('bukutamuModal');

	// Get the button that opens the modal
	var btbtn = document.getElementById("bukutamuBtn");

	// Get the <span> element that closes the modal
	var btspan = document.getElementsByClassName("btclose")[0];

	// When the user clicks on the button, open the modal
	btbtn.onclick = function() {
		// regModal.style.display = "none";
		btmodal.style.display = "block";
	}

	// When the user clicks on <span> (x), close the modal
	btspan.onclick = function() {
		btmodal.style.display = "none";
	}

	// When the user clicks anywhere outside of the modal, close it
	window.onclick = function(btevent) {
		if (btevent.target == btmodal) {
		btmodal.style.display = "none";
		}
	}

	//---------------------------------------------------//
	var deleteagbtn = document.getElementsByClassName("deleteagopendialogbutton");
	var tidakBtn = document.getElementsByClassName("deleteagclose");
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

  for (var i = 0; i < tidakBtn.length; i++) {
    var tdkBtn = tidakBtn[i];
    tdkBtn.addEventListener("click", function(){
      var deletemodal = document.getElementById(this.dataset.modal);
      deletemodal.style.display = "none";
      }, false);
  }
	</script>

</body>
</html>
