-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2024 at 11:54 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `19024_psas`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbadmin`
--

CREATE TABLE `tbadmin` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbadmin`
--

INSERT INTO `tbadmin` (`id`, `nama`, `password`) VALUES
(1, 'AdminHans', '558b363bc235f3d9b85d22716dda8cc9'),
(2, 'CoAdmin', 'f400e5f5671721f00184c353bd356720');

-- --------------------------------------------------------

--
-- Table structure for table `tbkendaraan`
--

CREATE TABLE `tbkendaraan` (
  `id` int(11) NOT NULL,
  `jenis` varchar(50) NOT NULL,
  `seri` varchar(255) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `tarif` decimal(10,2) NOT NULL,
  `durasi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbkendaraan`
--

INSERT INTO `tbkendaraan` (`id`, `jenis`, `seri`, `keterangan`, `foto`, `tarif`, `durasi`) VALUES
(1, 'Bus Besar', 'Jetbus 5 MHD - Mercedes Benz Oh 1626 NG Euro 4 - Air Suspension', 'Jetbus 5 MHD dengan mesin Mercedes Benz OH 1626 New Generation Euro 4 dan sistem suspensi udara (air suspension) adalah bus mewah yang menawarkan kenyamanan dan performa optimal. Ditenagai oleh mesin Mercedes Benz yang tangguh dan ramah lingkungan, bus ini dilengkapi dengan teknologi Euro 4 yang mengurangi emisi gas buang. Suspensi udara memberikan pengalaman berkendara yang halus dan stabil, membuat penumpang merasa nyaman meskipun melalui jalan yang bergelombang. Desain Jetbus 5 MHD modern, luas, dan elegan, menjadikannya pilihan tepat untuk perjalanan jarak jauh atau tur perusahaan.', '674b49ee395840.48209632.jpg', 2000000.00, 1),
(2, 'Bus Sleeper', 'Jetbus 5 DC - Mercedes Benz Oh 1626 NG Euro 4 - Air Suspension', 'Jetbus 5 DC/Dream Coach adalah bus sleeper premium yang dirancang untuk kenyamanan maksimal dalam perjalanan jarak jauh. Dilengkapi dengan mesin Mercedes Benz OH 1626 New Generation Euro 4, bus ini menawarkan performa yang andal dan efisiensi bahan bakar yang lebih baik, serta memenuhi standar emisi Euro 4 yang ramah lingkungan. Dengan sistem suspensi udara (air suspension), kendaraan ini memberikan kenyamanan ekstra dengan pengendalian yang lebih halus, meskipun melintasi jalan yang tidak rata. Desain Dream Coach ini menyajikan tempat tidur yang nyaman bagi penumpang, menjadikannya pilihan ideal untuk perjalanan malam atau tur yang memerlukan istirahat sepanjang perjalanan.', '674ae99379ae23.88294983.jpg', 3000000.00, 1),
(3, 'Bus Tingkat', 'Jetbus 5 SDD - Volvo B11R Euro 5 - I Shift', 'Jetbus 5 SDD (Double Deck) adalah bus tingkat yang mewah dan modern, dirancang untuk memberikan kenyamanan dan pengalaman berkendara yang luar biasa. Ditenagai oleh mesin Volvo B11R Euro 5 yang bertenaga dan ramah lingkungan, bus ini menawarkan performa optimal dengan emisi yang lebih rendah sesuai standar Euro 5. Transmisi I-Shift yang canggih memungkinkan perpindahan gigi yang halus dan efisien, menjamin kelancaran perjalanan. Dengan desain dua lantai yang luas, Jetbus 5 SDD memberikan kapasitas penumpang yang lebih banyak tanpa mengorbankan kenyamanan, menjadikannya pilihan sempurna untuk perjalanan jarak jauh, tur wisata, atau transportasi grup besar.', '674aea24cd5142.97975032.jpg', 5000000.00, 1),
(4, 'Bus Medium', 'Jetbus 5 MD - Mercedes Benz OF 917 NG Euro 4 - Soft Suspension', 'Jetbus 5 MD (Medium Bus) adalah pilihan ideal untuk perjalanan jarak menengah dengan kombinasi kenyamanan dan efisiensi. Ditenagai oleh mesin Mercedes Benz OF 917 New Generation Euro 4, bus ini menawarkan performa yang handal dan ramah lingkungan dengan emisi yang sesuai standar Euro 4. Dilengkapi dengan sistem suspensi lembut (soft suspension), bus ini memberikan kenyamanan maksimal bagi penumpang, bahkan saat melintasi jalan yang sedikit bergelombang. Desainnya yang modern dan fungsional, dengan kapasitas penumpang yang cukup besar, menjadikan Jetbus 5 MD sempurna untuk kebutuhan transportasi antar kota atau perjalanan wisata dengan kenyamanan ekstra.', '674aed01057d85.84315101.jpg', 1000000.00, 1),
(5, 'Mini Bus', 'Jetbus 5 Jumbo - Mercedes Benz OF 917 NG Euro 4 - Coil Spring Suspension', 'Jetbus 5 Jumbo (Mini Bus) adalah kendaraan yang ideal untuk perjalanan dalam kota atau antar kota dengan kapasitas penumpang yang lebih kecil namun tetap mengutamakan kenyamanan. Ditenagai oleh mesin Mercedes Benz OF 917 New Generation Euro 4, bus ini menawarkan kinerja yang kuat dan efisien dengan emisi ramah lingkungan yang memenuhi standar Euro 4. Dilengkapi dengan suspensi keong (Coil Spring Suspension), bus ini memberikan pengalaman berkendara yang halus dan nyaman meskipun melintasi jalan yang kurang rata. Dengan desain kompak dan elegan, Jetbus 5 Jumbo cocok untuk berbagai keperluan, seperti transportasi wisata, angkutan karyawan, atau acara keluarga, memberikan kenyamanan dengan kapasitas yang lebih praktis.', '674aed6dc25e80.08804672.jpg', 750000.00, 1),
(6, 'Mobil', 'Mercedes-Benz All New GLC 300 Coupe', 'Mercedes-Benz All New GLC 300 Coupe adalah pilihan sempurna bagi Anda yang mencari pengalaman berkendara mewah dan sporty. Dengan desain eksterior yang dinamis dan elegan, serta performa tangguh berkat mesin 2.0 liter 4-silinder turbocharged yang menghasilkan 255 horsepower, GLC 300 Coupe siap memberikan kenyamanan dan sensasi berkendara luar biasa. Dilengkapi dengan teknologi canggih seperti sistem infotainment MBUX, kamera 360 derajat, serta berbagai fitur keselamatan seperti pengereman darurat aktif dan cruise control adaptif, mobil ini memberikan rasa aman dan nyaman di setiap perjalanan. Suspensi udara yang disempurnakan memastikan kenyamanan dalam berbagai kondisi jalan, menjadikannya pilihan ideal untuk disewa, baik untuk perjalanan bisnis, acara spesial, atau liburan mewah.', '674b4f4596d9d1.73379009.jpg', 2500000.00, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbpelanggan`
--

CREATE TABLE `tbpelanggan` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `notelp` varchar(15) NOT NULL,
  `totalpembayaran` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbpelanggan`
--

INSERT INTO `tbpelanggan` (`id`, `nama`, `nik`, `alamat`, `notelp`, `totalpembayaran`) VALUES
(17, 'test', '6666666', 'Gembongan', '0812-2648-8885', 1500000.00),
(18, 'Hacky Zalman Alvista', '55666', 'Gembongan', '0823-1386-1862', 1500000.00);

-- --------------------------------------------------------

--
-- Table structure for table `tbsyaratsewa`
--

CREATE TABLE `tbsyaratsewa` (
  `id` int(11) NOT NULL,
  `persyaratan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbsyaratsewa`
--

INSERT INTO `tbsyaratsewa` (`id`, `persyaratan`) VALUES
(1, ' Untuk menyewa bus, pelanggan diwajibkan mengisi formulir penyewaan yang mencakup informasi lengkap seperti nama lengkap, NIK, alamat tempat tinggal, nomor telepon yang dapat dihubungi, serta data tambahan seperti tujuan perjalanan, tanggal dan waktu keberangkatan, serta estimasi durasi penggunaan bus. Selain itu, pelanggan wajib mendatangi kantor pusat untuk menyelesaikan proses administrasi, melakukan verifikasi identitas, dan pengambilan unit bus yang disewa. Sebelum keberangkatan, bus yang disewa harus diisi bahan bakarnya sepenuhnya oleh pelanggan, dan setiap penggunaan bahan bakar harus dicatat dalam laporan yang diserahkan kepada pihak penyewa.  Kendaraan yang disewa harus dijaga dengan baik, dan jika terjadi kerusakan fisik, kehilangan, atau penyalahgunaan selama masa sewa, pelanggan akan dikenakan sanksi berupa denda sesuai dengan nilai kerusakan atau kehilangan yang ditentukan oleh pihak penyewa. Pengembalian bus harus dilakukan tepat waktu dan dalam kondisi bersih serta tanpa kerusakan, dengan pemeriksaan kendaraan yang akan dilakukan oleh petugas saat pengembalian.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbadmin`
--
ALTER TABLE `tbadmin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbkendaraan`
--
ALTER TABLE `tbkendaraan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbpelanggan`
--
ALTER TABLE `tbpelanggan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nik` (`nik`);

--
-- Indexes for table `tbsyaratsewa`
--
ALTER TABLE `tbsyaratsewa`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbadmin`
--
ALTER TABLE `tbadmin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbkendaraan`
--
ALTER TABLE `tbkendaraan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbpelanggan`
--
ALTER TABLE `tbpelanggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbsyaratsewa`
--
ALTER TABLE `tbsyaratsewa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
