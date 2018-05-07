<?php
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
              <div class="newsSlides fade">
                <img class="news-img" src="<?php echo base_url() ?>uploads/berita/images/<?php echo $row->gambar_berita ?>">
                <div class="news-caption">
                  <p><?php echo $row->judul_berita ?></p>
                </div>
              </div>
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

      <div class="kegiatan-div">
        <p class="content-title">Kegiatan</p>
      </div>

    </section>


    <!--============== ASIDE ================-->
    <aside class="other-news-div">
      <p class="content-title">Berita Lainnya</p>
      <?php if (count($berita_lainnya_items)): ?>
        <?php foreach($berita_lainnya_items as $row): ?>
          <a href="<?php echo base_url(); ?>berita/baca/<?php echo $row->id_berita ?>">

            <div class="list-berita-div">

                <div class="left-news-div">
                  <img class="other-news-thumbnails" src="<?php echo base_url() ?>uploads/berita/images/<?php echo $row->gambar_berita ?>">
                </div>

                <div class="right-news-div">
                  <p class="other-news-title"><?php echo $row->judul_berita ?></p>
                  <p class="timedate"><?php echo $row->waktu_berita ?></p>
                  <!-- <p class="other-news-caption">Caption berita</p> -->
                </div>
            </div>
          </a>
          <?php
      //   }
      // }
      ?>
    <?php endforeach; ?>
  <?php endif ?>

      <p class="content-title">Kalender & Agenda 2018</p>
      <a class="linkto-edit-agenda" href="<?php echo base_url('agenda'); ?>">EDIT AGENDA</a>

      <div class="calendar-div">
        <?php include 'calendar2.php'; ?>
      </div>

      <p class="content-title">Link terkait</p>

      <a href="http://jogjaprov.go.id/home">
        <div class="link-terkait-div">

          <div class="left-link-div">
            <img class="link-images" src="<?php echo base_url(); ?>assets/profdiy_logo.png" alt="">
          </div>

          <div class="right-link-div">
            <p>PORTAL PEMERINTAHAN DAERAH DAERAH ISTIMEWA YOGYAKARTA</p>
          </div>
        </div>
      </a>

    </aside>

    <footer>
      <?php include 'home-footer.php';?>
    </footer>

<script type="text/javascript">
var slideIndex = 1;
showSlides(slideIndex);

function plusSlide(n)
{
  showSlides(slideIndex += n);
}

function currentSlide(n)
{
  showSlides(slideIndex = n);
}

function showSlides(n) {
    var i;

    var slides = document.getElementsByClassName("newsSlides");
    var dots = document.getElementsByClassName("dot");

    if (n > slides.length) {
      slideIndex = 1
    }

    if (n < 1) {
      slideIndex = slides.length
    }

    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }

    for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace("active", "");
    }

    slides[slideIndex-1].style.display = "block";
    dots[slideIndex-1].className += " active";
    // slideIndex++;
    // if (slideIndex > slides.length) {slideIndex = 1}
    // slides[slideIndex-1].style.display = "block";
    // setTimeout(showSlides, 2000); // Change image every 2 seconds
}

</script>
  </body>
</html>
