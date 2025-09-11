-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 11, 2025 at 04:31 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stockify`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'animi', 'Sapiente molestiae tenetur earum enim officia eveniet beatae quibusdam.', '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(2, 'consectetur', 'Quod animi consequuntur ut commodi quo omnis est.', '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(3, 'animi', 'A at quod quas ea ut.', '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(4, 'aut', 'Perspiciatis aperiam ut velit.', '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(5, 'minima', 'Illum sit libero est perferendis quia.', '2025-09-06 00:58:16', '2025-09-06 00:58:16');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_09_04_030916_create_categories_table', 1),
(5, '2025_09_04_030938_create_suppliers_table', 1),
(6, '2025_09_04_030948_create_products_table', 1),
(7, '2025_09_04_030957_create_product_attributes_table', 1),
(8, '2025_09_04_031011_create_stock_transactions_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `sku` varchar(255) NOT NULL COMMENT 'Stock Keeping Unit',
  `description` text DEFAULT NULL,
  `purchase_price` decimal(15,2) NOT NULL DEFAULT 0.00,
  `selling_price` decimal(15,2) NOT NULL DEFAULT 0.00,
  `stock` int(11) NOT NULL DEFAULT 0 COMMENT 'Jumlah stok saat ini',
  `minimum_stock` int(11) NOT NULL DEFAULT 0,
  `image` varchar(255) DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `supplier_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `sku`, `description`, `purchase_price`, `selling_price`, `stock`, `minimum_stock`, `image`, `category_id`, `supplier_id`, `created_at`, `updated_at`) VALUES
(1, 'molestias', 'PROD-HDBI', 'Repellat reiciendis cum eos tenetur quia ut nam.', 14180.60, 88268.53, 44, 7, NULL, 3, 2, '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(2, 'porro', 'PROD-HHHF', 'Laborum sit similique magni recusandae.', 12822.73, 76864.85, 58, 16, NULL, 3, 2, '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(3, 'quia', 'PROD-VVYD', 'Voluptatibus at provident aut voluptatem consequatur omnis et.', 47161.06, 88356.27, 84, 9, NULL, 3, 2, '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(4, 'voluptas', 'PROD-DBIU', 'Sunt enim ipsum illo cumque.', 35521.44, 99234.70, 92, 20, NULL, 3, 2, '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(5, 'quo', 'PROD-YJCZ', 'Recusandae maiores sint quos ea non voluptatibus qui.', 37950.36, 64351.08, 59, 18, NULL, 3, 2, '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(6, 'atque', 'PROD-TQWH', 'In animi quia error nam eligendi asperiores at.', 36476.07, 77669.29, 55, 10, NULL, 3, 2, '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(7, 'quasi', 'PROD-XWVG', 'Iusto consectetur sit ipsum quia doloremque inventore fugit.', 48800.68, 73675.31, 16, 14, NULL, 3, 2, '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(8, 'sequi', 'PROD-ARVF', 'Ut ut tempore quis aut suscipit in.', 41260.18, 60253.11, 79, 10, NULL, 3, 2, '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(9, 'et', 'PROD-IMEC', 'Placeat quaerat quisquam veniam amet.', 47748.06, 71772.58, 24, 15, NULL, 3, 2, '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(10, 'sint', 'PROD-AXZL', 'Exercitationem in et asperiores libero quo non ut.', 23088.18, 71924.80, 67, 6, NULL, 3, 2, '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(11, 'quis', 'PROD-AUCM', 'Reprehenderit praesentium voluptatem laboriosam animi voluptate.', 36775.78, 85111.74, 69, 10, NULL, 3, 2, '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(12, 'quaerat', 'PROD-RFKB', 'Cumque molestias molestiae dolor qui cumque explicabo quod.', 46822.93, 95345.02, 23, 7, NULL, 3, 2, '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(13, 'culpa', 'PROD-FICV', 'At fugiat sapiente dolores.', 42670.01, 61044.69, 18, 14, NULL, 3, 2, '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(14, 'consequuntur', 'PROD-RMQD', 'Ut ea repellendus enim minima sunt.', 19204.16, 91891.52, 17, 19, NULL, 3, 2, '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(15, 'ipsum', 'PROD-GOAL', 'Maxime consequatur et facere deserunt maiores.', 10679.06, 77496.66, 80, 17, NULL, 3, 2, '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(16, 'non', 'PROD-ORHB', 'Ea natus et ut velit.', 31728.35, 65131.13, 14, 10, NULL, 3, 2, '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(17, 'voluptas', 'PROD-TFBQ', 'Dolore est voluptas officiis veritatis nesciunt sed.', 36269.59, 96994.15, 25, 7, NULL, 3, 2, '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(18, 'dolor', 'PROD-SJBP', 'Occaecati corrupti dolorum hic excepturi pariatur adipisci totam perferendis.', 10879.48, 84018.77, 27, 15, NULL, 3, 2, '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(19, 'aspernatur', 'PROD-BTJA', 'Nihil quaerat illum hic quidem quo.', 10036.12, 92182.58, 13, 9, NULL, 3, 2, '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(20, 'repellat', 'PROD-HQAR', 'Repellendus harum est ratione aut quidem iusto accusantium.', 17496.44, 86920.56, 88, 8, NULL, 3, 2, '2025-09-06 00:58:16', '2025-09-06 00:58:16');

-- --------------------------------------------------------

--
-- Table structure for table `product_attributes`
--

CREATE TABLE `product_attributes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_attributes`
--

INSERT INTO `product_attributes` (`id`, `product_id`, `name`, `value`, `created_at`, `updated_at`) VALUES
(1, 1, 'Ukuran', 'M', '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(2, 1, 'Ukuran', 'L', '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(3, 2, 'Warna', 'Hijau', '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(4, 2, 'Warna', 'M', '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(5, 3, 'Ukuran', 'XL', '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(6, 3, 'Warna', 'Biru', '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(7, 4, 'Warna', 'M', '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(8, 4, 'Warna', 'Hijau', '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(9, 5, 'Ukuran', 'Hijau', '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(10, 5, 'Warna', 'Merah', '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(11, 6, 'Warna', 'Biru', '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(12, 6, 'Ukuran', 'Hijau', '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(13, 7, 'Ukuran', 'L', '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(14, 7, 'Ukuran', 'XL', '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(15, 8, 'Warna', 'M', '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(16, 8, 'Ukuran', 'L', '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(17, 9, 'Warna', 'L', '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(18, 9, 'Warna', 'Merah', '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(19, 10, 'Ukuran', 'M', '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(20, 10, 'Warna', 'Biru', '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(21, 11, 'Ukuran', 'Biru', '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(22, 11, 'Ukuran', 'Hijau', '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(23, 12, 'Warna', 'Hijau', '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(24, 12, 'Warna', 'XL', '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(25, 13, 'Ukuran', 'M', '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(26, 13, 'Warna', 'L', '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(27, 14, 'Ukuran', 'Hijau', '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(28, 14, 'Warna', 'Biru', '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(29, 15, 'Ukuran', 'Merah', '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(30, 15, 'Warna', 'Hijau', '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(31, 16, 'Warna', 'Merah', '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(32, 16, 'Ukuran', 'Hijau', '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(33, 17, 'Warna', 'Hijau', '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(34, 17, 'Warna', 'M', '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(35, 18, 'Ukuran', 'Biru', '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(36, 18, 'Ukuran', 'L', '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(37, 19, 'Ukuran', 'L', '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(38, 19, 'Warna', 'Hijau', '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(39, 20, 'Ukuran', 'XL', '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(40, 20, 'Ukuran', 'XL', '2025-09-06 00:58:16', '2025-09-06 00:58:16');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('e2UuHKxX5ByEP9knH4qzC9QO3LWFioLhnZb18n1x', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiMEpOQmppVzluY1c5OGVmNWxoSHQ4ZGd0V3B4VlEwRUM0ajZlUHE0aCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9wcm9kdWN0cyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1757557831),
('GvokdW9BEMPlzcYX6779dxwBHFDPYCMFmkd0dyRJ', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiOFZma0VJZ2RudXNvV0d2WjNtZUZvVnFEY2I4T2l4NU9ucmJQTE1PYiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9wcm9kdWN0cyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1757303663),
('LGUzbuXknBk7sP7Jv9mT4pk4XhmoMZwKL6SvlRhv', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiWVRVUDNIY2RuaTU1SWY0U3lLdFpRd3k4b2pLSEQxY0FKeE9VcmNKOSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9zdG9jayI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1757321601);

-- --------------------------------------------------------

--
-- Table structure for table `stock_transactions`
--

CREATE TABLE `stock_transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `type` enum('in','out') NOT NULL COMMENT 'in = barang masuk, out = barang keluar',
  `quantity` int(11) NOT NULL,
  `date` date NOT NULL,
  `status` enum('completed','pending','cancelled') NOT NULL DEFAULT 'completed',
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stock_transactions`
--

INSERT INTO `stock_transactions` (`id`, `product_id`, `user_id`, `type`, `quantity`, `date`, `status`, `notes`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'in', 45, '1975-08-22', 'completed', 'Ullam aliquam harum esse quibusdam et ipsa quod.', '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(2, 1, 1, 'in', 43, '1986-08-08', 'completed', 'Iusto vero possimus hic.', '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(3, 1, 1, 'in', 2, '2007-02-08', 'cancelled', 'Et sint dolores animi repudiandae optio est.', '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(4, 2, 1, 'in', 36, '1987-07-10', 'pending', 'Quod ratione sit reiciendis unde aut.', '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(5, 2, 1, 'in', 19, '2004-02-19', 'cancelled', 'Quaerat neque qui nisi.', '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(6, 2, 1, 'out', 9, '2015-01-03', 'cancelled', 'Voluptatem illum vitae officiis sint.', '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(7, 3, 1, 'in', 30, '1990-09-20', 'cancelled', 'Aliquid cum sunt et provident cupiditate et et est.', '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(8, 3, 1, 'out', 17, '1980-09-01', 'completed', 'Laboriosam tenetur minus amet.', '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(9, 3, 1, 'in', 45, '1992-11-27', 'completed', 'Ea maiores itaque possimus corrupti quae quidem sint.', '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(10, 4, 1, 'out', 31, '1984-05-04', 'completed', 'Provident quod deserunt quia aspernatur sit.', '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(11, 4, 1, 'out', 7, '1982-01-09', 'completed', 'Ipsam deleniti unde reiciendis ut debitis sunt et.', '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(12, 4, 1, 'out', 41, '2014-10-28', 'pending', 'Praesentium provident iure dolor ex.', '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(13, 5, 1, 'in', 35, '1997-07-22', 'pending', 'Ullam ut ut exercitationem veniam eum nihil molestias.', '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(14, 5, 1, 'out', 29, '2010-03-22', 'completed', 'A harum amet quis maxime laborum.', '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(15, 5, 1, 'in', 37, '1978-12-16', 'cancelled', 'Consequatur sit quis quas enim.', '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(16, 6, 1, 'in', 27, '1980-04-29', 'completed', 'Laborum aut tempora nam omnis adipisci sunt est.', '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(17, 6, 1, 'out', 19, '1983-11-22', 'completed', 'Dignissimos tempora temporibus velit magni reiciendis dolorum aut rerum.', '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(18, 6, 1, 'in', 44, '1986-09-26', 'completed', 'Voluptas corporis esse alias impedit.', '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(19, 7, 1, 'out', 14, '1971-10-27', 'cancelled', 'Ea aut eius quo necessitatibus rem.', '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(20, 7, 1, 'out', 31, '1993-12-11', 'completed', 'Perspiciatis voluptas ut nobis.', '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(21, 7, 1, 'out', 15, '2021-03-01', 'completed', 'Cum perferendis rerum ea qui quo corrupti.', '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(22, 8, 1, 'out', 7, '2000-02-26', 'completed', 'Amet debitis dignissimos ipsam ea quidem.', '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(23, 8, 1, 'in', 18, '2020-08-05', 'cancelled', 'Et corrupti beatae iure nulla molestiae.', '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(24, 8, 1, 'out', 39, '2019-03-16', 'completed', 'Excepturi nesciunt porro temporibus.', '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(25, 9, 1, 'in', 49, '1984-06-10', 'cancelled', 'Laboriosam incidunt omnis amet quod blanditiis expedita saepe.', '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(26, 9, 1, 'in', 20, '2022-06-26', 'cancelled', 'Praesentium aliquam deserunt laudantium vero et maxime veniam.', '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(27, 9, 1, 'in', 8, '2020-08-29', 'completed', 'Amet recusandae nihil necessitatibus aliquid eos ratione dolor.', '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(28, 10, 1, 'in', 16, '2023-09-06', 'pending', 'Perspiciatis eveniet consequatur dolorem facilis molestiae ea quia accusantium.', '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(29, 10, 1, 'in', 16, '2016-02-09', 'cancelled', 'Nostrum a aut magnam molestias pariatur est nemo.', '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(30, 10, 1, 'in', 5, '2018-08-12', 'pending', 'Quo culpa dolor dicta quam nam.', '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(31, 11, 1, 'in', 32, '1992-09-07', 'cancelled', 'Ipsum ut omnis cupiditate architecto possimus ipsam illo.', '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(32, 11, 1, 'out', 19, '1976-06-29', 'cancelled', 'Voluptatem magni iusto illum quis officiis aut.', '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(33, 11, 1, 'in', 6, '1983-02-19', 'pending', 'Soluta adipisci blanditiis quibusdam assumenda sit est consequatur dignissimos.', '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(34, 12, 1, 'in', 21, '2003-01-16', 'cancelled', 'Porro omnis et nulla consectetur vero dolorem non.', '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(35, 12, 1, 'in', 25, '1981-12-22', 'cancelled', 'Error alias qui quis quisquam id.', '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(36, 12, 1, 'out', 40, '2015-11-17', 'pending', 'Vero ullam ut architecto ut.', '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(37, 13, 1, 'in', 40, '2006-03-05', 'pending', 'Placeat repellat consectetur enim debitis dolores enim.', '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(38, 13, 1, 'out', 39, '2019-09-21', 'cancelled', 'Beatae enim aliquid dolorem sed dolorum.', '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(39, 13, 1, 'out', 35, '1975-03-13', 'pending', 'Error delectus tempore consequatur exercitationem ut et suscipit quod.', '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(40, 14, 1, 'out', 49, '1979-01-12', 'pending', 'Et ut et rerum voluptate sequi incidunt.', '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(41, 14, 1, 'in', 47, '1982-03-17', 'cancelled', 'Et ipsa vitae omnis sapiente molestiae expedita.', '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(42, 14, 1, 'out', 11, '1978-05-14', 'cancelled', 'Expedita repellat eum non corrupti eum delectus.', '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(43, 15, 1, 'out', 44, '1984-01-29', 'pending', 'Nihil officiis corrupti culpa corrupti accusantium.', '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(44, 15, 1, 'in', 29, '1976-09-03', 'cancelled', 'Nisi sit maiores nostrum reprehenderit itaque vero atque.', '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(45, 15, 1, 'out', 40, '1992-09-06', 'pending', 'Corrupti neque ullam voluptate numquam.', '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(46, 16, 1, 'in', 10, '2021-09-29', 'cancelled', 'Rem sed ut dicta quibusdam et.', '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(47, 16, 1, 'in', 14, '1981-02-25', 'completed', 'Dolorem corrupti ad hic voluptas.', '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(48, 16, 1, 'in', 12, '2020-10-08', 'pending', 'Assumenda maiores minima eligendi ut at.', '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(49, 17, 1, 'in', 9, '1984-08-24', 'cancelled', 'Enim vel modi sit reprehenderit.', '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(50, 17, 1, 'in', 26, '1983-01-11', 'pending', 'Voluptas ab laboriosam porro et rem soluta atque.', '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(51, 17, 1, 'in', 48, '2013-03-03', 'cancelled', 'Nihil fugiat voluptate eligendi dolores eos aut.', '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(52, 18, 1, 'in', 11, '1992-06-19', 'cancelled', 'Ullam amet tempore atque qui.', '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(53, 18, 1, 'in', 46, '1977-06-07', 'pending', 'Perspiciatis quia quos esse et vero.', '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(54, 18, 1, 'out', 5, '2007-12-23', 'pending', 'Deleniti qui eum aliquid quidem.', '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(55, 19, 1, 'out', 44, '1986-07-16', 'pending', 'Ad dignissimos aperiam architecto nihil corrupti.', '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(56, 19, 1, 'out', 8, '1993-01-06', 'cancelled', 'Dolores dolorem dolorum ullam quas vel sapiente numquam.', '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(57, 19, 1, 'out', 33, '2001-11-03', 'pending', 'Sunt dolorum ut deserunt.', '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(58, 20, 1, 'out', 40, '2000-04-07', 'pending', 'Qui et nobis exercitationem consequatur quis et quidem.', '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(59, 20, 1, 'out', 2, '2022-04-02', 'cancelled', 'Temporibus est non ut assumenda fuga qui velit consequatur.', '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(60, 20, 1, 'out', 4, '1992-02-11', 'pending', 'Voluptas et culpa recusandae blanditiis vel ut.', '2025-09-06 00:58:16', '2025-09-06 00:58:16');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` text DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `address`, `phone`, `email`, `created_at`, `updated_at`) VALUES
(1, 'Grimes, Mraz and Nienow', '304 Tyree Streets Suite 216\nWest Felicitabury, NH 36811-0068', '+1-615-565-2794', 'fritsch.herman@example.org', '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(2, 'Yost Group', '6794 Gottlieb Parkways Apt. 302\nLuigiview, MT 45880-9303', '(952) 994-6487', 'hwuckert@example.net', '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(3, 'Sauer LLC', '96699 Lavern Extension Suite 862\nNew Marian, DE 77644-9623', '747-952-1026', 'baumbach.angel@example.net', '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(4, 'Quitzon, Bauch and Ebert', '10491 Duncan Summit Apt. 506\nCassinton, SD 62196', '330.519.6674', 'schowalter.brenden@example.net', '2025-09-06 00:58:16', '2025-09-06 00:58:16'),
(5, 'Streich-Hudson', '3294 Little Flats\nSouth Jeniferfurt, ID 74605-7777', '978-446-6526', 'bcremin@example.org', '2025-09-06 00:58:16', '2025-09-06 00:58:16');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','manager','staff') NOT NULL DEFAULT 'staff',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Dyxxans', 'admin@stockify.com', '2025-09-06 00:58:16', '$2y$12$rhrxslWcV8o2R6f.2beBfO3e87drQ67fN76uVax.6vcDBTpPBmhBa', 'admin', 'Q0aXmWgIbn', '2025-09-06 00:58:16', '2025-09-06 00:58:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_sku_unique` (`sku`),
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_supplier_id_foreign` (`supplier_id`);

--
-- Indexes for table `product_attributes`
--
ALTER TABLE `product_attributes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_attributes_product_id_foreign` (`product_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `stock_transactions`
--
ALTER TABLE `stock_transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stock_transactions_product_id_foreign` (`product_id`),
  ADD KEY `stock_transactions_user_id_foreign` (`user_id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `suppliers_email_unique` (`email`);

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
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `product_attributes`
--
ALTER TABLE `product_attributes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `stock_transactions`
--
ALTER TABLE `stock_transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `products_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`);

--
-- Constraints for table `product_attributes`
--
ALTER TABLE `product_attributes`
  ADD CONSTRAINT `product_attributes_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `stock_transactions`
--
ALTER TABLE `stock_transactions`
  ADD CONSTRAINT `stock_transactions_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `stock_transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
