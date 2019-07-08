-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th7 08, 2019 lúc 04:46 AM
-- Phiên bản máy phục vụ: 10.1.37-MariaDB
-- Phiên bản PHP: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `ghepdb`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ban_douong`
--

CREATE TABLE `ban_douong` (
  `hoadoncafe_id` int(11) NOT NULL,
  `douong_id` int(10) UNSIGNED NOT NULL,
  `soluong` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `ban_douong`
--

INSERT INTO `ban_douong` (`hoadoncafe_id`, `douong_id`, `soluong`, `created_at`, `updated_at`, `id`) VALUES
(1, 1, 1, '2019-07-05 04:35:36', '2019-07-05 04:35:36', 1),
(2, 1, 2, '2019-07-05 04:36:14', '2019-07-05 04:36:14', 2),
(3, 1, 1, '2019-07-05 05:03:02', '2019-07-05 05:03:02', 3),
(4, 1, 2, '2019-07-05 05:03:55', '2019-07-05 05:03:55', 4),
(5, 1, 1, '2019-07-05 06:40:11', '2019-07-05 06:40:11', 5),
(6, 1, 3, '2019-07-05 06:40:55', '2019-07-05 06:40:55', 6);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitiethds`
--

CREATE TABLE `chitiethds` (
  `id` int(10) UNSIGNED NOT NULL,
  `hds_id` int(10) UNSIGNED NOT NULL,
  `sach_id` int(10) UNSIGNED NOT NULL,
  `tinhtrang` int(11) NOT NULL,
  `tienphathongsach` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `chitiethds`
--

INSERT INTO `chitiethds` (`id`, `hds_id`, `sach_id`, `tinhtrang`, `tienphathongsach`, `created_at`, `updated_at`) VALUES
(1, 56, 1, 25, 25000, '2019-07-05 04:28:10', '2019-07-05 04:28:10'),
(2, 56, 3, 0, 0, '2019-07-05 04:28:11', '2019-07-05 04:28:11'),
(3, 57, 1, 0, 0, '2019-07-05 06:37:32', '2019-07-05 06:37:32'),
(4, 57, 2, 0, 0, '2019-07-05 06:37:32', '2019-07-05 06:37:32'),
(5, 57, 15, 1, 150000, '2019-07-05 06:37:32', '2019-07-05 06:37:32');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `douong_theloai`
--

CREATE TABLE `douong_theloai` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `theloai_douong_name` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `theloai_douong_name_khongdau` varchar(191) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `douong_theloai`
--

INSERT INTO `douong_theloai` (`id`, `created_at`, `updated_at`, `theloai_douong_name`, `theloai_douong_name_khongdau`) VALUES
(1, NULL, NULL, 'Cafe', 'cafe'),
(2, NULL, NULL, 'Sinh tố', 'Sinh tố');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hoadoncafe`
--

CREATE TABLE `hoadoncafe` (
  `id` int(10) UNSIGNED NOT NULL,
  `total` int(11) NOT NULL,
  `user_id_tt` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `hoadoncafe`
--

INSERT INTO `hoadoncafe` (`id`, `total`, `user_id_tt`, `created_at`, `updated_at`, `user_id`) VALUES
(1, 20000, NULL, '2019-07-05 04:35:36', '2019-07-05 04:35:36', 1),
(2, 40000, 12, '2019-07-05 04:36:13', '2019-07-05 04:36:13', 1),
(3, 20000, NULL, '2019-07-05 05:03:02', '2019-07-05 05:03:02', 1),
(4, 40000, 12, '2019-07-05 05:03:55', '2019-07-05 05:03:55', 1),
(5, 20000, NULL, '2019-07-05 06:40:11', '2019-07-05 06:40:11', 1),
(6, 60000, 14, '2019-07-05 06:40:54', '2019-07-05 06:40:54', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hoadonsach`
--

CREATE TABLE `hoadonsach` (
  `id` int(10) UNSIGNED NOT NULL,
  `muontra_id` int(10) UNSIGNED DEFAULT NULL,
  `tienquahan` int(11) NOT NULL,
  `tienthue` int(11) NOT NULL,
  `tienthanhtoan` int(11) NOT NULL,
  `songayquahan` int(11) NOT NULL,
  `nguoitt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `hoadonsach`
--

INSERT INTO `hoadonsach` (`id`, `muontra_id`, `tienquahan`, `tienthue`, `tienthanhtoan`, `songayquahan`, `nguoitt`, `created_at`, `updated_at`) VALUES
(2, 15, 0, 21000, 21000, 0, 'admin@me.to', '2019-05-06 13:27:52', '2019-05-06 13:27:52'),
(3, 15, 0, 21000, 21000, 0, 'admin@me.to', '2019-05-07 13:40:05', '2019-05-07 13:40:05'),
(4, 15, 0, 21000, 21000, 0, 'admin@me.to', '2019-05-07 07:23:23', '2019-05-07 07:23:23'),
(5, 16, 0, 21000, 46000, 0, 'admin@me.to', '2019-05-09 07:40:59', '2019-05-09 07:40:59'),
(6, 16, 0, 21000, 21000, 0, 'admin@me.to', '2019-05-11 13:32:45', '2019-05-11 13:32:45'),
(9, 17, 0, 21000, 21000, 0, 'admin@me.to', '2019-05-11 13:57:06', '2019-05-11 13:57:06'),
(10, 17, 0, 21000, 21000, 0, 'admin@me.to', '2019-05-11 14:05:55', '2019-05-11 14:05:55'),
(11, 18, 0, 21000, 21000, 0, 'admin@me.to', '2019-05-11 14:17:30', '2019-05-11 14:17:30'),
(12, 18, 0, 21000, 21000, 0, 'admin@me.to', '2019-05-11 14:20:13', '2019-05-11 14:20:13'),
(13, 18, 0, 21000, 21000, 0, 'admin@me.to', '2019-05-11 14:22:11', '2019-05-11 14:22:11'),
(15, 19, 0, 21000, 21000, 0, 'admin@me.to', '2019-05-11 14:35:29', '2019-05-11 14:35:29'),
(16, 19, 0, 21000, 21000, 0, 'admin@me.to', '2019-05-11 14:37:26', '2019-05-11 14:37:26'),
(17, 19, 0, 21000, 21000, 0, 'admin@me.to', '2019-05-11 14:37:37', '2019-05-11 14:37:37'),
(18, 20, 0, 21000, 21000, 0, 'admin@me.to', '2019-05-11 14:38:16', '2019-05-11 14:38:16'),
(19, 21, 0, 21000, 21000, 0, 'admin@me.to', '2019-05-11 14:41:23', '2019-05-11 14:41:23'),
(20, 22, 0, 21000, 21000, 0, 'admin@me.to', '2019-05-11 14:42:31', '2019-05-11 14:42:31'),
(21, 22, 0, 21000, 21000, 0, 'admin@me.to', '2019-05-11 14:43:06', '2019-05-11 14:43:06'),
(41, 23, 0, 63000, 63000, 0, 'admin@me.to', '2019-05-12 07:28:32', '2019-05-12 07:28:32'),
(42, 24, 0, 21000, 21000, 0, 'admin@me.to', '2019-06-16 05:02:43', '2019-05-16 05:02:43'),
(43, 24, 0, 42000, 42000, 0, 'admin@me.to', '2019-06-16 05:03:01', '2019-05-16 05:03:01'),
(44, 25, 0, 84000, 84000, 0, 'admin@me.to', '2019-05-16 05:07:26', '2019-05-16 05:07:26'),
(45, 26, 0, 84000, 84000, 0, 'admin@me.to', '2019-05-16 05:09:46', '2019-05-16 05:09:46'),
(46, 27, 0, 63000, 63000, 0, 'admin@me.to', '2019-05-16 05:10:14', '2019-05-16 05:10:14'),
(47, 28, 0, 63000, 63000, 0, 'admin@me.to', '2019-05-20 00:52:18', '2019-05-20 00:52:18'),
(48, 29, 0, 42000, 42000, 0, 'admin@me.to', '2019-05-20 00:54:08', '2019-05-20 00:54:08'),
(49, 30, 0, 42000, 42000, 0, 'admin@me.to', '2019-05-20 00:56:20', '2019-05-20 00:56:20'),
(50, 31, 0, 63000, 63000, 0, 'admin@me.to', '2019-05-20 00:57:28', '2019-05-20 00:57:28'),
(51, 32, 0, 42000, 42000, 0, 'admin@me.to', '2019-05-20 01:30:20', '2019-05-20 01:30:20'),
(52, 33, 0, 21000, 21000, 0, 'admin@me.to', '2019-05-20 01:47:51', '2019-05-20 01:47:51'),
(53, 34, 0, 21000, 21000, 0, 'admin@me.to', '2019-05-20 02:14:24', '2019-05-20 02:14:24'),
(54, 36, 0, 21000, 21000, 0, 'show@me.to', '2019-06-16 11:11:23', '2019-06-16 11:11:23'),
(55, 35, 140000, 161000, 161000, 28, 'admin@me.to', '2019-06-24 07:00:30', '2019-06-24 07:00:30'),
(56, 38, 0, 84000, 109000, 0, 'admin@me.to', '2019-07-05 04:28:10', '2019-07-05 04:28:10'),
(57, 41, 0, 63000, 213000, 0, 'admin@me.to', '2019-07-05 06:37:32', '2019-07-05 06:37:32');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `menu`
--

CREATE TABLE `menu` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tendouong` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `gia` int(11) NOT NULL,
  `anh` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `theloai_douong` int(11) NOT NULL,
  `douong_khongdau` varchar(191) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `menu`
--

INSERT INTO `menu` (`id`, `created_at`, `updated_at`, `tendouong`, `gia`, `anh`, `theloai_douong`, `douong_khongdau`) VALUES
(1, '2019-04-24 02:52:55', '2019-04-24 04:10:05', 'Nâu đá', 20000, 'nauda.jpg', 1, ''),
(3, '2019-04-24 03:04:13', '2019-04-24 04:21:28', 'Đen đá', 20000, 'download.jpg', 1, ''),
(4, '2019-04-24 03:04:14', '2019-04-24 03:04:14', 'Bạc sỉu', 25000, 'bacsiu.jpg', 1, ''),
(5, '2019-04-24 04:16:50', '2019-04-24 04:16:50', 'Capuchino', 30000, 'capuchino.jpg', 1, ''),
(6, '2019-04-24 02:52:55', '2019-04-24 04:10:05', 'Sinh tố cam', 40000, 'sinhtocam.jpg', 2, ''),
(7, '2019-04-24 03:04:13', '2019-04-24 04:21:28', 'Sinh tố xoài', 40000, 'sinhtoxoai.png', 2, ''),
(8, '2019-04-24 03:04:14', '2019-04-24 03:04:14', 'Sinh tố dưa hấu', 40000, 'sinhtoduahau.png', 2, ''),
(9, '2019-04-24 04:16:50', '2019-04-24 04:16:50', 'Sinh tố bơ', 40000, 'sinhtobo.jpg', 2, ''),
(10, '2019-07-05 06:39:28', '2019-07-05 06:39:28', 'Sinh Tố 1', 40000, 'sinh-to-1.jpg', 2, '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_04_06_104224_create_menu_table', 1),
(4, '2019_04_06_110323_create_douong_theloai_table', 1),
(5, '2019_04_06_174117_create_theloaisach_table', 1),
(6, '2019_04_07_182156_create_tacgia_table', 1),
(7, '2019_04_07_182220_create_nhaxuatban_table', 1),
(8, '2019_04_08_161555_create_sach_table', 1),
(9, '2019_04_11_103725_create_muonsachtrasach_table', 1),
(10, '2019_04_17_121018_create_phieumuon_table', 1),
(11, '2019_04_17_121817_create_hoadonsach_table', 1),
(12, '2019_04_17_124232_create_theloaidouong_table', 1),
(13, '2019_04_17_125441_create_douong_table', 1),
(14, '2019_04_17_130122_create_qlban_table', 1),
(15, '2019_04_17_130444_create_ban_douong_table', 1),
(16, '2019_04_17_131014_create_hoadoncafe_table', 1),
(17, '2019_04_19_173459_create_vitien_table', 1),
(18, '2019_04_21_114130_create_nhaphuysach_table', 1),
(19, '2019_04_24_153531_create_chitiethds_table', 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `muontrasach`
--

CREATE TABLE `muontrasach` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `ngaymuon` date NOT NULL,
  `hantra` date NOT NULL,
  `tiendatcoc` int(11) NOT NULL,
  `tienthue` int(11) NOT NULL,
  `songaymuon` int(11) NOT NULL,
  `active` int(11) NOT NULL,
  `nguoidk` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `muontrasach`
--

INSERT INTO `muontrasach` (`id`, `user_id`, `ngaymuon`, `hantra`, `tiendatcoc`, `tienthue`, `songaymuon`, `active`, `nguoidk`, `created_at`, `updated_at`) VALUES
(15, 5, '2019-05-05', '2019-05-12', 525000, 63000, 7, 1, 'admin@me.to', '2019-05-05 14:17:17', '2019-05-07 07:23:23'),
(16, 6, '2019-05-05', '2019-05-12', 375000, 42000, 7, 1, 'admin@me.to', '2019-05-05 14:48:58', '2019-05-11 13:32:45'),
(17, 5, '2019-05-11', '2019-05-18', 600000, 42000, 7, 1, 'admin@me.to', '2019-05-11 13:49:42', '2019-05-11 14:05:55'),
(18, 5, '2019-05-11', '2019-05-18', 525000, 63000, 7, 1, 'admin@me.to', '2019-05-11 14:14:52', '2019-05-11 14:22:11'),
(19, 5, '2019-05-11', '2019-05-18', 525000, 63000, 7, 1, 'admin@me.to', '2019-05-11 14:25:49', '2019-05-11 14:37:37'),
(20, 5, '2019-05-11', '2019-05-18', 150000, 21000, 7, 1, 'admin@me.to', '2019-05-11 14:38:03', '2019-05-11 14:38:16'),
(21, 5, '2019-05-11', '2019-05-18', 150000, 21000, 7, 1, 'admin@me.to', '2019-05-11 14:41:07', '2019-05-11 14:41:23'),
(22, 5, '2019-05-11', '2019-05-18', 375000, 42000, 7, 1, 'admin@me.to', '2019-05-11 14:42:13', '2019-05-11 14:43:06'),
(23, 5, '2019-05-12', '2019-05-19', 525000, 63000, 7, 1, 'admin@me.to', '2019-05-12 06:54:00', '2019-05-12 07:28:32'),
(24, 5, '2019-05-16', '2019-05-23', 825000, 63000, 7, 1, 'admin@me.to', '2019-05-16 05:02:21', '2019-05-16 05:03:01'),
(25, 5, '2019-05-16', '2019-05-23', 975000, 84000, 7, 1, 'admin@me.to', '2019-05-16 05:07:06', '2019-05-16 05:07:26'),
(26, 5, '2019-05-16', '2019-05-23', 975000, 84000, 7, 1, 'admin@me.to', '2019-05-16 05:09:35', '2019-05-16 05:09:46'),
(27, 5, '2019-05-16', '2019-05-23', 525000, 63000, 7, 1, 'admin@me.to', '2019-05-16 05:10:06', '2019-05-16 05:10:14'),
(28, 5, '2019-05-20', '2019-05-27', 525000, 63000, 7, 1, 'admin@me.to', '2019-05-20 00:51:27', '2019-05-20 00:52:18'),
(29, 5, '2019-05-20', '2019-05-27', 375000, 42000, 7, 1, 'admin@me.to', '2019-05-20 00:53:51', '2019-05-20 00:54:08'),
(30, 5, '2019-05-20', '2019-05-27', 375000, 42000, 7, 1, 'admin@me.to', '2019-05-20 00:56:11', '2019-05-20 00:56:20'),
(31, 5, '2019-05-20', '2019-05-27', 525000, 63000, 7, 1, 'admin@me.to', '2019-05-20 00:57:07', '2019-05-20 00:57:28'),
(32, 5, '2019-05-20', '2019-05-27', 375000, 42000, 7, 1, 'admin@me.to', '2019-05-20 01:30:11', '2019-05-20 01:30:20'),
(33, 5, '2019-05-20', '2019-05-27', 150000, 21000, 7, 1, 'admin@me.to', '2019-05-20 01:47:41', '2019-05-20 01:47:51'),
(34, 5, '2019-05-20', '2019-05-27', 150000, 21000, 7, 1, 'admin@me.to', '2019-05-20 02:14:12', '2019-05-20 02:14:24'),
(35, 5, '2019-05-20', '2019-05-27', 150000, 21000, 7, 1, 'admin@me.to', '2019-05-20 02:34:27', '2019-06-24 07:00:31'),
(36, 4, '2019-06-16', '2019-06-23', 150000, 21000, 7, 1, 'show@me.to', '2019-06-16 11:07:42', '2019-06-16 11:11:23'),
(37, 4, '2019-06-24', '2019-07-01', 150000, 21000, 7, 0, 'admin@me.to', '2019-06-24 06:58:04', '2019-06-24 06:58:04'),
(38, 12, '2019-07-05', '2019-07-19', 300000, 84000, 14, 1, 'admin@me.to', '2019-07-05 04:25:36', '2019-07-05 04:28:11'),
(39, 12, '2019-07-05', '2019-07-12', 375000, 42000, 7, 0, 'admin@me.to', '2019-07-05 04:54:57', '2019-07-05 04:54:57'),
(40, 6, '2019-07-05', '2019-07-12', 525000, 63000, 7, 0, 'admin@me.to', '2019-07-05 04:59:51', '2019-07-05 04:59:51'),
(41, 14, '2019-07-05', '2019-07-12', 525000, 63000, 7, 1, 'admin@me.to', '2019-07-05 06:35:57', '2019-07-05 06:37:32');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhaphuysach`
--

CREATE TABLE `nhaphuysach` (
  `id` int(10) UNSIGNED NOT NULL,
  `sach_id` int(10) UNSIGNED NOT NULL,
  `status` int(11) NOT NULL,
  `soluong` int(11) DEFAULT NULL,
  `soluongbd` int(11) DEFAULT NULL,
  `ngay` date NOT NULL,
  `ghichu` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `nhaphuysach`
--

INSERT INTO `nhaphuysach` (`id`, `sach_id`, `status`, `soluong`, `soluongbd`, `ngay`, `ghichu`, `created_at`, `updated_at`) VALUES
(1, 1, 4, NULL, NULL, '2019-04-22', 'Đã Thêm sách Dế mèn phiêu lưu ký', '2019-04-22 04:51:06', '2019-04-22 04:51:06'),
(2, 2, 4, NULL, NULL, '2019-04-22', 'Đã Thêm sách số đỏ', '2019-04-22 06:26:49', '2019-04-22 06:26:49'),
(3, 3, 4, NULL, NULL, '2019-04-22', 'Đã Thêm sách Sách Thiên Cổ', '2019-04-22 06:27:41', '2019-04-22 06:27:41'),
(4, 1, 1, 5, NULL, '2019-04-22', NULL, '2019-04-22 06:29:35', '2019-04-22 06:29:35'),
(5, 2, 1, 2, NULL, '2019-04-22', NULL, '2019-04-22 06:29:40', '2019-04-22 06:29:40'),
(6, 3, 1, 1, NULL, '2019-04-22', NULL, '2019-04-22 06:29:44', '2019-04-22 06:29:44'),
(7, 4, 4, NULL, NULL, '2019-04-22', 'Đã Thêm sách Sách thăng khúc', '2019-04-22 06:31:56', '2019-04-22 06:31:56'),
(8, 2, 1, 3, NULL, '2019-04-23', NULL, '2019-04-23 13:45:21', '2019-04-23 13:45:21'),
(9, 2, 2, 1, NULL, '2019-04-25', NULL, '2019-04-25 06:21:15', '2019-04-25 06:21:15'),
(10, 5, 4, NULL, NULL, '2019-05-08', 'Đã Thêm sách Chí phèo', '2019-05-08 13:54:33', '2019-05-08 13:54:33'),
(11, 6, 4, NULL, NULL, '2019-05-08', 'Đã Thêm sách Trúng số độc đắc', '2019-05-08 14:01:39', '2019-05-08 14:01:39'),
(12, 7, 4, NULL, NULL, '2019-05-08', 'Đã Thêm sách Cạm bẫy người', '2019-05-08 14:23:23', '2019-05-08 14:23:23'),
(13, 8, 4, NULL, NULL, '2019-05-08', 'Đã Thêm sách Cát bụi chân ai', '2019-05-08 14:26:48', '2019-05-08 14:26:48'),
(14, 9, 4, NULL, NULL, '2019-05-08', 'Đã Thêm sách Nghệ thuật đàm phán', '2019-05-08 14:45:16', '2019-05-08 14:45:16'),
(15, 10, 4, NULL, NULL, '2019-05-08', 'Đã Thêm sách Bạn thực sự có tài', '2019-05-08 14:49:00', '2019-05-08 14:49:00'),
(16, 11, 4, NULL, NULL, '2019-05-08', 'Đã Thêm sách Sức mạnh tiềm thức', '2019-05-08 14:51:43', '2019-05-08 14:51:43'),
(17, 11, 1, 2, NULL, '2019-05-08', NULL, '2019-05-08 15:01:57', '2019-05-08 15:01:57'),
(18, 12, 4, NULL, NULL, '2019-05-08', 'Đã Thêm sách Nghĩ lớn để thành công', '2019-05-08 15:06:57', '2019-05-08 15:06:57'),
(19, 13, 4, NULL, NULL, '2019-05-08', 'Đã Thêm sách Đầu Tư Bất Động Sản – Cách Thức Khởi Nghiệp Và Thu Lợi Nhuận Lớn', '2019-05-08 15:10:19', '2019-05-08 15:10:19'),
(20, 14, 4, NULL, NULL, '2019-05-08', 'Đã Thêm sách Tiền không mua được gì?', '2019-05-08 15:18:05', '2019-05-08 15:18:05'),
(21, 9, 1, 3, NULL, '2019-07-05', NULL, '2019-07-05 04:00:09', '2019-07-05 04:00:09'),
(22, 9, 2, 3, NULL, '2019-07-05', NULL, '2019-07-05 04:00:14', '2019-07-05 04:00:14'),
(23, 15, 4, NULL, NULL, '2019-07-05', 'Đã Thêm sách Tuổi trẻ', '2019-07-05 06:33:29', '2019-07-05 06:33:29'),
(24, 15, 1, 5, NULL, '2019-07-05', NULL, '2019-07-05 06:33:55', '2019-07-05 06:33:55');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhaxuatban`
--

CREATE TABLE `nhaxuatban` (
  `id` int(10) UNSIGNED NOT NULL,
  `name_nxb` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `slug_name_nxb` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `nhaxuatban`
--

INSERT INTO `nhaxuatban` (`id`, `name_nxb`, `slug_name_nxb`, `created_at`, `updated_at`) VALUES
(1, 'Kim Đồng', 'kim-dong', '2019-04-22 04:50:17', '2019-04-22 04:50:17'),
(2, 'Nước ngoài', 'nuoc-ngoai', '2019-05-08 14:44:21', '2019-05-08 14:44:21'),
(3, 'Trẻ', 'tre', '2019-05-08 14:48:02', '2019-05-08 14:48:02');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phieumuon`
--

CREATE TABLE `phieumuon` (
  `muontra_id` int(10) UNSIGNED NOT NULL,
  `sach_id` int(10) UNSIGNED NOT NULL,
  `active` int(11) NOT NULL,
  `ngaytra` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `phieumuon`
--

INSERT INTO `phieumuon` (`muontra_id`, `sach_id`, `active`, `ngaytra`, `created_at`, `updated_at`) VALUES
(15, 1, 1, '2019-05-06', NULL, NULL),
(15, 2, 1, '2019-05-07', NULL, NULL),
(15, 3, 1, '2019-05-07', NULL, NULL),
(16, 2, 1, '2019-05-11', NULL, NULL),
(16, 3, 1, '2019-05-09', NULL, NULL),
(17, 1, 1, '2019-05-11', NULL, NULL),
(17, 11, 1, '2019-05-11', NULL, NULL),
(18, 1, 1, '2019-05-11', NULL, NULL),
(18, 2, 1, '2019-05-11', NULL, NULL),
(18, 3, 1, '2019-05-11', NULL, NULL),
(19, 1, 1, '2019-05-11', NULL, NULL),
(19, 2, 1, '2019-05-11', NULL, NULL),
(19, 3, 1, '2019-05-11', NULL, NULL),
(20, 1, 1, '2019-05-11', NULL, NULL),
(21, 1, 1, '2019-05-11', NULL, NULL),
(22, 1, 1, '2019-05-11', NULL, NULL),
(22, 2, 1, '2019-05-11', NULL, NULL),
(23, 1, 1, '2019-05-12', NULL, NULL),
(23, 2, 1, '2019-05-12', NULL, NULL),
(23, 3, 1, '2019-05-12', NULL, NULL),
(24, 2, 1, '2019-05-16', NULL, NULL),
(24, 3, 1, '2019-05-16', NULL, NULL),
(24, 11, 1, '2019-05-16', NULL, NULL),
(25, 1, 1, '2019-05-16', NULL, NULL),
(25, 2, 1, '2019-05-16', NULL, NULL),
(25, 3, 1, '2019-05-16', NULL, NULL),
(25, 11, 1, '2019-05-16', NULL, NULL),
(26, 1, 1, '2019-05-16', NULL, NULL),
(26, 2, 1, '2019-05-16', NULL, NULL),
(26, 3, 1, '2019-05-16', NULL, NULL),
(26, 11, 1, '2019-05-16', NULL, NULL),
(27, 1, 1, '2019-05-16', NULL, NULL),
(27, 2, 1, '2019-05-16', NULL, NULL),
(27, 3, 1, '2019-05-16', NULL, NULL),
(28, 1, 1, '2019-05-20', NULL, NULL),
(28, 2, 1, '2019-05-20', NULL, NULL),
(28, 3, 1, '2019-05-20', NULL, NULL),
(29, 1, 1, '2019-05-20', NULL, NULL),
(29, 2, 1, '2019-05-20', NULL, NULL),
(30, 1, 1, '2019-05-20', NULL, NULL),
(30, 2, 1, '2019-05-20', NULL, NULL),
(31, 1, 1, '2019-05-20', NULL, NULL),
(31, 2, 1, '2019-05-20', NULL, NULL),
(31, 3, 1, '2019-05-20', NULL, NULL),
(32, 1, 1, '2019-05-20', NULL, NULL),
(32, 2, 1, '2019-05-20', NULL, NULL),
(33, 1, 1, '2019-05-20', NULL, NULL),
(34, 1, 1, '2019-05-20', NULL, NULL),
(35, 1, 1, '2019-06-24', NULL, NULL),
(36, 1, 1, '2019-06-16', NULL, NULL),
(37, 1, 0, NULL, NULL, NULL),
(38, 1, 1, '2019-07-05', NULL, NULL),
(38, 3, 1, '2019-07-05', NULL, NULL),
(39, 1, 0, NULL, NULL, NULL),
(39, 2, 0, NULL, NULL, NULL),
(40, 1, 0, NULL, NULL, NULL),
(40, 2, 0, NULL, NULL, NULL),
(40, 3, 0, NULL, NULL, NULL),
(41, 1, 1, '2019-07-05', NULL, NULL),
(41, 2, 1, '2019-07-05', NULL, NULL),
(41, 15, 1, '2019-07-05', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sach`
--

CREATE TABLE `sach` (
  `id` int(10) UNSIGNED NOT NULL,
  `name_sach` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `name_slug_sach` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `hinhanh` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `namxb` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `soluong` int(11) NOT NULL,
  `mieuta` text COLLATE utf8_unicode_ci,
  `gia` int(11) NOT NULL,
  `solanmuon` int(11) NOT NULL,
  `noibat` int(11) NOT NULL,
  `nxb_id` int(10) UNSIGNED NOT NULL,
  `tacgia_id` int(10) UNSIGNED NOT NULL,
  `theloai_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sach`
--

INSERT INTO `sach` (`id`, `name_sach`, `name_slug_sach`, `hinhanh`, `namxb`, `soluong`, `mieuta`, `gia`, `solanmuon`, `noibat`, `nxb_id`, `tacgia_id`, `theloai_id`, `created_at`, `updated_at`) VALUES
(1, 'Dế mèn phiêu lưu ký', 'de-men-phieu-luu-ky', 'de-men-phieu-luu-ky.jpg', '1996', 1, '\"Dế mèn phiêu lưu kí\" là tác phẩm văn xuôi đặc sắc và nổi tiếng nhất của Tô Hoài viết về loài vật, dành cho lứa tuổi thiếu nhi. Ban đầu truyện có tên là \"Con dế mèn\" (chính là ba chương đầu của truyện) do Nhà xuất bản Tân Dân, Hà Nội phát hành năm 1941.\r\n\r\nSau đó, được sự ủng hộ nhiệt tình của nhân dân, Tô Hoài viết thêm truyện \"Dế Mèn phiêu lưu kí\" (là bảy chương cuối của chuyện\". Năm 1955, ông mới gộp hai chuyện vào với nhau để thành truyện \"Dế mèn phiêu lưu kí\" như ngày nay.', 100000, 27, 1, 1, 1, 1, '2019-04-22 04:51:06', '2019-07-05 06:37:32'),
(2, 'số đỏ', 'so-do', 'so-do.jpg', '1996', 3, 'Trong Số đỏ, một tiểu thuyết hoạt kê, Vũ Trọng Phụng đả kích cay độc cái xã hội tư sản bịp bợm, đang chạy theo lối sống văn minh rởm, hết sức lố lăng thối nát. Tác phẩm này cũng đả kích phong trào được thực dân khuyến khích như: phong trào Âu hoá, vui vẻ trẻ trung, giải phóng phụ nữ, thể dục thể thao, chấn hưng Phật giáo và khẩu hiệu Bình dân dối gạt của bọn cơ hội đương thời...\r\n\r\nMột đóng góp hết sức to lớn của Vũ Trong Phụng với tác phẩm này là đã xây dựng được những nhân vật trở thành điển hình về mặt tâm lý xã hội mà đến hôm nay bóng dáng những nhân vật ấy vẫn không mất hẳn, vẫn còn quanh quẩn ở bên cạnh cúng ta, đó là những Xuân Tóc đỏ, bà Phó Đoan, em Chã, ông TYPN, cô Tuyết, cụ cố Hồng biết rồi, khổ lắm, nói mãi...', 150000, 19, 1, 1, 3, 1, '2019-04-22 06:26:49', '2019-07-05 06:37:32'),
(3, 'Sách Thiên Cổ', 'sach-thien-co', 'sach-thien-co.jpg', '1996', 2, NULL, 100000, 15, 0, 1, 1, 1, '2019-04-22 06:27:41', '2019-07-05 04:59:51'),
(4, 'Sách thăng khúc', 'sach-thang-khuc', 'sach-thang-khuc.jpg', '1996', 0, NULL, 150000, 0, 0, 1, 1, 1, '2019-04-22 06:31:56', '2019-05-08 15:19:35'),
(5, 'Chí phèo', 'chi-pheo', 'chi-pheo.jpg', '1996', 0, 'Tác phẩm Chí Phèo mang giá trị nhân đạo sâu sắc, thể hiện tấm lòng yêu hương, trân trọng của Nam Cao đốI vớI những ngườI khốn khổ. Chí Phèo còn là tiếng kêu cứu thiết tha của những ngướI bất hạnh. Hãy bảo vệ và đấu tranh cho quyền được làm ngườI của những con ngườI kương thiện. Họ phảI được sống và sống hạnh phúc, không còn những thế lực đen tốI của xã hộI đẩy họ vào chổ cùng khốn, bế tắc, đầy bi kịch xót xa…', 150000, 5, 1, 1, 3, 1, '2019-05-08 13:54:33', '2019-05-08 15:59:17'),
(6, 'Trúng số độc đắc', 'trung-so-doc-dac', 'trung-so-doc-dac.jpg', '1996', 0, 'Trúng Số Độc Đắc là tác phẩm cuối đời của Vũ Trọng Phụng. Khác với lối viết tiểu thuyết trước, cứ đến ngày báo ra mới viết một chương, đưa in xong hết mới mới thành sách, Trúng Số Độc Đắc được Vũ Trọng Phụng viết một mạch đến khi hoàn thành, tự tay đi đóng thành quyển rồi mới đưa cho nhà xuất bản. Người bạn cố tri của Vũ Trọng Phụng là Ngọc Giao kể lại rằng mấy hôm trước khi qua đời, Vũ Trọng Phụng đã nhờ mình dìu đến tận nhà in, xin mấy tờ bản thảo đã xếp chữ rồi, vẫn còn lấm lem mực in và dấu ta thợ in, đưa và dặn Ngọc Giao giữ lại để lót đầu cho mình khi đăt thi hài mình vào áo quan.\r\n\r\nKhông đậm chất trào phúng khiến người ta phải vỗ đùi bôm bốp, phá lên mà cười như Số Đỏ, mà nhiều lý lẽ sâu sắc, thăng trầm hơn, nhưng vẫn mang giọng kể tự nhiên, châm biến hài hước của Vũ Trọng Phụng.\r\n\r\nCả tiểu thuyết chỉ tập trung vào nhân vật Phúc (nhân vật chính trúng số). Không có trang nào mà không có Phúc, tất cả chỉ để biểu đạt tâm tư suy nghĩ của anh, cả ngoại hình anh cũng chỉ được phác họa vài dòng ngắn gọn. Vũ Trọng Phụng mượn nhân vật Phúc để kể về về nhân tình thế thái, về thói đời, lòng người đổi trắng thay đen. Và cả chính Phúc, được dịp may đổi đời, rồi có cơ hội chứng kiến, hiểu và cười lòng người thế, cũng không tránh khỏi việc bản thân thay đổi theo hoàn cảnh, thời thế. Bởi vì Phúc cũng là con người.', 150000, 5, 1, 1, 3, 1, '2019-05-08 14:01:39', '2019-05-08 15:59:18'),
(7, 'Cạm bẫy người', 'cam-bay-nguoi', 'cam-bay-nguoi.jpg', '1996', 0, 'Cạm bẫy người (1933) viết về nạn cờ bạc bịp ở Hà Nội.\r\n\r\nĐể thấy cái tệ nạn cờ bạc rộng lớn và tai hại đến đâu, Vũ Trọng Phụng đã điều tra cái làng bịp, vạch ra tổ chức của nó, phác họa chân dung, mô tả chân tướng của dân làng bịp, tường thuật cách hành nghề của họ rõ ràng, sinh động...\r\n\r\nViết Cạm bẫy người là tố cáo một tệ nạn xã hội và nêu lên những bi kịch do những tay săn mòng gây ra cho những gia đình của bọn tín đồ “tôn giáo đỏ đen”.\r\n\r\n***\r\n\r\n\"Vũ Trọng Phụng là một nhà văn tài hoa trên cả hai lĩnh vực phóng sự và tiểu thuyết. Song, trước hết, Vũ Trọng Phụng là một “kiện tướng” về phóng sự, bởi “xét về mặt thể tài thuần tuý, phóng sự của Vũ Trọng Phụng đã là một cái gì rất chín, rất thành thục không chê vào đâu được. Sở dĩ nói Vũ Trọng Phụng đi xa hơn cả, so với nhiều cây bút phóng sự khác là ở chỗ trong khi miêu tả những sự đời ấy, ông biết làm cho nó lung linh lên, thật đấy, mà huyễn hoặc đấy, ma quái đấy, những sự thật được ông khai thác đôi khi tưởng như riêng lẻ, cá biệt, song lại nói được bản chất sự vật. Danh hiệu “ông vua phóng sự” quả là xứng đáng với tài năng và cống hiến to lớn của Vũ Trọng Phụng trong việc phát triển, hoàn thiện thể phóng sự, góp phần khẳng định tên tuổi một nhà văn hiện thực lớn xuất sắc của nền văn học Việt Nam hiện đại.\"', 150000, 10, 1, 1, 3, 1, '2019-05-08 14:23:22', '2019-05-08 15:59:19'),
(8, 'Cát bụi chân ai', 'cat-bui-chan-ai', 'cat-bui-chan-ai.jpg', '1996', 0, 'Mở đầu bằng mối giao tình giữa Tô Hoài và Nguyễn Tuân. Kết thúc bằng cái chết của Nguyễn Tuân. Giữa hai nhà văn đó là những kiếp nhân sinh chập chờn như những bóng ma trơi. Giữa hai nhà văn đó là không khí ngột ngạt của văn nghệ, kháng chiến, cách mạng và chính trị. Giữa hai nhà văn đó, cho tới khi có một người nằm xuống, đã một nửa thế kỷ trôi qua...(Hoàng Khởi Phong)\r\n\r\nTô Hoài đã khắc họa thành công các hình tượng Nguyễn Tuân, Nguyên Hồng, Nguyễn Bính, Xuân Diệu… và giúp chúng ta hiểu rõ hơn về một thời đại văn học. Đặc biệt Tô Hoài không tô vẽ cầu kỳ, không thiêng liêng hóa hình tượng Nguyễn Tuân nhưng chân dung Nguyễn Tuân không vì thế mà mất đi vẻ khả ái, đẹp đẽ và ấn tượng. Chỉ điểm xuyết về con người Nguyễn Tuân trong giai đoạn tiền chiến, rồi đi ngược lại mãi về một thời rất xa, cứ thế cuộc đời dấn thân của Nguyễn Tuân như Tô Hoài biết từ sau 1945 tới nay hiện lên sinh động với tất cả những gì bình dị và thân thương nhất…', 150000, 10, 1, 1, 1, 1, '2019-05-08 14:26:48', '2019-05-08 15:59:21'),
(9, 'Nghệ thuật đàm phán', 'nghe-thuat-dam-phan', 'nghe-thuat-dam-phan.jpg', '1996', 0, 'Quyển sách cho chúng ta thấy cách Trump làm việc mỗi ngày - cách ông điều hành công việc kinh doanh và cuộc sống - cũng như cách ông trò chuyện với bạn bè và gia đình, làm ăn với đối thủ, mua thành công những sòng bạc hàng đầu ở thành phố Atlantic, thay đổi bộ mặt của những cao ốc ở thành phố New York... và xây dựng những tòa nhà chọc trời trên thế giới. \r\n\r\nQuyển sách đi sâu vào đầu óc của một doanh nhân xuất sắc và khám phá một cách khoa học chưa từng thấy về cách đàm phán một thương vụ thành công. Đây là một cuốn sách thú vị về đàm phán và kinh doanh – và là một cuốn sách nên đọc cho bất kỳ ai quan tâm đến đầu tư, bất động sản và thành công.', 200000, 10, 1, 2, 4, 2, '2019-05-08 14:45:16', '2019-07-05 04:00:14'),
(10, 'Bạn thực sự có tài', 'ban-thuc-su-co-tai', 'ban-thuc-su-co-tai.jpg', '1996', 0, 'Khả năng sáng tạo không phải một loại tài năng thiên bẩm chỉ dành cho một số người đặc biệt, nó là một kỹ năng bất cứ ai cũng có thể học hỏi. Dựa trên nền tảng đó, tác giả - một chuyên gia huấn luyện và cũng là một giáo sư của Đại học Stanford sẽ giúp độc giả hiểu đúng hơn về sự sáng tạo. Cùng với việc làm rõ bản chất của sáng tạo, bà còn cung cấp cho độc giả nhiều ví dụ cực kỳ thú vị về những ý tưởng đột phát ở khắp mọi nơi, trong đó có những công ty nổi tiếng như Google, Pixar, Facebook, IDEO… \r\n\r\nNgoài ra, dựa trên rất nhiều bài tập và tình huống thực tế thú vị trong quá trình bà làm việc ở Stanford, Tina Seelig đã giới thiệu với chúng ta trong cuốn sách này nhiều công cụ và phương pháp để nâng cao khả năng sáng tạo', 100000, 10, 1, 3, 5, 2, '2019-05-08 14:49:00', '2019-05-08 15:59:24'),
(11, 'Sức mạnh tiềm thức', 'suc-manh-tiem-thuc', 'suc-manh-tiem-thuc.jpg', '1996', 2, 'Là một trong những quyển sách về nghệ thuật sống nhận được nhiều lời ngợi khen và bán chạy nhất mọi thời đại, Sức Mạnh Tiềm Thức đã giúp hàng triệu độc giả trên thế giới đạt được những mục tiêu quan trọng trong đời chỉ bằng một cách đơn giản là thay đổi tư duy.\r\n\r\nSức Mạnh Tiềm Thức giới thiệu và giải thích các phương pháp tập trung tâm thức nhằm xoá bỏ những rào cản tiềm thức đã ngăn chúng ta đạt được những điều mình mong muốn.\r\n\r\nSức Mạnh Tiềm Thức không những có khả năng truyền cảm hứng cho người đọc, mà nó còn rất thực tế vì được minh hoạ bằng những ví dụ sinh động trong cuộc sống hằng ngày. Từ đó, Sức Mạnh Tiềm Thức giúp độc giả vận dụng năng lực trí tuệ phi thường tiềm ẩn troing mỗi người để tạo dựng sự tự tin, xây dựng các mối quan hệ hoà hợp, đạt được thành công trong sự nghiệp, vượt qua những nỗi sợ hãi và ám ảnh, xua đi những thói quen tiêu cực, và thậm chí còn hướng dẫn cách ta chữa lành những vết thương về thể chất cũng như tâm hồn để có sự bình an, hạnh phúc trọn vẹn trong cuộc sống.', 300000, 14, 1, 2, 6, 2, '2019-05-08 14:51:43', '2019-05-16 05:09:46'),
(12, 'Nghĩ lớn để thành công', 'nghi-lon-de-thanh-cong', 'nghi-lon-de-thanh-cong.jpg', '1996', 0, 'Hai trong số các doanh nhân thành đạt nhất thế giới đã tiết lộ bí quyết suy nghĩ lớn để đạt được những thành công ngoạn mục.\r\n\r\nHãy áp dụng quan điểm của Donald để truyền cảm hứng cho chính bạn, nhằm phá vỡ những hạn chế của bản thân. Bạn luôn có hai lựa chọn, hoặc bằng lòng với những suy nghĩ bình thường như bao người khác hoặc có thể suy nghĩ lớn.\r\n\r\nĐúng như Donald đã nói: \"Nếu đã có thể suy nghĩ, hãy nghĩ lớn. Đó là lựa chọn của bạn. Dù bạn ở trong bất cứ hoàn cảnh nào thì không ai có thể ngăn bạn suy nghĩ lớn. Và một khi đã thích suy nghĩ lớn và học được cách hành động để thành công, bạn sẽ có động lực để tiếp tục và những phần thưởng xứng đáng sẽ đến với bạn. Đó chính là bí quyết của Donald Trump về việc suy nghĩ lớn để thành công. Hãy thực hành bí quyết này, và bạn cũng sẽ đạt được thành công cả trong cuộc sống cũng như trong công việc\".', 200000, 20, 1, 2, 4, 3, '2019-05-08 15:06:57', '2019-05-08 15:59:28'),
(13, 'Đầu Tư Bất Động Sản – Cách Thức Khởi Nghiệp Và Thu Lợi Nhuận Lớn', 'dau-tu-bat-dong-san-cach-thuc-khoi-nghiep-va-thu-loi-nhuan-lon', 'dau-tu-bat-dong-san-cach-thuc-khoi-nghiep-va-thu-loi-nhuan-lon.jpg', '1996', 0, 'Thị trường bất động sản tại Việt Nam chính thức được hình thành từ năm 1993, với sự ra đời của Luật Đất đai cho phép chuyển nhượng, chuyển đổi, cho thuê, thế chấp giá trị quyền sử dụng đất. Năm 1996, lần đầu tiên khái niệm “Thị trường bất động sản” được chính thức đề cập trong văn kiện Đại hội Đảng toàn quốc lần thứ VIII. Sau đó, sự ra đời của Luật đất đai 2003, Dự thảo Luật Kinh doanh bất động sản, Luật Nhà ở và hàng loạt những văn bản dưới luật hướng dẫn thi hành đã khẳng định sự tồn tại và phát triển của thị trường bất động sản Việt Nam.', 200000, 20, 1, 2, 4, 3, '2019-05-08 15:10:19', '2019-05-08 15:59:28'),
(14, 'Tiền không mua được gì?', 'tien-khong-mua-duoc-gi', 'tien-khong-mua-duoc-gi.jpg', '1996', 0, 'Chúng ta đã quen và bị thuyết phục bởi nền kinh tế thị trường: thông qua giá, thị trường điều phối tài nguyên quý hiếm để phục vụ xã hội một cách tốt nhất. Ai sẵn sàng bỏ nhiều tiền nhất để mua một cái gì đó sẽ là người sử dụng nó một cách hiệu quả nhất.\r\n\r\nNhưng, sâu thẳm trong lòng mình, chúng ta cũng tin rằng tiền không thể mua được tất cả mọi thứ: nó không mua được danh dự, không mua được sự sống và cái chết.\r\n\r\nNhưng đâu là ranh giới giữa những gì có thể mua được bằng tiền và những gì thì không. Chúng ta đã quen với việc những người mua vé máy bay có quyền lên máy bay trước mà không cần xếp hàng. Chúng ta cũng quen, tuy rằng cảm thấy khó chịu hơn, khi có người bỏ tiền để tranh giành cho được một chỗ trong trường tốt cho con mình đi học. Nhưng chúng ta rất khó chấp nhận khi người ta bỏ tiền để chen hàng cho người nhà mình vào phòng mổ cấp cứu. Chúng ta cũng rất khó chấp nhận khi người ta bỏ tiền ra để mua bộ phận trên cơ thể người khác hầu cấy vào cơ thể mình.', 200000, 30, 1, 2, 7, 3, '2019-05-08 15:18:05', '2019-05-08 15:59:29'),
(15, 'Tuổi trẻ', 'tuoi-tre', 'tuoi-tre.jpg', '1996', 4, 'tuổi trẻ', 100000, 1, 0, 1, 2, 1, '2019-07-05 06:33:29', '2019-07-05 06:35:57');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tacgia`
--

CREATE TABLE `tacgia` (
  `id` int(10) UNSIGNED NOT NULL,
  `name_tg` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `slug_name_tg` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `hinhanh` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gioithieu` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tacgia`
--

INSERT INTO `tacgia` (`id`, `name_tg`, `slug_name_tg`, `hinhanh`, `gioithieu`, `created_at`, `updated_at`) VALUES
(1, 'Tô Hoài', 'to-hoai', 'to-hoai-j6Kz5k1XAWykOMCP.jpg', 'Nhà văn Tô Hoài (1920-2014) là một trong những cây bút văn xuôi tiêu biểu của văn học Việt Nam hiện đại. Ông là tác giả của hàng trăm cuốn sách thuộc nhiều thể loại: Truyện ngắn, tiểu thuyết, bút ký, tự truyện... Trong số đó nổi tiếng nhất là tác phẩm Dế Mèn phiêu lưu ký viết cho thiếu nhi từ những năm trước Cách mạng.', '2019-04-22 04:50:24', '2019-05-08 13:43:00'),
(2, 'Nam Cao', 'nam-cao', 'nam-cao.jpg', 'Nam Cao là một nhà văn và cũng là một chiến sĩ, liệt sĩ người Việt Nam. Ông là nhà văn hiện thực lớn, một nhà báo kháng chiến, một trong những nhà văn tiêu biểu nhất thế kỷ 20. Nam Cao có nhiều đóng góp quan trọng đối với việc hoàn thiện phong cách truyện ngắn và tiểu thuyết Việt Nam ở nửa đầu thế kỷ 20.', '2019-05-08 13:42:30', '2019-05-08 13:42:30'),
(3, 'Vũ Trọng Phụng', 'vu-trong-phung', 'vu-trong-phung.jpg', 'Vũ Trọng Phụng (1912-1939) là một nhà văn, nhà báo nổi tiếng của Việt Nam vào đầu thế kỷ 20. Tuy thời gian cầm bút rất ngắn ngủi, với tác phẩm đầu tiên là truyện ngắn Chống nạng lên đường đăng trên Ngọ báo vào năm 1930, ông đã để lại một kho tác phẩm đáng kinh ngạc: hơn 30 truyện ngắn, 9 tập tiểu thuyết, 9 tập phóng sự, 7 vở kịch, cùng một bản dịch vở kịch từ tiếng Pháp, một số bài viết phê bình, tranh luận văn học và hàng trăm bài báo viết về các vấn đề chính trị, xã hội, văn hóa. Một số trích đoạn tác phẩm của ông trong các tác phẩm Số đỏ và Giông Tố đã được đưa vào sách giáo khoa môn Ngữ văn của Việt Nam.', '2019-05-08 14:00:49', '2019-05-08 14:00:49'),
(4, 'Donald J. Trump - Tony Schwartz', 'donald-j-trump-tony-schwartz', 'donald-j-trump-tony-schwartz.jpg', 'Trump: The Art of the Deal (Trump: Nghệ thuật Đàm phán) Cuốn sách nhận được sự chú ý nhiều hơn trong chiến dịch năm 2016 của Trump cho chức chủ tịch của Hoa Kỳ. Ông trích dẫn nó như là một trong những thành tựu đáng tự hào nhất của mình và cuốn sách yêu thích thứ hai của mình sau Kinh Thánh. . Đồng tác giả Schwartz bày tỏ sự hối tiếc về sự tham gia của ông trong cuốn sách, và cả ông và nhà xuất bản của cuốn sách, Howard Kaminsky, nói rằng Trump đã không đóng vai trò gì trong việc viết ra cuốn sách này. Trump đã đưa ra các tranh cãi xung đột cho câu hỏi ai mới là tác giả cuốn sách [1]\r\n\r\nĐây là cuốn sách đầu tay của Donald Trump.[2] Trump được thuyết phục viết cuốn sách này bởi chủ sở hữu Conde Nast Si Newhouse, sau khi ấn bản tháng 5 năm 1984 của tạp chí GQ với Trump là nhân vật trang bìa bất ngờ bán chạy.[1] Đồng tác giả của cuốn sách là nhà báo Tony Schwartz. Cuốn sách được xuất bản ngày 1 tháng 11 năm 1987 bởi Warner Books.', '2019-05-08 14:44:06', '2019-05-08 14:44:06'),
(5, 'Tina Seelig', 'tina-seelig', 'tina-seelig.jpg', NULL, '2019-05-08 14:47:53', '2019-05-08 14:47:53'),
(6, 'Joseph Murphy, Ph.D., D.D', 'joseph-murphy-phd-dd', 'joseph-murphy-phd-dd.jpg', 'Giáo sư Joseph Murphy (1898 - 1981) sinh ngày 20.5.1898, đã viết sách, giảng dạy, tư vấn và diễn thuyết cho hàng ngàn người trên thế giới.\r\n\r\nÔng từng là Phó chủ tịch của Hội nhà thờ Thánh khoa học ở Los Angeles trong 28 năm, nơi các bài diễn thuyết của ông có từ 1300 đến 1500 người đến nghe mỗi Chủ nhật.\r\n\r\nTư tưởng của ông ảnh hưởng từ Ernest Holmes và Emmet Fox - những tác giả nổi tiếng theo nguyên tắc New Thought.\r\n\r\nÔng viết hơn 30 quyển sách, đưa ra những kĩ thuật đơn giản nhưng được chứng minh một cách khoa học, và đưa một sự thật đầy kinh ngạc là sức mạnh trong tiềm thức mỗi người có thể mang đến những điều vô cùng kì diệu, chữa lành mọi vết thương tâm lý. Một số quyển sách nổi tiếng của ông có thể kể đến như “Peace within yourself” (1956), “Your infinite power to be rich” (1966), “Within you is the power” (1977), “The power of your subconscious mind” (1963).', '2019-05-08 14:50:49', '2019-05-08 14:50:49'),
(7, 'Michael J. Sandel', 'michael-j-sandel', 'michael-j-sandel.jpg', 'Michael J. Sandel (sinh 1953) là giáo sư ngành triết học chính trị tại Đại học Harvard, nổi tiếng với môn Công lý vì thu hút số sinh viên kỷ lục, hơn 10.000 người học trong hai thập niên, 1.115 sinh viên chỉ riêng trong học kỳ hai năm 2007. Là thành viên trong ủy ban đạo đức sinh học của tổng thống Bush, Sandel cũng thường xuất hiện trên truyền thông về các vấn đề đạo đức, mà theo ông cũng chính là chính trị.', '2019-05-08 15:17:23', '2019-05-08 15:17:23');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `theloaisach`
--

CREATE TABLE `theloaisach` (
  `id` int(10) UNSIGNED NOT NULL,
  `name_tl` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `slug_name_tl` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `theloaisach`
--

INSERT INTO `theloaisach` (`id`, `name_tl`, `slug_name_tl`, `created_at`, `updated_at`) VALUES
(1, 'Văn học việt nam', 'van-hoc-viet-nam', '2019-04-22 04:50:07', '2019-05-08 13:38:13'),
(2, 'Tâm lý - Kỹ năng sống', 'tam-ly-ky-nang-song', '2019-05-08 13:38:44', '2019-05-08 13:38:44'),
(3, 'Kinh Tế - Quản lý', 'kinh-te-quan-ly', '2019-05-08 13:39:02', '2019-05-08 13:39:02'),
(4, 'Marketing - Bán hàng', 'marketing-ban-hang', '2019-05-08 13:39:34', '2019-05-08 13:39:34'),
(5, 'Y học - Sức khỏe', 'y-hoc-suc-khoe', '2019-05-08 13:40:26', '2019-05-08 13:40:26');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `level` int(11) NOT NULL,
  `CMT` int(11) DEFAULT NULL,
  `diachi` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `SDT` int(11) DEFAULT NULL,
  `tien` int(11) DEFAULT NULL,
  `hinhanh` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `loaiTK` int(11) DEFAULT NULL,
  `activated` int(11) NOT NULL,
  `beginloaiTK` date DEFAULT NULL,
  `endloaiTK` date DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `level`, `CMT`, `diachi`, `SDT`, `tien`, `hinhanh`, `loaiTK`, `activated`, `beginloaiTK`, `endloaiTK`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@me.to', NULL, '$2y$10$cAC0d.cBnK7.fT62YIkvv.KUCWXVoDMI9gu3orr3.EOJ5uLIwp6/W', 1, 987654321, NULL, NULL, NULL, 'profile.png', NULL, 1, NULL, NULL, 'nbixN1Gwc16ImUHgl7RgdX9PDjBmox9ds3AB1JjYT64FcnZ57DhxqCufdBNR', NULL, NULL),
(2, 'coolboy1111', 'coolboy11@me.to', NULL, '$2y$10$PyaE9ycSSPGgNuYxaqZPrO2.ba/qa5P0KOkrdOKQzM2/MPnwiqLle', 0, 1234560789, NULL, NULL, 780000, 'profile.png', 1, 1, '2019-04-22', '2019-05-22', '2wi73XjNFF5eQKgM80sILyQWGp5Qm6gmEyRB6C64ratG2SOA1bkMwaPZEsNr', '2019-04-22 04:51:52', '2019-07-04 06:30:09'),
(4, 'coolboy', 'coolboy@me.to', NULL, '$2y$10$PyaE9ycSSPGgNuYxaqZPrO2.ba/qa5P0KOkrdOKQzM2/MPnwiqLle', 0, 1234567789, NULL, NULL, 200000, 'profile.png', 1, 1, '2019-04-22', '2019-05-22', NULL, '2019-04-22 04:51:52', '2019-07-05 04:57:47'),
(5, 'ngocanh', 'dangngocanh269@gmail.com', NULL, '$2y$10$hvatdUbfV7v2BUaxUoCyke0fgGcpssODIfA7BZH02mrd76g6wLq/C', 0, 1123456789, NULL, NULL, 642000, 'profile.png', 1, 1, '2019-04-22', '2019-05-22', 'TSpP1BTFangFTYjgJX7vXyPo8FkOqr5SP39M04pBGOdWglshShFOLDCwiaoq', '2019-04-22 09:29:09', '2019-06-24 07:00:30'),
(6, 'badboy', 'badboy@me.to', NULL, '$2y$10$BFPLllW3suYLRk7q5O4l.eHnpsTIfqtL1JCVOw/ZSTvO9xJdHyVgq', 0, 123456789, NULL, NULL, 700000, 'profile.png', 1, 1, '2019-04-22', '2019-05-22', 'q9rIgehdkQRDGT0I0oV1qtLItftqZWI7ANN2heYlTjNVx81LncEOJKwKcTQA', '2019-04-22 09:54:50', '2019-07-05 04:59:42'),
(8, 'show', 'show@me.to', NULL, '$2y$10$DOsnoUL23n6XOOqi.ZsOv.WCpRzaVx7zWerqzlFTdphv1nhOYGLMq', 2, 1234567899, NULL, NULL, 0, 'profile.png', NULL, 1, NULL, NULL, 'gfRNgT9VBtMjhUHbgDVeysxE7TRVZ7EYJeTjfWvYnLo2EyNIzlBWa1nPg1uR', '2019-04-25 02:43:42', '2019-04-25 02:44:33'),
(9, 'ngocanh', 'dangngocanh26q9@gmail.com', NULL, '$2y$10$YGaqn7z6fDD3VHhMQdsN1ebtGD3mkTgvTzrDxCB14xEmdN4O219ii', 0, 1234567890, NULL, NULL, 0, 'profile.png', NULL, 1, NULL, NULL, NULL, '2019-04-25 08:37:16', '2019-07-05 03:44:20'),
(10, 'Đặng Hưu Đạt', 'danghuudat1997@yahoo.com.vn', NULL, '$2y$10$Py8.oUc3qU2KKpjwV/XbnOi3mgWEYrGimF1et7sOjSdN5MNKdTU8S', 0, 1122334411, NULL, NULL, 500000, 'profile.png', 1, 1, '2019-07-05', '2019-08-04', NULL, '2019-07-05 03:45:34', '2019-07-05 04:24:21'),
(12, 'Khá Bảnh', 'khabanh@me.to', NULL, '$2y$10$Aszqieqp6ZQRbJ2h33cJEOt5ICyf/T1XhhMTP5tqVgKEtIfmHEGRS', 0, 1234578612, NULL, NULL, 9731000, 'profile.png', NULL, 1, NULL, NULL, 'Coas1MZswyHj6CyqPcHG2MfDCfP4IOElA0fRxP5LyNMIoMcKy3foxErlWXRd', '2019-07-05 03:47:10', '2019-07-05 05:03:53'),
(13, 'Nguyễn Khánh Toàn', 'toan98@me.to', NULL, '$2y$10$zY8vooUWbZ3U0GnRUrA6fuMTnpmQkxstftUxYrSW7c/vfejzm3Vcy', 0, 1234567898, NULL, NULL, 0, 'profile.png', NULL, 1, NULL, NULL, NULL, '2019-07-05 04:46:25', '2019-07-05 04:47:12'),
(14, 'Mai Thúy Nga', 'a123@me.to', NULL, '$2y$10$XIAvs4evZxu0QV5oXMBWIujPu4wpkUmhDrJgvR1pIqYg.tuGGRDoC', 0, 987456123, NULL, NULL, 1167000, 'profile.png', NULL, 1, NULL, NULL, NULL, '2019-07-05 06:24:47', '2019-07-05 06:40:54');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `vitien`
--

CREATE TABLE `vitien` (
  `id` int(10) UNSIGNED NOT NULL,
  `tentaikhoan` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `ngaynap` date NOT NULL,
  `tiennap` int(11) NOT NULL,
  `nguoinap` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `vitien`
--

INSERT INTO `vitien` (`id`, `tentaikhoan`, `ngaynap`, `tiennap`, `nguoinap`, `created_at`, `updated_at`, `status`) VALUES
(23, 'coolboy@me.to', '2019-04-22', 200000, 'admin@me.to', '2019-04-22 10:07:42', '2019-04-22 10:07:42', 0),
(24, 'coolboy@me.to', '2019-04-22', 500000, 'admin@me.to', '2019-04-22 11:21:05', '2019-04-22 11:21:05', 0),
(25, 'dangngocanh269@gmail.com', '2019-04-23', 500000, 'admin@me.to', '2019-04-23 05:30:30', '2019-04-23 05:30:30', 0),
(26, 'badboy@me.to', '2019-04-23', 500000, 'admin@me.to', '2019-04-23 09:24:52', '2019-04-23 09:24:52', 0),
(27, 'dangngocanh269@gmail.com', '2019-04-23', 500000, 'admin@me.to', '2019-04-23 14:00:41', '2019-04-23 14:00:41', 0),
(28, 'dangngocanh269@gmail.com', '2019-05-08', 100000, 'admin@me.to', '2019-05-08 08:12:46', '2019-05-08 08:12:46', 0),
(29, 'dangngocanh269@gmail.com', '2019-05-09', 100000, 'admin@me.to', '2019-05-09 07:42:14', '2019-05-09 07:42:14', 0),
(30, 'dangngocanh269@gmail.com', '2019-05-11', 1000000, 'admin@me.to', '2019-05-11 14:44:21', '2019-05-11 14:44:21', 0),
(31, 'dangngocanh269@gmail.com', '2019-06-24', 161000, 'admin@me.to', '2019-06-24 07:00:28', '2019-06-24 07:00:28', 1),
(32, 'coolboy@me.to', '2019-06-25', 100000, 'admin@me.to', '2019-06-24 07:00:28', NULL, 2),
(33, 'coolboy@me.to', '2019-06-25', 100000, 'admin@me.to', '2019-06-24 17:00:00', NULL, 2),
(34, 'coolboy11@me.to', '2019-06-25', 100000, 'admin@me.to', '2019-06-05 17:00:00', NULL, 2),
(35, 'coolboy11@me.to', '2019-06-25', 100000, 'admin@me.to', '2019-07-05 17:00:00', NULL, 2),
(36, 'khabanh@me.to', '2019-07-05', 10000000, 'admin@me.to', '2019-07-05 04:20:47', '2019-07-05 04:20:47', 0),
(37, 'danghuudat1997@yahoo.com.vn', '2019-07-05', 500000, 'admin@me.to', '2019-07-05 04:24:21', '2019-07-05 04:24:21', 0),
(38, 'khabanh@me.to', '2019-07-05', 109000, 'admin@me.to', '2019-07-05 04:28:10', '2019-07-05 04:28:10', 1),
(39, 'coolboy@me.to', '2019-07-05', 200000, 'admin@me.to', '2019-07-05 04:57:46', '2019-07-05 04:57:46', 0),
(40, 'badboy@me.to', '2019-07-05', 200000, 'admin@me.to', '2019-07-05 04:58:33', '2019-07-05 04:58:33', 0),
(41, 'badboy@me.to', '2019-07-05', 500000, 'admin@me.to', '2019-07-05 04:59:41', '2019-07-05 04:59:41', 0),
(42, 'a123@me.to', '2019-07-05', 500000, 'admin@me.to', '2019-07-05 06:27:01', '2019-07-05 06:27:01', 0),
(43, 'a123@me.to', '2019-07-05', 1000000, 'admin@me.to', '2019-07-05 06:35:44', '2019-07-05 06:35:44', 0),
(44, 'a123@me.to', '2019-07-05', 213000, 'admin@me.to', '2019-07-05 06:37:31', '2019-07-05 06:37:31', 1);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `ban_douong`
--
ALTER TABLE `ban_douong`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `chitiethds`
--
ALTER TABLE `chitiethds`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chitiethds_sach_id_foreign` (`sach_id`),
  ADD KEY `chitiethds_hds_id_foreign` (`hds_id`);

--
-- Chỉ mục cho bảng `douong_theloai`
--
ALTER TABLE `douong_theloai`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `hoadoncafe`
--
ALTER TABLE `hoadoncafe`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `hoadonsach`
--
ALTER TABLE `hoadonsach`
  ADD PRIMARY KEY (`id`),
  ADD KEY `muontra_id` (`muontra_id`);

--
-- Chỉ mục cho bảng `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `muontrasach`
--
ALTER TABLE `muontrasach`
  ADD PRIMARY KEY (`id`),
  ADD KEY `muontrasach_user_id_foreign` (`user_id`);

--
-- Chỉ mục cho bảng `nhaphuysach`
--
ALTER TABLE `nhaphuysach`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `nhaxuatban`
--
ALTER TABLE `nhaxuatban`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Chỉ mục cho bảng `phieumuon`
--
ALTER TABLE `phieumuon`
  ADD PRIMARY KEY (`muontra_id`,`sach_id`);

--
-- Chỉ mục cho bảng `sach`
--
ALTER TABLE `sach`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sach_nxb_id_foreign` (`nxb_id`),
  ADD KEY `sach_tacgia_id_foreign` (`tacgia_id`),
  ADD KEY `sach_theloai_id_foreign` (`theloai_id`);

--
-- Chỉ mục cho bảng `tacgia`
--
ALTER TABLE `tacgia`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `theloaisach`
--
ALTER TABLE `theloaisach`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Chỉ mục cho bảng `vitien`
--
ALTER TABLE `vitien`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `ban_douong`
--
ALTER TABLE `ban_douong`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `chitiethds`
--
ALTER TABLE `chitiethds`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `douong_theloai`
--
ALTER TABLE `douong_theloai`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `hoadoncafe`
--
ALTER TABLE `hoadoncafe`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `hoadonsach`
--
ALTER TABLE `hoadonsach`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT cho bảng `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `muontrasach`
--
ALTER TABLE `muontrasach`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT cho bảng `nhaphuysach`
--
ALTER TABLE `nhaphuysach`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT cho bảng `nhaxuatban`
--
ALTER TABLE `nhaxuatban`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `sach`
--
ALTER TABLE `sach`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `tacgia`
--
ALTER TABLE `tacgia`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `theloaisach`
--
ALTER TABLE `theloaisach`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `vitien`
--
ALTER TABLE `vitien`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `chitiethds`
--
ALTER TABLE `chitiethds`
  ADD CONSTRAINT `chitiethds_hds_id_foreign` FOREIGN KEY (`hds_id`) REFERENCES `hoadonsach` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `chitiethds_sach_id_foreign` FOREIGN KEY (`sach_id`) REFERENCES `sach` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `hoadonsach`
--
ALTER TABLE `hoadonsach`
  ADD CONSTRAINT `abc` FOREIGN KEY (`muontra_id`) REFERENCES `muontrasach` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `muontrasach`
--
ALTER TABLE `muontrasach`
  ADD CONSTRAINT `muontrasach_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `phieumuon`
--
ALTER TABLE `phieumuon`
  ADD CONSTRAINT `phieumuon_muontra_id_foreign` FOREIGN KEY (`muontra_id`) REFERENCES `muontrasach` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `sach`
--
ALTER TABLE `sach`
  ADD CONSTRAINT `sach_nxb_id_foreign` FOREIGN KEY (`nxb_id`) REFERENCES `nhaxuatban` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sach_tacgia_id_foreign` FOREIGN KEY (`tacgia_id`) REFERENCES `tacgia` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sach_theloai_id_foreign` FOREIGN KEY (`theloai_id`) REFERENCES `theloaisach` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
