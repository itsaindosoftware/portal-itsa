-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.24 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             12.5.0.6677
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for portal-itsa
CREATE DATABASE IF NOT EXISTS `portal-itsa` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `portal-itsa`;

-- Dumping structure for table portal-itsa.companys
CREATE TABLE IF NOT EXISTS `companys` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `company_desc` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table portal-itsa.companys: ~2 rows (approximately)
REPLACE INTO `companys` (`id`, `company_desc`, `created_at`, `updated_at`) VALUES
	(1, 'Indonesia Thai Summit Auto', '2025-05-06 02:56:13', '2025-05-05 23:34:53'),
	(2, 'Indonesia Thai Summit Plastech', '2025-05-06 02:56:30', NULL);

-- Dumping structure for table portal-itsa.departments
CREATE TABLE IF NOT EXISTS `departments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `description` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table portal-itsa.departments: ~17 rows (approximately)
REPLACE INTO `departments` (`id`, `description`, `created_at`, `updated_at`) VALUES
	(1, 'Accounting/Finance/CIC', '2025-05-06 02:55:22', NULL),
	(2, 'HQ Office', '2025-05-06 02:55:23', NULL),
	(3, 'HR/GA/HSE', '2025-05-06 02:55:24', NULL),
	(4, 'Plant Maintenance', '2025-05-06 02:55:24', NULL),
	(5, 'Marketing', '2025-05-06 02:55:25', NULL),
	(6, 'Production', '2025-05-06 02:55:26', NULL),
	(7, 'Engineering & MERD', '2025-05-06 02:55:26', NULL),
	(8, 'Purchasing', '2025-05-06 02:55:27', NULL),
	(9, 'Quality Assurance', '2025-05-06 02:55:28', NULL),
	(10, 'SYD/IT', '2025-05-06 02:55:29', NULL),
	(11, 'PPIC & SND (Outbound)', '2025-05-06 02:55:29', NULL),
	(12, 'PPIC & SND', '2025-05-06 02:55:30', NULL),
	(13, 'Maintenance Dies', '2025-05-06 02:55:31', NULL),
	(14, 'Production Engineering', '2025-05-06 02:55:32', NULL),
	(15, 'Personal Assistant', '2025-05-06 02:55:33', NULL),
	(16, 'Warehouse', '2025-05-06 02:55:33', NULL),
	(17, 'PPIC', '2025-05-06 02:55:34', NULL);

-- Dumping structure for table portal-itsa.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table portal-itsa.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table portal-itsa.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table portal-itsa.migrations: ~15 rows (approximately)
REPLACE INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2022_05_13_015148_laratrust_setup_tables', 1),
	(5, '2022_05_13_020037_create_module_table', 1),
	(6, '2022_05_13_025220_create_modules_table', 1),
	(7, '2025_05_05_033006_create_departments_table', 2),
	(8, '2025_05_05_033441_create_positions_table', 2),
	(9, '2025_05_05_033759_create_companys_table', 2),
	(10, '2025_05_06_012615_create_type_of_reqforms_table', 3),
	(11, '2025_05_06_083954_create_request_dar_table', 4),
	(12, '2025_05_08_073335_create_request_type_desc_table', 5),
	(13, '2025_05_08_083122_create_request_desc_table', 6),
	(14, '2025_05_23_022011_create_service_table', 7),
	(15, '2025_05_23_022227_create_news_table', 8);

-- Dumping structure for table portal-itsa.modules
CREATE TABLE IF NOT EXISTS `modules` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `modules_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table portal-itsa.modules: ~11 rows (approximately)
REPLACE INTO `modules` (`id`, `name`, `created_at`, `updated_at`) VALUES
	(1, 'Module Setting', '2022-05-17 00:26:49', '2022-05-18 00:47:08'),
	(2, 'Module', '2022-05-17 00:26:49', '2022-05-17 00:26:49'),
	(3, 'Module Permission', '2022-05-17 00:26:49', '2022-05-17 00:26:49'),
	(4, 'Module User', '2022-05-17 00:26:49', '2022-05-17 00:26:49'),
	(5, 'Module Role', '2022-05-17 00:26:49', '2022-05-17 00:26:49'),
	(13, 'Document Action Request', '2025-05-02 00:51:13', '2025-05-02 00:51:13'),
	(14, 'Module Company', '2025-05-05 21:51:03', '2025-05-05 21:51:03'),
	(15, 'Module Department', '2025-05-05 21:51:13', '2025-05-05 21:51:13'),
	(16, 'Module Position', '2025-05-05 21:51:24', '2025-05-05 21:51:24'),
	(17, 'Portal ITSA ( News )', '2025-05-22 21:02:28', '2025-05-22 21:03:22'),
	(18, 'Portal ITSA ( Service )', '2025-05-22 21:03:36', '2025-05-22 21:03:36');

-- Dumping structure for table portal-itsa.news
CREATE TABLE IF NOT EXISTS `news` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `users_id` int(11) NOT NULL,
  `dept_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pic` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table portal-itsa.news: ~1 rows (approximately)
REPLACE INTO `news` (`id`, `users_id`, `dept_id`, `role_id`, `title`, `pic`, `description`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
	(2, 1, 0, 1, 'Champions KIIC SPort', '2.png', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'admin-itsa', '2025-05-23 02:35:38', NULL, NULL);

-- Dumping structure for table portal-itsa.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table portal-itsa.password_resets: ~0 rows (approximately)

-- Dumping structure for table portal-itsa.permissions
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `module_id` bigint(20) unsigned NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=97 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table portal-itsa.permissions: ~57 rows (approximately)
REPLACE INTO `permissions` (`id`, `name`, `display_name`, `description`, `module_id`, `created_at`, `updated_at`) VALUES
	(1, 'manage-setting', 'Manage Setting', 'Bisa Memanage Setting', 1, '2022-05-17 00:26:49', '2022-05-17 00:26:49'),
	(2, 'create-setting', 'Create Setting', 'Bisa Membuat Setting', 1, '2022-05-17 00:26:49', '2022-05-17 00:26:49'),
	(3, 'edit-setting', 'Edit Setting', 'Bisa Mengedit Setting', 1, '2022-05-17 00:26:49', '2022-05-17 00:26:49'),
	(4, 'manage-module', 'Manage Module', 'Bisa Memanage Module', 2, '2022-05-17 00:26:49', '2022-05-17 00:26:49'),
	(5, 'create-module', 'Create Module', 'Bisa Membuat Module', 2, '2022-05-17 00:26:49', '2022-05-17 00:26:49'),
	(6, 'edit-module', 'Edit Module', 'Bisa Mengedit Module', 2, '2022-05-17 00:26:49', '2022-05-17 00:26:49'),
	(7, 'delete-module', 'Delete Module', 'Bisa Menghapus Module', 2, '2022-05-17 00:26:49', '2022-05-17 00:26:49'),
	(8, 'manage-permission', 'Manage Permission', 'Bisa Memanage Permission', 3, '2022-05-17 00:26:49', '2022-05-17 00:26:49'),
	(9, 'edit-permission', 'Edit Permission', 'Bisa Mengedit Permission', 3, '2022-05-17 00:26:49', '2022-05-17 00:26:49'),
	(10, 'manage-user', 'Manage User', 'Bisa Memanage User', 4, '2022-05-17 00:26:49', '2022-05-17 00:26:49'),
	(11, 'create-user', 'Create User', 'Bisa Membuat User', 4, '2022-05-17 00:26:49', '2022-05-17 00:26:49'),
	(12, 'edit-user', 'Edit User', 'Bisa Mengedit User', 4, '2022-05-17 00:26:49', '2022-05-17 00:26:49'),
	(13, 'reset-password', 'Reset Password User', 'Bisa Mengganti Password User', 4, '2022-05-17 00:26:49', '2022-05-17 00:26:49'),
	(14, 'manage-account', 'Manage Account Profile', 'Bisa Memanage Profile', 4, '2022-05-17 00:26:49', '2022-05-17 00:26:49'),
	(15, 'edit-account', 'Edit Account Profile', 'Bisa Mengedit Profile', 4, '2022-05-17 00:26:49', '2022-05-17 00:26:49'),
	(16, 'change-password-account', 'Reset Password Profile', 'Bisa Mengganti Password Profile', 4, '2022-05-17 00:26:49', '2022-05-17 00:26:49'),
	(17, 'manage-role', 'Manage Role', 'Bisa Memanage Role', 5, '2022-05-17 00:26:49', '2022-05-17 00:26:49'),
	(18, 'create-role', 'Create Role', 'Bisa Membuat Role', 5, '2022-05-17 00:26:49', '2022-05-17 00:26:49'),
	(19, 'edit-role', 'Edit Role', 'Bisa Mengedit Role', 5, '2022-05-17 00:26:49', '2022-05-17 00:26:49'),
	(22, 'create-permission', 'Create permission', 'Bisa menambahkan permission', 3, '2022-05-17 21:35:20', '2022-05-17 21:35:20'),
	(24, 'delete-permission', 'Delete Permission', 'Bisa menghapus permission', 3, '2022-05-17 21:39:22', '2022-05-17 21:39:22'),
	(25, 'delete-role', 'Delete Role', 'Bisa menghapus Role', 5, '2022-05-17 21:42:23', '2022-05-17 21:42:52'),
	(26, 'delete-user', 'Delete user', 'Bisa menghapus user', 4, '2022-05-17 21:44:50', '2022-05-17 21:44:50'),
	(63, 'manage-dar-system', 'manage dar system', 'list manage dar system', 13, '2025-05-02 00:54:57', '2025-05-02 00:54:57'),
	(64, 'manage-company', 'manage company', 'untuk list data company', 14, '2025-05-05 22:57:49', '2025-05-05 22:57:49'),
	(65, 'manage-department', 'manage department', 'untuk list data department', 15, '2025-05-05 22:58:51', '2025-05-05 22:58:51'),
	(66, 'manage-position', 'manage position', 'untuk list data position', 16, '2025-05-05 22:59:19', '2025-05-05 22:59:19'),
	(67, 'create-company', 'create company', 'add company', 14, '2025-05-05 23:13:34', '2025-05-05 23:13:34'),
	(68, 'edit-company', 'edit company', 'untuk perubahan company', 14, '2025-05-05 23:29:38', '2025-05-05 23:29:38'),
	(69, 'delete-company', 'delete company', 'untuk menghapus company', 14, '2025-05-05 23:30:05', '2025-05-05 23:30:05'),
	(70, 'create-department', 'create department', 'untuk menambahkan data department', 15, '2025-05-05 23:39:06', '2025-05-05 23:39:06'),
	(71, 'edit-department', 'edit department', 'untuk mengubah data department', 15, '2025-05-05 23:39:37', '2025-05-05 23:39:37'),
	(72, 'delete-department', 'delete department', 'untuk menghapus department', 15, '2025-05-05 23:40:01', '2025-05-05 23:40:01'),
	(73, 'create-position', 'create position', 'untuk menambahkan position', 16, '2025-05-05 23:55:35', '2025-05-05 23:55:35'),
	(74, 'edit-position', 'edit position', 'untuk mengubah position', 16, '2025-05-05 23:56:01', '2025-05-05 23:56:01'),
	(75, 'delete-position', 'delete position', 'untuk menghapus position', 16, '2025-05-05 23:56:38', '2025-05-05 23:56:38'),
	(76, 'show-use', 'show user', 'detail users', 4, '2025-05-06 00:19:09', '2025-05-06 00:22:01'),
	(77, 'create-reqdar', 'create reqdar', 'add request dar system', 13, '2025-05-07 20:26:34', '2025-05-07 20:26:34'),
	(78, 'show-dar', 'show dar', 'untuk show data dar', 13, '2025-05-09 02:01:48', '2025-05-09 02:01:48'),
	(79, 'edit-dar', 'edit dar', 'untuk mengubah dar', 13, '2025-05-12 23:19:18', '2025-05-12 23:19:18'),
	(80, 'approved-by1', 'approved by1', 'persetujuan atasan', 13, '2025-05-17 09:10:26', '2025-05-17 09:10:26'),
	(81, 'rejected-appr1', 'rejected appr1', 'penolakan dari approval 1', 13, '2025-05-17 11:32:16', '2025-05-17 11:32:16'),
	(82, 'approved-by2', 'approved by2', 'approved sysdev', 13, '2025-05-19 02:57:01', '2025-05-19 02:57:01'),
	(83, 'rejected-appr2', 'rejected appr2', 'rejected sysdev', 13, '2025-05-19 02:57:41', '2025-05-19 02:57:41'),
	(84, 'approved-by3', 'approved by3', 'approval terakhir', 13, '2025-05-19 18:40:00', '2025-05-19 18:40:00'),
	(85, 'rejected-by3', 'rejected by3', 'reject dari manager it', 13, '2025-05-19 18:42:20', '2025-05-19 18:42:20'),
	(86, 'delete-dar', 'delete dar', 'menghapus dar pengajuan', 13, '2025-05-19 23:14:45', '2025-05-19 23:14:45'),
	(87, 'manage-portalitsa-service', 'manage portalitsa service', 'manage portalitsa service', 18, '2025-05-22 21:21:19', '2025-05-22 21:21:19'),
	(88, 'create-portalitsa-service', 'create portalitsa service', 'create portalitsa service', 18, '2025-05-22 21:21:35', '2025-05-22 21:21:35'),
	(89, 'show-portalitsa-service', 'show portalitsa service', 'show portalitsa service', 18, '2025-05-22 21:21:50', '2025-05-22 21:21:50'),
	(90, 'edit-portalitsa-service', 'edit portalitsa service', 'edit portalitsa service', 18, '2025-05-22 21:22:24', '2025-05-22 21:22:24'),
	(91, 'delete-portalitsa-service', 'delete portalitsa service', 'delete portalitsa service', 18, '2025-05-22 21:23:58', '2025-05-22 21:23:58'),
	(92, 'manage-portalitsa-news', 'manage portalitsa news', 'manage portalitsa news', 17, '2025-05-22 21:25:44', '2025-05-22 21:25:44'),
	(93, 'create-portalitsa-news', 'create portalitsa news', 'create portalitsa news', 17, '2025-05-22 21:26:48', '2025-05-22 21:26:48'),
	(94, 'show-portalitsa-news', 'show portalitsa news', 'show portalitsa news', 17, '2025-05-22 21:27:12', '2025-05-22 21:27:12'),
	(95, 'edit-portalitsa-news', 'edit portalitsa news', 'edit portalitsa news', 17, '2025-05-22 21:29:58', '2025-05-22 21:29:58'),
	(96, 'delete-portalitsa-news', 'delete portalitsa news', 'delete portalitsa news', 17, '2025-05-22 21:30:16', '2025-05-22 21:30:16');

-- Dumping structure for table portal-itsa.permission_role
CREATE TABLE IF NOT EXISTS `permission_role` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `permission_role_role_id_foreign` (`role_id`),
  CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table portal-itsa.permission_role: ~66 rows (approximately)
REPLACE INTO `permission_role` (`permission_id`, `role_id`) VALUES
	(1, 1),
	(2, 1),
	(4, 1),
	(5, 1),
	(6, 1),
	(7, 1),
	(8, 1),
	(9, 1),
	(10, 1),
	(11, 1),
	(12, 1),
	(13, 1),
	(14, 1),
	(15, 1),
	(16, 1),
	(17, 1),
	(18, 1),
	(19, 1),
	(22, 1),
	(24, 1),
	(25, 1),
	(26, 1),
	(63, 1),
	(64, 1),
	(65, 1),
	(66, 1),
	(67, 1),
	(68, 1),
	(69, 1),
	(70, 1),
	(71, 1),
	(72, 1),
	(73, 1),
	(74, 1),
	(75, 1),
	(76, 1),
	(78, 1),
	(79, 1),
	(86, 1),
	(87, 1),
	(88, 1),
	(89, 1),
	(90, 1),
	(91, 1),
	(92, 1),
	(93, 1),
	(94, 1),
	(95, 1),
	(96, 1),
	(63, 3),
	(77, 3),
	(78, 3),
	(79, 3),
	(63, 4),
	(78, 4),
	(80, 4),
	(81, 4),
	(63, 5),
	(78, 5),
	(79, 5),
	(82, 5),
	(83, 5),
	(63, 6),
	(78, 6),
	(84, 6),
	(85, 6);

-- Dumping structure for table portal-itsa.permission_user
CREATE TABLE IF NOT EXISTS `permission_user` (
  `permission_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `user_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`user_id`,`permission_id`,`user_type`),
  KEY `permission_user_permission_id_foreign` (`permission_id`),
  CONSTRAINT `permission_user_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table portal-itsa.permission_user: ~0 rows (approximately)

-- Dumping structure for table portal-itsa.positions
CREATE TABLE IF NOT EXISTS `positions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `position_desc` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table portal-itsa.positions: ~19 rows (approximately)
REPLACE INTO `positions` (`id`, `position_desc`, `created_at`, `updated_at`) VALUES
	(1, 'Administration', '2025-05-06 02:59:15', NULL),
	(2, 'Assistant Manager', '2025-05-06 02:59:16', NULL),
	(3, 'Driver', '2025-05-06 02:59:16', NULL),
	(4, 'Engineer', '2025-05-06 02:59:20', NULL),
	(5, 'Foreman', '2025-05-06 02:59:20', NULL),
	(6, 'General Manager', '2025-05-06 02:59:21', NULL),
	(7, 'Inspector', '2025-05-06 02:59:22', NULL),
	(8, 'Leader', '2025-05-06 02:59:23', NULL),
	(9, 'Manager', '2025-05-06 02:59:23', NULL),
	(10, 'Managing Director', '2025-05-06 02:59:24', NULL),
	(11, 'Officer', '2025-05-06 02:59:25', NULL),
	(12, 'Operator', '2025-05-06 02:59:26', NULL),
	(13, 'Senior Officer', '2025-05-06 02:59:26', NULL),
	(14, 'Supervisor', '2025-05-06 02:59:27', NULL),
	(15, 'Technician', '2025-05-06 02:59:28', NULL),
	(16, 'Nurse', '2025-05-06 02:59:29', NULL),
	(17, 'Personal Assistant Executive', '2025-05-06 02:59:29', NULL),
	(18, 'Section Chief', '2025-05-06 02:59:30', NULL),
	(19, 'Advisor', '2025-05-06 02:59:30', NULL);

-- Dumping structure for table portal-itsa.request_dar
CREATE TABLE IF NOT EXISTS `request_dar` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `number_dar` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nik_req` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nik_atasan` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dept_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `position_id` int(11) NOT NULL,
  `typereqform_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `request_desc_id` int(11) NOT NULL,
  `name_doc` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_doc` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty_pages` int(11) NOT NULL,
  `reason` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_date` datetime NOT NULL,
  `file_doc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `storage_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rev_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `approval_by1` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `approval_date1` datetime DEFAULT NULL,
  `approval_status1` enum('0','1','2') COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '0 = waiting approval\r\n1 = approval\r\n2 = reject',
  `remark_approval_by1` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `approval_by2` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `approval_date2` datetime DEFAULT NULL,
  `approval_status2` enum('0','1','2') COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '0 = waiting approval',
  `remark_approval_by2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `approval_by3` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `approval_date3` datetime DEFAULT NULL,
  `approval_status3` enum('0','1','2') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remark_approval_by3` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by_1` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_bydate_1` datetime DEFAULT NULL,
  `updated_by_2` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_bydate_2` datetime DEFAULT NULL,
  `status` enum('1','2') COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '1 = Open, 2 = Close',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table portal-itsa.request_dar: ~0 rows (approximately)
REPLACE INTO `request_dar` (`id`, `number_dar`, `nik_req`, `nik_atasan`, `dept_id`, `company_id`, `position_id`, `typereqform_id`, `user_id`, `request_desc_id`, `name_doc`, `no_doc`, `qty_pages`, `reason`, `created_by`, `created_date`, `file_doc`, `storage_type`, `rev_no`, `approval_by1`, `approval_date1`, `approval_status1`, `remark_approval_by1`, `approval_by2`, `approval_date2`, `approval_status2`, `remark_approval_by2`, `approval_by3`, `approval_date3`, `approval_status3`, `remark_approval_by3`, `updated_by_1`, `updated_bydate_1`, `updated_by_2`, `updated_bydate_2`, `status`) VALUES
	(18, '05/001', '999.99.99', '966.96.96', 6, 1, 11, 8, 3, 3, 'Form Scrap Calculation', 'FG-HHJD-HI', 1, 'ubah document', '999.99.99', '2025-05-20 07:46:14', 'public/dar_documents/2025-05/1747727174_Summary Computer Checking Result.pdf', 'year', '1', 'Manager', NULL, '0', NULL, 'Sys Dev', NULL, '0', NULL, 'Manager SysDev & IT', NULL, '0', NULL, NULL, NULL, NULL, NULL, '1');

-- Dumping structure for table portal-itsa.request_desc
CREATE TABLE IF NOT EXISTS `request_desc` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `request_descript` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table portal-itsa.request_desc: ~3 rows (approximately)
REPLACE INTO `request_desc` (`id`, `request_descript`, `created_at`, `updated_at`) VALUES
	(1, 'NEW ISSUE', '2025-05-08 08:35:42', NULL),
	(2, 'OBSOLUTE', '2025-05-08 08:36:20', NULL),
	(3, 'REVISE', '2025-05-08 08:36:33', NULL);

-- Dumping structure for table portal-itsa.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table portal-itsa.roles: ~5 rows (approximately)
REPLACE INTO `roles` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
	(1, 'admin', 'Administrator', 'Ini adalah Role Admin', '2022-05-17 00:26:49', '2022-05-17 00:26:49'),
	(3, 'user-employee', 'user employee', 'pengguna system dar', '2025-05-06 20:39:18', '2025-05-06 20:39:18'),
	(4, 'manager', 'manager', 'approved 1', '2025-05-17 09:09:42', '2025-05-17 09:09:42'),
	(5, 'sysdev', 'sysdev', 'sysdev pengecekan', '2025-05-19 02:56:24', '2025-05-19 02:56:24'),
	(6, 'manager-it', 'manager it', 'approved terakhir dari dar system', '2025-05-19 18:33:49', '2025-05-19 18:33:49');

-- Dumping structure for table portal-itsa.role_user
CREATE TABLE IF NOT EXISTS `role_user` (
  `role_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `user_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`,`user_type`),
  KEY `role_user_role_id_foreign` (`role_id`),
  CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table portal-itsa.role_user: ~7 rows (approximately)
REPLACE INTO `role_user` (`role_id`, `user_id`, `user_type`) VALUES
	(1, 1, 'App\\User'),
	(1, 8, 'App\\User'),
	(3, 3, 'App\\User'),
	(3, 6, 'App\\User'),
	(4, 4, 'App\\User'),
	(5, 5, 'App\\User'),
	(6, 7, 'App\\User');

-- Dumping structure for table portal-itsa.service
CREATE TABLE IF NOT EXISTS `service` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table portal-itsa.service: ~2 rows (approximately)
REPLACE INTO `service` (`id`, `title`, `description`, `created_by`, `created_at`, `updated_at`, `updated_by`) VALUES
	(1, 'Document Action Request System', 'An efficient and structured system for submitting, approving and tracking company documents.', 'admin', '2025-05-23 03:39:44', NULL, NULL),
	(2, 'Digital Asset Registration', 'Management of corporate digital assets with high security and ease of access for authorized users.', 'admin', '2025-05-23 03:43:25', NULL, NULL);

-- Dumping structure for table portal-itsa.type_of_reqforms
CREATE TABLE IF NOT EXISTS `type_of_reqforms` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `request_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table portal-itsa.type_of_reqforms: ~9 rows (approximately)
REPLACE INTO `type_of_reqforms` (`id`, `request_type`, `created_at`, `updated_at`) VALUES
	(1, 'Quality Control Flow Char (QCF)\r\n', '2025-05-06 01:35:20', NULL),
	(2, 'Quality Control Plan (QCP)', '2025-05-06 01:35:21', NULL),
	(3, 'Standard Operation Procedure (SOP)', '2025-05-06 01:35:22', NULL),
	(4, 'Inspection Standard ( IS )', '2025-05-06 01:35:49', NULL),
	(5, 'Quality Manual (QM)', '2025-05-06 01:36:26', NULL),
	(6, 'System Procedure ( SP )', '2025-05-06 01:36:52', NULL),
	(7, 'Work Instruction ( WI )', '2025-05-06 01:37:22', NULL),
	(8, 'Form, Checkseet, Support Doc', '2025-05-06 01:37:42', NULL),
	(9, 'Other Doc', '2025-05-06 01:38:50', NULL);

-- Dumping structure for table portal-itsa.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nik` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department_id` int(11) NOT NULL DEFAULT '0',
  `position_id` int(11) NOT NULL DEFAULT '0',
  `company_id` int(11) NOT NULL DEFAULT '0',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_username_unique` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table portal-itsa.users: ~7 rows (approximately)
REPLACE INTO `users` (`id`, `name`, `email`, `username`, `nik`, `department_id`, `position_id`, `company_id`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'admin-itsa', 'admin@gmail.com', 'admin', '111.11.11', 0, 0, 0, NULL, '$2y$10$tTyzV0K8C7vi/LrpYIznduJU8oDrSechvHm5AgO5S0MsBKT9e1.Mm', 'VMMKMfp0OTbs38eaHVIb7im5pqVu89yJU2JESrhNWTDgVqGEUoCKbK3dpobd', '2022-05-17 00:26:49', '2023-11-14 21:25:23'),
	(2, 'Wildan Fathur Rohman', 'it-03@thaisummit.co.id', 'wildanfr', '943.04.25', 10, 11, 1, NULL, '$2y$10$erCl0A6vAO9m4jvBAr5bhOTY4b5Au1lv1BVi/blcMsr1ZAGopVjUK', NULL, '2025-05-05 20:30:05', '2025-05-05 21:07:00'),
	(3, 'user1', 'user1@gmail.com', 'user1', '999.99.99', 6, 11, 1, NULL, '$2y$10$uQnjMQuQtcMnVMsDv1pxRuOCKl/SeRdi6iaVi9Pqg13LtVvSIaQ0O', NULL, '2025-05-06 20:59:02', '2025-05-06 20:59:02'),
	(4, 'user2-manager', 'user2@thaisummit.co.id', 'user2-manager', '966.96.96', 6, 9, 1, NULL, '$2y$10$rGv5v8aPHb9Ie2B3X7g7Oeb3jWwG0irAiIVrFiCg0CaRU2ZH6zWfO', NULL, '2025-05-17 09:17:08', '2025-05-17 09:17:08'),
	(5, 'Ronal Rusdianto', 'syd-01@thaisummit.co.id', 'ronalrus', '480.11.12', 10, 11, 1, NULL, '$2y$10$gY8WEZqXYtv8zejsHWHqo.yfR40WVo15D9Kuu54dcIuNOjrEFmrg2', NULL, '2025-05-19 02:58:43', '2025-05-19 18:47:52'),
	(6, 'user4', 'user4@thaisummit.co.id', 'user4', '777.77.77', 9, 11, 1, NULL, '$2y$10$lFDzjEMnW7dtxXa3MaR/Geqpg7Cw2Clcuw11fPyimyMiFgC2NeY3e', NULL, '2025-05-19 03:02:53', '2025-05-19 03:02:53'),
	(7, 'Wida Mustika Sari', 'wida.mus@thaisummit.co.id', 'widamus', '115.08.08', 10, 9, 1, NULL, '$2y$10$f94sn0uQvqrbmV.hzrW/eeoJxNTif4FWZl88r3Gktq.2VfP1k7OWK', NULL, '2025-05-19 18:37:03', '2025-05-19 18:37:03'),
	(8, 'Didin Jahrudin', 'it-01@thaisummit.co.id', 'didinjah', '630.07.14', 10, 13, 1, NULL, '$2y$10$jvHx15BfyhCOFws5kRPGVuZHyEGJzKBAdMw7ATd5bbRDFK55NQZR2', NULL, '2025-05-20 18:22:36', '2025-05-20 18:26:19');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
