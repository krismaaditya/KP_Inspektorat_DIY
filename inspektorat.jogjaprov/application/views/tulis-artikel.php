<!DOCTYPE html>
<html>
<head>
    <title>Tulis Artikel</title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/tulis-artikel.css" />
</head>
<body>
  <header>
    <?php include 'header.php'; ?>
  </header>

  <nav>
    <?php include 'nav.php'; ?>
  </nav>

  <button id="artikelBtn">Buat Artikel</button>

  <div id="artikelModal" class="artikelmodal">
  <div class="artikelModal-content">

  <div class="artikelModal-header">
    <span class="artikelclose">&times;</span>
    <h3>Buat Artikel</h3>
  </div>

    <div class="artikelModal-body">
      <form role="form" class="kotak">
        <input class="judul" type="text" name="Judulr" placeholder="Judul Artikel" required>
        <label for="article-category">Kategori</label>
        <select class="category-select" name="article-category">
           <option value="artikel">Artikel</option>
           <option value="kegiatan">Kegiatan</option>
        </select>
         <label for="isi-artikel">ISI ARTIKEL</label>
         <textarea name="isi-artikel" class="texteditor"></textarea>
         <label for="gambar">GAMBAR</label>
         <img id="uploadPreview" style="width: 150px; height: 150px;" /><br>
         <input id="uploadImage" type="file" name="path" onchange="PreviewImage();"/>
        <input class="simpan-artikel-button" type="submit" name="simpan" value="SIMPAN">
      </form>
  </div>
  </div>
  </div>


  <div class="list-berita-div">

        <div class="left-news-div">
            <img class="other-news-thumbnails" src="<?php echo base_url()?>assets/images/banner-template00.jpg" alt="">
        </div>

        <div class="right-news-div">
            <p class="other-news-title">agenda</p>
            <p class="timedate">1068</p>
                  <!-- <p class="other-news-caption">Caption berita</p> -->
        </div>

  </div>
  <div class="list-berita-div">

        <div class="left-news-div">
            <img class="other-news-thumbnails" src="<?php echo base_url()?>assets/images/banner-template00.jpg" alt="">
        </div>

        <div class="right-news-div">
            <p class="other-news-title">agenda</p>
            <p class="timedate">1068</p>
                  <!-- <p class="other-news-caption">Caption berita</p> -->
        </div>

  </div>
  <div class="list-berita-div">

        <div class="left-news-div">
            <img class="other-news-thumbnails" src="<?php echo base_url()?>assets/images/banner-template00.jpg" alt="">
        </div>

        <div class="right-news-div">
            <p class="other-news-title">agenda</p>
            <p class="timedate">1068</p>
                  <!-- <p class="other-news-caption">Caption berita</p> -->
        </div>

  </div>



    <!-- panggil jquery -->
<script type="text/javascript" src="<?php echo base_url('js/jquery/jquery-3.1.1.min.js'); ?>"></script>
<!-- panggil ckeditor.js -->
<script type="text/javascript" src="<?php echo base_url('assets/ckeditor/ckeditor.js'); ?>"></script>
<!-- panggil adapter jquery ckeditor -->
<script type="text/javascript" src="<?php echo base_url('assets/ckeditor/adapters/jquery.js'); ?>"></script>
<!-- setup selector -->
<script type="text/javascript">
    $('textarea.texteditor').ckeditor();
</script>

<footer>
  <?php include 'footer.php'; ?>
</footer>

<script>
      // Get the modal
      var artikelModal = document.getElementById("artikelModal");

      // Get the button that opens the modal

      var artikelBtn = document.getElementById("artikelBtn");

      // Get the <span> element that closes the modal
      var artikelspan = document.getElementsByClassName("artikelclose")[0];

      artikelBtn.onclick = function() {
        // modal.style.display = "none";
        artikelModal.style.display = "block";
      }
      artikelspan.onclick = function() {
        artikelModal.style.display = "none";
      }

      // When the user clicks anywhere outside of the modal, close it
      window.onclick = function(event) {
        if (event.target == artikelModal) {
        artikelModal.style.display = "none";
        }
      }
      </script>
</body>
</html>
