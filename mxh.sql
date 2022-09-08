-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 23, 2022 lúc 07:35 PM
-- Phiên bản máy phục vụ: 10.4.21-MariaDB
-- Phiên bản PHP: 7.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `mxh`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin`
--

CREATE TABLE `admin` (
  `ad_ma` int(10) UNSIGNED NOT NULL,
  `ad_account` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ad_password` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ad_avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `admin`
--

INSERT INTO `admin` (`ad_ma`, `ad_account`, `ad_password`, `ad_avatar`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'e10adc3949ba59abbe56e057f20f883e', NULL, '2022-04-27 11:01:40', '2022-04-27 11:01:40');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `baocaopost`
--

CREATE TABLE `baocaopost` (
  `rp_id` int(10) UNSIGNED NOT NULL,
  `post_id` int(10) UNSIGNED NOT NULL,
  `user_tocao` int(10) UNSIGNED NOT NULL,
  `rp_tieude` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rp_noidung` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `baocaopost`
--

INSERT INTO `baocaopost` (`rp_id`, `post_id`, `user_tocao`, `rp_tieude`, `rp_noidung`, `created_at`, `updated_at`) VALUES
(11, 172, 29, 'Thông tin sai sự thật', 'Bài đăng chứa nội dung sai sự thật', '2022-05-23 01:19:02', '2022-05-23 01:19:02');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `baocaovipham`
--

CREATE TABLE `baocaovipham` (
  `bcvp_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `school_id` int(10) UNSIGNED DEFAULT NULL,
  `group_id` int(10) UNSIGNED DEFAULT NULL,
  `bcvp_catory` int(11) DEFAULT NULL,
  `user_tocao` int(10) UNSIGNED NOT NULL,
  `bcvp_tieude` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bcvp_noidung` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `baocaovipham`
--

INSERT INTO `baocaovipham` (`bcvp_id`, `user_id`, `school_id`, `group_id`, `bcvp_catory`, `user_tocao`, `bcvp_tieude`, `bcvp_noidung`, `created_at`, `updated_at`) VALUES
(6, 37, NULL, NULL, 1, 25, 'Giả mạo', 'Gio sj', '2022-05-21 07:59:04', '2022-05-21 07:59:04'),
(7, NULL, NULL, 12, 2, 27, 'Sử dụng ngôn từ không phù hợp', 'Nội dung trong nhóm sử dụng ngôn từ kích động', '2022-05-23 14:55:38', '2022-05-23 14:55:38'),
(8, NULL, 7, NULL, 3, 27, 'Các vấn đề khác', 'Người quản lý trang không kiểm duyệt nội dung đăng 1 cách hợp lý', '2022-05-23 16:29:01', '2022-05-23 16:29:01');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bookmark`
--

CREATE TABLE `bookmark` (
  `bm_id` int(10) UNSIGNED NOT NULL,
  `nguoiluu` int(10) UNSIGNED NOT NULL,
  `baiviet` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `bookmark`
--

INSERT INTO `bookmark` (`bm_id`, `nguoiluu`, `baiviet`, `created_at`, `updated_at`) VALUES
(22, 26, 163, '2022-05-21 03:30:13', '2022-05-21 03:30:13'),
(23, 25, 173, '2022-05-21 07:54:59', '2022-05-21 07:54:59'),
(25, 27, 173, '2022-05-23 16:30:31', '2022-05-23 16:30:31');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comment`
--

CREATE TABLE `comment` (
  `cmt_id` int(10) UNSIGNED NOT NULL,
  `post_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `cmt_noidung` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `cmt_reply` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `comment`
--

INSERT INTO `comment` (`cmt_id`, `post_id`, `user_id`, `cmt_noidung`, `cmt_reply`, `created_at`, `updated_at`) VALUES
(35, 174, 26, 'đã cmt<br>', NULL, '2022-05-21 07:48:09', '2022-05-21 07:48:09'),
(36, 189, 25, 'HFsuhsdjivsdkvds', NULL, '2022-05-23 14:20:50', '2022-05-23 14:20:50');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `emoticons`
--

CREATE TABLE `emoticons` (
  `emoticons_id` int(10) UNSIGNED NOT NULL,
  `post_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `icon_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `emoticons`
--

INSERT INTO `emoticons` (`emoticons_id`, `post_id`, `user_id`, `icon_id`, `created_at`, `updated_at`) VALUES
(115, 153, 33, 3, '2022-05-20 17:04:39', '2022-05-20 17:04:39'),
(116, 156, 35, 2, '2022-05-20 17:33:57', '2022-05-20 17:33:57'),
(117, 165, 26, 3, '2022-05-21 03:15:43', '2022-05-21 03:15:43'),
(118, 164, 26, 2, '2022-05-21 03:23:44', '2022-05-21 03:23:44'),
(119, 163, 26, 2, '2022-05-21 03:23:46', '2022-05-21 03:23:46'),
(120, 162, 26, 2, '2022-05-21 03:23:47', '2022-05-21 03:23:47'),
(121, 161, 26, 2, '2022-05-21 03:26:32', '2022-05-21 03:26:32'),
(122, 160, 26, 2, '2022-05-21 03:26:36', '2022-05-21 03:26:36'),
(123, 155, 25, 3, '2022-05-21 03:32:56', '2022-05-21 03:32:56'),
(124, 153, 25, 3, '2022-05-21 03:38:42', '2022-05-21 03:38:42'),
(125, 155, 33, 3, '2022-05-21 03:48:37', '2022-05-21 03:48:37'),
(126, 170, 25, 2, '2022-05-21 05:32:12', '2022-05-21 05:32:12'),
(127, 166, 26, 3, '2022-05-21 07:45:55', '2022-05-21 07:45:55'),
(128, 174, 26, 3, '2022-05-21 07:47:59', '2022-05-21 07:47:59'),
(129, 178, 39, 3, '2022-05-22 16:50:13', '2022-05-22 16:50:13'),
(130, 174, 39, 3, '2022-05-22 16:50:26', '2022-05-22 16:50:26'),
(131, 166, 39, 5, '2022-05-22 16:50:27', '2022-05-22 16:50:27'),
(132, 165, 39, 4, '2022-05-22 16:50:30', '2022-05-22 16:50:30'),
(133, 164, 39, 4, '2022-05-22 16:50:34', '2022-05-22 16:50:34'),
(134, 173, 29, 2, '2022-05-23 01:27:55', '2022-05-23 01:27:55'),
(135, 172, 29, 2, '2022-05-23 01:27:57', '2022-05-23 01:27:57'),
(137, 179, 29, 3, '2022-05-23 02:55:00', '2022-05-23 02:55:00'),
(138, 180, 29, 2, '2022-05-23 02:58:51', '2022-05-23 02:58:51'),
(139, 180, 26, 2, '2022-05-23 09:01:40', '2022-05-23 09:01:40'),
(140, 155, 40, 6, '2022-05-23 12:26:00', '2022-05-23 12:26:00'),
(141, 185, 40, 2, '2022-05-23 13:15:44', '2022-05-23 13:15:44'),
(142, 186, 40, 2, '2022-05-23 13:15:46', '2022-05-23 13:15:46'),
(143, 187, 40, 2, '2022-05-23 13:15:47', '2022-05-23 13:15:47'),
(144, 178, 40, 1, '2022-05-23 13:15:53', '2022-05-23 13:15:53'),
(145, 177, 40, 1, '2022-05-23 13:15:55', '2022-05-23 13:15:55'),
(146, 176, 40, 1, '2022-05-23 13:15:57', '2022-05-23 13:15:57'),
(147, 168, 40, 3, '2022-05-23 13:15:59', '2022-05-23 13:15:59'),
(149, 169, 40, 2, '2022-05-23 13:25:20', '2022-05-23 13:25:20'),
(150, 174, 40, 2, '2022-05-23 13:25:37', '2022-05-23 13:25:37'),
(151, 167, 40, 1, '2022-05-23 13:25:40', '2022-05-23 13:25:40'),
(152, 166, 40, 4, '2022-05-23 13:25:42', '2022-05-23 13:25:42'),
(153, 165, 40, 5, '2022-05-23 13:25:44', '2022-05-23 13:25:44'),
(154, 164, 40, 2, '2022-05-23 13:25:47', '2022-05-23 13:25:47'),
(155, 188, 41, 2, '2022-05-23 13:37:07', '2022-05-23 13:37:07'),
(156, 174, 41, 3, '2022-05-23 13:37:52', '2022-05-23 13:37:52'),
(157, 166, 41, 3, '2022-05-23 13:37:21', '2022-05-23 13:37:21'),
(158, 165, 41, 3, '2022-05-23 13:38:01', '2022-05-23 13:38:01'),
(159, 164, 41, 2, '2022-05-23 13:37:38', '2022-05-23 13:37:38'),
(160, 167, 41, 2, '2022-05-23 13:37:49', '2022-05-23 13:37:49'),
(161, 169, 41, 2, '2022-05-23 13:38:24', '2022-05-23 13:38:24'),
(163, 154, 41, 2, '2022-05-23 13:40:28', '2022-05-23 13:40:28'),
(164, 157, 41, 2, '2022-05-23 13:40:36', '2022-05-23 13:40:36'),
(165, 187, 41, 2, '2022-05-23 13:40:41', '2022-05-23 13:40:41'),
(166, 186, 41, 1, '2022-05-23 13:40:43', '2022-05-23 13:40:43'),
(167, 185, 41, 1, '2022-05-23 13:40:45', '2022-05-23 13:40:45'),
(168, 158, 41, 2, '2022-05-23 13:40:50', '2022-05-23 13:40:50'),
(169, 184, 25, 2, '2022-05-23 13:53:35', '2022-05-23 13:53:35'),
(170, 174, 25, 3, '2022-05-23 13:53:41', '2022-05-23 13:53:41'),
(171, 173, 25, 2, '2022-05-23 13:53:44', '2022-05-23 13:53:44'),
(172, 171, 25, 2, '2022-05-23 13:53:48', '2022-05-23 13:53:48'),
(173, 189, 25, 3, '2022-05-23 14:20:45', '2022-05-23 14:20:45'),
(174, 189, 26, 3, '2022-05-23 16:31:58', '2022-05-23 16:31:58'),
(175, 184, 26, 2, '2022-05-23 17:18:01', '2022-05-23 17:18:01'),
(176, 172, 26, 2, '2022-05-23 17:19:08', '2022-05-23 17:19:08'),
(177, 171, 26, 2, '2022-05-23 17:19:10', '2022-05-23 17:19:10'),
(178, 170, 26, 2, '2022-05-23 17:19:13', '2022-05-23 17:19:13'),
(179, 168, 26, 2, '2022-05-23 17:19:14', '2022-05-23 17:19:14');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
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
-- Cấu trúc bảng cho bảng `file_post`
--

CREATE TABLE `file_post` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `img_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `file_post`
--

INSERT INTO `file_post` (`id`, `img_name`, `img_type`, `post_id`, `created_at`, `updated_at`) VALUES
(79, '278357036_310678337870157_251719222879407307_n_1297029748_1653057254.jpg', 'image/jpeg', 154, NULL, NULL),
(80, 'Cau-hoi-test-iq-32_1586852348_1653064629.png', 'image/png', 155, NULL, NULL),
(82, 'anh-xinh-hot-girl-midu_1757033538_1653068028.jpg', 'image/jpeg', 156, NULL, NULL),
(83, '281036432_148567667698293_6530482958818773875_n_1505716347_1653069107.jpg', 'image/jpeg', 158, NULL, NULL),
(84, '170843434_2910567335895515_3379670089409742527_n_1364402843_1653069309.jpg', 'image/jpeg', 159, NULL, NULL),
(85, '174563357_2914950388790543_2785814413843825568_n_577327244_1653102470.jpg', 'image/jpeg', 160, NULL, NULL),
(86, '175106377_2914950372123878_4555032842348758480_n_102320527_1653102470.jpg', 'image/jpeg', 160, NULL, NULL),
(87, '161951005_2893898247562424_1634523904617427457_n_1662731806_1653102532.jpg', 'image/jpeg', 161, NULL, NULL),
(88, '159108627_2886220571663525_5699643338511489681_n_1582231113_1653102662.jpg', 'image/jpeg', 162, NULL, NULL),
(89, '95612183_2641862349432683_9169106117207261184_n_954047112_1653102730.jpg', 'image/jpeg', 163, NULL, NULL),
(90, '3415809466916_25350709_1653102779.mp4', 'video/mp4', 164, NULL, NULL),
(91, 'tải_xuống_281143881_1653102936.png', 'image/png', 165, NULL, NULL),
(92, 'images_1940682937_1653103554.png', 'image/png', 166, NULL, NULL),
(93, 'bo_de_vi_tich_phan_1541365787_1653103794.docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 167, NULL, NULL),
(94, '636868626509081323FS7Nz2Zjkh7_583091663_1653105609.png', 'image/png', 168, NULL, NULL),
(95, '78ef8d89c5b0ceb03ab6011a2a85c074_86815320_1653106971.jpg', 'image/jpeg', 169, NULL, NULL),
(96, '282568711_1101206433799088_4210363143541804254_n_607608324_1653111127.jpg', 'image/jpeg', 170, NULL, NULL),
(97, '282999366_1100620443857687_6729852866611969411_n_714791540_1653113497.jpg', 'image/jpeg', 171, NULL, NULL),
(98, '283001202_1100620440524354_5782496659548865421_n_1130823894_1653113497.jpg', 'image/jpeg', 171, NULL, NULL),
(99, '283110741_1100620513857680_9063946212859425403_n_239128339_1653113497.jpg', 'image/jpeg', 171, NULL, NULL),
(100, '283132778_1100620453857686_7007405350320388554_n_1045079724_1653113497.jpg', 'image/jpeg', 171, NULL, NULL),
(101, '279965927_1093305157922549_5751537811594085972_n_1128995418_1653113652.jpg', 'image/jpeg', 173, NULL, NULL),
(102, '280437909_1093305154589216_1891175677801985381_n_180868993_1653113652.jpg', 'image/jpeg', 173, NULL, NULL),
(103, '280472508_1093305167922548_6019496459977712862_n_1871277212_1653113652.jpg', 'image/jpeg', 173, NULL, NULL),
(104, '280544183_1093305197922545_1187095652908129684_n_287249429_1653113652.jpg', 'image/jpeg', 173, NULL, NULL),
(105, '1193577093763439169_2070560930_1653119273.mp4', 'video/mp4', 174, NULL, NULL),
(107, 'photo-1-1564902511462713516403_1410755263_1653234061.jpg', 'image/jpeg', 176, NULL, NULL),
(108, '4214721070051176276_556216733_1653238022.mp4', 'video/mp4', 177, NULL, NULL),
(109, 'reshot-illustration-online-course-AFNZ96EPVS_404111851_1653238204.png', 'image/png', 178, NULL, NULL),
(110, 'Capture_101441818_1653274494.PNG', 'image/png', 179, NULL, NULL),
(111, 'Capture_1981724426_1653274657.PNG', 'image/png', 180, NULL, NULL),
(112, 'Capture_1269340950_1653274946.PNG', 'image/png', 181, NULL, NULL),
(113, 'Capture1_311728507_1653297838.PNG', 'image/png', 184, NULL, NULL),
(114, '281956543_1125325914693663_1570154041164664558_n_880788069_1653308737.jpg', 'image/jpeg', 185, NULL, NULL),
(115, '283143377_5107332192685289_5928054027112840957_n_931263292_1653309228.jpg', 'image/jpeg', 186, NULL, NULL),
(116, '276317101_779388299703920_8232785971681434379_n_257220768_1653309349.jpg', 'image/jpeg', 187, NULL, NULL),
(117, '283058435_512180570596043_4404701928133762205_n_2141195333_1653312961.jpg', 'image/jpeg', 188, NULL, NULL),
(118, '283143377_5107332192685289_5928054027112840957_n_2072528344_1653315640.jpg', 'image/jpeg', 189, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `followers`
--

CREATE TABLE `followers` (
  `follow_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `school_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `friend`
--

CREATE TABLE `friend` (
  `user_from` int(10) UNSIGNED NOT NULL,
  `user_to` int(10) UNSIGNED NOT NULL,
  `f_trangthai` int(11) NOT NULL,
  `f_ghichu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `friend`
--

INSERT INTO `friend` (`user_from`, `user_to`, `f_trangthai`, `f_ghichu`, `created_at`, `updated_at`) VALUES
(25, 27, 0, 'Đã gửi lời mời', '2022-05-23 14:22:01', '2022-05-23 14:22:01'),
(25, 29, 1, 'Bạn bè', '2022-05-21 04:21:05', '2022-05-21 04:21:05'),
(26, 25, 1, 'Bạn bè', '2022-05-23 09:02:01', '2022-05-23 09:02:01'),
(26, 28, 1, 'Đã gửi lời mời', '2022-05-21 03:26:42', '2022-05-21 03:26:42'),
(26, 29, 1, 'Đã gửi lời mời', '2022-05-23 16:40:51', '2022-05-23 16:40:51'),
(26, 33, 1, 'Đã gửi lời mời', '2022-05-21 07:47:13', '2022-05-21 07:47:13'),
(26, 34, 1, 'Đã gửi lời mời', '2022-05-23 16:40:49', '2022-05-23 16:40:49'),
(26, 37, 0, 'Đã gửi lời mời', '2022-05-21 07:47:11', '2022-05-21 07:47:11'),
(26, 38, 1, 'Đã gửi lời mời', '2022-05-21 03:26:41', '2022-05-21 03:26:41'),
(26, 39, 0, 'Đã gửi lời mời', '2022-05-23 16:33:49', '2022-05-23 16:33:49'),
(40, 33, 0, 'Đã gửi lời mời', '2022-05-23 12:09:05', '2022-05-23 12:09:05'),
(40, 39, 0, 'Đã gửi lời mời', '2022-05-23 12:09:04', '2022-05-23 12:09:04');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `group`
--

CREATE TABLE `group` (
  `group_id` int(10) UNSIGNED NOT NULL,
  `group_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `group_founder` int(11) NOT NULL,
  `group_imgbg` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `group_privacy` int(11) NOT NULL DEFAULT 1 COMMENT '1:pulic, 2: private',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `group`
--

INSERT INTO `group` (`group_id`, `group_name`, `group_founder`, `group_imgbg`, `group_privacy`, `created_at`, `updated_at`) VALUES
(11, 'Lớp HG17V7A1 2017-2022', 26, 'group_1023264902_1653108891.jpg', 1, '2022-05-21 04:54:51', '2022-05-21 04:54:51'),
(12, 'Nhóm ĐHCT', 25, 'group_1296527605_1653113755.jpg', 1, '2022-05-21 06:15:55', '2022-05-21 06:15:55'),
(13, 'Lớp HG17V7A1 2017-2021', 25, 'group_1804344025_1653119407.jpg', 2, '2022-05-21 07:50:07', '2022-05-21 07:50:07');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `group_members`
--

CREATE TABLE `group_members` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `group_id` int(10) UNSIGNED NOT NULL,
  `group_status` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `group_members`
--

INSERT INTO `group_members` (`id`, `user_id`, `group_id`, `group_status`, `created_at`, `updated_at`) VALUES
(43, 26, 11, 1, '2022-05-21 04:54:51', '2022-05-21 04:54:51'),
(44, 28, 11, 1, '2022-05-21 04:54:51', '2022-05-21 04:54:51'),
(45, 38, 11, 1, '2022-05-21 04:54:51', '2022-05-21 04:54:51'),
(46, 25, 12, 1, '2022-05-21 06:15:55', '2022-05-21 06:15:55'),
(48, 25, 13, 1, '2022-05-21 07:50:07', '2022-05-21 07:50:07'),
(49, 29, 13, 1, '2022-05-21 07:50:07', '2022-05-21 07:50:07'),
(50, 26, 12, 1, '2022-05-21 09:54:52', '2022-05-21 09:54:52'),
(51, 39, 13, 1, '2022-05-22 16:41:35', '2022-05-22 16:41:35'),
(53, 29, 12, 1, '2022-05-23 00:53:11', '2022-05-23 00:53:11'),
(54, 40, 11, 0, '2022-05-23 13:13:24', '2022-05-23 13:13:24'),
(55, 40, 13, 1, '2022-05-23 13:25:28', '2022-05-23 13:25:28'),
(58, 27, 12, 1, '2022-05-23 15:32:01', '2022-05-23 15:32:01');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `group_work`
--

CREATE TABLE `group_work` (
  `gw_id` int(10) UNSIGNED NOT NULL,
  `gw_tieude` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gw_noidung` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gw_hannop` datetime NOT NULL,
  `gw_file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gw_typefile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nguoitao_id` int(10) UNSIGNED NOT NULL,
  `group_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `group_work`
--

INSERT INTO `group_work` (`gw_id`, `gw_tieude`, `gw_noidung`, `gw_hannop`, `gw_file`, `gw_typefile`, `nguoitao_id`, `group_id`, `created_at`, `updated_at`) VALUES
(10, 'Báo cáo công việc', 'Yêu cầu các thành viên đọc kỹ đề khi làm và nộp lại bằng file pdf.<br />\r\nNếu nộp trễ chúng tôi sẽ không chấm điểm', '2021-12-02 16:16:00', 'bảnthảo_1000896811_1653113909.docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 25, 12, '2022-05-21 06:18:29', '2022-05-21 06:18:29'),
(11, 'Bài tập 1', 'Giao công việc', '2022-05-20 14:50:00', 'DIEM_KT_CUOI_KI__I_MON_SINH_9_1196165983_1653119461.docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 25, 13, '2022-05-21 07:51:01', '2022-05-21 07:51:01'),
(13, 'Bài tập số 1', '', '2022-05-24 13:45:00', 'DIEM_KT_CUOI_KI__I_MON_SINH_9_794736241_1653327139.docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 26, 11, '2022-05-23 17:32:19', '2022-05-23 17:32:28');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `icon`
--

CREATE TABLE `icon` (
  `icon_id` int(10) UNSIGNED NOT NULL,
  `icon_symbol` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `icon`
--

INSERT INTO `icon` (`icon_id`, `icon_symbol`, `icon_name`, `created_at`, `updated_at`) VALUES
(1, 'like', 'Thích', NULL, NULL),
(2, 'love', 'Yêu thích', NULL, NULL),
(3, 'haha', 'Haha', NULL, NULL),
(4, 'sad', 'Buồn bã', NULL, NULL),
(5, 'wow', 'Ngạc nhiên', NULL, NULL),
(6, 'angry', 'Giận dữ', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `imgsanpham`
--

CREATE TABLE `imgsanpham` (
  `imgsp_id` int(10) UNSIGNED NOT NULL,
  `imgsp_ten` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sp_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `imgsanpham`
--

INSERT INTO `imgsanpham` (`imgsp_id`, `imgsp_ten`, `sp_id`, `created_at`, `updated_at`) VALUES
(27, 'SP7-1659649036-1652594676.png', 7, NULL, NULL),
(28, 'SP8-1261814549-1652595961.png', 8, NULL, NULL),
(29, 'SP9-1807600498-1652597160.jpg', 9, NULL, NULL),
(30, 'SP10-1932839556-1652706836.jpg', 10, NULL, NULL),
(31, 'SP10-55428904-1652706837.jpg', 10, NULL, NULL),
(32, 'SP10-560184504-1652706837.jpg', 10, NULL, NULL),
(33, 'SP11-2002239074-1652707034.png', 11, NULL, NULL),
(34, 'SP12-1579998391-1652707101.png', 12, NULL, NULL),
(35, 'SP13-452861281-1652707201.jpg', 13, NULL, NULL),
(36, 'SP14-1411877560-1652707285.png', 14, NULL, NULL),
(38, 'SP15-1387804898-1652793511.png', 15, NULL, NULL),
(39, 'SP15-1299414072-1652793511.png', 15, NULL, NULL),
(40, 'SP15-348435679-1652793511.png', 15, NULL, NULL),
(41, 'SP16-1107353959-1653119669.jpg', 16, NULL, NULL),
(42, 'SP17-763377693-1653276855.jpg', 17, NULL, NULL),
(43, 'SP18-302559712-1653310474.png', 18, NULL, NULL),
(44, 'SP18-202853780-1653310474.png', 18, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `jobs`
--

INSERT INTO `jobs` (`id`, `queue`, `payload`, `attempts`, `reserved_at`, `available_at`, `created_at`) VALUES
(40, 'default', '{\"uuid\":\"a5d3e259-dd09-4210-a17f-29f739443b58\",\"displayName\":\"App\\\\Events\\\\PrivateMessageEvent\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":12:{s:5:\\\"event\\\";O:30:\\\"App\\\\Events\\\\PrivateMessageEvent\\\":2:{s:4:\\\"data\\\";a:6:{s:9:\\\"sender_id\\\";i:29;s:11:\\\"sender_name\\\";s:12:\\\"Thi\\u00ean Ph\\u00fac\\\";s:11:\\\"receiver_id\\\";s:2:\\\"25\\\";s:7:\\\"content\\\";s:11:\\\"Ch\\u00e0o b\\u1ea1n\\\";s:10:\\\"created_at\\\";s:19:\\\"2022-05-23 15:49:15\\\";s:10:\\\"message_id\\\";i:40;}s:6:\\\"socket\\\";N;}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1653295756, 1653295756),
(41, 'default', '{\"uuid\":\"cbc45f93-1ffe-4c5f-8f3b-f777835e94fb\",\"displayName\":\"App\\\\Events\\\\PrivateMessageEvent\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":12:{s:5:\\\"event\\\";O:30:\\\"App\\\\Events\\\\PrivateMessageEvent\\\":2:{s:4:\\\"data\\\";a:6:{s:9:\\\"sender_id\\\";i:25;s:11:\\\"sender_name\\\";s:11:\\\"Ho\\u00e0ng Long\\\";s:11:\\\"receiver_id\\\";s:2:\\\"27\\\";s:7:\\\"content\\\";s:9:\\\"Xin ch\\u00e0o\\\";s:10:\\\"created_at\\\";s:19:\\\"2022-05-23 21:29:01\\\";s:10:\\\"message_id\\\";i:41;}s:6:\\\"socket\\\";N;}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1653316141, 1653316141),
(42, 'default', '{\"uuid\":\"db8a4fe9-cc60-4910-87c2-221bb48ba071\",\"displayName\":\"App\\\\Events\\\\GroupMessageEvent\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":12:{s:5:\\\"event\\\";O:28:\\\"App\\\\Events\\\\GroupMessageEvent\\\":2:{s:4:\\\"data\\\";a:9:{s:9:\\\"sender_id\\\";i:25;s:11:\\\"sender_name\\\";s:11:\\\"Ho\\u00e0ng Long\\\";s:16:\\\"sender_firstname\\\";s:8:\\\"Nguy\\u1ec5n\\\";s:13:\\\"sender_avatar\\\";s:34:\\\"avatar25-1321191803-1653054904.jpg\\\";s:7:\\\"content\\\";s:29:\\\"mess_843193054_1653316191.jpg\\\";s:10:\\\"created_at\\\";O:25:\\\"Illuminate\\\\Support\\\\Carbon\\\":3:{s:4:\\\"date\\\";s:26:\\\"2022-05-23 21:29:51.000000\\\";s:13:\\\"timezone_type\\\";i:3;s:8:\\\"timezone\\\";s:16:\\\"Asia\\/Ho_Chi_Minh\\\";}s:10:\\\"message_id\\\";i:42;s:8:\\\"group_id\\\";s:2:\\\"10\\\";s:4:\\\"type\\\";i:2;}s:6:\\\"socket\\\";N;}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1653316191, 1653316191);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loaisanpham`
--

CREATE TABLE `loaisanpham` (
  `pl_id` int(10) UNSIGNED NOT NULL,
  `pl_ten` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pl_icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pl_tag` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `loaisanpham`
--

INSERT INTO `loaisanpham` (`pl_id`, `pl_ten`, `pl_icon`, `pl_tag`, `created_at`, `updated_at`) VALUES
(6, 'Sách', '<i class=\"fa fa-book\" aria-hidden=\"true\"></i>', 'sach', NULL, NULL),
(7, 'Dụng cụ học tập', '<i class=\"fa fa-scissors\" aria-hidden=\"true\"></i>', 'dung_cu_hoc_tap', NULL, NULL),
(8, 'Thời trang', '<i class=\"fa fa-briefcase\" aria-hidden=\"true\"></i>', 'thoi_trang', NULL, NULL),
(9, 'Dụng cụ thể thao', '<i class=\"fa fa-futbol-o\" aria-hidden=\"true\"></i>', 'dung_cu_the_thao', NULL, NULL),
(10, 'Khác', '<i class=\"fa fa-hashtag\" aria-hidden=\"true\"></i>', 'khac', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` int(10) UNSIGNED DEFAULT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1:message, 2:file',
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `messages`
--

INSERT INTO `messages` (`id`, `parent_id`, `message`, `type`, `status`, `created_at`, `updated_at`) VALUES
(38, NULL, 'Xin chào&nbsp;', 1, 1, '2022-05-21 07:55:58', '2022-05-21 07:55:58'),
(39, NULL, 'Xin chào nhóm', 1, 1, '2022-05-21 07:56:27', '2022-05-21 07:56:27'),
(40, NULL, 'Chào bạn', 1, 1, '2022-05-23 08:49:15', '2022-05-23 08:49:15'),
(41, NULL, 'Xin chào', 1, 1, '2022-05-23 14:29:01', '2022-05-23 14:29:01'),
(42, NULL, 'mess_843193054_1653316191.jpg', 2, 1, '2022-05-23 14:29:51', '2022-05-23 14:29:51');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `message_groups`
--

CREATE TABLE `message_groups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL COMMENT 'creater of the group',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `message_groups`
--

INSERT INTO `message_groups` (`id`, `name`, `user_id`, `created_at`, `updated_at`) VALUES
(8, 'Hưng', 25, '2022-05-21 07:56:07', '2022-05-21 07:56:07'),
(9, 'Học nhóm Toán rời rạc', 29, '2022-05-23 08:49:30', '2022-05-23 08:49:30'),
(10, 'Nhóm tin nhắn', 25, '2022-05-23 14:29:33', '2022-05-23 14:29:33'),
(11, 'Học nhóm Vi tích phân', 26, '2022-05-23 16:41:18', '2022-05-23 16:41:18');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `message_group_members`
--

CREATE TABLE `message_group_members` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `message_group_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `message_group_members`
--

INSERT INTO `message_group_members` (`id`, `message_group_id`, `user_id`, `status`, `created_at`, `updated_at`) VALUES
(8, 8, 25, 1, '2022-05-21 07:56:08', '2022-05-21 07:56:08'),
(9, 8, 29, 1, '2022-05-21 07:56:17', '2022-05-21 07:56:17'),
(11, 9, 29, 1, '2022-05-23 08:49:30', '2022-05-23 08:49:30'),
(12, 9, 25, 1, '2022-05-23 08:49:30', '2022-05-23 08:49:30'),
(13, 10, 25, 1, '2022-05-23 14:29:33', '2022-05-23 14:29:33'),
(14, 10, 27, 1, '2022-05-23 14:29:33', '2022-05-23 14:29:33'),
(15, 10, 29, 1, '2022-05-23 14:29:33', '2022-05-23 14:29:33'),
(16, 11, 26, 1, '2022-05-23 16:41:18', '2022-05-23 16:41:18'),
(17, 11, 28, 1, '2022-05-23 17:12:24', '2022-05-23 17:12:24'),
(18, 11, 33, 1, '2022-05-23 17:12:24', '2022-05-23 17:12:24'),
(19, 11, 37, 1, '2022-05-23 17:12:24', '2022-05-23 17:12:24');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(195, '2014_10_12_000000_create_users_table', 1),
(196, '2014_10_12_100000_create_password_resets_table', 1),
(197, '2019_08_19_000000_create_failed_jobs_table', 1),
(198, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(199, '2021_10_05_102141_create_posts_table', 1),
(200, '2021_10_05_105037_create_emoticons_table', 1),
(201, '2021_10_05_194032_create_file_post_table', 1),
(202, '2021_11_11_124436_create_comment_table', 1),
(203, '2021_11_30_085137_create_friend_table', 1),
(204, '2021_12_17_042314_create_messages_table', 1),
(205, '2021_12_17_042340_create_user_messages_table', 1),
(206, '2021_12_24_154929_create_jobs_table', 1),
(207, '2021_12_25_012223_create_message_groups_table', 1),
(208, '2021_12_25_033424_create_message_group_members_table', 1),
(209, '2021_12_25_042847_add_columns_to_user_messages_table', 1),
(210, '2022_01_08_194438_create_group_table', 1),
(211, '2022_01_12_161826_create_group_members_table', 1),
(212, '2022_01_12_162046_create_school_table', 1),
(213, '2022_01_12_165400_create_school_followers_table', 1),
(214, '2022_02_24_201240_create_admin_table', 1),
(215, '2022_03_03_183516_create_followers_table', 1),
(216, '2022_03_05_092857_create_group_work_table', 1),
(217, '2022_03_05_093036_create_submissions_table', 1),
(218, '2022_03_18_215032_create_loaisanpham_table', 1),
(219, '2022_03_18_215233_create_sanpham_table', 1),
(220, '2022_03_18_215426_create_imgsanpham_table', 1),
(221, '2022_03_18_224235_create_bookmark_table', 1),
(222, '2022_04_29_124249_create_notifications_table', 2),
(223, '2021_09_30_155222_create_icon_table', 3),
(224, '2022_05_06_161051_create_baocaopost_table', 4),
(225, '2022_05_14_155909_create_baocaovipham_table', 5);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `personal_access_tokens`
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
-- Cấu trúc bảng cho bảng `posts`
--

CREATE TABLE `posts` (
  `post_id` int(10) UNSIGNED NOT NULL,
  `caption` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `post_choduyet` int(1) DEFAULT 1 COMMENT '0: là chưa duyệt, 1: đã duyệt',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type_post` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '1: bài đăng cá nhân, 2: bài đăng nhóm, 3: bài đăng fanpage',
  `category_post` int(11) NOT NULL DEFAULT 1 COMMENT '2 là Bài đăng video',
  `user_id` int(10) UNSIGNED NOT NULL,
  `group_id` int(10) UNSIGNED DEFAULT NULL,
  `school_id` int(10) UNSIGNED DEFAULT NULL,
  `sharepost_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `posts`
--

INSERT INTO `posts` (`post_id`, `caption`, `post_choduyet`, `status`, `type_post`, `category_post`, `user_id`, `group_id`, `school_id`, `sharepost_id`, `created_at`, `updated_at`) VALUES
(153, 'Hiện thị<div><br></div>', 1, 'Công khai', '3', 1, 25, NULL, 6, NULL, '2022-05-20 13:47:50', '2022-05-20 13:47:50'),
(154, 'Xin chào tháng 5', 1, 'Công khai', '1', 1, 32, NULL, NULL, NULL, '2022-05-20 14:34:14', '2022-05-20 14:34:14'),
(155, 'Câu hỏi IQ. Mời cao nhân giải dùm mình<div></div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', 1, 'Công khai', '1', 1, 33, NULL, NULL, NULL, '2022-05-20 16:37:09', '2022-05-20 16:37:09'),
(156, 'Thanh xuân như một tách trà <img alt=\"😚\" class=\"emojioneemoji\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/32/1f61a.png\"><img alt=\"😚\" class=\"emojioneemoji\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/32/1f61a.png\"><img alt=\"😚\" class=\"emojioneemoji\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/32/1f61a.png\"><img alt=\"😚\" class=\"emojioneemoji\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/32/1f61a.png\">', 1, 'Công khai', '1', 1, 35, NULL, NULL, NULL, '2022-05-20 17:33:48', '2022-05-20 17:33:48'),
(157, 'Cố gắng vì tương lai tươi đẹp<img alt=\"✊\" class=\"emojioneemoji\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/32/270a.png\"><img alt=\"✊\" class=\"emojioneemoji\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/32/270a.png\"><img alt=\"👊\" class=\"emojioneemoji\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/32/1f44a.png\">', 1, 'Công khai', '1', 1, 36, NULL, NULL, NULL, '2022-05-20 17:38:00', '2022-05-20 17:38:00'),
(158, 'Bạn không là ai nếu không là chính mình', 1, 'Công khai', '1', 1, 37, NULL, NULL, NULL, '2022-05-20 17:51:47', '2022-05-20 17:51:47'),
(159, 'Tạm biệt nhé!', 1, 'Công khai', '1', 1, 38, NULL, NULL, NULL, '2022-05-20 17:55:09', '2022-05-20 17:55:09'),
(160, 'Chi Bộ Khoa PTNT chúc mừng kéo dài thời gian giữ chức vụ Trưởng khoa PTNT của PGS.TS Nguyễn Duy Cần đến đầu năm 2023 theo quyết định của Hội đồng Trường ĐHCT nhân dịp họp giao ban hàng tuầ', 1, 'Công khai', '3', 1, 26, NULL, 7, NULL, '2022-05-21 03:07:50', '2022-05-21 03:07:50'),
(161, 'Thông tin tuyển dụng - Các bạn liên hệ qua a Thừa nhé -&nbsp;&nbsp;0838.99.33.86', 1, 'Công khai', '3', 1, 26, NULL, 7, NULL, '2022-05-21 03:08:52', '2022-05-21 03:08:52'),
(162, 'Tuyển sinh ngành Kinh doanh Nông nghiệp - Khoa Phát triển Nông thôn', 1, 'Công khai', '3', 1, 26, NULL, 7, NULL, '2022-05-21 03:11:02', '2022-05-21 03:11:02'),
(163, 'Các em chú ý, học kỳ này Trường không tổ chức thu học phí tại Khoa PTNT nên các em tranh thủ đóng trước 15/5 nhé.', 1, 'Công khai', '3', 1, 26, NULL, 7, NULL, '2022-05-21 03:12:10', '2022-05-21 03:12:10'),
(164, 'Anh ấy hát hay quá', 1, 'Công khai', '1', 2, 26, NULL, NULL, NULL, '2022-05-21 03:12:59', '2022-05-21 03:12:59'),
(165, 'Ai chỉ mình với', 1, 'Công khai', '1', 1, 26, NULL, NULL, NULL, '2022-05-21 03:15:36', '2022-05-21 03:15:36'),
(166, 'Giải tiếp câu đố IQ sẽ có thưởng', 1, 'Công khai', '1', 1, 26, NULL, NULL, NULL, '2022-05-21 03:25:54', '2022-05-21 03:25:54'),
(167, 'Bộ đề thi môn vi tích phân. Mong các bạn vượt qua môn', 1, 'Công khai', '1', 3, 26, NULL, NULL, NULL, '2022-05-21 03:29:54', '2022-05-21 03:29:54'),
(168, 'Xin hãy duyệt bài giúp em', 1, 'Công khai', '3', 1, 33, NULL, 6, NULL, '2022-05-21 04:00:09', '2022-05-21 04:00:09'),
(169, 'Chào ngày mới', 1, 'Công khai', '1', 1, 25, NULL, NULL, NULL, '2022-05-21 04:22:51', '2022-05-21 04:22:51'),
(170, 'Trường Đại học Cần Thơ tự hào và chúc mừng GS.TS. Nguyễn Minh Thủy, nhà khoa học của Trường nhận giải thưởng Kovalevskaia năm 2021.<div></div>Kovalevskaia là một trong những giải thưởng danh giá hàng đầu thế giới dành cho các nhà khoa học nữ có thành tích xuất sắc trong nghiên cứu và ứng dụng khoa học vào thực tiễn cuộc sống, đem lại nhiều lợi ích trên các lĩnh vực - kinh tế, xã hội và văn hóa.<div></div>Năm 2021, chỉ có 2 nhà khoa học nữ nhận được giải thưởng này và GS. Thủy là một trong số đó.', 1, 'Công khai', '3', 1, 25, NULL, 6, NULL, '2022-05-21 05:32:07', '2022-05-21 05:32:07'),
(171, 'Lễ ký kết hợp tác với Trường Kinh doanh Châu Âu - ISAG, Bồ Đào Nha<div></div>Đại diện lãnh đạo hai đơn vị, GS.TS. Hà Thanh Toàn, Hiệu trưởng Trường ĐHCT và GS. Elvira Pacheco Vieira, Tổng Giám đốc ISAG đã cùng ký kết bản ghi nhớ hợp tác với các hoạt động như: tăng cường nghiên cứu khoa học chung, trao đổi giảng viên, nghiên cứu viên; xây dựng và phát triển các chương trình trao đổi sinh viên và đào tạo bằng đôi; trao đổi dữ liệu nghiên cứu học thuật và tài liệu giảng dạy; hợp tác trong các hoạt động xuất bản và các hoạt động văn hóa; tổ chức các hội nghị, hội thảo khoa học, báo cáo chuyên đề,...<div><br></div>https://www.ctu.edu.vn/tin-tuc-su-kien/le-ky-ket-hop-tac-voi-truong-kinh-doanh-chau-au-isag-bo-dao-nha.html?fbclid=IwAR1yVfJ4Dcsg0Ivl1JUqoEcyeMaEj5LzJqXJIPqzzTOhIzzv6XRr3oNf1P8<div></div>', 1, 'Công khai', '3', 1, 25, NULL, 6, NULL, '2022-05-21 06:11:37', '2022-05-21 06:11:37'),
(172, '⚠CẢNH BÁO<div></div>Để đảm bảo quyền lợi của thí sinh trong việc đăng ký, nộp hồ sơ và lệ phí xét tuyển học bạ vào Trường Đại học Cần Thơ, cần lưu ý:<div></div><img alt=\"🔔\" class=\"emojioneemoji\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/32/1f514.png\"> Đọc kỹ và thực hiện đúng với Hướng dẫn của Trường tại bit.ly/hocba_ctu2022<div></div><img alt=\"✅\" class=\"emojioneemoji\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/32/2705.png\">Chỉ liên hệ với fanpage chính chủ: <img alt=\"🔹\" class=\"emojioneemoji\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/32/1f539.png\">Trường Đại học Cần Thơ (@ctudhct) và<img alt=\"🔹\" class=\"emojioneemoji\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/32/1f539.png\"> Tư vấn tuyển sinh chính quy (@ctu.tvst)', 1, 'Công khai', '3', 1, 25, NULL, 6, NULL, '2022-05-21 06:12:23', '2022-05-21 06:12:23'),
(173, 'Ở Trường Đại học Cần Thơ, bạn không chỉ được tham gia học tập nâng cao trình độ mà còn có cơ hội để trở thành \"ông chủ, bà chủ\" trong tương lai khi Trường luôn quan tâm và ươm mầm cho những ý tưởng, dự án khởi nghiệp tiềm năng.<div></div>Cuộc thi “Dự án khởi nghiệp tiềm năng trong học sinh sinh viên trường Đại học Cần Thơ mở rộng năm 2022” vừa diễn ra là minh chứng cho điều đó. Tổng cộng, Ban Tổ chức đã trao 16 giải thưởng cho các đội thi xuất sắc nhất với tổng giá trị các giải thưởng lên đến 22.700.000đ. <div></div>Đặc biệt, các đội thi còn có cơ hội tiếp tục được Trường Đại học Cần Thơ hỗ trợ ươm tạo dự án trong 06 tháng tại Trường từ nguồn quỹ Hỗ trợ Sinh viên Khởi nghiệp của Nhà trường và kết nối đến các hoạt động hỗ trợ khởi nghiệp kế tiếp.<div></div>https://www.ctu.edu.vn/tin-tuc-su-kien/cuoc-thi-du-an-khoi-nghiep-tiem-nang-trong-hoc-sinh-sinh-vien-truong-dai-hoc-can-tho-mo-rong-nam-2022.html?fbclid=IwAR0OJCqZJBQ2r-aGyDHv367jj0pKmfbxnRVJJ8QhtTOl_DiH6-THVUAWOwU', 1, 'Công khai', '3', 1, 25, NULL, 6, NULL, '2022-05-21 06:14:12', '2022-05-21 06:14:12'),
(174, 'Đăng bvideo', 1, 'Công khai', '1', 2, 26, NULL, NULL, NULL, '2022-05-21 07:47:53', '2022-05-21 07:47:53'),
(176, 'Đừng bỏ cuộc!', 1, 'Công khai', '1', 1, 39, NULL, NULL, NULL, '2022-05-22 15:41:01', '2022-05-22 15:41:01'),
(177, 'Nguy hiểm thật<img alt=\"🤢\" class=\"emojioneemoji\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/32/1f922.png\"><img alt=\"🤢\" class=\"emojioneemoji\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/32/1f922.png\"><img alt=\"🤢\" class=\"emojioneemoji\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/32/1f922.png\"><img alt=\"🤢\" class=\"emojioneemoji\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/32/1f922.png\">', 1, 'Công khai', '1', 2, 39, NULL, NULL, NULL, '2022-05-22 16:47:02', '2022-05-22 16:47:02'),
(178, NULL, 1, 'Công khai', '1', 1, 39, NULL, NULL, NULL, '2022-05-22 16:50:04', '2022-05-22 16:50:04'),
(179, 'Đề toán rời rạc cho bạn nào cần!', 1, 'Công khai', '1', 1, 29, NULL, NULL, NULL, '2022-05-23 02:54:54', '2022-05-23 02:54:54'),
(180, 'Có bạn nào muốn đi hiến máu tình nguyện thì nhớ mốc thời gian nha', 1, 'Công khai', '2', 1, 29, 12, NULL, NULL, '2022-05-23 02:57:37', '2022-05-23 02:57:37'),
(181, 'Lớp mình có ai muốn đi hiến máu không?<div></div>Lập team cùng đi nào', 1, 'Riêng tư', '2', 1, 29, 13, NULL, NULL, '2022-05-23 03:02:26', '2022-05-23 03:02:26'),
(184, 'Bạn nào muốn học tiếng anh bằng VSTEP B1, TOEIC 450 nên tranh thủ đăng ký, số lượng có giới hạn. Đăng ký trễ sẽ hết chỗ <img alt=\"🤩\" class=\"emojioneemoji\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/32/1f929.png\"><img alt=\"🤩\" class=\"emojioneemoji\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/32/1f929.png\"><img alt=\"🤩\" class=\"emojioneemoji\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/32/1f929.png\">', 1, 'Công khai', '2', 1, 26, 12, NULL, NULL, '2022-05-23 09:23:58', '2022-05-23 09:23:58'),
(185, 'Tuyển dụng nhân sự', 1, 'Công khai', '1', 1, 40, NULL, NULL, NULL, '2022-05-23 12:25:37', '2022-05-23 12:25:37'),
(186, 'Phòng Quản lý hệ thống và Pháp chế tuyển dụng!', 1, 'Công khai', '1', 1, 40, NULL, NULL, NULL, '2022-05-23 12:33:48', '2022-05-23 12:33:48'),
(187, 'Do nhu cầu mở rộng sản xuất, Công ty cần tuyển gấp:<div><br></div>5 nhân viên thiết kế và cân bằng chuyền<div><br></div>Nhận hồ sơ, phỏng vấn và nhận việc ngay.', 1, 'Công khai', '1', 1, 40, NULL, NULL, NULL, '2022-05-23 12:35:49', '2022-05-23 12:35:49'),
(188, '<img alt=\"😚\" class=\"emojioneemoji\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/32/1f61a.png\"><img alt=\"😚\" class=\"emojioneemoji\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/32/1f61a.png\"><img alt=\"😚\" class=\"emojioneemoji\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/32/1f61a.png\"><img alt=\"😚\" class=\"emojioneemoji\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/32/1f61a.png\"><img alt=\"😚\" class=\"emojioneemoji\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/32/1f61a.png\"><img alt=\"😚\" class=\"emojioneemoji\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/32/1f61a.png\">', 1, 'Công khai', '1', 1, 41, NULL, NULL, NULL, '2022-05-23 13:36:01', '2022-05-23 13:36:01'),
(189, 'Đăng bài', 1, 'Công khai', '1', 1, 25, NULL, NULL, NULL, '2022-05-23 14:20:40', '2022-05-23 14:20:40'),
(190, 'Đăng bài', 1, 'Công khai', '3', 1, 25, NULL, 6, NULL, '2022-05-23 14:23:06', '2022-05-23 14:23:06'),
(191, 'Fắnehđú l sdvfb', 1, 'Công khai', '3', 1, 29, NULL, 6, NULL, '2022-05-23 14:23:56', '2022-05-23 14:23:56');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sanpham`
--

CREATE TABLE `sanpham` (
  `sp_id` int(10) UNSIGNED NOT NULL,
  `sp_ten` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sp_gia` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sp_mota` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `sp_soluong` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sp_sdt` varchar(13) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sp_tinhtrang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sp_diachi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nguoiban` int(10) UNSIGNED NOT NULL,
  `phanloai` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sanpham`
--

INSERT INTO `sanpham` (`sp_id`, `sp_ten`, `sp_gia`, `sp_mota`, `sp_soluong`, `sp_sdt`, `sp_tinhtrang`, `sp_diachi`, `nguoiban`, `phanloai`, `created_at`, `updated_at`) VALUES
(7, 'Bán lại sách ôn thi tốt nghiệp Toán', 'Thương lượng', 'Sách chưa được sử dụng', '3', '0152788290', 'Đã qua sử dụng', 'Ninh Kiều, Cần Thơ', 25, 6, '2022-05-15 06:04:36', '2022-05-15 06:04:36'),
(8, 'Bán nhiều mẫu bút bi', 'Chỉ từ 3000đ', 'Nhiều mẫu mã tha hồ lựa chọn', '99999', '0374892677', 'Chưa qua sử dụng', 'Ninh Kiều, Cần Thơ', 25, 7, '2022-05-15 06:26:01', '2022-05-15 06:26:01'),
(9, 'Áo nhóm màu xanh', '150k', 'Áo tươi mát, mặc thoải mái  thấm mồ hôi, dùng đi chơi cùng hội bạn bè', '999', '0338992613', 'Chưa qua sử dụng', 'Quận Ninh Kiều, Cần Thơ', 26, 8, '2022-05-15 06:46:00', '2022-05-15 06:46:00'),
(10, 'Áo nhóm siêu đẹp', '150k/áo', 'Áo đẹp còn rẻ', '90', '0237822540', 'Mới', 'Quận Ninh Kiều, TP Cần Thơ', 26, 8, '2022-05-16 13:13:56', '2022-05-16 13:13:56'),
(11, 'Pass lại quyển giáo trình Kiến trúc máy tính', '34000đ', 'Mình dọn ktx nên cần bán lại cho những bạn cần', '1', '0334422679', 'Đã qua sử dụng', 'Trường đại học Cần Thơ', 28, 6, '2022-05-16 13:17:14', '2022-05-16 13:17:14'),
(12, 'Bán giáo trình đã qua sử dụng 1 lần', 'Thương lượng', 'Đã học qua cần bán lại', '1', '0233890116', 'Đã qua sử dụng', 'Khuôn viên trường đại học Cần Thơ', 26, 6, '2022-05-16 13:18:21', '2022-05-16 13:18:21'),
(13, 'Bán banh siêu rẻ', '200.000đ', 'Có bán sỉ khi mua trên 10 quả trở lên', '100', '0238472123', 'Còn mới', 'Mỹ Tú Sóc Trăng', 28, 9, '2022-05-16 13:20:01', '2022-05-16 13:20:01'),
(14, 'Bán nhiều loại bút bi', 'Tùy loại', 'nhiều mẫu mã mới trẻ trung, đẹp', '9999', '0237859223', 'Còn mới', 'Quận Ninh Kiều, TP Cần Thơ', 27, 7, '2022-05-16 13:21:25', '2022-05-16 13:21:25'),
(15, 'Tiểu thuyết', '200.000đ', 'Sách còn mới', '1', '0234822947', 'Còn mới', 'Xã Long Hưng, Mỹ Tú, Sóc Trăng', 26, 6, '2022-05-17 13:18:01', '2022-05-17 13:18:01'),
(16, 'ÁO nhóm', '200.000đ', 'Còn như mới', '12', '0874489427', 'CÒn mới', 'Ninh Kiều, Cần Thơ', 25, 7, '2022-05-21 07:54:29', '2022-05-21 07:54:29'),
(17, 'Bán lại cuốn bài tập xác suất thống kê cho bạn nào cần', '56 000 đ', 'Bạn nào có nhu cầu tìm nhiều bài tập để luyện tập thì rất phù hợp', '1', '0672676242', 'Đã qua sử dụng', 'Quận Ninh Kiều, TP Cần Thơ', 29, 6, '2022-05-23 03:34:15', '2022-05-23 03:34:15'),
(18, 'Bán lại 2 quyển giáo trình phát luật đại cương và luật tố tụng hình sự VN', '100.000đ', 'sdfdf', '2', '0336622885', 'Đã qua sử dụng', 'Ninh Kiều, Cần Thơ', 40, 7, '2022-05-23 12:54:34', '2022-05-23 12:54:34');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `school`
--

CREATE TABLE `school` (
  `school_id` int(10) UNSIGNED NOT NULL,
  `school_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `school_category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `school_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `school_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `school_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `school_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `school_about` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `userql` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `school_avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'noteimgschool.png',
  `school_background` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'backgroundschool.jpg',
  `school_status` int(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `school`
--

INSERT INTO `school` (`school_id`, `school_name`, `school_category`, `school_address`, `school_phone`, `school_email`, `school_link`, `school_about`, `userql`, `school_avatar`, `school_background`, `school_status`, `created_at`, `updated_at`) VALUES
(6, 'Trường đại học Cần Thơ', 'Trường đại học', 'Khu II đường 3/2 Cần Thơ 90000', '0292 3832 663', 'dhct@ctu.edu.vn', 'https://www.ctu.edu.vn/', 'Đại học Cần Thơ, cơ sở đào tạo đại học và sau đại học trọng điểm của Nhà nước ở ĐBSCL, là trung tâm văn hóa - khoa học kỹ thuật của vùng.<br />Đại học Cần Thơ (ĐHCT), cơ sở đào tạo đại học và sau đại học trọng điểm của Nhà nước ở ĐBSCL, là trung tâm văn hóa - khoa học kỹ thuật của vùng. Hiện Trường đào tạo 98 chuyên ngành đại học (trong đó có 2 chương trình đào tạo tiên tiến, 3 chương trình đào tạo chất lượng cao), 45 chuyên ngành cao học (trong đó 1 ngành liên kết với nước ngoài, 3 ngành đào tạo bằng tiếng Anh), 16 chuyên ngành nghiên cứu sinh.', '25', 'avatarschool25-567658937-1653054398.jpg', 'background25-1724654518-1653054398.jpg', 1, '2022-05-20 13:32:42', '2022-05-20 13:32:42'),
(7, 'Trường đại học Cần Thơ (Khu Hòa An)', 'Trường đại học', 'Số 554, ấp Hòa Đức, xã Hòa An, huyện Phụng Hiệp, tỉnh Hậu Giang', '0292 3832 663', 'dhct@ctu.edu.vn', 'https://www.ctu.edu.vn/', 'Khu Hòa An là một cơ sở đào tạo của Trường ĐHCT <br>Sinh viên học tại Khu Hòa An do Khoa Phát triển Nông thôn quản lý và là sinh viên hệ chính quy của Trường Đại học Cần Thơ. Chương trình đào tạo, giảng viên, điều kiện học tập, học phí và bằng cấp hoàn toàn giống như sinh viên học tại thành phố Cần Thơ. Khi trúng tuyển những sinh viên này sẽ học năm thứ nhất và năm thứ 4 tại thành phố Cần Thơ, các năm học còn lại học tại Khu Hòa An.', '26', 'avatarschool26-2084856381-1653053800.jpg', 'background26-118614094-1653053823.jpg', 1, '2022-05-20 13:32:42', '2022-05-20 13:32:42'),
(8, 'Trường Cao đẳng Cần Thơ', 'Trường cao đẳng', 'Số 413, Đường 30/4, Phường Hưng Lợi, Quận Ninh Kiều, TP. Cần Thơ', '0292 3838 306', 'cdct@ctu.edu.vn', 'https://www.ctu.edu.vn/', 'Được thành lập từ năm 1976, tọa lạc tại trung tâm thành phố Cần Thơ, với diện tích hơn 60.000 m2. Trường có 80 phòng học, hệ thống giảng đường, phòng thí nghiệm thực hành; nhà tập đa năng, sân chơi, khu ký túc xá sinh viên… hiện có và đang được xây dựng thêm sẽ góp phần đáp ứng như cầu học tập, sinh hoạt và rèn luyện sức khỏe của học sinh sinh viên vì ngày mai “lập thân, lập nghiệp”.', '27', 'avatarschool27-1779025107-1653054337.jpg', 'background27-1262489202-1653054337.jpg', 1, '2022-05-20 13:32:42', '2022-05-20 13:32:42'),
(9, 'Trường Đại học Tây Đô', 'Trường đại học', '68 Trần Chiên, Lê Bình, Cái Răng, Cần Thơ', '093 9028 579', 'admin@tdu.edu.vn', NULL, '\"Được thành lập vào ngày 9/3/2006 theo Quyết định số 54/2006/QĐ-TTg của Thủ tướng Chính phủ, Trường Đại học Tây Đô trở thành trường đại học tư thục đầu tiên của khu vực Đồng bằng sông Cửu Long. Cơ sở hiện đại và chương trình đào tạo tiên tiến, kết hợp với sự hướng dẫn của đội ngũ chuyên gia, có thể biến tài năng và sự nhiệt tình của sinh viên thành các kỹ năng cụ thể và kiến thức cần thiết để thành công trong sự nghiệp, đáp ứng cuộc sống thách thức trong tương lai.\"', '39', 'noteimgschool.png', 'backgroundschool.jpg', 2, '2022-05-22 15:49:33', '2022-05-22 15:49:33');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `school_followers`
--

CREATE TABLE `school_followers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `fl_status` int(11) DEFAULT 1 COMMENT '0 là được mời, 1 đã theo dõi',
  `school_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `school_followers`
--

INSERT INTO `school_followers` (`id`, `user_id`, `fl_status`, `school_id`, `created_at`, `updated_at`) VALUES
(25, 33, 1, 6, NULL, NULL),
(27, 29, 1, 6, NULL, NULL),
(28, 25, 0, 7, NULL, NULL),
(29, 28, 0, 7, NULL, NULL),
(30, 33, 0, 7, NULL, NULL),
(31, 37, 0, 7, NULL, NULL),
(32, 38, 0, 7, NULL, NULL),
(33, 26, 0, 6, NULL, NULL),
(34, 27, 0, 6, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `submissions`
--

CREATE TABLE `submissions` (
  `sm_id` int(10) UNSIGNED NOT NULL,
  `sm_noidung` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sm_file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sm_typefile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sm_ngaynop` datetime NOT NULL,
  `nguoinop_id` int(10) UNSIGNED NOT NULL,
  `group_id` int(10) UNSIGNED NOT NULL,
  `gw_id` int(10) UNSIGNED NOT NULL,
  `sm_diem` int(100) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `submissions`
--

INSERT INTO `submissions` (`sm_id`, `sm_noidung`, `sm_file`, `sm_typefile`, `sm_ngaynop`, `nguoinop_id`, `group_id`, `gw_id`, `sm_diem`, `created_at`, `updated_at`) VALUES
(13, 'Phạm Thiên Phúc MSSV B1706293', 'HD_BTnhom_1270401441_1653114115.pdf', 'application/pdf', '2022-05-21 13:21:55', 29, 12, 10, 100, '2022-05-21 06:21:55', '2022-05-21 06:21:55'),
(14, 'Giải quyết công việc', NULL, NULL, '2022-05-21 14:51:54', 29, 13, 11, 0, '2022-05-21 07:51:54', '2022-05-21 07:51:54'),
(15, 'Niọpkạksdvdfcvd', NULL, NULL, '2022-05-21 16:55:09', 26, 12, 10, 0, '2022-05-21 09:55:09', '2022-05-21 09:55:09'),
(16, 'Đức Huy đã nộp bài', NULL, NULL, '2022-05-22 23:42:52', 39, 13, 11, 45, '2022-05-22 16:42:52', '2022-05-22 16:42:52'),
(17, 'Nộp bài', 'asf_73712636_1653319950.jpg', 'image/jpeg', '2022-05-23 22:32:30', 27, 12, 10, 0, '2022-05-23 15:32:30', '2022-05-23 15:32:30');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sex` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'noteimg.png',
  `background` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'noimg.jpg',
  `job` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `class` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `school_id` int(10) UNSIGNED DEFAULT NULL,
  `interests` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthday` date NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`user_id`, `firstname`, `name`, `email`, `sex`, `avatar`, `background`, `job`, `class`, `school_id`, `interests`, `address`, `latitude`, `longitude`, `birthday`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(25, 'Nguyễn', 'Hoàng Long', 'nguyenhoanglong@gmail.com', 'Nam', 'avatar25-1321191803-1653054904.jpg', 'background25-125108142-1653054923.jpg', 'Sinh Viên', '', 6, '', 'Cái Răng, Cần Thơ', '9.652486', '105.8172996', '1998-08-03', NULL, '$2y$10$2TCdC8OybhoQmlsRJftEDOsMb0nnyQlEt8pFHM.MMBWil5QMvUTi2', NULL, '2011-05-20 10:18:14', NULL),
(26, 'Đinh', 'Lâm Huy', 'dinhlamhuytak489@gmail.com', 'Nam', 'avatar26-733037099-1653042278.jpg', 'background26-1420740418-1653042105.jpg', 'Sinh Viên', '', 7, '', 'Mỹ Tú, Sóc Trăng', '9.652486', '105.8172996', '2000-01-13', NULL, '$2y$10$1h8McChTZ0dpR4CWFGrk3u004SWqsay8se6d/LWhkNrx01c5D4JU6', NULL, '2014-07-20 10:18:14', NULL),
(27, 'Đinh', 'Tuấn Hoàng', 'dinhtuanhoangtak489@gmail.com', 'Nam', 'avatar27-541977373-1653042481.jpg', 'background27-1814861049-1653042505.jpg', 'Sinh Viên', '', NULL, '', 'Cù Lao Dung, Sóc Trăng', '10.027829', '105.770598', '2000-01-01', NULL, '$2y$10$YK8SCpyg04zn9GLCMj4oduwU40lVjWrnQ3iFGU3AaNssJMz1KTi2a', NULL, '2022-05-20 10:18:14', NULL),
(28, 'Nguyễn', 'Văn Tý', 'nguyenvanty@gmail.com', 'Nam', 'avatar28-2062276967-1653055414.jpg', 'background28-1491828203-1653055548.jpg', 'Sinh Viên', '', 7, '', 'Châu đốc, An Giang', '10.029720', '105.772577', '2001-01-12', NULL, '$2y$10$J1OhhAnzr3AW0JHa1KlYxu.b6Dn0otnfXdSTI1p5J1zYIK.x8W00u', NULL, '2022-05-20 10:18:14', NULL),
(29, 'Phạm', 'Thiên Phúc', 'phamthienphuc@gmail.com', 'Nam', 'avatar29-1138080826-1653285586.JPG', 'background29-1215255874-1653293504.jpg', 'Sinh Viên', '', NULL, '', 'Cao Lãnh, Bến Tre', '9.652486', '105.8172996', '2002-01-01', NULL, '$2y$10$JuQNhf5bLcOFgQrdQmMqU.OZ2ibZueLn2DB549Z19ESa7K31pudUS', NULL, '2022-05-20 10:18:14', NULL),
(30, 'Mai', 'Quốc Hưng', 'maiquochung@gmail.com', 'Nam', 'avatar30-943429386-1653055641.jpg', 'background30-1809684491-1653055651.jpg', 'Sinh Viên', '', NULL, '', 'Cao Lãnh, Bến Tre', '10.037982', '105.776670', '2002-01-01', NULL, '$2y$10$Vb8yl20Vqr0Xu11ujC081.xUD74cN.t2l8VR2tsWgf5F2z6mFFYQ2', NULL, '2021-05-20 10:18:14', NULL),
(31, 'Phan', 'Nhất Long', 'phannhatlong@gmail.com', 'Nam', 'avatar31-594779619-1653055678.jpg', 'background31-1242227099-1653055686.jpg', 'Sinh Viên', '', NULL, '', 'Ninh Kiều, Cần Thơ', '10.022588', '105.762136', '2002-01-01', NULL, '$2y$10$Wr8goPaIsdc27zexgXWRLuM8WJ4oN7Y1jLW/zRsjEodwR8bR2j8um', NULL, '2021-11-16 10:18:14', NULL),
(32, 'Ngô', 'Bảo Long', 'ngobaolong@gmail.com', 'Nam', 'avatar32-889382967-1653057207.jpg', 'background32-1442882645-1653057200.jpg', 'Sinh Viên', '', 6, '', 'Cao Lãnh, Bến tre', '10.022715', '105.761836', '2002-01-17', NULL, '$2y$10$VasvQTFzdkDVGtmbE5qpnewkm0SotDSCGeRYkf/J2sDguEDGs5cHy', NULL, '2022-05-20 10:18:14', NULL),
(33, 'Ngô', 'Bảo Thiên', 'ngobaothien@gmail.com', 'Nam', 'avatar33-208844112-1653057379.jpg', 'background33-1606234753-1653057391.jpg', 'Sinh Viên', '', 6, '', 'Cao Lãnh, Bến tre', '10.022715', '105.761836', '2002-01-01', NULL, '$2y$10$Tosr961IyHZFcnCN1ap21.ITMyb6RE/FkGiw8C6R0YR8cas8bLRTe', NULL, '2022-05-20 10:18:15', NULL),
(34, 'Nguyễn', 'Hồng Ngọc', 'nguyenhongngoc@gmail.com', 'Nữ', 'avatar34-2054127945-1653066329.jpg', 'background34-1203369806-1653066343.jpeg', 'Sinh Viên', '', NULL, '', 'Cao Lãnh, Bến tre', '10.022715', '105.761836', '2004-11-01', NULL, '$2y$10$q1ix0lBXthHdMfR5Huu.5edp1DX9vZggK6B2BPcYUPqF5ycnMhoMm', NULL, '2020-05-20 10:18:15', NULL),
(35, 'Đinh', 'Mỹ Kiều', 'dinhmykieu@gmail.com', 'Nữ', 'avatar35-370849379-1653067815.jpg', 'background35-519290862-1653067978.jpg', 'Sinh Viên', '', 7, '', 'Gạch Giá, Kiên Giang', '10.022715', '105.761836', '2001-11-09', NULL, '$2y$10$HRsLncdCdVtfUnpR1tF9COr2F9jumIZ5l4tjvh.P83Ta/.eX8z9Ea', NULL, '2022-05-20 10:18:15', NULL),
(36, 'Phạm', 'Thị Diễm', 'phamthidiem@gmail.com', 'Nữ', 'avatar36-200909725-1653068169.jpg', 'background36-1536083130-1653068219.jpg', 'Học sinh', '', 6, '', 'Ninh Kiều, Cần Thơ', '10.022715', '105.761836', '2000-06-11', NULL, '$2y$10$d2n8fXKvv8kkF9cGA9pB3eVHR1KhubAYqgP.dS8IXMvtGjZDScT5a', NULL, '2022-05-20 10:18:15', NULL),
(37, 'Hoàng', 'Thùy Lâm', 'hoangthuylam@gmail.com', 'Nữ', 'avatar37-1406445692-1653068927.jpg', 'background37-1461782277-1653069030.jpg', 'Cựu sinh viên', '', 6, '', 'Trà Vinh', '10.022715', '105.761836', '1998-05-12', NULL, '$2y$10$Os40xuBnGn8LS7N5hO2JfOyxPqazOFg8qUe7twQTTTT2VRYCAIM2i', NULL, '2022-05-20 10:18:15', NULL),
(38, 'Phạm', 'Ngọc Thạch', 'phamngocthach@gmail.com', 'Nam', 'avatar38-1264794320-1653069240.jpg', 'background38-847766439-1653069249.jpg', 'Sinh viên', '', 7, '', 'Long Hồ, Vĩnh Long', '10.022715', '105.761836', '1997-11-11', NULL, '$2y$10$R0vJcZjrb5zbE0FBuuGLje5enjv/Z8cg0K9k6BzPWqFWc.ARgt3ya', NULL, '2014-05-20 10:18:15', NULL),
(39, 'Phạm', 'Đức Huy', 'phamduchuy@gmail.com', 'Nam', 'avatar39-686108925-1653233948.jpg', 'background39-399785419-1653234099.jpg', 'Sinh viên', NULL, 7, NULL, 'Long Hưng, Mỹ Tú, Sóc Trăng', '9.652486', '105.8172996', '2004-05-21', NULL, '$2y$10$7EA1SAa/mNjTI0nCH2EDGeAhKc5JWZUM0tqJ7ddLP8A16VgkpPAju', NULL, '2022-05-22 15:38:55', '2022-05-22 15:38:55'),
(40, 'Nguyễn', 'Quỳnh Như', 'nguyenquynhnhu@gmail.com', 'Nữ', 'avatar40-597520557-1653307588.jpg', 'background40-942582369-1653307600.jpg', 'Sinh viên', NULL, 6, NULL, 'Gạch Giá, Kiên Giang', '9.652486', '105.8172996', '2006-08-08', NULL, '$2y$10$2S1K21ACv5RkYiWNoqNTduMTzsR2NVbMDmvVA6GBFpqOyzsz34n3u', NULL, '2022-05-23 12:00:30', '2022-05-23 12:00:30'),
(41, 'Đinh', 'Thị Xuân', 'dinhthixuan@gmail.com', 'Nữ', 'avatar41-1248621794-1653312526.jpg', 'noimg.jpg', 'Sinh viên', NULL, 6, NULL, 'Long Hồ, Vĩnh Long', NULL, NULL, '2002-07-09', NULL, '$2y$10$c2ninTn2.w.0DsKlaL4BTOrBnc7yJL6ICO9lE76bmODDrgj0cEK6W', NULL, '2022-05-23 13:28:30', '2022-05-23 13:28:30');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user_messages`
--

CREATE TABLE `user_messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `message_id` int(10) UNSIGNED NOT NULL,
  `sender_id` int(10) UNSIGNED NOT NULL,
  `receiver_id` int(10) UNSIGNED DEFAULT NULL,
  `type` tinyint(4) NOT NULL DEFAULT 0 COMMENT '1:group messafe, 0 personal message',
  `seen_status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '1:seen',
  `deliver_status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '1:delivered',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `message_group_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `user_messages`
--

INSERT INTO `user_messages` (`id`, `message_id`, `sender_id`, `receiver_id`, `type`, `seen_status`, `deliver_status`, `created_at`, `updated_at`, `message_group_id`) VALUES
(38, 38, 25, 29, 0, 0, 0, '2022-05-21 07:55:58', '2022-05-21 07:55:58', NULL),
(39, 39, 25, NULL, 0, 0, 0, '2022-05-21 07:56:27', '2022-05-21 07:56:27', 8),
(40, 40, 29, 25, 0, 0, 0, '2022-05-23 08:49:15', '2022-05-23 08:49:15', NULL),
(41, 41, 25, 27, 0, 0, 0, '2022-05-23 14:29:01', '2022-05-23 14:29:01', NULL),
(42, 42, 25, NULL, 0, 0, 0, '2022-05-23 14:29:51', '2022-05-23 14:29:51', 10);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ad_ma`);

--
-- Chỉ mục cho bảng `baocaopost`
--
ALTER TABLE `baocaopost`
  ADD PRIMARY KEY (`rp_id`);

--
-- Chỉ mục cho bảng `baocaovipham`
--
ALTER TABLE `baocaovipham`
  ADD PRIMARY KEY (`bcvp_id`);

--
-- Chỉ mục cho bảng `bookmark`
--
ALTER TABLE `bookmark`
  ADD PRIMARY KEY (`bm_id`);

--
-- Chỉ mục cho bảng `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`cmt_id`),
  ADD KEY `comment_user_id_foreign` (`user_id`),
  ADD KEY `comment_cmt_reply_foreign` (`cmt_reply`);

--
-- Chỉ mục cho bảng `emoticons`
--
ALTER TABLE `emoticons`
  ADD PRIMARY KEY (`emoticons_id`),
  ADD KEY `emoticons_user_id_foreign` (`user_id`),
  ADD KEY `emoticons_post_id_foreign` (`post_id`);

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Chỉ mục cho bảng `file_post`
--
ALTER TABLE `file_post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `file_post_post_id_foreign` (`post_id`);

--
-- Chỉ mục cho bảng `followers`
--
ALTER TABLE `followers`
  ADD PRIMARY KEY (`follow_id`);

--
-- Chỉ mục cho bảng `friend`
--
ALTER TABLE `friend`
  ADD PRIMARY KEY (`user_from`,`user_to`),
  ADD KEY `friend_user_to_foreign` (`user_to`);

--
-- Chỉ mục cho bảng `group`
--
ALTER TABLE `group`
  ADD PRIMARY KEY (`group_id`);

--
-- Chỉ mục cho bảng `group_members`
--
ALTER TABLE `group_members`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `group_work`
--
ALTER TABLE `group_work`
  ADD PRIMARY KEY (`gw_id`);

--
-- Chỉ mục cho bảng `icon`
--
ALTER TABLE `icon`
  ADD PRIMARY KEY (`icon_id`);

--
-- Chỉ mục cho bảng `imgsanpham`
--
ALTER TABLE `imgsanpham`
  ADD PRIMARY KEY (`imgsp_id`);

--
-- Chỉ mục cho bảng `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Chỉ mục cho bảng `loaisanpham`
--
ALTER TABLE `loaisanpham`
  ADD PRIMARY KEY (`pl_id`);

--
-- Chỉ mục cho bảng `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `message_groups`
--
ALTER TABLE `message_groups`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `message_group_members`
--
ALTER TABLE `message_group_members`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Chỉ mục cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Chỉ mục cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Chỉ mục cho bảng `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `posts_user_id_foreign` (`user_id`);

--
-- Chỉ mục cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`sp_id`);

--
-- Chỉ mục cho bảng `school`
--
ALTER TABLE `school`
  ADD PRIMARY KEY (`school_id`);

--
-- Chỉ mục cho bảng `school_followers`
--
ALTER TABLE `school_followers`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `submissions`
--
ALTER TABLE `submissions`
  ADD PRIMARY KEY (`sm_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Chỉ mục cho bảng `user_messages`
--
ALTER TABLE `user_messages`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admin`
--
ALTER TABLE `admin`
  MODIFY `ad_ma` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `baocaopost`
--
ALTER TABLE `baocaopost`
  MODIFY `rp_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `baocaovipham`
--
ALTER TABLE `baocaovipham`
  MODIFY `bcvp_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `bookmark`
--
ALTER TABLE `bookmark`
  MODIFY `bm_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT cho bảng `comment`
--
ALTER TABLE `comment`
  MODIFY `cmt_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT cho bảng `emoticons`
--
ALTER TABLE `emoticons`
  MODIFY `emoticons_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=180;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `file_post`
--
ALTER TABLE `file_post`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- AUTO_INCREMENT cho bảng `followers`
--
ALTER TABLE `followers`
  MODIFY `follow_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `group`
--
ALTER TABLE `group`
  MODIFY `group_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `group_members`
--
ALTER TABLE `group_members`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT cho bảng `group_work`
--
ALTER TABLE `group_work`
  MODIFY `gw_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `icon`
--
ALTER TABLE `icon`
  MODIFY `icon_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `imgsanpham`
--
ALTER TABLE `imgsanpham`
  MODIFY `imgsp_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT cho bảng `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT cho bảng `loaisanpham`
--
ALTER TABLE `loaisanpham`
  MODIFY `pl_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT cho bảng `message_groups`
--
ALTER TABLE `message_groups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `message_group_members`
--
ALTER TABLE `message_group_members`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=226;

--
-- AUTO_INCREMENT cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=192;

--
-- AUTO_INCREMENT cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  MODIFY `sp_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT cho bảng `school`
--
ALTER TABLE `school`
  MODIFY `school_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `school_followers`
--
ALTER TABLE `school_followers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT cho bảng `submissions`
--
ALTER TABLE `submissions`
  MODIFY `sm_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT cho bảng `user_messages`
--
ALTER TABLE `user_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `emoticons`
--
ALTER TABLE `emoticons`
  ADD CONSTRAINT `emoticons_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `emoticons_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `file_post`
--
ALTER TABLE `file_post`
  ADD CONSTRAINT `file_post_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `friend`
--
ALTER TABLE `friend`
  ADD CONSTRAINT `friend_user_from_foreign` FOREIGN KEY (`user_from`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `friend_user_to_foreign` FOREIGN KEY (`user_to`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
