-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 20, 2018 at 02:16 PM
-- Server version: 10.1.22-MariaDB
-- PHP Version: 7.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inspektoratdiy`
--

-- --------------------------------------------------------

--
-- Table structure for table `agenda`
--

CREATE TABLE `agenda` (
  `id_agenda` int(10) NOT NULL,
  `tanggal` date NOT NULL,
  `judul_agenda` text NOT NULL,
  `rincian_agenda` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `agenda`
--

INSERT INTO `agenda` (`id_agenda`, `tanggal`, `judul_agenda`, `rincian_agenda`) VALUES
(1, '2018-05-21', 'Selamat datang di Website Inspektorat DIY', '');

-- --------------------------------------------------------

--
-- Table structure for table `berita`
--

CREATE TABLE `berita` (
  `id_berita` int(12) NOT NULL,
  `judul_berita` varchar(250) NOT NULL,
  `isi_berita` text NOT NULL,
  `waktu_berita` datetime NOT NULL,
  `gambar_berita` varchar(100) NOT NULL,
  `kategori_berita` int(2) NOT NULL,
  `penulis_berita` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `berita`
--

INSERT INTO `berita` (`id_berita`, `judul_berita`, `isi_berita`, `waktu_berita`, `gambar_berita`, `kategori_berita`, `penulis_berita`) VALUES
(1, 'Sugeng Rawuh', '<p>Selamat datang di Website Inspektorat Daerah Istimewa Yogyakarta</p>\r\n', '2018-05-18 14:05:16', 'a2fe87cde03eb99d466b66b7d2977716.jpg', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `buku_tamu`
--

CREATE TABLE `buku_tamu` (
  `id_buku_tamu` int(100) NOT NULL,
  `nama_pengunjung` varchar(50) NOT NULL,
  `asal_instansi` varchar(50) NOT NULL,
  `tanggal_kunjungan` date NOT NULL,
  `keperluan_instansi` text NOT NULL,
  `dokumentasi` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `files_galeri`
--

CREATE TABLE `files_galeri` (
  `id_file` int(11) NOT NULL,
  `nama_file` varchar(350) NOT NULL,
  `id_gal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `files_galeri`
--

INSERT INTO `files_galeri` (`id_file`, `nama_file`, `id_gal`) VALUES
(1, '9a759410fa5dad501645b67b87d03bec.jpg', 1),
(2, '76908b3c0a5abf447163e588af0c2007.png', 2);

-- --------------------------------------------------------

--
-- Table structure for table `galeri`
--

CREATE TABLE `galeri` (
  `id_galeri` int(11) NOT NULL,
  `deskripsi` text,
  `waktu_upload` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `galeri`
--

INSERT INTO `galeri` (`id_galeri`, `deskripsi`, `waktu_upload`) VALUES
(1, 'Kantor Inspektorat', '2018-05-19 12:52:31'),
(2, 'Struktur Organisasi', '2018-05-20 07:34:17');

-- --------------------------------------------------------

--
-- Table structure for table `jabatan_pegawai`
--

CREATE TABLE `jabatan_pegawai` (
  `id_jabatan` int(10) NOT NULL,
  `nama_jabatan` varchar(125) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jabatan_pegawai`
--

INSERT INTO `jabatan_pegawai` (`id_jabatan`, `nama_jabatan`) VALUES
(1, 'Inpektur'),
(2, 'Sekretaris'),
(3, 'Kepala Sub Bagian Program dan Keuangan'),
(4, 'Kepala Sub Bagian Umum'),
(5, 'Kepala Subbag Data, TI, Monev'),
(6, 'Irban Bidang Pemerintahan'),
(7, 'Irban Bidang Perekonomian'),
(8, 'Irban Bidang Kesra'),
(9, 'Irban Bidang Sarana dan Prasarana');

-- --------------------------------------------------------

--
-- Table structure for table `kategoripnd`
--

CREATE TABLE `kategoripnd` (
  `id_kategoripnd` int(2) NOT NULL,
  `nama_kategoripnd` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategoripnd`
--

INSERT INTO `kategoripnd` (`id_kategoripnd`, `nama_kategoripnd`) VALUES
(8, 'Pungutan Liar'),
(9, 'Pencucian Uang'),
(10, 'Korupsi');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_berita`
--

CREATE TABLE `kategori_berita` (
  `id_kategori` int(2) NOT NULL,
  `nama_kategori` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori_berita`
--

INSERT INTO `kategori_berita` (`id_kategori`, `nama_kategori`) VALUES
(0, 'Berita'),
(1, 'Kegiatan');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_doc`
--

CREATE TABLE `kategori_doc` (
  `id_kategori_doc` int(12) NOT NULL,
  `nama_kategori_doc` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori_doc`
--

INSERT INTO `kategori_doc` (`id_kategori_doc`, `nama_kategori_doc`) VALUES
(1, 'Dokumen tidak dikategorikan'),
(4, 'Peraturan Daerah'),
(6, 'Peraturan Gubernur DIY'),
(7, 'Format Laporan');

-- --------------------------------------------------------

--
-- Table structure for table `komentar`
--

CREATE TABLE `komentar` (
  `id_komentar` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_berita` int(11) NOT NULL,
  `isi_komentar` varchar(10000) NOT NULL,
  `waktu_komentar` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `komentar`
--

INSERT INTO `komentar` (`id_komentar`, `id_user`, `id_berita`, `isi_komentar`, `waktu_komentar`) VALUES
(1, 1, 1, 'Sugeng rawuh.\r\nIni adalah sebuah komentar.', '2018-05-20 08:30:19'),
(2, 2, 1, 'Website sudah online', '2018-05-20 12:15:02');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` int(10) NOT NULL,
  `nik_pegawai` int(100) NOT NULL,
  `nama_pegawai` varchar(250) NOT NULL,
  `jabatan_pegawai` int(10) NOT NULL,
  `foto_pegawai` varchar(350) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `nik_pegawai`, `nama_pegawai`, `jabatan_pegawai`, `foto_pegawai`) VALUES
(1, 1234, 'Ir. Hananto Hadi Purnomo, M.Sc.', 1, 'd0fd0a803b3420617ff46673c90e2879.jpg'),
(2, 2345, 'Yudi Ismono, S.Sos, M.Acc.', 2, '48a0f206c26679a0f50fb62edbcfb805.jpg'),
(3, 3456, 'Bernardinus Norowisnu, S.Kom., M.Hum.', 3, '0e6151602e02b94a2d933320d304c047.jpg'),
(4, 4567, 'Lis Dwi Rahmawati, S.E.', 4, '386a3206cf0a629c26285e649ee816c7.jpg'),
(5, 5678, 'Farida Ekawati, S.IP', 5, 'a312db6e03149c259cacf9a01c859935.jpg'),
(6, 6789, 'Eny Herawati, S.Pd., M.Si.', 6, '77595f5fbeb4f109645f0d7579c5b2bc.jpg'),
(7, 4343, 'Ir. Eko Prastono, M.T.', 7, 'dbc04eb696c5a0ff700fadc7677c465a.jpg'),
(8, 5555, 'Muhammad Setiadi, S.Pt., M.Acc.', 8, 'dc1d6bb63a6a00777ca186da02d71c45.jpg'),
(9, 7676, 'Dra. Siti Haryani, M.Si.', 9, '5d5f596001f23d645a70dc87283a809b.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `pengaduan`
--

CREATE TABLE `pengaduan` (
  `id_pengaduan` int(11) NOT NULL,
  `nama_pengadu` int(100) NOT NULL,
  `judul_pengaduan` varchar(50) NOT NULL,
  `isi_pengaduan` text NOT NULL,
  `kategori_pengaduan` int(2) NOT NULL,
  `waktu_pengaduan` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_statuspengaduan` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengaduan`
--

INSERT INTO `pengaduan` (`id_pengaduan`, `nama_pengadu`, `judul_pengaduan`, `isi_pengaduan`, `kategori_pengaduan`, `waktu_pengaduan`, `id_statuspengaduan`) VALUES
(1, 1, 'Website sudah online', 'Bisa diakses', 8, '2018-05-19 12:11:58', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tindak_lanjut`
--

CREATE TABLE `tindak_lanjut` (
  `id_tindaklanjut` int(11) NOT NULL,
  `isi_tindaklanjut` text NOT NULL,
  `id_pengaduantnt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tindak_lanjut`
--

INSERT INTO `tindak_lanjut` (`id_tindaklanjut`, `isi_tindaklanjut`, `id_pengaduantnt`) VALUES
(2, 'Selamat', 1);

-- --------------------------------------------------------

--
-- Table structure for table `unduhan`
--

CREATE TABLE `unduhan` (
  `id_dokumen` int(100) NOT NULL,
  `judul_dokumen` varchar(1000) NOT NULL,
  `id_kategori_doc` int(12) DEFAULT '1',
  `deskripsi_dokumen` text NOT NULL,
  `tipe_dokumen` varchar(20) DEFAULT NULL,
  `ukuran_dokumen` varchar(20) DEFAULT NULL,
  `file_unduhan` varchar(350) DEFAULT NULL,
  `url` varchar(350) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `unduhan`
--

INSERT INTO `unduhan` (`id_dokumen`, `judul_dokumen`, `id_kategori_doc`, `deskripsi_dokumen`, `tipe_dokumen`, `ukuran_dokumen`, `file_unduhan`, `url`) VALUES
(2, 'Peraturan Daerah Istimewa Yogyakarta Nomor 3 Tahun 2015', 4, ' Tentang Kelembagaan Pemerintah Daerah Istimewa Yogyakarta', '.pdf', '588.13', 'perdais3-2015.pdf', NULL),
(3, 'Peraturan Gubernur Daerah Istimewa Yogyakarta Nomor 52 Tahun 2015', 6, 'Rincian Tugas dan fungsi Inspektorat', '.pdf', '207.48', 'pergub52-2015.pdf', NULL),
(7, 'Format Laporan', 7, 'Format Laporan Pajak-pajak Pribadi (lp2p)', '.xlsx', '17.2', 'format_lp2p.xlsx', '');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(100) NOT NULL,
  `no_ktp` varchar(100) NOT NULL,
  `nama_user` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` mediumtext NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `foto_profil_user` varchar(350) DEFAULT NULL,
  `foto_ktp_user` varchar(350) DEFAULT NULL,
  `verified` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `no_ktp`, `nama_user`, `alamat`, `no_hp`, `email`, `password`, `status`, `foto_profil_user`, `foto_ktp_user`, `verified`) VALUES
(1, '1234', 'Inspektorat DIY', 'Jl. Cendana No.40, Semaki, Umbulharjo, Kota Yogyakarta, Daerah Istimewa Yogyakarta 55166', '62', 'inspektorat.diy@gmail.com', '$2y$10$ucEDhH34tNmrH2.pd9hkKusgh2Jc0ePsf8DuF7Xjq3vMpZecJadwe', 1, 'a09a9a2bc94a77527371c127f3943a4d.png', NULL, 1),
(2, '019231098281', 'Albertus Krisma Aditya Giovanni', 'Berbah, Sleman', '085701310981', 'krismaaditya@gmail.com', '$2y$10$lwxYXv5kLeu6EacGChQZ2OVGyI2Gnpdh2ZRLwfjWPLpu4Ve/.dH7q', 0, '7f00db85e4b0bd2506c2d579eda8df92.png', '5c505e32cc146c5bc5caeb325aa1eb5c.jpg', 1),
(3, '90120', 'Bambang', 'Sleman', '123', 'bambang@gmail.com', '$2y$10$tJcC4aLWQ65YK.cTk2cJ/uWzaW36tjCeYipN71zY3IQfh3Zf9bRxy', 0, NULL, NULL, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agenda`
--
ALTER TABLE `agenda`
  ADD PRIMARY KEY (`id_agenda`);

--
-- Indexes for table `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id_berita`),
  ADD KEY `kategori_berita_fk_kategori` (`kategori_berita`),
  ADD KEY `penulis_berita_fk_id_user` (`penulis_berita`);

--
-- Indexes for table `buku_tamu`
--
ALTER TABLE `buku_tamu`
  ADD PRIMARY KEY (`id_buku_tamu`);

--
-- Indexes for table `files_galeri`
--
ALTER TABLE `files_galeri`
  ADD PRIMARY KEY (`id_file`),
  ADD KEY `fk_id_gal` (`id_gal`);

--
-- Indexes for table `galeri`
--
ALTER TABLE `galeri`
  ADD PRIMARY KEY (`id_galeri`);

--
-- Indexes for table `jabatan_pegawai`
--
ALTER TABLE `jabatan_pegawai`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indexes for table `kategoripnd`
--
ALTER TABLE `kategoripnd`
  ADD PRIMARY KEY (`id_kategoripnd`);

--
-- Indexes for table `kategori_berita`
--
ALTER TABLE `kategori_berita`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `kategori_doc`
--
ALTER TABLE `kategori_doc`
  ADD PRIMARY KEY (`id_kategori_doc`);

--
-- Indexes for table `komentar`
--
ALTER TABLE `komentar`
  ADD PRIMARY KEY (`id_komentar`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_berita` (`id_berita`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_pegawai`),
  ADD KEY `jabatan_pegawai_fk` (`jabatan_pegawai`);

--
-- Indexes for table `pengaduan`
--
ALTER TABLE `pengaduan`
  ADD PRIMARY KEY (`id_pengaduan`),
  ADD KEY `nama_pengadu` (`nama_pengadu`),
  ADD KEY `kategori_pnd_fk` (`kategori_pengaduan`);

--
-- Indexes for table `tindak_lanjut`
--
ALTER TABLE `tindak_lanjut`
  ADD PRIMARY KEY (`id_tindaklanjut`),
  ADD KEY `id_pengaduantnt` (`id_pengaduantnt`);

--
-- Indexes for table `unduhan`
--
ALTER TABLE `unduhan`
  ADD PRIMARY KEY (`id_dokumen`),
  ADD KEY `id_kategoridoc_fk` (`id_kategori_doc`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`,`no_ktp`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agenda`
--
ALTER TABLE `agenda`
  MODIFY `id_agenda` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `berita`
--
ALTER TABLE `berita`
  MODIFY `id_berita` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `buku_tamu`
--
ALTER TABLE `buku_tamu`
  MODIFY `id_buku_tamu` int(100) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `files_galeri`
--
ALTER TABLE `files_galeri`
  MODIFY `id_file` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `galeri`
--
ALTER TABLE `galeri`
  MODIFY `id_galeri` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `jabatan_pegawai`
--
ALTER TABLE `jabatan_pegawai`
  MODIFY `id_jabatan` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `kategoripnd`
--
ALTER TABLE `kategoripnd`
  MODIFY `id_kategoripnd` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `kategori_doc`
--
ALTER TABLE `kategori_doc`
  MODIFY `id_kategori_doc` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `komentar`
--
ALTER TABLE `komentar`
  MODIFY `id_komentar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id_pegawai` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `pengaduan`
--
ALTER TABLE `pengaduan`
  MODIFY `id_pengaduan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `tindak_lanjut`
--
ALTER TABLE `tindak_lanjut`
  MODIFY `id_tindaklanjut` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `unduhan`
--
ALTER TABLE `unduhan`
  MODIFY `id_dokumen` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `berita`
--
ALTER TABLE `berita`
  ADD CONSTRAINT `kategori_berita_fk_kategori` FOREIGN KEY (`kategori_berita`) REFERENCES `kategori_berita` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `penulis_berita_fk_id_user` FOREIGN KEY (`penulis_berita`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `files_galeri`
--
ALTER TABLE `files_galeri`
  ADD CONSTRAINT `fk_id_gal` FOREIGN KEY (`id_gal`) REFERENCES `galeri` (`id_galeri`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `komentar`
--
ALTER TABLE `komentar`
  ADD CONSTRAINT `komentar_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `komentar_ibfk_2` FOREIGN KEY (`id_berita`) REFERENCES `berita` (`id_berita`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD CONSTRAINT `jabatan_pegawai_fk` FOREIGN KEY (`jabatan_pegawai`) REFERENCES `jabatan_pegawai` (`id_jabatan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pengaduan`
--
ALTER TABLE `pengaduan`
  ADD CONSTRAINT `kategori_pnd_fk` FOREIGN KEY (`kategori_pengaduan`) REFERENCES `kategoripnd` (`id_kategoripnd`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pengaduan_ibfk_1` FOREIGN KEY (`nama_pengadu`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tindak_lanjut`
--
ALTER TABLE `tindak_lanjut`
  ADD CONSTRAINT `tindak_lanjut_ibfk_1` FOREIGN KEY (`id_pengaduantnt`) REFERENCES `pengaduan` (`id_pengaduan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `unduhan`
--
ALTER TABLE `unduhan`
  ADD CONSTRAINT `id_kategoridoc_fk` FOREIGN KEY (`id_kategori_doc`) REFERENCES `kategori_doc` (`id_kategori_doc`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
