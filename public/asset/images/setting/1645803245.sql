-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 07, 2022 at 04:29 AM
-- Server version: 5.7.31
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `covid_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `covideffects`
--

DROP TABLE IF EXISTS `covideffects`;
CREATE TABLE IF NOT EXISTS `covideffects` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(10) DEFAULT NULL,
  `covid_side_effect_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'comma separated ids',
  `on_behalf` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `on_behalf_relation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `recipient_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `age` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profession` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vaccine_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `complaints` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vaccine_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vaccine_location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vaccine_batch` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `symptoms` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `other_effect` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `affect_quality` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hospitalized` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ward_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hospitalized_duration` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hospital_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `effect_duration` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `present_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `previous_disease` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `diagnosis` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `effect_confirm` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `report` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `npra` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comments` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `covideffects`
--

INSERT INTO `covideffects` (`id`, `user_id`, `covid_side_effect_id`, `on_behalf`, `on_behalf_relation`, `recipient_name`, `age`, `gender`, `profession`, `nation`, `vaccine_type`, `complaints`, `vaccine_date`, `vaccine_location`, `vaccine_batch`, `symptoms`, `other_effect`, `affect_quality`, `hospitalized`, `ward_type`, `hospitalized_duration`, `hospital_name`, `effect_duration`, `present_status`, `previous_disease`, `diagnosis`, `effect_confirm`, `report`, `npra`, `contact`, `comments`, `file`, `created_at`, `updated_at`) VALUES
(1, NULL, '1', 'Diri Sendiri', 'Anak', 'ghgfh', '11', 'Lelaki', 'Awam', 'Awam', 'Awam', 'Awam', '2022-02-25', 'gfhfg', 'ghfh', 'Awam', NULL, 'Diri Sendiri', 'Diri Sendiri', 'Diri Sendiri', 'Diri Sendiri', NULL, 'Diri Sendiri', 'Diri Sendiri', NULL, NULL, 'Diri Sendiri', 'Diri Sendiri', 'Diri Sendiri', NULL, NULL, NULL, '2022-02-06 07:45:08', '2022-02-06 07:45:08'),
(2, NULL, '1', 'Diri Sendiri', 'Anak', 'dfd', '11', 'Lelaki', 'Awam', 'Awam', 'Awam', 'Awam', '2022-02-02', 'dfds', 'dsfsd', 'Awam', NULL, 'Diri Sendiri', 'Diri Sendiri', 'Diri Sendiri', 'Diri Sendiri', NULL, 'Diri Sendiri', 'Diri Sendiri', NULL, NULL, 'Diri Sendiri', 'Diri Sendiri', 'Diri Sendiri', NULL, NULL, NULL, '2022-02-06 08:08:32', '2022-02-06 08:08:32'),
(3, NULL, '1, 2, 39', 'Diri Sendiri', 'Anak', '2Ho3nio9Xu', '11', 'Lelaki', 'Awam', 'Awam', 'Awam', 'Awam', NULL, 'Uk2nantb35', '9a9VW2qcgq', 'Awam', '5hO2AjPKlC', 'Diri Sendiri', 'Diri Sendiri', 'Diri Sendiri', 'Diri Sendiri', 'aBKIzCvHcb', 'Diri Sendiri', 'Diri Sendiri', NULL, '97bpiaaHjY', 'Diri Sendiri', 'Diri Sendiri', 'Diri Sendiri', '3569949404', 'R9a4KrRx1B', NULL, '2022-02-06 11:11:08', '2022-02-06 11:11:08'),
(4, NULL, '1, 3, 4', 'Diri Sendiri', 'Anak', 'UwBcv5EdZE', '11', 'Lelaki', 'Awam', 'Awam', 'Awam', 'Awam', NULL, 'EreWOo5o4j', 'cBKelIdykI', 'Awam', 'ukhwHgR3qT', 'Diri Sendiri', 'Diri Sendiri', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-02-06 12:50:02', '2022-02-06 12:50:02'),
(5, NULL, NULL, 'Diri Sendiri', 'Anak', '9hciCW9IYK', '11', 'Lelaki', 'Awam', 'Awam', 'Awam', 'Awam', NULL, 'zFwa8q2uya', 'Z6qBmsoTa3', 'Awam', 'kBEb2nMdzo', 'Diri Sendiri', 'Diri Sendiri', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-02-06 12:52:58', '2022-02-06 12:52:58'),
(6, 13, NULL, 'Diri Sendiri', 'Anak', 'ZHyXQJRbZj', '11', 'Lelaki', 'Awam', 'Awam', 'Awam', 'Awam', NULL, 'U4fBxwTaCB', 'jx79NEPqqd', 'Awam', 'mOhIxgCDro', 'Diri Sendiri', 'Diri Sendiri', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 14, '21, 23', 'Diri Sendiri', 'Anak', 'EIlHPghhHi', '11', 'Lelaki', 'Awam', 'Awam', 'Awam', 'Awam', NULL, 'XXHjuLigHp', 'Ijna5QVzlk', 'Awam', '85NUniONoq', 'Diri Sendiri', 'Diri Sendiri', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `covid_side_effects`
--

DROP TABLE IF EXISTS `covid_side_effects`;
CREATE TABLE IF NOT EXISTS `covid_side_effects` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `oder_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `covid_side_effects`
--

INSERT INTO `covid_side_effects` (`id`, `name`, `oder_by`, `created_at`, `updated_at`) VALUES
(1, 'Pengsan', NULL, NULL, NULL),
(2, 'Sakit kepala/gelap mata/kepala berpusing', NULL, NULL, NULL),
(3, 'Strok', NULL, NULL, NULL),
(4, 'Masalah penglihatan', NULL, NULL, NULL),
(5, 'Masalah pendengaran', NULL, '2022-02-05 10:39:15', '2022-02-05 10:39:15'),
(6, 'Sawan', NULL, '2022-02-05 10:39:15', '2022-02-05 10:39:15'),
(7, 'Bells palsy (otot muka)', NULL, '2022-02-05 11:24:34', '2022-02-05 11:24:34'),
(8, 'Lumpuh', NULL, '2022-02-05 11:24:34', '2022-02-05 11:24:34'),
(9, 'Sesak nafas', NULL, '2022-02-05 11:24:34', '2022-02-05 11:24:34'),
(10, 'Jantung berdebar laju', NULL, '2022-02-05 11:24:34', '2022-02-05 11:24:34'),
(11, 'Masalah jantung', NULL, '2022-02-05 11:24:34', '2022-02-05 11:24:34'),
(12, 'Darah tinggi', NULL, '2022-02-05 11:24:34', '2022-02-05 11:24:34'),
(13, 'Masalah kulit / gatal', NULL, '2022-02-05 11:24:34', '2022-02-05 11:24:34'),
(14, 'Alahan (allergy)', NULL, '2022-02-05 11:24:34', '2022-02-05 11:24:34'),
(15, 'Kepenatan teruk', NULL, '2022-02-05 11:24:34', '2022-02-05 11:24:34'),
(16, 'Anggota badan lemah / sakit / kejang / kebas', NULL, '2022-02-05 11:24:34', '2022-02-05 11:24:34'),
(17, 'Masalah untuk berjalan / berdiri', NULL, '2022-02-05 11:24:34', '2022-02-05 11:24:34'),
(18, 'Mati pucuk', NULL, '2022-02-05 11:24:34', '2022-02-05 11:24:34'),
(19, 'Masalah haidh', NULL, '2022-02-05 11:24:34', '2022-02-05 11:24:34'),
(20, 'Keguguran kandungan', NULL, '2022-02-05 11:24:34', '2022-02-05 11:24:34'),
(21, 'Masalah haidh', NULL, '2022-02-05 11:24:34', '2022-02-05 11:24:34'),
(22, 'Keguguran kandungan', NULL, '2022-02-05 11:24:34', '2022-02-05 11:24:34'),
(23, 'Disahkan positif COVID-19', NULL, '2022-02-05 11:24:34', '2022-02-05 11:24:34'),
(24, 'Pendarahan daripada rongga badan', NULL, '2022-02-05 11:24:34', '2022-02-05 11:24:34'),
(25, 'Kematian', NULL, '2022-02-05 11:24:34', '2022-02-05 11:24:34'),
(26, 'Muntah', NULL, '2022-02-05 11:24:34', '2022-02-05 11:24:34'),
(27, 'Cirit-birit', NULL, '2022-02-05 11:24:34', '2022-02-05 11:24:34'),
(28, 'Nanah (abcess) pada tubuh/anggota', NULL, '2022-02-05 11:24:34', '2022-02-05 11:24:34'),
(29, 'Sakit dada (paru-paru)', NULL, '2022-02-05 11:24:34', '2022-02-05 11:24:34'),
(30, 'Sakit dada (bahagian jantung)', NULL, '2022-02-05 11:24:34', '2022-02-05 11:24:34'),
(31, 'Kanser', NULL, '2022-02-05 11:24:34', '2022-02-05 11:24:34'),
(32, 'Reflux acid perut (GERD)', NULL, '2022-02-05 11:24:34', '2022-02-05 11:24:34'),
(33, 'Gastrik', NULL, '2022-02-05 11:24:34', '2022-02-05 11:24:34'),
(34, 'Demam', NULL, '2022-02-05 11:24:34', '2022-02-05 11:24:34'),
(35, 'Batuk', NULL, '2022-02-05 11:24:34', '2022-02-05 11:24:34'),
(36, 'Selesema', NULL, '2022-02-05 11:24:34', '2022-02-05 11:24:34'),
(37, 'Hilang deria rasa/bau', NULL, '2022-02-05 11:24:34', '2022-02-05 11:24:34'),
(38, 'Gangguan emosi (anxiety, marah etc)', NULL, '2022-02-05 11:24:34', '2022-02-05 11:24:34'),
(39, 'Ulser', NULL, '2022-02-05 11:24:34', '2022-02-05 11:24:34'),
(40, 'Muncul masalah kencing manis (gula tinggi)', NULL, '2022-02-05 11:24:34', '2022-02-05 11:24:34'),
(41, 'Mata makin kabur', NULL, '2022-02-05 11:24:34', '2022-02-05 11:24:34'),
(42, 'Buta', NULL, '2022-02-05 11:24:34', '2022-02-05 11:24:34'),
(43, 'Pendarahan ketika hamil', NULL, '2022-02-05 11:24:34', '2022-02-05 11:24:34'),
(44, 'Gout', NULL, '2022-02-05 11:24:34', '2022-02-05 11:24:34'),
(45, 'Batuk berpanjangan', NULL, '2022-02-05 11:24:34', '2022-02-05 11:24:34'),
(46, 'Kayap (shingles)', NULL, '2022-02-05 11:24:34', '2022-02-05 11:24:34'),
(47, 'Masalah tidur (insomnia)', NULL, '2022-02-05 11:24:34', '2022-02-05 11:24:34'),
(48, 'Anaphylactic shock', NULL, '2022-02-05 11:24:34', '2022-02-05 11:24:34'),
(49, 'Ketumbuhan baru/membesar (fibroid, ketulan, etc)', NULL, '2022-02-05 11:24:34', '2022-02-05 11:24:34'),
(50, 'Darah beku', NULL, '2022-02-05 11:24:34', '2022-02-05 11:24:34'),
(51, 'Pendarahan dari rahim (tidak hamil)', NULL, '2022-02-05 11:24:34', '2022-02-05 11:24:34'),
(52, 'Radang jantung (myocarditis/pericarditis)', NULL, '2022-02-05 11:24:34', '2022-02-05 11:24:34'),
(53, 'Athma', NULL, '2022-02-05 11:24:34', '2022-02-05 11:24:34'),
(54, 'Keguguran rambut teruk', NULL, '2022-02-05 11:24:34', '2022-02-05 11:24:34'),
(55, 'Masalah hati', NULL, '2022-02-05 11:24:34', '2022-02-05 11:24:34'),
(56, 'Masalah buah pinggang', NULL, '2022-02-05 11:24:34', '2022-02-05 11:24:34'),
(57, 'Jangkitan dalam darah', NULL, '2022-02-05 11:24:34', '2022-02-05 11:24:34'),
(58, 'Heart attack (serangan jantung)', NULL, '2022-02-05 11:24:34', '2022-02-05 11:24:34'),
(59, 'Masalah berkaitan saraf', NULL, '2022-02-05 11:24:34', '2022-02-05 11:24:34'),
(60, 'Radang paru-paru (pneumonia)', NULL, '2022-02-05 11:24:34', '2022-02-05 11:24:34');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(7, '2014_10_12_000000_create_users_table', 1),
(8, '2014_10_12_100000_create_password_resets_table', 1),
(9, '2019_08_19_000000_create_failed_jobs_table', 1),
(10, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(11, '2022_02_05_162656_create_covid_side_effects_table', 1),
(12, '2022_02_06_111349_create_covideffects_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '1=admin,2=doctor,3=patient ',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password_str` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `role`, `password`, `password_str`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@admin.com', NULL, '1', '$2y$10$KHvIc9MI/JBnJtsmONVRQu2xqThz/8YvKvDdovRqpHWmAi4kNjSzy', NULL, NULL, '2022-02-05 00:39:31', '2022-02-05 00:39:31'),
(2, 'Doctor', 'doctor@doctor.com', NULL, '2', '$2y$10$Wl5cw8.KeQ332MIb4oCXPuWWpGKmmOarBnttyXxQ71waM.G1O0qiu', NULL, NULL, '2022-02-05 05:35:40', '2022-02-05 05:35:40'),
(3, 'Patient', 'patient@patient.com', NULL, '3', '$2y$10$94KA9zPXJP7n/LhZg2ASbe39TMgBbVDAGPL2JNjAQj6z.dG3OfWjG', NULL, NULL, '2022-02-05 05:37:42', '2022-02-05 05:37:42'),
(4, 'ghgfh', 'mkds@mkds.com', NULL, '3', '$2y$10$nx6wo8T6BsRBjvNE46n/U.IEbYROZS63HtK0H.UeOrWkbJxYTMEXG', NULL, NULL, '2022-02-06 07:45:08', '2022-02-06 07:45:08'),
(5, 'dfd', 'mkds@gmail.com', NULL, '3', '$2y$10$uAOra80pKEOtYR7wBb4hpOERQNpjwB6JJBaiiyduvh3gX.Bfhl84W', NULL, NULL, '2022-02-06 08:08:32', '2022-02-06 08:08:32'),
(6, '2Ho3nio9Xu', 'mroi4t8dRN', NULL, '3', '$2y$10$Ves1zAV5J8LVCOdP2gBXQua.BRU3oarW6dyntDNIpCEuG/RZJSqf.', NULL, NULL, '2022-02-06 11:11:08', '2022-02-06 11:11:08'),
(7, '5yG5bZlf71', '6St9sttae6', NULL, '3', '$2y$10$GMoTEjETsSGt2W6.4j9UYO3a2lwl8/8vd3cZp8Z8u.EXG1SoMrPaC', NULL, NULL, NULL, NULL),
(9, 'UwBcv5EdZE', 'zd8jz@ddak.com', NULL, '3', '$2y$10$1e0/se5LRBFU13mzT2X4duFV3aEeBA/nl4MsDDTadm4xqsByYcjFq', NULL, NULL, NULL, NULL),
(10, 'YRsR8spKrf', 'zmy7j@yk0n.com', NULL, '3', '$2y$10$Ur73QHBKsJNorOMDQIczQO8os21NTRLKCBT21LoROJT4AAQYMNZDi', NULL, NULL, NULL, NULL),
(12, '9hciCW9IYK', 'ijpfl@gwke.com', NULL, '3', '$2y$10$96jooCpBvC1kpl5wG3Vvie8YNfCka.7n6O5xWaWHvuPtf8DwLbVV.', NULL, NULL, NULL, NULL),
(13, 'ZHyXQJRbZj', 'gv0h2@qdfx.com', NULL, '3', '$2y$10$sx.iPAiSA2Avl0K/l0w/z.ZN329SjETJiZXjstxQtrLCWPx1WnF6C', NULL, NULL, NULL, NULL),
(14, 'EIlHPghhHi', 'h7qfr@hwwe.com', NULL, '3', '$2y$10$KHvIc9MI/JBnJtsmONVRQu2xqThz/8YvKvDdovRqpHWmAi4kNjSzy', 'F2c9GL0W', NULL, NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
