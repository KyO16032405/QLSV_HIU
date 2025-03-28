-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 27, 2025 at 05:56 PM
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
-- Database: `ms`
--

-- --------------------------------------------------------

--
-- Table structure for table `diems`
--

CREATE TABLE `diems` (
  `id` int UNSIGNED NOT NULL,
  `madiem` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `diemcc` int NOT NULL,
  `diemtx` int NOT NULL,
  `diemgk` int NOT NULL,
  `diemck` int NOT NULL,
  `diemtong` int NOT NULL,
  `diemrl` int NOT NULL COMMENT 'điểm trèn luyện',
  `HeSodiemcc` int NOT NULL,
  `HeSodiemtx` int NOT NULL,
  `HeSodiemgk` int NOT NULL,
  `HeSodiemck` int NOT NULL,
  `sinhvien_id` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `monhoc_id` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `diems`
--

INSERT INTO `diems` (`id`, `madiem`, `diemcc`, `diemtx`, `diemgk`, `diemck`, `diemtong`, `diemrl`, `HeSodiemcc`, `HeSodiemtx`, `HeSodiemgk`, `HeSodiemck`, `sinhvien_id`, `created_at`, `updated_at`, `monhoc_id`) VALUES
(3, 'A001', 9, 8, 7, 9, 8, 90, 1, 1, 1, 1, 121, NULL, NULL, 1),
(4, 'A002', 7, 6, 5, 8, 7, 85, 1, 1, 1, 1, 122, NULL, NULL, 2),
(5, 'A003', 8, 7, 6, 7, 7, 80, 1, 1, 1, 1, 123, NULL, NULL, 3),
(6, 'A004', 10, 9, 8, 9, 9, 95, 1, 1, 1, 1, 124, NULL, NULL, 4),
(7, 'A005', 6, 5, 4, 7, 6, 60, 1, 1, 1, 1, 125, NULL, NULL, 5),
(8, 'A006', 9, 9, 8, 10, 9, 88, 1, 1, 1, 1, 126, NULL, NULL, 6),
(9, 'A007', 5, 6, 7, 6, 6, 70, 1, 1, 1, 1, 127, NULL, NULL, 7),
(10, 'A008', 9, 8, 9, 8, 9, 85, 1, 1, 1, 1, 128, NULL, NULL, 8),
(11, 'A009', 10, 10, 9, 10, 10, 100, 1, 1, 1, 1, 129, NULL, NULL, 9),
(12, 'A010', 6, 7, 6, 5, 6, 75, 1, 1, 1, 1, 130, NULL, NULL, 10),
(13, 'A011', 8, 9, 7, 6, 7, 78, 1, 1, 1, 1, 131, NULL, NULL, 11),
(14, 'A012', 7, 8, 6, 9, 8, 80, 1, 1, 1, 1, 132, NULL, NULL, 12),
(15, 'A013', 9, 10, 8, 7, 8, 88, 1, 1, 1, 1, 133, NULL, NULL, 13),
(16, 'A014', 5, 6, 4, 7, 6, 65, 1, 1, 1, 1, 134, NULL, NULL, 14),
(17, 'A015', 10, 9, 8, 10, 9, 95, 1, 1, 1, 1, 135, NULL, NULL, 15),
(18, 'A016', 8, 7, 9, 6, 8, 85, 1, 1, 1, 1, 136, NULL, NULL, 16),
(19, 'A017', 6, 5, 7, 8, 7, 70, 1, 1, 1, 1, 137, NULL, NULL, 17),
(20, 'A018', 7, 9, 8, 9, 8, 90, 1, 1, 1, 1, 138, NULL, NULL, 18),
(21, 'A019', 9, 8, 6, 7, 8, 80, 1, 1, 1, 1, 139, NULL, NULL, 19),
(22, 'A020', 5, 6, 4, 5, 5, 50, 1, 1, 1, 1, 140, NULL, NULL, 20),
(23, 'A021', 8, 7, 9, 6, 8, 88, 1, 1, 1, 1, 141, NULL, NULL, 21),
(24, 'A022', 7, 6, 5, 9, 7, 78, 1, 1, 1, 1, 142, NULL, NULL, 22),
(25, 'A023', 9, 10, 8, 7, 9, 92, 1, 1, 1, 1, 143, NULL, NULL, 23),
(26, 'A024', 6, 5, 4, 8, 6, 60, 1, 1, 1, 1, 144, NULL, NULL, 24),
(27, 'A025', 10, 9, 7, 9, 9, 95, 1, 1, 1, 1, 145, NULL, NULL, 25);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `giangviens`
--

CREATE TABLE `giangviens` (
  `id` int UNSIGNED NOT NULL,
  `magv` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hogv` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tengv` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ngaysinh` date NOT NULL,
  `gioitinh` tinyint(1) NOT NULL,
  `hocham` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hocvi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `giangviens`
--

INSERT INTO `giangviens` (`id`, `magv`, `hogv`, `tengv`, `ngaysinh`, `gioitinh`, `hocham`, `hocvi`, `created_at`, `updated_at`) VALUES
(1, 'GV001', 'Nguyen', 'An', '1980-05-15', 1, 'Phó Giáo sư', 'Tiến sĩ', '2025-03-27 17:30:04', '2025-03-27 17:30:04'),
(2, 'GV002', 'Tran', 'Binh', '1975-09-20', 1, 'Giáo sư', 'Tiến sĩ', '2025-03-27 17:30:04', '2025-03-27 17:30:04'),
(3, 'GV003', 'Le', 'Cuc', '1982-07-10', 0, 'Phó Giáo sư', 'Thạc sĩ', '2025-03-27 17:30:04', '2025-03-27 17:30:04'),
(4, 'GV004', 'Pham', 'Duc', '1990-03-25', 1, 'Tiến sĩ', 'Tiến sĩ', '2025-03-27 17:30:04', '2025-03-27 17:30:04'),
(5, 'GV005', 'Hoang', 'Lan', '1988-12-30', 0, 'Thạc sĩ', 'Thạc sĩ', '2025-03-27 17:30:04', '2025-03-27 17:30:04'),
(6, 'GV006', 'Do', 'Minh', '1981-11-05', 1, 'Phó Giáo sư', 'Tiến sĩ', '2025-03-27 17:30:04', '2025-03-27 17:30:04'),
(7, 'GV007', 'Bui', 'Ngan', '1987-06-14', 0, 'Giáo sư', 'Tiến sĩ', '2025-03-27 17:30:04', '2025-03-27 17:30:04'),
(8, 'GV008', 'Pham', 'Huy', '1984-04-09', 1, 'Phó Giáo sư', 'Thạc sĩ', '2025-03-27 17:30:04', '2025-03-27 17:30:04'),
(9, 'GV009', 'Vu', 'Phuong', '1992-02-28', 0, 'Tiến sĩ', 'Thạc sĩ', '2025-03-27 17:30:04', '2025-03-27 17:30:04'),
(10, 'GV010', 'Nguyen', 'Son', '1978-08-18', 1, 'Giáo sư', 'Tiến sĩ', '2025-03-27 17:30:04', '2025-03-27 17:30:04'),
(11, 'GV011', 'Tran', 'Tuan', '1985-12-07', 1, 'Phó Giáo sư', 'Thạc sĩ', '2025-03-27 17:30:04', '2025-03-27 17:30:04'),
(12, 'GV012', 'Le', 'Van', '1989-05-21', 1, 'Tiến sĩ', 'Tiến sĩ', '2025-03-27 17:30:04', '2025-03-27 17:30:04'),
(13, 'GV013', 'Ho', 'Thanh', '1991-09-12', 0, 'Thạc sĩ', 'Thạc sĩ', '2025-03-27 17:30:04', '2025-03-27 17:30:04'),
(14, 'GV014', 'Bui', 'Linh', '1983-10-03', 0, 'Giáo sư', 'Tiến sĩ', '2025-03-27 17:30:04', '2025-03-27 17:30:04'),
(15, 'GV015', 'Do', 'Dai', '1976-07-16', 1, 'Phó Giáo sư', 'Tiến sĩ', '2025-03-27 17:30:04', '2025-03-27 17:30:04'),
(16, 'GV016', 'Nguyen', 'Quynh', '1993-11-30', 0, 'Tiến sĩ', 'Thạc sĩ', '2025-03-27 17:30:04', '2025-03-27 17:30:04'),
(17, 'GV017', 'Tran', 'Trung', '1986-03-19', 1, 'Phó Giáo sư', 'Tiến sĩ', '2025-03-27 17:30:04', '2025-03-27 17:30:04'),
(18, 'GV018', 'Le', 'Hanh', '1994-06-25', 0, 'Thạc sĩ', 'Thạc sĩ', '2025-03-27 17:30:04', '2025-03-27 17:30:04'),
(19, 'GV019', 'Pham', 'Duy', '1980-01-08', 1, 'Giáo sư', 'Tiến sĩ', '2025-03-27 17:30:04', '2025-03-27 17:30:04'),
(20, 'GV020', 'Hoang', 'Bao', '1982-09-27', 1, 'Phó Giáo sư', 'Tiến sĩ', '2025-03-27 17:30:04', '2025-03-27 17:30:04'),
(21, 'GV021', 'Do', 'Nhat', '1995-12-22', 1, 'Tiến sĩ', 'Tiến sĩ', '2025-03-27 17:30:04', '2025-03-27 17:30:04'),
(22, 'GV022', 'Bui', 'Lan', '1987-08-31', 0, 'Thạc sĩ', 'Thạc sĩ', '2025-03-27 17:30:04', '2025-03-27 17:30:04'),
(23, 'GV023', 'Vu', 'Hoang', '1984-04-16', 1, 'Giáo sư', 'Tiến sĩ', '2025-03-27 17:30:04', '2025-03-27 17:30:04'),
(24, 'GV024', 'Nguyen', 'Thu', '1990-02-14', 0, 'Phó Giáo sư', 'Thạc sĩ', '2025-03-27 17:30:04', '2025-03-27 17:30:04'),
(25, 'GV025', 'Tran', 'Diem', '1985-06-29', 0, 'Tiến sĩ', 'Tiến sĩ', '2025-03-27 17:30:04', '2025-03-27 17:30:04');

-- --------------------------------------------------------

--
-- Table structure for table `hockys`
--

CREATE TABLE `hockys` (
  `id` int UNSIGNED NOT NULL,
  `hocky` int NOT NULL,
  `namhoc` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hockys`
--

INSERT INTO `hockys` (`id`, `hocky`, `namhoc`, `created_at`, `updated_at`) VALUES
(1, 1, '2025-2026', '2025-03-27 17:47:28', '2025-03-27 17:47:28'),
(2, 2, '2025-2026', '2025-03-27 17:47:28', '2025-03-27 17:47:28');

-- --------------------------------------------------------

--
-- Table structure for table `khoas`
--

CREATE TABLE `khoas` (
  `id` int UNSIGNED NOT NULL,
  `makhoa` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tenkhoa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `khoas`
--

INSERT INTO `khoas` (`id`, `makhoa`, `tenkhoa`, `created_at`, `updated_at`) VALUES
(1, 'YHOC', 'Khoa Y', NULL, NULL),
(2, 'RHM', 'Khoa Răng Hàm Mặt', NULL, NULL),
(3, 'DD', 'Khoa Điều dưỡng', NULL, NULL),
(4, 'VLTL', 'Khoa Vật lý trị liệu và Phục hồi chức năng', NULL, NULL),
(5, 'KTXN', 'Khoa Kỹ thuật Xét nghiệm Y học', NULL, NULL),
(6, 'DUOC', 'Khoa Dược', NULL, NULL),
(7, 'HS', 'Khoa Hộ sinh', NULL, NULL),
(8, 'KTQT', 'Khoa Kinh tế và Quản trị', NULL, NULL),
(9, 'KTCN', 'Khoa Kỹ thuật và Công nghệ', NULL, NULL),
(10, 'KHXH', 'Khoa Khoa học Xã hội và Nhân văn', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lops`
--

CREATE TABLE `lops` (
  `id` int UNSIGNED NOT NULL,
  `malop` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tenlopvt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tenlop` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `khoa_id` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lops`
--

INSERT INTO `lops` (`id`, `malop`, `tenlopvt`, `tenlop`, `khoa_id`, `created_at`, `updated_at`) VALUES
(2, 'HB63', 'ĐHHB63', 'Đại học Hồng Bàng ', 9, '2025-03-27 09:38:38', '2025-03-27 09:38:38'),
(3, 'HB50', 'ĐHHB50', 'Đại học Hồng Bàng ', 5, '2025-03-27 09:38:38', '2025-03-27 09:38:38'),
(4, 'HB97', 'ĐHHB97', 'Đại học Hồng Bàng ', 10, '2025-03-27 09:38:38', '2025-03-27 09:38:38'),
(5, 'HB12', 'ĐHHB12', 'Đại học Hồng Bàng ', 9, '2025-03-27 09:38:38', '2025-03-27 09:38:38'),
(6, 'HB98', 'ĐHHB98', 'Đại học Hồng Bàng ', 3, '2025-03-27 09:38:38', '2025-03-27 09:38:38'),
(7, 'HB36', 'ĐHHB36', 'Đại học Hồng Bàng ', 2, '2025-03-27 09:38:38', '2025-03-27 09:38:38'),
(8, 'HB93', 'ĐHHB93', 'Đại học Hồng Bàng ', 5, '2025-03-27 09:38:38', '2025-03-27 09:38:38');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2017_11_15_134153_add_checkcodeemail_to_users_table', 1),
(4, '2017_12_09_143449_create_khoas_table', 1),
(5, '2017_12_10_033502_create_lops_table', 1),
(6, '2017_12_10_042847_create_sinhviens_table', 1),
(7, '2017_12_10_064613_create_diems_table', 1),
(8, '2017_12_10_065359_create_monhocs_table', 1),
(9, '2017_12_10_065807_add_monhocid_to_diems_table', 1),
(10, '2017_12_10_070622_create_monhoc_lop_table', 1),
(11, '2017_12_13_043759_create_sinhvien_monhoc_table', 1),
(12, '2017_12_27_033758_create_giangviens_table', 1),
(13, '2018_01_15_182502_add_postsvip_to_posts', 1),
(14, '2019_08_19_000000_create_failed_jobs_table', 1),
(15, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `monhocs`
--

CREATE TABLE `monhocs` (
  `id` int UNSIGNED NOT NULL,
  `mamon` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tenmon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'tên môn học',
  `tenbomon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'tên bộ môn',
  `sotinchi` int NOT NULL,
  `sotiet` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `hocky_id` int UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `monhocs`
--

INSERT INTO `monhocs` (`id`, `mamon`, `tenmon`, `tenbomon`, `sotinchi`, `sotiet`, `created_at`, `updated_at`, `hocky_id`) VALUES
(1, 'MH001', 'Toán cao cấp', 'Toán ứng dụng', 3, 45, NULL, NULL, 1),
(2, 'MH002', 'Giải tích', 'Toán ứng dụng', 3, 45, NULL, NULL, 1),
(3, 'MH003', 'Xác suất thống kê', 'Toán ứng dụng', 3, 45, NULL, NULL, 1),
(4, 'MH004', 'Vật lý đại cương', 'Vật lý', 3, 45, NULL, NULL, 1),
(5, 'MH005', 'Điện tử cơ bản', 'Điện - Điện tử', 3, 45, NULL, NULL, 1),
(6, 'MH006', 'Hóa học đại cương', 'Hóa học', 3, 45, NULL, NULL, 1),
(7, 'MH007', 'Cấu trúc dữ liệu & Giải thuật', 'Khoa học máy tính', 3, 45, NULL, NULL, 1),
(8, 'MH008', 'Lập trình C', 'Công nghệ phần mềm', 3, 45, NULL, NULL, 1),
(9, 'MH009', 'Lập trình hướng đối tượng', 'Công nghệ phần mềm', 3, 45, NULL, NULL, 1),
(10, 'MH010', 'Hệ điều hành', 'Khoa học máy tính', 3, 45, NULL, NULL, 1),
(11, 'MH011', 'Mạng máy tính', 'Mạng và bảo mật', 3, 45, NULL, NULL, 1),
(12, 'MH012', 'Cơ sở dữ liệu', 'Công nghệ phần mềm', 3, 45, NULL, NULL, 1),
(13, 'MH013', 'Pháp luật đại cương', 'Khoa học xã hội', 2, 30, NULL, NULL, 1),
(14, 'MH014', 'Kinh tế vi mô', 'Kinh tế', 3, 45, NULL, NULL, 1),
(15, 'MH015', 'Kinh tế vĩ mô', 'Kinh tế', 3, 45, NULL, NULL, 1),
(16, 'MH016', 'Nguyên lý kế toán', 'Tài chính - Kế toán', 3, 45, NULL, NULL, 1),
(17, 'MH017', 'Quản trị học', 'Quản trị kinh doanh', 3, 45, NULL, NULL, 1),
(18, 'MH018', 'Triết học Mác - Lênin', 'Khoa học chính trị', 3, 45, NULL, NULL, 1),
(19, 'MH019', 'Tư tưởng Hồ Chí Minh', 'Khoa học chính trị', 3, 45, NULL, NULL, 1),
(20, 'MH020', 'Đường lối cách mạng ĐCS VN', 'Khoa học chính trị', 3, 45, NULL, NULL, 1),
(21, 'MH021', 'Lập trình Java', 'Công nghệ phần mềm', 3, 45, NULL, NULL, 1),
(22, 'MH022', 'Phân tích thiết kế hệ thống', 'Công nghệ phần mềm', 3, 45, NULL, NULL, 1),
(23, 'MH023', 'Trí tuệ nhân tạo', 'Khoa học dữ liệu', 3, 45, NULL, NULL, 1),
(24, 'MH024', 'Xử lý ảnh', 'Khoa học dữ liệu', 3, 45, NULL, NULL, 1),
(25, 'MH025', 'An toàn thông tin', 'Mạng và bảo mật', 3, 45, NULL, NULL, 1),
(26, 'MH026', 'Phát triển ứng dụng di động', 'Công nghệ phần mềm', 3, 45, NULL, NULL, 1),
(27, 'MH027', 'Lập trình Web', 'Công nghệ phần mềm', 3, 45, NULL, NULL, 1),
(28, 'MH028', 'Hệ thống thông tin', 'Công nghệ phần mềm', 3, 45, NULL, NULL, 1),
(29, 'MH029', 'Điện toán đám mây', 'Khoa học dữ liệu', 3, 45, NULL, NULL, 1),
(30, 'MH030', 'Đồ án tốt nghiệp', 'Công nghệ phần mềm', 4, 60, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `monhoc_lop`
--

CREATE TABLE `monhoc_lop` (
  `id` int UNSIGNED NOT NULL,
  `monhoc_id` int UNSIGNED NOT NULL,
  `lop_id` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `monhoc_lop`
--

INSERT INTO `monhoc_lop` (`id`, `monhoc_id`, `lop_id`, `created_at`, `updated_at`) VALUES
(1, 1, 2, NULL, NULL),
(2, 1, 3, NULL, NULL),
(3, 1, 4, NULL, NULL),
(4, 1, 5, NULL, NULL),
(5, 2, 2, NULL, NULL),
(6, 2, 3, NULL, NULL),
(7, 2, 4, NULL, NULL),
(8, 2, 5, NULL, NULL),
(9, 3, 2, NULL, NULL),
(10, 3, 3, NULL, NULL),
(11, 3, 4, NULL, NULL),
(12, 3, 5, NULL, NULL),
(13, 4, 2, NULL, NULL),
(14, 4, 3, NULL, NULL),
(15, 4, 4, NULL, NULL),
(16, 4, 5, NULL, NULL),
(17, 5, 2, NULL, NULL),
(18, 5, 3, NULL, NULL),
(19, 5, 4, NULL, NULL),
(20, 6, 2, NULL, NULL),
(21, 6, 3, NULL, NULL),
(22, 6, 4, NULL, NULL),
(23, 7, 2, NULL, NULL),
(24, 7, 3, NULL, NULL),
(25, 7, 4, NULL, NULL),
(26, 8, 4, NULL, NULL),
(27, 8, 5, NULL, NULL),
(28, 8, 6, NULL, NULL),
(29, 9, 4, NULL, NULL),
(30, 9, 5, NULL, NULL),
(31, 9, 6, NULL, NULL),
(32, 10, 4, NULL, NULL),
(33, 10, 5, NULL, NULL),
(34, 10, 6, NULL, NULL),
(35, 11, 4, NULL, NULL),
(36, 11, 5, NULL, NULL),
(37, 11, 6, NULL, NULL),
(38, 12, 5, NULL, NULL),
(39, 12, 6, NULL, NULL),
(40, 12, 7, NULL, NULL),
(41, 13, 5, NULL, NULL),
(42, 13, 6, NULL, NULL),
(43, 13, 7, NULL, NULL),
(44, 14, 5, NULL, NULL),
(45, 14, 6, NULL, NULL),
(46, 14, 7, NULL, NULL),
(47, 15, 5, NULL, NULL),
(48, 15, 6, NULL, NULL),
(49, 15, 7, NULL, NULL),
(50, 16, 6, NULL, NULL),
(51, 16, 7, NULL, NULL),
(52, 16, 8, NULL, NULL),
(53, 17, 6, NULL, NULL),
(54, 17, 7, NULL, NULL),
(55, 17, 8, NULL, NULL),
(56, 18, 6, NULL, NULL),
(57, 18, 7, NULL, NULL),
(58, 18, 8, NULL, NULL),
(59, 19, 6, NULL, NULL),
(60, 19, 7, NULL, NULL),
(61, 19, 8, NULL, NULL),
(62, 20, 7, NULL, NULL),
(63, 20, 8, NULL, NULL),
(64, 21, 7, NULL, NULL),
(65, 21, 8, NULL, NULL),
(66, 22, 7, NULL, NULL),
(67, 22, 8, NULL, NULL),
(68, 23, 7, NULL, NULL),
(69, 23, 8, NULL, NULL),
(70, 24, 8, NULL, NULL),
(71, 25, 8, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `phancong`
--

CREATE TABLE `phancong` (
  `monhoc_id` int UNSIGNED NOT NULL,
  `lop_id` int UNSIGNED NOT NULL,
  `giangvien_id` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `phancong`
--

INSERT INTO `phancong` (`monhoc_id`, `lop_id`, `giangvien_id`, `created_at`, `updated_at`) VALUES
(1, 2, 1, '2025-03-27 17:50:44', '2025-03-27 17:50:44'),
(2, 2, 2, '2025-03-27 17:50:44', '2025-03-27 17:50:44'),
(3, 3, 3, '2025-03-27 17:50:44', '2025-03-27 17:50:44'),
(4, 4, 4, '2025-03-27 17:50:44', '2025-03-27 17:50:44'),
(5, 5, 5, '2025-03-27 17:50:44', '2025-03-27 17:50:44'),
(6, 6, 6, '2025-03-27 17:50:44', '2025-03-27 17:50:44'),
(7, 7, 7, '2025-03-27 17:50:44', '2025-03-27 17:50:44'),
(8, 8, 8, '2025-03-27 17:50:44', '2025-03-27 17:50:44');

-- --------------------------------------------------------

--
-- Table structure for table `sinhviens`
--

CREATE TABLE `sinhviens` (
  `id` int UNSIGNED NOT NULL,
  `masv` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hosv` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tensv` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gioitinh` tinyint(1) NOT NULL,
  `ngaysinh` date NOT NULL,
  `quequan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `lop_id` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sinhviens`
--

INSERT INTO `sinhviens` (`id`, `masv`, `hosv`, `tensv`, `gioitinh`, `ngaysinh`, `quequan`, `lop_id`, `created_at`, `updated_at`) VALUES
(121, '201104872', 'Lê Hoàng', 'Đạo', 1, '2002-12-11', 'Hà Nội', 2, '2025-03-26 17:00:00', '2025-03-26 17:00:00'),
(122, '201109321', 'Hoàng Lê Kiên', 'Cường', 1, '2002-12-11', 'TP Hồ Chí Minh', 6, '2025-03-26 17:00:00', '2025-03-26 17:00:00'),
(123, '201105678', 'Phạm Ninh', 'Dung', 0, '2002-12-11', 'Hải Phòng', 8, '2025-03-26 17:00:00', '2025-03-26 17:00:00'),
(124, '201107234', 'Nguyễn Ngọc', 'Hiền', 0, '2002-12-11', 'Đà Nẵng', 6, '2025-03-26 17:00:00', '2025-03-26 17:00:00'),
(125, '201103898', 'Đào Lê Duy', 'Hùng', 1, '2002-12-11', 'Cần Thơ', 5, '2025-03-26 17:00:00', '2025-03-26 17:00:00'),
(126, '201108765', 'Nguyễn Thế Quốc', 'Khang', 1, '2002-12-11', 'An Giang', 4, '2025-03-26 17:00:00', '2025-03-26 17:00:00'),
(127, '201106543', 'Trần Thị Thanh', 'Kiều', 0, '2002-12-11', 'Bà Rịa - Vũng Tàu', 3, '2025-03-26 17:00:00', '2025-03-26 17:00:00'),
(128, '201102198', 'Lý Thị Bích', 'Liên', 0, '2002-12-11', 'Bắc Giang', 5, '2025-03-26 17:00:00', '2025-03-26 17:00:00'),
(129, '201109876', 'Đỗ Quang', 'Minh', 1, '2002-12-11', 'Bắc Kạn', 7, '2025-03-26 17:00:00', '2025-03-26 17:00:00'),
(130, '201104321', 'Nguyễn Trọng', 'Nghĩa', 1, '2002-12-11', 'Bạc Liêu', 8, '2025-03-26 17:00:00', '2025-03-26 17:00:00'),
(131, '201107893', 'Nguyễn Đức', 'Anh', 1, '2002-12-11', 'Bắc Ninh', 2, '2025-03-26 17:00:00', '2025-03-26 17:00:00'),
(132, '201103214', 'Trần Minh', 'Ân', 1, '2002-12-11', 'Bến Tre', 2, '2025-03-26 17:00:00', '2025-03-26 17:00:00'),
(133, '201108567', 'Nguyễn Thành', 'Công', 1, '2002-12-11', 'Bình Định', 2, '2025-03-26 17:00:00', '2025-03-26 17:00:00'),
(134, '201106789', 'Phạm Công', 'Danh', 1, '2002-12-11', 'Bình Dương', 8, '2025-03-26 17:00:00', '2025-03-26 17:00:00'),
(135, '201102345', 'Nguyễn Văn', 'Duy', 1, '2002-12-11', 'Bình Phước', 2, '2025-03-26 17:00:00', '2025-03-26 17:00:00'),
(136, '201109012', 'Hoàng Thị Mỹ', 'Duyên', 0, '2002-12-11', 'Bình Thuận', 4, '2025-03-26 17:00:00', '2025-03-26 17:00:00'),
(137, '201104567', 'Nguyễn Hùng', 'Hào', 1, '2002-12-11', 'Cà Mau', 2, '2025-03-26 17:00:00', '2025-03-26 17:00:00'),
(138, '201108901', 'Lê Thị Thu', 'Hiền', 0, '2002-12-11', 'Cao Bằng', 2, '2025-03-26 17:00:00', '2025-03-26 17:00:00'),
(139, '201103456', 'Nguyễn Huy', 'Hoàng', 1, '2002-12-11', 'Đắk Lắk', 7, '2025-03-26 17:00:00', '2025-03-26 17:00:00'),
(140, '201107809', 'Hoàng Huy', 'Hùng', 1, '2002-12-11', 'Đắk Nông', 2, '2025-03-26 17:00:00', '2025-03-26 17:00:00'),
(141, '201102134', 'Nguyễn Hoàng', 'Anh', 1, '2002-12-11', 'Điện Biên', 5, '2025-03-26 17:00:00', '2025-03-26 17:00:00'),
(142, '201109678', 'Vũ Gia', 'Bảo', 1, '2002-12-11', 'Đồng Nai', 3, '2025-03-26 17:00:00', '2025-03-26 17:00:00'),
(143, '201104123', 'Nhữ Gia', 'Hoàng', 1, '2002-12-11', 'Đồng Tháp', 3, '2025-03-26 17:00:00', '2025-03-26 17:00:00'),
(144, '201108791', 'Trần Quốc', 'Toản', 1, '2002-12-11', 'Gia Lai', 3, '2025-03-26 17:00:00', '2025-03-26 17:00:00'),
(145, '201103567', 'Cao Trung', 'Thành', 1, '2002-12-11', 'Hà Giang', 3, '2025-03-26 17:00:00', '2025-03-26 17:00:00'),
(146, '201107901', 'Nguyễn Gia Khánh', 'Tùng', 1, '2017-12-11', 'Hà Nam', 3, '2025-03-26 17:00:00', '2025-03-26 17:00:00'),
(147, '201102678', 'Hoàng Tiến', 'Thành', 1, '2017-12-11', 'Hà Tĩnh', 3, '2025-03-26 17:00:00', '2025-03-26 17:00:00'),
(148, '201109345', 'Trần Hoàng ', 'Anh', 1, '2017-12-11', 'Hải Dương', 3, '2025-03-26 17:00:00', '2025-03-26 17:00:00'),
(149, '201104899', 'Nguyễn Thị Trà', 'My', 0, '2017-12-11', 'Hậu Giang', 3, '2025-03-26 17:00:00', '2025-03-26 17:00:00'),
(150, '201108123', 'Phan Quang', 'Nam', 1, '2017-12-11', 'Hòa Bình', 3, '2025-03-26 17:00:00', '2025-03-26 17:00:00'),
(151, '201103789', 'Võ Thị Hoàng', 'Anh', 0, '2017-12-11', 'Hưng Yên', 4, '2025-03-26 17:00:00', '2025-03-26 17:00:00'),
(152, '201107456', 'Nguyễn Hoàng', 'Anh', 1, '2017-12-11', 'Khánh Hòa', 4, '2025-03-26 17:00:00', '2025-03-26 17:00:00'),
(153, '201102901', 'Lê Văn', 'Bảo', 1, '2017-12-11', 'Kiên Giang', 4, '2025-03-26 17:00:00', '2025-03-26 17:00:00'),
(154, '201109234', 'Nguyễn Đức', 'Duy', 1, '2017-12-11', 'Kon Tum', 4, '2025-03-26 17:00:00', '2025-03-26 17:00:00'),
(155, '201104678', 'Huỳnh Lê', 'Đăng', 1, '2017-12-11', 'Lai Châu', 4, '2025-03-26 17:00:00', '2025-03-26 17:00:00'),
(156, '201108345', 'Hoàng Văn', 'Đức', 1, '2017-12-11', 'Lâm Đồng', 4, '2025-03-26 17:00:00', '2025-03-26 17:00:00'),
(157, '201103012', 'Nguyễn Quang', 'Long', 1, '2017-12-11', 'Lạng Sơn', 4, '2025-03-26 17:00:00', '2025-03-26 17:00:00'),
(158, '201107892', 'Nguyễn Lê Hoàng ', 'Sơn', 1, '2017-12-11', 'Lào Cai', 4, '2025-03-26 17:00:00', '2025-03-26 17:00:00'),
(159, '201102567', 'Nguyễn Thị Thủy', 'Tiên', 0, '2017-12-11', 'Long An', 4, '2025-03-26 17:00:00', '2025-03-26 17:00:00'),
(160, '201109123', 'Đặng Thị Hồng', 'Như', 0, '2017-12-11', 'Nam Định', 4, '2025-03-26 17:00:00', '2025-03-26 17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `sinhvien_monhoc`
--

CREATE TABLE `sinhvien_monhoc` (
  `id` int UNSIGNED NOT NULL,
  `monhoc_id` int UNSIGNED NOT NULL,
  `sinhvien_id` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sinhvien_monhoc`
--

INSERT INTO `sinhvien_monhoc` (`id`, `monhoc_id`, `sinhvien_id`, `created_at`, `updated_at`) VALUES
(1, 1, 121, NULL, NULL),
(2, 2, 121, NULL, NULL),
(3, 3, 121, NULL, NULL),
(4, 4, 121, NULL, NULL),
(5, 5, 121, NULL, NULL),
(6, 6, 122, NULL, NULL),
(7, 7, 122, NULL, NULL),
(8, 8, 122, NULL, NULL),
(9, 9, 122, NULL, NULL),
(10, 10, 122, NULL, NULL),
(11, 11, 123, NULL, NULL),
(12, 12, 123, NULL, NULL),
(13, 13, 123, NULL, NULL),
(14, 14, 123, NULL, NULL),
(15, 15, 123, NULL, NULL),
(16, 16, 124, NULL, NULL),
(17, 17, 124, NULL, NULL),
(18, 18, 124, NULL, NULL),
(19, 19, 124, NULL, NULL),
(20, 20, 124, NULL, NULL),
(21, 21, 125, NULL, NULL),
(22, 22, 125, NULL, NULL),
(23, 23, 125, NULL, NULL),
(24, 24, 125, NULL, NULL),
(25, 25, 125, NULL, NULL),
(26, 1, 126, NULL, NULL),
(27, 2, 126, NULL, NULL),
(28, 3, 126, NULL, NULL),
(29, 4, 126, NULL, NULL),
(30, 5, 126, NULL, NULL),
(31, 6, 127, NULL, NULL),
(32, 7, 127, NULL, NULL),
(33, 8, 127, NULL, NULL),
(34, 9, 127, NULL, NULL),
(35, 10, 127, NULL, NULL),
(36, 11, 128, NULL, NULL),
(37, 12, 128, NULL, NULL),
(38, 13, 128, NULL, NULL),
(39, 14, 128, NULL, NULL),
(40, 15, 128, NULL, NULL),
(41, 16, 129, NULL, NULL),
(42, 17, 129, NULL, NULL),
(43, 18, 129, NULL, NULL),
(44, 19, 129, NULL, NULL),
(45, 20, 129, NULL, NULL),
(46, 21, 130, NULL, NULL),
(47, 22, 130, NULL, NULL),
(48, 23, 130, NULL, NULL),
(49, 24, 130, NULL, NULL),
(50, 25, 130, NULL, NULL),
(51, 1, 131, NULL, NULL),
(52, 2, 131, NULL, NULL),
(53, 3, 131, NULL, NULL),
(54, 4, 131, NULL, NULL),
(55, 5, 131, NULL, NULL),
(56, 6, 132, NULL, NULL),
(57, 7, 132, NULL, NULL),
(58, 8, 132, NULL, NULL),
(59, 9, 132, NULL, NULL),
(60, 10, 132, NULL, NULL),
(61, 11, 133, NULL, NULL),
(62, 12, 133, NULL, NULL),
(63, 13, 133, NULL, NULL),
(64, 14, 133, NULL, NULL),
(65, 15, 133, NULL, NULL),
(66, 16, 134, NULL, NULL),
(67, 17, 134, NULL, NULL),
(68, 18, 134, NULL, NULL),
(69, 19, 134, NULL, NULL),
(70, 20, 134, NULL, NULL),
(71, 21, 135, NULL, NULL),
(72, 22, 135, NULL, NULL),
(73, 23, 135, NULL, NULL),
(74, 24, 135, NULL, NULL),
(75, 25, 135, NULL, NULL),
(76, 1, 136, NULL, NULL),
(77, 2, 136, NULL, NULL),
(78, 3, 136, NULL, NULL),
(79, 4, 136, NULL, NULL),
(80, 5, 136, NULL, NULL),
(81, 6, 137, NULL, NULL),
(82, 7, 137, NULL, NULL),
(83, 8, 137, NULL, NULL),
(84, 9, 137, NULL, NULL),
(85, 10, 137, NULL, NULL),
(86, 11, 138, NULL, NULL),
(87, 12, 138, NULL, NULL),
(88, 13, 138, NULL, NULL),
(89, 14, 138, NULL, NULL),
(90, 15, 138, NULL, NULL),
(91, 16, 139, NULL, NULL),
(92, 17, 139, NULL, NULL),
(93, 18, 139, NULL, NULL),
(94, 19, 139, NULL, NULL),
(95, 20, 139, NULL, NULL),
(96, 21, 140, NULL, NULL),
(97, 22, 140, NULL, NULL),
(98, 23, 140, NULL, NULL),
(99, 24, 140, NULL, NULL),
(100, 25, 140, NULL, NULL),
(101, 1, 141, NULL, NULL),
(102, 2, 141, NULL, NULL),
(103, 3, 141, NULL, NULL),
(104, 4, 141, NULL, NULL),
(105, 5, 141, NULL, NULL),
(106, 6, 142, NULL, NULL),
(107, 7, 142, NULL, NULL),
(108, 8, 142, NULL, NULL),
(109, 9, 142, NULL, NULL),
(110, 10, 142, NULL, NULL),
(111, 11, 143, NULL, NULL),
(112, 12, 143, NULL, NULL),
(113, 13, 143, NULL, NULL),
(114, 14, 143, NULL, NULL),
(115, 15, 143, NULL, NULL),
(116, 16, 144, NULL, NULL),
(117, 17, 144, NULL, NULL),
(118, 18, 144, NULL, NULL),
(119, 19, 144, NULL, NULL),
(120, 20, 144, NULL, NULL),
(121, 21, 145, NULL, NULL),
(122, 22, 145, NULL, NULL),
(123, 23, 145, NULL, NULL),
(124, 24, 145, NULL, NULL),
(125, 25, 145, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `thongkes`
--

CREATE TABLE `thongkes` (
  `id` int UNSIGNED NOT NULL,
  `sinhvien_id` int UNSIGNED NOT NULL,
  `diemrl` float DEFAULT '0',
  `hocbong` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thongke_hocky_id` int UNSIGNED DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `thongkes`
--

INSERT INTO `thongkes` (`id`, `sinhvien_id`, `diemrl`, `hocbong`, `thongke_hocky_id`) VALUES
(26, 121, 95, 'Xuất sắc', 1),
(27, 122, 92, 'Giỏi', 1),
(28, 123, 97, 'Xuất sắc', 1),
(29, 124, 94, 'Giỏi', 2),
(30, 125, 96, 'Xuất sắc', 2),
(31, 126, 91, 'Giỏi', 2),
(32, 127, 93, 'Giỏi', 1),
(33, 128, 98, 'Xuất sắc', 2),
(34, 129, 99, 'Xuất sắc', 1),
(35, 130, 100, 'Xuất sắc', 2),
(36, 131, 95, 'Xuất sắc', 1),
(37, 132, 92, 'Giỏi', 2),
(38, 133, 97, 'Xuất sắc', 2),
(39, 134, 94, 'Giỏi', 1),
(40, 135, 96, 'Xuất sắc', 2),
(41, 136, 91, 'Giỏi', 1),
(42, 137, 93, 'Giỏi', 2),
(43, 138, 98, 'Xuất sắc', 2),
(44, 139, 99, 'Xuất sắc', 2),
(45, 140, 100, 'Xuất sắc', 1),
(46, 141, 95, 'Xuất sắc', 1),
(47, 142, 92, 'Giỏi', 2),
(48, 143, 97, 'Xuất sắc', 2),
(49, 144, 94, 'Giỏi', 1),
(50, 145, 96, 'Xuất sắc', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` int NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `checkcodeemail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `picture`, `level`, `remember_token`, `created_at`, `updated_at`, `checkcodeemail`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$xRFsfZBnRzl8sqiTREW7.ezlVb/Dd9DbcuQGxPjebMRgQKCZbbhv.', 'admin.png', 0, NULL, NULL, NULL, NULL),
(2, 'user', 'user@gmail.com', '$2y$10$xRFsfZBnRzl8sqiTREW7.ezlVb/Dd9DbcuQGxPjebMRgQKCZbbhv.', 'user.png', 1, NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `diems`
--
ALTER TABLE `diems`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `diems_madiem_unique` (`madiem`),
  ADD KEY `diems_sinhvien_id_foreign` (`sinhvien_id`),
  ADD KEY `diems_monhoc_id_foreign` (`monhoc_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `giangviens`
--
ALTER TABLE `giangviens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `giangviens_magv_unique` (`magv`);

--
-- Indexes for table `hockys`
--
ALTER TABLE `hockys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `khoas`
--
ALTER TABLE `khoas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lops`
--
ALTER TABLE `lops`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `lops_malop_unique` (`malop`),
  ADD KEY `lops_khoa_id_foreign` (`khoa_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `monhocs`
--
ALTER TABLE `monhocs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `monhocs_mamon_unique` (`mamon`),
  ADD KEY `monhocs_hocky_id_foreign` (`hocky_id`);

--
-- Indexes for table `monhoc_lop`
--
ALTER TABLE `monhoc_lop`
  ADD PRIMARY KEY (`id`),
  ADD KEY `monhoc_lop_monhoc_id_foreign` (`monhoc_id`),
  ADD KEY `monhoc_lop_lop_id_foreign` (`lop_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `phancong`
--
ALTER TABLE `phancong`
  ADD KEY `phancong_monhoc_id_foreign` (`monhoc_id`),
  ADD KEY `phancong_lop_id_foreign` (`lop_id`),
  ADD KEY `phancong_giangvien_id_foreign` (`giangvien_id`);

--
-- Indexes for table `sinhviens`
--
ALTER TABLE `sinhviens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sinhviens_masv_unique` (`masv`),
  ADD KEY `sinhviens_lop_id_foreign` (`lop_id`);

--
-- Indexes for table `sinhvien_monhoc`
--
ALTER TABLE `sinhvien_monhoc`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sinhvien_monhoc_monhoc_id_foreign` (`monhoc_id`),
  ADD KEY `sinhvien_monhoc_sinhvien_id_foreign` (`sinhvien_id`);

--
-- Indexes for table `thongkes`
--
ALTER TABLE `thongkes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sinhvien_id` (`sinhvien_id`),
  ADD KEY `thongke_hocky_id` (`thongke_hocky_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `diems`
--
ALTER TABLE `diems`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `giangviens`
--
ALTER TABLE `giangviens`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `hockys`
--
ALTER TABLE `hockys`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `khoas`
--
ALTER TABLE `khoas`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `lops`
--
ALTER TABLE `lops`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `monhocs`
--
ALTER TABLE `monhocs`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `monhoc_lop`
--
ALTER TABLE `monhoc_lop`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sinhviens`
--
ALTER TABLE `sinhviens`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=161;

--
-- AUTO_INCREMENT for table `sinhvien_monhoc`
--
ALTER TABLE `sinhvien_monhoc`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- AUTO_INCREMENT for table `thongkes`
--
ALTER TABLE `thongkes`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `diems`
--
ALTER TABLE `diems`
  ADD CONSTRAINT `diems_monhoc_id_foreign` FOREIGN KEY (`monhoc_id`) REFERENCES `monhocs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `diems_sinhvien_id_foreign` FOREIGN KEY (`sinhvien_id`) REFERENCES `sinhviens` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `lops`
--
ALTER TABLE `lops`
  ADD CONSTRAINT `lops_khoa_id_foreign` FOREIGN KEY (`khoa_id`) REFERENCES `khoas` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `monhocs`
--
ALTER TABLE `monhocs`
  ADD CONSTRAINT `monhocs_hocky_id_foreign` FOREIGN KEY (`hocky_id`) REFERENCES `hockys` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `monhoc_lop`
--
ALTER TABLE `monhoc_lop`
  ADD CONSTRAINT `monhoc_lop_lop_id_foreign` FOREIGN KEY (`lop_id`) REFERENCES `lops` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `monhoc_lop_monhoc_id_foreign` FOREIGN KEY (`monhoc_id`) REFERENCES `monhocs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `phancong`
--
ALTER TABLE `phancong`
  ADD CONSTRAINT `phancong_giangvien_id_foreign` FOREIGN KEY (`giangvien_id`) REFERENCES `giangviens` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `phancong_lop_id_foreign` FOREIGN KEY (`lop_id`) REFERENCES `lops` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `phancong_monhoc_id_foreign` FOREIGN KEY (`monhoc_id`) REFERENCES `monhocs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sinhviens`
--
ALTER TABLE `sinhviens`
  ADD CONSTRAINT `sinhviens_lop_id_foreign` FOREIGN KEY (`lop_id`) REFERENCES `lops` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sinhvien_monhoc`
--
ALTER TABLE `sinhvien_monhoc`
  ADD CONSTRAINT `sinhvien_monhoc_monhoc_id_foreign` FOREIGN KEY (`monhoc_id`) REFERENCES `monhocs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sinhvien_monhoc_sinhvien_id_foreign` FOREIGN KEY (`sinhvien_id`) REFERENCES `sinhviens` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `thongkes`
--
ALTER TABLE `thongkes`
  ADD CONSTRAINT `sinhvien_id` FOREIGN KEY (`sinhvien_id`) REFERENCES `sinhviens` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `thongke_hocky_id` FOREIGN KEY (`thongke_hocky_id`) REFERENCES `hockys` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
