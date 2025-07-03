-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 12, 2025 at 05:39 PM
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
-- Database: `shopbqgr_performance_dashboard`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `is_admin` int(11) NOT NULL DEFAULT 1,
  `loyality` int(11) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `cnic_number` bigint(20) DEFAULT NULL,
  `cnic_front` varchar(255) DEFAULT NULL,
  `cnic_back` varchar(255) DEFAULT NULL,
  `guardian_name` varchar(255) DEFAULT NULL,
  `guardian_number` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `religion` varchar(255) DEFAULT NULL,
  `role_id` bigint(20) UNSIGNED DEFAULT 3,
  `batch_id` bigint(20) UNSIGNED DEFAULT NULL,
  `joining_date` date DEFAULT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `department_id` bigint(20) UNSIGNED DEFAULT NULL,
  `extra_access` int(11) NOT NULL DEFAULT 0,
  `base_salary` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `contact`, `address`, `email`, `email_verified_at`, `password`, `is_admin`, `loyality`, `remember_token`, `is_active`, `created_at`, `updated_at`, `full_name`, `image`, `cnic_number`, `cnic_front`, `cnic_back`, `guardian_name`, `guardian_number`, `gender`, `religion`, `role_id`, `batch_id`, `joining_date`, `designation`, `status`, `department_id`, `extra_access`, `base_salary`) VALUES
(1, 'admin', NULL, NULL, 'admin@admin.com', NULL, '$2y$10$DGH.673uLg2aRk5iUL0eauZFYX2IfsGt8/DXqS39QQ5uiwsdXkHAy', 1, 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, NULL, 1, 0.00),
(2, 'Vance Henry', '03030325502', 'Karachi', 'kawamity@mailinator.com', NULL, '$2y$10$dqfl.iSMx3zu.FhneHsTSOTSvQCSbMZztFG7FIlknxnnWnJFfvm0y', 1, 0, NULL, 0, NULL, '2025-06-05 19:14:02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, 1, 5, 0, 10000.00),
(3, 'Ahmed', '0320320320', 'Karachi', 'ahmed@gmail.com', NULL, '$2y$10$DGH.673uLg2aRk5iUL0eauZFYX2IfsGt8/DXqS39QQ5uiwsdXkHAy', 1, 0, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, 1, 10, 0, 15000.00),
(4, 'Ashar Khaan', NULL, NULL, 'ashar.khan@thetechrics.com', NULL, '$2y$10$rlCAi5/Nr8r2K6zviKPET.8dG864PLyrt.Bv1w3aUkm4BvIqrgt7i', 1, 0, NULL, 0, '2025-03-20 23:30:51', '2025-06-05 19:21:09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, 1, 2, 1, 0.00),
(5, 'Umair Khalid', NULL, NULL, 'umair.khalid@thetechrics.com', NULL, '$2y$10$HNOVVJAowvefrDYXofq2VuAHfVF/S82rBWDCqaq/LVz1Yjz3Y4Pzq', 1, 0, NULL, 0, '2025-03-24 17:36:16', '2025-03-24 17:36:16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, 1, 4, 0, 0.00),
(6, 'Syed Ahsan Ahmed', NULL, NULL, 'syed.ahsan.ahmed@thetechrics.com', NULL, '$2y$10$MkdF25aK1qr2IL2ig3ecwudFJEDCrJvbFTAhIXfBRRPL3uEfRanKe', 1, 0, NULL, 0, '2025-03-24 17:36:52', '2025-03-24 17:36:52', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, 1, 1, 0, 0.00),
(7, 'Aliyan Ahmed', NULL, NULL, 'aliyan.ahmed@thetechrics.com', NULL, '$2y$10$lgAwz5I03L64hDQO/WUfU.0py74Y/VO7X10gcLq2kRVAyETDWxOka', 1, 0, NULL, 0, '2025-03-24 18:18:33', '2025-03-24 18:20:29', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, 1, 9, 0, 0.00),
(8, 'Mujtaba Yousuf', NULL, NULL, 'mujtaba.yousuf@thetechrics.com', NULL, '$2y$10$RCHsv.psM6eyz3MmJ5HUUeTzibmHOtBBd7PfufTJj4K6fJwqJUrsK', 1, 0, NULL, 0, '2025-03-24 18:21:34', '2025-03-24 18:21:34', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, 1, 10, 0, 0.00),
(9, 'Atta ur Rehman', NULL, NULL, 'atta.rehman@thetechrics.com', NULL, '$2y$10$HbHEwk/YUWB/KYHG/6VFLeaeen3Lsl/0H1LfwCQHPdqk2ttkj81L2', 1, 0, NULL, 0, '2025-03-26 17:22:55', '2025-05-21 09:52:24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, 1, 10, 0, 0.00),
(10, 'Noman Masood', NULL, NULL, 'noman.masood@thetechrics.com', NULL, '$2y$10$FGhjKM6wbRR0m9daVYZFW.H6boNZEhLwfPWoIxBe.X1PycyYPrJjK', 1, 0, NULL, 0, '2025-03-26 17:23:39', '2025-03-26 17:23:39', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, 1, 10, 0, 0.00),
(11, 'CEO', NULL, NULL, 'superadmin@admin.com', NULL, '$2y$10$7eD./UhDebaxpp.4lYsQJe2xhKtC1Z1VuwF6Pu8bKS9b/S7tChcs6', 1, 0, NULL, 0, '2025-03-26 23:08:09', '2025-03-26 23:08:09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, NULL, NULL, 1, 1, 0, 0.00),
(12, 'Mehdi Abbas', NULL, NULL, 'mehdi.abbas@thetechrics.com', NULL, '$2y$10$oW3NBlg5E2vVRIBnmH1bs.811hbNCqbvds5jNF.l5bV0vE6AZ3DT.', 1, 0, NULL, 0, '2025-03-26 23:59:51', '2025-05-14 07:55:13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, 1, 1, 0, 0.00),
(15, 'Salman Mehmood', NULL, NULL, 'salman.mehmood@thetechrics.com', NULL, '$2y$10$o1hgv5feOrVpEaVXZKlbv.JoIJyrXPs9tZBtrtFguAecZtE14L9zy', 1, 0, NULL, 0, '2025-05-13 05:51:40', '2025-05-13 05:51:40', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, 1, 9, 0, 0.00),
(16, 'Zeeshan Mehmood', NULL, NULL, 'zeeshan.mehmood@thetechrics.com', NULL, '$2y$10$4rJw3YbKJawEarjk1PBjXeaqZPWiaw1yJ2LMl7Sluh2i/JJsD3e.u', 1, 0, NULL, 0, '2025-05-13 05:52:12', '2025-05-13 05:52:12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, 1, 10, 0, 0.00),
(17, 'Noushad Ali', NULL, NULL, 'noushad.ali@thetechrics.com', NULL, '$2y$10$ua6mzf.Ydb7Zd03KQBRS.OP.q1XYjzRZ3jxyPeSQPmIFFU6rXMrza', 1, 0, NULL, 0, '2025-05-14 02:02:01', '2025-05-14 02:02:01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, 1, 9, 0, 0.00),
(18, 'Muhammad Arsalan', NULL, NULL, 'muhammad.arsalan@thetechrics.com', NULL, '$2y$10$w19.AyJbeX.GmdQfUQHjue3wVtctDnTZrCjHE7/7mL1.kN77sZFle', 1, 0, NULL, 0, '2025-05-14 02:03:20', '2025-05-14 02:03:20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, 1, 9, 0, 0.00),
(19, 'Anas', NULL, NULL, 'muhammad.anas@thetechrics.com', NULL, '$2y$10$fs8aytabczlner9OWHkraeQwjG94PczdRImIpTA30peKngKNnXdEG', 1, 0, NULL, 0, '2025-05-16 05:27:23', '2025-05-16 05:27:23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, 1, 1, 0, 0.00),
(20, 'Jahanzaib Ahmed', NULL, NULL, 'jahanzaib.ahmed@thetechrics.com', NULL, '$2y$10$oW3NBlg5E2vVRIBnmH1bs.811hbNCqbvds5jNF.l5bV0vE6AZ3DT.', 1, 0, NULL, 0, '2025-03-27 03:59:51', '2025-05-14 11:55:13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, 1, 1, 0, 0.00),
(21, 'Syed Meesam Abbas', NULL, NULL, 'syed.meesamabbas@thetechrics.com', NULL, '$2y$10$oW3NBlg5E2vVRIBnmH1bs.811hbNCqbvds5jNF.l5bV0vE6AZ3DT.', 1, 0, NULL, 0, '2025-03-27 03:59:51', '2025-05-14 11:55:13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, 1, 1, 0, 0.00),
(22, 'Abdullah Hussain Khan', NULL, NULL, 'abdullah.hussainkhan@thetechrics.com', NULL, '$2y$10$oW3NBlg5E2vVRIBnmH1bs.811hbNCqbvds5jNF.l5bV0vE6AZ3DT.', 1, 0, NULL, 0, '2025-03-27 03:59:51', '2025-05-14 11:55:13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, 1, 1, 0, 0.00),
(23, 'Muhammad Munim', NULL, NULL, 'muhammad.munim@thetechrics.com', NULL, '$2y$10$oW3NBlg5E2vVRIBnmH1bs.811hbNCqbvds5jNF.l5bV0vE6AZ3DT.', 1, 0, NULL, 0, '2025-03-27 03:59:51', '2025-05-14 11:55:13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, 1, 1, 0, 0.00),
(24, 'Arqam Shaikh', NULL, NULL, 'arqam.shaikh@thetechrics.com', NULL, '$2y$10$QxAQJvJEeQw5LC0mEQgipeTv90Qpf.ve4zIefykm8tHaTbLzZu3ai', 1, 0, NULL, 0, '2025-05-17 01:18:50', '2025-05-17 01:18:50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, 1, 6, 0, 0.00),
(25, 'Behroz', NULL, NULL, 'behroz@thetechrics.com', NULL, '$2y$10$jBrexr/suplFWobXceVXX.PigN1MvzGulwYZ6qdTOrK5xfEaLTW06', 1, 0, NULL, 0, '2025-05-17 01:21:35', '2025-05-17 01:21:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, 1, 8, 0, 0.00),
(26, 'Ehtisham Shaikh', NULL, NULL, 'ehtisham.shaikh@thetechrics.com', NULL, '$2y$10$ago8zQsLeNWplt8jI8TdTezs0vPuyhvPdPl4iLd3FYRRVoMakN8Va', 1, 0, NULL, 0, '2025-05-17 01:38:12', '2025-05-17 01:38:12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, 1, 6, 0, 0.00),
(27, 'Jazim', NULL, NULL, 'jazim@thetechrics.com', NULL, '$2y$10$T0Wd29Mm8X/sBMaM2KY3xO1XON1/eDDYRkIH8bMM3jxrrXsCKOq0u', 1, 0, NULL, 0, '2025-05-17 02:08:02', '2025-05-17 02:08:02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, 1, 8, 0, 0.00),
(28, 'QA', NULL, NULL, 'qa@admin.com', NULL, '$2y$10$7eD./UhDebaxpp.4lYsQJe2xhKtC1Z1VuwF6Pu8bKS9b/S7tChcs6', 1, 0, NULL, 0, '2025-03-26 23:08:09', '2025-03-26 23:08:09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, NULL, NULL, 1, 1, 0, 0.00),
(29, 'Muhammad Muneeb', NULL, '3rd floor Rehman Square Street', 'muhammad.muneeb@thetechrics.com', NULL, '$2y$10$T0Wd29Mm8X/sBMaM2KY3xO1XON1/eDDYRkIH8bMM3jxrrXsCKOq0u', 1, 0, NULL, 0, '2025-05-17 02:08:02', '2025-06-03 18:11:48', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, '2025-06-03', 'Accusantium', 1, 11, 0, 120000.00),
(30, 'Faizan Ali', NULL, NULL, 'Faizan.ali@thetechrics.com', NULL, '$2y$10$T0Wd29Mm8X/sBMaM2KY3xO1XON1/eDDYRkIH8bMM3jxrrXsCKOq0u', 1, 0, NULL, 0, '2025-05-17 02:08:02', '2025-05-17 02:08:02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, 1, 11, 0, 0.00),
(31, 'M Umar', NULL, NULL, 'm.umar@thetechrics.com', NULL, '$2y$10$T0Wd29Mm8X/sBMaM2KY3xO1XON1/eDDYRkIH8bMM3jxrrXsCKOq0u', 1, 0, NULL, 0, '2025-05-17 02:08:02', '2025-05-17 02:08:02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, 1, 11, 0, 0.00),
(32, 'Raya Rios', NULL, NULL, 'dudadoz@mailinator.com', NULL, '$2y$10$w6xWCU/0gD5dwcR1rbiTaubWPPmp7.8XwgBD7IoBAdrKM1H.pFm1O', 1, 0, NULL, 1, '2025-06-05 20:04:47', '2025-06-05 20:05:10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, 1, 1, 0, 19.00);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
