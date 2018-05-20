<?php
// $sql = "SELECT * FROM pengaduan ORDER BY waktu_pengaduan ASC LIMIT 10";
// $query = $this->db->query($sql);
$sql1 = "SELECT pengaduan.id_pengaduan, pengaduan.nama_pengadu, pengaduan.judul_pengaduan,
								pengaduan.isi_pengaduan, pengaduan.kategori_pengaduan, pengaduan.waktu_pengaduan, pengaduan.id_statuspengaduan, user.*
								FROM pengaduan, user
								WHERE pengaduan.nama_pengadu=user.id_user
								ORDER BY pengaduan.id_pengaduan DESC";
$query1 = $this->db->query($sql1);

$sql2 = "SELECT * FROM kategoripnd";
$query2 = $this->db->query($sql2);

$sql = "SELECT pengaduan.id_pengaduan, pengaduan.nama_pengadu, pengaduan.judul_pengaduan,
								pengaduan.isi_pengaduan, pengaduan.kategori_pengaduan, pengaduan.waktu_pengaduan, pengaduan.id_statuspengaduan, kategoripnd.id_kategoripnd, kategoripnd.nama_kategoripnd
								FROM pengaduan, kategoripnd
								WHERE pengaduan.kategori_pengaduan=kategoripnd.id_kategoripnd";
$query = $this->db->query($sql);

$isadmin = $this->session->userdata('is_admin');
$is_verified = $this->session->userdata('is_verified');
?>

<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0" charset="utf-8">
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


		<h4 class="pndJudul">FORM LAYANAN PENGADUAN ONLINE INSPEKTORAT DIY</h4>
		<!-- FORM MODAL-->
		<?php
		if (!$id_user) { ?>
		<h3 id="alertpengaduan">Silahkan Login Terlebih Dahulu Untuk Menggunakan Layanan Pengaduan</h3>
		<?php }elseif(!$is_verified) {?>
			<h3 id="alertpengaduan">Silahkan verifikasi diri anda dengan mengupload foto KTP di
				halaman profil anda sebelum Menggunakan Layanan Pengaduan</h3>
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
						<input class ="" type="text" name="judul-pengaduan" maxlength="100" placeholder="Maksimal 100 Karakter" required >
						<label for="pilihan-kategori-pengaduan">Pilih jenis pengaduan</label>
						<select class="kategori-pengaduan" name="pilihan-kategori-pengaduan">
						<?php if ($query2->num_rows() > 0) {
							foreach ($query2->result() as $row2) {	?>
							<option value="<?php echo $row2->id_kategoripnd ?>"><?php echo $row2->nama_kategoripnd ?></option>
						<?php }
							}	?>
						</select>

						<?php if ($isadmin) { ?>
							<button id="tkBtn">+ Jenis Pengaduan</button>

						<?php }
							else {} ?>

						<textarea class="taPengaduan" name="pengaduan-textarea" rows="18" cols="79" maxlength="1050" required placeholder="Tulis Pengaduan Anda. Maksimal 1000 karakter"></textarea>
						<input type="submit" name="submit-pengaduan-button" class="submit-pengaduan-button" value="KIRIM">
					</form>
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
								<h4 id="judullistjenispengaduan">List Jenis Pengaduan</h4>
								<table class="listjenispengaduan">
									<?php $no = $this->uri->segment('3') + 1;
									if ($query2->num_rows() > 0) {
										foreach ($query2->result() as $row) { ?>
									<tr>
										<td><?php echo $no++ ?>.</td>
										<td><?php echo $row->nama_kategoripnd ?></td>
										<td>
											<a class="deletejeniskategoributton" data-modal="deletejeniskategoriModal<?php echo $row->id_kategoripnd?>">Hapus</a></td>
											<div id="deletejeniskategoriModal<?php echo $row->id_kategoripnd?>" class="delete-jeniskategori-modal-window modal">
												<div class="deletejeniskategoriModal-content">
													<div class="deletejeniskategori-header">
														<h4>Hapus Jenis Kategori</h4>
													</div>
													<div class="deletejeniskategoriModal-body">
														<h5>Hapus Jenis Kategori <?php echo $row->nama_kategoripnd?> ? </h5>
															<form role="form" class="hapusjeniskategoriform" action="<?php echo base_url('pengaduan/hapus/'); echo $row->id_kategoripnd ?>" method="post">
															<input class="delete-jeniskategori-button" type="submit" name="submit-delete-jeniskategori-button" value="Ya">
															<input class="deletejkclose" data-modal="deletejeniskategoriModal<?php echo $row->id_kategoripnd?>" type="button" value="Tidak">
														</form>
													</div>
												</div>
											</div>
									</tr>
									<?php }
										} ?>
								</table>
							</div>
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

	  <hr class="hrdivider">



		<section class="listpengaduan-samping">
			<!-- LIST PENGADUAN -->
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
												<b class="sudah-ditindaklanjuti-b">Sudah Ditindak Lanjuti</b>
												<?php
											} else{ ?>
												<i class="belum-ditindaklanjuti-i">Belum Ditindak Lanjuti</i>
											<?php }
											 	?>
										</span>
	                  <span>&bull;</span>

										<span class="username">
											Pelapor : <a href="<?php echo base_url('user/profile/'.$row->id_user);?>"><?php echo $row->nama_user?></a>
										</span>
									</p>
	                <hr id="hre">
								</div>
							</li>
							<?php
						}
					}
					else { ?>
						<h2 id="alertaduankosong">Tidak Ada Aduan</h2>
					<?php }
						?>
						</ul>

		</section>

		<aside class="aside-nav-pengaduan">


			<div class="statistikpnd">
				<h5>Statistik Laporan Pengaduan</h5>
				<?php
					$yow = $query->num_rows();
					if ($query2->num_rows() > 0) {
						foreach ($query2->result() as $key) { ?>
							<p class="p-nama-kategori">
								<?php echo $key->nama_kategoripnd ?>
							</p>
				<?php
					$total=0;
					$persen=0;
					if ($query->num_rows() > 0) {
						foreach ($query->result() as $key2) {
							if ($key2->kategori_pengaduan == $key->id_kategoripnd) {
								$total++;
							}
						}
						$persen = ($total / $yow) * 100;
					}
					?>
					<p>
						Jumlah laporan : <?php echo $total; ?>
						(<?php echo round($persen, 2); ?>%)
					</p>
					<?php
						}
				}
				?>
				<p>
					Total laporan pengaduan : <?php echo $yow; ?> laporan
				</p>

				<div id="piechart"></div>
			</div>

		</aside>







		<footer>
			<?php include 'footer.php' ?>
		</footer>

		<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
		<script type="text/javascript">
			google.charts.load('current', {'packages':['corechart']});
			google.charts.setOnLoadCallback(drawChart);

			function drawChart() {
				var data = google.visualization.arrayToDataTable([
					['namaKategori', 'totalPengaduan'],
					<?php
						$yow = $query->num_rows();
						if ($query2->num_rows() > 0) {
							foreach ($query2->result() as $key) {
								$total=0;
								$persen=0;
								if ($query->num_rows() > 0) {
									foreach ($query->result() as $key2) {
										if ($key2->kategori_pengaduan == $key->id_kategoripnd) {
											$total++;
										}
									}
								} ?>
					['<?php echo $key->nama_kategoripnd ?>', <?php echo $total; ?>],
					<?php
							}
						} ?>
				]);
				var options = {
					title: 'Chart Statistik Laporan Pengaduan berdasarkan jenisnya'
				};
				var chart = new google.visualization.PieChart(document.getElementById('piechart'));
				chart.draw(data, options);
			}
		</script>

		<script>
		var pndmodal = document.getElementById('pndModal');
		var tkmodal = document.getElementById('tkModal');

		var pndbtn = document.getElementById("pndBtn");
		var tkbtn = document.getElementById("tkBtn");

		var pndspan = document.getElementsByClassName("pndclose")[0];
		var tkspan = document.getElementsByClassName("tkclose")[0];

		var deletejkbtn = document.getElementsByClassName("deletejeniskategoributton");
		var tidakBtn = document.getElementsByClassName("deletejkclose");

		pndbtn.onclick = function() {
				pndmodal.style.display = "block";

				window.onclick = function(pndevent) {
						if (pndevent.target == pndmodal) {
								pndmodal.style.display = "none";
						}
				}

				pndspan.onclick = function() {
						pndmodal.style.display = "none";
				}
		}

		tkbtn.onclick = function() {
				tkmodal.style.display = "block";

				window.onclick = function(tkevent) {
						if (tkevent.target == tkmodal) {
								tkmodal.style.display = "none";
						}
				}

				tkspan.onclick = function() {
						tkmodal.style.display = "none";
				}
		}






		for (var i = 0; i < deletejkbtn.length; i++) {
					var deleteBtn = deletejkbtn[i];
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
