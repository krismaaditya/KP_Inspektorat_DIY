<?php
?>
<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="utf-8">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/pencarian.css">
    <title>Hasil pencarian - "<?php echo $katakuncilempar ?>"</title>
  </head>
  <body>
    <header>
      <?php include 'header.php'; ?>
    </header>

    <nav>
      <?php include 'nav.php'; ?>
    </nav>

    <div class="searchresult-div-wrapper">
      <h4>Hasil pencarian untuk "<?php echo $katakuncilempar ?>"</h4>

      <form class="pencarian-form" action="<?php echo base_url('search')?>" method="get">
        <input class="txt-input-cari" type="text" name="query" placeholder="Cari...">
        <input class="button-cari" type="submit" name="" value="Cari">
      </form>

      <div class="pencarian-berita-div">
        <h5 class="result-title">Berita</h5>
        <hr>
        <?php if (count($berita)>0): ?>
          <?php foreach ($berita as $data): ?>
            <a href="<?php echo base_url('berita/baca/'.$data->id_berita) ?>">
            <div class="list-result-div">
              <img class="result-thumbnails" src="<?php echo base_url() ?>uploads/berita/thumbnails/<?php echo $data->gambar_berita ?>">
              <p class="this-result-title"><?php echo $data->judul_berita ?></p>
              <hr class="hrdivider">
              <p class="timedate"><?php echo $data->waktu_berita ?></p>
              <p class="tag-berita">Tag : <?php echo $data->nama_kategori ?></p>
            </div>
            </a>
          <?php endforeach; ?>
          <?php else: ?>
            <p>Berita tidak ditemukan</p>
        <?php endif; ?>
      </div>

      <div class="pencarian-pengaduan-div">
        <h5 class="result-title">Pengaduan</h5>
        <hr class="top-divider">
        <?php if (count($pengaduan)>0): ?>
          <?php foreach ($pengaduan as $data): ?>
            <a href="<?php echo base_url('c_detail_pengaduan/selengkapnya/'.$data->id_pengaduan) ?>">
            <div class="list-result-div">
              <p class="this-result-title"><?php echo $data->judul_pengaduan ?></p>
              <hr class="hrdivider">
              <p class="timedate">Laporan oleh : <?php echo $data->nama_user ?></p>
              <p class="tag-berita">Kategori laporan : <?php echo $data->nama_kategoripnd ?></p>
            </div>
            </a>
          <?php endforeach; ?>
          <?php else: ?>
            <p>Pengaduan tidak ditemukan</p>
        <?php endif; ?>
      </div>

      <div class="pencarian-galeri-div">
        <h5 class="result-title">Galeri</h5>
        <hr>
        <?php if (count($galeri)>0): ?>
          <?php foreach ($galeri as $data): ?>
            <a href="<?php echo base_url('galeri') ?>">
            <div class="list-result-div">
              <img class="result-thumbnails" src="<?php echo base_url() ?>uploads/gallery/photo-thumbnails/<?php echo $data->nama_file ?>">
              <p class="this-result-title"><?php echo $data->deskripsi ?></p>
              <hr class="hrdivider">
              <p class="timedate"><?php echo $data->waktu_upload ?></p>
            </div>
            </a>
          <?php endforeach; ?>
          <?php else: ?>
            <p>Galeri tidak ditemukan</p>
        <?php endif; ?>
      </div>

      <div class="pencarian-user-div">
        <h5 class="result-title">Users</h5>
        <hr>
        <?php if (count($user)>0): ?>
          <?php foreach ($user as $data): ?>
            <a href="<?php echo base_url('user/profile/'.$data->id_user) ?>">
            <div class="list-result-div">
              <img class="result-thumbnails" src="<?php echo base_url() ?>uploads/foto_profil/users/<?php echo $data->foto_profil_user ?>">
              <p class="this-result-title"><?php echo $data->nama_user ?></p>
              <hr class="hrdivider">
              <p class="timedate"><?php echo $data->alamat ?></p>
            </div>
            </a>
          <?php endforeach; ?>
          <?php else: ?>
            <p>Tidak ditemukan user bernama "<?php echo $katakuncilempar ?>"</p>
        <?php endif; ?>
      </div>

    </div>

    <footer>
      <?php include 'footer.php'; ?>
    </footer>

  </body>
</html>
