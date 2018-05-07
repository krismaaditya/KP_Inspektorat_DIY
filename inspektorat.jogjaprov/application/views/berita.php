<?php
if (count($item_berita)) :
	foreach ($item_berita as $row):
		$id_berita = $row->id_berita;
		$judul_berita = $row->judul_berita;
		$isi_berita = $row->isi_berita;
		$waktu_berita = $row->waktu_berita;
		$gambar_berita = $row->gambar_berita;
		$kategori_berita = $row->kategori_berita;
		$penulis_berita = $row->penulis_berita;
		$nama_user = $row->nama_user;
	endforeach;
endif;
//select KOMENTAR
$sql1 = "SELECT komentar.id_komentar, komentar.id_user, komentar.id_berita,
								komentar.isi_komentar, komentar.waktu_komentar, user.nama_user
								FROM komentar, user
								WHERE komentar.id_user = user.id_user AND komentar.id_berita = $id_berita
								ORDER BY komentar.waktu_komentar
								";

$query1 = $this->db->query($sql1);
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
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
      <span id="kategori"><a href="#"><?php  ?></a></span>
      <h1><?php echo $judul_berita ?></h1>
      <span><i class="fa fa-calendar"></i><a href="#"><?php echo $waktu_berita ?></a>&ensp;</span>
      <span><i class="fa fa-user"></i><a href="#">oleh <?php echo $nama_user ?></a>&ensp;</span>
      <span><i class="fa fa-comments"></i><a href="#">jumlah_Komentar</a></span>
      <div class="gambar">
        <img class="gambar_detail_berita" src="<?php echo base_url(); ?>uploads/berita/images/<?php echo $gambar_berita ?>"/>
      </div>
      <p>
        <?php echo $isi_berita ?>
      </p>

			<!-- Komentar section -->
      <div class="komentar">
        <h3> Komentar </h3>
          <?php
            if ($query1->num_rows() > 0)
              {
                foreach ($query1->result() as $row) {
                ?>
                  <ul class="daftar_komentar">
                    <li>
                      <article class="komentar_1">
                        <header>
                          <img class="comment-profile-picture-small" src="<?php echo base_url(); ?>assets/icons/ic_account_box_white_48dp_2x.png"/>
                        <ul>
                          <li> <?php echo $row->nama_user; //echo $this->session->userdata('nama_user_komentar');  ?></li>
                          <li> <?php echo $row->waktu_komentar; //echo $this->session->userdata('waktu_komentar');  ?> </li>
                        </ul>
                        </header>
                      <section class="comment-wrapper">
                        <p> <?php echo $row->isi_komentar; //echo $this->session->userdata('isi_komentar'); ?> </p>
                      </section>
                    </article>
                  </li>
                </ul>
                      <?php
                    }
                  }
                  ?>

        <?php
        if (!$id_user) { ?>
        <h2>Silahkan login terlebih dahulu untuk memberikan komentar.</h2>
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

    <div class="samping">
      <aside class="agenda">
        <h4 id="judul_samping"><p id="jdl_Samping_1"> Agenda Hari Ini </p></h4>
          <ul class="daftar">
            <li> Agenda_1 </li>
            <li> Agenda_2 </li>
            <li> Agenda_3 </li>
          </ul>
      </aside>
      <aside class="agenda">
        <h4 id="judul_samping"><p id="jdl_Samping_2"> Postingan Terbaru </p></h4>
          <ul class="daftar">
            <li><a href="#"> Berbagi Mesin Cuci </a></li>
          </ul>
      </aside>
      <aside class="agenda">
        <h4 id="judul_samping"><p id="jdl_Samping_3"> Komentar Terbaru </p></h4>
          <ul class="daftar">
            <li><a href="#">NamaKomen</a>&nbsp;mengomentari&nbsp;<a href="#">JudulPos</a></li>
          </ul>
      </aside>
      <aside class="agenda">
        <h4 id="judul_samping"><p id="jdl_Samping_4"> Lokasi Inspektorat DIY </p></h4>
          <img src="<?php echo base_url(); ?>assets/map_Inspektorat.jpg" width="300 px" height="300 px"/>
      </aside>
    </div>
    <footer> <?php include'footer.php'; ?></footer>
  </body>
</html>
