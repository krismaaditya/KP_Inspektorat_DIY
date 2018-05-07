<?php
?>

<!DOCTYPE html>
<html>
<head>
    <title>Berita</title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/semua_berita.css" />
</head>
<body>
  <header>
    <?php include 'header.php'; ?>
  </header>

  <nav>
    <?php include 'nav.php'; ?>
  </nav>
<div>
  <button id="newBeritaBtn">+ Tulis Berita Baru</button>

  <div id="artikelModal" class="artikelmodal">
  <div class="artikelModal-content">

  <div class="artikelModal-header">
    <span class="artikelclose">&times;</span>
    <h3>Tulis Berita Baru</h3>
  </div>

    <div class="artikelModal-body">
      <!-- <form role="form" class="kotak" action="<?php //echo base_url('semua_berita/tulis'); ?>" method="post"> -->
        <?php echo form_open_multipart('semua_berita/tulis') ?>
        <input type="text" class="judul" name="judul-berita" placeholder="Judul berita" required>

        <label for="berita-category">Kategori</label>
        <select class="category-select" name="berita-category">
           <option value="artikel">Artikel</option>
           <option value="kegiatan">Kegiatan</option>
        </select>

         <label for="isi-berita">ISI ARTIKEL</label>
         <textarea name="isi-berita" class="texteditor"></textarea>

         <label for="gambar">FOTO BERITA</label>
         <!-- <img id="uploadPreview" style="width: 150px; height: 150px;" /><br> -->
         <input type="file" id="userfile" name="userfile" required/>

         <input type="submit" class="simpan-artikel-button" name="simpan" value="SIMPAN">
      <!-- </form> -->
      <?php form_close() ?>
  </div>
  </div>
  </div>

</div>

  <article class="list-berita-wrapper">
    <?php if (count($berita_items)): ?>
      <?php foreach($berita_items as $row):?>
        <a href="<?php echo base_url(); ?>berita/baca/<?php echo $row->id_berita ?>">
          <!-- <div class="berita-div"> -->
            <!-- <div class="berita-div"> -->
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
            <!-- </div> -->
          <!-- </div> -->
        </a>
      <?php endforeach; ?>
    <?php endif ?>
  </article>



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
      var nbBtn = document.getElementById("newBeritaBtn");

      // Get the <span> element that closes the modal
      var artikelspan = document.getElementsByClassName("artikelclose")[0];

      nbBtn.onclick = function() {
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
