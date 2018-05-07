<?php
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Inspektorat DIY - Visi dan Misi
    </title>
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
  </head>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/visi-misi.css">
  <body>
    <header>
      <?php include'header.php'; ?>
    </header>
    <nav>
      <?php include'nav.php'; ?>
    </nav>
    <div class="berita">
      <h1>Visi dan Misi</h1>
      <!-- <div class="gambar">
        <img class="gambar_detail_berita" src="<?php echo base_url(); ?>uploads/berita/images/<?php echo $this->session->userdata('gambar_berita'); ?>"/>
      </div> -->

      <h3>VISI</h3>
      <p>"Menjadi katalisator pencapaian tujuan dan sasaran strategis Pemerintah Daerah Istimewa Yogyakarta"</p>

      <h4>MISI</h4>
      <p>"Menjamin kualitas pencapaian tujuan dan sasaran strategis Pemerintah Daerah Istimewa Yogyakarta"</p>

      </div>

    <footer> <?php include'footer.php'; ?></footer>
  </body>
</html>
