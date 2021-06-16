-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th6 16, 2021 lúc 05:41 PM
-- Phiên bản máy phục vụ: 10.4.11-MariaDB
-- Phiên bản PHP: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `men_fashion`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `phone`, `email_verified_at`, `password`, `avatar`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', '0355123450', NULL, '$2y$10$.g6QYH.abH3Hr5Os9emXw.MKeE/3M4xKGfNWXDoA7iJF.AyMxDaNS', NULL, NULL, NULL, NULL),
(2, 'Nguyen Sy Khai', 'admin1@gmail.com', '0123456789', NULL, '$2y$10$.g6QYH.abH3Hr5Os9emXw.MKeE/3M4xKGfNWXDoA7iJF.AyMxDaNS', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug_category_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `menu_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `slug_category_name`, `menu_id`, `created_at`, `updated_at`) VALUES
(2, 'Áo', 'ao', 2, NULL, NULL),
(3, 'Quần', 'quan', 2, NULL, NULL),
(4, 'Đồ lót', 'do-lot', 2, NULL, NULL),
(5, 'Phụ kiện', 'phu-kien', 2, NULL, NULL),
(6, 'Combo', 'combo', 2, NULL, NULL),
(11, 'Kidman', 'kidman', 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `coupons_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coupons_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coupons_discount` int(11) DEFAULT NULL,
  `coupons_type_id` int(11) DEFAULT NULL,
  `coupons_max` int(11) DEFAULT NULL,
  `coupons_count` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `coupons`
--

INSERT INTO `coupons` (`id`, `coupons_code`, `coupons_name`, `coupons_discount`, `coupons_type_id`, `coupons_max`, `coupons_count`, `created_at`, `updated_at`) VALUES
(1, 'FANUMBER1', 'Lễ độc thân', 100000, 2, 100000, 10, NULL, NULL),
(2, 'FANUMBER2', 'Độc thân vui vẻ', 50, 1, 200000, 10, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `coupons_type`
--

CREATE TABLE `coupons_type` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `coupon_type_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `coupon_type_character` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `coupons_type`
--

INSERT INTO `coupons_type` (`id`, `coupon_type_name`, `coupon_type_character`, `created_at`, `updated_at`) VALUES
(1, 'Giảm theo phần trăm', '%', NULL, NULL),
(2, 'Giảm theo giá trị', '+', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `menu`
--

CREATE TABLE `menu` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `menu_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug_menu_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `menu`
--

INSERT INTO `menu` (`id`, `menu_name`, `slug_menu_name`, `created_at`, `updated_at`) VALUES
(1, 'Trang chủ', 'trang-chu', NULL, NULL),
(2, 'Sản phẩm', 'san-pham', NULL, NULL),
(3, 'Bộ sưu tập', 'bo-suu-tap', NULL, NULL),
(4, 'Tin tức', 'tin-tuc', NULL, NULL),
(5, 'Đồng phục', 'dong-phuc', NULL, NULL),
(6, 'Liên hệ', 'lien-he', NULL, NULL);

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
(13, '2014_10_12_000000_create_users_table', 1),
(14, '2014_10_12_100000_create_password_resets_table', 1),
(15, '2019_08_19_000000_create_failed_jobs_table', 1),
(16, '2021_05_23_202644_create_admins_table', 1),
(17, '2021_05_24_154358_create_menu_table', 1),
(18, '2021_05_24_222623_create_categories_table', 2),
(19, '2021_05_24_222701_create_subcategories_table', 2),
(20, '2021_05_26_205828_create_products_table', 3),
(21, '2021_05_26_210014_create_product_detail_table', 3),
(22, '2021_06_01_220426_create_orders_table', 4),
(23, '2021_06_01_220506_create_orders_detail_table', 4),
(24, '2021_06_01_220606_create_orders_shipping_table', 4),
(25, '2021_06_01_222511_create_orders_pay_stripe_table', 4),
(26, '2021_06_02_004943_create_coupons_table', 4),
(27, '2021_06_02_013714_create_coupons_type_table', 4);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `order_code` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_subtotal` int(11) DEFAULT NULL,
  `order_shipping` int(11) DEFAULT NULL,
  `order_vat` int(11) DEFAULT NULL,
  `order_sale` int(11) DEFAULT NULL,
  `order_coupons` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_total` int(11) DEFAULT NULL,
  `order_status` int(11) DEFAULT 0,
  `order_day` int(11) DEFAULT NULL,
  `order_month` int(11) DEFAULT NULL,
  `order_year` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `order_code`, `payment_type`, `order_subtotal`, `order_shipping`, `order_vat`, `order_sale`, `order_coupons`, `order_total`, `order_status`, `order_day`, `order_month`, `order_year`, `created_at`, `updated_at`) VALUES
(16, 15, '341766', 'cod', 500000, 30000, 0, 100000, '100000', 330000, 4, 3, 6, 2021, '2021-06-02 17:00:00', NULL),
(17, 15, '972061', 'cod', 500000, 30000, 0, 100000, '0', 430000, 1, 3, 6, 2021, '2021-06-02 17:00:00', NULL),
(18, 15, '147344', 'cod', 500000, 30000, 0, 0, '0', 530000, 2, 3, 6, 2021, '2021-06-02 17:00:00', NULL),
(19, 15, '315427', 'cod', 1350000, 30000, 0, 0, '0', 1380000, 3, 3, 6, 2021, '2021-06-02 17:00:00', NULL),
(20, 15, '231561', 'cod', 1000000, 30000, 0, 0, '0', 1030000, 4, 3, 6, 2021, '2021-06-02 17:00:00', NULL),
(22, 15, '654982', 'cod', 1700000, 30000, 0, 0, '0', 1730000, 5, 3, 6, 2021, '2021-06-03 17:00:00', NULL),
(23, 15, '121311', 'cod', 1000000, 30000, 0, 200000, '200000', 630000, 5, 6, 6, 2021, '2021-06-06 05:27:58', NULL),
(24, 15, '705599', 'stripe', 1000000, 30000, 0, 100000, '0', 930000, 0, 9, 6, 2021, '2021-06-09 10:38:22', NULL),
(25, 15, '940174', 'stripe', 1000000, 30000, 0, 100000, '0', 930000, 0, 9, 6, 2021, '2021-06-09 10:38:25', NULL),
(26, 15, '977111', 'cod', 800000, 30000, 0, 0, '0', 830000, 0, 9, 6, 2021, '2021-06-09 10:39:47', NULL),
(27, 15, '303694', 'cod', 6000000, 30000, 0, 600000, '0', 5430000, 3, 9, 6, 2021, '2021-06-09 14:48:29', NULL),
(28, 15, '231146', 'cod', 2000000, 30000, 0, 400000, '0', 1630000, 0, 9, 6, 2021, '2021-06-09 16:15:48', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders_detail`
--

CREATE TABLE `orders_detail` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `singleprice` int(11) DEFAULT NULL,
  `singlesale` int(11) DEFAULT NULL,
  `totalprice` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `orders_detail`
--

INSERT INTO `orders_detail` (`id`, `order_id`, `product_id`, `product_name`, `color`, `size`, `quantity`, `singleprice`, `singlesale`, `totalprice`, `created_at`, `updated_at`) VALUES
(16, 16, 27, 'ÁO POLO NAM ARISTINO APS025S1', 'Đen', 'S', 1, 500000, 100000, 400000, NULL, NULL),
(17, 17, 27, 'ÁO POLO NAM ARISTINO APS025S1', 'Đen', 'S', 1, 500000, 100000, 400000, NULL, NULL),
(18, 18, 30, 'ÁO SƠ MI NGẮN TAY NAM ARISTINO ASS127S1', 'Trắng in họa tiết chấm', '40', 1, 500000, 0, 500000, NULL, NULL),
(19, 19, 29, 'ÁO SƠ MI DÀI TAY NAM ARISTINO ALS13001', 'Xanh nhạt in họa tiết gạch', '41', 3, 450000, 0, 1350000, NULL, NULL),
(20, 20, 30, 'ÁO SƠ MI NGẮN TAY NAM ARISTINO ASS127S1', 'Trắng in họa tiết chấm', '40', 2, 500000, 0, 1000000, NULL, NULL),
(25, 22, 29, 'ÁO SƠ MI DÀI TAY NAM ARISTINO ALS13001', 'Xanh nhạt in họa tiết gạch', '41', 2, 450000, 0, 900000, NULL, NULL),
(26, 22, 28, 'ÁO SƠ MI DÀI TAY NAM ARISTINO ASS129S1', 'Trắng in họa tiết xanh lá', '42', 2, 400000, 0, 800000, NULL, NULL),
(27, 23, 27, 'ÁO POLO NAM ARISTINO APS025S1', 'Xanh', 'XL', 2, 500000, 100000, 800000, NULL, NULL),
(28, 24, 27, 'ÁO POLO NAM ARISTINO APS025S1', 'Đen', 'XL', 1, 500000, 100000, 400000, NULL, NULL),
(29, 24, 30, 'ÁO SƠ MI NGẮN TAY NAM ARISTINO ASS127S1', 'Trắng in họa tiết chấm', '39', 1, 500000, 0, 500000, NULL, NULL),
(30, 25, 27, 'ÁO POLO NAM ARISTINO APS025S1', 'Đen', 'XL', 1, 500000, 100000, 400000, NULL, NULL),
(31, 25, 30, 'ÁO SƠ MI NGẮN TAY NAM ARISTINO ASS127S1', 'Trắng in họa tiết chấm', '39', 1, 500000, 0, 500000, NULL, NULL),
(32, 26, 28, 'ÁO SƠ MI DÀI TAY NAM ARISTINO ASS129S1', 'Trắng in họa tiết xanh lá', '39', 2, 400000, 0, 800000, NULL, NULL),
(33, 27, 28, 'ÁO SƠ MI DÀI TAY NAM ARISTINO ASS129S1', 'Trắng in họa tiết xanh lá', '39', 4, 400000, 0, 1600000, NULL, NULL),
(34, 27, 27, 'ÁO POLO NAM ARISTINO APS025S1', 'Đen', 'XL', 2, 500000, 100000, 800000, NULL, NULL),
(35, 27, 27, 'ÁO POLO NAM ARISTINO APS025S1', 'Xanh', 'M', 2, 500000, 100000, 800000, NULL, NULL),
(36, 27, 27, 'ÁO POLO NAM ARISTINO APS025S1', 'Trắng', 'L', 2, 500000, 100000, 800000, NULL, NULL),
(37, 27, 29, 'ÁO SƠ MI DÀI TAY NAM ARISTINO ALS13001', 'Xanh nhạt in họa tiết gạch', '41', 2, 450000, 0, 900000, NULL, NULL),
(38, 27, 30, 'ÁO SƠ MI NGẮN TAY NAM ARISTINO ASS127S1', 'Trắng in họa tiết chấm', '39', 1, 500000, 0, 500000, NULL, NULL),
(39, 28, 27, 'ÁO POLO NAM ARISTINO APS025S1', 'Trắng', 'S', 2, 500000, 100000, 800000, NULL, NULL),
(40, 28, 27, 'ÁO POLO NAM ARISTINO APS025S1', 'Trắng', 'M', 2, 500000, 100000, 800000, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders_pay_stripe`
--

CREATE TABLE `orders_pay_stripe` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` int(11) NOT NULL,
  `stripe_payment_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stripe_payment_amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stripe_blnc_transaction` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stripe_order_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `orders_pay_stripe`
--

INSERT INTO `orders_pay_stripe` (`id`, `order_id`, `stripe_payment_id`, `stripe_payment_amount`, `stripe_blnc_transaction`, `stripe_order_id`, `created_at`, `updated_at`) VALUES
(2, 25, 'card_1J0OnlGuw3rAuQaWrHnrDSTs', '930000', 'txn_1J0OnnGuw3rAuQaW9TqtjAfV', 'card_1J0OnlGuw3rAuQaWrHnrDSTs', NULL, NULL),
(3, 24, 'card_1J0OnjGuw3rAuQaWF99vExCG', '930000', 'txn_1J0OnnGuw3rAuQaWDmjes32e', 'card_1J0OnjGuw3rAuQaWF99vExCG', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders_shipping`
--

CREATE TABLE `orders_shipping` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` int(11) NOT NULL,
  `ship_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ship_phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ship_address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ship_deliveryTime` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ship_note` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `orders_shipping`
--

INSERT INTO `orders_shipping` (`id`, `order_id`, `ship_name`, `ship_phone`, `ship_address`, `ship_deliveryTime`, `ship_note`, `created_at`, `updated_at`) VALUES
(13, 16, 'Nguyen Sy Khai', '0355123450', 'Số 40, Ngõ 122 Phường Khương Đình Quận Thanh Xuân Thành phố Hà Nội', 'Giờ hành chính', NULL, NULL, NULL),
(14, 17, 'Nguyen Sy Khai', '0355123450', 'Số 40, Ngõ 122 Phường Khương Đình Quận Thanh Xuân Thành phố Hà Nội', 'Giờ hành chính', NULL, NULL, NULL),
(15, 18, 'Nguyen Sy Khai', '0355123450', 'Số 40, Ngõ 122 Phường Khương Đình Quận Thanh Xuân Thành phố Hà Nội', 'Giờ hành chính', 'aaa', NULL, NULL),
(16, 19, 'Nguyen Sy Khai', '0355123450', 'Số 40, Ngõ 122 Phường Khương Đình Quận Thanh Xuân Thành phố Hà Nội', 'Giờ hành chính', NULL, NULL, NULL),
(17, 20, 'Nguyen Sy Khai', '0355123450', 'Số 40, Ngõ 122 Phường Khương Đình Quận Thanh Xuân Thành phố Hà Nội', 'Giờ hành chính', 'aaaaaa', NULL, NULL),
(19, 22, 'Nguyen Sy Khai', '0355123450', 'Số 40, Ngõ 122 Phường Khương Đình Quận Thanh Xuân Thành phố Hà Nội', 'Giờ hành chính', NULL, NULL, NULL),
(20, 23, 'Nguyen Sy Khai', '0355123450', 'Số 40, Ngõ 122 Phường La Khê Quận Hà Đông Thành phố Hà Nội', 'Giờ hành chính', 'sấ', NULL, NULL),
(21, 24, 'Nguyen Sy Khai', '0355123450', 'Số 40, Ngõ 122 Phường 03 Quận 4 Thành phố Hồ Chí Minh', 'Ngoài giờ hành chính', 'qqq', NULL, NULL),
(22, 25, 'Nguyen Sy Khai', '0355123450', 'Số 40, Ngõ 122 Phường 03 Quận 4 Thành phố Hồ Chí Minh', 'Ngoài giờ hành chính', 'qqq', NULL, NULL),
(23, 26, 'Nguyen Sy Khai', '0355123450', 'Số 40, Ngõ 122 Xã Ea Pô Huyện Cư Jút Tỉnh Đắk Nông', 'Giờ hành chính', 'qqqqq', NULL, NULL),
(24, 27, 'Nguyen Sy Khai', '0355123450', 'Số 40, Ngõ 122 Xã Thọ An Huyện Đan Phượng Thành phố Hà Nội', 'Giờ hành chính', NULL, NULL, NULL),
(25, 28, 'Nguyen Sy Khai', '0355123450', 'Số 40, Ngõ 122 Xã Gia Tân 2 Huyện Thống Nhất Tỉnh Đồng Nai', 'Giờ hành chính', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('khainguyensi.19981@gmail.com', '$2y$10$yLvT9bIi7BjXKuHuiEU9H.peNb/U.ItcUGnBOCqL7ST0VAT/khcXS', '2021-06-09 09:59:07');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug_product_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `subcategory_id` int(11) DEFAULT NULL,
  `product_price` int(11) DEFAULT NULL,
  `discount_price` int(11) DEFAULT NULL,
  `product_status` int(11) DEFAULT 1,
  `product_view` int(11) DEFAULT 0,
  `product_sold` int(11) DEFAULT 0,
  `hot_deal` int(11) DEFAULT 0,
  `hot_new` int(11) DEFAULT 0,
  `trend` int(11) DEFAULT 0,
  `product_avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_images_big` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_images_small` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_color_name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_image_color` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_content` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `product_name`, `slug_product_name`, `product_code`, `category_id`, `subcategory_id`, `product_price`, `discount_price`, `product_status`, `product_view`, `product_sold`, `hot_deal`, `hot_new`, `trend`, `product_avatar`, `product_images_big`, `product_images_small`, `product_color_name`, `product_image_color`, `product_content`, `created_at`, `updated_at`) VALUES
(27, 'ÁO POLO NAM ARISTINO APS025S1', 'ao-polo-nam-aristino-aps025s1', 'APS025S1', 2, 2, 500000, 20, 1, 0, 21, NULL, 1, 1, 'public/backend/media/product/avatar/ao-polo-nam-aristino-aps025s1-avatar.jpg', 'public/backend/media/product/images/ao-polo-nam-aristino-aps025s1-1.jpg|public/backend/media/product/images/ao-polo-nam-aristino-aps025s1-2.jpg|public/backend/media/product/images/ao-polo-nam-aristino-aps025s1-3.jpg|public/backend/media/product/images/ao-polo-nam-aristino-aps025s1-4.jpg|public/backend/media/product/images/ao-polo-nam-aristino-aps025s1-5.jpg|public/backend/media/product/images/ao-polo-nam-aristino-aps025s1-6.jpg|public/backend/media/product/images/ao-polo-nam-aristino-aps025s1-7.jpg|public/backend/media/product/images/ao-polo-nam-aristino-aps025s1-8.jpg|public/backend/media/product/images/ao-polo-nam-aristino-aps025s1-9.jpg|public/backend/media/product/images/ao-polo-nam-aristino-aps025s1-10.jpg|public/backend/media/product/images/ao-polo-nam-aristino-aps025s1-11.jpg|public/backend/media/product/images/ao-polo-nam-aristino-aps025s1-12.jpg|public/backend/media/product/images/ao-polo-nam-aristino-aps025s1-13.jpg|public/backend/media/product/images/ao-polo-nam-aristino-aps025s1-14.jpg|public/backend/media/product/images/ao-polo-nam-aristino-aps025s1-15.jpg|public/backend/media/product/images/ao-polo-nam-aristino-aps025s1-16.jpg|public/backend/media/product/images/ao-polo-nam-aristino-aps025s1-17.jpg|public/backend/media/product/images/ao-polo-nam-aristino-aps025s1-18.jpg|public/backend/media/product/images/ao-polo-nam-aristino-aps025s1-19.jpg|public/backend/media/product/images/ao-polo-nam-aristino-aps025s1-20.jpg', 'public/backend/media/product/images_small/ao-polo-nam-aristino-aps025s1-small-1.jpg|public/backend/media/product/images_small/ao-polo-nam-aristino-aps025s1-small-2.jpg|public/backend/media/product/images_small/ao-polo-nam-aristino-aps025s1-small-3.jpg|public/backend/media/product/images_small/ao-polo-nam-aristino-aps025s1-small-4.jpg', 'Đen,Đỏ,Xanh,Trắng', 'public/backend/media/product/images_color/ao-polo-nam-aristino-aps025s1-color-1.jpg|public/backend/media/product/images_color/ao-polo-nam-aristino-aps025s1-color-2.jpg|public/backend/media/product/images_color/ao-polo-nam-aristino-aps025s1-color-3.jpg|public/backend/media/product/images_color/ao-polo-nam-aristino-aps025s1-color-4.jpg', '<p style=\"box-sizing: border-box; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(17, 17, 17); font-family: Roboto, Arial, sans-serif; font-size: 13px;\"><span style=\"box-sizing: border-box; font-weight: 700;\">KIỂU DÁNG:</span>&nbsp;REGULAR FIT</p><p style=\"box-sizing: border-box; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(17, 17, 17); font-family: Roboto, Arial, sans-serif; font-size: 13px;\"><span style=\"box-sizing: border-box; font-weight: 700;\">CHI TIẾT:</span></p><p style=\"box-sizing: border-box; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(17, 17, 17); font-family: Roboto, Arial, sans-serif; font-size: 13px;\">- Áo polo phom dáng Regular Fit có độ suông vừa đủ, đảm bảo sự thoải mái mà vẫn vừa vặn hình thể.</p><p style=\"box-sizing: border-box; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(17, 17, 17); font-family: Roboto, Arial, sans-serif; font-size: 13px;\">- Tay áo thiết kế kiểu raglang khoẻ khoắn, trên tay áo còn được tạo các lỗ đục trang trí bằng công nghệ cắt lazer tiên tiến. Áo màu trung tính, đem đến vô số lựa chọn kết hợp trang phục.</p><p style=\"box-sizing: border-box; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(17, 17, 17); font-family: Roboto, Arial, sans-serif; font-size: 13px;\"><span style=\"box-sizing: border-box; font-weight: 700;\">CHẤT LIỆU:</span></p><p style=\"box-sizing: border-box; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(17, 17, 17); font-family: Roboto, Arial, sans-serif; font-size: 13px;\">- 98% đến từ sợi Polyester giúp áo mỏng nhẹ, bề mặt vải trơn trượt dễ chịu, đồng thời sắc nét và bền màu. Kết hợp thêm 2% sợi Spandex đem tới độ co giãn cho áo.</p><p style=\"box-sizing: border-box; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(17, 17, 17); font-family: Roboto, Arial, sans-serif; font-size: 13px;\"><span style=\"box-sizing: border-box; font-weight: 700;\">MÀU SẮC:&nbsp;</span>Trắng 6, Đen 15, Cam 83, Xám 283</p><p style=\"box-sizing: border-box; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(17, 17, 17); font-family: Roboto, Arial, sans-serif; font-size: 13px;\"><span style=\"box-sizing: border-box; font-weight: 700;\">SIZE:&nbsp;</span>S – M – L – XL – XXL</p>', NULL, NULL),
(28, 'ÁO SƠ MI DÀI TAY NAM ARISTINO ASS129S1', 'ao-so-mi-dai-tay-nam-aristino-ass129s1', 'ASS129S1', 2, 1, 400000, 0, 1, 0, 8, NULL, 1, 1, 'public/backend/media/product/avatar/ao-so-mi-dai-tay-nam-aristino-ass129s1-avatar.jpg', 'public/backend/media/product/images/ao-so-mi-dai-tay-nam-aristino-ass129s1-1.jpg|public/backend/media/product/images/ao-so-mi-dai-tay-nam-aristino-ass129s1-2.jpg|public/backend/media/product/images/ao-so-mi-dai-tay-nam-aristino-ass129s1-3.jpg|public/backend/media/product/images/ao-so-mi-dai-tay-nam-aristino-ass129s1-4.jpg|public/backend/media/product/images/ao-so-mi-dai-tay-nam-aristino-ass129s1-5.jpg', 'public/backend/media/product/images_small/ao-so-mi-dai-tay-nam-aristino-ass129s1-small-1.jpg', 'Trắng in họa tiết xanh lá', 'public/backend/media/product/images_color/ao-so-mi-dai-tay-nam-aristino-ass129s1-color-1.jpg', '<p style=\"box-sizing: border-box; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(17, 17, 17); font-family: Roboto, Arial, sans-serif; font-size: 13px;\"><span style=\"box-sizing: border-box; font-weight: 700;\">KIỂU DÁNG:&nbsp;</span>SLIM FIT - TÀ LƯỢN</p><p style=\"box-sizing: border-box; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(17, 17, 17); font-family: Roboto, Arial, sans-serif; font-size: 13px;\"><span style=\"box-sizing: border-box; font-weight: 700;\">CHI TIẾT:</span></p><p style=\"box-sizing: border-box; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(17, 17, 17); font-family: Roboto, Arial, sans-serif; font-size: 13px;\">- Sơ mi ngắn tay phom dáng Slim Fit ôm nhẹ vừa vặn mà vẫn thoải mái vận động.</p><p style=\"box-sizing: border-box; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(17, 17, 17); font-family: Roboto, Arial, sans-serif; font-size: 13px;\">- Thiết kế basic không túi ngực thoải mái, tà lượn thời trang họa tiết in hoa lá xanh tạo điểm nhấn.</p><p style=\"box-sizing: border-box; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(17, 17, 17); font-family: Roboto, Arial, sans-serif; font-size: 13px;\"><span style=\"box-sizing: border-box; font-weight: 700;\">CHẤT LIỆU:</span></p><p style=\"box-sizing: border-box; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(17, 17, 17); font-family: Roboto, Arial, sans-serif; font-size: 13px;\">- 50% Bamboo từ sợi tre thiên nhiên mang đến sự thoáng mát, thấm hút tốt và tạo cảm giác thoải mái.</p><p style=\"box-sizing: border-box; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(17, 17, 17); font-family: Roboto, Arial, sans-serif; font-size: 13px;\">- 50% Polyspun giúp tiết kiệm tối đa thời gian cho chuyện là ủi nhờ khả năng đàn hồi tự nhiên và ít nhăn co trong suốt quá trình sử dụng.</p><p style=\"box-sizing: border-box; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(17, 17, 17); font-family: Roboto, Arial, sans-serif; font-size: 13px;\"><span style=\"box-sizing: border-box; font-weight: 700;\">MÀU SẮC:&nbsp;</span>Trắng in họa tiết lá xanh</p><p style=\"box-sizing: border-box; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(17, 17, 17); font-family: Roboto, Arial, sans-serif; font-size: 13px;\"><span style=\"box-sizing: border-box; font-weight: 700;\">SIZE:&nbsp;</span>&nbsp;38 – 39 – 40 – 41 – 42 – 43</p>', NULL, NULL),
(29, 'ÁO SƠ MI DÀI TAY NAM ARISTINO ALS13001', 'ao-so-mi-dai-tay-nam-aristino-als13001', 'ALS13001', 2, 1, 450000, 0, 1, 0, 7, NULL, 1, 1, 'public/backend/media/product/avatar/ao-so-mi-dai-tay-nam-aristino-als13001-avatar.jpg', 'public/backend/media/product/images/ao-so-mi-dai-tay-nam-aristino-als13001-1.jpg|public/backend/media/product/images/ao-so-mi-dai-tay-nam-aristino-als13001-2.jpg|public/backend/media/product/images/ao-so-mi-dai-tay-nam-aristino-als13001-3.jpg|public/backend/media/product/images/ao-so-mi-dai-tay-nam-aristino-als13001-4.jpg|public/backend/media/product/images/ao-so-mi-dai-tay-nam-aristino-als13001-5.jpg', 'public/backend/media/product/images_small/ao-so-mi-dai-tay-nam-aristino-als13001-small-1.jpg', 'Xanh nhạt in họa tiết gạch', 'public/backend/media/product/images_color/ao-so-mi-dai-tay-nam-aristino-als13001-color-1.jpg', '<p style=\"box-sizing: border-box; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(17, 17, 17); font-family: Roboto, Arial, sans-serif; font-size: 13px;\"><span style=\"box-sizing: border-box; font-weight: 700;\">KIỂU DÁNG:&nbsp;</span>SLIM FIT - TÀ LƯỢN</p><p style=\"box-sizing: border-box; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(17, 17, 17); font-family: Roboto, Arial, sans-serif; font-size: 13px;\"><span style=\"box-sizing: border-box; font-weight: 700;\">CHI TIẾT:</span></p><p style=\"box-sizing: border-box; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(17, 17, 17); font-family: Roboto, Arial, sans-serif; font-size: 13px;\">- Áo sơ mi dài tay phom Slim fit ôm nhẹ, tôn dáng.</p><p style=\"box-sizing: border-box; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(17, 17, 17); font-family: Roboto, Arial, sans-serif; font-size: 13px;\">- Áo thiết kế tà lượn, không có túi ngực, in họa tiết gạch trên nền xanh nhạt độc đáo.</p><p style=\"box-sizing: border-box; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(17, 17, 17); font-family: Roboto, Arial, sans-serif; font-size: 13px;\"><span style=\"box-sizing: border-box; font-weight: 700;\">CHẤT LIỆU:</span></p><p style=\"box-sizing: border-box; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(17, 17, 17); font-family: Roboto, Arial, sans-serif; font-size: 13px;\">- 38% Modal giúp bề mặt vải mềm mại, thấm hút tốt</p><p style=\"box-sizing: border-box; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(17, 17, 17); font-family: Roboto, Arial, sans-serif; font-size: 13px;\">- 24% Cotton đem đến độ xốp nhẹ, đứng dáng vừa đủ.</p><p style=\"box-sizing: border-box; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(17, 17, 17); font-family: Roboto, Arial, sans-serif; font-size: 13px;\">- 38 Polyester giúp áo có màu sắc nét và giữ màu theo thời gian.</p><p style=\"box-sizing: border-box; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(17, 17, 17); font-family: Roboto, Arial, sans-serif; font-size: 13px;\"><span style=\"box-sizing: border-box; font-weight: 700;\">MÀU SẮC:&nbsp;</span>Xanh nhạt in họa tiết gạch</p><p style=\"box-sizing: border-box; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(17, 17, 17); font-family: Roboto, Arial, sans-serif; font-size: 13px;\"><span style=\"box-sizing: border-box; font-weight: 700;\">SIZE:&nbsp;</span>&nbsp;38 – 39 – 40 – 41 – 42 – 43</p>', NULL, NULL),
(30, 'ÁO SƠ MI NGẮN TAY NAM ARISTINO ASS127S1', 'ao-so-mi-ngan-tay-nam-aristino-ass127s1', 'ASS127S1', 2, 1, 500000, 0, 1, 0, 10, NULL, 1, 1, 'public/backend/media/product/avatar/ao-so-mi-ngan-tay-nam-aristino-ass127s1-avatar.jpg', 'public/backend/media/product/images/ao-so-mi-ngan-tay-nam-aristino-ass127s1-1.jpg|public/backend/media/product/images/ao-so-mi-ngan-tay-nam-aristino-ass127s1-2.jpg|public/backend/media/product/images/ao-so-mi-ngan-tay-nam-aristino-ass127s1-3.jpg|public/backend/media/product/images/ao-so-mi-ngan-tay-nam-aristino-ass127s1-4.jpg|public/backend/media/product/images/ao-so-mi-ngan-tay-nam-aristino-ass127s1-5.jpg', 'public/backend/media/product/images_small/ao-so-mi-ngan-tay-nam-aristino-ass127s1-small-1.jpg', 'Trắng in họa tiết chấm', 'public/backend/media/product/images_color/ao-so-mi-ngan-tay-nam-aristino-ass127s1-color-1.jpg', '<p style=\"box-sizing: border-box; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(17, 17, 17); font-family: Roboto, Arial, sans-serif; font-size: 13px;\"><span style=\"box-sizing: border-box; font-weight: 700;\">KIỂU DÁNG:</span>&nbsp;REGULAR FIT - TÀ LƯỢN</p><p style=\"box-sizing: border-box; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(17, 17, 17); font-family: Roboto, Arial, sans-serif; font-size: 13px;\"><span style=\"box-sizing: border-box; font-weight: 700;\">CHI TIẾT:</span></p><p style=\"box-sizing: border-box; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(17, 17, 17); font-family: Roboto, Arial, sans-serif; font-size: 13px;\">- Áo sơ mi ngắn tay phom Regular Fit suông vừa.</p><p style=\"box-sizing: border-box; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(17, 17, 17); font-family: Roboto, Arial, sans-serif; font-size: 13px;\">- Áo thiết kế tà lượn, có túi ngực, màu trắng in họa tiết chấm thanh lịch.</p><p style=\"box-sizing: border-box; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(17, 17, 17); font-family: Roboto, Arial, sans-serif; font-size: 13px;\"><span style=\"box-sizing: border-box; font-weight: 700;\">CHẤT LIỆU:</span></p><p style=\"box-sizing: border-box; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(17, 17, 17); font-family: Roboto, Arial, sans-serif; font-size: 13px;\">- 51% Modal cho bề mặt vải mềm mại, nhẹ và thoáng khí.</p><p style=\"box-sizing: border-box; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(17, 17, 17); font-family: Roboto, Arial, sans-serif; font-size: 13px;\">- 47% Polyester giúp áo bền màu, sắc nét và độ trơn trượt, mỏng nhẹ</p><p style=\"box-sizing: border-box; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(17, 17, 17); font-family: Roboto, Arial, sans-serif; font-size: 13px;\">- 2% Spandex tạo độ co giãn nhẹ</p><p style=\"box-sizing: border-box; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(17, 17, 17); font-family: Roboto, Arial, sans-serif; font-size: 13px;\"><span style=\"box-sizing: border-box; font-weight: 700;\">MÀU SẮC:&nbsp;</span>Trắng in họa tiết chấm</p><p style=\"box-sizing: border-box; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(17, 17, 17); font-family: Roboto, Arial, sans-serif; font-size: 13px;\"><span style=\"box-sizing: border-box; font-weight: 700;\">SIZE:&nbsp;</span>&nbsp;38 – 39 – 40 – 41 – 42 – 43</p>', NULL, NULL),
(32, 'ÁO POLO NAM ARISTINO APS018S1', 'ao-polo-nam-aristino-aps018s1', 'APS018S1', 2, 2, 250000, 0, 1, 0, 0, NULL, 1, NULL, 'public/backend/media/product/avatar/ao-polo-nam-aristino-aps018s1-avatar.jpg', 'public/backend/media/product/images/ao-polo-nam-aristino-aps018s1-1.jpg|public/backend/media/product/images/ao-polo-nam-aristino-aps018s1-2.jpg|public/backend/media/product/images/ao-polo-nam-aristino-aps018s1-3.jpg|public/backend/media/product/images/ao-polo-nam-aristino-aps018s1-4.jpg|public/backend/media/product/images/ao-polo-nam-aristino-aps018s1-5.jpg|public/backend/media/product/images/ao-polo-nam-aristino-aps018s1-6.jpg|public/backend/media/product/images/ao-polo-nam-aristino-aps018s1-7.jpg|public/backend/media/product/images/ao-polo-nam-aristino-aps018s1-8.jpg|public/backend/media/product/images/ao-polo-nam-aristino-aps018s1-9.jpg|public/backend/media/product/images/ao-polo-nam-aristino-aps018s1-10.jpg|public/backend/media/product/images/ao-polo-nam-aristino-aps018s1-11.jpg|public/backend/media/product/images/ao-polo-nam-aristino-aps018s1-12.jpg|public/backend/media/product/images/ao-polo-nam-aristino-aps018s1-13.jpg|public/backend/media/product/images/ao-polo-nam-aristino-aps018s1-14.jpg|public/backend/media/product/images/ao-polo-nam-aristino-aps018s1-15.jpg', 'public/backend/media/product/images_small/ao-polo-nam-aristino-aps018s1-small-1.jpg|public/backend/media/product/images_small/ao-polo-nam-aristino-aps018s1-small-2.jpg|public/backend/media/product/images_small/ao-polo-nam-aristino-aps018s1-small-3.jpg', 'Xanh biển,Xám,Xanh tím than', 'public/backend/media/product/images_color/ao-polo-nam-aristino-aps018s1-color-1.jpg|public/backend/media/product/images_color/ao-polo-nam-aristino-aps018s1-color-2.jpg|public/backend/media/product/images_color/ao-polo-nam-aristino-aps018s1-color-3.jpg', '<p style=\"box-sizing: border-box; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(17, 17, 17); font-family: Roboto, Arial, sans-serif; font-size: 13px;\"><span style=\"box-sizing: border-box; font-weight: 700;\">KIỂU DÁNG:</span>&nbsp;REGULAR FIT</p><p style=\"box-sizing: border-box; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(17, 17, 17); font-family: Roboto, Arial, sans-serif; font-size: 13px;\"><span style=\"box-sizing: border-box; font-weight: 700;\">CHI TIẾT:</span></p><p style=\"box-sizing: border-box; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(17, 17, 17); font-family: Roboto, Arial, sans-serif; font-size: 13px;\">- Áo Polo phom dáng Regular Fit suông nhẹ, có cổ. Áo màu trung tính, thanh lịch.</p><p style=\"box-sizing: border-box; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(17, 17, 17); font-family: Roboto, Arial, sans-serif; font-size: 13px;\"><span style=\"box-sizing: border-box; font-weight: 700;\">KIỂU DÁNG:</span></p><p style=\"box-sizing: border-box; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(17, 17, 17); font-family: Roboto, Arial, sans-serif; font-size: 13px;\">- 100% Polyester mang đến độ bóng sắc nét, không bị bai dão, luôn bền màu.</p><p style=\"box-sizing: border-box; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(17, 17, 17); font-family: Roboto, Arial, sans-serif; font-size: 13px;\">- Áo còn có khả năng chống bám bụi, chống nhăn, hạn chế thấm nước, độ bền cao.</p><p style=\"box-sizing: border-box; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(17, 17, 17); font-family: Roboto, Arial, sans-serif; font-size: 13px;\"><span style=\"box-sizing: border-box; font-weight: 700;\">MÀU SẮC:&nbsp;</span>Xanh biển 56MF, Xám 84MF, Xanh tím than 36MF</p><p style=\"box-sizing: border-box; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(17, 17, 17); font-family: Roboto, Arial, sans-serif; font-size: 13px;\"><span style=\"box-sizing: border-box; font-weight: 700;\">SIZE:</span>&nbsp;S-M-L-XL-XXL</p>', NULL, NULL),
(33, 'ÁO POLO NAM ARISTINO APS016S1', 'ao-polo-nam-aristino-aps016s1', 'APS016S1', 2, 2, 340000, 0, 1, 0, 0, NULL, 1, NULL, 'public/backend/media/product/avatar/ao-polo-nam-aristino-aps016s1-avatar.jpg', 'public/backend/media/product/images/ao-polo-nam-aristino-aps016s1-1.jpg|public/backend/media/product/images/ao-polo-nam-aristino-aps016s1-2.jpg|public/backend/media/product/images/ao-polo-nam-aristino-aps016s1-3.jpg|public/backend/media/product/images/ao-polo-nam-aristino-aps016s1-4.jpg|public/backend/media/product/images/ao-polo-nam-aristino-aps016s1-5.jpg|public/backend/media/product/images/ao-polo-nam-aristino-aps016s1-6.jpg|public/backend/media/product/images/ao-polo-nam-aristino-aps016s1-7.jpg|public/backend/media/product/images/ao-polo-nam-aristino-aps016s1-8.jpg|public/backend/media/product/images/ao-polo-nam-aristino-aps016s1-9.jpg|public/backend/media/product/images/ao-polo-nam-aristino-aps016s1-10.jpg|public/backend/media/product/images/ao-polo-nam-aristino-aps016s1-11.jpg|public/backend/media/product/images/ao-polo-nam-aristino-aps016s1-12.jpg|public/backend/media/product/images/ao-polo-nam-aristino-aps016s1-13.jpg|public/backend/media/product/images/ao-polo-nam-aristino-aps016s1-14.jpg|public/backend/media/product/images/ao-polo-nam-aristino-aps016s1-15.jpg', 'public/backend/media/product/images_small/ao-polo-nam-aristino-aps016s1-small-1.jpg|public/backend/media/product/images_small/ao-polo-nam-aristino-aps016s1-small-2.jpg|public/backend/media/product/images_small/ao-polo-nam-aristino-aps016s1-small-3.jpg', 'Xanh biển,Xanh tím than,Hồng', 'public/backend/media/product/images_color/ao-polo-nam-aristino-aps016s1-color-1.jpg|public/backend/media/product/images_color/ao-polo-nam-aristino-aps016s1-color-2.jpg|public/backend/media/product/images_color/ao-polo-nam-aristino-aps016s1-color-3.jpg', '<p style=\"box-sizing: border-box; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(17, 17, 17); font-family: Roboto, Arial, sans-serif; font-size: 13px;\"><span style=\"box-sizing: border-box; font-weight: 700;\">KIỂU DÁNG:</span>&nbsp;REGULAR FIT</p><p style=\"box-sizing: border-box; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(17, 17, 17); font-family: Roboto, Arial, sans-serif; font-size: 13px;\"><span style=\"box-sizing: border-box; font-weight: 700;\">CHI TIẾT:</span></p><p style=\"box-sizing: border-box; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(17, 17, 17); font-family: Roboto, Arial, sans-serif; font-size: 13px;\">- Áo Polo phom dáng Regular Fit suông nhẹ. Áo thiết kế cổ vải chính, cắt can, in dọc sống lưng, tay raglang.</p><p style=\"box-sizing: border-box; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(17, 17, 17); font-family: Roboto, Arial, sans-serif; font-size: 13px;\"><span style=\"box-sizing: border-box; font-weight: 700;\">CHẤT LIỆU:</span></p><p style=\"box-sizing: border-box; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(17, 17, 17); font-family: Roboto, Arial, sans-serif; font-size: 13px;\">- 100% Polyester giúp áo bền màu, sắc nét và độ trơn trượt, mỏng nhẹ.</p><p style=\"box-sizing: border-box; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(17, 17, 17); font-family: Roboto, Arial, sans-serif; font-size: 13px;\"><span style=\"box-sizing: border-box; font-weight: 700;\">MÀU SẮC:</span>&nbsp;Xanh tím than 36MF, Xanh biển 56MF, Hồng 9MF</p><p style=\"box-sizing: border-box; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(17, 17, 17); font-family: Roboto, Arial, sans-serif; font-size: 13px;\"><span style=\"box-sizing: border-box; font-weight: 700;\">SIZE:</span>&nbsp;S-M-L-XL-XXL</p>', NULL, NULL),
(34, 'ÁO POLO NAM ARISTINO APSG06S1', 'ao-polo-nam-aristino-apsg06s1', 'APSG06S1', 2, 2, 450000, 20, 1, 0, 0, 1, 1, NULL, 'public/backend/media/product/avatar/ao-polo-nam-aristino-apsg06s1-avatar.jpg', 'public/backend/media/product/images/ao-polo-nam-aristino-apsg06s1-1.jpg|public/backend/media/product/images/ao-polo-nam-aristino-apsg06s1-2.jpg|public/backend/media/product/images/ao-polo-nam-aristino-apsg06s1-3.jpg|public/backend/media/product/images/ao-polo-nam-aristino-apsg06s1-4.jpg|public/backend/media/product/images/ao-polo-nam-aristino-apsg06s1-5.jpg', 'public/backend/media/product/images_small/ao-polo-nam-aristino-apsg06s1-small-1.jpg', 'Trắng 5 kẻ', 'public/backend/media/product/images_color/ao-polo-nam-aristino-apsg06s1-color-1.jpg', '<p style=\"box-sizing: border-box; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(17, 17, 17); font-family: Roboto, Arial, sans-serif; font-size: 13px;\"><span style=\"box-sizing: border-box; font-weight: 700;\">KIỂU DÁNG:</span>&nbsp;GOLF FIT</p><p style=\"box-sizing: border-box; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(17, 17, 17); font-family: Roboto, Arial, sans-serif; font-size: 13px;\"><span style=\"box-sizing: border-box; font-weight: 700;\">CHI TIẾT:</span></p><p style=\"box-sizing: border-box; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(17, 17, 17); font-family: Roboto, Arial, sans-serif; font-size: 13px;\">- Áo Polo phom dáng Golf fit phù hợp với người chơi golf và những quý ông ưa vận động.</p><p style=\"box-sizing: border-box; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(17, 17, 17); font-family: Roboto, Arial, sans-serif; font-size: 13px;\">- Thiết kế trắng kẻ Jacquard toát lên sự thanh lịch và sang trọng với sự tối giản chi tiết, tỉ mỉ trong từng đường may.</p><p style=\"box-sizing: border-box; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(17, 17, 17); font-family: Roboto, Arial, sans-serif; font-size: 13px;\"><span style=\"box-sizing: border-box; font-weight: 700;\">CHẤT LIỆU:</span></p><p style=\"box-sizing: border-box; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(17, 17, 17); font-family: Roboto, Arial, sans-serif; font-size: 13px;\">- Với ưu điểm của cotton tự nhiên, áo mềm mại, thoáng mát, xốp nhẹ và có độ bền chắc. Ngoài ra, áo co giãn thoải mái nhờ 5% spandex phù hợp với các quý ông ưa vận động.</p><p style=\"box-sizing: border-box; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(17, 17, 17); font-family: Roboto, Arial, sans-serif; font-size: 13px;\"><span style=\"box-sizing: border-box; font-weight: 700;\">MÀU SẮC:&nbsp;</span>Trắng 5 kẻ&nbsp;</p><p style=\"box-sizing: border-box; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(17, 17, 17); font-family: Roboto, Arial, sans-serif; font-size: 13px;\"><span style=\"box-sizing: border-box; font-weight: 700;\">SIZE:</span>&nbsp;S – M – L – XL – XXL</p>', NULL, NULL),
(35, 'ÁO POLO NAM ARISTINO APSG09S1', 'ao-polo-nam-aristino-apsg09s1', 'APSG09S1', 2, 2, 280000, 0, 1, 0, 0, NULL, 1, NULL, 'public/backend/media/product/avatar/ao-polo-nam-aristino-apsg09s1-avatar.jpg', 'public/backend/media/product/images/ao-polo-nam-aristino-apsg09s1-1.jpg|public/backend/media/product/images/ao-polo-nam-aristino-apsg09s1-2.jpg|public/backend/media/product/images/ao-polo-nam-aristino-apsg09s1-3.jpg|public/backend/media/product/images/ao-polo-nam-aristino-apsg09s1-4.jpg|public/backend/media/product/images/ao-polo-nam-aristino-apsg09s1-5.jpg|public/backend/media/product/images/ao-polo-nam-aristino-apsg09s1-6.jpg|public/backend/media/product/images/ao-polo-nam-aristino-apsg09s1-7.jpg|public/backend/media/product/images/ao-polo-nam-aristino-apsg09s1-8.jpg|public/backend/media/product/images/ao-polo-nam-aristino-apsg09s1-9.jpg|public/backend/media/product/images/ao-polo-nam-aristino-apsg09s1-10.jpg', 'public/backend/media/product/images_small/ao-polo-nam-aristino-apsg09s1-small-1.jpg|public/backend/media/product/images_small/ao-polo-nam-aristino-apsg09s1-small-2.jpg', 'Xanh aqua 25,Trắng 6 kẻ', 'public/backend/media/product/images_color/ao-polo-nam-aristino-apsg09s1-color-1.jpg|public/backend/media/product/images_color/ao-polo-nam-aristino-apsg09s1-color-2.jpg', '<p style=\"box-sizing: border-box; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(17, 17, 17); font-family: Roboto, Arial, sans-serif; font-size: 13px;\"><span style=\"box-sizing: border-box; font-weight: 700;\">KIỂU DÁNG:</span>&nbsp;GOLF FIT</p><p style=\"box-sizing: border-box; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(17, 17, 17); font-family: Roboto, Arial, sans-serif; font-size: 13px;\"><span style=\"box-sizing: border-box; font-weight: 700;\">CHI TIẾT:</span></p><p style=\"box-sizing: border-box; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(17, 17, 17); font-family: Roboto, Arial, sans-serif; font-size: 13px;\">- Áo Polo Golf phom dáng Golf fit suông vừa, cổ dệt, in logo ngực nổi bật.</p><p style=\"box-sizing: border-box; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(17, 17, 17); font-family: Roboto, Arial, sans-serif; font-size: 13px;\"><span style=\"box-sizing: border-box; font-weight: 700;\">CHẤT LIỆU:</span></p><p style=\"box-sizing: border-box; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(17, 17, 17); font-family: Roboto, Arial, sans-serif; font-size: 13px;\">- 97% Nylon cho bề mặt vải độ mịn mượt, mỏng nhẹ.</p><p style=\"box-sizing: border-box; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(17, 17, 17); font-family: Roboto, Arial, sans-serif; font-size: 13px;\">- 3% Spandex tạo độ co giãn nhẹ.</p><p style=\"box-sizing: border-box; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(17, 17, 17); font-family: Roboto, Arial, sans-serif; font-size: 13px;\"><span style=\"box-sizing: border-box; font-weight: 700;\">MÀU SẮC:</span>&nbsp;Xanh aqua 25, Trắng 6 kẻ</p><p style=\"box-sizing: border-box; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(17, 17, 17); font-family: Roboto, Arial, sans-serif; font-size: 13px;\"><span style=\"box-sizing: border-box; font-weight: 700;\">SIZE:&nbsp;</span>M – L – XL – XXL</p>', NULL, NULL),
(36, 'ÁO POLO NAM ARISTINO APSG07S1', 'ao-polo-nam-aristino-apsg07s1', 'APSG07S1', 2, 2, 345000, 0, 1, 0, 0, NULL, 1, NULL, 'public/backend/media/product/avatar/ao-polo-nam-aristino-apsg07s1-avatar.jpg', 'public/backend/media/product/images/ao-polo-nam-aristino-apsg07s1-1.jpg|public/backend/media/product/images/ao-polo-nam-aristino-apsg07s1-2.jpg|public/backend/media/product/images/ao-polo-nam-aristino-apsg07s1-3.jpg|public/backend/media/product/images/ao-polo-nam-aristino-apsg07s1-4.jpg|public/backend/media/product/images/ao-polo-nam-aristino-apsg07s1-5.jpg|public/backend/media/product/images/ao-polo-nam-aristino-apsg07s1-6.jpg|public/backend/media/product/images/ao-polo-nam-aristino-apsg07s1-7.jpg|public/backend/media/product/images/ao-polo-nam-aristino-apsg07s1-8.jpg|public/backend/media/product/images/ao-polo-nam-aristino-apsg07s1-9.jpg|public/backend/media/product/images/ao-polo-nam-aristino-apsg07s1-10.jpg|public/backend/media/product/images/ao-polo-nam-aristino-apsg07s1-11.jpg|public/backend/media/product/images/ao-polo-nam-aristino-apsg07s1-12.jpg|public/backend/media/product/images/ao-polo-nam-aristino-apsg07s1-13.jpg|public/backend/media/product/images/ao-polo-nam-aristino-apsg07s1-14.jpg|public/backend/media/product/images/ao-polo-nam-aristino-apsg07s1-15.jpg', 'public/backend/media/product/images_small/ao-polo-nam-aristino-apsg07s1-small-1.jpg|public/backend/media/product/images_small/ao-polo-nam-aristino-apsg07s1-small-2.jpg|public/backend/media/product/images_small/ao-polo-nam-aristino-apsg07s1-small-3.jpg', 'Đen,Xanh cổ vịt 12,Trắng 6', 'public/backend/media/product/images_color/ao-polo-nam-aristino-apsg07s1-color-1.jpg|public/backend/media/product/images_color/ao-polo-nam-aristino-apsg07s1-color-2.jpg|public/backend/media/product/images_color/ao-polo-nam-aristino-apsg07s1-color-3.jpg', '<p style=\"box-sizing: border-box; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(17, 17, 17); font-family: Roboto, Arial, sans-serif; font-size: 13px;\"><span style=\"box-sizing: border-box; font-weight: 700;\">KIỂU DÁNG:&nbsp;</span>GOLF FIT</p><p style=\"box-sizing: border-box; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(17, 17, 17); font-family: Roboto, Arial, sans-serif; font-size: 13px;\"><span style=\"box-sizing: border-box; font-weight: 700;\">CHI TIẾT:</span></p><p style=\"box-sizing: border-box; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(17, 17, 17); font-family: Roboto, Arial, sans-serif; font-size: 13px;\">- Áo Polo Golf phom dáng Golf fit suông vừa. Vải có tính năng ưu Việt, thiết kế cổ dệt line kẻ, in và cắt lazer tinh tế.</p><p style=\"box-sizing: border-box; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(17, 17, 17); font-family: Roboto, Arial, sans-serif; font-size: 13px;\"><span style=\"box-sizing: border-box; font-weight: 700;\">CHẤT LIỆU:</span></p><p style=\"box-sizing: border-box; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(17, 17, 17); font-family: Roboto, Arial, sans-serif; font-size: 13px;\">- 97% Nylon cho bề mặt vải độ mịn mượt, mỏng nhẹ.</p><p style=\"box-sizing: border-box; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(17, 17, 17); font-family: Roboto, Arial, sans-serif; font-size: 13px;\">- 3% Spandex tạo độ co giãn nhẹ</p><p style=\"box-sizing: border-box; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(17, 17, 17); font-family: Roboto, Arial, sans-serif; font-size: 13px;\"><span style=\"box-sizing: border-box; font-weight: 700;\">MÀU SẮC:&nbsp;</span>Đen 9, Xanh cổ vịt 12, Trắng 6</p><p style=\"box-sizing: border-box; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(17, 17, 17); font-family: Roboto, Arial, sans-serif; font-size: 13px;\"><span style=\"box-sizing: border-box; font-weight: 700;\">SIZE:</span>&nbsp;S – M – L – XL – XXL</p>', NULL, NULL),
(37, 'ÁO POLO NAM ARISTINO APS026S1', 'ao-polo-nam-aristino-aps026s1', 'APS026S1', 2, 2, 250000, 10, 1, 0, 0, 1, 1, NULL, 'public/backend/media/product/avatar/ao-polo-nam-aristino-aps026s1-avatar.jpg', 'public/backend/media/product/images/ao-polo-nam-aristino-aps026s1-1.jpg|public/backend/media/product/images/ao-polo-nam-aristino-aps026s1-2.jpg|public/backend/media/product/images/ao-polo-nam-aristino-aps026s1-3.jpg|public/backend/media/product/images/ao-polo-nam-aristino-aps026s1-4.jpg|public/backend/media/product/images/ao-polo-nam-aristino-aps026s1-5.jpg|public/backend/media/product/images/ao-polo-nam-aristino-aps026s1-6.jpg|public/backend/media/product/images/ao-polo-nam-aristino-aps026s1-7.jpg|public/backend/media/product/images/ao-polo-nam-aristino-aps026s1-8.jpg|public/backend/media/product/images/ao-polo-nam-aristino-aps026s1-9.jpg|public/backend/media/product/images/ao-polo-nam-aristino-aps026s1-10.jpg|public/backend/media/product/images/ao-polo-nam-aristino-aps026s1-11.jpg|public/backend/media/product/images/ao-polo-nam-aristino-aps026s1-12.jpg|public/backend/media/product/images/ao-polo-nam-aristino-aps026s1-13.jpg|public/backend/media/product/images/ao-polo-nam-aristino-aps026s1-14.jpg|public/backend/media/product/images/ao-polo-nam-aristino-aps026s1-15.jpg', 'public/backend/media/product/images_small/ao-polo-nam-aristino-aps026s1-small-1.jpg|public/backend/media/product/images_small/ao-polo-nam-aristino-aps026s1-small-2.jpg|public/backend/media/product/images_small/ao-polo-nam-aristino-aps026s1-small-3.jpg', 'Xanh biển 209,Xanh tím than 8,Trắng 6', 'public/backend/media/product/images_color/ao-polo-nam-aristino-aps026s1-color-1.jpg|public/backend/media/product/images_color/ao-polo-nam-aristino-aps026s1-color-2.jpg|public/backend/media/product/images_color/ao-polo-nam-aristino-aps026s1-color-3.jpg', '<p style=\"box-sizing: border-box; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(17, 17, 17); font-family: Roboto, Arial, sans-serif; font-size: 13px;\"><span style=\"box-sizing: border-box; font-weight: 700;\">KIỂU DÁNG:&nbsp;</span>REGULAR FIT</p><p style=\"box-sizing: border-box; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(17, 17, 17); font-family: Roboto, Arial, sans-serif; font-size: 13px;\"><span style=\"box-sizing: border-box; font-weight: 700;\">CHI TIẾT:</span></p><p style=\"box-sizing: border-box; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(17, 17, 17); font-family: Roboto, Arial, sans-serif; font-size: 13px;\">- Áo polo phom dáng Regular fit suông vừa.</p><p style=\"box-sizing: border-box; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(17, 17, 17); font-family: Roboto, Arial, sans-serif; font-size: 13px;\">- Cổ áo dệt rib, tay trái in họa tiết đầy tinh tế. Vải dry-tech thấm hút tốt, đẩy hơi ẩm nhanh.</p><p style=\"box-sizing: border-box; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(17, 17, 17); font-family: Roboto, Arial, sans-serif; font-size: 13px;\"><span style=\"box-sizing: border-box; font-weight: 700;\">CHẤT LIỆU:</span></p><p style=\"box-sizing: border-box; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(17, 17, 17); font-family: Roboto, Arial, sans-serif; font-size: 13px;\">- 59% Cotton giúp áo mềm nhẹ, thấm hút tốt, thoáng khí dù ở mùa nào trong năm, đồng thời vẫn giữ được độ đứng dáng vừa đủ.</p><p style=\"box-sizing: border-box; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(17, 17, 17); font-family: Roboto, Arial, sans-serif; font-size: 13px;\">- 41% Polyester giúp bề mặt vải trơn bóng, màu sắc sắc nét và bền màu qua quá trình sử dụng.</p><p style=\"box-sizing: border-box; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(17, 17, 17); font-family: Roboto, Arial, sans-serif; font-size: 13px;\"><span style=\"box-sizing: border-box; font-weight: 700;\">MÀU SẮC:&nbsp;</span>Xanh tím than 8, Trắng 6, Xanh biển 209</p><p style=\"box-sizing: border-box; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(17, 17, 17); font-family: Roboto, Arial, sans-serif; font-size: 13px;\"><span style=\"box-sizing: border-box; font-weight: 700;\">SIZE:</span>&nbsp;S – M – L – XL – XXL</p>', NULL, NULL),
(38, 'ÁO POLO NAM ARISTINO APS033S1', 'ao-polo-nam-aristino-aps033s1', 'APS033S1', 2, 2, 500000, 50, 1, 0, 0, 1, 1, NULL, 'public/backend/media/product/avatar/ao-polo-nam-aristino-aps033s1-avatar.jpg', 'public/backend/media/product/images/ao-polo-nam-aristino-aps033s1-1.jpg|public/backend/media/product/images/ao-polo-nam-aristino-aps033s1-2.jpg|public/backend/media/product/images/ao-polo-nam-aristino-aps033s1-3.jpg|public/backend/media/product/images/ao-polo-nam-aristino-aps033s1-4.jpg|public/backend/media/product/images/ao-polo-nam-aristino-aps033s1-5.jpg|public/backend/media/product/images/ao-polo-nam-aristino-aps033s1-6.jpg|public/backend/media/product/images/ao-polo-nam-aristino-aps033s1-7.jpg|public/backend/media/product/images/ao-polo-nam-aristino-aps033s1-8.jpg|public/backend/media/product/images/ao-polo-nam-aristino-aps033s1-9.jpg|public/backend/media/product/images/ao-polo-nam-aristino-aps033s1-10.jpg|public/backend/media/product/images/ao-polo-nam-aristino-aps033s1-11.jpg|public/backend/media/product/images/ao-polo-nam-aristino-aps033s1-12.jpg|public/backend/media/product/images/ao-polo-nam-aristino-aps033s1-13.jpg|public/backend/media/product/images/ao-polo-nam-aristino-aps033s1-14.jpg|public/backend/media/product/images/ao-polo-nam-aristino-aps033s1-15.jpg|public/backend/media/product/images/ao-polo-nam-aristino-aps033s1-16.jpg|public/backend/media/product/images/ao-polo-nam-aristino-aps033s1-17.jpg|public/backend/media/product/images/ao-polo-nam-aristino-aps033s1-18.jpg|public/backend/media/product/images/ao-polo-nam-aristino-aps033s1-19.jpg|public/backend/media/product/images/ao-polo-nam-aristino-aps033s1-20.jpg', 'public/backend/media/product/images_small/ao-polo-nam-aristino-aps033s1-small-1.jpg|public/backend/media/product/images_small/ao-polo-nam-aristino-aps033s1-small-2.jpg|public/backend/media/product/images_small/ao-polo-nam-aristino-aps033s1-small-3.jpg|public/backend/media/product/images_small/ao-polo-nam-aristino-aps033s1-small-4.jpg', 'Xanh biển 109 MF,Xám 116 MF,Đen 1MF,Xanh tím than 7MF', 'public/backend/media/product/images_color/ao-polo-nam-aristino-aps033s1-color-1.jpg|public/backend/media/product/images_color/ao-polo-nam-aristino-aps033s1-color-2.jpg|public/backend/media/product/images_color/ao-polo-nam-aristino-aps033s1-color-3.jpg|public/backend/media/product/images_color/ao-polo-nam-aristino-aps033s1-color-4.jpg', '<p style=\"box-sizing: border-box; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(17, 17, 17); font-family: Roboto, Arial, sans-serif; font-size: 13px;\"><span style=\"box-sizing: border-box; font-weight: 700;\">KIỂU DÁNG:&nbsp;</span>REGULAR FIT</p><p style=\"box-sizing: border-box; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(17, 17, 17); font-family: Roboto, Arial, sans-serif; font-size: 13px;\"><span style=\"box-sizing: border-box; font-weight: 700;\">CHI TIẾT:</span></p><p style=\"box-sizing: border-box; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(17, 17, 17); font-family: Roboto, Arial, sans-serif; font-size: 13px;\">- Áo Polo phom Regular fit suông nhẹ, thoải mái và vẫn đảm bảo vừa vặn số đo hình thể nam giới Việt.</p><p style=\"box-sizing: border-box; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(17, 17, 17); font-family: Roboto, Arial, sans-serif; font-size: 13px;\">- Thiết kế cơ bản với cổ đức, vải 2 mặt, tay áo có thể lật lên nhìn thấy màu vải trong. Áo màu sắc trung tính, đem đến nhiều lựa chọn.</p><p style=\"box-sizing: border-box; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(17, 17, 17); font-family: Roboto, Arial, sans-serif; font-size: 13px;\"><span style=\"box-sizing: border-box; font-weight: 700;\">CHẤT LIỆU:</span></p><p style=\"box-sizing: border-box; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(17, 17, 17); font-family: Roboto, Arial, sans-serif; font-size: 13px;\">- Chất liệu 100% Polyester mang đến độ bóng sắc nét, không bị bai dão, luôn bền màu. Áo còn có khả năng chống bám bụi, chống nhăn, hạn chế thấm nước, độ bền cao.</p><p style=\"box-sizing: border-box; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(17, 17, 17); font-family: Roboto, Arial, sans-serif; font-size: 13px;\"><span style=\"box-sizing: border-box; font-weight: 700;\">MÀU SẮC:&nbsp;</span>Đen 1MF, Xanh tím than 7MF, Xanh biển 109 MF, Xám 116 MF</p><p style=\"box-sizing: border-box; margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(17, 17, 17); font-family: Roboto, Arial, sans-serif; font-size: 13px;\"><span style=\"box-sizing: border-box; font-weight: 700;\">SIZE:&nbsp;</span>S – M – L – XL – XXL</p>', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_detail`
--

CREATE TABLE `product_detail` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `product_color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_size` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_qty` int(11) DEFAULT NULL,
  `slug_product_color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_detail_sold` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product_detail`
--

INSERT INTO `product_detail` (`id`, `product_id`, `product_color`, `product_size`, `product_qty`, `slug_product_color`, `product_detail_sold`, `created_at`, `updated_at`) VALUES
(209, 27, 'Đen', 'S', 3, 'den', 2, NULL, NULL),
(210, 27, 'Đen', 'M', 40, 'den', 0, NULL, NULL),
(211, 27, 'Đen', 'L', 0, 'den', 0, NULL, NULL),
(212, 27, 'Đen', 'XL', 36, 'den', 4, NULL, NULL),
(213, 27, 'Đen', 'XXL', 40, 'den', 0, NULL, NULL),
(214, 27, 'Đỏ', 'S', 0, 'do', 0, NULL, NULL),
(215, 27, 'Đỏ', 'M', 0, 'do', 0, NULL, NULL),
(216, 27, 'Đỏ', 'L', 0, 'do', 0, NULL, NULL),
(217, 27, 'Đỏ', 'XL', 0, 'do', 0, NULL, NULL),
(218, 27, 'Đỏ', 'XXL', 0, 'do', 0, NULL, NULL),
(219, 27, 'Xanh', 'S', 40, 'xanh', 0, NULL, NULL),
(220, 27, 'Xanh', 'M', 38, 'xanh', 2, NULL, NULL),
(221, 27, 'Xanh', 'L', 38, 'xanh', 2, NULL, NULL),
(222, 27, 'Xanh', 'XL', 35, 'xanh', 5, NULL, NULL),
(223, 27, 'Xanh', 'XXL', 0, 'xanh', 0, NULL, NULL),
(224, 27, 'Trắng', 'S', 38, 'trang', 2, NULL, NULL),
(225, 27, 'Trắng', 'M', 38, 'trang', 2, NULL, NULL),
(226, 27, 'Trắng', 'L', 38, 'trang', 2, NULL, NULL),
(227, 27, 'Trắng', 'XL', 40, 'trang', 0, NULL, NULL),
(228, 27, 'Trắng', 'XXL', 40, 'trang', 0, NULL, NULL),
(229, 28, 'Trắng in họa tiết xanh lá', '38', 40, 'trang-in-hoa-tiet-xanh-la', 0, NULL, NULL),
(230, 28, 'Trắng in họa tiết xanh lá', '39', 34, 'trang-in-hoa-tiet-xanh-la', 6, NULL, NULL),
(231, 28, 'Trắng in họa tiết xanh lá', '40', 5, 'trang-in-hoa-tiet-xanh-la', 0, NULL, NULL),
(232, 28, 'Trắng in họa tiết xanh lá', '41', 40, 'trang-in-hoa-tiet-xanh-la', 0, NULL, NULL),
(233, 28, 'Trắng in họa tiết xanh lá', '42', 38, 'trang-in-hoa-tiet-xanh-la', 2, NULL, NULL),
(234, 28, 'Trắng in họa tiết xanh lá', '43', 40, 'trang-in-hoa-tiet-xanh-la', 0, NULL, NULL),
(235, 29, 'Xanh nhạt in họa tiết gạch', '38', 40, 'xanh-nhat-in-hoa-tiet-gach', 0, NULL, NULL),
(236, 29, 'Xanh nhạt in họa tiết gạch', '39', 40, 'xanh-nhat-in-hoa-tiet-gach', 0, NULL, NULL),
(237, 29, 'Xanh nhạt in họa tiết gạch', '40', 5, 'xanh-nhat-in-hoa-tiet-gach', 0, NULL, NULL),
(238, 29, 'Xanh nhạt in họa tiết gạch', '41', 33, 'xanh-nhat-in-hoa-tiet-gach', 7, NULL, NULL),
(239, 29, 'Xanh nhạt in họa tiết gạch', '42', 40, 'xanh-nhat-in-hoa-tiet-gach', 0, NULL, NULL),
(240, 29, 'Xanh nhạt in họa tiết gạch', '43', 40, 'xanh-nhat-in-hoa-tiet-gach', 0, NULL, NULL),
(241, 30, 'Trắng in họa tiết chấm', '38', 40, 'trang-in-hoa-tiet-cham', 0, NULL, NULL),
(242, 30, 'Trắng in họa tiết chấm', '39', 35, 'trang-in-hoa-tiet-cham', 5, NULL, NULL),
(243, 30, 'Trắng in họa tiết chấm', '40', 0, 'trang-in-hoa-tiet-cham', 5, NULL, NULL),
(244, 30, 'Trắng in họa tiết chấm', '41', 40, 'trang-in-hoa-tiet-cham', 0, NULL, NULL),
(245, 30, 'Trắng in họa tiết chấm', '42', 40, 'trang-in-hoa-tiet-cham', 0, NULL, NULL),
(246, 30, 'Trắng in họa tiết chấm', '43', 40, 'trang-in-hoa-tiet-cham', 0, NULL, NULL),
(248, 32, 'Xanh biển', 'S', 40, 'xanh-bien', 0, NULL, NULL),
(249, 32, 'Xanh biển', 'M', 40, 'xanh-bien', 0, NULL, NULL),
(250, 32, 'Xanh biển', 'L', 0, 'xanh-bien', 0, NULL, NULL),
(251, 32, 'Xanh biển', 'XL', 40, 'xanh-bien', 0, NULL, NULL),
(252, 32, 'Xanh biển', 'XXL', 40, 'xanh-bien', 0, NULL, NULL),
(253, 32, 'Xám', 'S', 40, 'xam', 0, NULL, NULL),
(254, 32, 'Xám', 'M', 40, 'xam', 0, NULL, NULL),
(255, 32, 'Xám', 'L', 40, 'xam', 0, NULL, NULL),
(256, 32, 'Xám', 'XL', 40, 'xam', 0, NULL, NULL),
(257, 32, 'Xám', 'XXL', 0, 'xam', 0, NULL, NULL),
(258, 32, 'Xanh tím than', 'S', 40, 'xanh-tim-than', 0, NULL, NULL),
(259, 32, 'Xanh tím than', 'M', 40, 'xanh-tim-than', 0, NULL, NULL),
(260, 32, 'Xanh tím than', 'L', 40, 'xanh-tim-than', 0, NULL, NULL),
(261, 32, 'Xanh tím than', 'XL', 40, 'xanh-tim-than', 0, NULL, NULL),
(262, 32, 'Xanh tím than', 'XXL', 40, 'xanh-tim-than', 0, NULL, NULL),
(263, 33, 'Xanh biển', 'S', 40, 'xanh-bien', 0, NULL, NULL),
(264, 33, 'Xanh biển', 'M', 40, 'xanh-bien', 0, NULL, NULL),
(265, 33, 'Xanh biển', 'L', 0, 'xanh-bien', 0, NULL, NULL),
(266, 33, 'Xanh biển', 'XL', 40, 'xanh-bien', 0, NULL, NULL),
(267, 33, 'Xanh biển', 'XXL', 40, 'xanh-bien', 0, NULL, NULL),
(268, 33, 'Xanh tím than', 'S', 40, 'xanh-tim-than', 0, NULL, NULL),
(269, 33, 'Xanh tím than', 'M', 40, 'xanh-tim-than', 0, NULL, NULL),
(270, 33, 'Xanh tím than', 'L', 40, 'xanh-tim-than', 0, NULL, NULL),
(271, 33, 'Xanh tím than', 'XL', 40, 'xanh-tim-than', 0, NULL, NULL),
(272, 33, 'Xanh tím than', 'XXL', 40, 'xanh-tim-than', 0, NULL, NULL),
(273, 33, 'Hồng', 'S', 40, 'hong', 0, NULL, NULL),
(274, 33, 'Hồng', 'M', 40, 'hong', 0, NULL, NULL),
(275, 33, 'Hồng', 'L', 20, 'hong', 0, NULL, NULL),
(276, 33, 'Hồng', 'XL', 40, 'hong', 0, NULL, NULL),
(277, 33, 'Hồng', 'XXL', 40, 'hong', 0, NULL, NULL),
(278, 34, 'Trắng 5 kẻ', 'S', 40, 'trang-5-ke', 0, NULL, NULL),
(279, 34, 'Trắng 5 kẻ', 'M', 40, 'trang-5-ke', 0, NULL, NULL),
(280, 34, 'Trắng 5 kẻ', 'L', 20, 'trang-5-ke', 0, NULL, NULL),
(281, 34, 'Trắng 5 kẻ', 'XL', 40, 'trang-5-ke', 0, NULL, NULL),
(282, 34, 'Trắng 5 kẻ', 'XXL', 40, 'trang-5-ke', 0, NULL, NULL),
(283, 35, 'Xanh aqua 25', 'S', 40, 'xanh-aqua-25', 0, NULL, NULL),
(284, 35, 'Xanh aqua 25', 'M', 40, 'xanh-aqua-25', 0, NULL, NULL),
(285, 35, 'Xanh aqua 25', 'L', 40, 'xanh-aqua-25', 0, NULL, NULL),
(286, 35, 'Xanh aqua 25', 'XL', 40, 'xanh-aqua-25', 0, NULL, NULL),
(287, 35, 'Xanh aqua 25', 'XXL', 40, 'xanh-aqua-25', 0, NULL, NULL),
(288, 35, 'Trắng 6 kẻ', 'S', 40, 'trang-6-ke', 0, NULL, NULL),
(289, 35, 'Trắng 6 kẻ', 'M', 40, 'trang-6-ke', 0, NULL, NULL),
(290, 35, 'Trắng 6 kẻ', 'L', 20, 'trang-6-ke', 0, NULL, NULL),
(291, 35, 'Trắng 6 kẻ', 'XL', 40, 'trang-6-ke', 0, NULL, NULL),
(292, 35, 'Trắng 6 kẻ', 'XXL', 40, 'trang-6-ke', 0, NULL, NULL),
(293, 36, 'Đen', 'S', 40, 'den', 0, NULL, NULL),
(294, 36, 'Đen', 'M', 40, 'den', 0, NULL, NULL),
(295, 36, 'Đen', 'L', 40, 'den', 0, NULL, NULL),
(296, 36, 'Đen', 'XL', 40, 'den', 0, NULL, NULL),
(297, 36, 'Đen', 'XXL', 40, 'den', 0, NULL, NULL),
(298, 36, 'Xanh cổ vịt 12', 'S', 0, 'xanh-co-vit-12', 0, NULL, NULL),
(299, 36, 'Xanh cổ vịt 12', 'M', 0, 'xanh-co-vit-12', 0, NULL, NULL),
(300, 36, 'Xanh cổ vịt 12', 'L', 0, 'xanh-co-vit-12', 0, NULL, NULL),
(301, 36, 'Xanh cổ vịt 12', 'XL', 0, 'xanh-co-vit-12', 0, NULL, NULL),
(302, 36, 'Xanh cổ vịt 12', 'XXL', 0, 'xanh-co-vit-12', 0, NULL, NULL),
(303, 36, 'Trắng 6', 'S', 40, 'trang-6', 0, NULL, NULL),
(304, 36, 'Trắng 6', 'M', 40, 'trang-6', 0, NULL, NULL),
(305, 36, 'Trắng 6', 'L', 20, 'trang-6', 0, NULL, NULL),
(306, 36, 'Trắng 6', 'XL', 40, 'trang-6', 0, NULL, NULL),
(307, 36, 'Trắng 6', 'XXL', 40, 'trang-6', 0, NULL, NULL),
(308, 37, 'Xanh biển 209', 'S', 40, 'xanh-bien-209', 0, NULL, NULL),
(309, 37, 'Xanh biển 209', 'M', 40, 'xanh-bien-209', 0, NULL, NULL),
(310, 37, 'Xanh biển 209', 'L', 20, 'xanh-bien-209', 0, NULL, NULL),
(311, 37, 'Xanh biển 209', 'XL', 40, 'xanh-bien-209', 0, NULL, NULL),
(312, 37, 'Xanh biển 209', 'XXL', 40, 'xanh-bien-209', 0, NULL, NULL),
(313, 37, 'Xanh tím than 8', 'S', 40, 'xanh-tim-than-8', 0, NULL, NULL),
(314, 37, 'Xanh tím than 8', 'M', 40, 'xanh-tim-than-8', 0, NULL, NULL),
(315, 37, 'Xanh tím than 8', 'L', 40, 'xanh-tim-than-8', 0, NULL, NULL),
(316, 37, 'Xanh tím than 8', 'XL', 40, 'xanh-tim-than-8', 0, NULL, NULL),
(317, 37, 'Xanh tím than 8', 'XXL', 40, 'xanh-tim-than-8', 0, NULL, NULL),
(318, 37, 'Trắng 6', 'S', 40, 'trang-6', 0, NULL, NULL),
(319, 37, 'Trắng 6', 'M', 40, 'trang-6', 0, NULL, NULL),
(320, 37, 'Trắng 6', 'L', 40, 'trang-6', 0, NULL, NULL),
(321, 37, 'Trắng 6', 'XL', 40, 'trang-6', 0, NULL, NULL),
(322, 37, 'Trắng 6', 'XXL', 40, 'trang-6', 0, NULL, NULL),
(323, 38, 'Xanh biển 109 MF', 'S', 40, 'xanh-bien-109-mf', 0, NULL, NULL),
(324, 38, 'Xanh biển 109 MF', 'M', 40, 'xanh-bien-109-mf', 0, NULL, NULL),
(325, 38, 'Xanh biển 109 MF', 'L', 20, 'xanh-bien-109-mf', 0, NULL, NULL),
(326, 38, 'Xanh biển 109 MF', 'XL', 40, 'xanh-bien-109-mf', 0, NULL, NULL),
(327, 38, 'Xanh biển 109 MF', 'XXL', 40, 'xanh-bien-109-mf', 0, NULL, NULL),
(328, 38, 'Xám 116 MF', 'S', 40, 'xam-116-mf', 0, NULL, NULL),
(329, 38, 'Xám 116 MF', 'M', 40, 'xam-116-mf', 0, NULL, NULL),
(330, 38, 'Xám 116 MF', 'L', 40, 'xam-116-mf', 0, NULL, NULL),
(331, 38, 'Xám 116 MF', 'XL', 40, 'xam-116-mf', 0, NULL, NULL),
(332, 38, 'Xám 116 MF', 'XXL', 40, 'xam-116-mf', 0, NULL, NULL),
(333, 38, 'Đen 1MF', 'S', 0, 'den-1mf', 0, NULL, NULL),
(334, 38, 'Đen 1MF', 'M', 0, 'den-1mf', 0, NULL, NULL),
(335, 38, 'Đen 1MF', 'L', 0, 'den-1mf', 0, NULL, NULL),
(336, 38, 'Đen 1MF', 'XL', 0, 'den-1mf', 0, NULL, NULL),
(337, 38, 'Đen 1MF', 'XXL', 0, 'den-1mf', 0, NULL, NULL),
(338, 38, 'Xanh tím than 7MF', 'S', 40, 'xanh-tim-than-7mf', 0, NULL, NULL),
(339, 38, 'Xanh tím than 7MF', 'M', 40, 'xanh-tim-than-7mf', 0, NULL, NULL),
(340, 38, 'Xanh tím than 7MF', 'L', 40, 'xanh-tim-than-7mf', 0, NULL, NULL),
(341, 38, 'Xanh tím than 7MF', 'XL', 40, 'xanh-tim-than-7mf', 0, NULL, NULL),
(342, 38, 'Xanh tím than 7MF', 'XXL', 40, 'xanh-tim-than-7mf', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `subcategories`
--

CREATE TABLE `subcategories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subcategory_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug_subcategory_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `subcategories`
--

INSERT INTO `subcategories` (`id`, `subcategory_name`, `slug_subcategory_name`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 'Áo sơ mi', 'ao-so-mi', 2, NULL, NULL),
(2, 'Áo polo', 'ao-polo', 2, NULL, NULL),
(4, 'Áo T-Shirt', 'ao-t-shirt', 2, NULL, NULL),
(5, 'Áo Tank-top', 'ao-tank-top', 2, NULL, NULL),
(6, 'Áo len', 'ao-len', 2, NULL, NULL),
(7, 'Áo khoác', 'ao-khoac', 2, NULL, NULL),
(8, 'Áo thun dài tay', 'ao-thun-dai-tay', 2, NULL, NULL),
(9, 'Áo blazer', 'ao-blazer', 2, NULL, NULL),
(10, 'Quần âu', 'quan-au', 3, NULL, NULL),
(11, 'Quần kaki', 'quan-kaki', 3, NULL, NULL),
(12, 'Quần thể thao', 'quan-the-thao', 3, NULL, NULL),
(13, 'Quần jeans', 'quan-jeans', 3, NULL, NULL),
(14, 'Quần Short', 'quan-short', 3, NULL, NULL),
(15, 'Boxer', 'boxer', 4, NULL, NULL),
(16, 'Brief', 'brief', 4, NULL, NULL),
(17, 'Thắt lưng', 'that-lung', 5, NULL, NULL),
(18, 'Ví nam', 'vi-nam', 5, NULL, NULL),
(19, 'Cà vạt', 'ca-vat', 5, NULL, NULL),
(20, 'Cặp da', 'cap-da', 5, NULL, NULL),
(21, 'Giày da', 'giay-da', 5, NULL, NULL),
(22, 'Vali', 'vali', 5, NULL, NULL),
(23, 'Khác', 'khac', 5, NULL, NULL),
(24, 'Bộ đồ', 'bo-do', 6, NULL, NULL),
(25, 'Bộ suit', 'bo-suit', 6, NULL, NULL),
(26, 'Áo sơ mi', 'ao-so-mi', 11, NULL, NULL),
(27, 'Áo polo', 'ao-polo', 11, NULL, NULL),
(28, 'Áo T-Shirt', 'ao-t-shirt', 11, NULL, NULL),
(29, 'Áo ba lỗ', 'ao-ba-lo', 11, NULL, NULL),
(30, 'Quần', 'quan', 11, NULL, NULL),
(31, 'Bộ đồ', 'bo-do', 11, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birth` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` int(11) DEFAULT NULL,
  `customer_type` int(11) DEFAULT 0,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `email_verified_at`, `password`, `avatar`, `birth`, `gender`, `customer_type`, `remember_token`, `created_at`, `updated_at`) VALUES
(15, 'Nguyen Sy Khai', 'khainguyensi.1998@gmail.com', '0355123450', NULL, '$2y$10$NU23NuyCPtTjLEQGrm4.hOSdeANATlLTp2Xp8ZXJBFRw8H6wKoLdS', NULL, '1998-05-14', 1, 0, 'Ths9zqQJ5ShqBbTMQgfhVb58wk0lktdEgbhboiVj1tHZ3lQw36fNcuQuXouw', '2021-05-31 00:24:26', '2021-06-10 08:14:07'),
(16, 'Nguyen Sy Khai', 'khainguyensi.19981@gmail.com', '0355123412', NULL, '$2y$10$c/LxxHxWudpfqVZBxplZSegdSIpR7Z8cUUsGUaZlUs2cziBNKAHbi', NULL, NULL, NULL, 0, NULL, '2021-06-09 09:57:01', '2021-06-09 09:57:01');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`),
  ADD UNIQUE KEY `admins_phone_unique` (`phone`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `coupons_type`
--
ALTER TABLE `coupons_type`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

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
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `orders_detail`
--
ALTER TABLE `orders_detail`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `orders_pay_stripe`
--
ALTER TABLE `orders_pay_stripe`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `orders_shipping`
--
ALTER TABLE `orders_shipping`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `product_detail`
--
ALTER TABLE `product_detail`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `coupons_type`
--
ALTER TABLE `coupons_type`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `menu`
--
ALTER TABLE `menu`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT cho bảng `orders_detail`
--
ALTER TABLE `orders_detail`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT cho bảng `orders_pay_stripe`
--
ALTER TABLE `orders_pay_stripe`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `orders_shipping`
--
ALTER TABLE `orders_shipping`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT cho bảng `product_detail`
--
ALTER TABLE `product_detail`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=343;

--
-- AUTO_INCREMENT cho bảng `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
