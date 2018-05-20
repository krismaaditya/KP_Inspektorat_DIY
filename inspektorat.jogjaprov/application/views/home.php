<?php
$is_loggedin = $this->session->userdata('logged_in');
$is_an_admin = $this->session->userdata('is_admin');
?>
<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="utf-8">
    <title>Inspektorat DIY - Home</title>
  </head>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/home.css">
  <link rel="javascript" href="text/javascript" href="<?php echo base_url(); ?>js/home.js">

  <body>
    <header> <?php include 'header.php'; ?> </header>
    <nav> <?php include 'nav.php'; ?> </nav>
    <section>
      <!-- div berita -->
      <div class="news-div">
        <p class="content-title">Berita Terbaru</p>
        <div class="slideshow-container">

          <?php if (count($berita_terbaru_items)): ?>
            <?php foreach($berita_terbaru_items as $row):?>

              <a href="<?php echo base_url('berita/baca/'.$row->id_berita); ?>">
              <div class="newsSlides fade">
                <img class="news-img" src="<?php echo base_url() ?>uploads/berita/images/<?php echo $row->gambar_berita ?>">
                <div class="news-caption">
                  <h4 class="h4news-caption"><?php echo $row->judul_berita ?></h4>
                </div>
              </div>
              </a>
            <?php endforeach; ?>
          <?php endif ?>

          <a class="prev" onclick="plusSlide(-1)">&#10094;</a>
          <a class="next" onclick="plusSlide(1)">&#10095;</a>

        </div>

        <div class="dot-navigation">
          <span class="dot" onclick="currentSlide(1)"></span>
          <span class="dot" onclick="currentSlide(2)"></span>
          <span class="dot" onclick="currentSlide(3)"></span>
        </div>

      </div>

      <p class="content-title">Kegiatan kami</p>
      <div class="kegiatan-div">


        <!-- KEGIATAN -->
        <?php if (count($kegiatan)): ?>
          <?php foreach($kegiatan as $row): ?>
            <a href="<?php echo base_url(); ?>berita/baca/<?php echo $row->id_berita ?>">
              <div class="list-kegiatan-div">
                <img class="kegiatan-thumbnails" src="<?php echo base_url() ?>uploads/berita/images/<?php echo $row->gambar_berita ?>">
                <h5 class="kegiatan-title"><?php echo $row->judul_berita ?></h5>
                <p class="kegiatantimedate"><?php echo $row->waktu_berita ?></p>
              </div>
            </a>
          <?php endforeach; ?>
        <?php endif ?>
      </div>

    </section>


    <!--============== ASIDE ================-->
    <aside class="other-news-div">
      <p class="content-title">Berita Lainnya</p>

      <!-- BERITA LAINNYA -->
      <?php if (count($berita_lainnya_items)): ?>
        <?php foreach($berita_lainnya_items as $row): ?>
          <a href="<?php echo base_url(); ?>berita/baca/<?php echo $row->id_berita ?>">
            <div class="list-berita-div">
              <img class="other-news-thumbnails" src="<?php echo base_url() ?>uploads/berita/images/<?php echo $row->gambar_berita ?>">
              <h5 class="other-news-title"><?php echo $row->judul_berita ?></h5>
              <p class="timedate"><?php echo $row->waktu_berita ?></p>
            </div>
          </a>
        <?php endforeach; ?>
      <?php endif ?>

      <!-- KALENDER -->
      <div class="calendar-div">
        <p class="content-title">Kalender & Agenda 2018</p>

        <?php if ($is_loggedin) { ?>
  			<?php if ($is_an_admin) { ?>
        <a class="linkto-edit-agenda" href="<?php echo base_url('agenda'); ?>">EDIT AGENDA</a>
        <?php } else { ?>
        <?php } } else { } ?>

        <?php include 'calendar2.php'; ?>
      </div>

      <p class="content-title">Link terkait</p>

      <!-- <div class="link-terkait-div-section"> -->
        <a href="http://jogjaprov.go.id/home">
          <div class="link-terkait-div">
            <img class="link-images" src="<?php echo base_url(); ?>assets/profdiy_logo.png" alt="">
            <p class="plink">PORTAL PEMERINTAHAN DAERAH DAERAH ISTIMEWA YOGYAKARTA</p>
          </div>
        </a>

        <a href="http://dppka.jogjaprov.go.id/">
          <div class="link-terkait-div">
            <img class="link-images" src="<?php echo base_url(); ?>assets/profdiy_logo.png" alt="">
            <p class="plink">DPPKA DAERAH DAERAH ISTIMEWA YOGYAKARTA</p>
          </div>
        </a>
      <!-- </div> -->


    </aside>

    <footer>
      <?php include 'home-footer.php';?>
    </footer>

    <script>

    var slideIndex = 1;
    var timer = null;
    showSlides(slideIndex);

    function plusSlide(n)
    {
      clearTimeout(timer);
      showSlides(slideIndex += n);
    }

    function currentSlide(n)
    {
      clearTimeout(timer);
      showSlides(slideIndex = n);
    }

    function showSlides(n) {
        var i;
        var slides = document.getElementsByClassName("newsSlides");
        var dots = document.getElementsByClassName("dot");

        if (n == undefined){n = ++slideIndex}
        if (n > slides.length) {slideIndex = 1}
        if (n < 1){slideIndex = slides.length}

        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }

        for (i = 0; i < dots.length; i++) {
          dots[i].className = dots[i].className.replace(" active", "");
        }

        slides[slideIndex-1].style.display = "block";
        dots[slideIndex-1].className += " active";
        timer = setTimeout(showSlides, 5000); // Change image every 5 seconds
        // slideIndex++;
        // if (slideIndex > slides.length) {slideIndex = 1}
        // slides[slideIndex-1].style.display = "block";
        // setTimeout(showSlides, 2000); // Change image every 2 seconds
    }
  </script>
</body>
</html>
