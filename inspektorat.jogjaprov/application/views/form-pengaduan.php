<?php
// $sql = "SELECT * FROM pengaduan ORDER BY waktu_pengaduan ASC LIMIT 10";
// $query = $this->db->query($sql);
$sql1 = "SELECT pengaduan.id_pengaduan, pengaduan.nama_pengadu, pengaduan.judul_pengaduan,
								pengaduan.isi_pengaduan, pengaduan.kategori_pengaduan, pengaduan.waktu_pengaduan, pengaduan.id_statuspengaduan, user.nama_user
								FROM pengaduan, user
								WHERE pengaduan.nama_pengadu=user.id_user";
$query1 = $this->db->query($sql1);

$sql2 = "SELECT * FROM kategoripnd";
$query2 = $this->db->query($sql2);
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Layanan Pengaduan</title>
	</head>
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/form-pengaduan.css" />
	<body>
		<header>
			<?php include 'header.php' ?>
		</header>
		<nav>
			<?php include 'nav.php' ?>
		</nav>
		<h2 id="pndJudul">FORM LAYANAN PENGADUAN ONLINE INSPEKTORAT DIY</h2>
    <!-- <h3>List Pengaduan</h3> -->

    <?php
    if (!$id_user) { ?>
    <h3 id="alertpengaduan">Silahkan Login Terlebih Dahulu Untuk Menggunakan Layanan Pengaduan</h3>

    <?php } else { ?>
		<button id="pndBtn">Form Pengaduan</button>
		<div id="pndModal" class="pndmodal">
			<div class="pndmodal-content">
				<div class="pndmodal-header">
					<span class="pndclose">&times;</span>
					<h2>Form Pengaduan</h2>
				</div>
			<div class="pndmodal-body">
				<div class="tulispengaduan">
					<h3>TULIS PENGADUAN ANDA</h3>
					<form class="pengaduan-form" action="<?php echo base_url('index.php/pengaduan/tulispengaduan'); ?>" method="post">
						<label for="judul-pengaduan">Judul</label>
						<input class ="" type="text" name="judul-pengaduan" required >
						<label for="pilihan-kategori-pengaduan">Pilih jenis pengaduan</label>
						<select class="kategori-pengaduan" name="pilihan-kategori-pengaduan">
						<?php if ($query2->num_rows() > 0) {
							foreach ($query2->result() as $row2) {	?>
							<option value="<?php echo $row2->id_kategoripnd ?>"><?php echo $row2->nama_kategoripnd ?></option>
						<?php }
							}	?>
						</select>
						<button id="tkBtn">+ Jenis Pengaduan</button>
						<textarea class="taPengaduan" name="pengaduan-textarea" rows="18" cols="79" required placeholder="Tulis Pengaduan Anda . ."></textarea>
						<input type="submit" name="submit-pengaduan-button" class="submit-pengaduan-button" value="KIRIM">
					</form>
				</div>
				<!-- form isi tkBtn Jenis Pengaduan -->
				<div id="tkModal" class="tkmodal">
					<div class="tkmodal-content">
						<div class="tkmodal-header">
							<span class="tkclose">&times;</span>
							<h2>Tambah Jenis Pengaduan</h2>
						</div>
						<div class="tkmodal-body">
							<form class="tambahjenis-form" action="<?php echo base_url('pengaduan/tambahkategoripengaduan'); ?>" method="post">
								<input class ="tambah-jnspengaduan" type="text" name="tambahnama_kategoripnd" placeholder="Masukkan Jenis Pengaduan" required>
								<input type="submit" name="submit-tambahjnspengaduan-button" class="submit-tambahjnspengaduan-button" value="TAMBAH">
							</form>
							<hr>
							<h4>List Jenis Pengaduan</h4>
						</div>
					</div>
				</div>
				<div class="informasipengadu">
					<h3 id="infoprof">INFORMASI PROFIL</h3>
					<h4>NAMA : <?php echo $this->session->userdata('nama_user'); ?></h4>
					<h4>EMAIL : <?php echo $this->session->userdata('email'); ?></h4>
				</div>
			</div>
			</div>
		</div>
    <?php } ?>

		<div class="listpengaduan-samping">
			<div class="list-samping">
				<div id="list-wrapper">
					<ul id=list-ul>
						<?php
						if ($query1->num_rows() > 0)
						{
							foreach ($query1->result() as $row) {?>
						<li>
							<div class="wrapper">
								<!-- <a href="#"> -->
								<h3 class="content-title"><?php echo $row->judul_pengaduan ?></h3>
								<!-- </a> -->
									<p class="content-body">
										<?php echo $row->isi_pengaduan?>
									</p>
									<a class="baca_Lengkap" href="<?php echo base_url(); ?>c_detail_pengaduan/selengkapnya/<?php echo $row->id_pengaduan;?>">Info Selengkapnya</a>
								<p class="content-detail">
									<span class="tanggal"><?php echo $row->waktu_pengaduan?></span>
                  <span>&bull;</span>
									<span class="comment">
										<?php if ($row->id_statuspengaduan > 0) {?>
											<b>Sudah Ditindak Lanjuti</b>
											<?php
										} else{ ?>
											<i>Belum Ditindak Lanjuti</i>
										<?php }
										 	?>
									</span>
                  <span>&bull;</span>
									<span class="username"><?php echo $row->nama_user?></span>
								</p>
                <hr id="hre">
							</div>
						</li>
						<?php
					}
				}
				?>
					</ul>
				</div>
			</div>
		</div>

		<!-- <div class="tab">
			<button class="tablinks" onclick="openForm(event,'register')">Langkah 1 : Pendaftaran</button>
			<button class="tablinks" onclick="openForm(event,'pengaduan')">Langkah 2 : Tulis Pengaduan Anda</button>
			<button class="tablinks" onclick="openForm(event,'selesai')">Selesai</button>
		</div> -->

		<footer>
			<?php include 'footer.php' ?>
		</footer>
		<script>
		var pndmodal = document.getElementById('pndModal');
		var tkmodal = document.getElementById('tkModal');

		var pndbtn = document.getElementById("pndBtn");
		var tkbtn = document.getElementById("tkBtn");

		var pndspan = document.getElementsByClassName("pndclose")[0];
		var tkspan = document.getElementsByClassName("tkclose")[0];

		pndbtn.onclick = function() {
				pndmodal.style.display = "block";
		}
		tkbtn.onclick = function() {
				tkmodal.style.display = "block";
		}

		pndspan.onclick = function() {
				pndmodal.style.display = "none";
		}
		window.onclick = function(pndevent) {
				if (pndevent.target == pndmodal) {
						pndmodal.style.display = "none";
				}
		}
		tkspan.onclick = function() {
				tkmodal.style.display = "none";
		}
		window.onclick = function(tkevent) {
				if (tkevent.target == tkmodal) {
						tkmodal.style.display = "none";
				}
		}

		</script>
</body>
</html>
