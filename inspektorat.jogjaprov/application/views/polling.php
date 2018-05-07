<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Polling</title>
  </head>
  <link rel="stylesheet" href="<?php echo base_url(); ?>css/polling.css" />
  <body>
    <header>
			<?php include 'header.php' ?>
		</header>
		<nav>
			<?php include 'nav.php' ?>
		</nav>

    <!-- form polling masyarakat -->
    <section class="sct_Polling">
      <h3 id="h3_Polling">Polling Masyarakat</h3>
      <hr>
      <p>Menurut Anda Website Ini Bagaimana ?</p>
      <form class="" action="index.html" method="post">
        <ul>
          <li>
            <input type="radio" id="radio_1" name="radio" checked>
            <label for="radio_1"><i class="fa fa-smile-o" style="font-size:30px"></i></label>
          </li>
          <li>
            <input type="radio" id="radio_2" name="radio">
            <label for="radio_2"><i class="fa fa-meh-o" style="font-size:30px"></i></label>
          </li>
          <li>
            <input type="radio" id="radio_3" name="radio">
            <label for="radio_3"><i class="fa fa-frown-o" style="font-size:30px"></i></label>
          </li>
        </ul>
      </form>
      <button id="btn_Vote"type="button" name="button">VOTE</button>
    </section>
    <!-- end form polling masyarakat -->

    <footer>
    	<?php include 'footer.php' ?>
    </footer>
  </body>
</html>
