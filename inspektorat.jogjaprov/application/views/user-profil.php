<?php

$id_berita = $this->session->userdata('id_berita');

// $sql = "SELECT * FROM berita ORDER BY id_berita ASC LIMIT 3";
// $query = $this->db->query($sql);

$sql = "SELECT isi_komentar FROM komentar WHERE id_berita = $id_berita";
$query = $this->db->query($sql);
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Inspektorat DIY - <?php echo $this->session->userdata('judul_berita'); ?>
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
      <span id="kategori"><a href="#"><?php echo $this->session->userdata('nama_kategori'); ?></a></span>

      <h1><?php echo $this->session->userdata('judul_berita'); ?></h1>

      <span><i class="fa fa-calendar"></i><a href="#"><?php echo $this->session->userdata('waktu_berita'); ?></a>&ensp;</span>
      <span><i class="fa fa-user"></i><a href="#">oleh Admin</a>&ensp;</span>
      <span><i class="fa fa-comments"></i><a href="#">jumlah_Komentar</a></span>
      <div class="gambar">
        <img class="gambar_detail_berita" src="<?php echo base_url(); ?>uploads/berita/images/<?php echo $this->session->userdata('gambar_berita'); ?>"/>
      </div>
      <p>
        <?php echo $this->session->userdata('isi_berita'); ?>
      </p>
      <div class="komentar">
        <h3> Komentar </h3>
          <?php
            // $sql = "SELECT * FROM berita ORDER BY id_berita ASC LIMIT 3";
            // $query = $this->db->query($sql);
            if ($query->num_rows() > 0)
              {
                foreach ($query->result() as $row) {?>
                  <ul class="daftar_komentar">
                    <li>
                      <article class="komentar_1">
                        <header>
                          <img src="<?php echo base_url(); ?>assets/berita1.jpg" width="74px" height="74px"/>
                        <ul>
                          <li> nama_Komentator </li>
                          <li> tanggal_Komentar </li>
                        </ul>
                      </header>
                      <section>
                        <p> <?php echo $row->isi_komentar; ?> </p>
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
        <form class="pos_komentar" action="<?php echo base_url('komentar/tulis'); ?>" method="post">
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
