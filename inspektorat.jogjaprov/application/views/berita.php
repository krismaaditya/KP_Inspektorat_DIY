<?php
if (count($item_berita)) :
	foreach ($item_berita as $row):
		$id_berita = $row->id_berita;
		$judul_berita = $row->judul_berita;
		$isi_berita = $row->isi_berita;
		$waktu_berita = $row->waktu_berita;
		$gambar_berita = $row->gambar_berita;
		$nama_kategori_berita = $row->nama_kategori;
		$nama_user = $row->nama_user;
	endforeach;
endif;

if (count($jumlah_komentar)) :
	foreach ($jumlah_komentar as $row):
		$n_jumlah_komentar = $row->jumlah_komentar;
	endforeach;
endif;

$is_loggedin = $this->session->userdata('logged_in');
$is_an_admin = $this->session->userdata('is_admin');
$is_verified = $this->session->userdata('is_verified');
?>

<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="utf-8">
    <title>Inspektorat DIY - <?php echo $judul_berita ?>
    </title>
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
  </head>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/berita.css">
  <body>
    <header>
      <?php include'header.php'; ?>
    </header>
    <nav>
      <?php include'nav.php'; ?>
    </nav>
    <div class="berita">

			<?php if ($is_loggedin) { ?>
			<?php if ($is_an_admin) { ?>
				<div class="berita-options-container">
					<a class="berita-options-button" onclick="beritaOptions()">&hellip;</a>
					<div class="berita-options" id="beritaOptionsDropdown">
						<!-- <a class="deletelink" href="#">Edit</a> -->
						<a class="deletelink" href="<?php echo base_url('berita/hapus/'.$id_berita); ?>">Hapus</a>
					</div>
				</div>
			<?php } else { ?>
			<?php } } else { } ?>



      <h1 class="h1-judul-berita"><?php echo $judul_berita ?></h1>
			<hr class="hr-berita-divider">
			<span id="kategori"><a href="#"><?php echo $nama_kategori_berita ?></a></span>
      <span><i class="fa fa-calendar"></i><a href="#"><?php echo $waktu_berita ?></a>&ensp;</span>
      <span><i class="fa fa-user"></i><a href="#">oleh <?php echo $nama_user ?></a>&ensp;</span>
      <span><i class="fa fa-comments"></i><a href="#"><?php echo $n_jumlah_komentar ?> komentar</a></span>
      <div class="gambar">
        <img class="gambar_detail_berita" src="<?php echo base_url(); ?>uploads/berita/images/<?php echo $gambar_berita ?>"/>
      </div>
      <p class="txt-isi-berita"><?php echo $isi_berita ?></p>
			<hr class="hr-berita-divider">

			<!-- Komentar section -->
      <div class="komentar">
				<?php if ($n_jumlah_komentar > 0): ?>
      	<h4> Komentar (<?php echo $n_jumlah_komentar ?>) </h4>
			<?php else: ?>
					<h4> Belum ada komentar</h4>
					<?php endif;  ?>
				<hr class="hr-berita-divider">
        <?php if (count($item_komentar)) :
							foreach ($item_komentar as $row): ?>

							<?php if ($is_loggedin) { ?>
							<?php if ($is_an_admin) { ?>
								<div class="komentar-options-container">
									<a class="komentar-options-button" data-komentaroption="komentarOptionsDropdown<?php echo $row->id_komentar ?>">&hellip;</a>
									<div class="komentar-options" id="komentarOptionsDropdown<?php echo $row->id_komentar ?>">
										<!-- <a class="deletelink" href="#">Edit</a> -->
										<a class="deletekomentarlink" href="<?php echo base_url('komentar/hapus/'); echo $row->id_komentar ?>">Hapus</a>
									</div>
								</div>
							<?php } else { ?>
							<?php } } else { } ?>


							<div class="komen-div-wrapper">
								<ul class="daftar_komentar">
			          	<li>
			            <article class="komentar_1">
			            	<header>
			          			<img class="comment-profile-picture-small" src="<?php echo base_url(); ?>uploads/foto_profil/users/<?php echo $row->foto_profil_user ?>"/>
			                  <ul>
			                  	<li class="nama-komentator-li"><?php echo $row->nama_user; ?></li>
			                    <li class="waktu-komentar-li"><?php echo $row->waktu_komentar; ?></li>
			                  </ul>
			              </header>
			              <section class="comment-wrapper">
			              	<p class="txt-komentar"><?php echo $row->isi_komentar; ?></p>
			              </section>

			            </article>
			          	</li>
			          </ul>
							</div>
							<hr class="hr-comment-divider">

        <?php endforeach;
							endif; ?>

        <?php
        if (!$is_loggedin) { ?>
        <h2>Silahkan login terlebih dahulu untuk memberikan komentar.</h2>
			<?php } elseif (!$is_verified) { ?>
				<h2>Silahkan verifikasi diri anda untuk dapat memberikan komentar dengan mengupload foto selfie anda dengan KTP</h2>
			<?php } else { ?>
        <form class="pos_komentar" action="<?php echo base_url('komentar/tulis/');?><?php echo $id_berita;?>" method="post">
          <ul>
            <li>
              <label for="isi_komentar"> Komentar <span class="wajib_diisi"> * </span></label>
            </li>
            <li>
              <textarea name="isi_komentar" rows="4" cols="38" maxlength="65525"
              required="required" placeholder="Isi komentar anda..."></textarea>
            </li>
            <li>
              <input id="tombol_kirim" type="submit" name="kirim" value="Kirim komentar">
            </li>
          </ul>
        </form>
        <?php } ?>
      </div>
    </div>

    <!-- <div class="samping"> -->
      <aside class="aside-baca-juga">
        <p class="judul-baca-juga">Baca juga</p>
				<!-- BACA JUGA -->
				<?php if (count($item_baca_juga)): ?>
					<?php foreach($item_baca_juga as $row): ?>
						<a href="<?php echo base_url(); ?>berita/baca/<?php echo $row->id_berita ?>">
							<div class="baca-juga-div">
								<img class="baca-juga-thumbnails" src="<?php echo base_url() ?>uploads/berita/images/<?php echo $row->gambar_berita ?>">
								<h5 class="baca-juga-title"><?php echo $row->judul_berita ?></h5>
								<p class="timedate"><?php echo $row->waktu_berita ?></p>
								<p class="tag">Tag : <?php echo $row->nama_kategori ?></p>
							</div>
						</a>
					<?php endforeach; ?>
				<?php endif ?>
      </aside>
    <footer> <?php include'footer.php'; ?></footer>

		<script type="text/javascript">
			function beritaOptions()
			{
			  document.getElementById("beritaOptionsDropdown").classList.toggle("show-berita-options");
			}

			var koBtn = document.getElementsByClassName("komentar-options-button");

			for (var i = 0; i < koBtn.length; i++) {
				var kodBtn = koBtn[i];
				kodBtn.addEventListener("click", function()
				{
					deleteoption = document.getElementById(this.dataset.komentaroption);
					deleteoption.classList.toggle("show-komentar-options");
				},
				false);
			}
		</script>
  </body>
</html>
