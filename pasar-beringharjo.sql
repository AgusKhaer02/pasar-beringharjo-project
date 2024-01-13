-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 13, 2024 at 08:30 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pasar-beringharjo`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `level` enum('superuser','admin') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `carosuel`
--

CREATE TABLE `carosuel` (
  `id` int NOT NULL,
  `carousel` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `subtitle` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` varchar(36) COLLATE utf8mb4_general_ci NOT NULL,
  `content` text COLLATE utf8mb4_general_ci NOT NULL,
  `status` enum('draft','published','archived','deleted') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'draft',
  `author` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `id_post` varchar(36) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` bigint NOT NULL,
  `media_type` enum('image','video') COLLATE utf8mb4_general_ci NOT NULL,
  `file_name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'default.png',
  `description` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `link_url` text COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `img_produk`
--

CREATE TABLE `img_produk` (
  `id` int NOT NULL,
  `id_produk` int NOT NULL,
  `img` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `img_produk`
--

INSERT INTO `img_produk` (`id`, `id_produk`, `img`) VALUES
(18, 309484, '1705027153_a12ca65b898a3e2fdcb2.png');

-- --------------------------------------------------------

--
-- Table structure for table `kritik`
--

CREATE TABLE `kritik` (
  `id` bigint NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `no_hp` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `content` text COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lokasi_pasar`
--

CREATE TABLE `lokasi_pasar` (
  `id` int NOT NULL,
  `bagian` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lokasi_pasar`
--

INSERT INTO `lokasi_pasar` (`id`, `bagian`) VALUES
(1, 'Beringharjo Barat (Pakaian)'),
(2, 'Beringharjo Timur (Makanan)'),
(3, 'Beringharjo Tengah (Kerajinan)');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` varchar(40) COLLATE utf8mb4_general_ci NOT NULL,
  `title` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `img` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `id_author` varchar(36) COLLATE utf8mb4_general_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `content` text COLLATE utf8mb4_general_ci NOT NULL,
  `tags` text COLLATE utf8mb4_general_ci NOT NULL,
  `status` enum('draft','published','archived','deleted') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'draft',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `title`, `img`, `id_author`, `slug`, `content`, `tags`, `status`, `created_at`, `updated_at`) VALUES
('b7006ebc-cb75-450b-afc6-cc104cf87793', 'Kuliah Kerja Nyata (KKN) di Pasar Beringharjo: Membangun Keterlibatan Masyarakat di Universitas Mercu Buana', '1703235838_f407e7ec954e38b52d72.jpg', '900d5535-a013-11ee-903f-1cb72c965d78', 'kuliah-kerja-nyata-kkn-di-pasar-beringharjo-membangun-keterlibatan-masyarakat-di-universitas-mercu-buana', '<p><span style=\"font-size: 14pt;\"><strong>Kuliah Kerja Nyata (KKN)</strong></span> merupakan bagian integral dari kurikulum di Universitas Mercu Buana, yang memberikan peluang kepada mahasiswa untuk berkontribusi secara langsung pada masyarakat. Salah satu lokasi yang dipilih untuk menjalankan program KKN adalah Pasar Beringharjo, sebuah pusat perdagangan tradisional di Yogyakarta yang kaya akan sejarah dan budaya.</p>\r\n<p>Dalam menjalankan KKN di <em>Pasar Beringharjo</em>, mahasiswa Universitas Mercu Buana memiliki fokus utama untuk membangun keterlibatan masyarakat sekitar. Mereka bekerja sama dengan pedagang, pengunjung, dan pihak terkait lainnya untuk meningkatkan kondisi pasar serta memberikan manfaat positif bagi semua pihak.</p>\r\n<p>Salah satu kegiatan utama yang dilakukan oleh mahasiswa adalah mengadakan program pelatihan dan workshop untuk para pedagang pasar. Materi yang diberikan meliputi strategi pemasaran, manajemen keuangan sederhana, dan penggunaan teknologi untuk meningkatkan daya saing usaha. Dengan demikian, diharapkan para pedagang dapat mengembangkan keterampilan mereka dan memperluas jangkauan pasar.</p>\r\n<p>Selain itu, mahasiswa juga terlibat dalam kegiatan sosial dan budaya. Mereka mengadakan acara seni dan budaya yang melibatkan komunitas sekitar, seperti pertunjukan seni tradisional dan pameran kerajinan lokal. Hal ini tidak hanya meningkatkan citra pasar sebagai destinasi wisata, tetapi juga memberikan peluang bagi para pelaku usaha lokal untuk memperluas jaringan dan meningkatkan pendapatan.</p>\r\n<p>Selama periode KKN, mahasiswa juga melakukan survei untuk mengidentifikasi masalah-masalah yang dihadapi oleh para pedagang dan pengunjung pasar. Hasil survei ini kemudian dijadikan dasar untuk mengusulkan solusi yang lebih berkelanjutan dan berdampak jangka panjang.</p>\r\n<p>Melalui kegiatan KKN di <em>Pasar Beringharjo</em>, mahasiswa Universitas Mercu Buana tidak hanya mendapatkan pengalaman praktis dalam menerapkan ilmu pengetahuan yang telah dipelajari di kelas, tetapi juga memberikan kontribusi positif kepada masyarakat. Mereka belajar untuk bekerja dalam tim, beradaptasi dengan lingkungan baru, dan menghargai keanekaragaman budaya yang ada di pasar tersebut.</p>\r\n<p>Secara keseluruhan, KKN di <em>Pasar Beringharjo</em> menjadi wadah bagi mahasiswa Universitas Mercu Buana untuk menjalankan tanggung jawab sosial mereka, merespons kebutuhan masyarakat, dan membantu memajukan sektor perdagangan lokal. Melalui kolaborasi ini, diharapkan dapat tercipta sinergi yang positif antara perguruan tinggi dan masyarakat, menciptakan dampak positif yang berkelanjutan dalam pembangunan komunitas.</p>', 'kkn', 'published', '2023-12-22 09:03:58', '2023-12-22 09:38:17'),
('d97dab5b-2e78-4d65-a778-2ea0b4953006', 'Membaur dalam Kehidupan Pasar Beringharjo Melalui KKN: Kontribusi Mahasiswa Universitas Mercu Buana', '1703238077_d8456f34f1693107ef5e.jpeg', '900d5535-a013-11ee-903f-1cb72c965d78', 'membaur-dalam-kehidupan-pasar-beringharjo-melalui-kkn-kontribusi-mahasiswa-universitas-mercu-buana', '<p><strong><span style=\"font-size: 18pt;\">Kuliah Kerja Nyata (KKN)</span></strong> di Universitas Mercu Buana memiliki dimensi yang unik dan berdaya dorong bagi mahasiswa untuk terlibat langsung dalam pemberdayaan masyarakat. Salah satu destinasi KKN yang menarik perhatian adalah Pasar Beringharjo di Yogyakarta, sebuah pusat perdagangan tradisional yang menjadi pusat kegiatan ekonomi dan budaya.</p>\r\n<p>Dalam menjalankan program KKN di Pasar Beringharjo, mahasiswa dari berbagai jurusan memiliki tujuan utama untuk membantu membangun keterlibatan masyarakat sekitar dan memberikan kontribusi positif pada perkembangan pasar. Langkah pertama yang diambil adalah memahami secara mendalam kebutuhan dan tantangan yang dihadapi oleh para pedagang dan pengunjung pasar.</p>\r\n<p>Melalui serangkaian kegiatan survei dan wawancara, mahasiswa mengidentifikasi beberapa isu krusial, termasuk permasalahan infrastruktur, pemasaran, dan tingkat daya saing pedagang lokal. Dengan pemahaman ini, mereka merancang program-program intervensi yang terukur dan berkelanjutan.</p>\r\n<p>Salah satu inisiatif yang dilakukan oleh mahasiswa adalah mengadakan lokakarya kecil dengan pedagang pasar. Materi yang disampaikan melibatkan strategi pemasaran modern, manajemen keuangan yang efisien, dan penggunaan teknologi sederhana untuk meningkatkan efisiensi bisnis. Mahasiswa tidak hanya berperan sebagai instruktur, tetapi juga sebagai fasilitator diskusi untuk saling bertukar pengalaman dan ide antarpedagang.</p>\r\n<p>Kegiatan sosial dan budaya juga menjadi bagian integral dari KKN di Pasar Beringharjo. Mahasiswa mengorganisir acara seni dan budaya yang melibatkan komunitas setempat. Pertunjukan seni tradisional, pameran kerajinan tangan lokal, dan kegiatan yang mendukung kesenian anak-anak menjadi sarana untuk mempererat hubungan antara pedagang, pengunjung pasar, dan masyarakat sekitar.</p>\r\n<p>Untuk mengatasi potensi duplikasi data, mahasiswa mengimplementasikan sistem penamaan unik pada inisiatif mereka. Melibatkan nomor identifikasi atau informasi yang bersifat unik, seperti nomor induk nasional pedagang atau nomor registrasi usaha, membantu memastikan bahwa setiap usaha memiliki identitas yang eksklusif.</p>\r\n<p>Dengan demikian, KKN di Pasar Beringharjo bukan hanya tentang memberikan solusi jangka pendek, tetapi juga menciptakan fondasi untuk perubahan positif jangka panjang. Melalui kerjasama yang erat dengan pihak pasar dan pengawas KKN, mahasiswa Universitas Mercu Buana berhasil membawa dampak positif pada lingkungan sekitar, sambil memperkaya pengalaman belajar mereka di luar kelas.</p>', 'tag', 'published', '2023-12-22 09:41:17', '2023-12-22 09:41:17');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int NOT NULL,
  `id_toko` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` int NOT NULL,
  `stok` enum('tersedia','tidak') COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `id_toko`, `slug`, `nama`, `jenis`, `harga`, `stok`, `description`) VALUES
(309484, '02af353e-2beb-4553-9d89-f313749c1b3b', 'agra-wibawa-merah', 'Agra Wibawa Merah', 'baju', 200000, 'tersedia', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `toko`
--

CREATE TABLE `toko` (
  `id_toko` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `coordinate` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_telp` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img_profile` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `img_cover` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lantai` int DEFAULT NULL,
  `password` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `verified` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `toko`
--

INSERT INTO `toko` (`id_toko`, `name`, `email`, `address`, `coordinate`, `no_telp`, `slug`, `img_profile`, `img_cover`, `lantai`, `password`, `verified`) VALUES
('02af353e-2beb-4553-9d89-f313749c1b3b', 'Toko Agus', 'aguskkhaerjobs@gmail.com', '62341 Jeanette Mountains', '{\"lat\":-7.798661,\"lng\":110.365318}', '08567773242', 'toko-agus', NULL, NULL, 1, '$2y$10$rWWBK0H9c9wZs/L58C7PpuER0UUM85EokTP0MVYj3KhsHkBDeCnK6', 0),
('12c50737-4db3-41a6-9d25-83a70cfebf68', 'asndnasdnl', 'asdal@gmail.com', NULL, '{\"lat\" : -7.798603, \"lng\" : 110.366104}', NULL, 'asndnasdnl', NULL, NULL, 1, '$2y$10$I.McRBlbrr8pAoMK8elKp.s0Z3DJTiGFJ53Cl6nVrigabLXJJihkG', 0),
('37691850-b1c0-11ee-ab68-c85b760e9f8a', 'asdasdasdasd', 'asdasdasd@yahoo.com', 'asdasd', '{\"lat\" : -7.798871, \"lng\" : 110.365958}', NULL, 'asdasdasdasd', NULL, NULL, 1, '', 0),
('37694036-b1c0-11ee-ab68-c85b760e9f8a', 'asdadsasd33', 'asdasdasd@outlook.com', NULL, '{\"lat\" : -7.798891, \"lng\" : 110.366613}', NULL, 'asdadsasd33', NULL, NULL, 1, '', 0),
('54c14387-0f7f-47cf-98ff-dce8d6464973', 'asndnasdnl', 'hohohohoo@gmail.com', NULL, '{\"lat\" :-7.798603, \"lng\" : 110.366104}', NULL, 'asndnasdnl', NULL, NULL, 1, '$2y$10$y.comtX4KrBDVBvWr6EchOgXZt2zIs3X7wGKClt89xcnKhw81ch8.', 0),
('ca328ea8-b1c0-11ee-ab68-c85b760e9f8a', 'asdasdasd2', 'asdaoopopop@gmail.com', NULL, '{\"lat\" : -7.798733, \"lng\" : 110.366685}', NULL, 'asdasdasd2', NULL, NULL, NULL, '', 0),
('ca32ac66-b1c0-11ee-ab68-c85b760e9f8a', '990909asd', '990909asd@gmail.com', 'asdaasdasdsfdgdhrtevcxc', '{\"lat\" : -7.799018, \"lng\" : 110.366528}', NULL, '990909asd', NULL, NULL, NULL, '', 0),
('ca32d1af-b1c0-11ee-ab68-c85b760e9f8a', 'googg323', 'ggggsad@gmail.com', NULL, '{\"lat\" : -7.798898, \"lng\" : 110.367220}', NULL, 'googg323', NULL, NULL, NULL, '', 0),
('ca32fb75-b1c0-11ee-ab68-c85b760e9f8a', 'wqerwtertttr', 'qwert!@gmail.com', NULL, '{\"lat\" : -7.798794, \"lng\" : 110.367638}', NULL, 'wqerwtertttr', NULL, NULL, NULL, '', 0),
('ca3313cd-b1c0-11ee-ab68-c85b760e9f8a', 'sdfsgdfgdfg', 'sdfsdfs@gmail.com', NULL, '{\"lat\" : -7.798782, \"lng\" : 110.367986}', NULL, 'sdfsgdfgdfg', NULL, NULL, NULL, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `toko_email_confirm`
--

CREATE TABLE `toko_email_confirm` (
  `id` int NOT NULL,
  `id_toko` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expired_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `toko_email_confirm`
--

INSERT INTO `toko_email_confirm` (`id`, `id_toko`, `code`, `expired_at`) VALUES
(14, '02af353e-2beb-4553-9d89-f313749c1b3b', '616bbaf1-e9e8-45a7-bdf8-a0e903588f81', '2024-01-11 22:28:38'),
(15, '12c50737-4db3-41a6-9d25-83a70cfebf68', '4772c016-2405-42b4-ab52-6dd61a961b4d', '2024-01-13 10:13:54'),
(16, '54c14387-0f7f-47cf-98ff-dce8d6464973', 'a87db9aa-0c87-4eae-9b8c-679d26611e01', '2024-01-13 10:14:13');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` varchar(36) COLLATE utf8mb4_general_ci NOT NULL,
  `fullname` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `password` char(60) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `image-profile` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `bg-profile` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `quotes` text COLLATE utf8mb4_general_ci,
  `status` enum('active','suspended') COLLATE utf8mb4_general_ci NOT NULL,
  `level` enum('user','author') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `fullname`, `username`, `password`, `email`, `image-profile`, `bg-profile`, `quotes`, `status`, `level`) VALUES
('900d5535-a013-11ee-903f-1cb72c965d78', 'Agus Kurniadin Khaer', 'AgusKhaer02', 'agus', 'aguskhaer@gmail.com', 'default.png', 'default.png', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quo alias numquam rem facere ut repellendus natus consequuntur soluta consequatur placeat!', 'active', 'author');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `carosuel`
--
ALTER TABLE `carosuel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_post` (`id_post`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `img_produk`
--
ALTER TABLE `img_produk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indexes for table `kritik`
--
ALTER TABLE `kritik`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lokasi_pasar`
--
ALTER TABLE `lokasi_pasar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `id_author` (`id_author`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_toko` (`id_toko`);

--
-- Indexes for table `toko`
--
ALTER TABLE `toko`
  ADD PRIMARY KEY (`id_toko`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `toko_email_confirm`
--
ALTER TABLE `toko_email_confirm`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_toko` (`id_toko`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `img_produk`
--
ALTER TABLE `img_produk`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `kritik`
--
ALTER TABLE `kritik`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lokasi_pasar`
--
ALTER TABLE `lokasi_pasar`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=309485;

--
-- AUTO_INCREMENT for table `toko_email_confirm`
--
ALTER TABLE `toko_email_confirm`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`id_post`) REFERENCES `post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `img_produk`
--
ALTER TABLE `img_produk`
  ADD CONSTRAINT `img_produk_ibfk_1` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`id_author`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_ibfk_1` FOREIGN KEY (`id_toko`) REFERENCES `toko` (`id_toko`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `toko_email_confirm`
--
ALTER TABLE `toko_email_confirm`
  ADD CONSTRAINT `toko_email_confirm_ibfk_1` FOREIGN KEY (`id_toko`) REFERENCES `toko` (`id_toko`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
