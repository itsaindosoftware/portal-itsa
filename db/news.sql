-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.24 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             12.8.0.6951
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

-- Dumping structure for table portal-itsa.news
CREATE TABLE IF NOT EXISTS `news` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `users_id` int(11) NOT NULL,
  `dept_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `excerpt` text COLLATE utf8mb4_unicode_ci,
  `pic` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_description` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `category` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `status` enum('active','inactive','draft') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `published_at` timestamp NULL DEFAULT NULL,
  `views_count` int(11) DEFAULT '0',
  `created_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_by` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table portal-itsa.news: ~2 rows (approximately)
INSERT IGNORE INTO `news` (`id`, `users_id`, `dept_id`, `role_id`, `title`, `slug`, `excerpt`, `pic`, `description`, `meta_description`, `category`, `status`, `published_at`, `views_count`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
	(3, 1, 0, 1, 'Champions KIIC Sport', 'champions-kiic-sport', 'tes', '2.png', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.', NULL, 'event', 'active', '2025-05-24 01:50:00', 0, 'admin-itsa', '2025-05-23 17:30:04', 'admin-itsa', '2025-05-23 18:50:37'),
	(4, 1, 0, 1, 'Thai Summit Grup Thailand', 'thai-summit-grup-thailand', 'We are pleased and honored to have received CHANGAN\'s first job, We truly appreciate CHANGAN\'s trust and confidence in our company.\r\n                    Thai Summit Group is greatly delighted to be on...', 'Changan.jpg', 'We are pleased and honored to have received CHANGAN\'s first job, We truly appreciate CHANGAN\'s trust and confidence in our company.\r\n                    Thai Summit Group is greatly delighted to be one of the automotive parts suppliers and to have a business-related partnership that strengthens the excellent connection between CHANGAN and Thai Summit Group.', NULL, 'general', 'active', '2025-05-24 02:25:00', 0, 'admin-itsa', '2025-05-23 19:25:51', 'admin-itsa', NULL);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
