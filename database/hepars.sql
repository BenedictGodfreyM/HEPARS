-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 28, 2025 at 10:11 AM
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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(12, '41358efa03b04af26873859fe9e15980', 'a2b59dfcf839e4079ea325986087fc53', NULL, NULL),
(15, '41358efa03b04af26873859fe9e15980', '55277a83aa77f8e34730dd47fe47a2e0', NULL, NULL),
(16, 'ca4008b0665abc6dd50630d6f047f7fb', '55277a83aa77f8e34730dd47fe47a2e0', NULL, NULL);

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
('00f2ce991d5c316327c21937247c8485', '50454887affd0f1dcf0354a77aae629d', 'Wellness Consultant', '2025-05-24 07:10:18', '2025-05-24 07:10:18'),
('0129e3301c978c8a54780a9955f92bfa', '144a1bcfa74aa675e045a74f9463430c', 'Interpreter', '2025-05-24 09:42:28', '2025-05-24 09:42:28'),
('01c9aa3ba46e58ee04ae5e2d675939ae', '08e5be3d6ec275be8b4c8c819c10309a', 'Marine Biologist', '2025-05-24 07:25:43', '2025-05-24 07:25:43'),
('01fdbe14d32adfdad3d20383df268069', '658e64e2162b8024259369a02271586f', 'Statistician', '2025-05-24 05:45:17', '2025-05-24 05:45:17'),
('0317f8a8ae5f7c5a08695500101865db', '48f7c12599cac4824ec5f0f9a85b64db', 'Energy Systems Designer', '2025-05-24 05:49:13', '2025-05-24 05:49:13'),
('03e7347d120cc9032aa8f5ae95f2dfee', 'd0db6a91e441fad01bddc7fe1434d0cd', 'Event Coordinator', '2025-05-24 09:34:21', '2025-05-24 09:34:21'),
('04b0a5dee379bac9c73ea37222bafba2', '08e5be3d6ec275be8b4c8c819c10309a', 'Environmental Consultant', '2025-05-23 12:38:24', '2025-05-23 12:38:24'),
('0570aa3b1bf3e220c8f8e2ff1a614007', '658e64e2162b8024259369a02271586f', 'Education Policy Analyst ', '2025-05-24 08:42:20', '2025-05-24 08:42:20'),
('07b8c66e8f704d8dc1aa95867281069d', '144a1bcfa74aa675e045a74f9463430c', 'Language Consultant ', '2025-05-24 09:42:52', '2025-05-24 09:42:52'),
('0933d077302f66c3722bf40fc99d10e0', '658e64e2162b8024259369a02271586f', 'Biostatistician', '2025-05-24 05:44:53', '2025-05-24 05:44:53'),
('0a4a13dbc03776d6c7dd0cb09ccc9c95', '61c85fef3fe628448507cf9fee884834', 'Forensic Accountant ', '2025-05-24 09:30:35', '2025-05-24 09:30:35'),
('0c91aa22a736b3f9da2c0c556784d483', '7144d7eb27e93ecd59dca9f9d1d8cb8f', 'Labour Training and Development Officer', '2025-05-24 09:39:00', '2025-05-24 09:39:00'),
('0d74bdf71c27eb458ffd7a5b6841d122', 'c9dd5ef734bf29254ba768e5a3e120ff', 'Business Records Manager', '2025-05-24 09:28:15', '2025-05-24 09:28:15'),
('0dcf3314272b9259d1e413ee93bd77a5', 'c9dd5ef734bf29254ba768e5a3e120ff', 'Business Consultant', '2025-05-24 09:36:39', '2025-05-24 09:36:39'),
('0fe0f237059bfc6b10d9d38b8409bf0d', '3cbc09a00ae4f273f835f9ca12213399', 'Early Childhood Educator (Pre-School)', '2025-05-24 08:48:28', '2025-05-24 08:50:17'),
('10986b0d2f50094b8a9439f7ef098d82', 'c9dd5ef734bf29254ba768e5a3e120ff', 'Brand Manager', '2025-05-24 09:08:41', '2025-05-24 09:08:41'),
('11137d0c7ecb1bc18a528a7d51fb670e', 'c3c17b192dd8307608a340d0e1cb0364', 'Geologist ', '2025-05-24 07:28:54', '2025-05-24 07:28:54'),
('11fa66c521d90c3da8f97f2a21b6128a', '4e62dc14ecad41cc0039b97b838511d4', 'Data Analyst ', '2025-05-24 07:18:06', '2025-05-24 07:18:06'),
('134707355e84c83cc99c91f7496cf1ea', '658e64e2162b8024259369a02271586f', 'Research Analyst', '2025-05-23 13:08:15', '2025-05-23 13:08:15'),
('13fc4624dbf393df441af50596d4e850', '658e64e2162b8024259369a02271586f', 'Biology Teacher', '2025-05-24 07:22:36', '2025-05-24 07:22:36'),
('16a27b987f7b17ade9bd23d3cd50e906', 'c9dd5ef734bf29254ba768e5a3e120ff', 'International Trade Officer', '2025-05-24 09:35:26', '2025-05-24 09:35:26'),
('17324ab30bc85e538e9ccb01db5051db', 'bf35ffd27e69fca6144f2c9c4143f8d5', 'Legal Researcher', '2025-05-24 07:43:28', '2025-05-24 07:43:28'),
('1805feb784292d77558aae27626e3a48', '50454887affd0f1dcf0354a77aae629d', 'Dentist', '2025-05-15 08:54:22', '2025-05-15 08:54:22'),
('19497335aad6392de992c7b8f2a3fdd8', '50454887affd0f1dcf0354a77aae629d', 'Optician', '2025-05-21 14:02:27', '2025-05-21 14:02:27'),
('1a4e797ba2901fa2c22a2c7279d9e53a', '4e62dc14ecad41cc0039b97b838511d4', 'Medical Records Manager', '2025-05-24 06:46:14', '2025-05-24 06:46:14'),
('1b169c83ea80a8a2d67253a116db1dfc', '3cbc09a00ae4f273f835f9ca12213399', 'Child Development Specialist', '2025-05-24 08:47:17', '2025-05-24 08:47:17'),
('1c293aaf916d259b108048df61b06fd7', '4e62dc14ecad41cc0039b97b838511d4', 'Health Information Officer', '2025-05-24 06:46:03', '2025-05-24 06:46:03'),
('1e9a75d6a0cda2db270a34a847fae5d7', '48f7c12599cac4824ec5f0f9a85b64db', 'Signal Processing Engineer', '2025-05-24 05:43:33', '2025-05-24 05:43:33'),
('20006f5b1d2e2bbec1e1a074f3d68d42', '658e64e2162b8024259369a02271586f', 'Academic Researcher', '2025-05-23 12:44:00', '2025-05-23 12:44:00'),
('2016e9ffe8b2be985e3c2db06bbabf0b', '3c13f7cb18a84b71495e2074305f44a2', 'Public Administrator ', '2025-05-24 09:54:04', '2025-05-24 09:54:04'),
('20eae42ec9907da4a8b4e04f8b1f1fa0', '50454887affd0f1dcf0354a77aae629d', 'Nutritionist', '2025-05-24 07:07:41', '2025-05-24 07:07:41'),
('2132f2b1e8def4f6e990a0b9d517574e', '3c13f7cb18a84b71495e2074305f44a2', 'Foreign Affairs Officer', '2025-05-24 09:59:07', '2025-05-24 09:59:07'),
('22d0d2a39b8dabd29ce821c848cf0305', 'c9dd5ef734bf29254ba768e5a3e120ff', 'Business Analyst', '2025-05-23 12:37:49', '2025-05-23 12:37:49'),
('26088e3530229d17b5e395e67648f469', '08e5be3d6ec275be8b4c8c819c10309a', 'Environmental Laboratory Technician', '2025-05-15 08:54:50', '2025-05-16 13:11:00'),
('265a321e5e1ae5d7a13d9c655c6e5a71', '08e5be3d6ec275be8b4c8c819c10309a', 'Conservation Biologist', '2025-05-24 07:22:11', '2025-05-24 07:22:11'),
('282724fa5d3d6e58bb4c9ce3c9fb1b83', '4e62dc14ecad41cc0039b97b838511d4', 'Clinical Informatics Specialist', '2025-05-24 06:46:52', '2025-05-24 06:46:52'),
('2867402ee6183fda491b26a51f478f03', '48f7c12599cac4824ec5f0f9a85b64db', 'Drilling Engineer', '2025-05-23 12:40:23', '2025-05-23 12:40:23'),
('289742729cfbd9c6eaf7b7be69e67bb0', '4e62dc14ecad41cc0039b97b838511d4', 'Systems Security Consultant', '2025-05-24 07:02:38', '2025-05-24 07:05:47'),
('29d7071db215bca519d1488fe3f7be7f', '50454887affd0f1dcf0354a77aae629d', 'Physiotherapist', '2025-05-21 13:47:24', '2025-05-21 13:47:24'),
('2ba3a196b51b040e43cad9df3155c194', '4e62dc14ecad41cc0039b97b838511d4', 'Systems Analyst', '2025-05-24 06:45:29', '2025-05-24 06:45:29'),
('2c0d45ee83f368356dd643c4da1e7e71', '7d65456e1a4117d8cb5bcdb15195ab6a', 'Art Director ', '2025-05-24 14:44:59', '2025-05-24 14:44:59'),
('2c22cee36acb001283b7fc3113a7cfeb', '50454887affd0f1dcf0354a77aae629d', 'Pharmacist', '2025-05-15 08:54:02', '2025-05-15 08:54:02'),
('2c53e63b8ec2c45850dd676e986059dc', '48f7c12599cac4824ec5f0f9a85b64db', 'Reservoir Engineer', '2025-05-23 12:40:54', '2025-05-23 12:40:54'),
('2ccbbee5f53c9c8668cc1b1f469a2a5d', 'bf35ffd27e69fca6144f2c9c4143f8d5', 'Prosecutor', '2025-05-24 07:43:21', '2025-05-24 07:43:21'),
('2d04c6414a317a8b39c4caa3814ab691', '658e64e2162b8024259369a02271586f', 'Geneticist', '2025-05-24 07:20:23', '2025-05-24 07:20:23'),
('2d6f63478e5b4dfb1ac11110c7108039', '3c13f7cb18a84b71495e2074305f44a2', 'Public Relations Officer ', '2025-05-24 09:58:43', '2025-05-24 09:58:43'),
('2de71d678dfbaca766c59e754781a392', '7d65456e1a4117d8cb5bcdb15195ab6a', 'Journalist', '2025-05-24 09:57:28', '2025-05-24 09:57:28'),
('30f2683fa48deea71a02c554d612bf1c', '3cbc09a00ae4f273f835f9ca12213399', 'Mental Health Advocate', '2025-05-24 08:39:55', '2025-05-24 08:39:55'),
('31f5e3d8de1acbf74ead6c3aeabb6efd', '4e62dc14ecad41cc0039b97b838511d4', 'Cybersecurity Specialist', '2025-05-24 07:01:57', '2025-05-24 07:01:57'),
('32b34586fe6ed820a56fae860b23f292', '4e62dc14ecad41cc0039b97b838511d4', 'IT Consultant', '2025-05-24 06:45:36', '2025-05-24 06:45:36'),
('338f0ff80227cc0120a45fc813b04dc4', '658e64e2162b8024259369a02271586f', 'Academic Planner', '2025-05-24 08:41:37', '2025-05-24 08:41:37'),
('34a1f5e0228534c3a52663c09b6e0afc', '144a1bcfa74aa675e045a74f9463430c', 'Translator', '2025-05-23 13:18:34', '2025-05-23 13:18:34'),
('359e174b3d0368771f75ec7b82d01048', '4e62dc14ecad41cc0039b97b838511d4', 'Software Engineer', '2025-05-24 05:48:06', '2025-05-24 05:48:06'),
('366a6986948163cc9db2821bb850d83e', '4e62dc14ecad41cc0039b97b838511d4', 'Database Administrator', '2025-05-24 06:45:51', '2025-05-24 06:45:51'),
('37bbdcfd23b80693d91e0db6f7129e2d', '3c13f7cb18a84b71495e2074305f44a2', 'Project Manager (Development)', '2025-05-24 09:53:42', '2025-05-24 09:53:42'),
('3849abce22c0e76f9014fcf290fde93e', '4e62dc14ecad41cc0039b97b838511d4', 'Game Designer', '2025-05-24 06:04:06', '2025-05-24 06:04:06'),
('3ad647963a4d47eff2f871be980b7fd3', 'c3c17b192dd8307608a340d0e1cb0364', 'Mining Engineer', '2025-05-24 06:06:25', '2025-05-24 06:06:25'),
('3b0f0a92aa3bb442637449cc8d658510', '48f7c12599cac4824ec5f0f9a85b64db', 'Electric Engineer', '2025-05-15 08:55:28', '2025-05-15 08:55:28'),
('3ded19dfdb04f7b95d8882c1c514bbb3', '4e62dc14ecad41cc0039b97b838511d4', 'Systems Integrator', '2025-05-24 07:17:56', '2025-05-24 07:17:56'),
('3e5fb51eb5dc145ccf9ecc962d2f32bc', '658e64e2162b8024259369a02271586f', 'Physicist', '2025-05-24 05:50:01', '2025-05-24 05:50:01'),
('3f1591c59054cdc2be79a63705175421', '4e62dc14ecad41cc0039b97b838511d4', 'Digital Forensics Analyst', '2025-05-24 07:02:05', '2025-05-24 07:02:05'),
('3fa814976e8a0bca42b77d3cec3201b9', '3c13f7cb18a84b71495e2074305f44a2', 'Development Officer', '2025-05-23 12:44:50', '2025-05-23 12:44:50'),
('3fc045b849bd160376bd795c2db4e2c5', '08e5be3d6ec275be8b4c8c819c10309a', 'Water Quality Analyst', '2025-05-24 07:25:50', '2025-05-24 07:25:50'),
('408ed38aa0c716c22b62813f8d003af8', '50454887affd0f1dcf0354a77aae629d', 'Pediatrician', '2025-05-24 05:40:46', '2025-05-24 05:40:46'),
('4111d3523d9b6465ee76642c360fbd68', '3c13f7cb18a84b71495e2074305f44a2', 'Political Scientist', '2025-05-24 09:54:26', '2025-05-24 09:54:26'),
('427b69a91de06d99d38b7096282bcadf', '658e64e2162b8024259369a02271586f', 'History Teacher', '2025-05-24 09:59:52', '2025-05-24 09:59:52'),
('44187f56a21fd410123a3a600c8b6128', '4e62dc14ecad41cc0039b97b838511d4', 'Business Systems Analyst', '2025-05-24 07:16:22', '2025-05-24 07:16:22'),
('4442d567f2d239fc845ff535c14dceec', 'd0db6a91e441fad01bddc7fe1434d0cd', 'Hotel Manager', '2025-05-24 09:34:11', '2025-05-24 09:34:11'),
('4478d087f79f0d170a7d3aacbe023b03', 'c3c17b192dd8307608a340d0e1cb0364', 'Extractive Metallurgist', '2025-05-24 06:34:37', '2025-05-24 06:34:37'),
('475893aa1944b1a639024c0ca4b49377', '4e62dc14ecad41cc0039b97b838511d4', 'DevOps Engineer', '2025-05-24 05:47:38', '2025-05-24 05:47:38'),
('477f856bef6bd6a0b88955142a9b625d', '7144d7eb27e93ecd59dca9f9d1d8cb8f', 'Labor Relations Officer', '2025-05-24 09:38:46', '2025-05-24 09:38:46'),
('49526c9045a1507125a079a8950ad205', '61c85fef3fe628448507cf9fee884834', 'Economist', '2025-05-23 12:45:42', '2025-05-23 12:45:42'),
('4ac1e1dc3a1eba40cbc01a2378d06fca', '50454887affd0f1dcf0354a77aae629d', 'Optometrist', '2025-05-21 14:06:24', '2025-05-21 14:06:24'),
('4bc6e7954c6519a2a46442bdf1d15fd1', '4e62dc14ecad41cc0039b97b838511d4', 'Full-Stack Developer', '2025-05-24 07:05:26', '2025-05-24 07:05:26'),
('4c9ec7656259cf2d0db6fe739c4bd311', 'd0db6a91e441fad01bddc7fe1434d0cd', 'Travel Agency Manager', '2025-05-24 09:34:44', '2025-05-24 09:34:44'),
('4cfe10f2546cceac7b9fe2d4d1eb8021', 'c3c17b192dd8307608a340d0e1cb0364', 'Remote Sensing Specialist', '2025-05-24 06:47:37', '2025-05-24 06:47:37'),
('4d2d0e669618f9de050289557127785b', '7d65456e1a4117d8cb5bcdb15195ab6a', 'Theatre Production Manager', '2025-05-24 09:48:59', '2025-05-24 09:48:59'),
('4e459826f27f853e3311dab6ace4e8e7', '3cbc09a00ae4f273f835f9ca12213399', 'Psychologist', '2025-05-24 08:38:50', '2025-05-24 08:38:50'),
('4ead18e091a7b639930f3fd544d75676', '5ab4622bf85c2260ef7659b96afa4d08', 'Urban Planning Analyst', '2025-05-24 10:13:40', '2025-05-24 10:13:40'),
('4eaf73ba792acea1ca7a01e7ef991f4f', '4e62dc14ecad41cc0039b97b838511d4', 'Data Scientist', '2025-05-24 07:05:12', '2025-05-24 07:05:12'),
('4f54563feb60b5b73df55c2a9fac3707', '2ce9bfa769ff08067d65108a501b8d94', 'Heritage Site Manager', '2025-05-23 12:43:34', '2025-05-23 12:43:34'),
('5062c48b0c35cfbdfd110720525c7776', '48f7c12599cac4824ec5f0f9a85b64db', 'Civil Engineer', '2025-05-15 08:55:07', '2025-05-15 08:55:07'),
('51dddf8ce17cd7e5ac2073d23bfc7a09', 'c9dd5ef734bf29254ba768e5a3e120ff', 'Business Data Manager', '2025-05-24 09:24:13', '2025-05-24 09:24:13'),
('52892b4f227ac22853bc61b21b5113a6', 'c3c17b192dd8307608a340d0e1cb0364', 'Mineral Processing Engineer', '2025-05-24 06:35:04', '2025-05-24 06:35:04'),
('532b8dbdee4b4e80ef2a258de3a88746', '658e64e2162b8024259369a02271586f', 'Mathematics Teacher', '2025-05-24 06:40:00', '2025-05-24 06:40:00'),
('55ecad39cc6aac2aef7e3b6ceb0a42f6', 'd0db6a91e441fad01bddc7fe1434d0cd', 'Tourism Officer', '2025-05-24 09:32:34', '2025-05-24 09:32:34'),
('5825f16bb8a05c380bc76dce418efa90', '61c85fef3fe628448507cf9fee884834', 'Auditor', '2025-05-24 09:29:55', '2025-05-24 09:29:55'),
('5899d48c078f6e287d1fe8113e32e0af', '4e62dc14ecad41cc0039b97b838511d4', 'Mobile App Developer', '2025-05-24 05:47:09', '2025-05-24 05:47:09'),
('5953da6faeef9d9c6c34888defbbeadf', '4e62dc14ecad41cc0039b97b838511d4', 'Backend Developer', '2025-05-24 05:47:52', '2025-05-24 05:47:52'),
('598eab98059b4b83284b2bb936d340d2', '658e64e2162b8024259369a02271586f', 'Science Curriculum Specialist', '2025-05-24 05:42:23', '2025-05-24 05:42:23'),
('5bee96e11cda2dc1dffa95d99475f6ba', '4e62dc14ecad41cc0039b97b838511d4', 'Ethical Hacker', '2025-05-24 07:02:47', '2025-05-24 07:02:47'),
('5e1a96ff22299e054213c2c46c514f88', '08e5be3d6ec275be8b4c8c819c10309a', 'Aquatic Ecologist', '2025-05-24 07:25:56', '2025-05-24 07:25:56'),
('5e5d3d9be3fa097139ee458dece1db0e', '3cbc09a00ae4f273f835f9ca12213399', 'Archaeologist', '2025-05-23 12:42:51', '2025-05-23 12:42:51'),
('5ecb11e51b4b6b9c8bf0b5fe906091c0', '50454887affd0f1dcf0354a77aae629d', 'Dietitian', '2025-05-24 07:09:38', '2025-05-24 07:09:38'),
('5f20f3d241d74f71d673c3278bdfd87e', '3c13f7cb18a84b71495e2074305f44a2', 'Public Policy Advisor', '2025-05-24 09:55:40', '2025-05-24 09:55:40'),
('5ffd5fba366a3ae75767791773161ec8', '08e5be3d6ec275be8b4c8c819c10309a', 'Sustainability Officer', '2025-05-23 12:38:56', '2025-05-23 12:38:56'),
('6166811f9414456f88cabfa302eb5d42', '08e5be3d6ec275be8b4c8c819c10309a', 'Water Resources Engineer', '2025-05-24 06:49:44', '2025-05-24 06:49:44'),
('61dbb77ba08e00b6ab63a01d28d3d8d7', '3c13f7cb18a84b71495e2074305f44a2', 'Political Analyst', '2025-05-24 09:54:49', '2025-05-24 09:54:49'),
('6326e9edc663907ac49e8d1417de17a3', '3cbc09a00ae4f273f835f9ca12213399', 'Behavior Analyst', '2025-05-24 08:39:48', '2025-05-24 08:39:48'),
('64d0f39750b325acf6624d6951210b37', '658e64e2162b8024259369a02271586f', 'Medical Researcher', '2025-05-24 10:18:12', '2025-05-24 10:18:12'),
('64f0d64deb387513db9be42d04647f30', '4e62dc14ecad41cc0039b97b838511d4', 'UI/UX Designer', '2025-05-24 06:04:17', '2025-05-24 06:04:17'),
('65225ad2aaf74e2ec7f3f2b6df878baa', 'bf35ffd27e69fca6144f2c9c4143f8d5', 'Magistrate', '2025-05-24 07:43:38', '2025-05-24 07:43:38'),
('66b3bcff99666ef03f1f7cbd2104a43b', '08e5be3d6ec275be8b4c8c819c10309a', 'Pollution Control Officer', '2025-05-24 06:49:51', '2025-05-24 06:49:51'),
('677f1424b29cddbb12f5c9c91740dd86', '3c13f7cb18a84b71495e2074305f44a2', 'Corporate Communications Specialist', '2025-05-24 09:58:52', '2025-05-24 09:58:52'),
('68ec694fdbb0721a3ef5e1612c529ec2', 'c3c17b192dd8307608a340d0e1cb0364', 'Geospatial Data Scientist', '2025-05-24 06:47:52', '2025-05-24 06:47:52'),
('69d9ac8cfe5c4185b1bd26e850c4fdf7', '3cbc09a00ae4f273f835f9ca12213399', 'Sociologist', '2025-05-24 09:49:26', '2025-05-24 09:49:26'),
('6e1d5ed2346feb1919657f7ece4e53f6', '7d65456e1a4117d8cb5bcdb15195ab6a', 'Technical Director (Broadcasting)', '2025-05-24 06:55:05', '2025-05-24 06:55:05'),
('6e7ea0b6a5e77e8fed029489c2ff9ecf', '144a1bcfa74aa675e045a74f9463430c', 'Multilingual Editor', '2025-05-24 09:43:10', '2025-05-24 09:43:10'),
('6ee28b5b75d7b07a47479b23f1d5e490', '61c85fef3fe628448507cf9fee884834', 'Quantitative Analyst', '2025-05-24 06:41:42', '2025-05-24 06:41:42'),
('7267624fa2966cfab6f4ca0ca41e6a89', '658e64e2162b8024259369a02271586f', 'Laboratory Technician', '2025-05-24 07:24:47', '2025-05-24 07:24:47'),
('7268d82dcec803fd423de7b47a9dd7db', 'c9dd5ef734bf29254ba768e5a3e120ff', 'Business Intelligence Analyst ', '2025-05-23 13:03:41', '2025-05-23 13:03:41'),
('72d8ea087d6ce217b157fe53e1eca6f2', '4e62dc14ecad41cc0039b97b838511d4', 'IoT Specialist', '2025-05-24 07:07:11', '2025-05-24 07:07:11'),
('731b6bb9e4a2a9047d39dc831386e22c', '3cbc09a00ae4f273f835f9ca12213399', 'Anthropologist', '2025-05-23 12:43:01', '2025-05-23 12:43:01'),
('73395dd7a5e74260435e3b47b760a439', '658e64e2162b8024259369a02271586f', 'French Teacher', '2025-05-23 13:18:14', '2025-05-23 13:18:14'),
('734bf01dc54bdd4b4c8cb3ae7436a902', '3c13f7cb18a84b71495e2074305f44a2', 'Monitoring and Evaluation Officer (Development)', '2025-05-23 12:45:22', '2025-05-24 12:15:25'),
('74ca651cfa9d1a3283e79f2332baea7f', '3cbc09a00ae4f273f835f9ca12213399', 'Rehabilitation Officer', '2025-05-24 08:38:26', '2025-05-24 08:38:26'),
('750af63ba84962b5a661c8ee930cd5cc', '2ce9bfa769ff08067d65108a501b8d94', 'Museum Curator', '2025-05-23 12:43:21', '2025-05-23 12:43:21'),
('7512b4d11fdf5ee948e718d67a835220', '7d65456e1a4117d8cb5bcdb15195ab6a', 'Multimedia Engineer', '2025-05-24 06:54:35', '2025-05-24 06:54:35'),
('7649589b71471bd055b2f1e917aeecf0', '658e64e2162b8024259369a02271586f', 'Archival Specialist ', '2025-05-24 10:00:52', '2025-05-24 10:00:52'),
('7692ca13d1f45afc651ed745d4198956', '658e64e2162b8024259369a02271586f', 'Science Teacher', '2025-05-24 05:41:49', '2025-05-24 05:41:49'),
('76fef40ec67f7451b8fd9e1eaa0cbe0b', '4e62dc14ecad41cc0039b97b838511d4', 'Information System Auditor', '2025-05-24 07:03:03', '2025-05-24 07:03:03'),
('7828423d6bddd73825a746a660f6ddb8', '50454887affd0f1dcf0354a77aae629d', 'Occupational Therapist', '2025-05-21 14:08:16', '2025-05-21 14:08:16'),
('79d9fe76271cd5db36b8c27a769581b0', '61c85fef3fe628448507cf9fee884834', 'Actuary', '2025-05-24 07:40:33', '2025-05-24 07:40:33'),
('7c4339d2c8733b9623cbdd2af92fd918', 'c3c17b192dd8307608a340d0e1cb0364', 'Metallurgical Engineer', '2025-05-24 06:35:14', '2025-05-24 06:35:14'),
('7e4c06f3f370820fb14a44d945b99124', '2ce9bfa769ff08067d65108a501b8d94', 'Museum Guide', '2025-05-24 09:44:40', '2025-05-24 09:44:40'),
('7e63b75915adfd46b91fa3164f18bd20', '720a381f6fa41ceccd81e87b1a793462', 'Quality Control Analyst', '2025-05-24 07:13:47', '2025-05-24 07:13:47'),
('7ef5013b53eecb157cc3af230064ba87', '7d65456e1a4117d8cb5bcdb15195ab6a', 'Film Editor', '2025-05-24 09:48:49', '2025-05-24 09:48:49'),
('80d9eb04703935bab8c30d438dc61f93', 'c9dd5ef734bf29254ba768e5a3e120ff', 'Market Analyst', '2025-05-23 12:46:30', '2025-05-23 12:46:30'),
('816c6eb4c75db6b8e5e37775eeb0b1ac', '720a381f6fa41ceccd81e87b1a793462', 'Production Manager', '2025-05-24 07:14:00', '2025-05-24 07:14:00'),
('81b57fcbbc12f82443be173a06d4ff31', '3cbc09a00ae4f273f835f9ca12213399', 'Social Researcher', '2025-05-23 12:47:35', '2025-05-23 12:47:35'),
('81f24cacad319add2a30a1e1cbf07079', '4e62dc14ecad41cc0039b97b838511d4', 'Telecommunications Engineer', '2025-05-24 05:42:57', '2025-05-24 05:42:57'),
('84f66027a00af2f2f2b0a0fb2f154877', 'c9dd5ef734bf29254ba768e5a3e120ff', 'Entrepreneur', '2025-05-23 12:37:21', '2025-05-23 12:37:21'),
('85076d31bf5c2b85e3bc075cf97ea697', '5ab4622bf85c2260ef7659b96afa4d08', 'Urban Planner', '2025-05-23 12:39:50', '2025-05-23 12:39:50'),
('87fe2e0810b95f51d066d790cbae6ba3', '658e64e2162b8024259369a02271586f', 'Education Program Developer', '2025-05-24 05:42:04', '2025-05-24 05:42:04'),
('88551eb98a26b16c85831b27a8fc6624', 'bf35ffd27e69fca6144f2c9c4143f8d5', 'Lawyer', '2025-05-24 07:43:01', '2025-05-24 07:43:01'),
('89aecf4b2c4b8abe40117b9d50a8f195', '658e64e2162b8024259369a02271586f', 'ICT Teacher', '2025-05-24 08:33:19', '2025-05-24 08:33:19'),
('8af1b47a2b16424377391ed639b6755b', '658e64e2162b8024259369a02271586f', 'Career Guidance Specialist', '2025-05-24 08:43:50', '2025-05-24 08:43:50'),
('8b602222a31fa4a91ef3bef238946080', '08e5be3d6ec275be8b4c8c819c10309a', 'Environmental Engineer', '2025-05-24 06:49:25', '2025-05-24 06:49:25'),
('8be7ca763621ecf8c8a90a87b31d1956', '7d65456e1a4117d8cb5bcdb15195ab6a', 'News Editor', '2025-05-24 09:57:42', '2025-05-24 09:57:42'),
('8d63ed0403e9782b5248a5bb1a1ea35f', '61c85fef3fe628448507cf9fee884834', 'Tax Consultant', '2025-05-24 09:30:25', '2025-05-24 09:30:25'),
('94b935c9374fad9f016b1b1f96c01e8b', '658e64e2162b8024259369a02271586f', 'Physics Teacher', '2025-05-24 06:03:13', '2025-05-24 06:03:13'),
('9787a81eb04e4eb77e6d90d69d9c1bbc', '658e64e2162b8024259369a02271586f', 'Historian', '2025-05-24 09:59:42', '2025-05-24 09:59:42'),
('99a906c47fded7a412301f520838bf89', '7144d7eb27e93ecd59dca9f9d1d8cb8f', 'Human Resource Manager', '2025-05-24 09:38:29', '2025-05-24 09:38:29'),
('9a2d2e681f71f487c53330ec971f686f', 'bf35ffd27e69fca6144f2c9c4143f8d5', 'Legal Advisor', '2025-05-24 07:43:08', '2025-05-24 07:43:08'),
('9a65833dd16bc911d50b716bf092a842', '08e5be3d6ec275be8b4c8c819c10309a', 'Green Economy Advisor', '2025-05-23 13:12:49', '2025-05-23 13:12:49'),
('9a9ddfd68e4862c6f8aad351d2d2a25a', '48f7c12599cac4824ec5f0f9a85b64db', 'Chemical Engineer', '2025-05-24 07:14:22', '2025-05-24 07:14:22'),
('9b66f77560076c48604ce8cad6cbc1a1', 'c3c17b192dd8307608a340d0e1cb0364', 'Mining Consultant', '2025-05-24 06:34:22', '2025-05-24 06:34:22'),
('9b9039287ccd6957e6ab9c1f25664cef', 'c9dd5ef734bf29254ba768e5a3e120ff', 'Sales Manager', '2025-05-24 09:09:20', '2025-05-24 09:09:20'),
('9c9add8e5f7fb4da88459b61649e3c6c', '7d65456e1a4117d8cb5bcdb15195ab6a', 'Film Director', '2025-05-24 09:48:28', '2025-05-24 09:48:28'),
('a01176e0e6893a17211db7118ee83d5d', '658e64e2162b8024259369a02271586f', 'English Teacher', '2025-05-23 13:10:13', '2025-05-23 13:10:13'),
('a12115a3cf173b23e2542e5d7aaa4732', 'b2c4de026257d3a8ad9079c986d96475', 'Logistics Manager', '2025-05-24 09:07:08', '2025-05-24 09:07:08'),
('a14f3145aee3d222de720317f0eef992', '3c13f7cb18a84b71495e2074305f44a2', 'Communication Specialist', '2025-05-23 13:10:56', '2025-05-23 13:10:56'),
('a159c489c2e87580031e6c7b08e97300', '3cbc09a00ae4f273f835f9ca12213399', 'Mental Health Counselor', '2025-05-24 08:45:50', '2025-05-24 08:45:50'),
('a1c9228523a838ca2f98510a0bc2a19c', '7d65456e1a4117d8cb5bcdb15195ab6a', 'AV Systems Specialist', '2025-05-24 06:54:45', '2025-05-24 06:54:45'),
('a43c06fff1f82728259ac992058695dd', '48f7c12599cac4824ec5f0f9a85b64db', 'Petroleum Engineer', '2025-05-23 12:40:14', '2025-05-23 12:40:14'),
('aa05f56010d00cea958ba4669fc183b1', '658e64e2162b8024259369a02271586f', 'Literary Critic', '2025-05-23 13:10:29', '2025-05-23 13:10:29'),
('aa83d92b6079265c02b41a967545080a', '7d65456e1a4117d8cb5bcdb15195ab6a', 'Media Content Writer', '2025-05-23 13:09:46', '2025-05-24 06:52:55'),
('aaff3fa62c15f8479277f27d6a6004d8', '08e5be3d6ec275be8b4c8c819c10309a', 'Environmental Safety Officer', '2025-05-24 08:29:08', '2025-05-24 08:29:08'),
('ab4a9b0d3771242097b89a5a04ed0c99', 'b2c4de026257d3a8ad9079c986d96475', 'Inventory Controller', '2025-05-24 09:07:20', '2025-05-24 09:07:20'),
('ab679f68ded092a60046c3d5be9fa6e4', '658e64e2162b8024259369a02271586f', 'Editor', '2025-05-23 13:11:28', '2025-05-23 13:11:28'),
('ab7ab2cd6287e06a37a4e5c38844dfd2', '658e64e2162b8024259369a02271586f', 'Laboratory Scientist ', '2025-05-24 06:01:19', '2025-05-24 06:01:19'),
('abee3c9575ea3011a5e699a95f7901b5', '658e64e2162b8024259369a02271586f', 'Kiswahili Teacher', '2025-05-24 10:14:20', '2025-05-24 10:14:46'),
('ad7dc7e37bbb3a4ab561ece0622c8e3d', '61c85fef3fe628448507cf9fee884834', 'Economic Consultant', '2025-05-23 12:46:56', '2025-05-23 12:46:56'),
('ae722daad34e68bfc7ed015f538124fb', '08e5be3d6ec275be8b4c8c819c10309a', 'Environmental Laboratory Scientist', '2025-05-15 08:54:42', '2025-05-15 08:54:42'),
('b00ebc967dcb285eff4372f511de8266', '4e62dc14ecad41cc0039b97b838511d4', 'Software Quality Assurance Engineer', '2025-05-24 06:36:18', '2025-05-24 06:36:18'),
('b0ae67161f7180a938afccfa4cca88c8', '658e64e2162b8024259369a02271586f', 'Chemistry Teacher', '2025-05-24 07:12:44', '2025-05-24 07:12:44'),
('b0d0a1efdd7cb0cec91731f2a86d6aba', '61c85fef3fe628448507cf9fee884834', 'Accountant', '2025-05-24 09:29:40', '2025-05-24 09:29:40'),
('b0edccc32cb0560c52a4eaddab1f14a4', '4e62dc14ecad41cc0039b97b838511d4', 'Visual Effects Artist', '2025-05-24 06:04:28', '2025-05-24 06:04:28'),
('b0ff8d7d57b4a72eff1ecd50b33523b9', 'c9dd5ef734bf29254ba768e5a3e120ff', 'Business Manager', '2025-05-23 12:36:56', '2025-05-23 12:36:56'),
('b186522af48c6a56fd74757d61012346', 'b2c4de026257d3a8ad9079c986d96475', 'Supply Chain Analyst', '2025-05-24 09:07:13', '2025-05-24 09:07:13'),
('b26340fab0e284415a48e805e22f70dd', '2ce9bfa769ff08067d65108a501b8d94', 'Art Gallery Curator', '2025-05-24 14:40:38', '2025-05-24 14:40:38'),
('b3cb8d90ff474ca62012e60838cfd805', '4e62dc14ecad41cc0039b97b838511d4', 'Software Developer', '2025-05-24 07:03:44', '2025-05-24 07:03:44'),
('b69ed4c8c6d81f16573acdf351b8a73f', '3cbc09a00ae4f273f835f9ca12213399', 'Psychosocial Support Officer', '2025-05-24 08:45:45', '2025-05-24 08:45:45'),
('b6d0650393d2dfb43069c90c1f2fa45b', '4e62dc14ecad41cc0039b97b838511d4', 'Computer Engineer', '2025-05-24 07:06:49', '2025-05-24 07:06:49'),
('bcb4fc57590d4c906f53060c46e24fee', 'c9dd5ef734bf29254ba768e5a3e120ff', 'Digital Marketing Specialist', '2025-05-24 09:09:13', '2025-05-24 09:09:13'),
('bce30018049c9d7a6078e92fa1d24287', '7d65456e1a4117d8cb5bcdb15195ab6a', 'Film Screenwriter', '2025-05-24 09:48:36', '2025-05-24 09:48:36'),
('bd6e3beb44084759f5c705e60074bc90', '658e64e2162b8024259369a02271586f', 'Pharmaceutical Research Scientist', '2025-05-24 07:20:36', '2025-05-24 07:20:36'),
('c01c8e28bc78d4ac59427fd6d4103d88', '2ce9bfa769ff08067d65108a501b8d94', 'Heritage Consultant', '2025-05-24 10:00:22', '2025-05-24 10:00:22'),
('c05b6d8587b1dcd4ff05147c82f225b4', '658e64e2162b8024259369a02271586f', 'Language Teacher', '2025-05-24 09:56:16', '2025-05-24 09:56:16'),
('c13aaa4c32013a86e969196152d872e7', '3cbc09a00ae4f273f835f9ca12213399', 'Learning Support Specialist', '2025-05-24 08:38:38', '2025-05-24 08:39:35'),
('c1f890ebd26d17286ca4bac03658015b', '3c13f7cb18a84b71495e2074305f44a2', 'Community Development Specialist', '2025-05-23 12:45:03', '2025-05-23 12:45:03'),
('c2e3d45cd971d5520ad550939f8617ac', '658e64e2162b8024259369a02271586f', 'Adult Educator', '2025-05-24 08:53:29', '2025-05-24 08:53:29'),
('c420a624b567e1eadafcefdbd7f333ea', '7d65456e1a4117d8cb5bcdb15195ab6a', 'Media Analyst ', '2025-05-24 09:58:00', '2025-05-24 09:58:00'),
('c5372bd13303b04b6ab2975f79174ba7', '658e64e2162b8024259369a02271586f', 'Academic Advisor', '2025-05-24 08:43:29', '2025-05-24 08:43:29'),
('c9490b8a50f7a5651e0a5f845c52db2b', 'c9dd5ef734bf29254ba768e5a3e120ff', 'Marketing Manager', '2025-05-24 09:08:31', '2025-05-24 09:08:31'),
('ca4242c399770153b0c5aad95a121096', '08e5be3d6ec275be8b4c8c819c10309a', 'Climate Change Analyst', '2025-05-23 12:38:36', '2025-05-23 12:38:36'),
('ca578a14cda8288e6ad10c6ee2951f1a', '4e62dc14ecad41cc0039b97b838511d4', 'Network Engineer', '2025-05-24 05:43:14', '2025-05-24 05:43:14'),
('ca6f4aa69d4996b202467f413ad783d8', '3cbc09a00ae4f273f835f9ca12213399', 'Special Needs Educator', '2025-05-24 08:38:03', '2025-05-24 08:38:03'),
('cc026e08d2939711301f79caec5fd16a', '3cbc09a00ae4f273f835f9ca12213399', 'School Counselor', '2025-05-24 08:39:07', '2025-05-24 08:39:07'),
('cc680b1e393ef1e270749a34de91c7f8', 'c3c17b192dd8307608a340d0e1cb0364', 'Cartographer', '2025-05-24 06:47:44', '2025-05-24 06:47:44'),
('cd925a96c67fa60359658f7454f364d5', '48f7c12599cac4824ec5f0f9a85b64db', 'Production Technologist', '2025-05-23 12:41:03', '2025-05-23 12:41:03'),
('cf98c5ea843cebb71499b387bf0d2be0', '658e64e2162b8024259369a02271586f', 'Mathematician', '2025-05-24 06:39:18', '2025-05-24 06:39:18'),
('cfcc8d94f159d3be0002b99dd791160e', 'c9dd5ef734bf29254ba768e5a3e120ff', 'Business Information Analyst', '2025-05-24 09:27:48', '2025-05-24 09:27:48'),
('d0f1705d513999c65a0d2977153dbbd9', '7d65456e1a4117d8cb5bcdb15195ab6a', 'Digital Content Producer', '2025-05-24 06:54:26', '2025-05-24 06:54:26'),
('d1f93c4a7e9cb30ae838b5aed677781f', '61c85fef3fe628448507cf9fee884834', 'Investment Banker ', '2025-05-24 09:39:39', '2025-05-24 09:39:39'),
('d26c64ed80b56e2d953d28084572c29c', '08e5be3d6ec275be8b4c8c819c10309a', 'Ecologist', '2025-05-24 06:49:10', '2025-05-24 06:49:10'),
('d3a8ce4701c3f8e06435835601d77120', '08e5be3d6ec275be8b4c8c819c10309a', 'Aquaculture Specialist', '2025-05-24 07:26:11', '2025-05-24 07:26:11'),
('d408e5d1e3dedbc0b80183ee916c312d', '50454887affd0f1dcf0354a77aae629d', 'Surgeon', '2025-05-24 05:41:13', '2025-05-24 05:41:13'),
('d41e546d2cadeb5394a925acc1b68022', '4e62dc14ecad41cc0039b97b838511d4', 'IT Project Manager', '2025-05-24 07:17:24', '2025-05-24 07:17:24'),
('d4323224c4e31ded4d403643ea85ab25', '3c13f7cb18a84b71495e2074305f44a2', 'Public Policy Analyst', '2025-05-24 09:54:18', '2025-05-24 09:54:18'),
('d45f1e57d43405cd63db32aa6e74c7fd', '08e5be3d6ec275be8b4c8c819c10309a', 'Disaster Risk Manager', '2025-05-24 08:29:40', '2025-05-24 08:29:40'),
('d49a8cd3940665bea8266b2834358758', '658e64e2162b8024259369a02271586f', 'Biotechnologist', '2025-05-24 07:19:13', '2025-05-24 07:19:13'),
('d4ea55dd0d1e7196a4e2884f41bce795', 'd0db6a91e441fad01bddc7fe1434d0cd', 'Tour Guide', '2025-05-23 13:19:12', '2025-05-23 13:19:12'),
('d4f5f36921781f7bac7e87184f96b796', '4e62dc14ecad41cc0039b97b838511d4', 'Embedded Systems Developer', '2025-05-24 07:06:56', '2025-05-24 07:06:56'),
('d5d5cf9ffba5777f70d644b1fae75ba0', '08e5be3d6ec275be8b4c8c819c10309a', 'Waste Management Engineer', '2025-05-24 06:49:34', '2025-05-24 06:49:34'),
('d64957f8870b8c106729003eac435efe', '50454887affd0f1dcf0354a77aae629d', 'Medical Doctor (MD)', '2025-05-15 08:53:32', '2025-05-15 08:53:32'),
('d66e4ffeadeea835a2365b729bb75000', 'c3c17b192dd8307608a340d0e1cb0364', 'GIS Analyst', '2025-05-24 06:47:30', '2025-05-24 06:47:30'),
('d70f1186a78a3dd6fc2f9ee8e8f2d6a3', '3c13f7cb18a84b71495e2074305f44a2', 'Program Coordinator (Development)', '2025-05-24 09:52:48', '2025-05-24 09:52:48'),
('d912bbca27b0ea4532ebd540a226b233', '658e64e2162b8024259369a02271586f', 'Secondary School Teacher', '2025-05-24 08:53:10', '2025-05-24 08:53:10'),
('db0fa7d2998000e083f02918b7efadc9', '3c13f7cb18a84b71495e2074305f44a2', 'Diplomat', '2025-05-24 09:59:00', '2025-05-24 09:59:00'),
('de2b3d9d013489cad0a5d2ebdf52af7f', '658e64e2162b8024259369a02271586f', 'Biologist', '2025-05-24 07:20:13', '2025-05-24 07:20:13'),
('de43ec2245836e80a06a0f3629ef17e4', '50454887affd0f1dcf0354a77aae629d', 'Nurse', '2025-05-15 08:53:48', '2025-05-15 08:53:48'),
('e37936c784eba8412a2c7b362aa14a35', 'b2c4de026257d3a8ad9079c986d96475', 'Procurement Officer', '2025-05-24 09:07:01', '2025-05-24 09:07:01'),
('e3ff95c19467ec21e3706a98c8cb9ee9', 'b2c4de026257d3a8ad9079c986d96475', 'Purchasing Manager', '2025-05-24 09:07:27', '2025-05-24 09:07:27'),
('e4681cf72b4469f823470de456a273f9', '08e5be3d6ec275be8b4c8c819c10309a', 'Environmental Economist', '2025-05-23 13:12:04', '2025-05-23 13:12:04'),
('e61f98369a40e651967fbc29538284f3', '658e64e2162b8024259369a02271586f', 'Chemist', '2025-05-24 07:10:55', '2025-05-24 07:10:55'),
('eca30a10769a4ad70cb626764f013e8f', '08e5be3d6ec275be8b4c8c819c10309a', 'Conservation Officer', '2025-05-24 06:48:58', '2025-05-24 06:48:58'),
('eea402ad3b6f6e6801aa1d5902d96c6d', '2ce9bfa769ff08067d65108a501b8d94', 'Cultural Liaison Officer', '2025-05-24 09:57:03', '2025-05-24 09:57:03'),
('f0fe62de61b7eb2bcb611cdd0fd25fd7', '61c85fef3fe628448507cf9fee884834', 'Financial Analyst', '2025-05-23 12:46:01', '2025-05-23 12:46:01'),
('f1804426ccd5f96d3f4af74e77cfa889', '658e64e2162b8024259369a02271586f', 'School Administrator ', '2025-05-24 08:55:15', '2025-05-24 08:55:15'),
('f1f3a9d54db709374bb306887e315380', '61c85fef3fe628448507cf9fee884834', 'Economic Statistician', '2025-05-24 10:02:26', '2025-05-24 10:02:26'),
('f28d40226fd07ed6d9b92baee16bb955', '48f7c12599cac4824ec5f0f9a85b64db', 'Renewable Energy Engineer', '2025-05-24 05:48:43', '2025-05-24 05:48:43'),
('f372c61aef58904cb505dec7d0af2045', 'c3c17b192dd8307608a340d0e1cb0364', 'Mining Quality Assurance Engineer', '2025-05-24 06:35:57', '2025-05-24 06:35:57'),
('f4db7c57eb786b3ae775de37b2fa68b1', '3c13f7cb18a84b71495e2074305f44a2', 'Capacity Building Specialist (Development)', '2025-05-24 09:52:56', '2025-05-24 09:52:56'),
('f5050c9fc103384bc8c71bae1973bf7e', '48f7c12599cac4824ec5f0f9a85b64db', 'Optical Engineer', '2025-05-24 06:01:42', '2025-05-24 06:01:42'),
('f6c8668acd578c754ede8ec92267e2de', '08e5be3d6ec275be8b4c8c819c10309a', 'Environmental Scientist', '2025-05-24 06:48:50', '2025-05-24 06:48:50'),
('f73470f471de7e9919fc09b09eb86119', '3cbc09a00ae4f273f835f9ca12213399', 'Socioeconomic Analyst', '2025-05-23 12:47:21', '2025-05-23 12:47:21'),
('f74594019a7d0bb4c0d24be4b185a8fe', '658e64e2162b8024259369a02271586f', 'Biomedical Researcher', '2025-05-24 07:21:46', '2025-05-24 07:21:46'),
('f95011ab7e9f790540906b920b83176e', '7144d7eb27e93ecd59dca9f9d1d8cb8f', 'Talent Acquisition Specialist', '2025-05-24 09:38:36', '2025-05-24 09:38:36'),
('f970d5cd0f935ece677bdf1d4c8b9d9c', '50454887affd0f1dcf0354a77aae629d', 'Orthotician', '2025-05-21 13:53:08', '2025-05-21 13:53:08'),
('f9951101250cf3bfd1e0af55608308c9', '4e62dc14ecad41cc0039b97b838511d4', 'Animator', '2025-05-24 06:05:26', '2025-05-24 06:05:26'),
('f9e5f48960f7cd2b2b61996aad0b327a', '50454887affd0f1dcf0354a77aae629d', 'Public Health Nutrition Officer', '2025-05-24 07:10:32', '2025-05-24 07:10:32'),
('fae07218536fcc3d34b37b6bf59343f9', '658e64e2162b8024259369a02271586f', 'Education Program Coordinator', '2025-05-24 08:41:57', '2025-05-24 08:41:57'),
('fb03070b16f4973143011b2682b01c28', '7d65456e1a4117d8cb5bcdb15195ab6a', 'Film Actor', '2025-05-24 09:48:19', '2025-05-24 09:48:19'),
('fe4672c090b29e00ece7d2a9645d80cc', '50454887affd0f1dcf0354a77aae629d', 'Prostetician', '2025-05-21 13:52:35', '2025-05-21 13:52:35'),
('ff08da4d7070e999eaa8a09a4c96d014', '61c85fef3fe628448507cf9fee884834', 'Treasury Officer', '2025-05-24 09:39:46', '2025-05-24 09:39:46'),
('ff2bc131c5e0c35bd45f55dc26c899d1', '3cbc09a00ae4f273f835f9ca12213399', 'Speech and Language Support Assistant', '2025-05-24 08:38:16', '2025-05-24 08:38:16');

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
) ENGINE=InnoDB AUTO_INCREMENT=157 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(24, '3d5c922db3b67c46ffbaf9195a03043f', '7828423d6bddd73825a746a660f6ddb8', NULL, NULL),
(25, '0a2ef0d874889eced29779fe6b314501', 'd64957f8870b8c106729003eac435efe', NULL, NULL),
(26, '3fe9ea3c37d1ad0b3dbf7bbdc0617027', '1805feb784292d77558aae27626e3a48', NULL, NULL),
(27, '9d66b4763429a099292fef7f64a21ab6', 'd64957f8870b8c106729003eac435efe', NULL, NULL),
(30, '9d66b4763429a099292fef7f64a21ab6', 'd408e5d1e3dedbc0b80183ee916c312d', NULL, NULL),
(31, '9d66b4763429a099292fef7f64a21ab6', '408ed38aa0c716c22b62813f8d003af8', NULL, NULL),
(33, '9d66b4763429a099292fef7f64a21ab6', '64d0f39750b325acf6624d6951210b37', NULL, NULL),
(34, '6bb7ca9a16a379ae8a5be8d15fae93e4', '04b0a5dee379bac9c73ea37222bafba2', NULL, NULL),
(35, '6bb7ca9a16a379ae8a5be8d15fae93e4', 'ca4242c399770153b0c5aad95a121096', NULL, NULL),
(36, '6bb7ca9a16a379ae8a5be8d15fae93e4', '5ffd5fba366a3ae75767791773161ec8', NULL, NULL),
(37, '2effed800cfa9be994214226d4688d17', 'a43c06fff1f82728259ac992058695dd', NULL, NULL),
(38, '2effed800cfa9be994214226d4688d17', '2867402ee6183fda491b26a51f478f03', NULL, NULL),
(39, '2effed800cfa9be994214226d4688d17', 'cd925a96c67fa60359658f7454f364d5', NULL, NULL),
(40, '97a881da632535a77ac6df45650e8bf0', '5e5d3d9be3fa097139ee458dece1db0e', NULL, NULL),
(41, '97a881da632535a77ac6df45650e8bf0', '731b6bb9e4a2a9047d39dc831386e22c', NULL, NULL),
(42, '97a881da632535a77ac6df45650e8bf0', '750af63ba84962b5a661c8ee930cd5cc', NULL, NULL),
(43, '97a881da632535a77ac6df45650e8bf0', '4f54563feb60b5b73df55c2a9fac3707', NULL, NULL),
(44, '97a881da632535a77ac6df45650e8bf0', '20006f5b1d2e2bbec1e1a074f3d68d42', NULL, NULL),
(45, '5ebded17fb1b01e6a8b833ca4c42c5eb', '3fa814976e8a0bca42b77d3cec3201b9', NULL, NULL),
(46, '5ebded17fb1b01e6a8b833ca4c42c5eb', 'd4323224c4e31ded4d403643ea85ab25', NULL, NULL),
(47, '5ebded17fb1b01e6a8b833ca4c42c5eb', '5f20f3d241d74f71d673c3278bdfd87e', NULL, NULL),
(48, '5ebded17fb1b01e6a8b833ca4c42c5eb', '37bbdcfd23b80693d91e0db6f7129e2d', NULL, NULL),
(49, '5ebded17fb1b01e6a8b833ca4c42c5eb', 'c1f890ebd26d17286ca4bac03658015b', NULL, NULL),
(50, '5ebded17fb1b01e6a8b833ca4c42c5eb', '734bf01dc54bdd4b4c8cb3ae7436a902', NULL, NULL),
(51, '77089d6bf7f21138817a91790677aed0', '49526c9045a1507125a079a8950ad205', NULL, NULL),
(52, '77089d6bf7f21138817a91790677aed0', 'd4323224c4e31ded4d403643ea85ab25', NULL, NULL),
(53, '77089d6bf7f21138817a91790677aed0', 'f0fe62de61b7eb2bcb611cdd0fd25fd7', NULL, NULL),
(54, '77089d6bf7f21138817a91790677aed0', '80d9eb04703935bab8c30d438dc61f93', NULL, NULL),
(55, '77089d6bf7f21138817a91790677aed0', 'ad7dc7e37bbb3a4ab561ece0622c8e3d', NULL, NULL),
(56, '77089d6bf7f21138817a91790677aed0', 'f1f3a9d54db709374bb306887e315380', NULL, NULL),
(57, '3171e6fe14344155312f865300c44fbf', 'f73470f471de7e9919fc09b09eb86119', NULL, NULL),
(58, '3171e6fe14344155312f865300c44fbf', '81b57fcbbc12f82443be173a06d4ff31', NULL, NULL),
(59, '3171e6fe14344155312f865300c44fbf', '5f20f3d241d74f71d673c3278bdfd87e', NULL, NULL),
(60, '3171e6fe14344155312f865300c44fbf', 'c1f890ebd26d17286ca4bac03658015b', NULL, NULL),
(61, 'b395b831c235d690bb4045488bd984c8', 'f1f3a9d54db709374bb306887e315380', NULL, NULL),
(62, 'b395b831c235d690bb4045488bd984c8', '49526c9045a1507125a079a8950ad205', NULL, NULL),
(63, 'b395b831c235d690bb4045488bd984c8', '134707355e84c83cc99c91f7496cf1ea', NULL, NULL),
(64, '6c71a7bbb3398a769abfb1fadb5929a1', 'd408e5d1e3dedbc0b80183ee916c312d', NULL, NULL),
(65, '6c71a7bbb3398a769abfb1fadb5929a1', '408ed38aa0c716c22b62813f8d003af8', NULL, NULL),
(66, '15276fccd27baa4118652dc7a3a32fba', 'ab679f68ded092a60046c3d5be9fa6e4', NULL, NULL),
(67, '15276fccd27baa4118652dc7a3a32fba', 'a01176e0e6893a17211db7118ee83d5d', NULL, NULL),
(68, '15276fccd27baa4118652dc7a3a32fba', 'aa05f56010d00cea958ba4669fc183b1', NULL, NULL),
(69, '5e8f08deaddfce947d1e5cb618b28696', 'e4681cf72b4469f823470de456a273f9', NULL, NULL),
(70, '5e8f08deaddfce947d1e5cb618b28696', '5ffd5fba366a3ae75767791773161ec8', NULL, NULL),
(71, '5e8f08deaddfce947d1e5cb618b28696', '9a65833dd16bc911d50b716bf092a842', NULL, NULL),
(72, '3123c6c61eee9f12231325a27577b08e', 'b26340fab0e284415a48e805e22f70dd', NULL, NULL),
(73, '3123c6c61eee9f12231325a27577b08e', '2c0d45ee83f368356dd643c4da1e7e71', NULL, NULL),
(74, '13ba1a5babdb11135842d045405245ba', '73395dd7a5e74260435e3b47b760a439', NULL, NULL),
(75, '13ba1a5babdb11135842d045405245ba', '34a1f5e0228534c3a52663c09b6e0afc', NULL, NULL),
(76, '13ba1a5babdb11135842d045405245ba', '0129e3301c978c8a54780a9955f92bfa', NULL, NULL),
(79, 'b480bff980c03badd4ac50713b62e9c7', '9787a81eb04e4eb77e6d90d69d9c1bbc', NULL, NULL),
(80, 'b480bff980c03badd4ac50713b62e9c7', '427b69a91de06d99d38b7096282bcadf', NULL, NULL),
(81, 'b480bff980c03badd4ac50713b62e9c7', '750af63ba84962b5a661c8ee930cd5cc', NULL, NULL),
(82, 'b480bff980c03badd4ac50713b62e9c7', '7e4c06f3f370820fb14a44d945b99124', NULL, NULL),
(83, 'b480bff980c03badd4ac50713b62e9c7', '7649589b71471bd055b2f1e917aeecf0', NULL, NULL),
(84, 'b480bff980c03badd4ac50713b62e9c7', 'c01c8e28bc78d4ac59427fd6d4103d88', NULL, NULL),
(85, 'c03243b27df718a9de6751ba21d53177', 'db0fa7d2998000e083f02918b7efadc9', NULL, NULL),
(86, 'c03243b27df718a9de6751ba21d53177', '2132f2b1e8def4f6e990a0b9d517574e', NULL, NULL),
(87, 'c03243b27df718a9de6751ba21d53177', '61dbb77ba08e00b6ab63a01d28d3d8d7', NULL, NULL),
(88, 'c03243b27df718a9de6751ba21d53177', '4111d3523d9b6465ee76642c360fbd68', NULL, NULL),
(89, '1f1fb2ec629aee1092ba5c6ebf98d5bd', '2de71d678dfbaca766c59e754781a392', NULL, NULL),
(90, '1f1fb2ec629aee1092ba5c6ebf98d5bd', '2d6f63478e5b4dfb1ac11110c7108039', NULL, NULL),
(91, '1f1fb2ec629aee1092ba5c6ebf98d5bd', '8be7ca763621ecf8c8a90a87b31d1956', NULL, NULL),
(92, '1f1fb2ec629aee1092ba5c6ebf98d5bd', '677f1424b29cddbb12f5c9c91740dd86', NULL, NULL),
(93, '1f1fb2ec629aee1092ba5c6ebf98d5bd', 'c420a624b567e1eadafcefdbd7f333ea', NULL, NULL),
(94, 'ee52820f620c1cdc868b0ef51a0d7df1', 'c05b6d8587b1dcd4ff05147c82f225b4', NULL, NULL),
(95, 'ee52820f620c1cdc868b0ef51a0d7df1', '34a1f5e0228534c3a52663c09b6e0afc', NULL, NULL),
(96, 'ee52820f620c1cdc868b0ef51a0d7df1', '0129e3301c978c8a54780a9955f92bfa', NULL, NULL),
(97, 'ee52820f620c1cdc868b0ef51a0d7df1', 'eea402ad3b6f6e6801aa1d5902d96c6d', NULL, NULL),
(98, '9911bb5c436790dea3f075f4126a3c59', '61dbb77ba08e00b6ab63a01d28d3d8d7', NULL, NULL),
(99, '9911bb5c436790dea3f075f4126a3c59', '4111d3523d9b6465ee76642c360fbd68', NULL, NULL),
(100, '9911bb5c436790dea3f075f4126a3c59', 'd4323224c4e31ded4d403643ea85ab25', NULL, NULL),
(101, '9911bb5c436790dea3f075f4126a3c59', '5f20f3d241d74f71d673c3278bdfd87e', NULL, NULL),
(102, '2ff84a374cb505b01fdb2eb9a5cce919', '2016e9ffe8b2be985e3c2db06bbabf0b', NULL, NULL),
(103, '2ff84a374cb505b01fdb2eb9a5cce919', '61dbb77ba08e00b6ab63a01d28d3d8d7', NULL, NULL),
(104, '2ff84a374cb505b01fdb2eb9a5cce919', '4111d3523d9b6465ee76642c360fbd68', NULL, NULL),
(105, '4e46c9efe8b6050f3a98f23f878979f4', '37bbdcfd23b80693d91e0db6f7129e2d', NULL, NULL),
(106, '4e46c9efe8b6050f3a98f23f878979f4', 'c1f890ebd26d17286ca4bac03658015b', NULL, NULL),
(107, '4e46c9efe8b6050f3a98f23f878979f4', '734bf01dc54bdd4b4c8cb3ae7436a902', NULL, NULL),
(108, '4e46c9efe8b6050f3a98f23f878979f4', 'f4db7c57eb786b3ae775de37b2fa68b1', NULL, NULL),
(109, '4c6fdda5e89280fddc60a6c6531bb1e0', '69d9ac8cfe5c4185b1bd26e850c4fdf7', NULL, NULL),
(110, '4c6fdda5e89280fddc60a6c6531bb1e0', '5f20f3d241d74f71d673c3278bdfd87e', NULL, NULL),
(111, '4c6fdda5e89280fddc60a6c6531bb1e0', 'd4323224c4e31ded4d403643ea85ab25', NULL, NULL),
(112, '4c6fdda5e89280fddc60a6c6531bb1e0', 'c1f890ebd26d17286ca4bac03658015b', NULL, NULL),
(113, '4c6fdda5e89280fddc60a6c6531bb1e0', '81b57fcbbc12f82443be173a06d4ff31', NULL, NULL),
(114, '3b002c4fec34240476e454c66e4ad733', 'fb03070b16f4973143011b2682b01c28', NULL, NULL),
(115, '3b002c4fec34240476e454c66e4ad733', '9c9add8e5f7fb4da88459b61649e3c6c', NULL, NULL),
(116, '3b002c4fec34240476e454c66e4ad733', '7ef5013b53eecb157cc3af230064ba87', NULL, NULL),
(117, '3b002c4fec34240476e454c66e4ad733', 'bce30018049c9d7a6078e92fa1d24287', NULL, NULL),
(118, '2e328ceeb55abaf3f967b1461e8cbc34', 'd4ea55dd0d1e7196a4e2884f41bce795', NULL, NULL),
(119, '2e328ceeb55abaf3f967b1461e8cbc34', '55ecad39cc6aac2aef7e3b6ceb0a42f6', NULL, NULL),
(120, '2e328ceeb55abaf3f967b1461e8cbc34', 'c01c8e28bc78d4ac59427fd6d4103d88', NULL, NULL),
(121, '2e328ceeb55abaf3f967b1461e8cbc34', '4f54563feb60b5b73df55c2a9fac3707', NULL, NULL),
(122, '2e328ceeb55abaf3f967b1461e8cbc34', '750af63ba84962b5a661c8ee930cd5cc', NULL, NULL),
(123, '2e328ceeb55abaf3f967b1461e8cbc34', '7e4c06f3f370820fb14a44d945b99124', NULL, NULL),
(124, '8d1ead6ad34295eed0ca5d34ab14a18b', '34a1f5e0228534c3a52663c09b6e0afc', NULL, NULL),
(125, '8d1ead6ad34295eed0ca5d34ab14a18b', '0129e3301c978c8a54780a9955f92bfa', NULL, NULL),
(126, '8d1ead6ad34295eed0ca5d34ab14a18b', '07b8c66e8f704d8dc1aa95867281069d', NULL, NULL),
(127, 'd45f1df0e8acdcfaaa0f76a18a0d962b', 'd912bbca27b0ea4532ebd540a226b233', NULL, NULL),
(128, 'd45f1df0e8acdcfaaa0f76a18a0d962b', '87fe2e0810b95f51d066d790cbae6ba3', NULL, NULL),
(129, 'd45f1df0e8acdcfaaa0f76a18a0d962b', 'f1804426ccd5f96d3f4af74e77cfa889', NULL, NULL),
(130, '2c8091f1835062ab5c271d8cbdf65455', 'b0ff8d7d57b4a72eff1ecd50b33523b9', NULL, NULL),
(131, '2c8091f1835062ab5c271d8cbdf65455', '84f66027a00af2f2f2b0a0fb2f154877', NULL, NULL),
(132, '2c8091f1835062ab5c271d8cbdf65455', '22d0d2a39b8dabd29ce821c848cf0305', NULL, NULL),
(133, '2c8091f1835062ab5c271d8cbdf65455', '0dcf3314272b9259d1e413ee93bd77a5', NULL, NULL),
(134, '03be0c34cf492227b7fcc8162859766c', 'f0fe62de61b7eb2bcb611cdd0fd25fd7', NULL, NULL),
(135, '03be0c34cf492227b7fcc8162859766c', 'd1f93c4a7e9cb30ae838b5aed677781f', NULL, NULL),
(136, '03be0c34cf492227b7fcc8162859766c', 'ff08da4d7070e999eaa8a09a4c96d014', NULL, NULL),
(137, '9dae15c2f9ea41c28100455914e5abdf', '99a906c47fded7a412301f520838bf89', NULL, NULL),
(138, '9dae15c2f9ea41c28100455914e5abdf', 'f95011ab7e9f790540906b920b83176e', NULL, NULL),
(139, '9dae15c2f9ea41c28100455914e5abdf', '477f856bef6bd6a0b88955142a9b625d', NULL, NULL),
(140, 'd9ad51d469d2b2c91164258efdf68955', '16a27b987f7b17ade9bd23d3cd50e906', NULL, NULL),
(141, 'd9ad51d469d2b2c91164258efdf68955', 'a12115a3cf173b23e2542e5d7aaa4732', NULL, NULL),
(142, 'd9ad51d469d2b2c91164258efdf68955', '0dcf3314272b9259d1e413ee93bd77a5', NULL, NULL),
(143, 'd9ad51d469d2b2c91164258efdf68955', '22d0d2a39b8dabd29ce821c848cf0305', NULL, NULL),
(144, 'd9ad51d469d2b2c91164258efdf68955', '80d9eb04703935bab8c30d438dc61f93', NULL, NULL),
(145, 'd9ad51d469d2b2c91164258efdf68955', 'c9490b8a50f7a5651e0a5f845c52db2b', NULL, NULL),
(146, '464e4242d398d7a9491b3a6332e304d7', '4442d567f2d239fc845ff535c14dceec', NULL, NULL),
(147, '464e4242d398d7a9491b3a6332e304d7', '55ecad39cc6aac2aef7e3b6ceb0a42f6', NULL, NULL),
(148, '464e4242d398d7a9491b3a6332e304d7', 'd4ea55dd0d1e7196a4e2884f41bce795', NULL, NULL),
(149, '1d1a94ea4a5c5d7258ccb1336cf20c95', '84f66027a00af2f2f2b0a0fb2f154877', NULL, NULL),
(150, '1d1a94ea4a5c5d7258ccb1336cf20c95', '80d9eb04703935bab8c30d438dc61f93', NULL, NULL),
(151, '1d1a94ea4a5c5d7258ccb1336cf20c95', 'c9490b8a50f7a5651e0a5f845c52db2b', NULL, NULL),
(152, '45b11d1f9ee299000e5b968dded03f50', 'b0d0a1efdd7cb0cec91731f2a86d6aba', NULL, NULL),
(153, '45b11d1f9ee299000e5b968dded03f50', '5825f16bb8a05c380bc76dce418efa90', NULL, NULL),
(154, '45b11d1f9ee299000e5b968dded03f50', 'f0fe62de61b7eb2bcb611cdd0fd25fd7', NULL, NULL),
(155, '45b11d1f9ee299000e5b968dded03f50', '8d63ed0403e9782b5248a5bb1a1ea35f', NULL, NULL),
(156, '1d1a94ea4a5c5d7258ccb1336cf20c95', '8d63ed0403e9782b5248a5bb1a1ea35f', NULL, NULL);

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
('0cbdcb915d6658c8415aad65e2f08001', '2ff84a374cb505b01fdb2eb9a5cce919', 4, 2, '2025-05-28 05:56:06', '2025-05-28 05:56:06'),
('114dfda1cab341736e704fc14afd1717', '7bcc3a2490d7ee562c8dc8cac9a25bd2', 8, 3, '2025-05-12 12:48:21', '2025-05-12 12:48:21'),
('158b0a4c58b7d47097eab72e4f6f2438', '5f614befa559981f694b049ba973dd3f', 4, 2, '2025-05-12 16:10:54', '2025-05-12 16:10:54'),
('163774c4d4ed9ae4d27c6f2449df1205', 'c1368857a497441654705eba40d31c59', 6, 3, '2025-05-12 16:43:56', '2025-05-12 16:43:56'),
('1716ccb983b5b585d353b38a6a2d9841', 'ebc4a771901acd053c8f21ca146d0eb6', 4, 2, '2025-05-12 15:41:06', '2025-05-12 15:41:06'),
('1f088c7a317fcce8e2b0d0a8c1e6b297', '15276fccd27baa4118652dc7a3a32fba', 4, 2, '2025-05-24 14:31:47', '2025-05-24 14:31:47'),
('20dd698387c0f4d33d1db0c52bc9263d', '5ebded17fb1b01e6a8b833ca4c42c5eb', 4, 2, '2025-05-24 11:29:03', '2025-05-24 11:29:03'),
('26f23336f45a68778bafc17cafb89511', '50bd144ecea17982c79347fbbb0b45fd', 4, 2, '2025-05-12 15:35:22', '2025-05-12 15:35:22'),
('2e8ab7c250bda54db1e02c374d6b7c2d', 'c67d1a2b2e50d41ccaef5c7cc7b857db', 4, 2, '2025-05-12 13:54:48', '2025-05-12 13:54:48'),
('2f4ee60382e42a8a10e5df917518a91a', 'acde11ba72feede28e96137d431ca186', 4, 2, '2025-05-15 08:56:43', '2025-05-15 08:56:43'),
('30973a49f205744c181fdde2ae9532b6', '2898adbdcc25d3d7b23651ee5e80abb1', 4, 2, '2025-05-10 17:26:19', '2025-05-10 17:26:19'),
('316c47edb43dd04c0193b69945453d3c', 'ba47e9cf0055abce55d33e7ad7200626', 6, 3, '2025-05-12 16:53:25', '2025-05-12 16:53:25'),
('31daa19effc33280b2e4ae94ae8cfb39', '3171e6fe14344155312f865300c44fbf', 4, 2, '2025-05-24 12:19:18', '2025-05-24 12:19:18'),
('3d19eae4cb94b499cd230aa7e360ca6e', '0a2ef0d874889eced29779fe6b314501', 6, 3, '2025-05-22 08:07:20', '2025-05-22 08:07:20'),
('3d85356b54a06e7d399122ff1672a78d', '1dca1fe90b6afd34e477b9405c1a1f1c', 4, 2, '2025-05-12 16:18:55', '2025-05-12 16:18:55'),
('443d3238db50436ab0ccf98ed5e35154', '719fc401b6ea6fa2cf3ff0ed314e8d98', 6, 3, '2025-05-21 13:33:58', '2025-05-21 13:33:58'),
('45b1f306a1652cb75a6472e55c62abed', '23240d5fa46f8ea7e2e8e403cbad0ffa', 4, 2, '2025-05-12 15:45:08', '2025-05-12 15:45:08'),
('4c4e5c72dd772c84aed925bb3720a0cd', '9d66b4763429a099292fef7f64a21ab6', 6, 3, '2025-05-24 10:18:37', '2025-05-24 10:18:37'),
('4c851222374e7cc05dbe9b23f63c0336', '5631f8c13e9880d8bfa150c72589b695', 4, 2, '2025-05-11 07:43:54', '2025-05-11 07:43:54'),
('4ca714d0e6867fece1ae23e93f1f4501', '03be0c34cf492227b7fcc8162859766c', 4, 2, '2025-05-28 06:33:36', '2025-05-28 06:33:36'),
('4d956f1bab3cd385120faf70614c5b5c', '587a540cab0235453b49f13f24770736', 4, 2, '2025-05-12 15:59:22', '2025-05-12 15:59:22'),
('5a08e99ac57f414e960caad388dfe125', '3b002c4fec34240476e454c66e4ad733', 4, 2, '2025-05-28 06:09:18', '2025-05-28 06:09:18'),
('5f659ac2f904d30914e117edca81d463', '6c71a7bbb3398a769abfb1fadb5929a1', 6, 3, '2025-05-24 12:30:09', '2025-05-24 12:30:09'),
('60d14d0fe32e5c4e3551268b2a2a4285', 'a6d09a6a2942b5ed6c5150b4bb909b74', 4, 2, '2025-05-10 16:50:13', '2025-05-10 16:50:13'),
('63be52a9dcd364e98839296691211ba2', '63d4bd5e98166ae14a5599b9f85ab96f', 6, 3, '2025-05-15 14:59:58', '2025-05-15 14:59:58'),
('64466dd5be592b64ae608a2504770f5e', '5e8f08deaddfce947d1e5cb618b28696', 4, 2, '2025-05-24 14:37:41', '2025-05-24 14:37:41'),
('652a3cfadda71c5e891a8b3734d0a986', '6bb7ca9a16a379ae8a5be8d15fae93e4', 4, 2, '2025-05-24 10:28:28', '2025-05-24 10:28:28'),
('659cfa654b9546487d5fb4991967f951', '2df21b54695076255c90a8e3bc1949a0', 4, 2, '2025-05-24 06:17:49', '2025-05-24 06:17:49'),
('6739ceb62b0edeb899dadd9d313b793f', '508abd074cee03faa487e0d9052a1d03', 4, 2, '2025-05-12 15:31:26', '2025-05-12 15:31:26'),
('695ed21d5d9d0f6855f930b52a837997', 'd45f1df0e8acdcfaaa0f76a18a0d962b', 4, 2, '2025-05-28 06:22:23', '2025-05-28 06:22:23'),
('6aa2584fd5f15eaa44e5737ecfb990a1', '3123c6c61eee9f12231325a27577b08e', 4, 2, '2025-05-24 15:06:55', '2025-05-24 15:06:55'),
('6c7116b72fd72f0cc6d80199ca9ce724', 'c731182b3060cbed02f070022cf3de30', 6, 3, '2025-05-21 14:06:49', '2025-05-21 14:06:49'),
('704f703100f09f05db5ef045c6e42dcc', '7a60250a7cd96e92cdb9d85ecbf500e7', 4, 2, '2025-05-12 16:21:53', '2025-05-12 16:21:53'),
('727799c3cb0dfbdafa4af2af45ebe6e1', '45b11d1f9ee299000e5b968dded03f50', 4, 2, '2025-05-28 07:07:48', '2025-05-28 07:07:48'),
('736e8022ea4ec778d4b11ee4b03d93ea', 'ee52820f620c1cdc868b0ef51a0d7df1', 4, 2, '2025-05-28 05:50:03', '2025-05-28 05:50:03'),
('74059b5fd53b8e83f3dd6aadfd49e060', '2c8091f1835062ab5c271d8cbdf65455', 4, 2, '2025-05-28 06:28:17', '2025-05-28 06:28:17'),
('7929b551653cade389fae91c3bd747d5', '3d5c922db3b67c46ffbaf9195a03043f', 6, 3, '2025-05-21 14:09:30', '2025-05-21 14:09:30'),
('7a81f762b0d5b02328b8e57fe4d8fa2a', '449b2db1ef0be3148d75b31cf01b4b2f', 4, 2, '2025-05-11 07:52:05', '2025-05-11 07:52:05'),
('7db3a00667669b2ae4dcee1d37078fd2', '8d1ead6ad34295eed0ca5d34ab14a18b', 4, 2, '2025-05-28 06:17:29', '2025-05-28 06:17:29'),
('7ec4e41e411e5f315f6142c88c491c01', 'b395b831c235d690bb4045488bd984c8', 4, 2, '2025-05-24 12:24:09', '2025-05-24 12:24:09'),
('80524131e1731a0ba2dcbdc4f9a6d5e4', '4e46c9efe8b6050f3a98f23f878979f4', 4, 2, '2025-05-28 06:00:05', '2025-05-28 06:00:05'),
('8241e853fd506fbd8ecbc0c760f71810', '97a881da632535a77ac6df45650e8bf0', 4, 2, '2025-05-24 10:47:27', '2025-05-24 10:47:27'),
('9331ebae62147c495cbdf0c26d9dda4f', 'df57e1e7f5710b954943617651407528', 4, 2, '2025-05-12 15:53:10', '2025-05-12 15:53:10'),
('957d080e00dc8a27786d0ee282239323', '5499b5d315f03a7b33f880eb88545fe6', 6, 3, '2025-05-15 08:57:25', '2025-05-15 08:57:25'),
('986c0220b3de868944c05264427fc1eb', '019ce65024551f545ac4fb88298394bc', 6, 3, '2025-05-19 08:45:54', '2025-05-19 08:45:54'),
('9fe841138231eb169f8ba29deb9e9d7b', '464e4242d398d7a9491b3a6332e304d7', 4, 2, '2025-05-28 06:55:48', '2025-05-28 06:55:48'),
('a6c1c068d6ca3edf0444bef011db5c90', 'd4899639b1243eeef21e33c0cfeb4135', 6, 3, '2025-05-21 13:23:20', '2025-05-21 13:23:20'),
('a89c7f85d3caed62060aea512ec896ab', '274abe94a2938438bc3d3a0a422da8c3', 8, 3, '2025-05-19 07:49:35', '2025-05-19 07:49:35'),
('a9e9f89057eba9322892330136bbad2e', '9dae15c2f9ea41c28100455914e5abdf', 4, 2, '2025-05-28 06:39:13', '2025-05-28 06:39:13'),
('ac0183aef13fe44ec7da3f63dca5b8b9', 'b0e9d87e618d6a5d1257af8e36b720e2', 4, 2, '2025-05-12 15:55:54', '2025-05-12 15:55:54'),
('ae19d783f8b9b2975c098a1ffdff9275', '3fe9ea3c37d1ad0b3dbf7bbdc0617027', 6, 3, '2025-05-22 08:09:50', '2025-05-22 08:09:50'),
('b01b468a4a282897d34fe3662a5bd3a3', '13ba1a5babdb11135842d045405245ba', 4, 2, '2025-05-24 15:09:51', '2025-05-24 15:09:51'),
('b0ac1d5786744074657f552259365095', 'c03243b27df718a9de6751ba21d53177', 4, 2, '2025-05-28 05:41:45', '2025-05-28 05:41:45'),
('b11ccb2ff1230028c7465bdbb5eed16d', '2effed800cfa9be994214226d4688d17', 4, 2, '2025-05-24 10:51:05', '2025-05-24 10:51:05'),
('b11ee817938a955e00cb49ad12b72b00', '9d00aa0e1f3822e02abdcc57e0e3bc18', 6, 3, '2025-05-12 16:48:52', '2025-05-12 16:48:52'),
('b6017e72385f60d32908fb7d226b4e38', '3041a5d3546187206b68e2e34f1b498c', 4, 2, '2025-05-12 15:26:21', '2025-05-12 15:26:21'),
('bfc9559aee160448046cadc5aa9c53c6', '9911bb5c436790dea3f075f4126a3c59', 4, 2, '2025-05-28 05:53:09', '2025-05-28 05:53:09'),
('ca6c300fe56c7a2358942fcb1eee60d7', '1f1fb2ec629aee1092ba5c6ebf98d5bd', 4, 2, '2025-05-28 05:46:51', '2025-05-28 05:46:51'),
('cc156b96c7f260dcac131305aee63264', 'c7d1b2fc3b1195b94195450ae9c0c9b5', 6, 3, '2025-05-15 08:57:54', '2025-05-15 08:57:54'),
('cfbc415dcbb07450b763c96fff3cf8c3', '9f8815cbb3c5245a6fdf81c9d2a2191a', 4, 2, '2025-05-13 12:09:38', '2025-05-13 12:09:38'),
('d560941b852e477b4c176a7ce98c09f6', 'caca892a97f4296c3efaf481a0c56f2b', 6, 3, '2025-05-21 13:55:14', '2025-05-21 13:55:14'),
('d77826b315938dc95ff34a1efde97330', 'b480bff980c03badd4ac50713b62e9c7', 4, 2, '2025-05-24 15:36:21', '2025-05-24 15:36:21'),
('dcbf1dbb7915d168285ccec2ad88322e', '2e328ceeb55abaf3f967b1461e8cbc34', 4, 2, '2025-05-28 06:12:22', '2025-05-28 06:12:22'),
('e77aa3d95c4d3314b783a42c1ee69281', '4c6fdda5e89280fddc60a6c6531bb1e0', 4, 2, '2025-05-28 06:05:11', '2025-05-28 06:05:11'),
('eb4f1cb61f442e05b963e34854f1edcd', 'f5845528dcf197cd15473140e6713950', 6, 3, '2025-05-21 13:29:32', '2025-05-21 13:29:32'),
('ed3e7d256799f3ba43e0a6b61e5cbf5f', 'd9ad51d469d2b2c91164258efdf68955', 4, 2, '2025-05-28 06:45:28', '2025-05-28 06:45:28'),
('efe0a16aa323471d3cae586c2ab7b88a', 'e490db7b5a98a0aa59eebd9ba8986bb3', 4, 2, '2025-05-11 10:27:58', '2025-05-11 10:27:58'),
('f080de0b4d3ff5b9b25d8dfc0b36d1af', '3ec5e6b0206ab1fa3d4c63ca141f24ef', 4, 2, '2025-05-11 10:20:40', '2025-05-11 10:20:40'),
('f14bdc55816ff41a2ab5da82d4764f9f', '77089d6bf7f21138817a91790677aed0', 4, 2, '2025-05-24 11:39:27', '2025-05-24 11:39:27'),
('f18edaf906c6481c81569c752ac6c5f9', '32f2acf3761302ddd4f73347a49cd526', 4, 2, '2025-05-10 19:20:25', '2025-05-10 19:20:25'),
('f2265980c7f6a9819f0faafb67922666', 'd00189b5bb76a8f2f842e760b609f532', 6, 3, '2025-05-21 13:49:52', '2025-05-21 13:49:52'),
('f553ec36a0fb30e0ab05ea8128ffe7ff', '756478f8bdd193b72d499db2538b66bb', 4, 2, '2025-05-10 16:06:35', '2025-05-10 16:06:35'),
('f582d2da55509d63fe5da9bce9c66fdb', 'cd9323c76d11b08ba1b98764b68ba470', 6, 3, '2025-05-12 16:51:15', '2025-05-12 16:51:15'),
('fb7b3bf5858cf2e48f3a538ae83bd3f1', '874f91396a7c6f62b220f9bc1ba7b8f3', 6, 3, '2025-05-24 15:24:09', '2025-05-24 15:24:09'),
('fc77ab1756cffdaf3903fcdf882e6a81', '1d1a94ea4a5c5d7258ccb1336cf20c95', 4, 2, '2025-05-28 07:08:26', '2025-05-28 07:08:26');

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
) ENGINE=InnoDB AUTO_INCREMENT=802 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(331, 'a89c7f85d3caed62060aea512ec896ab', '111239143c8489ef8e53421791b2c3e9', 'required', 'D', NULL, NULL),
(332, 'a89c7f85d3caed62060aea512ec896ab', '79a78e4e6a080e03d3ddf5aaca20b642', 'required', 'C', NULL, NULL),
(333, 'a89c7f85d3caed62060aea512ec896ab', 'de52cabd871248ebd540e4c1616d8477', 'required', 'C', NULL, NULL),
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
(371, '7929b551653cade389fae91c3bd747d5', 'de52cabd871248ebd540e4c1616d8477', 'required', 'D', NULL, NULL),
(372, '3d19eae4cb94b499cd230aa7e360ca6e', '79a78e4e6a080e03d3ddf5aaca20b642', 'required', 'D', NULL, NULL),
(373, '3d19eae4cb94b499cd230aa7e360ca6e', 'de52cabd871248ebd540e4c1616d8477', 'required', 'D', NULL, NULL),
(374, '3d19eae4cb94b499cd230aa7e360ca6e', '111239143c8489ef8e53421791b2c3e9', 'required', 'D', NULL, NULL),
(375, 'ae19d783f8b9b2975c098a1ffdff9275', '111239143c8489ef8e53421791b2c3e9', 'required', 'D', NULL, NULL),
(376, 'ae19d783f8b9b2975c098a1ffdff9275', '79a78e4e6a080e03d3ddf5aaca20b642', 'required', 'D', NULL, NULL),
(377, 'ae19d783f8b9b2975c098a1ffdff9275', 'de52cabd871248ebd540e4c1616d8477', 'required', 'D', NULL, NULL),
(391, '659cfa654b9546487d5fb4991967f951', '111239143c8489ef8e53421791b2c3e9', 'optional', 'E', NULL, NULL),
(392, '659cfa654b9546487d5fb4991967f951', '78a92fb99cfdc7f1e537f9caef0e0684', 'optional', 'E', NULL, NULL),
(393, '659cfa654b9546487d5fb4991967f951', '79a78e4e6a080e03d3ddf5aaca20b642', 'optional', 'E', NULL, NULL),
(394, '659cfa654b9546487d5fb4991967f951', 'de52cabd871248ebd540e4c1616d8477', 'optional', 'E', NULL, NULL),
(395, '659cfa654b9546487d5fb4991967f951', 'bbd67ff82f9f3749b72687aa7caa5bba', 'optional', 'E', NULL, NULL),
(396, '659cfa654b9546487d5fb4991967f951', '111239143c8489ef8e53421791b2c3e9', 'required', 'E', NULL, NULL),
(397, '659cfa654b9546487d5fb4991967f951', '79a78e4e6a080e03d3ddf5aaca20b642', 'required', 'E', NULL, NULL),
(398, '659cfa654b9546487d5fb4991967f951', 'de52cabd871248ebd540e4c1616d8477', 'required', 'E', NULL, NULL),
(399, '659cfa654b9546487d5fb4991967f951', '78a92fb99cfdc7f1e537f9caef0e0684', 'necessary', 'S', NULL, NULL),
(400, '659cfa654b9546487d5fb4991967f951', 'ba1c45bc4d5a9ba46387ba1837f90910', 'necessary', 'S', NULL, NULL),
(409, '4c4e5c72dd772c84aed925bb3720a0cd', '111239143c8489ef8e53421791b2c3e9', 'required', 'D', NULL, NULL),
(410, '4c4e5c72dd772c84aed925bb3720a0cd', '79a78e4e6a080e03d3ddf5aaca20b642', 'required', 'D', NULL, NULL),
(411, '4c4e5c72dd772c84aed925bb3720a0cd', 'de52cabd871248ebd540e4c1616d8477', 'required', 'D', NULL, NULL),
(412, '652a3cfadda71c5e891a8b3734d0a986', 'bbd67ff82f9f3749b72687aa7caa5bba', 'required', 'E', NULL, NULL),
(413, '652a3cfadda71c5e891a8b3734d0a986', '111239143c8489ef8e53421791b2c3e9', 'optional', 'E', NULL, NULL),
(414, '652a3cfadda71c5e891a8b3734d0a986', '78a92fb99cfdc7f1e537f9caef0e0684', 'optional', 'E', NULL, NULL),
(415, '652a3cfadda71c5e891a8b3734d0a986', 'b7b5fc68fb85dd88dc124a38ec488f2c', 'optional', 'E', NULL, NULL),
(416, '652a3cfadda71c5e891a8b3734d0a986', '921f5461645235088da06b1132a13754', 'optional', 'E', NULL, NULL),
(417, '652a3cfadda71c5e891a8b3734d0a986', '79a78e4e6a080e03d3ddf5aaca20b642', 'optional', 'E', NULL, NULL),
(418, '652a3cfadda71c5e891a8b3734d0a986', 'de52cabd871248ebd540e4c1616d8477', 'optional', 'E', NULL, NULL),
(419, '652a3cfadda71c5e891a8b3734d0a986', '535e955119b624e341febdce9a5ab025', 'optional', 'E', NULL, NULL),
(429, '8241e853fd506fbd8ecbc0c760f71810', '535e955119b624e341febdce9a5ab025', 'optional', 'E', NULL, NULL),
(430, '8241e853fd506fbd8ecbc0c760f71810', 'f38d3cf78b785d2b10281ebe33c15d8c', 'optional', 'E', NULL, NULL),
(431, '8241e853fd506fbd8ecbc0c760f71810', 'bbd67ff82f9f3749b72687aa7caa5bba', 'optional', 'E', NULL, NULL),
(432, '8241e853fd506fbd8ecbc0c760f71810', '499fb4fc5cb36c9413f708e2290ee465', 'optional', 'E', NULL, NULL),
(433, '8241e853fd506fbd8ecbc0c760f71810', '0f356d614e6881dd5ae8ffc9989732e9', 'optional', 'E', NULL, NULL),
(434, '8241e853fd506fbd8ecbc0c760f71810', 'b7b5fc68fb85dd88dc124a38ec488f2c', 'optional', 'E', NULL, NULL),
(435, '8241e853fd506fbd8ecbc0c760f71810', '35abc86c96a6c0938e31322dbc787e77', 'optional', 'E', NULL, NULL),
(436, 'b11ccb2ff1230028c7465bdbb5eed16d', '78a92fb99cfdc7f1e537f9caef0e0684', 'required', 'E', NULL, NULL),
(437, 'b11ccb2ff1230028c7465bdbb5eed16d', '111239143c8489ef8e53421791b2c3e9', 'required', 'E', NULL, NULL),
(438, 'b11ccb2ff1230028c7465bdbb5eed16d', '79a78e4e6a080e03d3ddf5aaca20b642', 'necessary', 'S', NULL, NULL),
(439, '20dd698387c0f4d33d1db0c52bc9263d', '535e955119b624e341febdce9a5ab025', 'optional', 'E', NULL, NULL),
(440, '20dd698387c0f4d33d1db0c52bc9263d', 'bbd67ff82f9f3749b72687aa7caa5bba', 'optional', 'E', NULL, NULL),
(441, '20dd698387c0f4d33d1db0c52bc9263d', '2e45ec206a607ba85a8cb0160e99ade4', 'optional', 'E', NULL, NULL),
(442, '20dd698387c0f4d33d1db0c52bc9263d', '499fb4fc5cb36c9413f708e2290ee465', 'optional', 'E', NULL, NULL),
(443, '20dd698387c0f4d33d1db0c52bc9263d', 'f38d3cf78b785d2b10281ebe33c15d8c', 'optional', 'E', NULL, NULL),
(444, '20dd698387c0f4d33d1db0c52bc9263d', '35abc86c96a6c0938e31322dbc787e77', 'optional', 'E', NULL, NULL),
(445, '20dd698387c0f4d33d1db0c52bc9263d', '0f356d614e6881dd5ae8ffc9989732e9', 'optional', 'E', NULL, NULL),
(446, '20dd698387c0f4d33d1db0c52bc9263d', 'b7b5fc68fb85dd88dc124a38ec488f2c', 'optional', 'E', NULL, NULL),
(447, '20dd698387c0f4d33d1db0c52bc9263d', '1a50115832dd08b87a189d155c62eb31', 'optional', 'E', NULL, NULL),
(448, '20dd698387c0f4d33d1db0c52bc9263d', '1502838edf28cac9b0390cd616bd0240', 'optional', 'E', NULL, NULL),
(449, '20dd698387c0f4d33d1db0c52bc9263d', '111239143c8489ef8e53421791b2c3e9', 'optional', 'E', NULL, NULL),
(450, '20dd698387c0f4d33d1db0c52bc9263d', '79a78e4e6a080e03d3ddf5aaca20b642', 'optional', 'E', NULL, NULL),
(451, '20dd698387c0f4d33d1db0c52bc9263d', 'de52cabd871248ebd540e4c1616d8477', 'optional', 'E', NULL, NULL),
(452, '20dd698387c0f4d33d1db0c52bc9263d', '78a92fb99cfdc7f1e537f9caef0e0684', 'optional', 'E', NULL, NULL),
(453, '20dd698387c0f4d33d1db0c52bc9263d', '921f5461645235088da06b1132a13754', 'optional', 'E', NULL, NULL),
(454, '20dd698387c0f4d33d1db0c52bc9263d', '17ae1bb333f280e72bdfeecf08342617', 'optional', 'E', NULL, NULL),
(455, '20dd698387c0f4d33d1db0c52bc9263d', '17afca89d6c133ae83d57d65acc89dd2', 'optional', 'E', NULL, NULL),
(456, 'f14bdc55816ff41a2ab5da82d4764f9f', '535e955119b624e341febdce9a5ab025', 'optional', 'E', NULL, NULL),
(457, 'f14bdc55816ff41a2ab5da82d4764f9f', 'bbd67ff82f9f3749b72687aa7caa5bba', 'optional', 'E', NULL, NULL),
(458, 'f14bdc55816ff41a2ab5da82d4764f9f', 'b7b5fc68fb85dd88dc124a38ec488f2c', 'optional', 'E', NULL, NULL),
(459, 'f14bdc55816ff41a2ab5da82d4764f9f', '1a50115832dd08b87a189d155c62eb31', 'optional', 'E', NULL, NULL),
(460, 'f14bdc55816ff41a2ab5da82d4764f9f', '1502838edf28cac9b0390cd616bd0240', 'optional', 'E', NULL, NULL),
(461, 'f14bdc55816ff41a2ab5da82d4764f9f', '111239143c8489ef8e53421791b2c3e9', 'optional', 'E', NULL, NULL),
(462, 'f14bdc55816ff41a2ab5da82d4764f9f', '79a78e4e6a080e03d3ddf5aaca20b642', 'optional', 'E', NULL, NULL),
(463, 'f14bdc55816ff41a2ab5da82d4764f9f', 'de52cabd871248ebd540e4c1616d8477', 'optional', 'E', NULL, NULL),
(464, 'f14bdc55816ff41a2ab5da82d4764f9f', '78a92fb99cfdc7f1e537f9caef0e0684', 'optional', 'E', NULL, NULL),
(465, 'f14bdc55816ff41a2ab5da82d4764f9f', '921f5461645235088da06b1132a13754', 'optional', 'E', NULL, NULL),
(466, 'f14bdc55816ff41a2ab5da82d4764f9f', '17ae1bb333f280e72bdfeecf08342617', 'optional', 'E', NULL, NULL),
(467, 'f14bdc55816ff41a2ab5da82d4764f9f', '17afca89d6c133ae83d57d65acc89dd2', 'optional', 'E', NULL, NULL),
(468, 'f14bdc55816ff41a2ab5da82d4764f9f', '78a92fb99cfdc7f1e537f9caef0e0684', 'necessary', 'S', NULL, NULL),
(469, 'f14bdc55816ff41a2ab5da82d4764f9f', 'ba1c45bc4d5a9ba46387ba1837f90910', 'necessary', 'S', NULL, NULL),
(470, '31daa19effc33280b2e4ae94ae8cfb39', '111239143c8489ef8e53421791b2c3e9', 'optional', 'E', NULL, NULL),
(471, '31daa19effc33280b2e4ae94ae8cfb39', '79a78e4e6a080e03d3ddf5aaca20b642', 'optional', 'E', NULL, NULL),
(472, '31daa19effc33280b2e4ae94ae8cfb39', 'de52cabd871248ebd540e4c1616d8477', 'optional', 'E', NULL, NULL),
(473, '31daa19effc33280b2e4ae94ae8cfb39', '78a92fb99cfdc7f1e537f9caef0e0684', 'optional', 'E', NULL, NULL),
(474, '31daa19effc33280b2e4ae94ae8cfb39', 'bbd67ff82f9f3749b72687aa7caa5bba', 'optional', 'E', NULL, NULL),
(475, '31daa19effc33280b2e4ae94ae8cfb39', 'b7b5fc68fb85dd88dc124a38ec488f2c', 'optional', 'E', NULL, NULL),
(476, '31daa19effc33280b2e4ae94ae8cfb39', '535e955119b624e341febdce9a5ab025', 'optional', 'E', NULL, NULL),
(477, '31daa19effc33280b2e4ae94ae8cfb39', '1a50115832dd08b87a189d155c62eb31', 'optional', 'E', NULL, NULL),
(478, '31daa19effc33280b2e4ae94ae8cfb39', '1502838edf28cac9b0390cd616bd0240', 'optional', 'E', NULL, NULL),
(479, '31daa19effc33280b2e4ae94ae8cfb39', '921f5461645235088da06b1132a13754', 'optional', 'E', NULL, NULL),
(480, '31daa19effc33280b2e4ae94ae8cfb39', '17ae1bb333f280e72bdfeecf08342617', 'optional', 'E', NULL, NULL),
(481, '31daa19effc33280b2e4ae94ae8cfb39', '17afca89d6c133ae83d57d65acc89dd2', 'optional', 'E', NULL, NULL),
(482, '31daa19effc33280b2e4ae94ae8cfb39', '78a92fb99cfdc7f1e537f9caef0e0684', 'necessary', 'S', NULL, NULL),
(483, '31daa19effc33280b2e4ae94ae8cfb39', 'ba1c45bc4d5a9ba46387ba1837f90910', 'necessary', 'S', NULL, NULL),
(484, '7ec4e41e411e5f315f6142c88c491c01', '111239143c8489ef8e53421791b2c3e9', 'optional', 'E', NULL, NULL),
(485, '7ec4e41e411e5f315f6142c88c491c01', '79a78e4e6a080e03d3ddf5aaca20b642', 'optional', 'E', NULL, NULL),
(486, '7ec4e41e411e5f315f6142c88c491c01', '78a92fb99cfdc7f1e537f9caef0e0684', 'optional', 'E', NULL, NULL),
(487, '7ec4e41e411e5f315f6142c88c491c01', 'de52cabd871248ebd540e4c1616d8477', 'optional', 'E', NULL, NULL),
(488, '7ec4e41e411e5f315f6142c88c491c01', 'bbd67ff82f9f3749b72687aa7caa5bba', 'optional', 'E', NULL, NULL),
(489, '7ec4e41e411e5f315f6142c88c491c01', 'b7b5fc68fb85dd88dc124a38ec488f2c', 'optional', 'E', NULL, NULL),
(490, '7ec4e41e411e5f315f6142c88c491c01', '1a50115832dd08b87a189d155c62eb31', 'optional', 'E', NULL, NULL),
(491, '7ec4e41e411e5f315f6142c88c491c01', '921f5461645235088da06b1132a13754', 'optional', 'E', NULL, NULL),
(492, '7ec4e41e411e5f315f6142c88c491c01', '17afca89d6c133ae83d57d65acc89dd2', 'optional', 'E', NULL, NULL),
(493, '7ec4e41e411e5f315f6142c88c491c01', '1502838edf28cac9b0390cd616bd0240', 'optional', 'E', NULL, NULL),
(494, '7ec4e41e411e5f315f6142c88c491c01', '17ae1bb333f280e72bdfeecf08342617', 'optional', 'E', NULL, NULL),
(495, '7ec4e41e411e5f315f6142c88c491c01', '78a92fb99cfdc7f1e537f9caef0e0684', 'necessary', 'S', NULL, NULL),
(496, '7ec4e41e411e5f315f6142c88c491c01', 'ba1c45bc4d5a9ba46387ba1837f90910', 'necessary', 'S', NULL, NULL),
(497, '5f659ac2f904d30914e117edca81d463', '111239143c8489ef8e53421791b2c3e9', 'required', 'D', NULL, NULL),
(498, '5f659ac2f904d30914e117edca81d463', '79a78e4e6a080e03d3ddf5aaca20b642', 'required', 'D', NULL, NULL),
(499, '5f659ac2f904d30914e117edca81d463', 'de52cabd871248ebd540e4c1616d8477', 'required', 'D', NULL, NULL),
(500, '1f088c7a317fcce8e2b0d0a8c1e6b297', '499fb4fc5cb36c9413f708e2290ee465', 'required', 'E', NULL, NULL),
(501, '1f088c7a317fcce8e2b0d0a8c1e6b297', 'bbd67ff82f9f3749b72687aa7caa5bba', 'optional', 'E', NULL, NULL),
(502, '1f088c7a317fcce8e2b0d0a8c1e6b297', '2e45ec206a607ba85a8cb0160e99ade4', 'optional', 'E', NULL, NULL),
(503, '1f088c7a317fcce8e2b0d0a8c1e6b297', '535e955119b624e341febdce9a5ab025', 'optional', 'E', NULL, NULL),
(504, '1f088c7a317fcce8e2b0d0a8c1e6b297', 'f38d3cf78b785d2b10281ebe33c15d8c', 'optional', 'E', NULL, NULL),
(505, '1f088c7a317fcce8e2b0d0a8c1e6b297', '35abc86c96a6c0938e31322dbc787e77', 'optional', 'E', NULL, NULL),
(506, '64466dd5be592b64ae608a2504770f5e', '111239143c8489ef8e53421791b2c3e9', 'optional', 'E', NULL, NULL),
(507, '64466dd5be592b64ae608a2504770f5e', '79a78e4e6a080e03d3ddf5aaca20b642', 'optional', 'E', NULL, NULL),
(508, '64466dd5be592b64ae608a2504770f5e', '78a92fb99cfdc7f1e537f9caef0e0684', 'optional', 'E', NULL, NULL),
(509, '64466dd5be592b64ae608a2504770f5e', 'de52cabd871248ebd540e4c1616d8477', 'optional', 'E', NULL, NULL),
(510, '64466dd5be592b64ae608a2504770f5e', '535e955119b624e341febdce9a5ab025', 'optional', 'E', NULL, NULL),
(511, '64466dd5be592b64ae608a2504770f5e', 'bbd67ff82f9f3749b72687aa7caa5bba', 'optional', 'E', NULL, NULL),
(512, '64466dd5be592b64ae608a2504770f5e', 'b7b5fc68fb85dd88dc124a38ec488f2c', 'optional', 'E', NULL, NULL),
(513, '64466dd5be592b64ae608a2504770f5e', '1a50115832dd08b87a189d155c62eb31', 'optional', 'E', NULL, NULL),
(514, '64466dd5be592b64ae608a2504770f5e', '921f5461645235088da06b1132a13754', 'optional', 'E', NULL, NULL),
(515, '64466dd5be592b64ae608a2504770f5e', '17afca89d6c133ae83d57d65acc89dd2', 'optional', 'E', NULL, NULL),
(516, '64466dd5be592b64ae608a2504770f5e', '1502838edf28cac9b0390cd616bd0240', 'optional', 'E', NULL, NULL),
(517, '64466dd5be592b64ae608a2504770f5e', '17ae1bb333f280e72bdfeecf08342617', 'optional', 'E', NULL, NULL),
(518, '64466dd5be592b64ae608a2504770f5e', '78a92fb99cfdc7f1e537f9caef0e0684', 'necessary', 'S', NULL, NULL),
(519, '64466dd5be592b64ae608a2504770f5e', 'ba1c45bc4d5a9ba46387ba1837f90910', 'necessary', 'S', NULL, NULL),
(520, '6aa2584fd5f15eaa44e5737ecfb990a1', '535e955119b624e341febdce9a5ab025', 'optional', 'E', NULL, NULL),
(521, '6aa2584fd5f15eaa44e5737ecfb990a1', '2e45ec206a607ba85a8cb0160e99ade4', 'optional', 'E', NULL, NULL),
(522, '6aa2584fd5f15eaa44e5737ecfb990a1', 'f38d3cf78b785d2b10281ebe33c15d8c', 'optional', 'E', NULL, NULL),
(523, '6aa2584fd5f15eaa44e5737ecfb990a1', '499fb4fc5cb36c9413f708e2290ee465', 'optional', 'E', NULL, NULL),
(524, '6aa2584fd5f15eaa44e5737ecfb990a1', 'bbd67ff82f9f3749b72687aa7caa5bba', 'optional', 'E', NULL, NULL),
(525, '6aa2584fd5f15eaa44e5737ecfb990a1', '35abc86c96a6c0938e31322dbc787e77', 'optional', 'E', NULL, NULL),
(526, '6aa2584fd5f15eaa44e5737ecfb990a1', 'b7b5fc68fb85dd88dc124a38ec488f2c', 'optional', 'E', NULL, NULL),
(527, '6aa2584fd5f15eaa44e5737ecfb990a1', '1a50115832dd08b87a189d155c62eb31', 'optional', 'E', NULL, NULL),
(528, '6aa2584fd5f15eaa44e5737ecfb990a1', '1502838edf28cac9b0390cd616bd0240', 'optional', 'E', NULL, NULL),
(529, '6aa2584fd5f15eaa44e5737ecfb990a1', '78a92fb99cfdc7f1e537f9caef0e0684', 'optional', 'E', NULL, NULL),
(530, '6aa2584fd5f15eaa44e5737ecfb990a1', '111239143c8489ef8e53421791b2c3e9', 'optional', 'E', NULL, NULL),
(531, '6aa2584fd5f15eaa44e5737ecfb990a1', 'de52cabd871248ebd540e4c1616d8477', 'optional', 'E', NULL, NULL),
(532, '6aa2584fd5f15eaa44e5737ecfb990a1', '79a78e4e6a080e03d3ddf5aaca20b642', 'optional', 'E', NULL, NULL),
(533, '6aa2584fd5f15eaa44e5737ecfb990a1', '17ae1bb333f280e72bdfeecf08342617', 'optional', 'E', NULL, NULL),
(534, '6aa2584fd5f15eaa44e5737ecfb990a1', '0f356d614e6881dd5ae8ffc9989732e9', 'optional', 'E', NULL, NULL),
(535, 'b01b468a4a282897d34fe3662a5bd3a3', 'f38d3cf78b785d2b10281ebe33c15d8c', 'required', 'E', NULL, NULL),
(536, 'b01b468a4a282897d34fe3662a5bd3a3', '2e45ec206a607ba85a8cb0160e99ade4', 'optional', 'E', NULL, NULL),
(537, 'b01b468a4a282897d34fe3662a5bd3a3', '499fb4fc5cb36c9413f708e2290ee465', 'optional', 'E', NULL, NULL),
(541, 'fb7b3bf5858cf2e48f3a538ae83bd3f1', '111239143c8489ef8e53421791b2c3e9', 'required', 'D', NULL, NULL),
(542, 'fb7b3bf5858cf2e48f3a538ae83bd3f1', '79a78e4e6a080e03d3ddf5aaca20b642', 'required', 'D', NULL, NULL),
(543, 'fb7b3bf5858cf2e48f3a538ae83bd3f1', 'de52cabd871248ebd540e4c1616d8477', 'required', 'D', NULL, NULL),
(544, 'd77826b315938dc95ff34a1efde97330', '535e955119b624e341febdce9a5ab025', 'required', 'E', NULL, NULL),
(545, 'd77826b315938dc95ff34a1efde97330', 'bbd67ff82f9f3749b72687aa7caa5bba', 'optional', 'E', NULL, NULL),
(546, 'd77826b315938dc95ff34a1efde97330', '2e45ec206a607ba85a8cb0160e99ade4', 'optional', 'E', NULL, NULL),
(547, 'd77826b315938dc95ff34a1efde97330', '499fb4fc5cb36c9413f708e2290ee465', 'optional', 'E', NULL, NULL),
(548, 'd77826b315938dc95ff34a1efde97330', 'f38d3cf78b785d2b10281ebe33c15d8c', 'optional', 'E', NULL, NULL),
(549, 'd77826b315938dc95ff34a1efde97330', '35abc86c96a6c0938e31322dbc787e77', 'optional', 'E', NULL, NULL),
(550, 'd77826b315938dc95ff34a1efde97330', '0f356d614e6881dd5ae8ffc9989732e9', 'optional', 'E', NULL, NULL),
(551, 'd77826b315938dc95ff34a1efde97330', 'b7b5fc68fb85dd88dc124a38ec488f2c', 'optional', 'E', NULL, NULL),
(552, 'b0ac1d5786744074657f552259365095', '535e955119b624e341febdce9a5ab025', 'optional', 'E', NULL, NULL),
(553, 'b0ac1d5786744074657f552259365095', 'f38d3cf78b785d2b10281ebe33c15d8c', 'optional', 'E', NULL, NULL),
(554, 'b0ac1d5786744074657f552259365095', 'bbd67ff82f9f3749b72687aa7caa5bba', 'optional', 'E', NULL, NULL),
(555, 'b0ac1d5786744074657f552259365095', '2e45ec206a607ba85a8cb0160e99ade4', 'optional', 'E', NULL, NULL),
(556, 'b0ac1d5786744074657f552259365095', '499fb4fc5cb36c9413f708e2290ee465', 'optional', 'E', NULL, NULL),
(557, 'ca6c300fe56c7a2358942fcb1eee60d7', '535e955119b624e341febdce9a5ab025', 'optional', 'E', NULL, NULL),
(558, 'ca6c300fe56c7a2358942fcb1eee60d7', 'bbd67ff82f9f3749b72687aa7caa5bba', 'optional', 'E', NULL, NULL),
(559, 'ca6c300fe56c7a2358942fcb1eee60d7', '2e45ec206a607ba85a8cb0160e99ade4', 'optional', 'E', NULL, NULL),
(560, 'ca6c300fe56c7a2358942fcb1eee60d7', '499fb4fc5cb36c9413f708e2290ee465', 'optional', 'E', NULL, NULL),
(561, 'ca6c300fe56c7a2358942fcb1eee60d7', 'f38d3cf78b785d2b10281ebe33c15d8c', 'optional', 'E', NULL, NULL),
(562, 'ca6c300fe56c7a2358942fcb1eee60d7', '35abc86c96a6c0938e31322dbc787e77', 'optional', 'E', NULL, NULL),
(563, 'ca6c300fe56c7a2358942fcb1eee60d7', '0f356d614e6881dd5ae8ffc9989732e9', 'optional', 'E', NULL, NULL),
(564, 'ca6c300fe56c7a2358942fcb1eee60d7', 'b7b5fc68fb85dd88dc124a38ec488f2c', 'optional', 'E', NULL, NULL),
(565, 'ca6c300fe56c7a2358942fcb1eee60d7', '1a50115832dd08b87a189d155c62eb31', 'optional', 'E', NULL, NULL),
(566, 'ca6c300fe56c7a2358942fcb1eee60d7', '1502838edf28cac9b0390cd616bd0240', 'optional', 'E', NULL, NULL),
(567, 'ca6c300fe56c7a2358942fcb1eee60d7', '111239143c8489ef8e53421791b2c3e9', 'optional', 'E', NULL, NULL),
(568, 'ca6c300fe56c7a2358942fcb1eee60d7', 'de52cabd871248ebd540e4c1616d8477', 'optional', 'E', NULL, NULL),
(569, 'ca6c300fe56c7a2358942fcb1eee60d7', '79a78e4e6a080e03d3ddf5aaca20b642', 'optional', 'E', NULL, NULL),
(570, 'ca6c300fe56c7a2358942fcb1eee60d7', '78a92fb99cfdc7f1e537f9caef0e0684', 'optional', 'E', NULL, NULL),
(571, 'ca6c300fe56c7a2358942fcb1eee60d7', '921f5461645235088da06b1132a13754', 'optional', 'E', NULL, NULL),
(572, 'ca6c300fe56c7a2358942fcb1eee60d7', '17ae1bb333f280e72bdfeecf08342617', 'optional', 'E', NULL, NULL),
(573, 'ca6c300fe56c7a2358942fcb1eee60d7', '17afca89d6c133ae83d57d65acc89dd2', 'optional', 'E', NULL, NULL),
(574, '736e8022ea4ec778d4b11ee4b03d93ea', '2e45ec206a607ba85a8cb0160e99ade4', 'optional', 'E', NULL, NULL),
(575, '736e8022ea4ec778d4b11ee4b03d93ea', '499fb4fc5cb36c9413f708e2290ee465', 'optional', 'E', NULL, NULL),
(576, '736e8022ea4ec778d4b11ee4b03d93ea', '35abc86c96a6c0938e31322dbc787e77', 'optional', 'E', NULL, NULL),
(577, '736e8022ea4ec778d4b11ee4b03d93ea', 'f38d3cf78b785d2b10281ebe33c15d8c', 'optional', 'E', NULL, NULL),
(578, '736e8022ea4ec778d4b11ee4b03d93ea', '535e955119b624e341febdce9a5ab025', 'optional', 'E', NULL, NULL),
(579, '736e8022ea4ec778d4b11ee4b03d93ea', 'bbd67ff82f9f3749b72687aa7caa5bba', 'optional', 'E', NULL, NULL),
(580, 'bfc9559aee160448046cadc5aa9c53c6', '535e955119b624e341febdce9a5ab025', 'optional', 'E', NULL, NULL),
(581, 'bfc9559aee160448046cadc5aa9c53c6', 'f38d3cf78b785d2b10281ebe33c15d8c', 'optional', 'E', NULL, NULL),
(582, 'bfc9559aee160448046cadc5aa9c53c6', 'bbd67ff82f9f3749b72687aa7caa5bba', 'optional', 'E', NULL, NULL),
(583, 'bfc9559aee160448046cadc5aa9c53c6', '2e45ec206a607ba85a8cb0160e99ade4', 'optional', 'E', NULL, NULL),
(584, 'bfc9559aee160448046cadc5aa9c53c6', '499fb4fc5cb36c9413f708e2290ee465', 'optional', 'E', NULL, NULL),
(585, '0cbdcb915d6658c8415aad65e2f08001', '535e955119b624e341febdce9a5ab025', 'optional', 'E', NULL, NULL),
(586, '0cbdcb915d6658c8415aad65e2f08001', 'bbd67ff82f9f3749b72687aa7caa5bba', 'optional', 'E', NULL, NULL),
(587, '0cbdcb915d6658c8415aad65e2f08001', '2e45ec206a607ba85a8cb0160e99ade4', 'optional', 'E', NULL, NULL),
(588, '0cbdcb915d6658c8415aad65e2f08001', '499fb4fc5cb36c9413f708e2290ee465', 'optional', 'E', NULL, NULL),
(589, '0cbdcb915d6658c8415aad65e2f08001', 'f38d3cf78b785d2b10281ebe33c15d8c', 'optional', 'E', NULL, NULL),
(590, '80524131e1731a0ba2dcbdc4f9a6d5e4', '111239143c8489ef8e53421791b2c3e9', 'optional', 'E', NULL, NULL),
(591, '80524131e1731a0ba2dcbdc4f9a6d5e4', '79a78e4e6a080e03d3ddf5aaca20b642', 'optional', 'E', NULL, NULL),
(592, '80524131e1731a0ba2dcbdc4f9a6d5e4', 'de52cabd871248ebd540e4c1616d8477', 'optional', 'E', NULL, NULL),
(593, '80524131e1731a0ba2dcbdc4f9a6d5e4', '78a92fb99cfdc7f1e537f9caef0e0684', 'optional', 'E', NULL, NULL),
(594, '80524131e1731a0ba2dcbdc4f9a6d5e4', 'bbd67ff82f9f3749b72687aa7caa5bba', 'optional', 'E', NULL, NULL),
(595, '80524131e1731a0ba2dcbdc4f9a6d5e4', 'b7b5fc68fb85dd88dc124a38ec488f2c', 'optional', 'E', NULL, NULL),
(596, '80524131e1731a0ba2dcbdc4f9a6d5e4', '1a50115832dd08b87a189d155c62eb31', 'optional', 'E', NULL, NULL),
(597, '80524131e1731a0ba2dcbdc4f9a6d5e4', '1502838edf28cac9b0390cd616bd0240', 'optional', 'E', NULL, NULL),
(598, '80524131e1731a0ba2dcbdc4f9a6d5e4', '921f5461645235088da06b1132a13754', 'optional', 'E', NULL, NULL),
(599, '80524131e1731a0ba2dcbdc4f9a6d5e4', '535e955119b624e341febdce9a5ab025', 'optional', 'E', NULL, NULL),
(600, '80524131e1731a0ba2dcbdc4f9a6d5e4', '499fb4fc5cb36c9413f708e2290ee465', 'optional', 'E', NULL, NULL),
(601, '80524131e1731a0ba2dcbdc4f9a6d5e4', '17ae1bb333f280e72bdfeecf08342617', 'optional', 'E', NULL, NULL),
(602, '80524131e1731a0ba2dcbdc4f9a6d5e4', '17afca89d6c133ae83d57d65acc89dd2', 'optional', 'E', NULL, NULL),
(603, 'e77aa3d95c4d3314b783a42c1ee69281', '535e955119b624e341febdce9a5ab025', 'optional', 'E', NULL, NULL),
(604, 'e77aa3d95c4d3314b783a42c1ee69281', 'bbd67ff82f9f3749b72687aa7caa5bba', 'optional', 'E', NULL, NULL),
(605, 'e77aa3d95c4d3314b783a42c1ee69281', '2e45ec206a607ba85a8cb0160e99ade4', 'optional', 'E', NULL, NULL),
(606, 'e77aa3d95c4d3314b783a42c1ee69281', '499fb4fc5cb36c9413f708e2290ee465', 'optional', 'E', NULL, NULL),
(607, 'e77aa3d95c4d3314b783a42c1ee69281', 'f38d3cf78b785d2b10281ebe33c15d8c', 'optional', 'E', NULL, NULL),
(608, 'e77aa3d95c4d3314b783a42c1ee69281', '35abc86c96a6c0938e31322dbc787e77', 'optional', 'E', NULL, NULL),
(609, 'e77aa3d95c4d3314b783a42c1ee69281', '0f356d614e6881dd5ae8ffc9989732e9', 'optional', 'E', NULL, NULL),
(610, 'e77aa3d95c4d3314b783a42c1ee69281', '111239143c8489ef8e53421791b2c3e9', 'optional', 'E', NULL, NULL),
(611, 'e77aa3d95c4d3314b783a42c1ee69281', '79a78e4e6a080e03d3ddf5aaca20b642', 'optional', 'E', NULL, NULL),
(612, 'e77aa3d95c4d3314b783a42c1ee69281', '78a92fb99cfdc7f1e537f9caef0e0684', 'optional', 'E', NULL, NULL),
(613, 'e77aa3d95c4d3314b783a42c1ee69281', 'de52cabd871248ebd540e4c1616d8477', 'optional', 'E', NULL, NULL),
(614, 'e77aa3d95c4d3314b783a42c1ee69281', '921f5461645235088da06b1132a13754', 'optional', 'E', NULL, NULL),
(615, 'e77aa3d95c4d3314b783a42c1ee69281', '17afca89d6c133ae83d57d65acc89dd2', 'optional', 'E', NULL, NULL),
(616, 'e77aa3d95c4d3314b783a42c1ee69281', '1a50115832dd08b87a189d155c62eb31', 'optional', 'E', NULL, NULL),
(617, 'e77aa3d95c4d3314b783a42c1ee69281', '1502838edf28cac9b0390cd616bd0240', 'optional', 'E', NULL, NULL),
(618, 'e77aa3d95c4d3314b783a42c1ee69281', 'b7b5fc68fb85dd88dc124a38ec488f2c', 'optional', 'E', NULL, NULL),
(619, '5a08e99ac57f414e960caad388dfe125', '535e955119b624e341febdce9a5ab025', 'optional', 'E', NULL, NULL);
INSERT INTO `entry_requirement_subjects` (`id`, `entry_requirement_id`, `subject_id`, `type`, `min_grade`, `created_at`, `updated_at`) VALUES
(620, '5a08e99ac57f414e960caad388dfe125', '2e45ec206a607ba85a8cb0160e99ade4', 'optional', 'E', NULL, NULL),
(621, '5a08e99ac57f414e960caad388dfe125', '499fb4fc5cb36c9413f708e2290ee465', 'optional', 'E', NULL, NULL),
(622, '5a08e99ac57f414e960caad388dfe125', 'f38d3cf78b785d2b10281ebe33c15d8c', 'optional', 'E', NULL, NULL),
(623, '5a08e99ac57f414e960caad388dfe125', 'bbd67ff82f9f3749b72687aa7caa5bba', 'optional', 'E', NULL, NULL),
(624, '5a08e99ac57f414e960caad388dfe125', '35abc86c96a6c0938e31322dbc787e77', 'optional', 'E', NULL, NULL),
(625, '5a08e99ac57f414e960caad388dfe125', '111239143c8489ef8e53421791b2c3e9', 'optional', 'E', NULL, NULL),
(626, '5a08e99ac57f414e960caad388dfe125', '79a78e4e6a080e03d3ddf5aaca20b642', 'optional', 'E', NULL, NULL),
(627, '5a08e99ac57f414e960caad388dfe125', '1a50115832dd08b87a189d155c62eb31', 'optional', 'E', NULL, NULL),
(628, '5a08e99ac57f414e960caad388dfe125', '1502838edf28cac9b0390cd616bd0240', 'optional', 'E', NULL, NULL),
(629, '5a08e99ac57f414e960caad388dfe125', 'de52cabd871248ebd540e4c1616d8477', 'optional', 'E', NULL, NULL),
(630, '5a08e99ac57f414e960caad388dfe125', '78a92fb99cfdc7f1e537f9caef0e0684', 'optional', 'E', NULL, NULL),
(631, '5a08e99ac57f414e960caad388dfe125', '17ae1bb333f280e72bdfeecf08342617', 'optional', 'E', NULL, NULL),
(632, '5a08e99ac57f414e960caad388dfe125', 'b7b5fc68fb85dd88dc124a38ec488f2c', 'optional', 'E', NULL, NULL),
(633, '5a08e99ac57f414e960caad388dfe125', '0f356d614e6881dd5ae8ffc9989732e9', 'optional', 'E', NULL, NULL),
(634, 'dcbf1dbb7915d168285ccec2ad88322e', '535e955119b624e341febdce9a5ab025', 'optional', 'E', NULL, NULL),
(635, 'dcbf1dbb7915d168285ccec2ad88322e', '2e45ec206a607ba85a8cb0160e99ade4', 'optional', 'E', NULL, NULL),
(636, 'dcbf1dbb7915d168285ccec2ad88322e', '499fb4fc5cb36c9413f708e2290ee465', 'optional', 'E', NULL, NULL),
(637, 'dcbf1dbb7915d168285ccec2ad88322e', 'f38d3cf78b785d2b10281ebe33c15d8c', 'optional', 'E', NULL, NULL),
(638, 'dcbf1dbb7915d168285ccec2ad88322e', 'bbd67ff82f9f3749b72687aa7caa5bba', 'optional', 'E', NULL, NULL),
(639, '7db3a00667669b2ae4dcee1d37078fd2', '499fb4fc5cb36c9413f708e2290ee465', 'optional', 'E', NULL, NULL),
(640, '7db3a00667669b2ae4dcee1d37078fd2', '2e45ec206a607ba85a8cb0160e99ade4', 'optional', 'E', NULL, NULL),
(641, '7db3a00667669b2ae4dcee1d37078fd2', '35abc86c96a6c0938e31322dbc787e77', 'optional', 'E', NULL, NULL),
(642, '7db3a00667669b2ae4dcee1d37078fd2', 'f38d3cf78b785d2b10281ebe33c15d8c', 'optional', 'E', NULL, NULL),
(643, '695ed21d5d9d0f6855f930b52a837997', '535e955119b624e341febdce9a5ab025', 'optional', 'E', NULL, NULL),
(644, '695ed21d5d9d0f6855f930b52a837997', 'bbd67ff82f9f3749b72687aa7caa5bba', 'optional', 'E', NULL, NULL),
(645, '695ed21d5d9d0f6855f930b52a837997', '2e45ec206a607ba85a8cb0160e99ade4', 'optional', 'E', NULL, NULL),
(646, '695ed21d5d9d0f6855f930b52a837997', '499fb4fc5cb36c9413f708e2290ee465', 'optional', 'E', NULL, NULL),
(647, '695ed21d5d9d0f6855f930b52a837997', 'f38d3cf78b785d2b10281ebe33c15d8c', 'optional', 'E', NULL, NULL),
(648, '695ed21d5d9d0f6855f930b52a837997', '35abc86c96a6c0938e31322dbc787e77', 'optional', 'E', NULL, NULL),
(649, '695ed21d5d9d0f6855f930b52a837997', '0f356d614e6881dd5ae8ffc9989732e9', 'optional', 'E', NULL, NULL),
(650, '695ed21d5d9d0f6855f930b52a837997', 'b7b5fc68fb85dd88dc124a38ec488f2c', 'optional', 'E', NULL, NULL),
(651, '695ed21d5d9d0f6855f930b52a837997', '1a50115832dd08b87a189d155c62eb31', 'optional', 'E', NULL, NULL),
(652, '695ed21d5d9d0f6855f930b52a837997', '1502838edf28cac9b0390cd616bd0240', 'optional', 'E', NULL, NULL),
(653, '74059b5fd53b8e83f3dd6aadfd49e060', '535e955119b624e341febdce9a5ab025', 'optional', 'E', NULL, NULL),
(654, '74059b5fd53b8e83f3dd6aadfd49e060', 'bbd67ff82f9f3749b72687aa7caa5bba', 'optional', 'E', NULL, NULL),
(655, '74059b5fd53b8e83f3dd6aadfd49e060', '2e45ec206a607ba85a8cb0160e99ade4', 'optional', 'E', NULL, NULL),
(656, '74059b5fd53b8e83f3dd6aadfd49e060', '499fb4fc5cb36c9413f708e2290ee465', 'optional', 'E', NULL, NULL),
(657, '74059b5fd53b8e83f3dd6aadfd49e060', 'f38d3cf78b785d2b10281ebe33c15d8c', 'optional', 'E', NULL, NULL),
(658, '74059b5fd53b8e83f3dd6aadfd49e060', '35abc86c96a6c0938e31322dbc787e77', 'optional', 'E', NULL, NULL),
(659, '74059b5fd53b8e83f3dd6aadfd49e060', '0f356d614e6881dd5ae8ffc9989732e9', 'optional', 'E', NULL, NULL),
(660, '74059b5fd53b8e83f3dd6aadfd49e060', 'b7b5fc68fb85dd88dc124a38ec488f2c', 'optional', 'E', NULL, NULL),
(661, '74059b5fd53b8e83f3dd6aadfd49e060', '1a50115832dd08b87a189d155c62eb31', 'optional', 'E', NULL, NULL),
(662, '74059b5fd53b8e83f3dd6aadfd49e060', '111239143c8489ef8e53421791b2c3e9', 'optional', 'E', NULL, NULL),
(663, '74059b5fd53b8e83f3dd6aadfd49e060', '79a78e4e6a080e03d3ddf5aaca20b642', 'optional', 'E', NULL, NULL),
(664, '74059b5fd53b8e83f3dd6aadfd49e060', 'de52cabd871248ebd540e4c1616d8477', 'optional', 'E', NULL, NULL),
(665, '74059b5fd53b8e83f3dd6aadfd49e060', '78a92fb99cfdc7f1e537f9caef0e0684', 'optional', 'E', NULL, NULL),
(666, '74059b5fd53b8e83f3dd6aadfd49e060', '921f5461645235088da06b1132a13754', 'optional', 'E', NULL, NULL),
(667, '74059b5fd53b8e83f3dd6aadfd49e060', '17ae1bb333f280e72bdfeecf08342617', 'optional', 'E', NULL, NULL),
(668, '74059b5fd53b8e83f3dd6aadfd49e060', '17afca89d6c133ae83d57d65acc89dd2', 'optional', 'E', NULL, NULL),
(669, '74059b5fd53b8e83f3dd6aadfd49e060', '78a92fb99cfdc7f1e537f9caef0e0684', 'necessary', 'S', NULL, NULL),
(670, '74059b5fd53b8e83f3dd6aadfd49e060', 'ba1c45bc4d5a9ba46387ba1837f90910', 'necessary', 'S', NULL, NULL),
(671, '4ca714d0e6867fece1ae23e93f1f4501', '535e955119b624e341febdce9a5ab025', 'optional', 'E', NULL, NULL),
(672, '4ca714d0e6867fece1ae23e93f1f4501', 'bbd67ff82f9f3749b72687aa7caa5bba', 'optional', 'E', NULL, NULL),
(673, '4ca714d0e6867fece1ae23e93f1f4501', '2e45ec206a607ba85a8cb0160e99ade4', 'optional', 'E', NULL, NULL),
(674, '4ca714d0e6867fece1ae23e93f1f4501', '499fb4fc5cb36c9413f708e2290ee465', 'optional', 'E', NULL, NULL),
(675, '4ca714d0e6867fece1ae23e93f1f4501', 'f38d3cf78b785d2b10281ebe33c15d8c', 'optional', 'E', NULL, NULL),
(676, '4ca714d0e6867fece1ae23e93f1f4501', '35abc86c96a6c0938e31322dbc787e77', 'optional', 'E', NULL, NULL),
(677, '4ca714d0e6867fece1ae23e93f1f4501', '0f356d614e6881dd5ae8ffc9989732e9', 'optional', 'E', NULL, NULL),
(678, '4ca714d0e6867fece1ae23e93f1f4501', 'b7b5fc68fb85dd88dc124a38ec488f2c', 'optional', 'E', NULL, NULL),
(679, '4ca714d0e6867fece1ae23e93f1f4501', '1a50115832dd08b87a189d155c62eb31', 'optional', 'E', NULL, NULL),
(680, '4ca714d0e6867fece1ae23e93f1f4501', '1502838edf28cac9b0390cd616bd0240', 'optional', 'E', NULL, NULL),
(681, '4ca714d0e6867fece1ae23e93f1f4501', '111239143c8489ef8e53421791b2c3e9', 'optional', 'E', NULL, NULL),
(682, '4ca714d0e6867fece1ae23e93f1f4501', '79a78e4e6a080e03d3ddf5aaca20b642', 'optional', 'E', NULL, NULL),
(683, '4ca714d0e6867fece1ae23e93f1f4501', 'de52cabd871248ebd540e4c1616d8477', 'optional', 'E', NULL, NULL),
(684, '4ca714d0e6867fece1ae23e93f1f4501', '78a92fb99cfdc7f1e537f9caef0e0684', 'optional', 'E', NULL, NULL),
(685, '4ca714d0e6867fece1ae23e93f1f4501', '921f5461645235088da06b1132a13754', 'optional', 'E', NULL, NULL),
(686, '4ca714d0e6867fece1ae23e93f1f4501', '17ae1bb333f280e72bdfeecf08342617', 'optional', 'E', NULL, NULL),
(687, '4ca714d0e6867fece1ae23e93f1f4501', '17afca89d6c133ae83d57d65acc89dd2', 'optional', 'E', NULL, NULL),
(688, '4ca714d0e6867fece1ae23e93f1f4501', 'ba1c45bc4d5a9ba46387ba1837f90910', 'necessary', 'S', NULL, NULL),
(689, '4ca714d0e6867fece1ae23e93f1f4501', '78a92fb99cfdc7f1e537f9caef0e0684', 'necessary', 'S', NULL, NULL),
(690, 'a9e9f89057eba9322892330136bbad2e', '535e955119b624e341febdce9a5ab025', 'optional', 'E', NULL, NULL),
(691, 'a9e9f89057eba9322892330136bbad2e', 'bbd67ff82f9f3749b72687aa7caa5bba', 'optional', 'E', NULL, NULL),
(692, 'a9e9f89057eba9322892330136bbad2e', '2e45ec206a607ba85a8cb0160e99ade4', 'optional', 'E', NULL, NULL),
(693, 'a9e9f89057eba9322892330136bbad2e', '499fb4fc5cb36c9413f708e2290ee465', 'optional', 'E', NULL, NULL),
(694, 'a9e9f89057eba9322892330136bbad2e', 'f38d3cf78b785d2b10281ebe33c15d8c', 'optional', 'E', NULL, NULL),
(695, 'a9e9f89057eba9322892330136bbad2e', '35abc86c96a6c0938e31322dbc787e77', 'optional', 'E', NULL, NULL),
(696, 'a9e9f89057eba9322892330136bbad2e', '0f356d614e6881dd5ae8ffc9989732e9', 'optional', 'E', NULL, NULL),
(697, 'a9e9f89057eba9322892330136bbad2e', 'b7b5fc68fb85dd88dc124a38ec488f2c', 'optional', 'E', NULL, NULL),
(698, 'a9e9f89057eba9322892330136bbad2e', '1a50115832dd08b87a189d155c62eb31', 'optional', 'E', NULL, NULL),
(699, 'a9e9f89057eba9322892330136bbad2e', '1502838edf28cac9b0390cd616bd0240', 'optional', 'E', NULL, NULL),
(700, 'a9e9f89057eba9322892330136bbad2e', '111239143c8489ef8e53421791b2c3e9', 'optional', 'E', NULL, NULL),
(701, 'a9e9f89057eba9322892330136bbad2e', '79a78e4e6a080e03d3ddf5aaca20b642', 'optional', 'E', NULL, NULL),
(702, 'a9e9f89057eba9322892330136bbad2e', 'de52cabd871248ebd540e4c1616d8477', 'optional', 'E', NULL, NULL),
(703, 'a9e9f89057eba9322892330136bbad2e', '78a92fb99cfdc7f1e537f9caef0e0684', 'optional', 'E', NULL, NULL),
(704, 'a9e9f89057eba9322892330136bbad2e', '921f5461645235088da06b1132a13754', 'optional', 'E', NULL, NULL),
(705, 'a9e9f89057eba9322892330136bbad2e', '17ae1bb333f280e72bdfeecf08342617', 'optional', 'E', NULL, NULL),
(706, 'a9e9f89057eba9322892330136bbad2e', '17afca89d6c133ae83d57d65acc89dd2', 'optional', 'E', NULL, NULL),
(707, 'a9e9f89057eba9322892330136bbad2e', '78a92fb99cfdc7f1e537f9caef0e0684', 'necessary', 'S', NULL, NULL),
(708, 'a9e9f89057eba9322892330136bbad2e', 'ba1c45bc4d5a9ba46387ba1837f90910', 'necessary', 'S', NULL, NULL),
(709, 'ed3e7d256799f3ba43e0a6b61e5cbf5f', '535e955119b624e341febdce9a5ab025', 'optional', 'E', NULL, NULL),
(710, 'ed3e7d256799f3ba43e0a6b61e5cbf5f', 'bbd67ff82f9f3749b72687aa7caa5bba', 'optional', 'E', NULL, NULL),
(711, 'ed3e7d256799f3ba43e0a6b61e5cbf5f', '2e45ec206a607ba85a8cb0160e99ade4', 'optional', 'E', NULL, NULL),
(712, 'ed3e7d256799f3ba43e0a6b61e5cbf5f', '499fb4fc5cb36c9413f708e2290ee465', 'optional', 'E', NULL, NULL),
(713, 'ed3e7d256799f3ba43e0a6b61e5cbf5f', 'f38d3cf78b785d2b10281ebe33c15d8c', 'optional', 'E', NULL, NULL),
(714, 'ed3e7d256799f3ba43e0a6b61e5cbf5f', '35abc86c96a6c0938e31322dbc787e77', 'optional', 'E', NULL, NULL),
(715, 'ed3e7d256799f3ba43e0a6b61e5cbf5f', '0f356d614e6881dd5ae8ffc9989732e9', 'optional', 'E', NULL, NULL),
(716, 'ed3e7d256799f3ba43e0a6b61e5cbf5f', 'b7b5fc68fb85dd88dc124a38ec488f2c', 'optional', 'E', NULL, NULL),
(717, 'ed3e7d256799f3ba43e0a6b61e5cbf5f', '1a50115832dd08b87a189d155c62eb31', 'optional', 'E', NULL, NULL),
(718, 'ed3e7d256799f3ba43e0a6b61e5cbf5f', '1502838edf28cac9b0390cd616bd0240', 'optional', 'E', NULL, NULL),
(719, 'ed3e7d256799f3ba43e0a6b61e5cbf5f', '111239143c8489ef8e53421791b2c3e9', 'optional', 'E', NULL, NULL),
(720, 'ed3e7d256799f3ba43e0a6b61e5cbf5f', '79a78e4e6a080e03d3ddf5aaca20b642', 'optional', 'E', NULL, NULL),
(721, 'ed3e7d256799f3ba43e0a6b61e5cbf5f', 'de52cabd871248ebd540e4c1616d8477', 'optional', 'E', NULL, NULL),
(722, 'ed3e7d256799f3ba43e0a6b61e5cbf5f', '78a92fb99cfdc7f1e537f9caef0e0684', 'optional', 'E', NULL, NULL),
(723, 'ed3e7d256799f3ba43e0a6b61e5cbf5f', '921f5461645235088da06b1132a13754', 'optional', 'E', NULL, NULL),
(724, 'ed3e7d256799f3ba43e0a6b61e5cbf5f', '17ae1bb333f280e72bdfeecf08342617', 'optional', 'E', NULL, NULL),
(725, 'ed3e7d256799f3ba43e0a6b61e5cbf5f', '17afca89d6c133ae83d57d65acc89dd2', 'optional', 'E', NULL, NULL),
(726, 'ed3e7d256799f3ba43e0a6b61e5cbf5f', '78a92fb99cfdc7f1e537f9caef0e0684', 'necessary', 'S', NULL, NULL),
(727, 'ed3e7d256799f3ba43e0a6b61e5cbf5f', 'ba1c45bc4d5a9ba46387ba1837f90910', 'necessary', 'S', NULL, NULL),
(728, '9fe841138231eb169f8ba29deb9e9d7b', '535e955119b624e341febdce9a5ab025', 'optional', 'E', NULL, NULL),
(729, '9fe841138231eb169f8ba29deb9e9d7b', 'bbd67ff82f9f3749b72687aa7caa5bba', 'optional', 'E', NULL, NULL),
(730, '9fe841138231eb169f8ba29deb9e9d7b', '2e45ec206a607ba85a8cb0160e99ade4', 'optional', 'E', NULL, NULL),
(731, '9fe841138231eb169f8ba29deb9e9d7b', '499fb4fc5cb36c9413f708e2290ee465', 'optional', 'E', NULL, NULL),
(732, '9fe841138231eb169f8ba29deb9e9d7b', 'f38d3cf78b785d2b10281ebe33c15d8c', 'optional', 'E', NULL, NULL),
(733, '9fe841138231eb169f8ba29deb9e9d7b', '35abc86c96a6c0938e31322dbc787e77', 'optional', 'E', NULL, NULL),
(734, '9fe841138231eb169f8ba29deb9e9d7b', '0f356d614e6881dd5ae8ffc9989732e9', 'optional', 'E', NULL, NULL),
(735, '9fe841138231eb169f8ba29deb9e9d7b', 'b7b5fc68fb85dd88dc124a38ec488f2c', 'optional', 'E', NULL, NULL),
(736, '9fe841138231eb169f8ba29deb9e9d7b', '1502838edf28cac9b0390cd616bd0240', 'optional', 'E', NULL, NULL),
(737, '9fe841138231eb169f8ba29deb9e9d7b', '111239143c8489ef8e53421791b2c3e9', 'optional', 'E', NULL, NULL),
(738, '9fe841138231eb169f8ba29deb9e9d7b', '79a78e4e6a080e03d3ddf5aaca20b642', 'optional', 'E', NULL, NULL),
(739, '9fe841138231eb169f8ba29deb9e9d7b', 'de52cabd871248ebd540e4c1616d8477', 'optional', 'E', NULL, NULL),
(740, '9fe841138231eb169f8ba29deb9e9d7b', '78a92fb99cfdc7f1e537f9caef0e0684', 'optional', 'E', NULL, NULL),
(741, '9fe841138231eb169f8ba29deb9e9d7b', '921f5461645235088da06b1132a13754', 'optional', 'E', NULL, NULL),
(742, '9fe841138231eb169f8ba29deb9e9d7b', '17ae1bb333f280e72bdfeecf08342617', 'optional', 'E', NULL, NULL),
(743, '9fe841138231eb169f8ba29deb9e9d7b', '17afca89d6c133ae83d57d65acc89dd2', 'optional', 'E', NULL, NULL),
(744, '9fe841138231eb169f8ba29deb9e9d7b', '78a92fb99cfdc7f1e537f9caef0e0684', 'necessary', 'S', NULL, NULL),
(745, '9fe841138231eb169f8ba29deb9e9d7b', 'ba1c45bc4d5a9ba46387ba1837f90910', 'necessary', 'S', NULL, NULL),
(765, '727799c3cb0dfbdafa4af2af45ebe6e1', '535e955119b624e341febdce9a5ab025', 'optional', 'E', NULL, NULL),
(766, '727799c3cb0dfbdafa4af2af45ebe6e1', 'bbd67ff82f9f3749b72687aa7caa5bba', 'optional', 'E', NULL, NULL),
(767, '727799c3cb0dfbdafa4af2af45ebe6e1', '2e45ec206a607ba85a8cb0160e99ade4', 'optional', 'E', NULL, NULL),
(768, '727799c3cb0dfbdafa4af2af45ebe6e1', '499fb4fc5cb36c9413f708e2290ee465', 'optional', 'E', NULL, NULL),
(769, '727799c3cb0dfbdafa4af2af45ebe6e1', 'f38d3cf78b785d2b10281ebe33c15d8c', 'optional', 'E', NULL, NULL),
(770, '727799c3cb0dfbdafa4af2af45ebe6e1', '35abc86c96a6c0938e31322dbc787e77', 'optional', 'E', NULL, NULL),
(771, '727799c3cb0dfbdafa4af2af45ebe6e1', '0f356d614e6881dd5ae8ffc9989732e9', 'optional', 'E', NULL, NULL),
(772, '727799c3cb0dfbdafa4af2af45ebe6e1', 'b7b5fc68fb85dd88dc124a38ec488f2c', 'optional', 'E', NULL, NULL),
(773, '727799c3cb0dfbdafa4af2af45ebe6e1', '1a50115832dd08b87a189d155c62eb31', 'optional', 'E', NULL, NULL),
(774, '727799c3cb0dfbdafa4af2af45ebe6e1', '1502838edf28cac9b0390cd616bd0240', 'optional', 'E', NULL, NULL),
(775, '727799c3cb0dfbdafa4af2af45ebe6e1', '111239143c8489ef8e53421791b2c3e9', 'optional', 'E', NULL, NULL),
(776, '727799c3cb0dfbdafa4af2af45ebe6e1', '79a78e4e6a080e03d3ddf5aaca20b642', 'optional', 'E', NULL, NULL),
(777, '727799c3cb0dfbdafa4af2af45ebe6e1', 'de52cabd871248ebd540e4c1616d8477', 'optional', 'E', NULL, NULL),
(778, '727799c3cb0dfbdafa4af2af45ebe6e1', '78a92fb99cfdc7f1e537f9caef0e0684', 'optional', 'E', NULL, NULL),
(779, '727799c3cb0dfbdafa4af2af45ebe6e1', '17ae1bb333f280e72bdfeecf08342617', 'optional', 'E', NULL, NULL),
(780, '727799c3cb0dfbdafa4af2af45ebe6e1', '17afca89d6c133ae83d57d65acc89dd2', 'optional', 'E', NULL, NULL),
(781, '727799c3cb0dfbdafa4af2af45ebe6e1', '78a92fb99cfdc7f1e537f9caef0e0684', 'necessary', 'S', NULL, NULL),
(782, '727799c3cb0dfbdafa4af2af45ebe6e1', 'ba1c45bc4d5a9ba46387ba1837f90910', 'necessary', 'S', NULL, NULL),
(783, 'fc77ab1756cffdaf3903fcdf882e6a81', '535e955119b624e341febdce9a5ab025', 'optional', 'E', NULL, NULL),
(784, 'fc77ab1756cffdaf3903fcdf882e6a81', 'bbd67ff82f9f3749b72687aa7caa5bba', 'optional', 'E', NULL, NULL),
(785, 'fc77ab1756cffdaf3903fcdf882e6a81', '2e45ec206a607ba85a8cb0160e99ade4', 'optional', 'E', NULL, NULL),
(786, 'fc77ab1756cffdaf3903fcdf882e6a81', '499fb4fc5cb36c9413f708e2290ee465', 'optional', 'E', NULL, NULL),
(787, 'fc77ab1756cffdaf3903fcdf882e6a81', 'f38d3cf78b785d2b10281ebe33c15d8c', 'optional', 'E', NULL, NULL),
(788, 'fc77ab1756cffdaf3903fcdf882e6a81', '35abc86c96a6c0938e31322dbc787e77', 'optional', 'E', NULL, NULL),
(789, 'fc77ab1756cffdaf3903fcdf882e6a81', '0f356d614e6881dd5ae8ffc9989732e9', 'optional', 'E', NULL, NULL),
(790, 'fc77ab1756cffdaf3903fcdf882e6a81', 'b7b5fc68fb85dd88dc124a38ec488f2c', 'optional', 'E', NULL, NULL),
(791, 'fc77ab1756cffdaf3903fcdf882e6a81', '1502838edf28cac9b0390cd616bd0240', 'optional', 'E', NULL, NULL),
(792, 'fc77ab1756cffdaf3903fcdf882e6a81', '1a50115832dd08b87a189d155c62eb31', 'optional', 'E', NULL, NULL),
(793, 'fc77ab1756cffdaf3903fcdf882e6a81', '111239143c8489ef8e53421791b2c3e9', 'optional', 'E', NULL, NULL),
(794, 'fc77ab1756cffdaf3903fcdf882e6a81', '79a78e4e6a080e03d3ddf5aaca20b642', 'optional', 'E', NULL, NULL),
(795, 'fc77ab1756cffdaf3903fcdf882e6a81', 'de52cabd871248ebd540e4c1616d8477', 'optional', 'E', NULL, NULL),
(796, 'fc77ab1756cffdaf3903fcdf882e6a81', '78a92fb99cfdc7f1e537f9caef0e0684', 'optional', 'E', NULL, NULL),
(797, 'fc77ab1756cffdaf3903fcdf882e6a81', '921f5461645235088da06b1132a13754', 'optional', 'E', NULL, NULL),
(798, 'fc77ab1756cffdaf3903fcdf882e6a81', '17ae1bb333f280e72bdfeecf08342617', 'optional', 'E', NULL, NULL),
(799, 'fc77ab1756cffdaf3903fcdf882e6a81', '17afca89d6c133ae83d57d65acc89dd2', 'optional', 'E', NULL, NULL),
(800, 'fc77ab1756cffdaf3903fcdf882e6a81', '78a92fb99cfdc7f1e537f9caef0e0684', 'necessary', 'S', NULL, NULL),
(801, 'fc77ab1756cffdaf3903fcdf882e6a81', 'ba1c45bc4d5a9ba46387ba1837f90910', 'necessary', 'S', NULL, NULL);

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
('144a1bcfa74aa675e045a74f9463430c', 'LINGUISTICS', '2025-05-23 12:01:03', '2025-05-23 12:01:03'),
('2ce9bfa769ff08067d65108a501b8d94', 'CULTURAL HERITAGE', '2025-05-23 11:30:41', '2025-05-23 11:30:41'),
('3c13f7cb18a84b71495e2074305f44a2', 'PUBLIC RELATIONS', '2025-05-23 11:33:57', '2025-05-23 11:33:57'),
('3cbc09a00ae4f273f835f9ca12213399', 'SOCIAL SCIENCE', '2025-05-23 12:42:37', '2025-05-23 12:42:37'),
('48f7c12599cac4824ec5f0f9a85b64db', 'ENGINEERING', '2025-05-15 08:52:52', '2025-05-15 08:52:52'),
('4e62dc14ecad41cc0039b97b838511d4', 'INFORMATION TECHNOLOGY', '2025-05-23 11:48:28', '2025-05-23 11:48:28'),
('50454887affd0f1dcf0354a77aae629d', 'MEDICINE', '2025-05-15 08:52:58', '2025-05-15 08:52:58'),
('5ab4622bf85c2260ef7659b96afa4d08', 'URBAN PLANNING', '2025-05-23 11:29:46', '2025-05-23 11:29:46'),
('61c85fef3fe628448507cf9fee884834', 'ECONOMICS, BANKING & FINANCE', '2025-05-23 11:31:19', '2025-05-23 11:42:15'),
('658e64e2162b8024259369a02271586f', 'EDUCATION, RESEARCH & STATISTICS', '2025-05-23 11:30:52', '2025-05-24 07:49:49'),
('7144d7eb27e93ecd59dca9f9d1d8cb8f', 'HUMAN RESOURCES', '2025-05-24 09:38:13', '2025-05-24 09:38:13'),
('720a381f6fa41ceccd81e87b1a793462', 'MANUFACTURING', '2025-05-24 07:13:04', '2025-05-24 07:13:04'),
('7d65456e1a4117d8cb5bcdb15195ab6a', 'MEDIA, ART & ENTERTAINMENT', '2025-05-23 11:36:59', '2025-05-24 14:57:19'),
('b2c4de026257d3a8ad9079c986d96475', 'LOGISTICS & SUPPLY CHAIN', '2025-05-24 09:06:32', '2025-05-24 09:46:34'),
('bf35ffd27e69fca6144f2c9c4143f8d5', 'LEGAL SERVICES', '2025-05-24 07:42:39', '2025-05-24 07:42:39'),
('c3c17b192dd8307608a340d0e1cb0364', 'GEO SCIENCES & MINING', '2025-05-24 06:47:09', '2025-05-24 07:30:16'),
('c9dd5ef734bf29254ba768e5a3e120ff', 'BUSINESS & MARKETING', '2025-05-23 11:32:53', '2025-05-24 07:30:25'),
('d0db6a91e441fad01bddc7fe1434d0cd', 'HOSPITALITY & TOURISM', '2025-05-23 11:40:11', '2025-05-24 09:33:07');

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
('55277a83aa77f8e34730dd47fe47a2e0', 'University of  Dodoma', 'UDOM', 'University', 'Public', 'Dodoma', '2025-05-22 08:27:01', '2025-05-22 08:27:01', 'https://application.udom.ac.tz', 4, NULL),
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
('03be0c34cf492227b7fcc8162859766c', '55277a83aa77f8e34730dd47fe47a2e0', 'Bachelor of Commerce in Finance', 3, '2025-05-28 06:33:36', '2025-05-28 06:33:36', 'Low Competition'),
('0a2ef0d874889eced29779fe6b314501', 'a2b59dfcf839e4079ea325986087fc53', 'Doctor of Medicine', 5, '2025-05-22 08:07:20', '2025-05-22 08:07:20', 'Moderate Competition'),
('13ba1a5babdb11135842d045405245ba', '55277a83aa77f8e34730dd47fe47a2e0', 'Bachelor of Arts in French', 3, '2025-05-24 15:09:51', '2025-05-24 15:09:51', 'Low Competition'),
('15276fccd27baa4118652dc7a3a32fba', '55277a83aa77f8e34730dd47fe47a2e0', 'Bachelor of Arts in English', 3, '2025-05-24 14:31:47', '2025-05-24 14:31:47', 'Low Competition'),
('1d1a94ea4a5c5d7258ccb1336cf20c95', '55277a83aa77f8e34730dd47fe47a2e0', 'Bachelor of Commerce in Entrepreneurship', 3, '2025-05-28 07:02:31', '2025-05-28 07:02:31', 'Low Competition'),
('1dca1fe90b6afd34e477b9405c1a1f1c', '24c41e67b7e00c6fd19b14a5efae3a98', 'Bachelor of Science in Quantity Surveying and Construction Economics', 4, '2025-05-12 16:18:55', '2025-05-12 16:18:55', 'Low Competition'),
('1f1fb2ec629aee1092ba5c6ebf98d5bd', '55277a83aa77f8e34730dd47fe47a2e0', 'Bachelor of Arts in Journalism and Public Relations', 3, '2025-05-28 05:46:51', '2025-05-28 05:46:51', 'Low Competition'),
('23240d5fa46f8ea7e2e8e403cbad0ffa', '24c41e67b7e00c6fd19b14a5efae3a98', 'Bachelor of Science in Regional Development Planning', 4, '2025-05-12 15:45:08', '2025-05-12 15:45:08', 'Low Competition'),
('274abe94a2938438bc3d3a0a422da8c3', '84ec1ffdd439490c07875ae45c1dc7fb', 'Bachelor of Science in Nursing', 4, '2025-03-14 07:31:43', '2025-05-19 07:42:10', 'High Competition'),
('2898adbdcc25d3d7b23651ee5e80abb1', '24c41e67b7e00c6fd19b14a5efae3a98', 'Bachelor of Science in Municipal and Industrial Services Engineering', 4, '2025-05-10 17:26:19', '2025-05-10 17:26:19', 'Low Competition'),
('2c8091f1835062ab5c271d8cbdf65455', '55277a83aa77f8e34730dd47fe47a2e0', 'Bachelor of Business Administration', 3, '2025-05-28 06:28:17', '2025-05-28 06:28:17', 'Low Competition'),
('2df21b54695076255c90a8e3bc1949a0', '24c41e67b7e00c6fd19b14a5efae3a98', 'Bachelor of Science in Environmental Laboratory Science and Technology', 4, '2025-05-12 16:24:57', '2025-05-12 16:24:57', 'Low Competition'),
('2e328ceeb55abaf3f967b1461e8cbc34', '55277a83aa77f8e34730dd47fe47a2e0', 'Bachelor of Arts in Tourism and Cultural Heritage', 3, '2025-05-28 06:12:22', '2025-05-28 06:12:22', 'Low Competition'),
('2effed800cfa9be994214226d4688d17', '55277a83aa77f8e34730dd47fe47a2e0', 'Bachelor of Science in Petroleum Engineering', 4, '2025-05-24 10:38:15', '2025-05-24 10:38:15', 'Moderate Competition'),
('2ff84a374cb505b01fdb2eb9a5cce919', '55277a83aa77f8e34730dd47fe47a2e0', 'Bachelor of Arts in Political Science and Public Administration', 3, '2025-05-28 05:56:06', '2025-05-28 05:56:06', 'Low Competition'),
('3041a5d3546187206b68e2e34f1b498c', '24c41e67b7e00c6fd19b14a5efae3a98', 'Bachelor of Science in Housing and Infrastructure Planning', 4, '2025-05-12 15:26:21', '2025-05-12 15:26:21', 'Low Competition'),
('3123c6c61eee9f12231325a27577b08e', '55277a83aa77f8e34730dd47fe47a2e0', 'Bachelor of Arts in Fine Arts and Design', 3, '2025-05-24 15:06:55', '2025-05-24 15:06:55', 'Low Competition'),
('3171e6fe14344155312f865300c44fbf', '55277a83aa77f8e34730dd47fe47a2e0', 'Bachelor of Arts in Economics and Sociology', 3, '2025-05-24 12:19:18', '2025-05-24 12:19:18', 'Moderate Competition'),
('32f2acf3761302ddd4f73347a49cd526', '24c41e67b7e00c6fd19b14a5efae3a98', 'Bachelor of  Architecture ', 5, '2025-03-07 11:26:46', '2025-03-07 11:26:46', 'Low Competition'),
('3b002c4fec34240476e454c66e4ad733', '55277a83aa77f8e34730dd47fe47a2e0', 'Bachelor of Arts in Theatre and Film', 3, '2025-05-28 06:09:18', '2025-05-28 06:09:18', 'Low Competition'),
('3d5c922db3b67c46ffbaf9195a03043f', 'b7fb61dae18f53addadd288f2520c403', 'Bachelor of Science in Occupational Therapy', 4, '2025-05-21 14:09:30', '2025-05-21 14:09:30', 'Moderate Competition'),
('3ec5e6b0206ab1fa3d4c63ca141f24ef', '24c41e67b7e00c6fd19b14a5efae3a98', 'Bachelor of  Science in  Landscape  Architecture ', 4, '2025-03-08 08:24:49', '2025-03-08 08:24:49', 'Low Competition'),
('3fe9ea3c37d1ad0b3dbf7bbdc0617027', 'a2b59dfcf839e4079ea325986087fc53', 'Doctor of Dental Surgery', 5, '2025-05-22 08:09:50', '2025-05-22 08:09:50', 'Moderate Competition'),
('42e1316d01cedc078337729829653b5b', '84ec1ffdd439490c07875ae45c1dc7fb', 'Bachelor of Science in Physiotherapy', 4, '2025-05-12 12:50:39', '2025-05-12 12:50:39', 'High Competition'),
('449b2db1ef0be3148d75b31cf01b4b2f', '24c41e67b7e00c6fd19b14a5efae3a98', 'Bachelor of  Science in  Interior  Design ', 4, '2025-03-08 08:18:31', '2025-03-08 08:18:31', 'Low Competition'),
('45b11d1f9ee299000e5b968dded03f50', '55277a83aa77f8e34730dd47fe47a2e0', 'Bachelor of Commerce in Accounting', 3, '2025-05-28 07:07:48', '2025-05-28 07:07:48', 'Low Competition'),
('464e4242d398d7a9491b3a6332e304d7', '55277a83aa77f8e34730dd47fe47a2e0', 'Bachelor of Commerce in Tourism and Hospitality Management', 3, '2025-05-28 06:55:48', '2025-05-28 06:55:48', 'Low Competition'),
('4c6fdda5e89280fddc60a6c6531bb1e0', '55277a83aa77f8e34730dd47fe47a2e0', 'Bachelor of Arts in Sociology', 3, '2025-05-28 06:05:11', '2025-05-28 06:05:11', 'Low Competition'),
('4e46c9efe8b6050f3a98f23f878979f4', '55277a83aa77f8e34730dd47fe47a2e0', 'Bachelor of Arts in Project Planning, Management and Community Development', 3, '2025-05-28 06:00:05', '2025-05-28 06:00:05', 'Low Competition'),
('508abd074cee03faa487e0d9052a1d03', '24c41e67b7e00c6fd19b14a5efae3a98', 'Bachelor of Science in Land Management and Valuation', 4, '2025-05-12 15:31:26', '2025-05-12 15:31:26', 'Low Competition'),
('50bd144ecea17982c79347fbbb0b45fd', '24c41e67b7e00c6fd19b14a5efae3a98', 'Bachelor of  Science in  Information  Systems  Management', 3, '2025-03-07 11:19:50', '2025-03-07 11:19:50', 'Low Competition'),
('5499b5d315f03a7b33f880eb88545fe6', '84ec1ffdd439490c07875ae45c1dc7fb', 'Doctor of Dental Surgery', 5, '2025-05-12 16:56:06', '2025-05-12 16:56:06', 'High Competition'),
('5631f8c13e9880d8bfa150c72589b695', '24c41e67b7e00c6fd19b14a5efae3a98', 'Bachelor of  Science in  Geomatics ', 4, '2025-03-08 08:30:24', '2025-03-08 08:30:24', 'Low Competition'),
('587a540cab0235453b49f13f24770736', '24c41e67b7e00c6fd19b14a5efae3a98', 'Bachelor of Arts in Economics', 3, '2025-05-12 15:59:22', '2025-05-12 15:59:22', 'Low Competition'),
('5e8f08deaddfce947d1e5cb618b28696', '55277a83aa77f8e34730dd47fe47a2e0', 'Bachelor of Arts in Environmental Economics and Policy', 3, '2025-05-24 14:37:41', '2025-05-24 14:37:41', 'Low Competition'),
('5ebded17fb1b01e6a8b833ca4c42c5eb', '55277a83aa77f8e34730dd47fe47a2e0', 'Bachelor of Arts in Development Studies', 3, '2025-05-24 11:29:03', '2025-05-24 11:29:03', 'Low Competition'),
('5f614befa559981f694b049ba973dd3f', '24c41e67b7e00c6fd19b14a5efae3a98', 'Bachelor of Science in Accounting and Finance', 3, '2025-05-12 16:10:54', '2025-05-12 16:10:54', 'Low Competition'),
('63d4bd5e98166ae14a5599b9f85ab96f', '84ec1ffdd439490c07875ae45c1dc7fb', 'Bachelor of Science in Environmental Health Sciences', 3, '2025-05-12 17:04:55', '2025-05-12 17:04:55', 'High Competition'),
('6bb7ca9a16a379ae8a5be8d15fae93e4', '55277a83aa77f8e34730dd47fe47a2e0', 'Bachelor of Geography and Environmental Studies', 3, '2025-05-24 10:28:28', '2025-05-24 10:28:28', 'Low Competition'),
('6c71a7bbb3398a769abfb1fadb5929a1', '84ec1ffdd439490c07875ae45c1dc7fb', 'Doctor of Medicine', 5, '2025-03-14 05:12:01', '2025-03-14 05:12:01', 'High Competition'),
('719fc401b6ea6fa2cf3ff0ed314e8d98', 'b7fb61dae18f53addadd288f2520c403', 'Bachelor of Science in Health Laboratory Sciences ', 4, '2025-05-21 13:33:58', '2025-05-21 13:33:58', 'Moderate Competition'),
('756478f8bdd193b72d499db2538b66bb', '24c41e67b7e00c6fd19b14a5efae3a98', 'Bachelor of Science in Computer Systems and Networks', 3, '2025-05-10 16:06:35', '2025-05-10 16:06:35', 'Low Competition'),
('77089d6bf7f21138817a91790677aed0', '55277a83aa77f8e34730dd47fe47a2e0', 'Bachelor of Arts in Economics', 3, '2025-05-24 11:39:26', '2025-05-24 11:39:26', 'Low Competition'),
('7a60250a7cd96e92cdb9d85ecbf500e7', '24c41e67b7e00c6fd19b14a5efae3a98', 'Bachelor of Science in Geographical Information Systems and Remote Sensing', 3, '2025-05-12 16:21:53', '2025-05-12 16:21:53', 'Low Competition'),
('7bcc3a2490d7ee562c8dc8cac9a25bd2', '84ec1ffdd439490c07875ae45c1dc7fb', 'Bachelor of Biomedical Engineering', 4, '2025-05-12 12:48:21', '2025-05-12 12:48:21', 'High Competition'),
('874f91396a7c6f62b220f9bc1ba7b8f3', 'e7d789969965d30b5d782ed901f42c75', 'Doctor of Medicine', 5, '2025-05-19 08:09:31', '2025-05-19 08:09:31', 'Moderate Competition'),
('8d1ead6ad34295eed0ca5d34ab14a18b', '55277a83aa77f8e34730dd47fe47a2e0', 'Bachelor of Arts in Translation and Interpretation', 3, '2025-05-28 06:17:29', '2025-05-28 06:17:29', 'Low Competition'),
('97a881da632535a77ac6df45650e8bf0', '55277a83aa77f8e34730dd47fe47a2e0', 'Bachelor of Arts in Archaeology and Anthropology', 3, '2025-05-24 10:45:37', '2025-05-24 10:45:37', 'Moderate Competition'),
('9911bb5c436790dea3f075f4126a3c59', '55277a83aa77f8e34730dd47fe47a2e0', 'Bachelor of Arts in Philosophy and Political Science', 3, '2025-05-28 05:53:09', '2025-05-28 05:53:09', 'Low Competition'),
('9d00aa0e1f3822e02abdcc57e0e3bc18', '84ec1ffdd439490c07875ae45c1dc7fb', 'Bachelor of Science in Diagnostic and Therapeutic Radiography', 4, '2025-05-12 16:48:52', '2025-05-12 16:48:52', 'High Competition'),
('9d66b4763429a099292fef7f64a21ab6', '55277a83aa77f8e34730dd47fe47a2e0', 'Doctor of Medicine', 5, '2025-05-22 08:31:58', '2025-05-22 08:31:58', 'Moderate Competition'),
('9dae15c2f9ea41c28100455914e5abdf', '55277a83aa77f8e34730dd47fe47a2e0', 'Bachelor of Commerce in Human Resource Management', 3, '2025-05-28 06:39:13', '2025-05-28 06:39:13', 'Low Competition'),
('9f8815cbb3c5245a6fdf81c9d2a2191a', 'a71a936a22c94f3044a88a1a0acf05fb', 'Bachelor of Science in Beekeeping Science and Technology', 3, '2025-05-13 12:09:38', '2025-05-13 12:09:38', 'Low Competition'),
('a6d09a6a2942b5ed6c5150b4bb909b74', '24c41e67b7e00c6fd19b14a5efae3a98', 'Bachelor of Arts in Community Development', 3, '2025-05-10 16:50:13', '2025-05-10 16:50:13', 'Low Competition'),
('acde11ba72feede28e96137d431ca186', '24c41e67b7e00c6fd19b14a5efae3a98', 'Bachelor of Science in Civil Engineering', 4, '2025-05-12 16:01:01', '2025-05-12 16:01:01', 'Low Competition'),
('b0e9d87e618d6a5d1257af8e36b720e2', '24c41e67b7e00c6fd19b14a5efae3a98', 'Bachelor of Science in Urban and Regional Planning', 4, '2025-05-12 15:55:54', '2025-05-12 15:55:54', 'Low Competition'),
('b395b831c235d690bb4045488bd984c8', '55277a83aa77f8e34730dd47fe47a2e0', 'Bachelor of Arts in Economics and Statistics', 3, '2025-05-24 12:24:09', '2025-05-24 12:24:09', 'Moderate Competition'),
('b480bff980c03badd4ac50713b62e9c7', '55277a83aa77f8e34730dd47fe47a2e0', 'Bachelor of Arts in History', 3, '2025-05-24 15:36:21', '2025-05-24 15:36:21', 'Low Competition'),
('ba47e9cf0055abce55d33e7ad7200626', '84ec1ffdd439490c07875ae45c1dc7fb', 'Bachelor of Science in Occupational Therapy', 4, '2025-05-12 16:53:25', '2025-05-12 16:53:25', 'High Competition'),
('c03243b27df718a9de6751ba21d53177', '55277a83aa77f8e34730dd47fe47a2e0', 'Bachelor of Arts in International Relations', 3, '2025-05-28 05:41:45', '2025-05-28 05:41:45', 'Low Competition'),
('c1368857a497441654705eba40d31c59', '84ec1ffdd439490c07875ae45c1dc7fb', 'Bachelor of Medical Laboratory Sciences', 3, '2025-05-12 16:43:56', '2025-05-12 16:43:56', 'High Competition'),
('c67d1a2b2e50d41ccaef5c7cc7b857db', '24c41e67b7e00c6fd19b14a5efae3a98', 'Bachelor of  Science in  Environmental Science and  Management ', 4, '2025-03-08 08:57:33', '2025-03-08 11:36:18', 'Low Competition'),
('c731182b3060cbed02f070022cf3de30', 'b7fb61dae18f53addadd288f2520c403', 'Bachelor of Science in Optometry ', 4, '2025-05-21 14:05:29', '2025-05-21 14:05:29', 'Moderate Competition'),
('c7d1b2fc3b1195b94195450ae9c0c9b5', '84ec1ffdd439490c07875ae45c1dc7fb', 'Bachelor of Pharmacy', 4, '2025-03-14 05:15:12', '2025-03-14 05:15:12', 'High Competition'),
('caca892a97f4296c3efaf481a0c56f2b', 'b7fb61dae18f53addadd288f2520c403', 'Bachelor of Science in Prosthetics & Orthotics ', 4, '2025-05-21 13:55:14', '2025-05-21 13:55:14', 'Moderate Competition'),
('cd9323c76d11b08ba1b98764b68ba470', '84ec1ffdd439490c07875ae45c1dc7fb', 'Bachelor of Science in Audiology & Speech Language Pathology', 4, '2025-05-12 16:51:15', '2025-05-12 16:51:15', 'High Competition'),
('d00189b5bb76a8f2f842e760b609f532', 'b7fb61dae18f53addadd288f2520c403', 'Bachelor of Science in Physiotherapy ', 4, '2025-05-21 13:49:52', '2025-05-21 13:49:52', 'Moderate Competition'),
('d45f1df0e8acdcfaaa0f76a18a0d962b', '55277a83aa77f8e34730dd47fe47a2e0', 'Bachelor of Arts with Education', 3, '2025-05-28 06:19:33', '2025-05-28 06:19:33', 'Low Competition'),
('d4899639b1243eeef21e33c0cfeb4135', 'b7fb61dae18f53addadd288f2520c403', 'Doctor of Medicine ', 5, '2025-05-21 13:23:20', '2025-05-21 13:23:20', 'Moderate Competition'),
('d9ad51d469d2b2c91164258efdf68955', '55277a83aa77f8e34730dd47fe47a2e0', 'Bachelor of Commerce in International Business', 3, '2025-05-28 06:45:28', '2025-05-28 06:45:28', 'Low Competition'),
('df57e1e7f5710b954943617651407528', '24c41e67b7e00c6fd19b14a5efae3a98', 'Bachelor of Science in Real Estate, Finance and Investment', 4, '2025-05-12 15:53:10', '2025-05-12 15:53:10', 'Low Competition'),
('e490db7b5a98a0aa59eebd9ba8986bb3', '24c41e67b7e00c6fd19b14a5efae3a98', 'Bachelor of  Science in  Environmental  Engineering ', 4, '2025-03-08 08:32:02', '2025-03-08 11:53:15', 'Low Competition'),
('ebc4a771901acd053c8f21ca146d0eb6', '24c41e67b7e00c6fd19b14a5efae3a98', 'Bachelor of Science in Property and Facility Management', 4, '2025-05-12 15:41:06', '2025-05-12 15:41:06', 'Low Competition'),
('ee52820f620c1cdc868b0ef51a0d7df1', '55277a83aa77f8e34730dd47fe47a2e0', 'Bachelor of Arts in Oriental Languages', 3, '2025-05-28 05:50:03', '2025-05-28 05:50:03', 'Low Competition'),
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
('Fk4BDRHUtIIJe34eqBt6u6BEemGG01p5qElwhH5B', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36 Edg/136.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiR2ZNbWRGUWRxZ1dXcG5GUjYzNmFVRjhaWGVRcmt2Mk5PU3JEaWNyeSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hdXRoIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1748426987);

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
('0f356d614e6881dd5ae8ffc9989732e9', 'Fine Art', 'FA', '2025-05-10 11:28:16', '2025-05-24 10:44:11', 0, 0),
('111239143c8489ef8e53421791b2c3e9', 'Physics', 'P', '2025-03-05 11:42:28', '2025-05-16 13:35:20', 0, 0),
('1502838edf28cac9b0390cd616bd0240', 'Accountancy', 'A', '2025-03-11 07:34:25', '2025-05-09 10:20:40', 0, 0),
('17ae1bb333f280e72bdfeecf08342617', 'Computer Science', 'CS', '2025-05-10 11:27:44', '2025-05-10 11:27:44', 0, 0),
('17afca89d6c133ae83d57d65acc89dd2', 'Nutrition', 'N', '2025-03-14 07:36:48', '2025-05-09 10:20:49', 0, 0),
('1a50115832dd08b87a189d155c62eb31', 'Commerce', 'C', '2025-03-11 07:33:45', '2025-05-09 10:20:58', 0, 0),
('2e45ec206a607ba85a8cb0160e99ade4', 'Kiswahili', 'K', '2025-03-11 07:33:19', '2025-05-09 10:21:07', 0, 0),
('3028d0e628e27d5384fe2c334634db6d', 'General Studies', 'GS', '2025-05-09 10:23:43', '2025-05-19 04:56:00', 1, 1),
('35abc86c96a6c0938e31322dbc787e77', 'Arabic', 'AR', '2025-05-24 10:43:21', '2025-05-24 10:43:21', 0, 0),
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
