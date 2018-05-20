<?php
if (count($userprofil)) :
	foreach ($userprofil as $row):
		$id_user = $row->id_user;
		$nomor_ktp = $row->no_ktp;
		$nama_user = $row->nama_user;
		$alamat = $row->alamat;
		$nomor_hp = $row->no_hp;
		$email = $row->email;
		$is_verified = $row->verified;
		$foto_profil_user = $row->foto_profil_user;
		$foto_ktp_user = $row->foto_ktp_user;
	endforeach;
endif;

$is_loggedin = $this->session->userdata('logged_in');
$is_an_admin = $this->session->userdata('is_admin');
$is_current_user_look = $this->session->userdata('is_current_user_look');
$is_current_user = $this->session->userdata('is_current_user');

?>
<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="utf-8">
    <title>Profil - <?php echo $nama_user ?></title>
  </head>
  <link rel="stylesheet" href="<?php echo base_url(); ?>css/user-profil.css" />
  <body>
    <header>
      <?php include 'header.php'; ?>
    </header>
    <nav>
      <?php include 'nav.php'; ?>
    </nav>

		<div class="body-wrapper">
			<div class="top-div">
				<h2 class="h2user">Profil user : <?php echo $nama_user ?></h2>

				<?php if ($is_verified == 1){ ?>
					<h4 class="h4verifiedstatus">
						<?php //if ($id_user == $this->session->userdata('id_user')){ ?>
							User
						<?php //}else{ ?>
							<!-- Anda -->
						<?php //} ?>
						telah terverifikasi (V)
					</h4>
				<?php } elseif ($is_verified == 0) { ?>
					<h4 class="h4unverifiedstatus">
						<?php //if ($id_user != $this->session->userdata('id_user')){ ?>
							User
						<?php //}else{ ?>
							<!-- Anda -->
						<?php //} ?>
						belum terverifikasi (X)
					</h4>
				<?php } else { ?>
					<h4 class="h4unknownstatus">Unknown User (V)</h4>
				<?php } ?>
			</div>

			<hr class="dividerline">

	    <div class="user-photo-div">
				<?php if ($foto_profil_user == NULL){ ?>
					<img class="profile-picture" src="<?php echo base_url(); ?>assets/photos/foto-profil-default.png"/>
				<?php } else {?>
					<img class="profile-picture" src="<?php echo base_url(); ?>uploads/foto_profil/users/<?php echo $row->foto_profil_user ?>"/>
				<?php } ?>

				<?php if ($is_current_user_look){ ?>
					<a id="uploadGaleriBtn">+ Upload foto profil</a>
				<?php }else{ } ?>
	    </div>

			<?php if ($is_current_user_look){ ?>
				<!-- UPLOAD FOTO PROFIL MODAL -->
				<div id="galeriModal" class="galerimodal">
					<div class="galeriModal-content">
					<div class="galeriModal-header">
						<span class="galericlose">&times;</span>
						<h3>Upload foto profil</h3>
					</div>
					<div class="galeriModal-body">
						<!-- form UPLOAD FOTO PROFIL -->
						<form class="uploadfoto-form" action="<?php echo base_url('user/submiteditfotoprofil/'.$row->id_user); ?>" enctype="multipart/form-data" method="post">
							<img id="preview-galeri-before-upload" alt="preview akan ditampilkan di sini setelah anda memilih file">

							<!-- <label></label> -->
							<p>Ukuran file maksimal 10 MB</p>
							<p>Upload foto profil ('.jpg' | '.jpeg' | '.png')</p>
							<input type="file" id="fotoprofilupload" name="userfile" required accept="image/jpeg, image/x-png" onchange="previewGaleriUpload()"/>

							<input class="upload-galeri-button" type="submit" name="submit-upload-galeri-button" value="upload">
						</form>
					</div>
					</div>
				</div>
			<?php }else{ } ?>

	    <div class="user-biodata-div">
					<?php if ($is_current_user_look){ ?>
						<!-- EDIT PROFIL MODAL -->
						<a id="editbiodataBtn">Edit biodata</a>

						<div id="editbiodataModal" class="editbiodatamodal">
							<div class="editbiodataModal-content">
							<div class="editbiodataModal-header">
								<span class="editbiodataclose">&times;</span>
								<h3>Edit Biodata profil</h3>
							</div>
							<div class="editbiodataModal-body">
								<!-- form EDIT PROFIL -->
								<form class="edit-profile-form" action="<?php echo base_url('user/submiteditprofile/'.$row->id_user); ?>" method="post">
									<label for="nama-lengkap">Nama Lengkap<span class="wajib_diisi">*</span></label>
				          <input class="edit-nama-lengkap" type="text" name="edit-nama-lengkap" required value="<?php echo $nama_user ?>">

				          <label for="no_KTP">Nomor KTP<span class="wajib_diisi">*</span></label>
				          <input class="edit-no-ktp" type="text" name="edit-noktp" required value="<?php echo $nomor_ktp ?>">

				          <label for="alamat">Alamat<span class="wajib_diisi">*</span></label>
				          <input class="edit-alamat" type="text" name="edit-alamat" value="<?php echo $alamat ?>">

				          <label for="telepon">Nomor Telepon<span class="wajib_diisi">*</span></label>
				          <input class="edit-telepon" type="text" name="edit-telepon" required value="<?php echo $nomor_hp ?>">

				          <label for="email">E-mail<span class="wajib_diisi">*</span></label>
				          <input class="edit-email" type="email" name="edit-email" required value="<?php echo $email ?>">

				          <label for="password">Password<span class="wajib_diisi">*</span></label>
				          <input class="edit-password" type="password" name="edit-password" required value="<?php echo $this->session->userdata('plainpass'); ?>">

				          <input class="edit-button" type="submit" name="submit-edit-button" value="Simpan">
								</form>
							</div>
							</div>
						</div>
					<?php }else{ } ?>

	        <h5>Nama Lengkap</h5>
	        <p><?php echo $nama_user ?></p>

					<?php if ($is_current_user_look || $is_an_admin): ?>
						<h5>Nomor KTP</h5>
		        <p><?php echo $nomor_ktp ?></p>

						<h5>Foto Selfie KTP user</h5>
						<p class="p-foto-ktp-wrapper">
							<?php if ($foto_ktp_user == NULL){ ?>
								User belum memiliki foto selfie KTP
							<?php }else {?>
								<img class="fotoktpuser" src="<?php echo base_url(); ?>uploads/foto_ktp/users/<?php echo $foto_ktp_user ?>" alt="">
							<?php } ?>
						</p>
						<?php else: ?>

						<?php endif; ?>

					<?php if ($is_current_user_look){ ?>
						<a id="uploadfotoktpBtn">Upload foto ktp</a>

						<div id="uploadfotoktpModal" class="uploadfotoktpmodal">
							<div class="uploadfotoktpModal-content">
							<div class="uploadfotoktpModal-header">
								<span class="uploadfotoktpclose">&times;</span>
								<h3>Upload foto selfie anda dengan KTP</h3>
							</div>
							<div class="uploadfotoktpModal-body">
								<!-- BUAT EDIT FOTO KTP -->
								<p>Ini digunakan untuk verifikasi anda sebagai user sebelum menggunakan layanan di website ini</p>
								<form class="edit-fotoktpform" action="<?php echo base_url('user/submiteditfotoktp/'.$id_user); ?>" enctype="multipart/form-data" method="post">
				          <input type="file" name="userfile" required/>
				          <input class="uploadfotoktp-button" type="submit" name="submit-upload-foto-ktp-button" value="Upload">
				        </form>
							</div>
							</div>
						</div>
					<?php }else{ } ?>

	        <h5>Alamat</h5>
	        <p><?php echo $alamat ?></p>

	        <h5>Nomor Telepon</h5>
	        <p><?php echo $nomor_hp ?></p>

	        <h5>E-mail</h5>
	        <p><?php echo $email ?></p>
	    </div>
		</div>


    <footer>
      <?php include 'footer.php';?>
    </footer>

		<script type="text/javascript">
		//modal
		var gModal = document.getElementById("galeriModal");
		// button
		var ugBtn = document.getElementById("uploadGaleriBtn");
		// x
		var gspan = document.getElementsByClassName("galericlose")[0];
		//UPLOAD IMAGE GALERY MODAL
		ugBtn.onclick = function() {
			// modal.style.display = "none";
			gModal.style.display = "block";

			// When the user clicks anywhere outside of the modal, close it
			window.onclick = function(ugevent) {
				if (ugevent.target == gModal) {
				gModal.style.display = "none";
				}
			}
		}
		gspan.onclick = function() {
			gModal.style.display = "none";
		}

		//-------------------------------------------------//
		var ebModal = document.getElementById("editbiodataModal");
		var ebBtn = document.getElementById("editbiodataBtn");
		var ebspan = document.getElementsByClassName("editbiodataclose")[0];

		//UPLOAD IMAGE GALERY MODAL
		ebBtn.onclick = function() {
			ebModal.style.display = "block";
			window.onclick = function(ebevent) {
				if (ebevent.target == ebModal) {
				ebModal.style.display = "none";
				}
			}
		}
		ebspan.onclick = function() {
			ebModal.style.display = "none";
		}
		//-------------------------------------------------------//

		var ufkModal = document.getElementById("uploadfotoktpModal");
		var ufkBtn = document.getElementById("uploadfotoktpBtn");
		var ufkspan = document.getElementsByClassName("uploadfotoktpclose")[0];

		//UPLOAD IMAGE GALERY MODAL
		ufkBtn.onclick = function() {
			ufkModal.style.display = "block";
			window.onclick = function(ufkevent) {
				if (ufkevent.target == ufkModal) {
				ufkModal.style.display = "none";
				}
			}
		}
		ufkspan.onclick = function() {
			ufkModal.style.display = "none";
		}

		//-------------------------------------------------//
		//PREVIEW FILE SEBELUM DIUPLOAD
		function previewGaleriUpload(){
			document.getElementById("preview-galeri-before-upload").style.display = "block";
			var oFReader = new FileReader();

			oFReader.readAsDataURL(document.getElementById("fotoprofilupload").files[0]);
			oFReader.onload = function(oFREvent){
				document.getElementById("preview-galeri-before-upload").src = oFREvent.target.result;
			};
		};


		</script>
  </body>
</html>
