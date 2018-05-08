-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 08, 2018 at 09:23 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
(6, '2018-05-07', 'Tes after edit', 'Tess setelah diedit gan'),
(8, '2018-05-16', 'Pesta Makan Inspektorat', 'Memperingati 20 tahun Inspektorat DIY'),
(10, '2018-05-12', 'Malam mingguan gan', 'hehe'),
(11, '2018-06-06', 'Jalan jalan ke Bandung', 'hhahaha'),
(12, '2018-06-07', 'Jajajaja', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam mattis malesuada aliquet. Suspendisse potenti. Proin eget aliquet nulla. Duis ut nulla diam. Nulla faucibus in erat a convallis. Nam ut rhoncus enim, id dignissim tellus. Nunc suscipit eu dolor ac accumsan. Etiam tortor lorem, congue a est non, pharetra sollicitudin ipsum. Aenean placerat velit dui, ut facilisis mauris dignissim eget. Suspendisse porttitor, orci varius tincidunt consectetur, nisi arcu varius lacus, ut tempus nulla ex et orci. Quisque porta magna sit amet ultrices molestie. Nam erat nisl, rutrum eget eros maximus, tempor eleifend velit. Suspendisse sit amet interdum odio. \r\nDonec neque sem, suscipit vitae enim a, facilisis dapibus mauris. Proin hendrerit et leo vitae porttitor. In hac habitasse platea dictumst. Fusce lobortis leo id urna convallis elementum. Proin tempus tellus dolor, sit amet tristique mauris pretium non. Vestibulum finibus, justo et sagittis feugiat, magna sem sollicitudin lacus, in porta nisi libero at quam. Sed lacus purus, dictum sed aliquet eget, dignissim et ante. Integer ut porta justo. Donec a eros risus. Cras et sem pellentesque, volutpat est nec, dapibus dui.\r\n');

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
(19, 'Kantor Inspektorat DIT berhasil didirikan', '<p>Isi berita Kantor Inspektorat DIT berhasil didirikan</p>\r\n', '2018-04-28 20:02:25', '58bdfaf4b487a5f43eb05b7652863ff8.jpg', 0, 7),
(20, 'Tugu Gerbang Inspektorat DIY', '<p>Tugu Gerbang Inspektorat DIY ini agak rusak dan waktunya diperbaiki</p>\r\n', '2018-04-28 20:46:59', 'be1514a62ff16a934ad6b8753cbcb106.jpg', 0, 7),
(22, 'Karyawan Inspektorat DIY Berfoto bersama', '<p>Mereka berfoto di halaman depan Kantor dan mengenakan pakaian adat jawa</p>\r\n', '2018-04-28 20:52:37', 'e1aef0a03cc85f2b82557d28db326f0a.png', 0, 7),
(23, 'Laporkan segala bentuk ketidakadilan di sekitar anda!', '<p>Laporkan segala bentuk ketidak adilan di sekitar anda agar hidup anda tenang dengan menghubungi 14022</p>\r\n', '2018-04-28 20:53:52', '7dcc64631ccb9b0178c5ff3c18cfcd3c.png', 0, 7),
(24, 'Tutorial memakan roti sambil merokok', '<p>lihat saja gambar untuk tau gimana caranya</p>\r\n', '2018-04-28 20:54:20', '8fcceeb597a0186aaee657996075d276.PNG', 0, 7),
(25, 'Pria misterius dari Palo Alto', '<p>Tolong hubungi 14022 jika anda menemukan pria ini :&#39;((</p>\r\n', '2018-04-28 20:54:54', '457a0b0e7431a35f5c932cb71e04cdc3.png', 0, 7),
(26, 'Pria ini makan ravioli di taman', '<p>Enak</p>\r\n', '2018-04-28 20:56:27', '0d5c7a1704d11edcda348c5880d3dae6.PNG', 0, 7),
(27, 'Betnov mengalami kecelakaan', '<p>Jidatnya jadi tambah lebar</p>\r\n', '2018-04-28 20:58:50', 'ee43637f7ffb520b3f3f24555542c24e.png', 0, 7),
(28, '>tfw', '<p>niqqa</p>\r\n', '2018-05-08 17:43:38', '77292f15ae888abc32f1e5047290fa42.jpg', 0, 3);

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

--
-- Dumping data for table `buku_tamu`
--

INSERT INTO `buku_tamu` (`id_buku_tamu`, `nama_pengunjung`, `asal_instansi`, `tanggal_kunjungan`, `keperluan_instansi`, `dokumentasi`) VALUES
(20, 'Spoderman', 'Avengers', '2018-04-27', 'Pinjam duit', 'Test_Document.pdf'),
(24, 'Viqi', 'UKDW', '2018-04-27', 'Apa', 'pergub52-2015.pdf'),
(25, 'aa', 'ss', '2018-04-28', 'asd', ''),
(26, 'afaf', 'wew', '2018-04-03', 'rew', ''),
(27, 'cvd', 'qwe', '2018-04-24', 'sex', ''),
(28, 'ert', 'trer', '2018-04-10', 'retetet', ''),
(29, 'Maverick', 'CT', '2018-04-30', 'Pinjam senjata', ''),
(31, 'lalala', 'lalal', '2018-05-02', 'qeqeqe', 'chibi_venom.jpg'),
(32, 'llalal', 'popololol', '2018-05-02', 'eeggg', 'bikini_bottom_apocalypse.jpg'),
(33, 'avava', 'asdasd', '2018-05-02', 'eqq', 'Camper_slayer.png'),
(34, 'vvv', 'asdasd', '2018-05-02', 'asd', 'SAP9_-_FI.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `galeri`
--

CREATE TABLE `galeri` (
  `id_galeri` int(100) NOT NULL,
  `gambar_galeri` blob NOT NULL,
  `keterangan_galeri` text NOT NULL,
  `waktu_galeri` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(2) NOT NULL,
  `nama_kategori` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(0, 'Berita Utama');

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
(5, 'Ehem'),
(6, 'asdasd');

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
(1, 6, 24, 'ah ga work gan, gimana nih', '2018-04-30 14:15:05'),
(2, 6, 24, 'ada cara lain gak gan', '2018-04-30 14:21:02'),
(3, 3, 24, 'KKK : coba rokoknya ditaruh di kedua telinga agan', '2018-04-30 14:26:18'),
(4, 3, 24, 'dan makanannya kalau bisa yang tidak berkuah', '2018-04-30 14:38:21'),
(5, 3, 24, 'dijamin work gan', '2018-04-30 14:38:55'),
(6, 8, 24, 'kalau saya sih work gan, saya makan padang, rokok 1 di telinga, yang lain di hidung', '2018-05-02 07:14:19'),
(7, 3, 23, 'berita macam apa ini', '2018-05-08 04:41:15');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` int(10) NOT NULL,
  `nik_pegawai` int(100) NOT NULL,
  `nama_pegawai` varchar(250) NOT NULL,
  `jabatan_pegawai` int(10) NOT NULL,
  `foto_pegawai` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `nik_pegawai`, `nama_pegawai`, `jabatan_pegawai`, `foto_pegawai`) VALUES
(1, 1234, 'Ir. Hananto Hadi Purnomo, M.Sc.', 1, '3c106032e6e06896de70943c054f3d5b.jpg'),
(2, 2345, 'Yudi Ismono, S.Sos, M.Acc.', 2, 'cf4e673fe65d8dd8ed4854435e3d05f3.jpg'),
(3, 3456, 'Bernardinus Norowisnu, S.Kom., M.Hum.', 3, 'b781b90d0257bf093daf4ce4c510f11a.jpg'),
(4, 4567, 'Lis Dwi Rahmawati, S.E.', 4, 'bc38ba9fcdfe9c3438a41accb9d02b8f.jpg'),
(5, 5678, 'Farida Ekawati, S.IP', 5, '06a9ded7f12bcf000dca9bd8cf0f31e3.jpg'),
(6, 6789, 'Eny Herawati, S.Pd., M.Si.', 6, '933480fa85cc79f950940d45bd3866c7.jpg'),
(7, 7890, 'Ir. Eko Prastono, M.T.', 7, 'b31e8a77dcc4e7d67bcf4b431d217f5d.jpg'),
(8, 8901, 'Muhammad Setiadi, S.Pt., M.Acc.', 8, 'e8dbceddec5233235e45e90e45658ac6.jpg'),
(9, 9012, 'Dra. Siti Haryani, M.Si.', 9, '8ccf69189728f963d68d82917adfd07c.jpg');

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
(11, 3, 'lalala', 'asdasdasd', 6, '2018-05-04 16:18:01', 1);

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
(10, 'sdddddddddddddddd', 11);

-- --------------------------------------------------------

--
-- Table structure for table `unduhan`
--

CREATE TABLE `unduhan` (
  `id_dokumen` int(100) NOT NULL,
  `judul_dokumen` varchar(1000) NOT NULL,
  `deskripsi_dokumen` text NOT NULL,
  `tipe_dokumen` varchar(10) NOT NULL,
  `ukuran_dokumen` varchar(10) NOT NULL,
  `file_unduhan` mediumblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `unduhan`
--

INSERT INTO `unduhan` (`id_dokumen`, `judul_dokumen`, `deskripsi_dokumen`, `tipe_dokumen`, `ukuran_dokumen`, `file_unduhan`) VALUES
(29, 'Dokumen kesekian', 'Untuk testing', '.docx', '13.12', 0x4d6d6d626f705f63686f7264732e646f6378),
(30, 'rerer', 'tttttt', '.docx', '15.32', 0x676f6f645f736869742e646f6378),
(32, 'Landasan Hukum Inspektorat setelah terbitnya Undang Undang Republik Indonesia Nomor 13 Tahun 2012 Tentang Keistimewaan DIY', 'PERATURAN DAERAH ISTIMEWA DAERAH ISTIMEWA YOGYAKARTA NOMOR 3 TAHUN 2015 TENTANG KELEMBAGAAN PEMERINTAH DAERAH DAERAH ISTIMEWA YOGYAKARTA ', '.pdf', '588.13', 0x70657264616973332d32303135312e706466),
(33, 'Landasan Hukum Inspektorat setelah terbitnya Undang Undang Republik Indonesia Nomor 13 Tahun 2012 Tentang Keistimewaan DIY', 'PERATURAN GUBERNUR DAERAH ISTIMEWA YOGYAKARTA NOMOR 52 TAHUN 2015 TENTANG RINCIAN TUGAS DAN FUNGSI INSPEKTORAT', '.pdf', '207.48', 0x70657267756235322d323031352e706466),
(34, 'Judul dokumen', 'Deskripsi dokumen', '.pdf', '588.13', 0x70657264616973332d323031352e706466),
(35, 'Lololo', 'llalala', '.docx', '12.35', 0x546573745f446f63756d656e742e646f6378),
(36, 'Dokumen alien', 'rencana alien menyerang bumi', '.pdf', '82.73', 0x546573745f446f63756d656e742e706466);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(100) NOT NULL,
  `no_ktp` int(100) NOT NULL,
  `nama_user` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `no_ktp`, `nama_user`, `alamat`, `no_hp`, `email`, `password`) VALUES
(3, 1234, 'Bambang', 'UKDW', '69', 'bambang@gmail.com', '$2y$10$vtXjPuAK4FnAPBMbT/PR9eE7u/AfvFAcYd39svEeSl3fNJ1v0Xw6C'),
(4, 12345, 'Hahahihi', 'Entahlah', '12395959', 'haha@yahoo.com', '$2y$10$KqRVRGsRraH.RWQfEmJXJOIDVX416hG6OHQOvUxzYIwZEJuNx.3RK'),
(5, 911241, 'Lalalala', 'AIhsd', '198527', 'lala@mail.com', '$2y$10$VIqwwwD41Ykq2ZIaOdDhmOHsfUjQyp.rTLz/WqVrOWb/611fvkvF.'),
(6, 1810100, 'KKK', 'America', '666', 'kkk@gmail.com', '$2y$10$b8KMQUVJzD..zR4lq5UrD.Jz9IVUPLrtHpCBq2bXdp03BwTVoJqku'),
(7, 1, 'Inspektorat DIY', 'Jl. Cendana No.40, Semaki, Umbulharjo, Kota Yogyakarta, Daerah Istimewa Yogyakarta 55166', '62', 'inspektoratdiy@gmail.com', '$2y$10$UFOqC9IM5XPouQyxE.u9Sua8LPp6Jm1FKmVMERlu0jC7ZTPhiGG86'),
(8, 2134, 'Albertus Krisma Aditya', 'Jl. Cendana No.40, Semaki, Umbulharjo, Kota Yogyakarta, Daerah Istimewa Yogyakarta 55166', '2147483647', 'krismaaditya@gmail.com', '$2y$10$dqz9YoCYmDRAcIRFinWyx.Vv3/gU6Daq2j.Pdc1ncNsRYA/E.fV.2'),
(9, 2147483647, 'Loli', 'Anime', '2147483647', 'loli@gmail.com', '$2y$10$5XXTmU1HbfPFkA8K5aPxnezEaQ7oyaXHOuXWleJrLuhTlBIF76pSu');

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
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `kategoripnd`
--
ALTER TABLE `kategoripnd`
  ADD PRIMARY KEY (`id_kategoripnd`);

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
  ADD KEY `nama_pengadu` (`nama_pengadu`);

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
  ADD PRIMARY KEY (`id_dokumen`);

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
  MODIFY `id_agenda` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `berita`
--
ALTER TABLE `berita`
  MODIFY `id_berita` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `buku_tamu`
--
ALTER TABLE `buku_tamu`
  MODIFY `id_buku_tamu` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `jabatan_pegawai`
--
ALTER TABLE `jabatan_pegawai`
  MODIFY `id_jabatan` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `kategoripnd`
--
ALTER TABLE `kategoripnd`
  MODIFY `id_kategoripnd` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `komentar`
--
ALTER TABLE `komentar`
  MODIFY `id_komentar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id_pegawai` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `pengaduan`
--
ALTER TABLE `pengaduan`
  MODIFY `id_pengaduan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `tindak_lanjut`
--
ALTER TABLE `tindak_lanjut`
  MODIFY `id_tindaklanjut` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `unduhan`
--
ALTER TABLE `unduhan`
  MODIFY `id_dokumen` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `berita`
--
ALTER TABLE `berita`
  ADD CONSTRAINT `kategori_berita_fk_kategori` FOREIGN KEY (`kategori_berita`) REFERENCES `kategori` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `penulis_berita_fk_id_user` FOREIGN KEY (`penulis_berita`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `komentar`
--
ALTER TABLE `komentar`
  ADD CONSTRAINT `komentar_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `komentar_ibfk_2` FOREIGN KEY (`id_berita`) REFERENCES `berita` (`id_berita`) ON DELETE CASCADE;

--
-- Constraints for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD CONSTRAINT `jabatan_pegawai_fk` FOREIGN KEY (`jabatan_pegawai`) REFERENCES `jabatan_pegawai` (`id_jabatan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pengaduan`
--
ALTER TABLE `pengaduan`
  ADD CONSTRAINT `pengaduan_ibfk_1` FOREIGN KEY (`nama_pengadu`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tindak_lanjut`
--
ALTER TABLE `tindak_lanjut`
  ADD CONSTRAINT `tindak_lanjut_ibfk_1` FOREIGN KEY (`id_pengaduantnt`) REFERENCES `pengaduan` (`id_pengaduan`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
