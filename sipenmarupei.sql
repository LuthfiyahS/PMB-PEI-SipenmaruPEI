-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 07 Jun 2022 pada 15.42
-- Versi server: 10.4.18-MariaDB
-- Versi PHP: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sipenmarupei`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal_kegiatan`
--

CREATE TABLE `jadwal_kegiatan` (
  `id` int(11) NOT NULL,
  `nama_kegiatan` varchar(100) NOT NULL,
  `jenis_kegiatan` varchar(100) NOT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_akhir` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jadwal_kegiatan`
--

INSERT INTO `jadwal_kegiatan` (`id`, `nama_kegiatan`, `jenis_kegiatan`, `tgl_mulai`, `tgl_akhir`) VALUES
(1, 'Jalur Prestasi Khusus', 'Pendaftaran', '2021-11-15', '2022-01-14'),
(2, 'Jalur Prestasi Khusus', 'Wawancara', '2022-01-17', '2022-01-17'),
(3, 'Jalur Prestasi Khusus', 'Pengumuman', '2022-01-28', '2022-01-28'),
(4, 'Jalur Prestasi Khusus', 'Registrasi Ulang', '2022-01-28', '2022-02-11'),
(5, 'Jalur Reguler Gelombang 1', 'Pendaftaran', '2021-11-17', '2022-02-21'),
(6, 'Jalur Reguler Gelombang 1', 'Tes Potensi Akademik dan Wawancara', '2022-02-23', '2022-02-23'),
(7, 'Jalur Reguler Gelombang 1', 'Pengumuman', '2022-03-10', '2022-03-10'),
(8, 'Jalur Reguler Gelombang 1', 'Registrasi Ulang', '2022-03-10', '2022-03-31'),
(9, 'Jalur Reguler Gelombang 2', 'Pendaftaran', '2022-02-24', '2022-03-21'),
(10, 'Jalur Reguler Gelombang 2', 'Tes Potensi Akademik dan Wawancara', '2022-03-23', '2022-03-23'),
(11, 'Jalur Reguler Gelombang 2', 'Pengumuman', '2022-04-07', '2022-04-07'),
(12, 'Jalur Reguler Gelombang 2', 'Registrasi Ulang', '2022-04-30', '2022-04-30'),
(13, 'Jalur Reguler Gelombang 3', 'Pendaftaran', '2022-03-24', '2022-04-18'),
(14, 'Jalur Reguler Gelombang 3', 'Tes Potensi Akademik dan Wawancara', '2022-04-20', '2022-04-20'),
(15, 'Jalur Reguler Gelombang 3', 'Pengumuman', '2022-05-06', '2022-05-06'),
(16, 'Jalur Reguler Gelombang 3', 'Registrasi Ulang', '2022-05-06', '2022-05-30'),
(17, 'Jalur Reguler Gelombang 4', 'Pendaftaran', '2022-04-21', '2022-06-20'),
(18, 'Jalur Reguler Gelombang 4', 'Tes Potensi Akademik dan Wawancara', '2022-06-22', '2022-06-22'),
(19, 'Jalur Reguler Gelombang 4', 'Pengumuman', '2022-07-06', '2022-07-06'),
(20, 'Jalur Reguler Gelombang 4', 'Registrasi Ulang', '2022-07-06', '2022-07-30'),
(21, 'Jalur Reguler Gelombang 5', 'Pendaftaran', '2022-06-23', '2022-07-25'),
(22, 'Jalur Reguler Gelombang 5', 'Tes Potensi Akademik dan Wawancara', '2022-07-27', '2022-07-27'),
(23, 'Jalur Reguler Gelombang 5', 'Pengumuman', '2022-08-10', '2022-08-10'),
(24, 'Jalur Reguler Gelombang 5', 'Registrasi Ulang', '2022-08-10', '2022-08-30'),
(25, 'Jalur Reguler Gelombang 6', 'Pendaftaran', '2022-07-28', '2022-08-22'),
(26, 'Jalur Reguler Gelombang 6', 'Tes Potensi Akademik dan Wawancara', '2022-08-24', '2022-08-24'),
(27, 'Jalur Reguler Gelombang 6', 'Pengumuman', '2022-09-02', '2022-09-02'),
(28, 'Jalur Reguler Gelombang 6', 'Registrasi Ulang', '2022-09-02', '2022-09-30');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` varchar(10) NOT NULL,
  `bukti_pembayaran` varchar(250) DEFAULT NULL,
  `status_pembayaran` varchar(30) NOT NULL,
  `tgl_pembayaran` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_pendaftaran` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `bukti_pembayaran`, `status_pembayaran`, `tgl_pembayaran`, `id_pendaftaran`) VALUES
('PAY0002', 'data pendaftar/202212003/payment-1642474501-banner (2).png', 'Dibayar', '2022-01-12 09:42:23', '202212003'),
('PAY0003', NULL, 'Gratis', '2022-01-12 14:10:52', '202212009'),
('PAY0005', 'data pendaftar/202219005/payment-1642597145-slip6jt.jpg', 'Dibayar', '2022-01-19 03:39:55', '202219005'),
('PAY0006', 'data pendaftar/202220004/payment-1643106286-Friend-Greeting-Card-2.png', 'Dibayar', '2022-01-20 15:44:38', '202220004'),
('PAY0007', 'data pendaftar/202219005/payment-1642597145-slip6jt.jpg', 'Dibayar', '2022-01-20 17:29:28', '202220005'),
('PAY0008', 'data pendaftar/202221006/payment-1642727423-raport.jpg', 'Dibayar', '2022-01-21 01:05:28', '202221006'),
('PAY0009', 'data pendaftar/202225007/payment-1643103808-Friend-Greeting-Card-2.png', 'Dibayar', '2022-01-25 09:37:21', '202225007'),
('PAY0010', 'data pendaftar/202226008/payment-1643211498-slip2jt.png', 'Dibayar', '2022-01-26 15:35:52', '202226008'),
('PAY0011', 'data pendaftar/202201009/payment-1644378380-HasilPengumuman_202202010 (1).pdf', 'Dibayar', '2022-02-01 10:04:03', '202201009'),
('PAY0012', 'data pendaftar/202202010/payment-1643768747-WhatsApp Image 2022-01-28 at 19.14.17.jpeg', 'Dibayar', '2022-02-02 02:19:59', '202202010'),
('PAY0013', 'data pendaftar/202209011/payment-1644398741-raport.jpg', 'Dibayar', '2022-02-09 09:21:07', '202209011');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pendaftaran`
--

CREATE TABLE `pendaftaran` (
  `id_pendaftaran` int(25) NOT NULL,
  `id_user` varchar(15) NOT NULL,
  `nisn` varchar(20) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `nama_siswa` varchar(100) NOT NULL,
  `jenis_kelamin` varchar(25) NOT NULL,
  `pas_foto` varchar(500) NOT NULL,
  `tempat_lahir` varchar(25) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `agama` varchar(25) NOT NULL,
  `alamat` varchar(250) NOT NULL,
  `email` varchar(100) NOT NULL,
  `nohp` varchar(15) NOT NULL,
  `gelombang` varchar(500) NOT NULL,
  `tahun_masuk` year(4) NOT NULL,
  `pil1` varchar(100) NOT NULL,
  `pil2` varchar(100) NOT NULL,
  `nama_ayah` varchar(100) NOT NULL,
  `nama_ibu` varchar(100) NOT NULL,
  `pekerjaan_ayah` varchar(50) NOT NULL,
  `pekerjaan_ibu` varchar(50) NOT NULL,
  `nohp_ayah` varchar(15) NOT NULL,
  `nohp_ibu` varchar(15) NOT NULL,
  `gaji` varchar(50) NOT NULL,
  `tanggungan` int(5) NOT NULL,
  `slip_gaji` varchar(500) NOT NULL,
  `kk` varchar(500) NOT NULL,
  `id_Sekolah` varchar(50) NOT NULL,
  `jurusan` varchar(50) NOT NULL,
  `smt1` double NOT NULL,
  `smt2` double NOT NULL,
  `smt3` double NOT NULL,
  `smt4` double NOT NULL,
  `smt5` double NOT NULL,
  `nilairaport` varchar(500) NOT NULL,
  `ijazah` varchar(500) DEFAULT NULL,
  `prestasi` varchar(250) DEFAULT NULL,
  `status_pendaftaran` varchar(50) NOT NULL,
  `tgl_pendaftaran` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pendaftaran`
--

INSERT INTO `pendaftaran` (`id_pendaftaran`, `id_user`, `nisn`, `nik`, `nama_siswa`, `jenis_kelamin`, `pas_foto`, `tempat_lahir`, `tanggal_lahir`, `agama`, `alamat`, `email`, `nohp`, `gelombang`, `tahun_masuk`, `pil1`, `pil2`, `nama_ayah`, `nama_ibu`, `pekerjaan_ayah`, `pekerjaan_ibu`, `nohp_ayah`, `nohp_ibu`, `gaji`, `tanggungan`, `slip_gaji`, `kk`, `id_Sekolah`, `jurusan`, `smt1`, `smt2`, `smt3`, `smt4`, `smt5`, `nilairaport`, `ijazah`, `prestasi`, `status_pendaftaran`, `tgl_pendaftaran`) VALUES
(202201009, 'USR000005', '3241231232', '464625432324', 'Nopi Rahmawati', 'Laki-laki', 'data pendaftar/202201009/Pasfoto1643709842-IMG_0620.JPG', 'Purwakarta', '2001-11-01', 'Islam', 'Purwakarta', 'nopiraa01@gmail.com', '085759933124', 'Jalur Reguler Gelombang 1', 2022, 'PR004', 'PR004', 'ayahku', 'ibuku', 'Wirausaha', 'PNS', '085759933124', '084348928343', '7.500.000 - 10.000.000', 32, 'data pendaftar/202201009/Slipgaji1643709842-PMB PEI.pdf', 'data pendaftar/202201009/KartuKeluarga1643709842-PMB PEI.pdf', '20217358', 'Agama', 45, 35, 56, 65, 67, 'data pendaftar/202201009/Pasfoto1643709842-PVisual Audio.zip', NULL, NULL, 'Selesai', '2022-02-01 10:04:03'),
(202202010, 'USR000027', '2313123234', '45343412312332', 'salsabila', 'Laki-laki', 'data pendaftar/202202010/Pasfoto1643768398-IMG_0617.JPG', 'purwakarta', '2000-01-01', 'Kristen', '0834657345', 'salsabila@gmail.com', '083236754254', 'Jalur Reguler Gelombang 1', 2022, 'PR003', 'PR003', 'Deris Nuryono Bimo', 'Iis Julaeha', 'Perawat', 'Wirausaha', '0892804837483', '0863254634434', '1.000.000 - 2.500.000', 4, 'data pendaftar/202202010/Slipgaji1643768399-PMB PEI.pdf', 'data pendaftar/202202010/KartuKeluarga1643768399-PMB PEI.pdf', '20217361', 'Agama', 98, 34, 54, 56, 76, 'data pendaftar/202202010/Pasfoto1643768399-1630670290_htmltopdf.zip', NULL, NULL, 'Selesai', '2022-02-02 02:19:59'),
(202209011, 'USR000029', '2313234', '085226236901', 'Rizki Saputri', 'Laki-laki', 'data pendaftar/202209011/Pasfoto1644398467-IMG_0622.JPG', 'purwakarta', '2000-01-01', 'Kong Hu Chu', 'Sampih Kembang Kuning', 'saput@gmail.com', '085226236901', 'Jalur Reguler Gelombang 1', 2022, 'PR004', 'PR002', 'Deris Nuryono Bimo', 'Iis Julaeha', 'Wirausaha', 'Buruh', '085226236901', '085226236901', '5.000.000 - 7.500.000', 7, 'data pendaftar/202209011/Slipgaji1644398467-PMB PEI.pdf', 'data pendaftar/202209011/KartuKeluarga1644398467-PMB PEI.pdf', '20217363', 'Tata Busana', 66, 65, 78, 98, 46, 'data pendaftar/202209011/Pasfoto1644398467-PMB PEI.pdf', NULL, NULL, 'Selesai', '2022-02-09 09:21:07'),
(202212003, 'USR000004', '2947987327295', '085226236901', 'Adila Alaina Risqi', 'Perempuan', 'data pendaftar/202220006/Pasfoto1642695828-IMG_0618.JPG', 'Pemalang', '2001-07-17', 'Islam', 'Sampih Kembang Kuning', 'adilaar17@gmail.com', '085226236901', 'Jalur Reguler Gelombang 1', 2021, 'PR002', 'PR004', 'ayahku', 'ibuku', 'Karyawan Honorer', 'Karyawan BUMN', '085226236901', '085226236901', '5.000.000 - 7.500.000', 3, 'data pendaftar/202220006/Slipgaji1642695828-slip6jt.jpg', 'data pendaftar/202220006/KartuKeluarga1642695828-kk.jpg', '20217363', 'Teknik', 66, 77, 78, 98, 46, 'data pendaftar/202220006/Raport1642695828-raport.jpg', NULL, NULL, 'Selesai', '2022-01-13 03:15:41'),
(202212009, 'USR000006', '7694653456', '085226236901', 'Nurul Aulia Khoerunnisa', 'Perempuan', 'data pendaftar/202220006/Pasfoto1642696049-IMG_0619.JPG', 'Subang', '2000-01-01', 'Hindu', 'Sampih Kembang Kuning', 'naulia@gmail.com', '085226236901', 'Jalur Reguler Gelombang 1', 2021, 'PR004', 'PR001', 'ayahku', 'ibuku', 'PNS', 'PNS', '085226236901', '085226236901', '5.000.000 - 7.500.000', 3, 'data pendaftar/202220006/Slipgaji1642696049-slip6jt.jpg', 'data pendaftar/202220006/KartuKeluarga1642696049-IMG_0619.JPG', '20217357', 'Bahasa', 66, 77, 23, 98, 46, 'data pendaftar/202220006/Raport1642696049-raport.jpg', NULL, NULL, 'Selesai', '2022-01-13 03:15:33'),
(202219005, 'USR000011', '6823847982', '3214011902010002', 'Bagus Bimantoro', 'Laki-laki', 'data pendaftar/202219005/Pasfoto1642563595-IMG_0622.JPG', 'Purwakarta', '2001-02-19', 'Budha', 'Jl Industri Maracang, Maracang. Purwakarta', 'goodbmtr@gmail.com', '085923168191', 'Jalur Reguler Gelombang 1', 2021, 'PR001', 'PR002', 'Deris Nuryono Bimo', 'Iis Julaeha', 'Karyawan Swasta', 'Ibu Rumah Tangga', '087779559303', '081212787815', '7.500.000 - 10.000.000', 2, 'data pendaftar/202219005/Slipgaji1642563595-slip6jt.jpg', 'data pendaftar/202219005/KartuKeluarga1642563595-kk.jpg', '20217357', 'IPA', 95, 87, 78, 98, 88, 'data pendaftar/202219005/Pasfoto1642563595-raport.jpg', NULL, NULL, 'Selesai', '2022-01-19 03:39:55'),
(202220004, 'USR000013', '5868768356', '869887987709', 'Dono Wiyono', 'Laki-laki', 'data pendaftar/202220005/Pasfoto1642693478-IMG_0625.JPG', 'Pemalang', '2000-01-21', 'Islam', 'Sampih Kembang Kuning', 'dono@gmail.com', '085226236901', 'Jalur Reguler Gelombang 1', 2022, 'PR003', 'PR002', 'Deris Nuryono Bimo', 'Iis Julaeha', 'PNS', 'Dokter', '085226236901', '085226236901', '7.500.000 - 10.000.000', 5, 'data pendaftar/202220005/Slipgaji1642693478-slip21jt.jpeg', 'data pendaftar/202220005/KartuKeluarga1642693478-kk.jpg', '20217363', 'Teknik', 66, 77, 78, 98, 80, 'data pendaftar/202220005/Pasfoto1642693478-raport.jpg', NULL, NULL, 'Tidak Sah', '2022-01-20 15:44:38'),
(202220005, 'USR000014', '8768768698', '4576768698954664', 'Andini Oktari', 'Perempuan', 'data pendaftar/202220005/Pasfoto1642699767-IMG_0620.JPG', 'Purwakarta', '2000-10-03', 'Kristen', 'Ceulibadak', 'andini@gmail.com', '08985349584', 'Jalur Reguler Gelombang 1', 2022, 'PR002', 'PR001', 'Deris Nuryono Bimo', 'Iis Julaeha', 'Karyawan Swasta', 'Karyawan BUMD', '085226236901', '085226236901', '5.000.000 - 7.500.000', 7, 'data pendaftar/202220005/Slipgaji1642699767-slip2jt.png', 'data pendaftar/202220005/KartuKeluarga1642699767-kk.jpg', '20217361', 'Tata Boga', 66, 77, 78, 98, 46, 'data pendaftar/202220005/Pasfoto1642699767-raport.jpg', NULL, NULL, 'Selesai', '2022-01-20 17:29:27'),
(202221006, 'USR000015', '2354534534', '464363467548', 'Emiliya Firdaus', 'Perempuan', 'data pendaftar/202221006/Pasfoto1642727128-IMG_0626.JPG', 'Purwakarta', '2000-04-12', 'Islam', 'Simpang', 'emil@gmail.com', '085226236901', 'Jalur Reguler Gelombang 1', 2022, 'PR004', 'PR003', 'Deris Nuryono Bimo', 'Iis Julaeha', 'Wirausaha', 'Wirausaha', '085226236901', '085226236901', '7.500.000 - 10.000.000', 2, 'data pendaftar/202221006/Slipgaji1642727128-slip6jt.jpg', 'data pendaftar/202221006/KartuKeluarga1642727128-kk.jpg', '20217358', 'IPA', 66, 77, 78, 98, 46, 'data pendaftar/202221006/Pasfoto1642727128-raport.jpg', NULL, NULL, 'Selesai', '2022-01-21 01:05:28'),
(202225007, 'USR000020', '12312324213', '1232123', 'niken', 'Perempuan', 'data pendaftar/202225007/Pasfoto1643103440-Friend-Greeting-Card-2.png', 'sfsd', '2000-01-01', 'Budha', 'sdfsdf', 'niken@gmail.com', '232342342123213', 'Jalur Reguler Gelombang 1', 2022, 'PR003', 'PR002', 'ayahku', 'ibuku', 'Karyawan BUMN', 'PNS', '085226236901', '085226236901', '2.500.000 - 5.000.000', 23, 'data pendaftar/202225007/Slipgaji1643103440-#bg visual.png', 'data pendaftar/202225007/KartuKeluarga1643103440-#bg visual.png', '20217361', 'Tata Boga', 546, 667, 78, 98, 46, 'data pendaftar/202225007/Pasfoto1643103440-pencil (1).png', NULL, NULL, 'Selesai', '2022-01-25 09:37:20'),
(202226008, 'USR000024', '24234', '085226236901', 'anandika', 'Laki-laki', 'data pendaftar/202226008/Pasfoto1643211352-IMG_0652.JPG', 'Solo', '2002-02-02', 'Islam', 'Sampih Kembang Kuning', 'anandika@gmail.com', '085226236901', 'Jalur Reguler Gelombang 1', 2022, 'PR004', 'PR001', 'Deris Nuryono Bimo', 'Iis Julaeha', 'Buruh', 'Wirausaha', '085226236901', '085226236901', '7.500.000 - 10.000.000', 2, 'data pendaftar/202226008/Slipgaji1643211352-slip6jt.jpg', 'data pendaftar/202226008/KartuKeluarga1643211352-kk.jpg', '69849092', 'Agama', 345, 65, 78, 98, 46, 'data pendaftar/202226008/Pasfoto1643211352-raport.jpg', NULL, NULL, 'Selesai', '2022-01-26 15:35:52');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengumuman`
--

CREATE TABLE `pengumuman` (
  `id_pengumuman` varchar(15) NOT NULL,
  `id_pendaftaran` int(15) NOT NULL,
  `hasil_seleksi` varchar(100) NOT NULL,
  `prodi_penerima` varchar(100) DEFAULT NULL,
  `nilai_interview` double DEFAULT NULL,
  `nilai_test` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pengumuman`
--

INSERT INTO `pengumuman` (`id_pengumuman`, `id_pendaftaran`, `hasil_seleksi`, `prodi_penerima`, `nilai_interview`, `nilai_test`) VALUES
('ANN002', 202212003, 'LULUS', 'PR002', 95, 45),
('ANN003', 202212009, 'LULUS', 'PR004', 95, 95),
('ANN005', 202219005, 'TIDAK LULUS', 'PR001', 23, 23),
('ANN006', 202220004, 'TIDAK LULUS', 'PR004', 23, 23),
('ANN007', 202220005, 'LULUS', 'PR002', 67, 67),
('ANN008', 202221006, 'LULUS', 'PR002', 95, 95),
('ANN009', 202225007, 'TIDAK LULUS', 'PR003', 88, 78),
('ANN010', 202226008, 'TIDAK LULUS', 'PR004', 33, 33),
('ANN011', 202201009, 'TIDAK LULUS', 'PR002', 9, 9),
('ANN012', 202202010, 'LULUS', 'PR002', 78, 95),
('ANN013', 202209011, 'LULUS', 'PR002', 100, 88);

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `profile_user`
--

CREATE TABLE `profile_user` (
  `Id_user` varchar(15) NOT NULL,
  `Nama` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Foto` varchar(250) DEFAULT NULL,
  `Tempat_lahir` varchar(50) DEFAULT NULL,
  `Tanggal_lahir` date NOT NULL,
  `Gender` varchar(25) DEFAULT NULL,
  `No_Hp` varchar(15) DEFAULT NULL,
  `Alamat` varchar(250) DEFAULT NULL,
  `Instagram` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `profile_user`
--

INSERT INTO `profile_user` (`Id_user`, `Nama`, `Email`, `Foto`, `Tempat_lahir`, `Tanggal_lahir`, `Gender`, `No_Hp`, `Alamat`, `Instagram`) VALUES
('USR000001', 'Luthfiyah Sakinah', 'luthfiyah.sakinah19@gmail.com', 'foto profil/1642312401-logo.png', 'Purwakarta', '2002-07-19', 'Perempuan', '085759933124', 'Jl Kapten Ismail RT 13/ RW 07 Sindangkasih Purwakarta. Jawa Barat 41112', 'piaaasan'),
('USR000003', 'Ayu Siti Rohmah', 'ayustr@gmail.com', 'foto profil/1640255664-logopei.png', 'Purwakarta', '2001-05-23', 'Perempuan', '085759933124', 'Sukatani Purwakarta', 'ayustr'),
('USR000004', 'Adila Alaina Risqi', 'adilaar17@gmail.com', NULL, 'Pemalang', '2001-07-17', 'Perempuan', '086753247234', 'Koloni Indorama', 'rkriris'),
('USR000005', 'Nopi Rahmawati', 'nopiraa01@gmail.com', 'foto profil/1642145117-logo.png', 'Purwakarta', '2001-11-01', 'Laki-laki', '085759933124', 'Purwakarta', 'no.nop'),
('USR000006', 'Nurul Aulia Khoerunnisa', 'naulia@gmail.com', 'foto profil/1642689276-pp.jpg', 'Subang', '2000-01-01', 'Perempuan', '085226236901', 'Perum Bumi Jaya Indah', 'nurulauliakh12'),
('USR000008', 'Dindha Aulia Putri Nurani', 'dindhaapn@gmail.com', NULL, NULL, '2000-01-01', NULL, NULL, NULL, NULL),
('USR000009', 'Annisa Zachry Fauziahh', 'annisazf12@gmail.com', 'foto profil/1642329406-logo.png', NULL, '2000-01-01', 'Laki-laki', '085226236901', NULL, NULL),
('USR000010', 'Nursita Setyawati', 'taasita@gmail.com', NULL, NULL, '2000-01-01', NULL, NULL, NULL, NULL),
('USR000011', 'Bagus Bimantoro', 'goodbmtr@gmail.com', 'foto profil/1643707530-IMG_0622.JPG', 'Purwakarta', '2000-01-01', 'Laki-laki', '084348928343', 'Purwakarta', NULL),
('USR000012', 'Alvin Febriant Syanyanto', 'alvinfebs@gmail.com', NULL, NULL, '2000-01-01', NULL, NULL, NULL, NULL),
('USR000013', 'Dono Wiyono', 'dono@gmail.com', 'foto profil/1642693237-pp.jpg', 'Pemalang', '2000-01-21', 'Laki-laki', '085226236901', 'Sampih Kembang Kuning', 'rkriris'),
('USR000014', 'Andini Oktari', 'andini@gmail.com', 'foto profil/1642697925-ppsaput (1).jpg', 'Purwakarta', '2000-10-17', 'Perempuan', '08985349584', 'Ceulibadak', 'andinioct'),
('USR000015', 'Emiliya Firdaus', 'emil@gmail.com', 'foto profil/1642726833-ppsaput (1).jpg', 'Purwakarta', '2000-04-20', 'Perempuan', '085226236901', 'Simpang', 'rkriris'),
('USR000016', 'ria', 'ria@gmail.com', NULL, NULL, '2000-01-01', NULL, NULL, NULL, NULL),
('USR000017', 'riri', 'riri@gmail.com', NULL, NULL, '2000-01-01', NULL, NULL, NULL, NULL),
('USR000018', 'vidya anjelina', 'vidi@gmail.com', NULL, NULL, '2000-01-01', NULL, NULL, NULL, NULL),
('USR000019', 'Anandita', 'anandita@gmail.com', NULL, NULL, '2000-01-01', NULL, NULL, NULL, NULL),
('USR000020', 'niken', 'niken@gmail.com', NULL, NULL, '2000-01-01', NULL, NULL, NULL, NULL),
('USR000021', 'diniandini', 'dini@gmail.com', NULL, NULL, '2000-01-01', NULL, NULL, NULL, NULL),
('USR000022', 'Dwiefrina', 'dwi@gmail.com', NULL, NULL, '2000-01-01', NULL, NULL, NULL, NULL),
('USR000023', 'Ratu tasya', 'tsaya@gmail.com', NULL, NULL, '2000-01-01', NULL, NULL, NULL, NULL),
('USR000024', 'anandika', 'anandika@gmail.com', NULL, 'Solo', '2002-02-02', 'Laki-laki', '085226236901', 'Sampih Kembang Kuning', 'andinioct'),
('USR000025', 'Luthfiyah S', 'piaaaaasan@gmail.com', NULL, NULL, '2000-01-01', NULL, NULL, NULL, NULL),
('USR000026', 'Annisa Zachry Fauziahh', 'luthfiyah.sakisdfnah19@gmail.com', 'foto profil/1643694050-user (1).png', NULL, '2000-01-01', 'Perempuan', '082111385941', NULL, NULL),
('USR000027', 'salsabila', 'salsabila@gmail.com', NULL, NULL, '2000-01-01', NULL, NULL, NULL, NULL),
('USR000028', 'Dindha Aulia Putri', 'daulia@gmail.com', NULL, NULL, '2000-01-01', NULL, NULL, NULL, NULL),
('USR000029', 'Rizki Saputri', 'saput@gmail.com', NULL, NULL, '2000-01-01', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `program_studi`
--

CREATE TABLE `program_studi` (
  `id_prodi` varchar(15) NOT NULL,
  `nama_prodi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `program_studi`
--

INSERT INTO `program_studi` (`id_prodi`, `nama_prodi`) VALUES
('PR001', 'TEKNOLOGI MESIN'),
('PR002', 'TEKNOLOGI MEKATRONIKA'),
('PR003', 'TEKNOLOGI LISTRIK'),
('PR004', 'TEKNOLOGI REKAYASA PERANGKAT LUNAK');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sekolah`
--

CREATE TABLE `sekolah` (
  `NPSN` varchar(25) NOT NULL,
  `nama_sekolah` varchar(100) NOT NULL,
  `alamat` varchar(250) NOT NULL,
  `kota` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `sekolah`
--

INSERT INTO `sekolah` (`NPSN`, `nama_sekolah`, `alamat`, `kota`) VALUES
('20217338', 'SMAN 1 JATILUHUR', 'Jl. Pramuka No.138, Bunder, Kec. Jatiluhur, Kabupaten Purwakarta, Jawa Barat 41161', 'Purwakarta'),
('20217357', 'SMAN 1 PURWAKARTA', 'Jl. K.K Singawinata, Nagri Kidul, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41111\r\nasdkj', 'Purwakarta'),
('20217358', 'SMAN 1 SUKATANI', 'JL. JATI JAJAR NO. 20, Sukatani, Kec. Sukatani, Kab. Purwakarta, Jawa Barat, dengan kode pos 41167.', 'Purwakarta'),
('20217361', 'SMAN 2 PURWAKARTA', 'Jl. Raya Sadang-Subang No.17, Ciseureuh, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41118', 'Purwakarta'),
('20217363', 'SMAN 3 PURWAKARTA', 'JL. Letkol Abdul Kadir, No. 15, Negeri Kaler, Tegalmunjul, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41115', 'Purwakarta'),
('20217461', 'SMAN 1 BUNGURSARI', 'Jl. Raya Bungursari, Bungursari, Kec. Bungursari, Kabupaten Purwakarta, Jawa Barat 41181', 'Purwakarta'),
('20217479', 'SMAN 1 CIBATU', 'Jl. Raya Cibatu No.KM. 15, Cibatu, Kec. Cibatu, Kabupaten Purwakarta, Jawa Barat 41181', 'Purwakarta'),
('20229756', 'SMKN 2 PURWAKARTA', 'Jl. Jend. Ahmad Yani No.44, Nagri Tengah, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41114', 'Purwakarta'),
('20229757', 'SMKN 1 CIBATU', 'JL. RAYA SADANG-SUBANG KM.15, Cipinang, Kec. Cibatu, Kab. Purwakarta', 'Purwakarta'),
('20231419', 'SMKN 1 CARIU', 'JL. BABAKAN RADEN NO. 807 CARIU, Babakan Raden, Kec. Cariu, Kab. Bogor, Jawa Barat, dengan kode pos 16840.', 'Bogor'),
('20233656', 'SMAN 1 TANJUNGSIANG', 'JL. SINDANGLAYA TANJUNGSIANG, SINDANGLAYA, Kec. Tanjung Siang, Kab. Subang', 'Subang'),
('20237379', 'SMAN 1 RENGASDENGKLOK', 'JL. KUTAGANDOK, Kutagandok, Kec. Kutawaluya, Kab. Karawang', 'Karawang'),
('20247316', 'SMAN 2 CIKAMPEK', 'JL. JEND. A.YANI, Dawuan Tengah, Kec. Cikampek, Kab. Karawang', 'Karawang'),
('20253277', 'SMKN 1 BOJONG', 'JL. RAYA KEC. BOJONG, Sukamanah, Kec. Bojong, Kab. Purwakarta', 'Purwakarta'),
('69734347', 'SMAN 1 RAWAMERTA', 'JL. GARUNGGUNG RAWAMERTA, PANYINGKIRAN, Kec. Rawamerta, Kab. Karawang', 'Karawang'),
('69774530', 'SMKN 1 SUKATANI', 'JL. RAYA SUKATANI KM. 11 Kp. Pertanian Rt / Rw 04 / 01 , Sukatani, Kec. Sukatani', 'Purwakarta'),
('69848986', 'SMKN 1 PONDOKSALAM', 'JL. TERUSAN KAPTEN HALIM , SALAM MULYA, Kec. Pondok Salam, Kab. Purwakarta', 'Purwakarta'),
('69849084', 'SMKN JATILUHUR', 'JL. LURAH KAWI , CIKAOBANDUNG, Kec. Jatiluhur', 'Purwakarta'),
('69849086', 'SMKN MANIIS', 'JL. RAYA PALUMBON NO 23, CITAMIANG, Kec. Maniis', 'Purwakarta'),
('69849087', 'SMKN TEGALWARU', 'JL. CIDONGKOL RT 03/02, CISARUA, Kec. Tegalwaru', 'Purwakarta'),
('69849090', 'SMKN 3 SUKATANI', 'JL. Desa Sukamaju RT 04/02, Sukamaju, Kec. Sukatani', 'Purwakarta'),
('69849091', 'SMKN DARANGDAN', 'JL. DESA PASIRANGIN 41163, PASIRANGIN, Kec. Darangdan, Kab. Purwakarta', 'Purwakarta'),
('69849092', 'SMKN PASAWAHAN', 'JL. WARUNGKADU NO 186, WARUNGKADU, Kec. Pasawahan, Kab. Purwakarta', 'Purwakarta');

-- --------------------------------------------------------

--
-- Struktur dari tabel `timeline`
--

CREATE TABLE `timeline` (
  `id` int(11) NOT NULL,
  `id_user` varchar(50) NOT NULL,
  `status` varchar(250) NOT NULL,
  `tgl_update` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `timeline`
--

INSERT INTO `timeline` (`id`, `id_user`, `status`, `tgl_update`) VALUES
(1, 'USR000001', 'Mengedit profilnya', '2022-01-16 12:39:28'),
(2, 'USR000001', 'Mengedit profilnya', '2022-01-16 12:52:05'),
(3, 'USR000001', 'Mengedit profilnya', '2022-01-16 12:52:35'),
(4, 'USR000001', 'Mengedit profilnya', '2022-01-16 12:53:04'),
(5, 'USR000001', 'Mengedit profilnya', '2022-01-16 12:53:22'),
(6, 'USR000008', 'Bergabung', '2022-01-16 13:07:52'),
(7, 'PAY0006', 'Melakukan verifikasi pembayaran', '2022-01-16 13:26:17'),
(8, '202213005', 'Mengganti status Pembayaran', '2022-01-16 13:27:10'),
(9, '202213005', 'Mengganti status Pembayaran', '2022-01-16 13:27:21'),
(10, 'PAY0006', 'Mengganti status Pembayaran', '2022-01-16 13:28:20'),
(11, 'PAY0005', 'Mengganti status Pembayaran', '2022-01-16 13:28:29'),
(12, 'PAY0003', 'Melakukan verifikasi pembayaran', '2022-01-16 13:28:43'),
(13, 'USR000001', 'Mengupdate pengumuman', '2022-01-16 13:32:10'),
(14, 'USR000001', 'Mengupdate pengumuman', '2022-01-16 13:39:33'),
(15, 'USR000001', 'Mengupdate pengumuman', '2022-01-16 13:40:10'),
(16, 'USR000001', 'Membuat user baru', '2022-01-16 17:34:22'),
(17, 'USR000001', 'Mengedit User', '2022-01-16 17:35:13'),
(18, 'USR000001', 'Membuat user baru', '2022-01-16 17:36:46'),
(19, '202213005', 'di verifikasi', '2022-01-16 17:40:07'),
(20, 'USR000001', 'Membuat user baru', '2022-01-17 12:55:35'),
(21, 'USR000001', 'Mengedit User', '2022-01-17 12:56:06'),
(22, 'USR000010', 'Bergabung', '2022-01-17 21:16:01'),
(23, 'USR000011', 'Bergabung', '2022-01-17 21:23:11'),
(24, 'USR000001', 'Memperbaharui Pembayaran', '2022-01-18 09:55:01'),
(25, 'USR000001', 'Memperbaharui Pembayaran', '2022-01-18 09:56:09'),
(26, 'USR000001', 'Mengupdate pengumuman', '2022-01-19 09:02:36'),
(27, 'USR000001', 'Mengupdate pengumuman', '2022-01-19 09:03:20'),
(28, 'USR000001', 'Mengupdate pengumuman', '2022-01-19 09:11:00'),
(29, 'USR000001', 'Mengupdate pengumuman', '2022-01-19 09:11:48'),
(30, 'USR000001', 'Mengupdate pengumuman', '2022-01-19 09:12:34'),
(31, '202213009', 'di verifikasi', '2022-01-19 09:12:56'),
(32, 'USR000001', 'Mengupdate pengumuman', '2022-01-19 09:13:19'),
(33, 'USR000011', 'Bergabung', '2022-01-19 10:29:50'),
(34, 'USR000011', 'Melakukan pendaftaran penerimaan mahasiswa baru', '2022-01-19 10:39:55'),
(35, 'USR000012', 'Bergabung', '2022-01-19 10:41:50'),
(36, '202219005', 'belum di verifikasi', '2022-01-19 10:43:55'),
(37, '202219005', 'di verifikasi', '2022-01-19 10:44:04'),
(38, 'USR000011', 'Mengupload Pembayaran', '2022-01-19 11:05:27'),
(39, 'USR000011', 'Mengupload Pembayaran', '2022-01-19 12:06:12'),
(40, 'USR000011', 'Mengupload Pembayaran', '2022-01-19 12:07:28'),
(41, 'USR000011', 'Mengupload Pembayaran', '2022-01-19 12:12:00'),
(42, 'USR000011', 'Mengupload bukti pembayaran', '2022-01-19 19:49:32'),
(43, 'USR000011', 'Mengupload bukti pembayaran', '2022-01-19 19:59:05'),
(44, 'USR000001', 'Mengupdate pengumuman', '2022-01-20 16:39:53'),
(45, 'USR000006', 'Mengedit profilnya', '2022-01-20 21:34:36'),
(46, 'USR000013', 'Bergabung', '2022-01-20 22:37:24'),
(47, 'USR000013', 'Mengedit profilnya', '2022-01-20 22:40:37'),
(48, 'USR000013', 'Melakukan pendaftaran penerimaan mahasiswa baru', '2022-01-20 22:44:38'),
(49, '202220005', 'di verifikasi', '2022-01-20 22:46:52'),
(50, 'USR000001', 'Mengedit Pendaftaran', '2022-01-20 23:23:48'),
(51, 'USR000001', 'Mengedit Pendaftaran', '2022-01-20 23:27:29'),
(52, 'USR000014', 'Bergabung', '2022-01-20 23:54:46'),
(53, 'USR000014', 'Mengedit profilnya', '2022-01-20 23:58:45'),
(54, 'USR000014', 'Melakukan pendaftaran penerimaan mahasiswa baru', '2022-01-21 00:29:28'),
(55, '202220005', 'di verifikasi', '2022-01-21 00:31:27'),
(56, 'USR000015', 'Bergabung', '2022-01-21 07:50:00'),
(57, 'USR000015', 'Mengedit profilnya', '2022-01-21 08:00:33'),
(58, 'USR000015', 'Melakukan pendaftaran penerimaan mahasiswa baru', '2022-01-21 08:05:29'),
(59, '202221006', 'di verifikasi', '2022-01-21 08:08:39'),
(60, 'USR000015', 'Mengupload bukti pembayaran', '2022-01-21 08:10:24'),
(61, 'USR000001', 'Mengupdate pengumuman', '2022-01-21 08:17:45'),
(62, 'USR000016', 'Bergabung', '2022-01-25 16:00:43'),
(63, 'USR000017', 'Bergabung', '2022-01-25 16:03:28'),
(64, 'USR000018', 'Bergabung', '2022-01-25 16:06:37'),
(65, 'USR000019', 'Bergabung', '2022-01-25 16:12:21'),
(66, 'USR000020', 'Bergabung', '2022-01-25 16:19:17'),
(67, 'USR000021', 'Bergabung', '2022-01-25 16:19:54'),
(68, 'USR000022', 'Bergabung', '2022-01-25 16:22:27'),
(69, 'USR000023', 'Bergabung', '2022-01-25 16:24:28'),
(70, 'USR000020', 'Melakukan pendaftaran penerimaan mahasiswa baru', '2022-01-25 16:37:22'),
(71, '202225007', 'di verifikasi', '2022-01-25 16:42:25'),
(72, 'USR000020', 'Mengupload bukti pembayaran', '2022-01-25 16:43:29'),
(73, 'USR000001', 'Mengupdate pengumuman', '2022-01-25 16:47:08'),
(74, 'USR000014', 'Mengupload bukti pembayaran', '2022-01-25 16:54:43'),
(75, 'USR000013', 'Mengupload bukti pembayaran', '2022-01-25 17:24:47'),
(76, 'USR000001', 'Mengupdate pengumuman', '2022-01-25 17:26:48'),
(77, 'USR000001', 'Mengupdate pengumuman', '2022-01-25 17:27:46'),
(78, 'USR000001', 'Mengupdate pengumuman', '2022-01-25 17:28:39'),
(79, 'USR000001', 'Mengupdate pengumuman', '2022-01-25 17:29:34'),
(80, 'USR000013', 'Mengedit kata sandinya', '2022-01-25 17:37:23'),
(81, 'USR000024', 'Bergabung', '2022-01-26 22:20:08'),
(82, 'USR000024', 'Mengedit profilnya', '2022-01-26 22:22:27'),
(83, 'USR000024', 'Melakukan pendaftaran penerimaan mahasiswa baru', '2022-01-26 22:35:53'),
(84, '202226008', 'di verifikasi', '2022-01-26 22:37:41'),
(85, 'USR000024', 'Mengupload bukti pembayaran', '2022-01-26 22:38:19'),
(86, 'USR000001', 'Mengupdate pengumuman', '2022-01-26 22:39:16'),
(87, 'USR000001', 'Mengupdate pengumuman', '2022-01-26 22:40:08'),
(88, '202220004', 'tidak sah', '2022-01-26 22:42:49'),
(89, 'USR000025', 'Bergabung', '2022-01-26 22:57:26'),
(90, 'USR000004', 'Mengedit profilnya', '2022-02-01 00:17:34'),
(91, 'USR000004', 'Mengedit profilnya', '2022-02-01 00:17:45'),
(92, 'USR000001', 'Membuat user baru', '2022-02-01 12:40:50'),
(93, 'USR000001', 'Mengupdate pengumuman', '2022-02-01 13:18:24'),
(94, 'USR000001', 'Mengedit User', '2022-02-01 16:25:30'),
(95, '202220004', 'belum di verifikasi', '2022-02-01 16:49:54'),
(96, '202220004', 'di verifikasi', '2022-02-01 16:50:05'),
(97, '202220004', 'tidak sah', '2022-02-01 16:50:15'),
(98, 'USR000005', 'Melakukan pendaftaran penerimaan mahasiswa baru', '2022-02-01 17:04:03'),
(99, 'USR000027', 'Bergabung', '2022-02-02 09:10:29'),
(100, 'USR000027', 'Melakukan pendaftaran penerimaan mahasiswa baru', '2022-02-02 09:19:59'),
(101, '202202010', 'di verifikasi', '2022-02-02 09:21:12'),
(102, 'USR000027', 'Mengupload bukti pembayaran', '2022-02-02 09:25:47'),
(103, 'USR000001', 'Mengupdate pengumuman', '2022-02-02 09:27:24'),
(104, 'USR000028', 'Bergabung', '2022-02-09 09:11:01'),
(105, 'USR000029', 'Bergabung', '2022-02-09 10:04:58'),
(106, '202201009', 'di verifikasi', '2022-02-09 10:45:54'),
(107, 'USR000005', 'Mengupload bukti pembayaran', '2022-02-09 10:46:20'),
(108, 'USR000001', 'Mengupdate pengumuman', '2022-02-09 10:47:18'),
(109, 'USR000001', 'Mengupdate pengumuman', '2022-02-09 10:48:54'),
(110, 'USR000001', 'Mengedit Pendaftaran', '2022-02-09 15:45:26'),
(111, 'USR000029', 'Melakukan pendaftaran penerimaan mahasiswa baru', '2022-02-09 16:21:07'),
(112, '202209011', 'di verifikasi', '2022-02-09 16:25:07'),
(113, 'USR000029', 'Mengupload bukti pembayaran', '2022-02-09 16:25:41'),
(114, 'USR000001', 'Mengupdate pengumuman', '2022-02-09 16:31:24');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_user` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`, `id_user`) VALUES
(1, 'Luthfiyah Sakinah', 'luthfiyah.sakinah19@gmail.com', NULL, '$2y$10$h8R481BZQe7YMBE3ImhaiuZ3CCKozSciVTwXjH69V/qszRlbvYs7C', 'Administrator', NULL, '2022-01-08 05:50:23', '2022-01-14 22:36:55', 'USR000001'),
(4, 'Ayu Siti Rohmah', 'ayustr@gmail.com', NULL, '$2y$10$KviE.j24qom1Qvr185Ey7e0nb9BwcWwju/Gvew9Y62HIjO7yvAbEC', 'Calon Mahasiswa', NULL, '2022-01-10 01:19:59', '2022-01-10 01:19:59', 'USR000003'),
(6, 'Adila Alaina Risqi', 'adilaar17@gmail.com', NULL, '$2y$10$lrxK58dLGMVVoUpMG5maK.V8okZCApvFAj85U4m.YqVjq3fSWy8JW', 'Calon Mahasiswa', NULL, '2022-01-11 19:35:51', '2022-01-11 19:35:51', 'USR000004'),
(7, 'Nopi Rahmawati', 'nopiraa01@gmail.com', NULL, '$2y$10$Wrob7DZ/KMcsu9DuhbdGiO0WGEVdCHM11/mzdZGuiF2wachgf3V.y', 'Calon Mahasiswa', NULL, '2022-01-11 19:43:05', '2022-01-11 19:43:05', 'USR000005'),
(14, 'Nurul Aulia Khoerunnisa', 'naulia@gmail.com', NULL, '$2y$10$Ik2vnvMgqf8cUhv7nKqxRO3tQrCclkDx9CO1f.fPte9yJSM2N0.Qi', 'Calon Mahasiswa', NULL, '2022-01-11 20:02:02', '2022-01-11 20:02:02', 'USR000006'),
(17, 'Dindha Aulia Putri Nurani', 'dindhaapn@gmail.com', NULL, '$2y$10$k4K9fUsRlNW0SRR8bEhM5Oj1kVeDDBal49HYIu2bqRiK/dTJjrdQu', 'Calon Mahasiswa', NULL, '2022-01-15 23:07:52', '2022-01-15 23:07:52', 'USR000008'),
(20, 'Annisa Zachry Fauziahh', 'annisazf12@gmail.com', NULL, '$2y$10$506HA3.ZH1OrRawdCDtIDuVa9Ydpj34LDDEKzFYDfGvGPlUvTKCvS', 'Administrator', NULL, '2022-01-16 03:36:46', '2022-01-16 03:36:46', 'USR000009'),
(22, 'Nursita Setyawati', 'taasita@gmail.com', NULL, '$2y$10$mGaS476R/jbrS8ar0SZnheY1FXAWNCWuUYLBsJ2Xz6kvan8Uu3jty', 'Calon Mahasiswa', NULL, '2022-01-17 07:16:01', '2022-01-17 07:16:01', 'USR000010'),
(24, 'Bagus Bimantoro', 'goodbmtr@gmail.com', NULL, '$2y$10$A.0X5KnIu/kBtoSra0EytOy7X/u4pgqe.Edke5HDhwWACVEFr/ube', 'Calon Mahasiswa', NULL, '2022-01-18 20:29:49', '2022-01-18 20:29:49', 'USR000011'),
(25, 'Alvin Febriant Syanyanto', 'alvinfebs@gmail.com', NULL, '$2y$10$Kam3One5nmUL63YtDXxkeuk2XtenmqejBxUUSViRU/bc4KSrBSXCu', 'Calon Mahasiswa', NULL, '2022-01-18 20:41:50', '2022-01-18 20:41:50', 'USR000012'),
(26, 'Dono Wiyono', 'dono@gmail.com', NULL, '$2y$10$mmHGN16a0SY95aJFrbl2iedHmYzw0bV2SGJaejM3tsjspZp4vhqWK', 'Calon Mahasiswa', NULL, '2022-01-20 08:37:23', '2022-01-25 03:37:23', 'USR000013'),
(27, 'Andini Oktari', 'andini@gmail.com', NULL, '$2y$10$itLV0DiPtl9zCcBVR5ogaeBd5/Tn79lp4My3avNzY5GKQL014nPT.', 'Calon Mahasiswa', NULL, '2022-01-20 09:54:45', '2022-01-20 09:54:45', 'USR000014'),
(28, 'Emiliya Firdaus', 'emil@gmail.com', NULL, '$2y$10$/EznFkcqbL4dXvAefp2VleSuEnFHdCRWyerrt0lwRpA7btAG8nQcK', 'Calon Mahasiswa', NULL, '2022-01-20 17:49:59', '2022-01-20 17:49:59', 'USR000015'),
(29, 'ria', 'ria@gmail.com', NULL, '$2y$10$oUh7IiFiRSsDFRw36.IiIeT59eqPULoqbwRjwgWumps2wcPOl3P/2', 'Calon Mahasiswa', NULL, '2022-01-25 02:00:43', '2022-01-25 02:00:43', 'USR000016'),
(30, 'riri', 'riri@gmail.com', NULL, '$2y$10$OvuefjvWPLAVe/I6nnbcHO03rB.IY1oMJQh1iHVUeyAUKNklOlWC6', 'Calon Mahasiswa', NULL, '2022-01-25 02:03:28', '2022-01-25 02:03:28', 'USR000017'),
(31, 'vidya anjelina', 'vidi@gmail.com', NULL, '$2y$10$OfnTftuyc5Ac2vr0AV.L1uHjMC/2nk8MX50UDKBN61P.uqkHDWcpa', 'Calon Mahasiswa', NULL, '2022-01-25 02:06:37', '2022-01-25 02:06:37', 'USR000018'),
(32, 'Anandita', 'anandita@gmail.com', NULL, '$2y$10$ClBcmktu/7yGyFf5EpPSa.fVwLqqetGrDjAaMf2wdauqOn/fENYmO', 'Calon Mahasiswa', NULL, '2022-01-25 02:12:20', '2022-01-25 02:12:20', 'USR000019'),
(33, 'niken', 'niken@gmail.com', NULL, '$2y$10$UMyebHqhH4ZnuBSloS1ig.rnuwImsilD.P9l.N6gy92iNfC1wpmia', 'Calon Mahasiswa', NULL, '2022-01-25 02:19:17', '2022-01-25 02:19:17', 'USR000020'),
(34, 'diniandini', 'dini@gmail.com', NULL, '$2y$10$3WU9BrqT.8JVU47VbJnHBOcjbFKhCB0R9tWr53imuriC6sNcpjhmO', 'Calon Mahasiswa', NULL, '2022-01-25 02:19:54', '2022-01-25 02:19:54', 'USR000021'),
(35, 'Dwiefrina', 'dwi@gmail.com', NULL, '$2y$10$bZIAXE73/Sm26FAiIdqhS.M.166N0qactwGJnf7zSwPnVcwmfCKma', 'Calon Mahasiswa', NULL, '2022-01-25 02:22:27', '2022-01-25 02:22:27', 'USR000022'),
(36, 'Ratu tasya', 'tsaya@gmail.com', NULL, '$2y$10$HOYS0Cpn.3Oyp7vnTJr5rOT.jy.GH.nyovrtHUY2ggnJ0n69KO3nG', 'Calon Mahasiswa', NULL, '2022-01-25 02:24:27', '2022-01-25 02:24:27', 'USR000023'),
(37, 'anandika', 'anandika@gmail.com', NULL, '$2y$10$7Ypa2DMPPDIB.O/6hJmpeuvLllAcHrMGFVTV3wbiPRFcG8AIotrRC', 'Calon Mahasiswa', NULL, '2022-01-26 08:20:08', '2022-01-26 08:20:08', 'USR000024'),
(38, 'Luthfiyah S', 'piaaaaasan@gmail.com', NULL, '$2y$10$U07y2Cm.aIxGnTb2K3v9jOG4VsP0EgRJxVfF6xISD35fnV/qGZN7.', 'Calon Mahasiswa', NULL, '2022-01-26 08:57:26', '2022-01-26 08:57:26', 'USR000025'),
(39, 'Annisa Zachry Fauziahh', 'luthfiyah.sakisdfnah19@gmail.com', NULL, '$2y$10$T9HiZgwQW2B6ykQeXQVVP.mGANBG74s.k8ZdjvwDPMns3ihCIhC1e', 'Administrator', NULL, '2022-01-31 22:40:50', '2022-01-31 22:40:50', 'USR000026'),
(40, 'salsabila', 'salsabila@gmail.com', NULL, '$2y$10$PGcVrcUb30ZB7YQWwTqHsuqF.5ydIEUbXvOnVwk/45I5j/vbKBwK6', 'Calon Mahasiswa', NULL, '2022-02-01 19:10:27', '2022-02-01 19:10:27', 'USR000027'),
(41, 'Dindha Aulia Putri', 'daulia@gmail.com', NULL, '$2y$10$66cQxlkcLlzjyo9pPzYHfefZIy3xkgh8p0UE4v4bVSGaJXbsMXNb2', 'Calon Mahasiswa', NULL, '2022-02-08 19:11:01', '2022-02-08 19:11:01', 'USR000028'),
(42, 'Rizki Saputri', 'saput@gmail.com', NULL, '$2y$10$KIZHam5MFt3t9pURQqsduu.37FcUZHiX.SJ7vwY.Gq.QqNqckMFoO', 'Calon Mahasiswa', NULL, '2022-02-08 20:04:58', '2022-02-08 20:04:58', 'USR000029');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `jadwal_kegiatan`
--
ALTER TABLE `jadwal_kegiatan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`),
  ADD UNIQUE KEY `id_pendaftaran` (`id_pendaftaran`);

--
-- Indeks untuk tabel `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD PRIMARY KEY (`id_pendaftaran`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `pil1` (`pil1`,`pil2`,`id_Sekolah`);

--
-- Indeks untuk tabel `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD PRIMARY KEY (`id_pengumuman`),
  ADD UNIQUE KEY `id_pendaftaran_2` (`id_pendaftaran`),
  ADD KEY `id_pendaftaran` (`id_pendaftaran`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `profile_user`
--
ALTER TABLE `profile_user`
  ADD PRIMARY KEY (`Id_user`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indeks untuk tabel `program_studi`
--
ALTER TABLE `program_studi`
  ADD PRIMARY KEY (`id_prodi`);

--
-- Indeks untuk tabel `sekolah`
--
ALTER TABLE `sekolah`
  ADD PRIMARY KEY (`NPSN`);

--
-- Indeks untuk tabel `timeline`
--
ALTER TABLE `timeline`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jadwal_kegiatan`
--
ALTER TABLE `jadwal_kegiatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `timeline`
--
ALTER TABLE `timeline`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
