-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 20, 2025 at 09:01 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_puskesmas`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` bigint(20) NOT NULL,
  `username_admin` varchar(100) NOT NULL,
  `password_admin` varchar(100) NOT NULL,
  `foto_admin` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username_admin`, `password_admin`, `foto_admin`) VALUES
(203020503050, 'admin', '203020503050', 'Stevan.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `distribusi_obat`
--

CREATE TABLE `distribusi_obat` (
  `id_distribusi` bigint(20) NOT NULL,
  `id_resep` bigint(20) NOT NULL,
  `tgl_distribusi` date NOT NULL DEFAULT current_timestamp(),
  `waktu_distribusi` time NOT NULL DEFAULT current_timestamp(),
  `nip_petugas` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `distribusi_obat`
--

INSERT INTO `distribusi_obat` (`id_distribusi`, `id_resep`, `tgl_distribusi`, `waktu_distribusi`, `nip_petugas`) VALUES
(1, 1, '2025-05-19', '00:00:00', 199212072022071003),
(16, 61, '2025-05-26', '12:31:06', 198004302019061004),
(17, 57, '2025-06-03', '07:48:16', 198004302019061004),
(18, 58, '2025-06-03', '07:48:19', 198004302019061004),
(19, 63, '2025-06-03', '07:48:20', 198004302019061004),
(20, 64, '2025-06-03', '07:48:20', 198004302019061004);

-- --------------------------------------------------------

--
-- Table structure for table `dokter`
--

CREATE TABLE `dokter` (
  `nip_dokter` bigint(20) NOT NULL,
  `id_ruang` bigint(20) NOT NULL,
  `foto_dokter` text NOT NULL,
  `nama_dokter` varchar(50) NOT NULL,
  `jk_dokter` enum('Laki-Laki','Perempuan') NOT NULL,
  `agama_dokter` enum('Islam','Kristen','Katolik','Hindu','Buddha','Khonghucu') NOT NULL,
  `status_pernikahan_dokter` enum('Sudah Menikah','Belum Menikah','Janda/Duda') NOT NULL,
  `alamat_dokter` varchar(100) NOT NULL,
  `no_hp_dokter` varchar(50) NOT NULL,
  `password_dokter` varchar(50) NOT NULL,
  `tgl_lahir_dokter` date NOT NULL,
  `tempat_lahir_dokter` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dokter`
--

INSERT INTO `dokter` (`nip_dokter`, `id_ruang`, `foto_dokter`, `nama_dokter`, `jk_dokter`, `agama_dokter`, `status_pernikahan_dokter`, `alamat_dokter`, `no_hp_dokter`, `password_dokter`, `tgl_lahir_dokter`, `tempat_lahir_dokter`) VALUES
(197806152023011001, 1, 'default.png', 'dr. Ahmad Fauzi', 'Laki-Laki', 'Islam', 'Sudah Menikah', 'Jalan Sutan Syahrir, Pangkalan Bun', '081234560001', '197806152023011001', '1978-06-15', 'Palangka Raya'),
(197902172019101007, 4, 'default.png', 'dr. Dedi Firmansyah', 'Laki-Laki', 'Islam', 'Janda/Duda', 'Jl. Suka Maju, Pangkalan Bun', '087234560007', '197902172019101007', '1979-02-17', 'Palangka Raya'),
(198409012022112002, 1, 'default.png', 'dr. Siti Rohmah', 'Perempuan', 'Islam', 'Sudah Menikah', 'Komplek Permata Hijau, Pangkalan Bun', '082234560002', '198409012022112002', '1984-09-01', 'Sampit'),
(198605072020081005, 3, 'default.png', 'dr. Rahmat Hidayat', 'Laki-Laki', 'Islam', 'Sudah Menikah', 'Jalan Jendral Sudirman, Pangkalan Bun', '085234560005', '198605072020081005', '1986-05-07', 'Kasongan'),
(198901202024031003, 2, 'default.png', 'dr. Budi Santoso', 'Laki-Laki', 'Kristen', 'Belum Menikah', 'Jl. Panglima Utar, Pangkalan Bun', '083234560003', '198901202024031003', '1989-01-20', 'Muara Teweh'),
(199011302023061006, 3, 'default.png', 'dr. Melani Putri', 'Perempuan', 'Islam', 'Sudah Menikah', 'Gang Rambutan, Pangkalan Bun', '086234560006', '199011302023061006', '1990-11-30', 'Buntok'),
(199208052021122004, 2, 'default.png', 'dr. Indah Lestari', 'Perempuan', 'Islam', 'Belum Menikah', 'Perumahan Griya Asri, Pangkalan Bun', '084234560004', '199208052021122004', '1992-08-05', 'Palangka Raya'),
(199304152021041008, 4, 'default.png', 'dr. Anisa Rahmawati', 'Perempuan', 'Islam', 'Belum Menikah', 'Jalan RTA Milono, Pangkalan Bun', '088234560008', '199304152021041008', '1993-04-15', 'Palangka Raya');

-- --------------------------------------------------------

--
-- Table structure for table `obat`
--

CREATE TABLE `obat` (
  `kode_obat` varchar(20) NOT NULL,
  `nama_obat` varchar(100) NOT NULL,
  `dosis_obat` varchar(100) NOT NULL,
  `keterangan_obat` varchar(100) NOT NULL,
  `stok_obat` int(11) NOT NULL DEFAULT 0,
  `satuan` varchar(50) NOT NULL,
  `tgl_kadaluarsa` date NOT NULL,
  `minimum_stok` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `obat`
--

INSERT INTO `obat` (`kode_obat`, `nama_obat`, `dosis_obat`, `keterangan_obat`, `stok_obat`, `satuan`, `tgl_kadaluarsa`, `minimum_stok`) VALUES
('OBT-0001', 'Paracetamol', '500 mg', 't', 160, 'Tablet', '2026-10-27', 50),
('OBT-0002', 'Asam Mefenamat', '500 mg', 'Obat antiinflamasi nonsteroid untuk nyeri ringan hingga sedang.', 90, 'Tablet', '2025-06-04', 50),
('OBT-0003', 'Amoxicillin', '250 mg', 't', 73, 'Kapsul', '2027-01-15', 50),
('OBT-0004', 'Vitamin C', '50 mg', 'Suplemen vitamin untuk daya tahan tubuh.', 140, 'Tablet', '2026-03-01', 50),
('OBT-0005', 'Ibuprofen', '400 mg', 'Obat anti-inflamasi non-steroid untuk nyeri dan radang.', 75, 'Tablet', '2024-05-10', 50),
('OBT-0006', 'Metformin', '500 mg', 'Obat untuk diabetes tipe 2.', 92, 'Tablet', '2025-11-25', 50),
('OBT-0007', 'Omeprazole', '20 mg', 'Obat untuk mengurangi asam lambung.', 40, 'Kapsul', '2027-01-01', 50),
('OBT-0008', 'Salbutamol', '2 mg', 'Bronkodilator untuk asma.', 40, 'Tablet', '2028-01-12', 50),
('OBT-0009', 'Cotrimoxazole', '960 mg', 'Antibiotik kombinasi untuk berbagai infeksi.', 55, 'Tablet', '2024-08-31', 50),
('OBT-0010', 'Cetirizine', '10 mg', 'Obat alergi untuk hidung gatal dan bersin.', 120, 'Tablet', '2025-02-14', 50),
('OBT-0011', 'Loratadine', '10 mg', 'Obat antihistamin untuk alergi.', 100, 'Tablet', '2028-01-17', 50);

-- --------------------------------------------------------

--
-- Table structure for table `obat_masuk`
--

CREATE TABLE `obat_masuk` (
  `id_masuk` int(11) NOT NULL,
  `kode_obat` varchar(20) DEFAULT NULL,
  `jumlah_masuk` int(11) NOT NULL,
  `tanggal_masuk` date NOT NULL DEFAULT current_timestamp(),
  `nip_petugas` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `obat_masuk`
--

INSERT INTO `obat_masuk` (`id_masuk`, `kode_obat`, `jumlah_masuk`, `tanggal_masuk`, `nip_petugas`) VALUES
(1, 'OBT-0002', 2, '2025-05-07', 199212072022071003),
(2, 'OBT-0003', 3, '2025-05-13', 199212072022071003),
(3, 'OBT-0004', 2, '2025-06-02', 198004302019061004),
(4, 'OBT-0005', 5, '2025-05-14', 198004302019061004),
(5, 'OBT-0006', 2, '2025-05-14', 198004302019061004),
(6, 'OBT-0001', 100, '2025-05-26', 198004302019061004);

-- --------------------------------------------------------

--
-- Table structure for table `pasien`
--

CREATE TABLE `pasien` (
  `nik_pasien` bigint(20) NOT NULL,
  `bpjs` varchar(50) NOT NULL,
  `rm` int(10) NOT NULL,
  `nama_pasien` varchar(100) NOT NULL,
  `foto_pasien` text DEFAULT 'default.png',
  `jk_pasien` enum('','Laki-Laki','Perempuan') NOT NULL,
  `agama_pasien` enum('','Islam','Kristen','Katolik','Hindu','Buddha','Khonghucu') NOT NULL,
  `status_pernikahan_pasien` enum('','Sudah Menikah','Belum Menikah','Janda/Duda') NOT NULL,
  `alamat_pasien` varchar(100) NOT NULL,
  `no_hp_pasien` varchar(50) NOT NULL,
  `password_pasien` varchar(50) NOT NULL,
  `pekerjaan_pasien` varchar(100) NOT NULL,
  `riwayat_alergi_pasien` varchar(100) NOT NULL,
  `tinggi_badan` varchar(10) NOT NULL,
  `lingkar_perut` varchar(10) NOT NULL,
  `lingkar_kepala` varchar(10) NOT NULL,
  `lingkar_dada` varchar(10) NOT NULL,
  `berat_badan` varchar(10) NOT NULL,
  `tempat_lahir_pasien` varchar(50) NOT NULL,
  `tgl_lahir_pasien` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pasien`
--

INSERT INTO `pasien` (`nik_pasien`, `bpjs`, `rm`, `nama_pasien`, `foto_pasien`, `jk_pasien`, `agama_pasien`, `status_pernikahan_pasien`, `alamat_pasien`, `no_hp_pasien`, `password_pasien`, `pekerjaan_pasien`, `riwayat_alergi_pasien`, `tinggi_badan`, `lingkar_perut`, `lingkar_kepala`, `lingkar_dada`, `berat_badan`, `tempat_lahir_pasien`, `tgl_lahir_pasien`) VALUES
(2020202020202020, '-', 15, 'Stevan Stenlly Sinaga', 'foto.png', 'Laki-Laki', 'Kristen', 'Belum Menikah', 'KBA', '085350373328', '2020202020202020', 'Petani', 'Tidak Ada', '165', '85', '-', '-', '80', 'Banjarmasin', '2001-07-05'),
(6101010101010001, '1234567890123', 1, 'Ahmad Setiawan', 'default.png', 'Laki-Laki', 'Islam', 'Sudah Menikah', 'Desa Kumpai Batu Atas, Kotawaringin Barat', '081234567801', '6101010101010001', 'Petani', 'Kacang', '165', '85', '-', '-', '65', 'Pangkalan Bun', '1985-06-15'),
(6101010101010002, '-', 2, 'Siti Aminah', 'default.png', 'Perempuan', 'Islam', 'Belum Menikah', 'Desa Kumpai Batu Atas, Kotawaringin Barat', '082134567802', '6101010101010002', 'Ibu Rumah Tangga', '-', '155', '70', '52', '85', '52', 'Kumpai Batu', '1993-11-02'),
(6101010101010003, '9876543210987', 3, 'Budi Hartono', 'default.png', 'Laki-Laki', 'Kristen', 'Sudah Menikah', 'Kumpai Batu Atas RT 04 RW 01, Kotawaringin Barat', '083234567803', '6101010101010003', 'Nelayan', '-', '170', '95', '58', '100', '75', 'Pangkalan Lada', '1979-04-20'),
(6101010101010004, '-', 4, 'Dewi Sartika', 'default.png', 'Perempuan', 'Islam', 'Janda/Duda', 'Desa Kumpai Batu Atas', '084234567804', '6101010101010004', 'Pedagang', 'Udang', '160', '88', '54', '92', '60', 'Kotawaringin Lama', '1980-12-10'),
(6101010101010005, '4567891234567', 5, 'Rahmat Hidayat', 'default.png', 'Laki-Laki', 'Islam', 'Belum Menikah', 'Jalan Poros Kumpai Batu Atas', '085234567805', '6101010101010005', 'Buruh Harian Lepas', '-', '168', '90', '56', '95', '70', 'Pangkalan Bun', '1995-07-18'),
(6101010101010006, '-', 6, 'Nur Aini', 'default.png', 'Perempuan', 'Islam', 'Sudah Menikah', 'Kumpai Batu Atas', '086234567806', '6101010101010006', 'Guru PAUD', 'Debu', '158', '75', '53', '88', '55', 'Kumpai Batu', '1990-03-12'),
(6101010101010007, '3214569876543', 7, 'Dedi Irawan', 'default.png', 'Laki-Laki', 'Islam', 'Sudah Menikah', 'Desa Kumpai Batu Atas, RT 02', '087234567807', '6101010101010007', 'Petani Karet', 'Serbuk', '172', '94', '60', '102', '78', 'Arut Selatan', '1982-10-05'),
(6101010101010008, '-', 8, 'Lina Marlina', 'default.png', 'Perempuan', 'Islam', 'Belum Menikah', 'Kumpai Batu Atas, Kotawaringin Barat', '088234567808', '6101010101010008', 'Penjahit', '-', '157', '72', '51', '84', '50', 'Pangkalan Banteng', '1998-08-21'),
(6101010101010009, '6543217896543', 9, 'Fajar Nugroho', 'default.png', 'Laki-Laki', 'Hindu', 'Sudah Menikah', 'Jalan Trans Kalimantan, Kumpai Batu Atas', '089234567809', '6101010101010009', 'Montir', 'Lateks', '173', '98', '59', '105', '80', 'Kotawaringin Lama', '1987-01-30'),
(6101010101010010, '-', 10, 'Maya Putri', 'default.png', 'Perempuan', 'Islam', 'Janda/Duda', 'Desa Kumpai Batu Atas RT 05', '081234567810', '6101010101010010', 'Bidan Desa', '-', '162', '80', '54', '90', '58', 'Pangkalan Bun', '1989-09-09');

-- --------------------------------------------------------

--
-- Table structure for table `pengumuman`
--

CREATE TABLE `pengumuman` (
  `id_pengumuman` bigint(20) NOT NULL,
  `foto_pengumuman` text NOT NULL,
  `judul_pengumuman` varchar(100) NOT NULL,
  `keterangan_pengumuman` text NOT NULL,
  `tgl_pengumuman` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengumuman`
--

INSERT INTO `pengumuman` (`id_pengumuman`, `foto_pengumuman`, `judul_pengumuman`, `keterangan_pengumuman`, `tgl_pengumuman`) VALUES
(1, 'logo_pkm.jpg', 'Puskesmas Kumpai Batu Atas', 'Puskesmas Desa Kumpai Batu Atas yang berlokasi di Jl. A. Yani RT.07/RW.04 Kode Pos 74117, Kecamatan Arut Selatan, Kabupaten Kotawaringin Barat, Kalimantan Tengah.', '2025-04-14'),
(2, 'Jadwal BIAS.png', 'Jadwal BIAS', 'Jadwal Pelaksanaan Bulan Imunisasi Anak Sekolah (BIAS) Puskesmas Kumpai Batu Atas bulan November 2024', '2025-04-14'),
(3, 'pengumuman pkm kba.png', 'Vaksin', 'Vaksin HBO dan DCG di Puskesmas Kumpai Batu Atas Belum Tersedia.', '2025-04-14'),
(4, 'pengumuman pkm kba.png', 'Vaksin', 'Vaksin HBO dan DCG di Puskesmas Kumpai Batu Atas Belum Tersedia.', '2025-05-06'),
(5, 'pengumuman pkm kba.png', 'Vaksin', 'Vaksin HBO dan DCG di Puskesmas Kumpai Batu Atas Belum Tersedia.', '2025-05-06');

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `nip_petugas` bigint(20) NOT NULL,
  `id_ruang` bigint(20) NOT NULL,
  `nama_petugas` varchar(100) NOT NULL,
  `foto_petugas` text NOT NULL,
  `jk_petugas` enum('Laki-Laki','Perempuan') NOT NULL,
  `agama_petugas` enum('Islam','Kristen','Katolik','Hindu','Buddha','Khonghucu') NOT NULL,
  `alamat_petugas` varchar(100) NOT NULL,
  `no_hp_petugas` varchar(100) NOT NULL,
  `password_petugas` varchar(100) NOT NULL,
  `status_pernikahan_petugas` enum('Sudah Menikah','Belum Menikah','Janda/Duda') NOT NULL,
  `tempat_lahir_petugas` varchar(50) NOT NULL,
  `tgl_lahir_petugas` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`nip_petugas`, `id_ruang`, `nama_petugas`, `foto_petugas`, `jk_petugas`, `agama_petugas`, `alamat_petugas`, `no_hp_petugas`, `password_petugas`, `status_pernikahan_petugas`, `tempat_lahir_petugas`, `tgl_lahir_petugas`) VALUES
(198004302019061004, 6, 'Hendra Saputra', 'default.png', 'Laki-Laki', 'Islam', 'Perumahan Mitra Sejahtera, Pangkalan Bun', '085268931004', '198004302019061004', 'Janda/Duda', 'Kasongan', '1980-04-30'),
(198703242020101001, 5, 'Yuni Setiawati', 'default.png', 'Perempuan', 'Islam', 'Jl. Ahmad Yani, Pangkalan Bun', '089534561001', '198703242020101001', 'Sudah Menikah', 'Palangka Raya', '1987-03-24'),
(199105182021121002, 5, 'Ahmad Nurdiansyah', 'default.png', 'Laki-Laki', 'Islam', 'Komplek Asri Mulia, Pangkalan Bun', '082145671002', '199105182021121002', 'Belum Menikah', 'Muara Teweh', '1991-05-18'),
(199212072022071003, 6, 'Lina Agustin', 'default.png', 'Perempuan', 'Kristen', 'Jl. G. Obos, Pangkalan Bun', '081234567103', '199212072022071003', 'Belum Menikah', 'Buntok', '1992-12-07');

-- --------------------------------------------------------

--
-- Table structure for table `rekam_medis`
--

CREATE TABLE `rekam_medis` (
  `id_rm` bigint(20) NOT NULL,
  `id_ruang` bigint(20) NOT NULL,
  `nip_petugas` bigint(20) NOT NULL,
  `nik_pasien` bigint(20) NOT NULL,
  `tgl_pemeriksaan` date NOT NULL,
  `waktu_pemeriksaan` time NOT NULL DEFAULT current_timestamp(),
  `sakit` varchar(100) NOT NULL,
  `nyeri_telan` enum('','Ya','Tidak') NOT NULL,
  `demam` enum('','Ya','Tidak') NOT NULL,
  `batuk` enum('','Ya','Tidak') NOT NULL,
  `pilek` enum('','Ya','Tidak') NOT NULL,
  `tekanan_darah` varchar(100) NOT NULL,
  `nadi` varchar(100) NOT NULL,
  `siklus_nafas` varchar(100) NOT NULL,
  `suhu_badan` varchar(100) NOT NULL,
  `resiko_jatuh` enum('','Ya','Tidak') NOT NULL,
  `keterangan_screening` varchar(100) NOT NULL,
  `status_screening` varchar(50) DEFAULT 'Belum Diperiksa',
  `status_dokter` varchar(50) DEFAULT 'Belum Diperiksa',
  `nip_dokter` bigint(20) NOT NULL,
  `ICD_10` varchar(50) NOT NULL,
  `nama_penyakit` varchar(100) NOT NULL,
  `keterangan_hasil` varchar(200) NOT NULL,
  `umur` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rekam_medis`
--

INSERT INTO `rekam_medis` (`id_rm`, `id_ruang`, `nip_petugas`, `nik_pasien`, `tgl_pemeriksaan`, `waktu_pemeriksaan`, `sakit`, `nyeri_telan`, `demam`, `batuk`, `pilek`, `tekanan_darah`, `nadi`, `siklus_nafas`, `suhu_badan`, `resiko_jatuh`, `keterangan_screening`, `status_screening`, `status_dokter`, `nip_dokter`, `ICD_10`, `nama_penyakit`, `keterangan_hasil`, `umur`) VALUES
(1, 1, 198703242020101001, 6101010101010001, '2025-01-05', '08:15:00', 'Flu Berat', 'Ya', 'Ya', 'Ya', 'Ya', '120/80', '78', '20', '37.5', 'Tidak', 'Pasien datang dengan keluhan umum', 'Sudah Diperiksa', 'Sudah Diperiksa', 198409012022112002, 'J11', 'Influenza, virus tidak teridentifikasi', 'Perlu istirahat dan pengobatan ringan', 39),
(3, 1, 198703242020101001, 6101010101010003, '2025-01-07', '11:00:00', 'ISPA', 'Ya', 'Ya', 'Ya', 'Ya', '110/75', '72', '18', '37.2', 'Tidak', 'Pasien datang dengan keluhan umum', 'Sudah Diperiksa', 'Sudah Diperiksa', 198409012022112002, 'J00', 'Nasofaringitis akut (common cold)', 'Obat flu diberikan', 45),
(4, 1, 198703242020101001, 6101010101010004, '2025-01-08', '14:45:00', 'Demam', 'Tidak', 'Ya', 'Tidak', 'Ya', '115/78', '80', '19', '37.9', 'Tidak', 'Pasien datang dengan keluhan umum', 'Sudah Diperiksa', 'Sudah Diperiksa', 198409012022112002, 'R50', 'Demam tidak spesifik', 'Cek lanjutan disarankan', 44),
(5, 1, 198703242020101001, 6101010101010005, '2025-01-10', '10:15:00', 'Flu Berat', 'Ya', 'Ya', 'Ya', 'Ya', '118/76', '75', '20', '38.0', 'Tidak', 'Pasien datang dengan keluhan umum', 'Sudah Diperiksa', 'Sudah Diperiksa', 198409012022112002, 'J11', 'Influenza, virus tidak teridentifikasi', 'Obat flu dan vitamin diberikan', 29),
(6, 1, 198703242020101001, 6101010101010010, '2025-05-19', '08:15:00', 'Flu Berat', 'Ya', 'Ya', 'Ya', 'Ya', '120/80', '78', '20', '37.5', 'Tidak', 'Pasien datang dengan keluhan umum', 'Sudah Diperiksa', 'Sudah Diperiksa', 197806152023011001, 'J11', 'Influenza, virus tidak teridentifikasi', 'Perlu istirahat dan pengobatan ringan', 26),
(7, 1, 199105182021121002, 6101010101010009, '2025-05-19', '09:30:00', 'Radang Tenggorokan', 'Ya', 'Ya', 'Tidak', 'Ya', '130/85', '85', '22', '38.1', 'Tidak', 'Pasien datang dengan keluhan umum', 'Sudah Diperiksa', 'Sudah Diperiksa', 197806152023011001, 'J02', 'Faringitis akut', 'Disarankan antibiotik dan istirahat', 37),
(8, 1, 198703242020101001, 6101010101010008, '2025-05-19', '11:00:00', 'ISPA', 'Ya', 'Ya', 'Ya', 'Ya', '110/75', '72', '18', '37.2', 'Tidak', 'Pasien datang dengan keluhan umum', 'Sudah Diperiksa', 'Sudah Diperiksa', 197806152023011001, 'J00', 'Nasofaringitis akut (common cold)', 'Obat flu diberikan', 31),
(9, 1, 199105182021121002, 6101010101010007, '2025-05-19', '14:45:00', 'Demam', 'Tidak', 'Ya', 'Tidak', 'Ya', '115/78', '80', '19', '37.9', 'Tidak', 'Pasien datang dengan keluhan umum', 'Sudah Diperiksa', 'Sudah Diperiksa', 197806152023011001, 'R50', 'Demam tidak spesifik', 'Cek lanjutan disarankan', 44),
(10, 1, 198703242020101001, 6101010101010006, '2025-05-19', '10:15:00', 'Flu Berat', 'Ya', 'Ya', 'Ya', 'Ya', '118/76', '75', '20', '38.0', 'Tidak', 'Pasien datang dengan keluhan umum', 'Sudah Diperiksa', 'Sudah Diperiksa', 197806152023011001, 'J11', 'Influenza, virus tidak teridentifikasi', 'Obat flu dan vitamin diberikan', 49),
(11, 1, 198703242020101001, 6101010101010010, '2025-02-01', '09:30:00', 'Radang Tenggorokan', 'Ya', 'Ya', 'Tidak', 'Ya', '130/85', '85', '22', '38.1', 'Tidak', 'Pasien datang dengan keluhan umum', 'Sudah Diperiksa', 'Sudah Diperiksa', 197806152023011001, 'J02', 'Faringitis akut', 'Disarankan antibiotik dan istirahat', 37),
(12, 1, 199105182021121002, 6101010101010009, '2025-02-10', '09:30:00', 'Radang Tenggorokan', 'Ya', 'Ya', 'Tidak', 'Ya', '130/85', '85', '22', '38.1', 'Tidak', 'Pasien datang dengan keluhan umum', 'Sudah Diperiksa', 'Sudah Diperiksa', 197806152023011001, 'J02', 'Faringitis akut', 'Disarankan antibiotik dan istirahat', 37),
(13, 1, 198703242020101001, 6101010101010008, '2025-05-15', '11:00:00', 'ISPA', 'Ya', 'Ya', 'Ya', 'Ya', '110/75', '72', '18', '37.2', 'Tidak', 'Pasien datang dengan keluhan umum', 'Sudah Diperiksa', 'Sudah Diperiksa', 197806152023011001, 'J00', 'Nasofaringitis akut (common cold)', 'Obat flu diberikan', 31),
(14, 1, 199105182021121002, 6101010101010007, '2025-02-20', '14:45:00', 'Demam', 'Tidak', 'Ya', 'Tidak', 'Ya', '115/78', '80', '19', '37.9', 'Tidak', 'Pasien datang dengan keluhan umum', 'Sudah Diperiksa', 'Sudah Diperiksa', 197806152023011001, 'R50', 'Demam tidak spesifik', 'Cek lanjutan disarankan', 44),
(15, 1, 198703242020101001, 6101010101010006, '2025-02-25', '14:45:00', 'Demam', 'Tidak', 'Ya', 'Tidak', 'Ya', '115/78', '80', '19', '37.9', 'Tidak', 'Pasien datang dengan keluhan umum', 'Sudah Diperiksa', 'Sudah Diperiksa', 198409012022112002, 'R50', 'Demam tidak spesifik', 'Cek lanjutan disarankan', 44),
(16, 1, 198703242020101001, 6101010101010010, '2025-05-26', '09:30:00', 'Radang Tenggorokan', 'Ya', 'Ya', 'Tidak', 'Ya', '130/85', '85', '22', '38.1', 'Tidak', 'Pasien datang dengan keluhan umum', 'Sudah Diperiksa', 'Sudah Diperiksa', 197806152023011001, 'J02', 'Faringitis akut', 'Disarankan antibiotik dan istirahat', 37),
(17, 1, 199105182021121002, 6101010101010009, '2025-01-10', '09:30:00', 'Radang Tenggorokan', 'Ya', 'Ya', 'Tidak', 'Ya', '130/85', '85', '22', '38.1', 'Tidak', 'Pasien datang dengan keluhan umum', 'Sudah Diperiksa', 'Sudah Diperiksa', 198409012022112002, 'J02', 'Faringitis akut', 'Disarankan antibiotik dan istirahat', 37),
(18, 1, 198703242020101001, 6101010101010008, '2025-01-15', '11:00:00', 'ISPA', 'Ya', 'Ya', 'Ya', 'Ya', '110/75', '72', '18', '37.2', 'Tidak', 'Pasien datang dengan keluhan umum', 'Sudah Diperiksa', 'Sudah Diperiksa', 197806152023011001, 'J00', 'Nasofaringitis akut (common cold)', 'Obat flu diberikan', 31),
(19, 1, 199105182021121002, 6101010101010007, '2025-01-20', '14:45:00', 'Demam', 'Tidak', 'Ya', 'Tidak', 'Ya', '115/78', '80', '19', '37.9', 'Tidak', 'Pasien datang dengan keluhan umum', 'Sudah Diperiksa', 'Sudah Diperiksa', 198409012022112002, 'R50', 'Demam tidak spesifik', 'Cek lanjutan disarankan', 44),
(20, 1, 198703242020101001, 6101010101010006, '2025-01-25', '14:45:00', 'Demam', 'Tidak', 'Ya', 'Tidak', 'Ya', '115/78', '80', '19', '37.9', 'Tidak', 'Pasien datang dengan keluhan umum', 'Sudah Diperiksa', 'Sudah Diperiksa', 197806152023011001, 'R50', 'Demam tidak spesifik', 'Cek lanjutan disarankan', 44),
(21, 1, 198703242020101001, 6101010101010001, '2025-02-01', '09:30:00', 'Radang Tenggorokan', 'Ya', 'Ya', 'Tidak', 'Ya', '130/85', '85', '22', '38.1', 'Tidak', 'Pasien datang dengan keluhan umum', 'Sudah Diperiksa', 'Sudah Diperiksa', 197806152023011001, 'J02', 'Faringitis akut', 'Disarankan antibiotik dan istirahat', 37),
(22, 1, 199105182021121002, 6101010101010002, '2025-02-10', '09:30:00', 'Radang Tenggorokan', 'Ya', 'Ya', 'Tidak', 'Ya', '130/85', '85', '22', '38.1', 'Tidak', 'Pasien datang dengan keluhan umum', 'Sudah Diperiksa', 'Sudah Diperiksa', 197806152023011001, 'J02', 'Faringitis akut', 'Disarankan antibiotik dan istirahat', 37),
(23, 1, 198703242020101001, 6101010101010003, '2025-02-15', '11:00:00', 'ISPA', 'Ya', 'Ya', 'Ya', 'Ya', '110/75', '72', '18', '37.2', 'Tidak', 'Pasien datang dengan keluhan umum', 'Sudah Diperiksa', 'Sudah Diperiksa', 198409012022112002, 'J00', 'Nasofaringitis akut (common cold)', 'Obat flu diberikan', 31),
(24, 1, 199105182021121002, 6101010101010004, '2025-02-20', '14:45:00', 'Demam', 'Tidak', 'Ya', 'Tidak', 'Ya', '115/78', '80', '19', '37.9', 'Tidak', 'Pasien datang dengan keluhan umum', 'Sudah Diperiksa', 'Sudah Diperiksa', 198409012022112002, 'R50', 'Demam tidak spesifik', 'Cek lanjutan disarankan', 44),
(25, 1, 198703242020101001, 6101010101010005, '2025-02-25', '14:45:00', 'Demam', 'Tidak', 'Ya', 'Tidak', 'Ya', '115/78', '80', '19', '37.9', 'Tidak', 'Pasien datang dengan keluhan umum', 'Sudah Diperiksa', 'Sudah Diperiksa', 197806152023011001, 'R50', 'Demam tidak spesifik', 'Cek lanjutan disarankan', 44),
(26, 1, 198703242020101001, 6101010101010001, '2025-03-01', '09:30:00', 'Radang Tenggorokan', 'Ya', 'Ya', 'Tidak', 'Ya', '130/85', '85', '22', '38.1', 'Tidak', 'Pasien datang dengan keluhan umum', 'Sudah Diperiksa', 'Sudah Diperiksa', 198409012022112002, 'J02', 'Faringitis akut', 'Disarankan antibiotik dan istirahat', 37),
(27, 1, 199105182021121002, 6101010101010002, '2025-03-10', '09:30:00', 'Radang Tenggorokan', 'Ya', 'Ya', 'Tidak', 'Ya', '130/85', '85', '22', '38.1', 'Tidak', 'Pasien datang dengan keluhan umum', 'Sudah Diperiksa', 'Sudah Diperiksa', 198409012022112002, 'J02', 'Faringitis akut', 'Disarankan antibiotik dan istirahat', 37),
(28, 1, 198703242020101001, 6101010101010003, '2025-03-15', '11:00:00', 'ISPA', 'Ya', 'Ya', 'Ya', 'Ya', '110/75', '72', '18', '37.2', 'Tidak', 'Pasien datang dengan keluhan umum', 'Sudah Diperiksa', 'Sudah Diperiksa', 198409012022112002, 'J00', 'Nasofaringitis akut (common cold)', 'Obat flu diberikan', 31),
(29, 1, 199105182021121002, 6101010101010004, '2025-03-20', '14:45:00', 'Demam', 'Tidak', 'Ya', 'Tidak', 'Ya', '115/78', '80', '19', '37.9', 'Tidak', 'Pasien datang dengan keluhan umum', 'Sudah Diperiksa', 'Sudah Diperiksa', 198409012022112002, 'R50', 'Demam tidak spesifik', 'Cek lanjutan disarankan', 44),
(30, 1, 198703242020101001, 6101010101010005, '2025-03-25', '14:45:00', 'Demam', 'Tidak', 'Ya', 'Tidak', 'Ya', '115/78', '80', '19', '37.9', 'Tidak', 'Pasien datang dengan keluhan umum', 'Sudah Diperiksa', 'Sudah Diperiksa', 197806152023011001, 'R50', 'Demam tidak spesifik', 'Cek lanjutan disarankan', 44),
(31, 1, 198703242020101001, 6101010101010010, '2025-04-01', '09:30:00', 'Radang Tenggorokan', 'Ya', 'Ya', 'Tidak', 'Ya', '130/85', '85', '22', '38.1', 'Tidak', 'Pasien datang dengan keluhan umum', 'Sudah Diperiksa', 'Sudah Diperiksa', 197806152023011001, 'J02', 'Faringitis akut', 'Disarankan antibiotik dan istirahat', 37),
(32, 1, 199105182021121002, 6101010101010009, '2025-04-10', '09:30:00', 'Radang Tenggorokan', 'Ya', 'Ya', 'Tidak', 'Ya', '130/85', '85', '22', '38.1', 'Tidak', 'Pasien datang dengan keluhan umum', 'Sudah Diperiksa', 'Sudah Diperiksa', 197806152023011001, 'J02', 'Faringitis akut', 'Disarankan antibiotik dan istirahat', 37),
(33, 1, 198703242020101001, 6101010101010008, '2025-04-15', '11:00:00', 'ISPA', 'Ya', 'Ya', 'Ya', 'Ya', '110/75', '72', '18', '37.2', 'Tidak', 'Pasien datang dengan keluhan umum', 'Sudah Diperiksa', 'Sudah Diperiksa', 197806152023011001, 'J00', 'Nasofaringitis akut (common cold)', 'Obat flu diberikan', 31),
(34, 1, 199105182021121002, 6101010101010007, '2025-04-20', '14:45:00', 'Demam', 'Tidak', 'Ya', 'Tidak', 'Ya', '115/78', '80', '19', '37.9', 'Tidak', 'Pasien datang dengan keluhan umum', 'Sudah Diperiksa', 'Sudah Diperiksa', 198409012022112002, 'R50', 'Demam tidak spesifik', 'Cek lanjutan disarankan', 44),
(35, 1, 198703242020101001, 6101010101010006, '2025-04-25', '14:45:00', 'Demam', 'Tidak', 'Ya', 'Tidak', 'Ya', '115/78', '80', '19', '37.9', 'Tidak', 'Pasien datang dengan keluhan umum', 'Sudah Diperiksa', 'Sudah Diperiksa', 197806152023011001, 'R50', 'Demam tidak spesifik', 'Cek lanjutan disarankan', 44),
(36, 2, 199208052021122004, 6101010101010010, '2025-01-06', '08:00:00', 'Pemeriksaan Kehamilan Trimester 1', 'Tidak', 'Tidak', 'Tidak', 'Tidak', '110/70', '78', '20', '36.7', 'Tidak', 'Cek rutin kehamilan awal', 'Sudah Diperiksa', 'Sudah Diperiksa', 199011302023061006, 'Z34.0', 'Pemeriksaan kehamilan trimester pertama', 'Kehamilan normal, lanjut kontrol bulanan', 38),
(37, 2, 198901202024031003, 6101010101010009, '2025-01-08', '09:30:00', 'Kontrol KB Suntik', 'Tidak', 'Tidak', 'Tidak', 'Tidak', '115/72', '76', '18', '36.5', 'Tidak', 'Kontrol rutin pasca KB suntik 3 bulan', 'Sudah Diperiksa', 'Sudah Diperiksa', 198605072020081005, 'Z30.4', 'Pemeriksaan dan nasihat sehubungan dengan injeksi kontrasepsi', 'Tidak ada efek samping ditemukan', 40),
(38, 2, 199208052021122004, 6101010101010008, '2025-05-26', '10:45:00', 'Pemeriksaan Nifas', 'Tidak', 'Tidak', 'Tidak', 'Tidak', '118/74', '80', '19', '36.6', 'Tidak', 'Cek kondisi pasca melahirkan', 'Sudah Diperiksa', 'Sudah Diperiksa', 199011302023061006, 'Z39.0', 'Pemeriksaan dan perawatan pada masa nifas', 'Ibu dan bayi dalam kondisi baik', 41),
(39, 2, 198901202024031003, 6101010101010007, '2025-01-13', '13:20:00', 'Menstruasi tidak teratur', 'Tidak', 'Tidak', 'Tidak', 'Tidak', '120/76', '82', '20', '36.8', 'Tidak', 'Keluhan haid tidak teratur dan nyeri haid', 'Sudah Diperiksa', 'Sudah Diperiksa', 198605072020081005, 'N92.6', 'Menstruasi tidak teratur, tidak spesifik', 'Dianjurkan USG dan pola hidup sehat', 42),
(40, 2, 199208052021122004, 6101010101010006, '2025-01-16', '11:15:00', 'Pemeriksaan Kehamilan Trimester 2', 'Tidak', 'Tidak', 'Tidak', 'Tidak', '112/70', '75', '19', '36.9', 'Tidak', 'Cek rutin kehamilan, detak jantung janin terpantau', 'Sudah Diperiksa', 'Sudah Diperiksa', 199011302023061006, 'Z34.1', 'Pemeriksaan kehamilan trimester kedua', 'Perkembangan janin baik, kontrol 2 minggu lagi', 43),
(41, 3, 198703242020101001, 6101010101010001, '2025-01-03', '09:00:00', 'Sakit gigi bagian bawah kanan', 'Ya', 'Tidak', 'Tidak', 'Tidak', '120/80', '80', '20', '36.6', 'Tidak', 'Keluhan nyeri pada gigi geraham bawah', 'Sudah Diperiksa', 'Sudah Diperiksa', 199011302023061006, 'K04.0', 'Pulpitis', 'Diberikan analgesik, rencana perawatan saluran akar', 38),
(42, 3, 198605072020081005, 6101010101010002, '2025-01-06', '10:15:00', 'Karang gigi', 'Tidak', 'Tidak', 'Tidak', 'Tidak', '115/75', '76', '18', '36.5', 'Tidak', 'Pembersihan karang gigi (scaling)', 'Sudah Diperiksa', 'Sudah Diperiksa', 198512082009082005, 'K03.6', 'Deposit gigi (karang)', 'Scaling berhasil, edukasi kebersihan gigi', 40),
(43, 3, 198703242020101001, 6101010101010003, '2025-01-09', '11:00:00', 'Gusi bengkak dan berdarah', 'Tidak', 'Tidak', 'Tidak', 'Tidak', '118/74', '78', '20', '36.7', 'Tidak', 'Pembengkakan gusi bagian atas', 'Sudah Diperiksa', 'Sudah Diperiksa', 199011302023061006, 'K05.1', 'Gingivitis kronis', 'Diberikan antiseptik mulut, kontrol seminggu', 41),
(44, 3, 198605072020081005, 6101010101010004, '2025-01-12', '13:45:00', 'Gigi berlubang', 'Ya', 'Tidak', 'Tidak', 'Tidak', '122/80', '82', '19', '36.8', 'Tidak', 'Lubang pada gigi premolar', 'Sudah Diperiksa', 'Sudah Diperiksa', 199001202011102004, 'K02.1', 'Karies dentin', 'Dilakukan penambalan sementara, kontrol lanjutan', 42),
(45, 3, 198703242020101001, 6101010101010005, '2025-01-15', '08:30:00', 'Kontrol pasca pencabutan gigi', 'Tidak', 'Tidak', 'Tidak', 'Tidak', '116/72', '77', '18', '36.6', 'Tidak', 'Pengecekan luka pasca pencabutan gigi geraham', 'Sudah Diperiksa', 'Sudah Diperiksa', 199011302023061006, 'Z09.0', 'Kontrol setelah tindakan gigi', 'Luka membaik, tidak ada infeksi', 43),
(46, 4, 198703242020101001, 6101010101010010, '2025-01-04', '09:10:00', 'Demam dan nyeri tenggorokan', 'Ya', 'Ya', 'Tidak', 'Tidak', '119/79', '82', '20', '38.2', 'Tidak', 'Gejala ILI, pasien mengalami demam dan nyeri menelan', 'Sudah Diperiksa', 'Sudah Diperiksa', 199304152021041008, 'J06.9', 'Infeksi saluran napas atas, tidak spesifik', 'Diberikan antipiretik dan anjuran istirahat', 38),
(47, 4, 199105182021121002, 6101010101010009, '2025-05-26', '10:20:00', 'Batuk kering sejak 3 hari', 'Tidak', 'Tidak', 'Ya', 'Ya', '117/76', '78', '20', '37.8', 'Tidak', 'Gejala batuk dan pilek ringan', 'Sudah Diperiksa', 'Sudah Diperiksa', 197902172019101007, 'J00', 'Nasofaringitis akut (common cold)', 'Terapi simptomatik, edukasi isolasi mandiri', 40),
(48, 4, 198703242020101001, 6101010101010008, '2025-01-10', '14:00:00', 'Demam, pilek, dan sakit kepala', 'Ya', 'Ya', 'Ya', 'Ya', '124/84', '85', '21', '38.5', 'Tidak', 'Kondisi ILI, demam tinggi dengan pilek dan nyeri otot', 'Sudah Diperiksa', 'Sudah Diperiksa', 199304152021041008, 'J11.1', 'Influenza tanpa pneumonia', 'Dianjurkan istirahat total, diberikan antivirus', 41),
(49, 4, 199105182021121002, 6101010101010007, '2025-01-14', '11:45:00', 'Nyeri tenggorokan dan pilek ringan', 'Ya', 'Tidak', 'Tidak', 'Ya', '116/73', '76', '18', '37.3', 'Tidak', 'Infeksi saluran napas atas ringan', 'Sudah Diperiksa', 'Sudah Diperiksa', 197902172019101007, 'J02.9', 'Faringitis akut, tidak spesifik', 'Terapi lokal, disarankan konsumsi cairan hangat', 42),
(50, 4, 198703242020101001, 6101010101010006, '2025-01-18', '09:30:00', 'Batuk berdahak dan demam', 'Ya', 'Ya', 'Ya', 'Tidak', '121/80', '81', '19', '38.0', 'Tidak', 'Gejala ILI dengan kemungkinan infeksi sekunder', 'Sudah Diperiksa', 'Sudah Diperiksa', 199304152021041008, 'J10.1', 'Influenza akibat virus influenza, disertai manifestasi pernapasan lain', 'Dianjurkan kontrol ulang jika demam tidak turun', 43),
(90, 1, 199105182021121002, 6101010101010001, '2025-05-22', '08:22:01', 'Sakit kepala, demam, batuk dan pilek', 'Ya', 'Ya', 'Ya', 'Ya', '100/62', '80', '24', '36', 'Ya', 'sakit', 'Sudah Diperiksa', 'Sudah Diperiksa', 198409012022112002, 'R50', 'Demam tidak spesifik', 'Datang 3 hari lagi jika belum sembuh', 39),
(98, 1, 198703242020101001, 6101010101010001, '2025-05-26', '00:00:00', 'Sakit kepala, demam, batuk dan pilek', 'Ya', 'Ya', 'Ya', 'Ya', '100/62', '80', '24', '36', 'Ya', 'sakit', 'Sudah Diperiksa', 'Sudah Diperiksa', 198409012022112002, '12', 'Ispa', 'Cek lanjutan disarankan', 39),
(99, 1, 198703242020101001, 2020202020202020, '2025-05-27', '09:00:00', 'Sakit Kepala', 'Ya', 'Ya', 'Ya', 'Ya', '100/62', '80', '24', '36', 'Ya', 'Sakit', 'Sudah Diperiksa', 'Sudah Diperiksa', 198409012022112002, 'R50', 'Ispa', 'Datang 3 hari lagi jika belum sembuh', 23),
(101, 1, 198703242020101001, 2020202020202020, '2025-05-26', '11:59:50', 'Sakit Kepala', 'Ya', 'Ya', 'Ya', 'Ya', '100/62', '80', '24', '36', 'Ya', 'Sakit', 'Sudah Diperiksa', 'Sudah Diperiksa', 198409012022112002, 'J22', 'Ispa', 'Cek lanjutan disarankan', 23),
(102, 1, 198703242020101001, 6101010101010001, '2025-05-28', '10:59:54', 'Sakit Kepala', 'Ya', 'Ya', 'Ya', 'Ya', '100/62', '80', '24', '36', 'Ya', 'sakit', 'Sudah Diperiksa', 'Sudah Diperiksa', 198409012022112002, 'R50', 'Ispa', 'Cek lanjutan disarankan', 39),
(103, 1, 198703242020101001, 6101010101010001, '2025-06-03', '08:14:00', 'Sakit Kepala', 'Ya', 'Ya', 'Ya', 'Ya', '100/62', '80', '24', '36', 'Ya', 'sakit', 'Sudah Diperiksa', 'Belum Diperiksa', 0, '', '', '', 39);

-- --------------------------------------------------------

--
-- Table structure for table `resep_obat`
--

CREATE TABLE `resep_obat` (
  `id_resep` bigint(20) NOT NULL,
  `id_rm` bigint(20) NOT NULL,
  `kode_obat` varchar(20) NOT NULL,
  `dosis` varchar(100) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `status` enum('belum','sudah') DEFAULT 'belum'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `resep_obat`
--

INSERT INTO `resep_obat` (`id_resep`, `id_rm`, `kode_obat`, `dosis`, `jumlah`, `status`) VALUES
(1, 4, 'OBT-0001', 'sakit', 10, 'sudah'),
(57, 90, 'OBT-0002', '3 x 1 (Setelah Makan)', 20, 'sudah'),
(58, 98, 'OBT-0001', '3 x 1 (setelah makan)', 20, 'sudah'),
(61, 101, 'OBT-0001', '3 x 1 (setelah makan)', 20, 'sudah'),
(63, 99, 'OBT-0001', '3 x 1 (setelah makan)', 20, 'sudah'),
(64, 99, 'OBT-0003', '2 sfsafd', 10, 'sudah');

-- --------------------------------------------------------

--
-- Table structure for table `ruang`
--

CREATE TABLE `ruang` (
  `id_ruang` bigint(20) NOT NULL,
  `nama_ruang` varchar(100) NOT NULL,
  `tipe_ruang` enum('pelayanan','internal') NOT NULL DEFAULT 'pelayanan'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ruang`
--

INSERT INTO `ruang` (`id_ruang`, `nama_ruang`, `tipe_ruang`) VALUES
(1, 'Ruang Pemeriksaan Umum', 'pelayanan'),
(2, 'Ruang Pemeriksaan KIA-KB', 'pelayanan'),
(3, 'Ruang Pemeriksaan Gigi', 'pelayanan'),
(4, 'Ruang Pemeriksaan ILI', 'pelayanan'),
(5, 'Ruang Screening', 'internal'),
(6, 'Ruang Farmasi', 'internal');

-- --------------------------------------------------------

--
-- Table structure for table `surat_rujukan`
--

CREATE TABLE `surat_rujukan` (
  `id_rujukan` bigint(20) NOT NULL,
  `id_rm` bigint(20) NOT NULL,
  `no_rujukan` varchar(50) NOT NULL,
  `tanggal_rujukan` date NOT NULL,
  `fasilitas_tujuan` varchar(100) NOT NULL,
  `poli_tujuan` varchar(100) DEFAULT NULL,
  `alasan_rujukan` text DEFAULT NULL,
  `diagnosa` varchar(255) DEFAULT NULL,
  `ICD_10` varchar(20) DEFAULT NULL,
  `nip_pengirim` varchar(50) DEFAULT NULL,
  `nama_pengirim` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `surat_rujukan`
--

INSERT INTO `surat_rujukan` (`id_rujukan`, `id_rm`, `no_rujukan`, `tanggal_rujukan`, `fasilitas_tujuan`, `poli_tujuan`, `alasan_rujukan`, `diagnosa`, `ICD_10`, `nip_pengirim`, `nama_pengirim`, `created_at`) VALUES
(5, 90, 'RUJ-20250521-0001', '2025-05-21', 'sssss', 'ssssssssssss', 'tesss', 'Demam tidak spesifik', 'R50', '198409012022112002', 'dr. Siti Rohmah', '2025-05-21 20:06:03'),
(6, 98, 'RUJ-20250526-0001', '2025-05-26', 'Rumah Sakit', 'Bedah umum', 'saki', 'Ispa', '12', '198409012022112002', 'dr. Siti Rohmah', '2025-05-26 00:58:39'),
(7, 101, 'RUJ-20250526-0002', '2025-05-26', 'Rumah Sakit', 'Bedah umum', 'Sakit', 'Ispa', 'J22', '198409012022112002', 'dr. Siti Rohmah', '2025-05-26 05:27:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `distribusi_obat`
--
ALTER TABLE `distribusi_obat`
  ADD PRIMARY KEY (`id_distribusi`),
  ADD KEY `id_resep` (`id_resep`),
  ADD KEY `nip_petugas` (`nip_petugas`);

--
-- Indexes for table `dokter`
--
ALTER TABLE `dokter`
  ADD PRIMARY KEY (`nip_dokter`),
  ADD KEY `id_ruang` (`id_ruang`);

--
-- Indexes for table `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`kode_obat`);

--
-- Indexes for table `obat_masuk`
--
ALTER TABLE `obat_masuk`
  ADD PRIMARY KEY (`id_masuk`),
  ADD KEY `kode_obat` (`kode_obat`),
  ADD KEY `nip_petugas` (`nip_petugas`);

--
-- Indexes for table `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`nik_pasien`),
  ADD UNIQUE KEY `rm` (`rm`);

--
-- Indexes for table `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD PRIMARY KEY (`id_pengumuman`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`nip_petugas`),
  ADD KEY `id_ruang` (`id_ruang`);

--
-- Indexes for table `rekam_medis`
--
ALTER TABLE `rekam_medis`
  ADD PRIMARY KEY (`id_rm`),
  ADD KEY `id_ruang` (`id_ruang`),
  ADD KEY `nip_petugas` (`nip_petugas`),
  ADD KEY `nik_pasien` (`nik_pasien`),
  ADD KEY `nip_dokter` (`nip_dokter`);

--
-- Indexes for table `resep_obat`
--
ALTER TABLE `resep_obat`
  ADD PRIMARY KEY (`id_resep`),
  ADD KEY `id_rm` (`id_rm`),
  ADD KEY `fk_resep_obat_kode` (`kode_obat`);

--
-- Indexes for table `ruang`
--
ALTER TABLE `ruang`
  ADD PRIMARY KEY (`id_ruang`);

--
-- Indexes for table `surat_rujukan`
--
ALTER TABLE `surat_rujukan`
  ADD PRIMARY KEY (`id_rujukan`),
  ADD UNIQUE KEY `no_rujukan` (`no_rujukan`),
  ADD KEY `id_rm` (`id_rm`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `distribusi_obat`
--
ALTER TABLE `distribusi_obat`
  MODIFY `id_distribusi` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `obat_masuk`
--
ALTER TABLE `obat_masuk`
  MODIFY `id_masuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pasien`
--
ALTER TABLE `pasien`
  MODIFY `rm` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `pengumuman`
--
ALTER TABLE `pengumuman`
  MODIFY `id_pengumuman` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `rekam_medis`
--
ALTER TABLE `rekam_medis`
  MODIFY `id_rm` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `resep_obat`
--
ALTER TABLE `resep_obat`
  MODIFY `id_resep` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `ruang`
--
ALTER TABLE `ruang`
  MODIFY `id_ruang` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `surat_rujukan`
--
ALTER TABLE `surat_rujukan`
  MODIFY `id_rujukan` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `distribusi_obat`
--
ALTER TABLE `distribusi_obat`
  ADD CONSTRAINT `distribusi_obat_ibfk_1` FOREIGN KEY (`id_resep`) REFERENCES `resep_obat` (`id_resep`);

--
-- Constraints for table `obat_masuk`
--
ALTER TABLE `obat_masuk`
  ADD CONSTRAINT `obat_masuk_ibfk_1` FOREIGN KEY (`kode_obat`) REFERENCES `obat` (`kode_obat`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `resep_obat`
--
ALTER TABLE `resep_obat`
  ADD CONSTRAINT `fk_resep_obat_kode` FOREIGN KEY (`kode_obat`) REFERENCES `obat` (`kode_obat`) ON UPDATE CASCADE,
  ADD CONSTRAINT `resep_obat_ibfk_1` FOREIGN KEY (`id_rm`) REFERENCES `rekam_medis` (`id_rm`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `surat_rujukan`
--
ALTER TABLE `surat_rujukan`
  ADD CONSTRAINT `surat_rujukan_ibfk_1` FOREIGN KEY (`id_rm`) REFERENCES `rekam_medis` (`id_rm`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
