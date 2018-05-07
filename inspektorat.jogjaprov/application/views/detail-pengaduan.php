<?php
$id_pengaduan = $this->session->userdata('id_pengaduan');
$sql = "SELECT  pengaduan.id_pengaduan, pengaduan.nama_pengadu, pengaduan.judul_pengaduan,
								pengaduan.isi_pengaduan, pengaduan.kategori_pengaduan, pengaduan.waktu_pengaduan, pengaduan.id_statuspengaduan, user.id_user,
								user.nama_user, kategoripnd.id_kategoripnd, kategoripnd.nama_kategoripnd
								FROM pengaduan, user, kategoripnd
								WHERE pengaduan.nama_pengadu=user.id_user AND pengaduan.kategori_pengaduan=kategoripnd.id_kategoripnd AND
								pengaduan.id_pengaduan=$id_pengaduan";
$query = $this->db->query($sql);

$sqlkmt = "SELECT pengaduan.id_pengaduan, pengaduan.nama_pengadu, pengaduan.judul_pengaduan,
									pengaduan.isi_pengaduan, pengaduan.kategori_pengaduan, pengaduan.waktu_pengaduan, pengaduan.id_statuspengaduan, tindak_lanjut.id_tindaklanjut,
									tindak_lanjut.isi_tindaklanjut, tindak_lanjut.id_pengaduantnt
									FROM pengaduan, tindak_lanjut
									WHERE tindak_lanjut.id_pengaduantnt=$id_pengaduan AND tindak_lanjut.id_pengaduantnt=pengaduan.id_pengaduan";
$querykmt = $this->db->query($sqlkmt);
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Detail Pengaduan</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/detail-pengaduan.css">
  </head>
  <body>
    <header>
			<?php include 'header.php' ?>
		</header>
		<nav>
			<?php include 'nav.php' ?>
		</nav>

		<div class="detailpengaduan">
      <h2 id="juduldetail"><?php echo $this->session->judul_pengaduan?></h2>
      <div class="detailkanan">
        <h3>Laporan :</h3>
        <p id="isidetail"><?php echo $this->session->isi_pengaduan?>
        </p>
      </div>

      <div class="detailkiri">
			<?php if ($query->num_rows() > 0) {
				foreach ($query->result() as $row) {	?>
        <h4>Nama: <?php echo $row->nama_user; ?></h4>
        <h4>Tanggal: <?php echo $row->waktu_pengaduan; ?></h4>
        <h4>Kategori: <?php echo $row->nama_kategoripnd; ?></h4>
				<?php if ($row->id_statuspengaduan > 0) {?>
					<h4>Status: Sudah Ditindak Lanjuti</h4>
					<?php
				} else{ ?>
					<h4>Status: Belum Ditindak Lanjuti</h4>
				<?php }
				 	?>


				<button id="tntBtn">Tindak Lanjut</button>
				<div id="tntModal" class="tntmodal">
				  <div class="tntmodal-content">
				    <div class="tntmodal-header">
				      <span class="tntclose">&times;</span>
				      <h2>Tindak Lanjut Pengaduan</h2>
				    </div>
				    <div class="tntmodal-body">
				      <form class="tindaklanjut-form" action="<?php echo base_url('c_detail_pengaduan/tindaklanjut'); ?>" method="post">
								<textarea class="taTindakLanjut" name="tindakLanjut-textarea" rows="10" cols="10" required placeholder="Tulis Tindak Lanjut Pengaduan. Max 200 Karakter."></textarea>
								<input type="submit" name="submit-tindaklanjut-button" class="submit-tindaklanjut-button" value="KIRIM">
				      </form>
				    </div>
				  </div>
				</div>
			<?php }
				}	?>
      </div>
			<div class="vl">
			</div>
			<div class="detailpndKomentar">
				<h3 id="detailkmt">Komentar :</h3>
				<?php
					if ($querykmt->num_rows() > 0)
						{
							foreach ($querykmt->result() as $rowkmt) { 	?>
					<ul class="daftarDetailpndKomentar">
						<li>
							<article class="artDetailpndKomentar">
								<header>
									<img class="comment-profile-picture-small" src="<?php echo base_url(); ?>assets/icons/ic_account_box_white_48dp_2x.png"/>
								<ul>
									<li> ADMIN </li>
								</ul>
								</header>
							<section class="secDetailpndKomentar">
								<p> <?php echo $rowkmt->isi_tindaklanjut; //echo $this->session->userdata('isi_komentar'); ?> </p>
							</section>
						</article>
					</li>
				</ul>
				<?php	}
					} ?>
			</div>
    </div>

    <footer>
			<?php include 'footer.php' ?>
		</footer>

		<script>
		var tntmodal = document.getElementById('tntModal');
		var tntbtn = document.getElementById("tntBtn");
		var tntspan = document.getElementsByClassName("tntclose")[0];
		tntbtn.onclick = function() {
		    tntmodal.style.display = "block";
		}
		tntspan.onclick = function() {
		    tntmodal.style.display = "none";
		}
		window.onclick = function(tntevent) {
		    if (tntevent.target == tntmodal) {
		        tntmodal.style.display = "none";
		    }
		}
		</script>
  </body>
</html>
