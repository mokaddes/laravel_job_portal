-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 05, 2022 at 07:17 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web`
--

-- --------------------------------------------------------

--
-- Table structure for table `covideffects`
--

CREATE TABLE `covideffects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `on_behalf` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `on_behalf_relation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `recipient_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `age` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profession` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vaccine_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vaccine_location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vaccine_batch` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `complaints` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `symptoms` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `covid_side_effects`
--

CREATE TABLE `covid_side_effects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `oder_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `covid_side_effects`
--

INSERT INTO `covid_side_effects` (`id`, `name`, `oder_by`, `created_at`, `updated_at`) VALUES
(1, 'Pengsan', NULL, NULL, NULL),
(2, 'Sakit kepala/gelap mata/kepala berpusing', NULL, NULL, NULL),
(3, 'Strok', NULL, NULL, NULL),
(4, 'Masalah penglihatan', NULL, NULL, NULL),
(5, 'Masalah pendengaran', NULL, '2022-02-05 16:39:15', '2022-02-05 16:39:15'),
(6, 'Sawan', NULL, '2022-02-05 16:39:15', '2022-02-05 16:39:15'),
(7, 'Bells palsy (otot muka)', NULL, '2022-02-05 17:24:34', '2022-02-05 17:24:34'),
(8, 'Lumpuh', NULL, '2022-02-05 17:24:34', '2022-02-05 17:24:34'),
(9, 'Sesak nafas', NULL, '2022-02-05 17:24:34', '2022-02-05 17:24:34'),
(10, 'Jantung berdebar laju', NULL, '2022-02-05 17:24:34', '2022-02-05 17:24:34'),
(11, 'Masalah jantung', NULL, '2022-02-05 17:24:34', '2022-02-05 17:24:34'),
(12, 'Darah tinggi', NULL, '2022-02-05 17:24:34', '2022-02-05 17:24:34'),
(13, 'Masalah kulit / gatal', NULL, '2022-02-05 17:24:34', '2022-02-05 17:24:34'),
(14, 'Alahan (allergy)', NULL, '2022-02-05 17:24:34', '2022-02-05 17:24:34'),
(15, 'Kepenatan teruk', NULL, '2022-02-05 17:24:34', '2022-02-05 17:24:34'),
(16, 'Anggota badan lemah / sakit / kejang / kebas', NULL, '2022-02-05 17:24:34', '2022-02-05 17:24:34'),
(17, 'Masalah untuk berjalan / berdiri', NULL, '2022-02-05 17:24:34', '2022-02-05 17:24:34'),
(18, 'Mati pucuk', NULL, '2022-02-05 17:24:34', '2022-02-05 17:24:34'),
(19, 'Masalah haidh', NULL, '2022-02-05 17:24:34', '2022-02-05 17:24:34'),
(20, 'Keguguran kandungan', NULL, '2022-02-05 17:24:34', '2022-02-05 17:24:34'),
(21, 'Masalah haidh', NULL, '2022-02-05 17:24:34', '2022-02-05 17:24:34'),
(22, 'Keguguran kandungan', NULL, '2022-02-05 17:24:34', '2022-02-05 17:24:34'),
(23, 'Disahkan positif COVID-19', NULL, '2022-02-05 17:24:34', '2022-02-05 17:24:34'),
(24, 'Pendarahan daripada rongga badan', NULL, '2022-02-05 17:24:34', '2022-02-05 17:24:34'),
(25, 'Kematian', NULL, '2022-02-05 17:24:34', '2022-02-05 17:24:34'),
(26, 'Muntah', NULL, '2022-02-05 17:24:34', '2022-02-05 17:24:34'),
(27, 'Cirit-birit', NULL, '2022-02-05 17:24:34', '2022-02-05 17:24:34'),
(28, 'Nanah (abcess) pada tubuh/anggota', NULL, '2022-02-05 17:24:34', '2022-02-05 17:24:34'),
(29, 'Sakit dada (paru-paru)', NULL, '2022-02-05 17:24:34', '2022-02-05 17:24:34'),
(30, 'Sakit dada (bahagian jantung)', NULL, '2022-02-05 17:24:34', '2022-02-05 17:24:34'),
(31, 'Kanser', NULL, '2022-02-05 17:24:34', '2022-02-05 17:24:34'),
(32, 'Reflux acid perut (GERD)', NULL, '2022-02-05 17:24:34', '2022-02-05 17:24:34'),
(33, 'Gastrik', NULL, '2022-02-05 17:24:34', '2022-02-05 17:24:34'),
(34, 'Demam', NULL, '2022-02-05 17:24:34', '2022-02-05 17:24:34'),
(35, 'Batuk', NULL, '2022-02-05 17:24:34', '2022-02-05 17:24:34'),
(36, 'Selesema', NULL, '2022-02-05 17:24:34', '2022-02-05 17:24:34'),
(37, 'Hilang deria rasa/bau', NULL, '2022-02-05 17:24:34', '2022-02-05 17:24:34'),
(38, 'Gangguan emosi (anxiety, marah etc)', NULL, '2022-02-05 17:24:34', '2022-02-05 17:24:34'),
(39, 'Ulser', NULL, '2022-02-05 17:24:34', '2022-02-05 17:24:34'),
(40, 'Muncul masalah kencing manis (gula tinggi)', NULL, '2022-02-05 17:24:34', '2022-02-05 17:24:34'),
(41, 'Mata makin kabur', NULL, '2022-02-05 17:24:34', '2022-02-05 17:24:34'),
(42, 'Buta', NULL, '2022-02-05 17:24:34', '2022-02-05 17:24:34'),
(43, 'Pendarahan ketika hamil', NULL, '2022-02-05 17:24:34', '2022-02-05 17:24:34'),
(44, 'Gout', NULL, '2022-02-05 17:24:34', '2022-02-05 17:24:34'),
(45, 'Batuk berpanjangan', NULL, '2022-02-05 17:24:34', '2022-02-05 17:24:34'),
(46, 'Kayap (shingles)', NULL, '2022-02-05 17:24:34', '2022-02-05 17:24:34'),
(47, 'Masalah tidur (insomnia)', NULL, '2022-02-05 17:24:34', '2022-02-05 17:24:34'),
(48, 'Anaphylactic shock', NULL, '2022-02-05 17:24:34', '2022-02-05 17:24:34'),
(49, 'Ketumbuhan baru/membesar (fibroid, ketulan, etc)', NULL, '2022-02-05 17:24:34', '2022-02-05 17:24:34'),
(50, 'Darah beku', NULL, '2022-02-05 17:24:34', '2022-02-05 17:24:34'),
(51, 'Pendarahan dari rahim (tidak hamil)', NULL, '2022-02-05 17:24:34', '2022-02-05 17:24:34'),
(52, 'Radang jantung (myocarditis/pericarditis)', NULL, '2022-02-05 17:24:34', '2022-02-05 17:24:34'),
(53, 'Athma', NULL, '2022-02-05 17:24:34', '2022-02-05 17:24:34'),
(54, 'Keguguran rambut teruk', NULL, '2022-02-05 17:24:34', '2022-02-05 17:24:34'),
(55, 'Masalah hati', NULL, '2022-02-05 17:24:34', '2022-02-05 17:24:34'),
(56, 'Masalah buah pinggang', NULL, '2022-02-05 17:24:34', '2022-02-05 17:24:34'),
(57, 'Jangkitan dalam darah', NULL, '2022-02-05 17:24:34', '2022-02-05 17:24:34'),
(58, 'Heart attack (serangan jantung)', NULL, '2022-02-05 17:24:34', '2022-02-05 17:24:34'),
(59, 'Masalah berkaitan saraf', NULL, '2022-02-05 17:24:34', '2022-02-05 17:24:34'),
(60, 'Radang paru-paru (pneumonia)', NULL, '2022-02-05 17:24:34', '2022-02-05 17:24:34');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
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
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(9, '2014_10_12_000000_create_users_table', 1),
(10, '2014_10_12_100000_create_password_resets_table', 1),
(11, '2019_08_19_000000_create_failed_jobs_table', 1),
(12, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(17, '2022_02_05_152947_create_covideffects_table', 2),
(18, '2022_02_05_162656_create_covid_side_effects_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
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
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Admin = 1\r\nDoctor = 2\r\nPatient = 3',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `role`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@admin.com', NULL, '1', '$2y$10$Qrc3S6MFXNYw7/ZwqTQ2Ue7nvPM2KO/MCqEYZhIsCZx4PRnmdarBe', NULL, '2022-02-05 06:39:31', '2022-02-05 06:39:31'),
(4, 'Doctor', 'doctor@doctor.com', NULL, '2', '$2y$10$Wl5cw8.KeQ332MIb4oCXPuWWpGKmmOarBnttyXxQ71waM.G1O0qiu', NULL, '2022-02-05 11:35:40', '2022-02-05 11:35:40'),
(5, 'Patient', 'patient@patient.com', NULL, '3', '$2y$10$94KA9zPXJP7n/LhZg2ASbe39TMgBbVDAGPL2JNjAQj6z.dG3OfWjG', NULL, '2022-02-05 11:37:42', '2022-02-05 11:37:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `covideffects`
--
ALTER TABLE `covideffects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `covideffects_user_id_foreign` (`user_id`);

--
-- Indexes for table `covid_side_effects`
--
ALTER TABLE `covid_side_effects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

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
-- AUTO_INCREMENT for table `covideffects`
--
ALTER TABLE `covideffects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `covid_side_effects`
--
ALTER TABLE `covid_side_effects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `covideffects`
--
ALTER TABLE `covideffects`
  ADD CONSTRAINT `covideffects_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
