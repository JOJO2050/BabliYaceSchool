-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 25 août 2026 à 21:29
-- Version du serveur : 9.1.0
-- Version de PHP : 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `bd_babliyaceschool`
--

-- --------------------------------------------------------

--
-- Structure de la table `assign_class_subject_teacher`
--

DROP TABLE IF EXISTS `assign_class_subject_teacher`;
CREATE TABLE IF NOT EXISTS `assign_class_subject_teacher` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `class_id` bigint UNSIGNED NOT NULL,
  `subject_id` bigint UNSIGNED NOT NULL,
  `teacher_id` bigint UNSIGNED NOT NULL,
  `status` tinyint NOT NULL DEFAULT '0',
  `is_delete` tinyint NOT NULL DEFAULT '0',
  `created_by` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `class_subject_teacher_unique` (`class_id`,`subject_id`,`teacher_id`),
  KEY `assign_class_subject_teacher_subject_id_foreign` (`subject_id`),
  KEY `assign_class_subject_teacher_teacher_id_foreign` (`teacher_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `assign_class_subject_teacher`
--

INSERT INTO `assign_class_subject_teacher` (`id`, `class_id`, `subject_id`, `teacher_id`, `status`, `is_delete`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 40, 9, 44, 0, 1, 1, '2026-07-23 19:30:53', '2026-07-23 20:31:51'),
(2, 28, 9, 44, 0, 1, 1, '2026-07-23 19:45:27', '2026-07-23 20:31:53'),
(3, 28, 10, 43, 0, 0, 1, '2026-07-23 19:45:27', '2026-07-23 19:45:27'),
(4, 28, 9, 42, 0, 0, 1, '2026-07-23 19:45:27', '2026-07-23 19:46:01'),
(5, 31, 9, 44, 0, 0, 1, '2026-07-23 20:33:45', '2026-07-23 20:34:20'),
(6, 31, 10, 43, 0, 0, 1, '2026-07-28 06:38:12', '2026-07-28 06:38:12'),
(7, 31, 5, 44, 0, 0, 1, '2026-07-28 08:43:19', '2026-07-28 08:43:19'),
(8, 35, 8, 59, 0, 1, 1, '2026-08-13 19:39:23', '2026-08-13 19:43:18');

-- --------------------------------------------------------

--
-- Structure de la table `assign_class_teacher`
--

DROP TABLE IF EXISTS `assign_class_teacher`;
CREATE TABLE IF NOT EXISTS `assign_class_teacher` (
  `id` int NOT NULL AUTO_INCREMENT,
  `class_id` int DEFAULT NULL,
  `teacher_id` int DEFAULT NULL,
  `status` tinyint DEFAULT '0',
  `is_delete` tinyint NOT NULL DEFAULT '0',
  `created_by` int DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `class`
--

DROP TABLE IF EXISTS `class`;
CREATE TABLE IF NOT EXISTS `class` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '0' COMMENT '0:Active, 1:Inactive ',
  `is_delete` tinyint NOT NULL DEFAULT '0' COMMENT '	0:Pas Supprimé, 1:Supprimé',
  `created_by` int DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `class`
--

INSERT INTO `class` (`id`, `name`, `status`, `is_delete`, `created_by`, `created_at`, `updated_at`) VALUES
(1, '6ème 1', 0, 0, 1, '2026-02-13 15:50:18', '2026-02-14 17:04:10'),
(2, '6ème 2', 0, 0, 1, '2026-02-13 15:58:47', '2026-02-13 15:58:47'),
(3, '6ème 3', 0, 0, 1, '2026-02-13 16:28:19', '2026-02-22 21:09:51'),
(4, '6ème 4', 0, 0, 1, '2026-02-14 17:14:30', '2026-02-22 21:10:16'),
(5, '6ème 5', 0, 0, 1, '2026-02-18 12:30:19', '2026-02-22 21:10:36'),
(6, '6ème 6', 0, 0, 1, '2026-02-22 21:11:15', '2026-02-22 21:11:15'),
(7, '6ème 7', 0, 0, 1, '2026-02-22 21:11:28', '2026-02-22 21:11:28'),
(8, '6ème 8', 0, 0, 1, '2026-02-22 21:11:41', '2026-02-22 21:11:41'),
(9, '6ème 9', 0, 0, 1, '2026-02-22 21:11:55', '2026-02-22 21:11:55'),
(10, '6ème 10', 0, 0, 1, '2026-02-22 21:12:12', '2026-02-22 21:12:12'),
(11, '5ème 1', 0, 0, 1, '2026-02-22 21:12:42', '2026-02-22 21:12:42'),
(12, '5ème 2', 0, 0, 1, '2026-02-22 21:24:27', '2026-02-22 21:24:27'),
(13, '5ème 3', 0, 0, 1, '2026-02-22 21:24:40', '2026-02-22 21:24:40'),
(14, '5ème 4', 0, 0, 1, '2026-02-22 21:24:53', '2026-02-22 21:24:53'),
(15, '5ème 5', 0, 0, 1, '2026-02-22 21:25:05', '2026-02-22 21:25:05'),
(16, '5ème 6', 0, 0, 1, '2026-02-22 21:25:23', '2026-02-22 21:25:23'),
(17, '5ème 7', 0, 0, 1, '2026-02-22 21:25:41', '2026-02-22 21:25:41'),
(18, '5ème 8', 0, 0, 1, '2026-02-22 21:25:52', '2026-02-22 21:25:52'),
(19, '5ème 9', 0, 0, 1, '2026-02-22 21:26:05', '2026-02-22 21:26:05'),
(20, '5ème 10', 0, 0, 1, '2026-02-22 21:26:17', '2026-02-22 21:26:17'),
(21, '4ème 1', 0, 0, 1, '2026-02-22 21:27:33', '2026-02-22 21:27:33'),
(22, '4ème 2', 0, 0, 1, '2026-02-22 21:27:43', '2026-02-22 21:27:43'),
(23, '4ème 3', 0, 0, 1, '2026-02-22 21:27:58', '2026-02-22 21:28:06'),
(24, '4ème 4', 0, 0, 1, '2026-02-22 21:28:20', '2026-02-22 21:28:20'),
(25, '4ème 5', 0, 0, 1, '2026-02-22 21:28:35', '2026-02-22 21:28:35'),
(26, '4ème 6', 0, 0, 1, '2026-02-22 21:28:47', '2026-02-22 21:28:47'),
(27, '4ème 7', 0, 0, 1, '2026-02-22 21:28:57', '2026-02-22 21:28:57'),
(28, '4ème 8', 0, 0, 1, '2026-02-22 21:29:14', '2026-02-22 21:29:14'),
(29, '4ème 9', 0, 0, 1, '2026-02-22 21:29:28', '2026-02-22 21:29:28'),
(30, '4ème 10', 0, 0, 1, '2026-02-22 21:29:39', '2026-02-22 21:29:39'),
(31, '3ème 1', 0, 0, 1, '2026-02-22 21:29:57', '2026-02-22 21:29:57'),
(32, '3ème 2', 0, 0, 1, '2026-02-22 21:30:06', '2026-02-22 21:30:06'),
(33, '3ème 3', 0, 0, 1, '2026-02-22 21:30:16', '2026-02-22 21:30:16'),
(34, '3ème 4', 0, 0, 1, '2026-02-22 21:30:27', '2026-02-22 21:30:27'),
(35, '3ème 5', 0, 0, 1, '2026-02-22 21:30:39', '2026-02-22 21:30:39'),
(36, '3ème 6', 0, 0, 1, '2026-02-22 21:30:50', '2026-02-22 21:30:50'),
(37, '3ème 7', 0, 0, 1, '2026-02-22 21:31:27', '2026-02-22 21:31:27'),
(38, '3ème 8', 0, 0, 1, '2026-02-22 21:31:38', '2026-02-22 21:31:38'),
(39, '3ème 9', 0, 0, 1, '2026-02-22 21:31:53', '2026-02-22 21:31:53'),
(40, '3ème 10', 0, 0, 1, '2026-02-22 21:32:10', '2026-06-21 10:24:02');

-- --------------------------------------------------------

--
-- Structure de la table `class_subject`
--

DROP TABLE IF EXISTS `class_subject`;
CREATE TABLE IF NOT EXISTS `class_subject` (
  `id` int NOT NULL AUTO_INCREMENT,
  `class_id` int DEFAULT NULL,
  `subject_id` int DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `is_delete` tinyint NOT NULL DEFAULT '0',
  `status` int NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=72 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `class_subject`
--

INSERT INTO `class_subject` (`id`, `class_id`, `subject_id`, `created_by`, `is_delete`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 8, 1, 0, 0, '2026-03-30 14:52:01', '2026-03-30 14:52:01'),
(2, 2, 9, 1, 0, 0, '2026-03-30 14:52:01', '2026-03-30 14:52:01'),
(3, 2, 5, 1, 0, 0, '2026-03-30 14:52:01', '2026-03-30 14:52:01'),
(4, 2, 6, 1, 0, 0, '2026-03-30 14:52:01', '2026-03-30 14:52:01'),
(5, 2, 7, 1, 0, 0, '2026-03-30 14:52:01', '2026-03-30 14:52:01'),
(6, 2, 12, 1, 0, 0, '2026-03-30 14:52:01', '2026-03-30 14:52:01'),
(7, 2, 11, 1, 0, 0, '2026-03-30 14:52:01', '2026-03-30 14:52:01'),
(8, 2, 17, 1, 0, 0, '2026-03-30 14:52:01', '2026-03-30 14:52:01'),
(9, 2, 13, 1, 0, 0, '2026-03-30 14:52:01', '2026-03-30 14:52:01'),
(10, 35, 10, 1, 1, 0, '2026-06-24 14:07:46', '2026-06-24 14:39:20'),
(11, 29, 8, 1, 0, 0, '2026-06-24 14:39:36', '2026-06-24 14:39:36'),
(12, 29, 9, 1, 0, 0, '2026-06-24 14:39:36', '2026-06-24 14:39:36'),
(13, 29, 10, 1, 0, 0, '2026-06-24 14:39:36', '2026-06-24 14:39:36'),
(14, 29, 16, 1, 0, 0, '2026-06-24 14:39:36', '2026-06-24 14:39:36'),
(15, 29, 6, 1, 0, 0, '2026-06-24 14:39:36', '2026-06-24 14:39:36'),
(16, 29, 14, 1, 0, 0, '2026-06-24 14:39:36', '2026-06-24 14:39:36'),
(17, 36, 8, 1, 0, 0, '2026-06-24 14:40:01', '2026-06-24 14:40:01'),
(18, 36, 9, 1, 0, 0, '2026-06-24 14:40:01', '2026-06-24 14:40:01'),
(19, 36, 10, 1, 0, 0, '2026-06-24 14:40:01', '2026-06-24 14:40:01'),
(20, 36, 16, 1, 0, 0, '2026-06-24 14:40:01', '2026-06-24 14:40:01'),
(21, 36, 6, 1, 0, 0, '2026-06-24 14:40:01', '2026-06-24 14:40:01'),
(22, 36, 7, 1, 0, 0, '2026-06-24 14:40:01', '2026-06-24 14:40:01'),
(23, 36, 12, 1, 0, 0, '2026-06-24 14:40:01', '2026-06-24 14:40:01'),
(24, 36, 11, 1, 0, 0, '2026-06-24 14:40:01', '2026-06-24 14:40:01'),
(25, 36, 13, 1, 0, 0, '2026-06-24 14:40:01', '2026-06-24 14:40:01'),
(26, 36, 15, 1, 0, 0, '2026-06-24 14:40:01', '2026-06-24 14:40:01'),
(27, 33, 8, 1, 0, 0, '2026-06-24 14:40:46', '2026-06-24 14:40:46'),
(28, 33, 9, 1, 0, 0, '2026-06-24 14:40:46', '2026-06-24 14:40:46'),
(29, 33, 10, 1, 0, 0, '2026-06-24 14:40:46', '2026-06-24 14:40:46'),
(30, 33, 16, 1, 0, 0, '2026-06-24 14:40:46', '2026-06-24 14:40:46'),
(31, 33, 5, 1, 0, 0, '2026-06-24 14:40:46', '2026-06-24 14:40:46'),
(32, 33, 6, 1, 0, 0, '2026-06-24 14:40:46', '2026-06-24 14:40:46'),
(33, 33, 12, 1, 0, 0, '2026-06-24 14:40:46', '2026-06-24 14:40:46'),
(34, 33, 11, 1, 0, 0, '2026-06-24 14:40:46', '2026-06-24 14:40:46'),
(35, 33, 13, 1, 0, 0, '2026-06-24 14:40:46', '2026-06-24 14:40:46'),
(36, 33, 15, 1, 0, 0, '2026-06-24 14:40:46', '2026-06-24 14:40:46'),
(37, 12, 8, 1, 0, 0, '2026-06-24 14:41:15', '2026-06-24 14:41:15'),
(38, 12, 9, 1, 0, 0, '2026-06-24 14:41:15', '2026-06-24 14:41:15'),
(39, 12, 10, 1, 0, 0, '2026-06-24 14:41:15', '2026-06-24 14:41:15'),
(40, 12, 16, 1, 0, 0, '2026-06-24 14:41:15', '2026-06-24 14:41:15'),
(41, 12, 5, 1, 0, 0, '2026-06-24 14:41:15', '2026-06-24 14:41:15'),
(42, 12, 6, 1, 0, 0, '2026-06-24 14:41:15', '2026-06-24 14:41:15'),
(43, 12, 7, 1, 0, 0, '2026-06-24 14:41:15', '2026-06-24 14:41:15'),
(44, 12, 14, 1, 0, 0, '2026-06-24 14:41:15', '2026-06-24 14:41:15'),
(45, 12, 11, 1, 0, 0, '2026-06-24 14:41:15', '2026-06-24 14:41:15'),
(46, 12, 17, 1, 0, 0, '2026-06-24 14:41:15', '2026-06-24 14:41:15'),
(47, 12, 13, 1, 0, 0, '2026-06-24 14:41:15', '2026-06-24 14:41:15'),
(48, 28, 8, 1, 0, 0, '2026-06-24 14:56:47', '2026-06-24 14:56:47'),
(49, 28, 9, 1, 0, 0, '2026-06-24 14:56:47', '2026-06-24 14:56:47'),
(50, 28, 10, 1, 0, 0, '2026-06-24 14:56:47', '2026-06-24 14:56:47'),
(51, 28, 16, 1, 0, 0, '2026-06-24 14:56:47', '2026-06-24 14:56:47'),
(52, 28, 5, 1, 0, 0, '2026-06-24 14:56:47', '2026-06-24 14:56:47'),
(53, 28, 6, 1, 0, 0, '2026-06-24 14:56:47', '2026-06-24 14:56:47'),
(54, 28, 7, 1, 0, 0, '2026-06-24 14:56:47', '2026-06-24 14:56:47'),
(55, 28, 14, 1, 0, 0, '2026-06-24 14:56:47', '2026-06-24 14:56:47'),
(56, 28, 11, 1, 0, 0, '2026-06-24 14:56:47', '2026-06-24 14:56:47'),
(62, 31, 10, 1, 0, 0, '2026-07-28 06:37:40', '2026-07-28 06:37:40'),
(58, 32, 10, 1, 0, 0, '2026-07-08 16:34:32', '2026-07-08 16:34:32'),
(61, 31, 9, 1, 0, 0, '2026-07-28 06:37:40', '2026-07-28 06:37:40'),
(63, 31, 5, 1, 0, 0, '2026-07-28 06:37:40', '2026-07-28 06:37:40'),
(64, 31, 6, 1, 0, 0, '2026-07-28 06:37:40', '2026-07-28 06:37:40'),
(65, 35, 8, 1, 0, 0, '2026-08-13 19:38:31', '2026-08-13 19:38:31'),
(66, 35, 9, 1, 0, 0, '2026-08-13 19:38:31', '2026-08-13 19:38:31'),
(67, 35, 16, 1, 0, 0, '2026-08-13 19:38:31', '2026-08-13 19:38:31'),
(68, 35, 11, 1, 0, 0, '2026-08-13 19:38:31', '2026-08-13 19:38:31'),
(69, 35, 17, 1, 0, 0, '2026-08-13 19:38:31', '2026-08-13 19:38:31'),
(70, 35, 13, 1, 0, 0, '2026-08-13 19:38:31', '2026-08-13 19:38:31'),
(71, 35, 15, 1, 0, 0, '2026-08-13 19:38:31', '2026-08-13 19:38:31');

-- --------------------------------------------------------

--
-- Structure de la table `class_subject_timetable`
--

DROP TABLE IF EXISTS `class_subject_timetable`;
CREATE TABLE IF NOT EXISTS `class_subject_timetable` (
  `id` int NOT NULL AUTO_INCREMENT,
  `class_id` int DEFAULT NULL,
  `subject_id` int DEFAULT NULL,
  `week_id` int DEFAULT NULL,
  `start_time` varchar(100) DEFAULT NULL,
  `end_time` varchar(100) DEFAULT NULL,
  `room_number` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `class_subject_timetable`
--

INSERT INTO `class_subject_timetable` (`id`, `class_id`, `subject_id`, `week_id`, `start_time`, `end_time`, `room_number`, `created_at`, `updated_at`) VALUES
(9, 28, 9, 1, '10:00', '12:00', '5', '2026-07-28 07:22:44', '2026-07-28 07:22:44'),
(4, 28, 10, 1, '08:00', '10:00', '5', '2026-07-28 06:40:10', '2026-07-28 06:40:10'),
(3, 31, 9, 1, '10:00', '12:00', '5', '2026-07-27 10:20:29', '2026-07-27 10:20:29'),
(5, 28, 10, 2, '14:00', '16:00', '5', '2026-07-28 06:40:10', '2026-07-28 06:40:10'),
(6, 28, 10, 3, '08:00', '09:00', '5', '2026-07-28 06:40:10', '2026-07-28 06:40:10'),
(7, 28, 10, 4, '10:00', '12:00', '5', '2026-07-28 06:40:10', '2026-07-28 06:40:10'),
(8, 28, 10, 5, '09:00', '10:00', '5', '2026-07-28 06:40:10', '2026-07-28 06:40:10'),
(10, 31, 10, 1, '10:00', '12:00', '10', '2026-07-28 07:36:15', '2026-07-28 07:36:15'),
(11, 35, 8, 1, '08:00', '10:00', '5', '2026-08-13 19:40:34', '2026-08-13 19:40:34'),
(12, 35, 8, 3, '09:00', '10:00', '5', '2026-08-13 19:40:34', '2026-08-13 19:40:34'),
(13, 35, 8, 5, '14:00', '16:00', '5', '2026-08-13 19:40:34', '2026-08-13 19:40:34');

-- --------------------------------------------------------

--
-- Structure de la table `exam`
--

DROP TABLE IF EXISTS `exam`;
CREATE TABLE IF NOT EXISTS `exam` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(500) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `is_delete` tinyint NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `exam`
--

INSERT INTO `exam` (`id`, `name`, `description`, `created_by`, `is_delete`, `created_at`, `updated_at`) VALUES
(5, '3ème Trimestre', 'Toutes évaluations en rapports avec le  3ème Trimestre du 05/04/2027 au 28/06/2027', 1, 0, '2026-07-10 14:17:00', '2026-07-10 15:19:23'),
(6, '2ème Trimestre', 'Toutes évaluations en rapports avec le 2ème Trimestre du 02/01/2027 au 28/03/2027', 1, 0, '2026-07-10 14:18:02', '2026-07-10 15:18:35'),
(7, '1er Trimestre', 'Toutes évaluations en rapports avec le 1er Trimestre du 08/10/2026 au 22/12/2026', 1, 0, '2026-07-10 14:18:32', '2026-07-10 15:17:16');

-- --------------------------------------------------------

--
-- Structure de la table `exam_schedule`
--

DROP TABLE IF EXISTS `exam_schedule`;
CREATE TABLE IF NOT EXISTS `exam_schedule` (
  `id` int NOT NULL AUTO_INCREMENT,
  `exam_id` int DEFAULT NULL,
  `class_id` int DEFAULT NULL,
  `subject_id` int DEFAULT NULL,
  `exam_date` date DEFAULT NULL,
  `start_time` varchar(100) DEFAULT NULL,
  `end_time` varchar(100) DEFAULT NULL,
  `room_number` varchar(100) DEFAULT NULL,
  `full_marks` varchar(100) DEFAULT NULL,
  `passing_mark` varchar(100) DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `exam_schedule`
--

INSERT INTO `exam_schedule` (`id`, `exam_id`, `class_id`, `subject_id`, `exam_date`, `start_time`, `end_time`, `room_number`, `full_marks`, `passing_mark`, `created_by`, `created_at`, `updated_at`) VALUES
(2, 7, 28, 11, '2026-07-10', '10:00', '12:00', '5', '100', '50', 1, '2026-07-27 08:55:25', '2026-07-27 08:55:25'),
(3, 7, 28, 10, '2026-05-11', '08:00', '10:00', '5', '100', '50', 1, '2026-07-27 08:55:25', '2026-07-27 08:55:25'),
(4, 7, 31, 9, '2026-05-10', '08:00', '10:00', '5', '100', '50', 1, '2026-07-27 10:21:38', '2026-07-27 10:21:38');

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
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
-- Structure de la table `homework`
--

DROP TABLE IF EXISTS `homework`;
CREATE TABLE IF NOT EXISTS `homework` (
  `id` int NOT NULL AUTO_INCREMENT,
  `class_id` int DEFAULT NULL,
  `subject_id` int DEFAULT NULL,
  `homework_date` date DEFAULT NULL,
  `submission_date` date DEFAULT NULL,
  `document_file` varchar(255) DEFAULT NULL,
  `description` text,
  `is_delete` int NOT NULL DEFAULT '0' COMMENT '0:pas supprimé, 1=supprimé\r\n',
  `created_by` int DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `homework`
--

INSERT INTO `homework` (`id`, `class_id`, `subject_id`, `homework_date`, `submission_date`, `document_file`, `description`, `is_delete`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 28, 7, '2026-08-29', '2026-08-25', '20260822020412fuheshetkmrjsiqqmmlt.pdf', '<p>Devoir a rendre le mardi 25</p>', 0, 1, '2026-08-22 14:03:36', '2026-08-22 14:15:32'),
(2, 28, 9, '2026-08-20', '2026-08-29', '20260822031647cslegcpk5mleuo6m32sj.pdf', '<p>Nouvelle mise a jour</p>', 0, 1, '2026-08-22 15:16:47', '2026-08-23 08:37:44'),
(3, 2, 17, '2026-08-13', '2026-08-19', '20260822031742wu1kr13emrirsd3cfbpi.pdf', 'art plastique', 0, 1, '2026-08-22 15:17:42', '2026-08-22 15:17:42'),
(4, 35, 15, '2026-08-17', '2026-08-21', '202608230848064bjg9guif2nfe12dbnvb.pdf', '<p>Devoir arendre le vendredi&nbsp;</p>', 0, 1, '2026-08-23 08:48:06', '2026-08-23 08:48:06'),
(5, 31, 10, '2026-08-21', '2026-08-28', '20260823100956bbkcds39f8q9yqwghabz.pdf', '<p>Devoir de philosophie</p>', 0, 43, '2026-08-23 10:09:56', '2026-08-23 10:49:17'),
(6, 28, 10, '2026-08-12', '2026-08-26', '20260823104815mluozdnbtxfj8oq3qojb.pdf', '<p>Devoir de Philosophie appliqué&nbsp;</p>', 0, 43, '2026-08-23 10:13:11', '2026-08-23 15:19:39'),
(7, 28, 10, '2026-08-23', '2026-08-24', '20260823124823xgl9bnjzgmginhfkvsla.pdf', '<p>okok</p>', 0, 43, '2026-08-23 12:48:23', '2026-08-23 12:48:23'),
(8, 28, 7, '2026-08-23', '2026-08-24', '20260823051140c1ur3tzxqahkep4li0y9.pdf', '<p>Qsqdfqdf</p>', 0, 1, '2026-08-23 17:11:40', '2026-08-23 17:11:40'),
(9, 28, 10, '2026-08-21', '2026-08-27', '20260823093804i6idtlj25plesgueppjl.pdf', '<p>a rendre lundi</p>', 0, 43, '2026-08-23 21:38:04', '2026-08-23 21:38:04'),
(10, 28, 10, '2026-08-14', '2026-08-25', '20260823093855glnpkpaau0hagty7nf9y.pdf', '<p>dgsdgqDGSQSGDqdfqf</p>', 0, 43, '2026-08-23 21:38:55', '2026-08-23 21:38:55');

-- --------------------------------------------------------

--
-- Structure de la table `homework_submit`
--

DROP TABLE IF EXISTS `homework_submit`;
CREATE TABLE IF NOT EXISTS `homework_submit` (
  `id` int NOT NULL AUTO_INCREMENT,
  `homework_id` int DEFAULT NULL,
  `student_id` int DEFAULT NULL,
  `description` text,
  `document_file` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `homework_submit`
--

INSERT INTO `homework_submit` (`id`, `homework_id`, `student_id`, `description`, `document_file`, `created_at`, `updated_at`) VALUES
(1, 1, 56, '<p>Capture ecran</p>', '20260823042453cdyqors0sshtezgjeeka.png', '2026-08-23 16:24:53', '2026-08-23 16:24:53'),
(2, 6, 56, '<p>capture 2</p>', '202608230425524o4swppvmhtkzikiuz90.png', '2026-08-23 16:25:52', '2026-08-23 16:25:52'),
(3, 2, 56, '<p>qsdff</p>', '20260823044347rzhn2ghkg136l4py3t9y.pdf', '2026-08-23 16:43:47', '2026-08-23 16:43:47'),
(4, 7, 56, '<p>devoir de philo</p>', '20260823045138prxjwtvkd411fczjywsn.docx', '2026-08-23 16:51:38', '2026-08-23 16:51:38'),
(5, 8, 56, '<p>Nouveau</p>', '20260823055344cwp08rzhvfplvl4gipvi.jpg', '2026-08-23 17:53:44', '2026-08-23 17:53:44'),
(6, 9, 56, '<p>je viens de finir mon devoir</p>', '20260825034430x6ut8smhxuc0y08pgh3l.jpeg', '2026-08-25 15:44:30', '2026-08-25 15:44:30'),
(7, 10, 55, '<p>okkhqfdFDFDYDFDFd sdiFDIdf</p>', '20260825035455lsscfvrfvcx5rygzkg4q.jpg', '2026-08-25 15:54:55', '2026-08-25 15:54:55'),
(8, 10, 56, '<p>fq dffdsIdfdfiF</p>', '20260825035619nsnhurxmqhlujotxbhp6.jpg', '2026-08-25 15:56:19', '2026-08-25 15:56:19');

-- --------------------------------------------------------

--
-- Structure de la table `marks_grade`
--

DROP TABLE IF EXISTS `marks_grade`;
CREATE TABLE IF NOT EXISTS `marks_grade` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `percent_from` int NOT NULL DEFAULT '0',
  `percent_to` int DEFAULT '0',
  `created_by` int DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `marks_grade`
--

INSERT INTO `marks_grade` (`id`, `name`, `percent_from`, `percent_to`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Insuffisant', 0, 49, 1, '2026-07-19 18:03:34', '2026-07-23 07:32:03'),
(2, 'Passable', 50, 59, 1, '2026-07-20 18:21:51', '2026-07-23 07:32:11'),
(3, 'Assez bien', 60, 69, 1, '2026-07-23 07:15:54', '2026-07-23 07:32:22'),
(4, 'Bien', 70, 79, 1, '2026-07-23 07:16:45', '2026-07-23 07:32:47'),
(5, 'Très bien', 80, 89, 1, '2026-07-23 07:21:42', '2026-07-23 07:33:00'),
(6, 'Excellent', 90, 100, 1, '2026-07-23 07:21:54', '2026-07-23 07:33:11');

-- --------------------------------------------------------

--
-- Structure de la table `marks_register`
--

DROP TABLE IF EXISTS `marks_register`;
CREATE TABLE IF NOT EXISTS `marks_register` (
  `id` int NOT NULL AUTO_INCREMENT,
  `student_id` int DEFAULT NULL,
  `exam_id` int DEFAULT NULL,
  `class_id` int DEFAULT NULL,
  `subject_id` int DEFAULT NULL,
  `Interrogation_1` int NOT NULL DEFAULT '0',
  `Interrogation_2` int NOT NULL DEFAULT '0',
  `Devoir_de_classe_1` int NOT NULL DEFAULT '0',
  `Devoir_de_classe_2` int NOT NULL DEFAULT '0',
  `Devoir_de_niveau` int NOT NULL DEFAULT '0',
  `full_marks` int NOT NULL DEFAULT '0',
  `passing_marks` int DEFAULT '0',
  `created_by` int DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `marks_register`
--

INSERT INTO `marks_register` (`id`, `student_id`, `exam_id`, `class_id`, `subject_id`, `Interrogation_1`, `Interrogation_2`, `Devoir_de_classe_1`, `Devoir_de_classe_2`, `Devoir_de_niveau`, `full_marks`, `passing_marks`, `created_by`, `created_at`, `updated_at`) VALUES
(14, 45, 7, 31, 9, 0, 5, 12, 12, 15, 100, 0, 44, '2026-07-27 11:01:36', '2026-07-27 11:01:36'),
(17, 46, 7, 31, 9, 12, 10, 15, 20, 0, 0, 0, 44, '2026-07-27 11:35:25', '2026-08-07 12:29:27'),
(19, 56, 7, 28, 11, 0, 20, 12, 10, 5, 100, 50, 1, '2026-07-28 08:11:03', '2026-07-29 08:59:31'),
(18, 56, 7, 28, 10, 20, 8, 12, 10, 17, 100, 50, 43, '2026-07-28 07:59:02', '2026-07-29 09:05:29');

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2026_07_23_102112_create_assign_class_subject_teachers_table', 2);

-- --------------------------------------------------------

--
-- Structure de la table `notice_board`
--

DROP TABLE IF EXISTS `notice_board`;
CREATE TABLE IF NOT EXISTS `notice_board` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `notice_date` date DEFAULT NULL,
  `publish_date` date DEFAULT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_by` int DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `notice_board`
--

INSERT INTO `notice_board` (`id`, `title`, `notice_date`, `publish_date`, `message`, `created_by`, `created_at`, `updated_at`) VALUES
(5, 'Information globale', '2026-08-10', '2026-08-12', 'Journée Porte Ouverte', 1, '2026-08-15 12:24:20', '2026-08-17 15:49:12'),
(6, 'Devoir de Mathematqiue', '2026-08-13', '2026-08-15', '<p style=\"text-align: justify;\"><span style=\"color: rgb(32, 33, 34); font-size: 16px;\">Généralement, on utilise un texte en faux </span><a rel=\"mw:WikiLink\" href=\"https://fr.wikipedia.org/wiki/Latin\" title=\"Latin\" id=\"mwKw\" style=\"text-decoration: none; color: rgb(51, 102, 204); background: none rgb(255, 255, 255); border-radius: 2px; overflow-wrap: break-word; font-family: sans-serif; font-size: 16px; font-weight: 400;\">latin</a><span style=\"color: rgb(32, 33, 34); font-size: 16px;\"> (le texte ne veut rien dire, il a été modifié)</span></p>', 1, '2026-08-16 12:13:43', '2026-08-17 16:34:05'),
(4, 'Devoir de 6ème', '2026-08-09', '2026-08-22', '<p>Devoir de Niveau de 6ème ce Lundi 17 Aout 2026.</p><p>Aucune tricherie ne saura toléré</p><p><br></p>', 1, '2026-08-15 10:59:16', '2026-08-23 13:32:42');

-- --------------------------------------------------------

--
-- Structure de la table `notice_board_message`
--

DROP TABLE IF EXISTS `notice_board_message`;
CREATE TABLE IF NOT EXISTS `notice_board_message` (
  `id` int NOT NULL AUTO_INCREMENT,
  `notice_board_id` int DEFAULT NULL,
  `message_to` int DEFAULT NULL COMMENT 'type d''utilisateur\r\n2=Professeur, 3=Elève, 4=Parent',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=85 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `notice_board_message`
--

INSERT INTO `notice_board_message` (`id`, `notice_board_id`, `message_to`, `created_at`, `updated_at`) VALUES
(84, 4, 4, '2026-08-23 13:32:42', '2026-08-23 13:32:42'),
(81, 5, 3, '2026-08-17 18:09:23', '2026-08-17 18:09:23'),
(80, 5, 2, '2026-08-17 18:09:23', '2026-08-17 18:09:23'),
(83, 4, 2, '2026-08-23 13:32:42', '2026-08-23 13:32:42'),
(82, 6, 2, '2026-08-18 06:37:56', '2026-08-18 06:37:56');

-- --------------------------------------------------------

--
-- Structure de la table `password_reset_tokens`
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
-- Structure de la table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `student_attendance`
--

DROP TABLE IF EXISTS `student_attendance`;
CREATE TABLE IF NOT EXISTS `student_attendance` (
  `id` int NOT NULL AUTO_INCREMENT,
  `class_id` int DEFAULT NULL,
  `subject_id` int DEFAULT NULL,
  `student_id` int DEFAULT NULL,
  `attendance_type` int DEFAULT NULL COMMENT '1=Présent, 2=Absent ',
  `attendance_date` date DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `student_attendance`
--

INSERT INTO `student_attendance` (`id`, `class_id`, `subject_id`, `student_id`, `attendance_type`, `attendance_date`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 28, 11, 56, 1, '2026-08-06', 1, '2026-08-06 08:31:13', '2026-08-06 08:41:45'),
(2, 28, 11, 55, 1, '2026-08-06', 1, '2026-08-06 08:31:16', '2026-08-08 17:41:13'),
(3, 31, 5, 46, 2, '2026-08-07', 1, '2026-08-07 11:57:03', '2026-08-07 12:22:55'),
(4, 31, 5, 45, 1, '2026-08-07', 1, '2026-08-07 11:57:05', '2026-08-07 11:57:05'),
(5, 28, 11, 56, 2, '2026-08-09', 1, '2026-08-09 12:52:44', '2026-08-09 12:52:44'),
(6, 28, 11, 55, 2, '2026-08-09', 1, '2026-08-09 12:52:45', '2026-08-09 12:52:45'),
(7, 31, 10, 46, 2, '2026-07-28', 43, '2026-08-10 08:16:38', '2026-08-12 07:50:13'),
(8, 31, 10, 45, 1, '2026-07-28', 43, '2026-08-10 08:17:32', '2026-08-10 08:17:32'),
(9, 31, 10, 46, 2, '2026-08-10', 43, '2026-08-10 08:20:20', '2026-08-10 08:29:28'),
(10, 31, 10, 45, 2, '2026-08-10', 43, '2026-08-10 08:20:52', '2026-08-10 08:30:06'),
(11, 28, 10, 56, 2, '2026-08-10', 1, '2026-08-10 08:31:09', '2026-08-10 08:44:47'),
(12, 28, 10, 55, 1, '2026-08-10', 43, '2026-08-10 08:53:02', '2026-08-10 08:58:55'),
(13, 31, 6, 46, 1, '2026-07-28', 1, '2026-08-12 07:47:49', '2026-08-12 07:47:49'),
(14, 31, 6, 45, 1, '2026-07-28', 1, '2026-08-12 07:47:50', '2026-08-12 07:47:50'),
(15, 28, 10, 56, 1, '2026-07-31', 1, '2026-08-12 09:21:17', '2026-08-12 09:21:17'),
(16, 28, 10, 56, 1, '2026-07-08', 1, '2026-08-12 09:21:28', '2026-08-12 09:21:28'),
(17, 28, 10, 56, 1, '2026-08-13', 43, '2026-08-13 08:53:36', '2026-08-13 08:55:45'),
(18, 28, 5, 56, 2, '2026-08-13', 1, '2026-08-13 09:47:02', '2026-08-13 09:47:02');

-- --------------------------------------------------------

--
-- Structure de la table `subject`
--

DROP TABLE IF EXISTS `subject`;
CREATE TABLE IF NOT EXISTS `subject` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '0' COMMENT '0:active, 1:inactive',
  `is_delete` tinyint NOT NULL DEFAULT '0' COMMENT '0:Pas Supprimé, 1:Supprimé',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `subject`
--

INSERT INTO `subject` (`id`, `name`, `type`, `created_by`, `status`, `is_delete`, `created_at`, `updated_at`) VALUES
(3, 'Mathematique', 'Théorique', 1, 0, 1, '2026-02-17 11:50:22', '2026-02-17 12:18:51'),
(4, 'Français', 'Pratique', 1, 0, 1, '2026-02-17 11:50:45', '2026-02-17 13:24:23'),
(5, 'Mathematique', 'Théorique', 1, 0, 0, '2026-02-17 12:19:15', '2026-02-17 13:28:52'),
(6, 'Histoire & Geographie', 'Théorique', 1, 0, 0, '2026-02-17 13:24:40', '2026-03-09 14:15:05'),
(7, 'Français', 'Pratique', 1, 0, 0, '2026-02-17 16:36:01', '2026-02-17 16:36:01'),
(8, 'Science de la Vie et de la Terre ( SVT)', 'Théorique', 1, 0, 0, '2026-02-17 16:36:16', '2026-02-22 21:33:01'),
(9, 'Physique-Chimie (PC)', 'Théorique', 1, 0, 0, '2026-02-17 16:37:18', '2026-02-17 16:37:18'),
(10, 'Philosophie', 'Théorique', 1, 0, 0, '2026-02-18 12:37:19', '2026-02-18 12:37:19'),
(11, 'Education Civique et Moral (ECM)', 'Théorique', 1, 0, 0, '2026-02-22 21:33:38', '2026-02-22 21:33:38'),
(12, 'Education Physique et Sportive (EPS)', 'Pratique', 1, 0, 0, '2026-02-22 21:34:15', '2026-02-22 21:34:15'),
(13, 'Anglais', 'Théorique', 1, 0, 0, '2026-02-22 21:34:38', '2026-02-22 21:34:38'),
(14, 'Espagnol', 'Théorique', 1, 0, 0, '2026-02-22 21:34:53', '2026-02-22 21:34:53'),
(15, 'Allemand', 'Théorique', 1, 0, 0, '2026-02-22 21:35:07', '2026-02-22 21:35:07'),
(16, 'Musique', 'Pratique', 1, 0, 0, '2026-02-22 21:35:35', '2026-02-22 21:35:35'),
(17, 'Art Plastique', 'Pratique', 1, 0, 0, '2026-02-22 21:35:49', '2026-02-22 21:35:49');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `parent_id` int DEFAULT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admission_number` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `roll_number` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `class_id` int DEFAULT NULL,
  `gender` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `caste` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `religion` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_number` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `marital_status` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admission_date` date DEFAULT NULL,
  `profile_pic` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `blood_group` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `heigth` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `weigth` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `occupation` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permanent_address` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qualification` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `work_experience` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_type` tinyint NOT NULL DEFAULT '3' COMMENT '1:adminn, 2:teacher, 3:student, 4:parent',
  `is_delete` tinyint NOT NULL DEFAULT '0' COMMENT '0:Pas Supprimé, 1:Supprimé',
  `status` tinyint DEFAULT '0' COMMENT '0:actif, 1:inactif',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=66 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `parent_id`, `name`, `last_name`, `email`, `email_verified_at`, `password`, `remember_token`, `admission_number`, `roll_number`, `class_id`, `gender`, `date_of_birth`, `caste`, `religion`, `mobile_number`, `marital_status`, `admission_date`, `profile_pic`, `blood_group`, `heigth`, `weigth`, `occupation`, `address`, `permanent_address`, `qualification`, `work_experience`, `note`, `user_type`, `is_delete`, `status`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Admin MEMEL', NULL, 'admin@gmail.com', NULL, '$2y$10$hxix8x332Cz1d/gMZ1jh/OvEGa7JWet5wiXU9l6Iw2K5GJoFQQGCO', 'aEDIvKNJfQJIiqw3ePiFWOvl1EubD2gbC1lQZ4LicLIvklNu7ojdbw5rxPxP', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0757733168', NULL, NULL, '20260302113143fvarjkciycll731di644.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 1, 0, 0, '2026-02-02 12:09:53', '2026-03-02 11:31:43'),
(48, NULL, 'FOFIE', 'Norbert', 'memelakpajoel2050@gmail.com', NULL, '$2y$10$uvKLgiaF8gtnYEaI7rLfGOioILdKmLoenuyJNjB2xRpP5OIRjG3AG', NULL, NULL, NULL, NULL, 'Male', NULL, NULL, NULL, '0505018036', NULL, NULL, '20260420072800n5g25t29n8e4kcrp2p88.jpg', NULL, NULL, NULL, 'Ingenieur', 'ABIDJAN', NULL, NULL, NULL, NULL, 4, 0, 0, '2026-03-30 14:40:29', '2026-08-19 10:04:22'),
(46, NULL, 'KOFFI', 'Blanche', 'koffiange@gmail.com', NULL, '$2y$10$5v/Xw3b1Y9jAwWylNfQnCeQYV16P7.wm5Vn89zPs6hzNnndlMphaG', NULL, '2', 'MBY-123542', 31, 'Femelle', '2014-01-02', 'poofb', 'Boudhiste', '123645542', NULL, '2023-07-02', '20260420072945yplz3u5ane8ffma9sclw.jpg', 'B', '1M40', '40 KG', NULL, NULL, NULL, NULL, NULL, NULL, 3, 0, 0, '2026-03-30 14:34:08', '2026-08-18 06:36:09'),
(47, 49, 'FOFIE', 'Alexandre', 'fofieange@gmail.com', NULL, '$2y$10$RdBybSJIxvgHwQpWPoCKBuTZFM9k1pIct2IHrAyR.rwdUosTIiom2', NULL, '3', 'MBY-123454', 2, 'Femelle', '2015-12-12', 'poofb', 'Chretien', '12364554', NULL, '2023-03-01', '20260420072918xubqefsx3v8vegbaumhg.jpg', 'AB', '1M65', '100KG', NULL, NULL, NULL, NULL, NULL, NULL, 3, 0, 0, '2026-03-30 14:39:19', '2026-07-11 23:19:18'),
(38, NULL, 'OURA Max Joel', NULL, 'ouramaxjoel@gmail.com', NULL, '$2y$10$2DLs8rXmWOkvtf2p8gcfDeEIjsjGb4m6XF9ZjIZnl/C.O9BmcC6X6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '20260316094725ht3qyi1aqp0irsokenx7.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, '2026-03-16 09:47:26', '2026-03-16 09:47:26'),
(42, NULL, 'BEKOIN', 'Raoul', 'bekoinraoul@gmail.com', NULL, '$2y$10$MUXVyWaNSLVV44kWJetSMuF2AuO2VzyW0OvCp3JcgjXLXKcsz3J0W', NULL, NULL, NULL, NULL, 'Male', '1966-12-12', NULL, NULL, '0505018036', 'Celibataire', '2010-05-05', '20260420072609ptx42dc83b3jgmnw3yah.png', NULL, NULL, NULL, NULL, 'ABIDJAN', 'Anyama, ancien Gendarmerie', 'Professeur Lycée', 'Master 1', '15', 2, 0, 0, '2026-03-30 14:15:21', '2026-04-26 21:55:24'),
(43, NULL, 'LONGUET', 'Kader', 'longuetkader@gmail.com', NULL, '$2y$10$4ROWl9Pu1IGAnOZUG2YUXOgNzTT1oVYcXyMQmU4G.LGxgFEoPgRe2', NULL, NULL, NULL, NULL, 'Male', '1985-05-10', NULL, NULL, '0505018036', 'Celibataire', '2016-06-15', '20260420072551zz7lawlhpvmhro8fugdo.png', NULL, NULL, NULL, NULL, 'ABIDJAN', 'Cocody, Angré 8ème tranche', 'Professeur Collège', 'Licence', '14', 2, 0, 0, '2026-03-30 14:19:43', '2026-04-26 21:55:14'),
(44, NULL, 'KATTA', 'Marie Ange', 'marieangekatta@gmail.com', NULL, '$2y$10$ZvPpbmEW03UF2BIzxmrL2eEfsJpKmZC4T2padTmndxKdSZlTcYLgi', NULL, NULL, NULL, NULL, 'Femelle', '2000-06-15', NULL, NULL, '55652552', 'Marié', '2021-01-05', '20260420072536ofzaajt9bvp0m3mhtt7s.png', NULL, NULL, NULL, NULL, 'ABIDJAN', 'Yopougon, Ananeraire', 'Professeur de Collège', 'Licence', '15', 2, 0, 0, '2026-03-30 14:22:18', '2026-04-26 21:55:03'),
(45, 50, 'OUATTARA', 'Zana', 'ouattarazana@gmail.com', NULL, '$2y$10$qLLN1RanVl4FE/AUE9NNP.K0Zs82Af0zNdR.pjxkdHmzGXQ3EBTvW', NULL, '1', 'MBY-123456', 31, 'Male', '2010-05-12', 'poofb', 'Chretien', '123645', NULL, '2022-05-07', '20260420073006mcayrtn7nrtoqodefsip.jpg', 'A', '1M65', '50 KG', NULL, NULL, NULL, NULL, NULL, NULL, 3, 0, 0, '2026-03-30 14:29:50', '2026-04-20 07:30:06'),
(49, NULL, 'BAKAYOKO', 'Hamed', 'bakayokohamed@gmail.com', NULL, '$2y$10$sIdiBB0UiQbhyxvxsR03SuYn9zsL4eQ0rjjENWyumfS3tuOK15KF.', NULL, NULL, NULL, NULL, 'Male', NULL, NULL, NULL, '0505018036', NULL, NULL, '20260420072745ghllbgbkdd3dqnhewai9.jpg', NULL, NULL, NULL, 'Censeur', 'ABIDJAN', NULL, NULL, NULL, NULL, 4, 0, 0, '2026-03-30 14:42:50', '2026-04-20 07:27:45'),
(50, NULL, 'OUATTARA', 'Adama', 'ouattaraadama@gmail.com', NULL, '$2y$10$NAsK8ePg/7S.8Pu1klkiNOdQZEJF53Xl8KkHiIrDyuFde20LK5.wS', NULL, NULL, NULL, NULL, 'Male', NULL, NULL, NULL, '55652552658', NULL, NULL, '20260420072732jsc81hhmpr0kbasmvg5h.jpg', NULL, NULL, NULL, 'Ingenieur', 'ABIDJAN', NULL, NULL, NULL, NULL, 4, 0, 0, '2026-03-30 14:44:06', '2026-04-20 07:27:32'),
(51, NULL, 'KOFFI', 'Charlène', 'kofficharlene@gmail.com', NULL, '$2y$10$YWIbNmpXNWBREBWbJLtVSuBWis5G91lw0UpkDsJkWSpnrGa4VgxYW', NULL, NULL, NULL, NULL, 'Femelle', NULL, NULL, NULL, '123645656', NULL, NULL, '20260420072714bkngtlwszjmmaymzaw3o.jpg', NULL, NULL, NULL, 'Diplomate', 'ABIDJAN', NULL, NULL, NULL, NULL, 4, 0, 0, '2026-03-30 14:46:30', '2026-04-20 07:27:14'),
(55, 48, 'Regan', 'Webb Galloway', 'tecevic475@luhupo.com', NULL, '$2y$10$JRl9WwcvMYAJcUaJ6BVBkOCEdTwLmnFWk8eJ2ut2des5LEF3dXC8G', NULL, '559', '571', 28, 'Male', '1999-11-18', 'sivax@mailinator.com', 'socayi2663@luhupo.com', '+23302547896', NULL, '1980-11-07', '20260624030339y7ib1vvfkgq5hreqd3qe.jpeg', 'A+', 'gyju@maili', 'mehoqo@mai', NULL, NULL, NULL, NULL, NULL, NULL, 3, 0, 0, '2026-06-24 15:03:39', '2026-08-19 11:36:44'),
(54, NULL, 'GNAMA Loah Daniel', NULL, 'gnamaloahdaniel@gmail.com', NULL, '$2y$10$E.8f2ozBeO7paERrcByjUudv3gJx.VjshB.vTVBwgoCUg5Uu5jDWG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '078893764', NULL, NULL, '20260427084732orz1vmmwmayfrwh1pdg8.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, '2026-04-27 08:47:32', '2026-04-27 08:47:32'),
(56, 48, 'Lisandra', 'Collins Ramsey', 'lisandraramseycollins@gmailcom', NULL, '$2y$10$hxix8x332Cz1d/gMZ1jh/OvEGa7JWet5wiXU9l6Iw2K5GJoFQQGCO', NULL, '387', '3', 28, 'Femelle', '1974-02-17', 'hyhav@mailinator.com', 'Boudhiste', '+22556987456', NULL, '1996-08-02', '202608090408013tj5hew3rrrqtmbll8vj.png', 'AB', '1M40', '65Kg', NULL, NULL, NULL, NULL, NULL, NULL, 3, 0, 0, '2026-06-24 15:41:14', '2026-08-13 09:00:28'),
(58, NULL, 'Marvin Ratliff', 'Kelley', 'celec@mailinator.com', NULL, '$2y$10$DF4CIR2iflr2rxlP/td1muHmKqREY5M8NGio1mxEktgpowQPg1Ijm', NULL, NULL, NULL, NULL, 'Autre', '1996-06-30', NULL, NULL, 'qozipi@mailinator.com', 'rehypim@mailinator.com', '1982-01-13', '20260729064427btzjezxl8o8hjxvofln3.jpg', NULL, NULL, NULL, NULL, 'Sapiente enim in id', 'Dolor nostrum debiti', 'Consequatur Nam tota', 'Enim beatae debitis', 'Enim et veniam dolo', 2, 0, 1, '2026-07-23 20:21:32', '2026-07-29 06:44:27'),
(59, NULL, 'Nadine Rodriguez', 'Little', 'taqo@mailinator.com', NULL, '$2y$10$pay8tnKXA8XDULCRiU0X2.mh3Rsc0R/fGgP4ard6y5gavJ5Wf88IW', NULL, NULL, NULL, NULL, 'Male', '2000-05-03', NULL, NULL, '52333333', 'celibatire', '2008-03-20', '20260813073454t1zjzru6ggvvb09taa3z.jpg', NULL, NULL, NULL, NULL, 'Esse aut incididunt', 'Nam tempor quo delec', 'Iusto consequuntur e', 'Aut est deleniti non', 'Professeur excellent', 2, 1, 0, '2026-08-13 19:34:54', '2026-08-13 19:42:00'),
(60, 61, 'Quon Finch', 'Duncan', 'gefohu@mailinator.com', NULL, '$2y$10$zMsT0uXpKhzS701OiHqvt.VogJQJuLLxhAk2/Wxl/3EmiYOvBzr9i', NULL, '510', '172', 35, 'Autre', '1979-07-16', 'wynetulop@mailinator.com', 'zitemejy@mailinator.com', 'rytaponuja@mailinator.com', NULL, '2003-08-03', '20260813073602w4a4ztn6vhq0kkihn63y.jpg', 'cebexy@mai', 'worujivyti', 'meboq@mail', NULL, NULL, NULL, NULL, NULL, NULL, 3, 1, 0, '2026-08-13 19:36:02', '2026-08-13 19:41:55'),
(61, NULL, 'Bethany Duran', 'Rich', 'syzyset@mailinator.com', NULL, '$2y$10$WH0VB9i6rblOApzLagyDKeXS5XlRHsSSLGT71BQ0IVSQYuwDvZK86', NULL, NULL, NULL, NULL, 'Male', NULL, NULL, NULL, 'pojexole@mailinator.com', NULL, NULL, '20260813073617lhjpzw6b8yw2n6bnngfx.jpg', NULL, NULL, NULL, 'nusaj@mailinator.com', 'wacaf@mailinator.com', NULL, NULL, NULL, NULL, 4, 1, 1, '2026-08-13 19:36:17', '2026-08-13 19:42:25'),
(65, NULL, 'KOUDOUSs', NULL, 'memelakpaxjoel2050@gmail.com', NULL, '$2y$10$PbJT9XTijgIlRYthLZgKAeTO1O8/Fmvf9F39pl3eN7YcKsRaJyF26', 'Lv5QqG0qXuBuy0GJNGw14PFzaydmr7', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, '20260815035415xden9m3piejjw0zlzqvi.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, '2026-08-15 15:54:15', '2026-08-19 10:04:08');

-- --------------------------------------------------------

--
-- Structure de la table `week`
--

DROP TABLE IF EXISTS `week`;
CREATE TABLE IF NOT EXISTS `week` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `fullcalendar_day` int NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `week`
--

INSERT INTO `week` (`id`, `name`, `fullcalendar_day`, `created_at`, `updated_at`) VALUES
(1, 'Lundi', 1, NULL, NULL),
(2, 'Mardi', 2, NULL, NULL),
(3, 'Mercredi', 3, NULL, NULL),
(4, 'Jeudi', 4, NULL, NULL),
(5, 'Vendredi', 5, NULL, NULL),
(6, 'Samedi', 6, NULL, NULL),
(7, 'Dimache', 7, NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
