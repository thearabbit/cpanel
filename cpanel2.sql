-- phpMyAdmin SQL Dump
-- version 4.3.3
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Dec 28, 2014 at 01:00 AM
-- Server version: 5.5.40
-- PHP Version: 5.4.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cpanel2`
--

-- --------------------------------------------------------

--
-- Table structure for table `cp_branch`
--

CREATE TABLE IF NOT EXISTS `cp_branch` (
  `id` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `kh_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `kh_short_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `en_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `en_short_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `kh_address` text COLLATE utf8_unicode_ci NOT NULL,
  `en_address` text COLLATE utf8_unicode_ci NOT NULL,
  `telephone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cp_branch`
--

INSERT INTO `cp_branch` (`id`, `kh_name`, `kh_short_name`, `en_name`, `en_short_name`, `kh_address`, `en_address`, `telephone`, `email`, `created_at`, `updated_at`) VALUES
('001', 'សាខាបាត់ដំបង', 'បប', 'Battambang', 'BTB', 'ផ្លូវជាតិលេខ ៥ ភូមិរំចេក ៤ សង្កាត់រតនៈ ក្រុងបាត់ដំបង ខេត្តបាត់ដំបង', 'Str 5, Romchek 4 Village, Sangkat Rottanak, Krong Battambang, Battambang Province', '053 50 66 777', '', '2014-12-17 10:16:23', '2014-12-17 10:16:23');

-- --------------------------------------------------------

--
-- Table structure for table `cp_company`
--

CREATE TABLE IF NOT EXISTS `cp_company` (
  `id` int(10) unsigned NOT NULL,
  `kh_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `kh_short_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `en_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `en_short_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `kh_address` text COLLATE utf8_unicode_ci NOT NULL,
  `en_address` text COLLATE utf8_unicode_ci NOT NULL,
  `telephone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `website` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cp_company`
--

INSERT INTO `cp_company` (`id`, `kh_name`, `kh_short_name`, `en_name`, `en_short_name`, `kh_address`, `en_address`, `telephone`, `email`, `website`, `logo`, `created_at`, `updated_at`) VALUES
(1, 'មជ្ឈមណ្ឌលបណ្តុះបណ្តាល រ៉ាប៊ីត', 'មបរ', 'Rabbit Training Center', 'RTC', 'ផ្លូវជាតិលេខ ៥ ភូមិរំចេក ៤ សង្កាត់រតនៈ ក្រុងបាត់ដំបង ខេត្តបាត់ដំបង', 'Str 5, Romchek 4 Village, Sangkat Rottanak, Krong Battambang, Battambang Province', '053 50 66 777', '', 'rabbittc.blogspot.com', '', '2014-12-17 10:16:23', '2014-12-17 10:16:23');

-- --------------------------------------------------------

--
-- Table structure for table `cp_currency`
--

CREATE TABLE IF NOT EXISTS `cp_currency` (
  `id` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cp_currency`
--

INSERT INTO `cp_currency` (`id`, `name`, `created_at`, `updated_at`) VALUES
('1', 'KHR', '2014-12-18 06:52:25', '2014-12-18 06:52:25'),
('2', 'USD', '2014-12-18 06:52:25', '2014-12-18 06:52:25'),
('5', 'THB', '2014-12-18 06:52:25', '2014-12-18 06:52:25');

-- --------------------------------------------------------

--
-- Table structure for table `cp_exchange`
--

CREATE TABLE IF NOT EXISTS `cp_exchange` (
  `id` int(10) unsigned NOT NULL,
  `exchange_date` date NOT NULL,
  `khr_usd` decimal(12,2) NOT NULL,
  `usd` decimal(12,2) NOT NULL,
  `khr_thb` decimal(12,2) NOT NULL,
  `thb` decimal(12,2) NOT NULL,
  `memo` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cp_exchange`
--

INSERT INTO `cp_exchange` (`id`, `exchange_date`, `khr_usd`, `usd`, `khr_thb`, `thb`, `memo`, `created_at`, `updated_at`) VALUES
(1, '2015-01-01', '4055.00', '1.00', '125.00', '1.00', '', '2014-12-18 09:45:58', '2014-12-18 09:58:09');

-- --------------------------------------------------------

--
-- Table structure for table `cp_group`
--

CREATE TABLE IF NOT EXISTS `cp_group` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `package` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `permission` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cp_group`
--

INSERT INTO `cp_group` (`id`, `name`, `package`, `permission`, `created_at`, `updated_at`) VALUES
(1, 'Super', 'cpanel', '[]', '2014-12-17 10:16:23', '2014-12-17 10:17:10'),
(2, 'Admin', 'cpanel', '["cpanel.company.edit","cpanel.backup.create","cpanel.restore.create","cpanel.exchange.index","cpanel.exchange.create","cpanel.exchange.edit","cpanel.exchange.destroy","cpanel.branch.index","cpanel.branch.create","cpanel.branch.edit","cpanel.branch.destroy","cpanel.group.index","cpanel.group.create","cpanel.group.edit","cpanel.group.destroy","cpanel.user.index","cpanel.user.create","cpanel.user.edit","cpanel.user.destroy"]', '2014-12-17 10:18:38', '2014-12-24 03:35:59');

-- --------------------------------------------------------

--
-- Table structure for table `cp_user`
--

CREATE TABLE IF NOT EXISTS `cp_user` (
  `id` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `full_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `group` text COLLATE utf8_unicode_ci NOT NULL,
  `branch` text COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_action` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `activated` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `owner_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cp_user`
--

INSERT INTO `cp_user` (`id`, `full_name`, `email`, `type`, `group`, `branch`, `username`, `password`, `password_action`, `activated`, `owner_id`, `remember_token`, `created_at`, `updated_at`) VALUES
('001', 'Yuom Theara', 'yuom.theara@gmail.com', 'Super', '["1"]', '["001"]', 'super', '$2y$10$wjS1BjmNZmWEZ9L0KSdNb.9SO0pyhEC88d8vX0E5hy9WFjQ25HMmC', 'super123456', 'Yes', '001', 'Q8JkGIW2LkQyHycDM4FaIVDpYNpTp898pb65CepzWpHRDaIhRG5Hsdz2q9Cr', '2014-12-17 10:16:23', '2014-12-28 08:54:26'),
('002', 'Admin', 'admin@gamil.com', 'Admin', '["2"]', '["001"]', 'admin', '$2y$10$iv2SyFtmsoLFn/LPG77we.KZedwKm8SGDescHA0ukrbcJ3a0uinMi', 'admin123456', 'Yes', '001', 'ondjv96hrck0TsuH4eXlt1VsNTzSPEVcINWVaB6TvjUFiCkH2j8VMLbIweGY', '2014-12-17 10:19:44', '2014-12-28 04:55:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cp_branch`
--
ALTER TABLE `cp_branch`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cp_company`
--
ALTER TABLE `cp_company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cp_currency`
--
ALTER TABLE `cp_currency`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cp_exchange`
--
ALTER TABLE `cp_exchange`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cp_group`
--
ALTER TABLE `cp_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cp_user`
--
ALTER TABLE `cp_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cp_company`
--
ALTER TABLE `cp_company`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `cp_exchange`
--
ALTER TABLE `cp_exchange`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `cp_group`
--
ALTER TABLE `cp_group`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
