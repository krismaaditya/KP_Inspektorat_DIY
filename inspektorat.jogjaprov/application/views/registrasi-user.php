<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Registrasi User</title>
  </head>
  <link rel="stylesheet" href="<?php echo base_url(); ?>css/registrasi-user.css" />
  <body>
    <!-- registrasi user -->
    <div class="rgt_User">
      <h2 id="rgt_User">Registrasi User</h2>
      <hr>
      <form class="register-pengaduan-form" action="index.html" method="post">
        <label for="username">Username<span class="wajib_diisi">*</span></label>
        <input type="text" name="username" required>

        <label for="password">Password<span class="wajib_diisi">*</span></label>
        <input type="password" name="password" required>

        <label for="no_KTP">Nomor KTP<span class="wajib_diisi">*</span></label>
        <input type="text" name="no_KTP" required>

        <label for="nama-lengkap">Nama Lengkap<span class="wajib_diisi">*</span></label>
        <input type="text" name="nama-lengkap" required>

        <label for="alamat">Alamat<span class="wajib_diisi">*</span></label>
        <input type="text" name="alamat">

        <label for="telepon">Nomor Telepon<span class="wajib_diisi">*</span></label>
        <input type="text" name="telepon" required>

        <label for="email">E-mail<span class="wajib_diisi">*</span></label>
        <input type="email" name="email" required>

        <input type="submit" name="register-button" value="REGISTER">
      </form>
    </div>
    <!-- End registrasi user -->
  </body>
</html>
