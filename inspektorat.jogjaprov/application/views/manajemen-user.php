<?php
$is_loggedin = $this->session->userdata('logged_in');
$is_an_admin = $this->session->userdata('is_admin');
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Manajemen User</title>
	</head>
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/manajemen-user.css" />
	<body>
		<nav>
			<?php include 'nav.php' ?>
		</nav>

    <?php if ($is_loggedin) { ?>
    <?php if ($is_an_admin) { ?>
      <h4>Daftar User Inspektorat</h4>

  		<button id="manuserBtn">+Admin</button>

  		<!-- FORM BUKU TAMU MODAL -->
  		<div id="manuserModal" class="manusermodal">
  			<div class="manuserModal-content">

  				<div class="manuserModal-header">
  					<span class="muclose">&times;</span>
  					<h3>Tambah Admin</h3>
  				</div>

  				<div class="manuserModal-body">
            <form role="form" class="registerform" action="<?php echo base_url('manajemen_user/tambah'); ?>" method="post">
              <input class="noktpInput" type="number" name="no_ktp" placeholder="Nomor KTP" required>
              <input class="namaInput" type="text" name="nama_user" placeholder="Nama Lengkap" required>
              <input class="alamatInput" type="text" name="alamat" placeholder="Alamat" required>
              <input class="nohpInput" type="number" name="no_hp" placeholder="Nomor Telepon / HP" required>
              <input class="emailInput" type="email" name="email" placeholder="E-mail" required>
              <input class="passwordInput" type="password" name="password" placeholder="Password" required>
  						<input class="registrasi-button" type="submit" name="register-button" value="SUBMIT">
  					</form>
  				</div>
  			</div>
  		</div>

			<form class="pencarian-form" action="<?php echo base_url('manajemen_user/cari')?>" method="get">
        <input class="txt-input-cari" type="text" name="query" placeholder="Cari user...">
        <input class="button-cari" type="submit" name="" value="Cari">
      </form>

			<div class="mu-pagination">
        <?php echo $this->pagination->create_links(); ?>
      </div>

  		<div class="table-list-manajemen-user-div">
  			<table>
  				<tr>
            <th>No.</th>
            <th>Nomor KTP</th>
						<th>Foto KTP</th>
  					<th>Nama user</th>
  					<th>Alamat</th>
  					<th>Nomor HP</th>
  					<th>Email</th>
  					<th>Status</th>
						<th>Verifikasi</th>
            <th>Action</th>
  				</tr>
  				<!-- isi -->
  				<?php
          $no = $this->uri->segment('3') + 1;
          foreach ($user as $key) { ?>
  						<tr>
                <td><?php echo $no++?></td>

                <td><?php echo $key->no_ktp ?></td>
								<td>
									<?php if ($key->foto_ktp_user == NULL){ ?>
									<p>Belum ada foto KTP</p>
									<?php }else{ ?>
									<a class="ktp-profile-link" href="<?php echo base_url('./uploads/foto_ktp/users/'.$key->foto_ktp_user); ?>">Lihat foto</a>
									<?php } ?>
								</td>

  		    			<td><a class="mu-profile-link" href="<?php echo base_url('user/profile/'.$key->id_user); ?>"><?php echo $key->nama_user ?></a></td>
  		    			<td><?php echo $key->alamat ?></td>
  		    			<td><?php echo $key->no_hp ?></td>
  							<td><?php echo $key->email ?></td>

								<td><?php if ($key->status == 1) {
                 ?>Admin
                <?php } else {
                  ?>User
                <?php } ?>
								</td>

								<td><?php if ($key->verified == 1) {?>
									<p class="verified-p">Terverifikasi</p>
								<?php }else{ ?>
									<p class="unverified-p">Belum Terverifikasi</p>
								<?php } ?>
								</td>

                <td>
									<?php if ($key->id_user != $this->session->userdata('id_user')) { ?>
									<?php if ($key->verified == 0) {?>

										<a class="verifyopendialogbutton" data-verifymodal="verifyuserModal<?php echo $key->id_user?>">Verifikasi</a>
									<?php }else if ($key->verified == 1){ ?>
										<a class="unverifyopendialogbutton" data-unverifymodal="unverifyuserModal<?php echo $key->id_user?>">UnVerifikasi</a>
									<?php } }else{ } ?>

                  <?php if ($key->id_user != $this->session->userdata('id_user')) { ?>
									<a class="deleteagopendialogbutton" data-modal="deleteagendaModal<?php echo $key->id_user?>">Hapus</a>
                  <?php } else { ?>
										<p>-</p>
                  <?php } ?>
									</td>

									<!-- VERIFY USER MODAL -->
									<?php if ($key->id_user != $this->session->userdata('id_user')) { ?>
									<div id="verifyuserModal<?php echo $key->id_user?>" class="verifyuser-modal-window modal">
                    <div class="verifyuserModal-content">
                      <div class="verifyuserModal-header">
                        <h4>Verifikasi user</h4>
                      </div>
                      <div class="verifyuserModal-body">
                        <h5>Verifikasi user bernama <?php echo $key->nama_user ?> ? </h5>
												<h5>Pastikan user ini sudah mengupload foto selfie dengan ktpnya.</h5>
                          <form role="form" class="verifyuserform" action="<?php echo base_url('manajemen_user/verify/'); echo $key->id_user ?>" method="post">
                          <input class="verifyuser-button" type="submit" name="submit-verifyuser-button" value="Ya">
                          <input class="verifyuserclose" data-verifymodal="verifyuserModal<?php echo $key->id_user?>" type="button" value="Tidak">
                        </form>
                      </div>
                    </div>
                  </div>
								<?php } else { ?>
								<?php } ?>

									<!-- UN-VERIFY USER MODAL -->
									<?php if ($key->id_user != $this->session->userdata('id_user')) { ?>
									<div id="unverifyuserModal<?php echo $key->id_user?>" class="unverifyuser-modal-window modal">
                    <div class="unverifyuserModal-content">
                      <div class="unverifyuserModal-header">
                        <h4>Batal Verifikasi user</h4>
                      </div>
                      <div class="unverifyuserModal-body">
                        <h5>Batal Verifikasi user bernama <?php echo $key->nama_user ?> ? </h5>
                          <form role="form" class="unverifyuserform" action="<?php echo base_url('manajemen_user/unverify/'); echo $key->id_user ?>" method="post">
                          <input class="unverifyuser-button" type="submit" name="submit-unverifyuser-button" value="Ya">
                          <input class="unverifyuserclose" data-unverifymodal="unverifyuserModal<?php echo $key->id_user?>" type="button" value="Tidak">
                        </form>
                      </div>
                    </div>
                  </div>
								<?php } else { ?>
								<?php } ?>

									<!-- DELETE USER MODAL -->
                  <div id="deleteagendaModal<?php echo $key->id_user?>" class="edit-agenda-modal-window modal">
                    <div class="deleteagendaModal-content">
                      <div class="editagendaModal-header">
                        <h4>Hapus User</h4>
                      </div>
                      <div class="deleteagendaModal-body">
                        <h5>Apakah anda yakin ingin menghapus user bernama <?php echo $key->nama_user ?> ? </h5>
												<h5>Anda tidak dapat mengembalikan action ini.</h5>
                          <form role="form" class="tulisagendaform" action="<?php echo base_url('manajemen_user/hapus/'); echo $key->id_user ?>" method="post">
                          <input class="delete-agenda-button" type="submit" name="submit-delete-agenda-button" value="Ya">
                          <input class="deleteagclose" data-modal="deleteagendaModal<?php echo $key->id_user?>" type="button" value="Tidak">
                        </form>
                      </div>
                    </div>
                  </div>

  		  			</tr>
            <?php } ?>
  			</table>
  		</div>


    <?php  } else { ?>
      <h3>Maaf, hanya Admin yang bisa melihat halaman ini.</h3>
    <?php } } else { } ?>


  <footer>
  	<?php include 'footer.php' ?>
  </footer>

<script>
	// Get the modal
	var mumodal = document.getElementById('manuserModal');
	// Get the button that opens the modal
	var mubtn = document.getElementById("manuserBtn");
	// Get the <span> element that closes the modal
	var muspan = document.getElementsByClassName("muclose")[0];
	// When the user clicks on the button, open the modal
	mubtn.onclick = function() {
		// regModal.style.display = "none";
		mumodal.style.display = "block";
	}
	// When the user clicks on <span> (x), close the modal
	muspan.onclick = function() {
		mumodal.style.display = "none";
	}
	// When the user clicks anywhere outside of the modal, close it
	window.onclick = function(muevent) {
		if (muevent.target == mumodal) {
		mumodal.style.display = "none";
		}
	}
	//---------------------------------------------------//
	var vubtn = document.getElementsByClassName("verifyopendialogbutton");
	var tidakVerifyBtn = document.getElementsByClassName("verifyuserclose");
  for (var i = 0; i < vubtn.length; i++) {
        var vuBtn = vubtn[i];
        	vuBtn.addEventListener("click", function(){
          vumodal = document.getElementById(this.dataset.verifymodal);
          vumodal.style.display = "block";

          window.onclick = function(vuevent) {
        		if (vuevent.target == vumodal) {
        		vumodal.style.display = "none";
        		}
        	}
          }, false);
      }

  for (var i = 0; i < tidakVerifyBtn.length; i++) {
    var tvBtn = tidakVerifyBtn[i];
    tvBtn.addEventListener("click", function(){
      var vumodal = document.getElementById(this.dataset.verifymodal);
      vumodal.style.display = "none";
      }, false);
  }

	//---------------------------------------------------//
	var unvubtn = document.getElementsByClassName("unverifyopendialogbutton");
	var tidakUnverifyBtn = document.getElementsByClassName("unverifyuserclose");
  for (var i = 0; i < unvubtn.length; i++) {
        var unvuBtn = unvubtn[i];
        	unvuBtn.addEventListener("click", function(){
          unvumodal = document.getElementById(this.dataset.unverifymodal);
          unvumodal.style.display = "block";

          window.onclick = function(unvuevent) {
        		if (unvuevent.target == unvumodal) {
        		unvumodal.style.display = "none";
        		}
        	}
          }, false);
      }

  for (var i = 0; i < tidakUnverifyBtn.length; i++) {
    var tunvuBtn = tidakUnverifyBtn[i];
    tunvuBtn.addEventListener("click", function(){
      var unvumodal = document.getElementById(this.dataset.unverifymodal);
      unvumodal.style.display = "none";
      }, false);
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
