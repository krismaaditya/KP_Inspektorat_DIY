<?php
$is_loggedin = $this->session->userdata('logged_in');
$is_an_admin = $this->session->userdata('is_admin');
?>
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Galeri Inspektorat DIY</title>
  <link rel="stylesheet" href="<?php echo base_url(); ?>css/galeri.css" />
</head>
<body>
  <header>
    <?php include 'header.php'; ?>
  </header>

  <nav>
    <?php include 'nav.php'; ?>
  </nav>

  <h4 class="h4berita">GALERI INSPEKTORAT DIY</h4>
  <hr class="hrdivider">

  <?php if ($is_loggedin) { ?>
  <?php if ($is_an_admin) { ?>
  <button id="uploadGaleriBtn">+ Upload file galeri</button>

  <div id="galeriModal" class="galerimodal">
    <div class="galeriModal-content">

    <div class="galeriModal-header">
      <span class="galericlose">&times;</span>
      <h3>Upload file Galeri</h3>
    </div>

    <div class="galeriModal-body">
      <!-- form tambah pegawai -->
      <form class="upgaleri" id="uploadfilegaleriform" action="<?php echo base_url('galeri/upload'); ?>" enctype="multipart/form-data" method="post">
        <img id="preview-galeri-before-upload" alt="preview akan ditampilkan di sini setelah anda memilih file">

        <label>Upload File ('.jpg' | '.jpeg' | '.png')</label>
        <input type="file" id="fileupload" name="userfile[]" required multiple onchange="previewGaleriUpload()"/>

        <label for="gallery-description">Deskripsi</label>
        <textarea class="txtareaDesc" name="gallery-description" placeholder="beri deskripsi tentang foto ini..."></textarea>

        <input class="upload-galeri-button" type="submit" name="submit-upload-galeri-button" value="upload">
      </form>
    </div>
    </div>
  </div>
  <?php } else { ?>
  <?php } } else { } ?>

  <div class="list-galeri-wrapper">
    <!-- row -->
    <div class="row">
      <?php $num_row = 0; if (count($galeri)): ?>
      <?php foreach($galeri as $row): $num_row++; ?>



        <!-- column -->
        <div class="column">
          <?php if ($is_loggedin) { ?>
          <?php if ($is_an_admin) { ?>
            <div class="galeri-options-container">
              <a class="galeri-options-button" data-galerioption="galeriOptionsDropdown<?php echo $row->id_file ?>">&hellip;</a>
              <div class="galeri-options" id="galeriOptionsDropdown<?php echo $row->id_file ?>">
                <a class="galeri-edit-option-link" data-editgaleri="editgaleriModal<?php echo $row->id_file?>">Edit</a>
                <a class="galeri-delete-option-link" href="<?php echo base_url('galeri/hapus/'); echo $row->id_file ?>">Hapus</a>
              </div>
            </div>
            <!-- FORM EDIT CAPTION GALERI MODAL -->
            <div id="editgaleriModal<?php echo $row->id_file?>" class="edit-galeri-modal-window modal">
              <div class="editgaleriModal-content">
                <div class="editgaleriModal-header">
                  <span class="editegclose" data-editgaleri="editgaleriModal<?php echo $row->id_file?>">&times;</span>
                  <h3>Sunting caption pada foto ini</h3>
                </div>
                <div class="editgaleriModal-body">
                    <form role="form" class="editgaleriform" action="<?php echo base_url('galeri/edit/'); echo $row->id_galeri ?>" method="post">

                    <img id="preview-galeri-before-upload" alt="edit-preview" src="<?php echo base_url() ?>uploads/gallery/photos/<?php echo $row->nama_file ?>">

                    <label for="edit-caption-galeri">Caption : </label>
                    <textarea class="txtareaDesc" type="text" name="edit-caption-galeri"><?php echo $row->deskripsi ?></textarea>

                    <input class="upload-galeri-button" type="submit" name="submit-edit-caption-button" value="SIMPAN">
                  </form>
                </div>
              </div>
            </div>
            <!-- END OF FORM EDIT AGENDA MODAL -->
          <?php } else { ?>
          <?php } } else { } ?>

          <img style="width:100%" onclick="openModal();currentSlide(<?php echo $num_row ?>)" class="hover-shadow cursor" src="<?php echo base_url() ?>uploads/gallery/photo-thumbnails/<?php echo $row->nama_file ?>">
        </div>


      <?php endforeach; ?>
      <?php endif ?>
    </div>

    <!-- Preview Galeri Lightbox Modal-->
    <div id="myModal" class="modal">
      <span class="close cursor" onclick="closeModal()">&times;</span>
      <div class="modal-content">
        <?php if (count($galeri)): ?>
        <?php foreach($galeri as $row):?>
          <div class="mySlides">
            <img class="main-image-preview" src="<?php echo base_url() ?>uploads/gallery/photos/<?php echo $row->nama_file ?>" style="width:100%" alt="<?php echo $row->deskripsi ?>">
          </div>
        <?php endforeach; ?>
        <?php endif; ?>

        <!-- Next/previous controls -->
        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
        <a class="next" onclick="plusSlides(1)">&#10095;</a>

        <!-- Caption text -->
        <div class="caption-container">
          <p id="caption"></p>
        </div>
      </div>
    </div>
  </div>

  <footer>
    <?php include 'footer.php'; ?>
  </footer>

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

  <script>
      //modal
      var gModal = document.getElementById("galeriModal");
      // button
      var ugBtn = document.getElementById("uploadGaleriBtn");
      // x
      var gspan = document.getElementsByClassName("galericlose")[0];

      //UPLOAD IMAGE GALERY MODAL
      ugBtn.onclick = function() {
        // modal.style.display = "none";
        gModal.style.display = "block";

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(ugevent) {
          if (ugevent.target == gModal) {
          gModal.style.display = "none";
          }
        }
      }
      gspan.onclick = function() {
        gModal.style.display = "none";
      }

      //PREVIEW FILE SEBELUM DIUPLOAD
      function previewGaleriUpload(){
        document.getElementById("preview-galeri-before-upload").style.display = "block";
        var oFReader = new FileReader();

        oFReader.readAsDataURL(document.getElementById("fileupload").files[0]);
        oFReader.onload = function(oFREvent){
          document.getElementById("preview-galeri-before-upload").src = oFREvent.target.result;
        };
      };

      //FORM EDIT MODAL JAVASCRIPT
      var editgbtn = document.getElementsByClassName("galeri-edit-option-link");
      var closeegbtn = document.getElementsByClassName("editegclose");

      //open edit form button
      for (var i = 0; i < editgbtn.length; i++) {
        var editgBtn = editgbtn[i];
        editgBtn.addEventListener("click", function(){
          editgalerimodal = document.getElementById(this.dataset.editgaleri);
          editgalerimodal.style.display = "block";

          window.onclick = function(edgalevent) {
        		if (edgalevent.target == editgalerimodal) {
        		editgalerimodal.style.display = "none";
        		}
        	}

          }, false);
      }

      //button untuk close EDIT GALERI form
      for (var i = 0; i < closeegbtn.length; i++) {
        var closeegBtn = closeegbtn[i];
        closeegBtn.addEventListener("click", function(){
          var editgalerimodal = document.getElementById(this.dataset.editgaleri);
          editgalerimodal.style.display = "none";
          }, false);
      }

      //PREVIEW IMAGE GALLERY MODAL
      function openModal()
      {
        document.getElementById('myModal').style.display = "block";
      }

      function closeModal() {
        document.getElementById('myModal').style.display = "none";
      }

      var slideIndex = 1;
      showSlides(slideIndex);

      function plusSlides(n) {
        showSlides(slideIndex += n);
      }

      function currentSlide(n) {
        showSlides(slideIndex = n);
      }

      function showSlides(n) {
        var i;
        var slides = document.getElementsByClassName("mySlides");
        var imgdots = document.getElementsByClassName("main-image-preview");

        // var dots = document.getElementsByClassName("demo");
        var captionText = document.getElementById("caption");
        if (n > slides.length) {slideIndex = 1}
        if (n < 1) {slideIndex = slides.length}
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        // for (i = 0; i < dots.length; i++) {
        //     dots[i].className = dots[i].className.replace(" active", "");
        // }
        slides[slideIndex-1].style.display = "block";
        // dots[slideIndex-1].className += " active";
        captionText.innerHTML = imgdots[slideIndex-1].alt;
      }

      //DROPDOWN PILIHAN HAPUS GALERI
      var goBtn = document.getElementsByClassName("galeri-options-button");

			for (var i = 0; i < goBtn.length; i++) {
				var godBtn = goBtn[i];
				godBtn.addEventListener("click", function()
				{
					galerioption = document.getElementById(this.dataset.galerioption);
					galerioption.classList.toggle("show-galeri-options");
          // galerioption.style.display = "block";

          // window.onclick = function(opevent) {
        	// 	if (opevent.target == galerioption) {
        	// 	galerioption.style.display = "none";
        	// 	}
        	// }
				},
				false);
			}
    </script>
</body>
</html>
