-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 29 Bulan Mei 2023 pada 08.15
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `esterlaundry`
--

DELIMITER $$
--
-- Fungsi
--
CREATE DEFINER=`root`@`localhost` FUNCTION `jmlPenghasilan` (`tanggal_awal` DATETIME, `tanggal_akhir` DATETIME) RETURNS INT(11)  BEGIN 
	DECLARE jmlHasil INT;
	SELECT sum(
			(
			((paket.harga_paket * detail_transaksi.kuantitas + detail_transaksi.biaya_tambahan) ) - 
			(((paket.harga_paket * detail_transaksi.kuantitas + detail_transaksi.biaya_tambahan) ) * transaksi.diskon / 100)
			) 
			+ 
			((
			(((paket.harga_paket * detail_transaksi.kuantitas + detail_transaksi.biaya_tambahan) ) - 
			(((paket.harga_paket * detail_transaksi.kuantitas + detail_transaksi.biaya_tambahan) ) * transaksi.diskon / 100)) 
			* transaksi.pajak
			) / 100)
		) as penghasilan INTO jmlHasil
		FROM transaksi
		INNER JOIN user ON transaksi.id_user = user.id_user 
		INNER JOIN detail_transaksi ON transaksi.id_transaksi = detail_transaksi.id_transaksi 
		INNER JOIN paket ON detail_transaksi.id_paket = paket.id_paket 
		 WHERE transaksi.tanggal_transaksi 
		BETWEEN tanggal_awal AND tanggal_akhir AND status_bayar != 'belum dibayar';
	RETURN jmlHasil;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `jmlStatusTanggal` (`st` ENUM('proses','dicuci','siap diambil','sudah diambil'), `tgl` DATE) RETURNS INT(11) NO SQL BEGIN
DECLARE jmlHasil INT;
SELECT COUNT(*) AS jml INTO jmlHasil FROM transaksi WHERE status_transaksi = st AND date(tanggal_transaksi) = tgl;
RETURN jmlHasil;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `jmlTransPaket` (`idPaket` INT) RETURNS INT(11)  BEGIN
DECLARE jmlHasil INT;
	SELECT COUNT(*) as jml INTO jmlHasil FROM detail_transaksi WHERE id_paket = idPaket;
    RETURN jmlHasil;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `biodata`
--

CREATE TABLE `biodata` (
  `id_biodata` int(11) NOT NULL,
  `nama_lengkap` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `telepon` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8_unicode_ci NOT NULL,
  `foto` text COLLATE utf8_unicode_ci NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `biodata`
--

INSERT INTO `biodata` (`id_biodata`, `nama_lengkap`, `telepon`, `email`, `alamat`, `foto`, `id_user`) VALUES
(20, 'Timothy Priambodo Hartono', '', '', 'Jl. Baturaden', 'default.png', 29);

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `id_detail_transaksi` int(11) NOT NULL,
  `kuantitas` float NOT NULL,
  `keterangan` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `biaya_tambahan` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `id_paket` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`id_detail_transaksi`, `kuantitas`, `keterangan`, `biaya_tambahan`, `id_transaksi`, `id_paket`) VALUES
(406, 5, '', 1000, 277, 17),
(407, 3, '', 10000, 278, 1),
(408, 5, '', 20000, 278, 18),
(409, 5, 'ascd', 1500, 279, 13),
(410, 2, 'abc', 10000, 279, 17),
(411, 2, 'bcde', 10000, 281, 1),
(412, 2, 'abc', 10000, 281, 2),
(415, 4, 'tambah pewangi', 5000, 283, 1),
(416, 2, 'Baju 2x Celana 1x Jaket 2x', 3000, 283, 2),
(417, 2, 'Tambahan pewangi', 5000, 284, 1),
(418, 2, 'Double Plastik', 2000, 284, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `paket`
--

CREATE TABLE `paket` (
  `id_paket` int(11) NOT NULL,
  `nama_paket` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `harga_paket` int(11) NOT NULL,
  `satuan` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `layanan` enum('Reguler','Ekspress') COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `paket`
--

INSERT INTO `paket` (`id_paket`, `nama_paket`, `harga_paket`, `satuan`, `layanan`) VALUES
(1, 'Cuci, Setrika, Lipat', 5000, 'Kilogram', 'Reguler'),
(2, 'Cuci, Lipat', 4000, 'Kilogram', 'Reguler'),
(13, 'Helm Ekspress', 20000, 'Pcs', 'Ekspress'),
(17, 'Setrika Ekspress', 30000, 'Pcs', 'Ekspress'),
(18, 'Tas', 12000, 'Pcs', 'Reguler'),
(24, 'Cuci Ekspress', 8000, 'Kilogram', 'Ekspress');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL,
  `uang_yg_dibayar` int(11) NOT NULL,
  `kembalian` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_transaksi`, `total_harga`, `uang_yg_dibayar`, `kembalian`) VALUES
(73, 277, 151000, 151000, 0),
(74, 278, 105000, 120000, 15000),
(75, 283, 36000, 40000, 4000),
(76, 284, 25000, 25000, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `kode_invoice` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `nama_pelanggan` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `no_hp_pelanggan` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `alamat_pelanggan` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `tanggal_transaksi` datetime NOT NULL,
  `batas_waktu` datetime NOT NULL,
  `tanggal_bayar` datetime NOT NULL,
  `diskon` float NOT NULL,
  `pajak` int(11) NOT NULL,
  `status_transaksi` enum('proses','dicuci','siap diambil','sudah diambil') COLLATE utf8_unicode_ci NOT NULL,
  `status_bayar` enum('belum dibayar','sudah dibayar') COLLATE utf8_unicode_ci NOT NULL,
  `layanan` enum('Reguler','Ekspress') COLLATE utf8_unicode_ci NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `kode_invoice`, `nama_pelanggan`, `no_hp_pelanggan`, `alamat_pelanggan`, `tanggal_transaksi`, `batas_waktu`, `tanggal_bayar`, `diskon`, `pajak`, `status_transaksi`, `status_bayar`, `layanan`, `id_user`) VALUES
(277, '2605202329T0006', 'Sachi', '6285771621080', '', '2023-05-26 05:06:50', '2023-05-27 05:06:00', '2023-05-26 05:07:18', 0, 0, 'dicuci', 'sudah dibayar', 'Ekspress', 29),
(278, '2605202329T0007', 'sasta', '85771621080', '', '2023-05-26 05:08:06', '2023-05-29 05:08:00', '2023-05-26 05:08:48', 0, 0, 'proses', 'sudah dibayar', 'Reguler', 29),
(279, '2605202329T0008', 'Aulia', '6285771621080', '', '2023-05-26 05:09:48', '2023-05-27 05:09:00', '0000-00-00 00:00:00', 0, 0, 'dicuci', 'belum dibayar', 'Ekspress', 29),
(281, '2605202329T0009', 'Aulia', '6285771621080', '', '2023-05-26 10:09:32', '2023-05-28 10:09:00', '0000-00-00 00:00:00', 0, 0, 'proses', 'belum dibayar', 'Reguler', 29),
(283, '2605202329T0010', 'Sachi', '6285771621080', '', '2023-05-26 13:42:53', '2023-05-29 13:42:00', '2023-05-26 13:44:03', 0, 0, 'proses', 'sudah dibayar', 'Reguler', 29),
(284, '2705202329T0001', 'Aulia', '6285771621080', 'Jl. Hajidimun XI', '2023-05-27 13:26:20', '2023-05-30 13:26:00', '2023-05-27 13:37:02', 0, 0, 'proses', 'sudah dibayar', 'Reguler', 29);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`) VALUES
(29, 'timothy123', '$2y$10$ySHJLk8GAhLVSQkwVkrPEeyRy1SFKniGThhTqRg6bLIAxTQlpJqrm');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `biodata`
--
ALTER TABLE `biodata`
  ADD PRIMARY KEY (`id_biodata`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD PRIMARY KEY (`id_detail_transaksi`),
  ADD KEY `id_transaksi` (`id_transaksi`),
  ADD KEY `id_paket` (`id_paket`);

--
-- Indeks untuk tabel `paket`
--
ALTER TABLE `paket`
  ADD PRIMARY KEY (`id_paket`);

--
-- Indeks untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`),
  ADD KEY `id_transaksi` (`id_transaksi`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `biodata`
--
ALTER TABLE `biodata`
  MODIFY `id_biodata` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  MODIFY `id_detail_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=419;

--
-- AUTO_INCREMENT untuk tabel `paket`
--
ALTER TABLE `paket`
  MODIFY `id_paket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=285;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `biodata`
--
ALTER TABLE `biodata`
  ADD CONSTRAINT `biodata_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD CONSTRAINT `detail_transaksi_ibfk_1` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_transaksi_ibfk_2` FOREIGN KEY (`id_paket`) REFERENCES `paket` (`id_paket`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_2` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
