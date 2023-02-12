-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 12, 2023 at 03:10 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `agendarapat`
--

-- --------------------------------------------------------

--
-- Table structure for table `absensi`
--

CREATE TABLE `absensi` (
  `id_absensi` char(30) NOT NULL,
  `id_rapat` char(30) NOT NULL,
  `pimpinan_rapat` varchar(255) NOT NULL,
  `peserta` varchar(255) NOT NULL,
  `waktu` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `absensi`
--

INSERT INTO `absensi` (`id_absensi`, `id_rapat`, `pimpinan_rapat`, `peserta`, `waktu`) VALUES
('ABSN01', 'RPT01', 'Kepala Kantor Cabang', 'Kabid Kepesertaan KSI, Kabid Kepesertaan Khusus, Kepala Kantor Cabang, Kabid Pelayanan, Kabid Keuangan', '2022-12-14 03:15:00'),
('ABSN02', 'RPT02', 'Kabid Kepesertaan Khusus', 'Kabid Kepesertaan Khusus, Bidang Kepesertaan Khusus', '2022-12-17 14:30:00'),
('ABSN03', 'RPT03', 'Kepala Kantor Cabang', 'Kabid Kepesertaan Khusus', '2022-12-19 02:30:00'),
('ABSN04', 'RPT04', 'Kepala Kantor Cabang', 'Kabid Kepesertaan KSI, Kabid Kepesertaan Khusus', '2022-12-20 02:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `agenda`
--

CREATE TABLE `agenda` (
  `id_rapat` char(30) NOT NULL,
  `hari` varchar(100) NOT NULL,
  `tanggal` date NOT NULL,
  `waktu` time NOT NULL,
  `ruangan` varchar(100) NOT NULL,
  `acara` varchar(255) NOT NULL,
  `pimpinan_rapat` varchar(255) NOT NULL,
  `peserta` varchar(255) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `agenda`
--

INSERT INTO `agenda` (`id_rapat`, `hari`, `tanggal`, `waktu`, `ruangan`, `acara`, `pimpinan_rapat`, `peserta`, `status`) VALUES
('RPT01', 'Senin', '2022-12-12', '04:08:10', 'RPTLT02', 'Evaluasi Kinerja Anak Magang', 'Kepala Kantor Cabang', 'Kabid Kepesertaan KSI, Kabid Kepesertaan Khusus, Kepala Kantor Cabang, Kabid Pelayanan, Kabid Keuangan', 'Belum Mulai'),
('RPT02', 'Selasa', '2022-12-13', '12:49:00', 'PANTRYLT01', 'Monitoring Kinerja Karyawan', ' Kabid Kepesertaan Khusus', 'Kabid Kepesertaan Khusus, Bidang Kepesertaan Khusus', 'Belum Mulai'),
('RPT03', 'Selasa', '2022-12-13', '16:05:00', 'RPTLT01', 'Monitoring Kinerja Pelayanan BPJS', 'Kepala Kantor Cabang', 'Kabid Kepesertaan Khusus', 'Belum Mulai'),
('RPT04', 'Rabu', '2022-12-13', '23:23:00', 'RPTLT01', 'Vioting Peserta', ' Kabid Kepesertaan KSI', 'Kabid Kepesertaan KSI, Bidang Kepesertaan Khusus', 'Belum Mulai'),
('RPT05', 'Jumat', '2025-02-04', '14:45:00', 'PANTRYLT01', 'Test2', 'Kepala Kantor Cabang', 'Kabid Kepesertaan KSI, Kabid Kepesertaan Khusus, Kepala Kantor Cabang, Kabid Pelayanan', 'Selesai'),
('RPT06', 'Selasa', '0002-02-02', '21:03:00', 'RPTLT01', 'we', 'Bidang Kearsipan', 'Kabid Kepesertaan KSI', 'Belum Mulai');

-- --------------------------------------------------------

--
-- Table structure for table `notulen`
--

CREATE TABLE `notulen` (
  `id_notulen` char(30) NOT NULL,
  `id_rapat` char(30) NOT NULL,
  `id_absensi` char(30) NOT NULL,
  `notulen` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notulen`
--

INSERT INTO `notulen` (`id_notulen`, `id_rapat`, `id_absensi`, `notulen`) VALUES
('NTLN01', 'RPT01', 'ABSN01', 'Kesimpulannya adalah kinerja anak magang satabil dan perlu dilakukan monitoring agar menjaga kestabilan kerja yang baik, sehingga memungkinkan untuk tidak mudah salah saat bekerja dikantor'),
('NTLN02', 'RPT02', 'ABSN02', 'sssss\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `peserta`
--

CREATE TABLE `peserta` (
  `no` int(11) NOT NULL,
  `peserta` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `peserta`
--

INSERT INTO `peserta` (`no`, `peserta`) VALUES
(1, 'Kabid Kepesertaan KSI'),
(2, 'Kabid Kepesertaan Khusus'),
(3, 'Kepala Kantor Cabang'),
(5, 'Kabid Pelayanan'),
(6, 'Kabid Keuangan'),
(7, 'Bidang Umum & SDM'),
(8, 'Bidang Kepesertaan Khusus'),
(9, 'Bidang Umum'),
(10, 'Bidang Kearsipan');

-- --------------------------------------------------------

--
-- Table structure for table `ruangan`
--

CREATE TABLE `ruangan` (
  `no` int(11) NOT NULL,
  `nama_ruangan` varchar(100) NOT NULL,
  `tempat` varchar(100) NOT NULL,
  `kapasitas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ruangan`
--

INSERT INTO `ruangan` (`no`, `nama_ruangan`, `tempat`, `kapasitas`) VALUES
(1, 'RPTLT01', 'BPJS Ketenagakerjaan Cabang Serang', 20),
(2, 'RPTLT02', 'BPJS Ketenagakerjaan Cabang Serang', 20),
(3, 'PANTRYLT01', 'BPJS Ketenagakerjaan Cabang Serang', 10);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(60) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `bidang` varchar(100) NOT NULL,
  `jabatan` varchar(100) NOT NULL,
  `level` enum('Admin','User') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama`, `bidang`, `jabatan`, `level`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Joni Jumanji', 'Kearsipan', 'Sekertaris', 'Admin'),
(2, 'titon', '202cb962ac59075b964b07152d234b70', 'Titon Meisya Kresna', 'Bidang Umum', 'Pegawai', 'User'),
(5, 'jamaludin', '7363a0d0604902af7b70b271a0b96480', 'Jamaluddin', 'Bidang Kepesertaan', 'Staff', 'User'),
(6, 'titon', '940a8df7d359963b805f92e125dabecf', 'Tin', 'Bidang Keuangan', 'Staff', 'User'),
(7, 'titon19', '43522ad2d366ce91a24fa72ba46c75e5', 'Titon', 'Umum', 'Pegawai', 'User');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id_absensi`),
  ADD KEY `id_rapat` (`id_rapat`);

--
-- Indexes for table `agenda`
--
ALTER TABLE `agenda`
  ADD PRIMARY KEY (`id_rapat`);

--
-- Indexes for table `notulen`
--
ALTER TABLE `notulen`
  ADD PRIMARY KEY (`id_notulen`),
  ADD KEY `id_rapat` (`id_rapat`),
  ADD KEY `id_absensi` (`id_absensi`);

--
-- Indexes for table `peserta`
--
ALTER TABLE `peserta`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `ruangan`
--
ALTER TABLE `ruangan`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `peserta`
--
ALTER TABLE `peserta`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `ruangan`
--
ALTER TABLE `ruangan`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `absensi`
--
ALTER TABLE `absensi`
  ADD CONSTRAINT `absensi_ibfk_1` FOREIGN KEY (`id_rapat`) REFERENCES `agenda` (`id_rapat`);

--
-- Constraints for table `notulen`
--
ALTER TABLE `notulen`
  ADD CONSTRAINT `notulen_ibfk_1` FOREIGN KEY (`id_rapat`) REFERENCES `agenda` (`id_rapat`),
  ADD CONSTRAINT `notulen_ibfk_2` FOREIGN KEY (`id_absensi`) REFERENCES `absensi` (`id_absensi`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
