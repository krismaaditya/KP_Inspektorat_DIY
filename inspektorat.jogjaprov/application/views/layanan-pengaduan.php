<!DOCTYPE html>
<html>
<head>
  <title>form pengaduan via web</title>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/form-style.css">
</head>
<body>

	<h1>FORM PENGISIAN PENGADUAN MELALUI WEB</h1>
	<div class="form-wrapper">
		<div class="left-form">
      <form class="biodata-form" action="" method="post">
        <label>Nama</label>
        <input type="text" class="form-control" placeholder="Nama" name="nama">

        <label>Tanggal Lahir</label>
        <input type="text" class="form-control" placeholder="tanggal-lahir" name="tanggal lahir">

        <label>Email</label>
        <input type="text" class="form-control" placeholder="Email" name="Email">

        <label>Alamat</label>
        <input type="text" class="form-control" placeholder="Alamat" name="Alamat">

        <label>Nomor Telepon</label>
        <input type="text" class="form-control" placeholder="Nama" name="nama">
      </form>
    </div>

    <div class="right-form">
      <label>Foto</label>
      <input type="file" name="imageUpload" id="imageUpload" class="hide"/>
      <img src="" id="imagePreview" alt="" class="img-responsive" />

      <textarea name="name" rows="8" cols="60"></textarea>
      <input type="submit" name="" value="Upload">
    </div>

  </div>
</body>
</html>
