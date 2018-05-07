<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Struktur Organisasi</title>
    <link rel="stylesheet" href="<?php echo base_url()?>/css/struktur-organisasi.css">
  </head>
  <body>
    <header>
      <?php include 'header.php'; ?>
    </header>

    <nav>
      <?php include 'nav.php'; ?>
    </nav>

    <section>
      <h3>STRUKTUR ORGANISASI</h3>
      <button id="editPegawaiButton" type="button" name="button"><img class="editpegawai-icon" src="<?php echo base_url()?>/assets/icons/utilities icons/pencil-edit-button.png" alt="">Edit</button>

      <!-- edit pegawai modal pop-up -->
      <div id="artikelModal" class="artikelmodal">
        <div class="artikelModal-content">

          <div class="artikelModal-header">
            <span class="artikelclose">&times;</span>
            <h3>Sunting pegawai dan jabatan</h3>
          </div>

          <div class="editPegawaiModal-body">

            <div class="card-wrapper">
              <img class="card-photo" src="<?php echo base_url()?>assets/photos/pejabat_struktural/Hananto-243x300.jpg" alt="">
                <div class="profile-details">
                 <h5>Inspektur</h5>
                 <hr>
                 <p>Ir. Hananto Hadi Purnomo, M.Sc.</p>
                </div>
            </div>

            <div class="card-wrapper">
              <img class="card-photo" src="<?php echo base_url()?>assets/photos/pejabat_struktural/Hananto-243x300.jpg" alt="">
                <div class="profile-details">
                 <h5>Inspektur</h5>
                 <hr>
                 <p>Ir. Hananto Hadi Purnomo, M.Sc.</p>
                </div>
            </div>

            <div class="card-wrapper">
              <img class="card-photo" src="<?php echo base_url()?>assets/photos/pejabat_struktural/Hananto-243x300.jpg" alt="">
                <div class="profile-details">
                 <h5>Inspektur</h5>
                 <hr>
                 <p>Ir. Hananto Hadi Purnomo, M.Sc.</p>
                </div>
            </div>

            <div class="card-wrapper">
              <img class="card-photo" src="<?php echo base_url()?>assets/photos/pejabat_struktural/Hananto-243x300.jpg" alt="">
                <div class="profile-details">
                 <h5>Inspektur</h5>
                 <hr>
                 <p>Ir. Hananto Hadi Purnomo, M.Sc.</p>
                </div>
            </div>

          </div>
        </div>
      </div>


      <div class="grid-container">

         <div id="grid-item" class="grid-item-inspektur">
           <div class="card-wrapper">
             <img class="card-photo" src="<?php echo base_url()?>assets/photos/pejabat_struktural/Hananto-243x300.jpg" alt="">
               <div class="profile-details">
                <h5>Inspektur</h5>
                <hr>
                <p>Ir. Hananto Hadi Purnomo, M.Sc.</p>
               </div>
             </div>
           </div>

           <!-- <div id="grid-item" class="garis-1">
             <svg height="210" width="500">
               <line x1="0" y1="0" x2="200" y2="200" style="stroke:rgb(255,0,0);stroke-width:2" />
             </svg>
           </div> -->



         <div id="grid-item" class="grid-item-sekretariat">
           <div class="card-wrapper">
             <img class="card-photo" src="<?php echo base_url()?>assets/photos/pejabat_struktural/YudiIsmono-254x300.jpg" alt="">
             <div class="profile-details">
               <h5>Sekretaris</h5>
               <hr>
               <p>Yudi Ismono, S.Sos, M.Acc.</p>
             </div>
           </div>
         </div>


         <div id="grid-item" class="grid-item-jabatanfungsional">Kelompok Jabatan Fungsional</div>

         <div id="grid-item" class="grid-item-keuangan">
           <div class="card-wrapper">
             <img class="card-photo" src="<?php echo base_url()?>assets/photos/pejabat_struktural/norowisnu-254x300.jpg" alt="">
             <div class="profile-details">
               <h5>Kepala Sub Bagian Program dan Keuangan</h5>
               <hr>
               <p>Bernardinus Norowisnu, S.Kom., M.Hum.</p>
             </div>
           </div>
         </div>

         <div id="grid-item" class="grid-item-sub-umum">
           <div class="card-wrapper">
             <img class="card-photo" src="<?php echo base_url()?>assets/photos/pejabat_struktural/LisDwi-254x300.jpg" alt="">
             <div class="profile-details">
               <h5>Kepala Sub Bagian Umum</h5>
               <hr>
               <p>Lis Dwi Rahmawati, S.E.</p>
             </div>
           </div>
         </div>


         <div id="grid-item" class="grid-item-sub-ti">
           <div class="card-wrapper">
             <img class="card-photo" src="<?php echo base_url()?>assets/photos/pejabat_struktural/FaridaE-254x300.jpg" alt="">
             <div class="profile-details">
               <h5>Kepala Subbag Data, TI, Monev</h5>
               <hr>
               <p>Farida Ekawati, S.IP</p>
             </div>
           </div>
         </div>

         <div id="grid-item" class="grid-item-pembantu-pemerintahan">
           <div class="card-wrapper">
             <img class="card-photo" src="<?php //echo base_url()?>assets/photos/pejabat_struktural/EnyHera-254x300.jpg" alt="">
             <div class="profile-details">
               <h5>Irban Bidang Pemerintahan</h5>
               <hr>
               <p>Eny Herawati, S.Pd., M.Si.</p>
             </div>
           </div>
         </div>


         <div id="grid-item" class="grid-item-pembantu-perekonomian">
           <div class="card-wrapper">
             <img class="card-photo" src="<?php //echo base_url()?>assets/photos/pejabat_struktural/EkoP-254x300.jpg" alt="">
             <div class="profile-details">
               <h5>Irban Bidang Perekonomian</h5>
               <hr>
               <p>Ir. Eko Prastono, M.T.</p>
             </div>
           </div>
         </div>

         <div id="grid-item" class="grid-item-pembantu-kesejahteraan">
           <div class="card-wrapper">
             <img class="card-photo" src="<?php //echo base_url()?>assets/photos/pejabat_struktural/MSetiadi-255x300.jpg" alt="">
             <div class="profile-details">
               <h5>Irban Bidang Kesra</h5>
               <hr>
               <p>Muhammad Setiadi, S.Pt., M.Acc.</p>
             </div>
           </div>
         </div>

         <div id="grid-item" class="grid-item-pembantu-sarana">
           <div class="card-wrapper">
             <img class="card-photo" src="<?php //echo base_url()?>assets/photos/pejabat_struktural/SitiH-254x300.jpg" alt="">
             <div class="profile-details">
               <h5>Irban Bidang Sarana dan Prasarana</h5>
               <hr>
               <p>Dra. Siti Haryani, M.Si.</p>
             </div>
           </div>
         </div>

       </div>
      <!-- <div class="so-dropdown">
        <h3 class="jabatanh3">INSPEKTUR</h3>

      </div> -->

       <!-- <div class="bagan-organisasi">
        <img src="<?php //echo base_url()?>assets/photos/pejabat_struktural/BaganOrganisasi.png" alt="">
      </div> -->

    </section>

    <footer>
      <?php include 'footer.php'; ?>
    </footer>

    <script>
          // Get the modal
          var artikelModal = document.getElementById("artikelModal");

          // Get the button that opens the modal
          var nbBtn = document.getElementById("editPegawaiButton");

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
