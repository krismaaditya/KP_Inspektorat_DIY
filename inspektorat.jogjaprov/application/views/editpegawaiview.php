<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>JANCOK</title>
    <link rel="stylesheet" href="<?php echo base_url()?>/css/struktur-organisasi.css">
  </head>
  <body>
    <div class="editPegawaiModal-body">
      <?php if (count($pegawai)): ?>
        <?php foreach($pegawai as $row):?>
      <form class="editp" id="editpegawaiform" action="<?php echo base_url('struktur_organisasi/edit/'.$row->id_pegawai); ?>" enctype="multipart/form-data" method="post">
        <img id="edit-foto-pegawai-preview-before-upload" class="edit-foto-pegawai-preview" src="<?php echo base_url()?>uploads/foto_profil/pejabat_struktural/<?php echo $row->foto_pegawai ?>" alt="">

        <label for="userfile">Ganti Foto Pegawai</label>
        <input type="file" id="editfotofile" name="userfile" onchange="previewEditFoto()"/>

        <label for="edit-nik-pegawai">NIK<span class="wajib_diisi">*</span></label>
        <input class="data-edit-pegawai" type="number" name="edit-nik-pegawai" required value="<?php echo $row->nik_pegawai ?>">

        <label for="edit-nama-pegawai">Nama Pegawai<span class="wajib_diisi">*</span></label>
        <input class="data-edit-pegawai" type="text" name="edit-nama-pegawai" required value="<?php echo $row->nama_pegawai ?>">

        <label for="edit-jabatan-pegawai">Jabatan Pegawai<span class="wajib_diisi">*</span></label>
        <select class="data-edit-pegawai readonly-data" name="edit-jabatan-pegawai" readonly>
          <option value="<?php echo $row->id_jabatan ?>"><?php echo $row->nama_jabatan ?></option>
        </select>

        <input class="edit-pegawai-button" type="submit" name="submit-edit-pegawai-button" value="simpan">
      </form>
    <?php endforeach; ?>
  <?php endif ?>
    </div>
  </body>
</html>
