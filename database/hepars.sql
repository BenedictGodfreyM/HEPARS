-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 21, 2025 at 05:13 PM
-- Server version: 8.2.0
-- PHP Version: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hepars`
--

-- --------------------------------------------------------

--
-- Table structure for table `accreditations`
--

DROP TABLE IF EXISTS `accreditations`;
CREATE TABLE IF NOT EXISTS `accreditations` (
  `id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating` int UNSIGNED NOT NULL,
  `description` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `accreditations`
--

INSERT INTO `accreditations` (`id`, `status`, `rating`, `description`, `created_at`, `updated_at`) VALUES
('41358efa03b04af26873859fe9e15980', 'Accredited', 3, 'The recognition or approval of a higher education institution by a National Regulatory Authority (Accreditation Agency), that it has met specific quality standards.', '2025-05-17 03:07:14', '2025-05-17 08:00:12'),
('78650ff3a5ceb7df49483dde5273cb7f', 'Provisional Licence', 1, 'A temporary authorization given to a higher education institution by a National Regulatory Authority to operate (under strict monitoring) before it receives full accreditation or a full operational license.', '2025-05-17 03:44:41', '2025-05-17 08:19:21'),
('ca4008b0665abc6dd50630d6f047f7fb', 'Chartered', 4, 'A higher level of recognition that grants a higher education institution legal autonomy to operate fully, award degrees, and govern itself. Signifies a high level of competency and commitment to professional development (Recognition of expertise and career advancement).', '2025-05-17 03:30:20', '2025-05-17 08:16:01'),
('f9908a5af2b38b637fe4d8fd395dcffb', 'Certificate of Full Registration', 2, 'A confirmation that a higher education institution has met all regulatory requirements to operate as a full institution.', '2025-05-17 03:46:57', '2025-05-17 08:25:47');

-- --------------------------------------------------------

--
-- Table structure for table `accreditation_institutions`
--

DROP TABLE IF EXISTS `accreditation_institutions`;
CREATE TABLE IF NOT EXISTS `accreditation_institutions` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `accreditation_id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `institution_id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `accreditation_institutions_accreditation_id_index` (`accreditation_id`),
  KEY `accreditation_institutions_institution_id_index` (`institution_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `accreditation_institutions`
--

INSERT INTO `accreditation_institutions` (`id`, `accreditation_id`, `institution_id`, `created_at`, `updated_at`) VALUES
(1, '41358efa03b04af26873859fe9e15980', '24c41e67b7e00c6fd19b14a5efae3a98', NULL, NULL),
(2, 'ca4008b0665abc6dd50630d6f047f7fb', '24c41e67b7e00c6fd19b14a5efae3a98', NULL, NULL),
(3, '41358efa03b04af26873859fe9e15980', '84ec1ffdd439490c07875ae45c1dc7fb', NULL, NULL),
(4, 'ca4008b0665abc6dd50630d6f047f7fb', '84ec1ffdd439490c07875ae45c1dc7fb', NULL, NULL),
(5, '41358efa03b04af26873859fe9e15980', 'a71a936a22c94f3044a88a1a0acf05fb', NULL, NULL),
(6, 'ca4008b0665abc6dd50630d6f047f7fb', 'a71a936a22c94f3044a88a1a0acf05fb', NULL, NULL),
(8, '41358efa03b04af26873859fe9e15980', 'e7d789969965d30b5d782ed901f42c75', NULL, NULL),
(9, 'ca4008b0665abc6dd50630d6f047f7fb', 'e7d789969965d30b5d782ed901f42c75', NULL, NULL),
(10, '41358efa03b04af26873859fe9e15980', 'b7fb61dae18f53addadd288f2520c403', NULL, NULL),
(11, '41358efa03b04af26873859fe9e15980', '42f508e25f6fd1acaef522ae85454ca6', NULL, NULL),
(12, '41358efa03b04af26873859fe9e15980', 'a2b59dfcf839e4079ea325986087fc53', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `careers`
--

DROP TABLE IF EXISTS `careers`;
CREATE TABLE IF NOT EXISTS `careers` (
  `id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `field_id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `careers_field_id_index` (`field_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `careers`
--

INSERT INTO `careers` (`id`, `field_id`, `name`, `created_at`, `updated_at`) VALUES
('1805feb784292d77558aae27626e3a48', '50454887affd0f1dcf0354a77aae629d', 'Dentist', '2025-05-15 08:54:22', '2025-05-15 08:54:22'),
('19497335aad6392de992c7b8f2a3fdd8', '50454887affd0f1dcf0354a77aae629d', 'Optician', '2025-05-21 14:02:27', '2025-05-21 14:02:27'),
('26088e3530229d17b5e395e67648f469', '08e5be3d6ec275be8b4c8c819c10309a', 'Environmental Laboratory Technician', '2025-05-15 08:54:50', '2025-05-16 13:11:00'),
('29d7071db215bca519d1488fe3f7be7f', '50454887affd0f1dcf0354a77aae629d', 'Physiotherapist', '2025-05-21 13:47:24', '2025-05-21 13:47:24'),
('2c22cee36acb001283b7fc3113a7cfeb', '50454887affd0f1dcf0354a77aae629d', 'Pharmacist', '2025-05-15 08:54:02', '2025-05-15 08:54:02'),
('3b0f0a92aa3bb442637449cc8d658510', '48f7c12599cac4824ec5f0f9a85b64db', 'Electric Engineer', '2025-05-15 08:55:28', '2025-05-15 08:55:28'),
('4ac1e1dc3a1eba40cbc01a2378d06fca', '50454887affd0f1dcf0354a77aae629d', 'Optometrist', '2025-05-21 14:06:24', '2025-05-21 14:06:24'),
('5062c48b0c35cfbdfd110720525c7776', '48f7c12599cac4824ec5f0f9a85b64db', 'Civil Engineer', '2025-05-15 08:55:07', '2025-05-15 08:55:07'),
('7828423d6bddd73825a746a660f6ddb8', '50454887affd0f1dcf0354a77aae629d', 'Occupational Therapist', '2025-05-21 14:08:16', '2025-05-21 14:08:16'),
('ae722daad34e68bfc7ed015f538124fb', '08e5be3d6ec275be8b4c8c819c10309a', 'Environmental Laboratory Scientist', '2025-05-15 08:54:42', '2025-05-15 08:54:42'),
('d64957f8870b8c106729003eac435efe', '50454887affd0f1dcf0354a77aae629d', 'Medical Doctor (MD)', '2025-05-15 08:53:32', '2025-05-15 08:53:32'),
('de43ec2245836e80a06a0f3629ef17e4', '50454887affd0f1dcf0354a77aae629d', 'Nurse', '2025-05-15 08:53:48', '2025-05-15 08:53:48'),
('f970d5cd0f935ece677bdf1d4c8b9d9c', '50454887affd0f1dcf0354a77aae629d', 'Orthotician', '2025-05-21 13:53:08', '2025-05-21 13:53:08'),
('fe4672c090b29e00ece7d2a9645d80cc', '50454887affd0f1dcf0354a77aae629d', 'Prostetician', '2025-05-21 13:52:35', '2025-05-21 13:52:35');

-- --------------------------------------------------------

--
-- Table structure for table `career_programs`
--

DROP TABLE IF EXISTS `career_programs`;
CREATE TABLE IF NOT EXISTS `career_programs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `program_id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `career_id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `career_programs_program_id_index` (`program_id`),
  KEY `career_programs_career_id_index` (`career_id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `career_programs`
--

INSERT INTO `career_programs` (`id`, `program_id`, `career_id`, `created_at`, `updated_at`) VALUES
(1, '2df21b54695076255c90a8e3bc1949a0', 'ae722daad34e68bfc7ed015f538124fb', NULL, NULL),
(2, '2df21b54695076255c90a8e3bc1949a0', '26088e3530229d17b5e395e67648f469', NULL, NULL),
(3, 'acde11ba72feede28e96137d431ca186', '5062c48b0c35cfbdfd110720525c7776', NULL, NULL),
(4, '274abe94a2938438bc3d3a0a422da8c3', 'de43ec2245836e80a06a0f3629ef17e4', NULL, NULL),
(5, '5499b5d315f03a7b33f880eb88545fe6', '1805feb784292d77558aae27626e3a48', NULL, NULL),
(6, '6c71a7bbb3398a769abfb1fadb5929a1', 'd64957f8870b8c106729003eac435efe', NULL, NULL),
(7, 'c7d1b2fc3b1195b94195450ae9c0c9b5', '2c22cee36acb001283b7fc3113a7cfeb', NULL, NULL),
(8, '63d4bd5e98166ae14a5599b9f85ab96f', 'ae722daad34e68bfc7ed015f538124fb', NULL, NULL),
(9, '63d4bd5e98166ae14a5599b9f85ab96f', '26088e3530229d17b5e395e67648f469', NULL, NULL),
(13, '874f91396a7c6f62b220f9bc1ba7b8f3', 'd64957f8870b8c106729003eac435efe', NULL, NULL),
(14, '019ce65024551f545ac4fb88298394bc', 'de43ec2245836e80a06a0f3629ef17e4', NULL, NULL),
(15, 'd4899639b1243eeef21e33c0cfeb4135', 'd64957f8870b8c106729003eac435efe', NULL, NULL),
(16, 'f5845528dcf197cd15473140e6713950', 'de43ec2245836e80a06a0f3629ef17e4', NULL, NULL),
(17, '719fc401b6ea6fa2cf3ff0ed314e8d98', 'ae722daad34e68bfc7ed015f538124fb', NULL, NULL),
(18, '719fc401b6ea6fa2cf3ff0ed314e8d98', '26088e3530229d17b5e395e67648f469', NULL, NULL),
(19, 'd00189b5bb76a8f2f842e760b609f532', '29d7071db215bca519d1488fe3f7be7f', NULL, NULL),
(20, 'caca892a97f4296c3efaf481a0c56f2b', 'fe4672c090b29e00ece7d2a9645d80cc', NULL, NULL),
(21, 'caca892a97f4296c3efaf481a0c56f2b', 'f970d5cd0f935ece677bdf1d4c8b9d9c', NULL, NULL),
(22, 'c731182b3060cbed02f070022cf3de30', '19497335aad6392de992c7b8f2a3fdd8', NULL, NULL),
(23, 'c731182b3060cbed02f070022cf3de30', '4ac1e1dc3a1eba40cbc01a2378d06fca', NULL, NULL),
(24, '3d5c922db3b67c46ffbaf9195a03043f', '7828423d6bddd73825a746a660f6ddb8', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `combinations`
--

DROP TABLE IF EXISTS `combinations`;
CREATE TABLE IF NOT EXISTS `combinations` (
  `id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `category` enum('Natural Science','Arts') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `combinations`
--

INSERT INTO `combinations` (`id`, `name`, `created_at`, `updated_at`, `category`) VALUES
('006744490469cf2fcacfca50141c746c', 'CBA', '2025-05-09 10:17:11', '2025-05-18 10:37:59', 'Natural Science'),
('0c81c36325cf1f923ba619e86516b910', 'CBN', '2025-05-09 10:18:06', '2025-05-18 10:38:16', 'Natural Science'),
('311049eadf26eae39d65add0c9e84ac4', 'CBG', '2025-05-08 10:27:45', '2025-05-18 10:37:47', 'Natural Science'),
('4810ed06fcbe93d369bb022042ed4e90', 'KLF', '2025-05-09 10:46:22', '2025-05-18 10:38:24', 'Arts'),
('520d274a54d9c0d931edaeab4ede799c', 'HGL', '2025-05-09 10:25:03', '2025-05-18 10:38:33', 'Arts'),
('5e89fa3a703854fc11451a8127674403', 'PGM', '2025-05-09 09:45:40', '2025-05-18 10:37:16', 'Natural Science'),
('66db45b3285aa1020574a47fc2f77e3d', 'HGE', '2025-05-08 10:21:45', '2025-05-18 10:38:41', 'Arts'),
('a2af328c3ae2af91d58d2baf66b11295', 'PCB', '2025-05-08 09:38:54', '2025-05-18 10:36:59', 'Natural Science'),
('a3b4459156823fe8ecd3d69e188f8f0e', 'EGM', '2025-05-09 09:49:32', '2025-05-18 10:37:32', 'Natural Science'),
('a5dc912be0f2908687e0e3a57d8ac7cd', 'HGK', '2025-05-09 10:37:08', '2025-05-18 10:38:50', 'Arts'),
('b6c72663f827a764811aa41a9cc3851b', 'ECA', '2025-05-09 10:50:14', '2025-05-18 10:39:00', 'Arts'),
('e95ee1e6223ef34654f74687a7fffeb3', 'PCM', '2025-05-08 10:19:49', '2025-05-18 10:36:33', 'Natural Science'),
('fce432faea73c74b6e62063263023ed6', 'HKL', '2025-05-09 10:39:10', '2025-05-18 10:39:07', 'Arts');

-- --------------------------------------------------------

--
-- Table structure for table `combination_subjects`
--

DROP TABLE IF EXISTS `combination_subjects`;
CREATE TABLE IF NOT EXISTS `combination_subjects` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `combination_id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject_id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `combination_subjects_combination_id_index` (`combination_id`),
  KEY `combination_subjects_subject_id_index` (`subject_id`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `combination_subjects`
--

INSERT INTO `combination_subjects` (`id`, `combination_id`, `subject_id`, `created_at`, `updated_at`) VALUES
(4, 'a2af328c3ae2af91d58d2baf66b11295', 'ba1c45bc4d5a9ba46387ba1837f90910', NULL, NULL),
(5, 'a2af328c3ae2af91d58d2baf66b11295', 'de52cabd871248ebd540e4c1616d8477', NULL, NULL),
(6, 'a2af328c3ae2af91d58d2baf66b11295', '79a78e4e6a080e03d3ddf5aaca20b642', NULL, NULL),
(7, 'a2af328c3ae2af91d58d2baf66b11295', '111239143c8489ef8e53421791b2c3e9', NULL, NULL),
(8, 'e95ee1e6223ef34654f74687a7fffeb3', '78a92fb99cfdc7f1e537f9caef0e0684', NULL, NULL),
(9, 'e95ee1e6223ef34654f74687a7fffeb3', '79a78e4e6a080e03d3ddf5aaca20b642', NULL, NULL),
(10, 'e95ee1e6223ef34654f74687a7fffeb3', '111239143c8489ef8e53421791b2c3e9', NULL, NULL),
(11, '66db45b3285aa1020574a47fc2f77e3d', 'ba1c45bc4d5a9ba46387ba1837f90910', NULL, NULL),
(12, '66db45b3285aa1020574a47fc2f77e3d', 'b7b5fc68fb85dd88dc124a38ec488f2c', NULL, NULL),
(13, '66db45b3285aa1020574a47fc2f77e3d', 'bbd67ff82f9f3749b72687aa7caa5bba', NULL, NULL),
(14, '66db45b3285aa1020574a47fc2f77e3d', '535e955119b624e341febdce9a5ab025', NULL, NULL),
(15, '311049eadf26eae39d65add0c9e84ac4', 'ba1c45bc4d5a9ba46387ba1837f90910', NULL, NULL),
(16, '311049eadf26eae39d65add0c9e84ac4', 'de52cabd871248ebd540e4c1616d8477', NULL, NULL),
(17, '311049eadf26eae39d65add0c9e84ac4', '79a78e4e6a080e03d3ddf5aaca20b642', NULL, NULL),
(18, '311049eadf26eae39d65add0c9e84ac4', 'bbd67ff82f9f3749b72687aa7caa5bba', NULL, NULL),
(19, '5e89fa3a703854fc11451a8127674403', '78a92fb99cfdc7f1e537f9caef0e0684', NULL, NULL),
(20, '5e89fa3a703854fc11451a8127674403', 'bbd67ff82f9f3749b72687aa7caa5bba', NULL, NULL),
(21, '5e89fa3a703854fc11451a8127674403', '111239143c8489ef8e53421791b2c3e9', NULL, NULL),
(22, 'a3b4459156823fe8ecd3d69e188f8f0e', '78a92fb99cfdc7f1e537f9caef0e0684', NULL, NULL),
(23, 'a3b4459156823fe8ecd3d69e188f8f0e', 'b7b5fc68fb85dd88dc124a38ec488f2c', NULL, NULL),
(24, 'a3b4459156823fe8ecd3d69e188f8f0e', 'bbd67ff82f9f3749b72687aa7caa5bba', NULL, NULL),
(25, '006744490469cf2fcacfca50141c746c', '921f5461645235088da06b1132a13754', NULL, NULL),
(26, '006744490469cf2fcacfca50141c746c', 'ba1c45bc4d5a9ba46387ba1837f90910', NULL, NULL),
(27, '006744490469cf2fcacfca50141c746c', 'de52cabd871248ebd540e4c1616d8477', NULL, NULL),
(28, '006744490469cf2fcacfca50141c746c', '79a78e4e6a080e03d3ddf5aaca20b642', NULL, NULL),
(29, '0c81c36325cf1f923ba619e86516b910', 'ba1c45bc4d5a9ba46387ba1837f90910', NULL, NULL),
(30, '0c81c36325cf1f923ba619e86516b910', 'de52cabd871248ebd540e4c1616d8477', NULL, NULL),
(31, '0c81c36325cf1f923ba619e86516b910', '79a78e4e6a080e03d3ddf5aaca20b642', NULL, NULL),
(32, '0c81c36325cf1f923ba619e86516b910', '17afca89d6c133ae83d57d65acc89dd2', NULL, NULL),
(33, '520d274a54d9c0d931edaeab4ede799c', '499fb4fc5cb36c9413f708e2290ee465', NULL, NULL),
(34, '520d274a54d9c0d931edaeab4ede799c', 'bbd67ff82f9f3749b72687aa7caa5bba', NULL, NULL),
(35, '520d274a54d9c0d931edaeab4ede799c', '535e955119b624e341febdce9a5ab025', NULL, NULL),
(36, 'a5dc912be0f2908687e0e3a57d8ac7cd', 'bbd67ff82f9f3749b72687aa7caa5bba', NULL, NULL),
(37, 'a5dc912be0f2908687e0e3a57d8ac7cd', '535e955119b624e341febdce9a5ab025', NULL, NULL),
(38, 'a5dc912be0f2908687e0e3a57d8ac7cd', '2e45ec206a607ba85a8cb0160e99ade4', NULL, NULL),
(39, 'fce432faea73c74b6e62063263023ed6', '499fb4fc5cb36c9413f708e2290ee465', NULL, NULL),
(40, 'fce432faea73c74b6e62063263023ed6', '535e955119b624e341febdce9a5ab025', NULL, NULL),
(41, 'fce432faea73c74b6e62063263023ed6', '2e45ec206a607ba85a8cb0160e99ade4', NULL, NULL),
(42, '4810ed06fcbe93d369bb022042ed4e90', '499fb4fc5cb36c9413f708e2290ee465', NULL, NULL),
(43, '4810ed06fcbe93d369bb022042ed4e90', 'f38d3cf78b785d2b10281ebe33c15d8c', NULL, NULL),
(44, '4810ed06fcbe93d369bb022042ed4e90', '2e45ec206a607ba85a8cb0160e99ade4', NULL, NULL),
(45, 'b6c72663f827a764811aa41a9cc3851b', '1502838edf28cac9b0390cd616bd0240', NULL, NULL),
(46, 'b6c72663f827a764811aa41a9cc3851b', '1a50115832dd08b87a189d155c62eb31', NULL, NULL),
(47, 'b6c72663f827a764811aa41a9cc3851b', 'b7b5fc68fb85dd88dc124a38ec488f2c', NULL, NULL),
(48, 'b6c72663f827a764811aa41a9cc3851b', 'ba1c45bc4d5a9ba46387ba1837f90910', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `entry_requirements`
--

DROP TABLE IF EXISTS `entry_requirements`;
CREATE TABLE IF NOT EXISTS `entry_requirements` (
  `id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `program_id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `min_total_points` int UNSIGNED NOT NULL,
  `required_subjects_count` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `entry_requirements_program_id_index` (`program_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `entry_requirements`
--

INSERT INTO `entry_requirements` (`id`, `program_id`, `min_total_points`, `required_subjects_count`, `created_at`, `updated_at`) VALUES
('017a2b6654b3311be8ef846fedf099a4', '42e1316d01cedc078337729829653b5b', 9, 3, '2025-05-12 12:50:39', '2025-05-12 12:50:39'),
('114dfda1cab341736e704fc14afd1717', '7bcc3a2490d7ee562c8dc8cac9a25bd2', 8, 3, '2025-05-12 12:48:21', '2025-05-12 12:48:21'),
('158b0a4c58b7d47097eab72e4f6f2438', '5f614befa559981f694b049ba973dd3f', 4, 2, '2025-05-12 16:10:54', '2025-05-12 16:10:54'),
('163774c4d4ed9ae4d27c6f2449df1205', 'c1368857a497441654705eba40d31c59', 6, 3, '2025-05-12 16:43:56', '2025-05-12 16:43:56'),
('1716ccb983b5b585d353b38a6a2d9841', 'ebc4a771901acd053c8f21ca146d0eb6', 4, 2, '2025-05-12 15:41:06', '2025-05-12 15:41:06'),
('26f23336f45a68778bafc17cafb89511', '50bd144ecea17982c79347fbbb0b45fd', 4, 2, '2025-05-12 15:35:22', '2025-05-12 15:35:22'),
('290d05b881a81bc39a3a3486c80803e3', '6c71a7bbb3398a769abfb1fadb5929a1', 6, 3, '2025-05-15 08:57:38', '2025-05-15 08:57:38'),
('2e8ab7c250bda54db1e02c374d6b7c2d', 'c67d1a2b2e50d41ccaef5c7cc7b857db', 4, 2, '2025-05-12 13:54:48', '2025-05-12 13:54:48'),
('2f4ee60382e42a8a10e5df917518a91a', 'acde11ba72feede28e96137d431ca186', 4, 2, '2025-05-15 08:56:43', '2025-05-15 08:56:43'),
('30973a49f205744c181fdde2ae9532b6', '2898adbdcc25d3d7b23651ee5e80abb1', 4, 2, '2025-05-10 17:26:19', '2025-05-10 17:26:19'),
('316c47edb43dd04c0193b69945453d3c', 'ba47e9cf0055abce55d33e7ad7200626', 6, 3, '2025-05-12 16:53:25', '2025-05-12 16:53:25'),
('3d85356b54a06e7d399122ff1672a78d', '1dca1fe90b6afd34e477b9405c1a1f1c', 4, 2, '2025-05-12 16:18:55', '2025-05-12 16:18:55'),
('443d3238db50436ab0ccf98ed5e35154', '719fc401b6ea6fa2cf3ff0ed314e8d98', 6, 3, '2025-05-21 13:33:58', '2025-05-21 13:33:58'),
('45b1f306a1652cb75a6472e55c62abed', '23240d5fa46f8ea7e2e8e403cbad0ffa', 4, 2, '2025-05-12 15:45:08', '2025-05-12 15:45:08'),
('4c851222374e7cc05dbe9b23f63c0336', '5631f8c13e9880d8bfa150c72589b695', 4, 2, '2025-05-11 07:43:54', '2025-05-11 07:43:54'),
('4cb419dcde84b235311983f2cacca372', '2df21b54695076255c90a8e3bc1949a0', 4, 2, '2025-05-16 11:00:19', '2025-05-16 11:00:19'),
('4d956f1bab3cd385120faf70614c5b5c', '587a540cab0235453b49f13f24770736', 4, 2, '2025-05-12 15:59:22', '2025-05-12 15:59:22'),
('60d14d0fe32e5c4e3551268b2a2a4285', 'a6d09a6a2942b5ed6c5150b4bb909b74', 4, 2, '2025-05-10 16:50:13', '2025-05-10 16:50:13'),
('63be52a9dcd364e98839296691211ba2', '63d4bd5e98166ae14a5599b9f85ab96f', 6, 3, '2025-05-15 14:59:58', '2025-05-15 14:59:58'),
('6739ceb62b0edeb899dadd9d313b793f', '508abd074cee03faa487e0d9052a1d03', 4, 2, '2025-05-12 15:31:26', '2025-05-12 15:31:26'),
('6c7116b72fd72f0cc6d80199ca9ce724', 'c731182b3060cbed02f070022cf3de30', 6, 3, '2025-05-21 14:06:49', '2025-05-21 14:06:49'),
('704f703100f09f05db5ef045c6e42dcc', '7a60250a7cd96e92cdb9d85ecbf500e7', 4, 2, '2025-05-12 16:21:53', '2025-05-12 16:21:53'),
('7929b551653cade389fae91c3bd747d5', '3d5c922db3b67c46ffbaf9195a03043f', 6, 3, '2025-05-21 14:09:30', '2025-05-21 14:09:30'),
('7a81f762b0d5b02328b8e57fe4d8fa2a', '449b2db1ef0be3148d75b31cf01b4b2f', 4, 2, '2025-05-11 07:52:05', '2025-05-11 07:52:05'),
('9331ebae62147c495cbdf0c26d9dda4f', 'df57e1e7f5710b954943617651407528', 4, 2, '2025-05-12 15:53:10', '2025-05-12 15:53:10'),
('957d080e00dc8a27786d0ee282239323', '5499b5d315f03a7b33f880eb88545fe6', 6, 3, '2025-05-15 08:57:25', '2025-05-15 08:57:25'),
('986c0220b3de868944c05264427fc1eb', '019ce65024551f545ac4fb88298394bc', 6, 3, '2025-05-19 08:45:54', '2025-05-19 08:45:54'),
('9bddf7eb97080a990aa4534e19da8de6', '874f91396a7c6f62b220f9bc1ba7b8f3', 6, 3, '2025-05-19 08:09:31', '2025-05-19 08:09:31'),
('a6c1c068d6ca3edf0444bef011db5c90', 'd4899639b1243eeef21e33c0cfeb4135', 6, 3, '2025-05-21 13:23:20', '2025-05-21 13:23:20'),
('a89c7f85d3caed62060aea512ec896ab', '274abe94a2938438bc3d3a0a422da8c3', 8, 3, '2025-05-19 07:49:35', '2025-05-19 07:49:35'),
('ac0183aef13fe44ec7da3f63dca5b8b9', 'b0e9d87e618d6a5d1257af8e36b720e2', 4, 2, '2025-05-12 15:55:54', '2025-05-12 15:55:54'),
('b11ee817938a955e00cb49ad12b72b00', '9d00aa0e1f3822e02abdcc57e0e3bc18', 6, 3, '2025-05-12 16:48:52', '2025-05-12 16:48:52'),
('b6017e72385f60d32908fb7d226b4e38', '3041a5d3546187206b68e2e34f1b498c', 4, 2, '2025-05-12 15:26:21', '2025-05-12 15:26:21'),
('cc156b96c7f260dcac131305aee63264', 'c7d1b2fc3b1195b94195450ae9c0c9b5', 6, 3, '2025-05-15 08:57:54', '2025-05-15 08:57:54'),
('cfbc415dcbb07450b763c96fff3cf8c3', '9f8815cbb3c5245a6fdf81c9d2a2191a', 4, 2, '2025-05-13 12:09:38', '2025-05-13 12:09:38'),
('d560941b852e477b4c176a7ce98c09f6', 'caca892a97f4296c3efaf481a0c56f2b', 6, 3, '2025-05-21 13:55:14', '2025-05-21 13:55:14'),
('eb4f1cb61f442e05b963e34854f1edcd', 'f5845528dcf197cd15473140e6713950', 6, 3, '2025-05-21 13:29:32', '2025-05-21 13:29:32'),
('efe0a16aa323471d3cae586c2ab7b88a', 'e490db7b5a98a0aa59eebd9ba8986bb3', 4, 2, '2025-05-11 10:27:58', '2025-05-11 10:27:58'),
('f080de0b4d3ff5b9b25d8dfc0b36d1af', '3ec5e6b0206ab1fa3d4c63ca141f24ef', 4, 2, '2025-05-11 10:20:40', '2025-05-11 10:20:40'),
('f18edaf906c6481c81569c752ac6c5f9', '32f2acf3761302ddd4f73347a49cd526', 4, 2, '2025-05-10 19:20:25', '2025-05-10 19:20:25'),
('f2265980c7f6a9819f0faafb67922666', 'd00189b5bb76a8f2f842e760b609f532', 6, 3, '2025-05-21 13:49:52', '2025-05-21 13:49:52'),
('f553ec36a0fb30e0ab05ea8128ffe7ff', '756478f8bdd193b72d499db2538b66bb', 4, 2, '2025-05-10 16:06:35', '2025-05-10 16:06:35'),
('f582d2da55509d63fe5da9bce9c66fdb', 'cd9323c76d11b08ba1b98764b68ba470', 6, 3, '2025-05-12 16:51:15', '2025-05-12 16:51:15');

-- --------------------------------------------------------

--
-- Table structure for table `entry_requirement_subjects`
--

DROP TABLE IF EXISTS `entry_requirement_subjects`;
CREATE TABLE IF NOT EXISTS `entry_requirement_subjects` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `entry_requirement_id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject_id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('required','optional','necessary') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `min_grade` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `entry_requirement_subjects_entry_requirement_id_index` (`entry_requirement_id`),
  KEY `entry_requirement_subjects_subject_id_index` (`subject_id`)
) ENGINE=InnoDB AUTO_INCREMENT=372 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `entry_requirement_subjects`
--

INSERT INTO `entry_requirement_subjects` (`id`, `entry_requirement_id`, `subject_id`, `type`, `min_grade`, `created_at`, `updated_at`) VALUES
(1, 'f553ec36a0fb30e0ab05ea8128ffe7ff', '78a92fb99cfdc7f1e537f9caef0e0684', 'necessary', 'E', NULL, NULL),
(2, 'f553ec36a0fb30e0ab05ea8128ffe7ff', '111239143c8489ef8e53421791b2c3e9', 'optional', 'E', NULL, NULL),
(3, 'f553ec36a0fb30e0ab05ea8128ffe7ff', 'bbd67ff82f9f3749b72687aa7caa5bba', 'optional', 'E', NULL, NULL),
(4, 'f553ec36a0fb30e0ab05ea8128ffe7ff', 'de52cabd871248ebd540e4c1616d8477', 'optional', 'E', NULL, NULL),
(5, 'f553ec36a0fb30e0ab05ea8128ffe7ff', '79a78e4e6a080e03d3ddf5aaca20b642', 'optional', 'E', NULL, NULL),
(6, 'f553ec36a0fb30e0ab05ea8128ffe7ff', 'b7b5fc68fb85dd88dc124a38ec488f2c', 'optional', 'E', NULL, NULL),
(7, 'f553ec36a0fb30e0ab05ea8128ffe7ff', '17ae1bb333f280e72bdfeecf08342617', 'optional', 'E', NULL, NULL),
(8, 'f553ec36a0fb30e0ab05ea8128ffe7ff', '78a92fb99cfdc7f1e537f9caef0e0684', 'optional', 'E', NULL, NULL),
(9, 'f553ec36a0fb30e0ab05ea8128ffe7ff', 'ba1c45bc4d5a9ba46387ba1837f90910', 'necessary', 'S', NULL, NULL),
(10, '60d14d0fe32e5c4e3551268b2a2a4285', '535e955119b624e341febdce9a5ab025', 'optional', 'E', NULL, NULL),
(11, '60d14d0fe32e5c4e3551268b2a2a4285', '2e45ec206a607ba85a8cb0160e99ade4', 'optional', 'E', NULL, NULL),
(12, '60d14d0fe32e5c4e3551268b2a2a4285', '499fb4fc5cb36c9413f708e2290ee465', 'optional', 'E', NULL, NULL),
(13, '60d14d0fe32e5c4e3551268b2a2a4285', 'bbd67ff82f9f3749b72687aa7caa5bba', 'optional', 'E', NULL, NULL),
(14, '60d14d0fe32e5c4e3551268b2a2a4285', 'b7b5fc68fb85dd88dc124a38ec488f2c', 'optional', 'E', NULL, NULL),
(15, '60d14d0fe32e5c4e3551268b2a2a4285', '1a50115832dd08b87a189d155c62eb31', 'optional', 'E', NULL, NULL),
(16, '60d14d0fe32e5c4e3551268b2a2a4285', '1502838edf28cac9b0390cd616bd0240', 'optional', 'E', NULL, NULL),
(17, '60d14d0fe32e5c4e3551268b2a2a4285', '111239143c8489ef8e53421791b2c3e9', 'optional', 'E', NULL, NULL),
(18, '60d14d0fe32e5c4e3551268b2a2a4285', '79a78e4e6a080e03d3ddf5aaca20b642', 'optional', 'E', NULL, NULL),
(19, '60d14d0fe32e5c4e3551268b2a2a4285', 'de52cabd871248ebd540e4c1616d8477', 'optional', 'E', NULL, NULL),
(20, '60d14d0fe32e5c4e3551268b2a2a4285', '78a92fb99cfdc7f1e537f9caef0e0684', 'optional', 'E', NULL, NULL),
(21, '60d14d0fe32e5c4e3551268b2a2a4285', '921f5461645235088da06b1132a13754', 'optional', 'E', NULL, NULL),
(22, '60d14d0fe32e5c4e3551268b2a2a4285', '17afca89d6c133ae83d57d65acc89dd2', 'optional', 'E', NULL, NULL),
(23, '30973a49f205744c181fdde2ae9532b6', '111239143c8489ef8e53421791b2c3e9', 'optional', 'E', NULL, NULL),
(24, '30973a49f205744c181fdde2ae9532b6', '78a92fb99cfdc7f1e537f9caef0e0684', 'optional', 'E', NULL, NULL),
(25, '30973a49f205744c181fdde2ae9532b6', '79a78e4e6a080e03d3ddf5aaca20b642', 'optional', 'E', NULL, NULL),
(26, '30973a49f205744c181fdde2ae9532b6', 'de52cabd871248ebd540e4c1616d8477', 'optional', 'E', NULL, NULL),
(27, '30973a49f205744c181fdde2ae9532b6', '78a92fb99cfdc7f1e537f9caef0e0684', 'necessary', 'S', NULL, NULL),
(28, '30973a49f205744c181fdde2ae9532b6', 'ba1c45bc4d5a9ba46387ba1837f90910', 'necessary', 'S', NULL, NULL),
(29, 'f18edaf906c6481c81569c752ac6c5f9', '78a92fb99cfdc7f1e537f9caef0e0684', 'optional', 'E', NULL, NULL),
(30, 'f18edaf906c6481c81569c752ac6c5f9', '111239143c8489ef8e53421791b2c3e9', 'optional', 'E', NULL, NULL),
(31, 'f18edaf906c6481c81569c752ac6c5f9', '79a78e4e6a080e03d3ddf5aaca20b642', 'optional', 'E', NULL, NULL),
(32, 'f18edaf906c6481c81569c752ac6c5f9', 'de52cabd871248ebd540e4c1616d8477', 'optional', 'E', NULL, NULL),
(33, 'f18edaf906c6481c81569c752ac6c5f9', 'bbd67ff82f9f3749b72687aa7caa5bba', 'optional', 'E', NULL, NULL),
(34, 'f18edaf906c6481c81569c752ac6c5f9', '0f356d614e6881dd5ae8ffc9989732e9', 'optional', 'E', NULL, NULL),
(35, 'f18edaf906c6481c81569c752ac6c5f9', '78a92fb99cfdc7f1e537f9caef0e0684', 'necessary', 'S', NULL, NULL),
(36, 'f18edaf906c6481c81569c752ac6c5f9', 'ba1c45bc4d5a9ba46387ba1837f90910', 'necessary', 'S', NULL, NULL),
(37, '4c851222374e7cc05dbe9b23f63c0336', '78a92fb99cfdc7f1e537f9caef0e0684', 'required', 'E', NULL, NULL),
(38, '4c851222374e7cc05dbe9b23f63c0336', '111239143c8489ef8e53421791b2c3e9', 'optional', 'E', NULL, NULL),
(39, '4c851222374e7cc05dbe9b23f63c0336', 'bbd67ff82f9f3749b72687aa7caa5bba', 'optional', 'E', NULL, NULL),
(40, '4c851222374e7cc05dbe9b23f63c0336', '79a78e4e6a080e03d3ddf5aaca20b642', 'optional', 'E', NULL, NULL),
(41, '4c851222374e7cc05dbe9b23f63c0336', '17ae1bb333f280e72bdfeecf08342617', 'optional', 'E', NULL, NULL),
(42, '4c851222374e7cc05dbe9b23f63c0336', '111239143c8489ef8e53421791b2c3e9', 'necessary', 'S', NULL, NULL),
(43, '7a81f762b0d5b02328b8e57fe4d8fa2a', '111239143c8489ef8e53421791b2c3e9', 'optional', 'E', NULL, NULL),
(44, '7a81f762b0d5b02328b8e57fe4d8fa2a', '79a78e4e6a080e03d3ddf5aaca20b642', 'optional', 'E', NULL, NULL),
(45, '7a81f762b0d5b02328b8e57fe4d8fa2a', 'de52cabd871248ebd540e4c1616d8477', 'optional', 'E', NULL, NULL),
(46, '7a81f762b0d5b02328b8e57fe4d8fa2a', '78a92fb99cfdc7f1e537f9caef0e0684', 'optional', 'E', NULL, NULL),
(47, '7a81f762b0d5b02328b8e57fe4d8fa2a', 'bbd67ff82f9f3749b72687aa7caa5bba', 'optional', 'E', NULL, NULL),
(48, '7a81f762b0d5b02328b8e57fe4d8fa2a', '0f356d614e6881dd5ae8ffc9989732e9', 'optional', 'E', NULL, NULL),
(49, '7a81f762b0d5b02328b8e57fe4d8fa2a', '78a92fb99cfdc7f1e537f9caef0e0684', 'necessary', 'S', NULL, NULL),
(50, '7a81f762b0d5b02328b8e57fe4d8fa2a', 'ba1c45bc4d5a9ba46387ba1837f90910', 'necessary', 'S', NULL, NULL),
(51, 'f080de0b4d3ff5b9b25d8dfc0b36d1af', '111239143c8489ef8e53421791b2c3e9', 'optional', 'E', NULL, NULL),
(52, 'f080de0b4d3ff5b9b25d8dfc0b36d1af', '79a78e4e6a080e03d3ddf5aaca20b642', 'optional', 'E', NULL, NULL),
(53, 'f080de0b4d3ff5b9b25d8dfc0b36d1af', 'de52cabd871248ebd540e4c1616d8477', 'optional', 'E', NULL, NULL),
(54, 'f080de0b4d3ff5b9b25d8dfc0b36d1af', '78a92fb99cfdc7f1e537f9caef0e0684', 'optional', 'E', NULL, NULL),
(55, 'f080de0b4d3ff5b9b25d8dfc0b36d1af', 'bbd67ff82f9f3749b72687aa7caa5bba', 'optional', 'E', NULL, NULL),
(56, 'f080de0b4d3ff5b9b25d8dfc0b36d1af', '0f356d614e6881dd5ae8ffc9989732e9', 'optional', 'E', NULL, NULL),
(57, 'f080de0b4d3ff5b9b25d8dfc0b36d1af', '78a92fb99cfdc7f1e537f9caef0e0684', 'necessary', 'S', NULL, NULL),
(58, 'f080de0b4d3ff5b9b25d8dfc0b36d1af', 'ba1c45bc4d5a9ba46387ba1837f90910', 'necessary', 'S', NULL, NULL),
(59, 'efe0a16aa323471d3cae586c2ab7b88a', '111239143c8489ef8e53421791b2c3e9', 'optional', 'E', NULL, NULL),
(60, 'efe0a16aa323471d3cae586c2ab7b88a', '78a92fb99cfdc7f1e537f9caef0e0684', 'optional', 'E', NULL, NULL),
(61, 'efe0a16aa323471d3cae586c2ab7b88a', '79a78e4e6a080e03d3ddf5aaca20b642', 'optional', 'E', NULL, NULL),
(62, 'efe0a16aa323471d3cae586c2ab7b88a', 'de52cabd871248ebd540e4c1616d8477', 'optional', 'E', NULL, NULL),
(63, 'efe0a16aa323471d3cae586c2ab7b88a', '78a92fb99cfdc7f1e537f9caef0e0684', 'necessary', 'S', NULL, NULL),
(64, 'efe0a16aa323471d3cae586c2ab7b88a', 'ba1c45bc4d5a9ba46387ba1837f90910', 'necessary', 'S', NULL, NULL),
(74, '114dfda1cab341736e704fc14afd1717', '111239143c8489ef8e53421791b2c3e9', 'required', 'C', NULL, NULL),
(75, '114dfda1cab341736e704fc14afd1717', '79a78e4e6a080e03d3ddf5aaca20b642', 'required', 'D', NULL, NULL),
(76, '114dfda1cab341736e704fc14afd1717', '78a92fb99cfdc7f1e537f9caef0e0684', 'required', 'C', NULL, NULL),
(77, '017a2b6654b3311be8ef846fedf099a4', '111239143c8489ef8e53421791b2c3e9', 'required', 'C', NULL, NULL),
(78, '017a2b6654b3311be8ef846fedf099a4', '79a78e4e6a080e03d3ddf5aaca20b642', 'required', 'C', NULL, NULL),
(79, '017a2b6654b3311be8ef846fedf099a4', 'de52cabd871248ebd540e4c1616d8477', 'required', 'C', NULL, NULL),
(88, '2e8ab7c250bda54db1e02c374d6b7c2d', '111239143c8489ef8e53421791b2c3e9', 'optional', 'E', NULL, NULL),
(89, '2e8ab7c250bda54db1e02c374d6b7c2d', '78a92fb99cfdc7f1e537f9caef0e0684', 'optional', 'E', NULL, NULL),
(90, '2e8ab7c250bda54db1e02c374d6b7c2d', '79a78e4e6a080e03d3ddf5aaca20b642', 'optional', 'E', NULL, NULL),
(91, '2e8ab7c250bda54db1e02c374d6b7c2d', 'de52cabd871248ebd540e4c1616d8477', 'optional', 'E', NULL, NULL),
(92, '2e8ab7c250bda54db1e02c374d6b7c2d', 'bbd67ff82f9f3749b72687aa7caa5bba', 'optional', 'E', NULL, NULL),
(93, '2e8ab7c250bda54db1e02c374d6b7c2d', '111239143c8489ef8e53421791b2c3e9', 'required', 'E', NULL, NULL),
(94, '2e8ab7c250bda54db1e02c374d6b7c2d', '79a78e4e6a080e03d3ddf5aaca20b642', 'required', 'E', NULL, NULL),
(95, '2e8ab7c250bda54db1e02c374d6b7c2d', 'de52cabd871248ebd540e4c1616d8477', 'required', 'E', NULL, NULL),
(96, '2e8ab7c250bda54db1e02c374d6b7c2d', '78a92fb99cfdc7f1e537f9caef0e0684', 'necessary', 'S', NULL, NULL),
(97, '2e8ab7c250bda54db1e02c374d6b7c2d', 'ba1c45bc4d5a9ba46387ba1837f90910', 'necessary', 'S', NULL, NULL),
(98, 'b6017e72385f60d32908fb7d226b4e38', '111239143c8489ef8e53421791b2c3e9', 'optional', 'E', NULL, NULL),
(99, 'b6017e72385f60d32908fb7d226b4e38', '79a78e4e6a080e03d3ddf5aaca20b642', 'optional', 'E', NULL, NULL),
(100, 'b6017e72385f60d32908fb7d226b4e38', 'de52cabd871248ebd540e4c1616d8477', 'optional', 'E', NULL, NULL),
(101, 'b6017e72385f60d32908fb7d226b4e38', '78a92fb99cfdc7f1e537f9caef0e0684', 'optional', 'E', NULL, NULL),
(102, 'b6017e72385f60d32908fb7d226b4e38', 'bbd67ff82f9f3749b72687aa7caa5bba', 'optional', 'E', NULL, NULL),
(103, 'b6017e72385f60d32908fb7d226b4e38', 'b7b5fc68fb85dd88dc124a38ec488f2c', 'optional', 'E', NULL, NULL),
(104, 'b6017e72385f60d32908fb7d226b4e38', '78a92fb99cfdc7f1e537f9caef0e0684', 'necessary', 'E', NULL, NULL),
(105, 'b6017e72385f60d32908fb7d226b4e38', 'ba1c45bc4d5a9ba46387ba1837f90910', 'necessary', 'S', NULL, NULL),
(106, '6739ceb62b0edeb899dadd9d313b793f', 'bbd67ff82f9f3749b72687aa7caa5bba', 'optional', 'E', NULL, NULL),
(107, '6739ceb62b0edeb899dadd9d313b793f', 'b7b5fc68fb85dd88dc124a38ec488f2c', 'optional', 'E', NULL, NULL),
(108, '6739ceb62b0edeb899dadd9d313b793f', '78a92fb99cfdc7f1e537f9caef0e0684', 'optional', 'E', NULL, NULL),
(109, '6739ceb62b0edeb899dadd9d313b793f', '535e955119b624e341febdce9a5ab025', 'optional', 'E', NULL, NULL),
(110, '6739ceb62b0edeb899dadd9d313b793f', '499fb4fc5cb36c9413f708e2290ee465', 'optional', 'E', NULL, NULL),
(111, '6739ceb62b0edeb899dadd9d313b793f', '1a50115832dd08b87a189d155c62eb31', 'optional', 'E', NULL, NULL),
(112, '6739ceb62b0edeb899dadd9d313b793f', '1502838edf28cac9b0390cd616bd0240', 'optional', 'E', NULL, NULL),
(113, '6739ceb62b0edeb899dadd9d313b793f', '111239143c8489ef8e53421791b2c3e9', 'optional', 'E', NULL, NULL),
(114, '6739ceb62b0edeb899dadd9d313b793f', 'de52cabd871248ebd540e4c1616d8477', 'optional', 'E', NULL, NULL),
(115, '6739ceb62b0edeb899dadd9d313b793f', '79a78e4e6a080e03d3ddf5aaca20b642', 'optional', 'E', NULL, NULL),
(116, '6739ceb62b0edeb899dadd9d313b793f', '78a92fb99cfdc7f1e537f9caef0e0684', 'necessary', 'S', NULL, NULL),
(117, '6739ceb62b0edeb899dadd9d313b793f', 'ba1c45bc4d5a9ba46387ba1837f90910', 'necessary', 'S', NULL, NULL),
(118, '26f23336f45a68778bafc17cafb89511', '78a92fb99cfdc7f1e537f9caef0e0684', 'optional', 'E', NULL, NULL),
(119, '26f23336f45a68778bafc17cafb89511', '111239143c8489ef8e53421791b2c3e9', 'optional', 'E', NULL, NULL),
(120, '26f23336f45a68778bafc17cafb89511', 'bbd67ff82f9f3749b72687aa7caa5bba', 'optional', 'E', NULL, NULL),
(121, '26f23336f45a68778bafc17cafb89511', 'de52cabd871248ebd540e4c1616d8477', 'optional', 'E', NULL, NULL),
(122, '26f23336f45a68778bafc17cafb89511', '79a78e4e6a080e03d3ddf5aaca20b642', 'optional', 'E', NULL, NULL),
(123, '26f23336f45a68778bafc17cafb89511', 'b7b5fc68fb85dd88dc124a38ec488f2c', 'optional', 'E', NULL, NULL),
(124, '26f23336f45a68778bafc17cafb89511', '17ae1bb333f280e72bdfeecf08342617', 'optional', 'E', NULL, NULL),
(125, '26f23336f45a68778bafc17cafb89511', '78a92fb99cfdc7f1e537f9caef0e0684', 'necessary', 'S', NULL, NULL),
(126, '26f23336f45a68778bafc17cafb89511', 'ba1c45bc4d5a9ba46387ba1837f90910', 'necessary', 'S', NULL, NULL),
(127, '1716ccb983b5b585d353b38a6a2d9841', 'bbd67ff82f9f3749b72687aa7caa5bba', 'optional', 'E', NULL, NULL),
(128, '1716ccb983b5b585d353b38a6a2d9841', 'b7b5fc68fb85dd88dc124a38ec488f2c', 'optional', 'E', NULL, NULL),
(129, '1716ccb983b5b585d353b38a6a2d9841', '78a92fb99cfdc7f1e537f9caef0e0684', 'optional', 'E', NULL, NULL),
(130, '1716ccb983b5b585d353b38a6a2d9841', '535e955119b624e341febdce9a5ab025', 'optional', 'E', NULL, NULL),
(131, '1716ccb983b5b585d353b38a6a2d9841', '499fb4fc5cb36c9413f708e2290ee465', 'optional', 'E', NULL, NULL),
(132, '1716ccb983b5b585d353b38a6a2d9841', '1a50115832dd08b87a189d155c62eb31', 'optional', 'E', NULL, NULL),
(133, '1716ccb983b5b585d353b38a6a2d9841', '1502838edf28cac9b0390cd616bd0240', 'optional', 'E', NULL, NULL),
(134, '1716ccb983b5b585d353b38a6a2d9841', '111239143c8489ef8e53421791b2c3e9', 'optional', 'E', NULL, NULL),
(135, '1716ccb983b5b585d353b38a6a2d9841', 'de52cabd871248ebd540e4c1616d8477', 'optional', 'E', NULL, NULL),
(136, '1716ccb983b5b585d353b38a6a2d9841', '79a78e4e6a080e03d3ddf5aaca20b642', 'optional', 'E', NULL, NULL),
(137, '1716ccb983b5b585d353b38a6a2d9841', '78a92fb99cfdc7f1e537f9caef0e0684', 'necessary', 'S', NULL, NULL),
(138, '1716ccb983b5b585d353b38a6a2d9841', 'ba1c45bc4d5a9ba46387ba1837f90910', 'necessary', 'S', NULL, NULL),
(139, '45b1f306a1652cb75a6472e55c62abed', '111239143c8489ef8e53421791b2c3e9', 'optional', 'E', NULL, NULL),
(140, '45b1f306a1652cb75a6472e55c62abed', '79a78e4e6a080e03d3ddf5aaca20b642', 'optional', 'E', NULL, NULL),
(141, '45b1f306a1652cb75a6472e55c62abed', 'de52cabd871248ebd540e4c1616d8477', 'optional', 'E', NULL, NULL),
(142, '45b1f306a1652cb75a6472e55c62abed', '78a92fb99cfdc7f1e537f9caef0e0684', 'optional', 'E', NULL, NULL),
(143, '45b1f306a1652cb75a6472e55c62abed', 'bbd67ff82f9f3749b72687aa7caa5bba', 'optional', 'E', NULL, NULL),
(144, '45b1f306a1652cb75a6472e55c62abed', 'b7b5fc68fb85dd88dc124a38ec488f2c', 'optional', 'E', NULL, NULL),
(145, '45b1f306a1652cb75a6472e55c62abed', '1a50115832dd08b87a189d155c62eb31', 'optional', 'E', NULL, NULL),
(146, '45b1f306a1652cb75a6472e55c62abed', '1502838edf28cac9b0390cd616bd0240', 'optional', 'E', NULL, NULL),
(147, '45b1f306a1652cb75a6472e55c62abed', 'ba1c45bc4d5a9ba46387ba1837f90910', 'necessary', 'S', NULL, NULL),
(148, '9331ebae62147c495cbdf0c26d9dda4f', '1a50115832dd08b87a189d155c62eb31', 'optional', 'E', NULL, NULL),
(149, '9331ebae62147c495cbdf0c26d9dda4f', '1502838edf28cac9b0390cd616bd0240', 'optional', 'E', NULL, NULL),
(150, '9331ebae62147c495cbdf0c26d9dda4f', 'b7b5fc68fb85dd88dc124a38ec488f2c', 'optional', 'E', NULL, NULL),
(151, '9331ebae62147c495cbdf0c26d9dda4f', '535e955119b624e341febdce9a5ab025', 'optional', 'E', NULL, NULL),
(152, '9331ebae62147c495cbdf0c26d9dda4f', 'bbd67ff82f9f3749b72687aa7caa5bba', 'optional', 'E', NULL, NULL),
(153, '9331ebae62147c495cbdf0c26d9dda4f', '78a92fb99cfdc7f1e537f9caef0e0684', 'optional', 'E', NULL, NULL),
(154, '9331ebae62147c495cbdf0c26d9dda4f', '111239143c8489ef8e53421791b2c3e9', 'optional', 'E', NULL, NULL),
(155, '9331ebae62147c495cbdf0c26d9dda4f', 'de52cabd871248ebd540e4c1616d8477', 'optional', 'E', NULL, NULL),
(156, '9331ebae62147c495cbdf0c26d9dda4f', '79a78e4e6a080e03d3ddf5aaca20b642', 'optional', 'E', NULL, NULL),
(157, '9331ebae62147c495cbdf0c26d9dda4f', '78a92fb99cfdc7f1e537f9caef0e0684', 'necessary', 'S', NULL, NULL),
(158, '9331ebae62147c495cbdf0c26d9dda4f', 'ba1c45bc4d5a9ba46387ba1837f90910', 'necessary', 'S', NULL, NULL),
(159, 'ac0183aef13fe44ec7da3f63dca5b8b9', '111239143c8489ef8e53421791b2c3e9', 'optional', 'E', NULL, NULL),
(160, 'ac0183aef13fe44ec7da3f63dca5b8b9', '79a78e4e6a080e03d3ddf5aaca20b642', 'optional', 'E', NULL, NULL),
(161, 'ac0183aef13fe44ec7da3f63dca5b8b9', 'de52cabd871248ebd540e4c1616d8477', 'optional', 'E', NULL, NULL),
(162, 'ac0183aef13fe44ec7da3f63dca5b8b9', '78a92fb99cfdc7f1e537f9caef0e0684', 'optional', 'E', NULL, NULL),
(163, 'ac0183aef13fe44ec7da3f63dca5b8b9', 'bbd67ff82f9f3749b72687aa7caa5bba', 'optional', 'E', NULL, NULL),
(164, 'ac0183aef13fe44ec7da3f63dca5b8b9', 'b7b5fc68fb85dd88dc124a38ec488f2c', 'optional', 'E', NULL, NULL),
(165, 'ac0183aef13fe44ec7da3f63dca5b8b9', '1a50115832dd08b87a189d155c62eb31', 'optional', 'E', NULL, NULL),
(166, 'ac0183aef13fe44ec7da3f63dca5b8b9', '1502838edf28cac9b0390cd616bd0240', 'optional', 'E', NULL, NULL),
(167, 'ac0183aef13fe44ec7da3f63dca5b8b9', 'ba1c45bc4d5a9ba46387ba1837f90910', 'necessary', 'S', NULL, NULL),
(168, '4d956f1bab3cd385120faf70614c5b5c', 'bbd67ff82f9f3749b72687aa7caa5bba', 'optional', 'E', NULL, NULL),
(169, '4d956f1bab3cd385120faf70614c5b5c', '535e955119b624e341febdce9a5ab025', 'optional', 'E', NULL, NULL),
(170, '4d956f1bab3cd385120faf70614c5b5c', '1a50115832dd08b87a189d155c62eb31', 'optional', 'E', NULL, NULL),
(171, '4d956f1bab3cd385120faf70614c5b5c', '1502838edf28cac9b0390cd616bd0240', 'optional', 'E', NULL, NULL),
(172, '4d956f1bab3cd385120faf70614c5b5c', '111239143c8489ef8e53421791b2c3e9', 'optional', 'E', NULL, NULL),
(173, '4d956f1bab3cd385120faf70614c5b5c', '79a78e4e6a080e03d3ddf5aaca20b642', 'optional', 'E', NULL, NULL),
(174, '4d956f1bab3cd385120faf70614c5b5c', '78a92fb99cfdc7f1e537f9caef0e0684', 'optional', 'E', NULL, NULL),
(175, '4d956f1bab3cd385120faf70614c5b5c', '78a92fb99cfdc7f1e537f9caef0e0684', 'necessary', 'S', NULL, NULL),
(176, '4d956f1bab3cd385120faf70614c5b5c', 'ba1c45bc4d5a9ba46387ba1837f90910', 'necessary', 'S', NULL, NULL),
(183, '158b0a4c58b7d47097eab72e4f6f2438', '1a50115832dd08b87a189d155c62eb31', 'optional', 'E', NULL, NULL),
(184, '158b0a4c58b7d47097eab72e4f6f2438', '1502838edf28cac9b0390cd616bd0240', 'optional', 'E', NULL, NULL),
(185, '158b0a4c58b7d47097eab72e4f6f2438', 'b7b5fc68fb85dd88dc124a38ec488f2c', 'optional', 'E', NULL, NULL),
(186, '158b0a4c58b7d47097eab72e4f6f2438', '78a92fb99cfdc7f1e537f9caef0e0684', 'optional', 'E', NULL, NULL),
(187, '158b0a4c58b7d47097eab72e4f6f2438', 'bbd67ff82f9f3749b72687aa7caa5bba', 'optional', 'E', NULL, NULL),
(188, '158b0a4c58b7d47097eab72e4f6f2438', '535e955119b624e341febdce9a5ab025', 'optional', 'E', NULL, NULL),
(189, '158b0a4c58b7d47097eab72e4f6f2438', '111239143c8489ef8e53421791b2c3e9', 'optional', 'E', NULL, NULL),
(190, '158b0a4c58b7d47097eab72e4f6f2438', 'de52cabd871248ebd540e4c1616d8477', 'optional', 'E', NULL, NULL),
(191, '158b0a4c58b7d47097eab72e4f6f2438', '79a78e4e6a080e03d3ddf5aaca20b642', 'optional', 'E', NULL, NULL),
(192, '158b0a4c58b7d47097eab72e4f6f2438', '78a92fb99cfdc7f1e537f9caef0e0684', 'necessary', 'S', NULL, NULL),
(193, '158b0a4c58b7d47097eab72e4f6f2438', 'ba1c45bc4d5a9ba46387ba1837f90910', 'necessary', 'S', NULL, NULL),
(194, '3d85356b54a06e7d399122ff1672a78d', '78a92fb99cfdc7f1e537f9caef0e0684', 'optional', 'E', NULL, NULL),
(195, '3d85356b54a06e7d399122ff1672a78d', '111239143c8489ef8e53421791b2c3e9', 'optional', 'E', NULL, NULL),
(196, '3d85356b54a06e7d399122ff1672a78d', '79a78e4e6a080e03d3ddf5aaca20b642', 'optional', 'E', NULL, NULL),
(197, '3d85356b54a06e7d399122ff1672a78d', 'de52cabd871248ebd540e4c1616d8477', 'optional', 'E', NULL, NULL),
(198, '3d85356b54a06e7d399122ff1672a78d', 'b7b5fc68fb85dd88dc124a38ec488f2c', 'optional', 'E', NULL, NULL),
(199, '3d85356b54a06e7d399122ff1672a78d', '1502838edf28cac9b0390cd616bd0240', 'optional', 'E', NULL, NULL),
(200, '3d85356b54a06e7d399122ff1672a78d', '78a92fb99cfdc7f1e537f9caef0e0684', 'necessary', 'S', NULL, NULL),
(201, '3d85356b54a06e7d399122ff1672a78d', 'ba1c45bc4d5a9ba46387ba1837f90910', 'necessary', 'S', NULL, NULL),
(202, '704f703100f09f05db5ef045c6e42dcc', '78a92fb99cfdc7f1e537f9caef0e0684', 'optional', 'E', NULL, NULL),
(203, '704f703100f09f05db5ef045c6e42dcc', '111239143c8489ef8e53421791b2c3e9', 'optional', 'E', NULL, NULL),
(204, '704f703100f09f05db5ef045c6e42dcc', '79a78e4e6a080e03d3ddf5aaca20b642', 'optional', 'E', NULL, NULL),
(205, '704f703100f09f05db5ef045c6e42dcc', 'bbd67ff82f9f3749b72687aa7caa5bba', 'optional', 'E', NULL, NULL),
(206, '704f703100f09f05db5ef045c6e42dcc', '17ae1bb333f280e72bdfeecf08342617', 'optional', 'E', NULL, NULL),
(207, '704f703100f09f05db5ef045c6e42dcc', 'de52cabd871248ebd540e4c1616d8477', 'optional', 'E', NULL, NULL),
(208, '704f703100f09f05db5ef045c6e42dcc', 'b7b5fc68fb85dd88dc124a38ec488f2c', 'optional', 'E', NULL, NULL),
(209, '704f703100f09f05db5ef045c6e42dcc', '921f5461645235088da06b1132a13754', 'optional', 'E', NULL, NULL),
(210, '704f703100f09f05db5ef045c6e42dcc', '78a92fb99cfdc7f1e537f9caef0e0684', 'necessary', 'S', NULL, NULL),
(211, '704f703100f09f05db5ef045c6e42dcc', 'ba1c45bc4d5a9ba46387ba1837f90910', 'necessary', 'S', NULL, NULL),
(220, '163774c4d4ed9ae4d27c6f2449df1205', '111239143c8489ef8e53421791b2c3e9', 'required', 'E', NULL, NULL),
(221, '163774c4d4ed9ae4d27c6f2449df1205', '79a78e4e6a080e03d3ddf5aaca20b642', 'required', 'C', NULL, NULL),
(222, '163774c4d4ed9ae4d27c6f2449df1205', 'de52cabd871248ebd540e4c1616d8477', 'required', 'D', NULL, NULL),
(223, 'b11ee817938a955e00cb49ad12b72b00', '111239143c8489ef8e53421791b2c3e9', 'required', 'E', NULL, NULL),
(224, 'b11ee817938a955e00cb49ad12b72b00', '79a78e4e6a080e03d3ddf5aaca20b642', 'required', 'C', NULL, NULL),
(225, 'b11ee817938a955e00cb49ad12b72b00', 'de52cabd871248ebd540e4c1616d8477', 'required', 'D', NULL, NULL),
(226, 'f582d2da55509d63fe5da9bce9c66fdb', '111239143c8489ef8e53421791b2c3e9', 'required', 'D', NULL, NULL),
(227, 'f582d2da55509d63fe5da9bce9c66fdb', '79a78e4e6a080e03d3ddf5aaca20b642', 'required', 'D', NULL, NULL),
(228, 'f582d2da55509d63fe5da9bce9c66fdb', 'de52cabd871248ebd540e4c1616d8477', 'required', 'D', NULL, NULL),
(229, '316c47edb43dd04c0193b69945453d3c', '111239143c8489ef8e53421791b2c3e9', 'required', 'D', NULL, NULL),
(230, '316c47edb43dd04c0193b69945453d3c', '79a78e4e6a080e03d3ddf5aaca20b642', 'required', 'D', NULL, NULL),
(231, '316c47edb43dd04c0193b69945453d3c', 'de52cabd871248ebd540e4c1616d8477', 'required', 'D', NULL, NULL),
(258, 'cfbc415dcbb07450b763c96fff3cf8c3', 'de52cabd871248ebd540e4c1616d8477', 'required', 'D', NULL, NULL),
(259, 'cfbc415dcbb07450b763c96fff3cf8c3', '79a78e4e6a080e03d3ddf5aaca20b642', 'optional', 'D', NULL, NULL),
(260, 'cfbc415dcbb07450b763c96fff3cf8c3', '17afca89d6c133ae83d57d65acc89dd2', 'optional', 'D', NULL, NULL),
(261, 'cfbc415dcbb07450b763c96fff3cf8c3', '921f5461645235088da06b1132a13754', 'optional', 'D', NULL, NULL),
(262, 'cfbc415dcbb07450b763c96fff3cf8c3', '111239143c8489ef8e53421791b2c3e9', 'optional', 'D', NULL, NULL),
(263, 'cfbc415dcbb07450b763c96fff3cf8c3', 'bbd67ff82f9f3749b72687aa7caa5bba', 'optional', 'D', NULL, NULL),
(274, '2f4ee60382e42a8a10e5df917518a91a', '78a92fb99cfdc7f1e537f9caef0e0684', 'required', 'E', NULL, NULL),
(275, '2f4ee60382e42a8a10e5df917518a91a', '111239143c8489ef8e53421791b2c3e9', 'required', 'E', NULL, NULL),
(276, '2f4ee60382e42a8a10e5df917518a91a', '79a78e4e6a080e03d3ddf5aaca20b642', 'necessary', 'S', NULL, NULL),
(280, '957d080e00dc8a27786d0ee282239323', '111239143c8489ef8e53421791b2c3e9', 'required', 'D', NULL, NULL),
(281, '957d080e00dc8a27786d0ee282239323', 'de52cabd871248ebd540e4c1616d8477', 'required', 'D', NULL, NULL),
(282, '957d080e00dc8a27786d0ee282239323', '79a78e4e6a080e03d3ddf5aaca20b642', 'required', 'D', NULL, NULL),
(283, '290d05b881a81bc39a3a3486c80803e3', '111239143c8489ef8e53421791b2c3e9', 'required', 'D', NULL, NULL),
(284, '290d05b881a81bc39a3a3486c80803e3', '79a78e4e6a080e03d3ddf5aaca20b642', 'required', 'D', NULL, NULL),
(285, '290d05b881a81bc39a3a3486c80803e3', 'de52cabd871248ebd540e4c1616d8477', 'required', 'D', NULL, NULL),
(286, 'cc156b96c7f260dcac131305aee63264', '111239143c8489ef8e53421791b2c3e9', 'required', 'D', NULL, NULL),
(287, 'cc156b96c7f260dcac131305aee63264', '79a78e4e6a080e03d3ddf5aaca20b642', 'required', 'D', NULL, NULL),
(288, 'cc156b96c7f260dcac131305aee63264', 'de52cabd871248ebd540e4c1616d8477', 'required', 'D', NULL, NULL),
(289, '63be52a9dcd364e98839296691211ba2', '79a78e4e6a080e03d3ddf5aaca20b642', 'required', 'C', NULL, NULL),
(290, '63be52a9dcd364e98839296691211ba2', 'de52cabd871248ebd540e4c1616d8477', 'required', 'D', NULL, NULL),
(291, '63be52a9dcd364e98839296691211ba2', '78a92fb99cfdc7f1e537f9caef0e0684', 'optional', 'E', NULL, NULL),
(292, '63be52a9dcd364e98839296691211ba2', '111239143c8489ef8e53421791b2c3e9', 'optional', 'E', NULL, NULL),
(293, '63be52a9dcd364e98839296691211ba2', '17afca89d6c133ae83d57d65acc89dd2', 'optional', 'E', NULL, NULL),
(294, '63be52a9dcd364e98839296691211ba2', 'bbd67ff82f9f3749b72687aa7caa5bba', 'optional', 'E', NULL, NULL),
(295, '63be52a9dcd364e98839296691211ba2', '921f5461645235088da06b1132a13754', 'optional', 'E', NULL, NULL),
(316, '4cb419dcde84b235311983f2cacca372', '111239143c8489ef8e53421791b2c3e9', 'optional', 'E', NULL, NULL),
(317, '4cb419dcde84b235311983f2cacca372', '78a92fb99cfdc7f1e537f9caef0e0684', 'optional', 'E', NULL, NULL),
(318, '4cb419dcde84b235311983f2cacca372', '79a78e4e6a080e03d3ddf5aaca20b642', 'optional', 'E', NULL, NULL),
(319, '4cb419dcde84b235311983f2cacca372', 'de52cabd871248ebd540e4c1616d8477', 'optional', 'E', NULL, NULL),
(320, '4cb419dcde84b235311983f2cacca372', 'bbd67ff82f9f3749b72687aa7caa5bba', 'optional', 'E', NULL, NULL),
(321, '4cb419dcde84b235311983f2cacca372', '111239143c8489ef8e53421791b2c3e9', 'required', 'E', NULL, NULL),
(322, '4cb419dcde84b235311983f2cacca372', '79a78e4e6a080e03d3ddf5aaca20b642', 'required', 'E', NULL, NULL),
(323, '4cb419dcde84b235311983f2cacca372', 'de52cabd871248ebd540e4c1616d8477', 'required', 'E', NULL, NULL),
(324, '4cb419dcde84b235311983f2cacca372', '78a92fb99cfdc7f1e537f9caef0e0684', 'necessary', 'S', NULL, NULL),
(325, '4cb419dcde84b235311983f2cacca372', 'ba1c45bc4d5a9ba46387ba1837f90910', 'necessary', 'S', NULL, NULL),
(331, 'a89c7f85d3caed62060aea512ec896ab', '111239143c8489ef8e53421791b2c3e9', 'required', 'D', NULL, NULL),
(332, 'a89c7f85d3caed62060aea512ec896ab', '79a78e4e6a080e03d3ddf5aaca20b642', 'required', 'C', NULL, NULL),
(333, 'a89c7f85d3caed62060aea512ec896ab', 'de52cabd871248ebd540e4c1616d8477', 'required', 'C', NULL, NULL),
(335, '9bddf7eb97080a990aa4534e19da8de6', '111239143c8489ef8e53421791b2c3e9', 'required', 'D', NULL, NULL),
(336, '9bddf7eb97080a990aa4534e19da8de6', '79a78e4e6a080e03d3ddf5aaca20b642', 'required', 'D', NULL, NULL),
(337, '9bddf7eb97080a990aa4534e19da8de6', 'de52cabd871248ebd540e4c1616d8477', 'required', 'D', NULL, NULL),
(338, '986c0220b3de868944c05264427fc1eb', '79a78e4e6a080e03d3ddf5aaca20b642', 'required', 'C', NULL, NULL),
(339, '986c0220b3de868944c05264427fc1eb', 'de52cabd871248ebd540e4c1616d8477', 'required', 'D', NULL, NULL),
(340, '986c0220b3de868944c05264427fc1eb', '111239143c8489ef8e53421791b2c3e9', 'optional', 'E', NULL, NULL),
(341, '986c0220b3de868944c05264427fc1eb', '78a92fb99cfdc7f1e537f9caef0e0684', 'optional', 'E', NULL, NULL),
(342, '986c0220b3de868944c05264427fc1eb', '17afca89d6c133ae83d57d65acc89dd2', 'optional', 'E', NULL, NULL),
(343, 'a6c1c068d6ca3edf0444bef011db5c90', '111239143c8489ef8e53421791b2c3e9', 'required', 'D', NULL, NULL),
(344, 'a6c1c068d6ca3edf0444bef011db5c90', '79a78e4e6a080e03d3ddf5aaca20b642', 'required', 'D', NULL, NULL),
(345, 'a6c1c068d6ca3edf0444bef011db5c90', 'de52cabd871248ebd540e4c1616d8477', 'required', 'D', NULL, NULL),
(346, 'eb4f1cb61f442e05b963e34854f1edcd', '79a78e4e6a080e03d3ddf5aaca20b642', 'required', 'C', NULL, NULL),
(347, 'eb4f1cb61f442e05b963e34854f1edcd', 'de52cabd871248ebd540e4c1616d8477', 'required', 'D', NULL, NULL),
(348, 'eb4f1cb61f442e05b963e34854f1edcd', '111239143c8489ef8e53421791b2c3e9', 'optional', 'E', NULL, NULL),
(349, 'eb4f1cb61f442e05b963e34854f1edcd', '17afca89d6c133ae83d57d65acc89dd2', 'optional', 'E', NULL, NULL),
(350, 'eb4f1cb61f442e05b963e34854f1edcd', '78a92fb99cfdc7f1e537f9caef0e0684', 'optional', 'E', NULL, NULL),
(351, '443d3238db50436ab0ccf98ed5e35154', '111239143c8489ef8e53421791b2c3e9', 'required', 'E', NULL, NULL),
(352, '443d3238db50436ab0ccf98ed5e35154', '79a78e4e6a080e03d3ddf5aaca20b642', 'required', 'C', NULL, NULL),
(353, '443d3238db50436ab0ccf98ed5e35154', 'de52cabd871248ebd540e4c1616d8477', 'required', 'D', NULL, NULL),
(354, 'f2265980c7f6a9819f0faafb67922666', '111239143c8489ef8e53421791b2c3e9', 'required', 'E', NULL, NULL),
(355, 'f2265980c7f6a9819f0faafb67922666', '79a78e4e6a080e03d3ddf5aaca20b642', 'required', 'C', NULL, NULL),
(356, 'f2265980c7f6a9819f0faafb67922666', 'de52cabd871248ebd540e4c1616d8477', 'required', 'D', NULL, NULL),
(357, 'd560941b852e477b4c176a7ce98c09f6', '79a78e4e6a080e03d3ddf5aaca20b642', 'required', 'C', NULL, NULL),
(358, 'd560941b852e477b4c176a7ce98c09f6', 'de52cabd871248ebd540e4c1616d8477', 'required', 'D', NULL, NULL),
(359, 'd560941b852e477b4c176a7ce98c09f6', '111239143c8489ef8e53421791b2c3e9', 'optional', 'E', NULL, NULL),
(360, 'd560941b852e477b4c176a7ce98c09f6', '78a92fb99cfdc7f1e537f9caef0e0684', 'optional', 'E', NULL, NULL),
(365, '6c7116b72fd72f0cc6d80199ca9ce724', '111239143c8489ef8e53421791b2c3e9', 'required', 'C', NULL, NULL),
(366, '6c7116b72fd72f0cc6d80199ca9ce724', '79a78e4e6a080e03d3ddf5aaca20b642', 'optional', 'E', NULL, NULL),
(367, '6c7116b72fd72f0cc6d80199ca9ce724', 'de52cabd871248ebd540e4c1616d8477', 'required', 'D', NULL, NULL),
(368, '6c7116b72fd72f0cc6d80199ca9ce724', '78a92fb99cfdc7f1e537f9caef0e0684', 'optional', 'E', NULL, NULL),
(369, '7929b551653cade389fae91c3bd747d5', '111239143c8489ef8e53421791b2c3e9', 'required', 'D', NULL, NULL),
(370, '7929b551653cade389fae91c3bd747d5', '79a78e4e6a080e03d3ddf5aaca20b642', 'required', 'D', NULL, NULL),
(371, '7929b551653cade389fae91c3bd747d5', 'de52cabd871248ebd540e4c1616d8477', 'required', 'D', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fields`
--

DROP TABLE IF EXISTS `fields`;
CREATE TABLE IF NOT EXISTS `fields` (
  `id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fields`
--

INSERT INTO `fields` (`id`, `name`, `created_at`, `updated_at`) VALUES
('08e5be3d6ec275be8b4c8c819c10309a', 'ENVIRONMENTAL SCIENCE', '2025-05-15 08:53:10', '2025-05-16 12:45:33'),
('48f7c12599cac4824ec5f0f9a85b64db', 'ENGINEERING', '2025-05-15 08:52:52', '2025-05-15 08:52:52'),
('50454887affd0f1dcf0354a77aae629d', 'MEDICINE', '2025-05-15 08:52:58', '2025-05-15 08:52:58');

-- --------------------------------------------------------

--
-- Table structure for table `institutions`
--

DROP TABLE IF EXISTS `institutions`;
CREATE TABLE IF NOT EXISTS `institutions` (
  `id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `acronym` char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('University','University College','University Campus College','Non-University') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ownership` enum('Private','Public') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `admission_portal_link` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `rank` int UNSIGNED NOT NULL,
  `affiliation_id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `institutions_affiliation_id_index` (`affiliation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `institutions`
--

INSERT INTO `institutions` (`id`, `name`, `acronym`, `type`, `ownership`, `location`, `created_at`, `updated_at`, `admission_portal_link`, `rank`, `affiliation_id`) VALUES
('24c41e67b7e00c6fd19b14a5efae3a98', 'Ardhi University', 'ARU', 'University', 'Public', 'Dar es Salaam', '2025-02-28 10:32:30', '2025-05-17 15:15:59', 'https://admission.aru.ac.tz/', 4, NULL),
('42f508e25f6fd1acaef522ae85454ca6', 'Kampala International University in Tanzania', 'KIUT', 'University', 'Private', 'Dar es Salaam', '2025-05-21 10:23:14', '2025-05-21 10:23:14', 'https://osim.kiut.ac.tz', 12, NULL),
('84ec1ffdd439490c07875ae45c1dc7fb', ' Muhimbili  University of  Health and  Allied Sciences', 'MUHAS', 'University', 'Public', 'Dar es  Salaam', '2025-03-05 06:45:20', '2025-05-16 16:21:47', 'https://oas.muhas.ac.tz', 2, NULL),
('a2b59dfcf839e4079ea325986087fc53', 'Mbeya College of Health and Allied  Sciences', 'MCHAS', 'University College', 'Public', 'Mbeya', '2025-05-21 10:31:48', '2025-05-21 13:14:36', 'https://admission.udsm.ac.tz/', 16, 'a71a936a22c94f3044a88a1a0acf05fb'),
('a71a936a22c94f3044a88a1a0acf05fb', ' University of  Dar es Salaam ', 'UDSM', 'University', 'Public', 'Dar es  Salaam ', '2025-03-05 06:46:32', '2025-05-09 11:50:50', 'https://admission.udsm.ac.tz', 1, NULL),
('b7fb61dae18f53addadd288f2520c403', 'Kilimanjaro Christian Medical University College ', 'KCMUCo', 'University', 'Private', 'Kilimanjaro', '2025-05-21 10:20:33', '2025-05-21 13:19:08', 'https://osim.kcmuco.ac.tz', 10, NULL),
('e7d789969965d30b5d782ed901f42c75', 'Kairuki University', 'KU', 'University', 'Private', 'Dar es Salaam', '2025-05-19 08:05:25', '2025-05-19 08:05:25', 'https://osim.hkmu.ac.tz', 2, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `queue` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2016_01_15_105324_create_roles_table', 1),
(5, '2016_01_15_114412_create_role_user_table', 1),
(6, '2016_01_26_115212_create_permissions_table', 1),
(7, '2016_01_26_115523_create_permission_role_table', 1),
(8, '2016_02_09_132439_create_permission_user_table', 1),
(9, '2025_02_24_074954_create_institutions_table', 1),
(10, '2025_02_24_075016_create_programs_table', 1),
(11, '2025_02_24_075038_create_subjects_table', 1),
(28, '2025_05_13_075211_create_career_programs_table', 7),
(27, '2025_05_13_075056_create_careers_table', 7),
(20, '2025_02_24_075117_create_entry_requirements_table', 5),
(16, '2025_05_07_052535_add_admission_portal_link_to_institutions_table', 3),
(17, '2025_05_08_073537_create_combinations_table', 4),
(18, '2025_05_08_075211_create_combination_subjects_table', 4),
(22, '2025_05_10_075117_create_entry_requirement_subjects_table', 6),
(26, '2025_05_12_205554_create_fields_table', 7),
(29, '2025_05_16_052535_add_rank_to_institutions_table', 8),
(30, '2025_05_16_202054_create_accreditations_table', 9),
(31, '2025_05_16_275211_create_accreditation_institutions_table', 9),
(32, '2025_05_17_052535_add_affiliation_id_to_institutions_table', 9),
(33, '2025_05_18_052535_add_category_to_combinations_table', 10),
(34, '2025_05_18_052536_add_is_compulsory_to_subjects_table', 11),
(35, '2025_05_18_052537_add_is_additional_to_subjects_table', 11),
(37, '2025_05_19_052537_add_competition_scale_to_programs_table', 12);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `model` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_slug_unique` (`slug`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

DROP TABLE IF EXISTS `permission_role`;
CREATE TABLE IF NOT EXISTS `permission_role` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `permission_id` int UNSIGNED NOT NULL,
  `role_id` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `permission_role_permission_id_index` (`permission_id`),
  KEY `permission_role_role_id_index` (`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permission_user`
--

DROP TABLE IF EXISTS `permission_user`;
CREATE TABLE IF NOT EXISTS `permission_user` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `permission_id` int UNSIGNED NOT NULL,
  `user_id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `permission_user_permission_id_index` (`permission_id`),
  KEY `permission_user_user_id_index` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `programs`
--

DROP TABLE IF EXISTS `programs`;
CREATE TABLE IF NOT EXISTS `programs` (
  `id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `institution_id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `duration` tinyint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `competition_scale` enum('High Competition','Moderate Competition','Low Competition') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `programs_institution_id_index` (`institution_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `programs`
--

INSERT INTO `programs` (`id`, `institution_id`, `name`, `duration`, `created_at`, `updated_at`, `competition_scale`) VALUES
('019ce65024551f545ac4fb88298394bc', 'e7d789969965d30b5d782ed901f42c75', 'Bachelor of Science in Nursing', 4, '2025-05-19 08:45:54', '2025-05-19 08:45:54', 'Moderate Competition'),
('1dca1fe90b6afd34e477b9405c1a1f1c', '24c41e67b7e00c6fd19b14a5efae3a98', 'Bachelor of Science in Quantity Surveying and Construction Economics', 4, '2025-05-12 16:18:55', '2025-05-12 16:18:55', 'Low Competition'),
('23240d5fa46f8ea7e2e8e403cbad0ffa', '24c41e67b7e00c6fd19b14a5efae3a98', 'Bachelor of Science in Regional Development Planning', 4, '2025-05-12 15:45:08', '2025-05-12 15:45:08', 'Low Competition'),
('274abe94a2938438bc3d3a0a422da8c3', '84ec1ffdd439490c07875ae45c1dc7fb', 'Bachelor of Science in Nursing', 4, '2025-03-14 07:31:43', '2025-05-19 07:42:10', 'High Competition'),
('2898adbdcc25d3d7b23651ee5e80abb1', '24c41e67b7e00c6fd19b14a5efae3a98', 'Bachelor of Science in Municipal and Industrial Services Engineering', 4, '2025-05-10 17:26:19', '2025-05-10 17:26:19', 'Low Competition'),
('2df21b54695076255c90a8e3bc1949a0', '24c41e67b7e00c6fd19b14a5efae3a98', 'Bachelor of Science in Environmental Laboratory Science and Technology', 4, '2025-05-12 16:24:57', '2025-05-12 16:24:57', 'Low Competition'),
('3041a5d3546187206b68e2e34f1b498c', '24c41e67b7e00c6fd19b14a5efae3a98', 'Bachelor of Science in Housing and Infrastructure Planning', 4, '2025-05-12 15:26:21', '2025-05-12 15:26:21', 'Low Competition'),
('32f2acf3761302ddd4f73347a49cd526', '24c41e67b7e00c6fd19b14a5efae3a98', 'Bachelor of  Architecture ', 5, '2025-03-07 11:26:46', '2025-03-07 11:26:46', 'Low Competition'),
('3d5c922db3b67c46ffbaf9195a03043f', 'b7fb61dae18f53addadd288f2520c403', 'Bachelor of Science in Occupational Therapy', 4, '2025-05-21 14:09:30', '2025-05-21 14:09:30', 'Moderate Competition'),
('3ec5e6b0206ab1fa3d4c63ca141f24ef', '24c41e67b7e00c6fd19b14a5efae3a98', 'Bachelor of  Science in  Landscape  Architecture ', 4, '2025-03-08 08:24:49', '2025-03-08 08:24:49', 'Low Competition'),
('42e1316d01cedc078337729829653b5b', '84ec1ffdd439490c07875ae45c1dc7fb', 'Bachelor of Science in Physiotherapy', 4, '2025-05-12 12:50:39', '2025-05-12 12:50:39', 'High Competition'),
('449b2db1ef0be3148d75b31cf01b4b2f', '24c41e67b7e00c6fd19b14a5efae3a98', 'Bachelor of  Science in  Interior  Design ', 4, '2025-03-08 08:18:31', '2025-03-08 08:18:31', 'Low Competition'),
('508abd074cee03faa487e0d9052a1d03', '24c41e67b7e00c6fd19b14a5efae3a98', 'Bachelor of Science in Land Management and Valuation', 4, '2025-05-12 15:31:26', '2025-05-12 15:31:26', 'Low Competition'),
('50bd144ecea17982c79347fbbb0b45fd', '24c41e67b7e00c6fd19b14a5efae3a98', 'Bachelor of  Science in  Information  Systems  Management', 3, '2025-03-07 11:19:50', '2025-03-07 11:19:50', 'Low Competition'),
('5499b5d315f03a7b33f880eb88545fe6', '84ec1ffdd439490c07875ae45c1dc7fb', 'Doctor of Dental Surgery', 5, '2025-05-12 16:56:06', '2025-05-12 16:56:06', 'High Competition'),
('5631f8c13e9880d8bfa150c72589b695', '24c41e67b7e00c6fd19b14a5efae3a98', 'Bachelor of  Science in  Geomatics ', 4, '2025-03-08 08:30:24', '2025-03-08 08:30:24', 'Low Competition'),
('587a540cab0235453b49f13f24770736', '24c41e67b7e00c6fd19b14a5efae3a98', 'Bachelor of Arts in Economics', 3, '2025-05-12 15:59:22', '2025-05-12 15:59:22', 'Low Competition'),
('5f614befa559981f694b049ba973dd3f', '24c41e67b7e00c6fd19b14a5efae3a98', 'Bachelor of Science in Accounting and Finance', 3, '2025-05-12 16:10:54', '2025-05-12 16:10:54', 'Low Competition'),
('63d4bd5e98166ae14a5599b9f85ab96f', '84ec1ffdd439490c07875ae45c1dc7fb', 'Bachelor of Science in Environmental Health Sciences', 3, '2025-05-12 17:04:55', '2025-05-12 17:04:55', 'High Competition'),
('6c71a7bbb3398a769abfb1fadb5929a1', '84ec1ffdd439490c07875ae45c1dc7fb', 'Doctor of Medicine', 5, '2025-03-14 05:12:01', '2025-03-14 05:12:01', 'High Competition'),
('719fc401b6ea6fa2cf3ff0ed314e8d98', 'b7fb61dae18f53addadd288f2520c403', 'Bachelor of Science in Health Laboratory Sciences ', 4, '2025-05-21 13:33:58', '2025-05-21 13:33:58', 'Moderate Competition'),
('756478f8bdd193b72d499db2538b66bb', '24c41e67b7e00c6fd19b14a5efae3a98', 'Bachelor of Science in Computer Systems and Networks', 3, '2025-05-10 16:06:35', '2025-05-10 16:06:35', 'Low Competition'),
('7a60250a7cd96e92cdb9d85ecbf500e7', '24c41e67b7e00c6fd19b14a5efae3a98', 'Bachelor of Science in Geographical Information Systems and Remote Sensing', 3, '2025-05-12 16:21:53', '2025-05-12 16:21:53', 'Low Competition'),
('7bcc3a2490d7ee562c8dc8cac9a25bd2', '84ec1ffdd439490c07875ae45c1dc7fb', 'Bachelor of Biomedical Engineering', 4, '2025-05-12 12:48:21', '2025-05-12 12:48:21', 'High Competition'),
('874f91396a7c6f62b220f9bc1ba7b8f3', 'e7d789969965d30b5d782ed901f42c75', 'Doctor of Medicine', 5, '2025-05-19 08:09:31', '2025-05-19 08:09:31', 'Moderate Competition'),
('9d00aa0e1f3822e02abdcc57e0e3bc18', '84ec1ffdd439490c07875ae45c1dc7fb', 'Bachelor of Science in Diagnostic and Therapeutic Radiography', 4, '2025-05-12 16:48:52', '2025-05-12 16:48:52', 'High Competition'),
('9f8815cbb3c5245a6fdf81c9d2a2191a', 'a71a936a22c94f3044a88a1a0acf05fb', 'Bachelor of Science in Beekeeping Science and Technology', 3, '2025-05-13 12:09:38', '2025-05-13 12:09:38', 'Low Competition'),
('a6d09a6a2942b5ed6c5150b4bb909b74', '24c41e67b7e00c6fd19b14a5efae3a98', 'Bachelor of Arts in Community Development', 3, '2025-05-10 16:50:13', '2025-05-10 16:50:13', 'Low Competition'),
('acde11ba72feede28e96137d431ca186', '24c41e67b7e00c6fd19b14a5efae3a98', 'Bachelor of Science in Civil Engineering', 4, '2025-05-12 16:01:01', '2025-05-12 16:01:01', 'Low Competition'),
('b0e9d87e618d6a5d1257af8e36b720e2', '24c41e67b7e00c6fd19b14a5efae3a98', 'Bachelor of Science in Urban and Regional Planning', 4, '2025-05-12 15:55:54', '2025-05-12 15:55:54', 'Low Competition'),
('ba47e9cf0055abce55d33e7ad7200626', '84ec1ffdd439490c07875ae45c1dc7fb', 'Bachelor of Science in Occupational Therapy', 4, '2025-05-12 16:53:25', '2025-05-12 16:53:25', 'High Competition'),
('c1368857a497441654705eba40d31c59', '84ec1ffdd439490c07875ae45c1dc7fb', 'Bachelor of Medical Laboratory Sciences', 3, '2025-05-12 16:43:56', '2025-05-12 16:43:56', 'High Competition'),
('c67d1a2b2e50d41ccaef5c7cc7b857db', '24c41e67b7e00c6fd19b14a5efae3a98', 'Bachelor of  Science in  Environmental Science and  Management ', 4, '2025-03-08 08:57:33', '2025-03-08 11:36:18', 'Low Competition'),
('c731182b3060cbed02f070022cf3de30', 'b7fb61dae18f53addadd288f2520c403', 'Bachelor of Science in Optometry ', 4, '2025-05-21 14:05:29', '2025-05-21 14:05:29', 'Moderate Competition'),
('c7d1b2fc3b1195b94195450ae9c0c9b5', '84ec1ffdd439490c07875ae45c1dc7fb', 'Bachelor of Pharmacy', 4, '2025-03-14 05:15:12', '2025-03-14 05:15:12', 'High Competition'),
('caca892a97f4296c3efaf481a0c56f2b', 'b7fb61dae18f53addadd288f2520c403', 'Bachelor of Science in Prosthetics & Orthotics ', 4, '2025-05-21 13:55:14', '2025-05-21 13:55:14', 'Moderate Competition'),
('cd9323c76d11b08ba1b98764b68ba470', '84ec1ffdd439490c07875ae45c1dc7fb', 'Bachelor of Science in Audiology & Speech Language Pathology', 4, '2025-05-12 16:51:15', '2025-05-12 16:51:15', 'High Competition'),
('d00189b5bb76a8f2f842e760b609f532', 'b7fb61dae18f53addadd288f2520c403', 'Bachelor of Science in Physiotherapy ', 4, '2025-05-21 13:49:52', '2025-05-21 13:49:52', 'Moderate Competition'),
('d4899639b1243eeef21e33c0cfeb4135', 'b7fb61dae18f53addadd288f2520c403', 'Doctor of Medicine ', 5, '2025-05-21 13:23:20', '2025-05-21 13:23:20', 'Moderate Competition'),
('df57e1e7f5710b954943617651407528', '24c41e67b7e00c6fd19b14a5efae3a98', 'Bachelor of Science in Real Estate, Finance and Investment', 4, '2025-05-12 15:53:10', '2025-05-12 15:53:10', 'Low Competition'),
('e490db7b5a98a0aa59eebd9ba8986bb3', '24c41e67b7e00c6fd19b14a5efae3a98', 'Bachelor of  Science in  Environmental  Engineering ', 4, '2025-03-08 08:32:02', '2025-03-08 11:53:15', 'Low Competition'),
('ebc4a771901acd053c8f21ca146d0eb6', '24c41e67b7e00c6fd19b14a5efae3a98', 'Bachelor of Science in Property and Facility Management', 4, '2025-05-12 15:41:06', '2025-05-12 15:41:06', 'Low Competition'),
('f5845528dcf197cd15473140e6713950', 'b7fb61dae18f53addadd288f2520c403', 'Bachelor of Science in Nursing ', 4, '2025-05-21 13:29:32', '2025-05-21 13:29:32', 'Moderate Competition');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `level` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_slug_unique` (`slug`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

DROP TABLE IF EXISTS `role_user`;
CREATE TABLE IF NOT EXISTS `role_user` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `role_id` int UNSIGNED NOT NULL,
  `user_id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `role_user_role_id_index` (`role_id`),
  KEY `role_user_user_id_index` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('xThHw0lUf8KEtUSrPFRM78S9KHmG1cV9zNTBcAzK', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36 Edg/136.0.0.0', 'YTo3OntzOjY6Il90b2tlbiI7czo0MDoidldYanpYZVhLV2xPUkoyTDF6Z0JXcVliMW9JWTJCNGNZd1ZpcHRGTyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hdXRoIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo4OiJmaWVsZF9pZCI7czozMjoiNTA0NTQ4ODdhZmZkMGYxZGNmMDM1NGE3N2FhZTYyOWQiO3M6OToiY2FyZWVyX2lkIjtzOjMyOiIxOTQ5NzMzNWFhZDYzOTJkZTk5MmM3YjhmMmEzZmRkOCI7czoxNDoiaW5zdGl0dXRpb25faWQiO3M6MzI6ImI3ZmI2MWRhZTE4ZjUzYWRkYWRkMjg4ZjI1MjBjNDAzIjtzOjEwOiJwcm9ncmFtX2lkIjtzOjMyOiJjNzMxMTgyYjMwNjBjYmVkMDJmMDcwMDIyY2YzZGUzMCI7fQ==', 1747847558);

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

DROP TABLE IF EXISTS `subjects`;
CREATE TABLE IF NOT EXISTS `subjects` (
  `id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_compulsory` tinyint(1) NOT NULL DEFAULT '0',
  `is_additional` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `name`, `code`, `created_at`, `updated_at`, `is_compulsory`, `is_additional`) VALUES
('0f356d614e6881dd5ae8ffc9989732e9', 'Fine Arts', 'FA', '2025-05-10 11:28:16', '2025-05-10 11:28:16', 0, 0),
('111239143c8489ef8e53421791b2c3e9', 'Physics', 'P', '2025-03-05 11:42:28', '2025-05-16 13:35:20', 0, 0),
('1502838edf28cac9b0390cd616bd0240', 'Accountancy', 'A', '2025-03-11 07:34:25', '2025-05-09 10:20:40', 0, 0),
('17ae1bb333f280e72bdfeecf08342617', 'Computer Science', 'CS', '2025-05-10 11:27:44', '2025-05-10 11:27:44', 0, 0),
('17afca89d6c133ae83d57d65acc89dd2', 'Nutrition', 'N', '2025-03-14 07:36:48', '2025-05-09 10:20:49', 0, 0),
('1a50115832dd08b87a189d155c62eb31', 'Commerce', 'C', '2025-03-11 07:33:45', '2025-05-09 10:20:58', 0, 0),
('2e45ec206a607ba85a8cb0160e99ade4', 'Kiswahili', 'K', '2025-03-11 07:33:19', '2025-05-09 10:21:07', 0, 0),
('3028d0e628e27d5384fe2c334634db6d', 'General Studies', 'GS', '2025-05-09 10:23:43', '2025-05-19 04:56:00', 1, 1),
('499fb4fc5cb36c9413f708e2290ee465', 'English Language', 'L', '2025-03-11 07:31:41', '2025-05-09 10:21:30', 0, 0),
('535e955119b624e341febdce9a5ab025', 'History', 'H', '2025-03-11 07:34:07', '2025-05-09 10:21:40', 0, 0),
('78a92fb99cfdc7f1e537f9caef0e0684', 'Advanced Mathematics', 'M', '2025-03-11 07:32:31', '2025-05-09 10:22:05', 0, 0),
('79a78e4e6a080e03d3ddf5aaca20b642', 'Chemistry', 'C', '2025-03-05 11:43:22', '2025-05-09 10:22:16', 0, 0),
('921f5461645235088da06b1132a13754', 'Agriculture', 'A', '2025-03-14 07:36:36', '2025-05-09 10:22:27', 0, 0),
('b7b5fc68fb85dd88dc124a38ec488f2c', 'Economics', 'E', '2025-03-11 07:33:28', '2025-05-09 10:22:40', 0, 0),
('ba1c45bc4d5a9ba46387ba1837f90910', 'Basic Applied Mathematics', 'BAM', '2025-03-09 08:41:11', '2025-05-19 05:06:04', 0, 1),
('bbd67ff82f9f3749b72687aa7caa5bba', 'Geography', 'G', '2025-03-11 07:33:58', '2025-05-09 10:22:52', 0, 0),
('de52cabd871248ebd540e4c1616d8477', 'Biology', 'B', '2025-03-09 08:40:11', '2025-05-09 10:23:02', 0, 0),
('f38d3cf78b785d2b10281ebe33c15d8c', 'French', 'F', '2025-05-09 10:45:40', '2025-05-09 10:45:40', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `surname` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `profile_photo` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accreditation_institutions`
--
ALTER TABLE `accreditation_institutions`
  ADD CONSTRAINT `accreditation_institutions_accreditation_id_foreign` FOREIGN KEY (`accreditation_id`) REFERENCES `accreditations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `accreditation_institutions_institution_id_foreign` FOREIGN KEY (`institution_id`) REFERENCES `institutions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `careers`
--
ALTER TABLE `careers`
  ADD CONSTRAINT `careers_field_id_foreign` FOREIGN KEY (`field_id`) REFERENCES `fields` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `career_programs`
--
ALTER TABLE `career_programs`
  ADD CONSTRAINT `career_programs_career_id_foreign` FOREIGN KEY (`career_id`) REFERENCES `careers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `career_programs_program_id_foreign` FOREIGN KEY (`program_id`) REFERENCES `programs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `combination_subjects`
--
ALTER TABLE `combination_subjects`
  ADD CONSTRAINT `combination_subjects_combination_id_foreign` FOREIGN KEY (`combination_id`) REFERENCES `combinations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `combination_subjects_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `entry_requirements`
--
ALTER TABLE `entry_requirements`
  ADD CONSTRAINT `entry_requirements_program_id_foreign` FOREIGN KEY (`program_id`) REFERENCES `programs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `entry_requirement_subjects`
--
ALTER TABLE `entry_requirement_subjects`
  ADD CONSTRAINT `entry_requirement_subjects_entry_requirement_id_foreign` FOREIGN KEY (`entry_requirement_id`) REFERENCES `entry_requirements` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `entry_requirement_subjects_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `institutions`
--
ALTER TABLE `institutions`
  ADD CONSTRAINT `institutions_affiliation_id_foreign` FOREIGN KEY (`affiliation_id`) REFERENCES `institutions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `programs`
--
ALTER TABLE `programs`
  ADD CONSTRAINT `programs_institution_id_foreign` FOREIGN KEY (`institution_id`) REFERENCES `institutions` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
