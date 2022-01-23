-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 07 Des 2020 pada 04.05
-- Versi server: 10.1.37-MariaDB
-- Versi PHP: 7.0.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e-school`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `app_api`
--

CREATE TABLE `app_api` (
  `id` int(11) NOT NULL,
  `mailsender_address` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mailsender_password` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `app_banner`
--

CREATE TABLE `app_banner` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `nip` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `text` text COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `app_banner`
--

INSERT INTO `app_banner` (`id`, `name`, `nip`, `text`, `image`) VALUES
(1, 'Drs. Wiyono, M.M', '19620629 198803 1 008', '<p>Selamat datang di SMA N 1 SUKODADI, Tetap belajar yang giat, jaga jarak jangan lupa cuci tangan dan tetap menggunakan masker. Meskipun kegiatan belajar mengajar belum bisa berjalan baik, saya berikan semangat dan dukungan agar jangan lupa untuk selalu belajar dan berbagi ilmu.</p>\r\n\r\n<blockquote>\r\n<p><strong>Karena Bangsa Yang Besar Adalah Bangsa Yang Mau Belajar Dari Kesalahan</strong></p>\r\n</blockquote>\r\n\r\n<p>Mohon gunakan sistem ini dengan&nbsp;bijak dan baik, agar kegiatan belajar mengajar bisa di laksana dengan lacar.<br />\r\nDrs. Wiyono, M.M</p>', '69A1B2AE-25E5-4087-9C25-47849583A84A.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `app_menu`
--

CREATE TABLE `app_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(128) NOT NULL,
  `url` varchar(50) NOT NULL,
  `order` int(2) NOT NULL,
  `icon` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `app_menu`
--

INSERT INTO `app_menu` (`id`, `menu`, `url`, `order`, `icon`) VALUES
(1, 'Setting', 'setting', 10, 'fa fa-gear'),
(2, 'Post', 'post', 5, 'fa fa-book'),
(3, 'Dashboard', 'dashboard', 1, 'fa fa-home'),
(6, 'User', 'user', 8, 'fa fa-users'),
(7, 'Tools', 'tools', 8, 'fa fa-wrench'),
(8, 'Media', 'Media', 6, 'fa fa-file-image-o'),
(11, 'Pages', 'pages', 4, 'fa fa-file-text'),
(12, 'Home Page Setting', 'homepage', 3, 'fa fa-globe'),
(13, 'Data Siswa', 'member', 2, 'fa fa-users'),
(14, 'Guru', 'pengajar', 3, 'fa fa-institution'),
(15, 'Tugas & Materi', 'duty', 4, 'fa fa-archive'),
(16, 'Master Data', 'master', 7, 'fa fa-database'),
(17, 'Profile', 'profile', 2, 'fa fa-user'),
(18, 'Logout', 'auth/logout', 100, 'fa fa-sign-out'),
(19, 'Tugas & Materi', 'panelsiswa', 20, 'fa fa-archive');

-- --------------------------------------------------------

--
-- Struktur dari tabel `app_pages`
--

CREATE TABLE `app_pages` (
  `id` int(11) NOT NULL,
  `about` text COLLATE utf8_unicode_ci,
  `history` text COLLATE utf8_unicode_ci,
  `visi` text COLLATE utf8_unicode_ci,
  `jadwal` text COLLATE utf8_unicode_ci,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `app_pages`
--

INSERT INTO `app_pages` (`id`, `about`, `history`, `visi`, `jadwal`, `updated_at`, `updated_by`) VALUES
(1, '<ol>\r\n	<li><span style=\"font-size:11.0000pt\"><span style=\"font-family:Calibri\">Alamat</span></span></li>\r\n</ol>\r\n\r\n<p><span style=\"font-size:11.0000pt\"><span style=\"font-family:Calibri\">Gang Pakel No.00, Karanganom RT05 RW03, Karangmojo, Purwomartani, Kalasan, Sleman, Yogyakarta 55571</span></span></p>\r\n\r\n<ol start=\"2\">\r\n	<li><span style=\"font-size:11.0000pt\"><span style=\"font-family:Calibri\">Kontak</span></span></li>\r\n</ol>\r\n\r\n<p><span style=\"font-size:11.0000pt\"><span style=\"font-family:Calibri\">Telepon/Whatsapp/Telegram: 0878-4829-0600</span></span></p>\r\n\r\n<p><span style=\"font-size:11.0000pt\"><span style=\"font-family:Calibri\">E-mail: </span></span><a href=\"mailto:bimbelbunanang@gmail.com\"><u><span style=\"font-family:Calibri\"><span style=\"color:#0000ff\"><u>bimbelbunanang@gmail.com</u></span></span></u></a></p>\r\n\r\n<p><span style=\"font-size:11.0000pt\"><span style=\"font-family:Calibri\">Instagram: les.bu.nanang</span></span></p>\r\n', '<h2>What is Lorem Ipsum?</h2>\r\n\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<h2>Why do we use it?</h2>\r\n\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).<img alt=\"\" src=\"http://testing.hellotech.id//upload/WhatsApp%20Image%202020-09-07%20at%2010-14-16%20(2).jpg\" style=\"height:600px; width:800px\" /></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>Where does it come from?</h2>\r\n\r\n<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.</p>\r\n\r\n<p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from &quot;de Finibus Bonorum et Malorum&quot; by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p>\r\n\r\n<h2>Where can I get some?</h2>\r\n\r\n<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p>\r\n', '<h1><strong>Visi</strong></h1>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\">Terampil, berprestasi berlandaskan imteq, peduli, melestarikan dan mencegah terjadinya pencemaran lingkungan</span></span></p>\r\n\r\n<h1><strong>Misi</strong></h1>\r\n\r\n<ul>\r\n	<li><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\">Melaksanakan berbagai kegiatan ekstrakurikuler pilihan untuk mendorong dan membantu setiap siswa agar dapat mengenali potensi dirinya sehingga dapat berkembang secara optimal.</span></span></li>\r\n	<li><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\">&nbsp;Melaksanakan pembelajaran secara efektif untuk menumbuhkan semangat keunggulan dalam rangka meningkatkan perolehan rata-rata NUN(Nilai Ujian Nasional).</span></span></li>\r\n	<li><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\">Meningkatkan kualitas layanan terhadap siswa sebagai upaya memperbanyak jumlah siswa yang diterima diberbagai perguruan Tinggi Favorit.</span></span></li>\r\n	<li><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\">Meningkatkan penghayatan dan keyakinan setiap warga sekolah terhadap ajaran agama masing-masing sebagai pijakan untuk bertindak lebih Arif.</span></span></li>\r\n	<li><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\">&nbsp;Terciptanya lingkungan sekolah yang bersih, indah dan nyaman serta menyehatkan.</span></span></li>\r\n	<li><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\">Bersama warga sekolah melestarikan lingkungan sekolah dan lingkungan sekitar.</span></span></li>\r\n	<li><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\">Menciptakan lingkungan sekolah yang terbebas dari pencemaran.</span></span></li>\r\n</ul>\r\n', NULL, '2020-08-15 22:40:52', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `app_role`
--

CREATE TABLE `app_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `app_setting`
--

CREATE TABLE `app_setting` (
  `id` int(1) NOT NULL,
  `site_title` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `site_tagline` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mail_notification` int(1) DEFAULT NULL,
  `phone_notification` int(1) DEFAULT NULL,
  `mail_notification_list` text COLLATE utf8_unicode_ci,
  `phone_notification_list` text COLLATE utf8_unicode_ci,
  `last_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `app_setting`
--

INSERT INTO `app_setting` (`id`, `site_title`, `site_tagline`, `mail_notification`, `phone_notification`, `mail_notification_list`, `phone_notification_list`, `last_updated`, `updated_by`) VALUES
(1, 'SMA N 1 Sukodadi', 'SMA N 1 Sukodadi', 1, 1, 'a:1:{i:0;s:1:\"1\";}', 'N;', '2020-08-07 02:25:02', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `app_social`
--

CREATE TABLE `app_social` (
  `id` int(11) NOT NULL,
  `instagram` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `youtube` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `facebook` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `whatapps` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gmail` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `linkedin` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `twitter` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci,
  `last_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `No_Telp` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `app_sub_menu`
--

CREATE TABLE `app_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `order` int(2) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `app_sub_menu`
--

INSERT INTO `app_sub_menu` (`id`, `menu_id`, `name`, `url`, `icon`, `order`, `is_active`) VALUES
(1, 1, 'Menu Settings', 'menu', 'fa fa-list', 1, 1),
(2, 1, 'Role Access', 'role_access', '', 3, 1),
(3, 1, 'Role', 'role', '', 2, 1),
(5, 2, 'Post', 'post', '', 1, 1),
(6, 2, 'Kategori', 'categories', '', 2, 1),
(7, 2, 'Tags', 'tags', '', 3, 1),
(12, 1, 'General', 'general', '', 5, 1),
(14, 7, 'Backup DB', 'dump', '', 1, 1),
(22, 11, 'Visi & Misi', 'visi', '', 1, 1),
(23, 11, 'Sejarah', 'sejarah', '', 2, 1),
(25, 12, 'Slider', 'galeri', '', 1, 1),
(28, 13, 'Daftar Siswa', 'member', '', 1, 1),
(29, 13, 'Persetujuan Akun Siswa', 'approve', '', 2, 1),
(30, 15, 'Upload Materi', 'materi', '', 1, 1),
(31, 15, 'Tugas', 'tugas', '', 2, 1),
(32, 1, 'Sosial Media & Alamat', 'social', '', 6, 1),
(33, 16, 'Kelas', 'kelas', '', 1, 1),
(34, 16, 'Kategori Materi / Tugas', 'categories', '', 2, 1),
(35, 11, 'Galeri', 'galeri', '', 4, 1),
(36, 19, 'Tugas', 'tugas', '', 2, 1),
(37, 19, 'Materi', 'materi', '', 1, 1),
(38, 1, 'Api', 'api', '', 7, 1),
(39, 12, 'Banner', 'banner', '', 2, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `file_materi`
--

CREATE TABLE `file_materi` (
  `id` int(11) NOT NULL,
  `title` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `file` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `upload_by` int(11) NOT NULL,
  `is_publish` int(1) NOT NULL DEFAULT '1',
  `categories_id` int(11) NOT NULL,
  `type` enum('video','file') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'file'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `file_materi`
--

INSERT INTO `file_materi` (`id`, `title`, `description`, `file`, `upload_by`, `is_publish`, `categories_id`, `type`) VALUES
(4, 'GARIS DAN SUDUT (test)', 'Lorem ipsum dolor sit amet', 'WhatsApp Image 2020-09-07 at 10-14-16.jpg', 4, 0, 4, 'file'),
(5, 'Minor Chord Progresi', 'Ini adalah contoh progresi chord minor dengan nada dasar C = Do\r\nbisa menjadi rujukan untuk song sedih', 'Jamming Tipis Tipis  C Major  Piano.mp4', 4, 0, 4, 'video');

-- --------------------------------------------------------

--
-- Struktur dari tabel `file_tugas`
--

CREATE TABLE `file_tugas` (
  `id` int(11) NOT NULL,
  `title` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `max_upload` datetime NOT NULL,
  `file` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `categories_id` int(11) NOT NULL,
  `deleted` int(1) NOT NULL DEFAULT '0',
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `file_tugas`
--

INSERT INTO `file_tugas` (`id`, `title`, `description`, `max_upload`, `file`, `categories_id`, `deleted`, `created_by`) VALUES
(1, 'Tugas 1 Terbaru', '<p>Deskripsi</p>', '2020-08-28 00:00:00', 'materi/Scan 1.pdf', 3, 1, 1),
(2, 'Latihan - IPA Bab 3 (Hereditas)', '<p>Kerjakan di buku tulis, nomor 1-40</p>\r\n\r\n<p>Beri judul \"Latihan Hereditas\"</p>\r\n\r\n<p>Tulis langsung jawabannya (huruf + keterangan)</p>\r\n\r\n<p>Diupload paling lambat 4 September 2020</p>\r\n\r\n<p> </p>\r\n\r\n<p>Regards,</p>\r\n\r\n<p><em>Icha Hadiqah</em></p>', '2020-09-30 00:00:00', 'tugas_siswa/9_IPA_Hereditas-1.pdf', 7, 0, 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `file_tugas_member`
--

CREATE TABLE `file_tugas_member` (
  `id` int(11) NOT NULL,
  `id_tugas` int(11) NOT NULL,
  `filename` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `file_tugas_member`
--

INSERT INTO `file_tugas_member` (`id`, `id_tugas`, `filename`, `user_id`, `created_at`) VALUES
(2, 2, 'upload/tugas_siswa/2020_06_03-14_52_011.png', 6, '2020-09-15 04:49:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `home_gallery`
--

CREATE TABLE `home_gallery` (
  `id` int(11) NOT NULL,
  `title` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `image` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `text_color` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `home_gallery`
--

INSERT INTO `home_gallery` (`id`, `title`, `description`, `image`, `text_color`) VALUES
(1, 'Selamat datang', 'Berusaha dan berdoa, adalah kunci keberhasilan.', 'Slider 1.jpg', '#ffffff'),
(3, 'JUJUR, DISIPLIN, TEKUN, BERPRESTASI', 'Didampingi guru yang ramah dan berpengalaman dalam bidang les privat, anak-anak diharapkan dapat memiliki kualitas belajar yang lebih baik.', 'slider 2.jpg', '#ffffff'),
(4, 'Sekolah Berprestasi', 'Prestasi pengajar pun turut jadi prioritas kami', 'teacher (1).jpg', '#ffffff');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_categories`
--

CREATE TABLE `master_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `deleted` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `master_categories`
--

INSERT INTO `master_categories` (`id`, `name`, `deleted`) VALUES
(1, 'Fisika', 0),
(2, 'Kimia', 0),
(3, 'Biologi', 0),
(4, 'Matematika', 0),
(5, 'Bahasa Indonesia', 0),
(6, 'English', 0),
(7, 'IPA', 0),
(10, 'test', 1),
(11, 'IPS', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_kelas`
--

CREATE TABLE `master_kelas` (
  `id` int(11) NOT NULL,
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `deleted` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `post_blog`
--

CREATE TABLE `post_blog` (
  `id` int(11) NOT NULL,
  `title` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci,
  `slug` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `categories` text COLLATE utf8_unicode_ci,
  `tags` text COLLATE utf8_unicode_ci,
  `meta_desc` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `featured_image` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted` int(1) NOT NULL DEFAULT '0',
  `is_publish` int(1) NOT NULL DEFAULT '0',
  `last_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` datetime DEFAULT NULL,
  `updated_by` int(11) NOT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `post_blog`
--

INSERT INTO `post_blog` (`id`, `title`, `content`, `slug`, `categories`, `tags`, `meta_desc`, `featured_image`, `deleted`, `is_publish`, `last_updated`, `created_at`, `updated_by`, `created_by`) VALUES
(2, 'Test post', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod<br>\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,<br>\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo<br>\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse<br>\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non<br>\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n\r\n<p> </p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod<br>\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,<br>\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo<br>\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse<br>\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non<br>\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n', 'test-post', 'a:2:{i:0;s:1:\"1\";i:1;s:1:\"3\";}', '', 'Test meta', 'DSC_0125.JPG', 1, 1, '2020-08-08 05:08:48', '2020-08-07 22:08:48', 1, 1),
(3, 'Bagaimana Meningkatkan Mutu Pendidikan', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod<br />\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,<br />\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo<br />\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse<br />\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non<br />\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n', 'bagaimana-meningkatkan-mutu-pendidikan', '[\"1\",\"3\"]', '[\"1\",\"4\"]', 'Test data', 'education-01-728x410.jpg', 1, 1, '2020-08-08 07:50:50', '2020-08-08 00:50:50', 1, 1),
(4, 'Evaluasi Tentor dan Progres Belajar Siswa', '<p>Tanggal 30 Agustus 2020 kemarin, Bimbingan Belajar Bu Nanang mengadakan acara makan bersama di rumah makan &quot;Eyang Uti Coffee and Garden&quot;, Maguwoharjo. Acara ini dihadiri oleh mbak Icha sebagai pengelola bimbel, 4 orang tentor, dan 3 orang staff internal.&nbsp;</p>\r\n\r\n<p>Tujuan utama dari diadakannya acara ini adalah untuk mengevaluasi kinerja tentor dan diskusi progres belajar siswa dan penyampaian kendala-kendala di kelas&nbsp;setelah 2 periode berlangsung. Acara bersifat santai, sehingga diskusi dilakukan sambil menyantap camilan dan kopi, dan ditutup dengan sesi foto bersama. Ke depannya evaluasi dan diskusi ini akan dilakukan rutin setiap 2 periode sekali.</p>\r\n\r\n<p>Kepada siswa dan orang tua siswa, jika ada kritik saran yang ingin disampaikan, silakan disampaikan kepada mbak Icha melalui japri WA karena masukan-masukan dan kritik yang membangun pasti akan kami diskusikan bersama dalam acara evaluasi rutin tersebut.&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Salam hangat dari kami,</p>\r\n\r\n<p>Tim Bimbingan Belajar Bu Nanang</p>\r\n', 'evaluasi-tentor-dan-progres-belajar-siswa', 'null', 'null', 'YTest', '', 1, 1, '2020-08-08 08:14:06', '2020-08-08 01:14:06', 4, 1),
(5, 'Menjadikan Konsep Belajar Yang Baru', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod<br />\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,<br />\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo<br />\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse<br />\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non<br />\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n', 'menjadikan-konsep-belajar-yang-baru', '[\"3\"]', '[\"1\"]', 'Test data', '94b846b7502ed24666191ad5d2f6de03.jpg', 1, 1, '2020-08-20 11:57:04', '2020-08-20 18:57:04', 1, 1),
(6, 'Evaluasi Guru dan Progres Belajar Siswa', '<p><br />\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod<br />\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,<br />\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo<br />\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse<br />\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non<br />\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.<br />\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod<br />\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,<br />\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo<br />\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse<br />\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non<br />\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.<br />\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod<br />\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,<br />\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo<br />\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse<br />\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non<br />\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.<br />\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod<br />\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,<br />\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo<br />\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse<br />\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non<br />\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.<br />\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod<br />\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,<br />\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo<br />\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse<br />\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non<br />\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.<br />\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod<br />\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,<br />\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo<br />\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse<br />\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non<br />\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n', 'evaluasi-guru-dan-progres-belajar-siswa', '[\"5\"]', '[\"4\"]', '', 'WhatsApp Image 2020-09-07 at 10-14-16 (1).jpg', 0, 1, '2020-09-10 22:33:02', '2020-09-11 05:33:02', 1, 4),
(7, 'Pensi Sekolah Akan Segera Di Laksananakan', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut aliquam libero quis metus pulvinar, ut ultricies augue fringilla. Etiam semper tincidunt interdum. Sed nec congue mi. In sollicitudin elit id sem aliquet malesuada. Aenean dignissim suscipit semper. Vestibulum ullamcorper vel tortor venenatis euismod. Donec eu nibh suscipit tellus sollicitudin ullamcorper sed quis magna. Donec pharetra massa eget egestas tristique. Mauris accumsan nisi non neque aliquam, id dictum turpis tincidunt. Donec volutpat, magna at consectetur faucibus, lacus mi viverra turpis, non tincidunt justo nisi eu eros. Sed interdum, nibh efficitur sollicitudin tristique, neque est pretium urna, vitae tempor dolor odio vel purus.</p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<img alt=\"\" src=\"http://testing.hellotech.id//upload/82558_alseace-2018.jpg\" style=\"height:233px; width:350px\" /></p>\r\n\r\n<p>Maecenas nec turpis sed felis interdum condimentum nec non magna. Phasellus non leo sed quam dignissim rhoncus. Phasellus orci sapien, posuere quis maximus quis, tempus vel mi. Curabitur semper bibendum dui vel vestibulum. Maecenas elementum purus id pellentesque interdum. Vestibulum ac mattis libero. Duis cursus, augue et congue tempor, felis nisi scelerisque ligula, sit amet rhoncus urna leo et velit. Donec ligula nulla, bibendum nec lacinia eu, faucibus vitae nunc. Donec quis lorem quis urna laoreet aliquet.</p>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<img alt=\"\" src=\"http://testing.hellotech.id//upload/15000-orang-berkumpul-di-alseace-2018_thumb.jpg\" style=\"height:360px; width:360px\" /></p>\r\n\r\n<p>In eu scelerisque magna. Suspendisse in ex dictum, dignissim ex nec, porta diam. Duis sagittis erat vel ultrices tempus. Nullam vitae vulputate augue, eu hendrerit neque. In hac habitasse platea dictumst. Vivamus ac risus sit amet lectus rutrum cursus. Sed iaculis condimentum euismod. Fusce diam sem, auctor a venenatis in, aliquet ac lorem. Nulla venenatis luctus ligula, eget vehicula sem faucibus a.</p>\r\n', 'pensi-sekolah-akan-segera-di-laksananakan', '[\"1\"]', 'null', '', '82558_alseace-2018.jpg', 0, 1, '2020-09-23 00:46:22', '2020-09-23 07:46:22', 1, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `post_categories`
--

CREATE TABLE `post_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `post_categories`
--

INSERT INTO `post_categories` (`id`, `name`, `slug`) VALUES
(1, 'Blog', 'blog'),
(3, 'Tips dan Trik', 'tips_dan_trik'),
(5, 'Kegiatan', 'kegiatan'),
(6, 'Akademik', 'akademik'),
(7, 'Informasi', 'informasi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `post_comment`
--

CREATE TABLE `post_comment` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `text` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `post_comment_notification`
--

CREATE TABLE `post_comment_notification` (
  `id` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_id_comment` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `post_comment_reply`
--

CREATE TABLE `post_comment_reply` (
  `id` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `text` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `post_gallery`
--

CREATE TABLE `post_gallery` (
  `id` int(11) NOT NULL,
  `title` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `image` varchar(256) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `post_gallery`
--

INSERT INTO `post_gallery` (`id`, `title`, `description`, `image`) VALUES
(5, 'Halaman Depan', 'Halaman depan sekolah', 'WhatsApp Image 2020-09-07 at 10-14-16.jpg'),
(6, 'Prestasi Sekolah', '', 'teacher.jpg'),
(7, 'Footage Drone', '', 'drone image.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `post_tags`
--

CREATE TABLE `post_tags` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `post_tags`
--

INSERT INTO `post_tags` (`id`, `name`, `slug`) VALUES
(1, 'Blog', 'blog'),
(4, 'Pendidikan', 'pendidikan'),
(5, 'Kegiatan', 'kegiatan'),
(6, 'Akademik', 'akademik'),
(7, 'Informasi', 'informasi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `username` varchar(128) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `image` varchar(128) DEFAULT NULL,
  `password` varchar(256) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `deleted` int(1) NOT NULL DEFAULT '0',
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cookie` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `name`, `username`, `email`, `image`, `password`, `role_id`, `is_active`, `deleted`, `date_created`, `cookie`) VALUES
(7, 'Guru 1', 'gurusekolah', 'mail@gmai.com', 'WhatsApp Image 2020-09-07 at 10-14-16.jpg', '5f4dcc3b5aa765d61d8327deb882cf99', 3, 1, 0, '2020-09-15 08:00:24', NULL),
(8, 'Hermindha A', 'hermindha', 'hermindhaanggraitasarai@gmail.com', '', '432f45b44c432414d2f97df0e5743818', 2, 1, 0, '2020-09-26 11:17:48', '2dxKs3Q6tOkMrLPGXPVg4JONfgIzua2AmeeUvTVj85JWbD7HncSL1b0zNl0ZfjCn'),
(9, 'ita', 'anggra', 'maheranggra@gmail.com', NULL, '432f45b44c432414d2f97df0e5743818', 4, 1, 0, '2020-09-26 11:29:31', NULL),
(10, 'Hermindha A', 'rara23', 'faizarahmadina@gmail.com', NULL, '432f45b44c432414d2f97df0e5743818', 4, 1, 0, '2020-11-07 11:08:27', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `sub_menu_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`, `sub_menu_id`) VALUES
(893, 4, 3, NULL),
(894, 4, 17, NULL),
(895, 4, 19, NULL),
(896, 4, 18, NULL),
(897, 4, 19, 37),
(898, 4, 19, 36),
(899, 3, 3, NULL),
(900, 3, 17, NULL),
(901, 3, 15, NULL),
(902, 3, 2, NULL),
(903, 3, 18, NULL),
(904, 3, 15, 30),
(905, 3, 15, 31),
(906, 3, 2, 5),
(907, 3, 2, 6),
(908, 3, 2, 7),
(943, 1, 3, NULL),
(944, 1, 17, NULL),
(945, 1, 13, NULL),
(946, 1, 14, NULL),
(947, 1, 12, NULL),
(948, 1, 15, NULL),
(949, 1, 11, NULL),
(950, 1, 2, NULL),
(951, 1, 8, NULL),
(952, 1, 16, NULL),
(953, 1, 7, NULL),
(954, 1, 6, NULL),
(955, 1, 1, NULL),
(956, 1, 18, NULL),
(957, 1, 13, 28),
(958, 1, 13, 29),
(959, 1, 12, 25),
(960, 1, 12, 39),
(961, 1, 15, 30),
(962, 1, 15, 31),
(963, 1, 11, 22),
(964, 1, 11, 23),
(965, 1, 11, 35),
(966, 1, 2, 5),
(967, 1, 2, 6),
(968, 1, 2, 7),
(969, 1, 16, 33),
(970, 1, 16, 34),
(971, 1, 7, 14),
(972, 1, 1, 1),
(973, 1, 1, 3),
(974, 1, 1, 2),
(975, 1, 1, 12),
(976, 1, 1, 32),
(977, 1, 1, 38),
(978, 2, 3, NULL),
(979, 2, 17, NULL),
(980, 2, 13, NULL),
(981, 2, 12, NULL),
(982, 2, 14, NULL),
(983, 2, 11, NULL),
(984, 2, 15, NULL),
(985, 2, 2, NULL),
(986, 2, 8, NULL),
(987, 2, 16, NULL),
(988, 2, 7, NULL),
(989, 2, 6, NULL),
(990, 2, 1, NULL),
(991, 2, 18, NULL),
(992, 2, 13, 28),
(993, 2, 13, 29),
(994, 2, 12, 25),
(995, 2, 12, 39),
(996, 2, 11, 22),
(997, 2, 11, 23),
(998, 2, 11, 35),
(999, 2, 15, 30),
(1000, 2, 15, 31),
(1001, 2, 2, 5),
(1002, 2, 2, 6),
(1003, 2, 2, 7),
(1004, 2, 16, 33),
(1005, 2, 16, 34),
(1006, 2, 7, 14),
(1007, 2, 1, 12),
(1008, 2, 1, 32);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_member`
--

CREATE TABLE `user_member` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `nisn` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `alamat` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `tempat_lahir` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `student_phone` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_pengajar`
--

CREATE TABLE `user_pengajar` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `riwayat_pendidikan` text COLLATE utf8_unicode_ci NOT NULL,
  `kelas_id` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL,
  `deleted` int(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_role`
--

INSERT INTO `user_role` (`id`, `role`, `deleted`, `created_at`) VALUES
(1, 'Developer', 0, '2020-07-28 06:59:45'),
(2, 'Administrator', 0, '2020-07-28 06:59:45'),
(3, 'Guru', 0, '2020-08-05 08:49:55'),
(4, 'Siswa', 0, '2020-08-15 22:32:49');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `app_api`
--
ALTER TABLE `app_api`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `app_banner`
--
ALTER TABLE `app_banner`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `app_menu`
--
ALTER TABLE `app_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `app_pages`
--
ALTER TABLE `app_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `app_setting`
--
ALTER TABLE `app_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `app_social`
--
ALTER TABLE `app_social`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `app_sub_menu`
--
ALTER TABLE `app_sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `file_materi`
--
ALTER TABLE `file_materi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `file_tugas`
--
ALTER TABLE `file_tugas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `file_tugas_member`
--
ALTER TABLE `file_tugas_member`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `home_gallery`
--
ALTER TABLE `home_gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `master_categories`
--
ALTER TABLE `master_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `master_kelas`
--
ALTER TABLE `master_kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `post_blog`
--
ALTER TABLE `post_blog`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `post_categories`
--
ALTER TABLE `post_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `post_comment`
--
ALTER TABLE `post_comment`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `post_comment_notification`
--
ALTER TABLE `post_comment_notification`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `post_comment_reply`
--
ALTER TABLE `post_comment_reply`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `post_gallery`
--
ALTER TABLE `post_gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `post_tags`
--
ALTER TABLE `post_tags`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_member`
--
ALTER TABLE `user_member`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_pengajar`
--
ALTER TABLE `user_pengajar`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `app_api`
--
ALTER TABLE `app_api`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `app_banner`
--
ALTER TABLE `app_banner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `app_menu`
--
ALTER TABLE `app_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `app_pages`
--
ALTER TABLE `app_pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `app_setting`
--
ALTER TABLE `app_setting`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `app_social`
--
ALTER TABLE `app_social`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `app_sub_menu`
--
ALTER TABLE `app_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT untuk tabel `file_materi`
--
ALTER TABLE `file_materi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `file_tugas`
--
ALTER TABLE `file_tugas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `file_tugas_member`
--
ALTER TABLE `file_tugas_member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `home_gallery`
--
ALTER TABLE `home_gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `master_categories`
--
ALTER TABLE `master_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `master_kelas`
--
ALTER TABLE `master_kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `post_blog`
--
ALTER TABLE `post_blog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `post_categories`
--
ALTER TABLE `post_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `post_comment`
--
ALTER TABLE `post_comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `post_comment_notification`
--
ALTER TABLE `post_comment_notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `post_comment_reply`
--
ALTER TABLE `post_comment_reply`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `post_gallery`
--
ALTER TABLE `post_gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `post_tags`
--
ALTER TABLE `post_tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1009;

--
-- AUTO_INCREMENT untuk tabel `user_member`
--
ALTER TABLE `user_member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `user_pengajar`
--
ALTER TABLE `user_pengajar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
