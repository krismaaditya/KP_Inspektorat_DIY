<?php
$id_user = $this->session->userdata('id_user');

$is_loggedin = $this->session->userdata('logged_in');
$is_an_admin = $this->session->userdata('is_admin');

?>
<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="utf-8">
    <title></title>
    <!--load jquery & js files-->
    <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery/jquery-3.3.1.min.js" async></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>js/nav.js" async></script>
  </head>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/nav.css">
  <body>

    <nav class="navbar" id="mainNavbar">
      <ul>
        <li class="left-li"><a href="javascript:void(0)" class="main-a burger" onclick="openBurger()">&#9776;</a></li>
        <li class="left-li"><a class="main-a" href="<?php echo base_url();?>">Beranda</a></li>

        <li class="left-li profil-dropdown">
          <a class="main-a profil-dropbtn" href="javascript:void(0)">Profil Inspektorat DIY</a>
          <div class="profil-dropdown-content">
            <a href="<?php echo base_url('landasan_hukum'); ?>">Landasan Hukum</a>
            <a href="<?php echo base_url('struktur_organisasi'); ?>">Struktur Organisasi</a>
            <a href="<?php echo base_url('visi_misi'); ?>">Visi & Misi</a>
            <!-- <a href="#">Sumber Daya</a> -->
            <a href="<?php echo base_url('tugas_jabatan'); ?>">Tugas dan Fungsi</a>
          </div>
        </li>

        <li class="left-li"><a class="main-a" href="<?php echo base_url('semua_berita'); ?>">Berita</a></li>
        <li class="left-li"><a class="main-a" href="<?php echo base_url('galeri'); ?>">Galeri</a></li>
        <?php if ($is_an_admin){ ?>
          <li class="left-li"><a class="main-a" href="<?php echo base_url('buku_tamu'); ?>">Buku Tamu</a></li>
        <?php }else{ }?>
        <li class="left-li"><a class="main-a" href="<?php echo base_url('pengaduan'); ?>">Layanan Pengaduan</a></li>
        <li class="left-li"><a class="main-a" href="<?php echo base_url('download_center'); ?>">Download Center</a></li>

        <?php
        if (!$id_user) { ?>

          <li class="loginmodalbutton"><button id="loginBtn">Log In</button>
            <!-- LOGIN MODAL -->
            <div id="loginModal" class="loginmodal">
              <div class="loginModal-content">

                <div class="loginModal-header">
                  <span class="logclose">&times;</span>
                  <h3>Login</h3>
                </div>

                <div class="loginModal-body">
                  <form role="form" class="loginform">
                    <input class="emailInput" id="email" type="email" name="email" placeholder="E-mail Anda" required>
                    <input class="passwordInput" id="password" type="password" name="password" placeholder="Password Anda" required>
                    <input class="loginButton" id="loginsubmit" type="submit" name="submit" value="Login">
                  </form>
                </div>

                <div id="alert-msg">
                </div>

                <!-- <div class="loginModal-footer">
                  <h3>Inspektorat DIY</h3>
                </div> -->

              </div>
            </div>
          </li>

          <li class="registermodalbutton"><button id="registerBtn">Register</button>
            <!-- REGISTER MODAL -->
            <div id="registerModal" class="registermodal">
              <div class="registerModal-content">

                <div class="registerModal-header">
                  <span class="regclose">&times;</span>
                  <h3>Register</h3>
                </div>

                <div class="registerModal-body">
                  <form role="form" class="registerform" action="<?php echo base_url('user/daftar'); ?>" method="post">
                    <input class="noktpInput" type="number" name="no_ktp" placeholder="Nomor KTP" required>
                    <input class="namaInput" type="text" name="nama_user" placeholder="Nama Lengkap" required>
                    <input class="alamatInput" type="text" name="alamat" placeholder="Alamat" required>
                    <input class="nohpInput" type="number" name="no_hp" placeholder="Nomor Telepon / HP" required>
                    <input class="emailInput" type="email" name="email" placeholder="E-mail" required>
                    <input class="passwordInput" type="password" name="password" placeholder="Password" required>
                    <input class="registerButton" id="regsubmit" type="submit" name="submit" value="Daftar">
                  </form>
                </div>

                <!-- <div class="registerModal-footer">
                  <h3>Inspektorat DIY</h3
                </div> -->

              </div>
            </div>
          </li>
        <?php } else { ?>
          <li class="user-dropdown-container">
            <a class="user-button" onclick="userMenu()">
              <?php echo $this->session->userdata('nama_user'); ?>
              <?php if ($is_an_admin){
                echo "(Admin)";
              }else{

              }?>
            </a>
            <div class="user-dropdown-content" id="userDropdown">
              <a class="user-sub-menu-link" href="<?php echo base_url('user/profile/'); ?><?php echo $id_user ?>">Halaman Profil</a>
              <?php if ($is_an_admin): ?>
                <a class="user-sub-menu-link" href="<?php echo base_url('manajemen_user'); ?>">Manajemen users</a>
              <?php endif; ?>
              <a class="user-sub-menu-link" href="<?php echo base_url('user/logout'); ?>">Log Out</a>
            </div>
          </li>
        <?php } ?>

        <li class="search-dropdown-container">
          <a class="search-dropdown-button" onclick="searchMenu()">
            <img src="<?php echo base_url(); ?>assets/icons/utilities icons/magnifier-tool.png" width="10px" height="10px">
          </a>
            <div class="search-dropdown-content" id="searchDropdown">
              <form class="search-form" action="<?php echo base_url('search')?>" method="get">
                <input class="searchbar" type="text" name="query" placeholder="Cari..">
                <input class="search-button" type="submit" name="" value="Cari">
              </form>
            </div>
        </li>
      </ul>
    </nav>

    <script type="text/javascript">
      var urllogin = "<?php print base_url('user/login'); ?>";
      var urlwelcome = "<?php print base_url('welcome'); ?>";
    </script>

  </body>
</html>
