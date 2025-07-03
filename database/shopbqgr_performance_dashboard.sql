-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 03, 2025 at 03:05 AM
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
-- Table structure for table `attendances`
--

CREATE TABLE `attendances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `status` enum('present','absent','leave') NOT NULL,
  `check_in` time DEFAULT NULL,
  `check_out` time DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attendances`
--

INSERT INTO `attendances` (`id`, `user_id`, `date`, `status`, `check_in`, `check_out`, `remarks`, `created_at`, `updated_at`) VALUES
(1, 1, '2025-05-01', 'absent', NULL, NULL, NULL, '2025-06-13 20:46:03', '2025-06-13 20:46:03'),
(2, 2, '2025-05-01', 'absent', NULL, NULL, NULL, '2025-06-13 20:46:03', '2025-06-13 20:46:03'),
(3, 3, '2025-05-01', 'absent', NULL, NULL, NULL, '2025-06-13 20:46:03', '2025-06-13 20:46:03'),
(4, 4, '2025-05-01', 'present', '09:00:00', NULL, NULL, '2025-06-13 20:46:03', '2025-06-13 20:46:03'),
(5, 5, '2025-05-01', 'present', '09:00:00', NULL, NULL, '2025-06-13 20:46:03', '2025-06-13 20:46:03'),
(6, 6, '2025-05-01', 'absent', NULL, NULL, NULL, '2025-06-13 20:46:03', '2025-06-13 20:46:03'),
(7, 7, '2025-05-01', 'absent', NULL, NULL, NULL, '2025-06-13 20:46:03', '2025-06-13 20:46:03'),
(8, 1, '2025-05-02', 'absent', NULL, NULL, NULL, '2025-06-13 20:46:54', '2025-06-13 20:46:54'),
(9, 2, '2025-05-02', 'present', '09:00:00', NULL, NULL, '2025-06-13 20:46:54', '2025-06-13 20:46:54'),
(10, 3, '2025-05-02', 'absent', NULL, NULL, NULL, '2025-06-13 20:46:54', '2025-06-13 20:46:54'),
(11, 4, '2025-05-02', 'absent', NULL, NULL, NULL, '2025-06-13 20:46:54', '2025-06-13 20:46:54'),
(12, 5, '2025-05-02', 'present', '09:00:00', NULL, NULL, '2025-06-13 20:46:54', '2025-06-13 20:46:54'),
(13, 6, '2025-05-02', 'present', '09:00:00', NULL, NULL, '2025-06-13 20:46:54', '2025-06-13 20:46:54'),
(14, 7, '2025-05-02', 'absent', NULL, NULL, NULL, '2025-06-13 20:46:54', '2025-06-13 20:46:54'),
(15, 1, '2025-05-05', 'absent', NULL, NULL, NULL, '2025-06-13 20:47:28', '2025-06-13 20:47:28'),
(16, 2, '2025-05-05', 'present', '09:00:00', NULL, NULL, '2025-06-13 20:47:28', '2025-06-13 20:47:28'),
(17, 3, '2025-05-05', 'absent', NULL, NULL, NULL, '2025-06-13 20:47:28', '2025-06-13 20:47:28'),
(18, 4, '2025-05-05', 'absent', NULL, NULL, NULL, '2025-06-13 20:47:28', '2025-06-13 20:47:28'),
(19, 5, '2025-05-05', 'present', '09:00:00', NULL, NULL, '2025-06-13 20:47:28', '2025-06-13 20:47:28'),
(20, 6, '2025-05-05', 'absent', NULL, NULL, NULL, '2025-06-13 20:47:28', '2025-06-13 20:47:28'),
(21, 7, '2025-05-05', 'absent', NULL, NULL, NULL, '2025-06-13 20:47:28', '2025-06-13 20:47:28'),
(22, 1, '2025-05-06', 'absent', NULL, NULL, NULL, '2025-06-13 20:48:03', '2025-06-13 20:48:03'),
(23, 2, '2025-05-06', 'present', '09:00:00', NULL, NULL, '2025-06-13 20:48:04', '2025-06-13 20:48:04'),
(24, 3, '2025-05-06', 'absent', NULL, NULL, NULL, '2025-06-13 20:48:04', '2025-06-13 20:48:04'),
(25, 4, '2025-05-06', 'absent', NULL, NULL, NULL, '2025-06-13 20:48:04', '2025-06-13 20:48:04'),
(26, 5, '2025-05-06', 'present', '09:00:00', NULL, NULL, '2025-06-13 20:48:04', '2025-06-13 20:48:04'),
(27, 6, '2025-05-06', 'present', '09:00:00', NULL, NULL, '2025-06-13 20:48:04', '2025-06-13 20:48:04'),
(28, 7, '2025-05-06', 'present', '09:00:00', NULL, NULL, '2025-06-13 20:48:04', '2025-06-13 20:48:04'),
(29, 1, '2025-05-07', 'absent', NULL, NULL, NULL, '2025-06-13 20:49:14', '2025-06-13 20:49:14'),
(30, 2, '2025-05-07', 'present', '09:00:00', NULL, NULL, '2025-06-13 20:49:14', '2025-06-13 20:49:14'),
(31, 3, '2025-05-07', 'absent', NULL, NULL, NULL, '2025-06-13 20:49:14', '2025-06-13 20:49:14'),
(32, 4, '2025-05-07', 'present', '09:00:00', NULL, NULL, '2025-06-13 20:49:14', '2025-06-13 20:49:14'),
(33, 5, '2025-05-07', 'present', '09:00:00', NULL, NULL, '2025-06-13 20:49:14', '2025-06-13 20:49:14'),
(34, 6, '2025-05-07', 'present', '09:00:00', NULL, NULL, '2025-06-13 20:49:14', '2025-06-13 20:49:14'),
(35, 7, '2025-05-07', 'absent', NULL, NULL, NULL, '2025-06-13 20:49:14', '2025-06-13 20:49:14'),
(36, 1, '2025-05-08', 'present', '09:00:00', NULL, NULL, '2025-06-13 20:49:27', '2025-06-13 20:49:27'),
(37, 2, '2025-05-08', 'absent', NULL, NULL, NULL, '2025-06-13 20:49:27', '2025-06-13 20:49:27'),
(38, 3, '2025-05-08', 'present', '09:00:00', NULL, NULL, '2025-06-13 20:49:27', '2025-06-13 20:49:27'),
(39, 4, '2025-05-08', 'absent', NULL, NULL, NULL, '2025-06-13 20:49:27', '2025-06-13 20:49:27'),
(40, 5, '2025-05-08', 'present', '09:00:00', NULL, NULL, '2025-06-13 20:49:27', '2025-06-13 20:49:27'),
(41, 6, '2025-05-08', 'present', '09:00:00', NULL, NULL, '2025-06-13 20:49:27', '2025-06-13 20:49:27'),
(42, 7, '2025-05-08', 'present', '09:00:00', NULL, NULL, '2025-06-13 20:49:27', '2025-06-13 20:49:27'),
(43, 1, '2025-05-09', 'absent', NULL, NULL, NULL, '2025-06-13 20:49:54', '2025-06-13 20:49:54'),
(44, 2, '2025-05-09', 'present', '09:00:00', NULL, NULL, '2025-06-13 20:49:54', '2025-06-13 20:49:54'),
(45, 3, '2025-05-09', 'present', '09:00:00', NULL, NULL, '2025-06-13 20:49:54', '2025-06-13 20:49:54'),
(46, 4, '2025-05-09', 'present', '09:00:00', NULL, NULL, '2025-06-13 20:49:54', '2025-06-13 20:49:54'),
(47, 5, '2025-05-09', 'absent', NULL, NULL, NULL, '2025-06-13 20:49:54', '2025-06-13 20:49:54'),
(48, 6, '2025-05-09', 'absent', NULL, NULL, NULL, '2025-06-13 20:49:54', '2025-06-13 20:49:54'),
(49, 7, '2025-05-09', 'absent', NULL, NULL, NULL, '2025-06-13 20:49:54', '2025-06-13 20:49:54'),
(50, 1, '2025-05-12', 'present', '09:00:00', NULL, NULL, '2025-06-13 20:51:11', '2025-06-13 20:51:11'),
(51, 2, '2025-05-12', 'present', '09:00:00', NULL, NULL, '2025-06-13 20:51:11', '2025-06-13 20:51:11'),
(52, 3, '2025-05-12', 'absent', NULL, NULL, NULL, '2025-06-13 20:51:11', '2025-06-13 20:51:11'),
(53, 4, '2025-05-12', 'absent', NULL, NULL, NULL, '2025-06-13 20:51:11', '2025-06-13 20:51:11'),
(54, 5, '2025-05-12', 'present', '09:00:00', NULL, NULL, '2025-06-13 20:51:11', '2025-06-13 20:51:11'),
(55, 6, '2025-05-12', 'absent', NULL, NULL, NULL, '2025-06-13 20:51:11', '2025-06-13 20:51:11'),
(56, 7, '2025-05-12', 'absent', NULL, NULL, NULL, '2025-06-13 20:51:11', '2025-06-13 20:51:11'),
(57, 1, '2025-05-13', 'present', '09:00:00', NULL, NULL, '2025-06-13 20:51:45', '2025-06-13 20:51:45'),
(58, 2, '2025-05-13', 'present', '09:00:00', NULL, NULL, '2025-06-13 20:51:45', '2025-06-13 20:51:45'),
(59, 3, '2025-05-13', 'present', '09:00:00', NULL, NULL, '2025-06-13 20:51:45', '2025-06-13 20:51:45'),
(60, 4, '2025-05-13', 'present', '09:00:00', NULL, NULL, '2025-06-13 20:51:45', '2025-06-13 20:51:45'),
(61, 5, '2025-05-13', 'present', '09:00:00', NULL, NULL, '2025-06-13 20:51:45', '2025-06-13 20:51:45'),
(62, 6, '2025-05-13', 'absent', NULL, NULL, NULL, '2025-06-13 20:51:46', '2025-06-13 20:51:46'),
(63, 7, '2025-05-13', 'present', '09:00:00', NULL, NULL, '2025-06-13 20:51:46', '2025-06-13 20:51:46'),
(64, 1, '2025-05-14', 'present', '09:00:00', NULL, NULL, '2025-06-13 20:51:58', '2025-06-13 20:51:58'),
(65, 2, '2025-05-14', 'absent', NULL, NULL, NULL, '2025-06-13 20:51:58', '2025-06-13 20:51:58'),
(66, 3, '2025-05-14', 'present', '09:00:00', NULL, NULL, '2025-06-13 20:51:58', '2025-06-13 20:51:58'),
(67, 4, '2025-05-14', 'present', '09:00:00', NULL, NULL, '2025-06-13 20:51:58', '2025-06-13 20:51:58'),
(68, 5, '2025-05-14', 'absent', NULL, NULL, NULL, '2025-06-13 20:51:58', '2025-06-13 20:51:58'),
(69, 6, '2025-05-14', 'absent', NULL, NULL, NULL, '2025-06-13 20:51:58', '2025-06-13 20:51:58'),
(70, 7, '2025-05-14', 'present', '09:00:00', NULL, NULL, '2025-06-13 20:51:58', '2025-06-13 20:51:58'),
(71, 1, '2025-05-15', 'present', '09:00:00', NULL, NULL, '2025-06-13 20:52:14', '2025-06-13 20:52:14'),
(72, 2, '2025-05-15', 'present', '09:00:00', NULL, NULL, '2025-06-13 20:52:14', '2025-06-13 20:52:14'),
(73, 3, '2025-05-15', 'absent', NULL, NULL, NULL, '2025-06-13 20:52:14', '2025-06-13 20:52:14'),
(74, 4, '2025-05-15', 'absent', NULL, NULL, NULL, '2025-06-13 20:52:14', '2025-06-13 20:52:14'),
(75, 5, '2025-05-15', 'present', '09:00:00', NULL, NULL, '2025-06-13 20:52:14', '2025-06-13 20:52:14'),
(76, 6, '2025-05-15', 'absent', NULL, NULL, NULL, '2025-06-13 20:52:14', '2025-06-13 20:52:14'),
(77, 7, '2025-05-15', 'absent', NULL, NULL, NULL, '2025-06-13 20:52:14', '2025-06-13 20:52:14'),
(78, 1, '2025-05-16', 'present', '09:00:00', NULL, NULL, '2025-06-13 20:52:25', '2025-06-13 20:52:25'),
(79, 2, '2025-05-16', 'absent', NULL, NULL, NULL, '2025-06-13 20:52:25', '2025-06-13 20:52:25'),
(80, 3, '2025-05-16', 'present', '09:00:00', NULL, NULL, '2025-06-13 20:52:25', '2025-06-13 20:52:25'),
(81, 4, '2025-05-16', 'present', '09:00:00', NULL, NULL, '2025-06-13 20:52:25', '2025-06-13 20:52:25'),
(82, 5, '2025-05-16', 'present', '09:00:00', NULL, NULL, '2025-06-13 20:52:25', '2025-06-13 20:52:25'),
(83, 6, '2025-05-16', 'present', '09:00:00', NULL, NULL, '2025-06-13 20:52:25', '2025-06-13 20:52:25'),
(84, 7, '2025-05-16', 'absent', NULL, NULL, NULL, '2025-06-13 20:52:26', '2025-06-13 20:52:26'),
(85, 1, '2025-05-19', 'present', '09:00:00', NULL, NULL, '2025-06-13 20:54:03', '2025-06-13 20:54:03'),
(86, 2, '2025-05-19', 'absent', NULL, NULL, NULL, '2025-06-13 20:54:03', '2025-06-13 20:54:03'),
(87, 3, '2025-05-19', 'absent', NULL, NULL, NULL, '2025-06-13 20:54:03', '2025-06-13 20:54:03'),
(88, 4, '2025-05-19', 'present', '09:00:00', NULL, NULL, '2025-06-13 20:54:03', '2025-06-13 20:54:03'),
(89, 5, '2025-05-19', 'absent', NULL, NULL, NULL, '2025-06-13 20:54:03', '2025-06-13 20:54:03'),
(90, 6, '2025-05-19', 'absent', NULL, NULL, NULL, '2025-06-13 20:54:03', '2025-06-13 20:54:03'),
(91, 7, '2025-05-19', 'absent', NULL, NULL, NULL, '2025-06-13 20:54:03', '2025-06-13 20:54:03'),
(92, 1, '2025-05-20', 'absent', NULL, NULL, NULL, '2025-06-13 20:54:20', '2025-06-13 20:54:20'),
(93, 2, '2025-05-20', 'present', '09:00:00', NULL, NULL, '2025-06-13 20:54:20', '2025-06-13 20:54:20'),
(94, 3, '2025-05-20', 'absent', NULL, NULL, NULL, '2025-06-13 20:54:20', '2025-06-13 20:54:20'),
(95, 4, '2025-05-20', 'absent', NULL, NULL, NULL, '2025-06-13 20:54:20', '2025-06-13 20:54:20'),
(96, 5, '2025-05-20', 'absent', NULL, NULL, NULL, '2025-06-13 20:54:20', '2025-06-13 20:54:20'),
(97, 6, '2025-05-20', 'absent', NULL, NULL, NULL, '2025-06-13 20:54:20', '2025-06-13 20:54:20'),
(98, 7, '2025-05-20', 'present', '09:00:00', NULL, NULL, '2025-06-13 20:54:20', '2025-06-13 20:54:20'),
(99, 1, '2025-05-21', 'present', '09:00:00', NULL, NULL, '2025-06-13 20:54:41', '2025-06-13 20:54:41'),
(100, 2, '2025-05-21', 'present', '09:00:00', NULL, NULL, '2025-06-13 20:54:41', '2025-06-13 20:54:41'),
(101, 3, '2025-05-21', 'present', '09:00:00', NULL, NULL, '2025-06-13 20:54:41', '2025-06-13 20:54:41'),
(102, 4, '2025-05-21', 'present', '09:00:00', NULL, NULL, '2025-06-13 20:54:41', '2025-06-13 20:54:41'),
(103, 5, '2025-05-21', 'present', '09:00:00', NULL, NULL, '2025-06-13 20:54:41', '2025-06-13 20:54:41'),
(104, 6, '2025-05-21', 'present', '09:00:00', NULL, NULL, '2025-06-13 20:54:41', '2025-06-13 20:54:41'),
(105, 7, '2025-05-21', 'absent', NULL, NULL, NULL, '2025-06-13 20:54:41', '2025-06-13 20:54:41'),
(106, 1, '2025-05-22', 'present', '09:00:00', NULL, NULL, '2025-06-13 20:55:04', '2025-06-13 20:55:04'),
(107, 2, '2025-05-22', 'present', '09:00:00', NULL, NULL, '2025-06-13 20:55:04', '2025-06-13 20:55:04'),
(108, 3, '2025-05-22', 'present', '09:00:00', NULL, NULL, '2025-06-13 20:55:04', '2025-06-13 20:55:04'),
(109, 4, '2025-05-22', 'absent', NULL, NULL, NULL, '2025-06-13 20:55:04', '2025-06-13 20:55:04'),
(110, 5, '2025-05-22', 'absent', NULL, NULL, NULL, '2025-06-13 20:55:04', '2025-06-13 20:55:04'),
(111, 6, '2025-05-22', 'present', '09:00:00', NULL, NULL, '2025-06-13 20:55:04', '2025-06-13 20:55:04'),
(112, 7, '2025-05-22', 'absent', NULL, NULL, NULL, '2025-06-13 20:55:04', '2025-06-13 20:55:04'),
(113, 1, '2025-05-23', 'absent', NULL, NULL, NULL, '2025-06-13 20:55:33', '2025-06-13 20:55:33'),
(114, 2, '2025-05-23', 'present', '09:00:00', NULL, NULL, '2025-06-13 20:55:33', '2025-06-13 20:55:33'),
(115, 3, '2025-05-23', 'present', '09:00:00', NULL, NULL, '2025-06-13 20:55:33', '2025-06-13 20:55:33'),
(116, 4, '2025-05-23', 'absent', NULL, NULL, NULL, '2025-06-13 20:55:33', '2025-06-13 20:55:33'),
(117, 5, '2025-05-23', 'present', '09:00:00', NULL, NULL, '2025-06-13 20:55:33', '2025-06-13 20:55:33'),
(118, 6, '2025-05-23', 'absent', NULL, NULL, NULL, '2025-06-13 20:55:33', '2025-06-13 20:55:33'),
(119, 7, '2025-05-23', 'present', '09:00:00', NULL, NULL, '2025-06-13 20:55:33', '2025-06-13 20:55:33'),
(120, 1, '2025-05-26', 'present', '09:00:00', NULL, NULL, '2025-06-13 20:59:54', '2025-06-13 20:59:54'),
(121, 2, '2025-05-26', 'absent', NULL, NULL, NULL, '2025-06-13 20:59:54', '2025-06-13 20:59:54'),
(122, 3, '2025-05-26', 'present', '09:00:00', NULL, NULL, '2025-06-13 20:59:54', '2025-06-13 20:59:54'),
(123, 4, '2025-05-26', 'absent', NULL, NULL, NULL, '2025-06-13 20:59:54', '2025-06-13 20:59:54'),
(124, 5, '2025-05-26', 'absent', NULL, NULL, NULL, '2025-06-13 20:59:54', '2025-06-13 20:59:54'),
(125, 6, '2025-05-26', 'absent', NULL, NULL, NULL, '2025-06-13 20:59:54', '2025-06-13 20:59:54'),
(126, 7, '2025-05-26', 'present', '09:00:00', NULL, NULL, '2025-06-13 20:59:54', '2025-06-13 20:59:54'),
(127, 1, '2025-05-27', 'present', '09:00:00', NULL, NULL, '2025-06-13 21:00:28', '2025-06-13 21:00:28'),
(128, 2, '2025-05-27', 'present', '09:00:00', NULL, NULL, '2025-06-13 21:00:28', '2025-06-13 21:00:28'),
(129, 3, '2025-05-27', 'absent', NULL, NULL, NULL, '2025-06-13 21:00:28', '2025-06-13 21:00:28'),
(130, 4, '2025-05-27', 'present', '09:00:00', NULL, NULL, '2025-06-13 21:00:28', '2025-06-13 21:00:28'),
(131, 5, '2025-05-27', 'absent', NULL, NULL, NULL, '2025-06-13 21:00:28', '2025-06-13 21:00:28'),
(132, 6, '2025-05-27', 'absent', NULL, NULL, NULL, '2025-06-13 21:00:28', '2025-06-13 21:00:28'),
(133, 7, '2025-05-27', 'present', '09:00:00', NULL, NULL, '2025-06-13 21:00:28', '2025-06-13 21:00:28'),
(134, 1, '2025-05-28', 'present', '09:00:00', NULL, NULL, '2025-06-13 21:00:52', '2025-06-13 21:00:52'),
(135, 2, '2025-05-28', 'absent', NULL, NULL, NULL, '2025-06-13 21:00:52', '2025-06-13 21:00:52'),
(136, 3, '2025-05-28', 'absent', NULL, NULL, NULL, '2025-06-13 21:00:52', '2025-06-13 21:00:52'),
(137, 4, '2025-05-28', 'present', '09:00:00', NULL, NULL, '2025-06-13 21:00:52', '2025-06-13 21:00:52'),
(138, 5, '2025-05-28', 'absent', NULL, NULL, NULL, '2025-06-13 21:00:52', '2025-06-13 21:00:52'),
(139, 6, '2025-05-28', 'present', '09:00:00', NULL, NULL, '2025-06-13 21:00:52', '2025-06-13 21:00:52'),
(140, 7, '2025-05-28', 'absent', NULL, NULL, NULL, '2025-06-13 21:00:52', '2025-06-13 21:00:52'),
(141, 1, '2025-05-29', 'present', '09:00:00', NULL, NULL, '2025-06-13 21:01:19', '2025-06-13 21:01:19'),
(142, 2, '2025-05-29', 'present', '09:00:00', NULL, NULL, '2025-06-13 21:01:19', '2025-06-13 21:01:19'),
(143, 3, '2025-05-29', 'present', '09:00:00', NULL, NULL, '2025-06-13 21:01:19', '2025-06-13 21:01:19'),
(144, 4, '2025-05-29', 'absent', NULL, NULL, NULL, '2025-06-13 21:01:19', '2025-06-13 21:01:19'),
(145, 5, '2025-05-29', 'absent', NULL, NULL, NULL, '2025-06-13 21:01:19', '2025-06-13 21:01:19'),
(146, 6, '2025-05-29', 'absent', NULL, NULL, NULL, '2025-06-13 21:01:19', '2025-06-13 21:01:19'),
(147, 7, '2025-05-29', 'present', '09:00:00', NULL, NULL, '2025-06-13 21:01:19', '2025-06-13 21:01:19'),
(148, 1, '2025-05-30', 'present', '09:00:00', NULL, NULL, '2025-06-13 21:01:34', '2025-06-13 21:01:34'),
(149, 2, '2025-05-30', 'present', '09:00:00', NULL, NULL, '2025-06-13 21:01:34', '2025-06-13 21:01:34'),
(150, 3, '2025-05-30', 'absent', NULL, NULL, NULL, '2025-06-13 21:01:34', '2025-06-13 21:01:34'),
(151, 4, '2025-05-30', 'absent', NULL, NULL, NULL, '2025-06-13 21:01:34', '2025-06-13 21:01:34'),
(152, 5, '2025-05-30', 'absent', NULL, NULL, NULL, '2025-06-13 21:01:34', '2025-06-13 21:01:34'),
(153, 6, '2025-05-30', 'present', '09:00:00', NULL, NULL, '2025-06-13 21:01:34', '2025-06-13 21:01:34'),
(154, 7, '2025-05-30', 'absent', NULL, NULL, NULL, '2025-06-13 21:01:34', '2025-06-13 21:01:34');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `configs`
--

CREATE TABLE `configs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `flag_key` varchar(255) NOT NULL,
  `flag_value` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `configs`
--

INSERT INTO `configs` (`id`, `flag_key`, `flag_value`, `created_at`, `updated_at`) VALUES
(1, 'site_logo', '', '2025-05-13 17:13:37', '2025-06-02 17:48:34'),
(2, 'office_start_time', '09:00', '2025-05-13 17:13:37', '2025-05-13 17:13:37'),
(3, 'office_end_time', '18:00', '2025-05-13 17:13:37', '2025-05-13 17:36:58');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `slug`, `status`, `created_at`, `updated_at`, `parent_id`) VALUES
(1, 'Wordpress', 'wordpress', 1, '2025-03-20 23:27:13', '2025-03-20 23:27:13', NULL),
(2, 'Custom and Front end', 'custom-and-front-end', 1, '2025-03-20 23:30:30', '2025-03-26 22:45:46', NULL),
(4, 'Design', 'design', 1, '2025-03-20 23:30:52', '2025-03-20 23:30:52', NULL),
(5, 'Illustration', 'illustration', 1, NULL, NULL, 4),
(6, 'Web Design', 'web-design', 1, NULL, NULL, 4),
(7, 'Social Media', 'social-media', 1, NULL, NULL, 4),
(8, 'Book', 'book', 1, NULL, NULL, 4),
(9, 'Custom', 'custom', 1, NULL, NULL, 2),
(10, 'FrontEnd', 'front-end', 1, NULL, NULL, 2),
(11, 'SEO', 'seo', 1, NULL, NULL, 2);

-- --------------------------------------------------------

--
-- Table structure for table `dyeing_batches`
--

CREATE TABLE `dyeing_batches` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `batch_no` varchar(255) NOT NULL,
  `color_info` varchar(255) NOT NULL,
  `dye_type` varchar(255) NOT NULL,
  `process_status` enum('pending','in_process','completed') NOT NULL,
  `quantity` decimal(10,2) NOT NULL,
  `unit_type` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `email_data`
--

CREATE TABLE `email_data` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `domain_name` varchar(255) DEFAULT NULL,
  `brand_id` bigint(20) UNSIGNED DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) DEFAULT NULL,
  `collection_name` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `mime_type` varchar(255) DEFAULT NULL,
  `disk` varchar(255) NOT NULL,
  `conversions_disk` varchar(255) DEFAULT NULL,
  `size` bigint(20) UNSIGNED NOT NULL,
  `manipulations` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`manipulations`)),
  `custom_properties` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`custom_properties`)),
  `generated_conversions` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`generated_conversions`)),
  `responsive_images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`responsive_images`)),
  `order_column` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `model_type`, `model_id`, `uuid`, `collection_name`, `name`, `file_name`, `mime_type`, `disk`, `conversions_disk`, `size`, `manipulations`, `custom_properties`, `generated_conversions`, `responsive_images`, `order_column`, `created_at`, `updated_at`) VALUES
(3, 'App\\Models\\Setting', 1, '9615a02a-dfd8-4474-902f-841b92f44f4b', 'logo_3', 'logo', 'logo.png', 'image/png', 'public', 'public', 15780, '[]', '[]', '[]', '[]', 3, '2025-06-12 15:44:56', '2025-06-12 15:44:56'),
(5, 'App\\Models\\User', 2, 'f37e75a9-4849-4a68-93bd-5cb8e968399b', 'thumbnail', 'testimonials-3', 'testimonials-3.jpg', 'image/jpeg', 'public', 'public', 2737, '[]', '[]', '[]', '[]', 1, '2025-06-13 16:31:30', '2025-06-13 16:31:30'),
(6, 'App\\Models\\User', 3, '00cfbc49-db61-4775-84b7-47e3591feff2', 'thumbnail', 'testimonials-1', 'testimonials-1.jpg', 'image/jpeg', 'public', 'public', 2795, '[]', '[]', '[]', '[]', 1, '2025-06-13 16:32:31', '2025-06-13 16:32:31'),
(7, 'App\\Models\\User', 4, '75b98393-1c6d-4e95-b3ac-d16aa99a4d46', 'thumbnail', 'testimonials-2', 'testimonials-2.jpg', 'image/jpeg', 'public', 'public', 2203, '[]', '[]', '[]', '[]', 1, '2025-06-13 16:33:57', '2025-06-13 16:33:57'),
(8, 'App\\Models\\User', 5, '276ebd6b-a933-478b-9616-1c390bdecc17', 'thumbnail', 'hero-banner', 'hero-banner.jpg', 'image/jpeg', 'public', 'public', 132317, '[]', '[]', '[]', '[]', 1, '2025-06-13 16:38:35', '2025-06-13 16:38:35'),
(9, 'App\\Models\\User', 6, 'b0c91c5d-9d23-46e0-abec-1d7f4bc75828', 'thumbnail', 'ac-big', 'ac-big.jpg', 'image/jpeg', 'public', 'public', 101566, '[]', '[]', '[]', '[]', 1, '2025-06-13 16:45:56', '2025-06-13 16:45:56'),
(11, 'App\\Models\\User', 7, '7d1a3b4e-3164-4e39-ae4f-f872a9ab01bf', 'thumbnail', 'freezing-cooling-1', 'freezing-cooling-1.jpg', 'image/jpeg', 'public', 'public', 93989, '[]', '[]', '[]', '[]', 1, '2025-06-13 16:48:10', '2025-06-13 16:48:10'),
(12, 'App\\Models\\Setting', 1, 'e81cdf43-8d51-49f4-ae8d-dae99495a7ef', 'logo', 'techorbit-2', 'techorbit-2.png', 'image/png', 'public', 'public', 6060, '[]', '[]', '[]', '[]', 4, '2025-06-16 16:42:21', '2025-06-16 16:42:21'),
(13, 'App\\Models\\Setting', 1, '189720bf-ba66-4b8d-9aae-87ae18e514b6', 'logo_2', 'techorbit-2', 'techorbit-2.png', 'image/png', 'public', 'public', 6060, '[]', '[]', '[]', '[]', 5, '2025-06-16 17:53:54', '2025-06-16 17:53:54');

-- --------------------------------------------------------

--
-- Table structure for table `meta`
--

CREATE TABLE `meta` (
  `id` int(10) UNSIGNED NOT NULL,
  `key` varchar(110) NOT NULL,
  `value` text DEFAULT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'string',
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `owner_type` varchar(80) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2018_04_02_110607_create_meta_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2023_07_14_071752_create_permission_tables', 1),
(7, '2023_07_14_072713_create_media_table', 1),
(8, '2023_08_15_204213_create_password_resets_table', 1),
(9, '2023_09_08_131950_update_user_fields', 1),
(10, '2023_11_01_150312_create_settings_table', 1),
(11, '2024_01_09_192710_modify_settings_table', 2),
(12, '2024_12_08_004104_modify_settings_table', 3),
(13, '2025_02_03_172701_create_posts_table', 3),
(14, '2025_02_03_173619_create_categories_table', 3),
(16, '2023_11_07_134914_create_blogs_table', 4),
(17, '2025_02_13_053327_create_tag_tables', 5),
(19, '2025_02_13_220405_update_blogs_table', 6),
(21, '2025_02_14_033933_create_newsletter_table', 7),
(22, '2025_02_27_043040_create_plans_table', 8),
(24, '2025_02_28_044641_create_subscribtions_table', 9),
(25, '2025_03_07_230102_create_inquiries_table', 10),
(26, '2025_03_20_235004_create_departments_table', 11),
(28, '2025_03_21_012431_update_users_table', 12),
(34, '2025_03_24_232256_create_tasks_table', 13),
(35, '2025_03_25_235453_create_targets_table', 13),
(36, '2025_04_05_041544_create_saved_data_table', 14),
(37, '2025_04_05_042320_create_brands_table', 14),
(39, '2024_01_09_000000_create_email_data_table', 15),
(40, '2025_05_02_223504_add_extradataaccess_column_users', 16),
(43, '2025_05_06_014702_update_targets_table', 17),
(44, '2025_05_06_014732_update_tasks_table', 17),
(45, '2025_05_15_020935_update_department_table', 18),
(47, '2025_05_19_192857_update_task_tabel', 19),
(48, '2024_01_01_000001_create_suppliers_table', 20),
(49, '2024_01_01_000002_create_yarn_purchase_orders_table', 20),
(50, '2024_01_01_000004_create_yarn_inventory_table', 20),
(51, '2024_01_01_000005_create_dyeing_batches_table', 20),
(52, '2024_01_01_000006_create_orders_table', 20),
(53, '2025_05_23_231453_update_tasks_table', 20);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `newsletters`
--

CREATE TABLE `newsletters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `is_active` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `newsletters`
--

INSERT INTO `newsletters` (`id`, `name`, `email`, `phone`, `is_active`, `created_at`, `updated_at`) VALUES
(1, NULL, 'numusoseco@mailinator.com', NULL, 1, '2025-02-13 22:45:14', '2025-02-13 22:45:14'),
(2, NULL, 'kehy@mailinator.com', NULL, 1, '2025-02-13 22:45:26', '2025-02-13 22:45:26');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_no` varchar(255) NOT NULL,
  `buyer_name` varchar(255) NOT NULL,
  `buyer_details` text DEFAULT NULL,
  `status` enum('pending','in_process','completed') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_type` varchar(255) NOT NULL,
  `quantity` decimal(10,2) NOT NULL,
  `unit_type` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin', '2025-03-19 18:58:39', NULL),
(2, 'Manager', 'manager', '2025-03-18 23:05:03', NULL),
(3, 'Employe', 'employe', NULL, NULL),
(4, 'Supervisor', 'supervisor', '2025-03-18 23:05:21', '2025-03-26 23:05:21');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `salaries`
--

CREATE TABLE `salaries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `month_year` date NOT NULL,
  `base_salary` decimal(10,2) NOT NULL,
  `total_days` decimal(8,2) NOT NULL,
  `present_days` decimal(8,2) NOT NULL,
  `absent_days` decimal(8,2) NOT NULL,
  `leave_days` decimal(8,2) NOT NULL,
  `deductions` decimal(10,2) NOT NULL DEFAULT 0.00,
  `bonus` decimal(10,2) NOT NULL DEFAULT 0.00,
  `net_salary` decimal(10,2) NOT NULL,
  `payment_status` varchar(255) NOT NULL DEFAULT 'pending',
  `payment_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `salaries`
--

INSERT INTO `salaries` (`id`, `user_id`, `month_year`, `base_salary`, `total_days`, `present_days`, `absent_days`, `leave_days`, `deductions`, `bonus`, `net_salary`, `payment_status`, `payment_date`, `created_at`, `updated_at`) VALUES
(1, 1, '2025-05-01', 0.00, 22.00, 14.00, 8.00, 0.00, 0.00, 0.00, 0.00, 'pending', NULL, '2025-06-16 20:19:43', '2025-06-16 20:19:43'),
(2, 2, '2025-05-01', 100000.00, 22.00, 15.00, 7.00, 0.00, 0.00, 0.00, 68181.82, 'pending', NULL, '2025-06-16 20:19:43', '2025-06-16 20:19:43'),
(3, 3, '2025-05-01', 100000.00, 22.00, 10.00, 12.00, 0.00, 0.00, 0.00, 45454.55, 'pending', NULL, '2025-06-16 20:19:43', '2025-06-16 20:19:43'),
(4, 4, '2025-05-01', 120000.00, 22.00, 10.00, 12.00, 0.00, 0.00, 0.00, 54545.45, 'pending', NULL, '2025-06-16 20:19:43', '2025-06-16 20:19:43'),
(5, 5, '2025-05-01', 40000.00, 22.00, 12.00, 10.00, 0.00, 0.00, 0.00, 21818.18, 'pending', NULL, '2025-06-16 20:19:43', '2025-06-16 20:19:43'),
(6, 6, '2025-05-01', 60000.00, 22.00, 9.00, 13.00, 0.00, 0.00, 0.00, 24545.45, 'pending', NULL, '2025-06-16 20:19:43', '2025-06-16 20:19:43'),
(7, 7, '2025-05-01', 50000.00, 22.00, 9.00, 13.00, 0.00, 0.00, 0.00, 20454.55, 'pending', NULL, '2025-06-16 20:19:43', '2025-06-16 20:19:43');

-- --------------------------------------------------------

--
-- Table structure for table `saved_data`
--

CREATE TABLE `saved_data` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `brand_id` bigint(20) UNSIGNED DEFAULT NULL,
  `order` varchar(255) DEFAULT NULL,
  `buy_source` varchar(255) DEFAULT NULL,
  `client_name` varchar(255) DEFAULT NULL,
  `client_email` varchar(255) DEFAULT NULL,
  `amount_paid` varchar(255) DEFAULT NULL,
  `target` varchar(255) DEFAULT NULL,
  `purchase_date` varchar(255) DEFAULT NULL,
  `expire_date` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `saved_data`
--

INSERT INTO `saved_data` (`id`, `user_id`, `name`, `slug`, `description`, `brand_id`, `order`, `buy_source`, `client_name`, `client_email`, `amount_paid`, `target`, `purchase_date`, `expire_date`, `status`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Kylee Nelson', 'kylee-nelson', 'Magnam lorem enim an.', 1, 'Magni omnis non cons', 'Temporibus ut verita', 'Griffith Sampson', 'jasoricy@mailinator.com', 'Iste ipsam maiores h', NULL, '1970-12-19', '2011-02-21', 1, '2025-05-03 02:26:55', '2025-05-03 02:26:55');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `logo_2` varchar(255) DEFAULT NULL,
  `logo_3` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `phone_2` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `email_2` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `address_2` text DEFAULT NULL,
  `timing` text DEFAULT NULL,
  `timing_2` text DEFAULT NULL,
  `copyright` text DEFAULT NULL,
  `footer_about` text DEFAULT NULL,
  `color` varchar(30) DEFAULT NULL,
  `color_2` varchar(30) DEFAULT NULL,
  `color_3` varchar(30) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `behance` varchar(255) DEFAULT NULL,
  `pinterest` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `color_4` varchar(255) DEFAULT NULL,
  `lwaClientId` text DEFAULT NULL,
  `lwaClientSecret` text DEFAULT NULL,
  `awsAccessKeyId` text DEFAULT NULL,
  `awsSecretAccessKey` text DEFAULT NULL,
  `roleArn` text DEFAULT NULL,
  `marketplace_region` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `logo`, `logo_2`, `logo_3`, `phone`, `phone_2`, `email`, `email_2`, `address`, `address_2`, `timing`, `timing_2`, `copyright`, `footer_about`, `color`, `color_2`, `color_3`, `facebook`, `twitter`, `instagram`, `linkedin`, `behance`, `pinterest`, `created_at`, `updated_at`, `color_4`, `lwaClientId`, `lwaClientSecret`, `awsAccessKeyId`, `awsSecretAccessKey`, `roleArn`, `marketplace_region`) VALUES
(1, NULL, NULL, NULL, '+1 (755) 804-2369', '+1 (888) 943-7444', 'natixobupi@mailinator.com', 'velapuze@mailinator.com', 'Deserunt non maiores', 'Dolores sint a id ve', 'Deserunt sit at vol', 'Officia sit sed adi', '© 2023 neeon. All Rights Reserved by RadiusTheme', 'When an unknown printer took a galley and scrambled it to make specimen book not only five When an unknown printer took a galley and scrambled it to five centurie.', '#7238fa', '#3ec89d', '#f4deb6', 'https://www.facebook.com', 'https://twitter.com/', 'https://www.instagram.com/', 'https://www.linkedin.com', 'https://www.behance.net/', 'https://www.pinterest.com/', '2024-12-06 14:32:29', '2025-06-03 22:45:06', '#000000', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `address` text DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `contact`, `address`, `email`, `created_at`, `updated_at`) VALUES
(1, 'Kyra Ferrell', 'Et et asperiores sed', 'Velit fugit ea erro', 'vuholuzo@mailinator.com', '2025-07-03 00:52:52', '2025-07-03 00:52:52'),
(2, 'Merritt Albert', 'Labore voluptatem qu', 'Sunt optio sit sed', 'qulypag@mailinator.com', '2025-07-03 00:53:05', '2025-07-03 00:53:05');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`name`)),
  `slug` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`slug`)),
  `type` varchar(255) DEFAULT NULL,
  `order_column` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `name`, `slug`, `type`, `order_column`, `created_at`, `updated_at`) VALUES
(1, '{\"en\":\"Music\"}', '{\"en\":\"music\"}', 'blog', 1, '2025-02-13 13:50:42', '2025-02-13 13:50:42'),
(2, '{\"en\":\"Travel\"}', '{\"en\":\"travel\"}', 'blog', 2, '2025-02-13 13:50:54', '2025-02-13 13:50:54'),
(3, '{\"en\":\"Yoga\"}', '{\"en\":\"yoga\"}', 'blog', 3, '2025-02-13 13:51:12', '2025-02-13 13:51:12'),
(4, '{\"en\":\"Technology\"}', '{\"en\":\"technology\"}', 'blog', 4, '2025-02-13 13:51:16', '2025-02-13 13:51:16'),
(5, '{\"en\":\"Food\"}', '{\"en\":\"food\"}', 'blog', 5, '2025-02-13 13:51:26', '2025-02-13 13:51:26'),
(6, '{\"en\":\"Gym\"}', '{\"en\":\"gym\"}', 'blog', 6, '2025-02-13 13:51:31', '2025-02-13 13:51:31'),
(7, '{\"\":\"Food\"}', '{\"\":\"food\"}', NULL, 7, '2025-02-13 13:52:23', '2025-02-13 13:52:23'),
(8, '{\"\":\"Gym\"}', '{\"\":\"gym\"}', NULL, 8, '2025-02-13 13:52:23', '2025-02-13 13:52:23'),
(9, '{\"en\":\"Fashion\"}', '{\"en\":\"fashion\"}', 'blog', 9, '2025-02-13 18:11:48', '2025-02-13 18:11:48'),
(10, '{\"en\":\"Wild Life\"}', '{\"en\":\"wild-life\"}', 'blog', 10, '2025-02-13 18:12:05', '2025-02-13 18:12:05'),
(11, '{\"en\":\"Wedding\"}', '{\"en\":\"wedding\"}', 'blog', 11, '2025-02-13 18:12:09', '2025-02-13 18:12:09'),
(13, '{\"en\":\"Nature\"}', '{\"en\":\"nature\"}', 'blog', 12, '2025-02-13 18:12:22', '2025-02-13 18:12:22'),
(14, '{\"en\":\"Adventure\"}', '{\"en\":\"adventure\"}', 'blog', 13, '2025-02-13 18:12:32', '2025-02-13 18:12:32'),
(15, '{\"en\":\"Sports\"}', '{\"en\":\"sports\"}', 'blog', 14, '2025-02-13 18:12:53', '2025-02-13 18:12:53'),
(16, '{\"\":\"Technology\"}', '{\"\":\"technology\"}', NULL, 15, '2025-02-13 18:13:50', '2025-02-13 18:13:50'),
(17, '{\"\":\"Travel\"}', '{\"\":\"travel\"}', NULL, 16, '2025-02-13 18:14:23', '2025-02-13 18:14:23'),
(18, '{\"en\":\"Animal\"}', '{\"en\":\"animal\"}', 'blog', 17, '2025-02-13 18:16:42', '2025-02-13 18:16:42'),
(19, '{\"\":\"Animal\"}', '{\"\":\"animal\"}', NULL, 18, '2025-02-13 18:17:12', '2025-02-13 18:17:12'),
(20, '{\"\":\"Adventure\"}', '{\"\":\"adventure\"}', NULL, 19, '2025-02-13 18:17:40', '2025-02-13 18:17:40'),
(22, '{\"en\":\"Health\"}', '{\"en\":\"health\"}', 'blog', 21, '2025-02-13 18:18:27', '2025-02-13 18:18:27'),
(23, '{\"\":\"Health\"}', '{\"\":\"health\"}', NULL, 22, '2025-02-13 18:19:07', '2025-02-13 18:19:07'),
(24, '{\"\":\"Wild Life\"}', '{\"\":\"wild-life\"}', NULL, 23, '2025-02-13 18:21:58', '2025-02-13 18:21:58'),
(25, '{\"\":\"Wedding\"}', '{\"\":\"wedding\"}', NULL, 24, '2025-02-13 18:22:51', '2025-02-13 18:22:51'),
(26, '{\"\":\"Fashion\"}', '{\"\":\"fashion\"}', NULL, 25, '2025-02-13 18:45:12', '2025-02-13 18:45:12');

-- --------------------------------------------------------

--
-- Table structure for table `targets`
--

CREATE TABLE `targets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `target` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `month` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `approved_tasks` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `details` longtext DEFAULT NULL,
  `assign_date` date DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `approval_status` int(11) NOT NULL DEFAULT 0,
  `is_read` int(11) NOT NULL DEFAULT 0,
  `type` varchar(255) NOT NULL DEFAULT '1',
  `rating` varchar(255) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(2, 'John', NULL, NULL, 'john@gmail.com', NULL, '$2y$10$pi.GQ/M3xxH9pCGYRP15pOcXhgmSTXaEL29aQByudhCEddbmeo8gm', 1, 0, NULL, 1, '2025-06-13 16:31:30', '2025-06-13 16:31:30', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, 1, 1, 0, 100000.00),
(3, 'Sheery', NULL, NULL, 'sheery@gmail.com', NULL, '$2y$10$LZO4qjfgfy/zBhRDq3dHku1wZ0eMvRjBAp14YeVAqFqN/BdvCRi0y', 1, 0, NULL, 1, '2025-06-13 16:32:31', '2025-06-13 16:32:31', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, 1, 2, 0, 100000.00),
(4, 'Remy', NULL, NULL, 'remy@gmail.com', NULL, '$2y$10$3gXyLjPcPB6rIJyIuZ.dcO1rjNMmxLPPjKuWcDdNkHA1sGP9RyBp6', 1, 0, NULL, 1, '2025-06-13 16:33:57', '2025-06-13 16:33:57', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, 1, 4, 0, 120000.00),
(5, 'Ali', NULL, NULL, 'ali@gmail.com', NULL, '$2y$10$NEKv/jfhFbMucbQyUNLOPO.LC/xG6unizCWpyHr7bbJOfOHGzKpiu', 1, 0, NULL, 1, '2025-06-13 16:38:35', '2025-06-13 16:38:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, 1, 1, 0, 40000.00),
(6, 'Hamza', NULL, NULL, 'hamza@gmail.com', NULL, '$2y$10$IbQs1Tx2nMRh3FwP45eF3.XjvK7MMZAhHyIrYFpfowDNV3E1nkiLi', 1, 0, NULL, 1, '2025-06-13 16:45:56', '2025-06-13 16:45:56', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, 1, 2, 0, 60000.00),
(7, 'Atta', NULL, NULL, 'atta@gmail.com', NULL, '$2y$10$y6ziZ3BBN3WE5lhsJDBpheGEYCL0meN26MtC2qqHVBYIONpnRoalq', 1, 0, NULL, 1, '2025-06-13 16:47:03', '2025-06-13 16:48:10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, 1, 4, 0, 50000.00),
(8, 'Nelle Kemp', NULL, NULL, 'qewana@mailinator.com', NULL, '$2y$10$xgNPgztIwlMrlBu6BxvRM.pKQn8P6WnQEuqkTXexQnDwT690rYby.', 1, 0, NULL, 1, '2025-06-19 23:04:18', '2025-06-19 23:04:18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, 1, 6, 0, 44.00);

-- --------------------------------------------------------

--
-- Table structure for table `yarn_inventory`
--

CREATE TABLE `yarn_inventory` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `department_id` bigint(20) UNSIGNED NOT NULL,
  `yarn_type` varchar(255) NOT NULL,
  `bags` decimal(10,2) NOT NULL DEFAULT 0.00,
  `cones` decimal(10,2) NOT NULL DEFAULT 0.00,
  `kg` decimal(10,2) NOT NULL DEFAULT 0.00,
  `pieces` decimal(10,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `yarn_movements`
--

CREATE TABLE `yarn_movements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `from_department_id` bigint(20) UNSIGNED NOT NULL,
  `to_department_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` decimal(10,2) NOT NULL,
  `unit_type` varchar(255) NOT NULL,
  `movement_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `yarn_purchase_orders`
--

CREATE TABLE `yarn_purchase_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `supplier_id` bigint(20) UNSIGNED NOT NULL,
  `expected_delivery_date` date NOT NULL,
  `status` enum('pending','completed') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `yarn_purchase_orders`
--

INSERT INTO `yarn_purchase_orders` (`id`, `supplier_id`, `expected_delivery_date`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, '2003-02-10', 'pending', '2025-07-03 00:58:23', '2025-07-03 00:58:23'),
(2, 1, '2003-02-10', 'pending', '2025-07-03 01:00:25', '2025-07-03 01:00:25'),
(3, 1, '2003-02-10', 'pending', '2025-07-03 01:00:43', '2025-07-03 01:00:43'),
(4, 2, '1991-04-22', 'pending', '2025-07-03 01:01:08', '2025-07-03 01:01:08'),
(5, 2, '1981-06-06', 'pending', '2025-07-03 01:01:33', '2025-07-03 01:01:33');

-- --------------------------------------------------------

--
-- Table structure for table `yarn_purchase_order_items`
--

CREATE TABLE `yarn_purchase_order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `yarn_purchase_order_id` bigint(20) UNSIGNED NOT NULL,
  `yarn_type` varchar(255) NOT NULL,
  `count` varchar(255) DEFAULT NULL,
  `quantity` decimal(10,2) NOT NULL,
  `rate` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `yarn_purchase_order_items`
--

INSERT INTO `yarn_purchase_order_items` (`id`, `yarn_purchase_order_id`, `yarn_type`, `count`, `quantity`, `rate`, `created_at`, `updated_at`) VALUES
(1, 3, 'Odio est qui commodi', NULL, 523.00, NULL, '2025-07-03 01:00:43', '2025-07-03 01:00:43'),
(2, 3, 'Voluptatem Ut lorem', NULL, 308.00, NULL, '2025-07-03 01:00:44', '2025-07-03 01:00:44'),
(3, 3, 'Soluta aut accusamus', NULL, 166.00, NULL, '2025-07-03 01:00:44', '2025-07-03 01:00:44'),
(4, 4, 'Aliquid doloremque q', NULL, 695.00, NULL, '2025-07-03 01:01:08', '2025-07-03 01:01:08'),
(5, 4, 'Et sed pariatur Eve', NULL, 484.00, NULL, '2025-07-03 01:01:08', '2025-07-03 01:01:08'),
(6, 4, 'Aperiam enim vel cor', NULL, 361.00, NULL, '2025-07-03 01:01:08', '2025-07-03 01:01:08'),
(7, 4, 'Non amet impedit i', NULL, 332.00, NULL, '2025-07-03 01:01:08', '2025-07-03 01:01:08'),
(8, 4, 'Et minim id quod ape', NULL, 858.00, NULL, '2025-07-03 01:01:09', '2025-07-03 01:01:09'),
(9, 5, 'Esse non doloribus i', NULL, 8.00, NULL, '2025-07-03 01:01:33', '2025-07-03 01:01:33'),
(10, 5, 'Ex voluptate ut prae', NULL, 555.00, NULL, '2025-07-03 01:01:33', '2025-07-03 01:01:33'),
(11, 5, 'Tempora dolorem eum', NULL, 800.00, NULL, '2025-07-03 01:01:33', '2025-07-03 01:01:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendances`
--
ALTER TABLE `attendances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attendances_employee_id_foreign` (`user_id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `configs`
--
ALTER TABLE `configs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `configs_flag_key_unique` (`flag_key`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dyeing_batches`
--
ALTER TABLE `dyeing_batches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `dyeing_batches_batch_no_unique` (`batch_no`);

--
-- Indexes for table `email_data`
--
ALTER TABLE `email_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email_data_brand_id_foreign` (`brand_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `media_uuid_unique` (`uuid`),
  ADD KEY `media_model_type_model_id_index` (`model_type`,`model_id`),
  ADD KEY `media_order_column_index` (`order_column`);

--
-- Indexes for table `meta`
--
ALTER TABLE `meta`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `meta_key_owner_type_owner_id_unique` (`key`,`owner_type`,`owner_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `newsletters`
--
ALTER TABLE `newsletters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orders_order_no_unique` (`order_no`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `salaries`
--
ALTER TABLE `salaries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `salaries_employee_id_foreign` (`user_id`);

--
-- Indexes for table `saved_data`
--
ALTER TABLE `saved_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `targets`
--
ALTER TABLE `targets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- Indexes for table `yarn_inventory`
--
ALTER TABLE `yarn_inventory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `yarn_inventory_department_id_foreign` (`department_id`);

--
-- Indexes for table `yarn_movements`
--
ALTER TABLE `yarn_movements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `yarn_movements_from_department_id_foreign` (`from_department_id`),
  ADD KEY `yarn_movements_to_department_id_foreign` (`to_department_id`);

--
-- Indexes for table `yarn_purchase_orders`
--
ALTER TABLE `yarn_purchase_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `yarn_purchase_orders_supplier_id_foreign` (`supplier_id`);

--
-- Indexes for table `yarn_purchase_order_items`
--
ALTER TABLE `yarn_purchase_order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `yarn_purchase_order_items_yarn_purchase_order_id_foreign` (`yarn_purchase_order_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendances`
--
ALTER TABLE `attendances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=155;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `configs`
--
ALTER TABLE `configs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `dyeing_batches`
--
ALTER TABLE `dyeing_batches`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `email_data`
--
ALTER TABLE `email_data`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `meta`
--
ALTER TABLE `meta`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `newsletters`
--
ALTER TABLE `newsletters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `salaries`
--
ALTER TABLE `salaries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `saved_data`
--
ALTER TABLE `saved_data`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `targets`
--
ALTER TABLE `targets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `yarn_inventory`
--
ALTER TABLE `yarn_inventory`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `yarn_movements`
--
ALTER TABLE `yarn_movements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `yarn_purchase_orders`
--
ALTER TABLE `yarn_purchase_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `yarn_purchase_order_items`
--
ALTER TABLE `yarn_purchase_order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendances`
--
ALTER TABLE `attendances`
  ADD CONSTRAINT `attendances_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `email_data`
--
ALTER TABLE `email_data`
  ADD CONSTRAINT `email_data_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `salaries`
--
ALTER TABLE `salaries`
  ADD CONSTRAINT `salaries_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

--
-- Constraints for table `yarn_inventory`
--
ALTER TABLE `yarn_inventory`
  ADD CONSTRAINT `yarn_inventory_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`);

--
-- Constraints for table `yarn_movements`
--
ALTER TABLE `yarn_movements`
  ADD CONSTRAINT `yarn_movements_from_department_id_foreign` FOREIGN KEY (`from_department_id`) REFERENCES `departments` (`id`),
  ADD CONSTRAINT `yarn_movements_to_department_id_foreign` FOREIGN KEY (`to_department_id`) REFERENCES `departments` (`id`);

--
-- Constraints for table `yarn_purchase_orders`
--
ALTER TABLE `yarn_purchase_orders`
  ADD CONSTRAINT `yarn_purchase_orders_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`);

--
-- Constraints for table `yarn_purchase_order_items`
--
ALTER TABLE `yarn_purchase_order_items`
  ADD CONSTRAINT `yarn_purchase_order_items_yarn_purchase_order_id_foreign` FOREIGN KEY (`yarn_purchase_order_id`) REFERENCES `yarn_purchase_orders` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
