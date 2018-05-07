<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="utf-8">
    <title>Agenda</title>
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
  </head>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/agenda.css">
  <body>
    <header>
      <?php include'header.php'; ?>
    </header>
    <nav>
      <?php include'nav.php'; ?>
    </nav>

    <h3>Tulis, edit atau hapus agenda</h3>

    <div class="wrapper">

      <div class="calendar-div">
        <?php include 'calendar2.php'; ?>
      </div>

      <div class="agenda-div">
        <button id="agendaBtn">+Catat baru</button>

        <!-- FORM TULIS AGENDA MODAL -->
    		<div id="agendaModal" class="agendamodal">
    			<div class="agendaModal-content">

    				<div class="agendaModal-header">
    					<span class="agclose">&times;</span>
    					<h3>Tulis Agenda Baru</h3>
    				</div>

    				<div class="agendaModal-body">
    					<!-- <form class="buku-tamu-form" action="<?php //echo base_url('buku_tamu/catat'); ?>" method="post"> -->
                <?php //echo form_open_multipart('agenda/tulis'); ?>
                <form role="form" class="tulisagendaform" action="<?php echo base_url('agenda/tulis'); ?>" method="post">

                <label for="tanggal-agenda">Tanggal Agenda<span class="wajib_diisi">*</span></label>
    						<input class="data-agenda" type="date" name="tanggal-agenda" required>

    		        <label for="judul-agenda">Judul Agenda<span class="wajib_diisi">*</span></label>
    						<input class="data-agenda" type="text" name="judul-agenda" required>

    		        <label for="rincian-agenda">Rincian<span class="wajib_diisi">*</span></label>
    						<textarea name="rincian-agenda" rows="8" cols="40"></textarea>

    						<input class="submit-agenda-button" type="submit" name="submit-agenda-button" value="SUBMIT">
    					</form>
    				</div>
    			</div>
    		</div>
        <!-- END OF FORM TULIS AGENDA MODAL -->

        <table id="tabel-agenda">
  				<tr>
            <th>No.</th>
  					<th>Tanggal</th>
  					<th>Judul Agenda</th>
  					<th>Rincian Agenda</th>
            <th>Action</th>
  				</tr>
  				<!-- isi -->

          <?php
          $no = $this->uri->segment('3') + 1;
          foreach ($agenda as $key) { ?>
  						<tr>
                <td><?php echo $no++?></td>
  		    			<td><?php echo $key->tanggal ?></td>
  		    			<td><?php echo $key->judul_agenda ?></td>
  		    			<td><?php echo $key->rincian_agenda ?></td>
                <td>

                  <!-- ============================EDIT AGENDA FORM============================= -->
                  <a class="editagopen" data-modal="editagendaModal<?php echo $key->id_agenda?>">Edit</a>

                  <!-- FORM EDIT AGENDA MODAL -->
                  <div id="editagendaModal<?php echo $key->id_agenda?>" class="edit-agenda-modal-window modal">
                    <div class="editagendaModal-content">

                      <div class="editagendaModal-header">
                        <span class="editagclose" data-modal="editagendaModal<?php echo $key->id_agenda?>">&times;</span>
                        <h3>Sunting Agenda</h3>
                      </div>

                      <div class="editagendaModal-body">
                          <form role="form" class="tulisagendaform" action="<?php echo base_url('agenda/edit/'); echo $key->id_agenda ?>" method="post">

                          <label for="edit-tanggal-agenda">Tanggal Agenda<span class="wajib_diisi">*</span></label>
                          <input class="data-agenda" type="date" name="edit-tanggal-agenda" required value="<?php echo $key->tanggal ?>">

                          <label for="edit-judul-agenda">Judul Agenda<span class="wajib_diisi">*</span></label>
                          <input class="data-agenda" type="text" name="edit-judul-agenda" required value="<?php echo $key->judul_agenda ?>">

                          <label for="edit-rincian-agenda">Rincian<span class="wajib_diisi">*</span></label>
                          <textarea name="edit-rincian-agenda" rows="8" cols="40"><?php echo $key->rincian_agenda ?></textarea>

                          <input class="edit-agenda-button" type="submit" name="submit-edit-agenda-button" value="SUBMIT">
                        </form>
                      </div>
                    </div>
                  </div>
                  <!-- END OF FORM EDIT AGENDA MODAL -->

                  |

                  <!-- =====================DELETE AGENDA =======================-->
                  <a class="deleteagopendialogbutton" data-modal="deleteagendaModal<?php echo $key->id_agenda?>">Hapus</a>

                  <!-- ============FORM DELETE AGENDA MODAL ==================== -->
                  <div id="deleteagendaModal<?php echo $key->id_agenda?>" class="edit-agenda-modal-window modal">
                    <div class="deleteagendaModal-content">

                      <div class="editagendaModal-header">
                        <h4>Hapus Agenda</h4>
                      </div>

                      <div class="deleteagendaModal-body">
                        <h5>Apakah anda yakin ingin menghapus agenda pada tanggal <?php echo $key->tanggal ?> : </h5>
                        <h5><?php echo $key->judul_agenda ?> ? </h5>
                          <form role="form" class="tulisagendaform" action="<?php echo base_url('agenda/hapus/'); echo $key->id_agenda ?>" method="post">
                          <input class="delete-agenda-button" type="submit" name="submit-delete-agenda-button" value="Ya">
                          <input class="deleteagclose" data-modal="deleteagendaModal<?php echo $key->id_agenda?>" type="button" value="Tidak">
                        </form>

                      </div>
                    </div>
                  </div>
                  <!-- END OF FORM DELETE AGENDA MODAL DIALOG-->

  		  			</tr>
  						<?php } ?>

  			</table>



      </div>

      <div class="agenda-pagination">
        <?php echo $this->pagination->create_links(); ?>
      </div>

    </div>

    <footer> <?php include'footer.php'; ?></footer>
    <script>
    	// Get the modal
    	var agmodal = document.getElementById('agendaModal');
    	// Get the button that opens the modal
    	var agbtn = document.getElementById("agendaBtn");

      var editagbtn = document.getElementsByClassName("editagopen");
      var closeagbtn = document.getElementsByClassName("editagclose");

      var deleteagbtn = document.getElementsByClassName("deleteagopendialogbutton");
      var tidakBtn = document.getElementsByClassName("deleteagclose");

      //open edit form button
      for (var i = 0; i < editagbtn.length; i++) {
        var editBtn = editagbtn[i];
        editBtn.addEventListener("click", function(){
          editmodal = document.getElementById(this.dataset.modal);
          editmodal.style.display = "block";

          window.onclick = function(edagevent) {
        		if (edagevent.target == editmodal) {
        		editmodal.style.display = "none";
        		}
        	}

          }, false);
      }

      //button untuk close EDIT form
      for (var i = 0; i < closeagbtn.length; i++) {
        var closeBtn = closeagbtn[i];
        closeBtn.addEventListener("click", function(){
          var editmodal = document.getElementById(this.dataset.modal);
          editmodal.style.display = "none";
          }, false);
      }

      //open DELETE form button
      for (var i = 0; i < deleteagbtn.length; i++) {
        var deleteBtn = deleteagbtn[i];
        deleteBtn.addEventListener("click", function(){
          deletemodal = document.getElementById(this.dataset.modal);
          deletemodal.style.display = "block";

          window.onclick = function(deagevent) {
        		if (deagevent.target == deletemodal) {
        		deletemodal.style.display = "none";
        		}
        	}

          }, false);
      }

      //button untuk close DELETE form
      for (var i = 0; i < tidakBtn.length; i++) {
        var tdkBtn = tidakBtn[i];
        tdkBtn.addEventListener("click", function(){
          var deletemodal = document.getElementById(this.dataset.modal);
          deletemodal.style.display = "none";
          }, false);
      }


    	// Get the <span> element that closes the modal
    	var agspan = document.getElementsByClassName("agclose")[0];

    	// When the user clicks on the button, open the modal
    	agbtn.onclick = function() {
    		agmodal.style.display = "block";
    	}

    	// When the user clicks on <span> (x), close the modal
    	agspan.onclick = function() {
    		agmodal.style.display = "none";
    	}

    	// When the user clicks anywhere outside of the modal, close it
    	window.onclick = function(agevent) {
    		if (agevent.target == agmodal) {
    		agmodal.style.display = "none";
    		}
    	}
    	</script>
  </body>
</html>
