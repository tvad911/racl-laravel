-- phpMyAdmin SQL Dump
-- version 4.4.15.5
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 26, 2017 at 03:59 PM
-- Server version: 5.6.29
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `racl.dev`
--

-- --------------------------------------------------------

--
-- Table structure for table `acl_groups`
--

CREATE TABLE IF NOT EXISTS `acl_groups` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `acl_groups`
--

INSERT INTO `acl_groups` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Banned', NULL, NULL),
(2, 'Guests', NULL, NULL),
(3, 'Users', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `acl_group_permissions`
--

CREATE TABLE IF NOT EXISTS `acl_group_permissions` (
  `id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `group_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `actions` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `acl_group_roles`
--

CREATE TABLE IF NOT EXISTS `acl_group_roles` (
  `group_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `acl_group_roles`
--

INSERT INTO `acl_group_roles` (`group_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, NULL),
(2, 2, NULL, NULL),
(3, 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `acl_permissions`
--

CREATE TABLE IF NOT EXISTS `acl_permissions` (
  `id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `area` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `permission` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `actions` text COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `acl_permissions`
--

INSERT INTO `acl_permissions` (`id`, `created_at`, `updated_at`, `area`, `permission`, `actions`, `description`) VALUES
(1, '2017-10-19 20:41:17', '2017-10-19 20:41:43', 'admin', 'user', 'a:7:{i:0;s:5:"index";i:1;s:6:"create";i:2;s:5:"store";i:3;s:4:"show";i:4;s:4:"edit";i:5;s:6:"update";i:6;s:7:"destroy";}', '');

-- --------------------------------------------------------

--
-- Table structure for table `acl_roles`
--

CREATE TABLE IF NOT EXISTS `acl_roles` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `filter` enum('','A','D','R') COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `acl_roles`
--

INSERT INTO `acl_roles` (`id`, `name`, `filter`, `created_at`, `updated_at`) VALUES
(1, 'banned', 'D', NULL, NULL),
(2, 'public', '', NULL, NULL),
(3, 'user', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `acl_role_permissions`
--

CREATE TABLE IF NOT EXISTS `acl_role_permissions` (
  `id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `actions` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `acl_users`
--

CREATE TABLE IF NOT EXISTS `acl_users` (
  `id` int(10) unsigned NOT NULL,
  `login` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `group_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=309 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `acl_users`
--

INSERT INTO `acl_users` (`id`, `login`, `username`, `name`, `email`, `password`, `group_id`, `remember_token`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'guest', 'guest', 'guest', 'guest@gmail.com', 'NO PASSWORD', '2', NULL, 1, NULL, NULL, NULL),
(2, 'anhduongphuong@gmail.com', 'administrator', 'Ánh Dương™', 'anhduongphuong@gmail.com', '$2y$10$yaZPNjKS0L2Osx4fmZYwOe3xvPS0PUitPhvBQ65PGFZn8CXm1lrOC', '0', '7LJBMKH1jneDbPJ94eqEklqEQa0WxgMYigtlljl6saajnUqkXDeTEz1a8hlk', 1, NULL, '2017-04-02 00:04:58', '2017-04-02 00:04:58'),
(3, 'calista88@casper.com', 'Arnoldo Wisoky III', 'Kristofer Hartmann', 'jailyn33@stark.com', '$2y$10$GV1lIJwafytNnxV2JWoKpeJg/cvyIkrhOID5fFoKQ4NtELV/WDVZW', '0', NULL, 0, NULL, '2017-04-02 00:04:58', '2017-04-02 00:04:58'),
(4, 'francisco64@jacobs.com', 'Amir Bednar', 'Dominique Lowe', 'lehner.treva@shields.com', '$2y$10$UlWYaHM/V1QqWWzhsknS8.1cxiXOyt82qH8XHU61c5gClR5HDpbMa', '0', NULL, 0, NULL, '2017-04-02 00:04:59', '2017-04-02 00:04:59'),
(5, 'estrella06@gmail.com', 'Lorine Runolfsdottir', 'Sibyl Hickle', 'qmccullough@jaskolski.com', '$2y$10$b45qBb2JyJ147n1zg3RWjuy/CSxt0U3BoxxesTj7.pEq/0P49z0RW', '0', NULL, 1, NULL, '2017-04-02 00:04:59', '2017-04-02 00:04:59'),
(6, 'cummerata.willis@rowe.com', 'Dr. Declan Schaefer', 'Marge Zboncak', 'salvatore70@hotmail.com', '$2y$10$yWb1ht6jBy2gsX3mIFvureXRz0qKEGKlSmNqaDy4pLLSqHLRUuO8a', '0', NULL, 0, NULL, '2017-04-02 00:04:59', '2017-04-02 00:04:59'),
(7, 'dare.edison@koepp.com', 'Prof. Micheal Schumm PhD', 'Domenico Orn', 'blangosh@yahoo.com', '$2y$10$iVg7MjwsPkqzQGSqVXH1d.AhevtSo51YbMRDTLfSg.EkdAcS4K5XC', '0', NULL, 0, NULL, '2017-04-02 00:04:59', '2017-04-02 00:04:59'),
(8, 'pouros.emmanuelle@hotmail.com', 'Noelia Stamm V', 'Billie Johnston', 'obahringer@bashirian.com', '$2y$10$OK7kbZjHFJB1Th0vn7OiS.2rYXS/34UDo4xXJjWjrtJ0lDMymT0mC', '0', NULL, 1, NULL, '2017-04-02 00:04:59', '2017-04-02 00:04:59'),
(9, 'sarah17@kozey.net', 'Louisa Hyatt', 'Elinore Hilpert', 'sauer.veda@gmail.com', '$2y$10$HjLLi.pUlGusU2zZRrDF9OMzsrLeLLDicwUHoKeH32ZW5YkBUePg2', '0', NULL, 1, NULL, '2017-04-02 00:04:59', '2017-04-02 00:04:59'),
(10, 'cole.mylene@dickens.com', 'Cecile Turner', 'Mrs. Esther Lindgren IV', 'ztoy@sanford.com', '$2y$10$GlHl6mQIc/cVJmQOXU1Q6udvMMQBgIzlDtJODaSqka9VNAxVxd/g6', '0', NULL, 0, NULL, '2017-04-02 00:04:59', '2017-04-02 00:04:59'),
(11, 'domenica92@yahoo.com', 'Monique Kohler', 'Robyn Langosh', 'josephine.schiller@yahoo.com', '$2y$10$3A4fA68tQ/akPfJFYZfPfOhUSWFPC25wBXJcno55sFsMftI8z8uLu', '0', NULL, 1, NULL, '2017-04-02 00:04:59', '2017-04-02 00:04:59'),
(12, 'denesik.lourdes@kilback.com', 'Donald Yost', 'Dasia Crona', 'tfahey@gmail.com', '$2y$10$5KoWFxcybLQxFWbQ0fw.ZejZzy/c7XjuJ34TaMIRMsWvJ.KutXjra', '0', NULL, 1, NULL, '2017-04-02 00:04:59', '2017-04-02 00:04:59'),
(13, 'wiegand.larue@gmail.com', 'Prof. Wilfredo Lueilwitz DVM', 'Marlin Rath', 'vallie20@yahoo.com', '$2y$10$EjtBRlNd8NZjV2O/iyKtoOiKKwtMsoqPyP4KIRjWGKqyPpzxMZx1y', '0', NULL, 0, NULL, '2017-04-02 00:04:59', '2017-04-02 00:04:59'),
(14, 'george.fisher@gmail.com', 'Dr. Angelica Kirlin', 'Julien Williamson I', 'oconner.mariane@anderson.com', '$2y$10$dIX.dnwfzOagjcR3tp7y5Ou1LNC5KWopwZf36jaCH5XB.2BWbi9Dq', '0', NULL, 1, NULL, '2017-04-02 00:04:59', '2017-04-02 00:04:59'),
(15, 'torrey26@hotmail.com', 'Kariane Koch', 'Evalyn Dooley', 'kira38@boehm.com', '$2y$10$dvpKHR5AnsVnXuGbF2zL3.jeE4.rlCKNguUknlH85FzUsOiFjdr4O', '0', NULL, 0, NULL, '2017-04-02 00:04:59', '2017-04-02 00:04:59'),
(16, 'keira.christiansen@bahringer.com', 'Madalyn Grant', 'Melisa Hintz', 'considine.cristobal@keebler.biz', '$2y$10$DSj6z7k4RxGJma3qbUu/ou.4W8tblFmd.D96DkdV6pMPARDEbdrjq', '0', NULL, 1, NULL, '2017-04-02 00:04:59', '2017-04-02 00:04:59'),
(17, 'karianne.brakus@wiegand.biz', 'Bianka Weissnat I', 'Joey Sanford', 'vivien.lueilwitz@hahn.info', '$2y$10$oohOo24T.BDNrjWyR5rOuONUPcITTFEqwXREcBZeh/gXoXfTrg9YO', '0', NULL, 0, NULL, '2017-04-02 00:04:59', '2017-04-02 00:04:59'),
(18, 'gpfeffer@hotmail.com', 'Moshe Raynor', 'Eloise Bruen', 'nweber@yahoo.com', '$2y$10$DCfkAuE.x/.OMpn2DLiav.nFr90grCejbt5gHjelUFOvCmLlPJN1G', '0', NULL, 0, NULL, '2017-04-02 00:05:00', '2017-04-02 00:05:00'),
(19, 'qtromp@gmail.com', 'Mr. Deontae Jacobi IV', 'Tristin Rogahn', 'flavio.kautzer@abbott.com', '$2y$10$kldpadcI58ZP2qTDB5ho9ev3Ra4LPdETECBbaky47P1FzwzQU8L/2', '0', NULL, 0, NULL, '2017-04-02 00:05:00', '2017-04-02 00:05:00'),
(20, 'caleb55@hotmail.com', 'Dax Welch III', 'Ms. Lauretta Walter IV', 'cale.feest@hotmail.com', '$2y$10$B1xPd11B63orZR/l5xQ.YuNgwUknPz2hl.kM18Ng3rCclM4cIwGK.', '0', NULL, 0, NULL, '2017-04-02 00:05:00', '2017-04-02 00:05:00'),
(21, 'cleo86@gmail.com', 'Heaven Doyle', 'Bernardo Langosh', 'qhirthe@mcglynn.com', '$2y$10$aXBFFkG1uuWTRh0AmBluS.GihEXzwkF085Bc0yUF071Pnyz1Y9SIi', '0', NULL, 0, NULL, '2017-04-02 00:05:00', '2017-04-02 00:05:00'),
(22, 'andreane66@hotmail.com', 'Marcella Botsford', 'Cynthia Braun', 'juwan.okuneva@kohler.com', '$2y$10$GpklzsMEM1tcSpekIDRAg.UNXCcRSSn4u6ZtbW466gtlm.2n/tdJu', '0', NULL, 1, NULL, '2017-04-02 00:05:00', '2017-04-02 00:05:00'),
(23, 'maybell.turner@gmail.com', 'Candice Schmeler', 'Dr. Chaz Orn Sr.', 'omer56@ernser.com', '$2y$10$l8eTvqA13UEXraHLgyqaQ.fID2yQ1pAKY3B8h8VxuAAYvpgKTQQf.', '0', NULL, 1, NULL, '2017-04-02 00:05:00', '2017-04-02 00:05:00'),
(24, 'condricka@auer.com', 'Mr. Judah Nader', 'Syble Reilly', 'bashirian.wayne@hartmann.biz', '$2y$10$3kE5vutFO1SvN.1R4qCjo.s3xS4acH6V3KG0HbZHBdmFwZyUCIzDG', '0', NULL, 0, NULL, '2017-04-02 00:05:00', '2017-04-02 00:05:00'),
(25, 'dean03@hotmail.com', 'Paula Dietrich', 'Jaylen Towne', 'oreilly.delores@jacobs.info', '$2y$10$dcaj8w123/MDHsiyGgdbVuksfFgJYDCK7gxRJWphkXs1gvpmhG2UG', '0', NULL, 1, NULL, '2017-04-02 00:05:00', '2017-04-02 00:05:00'),
(26, 'kian.graham@gmail.com', 'Bernadine Lockman', 'Lorna Green DVM', 'owalker@macejkovic.net', '$2y$10$702JvWp8qG3Augp/6Eg/XeUHAxUgKH5Il.ftE8bxcICU.ij.42vv.', '0', NULL, 0, NULL, '2017-04-02 00:05:00', '2017-04-02 00:05:00'),
(27, 'rbraun@yahoo.com', 'Prof. Casper Wyman IV', 'Dr. Ray Bahringer II', 'melisa.hand@carter.com', '$2y$10$AbjdvBoTQ9lsn1B2p12B4ugSl8l.UsQsu22a.z09eQpkXeS6Qh/AW', '0', NULL, 1, NULL, '2017-04-02 00:05:00', '2017-04-02 00:05:00'),
(28, 'ashlynn84@yahoo.com', 'Joe Batz', 'Wellington Kihn MD', 'tkirlin@walter.biz', '$2y$10$J4DvW1rL6anhaNRGxmvUOeL5dGweJDTGAOXI2PWH2Q15GC9fds5EW', '0', NULL, 1, NULL, '2017-04-02 00:05:00', '2017-04-02 00:05:00'),
(29, 'kyost@stamm.net', 'Mr. Ewald Osinski', 'Jasmin Denesik', 'emarvin@flatley.biz', '$2y$10$TLYlq2RYX6JpOPXnjEV.T.5i4Cx/zhQOj8Lvin0KaYf2HfXkkO6zS', '0', NULL, 0, NULL, '2017-04-02 00:05:00', '2017-04-02 00:05:00'),
(30, 'leanne47@hotmail.com', 'Broderick Stanton', 'Lea Kertzmann', 'shakira44@waters.org', '$2y$10$t4NeEMI1JLnFs/z3ZbdFtO82mCg/g9XOzIlgsM33Nj4RTjPaP.s9e', '0', NULL, 0, NULL, '2017-04-02 00:05:00', '2017-04-02 00:05:00'),
(31, 'blick.casimer@yahoo.com', 'Mertie Hilll', 'Ferne Okuneva', 'mitchell.keith@gmail.com', '$2y$10$JipTXEC//6iJxL6/J5Tdwux3Q1U7XtnPQEGMBjSU8wo9IovK3r94a', '0', NULL, 1, NULL, '2017-04-02 00:05:01', '2017-04-02 00:05:01'),
(32, 'egoyette@toy.com', 'Conor Lebsack', 'Dr. Albina Powlowski', 'qziemann@gmail.com', '$2y$10$CTEbs1l3pvf3ES7.J7HqQurubmFR8TJ9LslNldPFPdGfPuXdnRT9S', '0', NULL, 0, NULL, '2017-04-02 00:05:01', '2017-04-02 00:05:01'),
(33, 'vkessler@hotmail.com', 'Abner Harber', 'Peyton Pagac', 'ttillman@emard.info', '$2y$10$.VD7Fs1suaXrRrpv3pk.XezqdqwU2C26dt5QW5Ok/p2GGB2WjLzLa', '0', NULL, 1, NULL, '2017-04-02 00:05:01', '2017-04-02 00:05:01'),
(34, 'tressa69@yahoo.com', 'Bryana Yundt', 'Stefan Beatty DVM', 'lydia.schneider@yahoo.com', '$2y$10$8.gOIST2OrGBg2HgdqHTreGsgc2EST2QKYwlFgKIGEAVYT6LwjkyW', '0', NULL, 1, NULL, '2017-04-02 00:05:01', '2017-04-02 00:05:01'),
(35, 'ycummerata@kunde.org', 'Reuben Thiel', 'Robert Boehm DDS', 'kihn.vernie@bartell.biz', '$2y$10$bhu8iq8nAjyCQlo96a4n6ewcFNa4L5VznFCzw3Lu0M5V9nNRN.oHm', '0', NULL, 1, NULL, '2017-04-02 00:05:01', '2017-04-02 00:05:01'),
(36, 'ullrich.halle@schimmel.com', 'Ottilie Wilderman', 'Americo Bednar V', 'von.weldon@yahoo.com', '$2y$10$zJpd732WnM2qKfaY63rx6uexZ7aewIW8INvCvPf3RjF2aVpmM286K', '0', NULL, 1, NULL, '2017-04-02 00:05:01', '2017-04-02 00:05:01'),
(37, 'gottlieb.myrl@hoeger.org', 'Frances Sporer DDS', 'Katelynn Schuppe', 'olen.ernser@yahoo.com', '$2y$10$iEAoH/n0VdSuS5Adwzmof.NpacEmmkXHaQrvsUltktw9fYdQv5NVG', '0', NULL, 0, NULL, '2017-04-02 00:05:01', '2017-04-02 00:05:01'),
(38, 'lborer@gmail.com', 'Maynard Lakin', 'Jedediah Herzog', 'rafael86@hotmail.com', '$2y$10$4a1w8fTL1uUfpyN5ApxUF.4Ni1LSLQBezp0hyOUJjxpmAtoNtvZSu', '0', NULL, 0, NULL, '2017-04-02 00:05:01', '2017-04-02 00:05:01'),
(39, 'marlon75@ratke.com', 'Mrs. Vincenza Casper', 'Rosalinda Nikolaus MD', 'vito26@bashirian.com', '$2y$10$8glpFVEBBwd0791/4rZExupoAsk/AKh7H/kvE6hg9C2aSG30rkROW', '0', NULL, 0, NULL, '2017-04-02 00:05:01', '2017-04-02 00:05:01'),
(40, 'etillman@hotmail.com', 'Dr. Noel Miller', 'Ms. Valerie Wiza', 'ivy.bailey@stamm.org', '$2y$10$YRMANfjhTJ82EaDwPNyF7.EhxjJNcnJQm9yBz2vzckH9VqDUybCGa', '0', NULL, 1, NULL, '2017-04-02 00:05:01', '2017-04-02 00:05:01'),
(41, 'schoen.bertram@hermann.net', 'Dorothea Thompson', 'Jerry Bins', 'bette.boyle@walker.info', '$2y$10$q2W5DxODTTa2m/kZkVEj2.eM2rQ82xtIJ/srThWr3LP/WheekYu4u', '0', NULL, 0, NULL, '2017-04-02 00:05:01', '2017-04-02 00:05:01'),
(42, 'elockman@kihn.biz', 'Mrs. Karina Altenwerth IV', 'Esther Halvorson', 'magdalen.cartwright@leannon.com', '$2y$10$JumK4cazfwZ06DbAUXFUqOXFPNi/fEbV4oXVrEjSo08SBOQx1n1TC', '0', NULL, 1, NULL, '2017-04-02 00:05:01', '2017-04-02 00:05:01'),
(43, 'lamont.nader@hotmail.com', 'Marlin Pfannerstill DDS', 'Golden Walker Jr.', 'hilbert32@gmail.com', '$2y$10$U/aA3vjtdmO.YtK7CJsuOuK3mXH2GsU.KopNqCnjwslGuiAPwgHP6', '0', NULL, 1, NULL, '2017-04-02 00:05:01', '2017-04-02 00:05:01'),
(44, 'bfahey@rosenbaum.biz', 'Cathrine Sporer', 'Mrs. Kiana Shields', 'thurman.mraz@ernser.com', '$2y$10$JjxGg/cDKrVgS3/0cO3hc.dfR3XXauTRpRhlWzvWUikR65z1eOvxS', '0', NULL, 0, NULL, '2017-04-02 00:05:01', '2017-04-02 00:05:01'),
(45, 'domenico36@yahoo.com', 'Prof. Reece White V', 'Leatha Smith MD', 'gaetano.abshire@corkery.info', '$2y$10$7b5RdzwiBPwDcU1Dzg0oNeZMITDA1UoXyUW92D.vPlWlIwcjbm38i', '0', NULL, 0, NULL, '2017-04-02 00:05:02', '2017-04-02 00:05:02'),
(46, 'yvette65@spencer.net', 'Summer Cremin V', 'Freddie Zemlak V', 'volkman.savion@grady.com', '$2y$10$D/MpMTK0nrZbbY5EL/EJ6OtXlk5a6UUuiroSd./19N6LSLud7GW3u', '0', NULL, 0, NULL, '2017-04-02 00:05:02', '2017-04-02 00:05:02'),
(47, 'elaina07@dickinson.com', 'Prof. Evans Corkery DVM', 'Hulda Stanton Jr.', 'brice93@hotmail.com', '$2y$10$xc.aE3P9uv8DSEveDStmr.VjlCJPSgl1hksqrOrEDOmVwBTP9aoUy', '0', NULL, 0, NULL, '2017-04-02 00:05:02', '2017-04-02 00:05:02'),
(48, 'laurie43@hotmail.com', 'Aaliyah Deckow', 'Doris Ortiz', 'scummerata@ryan.com', '$2y$10$gte5k94yP/Iwx9naOHgQuOtF4YEJXShsOJElc/Dg1s8hOi7wziXNu', '0', NULL, 1, NULL, '2017-04-02 00:05:02', '2017-04-02 00:05:02'),
(49, 'stracke.claudine@pfannerstill.com', 'Emelia Friesen', 'Tom Bruen', 'kaylee.padberg@yahoo.com', '$2y$10$bnhYbVdeQnuioLhsBBzqCOZ0fmNkJYT/IDH9LoBDcDJwXrgiE6iNm', '0', NULL, 0, NULL, '2017-04-02 00:05:02', '2017-04-02 00:05:02'),
(50, 'beer.patience@yahoo.com', 'Dr. Stephan Sanford', 'Etha O''Kon', 'ellis91@dooley.org', '$2y$10$EUbYWZga7L9O24VNCp6syujUKYxAS6wZiw/9FRlkZlhdMJ3IlzPLe', '0', NULL, 1, NULL, '2017-04-02 00:05:02', '2017-04-02 00:05:02'),
(51, 'eugene.reinger@yahoo.com', 'Elyse Jakubowski', 'Kelsie Kulas Sr.', 'miracle70@hotmail.com', '$2y$10$8Yrs3ygjaxjZiz5.Fd75jeNzTXzN.1ZIgDvfQFbuHi8gWaFUPeYXK', '0', NULL, 1, NULL, '2017-04-02 00:05:02', '2017-04-02 00:05:02'),
(52, 'thermiston@hotmail.com', 'Prof. Isaias Heller II', 'Margaretta Jaskolski IV', 'karli07@jacobs.net', '$2y$10$pzTNJ3gq6uRlt31rrxyobuoNB5B5ZAAKCg.ysqDcKwvdJSnXTkBiu', '0', NULL, 1, NULL, '2017-04-02 00:05:02', '2017-04-02 00:05:02'),
(53, 'windler.vernie@hand.biz', 'Linwood Daniel', 'Prof. Henderson Stroman', 'lula30@hotmail.com', '$2y$10$u7TumggANsr6.fwt7rFF6uaHuUu.WREkR8VOS212tioTGv6f2dOZC', '0', NULL, 1, NULL, '2017-04-02 00:05:02', '2017-04-02 00:05:02'),
(54, 'cummerata.kathryn@yahoo.com', 'Colt McCullough', 'Roxanne Bailey', 'mbogisich@zemlak.org', '$2y$10$/DlodiTn1vLEIMbVev7xu.T1/QHPjECKcus.QRPWUKgqx/HU7ysoe', '0', NULL, 1, NULL, '2017-04-02 00:05:02', '2017-04-02 00:05:02'),
(55, 'rohan.alexis@hotmail.com', 'Dr. Earnestine Grimes', 'Prof. Meggie Kuvalis IV', 'berry.okon@gmail.com', '$2y$10$Vp0vNMlUzzTcYl/1KfCst.sTZ3sLn/xb1Pg/urL.qIT4J1kEMqaca', '0', NULL, 1, NULL, '2017-04-02 00:05:02', '2017-04-02 00:05:02'),
(56, 'cbauch@hermiston.com', 'Leone Nikolaus', 'Prof. Helena Nader IV', 'lockman.emelie@daugherty.info', '$2y$10$/QokpSCl/w75HGKucb9sKumGced6KPUYybSAuH07v8F5ARuZ82S8y', '0', NULL, 0, NULL, '2017-04-02 00:05:02', '2017-04-02 00:05:02'),
(57, 'sbednar@yahoo.com', 'Prof. Alanis Boehm II', 'Lisette Zulauf', 'theo97@yahoo.com', '$2y$10$xB1FHMmYSm7VC4Z8c6DKruf/0P.bfNyCq.q7xOf5keG6N.9OebcUK', '0', NULL, 1, NULL, '2017-04-02 00:05:02', '2017-04-02 00:05:02'),
(58, 'stokes.hester@hauck.com', 'Destiny Bruen', 'Gladyce Ernser', 'pattie10@baumbach.com', '$2y$10$j7lGBvczxE7wqH0ydhYqxOlXXp6rL8uNoL5X2WazqajBhFXTsWFb6', '0', NULL, 0, NULL, '2017-04-02 00:05:02', '2017-04-02 00:05:02'),
(59, 'maggio.curtis@yahoo.com', 'Kenton Hudson', 'Missouri Daugherty', 'leuschke.roscoe@spinka.com', '$2y$10$CXZFcUuecALHGw4fFaELd.Ds6lXDZz6xTKShURr5bx76GE8yO5b8S', '0', NULL, 1, NULL, '2017-04-02 00:05:02', '2017-04-02 00:05:02'),
(60, 'cade.baumbach@cronin.info', 'Dudley Becker', 'Prof. Allan Waelchi', 'roob.barney@hotmail.com', '$2y$10$CdhYHAs0hYxh/y3f7Cu5k.EX.yKwEdW2MiIvXLVuHQZf0xhpq5rBG', '0', NULL, 1, NULL, '2017-04-02 00:05:03', '2017-04-02 00:05:03'),
(61, 'velda98@yahoo.com', 'Kameron Dicki', 'Berenice McCullough', 'johann.nienow@beatty.info', '$2y$10$q2Q5alyef5G6KkRIVF0sg.1R3/MXrs1v3lN3sxn3iiE5kxY.fF6fa', '0', NULL, 0, NULL, '2017-04-02 00:05:03', '2017-04-02 00:05:03'),
(62, 'fwuckert@hotmail.com', 'Mrs. Eve Hegmann DDS', 'Jaqueline Hand MD', 'brad45@hotmail.com', '$2y$10$xq6RVF6EO8IMd2O8JkRvVeDnqE4foVBMRG7go1zeI1/wUThntLb36', '0', NULL, 0, NULL, '2017-04-02 00:05:03', '2017-04-02 00:05:03'),
(63, 'szulauf@carroll.com', 'Tierra Eichmann', 'Mr. Harmon Runolfsdottir', 'lorna59@bechtelar.net', '$2y$10$EM6UmoUwmI8T3BP0w/GbhuACYDpkc0JSjOkK.62c/WXWwdsVsGuOC', '0', NULL, 1, NULL, '2017-04-02 00:05:03', '2017-04-02 00:05:03'),
(64, 'annamarie11@hintz.net', 'Jaqueline Hettinger', 'Mckenna Tremblay PhD', 'ndare@yahoo.com', '$2y$10$xwd16trS3XBAaFv0pfPU9epGVpWj7y4eqGor.0ivzOf9nYTmjjvS6', '0', NULL, 0, NULL, '2017-04-02 00:05:03', '2017-04-02 00:05:03'),
(65, 'nterry@kiehn.com', 'Carroll Dickens', 'Ms. Ada Trantow Sr.', 'atremblay@gmail.com', '$2y$10$7uVC9864wTOdFS.1./eeEuRPpTXStsLxFBPVgTyLLmKNRp0Rr4YdO', '0', NULL, 0, NULL, '2017-04-02 00:05:03', '2017-04-02 00:05:03'),
(66, 'simonis.kitty@auer.com', 'Dr. Helmer West Sr.', 'Alexzander Koepp DDS', 'ustehr@ortiz.com', '$2y$10$pbf8U481pUY8k0ovKwPLZOUeXpjR/YjlTu9.LZwRXE27ezmax93Z.', '0', NULL, 1, NULL, '2017-04-02 00:05:03', '2017-04-02 00:05:03'),
(67, 'elvera01@walter.com', 'Danial Hettinger', 'Rey Yundt', 'nterry@yahoo.com', '$2y$10$E1bGSn.KYr5QYldIt25m0e2GDOQ03t/st.sOam1gQFjsvlL78LBQm', '0', NULL, 1, NULL, '2017-04-02 00:05:03', '2017-04-02 00:05:03'),
(68, 'simonis.curt@yahoo.com', 'Sonny Stamm', 'Geraldine Kuhlman', 'ariane98@zboncak.info', '$2y$10$k5Zz.aZnD67cBS45Nj6IxeYxoD9IbtLIgkD9uoXVI0EY1H3FhjRhW', '0', NULL, 0, NULL, '2017-04-02 00:05:03', '2017-04-02 00:05:03'),
(69, 'therese.gerhold@gmail.com', 'Mr. Geovanni Ledner', 'Prof. Delfina Kunde', 'ngreen@romaguera.com', '$2y$10$EgKRigNQhFwW9UkGzWqeAu98MbHOE/Ku0EM8GbFCpFUqEOFT4xeOK', '0', NULL, 1, NULL, '2017-04-02 00:05:03', '2017-04-02 00:05:03'),
(70, 'geovanny.schultz@veum.com', 'Ericka Langworth', 'Destany Schuppe DVM', 'dtorphy@gmail.com', '$2y$10$pcfThzz7lfQeCkeL5Rsb9.hcAwQ3Vg0qaJQeRWnwLYDdZCiQ2om16', '0', NULL, 1, NULL, '2017-04-02 00:05:03', '2017-04-02 00:05:03'),
(71, 'crona.idell@predovic.com', 'Caden Pfannerstill PhD', 'Esperanza Spinka', 'maye.smitham@runolfsdottir.biz', '$2y$10$b0jipP69I16dUUZsFSC1.Os9UtpSzsRc8SDHI1EggQ1yhq1Air7O.', '0', NULL, 0, NULL, '2017-04-02 00:05:03', '2017-04-02 00:05:03'),
(72, 'darlene57@thiel.net', 'Oleta Purdy I', 'Tobin Waters V', 'jaeden.walsh@maggio.com', '$2y$10$bkokEPDC1ugSNwOH.jNFsuxePkjW6HQ3I6B0emU30UJuj8e6AqY56', '0', NULL, 1, NULL, '2017-04-02 00:05:03', '2017-04-02 00:05:03'),
(73, 'carley47@mante.info', 'Dr. Laurine O''Reilly Sr.', 'Augustus Bruen', 'ghomenick@hotmail.com', '$2y$10$kwiDD.oWchc1P9eB.63TCOr7Gvy9jqHvznjamc8Oe9Z5r1F/Iepa2', '0', NULL, 0, NULL, '2017-04-02 00:05:03', '2017-04-02 00:05:03'),
(74, 'runolfsson.bria@yahoo.com', 'Mariela Marquardt', 'Prof. Elyse Goldner Sr.', 'trisha79@gislason.net', '$2y$10$nb6bKIPelmnaHjj/8zt/kedKZx6En6tgiwEV66L5kh7laN5W63VXO', '0', NULL, 0, NULL, '2017-04-02 00:05:04', '2017-04-02 00:05:04'),
(75, 'cierra72@armstrong.com', 'Eugene Schaefer', 'Maida Mitchell', 'reynolds.tamara@hotmail.com', '$2y$10$XT7Fh48ZIhwUdRfQgsllCOL2Kofao66AHG9Fr1a2iXXxn4h.ygu6W', '0', NULL, 1, NULL, '2017-04-02 00:05:04', '2017-04-02 00:05:04'),
(76, 'hintz.nico@hotmail.com', 'Susan Oberbrunner', 'Shannon Bednar', 'grant.isobel@yahoo.com', '$2y$10$K3xOUnmaykazjaUFbD6fAunsOeW8LVoGKS/OqRuhV76xjJWnXic3O', '0', NULL, 0, NULL, '2017-04-02 00:05:04', '2017-04-02 00:05:04'),
(77, 'houston22@huel.com', 'Stephon Ebert', 'Enid Cronin', 'eohara@yahoo.com', '$2y$10$nrowkMQPkMZCNmaD5d/98OElag6I3xwOeMnQR/bg6HJace5JS482W', '0', NULL, 0, NULL, '2017-04-02 00:05:04', '2017-04-02 00:05:04'),
(78, 'christiana34@hotmail.com', 'Mr. Salvatore Yundt DVM', 'Prof. Estevan Barrows MD', 'xdamore@hotmail.com', '$2y$10$PaRqUDklJILTnGqa5mADwuEFQSirsGS4uiaek2E836Cm5rPpeF1G6', '0', NULL, 0, NULL, '2017-04-02 00:05:04', '2017-04-02 00:05:04'),
(79, 'ankunding.chandler@hilll.com', 'Deonte Fritsch', 'Esta McGlynn', 'marjolaine29@watsica.com', '$2y$10$wjQ7kSz.SgcQlqMX6r46GO0FkwkK7BM5jQcwUvPRYakfMsTAwuwMi', '0', NULL, 1, NULL, '2017-04-02 00:05:04', '2017-04-02 00:05:04'),
(80, 'margarita46@hotmail.com', 'Lizzie Wolff', 'Gillian Hamill DDS', 'alda18@gmail.com', '$2y$10$EySn7nZ2V9hajls/LixTSuufK7BRb4Sy4MKNfDVLx1InPsENhsiee', '0', NULL, 1, NULL, '2017-04-02 00:05:04', '2017-04-02 00:05:04'),
(81, 'clare.aufderhar@hotmail.com', 'Florine Goldner DVM', 'Cicero Williamson', 'dschmidt@rowe.org', '$2y$10$D3AIRfZRUACQM3FB.cEb5OZycOoT10ZC6pz2QISr6YpEC07cb.dIK', '0', NULL, 0, NULL, '2017-04-02 00:05:04', '2017-04-02 00:05:04'),
(82, 'rchamplin@koss.com', 'Neoma Mante V', 'Prof. Stefan Christiansen V', 'robel.uriah@price.com', '$2y$10$FTA9Y8npDzZeaHAPv4cq..yW8RQrxtBGhI.jeE8lW3rrmN/14A7Tm', '0', NULL, 1, NULL, '2017-04-02 00:05:04', '2017-04-02 00:05:04'),
(83, 'andrew74@gmail.com', 'Krista Little', 'Braxton Sauer DDS', 'iluettgen@gmail.com', '$2y$10$1QCuxU6/rciWPc5cQ0EGMe9374XLX4yqsL/9W2rA1QB04wbCa9VdG', '0', NULL, 0, NULL, '2017-04-02 00:05:04', '2017-04-02 00:05:04'),
(84, 'jamey66@greenholt.biz', 'Dr. Jany Huel', 'Carole Harris', 'arnoldo19@yahoo.com', '$2y$10$vnuHioCdcHk5qBFFdSUKmeYCmh1vH4Ry/0lRRrJaiuOkou2sgF.dO', '0', NULL, 0, NULL, '2017-04-02 00:05:04', '2017-04-02 00:05:04'),
(85, 'haylie.wunsch@gleichner.com', 'Dixie Thompson', 'Liana Conroy', 'ted31@weissnat.com', '$2y$10$HeVTUJ.423XrUk4JBH/G3.wqoZA2qoab8dlGzm131z4hbmHayaERS', '0', NULL, 0, NULL, '2017-04-02 00:05:04', '2017-04-02 00:05:04'),
(86, 'bwaters@effertz.info', 'Lilyan Sipes Sr.', 'Emmie Dooley', 'leone82@rempel.org', '$2y$10$jljDdeR36dhwz3nOGZ9O6ei0fzTFQAorBe2M4XE/5Z5L5Jb3TUzhe', '0', NULL, 0, NULL, '2017-04-02 00:05:04', '2017-04-02 00:05:04'),
(87, 'lcollins@yahoo.com', 'Mrs. Ivy Adams', 'Cleo Nader Sr.', 'casimir.bernhard@marks.com', '$2y$10$FB15yJCHXQ93mxlt755qMOQAz4oPutN8sV.ye8rFpSg5uUTTcStau', '0', NULL, 0, NULL, '2017-04-02 00:05:04', '2017-04-02 00:05:04'),
(88, 'vada.swift@simonis.com', 'Prof. Josiah Sawayn', 'Prof. Kay Considine DVM', 'alowe@gmail.com', '$2y$10$2bNDBa9DouVv82Fl4WqvjeRgWx.0YqlXAoyy71AU13kCSO0FSSMcm', '0', NULL, 1, NULL, '2017-04-02 00:05:05', '2017-04-02 00:05:05'),
(89, 'rene.larkin@haag.com', 'Miss Joelle O''Keefe DVM', 'Ms. Leonie Kuphal', 'marcelina.braun@gmail.com', '$2y$10$fPQyOAACInsBssTKehYuxOb2Rptpmsv48e3DeXnSZ9nCnUUCkIfYu', '0', NULL, 1, NULL, '2017-04-02 00:05:05', '2017-04-02 00:05:05'),
(90, 'olson.chaim@yahoo.com', 'Mekhi Kuhic', 'Miss Madaline Prosacco V', 'casimer77@davis.com', '$2y$10$aLwsHu/jx5fAGQH0GqSrWu0xlTEyCRijkt6cJ4L7Upf0GWzIf18A2', '0', NULL, 1, NULL, '2017-04-02 00:05:05', '2017-04-02 00:05:05'),
(91, 'otto39@rogahn.com', 'Alexandra Rau PhD', 'Mr. Jack Ebert', 'darien08@streich.com', '$2y$10$5iQNDqKvAnvzczwUgDVUzuDofA2VdCL2rKBljpMTnKU3uuU/DCvaK', '0', NULL, 1, NULL, '2017-04-02 00:05:05', '2017-04-02 00:05:05'),
(92, 'hortense67@hotmail.com', 'Dr. Easton Lindgren IV', 'Orion Veum', 'iruecker@hotmail.com', '$2y$10$HFsWY.fulfKavcSBxNtNhe98pPwa5w/g9lns6SgBEItob2jRwb1b2', '0', NULL, 1, NULL, '2017-04-02 00:05:05', '2017-04-02 00:05:05'),
(93, 'zhansen@bins.info', 'Vergie Pouros V', 'George Walsh', 'dallin.goyette@hotmail.com', '$2y$10$WVB7iKVpT39I6nlDTD7uWuLKkJNX2qcBm45iddmsZxyQhnmrPicFC', '0', NULL, 1, NULL, '2017-04-02 00:05:05', '2017-04-02 00:05:05'),
(94, 'vgleason@yahoo.com', 'Darrick Fritsch Sr.', 'Maximillia Bernier IV', 'uupton@rolfson.com', '$2y$10$cHGY1m/5XdoXEyrIT1HUjetw5YQYHoD9bzmBduxmYJdqVqSa8DvLK', '0', NULL, 0, NULL, '2017-04-02 00:05:05', '2017-04-02 00:05:05'),
(95, 'kaycee46@hotmail.com', 'Deshaun Littel', 'Cordie Jast', 'wava96@douglas.com', '$2y$10$pRVunRJ3FtlxnrJ57tXK6ODtA8lZSYPPo1w83R4wzQLHsSKn72UhS', '0', NULL, 1, NULL, '2017-04-02 00:05:05', '2017-04-02 00:05:05'),
(96, 'eduardo.price@hotmail.com', 'Annamarie Krajcik', 'Beulah Spencer', 'kulas.ona@becker.com', '$2y$10$evdCPJZwy6cCwrcJ/rNIwumz2e3YTQzT9BwLIe4JC0YaCZxNm/V8W', '0', NULL, 0, NULL, '2017-04-02 00:05:05', '2017-04-02 00:05:05'),
(97, 'rossie74@shanahan.com', 'Mr. Levi Langosh DDS', 'Corene Nolan', 'novella.heller@gmail.com', '$2y$10$HF/45KRfzzM3HUQFPADBFOtjhEJAuzBUCehME2zKsj436SD8Najyy', '0', NULL, 1, NULL, '2017-04-02 00:05:05', '2017-04-02 00:05:05'),
(98, 'gdach@yahoo.com', 'Glennie McLaughlin', 'Prof. Adolfo Kilback DDS', 'lockman.mose@schaefer.com', '$2y$10$2spMKV/c7dS..CWhlD2HLeziqXIvkNftvhhM3BKpdlLAtcowFrd3i', '0', NULL, 1, NULL, '2017-04-02 00:05:05', '2017-04-02 00:05:05'),
(99, 'wleuschke@yahoo.com', 'Mr. Forrest Schoen', 'Ms. Flavie Kuhic I', 'lenna.parisian@gmail.com', '$2y$10$.3B1NKBTEdh5zewGnaOKQ.jAN12vt7SuBgG7oNS/sHCMgYjGAzC/C', '0', NULL, 0, NULL, '2017-04-02 00:05:05', '2017-04-02 00:05:05'),
(100, 'alexandrine11@yahoo.com', 'Teresa Von', 'Dr. Juvenal Homenick', 'fkunde@yahoo.com', '$2y$10$2gjel6HjfWewXWDZUL6LNeFTADGl0L9u8Ryc.aju7taSVCJHVlKsK', '0', NULL, 0, NULL, '2017-04-02 00:05:05', '2017-04-02 00:05:05'),
(101, 'nmohr@gmail.com', 'Lillie Hayes', 'Geraldine Runte II', 'xbechtelar@blick.com', '$2y$10$5W7.YyP7Te/FWHxJ2gXrNexMBwTMvxX04mE8/f8hQl8UNJS2cGNVe', '0', NULL, 1, NULL, '2017-04-02 00:05:06', '2017-04-02 00:05:06'),
(102, 'njohnston@fahey.com', 'Eugene Bernhard', 'Billy Ortiz', 'christiansen.isaiah@rau.com', '$2y$10$YDgC7teavWdO39wC.XVfguFUJTZs97/Q.yNO20qVlYUGj10s12BkK', '0', NULL, 0, NULL, '2017-04-02 00:05:06', '2017-04-02 00:05:06'),
(103, 'dkeeling@braun.org', 'Prof. Malcolm Marquardt', 'Dr. Muriel Barton', 'hsteuber@heller.com', '$2y$10$sfSEyyPlxtpUEQZawdU8B.qPbYSI4M31AC/iGHhycjPCE/q9m0s6i', '0', NULL, 0, NULL, '2017-04-02 00:05:06', '2017-04-02 00:05:06'),
(104, 'marcelino92@gmail.com', 'Linnea Simonis', 'Chester Rowe', 'wilber.johns@williamson.com', '$2y$10$dRUy21R9bcXLeI.oC2IoVOiBbNWK57qafm5gjxIwlVQBryVIbjRbG', '0', NULL, 0, NULL, '2017-04-02 00:05:06', '2017-04-02 00:05:06'),
(105, 'chadd.miller@hotmail.com', 'Santiago Funk', 'Francis Wilkinson', 'lmoore@jakubowski.com', '$2y$10$7vUm2hDkpRqapkFbR3.w7eA6/IIwRbSPkDJq8ZbRvGabP7ZyCX5Ry', '0', NULL, 0, NULL, '2017-04-02 00:05:06', '2017-04-02 00:05:06'),
(106, 'wiza.daphne@will.com', 'Reba Donnelly', 'Mrs. Juana Reilly III', 'simone.dare@anderson.org', '$2y$10$Koan2qjqYIVHHgwb/DmWhuGz1TV9Rf0rEev4wCzRp6JuFBpfNty7S', '0', NULL, 0, NULL, '2017-04-02 00:05:06', '2017-04-02 00:05:06'),
(107, 'schumm.mozelle@nikolaus.info', 'Larue Zemlak', 'Mr. Bradley Leannon IV', 'schuster.jasper@yahoo.com', '$2y$10$TtCKntZjrWBBLeQgRc19Iuvyn4kLIqtzAi8w.17V4lQGyi5dLd1Xe', '0', NULL, 1, NULL, '2017-04-02 00:05:06', '2017-04-02 00:05:06'),
(108, 'morissette.casandra@yahoo.com', 'Alana Witting', 'Guillermo Ondricka DDS', 'cherman@grimes.com', '$2y$10$WxpdMDQrVne1sCHMhxFnme8nfY72vKp2sq2LS1OKMXLEpmaWro98m', '0', NULL, 0, NULL, '2017-04-02 00:05:06', '2017-04-02 00:05:06'),
(109, 'damore.kevin@gmail.com', 'Beryl Mayert', 'Dr. Wilbert Gulgowski', 'ferry.melisa@beahan.com', '$2y$10$U50J8KWY.ZCWKPucS/.hbOo1lW0/HQ0MMM00EJKznFOsrmcrApTZm', '0', NULL, 0, NULL, '2017-04-02 00:05:06', '2017-04-02 00:05:06'),
(110, 'paxton28@hotmail.com', 'Mr. Elwyn DuBuque Sr.', 'Demetrius Zieme', 'nova02@yahoo.com', '$2y$10$0oKaoCGlZvFPAy7JVRg1wOf2uB4fKSNLFwzSF7rnpZNIXaKX9oAsy', '0', NULL, 1, NULL, '2017-04-02 00:05:06', '2017-04-02 00:05:06'),
(111, 'joannie01@hotmail.com', 'Prof. Isaac Nienow', 'Vladimir White', 'evan87@hotmail.com', '$2y$10$hsqMwLfANIDIiaxRgv15JeZvUvZfeVI5capc3Ij3eHCvbBXyvvhTC', '0', NULL, 1, NULL, '2017-04-02 00:05:06', '2017-04-02 00:05:06'),
(112, 'mohammad39@wunsch.biz', 'Maggie Tromp IV', 'Mr. Arvid Schmeler', 'wiegand.allene@gmail.com', '$2y$10$W9grizrGdsfbCERETq.WZOfPq/oTntA7SHM3qESuyee5ZlwaDX7kq', '0', NULL, 0, NULL, '2017-04-02 00:05:06', '2017-04-02 00:05:06'),
(113, 'joseph24@yahoo.com', 'Albertha McClure', 'Prof. Griffin Hilll', 'jerad82@yahoo.com', '$2y$10$4qIBi9nshvsIPwRpqVyty.eoCjuDvfrxoZPGyxXC35wJnYRjv7s4m', '0', NULL, 1, NULL, '2017-04-02 00:05:06', '2017-04-02 00:05:06'),
(114, 'vkutch@gmail.com', 'Dayne Spencer', 'Napoleon Green', 'murl38@gmail.com', '$2y$10$oCEdyYQzbAydux7/C6c1Ke4cMUPb4xjkLVZAnL8N.hmXFUZkYlFUW', '0', NULL, 0, NULL, '2017-04-02 00:05:06', '2017-04-02 00:05:06'),
(115, 'vheller@schoen.info', 'Mikayla Hilll', 'Dannie Kub', 'runte.gaylord@hotmail.com', '$2y$10$w6EKRac/gCF1rYQQ9545P.gq2AW4Oql.Er3sGo6WLs7RE.ioibVxS', '0', NULL, 1, NULL, '2017-04-02 00:05:07', '2017-04-02 00:05:07'),
(116, 'macejkovic.cesar@yahoo.com', 'Nathanael Haley Sr.', 'Mr. Crawford Rath DDS', 'lucienne73@friesen.com', '$2y$10$HA9cJSO7ZxoK5gyyD7Wxue5TCJt8SKmLhebekEiHEPOQAyIFpDyL2', '0', NULL, 1, NULL, '2017-04-02 00:05:07', '2017-04-02 00:05:07'),
(117, 'shad68@hotmail.com', 'Judy Barton', 'Prof. Cesar Boehm Sr.', 'kendra.murazik@collins.biz', '$2y$10$8rLbPlqZtMeKbvarE2LOT.nJOFtCKyj37KsEssHFR2leyitXaM7sS', '0', NULL, 0, NULL, '2017-04-02 00:05:07', '2017-04-02 00:05:07'),
(118, 'harvey.elsa@hotmail.com', 'Bernard Schmidt', 'George Walsh', 'emmy.mitchell@yahoo.com', '$2y$10$i9J/bw.jOkJ/w16zrjmHvu4Ho71E4JAew8T281OW9yMgfBd3Ms5Gu', '0', NULL, 1, NULL, '2017-04-02 00:05:07', '2017-04-02 00:05:07'),
(119, 'jaida77@gmail.com', 'Vada Barton', 'Tyler Hansen', 'pharber@gmail.com', '$2y$10$ZU8I0z2HfUJLO.TBeCkpberFP8DTRkDtXBex6qJE60WmhNceWusAO', '0', NULL, 0, NULL, '2017-04-02 00:05:07', '2017-04-02 00:05:07'),
(120, 'sbauch@gmail.com', 'Jaron Rath', 'Dr. Tavares Leuschke', 'lucio10@erdman.org', '$2y$10$iMeLfMJHzS/3Kh7irBHY3.9cLUH4.rjvWp/Jk2B8o/qrhcNdIGrf2', '0', NULL, 1, NULL, '2017-04-02 00:05:07', '2017-04-02 00:05:07'),
(121, 'jovany23@yahoo.com', 'Dana Hirthe', 'Mr. Enrique Heidenreich V', 'jordyn41@runolfsdottir.com', '$2y$10$N9Ak5OZbgTbYX8EyBbGL.OfWFKK8inLJ.gvkP1P5Cf32qxt5nWC5y', '0', NULL, 1, NULL, '2017-04-02 00:05:07', '2017-04-02 00:05:07'),
(122, 'madaline32@hotmail.com', 'Jesse Marquardt', 'Danial Abbott', 'romaguera.nikolas@miller.net', '$2y$10$McU9JgTraLuMHDpCuArWFu4m/QpEJJNm7O7vPGxl6p9/Nezz8Ad4y', '0', NULL, 0, NULL, '2017-04-02 00:05:07', '2017-04-02 00:05:07'),
(123, 'scotty.rempel@hotmail.com', 'Kaleigh Schulist DVM', 'Lilla Jacobi II', 'charity94@green.com', '$2y$10$0JkUxbtQfEIFhwWEF.nff.Twn955HtEib27N6tRf0ENQ4Za7e2wEO', '0', NULL, 0, NULL, '2017-04-02 00:05:07', '2017-04-02 00:05:07'),
(124, 'eschiller@hotmail.com', 'Katharina Greenfelder', 'Clifford Reilly', 'ybeahan@lueilwitz.info', '$2y$10$MVV77TcGUiXob/9CVD8mVe8U.oHXnjqteLImoV8Dzu4v9NlUxk8Ga', '0', NULL, 0, NULL, '2017-04-02 00:05:07', '2017-04-02 00:05:07'),
(125, 'langosh.raleigh@doyle.biz', 'Katherine Blick', 'Enid Wehner', 'joel.rippin@gmail.com', '$2y$10$cFPNB2iw7QjTYLBP7/MOyucIgkfrYOTAJoEdGszpNknFjMiMZFRwC', '0', NULL, 1, NULL, '2017-04-02 00:05:07', '2017-04-02 00:05:07'),
(126, 'max85@hotmail.com', 'Miss Jaqueline Kutch III', 'Prof. Avis Koepp MD', 'walker.jazmyn@hotmail.com', '$2y$10$kEAVh39Lt8II06O5E5zhCe9y.XPdR6/x6ZIij3YvlKmFu02a6q4Te', '0', NULL, 0, NULL, '2017-04-02 00:05:07', '2017-04-02 00:05:07'),
(127, 'zkerluke@gleichner.com', 'Mr. Chet Murphy Jr.', 'Julianne Baumbach', 'uhoppe@yahoo.com', '$2y$10$SLaadV.CKCN0YoTBjk/TXupC1HCmMEyD9uFxkeuhEuE45oYmIOJdG', '0', NULL, 0, NULL, '2017-04-02 00:05:07', '2017-04-02 00:05:07'),
(128, 'london31@rippin.com', 'Amelia Prohaska', 'Jarrell Pollich', 'rstehr@gmail.com', '$2y$10$2ZTJFAy7R9XZTBxiA7gwz.VUuXOh9WStgxi/7T5FRUnRhp9Kje3H6', '0', NULL, 1, NULL, '2017-04-02 00:05:07', '2017-04-02 00:05:07'),
(129, 'lwalker@gmail.com', 'Prof. Domingo Mueller', 'Mr. Ted Rogahn DDS', 'smith.russell@moen.com', '$2y$10$stUnZjGbrsJaY0D/YyDEn.jBsSCx95jvEKfGNrBxQ6gGoNVuWvqga', '0', NULL, 1, NULL, '2017-04-02 00:05:08', '2017-04-02 00:05:08'),
(130, 'emiliano.vonrueden@yahoo.com', 'Dr. Jarred Swaniawski', 'Elena Wisoky', 'pgrady@hotmail.com', '$2y$10$Gly7AB.3GxNIZzAH1nFE3.qosQQRcmePKciU1JIDAnC1pz.JLdSki', '0', NULL, 1, NULL, '2017-04-02 00:05:08', '2017-04-02 00:05:08'),
(131, 'selena.kutch@huel.net', 'Ms. Alysson Turcotte Jr.', 'Prof. Keanu Dickens I', 'emard.ollie@jenkins.com', '$2y$10$ih2hrWyiYWeN83Iowoi8leRHpkc8WfjUZTQUxqw.K96MxfwgwwQVW', '0', NULL, 1, NULL, '2017-04-02 00:05:08', '2017-04-02 00:05:08'),
(132, 'rschneider@yahoo.com', 'Leilani Abbott', 'Frederic Fay IV', 'nnitzsche@hotmail.com', '$2y$10$7qLcfrDSPPDwkWJiWurWae2ObfJ7mblqoEOxm7bPZB5IRdShV3tGG', '0', NULL, 1, NULL, '2017-04-02 00:05:08', '2017-04-02 00:05:08'),
(133, 'fern.breitenberg@yahoo.com', 'Ansley Murray', 'Baron Stokes', 'amari82@erdman.com', '$2y$10$uquuFE6cHdn9OUPcWN50aufDs1Jkr1M/3khvfLZOdvzNQ2.KpBxxm', '0', NULL, 1, NULL, '2017-04-02 00:05:08', '2017-04-02 00:05:08'),
(134, 'lakin.travon@yahoo.com', 'Naomie Muller', 'Treva Smith MD', 'skiles.moshe@spencer.com', '$2y$10$nZ854jS94MYE7jcMpOP/E.3zYGnOR/jTt2FTVdDOFRxrkBgmKcNXa', '0', NULL, 0, NULL, '2017-04-02 00:05:08', '2017-04-02 00:05:08'),
(135, 'freynolds@yahoo.com', 'Arthur West', 'Jeanette Schroeder', 'wilkinson.columbus@rempel.biz', '$2y$10$17VeaKFCxGFA67igsRKFfOlVKgPQrOYOaBgEdFubPTj2fpYSeCaEu', '0', NULL, 0, NULL, '2017-04-02 00:05:08', '2017-04-02 00:05:08'),
(136, 'kimberly.ullrich@yahoo.com', 'Yasmin Mueller', 'Vita Berge', 'roob.jeremy@sawayn.com', '$2y$10$hrKrKgE56lwii5ZF4HhLNevw0HUfhrj0J4KqdywssWGYsU1fStpfy', '0', NULL, 1, NULL, '2017-04-02 00:05:08', '2017-04-02 00:05:08'),
(137, 'little.maximilian@gerhold.com', 'Mr. Devan Bernier', 'Prof. Warren Mante', 'rosinski@hotmail.com', '$2y$10$cW6CMJFmV8oIcCnlCsQBreTSbWQck0zP9Yr9BYC6tzAZTFDKVbC9W', '0', NULL, 1, NULL, '2017-04-02 00:05:08', '2017-04-02 00:05:08'),
(138, 'effie56@abshire.info', 'Lizzie Muller', 'Prof. Myah Witting', 'elbert.corkery@hotmail.com', '$2y$10$8RhmH8efdONVfltSI6yQ/.EWXuEXmzx52NcNINU/BmGvbmu8nxX9G', '0', NULL, 1, NULL, '2017-04-02 00:05:08', '2017-04-02 00:05:08'),
(139, 'rath.madge@hotmail.com', 'Dr. Theo Kessler IV', 'Linnea Steuber', 'dakota.hane@lebsack.net', '$2y$10$Yxha1BT1ssm554UFoJaIe.vfK/zSEFGrH2KXP0.pGfpK0eUGd9s.S', '0', NULL, 0, NULL, '2017-04-02 00:05:08', '2017-04-02 00:05:08'),
(140, 'wgrady@hotmail.com', 'Ms. Zoe Muller', 'Mikel Waters', 'leanna.bosco@blick.biz', '$2y$10$Nz6EGXd7vI2NrqkIhs7aUuWXxLaV9lBRSZPSQJOljgCHBLcxCdQPu', '0', NULL, 0, NULL, '2017-04-02 00:05:08', '2017-04-02 00:05:08'),
(141, 'annette77@pacocha.com', 'Dr. Gregg Nicolas', 'Dolores Reichert', 'dnikolaus@hotmail.com', '$2y$10$4lAAmGxzSVDj0m9L6q7GQ.t/78zlA9TgN1USSAUwY2CCb5quKCc0a', '0', NULL, 0, NULL, '2017-04-02 00:05:08', '2017-04-02 00:05:08'),
(142, 'pdaniel@yahoo.com', 'Erling Kutch', 'Dr. Cali Olson MD', 'ortiz.sherman@morar.net', '$2y$10$qUw5ZWANrVKi9ZEGvVGhiuph4QddPZWcxLPdfxV4rSo8dgXGw71L6', '0', NULL, 1, NULL, '2017-04-02 00:05:08', '2017-04-02 00:05:08'),
(143, 'batz.noemy@hotmail.com', 'Dr. Laverne Kiehn V', 'Roslyn Eichmann', 'pfeffer.dimitri@hotmail.com', '$2y$10$sACdBc4bCZGAcqotqt3Pc.bAYDk7kCfigUCx6w3DM2OKfCAYl//2S', '0', NULL, 0, NULL, '2017-04-02 00:05:09', '2017-04-02 00:05:09'),
(144, 'rice.johann@emmerich.info', 'Mrs. Jewel Brekke', 'Kassandra Mohr', 'kerluke.manuel@hotmail.com', '$2y$10$zUTYyPUVejfgjK.XQB62JuQoI09BQoE6nR8tDApgNQzqlzWYjTGzC', '0', NULL, 0, NULL, '2017-04-02 00:05:09', '2017-04-02 00:05:09'),
(145, 'santino81@beahan.biz', 'Sidney Schiller', 'Jarrell Barton', 'edaniel@roob.com', '$2y$10$OKfraV.R9Z/1.wBbvmkv..9ayVvOoOKSnZYO9/x6zbeXGHtGatkUa', '0', NULL, 1, NULL, '2017-04-02 00:05:09', '2017-04-02 00:05:09'),
(146, 'genevieve.watsica@gmail.com', 'Raegan Spencer', 'Mr. Johnathon Donnelly', 'quitzon.prudence@willms.net', '$2y$10$9lneubuGf0OKwy1vHkdw3u5cOSW8.u5Zws8PXtXSAaRgYu9wsQa46', '0', NULL, 1, NULL, '2017-04-02 00:05:09', '2017-04-02 00:05:09'),
(147, 'kfriesen@mcglynn.info', 'Reed Turcotte DDS', 'Mrs. Kathryne Nicolas', 'wlesch@hotmail.com', '$2y$10$H8uOsIyPzmwYAOdz1KnOi.6In2rWlrXuRAeRPyv4jVKbyuZUfXs/q', '0', NULL, 1, NULL, '2017-04-02 00:05:09', '2017-04-02 00:05:09'),
(148, 'urussel@lindgren.com', 'Dora Tillman', 'Bettie Schmitt', 'renner.manuel@schultz.com', '$2y$10$E33.T32QelagWQ2I2bwT6OM0PZmOE6ejkOJpiajVVywcsazjiT0SC', '0', NULL, 0, NULL, '2017-04-02 00:05:09', '2017-04-02 00:05:09'),
(149, 'hagenes.yazmin@gmail.com', 'Dr. Jacquelyn O''Conner Sr.', 'Walton Lynch', 'stoltenberg.clark@parker.org', '$2y$10$VTlWQOLvOyJonS.zmmk6qudnvW/p85AVc6R66iqqD8CCpDvXtuizG', '0', NULL, 1, NULL, '2017-04-02 00:05:09', '2017-04-02 00:05:09'),
(150, 'boehm.jerrold@gmail.com', 'Dannie McClure', 'Orlo Prosacco', 'antwan64@hotmail.com', '$2y$10$TEuqaelBta9.AAi6dYV3DeAnB1SX.8HdVLvjGA9hXNsG0TVfkBjOe', '0', NULL, 1, NULL, '2017-04-02 00:05:09', '2017-04-02 00:05:09'),
(151, 'cwyman@ritchie.com', 'Ms. Jada Weber Jr.', 'Dr. Duncan Kulas DDS', 'igrant@considine.com', '$2y$10$76A6mL4c2PoTksFC.wqjcuEbIAI9qndHcBtDHqQbNZHQ0//7CKYmC', '0', NULL, 1, NULL, '2017-04-02 00:05:09', '2017-04-02 00:05:09'),
(152, 'berenice.mckenzie@lakin.biz', 'Miss Ivah Koepp', 'Jessyca Kemmer', 'agutkowski@walter.com', '$2y$10$05LrZEbyye.S.72ck.mlLuMG2GOjnH1PMYe7yqjluxTucaUnBD.Zm', '0', NULL, 0, NULL, '2017-04-02 00:05:09', '2017-04-02 00:05:09'),
(153, 'arvid40@hane.com', 'Mustafa Haley', 'Kenny Keebler', 'gibson.arielle@gmail.com', '$2y$10$2yd0Cdzl5vuEuajZgIvdmOUMlnEEK7Cua6cMMNethiXxOkKE.7FEa', '0', NULL, 1, NULL, '2017-04-02 00:05:09', '2017-04-02 00:05:09'),
(154, 'orin44@gmail.com', 'Mr. Orion Veum', 'Teagan Hammes', 'mmills@corkery.com', '$2y$10$ECN3nGSWm.hvlfEGVFhy8Omvwvd.t5ZMRajceRY4RiettBBRb6cXq', '0', NULL, 0, NULL, '2017-04-02 00:05:09', '2017-04-02 00:05:09'),
(155, 'julie.eichmann@yahoo.com', 'Mittie Moore', 'Ms. Nora Padberg II', 'delores85@hintz.biz', '$2y$10$1mzO24ipfyE09S6h3wDIHu9nL38cqhpgJ7oAasJDRyzSmlNFfZhfW', '0', NULL, 0, NULL, '2017-04-02 00:05:09', '2017-04-02 00:05:09'),
(156, 'dlegros@schaden.com', 'Emely Senger PhD', 'Keyshawn Hudson', 'april.reynolds@reichel.biz', '$2y$10$8UhS.72FggdCEm7VsS.iVObRpUSrwdzzjrKKOUiupMo3yIn72RuGW', '0', NULL, 1, NULL, '2017-04-02 00:05:09', '2017-04-02 00:05:09'),
(157, 'alberta.baumbach@powlowski.com', 'Corbin Rutherford II', 'Alec Kuhlman', 'daniel.tom@corwin.com', '$2y$10$XhNHFL2NcHtBRRIJVR4St.g1iNxb0i5vExvvxwvvAVJO8FuwIUpjm', '0', NULL, 1, NULL, '2017-04-02 00:05:10', '2017-04-02 00:05:10'),
(158, 'stark.carmella@wisozk.org', 'Pauline Wisozk', 'Giuseppe Wyman', 'antoinette36@morissette.info', '$2y$10$8AGW8lzYbg5sVjA8tuAoaOWWMG.uckTYz06tmAr7AzxZ2e6/RW8Yy', '0', NULL, 0, NULL, '2017-04-02 00:05:10', '2017-04-02 00:05:10'),
(159, 'qrodriguez@yahoo.com', 'Rhoda Herman', 'Zachary Jakubowski PhD', 'judson.kulas@gmail.com', '$2y$10$UUBfFa/fiR4KOxeLMvH.GeYe0f9ZxCYRPUxx/s00efMHMsWw6U3aK', '0', NULL, 0, NULL, '2017-04-02 00:05:10', '2017-04-02 00:05:10'),
(160, 'pluettgen@howe.com', 'Dayna Harvey', 'Jessica Pagac', 'jhessel@prosacco.com', '$2y$10$dUTgf35TQyhI9axJZOb52uNa9aqaGRO5unoSZgNItfuaclr.S62HW', '0', NULL, 1, NULL, '2017-04-02 00:05:10', '2017-04-02 00:05:10'),
(161, 'haley10@hotmail.com', 'Ms. Kitty Steuber', 'Cristian Cormier', 'maida.schumm@grady.com', '$2y$10$nJuND1xNuvJTuIfI6LnNhOVBYIRAJAVGLzT6Ng1JjRFODXyiqCJTS', '0', NULL, 0, NULL, '2017-04-02 00:05:10', '2017-04-02 00:05:10'),
(162, 'jimmie18@leannon.com', 'Ottis O''Reilly', 'Rachael Morar', 'beer.mustafa@rolfson.biz', '$2y$10$ONYsjYE9CHGKxFHO3qW0d.D/BX5nW2hy.1ckXQh4mD4gRFJ.z8kvK', '0', NULL, 1, NULL, '2017-04-02 00:05:10', '2017-04-02 00:05:10'),
(163, 'nona99@kautzer.com', 'Bartholome Wiza DDS', 'Hannah Gottlieb DVM', 'udare@torp.org', '$2y$10$OuJNCE.mx.QyFhzTqJMOc.uItVD5twro5K3bbEmZJsRy9ppctTF7q', '0', NULL, 0, NULL, '2017-04-02 00:05:10', '2017-04-02 00:05:10'),
(164, 'zmann@gmail.com', 'Timmy Cronin', 'April Romaguera MD', 'vwitting@gibson.net', '$2y$10$52bPTZ58gvjCuHc.Wjw.e.qCCxA7TFvS6YZnzjfZfD33WluRVxr.i', '0', NULL, 1, NULL, '2017-04-02 00:05:10', '2017-04-02 00:05:10'),
(165, 'gregg14@gmail.com', 'Rico Tremblay', 'Mr. Quentin Schimmel II', 'juwan12@breitenberg.com', '$2y$10$3dERPVc6.zoX81NcUy60tuKe.WiaGY5V.xGQoB2L9ADg6QqTLwse2', '0', NULL, 0, NULL, '2017-04-02 00:05:10', '2017-04-02 00:05:10'),
(166, 'dannie.blick@gmail.com', 'Luz Hayes', 'Valerie Bechtelar DDS', 'carlo38@gmail.com', '$2y$10$bqSEZK1wRWlTOs/.CxsPIeTI3OGM3/ecPhDN275Xj5r4g9WSK75nO', '0', NULL, 0, NULL, '2017-04-02 00:05:10', '2017-04-02 00:05:10'),
(167, 'fspinka@gibson.com', 'Jacklyn Hegmann', 'Estella Turner', 'tjakubowski@marvin.info', '$2y$10$RNBr7RuZ45j0whD.fCv5eeKTWqRVIBWYmR2n4X0ysf4bIlqSrOxWm', '0', NULL, 1, NULL, '2017-04-02 00:05:10', '2017-04-02 00:05:10'),
(168, 'glenna.mitchell@lesch.info', 'Maia Hintz', 'Sigrid Herzog I', 'tomas.jaskolski@kling.com', '$2y$10$ms4n329wz5CZhn8fETIgYurBan8BqxxnJe2i7P4LdfffQHf2t6AiG', '0', NULL, 0, NULL, '2017-04-02 00:05:10', '2017-04-02 00:05:10'),
(169, 'cmcdermott@yahoo.com', 'Prof. Roxane Predovic Sr.', 'Tito Doyle', 'roberts.minnie@beer.com', '$2y$10$3PCAnKuCdHYGb3xDEKXJROY6GEl8lOyrw21p71vKOPgjzfWFahNtO', '0', NULL, 0, NULL, '2017-04-02 00:05:10', '2017-04-02 00:05:10'),
(170, 'pdach@gmail.com', 'Jeramy Paucek', 'Mr. Orin Doyle MD', 'gisselle.walter@funk.com', '$2y$10$Pt75CK1MfpsB.epUR6HMueLKIxZcpf6Auhh3DnkzOByhvP33yShOm', '0', NULL, 0, NULL, '2017-04-02 00:05:11', '2017-04-02 00:05:11'),
(171, 'katherine.schimmel@franecki.com', 'Tremayne O''Conner IV', 'Dr. Noble Ruecker', 'koepp.ericka@howe.com', '$2y$10$KkLzgFcuhJnJHRhBPWVKUuX/fXtLVN80rWCshvWK8E3byii32gCtK', '0', NULL, 0, NULL, '2017-04-02 00:05:11', '2017-04-02 00:05:11'),
(172, 'blick.mohammad@yahoo.com', 'Vivienne Kuhn', 'William Bernier PhD', 'herminia35@fahey.org', '$2y$10$ls..Fqcc7/hwadQJOKmWduGL8mjX3qRV2zTwmn4zYpwxtW9gTPHaG', '0', NULL, 1, NULL, '2017-04-02 00:05:11', '2017-04-02 00:05:11'),
(173, 'deanna77@hotmail.com', 'Orpha Feil', 'Mozelle Batz', 'jovanny.torp@gmail.com', '$2y$10$31I9C50egWOeMieLqNc6G.1VFJErTcPKVmCmUUoygIqyBhjTSe4ce', '0', NULL, 1, NULL, '2017-04-02 00:05:11', '2017-04-02 00:05:11'),
(174, 'jazmyne.dooley@kertzmann.org', 'Jamaal Cruickshank', 'Dr. Eusebio Gusikowski II', 'rmorissette@leffler.biz', '$2y$10$KJWwInGDFQ6Z80hbHpzB.eT6C.WCz5nicDtnb.85TuMOpOX8i.8Im', '0', NULL, 1, NULL, '2017-04-02 00:05:11', '2017-04-02 00:05:11'),
(175, 'considine.arch@hotmail.com', 'Holden Skiles', 'Everett Homenick', 'dgrimes@mcglynn.com', '$2y$10$pEz4zMMsDXZH1wdFajrOrO8jE76YBuhR9DTfNcdqaegLDCfC9vQ..', '0', NULL, 1, NULL, '2017-04-02 00:05:11', '2017-04-02 00:05:11'),
(176, 'vspencer@cremin.biz', 'Roxane White PhD', 'Tyree Ruecker V', 'jones.elody@braun.com', '$2y$10$2UVB9v4kjyqr63Lc3YAvAeiHgkQiH.JZisisTvj3ZFunIk4jjhCOG', '0', NULL, 1, NULL, '2017-04-02 00:05:11', '2017-04-02 00:05:11'),
(177, 'swilkinson@gerhold.com', 'Raleigh Ullrich II', 'Rossie Heaney', 'mraz.ramon@hermiston.com', '$2y$10$aw3Vr5OCBeZ3iinnD0fpxea0GEQ1uglFizaO1xA8hGXkoIMpryLXq', '0', NULL, 0, NULL, '2017-04-02 00:05:11', '2017-04-02 00:05:11'),
(178, 'schultz.imelda@yahoo.com', 'Ms. Ivory Hammes', 'Prof. Brady Larson', 'orrin82@yahoo.com', '$2y$10$HMaWNkXXLQkO3/PpIslpq./uGaOMZL.M9QwjxGIXwPLUOn/8SrG1q', '0', NULL, 0, NULL, '2017-04-02 00:05:11', '2017-04-02 00:05:11'),
(179, 'carolyn.dibbert@yahoo.com', 'Adam Hills', 'Gretchen Gottlieb I', 'liza.crona@yahoo.com', '$2y$10$Do27eo8vev1OeILOa.sPYOfXQFjFaDCGHGvBU9Kf6r5uq2fmw13De', '0', NULL, 0, NULL, '2017-04-02 00:05:11', '2017-04-02 00:05:11'),
(180, 'avery77@mills.org', 'Prof. Jermey Runolfsdottir', 'Norris Monahan', 'rkihn@gmail.com', '$2y$10$O1uD6692qjJN.sKbJHsnD.rYf5ACkLnIsUF65GcM/Q1SIMy8dS24e', '0', NULL, 0, NULL, '2017-04-02 00:05:11', '2017-04-02 00:05:11'),
(181, 'mschneider@hotmail.com', 'Ila Bernier', 'Eulah Schuster', 'mozell39@schoen.net', '$2y$10$JHjWbIiLF1pAsrAFc9bQJOR4HG0M9TnoVNAFLYEo83nB0Y3SoABO6', '0', NULL, 0, NULL, '2017-04-02 00:05:11', '2017-04-02 00:05:11'),
(182, 'howard90@hotmail.com', 'Sonya Bahringer', 'Prof. Joshuah Rau I', 'klocko.cassandre@gmail.com', '$2y$10$Le2scuo0uX/kjUzbtcsCHuIp2YAQ03Dqc79M7LOpWgUnfMHKw9gz6', '0', NULL, 1, NULL, '2017-04-02 00:05:11', '2017-04-02 00:05:11'),
(183, 'unique64@hotmail.com', 'Dr. Josiane Fadel', 'Wiley Grimes', 'balistreri.drake@hotmail.com', '$2y$10$tp5dThy1Ept9bhALWA6aLum6e/RHIhZZmA4mgu3c17qBNWEXnuutG', '0', NULL, 1, NULL, '2017-04-02 00:05:12', '2017-04-02 00:05:12'),
(184, 'bradtke.hailie@gorczany.com', 'Miss Julianne Langosh', 'Jane Shields', 'vhammes@ortiz.biz', '$2y$10$ISVjOY9/L/SSQlp27oyLTu5Q/CDogl5QDUlLITjf.vCloPZKcKSGC', '0', NULL, 1, NULL, '2017-04-02 00:05:12', '2017-04-02 00:05:12'),
(185, 'crice@feeney.com', 'Kurt Schumm III', 'Darrick McKenzie', 'jovani.dooley@hotmail.com', '$2y$10$ftcJVkSkP7U9uxyshgsCEufh/3vUSNyN97FgOdzZHKDlG6EY/uzlm', '0', NULL, 0, NULL, '2017-04-02 00:05:12', '2017-04-02 00:05:12'),
(186, 'daren15@yahoo.com', 'Gay Stark Sr.', 'Mrs. Peggie Heller', 'alysson07@leuschke.com', '$2y$10$pLYVONSR8XswfWRwTU8yneZa/nM8.AVv4YeuMB2BPtFEfMzbJJdgC', '0', NULL, 1, NULL, '2017-04-02 00:05:12', '2017-04-02 00:05:12'),
(187, 'vcarter@oberbrunner.org', 'Santina Wunsch', 'Sammy Rosenbaum III', 'cummings.dulce@gmail.com', '$2y$10$374Ib6GK..4afVlx7FPYA.ikQehbVtb5rOsnPzIkal8GXlfN9cBq2', '0', NULL, 1, NULL, '2017-04-02 00:05:12', '2017-04-02 00:05:12'),
(188, 'athena99@yahoo.com', 'Prof. Sim Mayert PhD', 'Belle Welch', 'vparisian@hotmail.com', '$2y$10$r5jYATQkmmidmFKzxx//3.6GSaLFg0scMSL4DlpL8u/kUnHru2vXW', '0', NULL, 0, NULL, '2017-04-02 00:05:12', '2017-04-02 00:05:12'),
(189, 'monica62@flatley.info', 'Yasmeen Hettinger', 'Carey Daugherty', 'easton27@brakus.com', '$2y$10$JyA4O7LFuCDbotamMlJj9.rr/AW19pgZIOEM/0AVLwo01/QvVUYm6', '0', NULL, 1, NULL, '2017-04-02 00:05:12', '2017-04-02 00:05:12'),
(190, 'edward.johnson@spencer.com', 'Dr. Axel Schowalter', 'Sydnee Thompson', 'nicolette.west@yahoo.com', '$2y$10$imCwWGF81Ke0jT8pKsbzyuuwkl82HVaC8NdW5Cgg55Z9mdRq2jFyC', '0', NULL, 0, NULL, '2017-04-02 00:05:12', '2017-04-02 00:05:12'),
(191, 'faye.kozey@gmail.com', 'Dexter Monahan DVM', 'Fern Walker', 'maryam.quigley@parker.com', '$2y$10$aBl6B0anLeS9vsgJMqQKq.kWSogS9hpKH3RS/VRcuWezBqZWaEbHy', '0', NULL, 1, NULL, '2017-04-02 00:05:12', '2017-04-02 00:05:12'),
(192, 'katharina10@gerlach.com', 'Ali Conn', 'Ralph Orn', 'dorothea.carter@nikolaus.biz', '$2y$10$yZqplcXBPrWeG1Gtg7/1FuoYlpJS/GJyAir/HBK4bUp8aRIyyIPoC', '0', NULL, 1, NULL, '2017-04-02 00:05:12', '2017-04-02 00:05:12'),
(193, 'bhessel@krajcik.com', 'Gilberto Schowalter', 'Idella Bauch', 'abagail55@keeling.info', '$2y$10$RULZOSv7vqzBDdgrYTd5UOFX0cfzeh59lYQtfxhKk42tant3eNz3a', '0', NULL, 1, NULL, '2017-04-02 00:05:12', '2017-04-02 00:05:12'),
(194, 'hillard.littel@yahoo.com', 'Payton Rice', 'Hardy Hodkiewicz', 'rice.waldo@corkery.biz', '$2y$10$QXRZzPRpBW8Vg6V/PxYETOR7u.KnDZxBNUSOTSCdK6J7YONKhQZHG', '0', NULL, 0, NULL, '2017-04-02 00:05:12', '2017-04-02 00:05:12'),
(195, 'levi.grimes@tremblay.biz', 'Dr. Brayan Zieme', 'Dax Ernser', 'eorn@hotmail.com', '$2y$10$.QB/liNED37JcDZibfPhh.lV/1cdEDuwdXZmz/X0pqVCYWedjaaG6', '0', NULL, 1, NULL, '2017-04-02 00:05:12', '2017-04-02 00:05:12'),
(196, 'morissette.esteban@yahoo.com', 'Ms. Marisol Rempel DDS', 'Ms. Lorna Reynolds', 'tabbott@yahoo.com', '$2y$10$boDrDPTXV2RR1t5XA04nb.Nm5uJrvA7vwH5vLVbtqLIi6J4HRwq/q', '0', NULL, 0, NULL, '2017-04-02 00:05:12', '2017-04-02 00:05:12'),
(197, 'camila98@wisoky.biz', 'Dawson Goldner', 'Dr. Brandi Stracke', 'rdare@yahoo.com', '$2y$10$C0udnKEcEAN9OfDP1n2jfu3uZo3UG5SFUxzqsaNbZeBeyeWoO.xOi', '0', NULL, 1, NULL, '2017-04-02 00:05:13', '2017-04-02 00:05:13'),
(198, 'rylee.price@gleason.net', 'Maida Boehm', 'Pete Muller Jr.', 'adella11@romaguera.info', '$2y$10$NNn08wPPM.m6XjnbuhfXWeffH8FrmszokShREPUXSCyOhH4lLmW0G', '0', NULL, 0, NULL, '2017-04-02 00:05:13', '2017-04-02 00:05:13'),
(199, 'garrison54@hotmail.com', 'Dr. Bell Veum', 'Stephan Kovacek', 'brandt05@yahoo.com', '$2y$10$t2LHGf.plmPyJfUT5NW9zOUzHsOk.WWFgGm2zr2wG/GVv/LWLQV0e', '0', NULL, 1, NULL, '2017-04-02 00:05:13', '2017-04-02 00:05:13'),
(200, 'maximillian31@yahoo.com', 'Hershel Ortiz', 'Sheldon Konopelski MD', 'elsa.swaniawski@hotmail.com', '$2y$10$GGxGjEsj8ENMRSBaPH84jOJ.Hka8aed3CrHkRDTlnlukc5UYtG1MG', '0', NULL, 0, NULL, '2017-04-02 00:05:13', '2017-04-02 00:05:13'),
(201, 'arnaldo.stiedemann@davis.com', 'Prof. Oleta Ledner PhD', 'Cassandra Gleason', 'eichmann.donnie@kessler.com', '$2y$10$uJUEW4dtDX95inaH2g78zuyIMOJmx1qLmL/63Qn4X07piLOA3fAce', '0', NULL, 0, NULL, '2017-04-02 00:05:13', '2017-04-02 00:05:13'),
(202, 'zsawayn@wuckert.com', 'Prof. Selena Pagac DVM', 'Elijah Kovacek', 'berge.elsie@yahoo.com', '$2y$10$fWbP..CR98MxAVkBvu/BI.sPijoFSIBT0kifelxWVv8r1qE18vHrm', '0', NULL, 1, NULL, '2017-04-02 00:05:13', '2017-04-02 00:05:13'),
(203, 'qmorar@rohan.biz', 'Emanuel Zboncak', 'Ahmad Murphy', 'harvey.darlene@schneider.com', '$2y$10$mMq4gi.oBTTmRXa4rRpQX.dDQaqsMdnmlrmLgwxbaX76oFRWEqU8m', '0', NULL, 0, NULL, '2017-04-02 00:05:13', '2017-04-02 00:05:13'),
(204, 'obauch@kuvalis.org', 'Marlon Bartell', 'Aaron Streich', 'maida77@mosciski.org', '$2y$10$ec9XtB21rEylmCClpr7.A.xfSTYS/huZVtSDBnRYgAfCjY5lNUov2', '0', NULL, 0, NULL, '2017-04-02 00:05:13', '2017-04-02 00:05:13'),
(205, 'hickle.della@willms.com', 'Michael Wisozk', 'Abdullah Okuneva PhD', 'jacobs.bennett@goyette.com', '$2y$10$Xz6iR60fr8e4B.XvS1toDudhgBvm5xWKNopeDdNzn1NitxlX0fdhe', '0', NULL, 1, NULL, '2017-04-02 00:05:13', '2017-04-02 00:05:13'),
(206, 'gerlach.jamie@stamm.com', 'Guadalupe Boyle', 'Kaia Cassin', 'vrunolfsson@graham.net', '$2y$10$55g766N/HJgJWvk/fCBYYuBbcmHaPVYDWGWzGr2Ls46NkfrkcQgLW', '0', NULL, 1, NULL, '2017-04-02 00:05:13', '2017-04-02 00:05:13'),
(207, 'ycrooks@gmail.com', 'Dr. Janis Mertz', 'Prof. Shane Schuster', 'tressa48@hotmail.com', '$2y$10$LmO0FphvGJE1L7A7txS4n.6GwNg44cLwrE.E/w69jdqGp3/pXclZ6', '0', NULL, 1, NULL, '2017-04-02 00:05:13', '2017-04-02 00:05:13'),
(208, 'zwhite@crist.net', 'Mr. Robbie Gusikowski', 'Micah Bernhard', 'mireille41@lockman.biz', '$2y$10$FwiretDJM8KvClu69wzVF.08UK07pcJwQxHgDtb0AUM82S4dUXA2a', '0', NULL, 0, NULL, '2017-04-02 00:05:13', '2017-04-02 00:05:13'),
(209, 'oquitzon@yahoo.com', 'Mr. Jamaal Turner', 'Ronaldo Hermann', 'gracie.wiza@renner.com', '$2y$10$5GJ/s99CWZbUIQPfpQN5yOTtRjXw8oRz4GQOlPIOy0pP.nV2/io2u', '0', NULL, 0, NULL, '2017-04-02 00:05:13', '2017-04-02 00:05:13'),
(210, 'dbecker@hotmail.com', 'Dr. Phoebe Bahringer', 'Abraham Leuschke', 'hammes.chasity@gmail.com', '$2y$10$PEohMthygTvrp6gHfgAMfeBrNmCdRhWupgfuU.lhHK07oVuzXXMUy', '0', NULL, 0, NULL, '2017-04-02 00:05:13', '2017-04-02 00:05:13'),
(211, 'nturner@yahoo.com', 'Vivien Kovacek II', 'Javonte Daniel', 'cathy.sporer@hessel.com', '$2y$10$eLcTreMxQAtdcKIqqDnQCOp3v5jbRF9QYLNEDUHUmDoF4acq2DmTS', '0', NULL, 0, NULL, '2017-04-02 00:05:14', '2017-04-02 00:05:14'),
(212, 'ymayer@hotmail.com', 'Porter Kozey', 'Charlene Dietrich MD', 'woodrow71@marks.info', '$2y$10$0jtiAI13pbfoNOu7PbP1k.M3GmFghgTQCrOxR1zaCFPq2mSgwIX22', '0', NULL, 0, NULL, '2017-04-02 00:05:14', '2017-04-02 00:05:14'),
(213, 'stone70@yahoo.com', 'Margaret Schimmel', 'Nathanael King', 'eusebio17@brown.org', '$2y$10$x2lCS0Ll5lDd.18iJJ6MiO3JBnzZYki5V1SaDoLVXenXzzz9cH1AW', '0', NULL, 1, NULL, '2017-04-02 00:05:14', '2017-04-02 00:05:14'),
(214, 'jcrist@hotmail.com', 'Paige Hamill', 'Imani Runolfsdottir DVM', 'dangelo00@yahoo.com', '$2y$10$Ez2W0vNg/Oy3w.Hn2co4PuKSnwLhNfkslp1DggkfuRPhjDHKcDuy2', '0', NULL, 0, NULL, '2017-04-02 00:05:14', '2017-04-02 00:05:14'),
(215, 'nikita79@waelchi.info', 'Sierra Weimann', 'Stella Paucek', 'ygreenfelder@berge.org', '$2y$10$8rMAFdHD4ij2uS3UpShv9OWkCVUSEKxbZmn7o6SwGNwPjXGm3s2Qm', '0', NULL, 0, NULL, '2017-04-02 00:05:14', '2017-04-02 00:05:14'),
(216, 'delpha.torp@borer.com', 'Jacquelyn Wilderman', 'Megane Rippin', 'vaughn06@cassin.net', '$2y$10$1T.pRqvczs4jguqnnJ2nS.pIi8DbMz65zXaVz0WwMw6fQ2dF2N4dy', '0', NULL, 0, NULL, '2017-04-02 00:05:14', '2017-04-02 00:05:14'),
(217, 'ferry.josiane@mcclure.com', 'Lester Spinka', 'Elfrieda Cole I', 'aheaney@hotmail.com', '$2y$10$.zYnIFyrprqT/x4YSCXaHui3diTlPyAvJv85ul9THMe/2m6KOzI0W', '0', NULL, 0, NULL, '2017-04-02 00:05:14', '2017-04-02 00:05:14'),
(218, 'jnitzsche@ortiz.com', 'Lennie Ortiz', 'Roslyn Ortiz', 'rzboncak@yahoo.com', '$2y$10$aodHIgQPzM0GHXeOfg310O9aCJb3emXzHetAVJtnLZWTJRqm8WH0m', '0', NULL, 0, NULL, '2017-04-02 00:05:14', '2017-04-02 00:05:14'),
(219, 'dkeeling@yahoo.com', 'Mr. Mitchel Ankunding', 'Ferne Zieme', 'crist.zachariah@yahoo.com', '$2y$10$D5f0mRahYXyXDL33h72Q2eQJ/yaQvXK5ygChyguVP0w7C9OsVZ7cK', '0', NULL, 1, NULL, '2017-04-02 00:05:14', '2017-04-02 00:05:14'),
(220, 'callie.zboncak@wehner.com', 'Prof. Johan Homenick DVM', 'Lavon Kozey', 'fisher.linda@yahoo.com', '$2y$10$Djlqp0e5QS.7xnMhfLsGlexmpkXwin33Z7EP4rB/g4vqg/5FuLIfm', '0', NULL, 0, NULL, '2017-04-02 00:05:14', '2017-04-02 00:05:14'),
(221, 'aryanna.bogan@gmail.com', 'Baby Terry', 'Miss Addison Skiles', 'goodwin.jasmin@heathcote.info', '$2y$10$m0B1etImnA8Vlk.s/FfCjeC2ipm.8HD6XwglZtrpGakiG/s.utIi2', '0', NULL, 1, NULL, '2017-04-02 00:05:14', '2017-04-02 00:05:14');
INSERT INTO `acl_users` (`id`, `login`, `username`, `name`, `email`, `password`, `group_id`, `remember_token`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(222, 'armstrong.jake@gmail.com', 'Greta Kihn', 'Veda Will', 'ebalistreri@hotmail.com', '$2y$10$0U2DuqruZzRiUM6Ebk3LC.elK1f7dNOHdPa61cpdS2mqZga6yzigq', '0', NULL, 0, NULL, '2017-04-02 00:05:14', '2017-04-02 00:05:14'),
(223, 'czulauf@gmail.com', 'Dr. Uriah Hane Jr.', 'Misael Schultz', 'auer.janick@nikolaus.com', '$2y$10$1nxnrN1ooWFuGbMtUsKvs.4eeI.sLvjgSRC5PoTIY8xdaa1SvLhkW', '0', NULL, 0, NULL, '2017-04-02 00:05:14', '2017-04-02 00:05:14'),
(224, 'hester.kub@yahoo.com', 'Dr. Ari Hartmann', 'Libbie Shanahan', 'qnikolaus@yahoo.com', '$2y$10$UB1QZPKsdsWXcl.59zceCOzv.MZnA8XmRWHC.emp.3BzxRovqW.mK', '0', NULL, 1, NULL, '2017-04-02 00:05:15', '2017-04-02 00:05:15'),
(225, 'williamson.kenny@schulist.com', 'Lacey West', 'Prof. Tevin Altenwerth', 'xkihn@yahoo.com', '$2y$10$AimUukRT2xZznwfKQNOaPuQdR4SuUkwUp83c5hM.DQ88yU1HKGkzu', '0', NULL, 1, NULL, '2017-04-02 00:05:15', '2017-04-02 00:05:15'),
(226, 'plowe@gmail.com', 'Maybelle O''Reilly', 'Berta Murphy', 'noconner@gmail.com', '$2y$10$PUY9RnsD6FQfOY3KA4ef6.RyUV7DSWBrWn6owpEu7iBd/dbQVwQzu', '0', NULL, 1, NULL, '2017-04-02 00:05:15', '2017-04-02 00:05:15'),
(227, 'twiegand@yahoo.com', 'Delphia Moen', 'Elmore Russel', 'nova09@kulas.net', '$2y$10$ZmkwVQnjpkb1LPMXWd8DMO0TRxlgRTJnw5xOJGlVLcpAl9xa3LCGa', '0', NULL, 1, NULL, '2017-04-02 00:05:15', '2017-04-02 00:05:15'),
(228, 'qhessel@yahoo.com', 'Giovanny Steuber', 'Deanna Trantow', 'nwaelchi@hotmail.com', '$2y$10$0bJm.y7wAIvEhxJm4lXdde2xyqwNucNAYevdwBhALrxO1KysNrcFe', '0', NULL, 1, NULL, '2017-04-02 00:05:15', '2017-04-02 00:05:15'),
(229, 'christy87@champlin.com', 'Prof. Shanon Effertz MD', 'Ken D''Amore', 'aflatley@hagenes.biz', '$2y$10$1/5lAtm7ODQK0PZZg2RBQuQxmHb0kodsK/g22vUNAJC7OkktuDuFy', '0', NULL, 0, NULL, '2017-04-02 00:05:15', '2017-04-02 00:05:15'),
(230, 'boyer.sophie@yahoo.com', 'Jakob Treutel', 'Karelle Dibbert II', 'zoe10@sporer.com', '$2y$10$mDBtFjzoGOMLRaO9uzn1subAk3jPT9WsUgZGLzWBH3difDvWTT28G', '0', NULL, 1, NULL, '2017-04-02 00:05:15', '2017-04-02 00:05:15'),
(231, 'ruby00@sanford.com', 'Bonnie Flatley', 'Asia Crist', 'cremin.macie@bogisich.org', '$2y$10$flUc74tDJwkveYkmW9qKWewoP1YJnKDgKBRswCfv8CdPBuvRWfnKy', '0', NULL, 0, NULL, '2017-04-02 00:05:15', '2017-04-02 00:05:15'),
(232, 'mayer.lonzo@hotmail.com', 'Dr. Kristian Dickens', 'Roxanne Miller', 'lorine.feest@crooks.info', '$2y$10$YRq9bhIDXYPJRlAJweb4..OYDPmBxXN2cm1oc7kMO7lt9usqYVQtC', '0', NULL, 0, NULL, '2017-04-02 00:05:15', '2017-04-02 00:05:15'),
(233, 'mueller.rebecca@streich.org', 'Miss Vivianne Hudson DVM', 'Mr. Tito Wintheiser', 'vtowne@greenholt.info', '$2y$10$iYmwCC3GN8BIloc5zedDHeipcLw6/jA6fF3TEcMjKG7JWdCjKXqVC', '0', NULL, 1, NULL, '2017-04-02 00:05:15', '2017-04-02 00:05:15'),
(234, 'elenor.dickens@erdman.com', 'Hayden Heidenreich', 'Lyla Connelly', 'sydni.bogisich@yahoo.com', '$2y$10$YmYmOkZlqIPWKIpeA2P8oe5RyUlwXYk75c1wevbYhcoQDgyzqv7W2', '0', NULL, 1, NULL, '2017-04-02 00:05:15', '2017-04-02 00:05:15'),
(235, 'balistreri.doug@yahoo.com', 'Miss Trinity Fay', 'Leonie Davis', 'rogahn.paul@yahoo.com', '$2y$10$/n3WlC8DGzzMTuxRy899m.9hKolN5rC9mwaBWa/CFAuy1e2pKmUO6', '0', NULL, 0, NULL, '2017-04-02 00:05:15', '2017-04-02 00:05:15'),
(236, 'alvis12@yahoo.com', 'Danika Christiansen PhD', 'Tiffany Satterfield', 'ilubowitz@yahoo.com', '$2y$10$OuRX4azJGGXx5JqSgE9Z9eVUiZz5fUWD/XMdXkScnV5BERCkRBHWm', '0', NULL, 1, NULL, '2017-04-02 00:05:15', '2017-04-02 00:05:15'),
(237, 'wintheiser.ramon@gmail.com', 'Bradford Waters', 'Daisy Emmerich', 'bergnaum.daphne@gmail.com', '$2y$10$31LpgNK0jyyXw/UJFbHg2.S.0mP3UIjg7EWKLd8fYRpWvn4uM/Wu2', '0', NULL, 1, NULL, '2017-04-02 00:05:16', '2017-04-02 00:05:16'),
(238, 'kbuckridge@yahoo.com', 'Prof. Rowan Sawayn', 'Anita Bernhard', 'fay11@reynolds.com', '$2y$10$yFojFh6FY/uChr9QCM1Vge2pb4Y.OkZbQzHxySN.WluggUqMFHfhm', '0', NULL, 0, NULL, '2017-04-02 00:05:16', '2017-04-02 00:05:16'),
(239, 'brekke.elsie@ferry.com', 'Marietta Schaden', 'Dr. Della Gleichner III', 'xschulist@kovacek.com', '$2y$10$B773woN2tYVL/hSmgBpX6uRKvg9I0XV0G2Whp8wbq3wOgN8xRrkgS', '0', NULL, 1, NULL, '2017-04-02 00:05:16', '2017-04-02 00:05:16'),
(240, 'laverna91@gmail.com', 'Mr. Cornelius Koepp DVM', 'Mr. Mose Blanda Sr.', 'brenden33@yahoo.com', '$2y$10$6UuZ5R9IzQEYT3MvM5v/DeB1L8/32lRBUUX5Bdu9FfKHLhG9umwx.', '0', NULL, 1, NULL, '2017-04-02 00:05:16', '2017-04-02 00:05:16'),
(241, 'annabelle.bernier@ullrich.com', 'Mr. Frederik Simonis Sr.', 'Dr. Novella Wehner', 'ikihn@yahoo.com', '$2y$10$1mdjv8l914J2XgUoTxRl8eZB8QwYsCE64ejl1Y4o8Q.chlikm15L6', '0', NULL, 1, NULL, '2017-04-02 00:05:16', '2017-04-02 00:05:16'),
(242, 'fay.halvorson@vonrueden.com', 'Norene Stiedemann', 'Greyson Collins', 'alfreda.turcotte@gmail.com', '$2y$10$Q0eHM.9kjDNzQCupowIPI.6CwDSroyi/KPNF8B4QB1dH1nhGJwW9y', '0', NULL, 0, NULL, '2017-04-02 00:05:16', '2017-04-02 00:05:16'),
(243, 'vgerlach@runte.net', 'Miss Estrella Larkin IV', 'Prof. Garland Schulist', 'effie.jakubowski@kozey.com', '$2y$10$q4PRUOt1J/8WhQ6yjGWRb.DzFmUMl7v7ln02yk.MByNcgHORlCqge', '0', NULL, 1, NULL, '2017-04-02 00:05:16', '2017-04-02 00:05:16'),
(244, 'krutherford@yahoo.com', 'Dr. Reece O''Hara IV', 'Krystel Mohr', 'wiegand.jordyn@wunsch.net', '$2y$10$1SmG7OgUHijvqLBpVv8CkOi2VNaVfLUZBsFj9XAeTmOGY1z8RXz8u', '0', NULL, 0, NULL, '2017-04-02 00:05:16', '2017-04-02 00:05:16'),
(245, 'jude58@yahoo.com', 'David Schaden', 'Louie Stehr', 'okon.elmo@glover.org', '$2y$10$Hc6zdtahUde03.1RgKwgVOPbtyhJPz.LLEjl88vQHgrDD0ZEtoT2.', '0', NULL, 1, NULL, '2017-04-02 00:05:16', '2017-04-02 00:05:16'),
(246, 'jade51@hotmail.com', 'Brendon Anderson DDS', 'Daniela Hoppe', 'ryan40@hotmail.com', '$2y$10$10h1G9i0/teBL7vuCJ8CTeHjGRYZ8L9OSarkCqXz.T1GGBQYHOyRW', '0', NULL, 1, NULL, '2017-04-02 00:05:16', '2017-04-02 00:05:16'),
(247, 'tkrajcik@yahoo.com', 'Fannie Boyle', 'Johnpaul Eichmann', 'hrunte@wunsch.com', '$2y$10$eWK8D1kDuxRwfAY4R7PsNODnrj6RL3Bd9Y97r7wvY/W/0rWKED0FO', '0', NULL, 1, NULL, '2017-04-02 00:05:16', '2017-04-02 00:05:16'),
(248, 'gmorissette@beier.com', 'Shane Turner Jr.', 'Christian Mills', 'whagenes@williamson.com', '$2y$10$SS4OqdQFrd8DHGTxowal4uDfGOtwHBhhqXSQ7JBvS7Qirt/Zmb362', '0', NULL, 1, NULL, '2017-04-02 00:05:16', '2017-04-02 00:05:16'),
(249, 'garry.grady@gmail.com', 'Mr. Fernando Mann', 'Dr. Fredrick Harris I', 'eschulist@armstrong.com', '$2y$10$FG2GXG0gpjRI/C88lg192Oxp4/f.3Gm3ExcUR44xV1iSwyk47IeNK', '0', NULL, 1, NULL, '2017-04-02 00:05:16', '2017-04-02 00:05:16'),
(250, 'greenholt.mona@yahoo.com', 'Johnathan Jenkins', 'Jaycee Mante', 'carleton.quigley@yahoo.com', '$2y$10$FUO04wLogbU0FZxvEHhC0Ot2JLBtq0FZjZviKdgyoMFoS8shRGJz.', '0', NULL, 0, NULL, '2017-04-02 00:05:16', '2017-08-31 01:04:27'),
(251, 'kirsten94@thiel.info', 'Dr. Nicholas Satterfield Jr.', 'Mr. Eliezer Rath', 'osinski.damien@hotmail.com', '$2y$10$CJNoPaMBuLQwJ3wCxzeClu4ET0iTQBcf7bifx68k6n9R4yTWREKZ.', '0', NULL, 0, NULL, '2017-04-02 00:05:17', '2017-08-31 01:04:27'),
(252, 'ghackett@wolf.info', 'Eleazar Moen Sr.', 'Mr. Winfield Zboncak Sr.', 'alden.kessler@hotmail.com', '$2y$10$Ldh0P45qGcQNCO6r3qfhvOhX.jWCccVJYx/hBTyBSeVKL.K/HM.OC', '0', NULL, 1, NULL, '2017-04-02 00:05:17', '2017-04-02 00:05:17'),
(253, 'sim35@hotmail.com', 'Prof. Isai Vandervort', 'Casper Daniel', 'zhauck@hotmail.com', '$2y$10$qodbz2cOUWGYNHAJwYMYdOJvKC.OXlI1v/0uZF/arSVbiXvR3Euk2', '0', NULL, 1, NULL, '2017-04-02 00:05:17', '2017-04-02 00:05:17'),
(254, 'annie.monahan@yahoo.com', 'Kristoffer Kuphal', 'Mr. Kelvin Johnson V', 'federico26@klocko.com', '$2y$10$E4ZVYNII58Fgynpx6ouj7urnxQNOr/OP/A6c6b3MZVZhPdcfR2mvS', '0', NULL, 0, '2017-08-31 01:04:04', '2017-04-02 00:05:17', '2017-08-31 01:04:04'),
(255, 'blanda.peter@hotmail.com', 'Dr. Schuyler Terry', 'Providenci Emard', 'ifadel@ratke.com', '$2y$10$Xs/WeKcsopudk1BW8wdcu.ro2jc5xqol3Dlv/eEUxSNc.WDk8T6ne', '0', NULL, 1, NULL, '2017-04-02 00:05:17', '2017-04-02 00:05:17'),
(256, 'trace50@yahoo.com', 'Ettie Von', 'Arturo Lebsack I', 'ewald15@gmail.com', '$2y$10$jOud9aDU8VRpg5n35Y/40ucsmc3d/iifCQv04YC2BgIvJlnrr0Sku', '0', NULL, 0, '2017-08-31 01:04:04', '2017-04-02 00:05:17', '2017-08-31 01:04:04'),
(257, 'zhegmann@spencer.net', 'Estella Mraz V', 'Mrs. Chelsea Greenfelder', 'ike15@gmail.com', '$2y$10$Z6kH58w9AbPbuCUIA9hnU.bK6aMwWPuz.XGZVv2uO11e5aQ3NVeYO', '0', NULL, 0, '2017-08-31 01:04:04', '2017-04-02 00:05:17', '2017-08-31 01:04:04'),
(258, 'torp.baylee@hotmail.com', 'Noemy Runolfsdottir', 'Aric Cormier', 'john.ondricka@yahoo.com', '$2y$10$C2QYrasL12qC6rgaqFaoUO5IImABLzkIl2pg4IzRnTBJj3vHpiQzG', '0', NULL, 0, '2017-08-31 01:04:04', '2017-04-02 00:05:17', '2017-08-31 01:04:04'),
(259, 'hoppe.wilfred@fadel.com', 'Miss Bert Gusikowski', 'Reymundo Mosciski', 'xgraham@gmail.com', '$2y$10$QAtBYzh4cIWT2XppNonEc.Bvpb6N78QYEkINCxdu/p.8mKWOq1nvO', '0', NULL, 1, NULL, '2017-04-02 00:05:17', '2017-04-02 00:05:17'),
(260, 'trycia.gerlach@gmail.com', 'Melba Kovacek', 'Keara Sanford', 'daniel.cara@davis.com', '$2y$10$6/l3dq7cssBuRa1dLUdLTOWKZp3zsUjpSPlG5/CFNuzC8N6fSoBB2', '0', NULL, 0, '2017-08-31 01:04:04', '2017-04-02 00:05:17', '2017-08-31 01:04:04'),
(261, 'gleason.reyes@yahoo.com', 'Gina Dickinson DDS', 'Leslie Pouros', 'charles13@barton.com', '$2y$10$n4wWiPQD7VeSRjubyG4dLOjn..9SvvPogcndpgIQkyKqiwYNd0h2m', '0', NULL, 0, '2017-08-31 01:04:04', '2017-04-02 00:05:17', '2017-08-31 01:04:04'),
(262, 'miller72@hotmail.com', 'Linnea Von', 'Sibyl Ernser Sr.', 'edwin.kuvalis@kuvalis.biz', '$2y$10$IjwlUC3VSv9y7N6Ayscyfee4jvoHwdiI1jczsImr3OeP.5vIKZ8/e', '0', NULL, 1, NULL, '2017-04-02 00:05:17', '2017-04-02 00:05:17'),
(263, 'schultz.francisca@white.info', 'Delta Heaney', 'Nash Will II', 'delaney69@hotmail.com', '$2y$10$rp.e9Qfh1JaE5cgBXhoOTuy9zOrxEBsHxIZZRJzIWf617MZU7u9P2', '0', NULL, 0, '2017-08-31 01:04:04', '2017-04-02 00:05:17', '2017-08-31 01:04:04'),
(264, 'cbeatty@gmail.com', 'Murray Kris', 'Reina Volkman', 'hgoyette@yahoo.com', '$2y$10$3q1DANXD6KD/.hDsZ5JJpuKoD9KLpyEabsfQDElpJh3pw6Vai0aXW', '0', NULL, 1, NULL, '2017-04-02 00:05:17', '2017-04-02 00:05:17'),
(265, 'abigale.schaefer@hagenes.com', 'Haleigh Marks I', 'Brian Cummerata IV', 'hmaggio@gaylord.org', '$2y$10$mJhyrtiR.mETOlfYqngkf.UXFDF9F3d6Lks3hbvsIvekUouB/Zb.O', '0', NULL, 0, '2017-08-31 01:04:04', '2017-04-02 00:05:18', '2017-08-31 01:04:04'),
(266, 'xosinski@dach.org', 'Jorge Hahn', 'Henderson Veum', 'jena33@dooley.com', '$2y$10$dYnHFK3Fq3afAH2aFymmdeWnWDZIuXylIWDCL2AQt2rKnqRRUmmDW', '0', NULL, 1, NULL, '2017-04-02 00:05:18', '2017-04-02 00:05:18'),
(267, 'gislason.aracely@gutmann.com', 'Mrs. Lacey Christiansen', 'Kathryne Boyle', 'slittle@botsford.com', '$2y$10$C56H9ri7l.FsHARJHT57h.c33csGgl6sqw6OvdW.IlBU4semA2cW2', '0', NULL, 1, NULL, '2017-04-02 00:05:18', '2017-04-02 00:05:18'),
(268, 'thompson.consuelo@gmail.com', 'Cordelia Bode', 'Dr. Rigoberto Little', 'boyer.rudolph@lind.net', '$2y$10$FDRfhBL/dubobRDgZ64N8eXxFK.82xZB2.dphJ/vZn.t3aJ6wRSAy', '0', NULL, 1, NULL, '2017-04-02 00:05:18', '2017-04-02 00:05:18'),
(269, 'rmohr@marvin.info', 'Dahlia Hammes', 'Pierre Parisian', 'koepp.kelvin@gmail.com', '$2y$10$iDWryA.Uc3CoCZHrIttMeemB3R7heoP5J6yNnb5NA6F/6q8ASfbHK', '0', NULL, 1, NULL, '2017-04-02 00:05:18', '2017-04-02 00:05:18'),
(270, 'jovan.schneider@walter.biz', 'Joaquin Jerde', 'Dr. Georgette Dickens Sr.', 'kertzmann.ofelia@johnston.com', '$2y$10$T8xS0OKYX5QJvxmabJUdEuPZR.gUCr/4113Q9FkHkYOXZCzNKrfdW', '0', NULL, 0, '2017-08-31 01:04:04', '2017-04-02 00:05:18', '2017-08-31 01:04:04'),
(271, 'freichert@boyle.com', 'Mr. Alexzander Pouros Jr.', 'Charlotte Crona', 'grady.mikayla@schmeler.com', '$2y$10$hByzpsliIBWm9dp6DcSi3e2qlAeHQUvlIiPic8k1bYsXs9kI84BPe', '0', NULL, 1, NULL, '2017-04-02 00:05:18', '2017-04-02 00:05:18'),
(272, 'gottlieb.donny@stiedemann.com', 'Mr. Nels Pagac', 'Kassandra Rippin', 'bergstrom.eddie@hotmail.com', '$2y$10$kq3pIyjdMqrQNvd/DxAn0.Kcd.EnhNLKGRg2m.uXaOSejiN7AKBkW', '0', NULL, 0, '2017-08-31 01:04:04', '2017-04-02 00:05:18', '2017-08-31 01:04:04'),
(273, 'schiller.vernice@yahoo.com', 'Ted Bosco', 'Blanca Beahan', 'bruen.lucius@kiehn.com', '$2y$10$95a6aOAjXNPkfFbkAOP84uwpld84dOC37iixCHHhDGdHiJWt5vgB6', '0', NULL, 1, NULL, '2017-04-02 00:05:18', '2017-04-02 00:05:18'),
(274, 'littel.rosina@blick.com', 'Myriam Pouros', 'Prof. Garrick Konopelski I', 'hirthe.christa@yahoo.com', '$2y$10$BjfrjMKVHbLuxSTjRT5Xv.VYCK/Jo/2ht.XrnyI3joVgmSheeDqdS', '0', NULL, 1, NULL, '2017-04-02 00:05:18', '2017-04-02 00:05:18'),
(275, 'mconnelly@gmail.com', 'Tracey Fritsch', 'Bennett Wisoky', 'max72@jacobi.com', '$2y$10$nU7haxbDAHUzYPUA5davauFqAH3j2rra8MpBezfUfPeiPOiFklHuu', '0', NULL, 0, '2017-08-31 01:04:04', '2017-04-02 00:05:18', '2017-08-31 01:04:04'),
(276, 'rosanna61@yahoo.com', 'Kaylah Schumm', 'Brianne Moen', 'yanderson@hotmail.com', '$2y$10$.GaK3sEctoSbJgVU2dVgPOcPjiy4sBp/qXIINkbi/X2elYRZ8ZsRW', '0', NULL, 0, '2017-08-31 01:04:04', '2017-04-02 00:05:18', '2017-08-31 01:04:04'),
(277, 'dmuller@cummings.org', 'Dr. Trevion Brown', 'Alisa Flatley', 'abshire.tevin@yahoo.com', '$2y$10$fMbz/NTLvYElc6om3LJ9IerJSEM2RuA9//f94o9pfRbyKAjBT4SaW', '0', NULL, 0, '2017-08-31 01:04:04', '2017-04-02 00:05:18', '2017-08-31 01:04:04'),
(278, 'talia18@wolff.org', 'Ocie Kovacek', 'Dr. Diego Pagac', 'heaney.harmony@schroeder.com', '$2y$10$i47ACDuWO49uv2UKajvhmeFzaW5EFgvXRoagpL5myL6yDIh.9Zpqm', '0', NULL, 1, NULL, '2017-04-02 00:05:18', '2017-04-02 00:05:18'),
(279, 'odare@gibson.com', 'Hassie Ziemann I', 'Miss Daisha Bauch', 'wnienow@yahoo.com', '$2y$10$aGk8aAEblQP8qjYU3QnyLu6K3I1MVeGLn17zsuT0pB2KU.Hs0DGkK', '0', NULL, 1, NULL, '2017-04-02 00:05:19', '2017-04-02 00:05:19'),
(280, 'wspencer@hotmail.com', 'Lucas Carroll Sr.', 'Coralie Mraz', 'gayle99@hotmail.com', '$2y$10$oH4ySy503c0L68ZG2/I/4e8ysWydD/NGQ4VJibOMZ2Z/fd5bMBprG', '0', NULL, 1, NULL, '2017-04-02 00:05:19', '2017-04-02 00:05:19'),
(281, 'mozell.stamm@white.com', 'Sigrid Jacobi', 'Dr. Morton Strosin', 'salvatore.blick@volkman.com', '$2y$10$tR9hkNpBI0yXDHv/ZWcPA.tx.jKtXTxR7sn3XhWn82fj6sQTjloa6', '0', NULL, 1, NULL, '2017-04-02 00:05:19', '2017-04-02 00:05:19'),
(282, 'shanahan.tanya@mcclure.net', 'Jamie Toy', 'Jazmyne Kassulke', 'nturcotte@yahoo.com', '$2y$10$HZxVYImO1VkFIR1rjiAbD.eQt0am0djiMr.PLtmJCgXWP/2mnaecq', '0', NULL, 0, '2017-08-31 01:04:04', '2017-04-02 00:05:19', '2017-08-31 01:04:04'),
(283, 'rwitting@yahoo.com', 'Jaydon Dooley', 'Theresa Schiller', 'adrian.runolfsson@hotmail.com', '$2y$10$BGA0SXJPZ56nJhb53O3UHuGNloxDONE/h.Gg4S4iNOr9GBw29tIwq', '0', NULL, 1, NULL, '2017-04-02 00:05:19', '2017-04-02 00:05:19'),
(284, 'xdickinson@hotmail.com', 'Bernadette Gorczany', 'Miss Wilhelmine Waters', 'alexandro.buckridge@kerluke.org', '$2y$10$FaIXLdMdNU10wx4JOHu4FeOVdD4yu/Jte5.vC.qQnwcNImOnSzZt2', '0', NULL, 0, '2017-08-31 01:04:04', '2017-04-02 00:05:19', '2017-08-31 01:04:04'),
(285, 'mwillms@gmail.com', 'Marvin Kozey', 'Royce O''Keefe', 'ccorkery@gmail.com', '$2y$10$Zhs4SctRtv5Ci.nkAOPRY.ObxtPOB.CGMlLvKmy7ptkrNh/rxNFR6', '0', NULL, 0, '2017-08-31 01:04:04', '2017-04-02 00:05:19', '2017-08-31 01:04:04'),
(286, 'neil15@huels.info', 'Dr. Frank Willms DDS', 'Mr. Darion Kulas', 'janiya92@hotmail.com', '$2y$10$T5ioW1x3iY1v32kk2k.Mhe1vp0cQlKEL1.tap.Cf5h6S8akJcY7ye', '0', NULL, 1, NULL, '2017-04-02 00:05:19', '2017-04-02 00:05:19'),
(287, 'dbogisich@langosh.com', 'Amaya Kozey', 'Deshawn Luettgen', 'houston97@yahoo.com', '$2y$10$wrTFnOroAoYIyIBZe58rKeq7fmdSJ5jJ6.YokHGw79FDJkKHgOwDy', '0', NULL, 1, NULL, '2017-04-02 00:05:19', '2017-04-02 00:05:19'),
(288, 'peter.schneider@batz.com', 'Jimmy Mraz', 'Immanuel Waters V', 'dspencer@daugherty.org', '$2y$10$U7NO3cQlJWyNVxff8z3myusZNKRCwJBIRMwvBtBNNYNdfTVdiZ9QK', '0', NULL, 1, NULL, '2017-04-02 00:05:19', '2017-04-02 00:05:19'),
(289, 'russell.gutmann@hotmail.com', 'Leon Emard', 'Tianna Anderson III', 'borer.tiffany@strosin.com', '$2y$10$Qw4Rygyh9.hm10e0B7R4SuueFZh0Rc1gvbfZ3Fa2NuGH5A91a1Pr6', '0', NULL, 1, NULL, '2017-04-02 00:05:19', '2017-04-02 00:05:19'),
(290, 'myrtle06@gmail.com', 'Mrs. Alivia Collins V', 'Richard Hudson', 'qkassulke@hotmail.com', '$2y$10$/V6TW6wawvL15IrBbQLU0.zppgmgpI612vW6wa1LgJVgAp1Nlmik2', '0', NULL, 1, NULL, '2017-04-02 00:05:19', '2017-04-02 00:05:19'),
(291, 'dchamplin@baumbach.org', 'Taya Zieme', 'Violette Dooley', 'deondre07@yahoo.com', '$2y$10$IJoWekSk1h1NldeobylTH.I3AWkhC67o9bkcEYPj8RnxKRjRWhvkG', '0', NULL, 0, '2017-08-31 01:04:04', '2017-04-02 00:05:19', '2017-08-31 01:04:04'),
(292, 'irwin63@johns.net', 'Joelle Labadie', 'Kristofer Weissnat', 'clint.feil@yahoo.com', '$2y$10$juTbEVx0B0Kwp9arpPd2OO3favhZDnUVx3Bh92hkGaxoJD0hdJQnG', '0', NULL, 0, '2017-08-31 01:04:04', '2017-04-02 00:05:19', '2017-08-31 01:04:04'),
(293, 'rowe.makenzie@larkin.com', 'Virginie Rau', 'Miss Alvera Beier', 'ryan.kayley@hotmail.com', '$2y$10$9wJIpfQww4CuTKl/4DeyT.BanDWmyLfyLgi.DVraUQD2OL8Kr6KUi', '0', NULL, 1, NULL, '2017-04-02 00:05:20', '2017-04-02 00:05:20'),
(294, 'kuhic.maxime@gmail.com', 'Hilda Grimes III', 'Mr. Deron Johnston', 'emelia.hoppe@wiza.biz', '$2y$10$2aejxF.n/QjTy89iNT4xX.zmLotXNLsoUytNCjtOPMQdpjfxwiMAe', '0', NULL, 0, '2017-08-31 01:04:04', '2017-04-02 00:05:20', '2017-08-31 01:04:04'),
(295, 'maymie.rowe@kautzer.com', 'Ryan Padberg', 'Ms. Piper Franecki Sr.', 'rosina68@parisian.com', '$2y$10$NEzHwrk/jVusPzOuFMrKm.ffBFQGMbslJW29Xzri5LQ/Z3Qbi/knK', '0', NULL, 1, NULL, '2017-04-02 00:05:20', '2017-04-02 00:05:20'),
(296, 'casper55@grimes.com', 'Sidney Beer', 'Kaden Lockman', 'edamore@gmail.com', '$2y$10$9uvdAu0agm2v2jgN/Bjfu.kjsqsT4pGcJ9AjJJFjpnb2wE8AMCD/G', '0', NULL, 1, NULL, '2017-04-02 00:05:20', '2017-04-02 00:05:20'),
(297, 'carroll51@hermann.com', 'Mrs. Kattie Pouros V', 'Prof. Savion Rowe', 'garfield.murray@hotmail.com', '$2y$10$TdOrstYB0NRAQO2bUtcnBeOOtJXnbnp4geJFoKz1v5nAzTKq2ocmu', '0', NULL, 1, NULL, '2017-04-02 00:05:20', '2017-04-02 00:05:20'),
(298, 'shanahan.dedrick@hotmail.com', 'Heloise Klocko DDS', 'Zion Yundt', 'constance.schuster@corwin.org', '$2y$10$Ywj0UcoqkTNi4.TKbRSxte8syQjQ1RxjNBV90ONHYXmFXqDD6qwgS', '0', NULL, 1, NULL, '2017-04-02 00:05:20', '2017-04-02 00:05:20'),
(299, 'casimir.toy@kunze.com', 'Irving Reilly V', 'Mallory Cummerata', 'karl.littel@rau.net', '$2y$10$KrGkH91xavIzAyiUvYRvrO8dgyIDWHAHxIcvuCc74iRwoQe0in7vW', '0', NULL, 1, NULL, '2017-04-02 00:05:20', '2017-04-02 00:05:20'),
(300, 'kertzmann.andrew@padberg.com', 'Tamara Quigley', 'Francisca Rowe', 'ystokes@mante.com', '$2y$10$07asPaeKwaoOoKuT0J8wo.mhGMkxllWIVofvydFr19UfuLzw6sR..', '0', NULL, 1, NULL, '2017-04-02 00:05:20', '2017-04-02 00:05:20'),
(301, 'predovic.judy@yahoo.com', 'Mr. Waldo Beer II', 'Ms. Delphine Mann Sr.', 'kailey11@corwin.net', '$2y$10$Zb3PLxUigvaYH9MYgvuCE.TAbeizSYQsTdn7pwhq9IQVXmoCerpDu', '0', NULL, 1, NULL, '2017-04-02 00:05:20', '2017-04-02 00:05:20'),
(302, 'haylie.labadie@connelly.com', 'Zella Kemmer', 'Carleton Jacobs', 'quentin89@hotmail.com', '$2y$10$VjMQyPw99Mzue0zwCNtaSOlfE6/0AHbmTlSXrdPZHftxc.CeJB.OS', '0', NULL, 1, NULL, '2017-04-02 00:05:20', '2017-04-02 00:05:20'),
(303, 'vbradtke@gmail.com', 'Anne Hartmann III', 'Shad Bradtke', 'darien.brakus@gmail.com', '$2y$10$6JMr2yOm.di/COKvHbf0..dq9KnWRS87HnRniw2KR5EBuDArzzbXe', '0', NULL, 0, '2017-08-31 01:04:04', '2017-04-02 00:05:20', '2017-08-31 01:04:04'),
(304, 'rosalyn.spinka@mayert.com', 'Dr. Marvin Torp', 'Jordy Witting', 'eric31@berge.com', '$2y$10$ira.pgGFk1CMpADRJKRhde04nD.YxyNQGPL8A2I27GN7axeaH4dlG', '0', NULL, 0, '2017-08-31 01:04:04', '2017-04-02 00:05:20', '2017-08-31 01:04:04'),
(305, 'felicity.schaefer@gmail.com', 'Brody Bartoletti', 'Eva Moore', 'cummerata.wyman@yahoo.com', '$2y$10$/hBw4ju445MUPD1HmsTJhuxzhWviHNAlFPGZLX.1zJRLYSFfWNtSC', '0', NULL, 0, '2017-08-31 01:04:04', '2017-04-02 00:05:20', '2017-08-31 01:04:04'),
(306, 'mhowe@robel.com', 'Arianna Waters', 'Dr. Abelardo Beahan', 'joelle29@gmail.com', '$2y$10$NG4qrTIIfY34GP6MwkN/t.NYFsxqpD.yXim29GcjPBsMstKZAwqPe', '0', NULL, 1, NULL, '2017-04-02 00:05:20', '2017-04-02 00:05:20'),
(307, 'xemard@breitenberg.biz', 'Adriana Hyatt', 'Caterina Larkin', 'sipes.annie@yahoo.com', '$2y$10$63zhHXhkCFkpD40HqbkVeuNR6fM2B79udXljEQqXvXsW7vi.coFFm', '0', NULL, 0, NULL, '2017-04-02 00:05:21', '2017-09-10 10:18:35'),
(308, 'hilbert.waelchi@hilll.org', 'Carson Friesen DDS', 'Mrs. Elvie Cormier', 'nbarrows@hotmail.com', '$2y$10$Ld03N.J/G21D0ZZMm88Yl.krpmIG1OozsDexsL4xUhzOznO3utF9y', '0', NULL, 0, NULL, '2017-04-02 00:05:21', '2017-08-31 01:04:13');

-- --------------------------------------------------------

--
-- Table structure for table `acl_user_permissions`
--

CREATE TABLE IF NOT EXISTS `acl_user_permissions` (
  `id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `actions` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `acl_user_roles`
--

CREATE TABLE IF NOT EXISTS `acl_user_roles` (
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(10) unsigned NOT NULL,
  `parent_id` int(10) unsigned DEFAULT NULL,
  `lft` int(10) unsigned DEFAULT NULL,
  `rgt` int(10) unsigned DEFAULT NULL,
  `depth` int(10) unsigned DEFAULT NULL,
  `type` smallint(6) NOT NULL DEFAULT '0',
  `position` int(10) unsigned DEFAULT '0',
  `is_root_category` tinyint(4) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category_lang`
--

CREATE TABLE IF NOT EXISTS `category_lang` (
  `category_id` int(11) NOT NULL,
  `lang_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_title` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_keywords` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_description` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lang`
--

CREATE TABLE IF NOT EXISTS `lang` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `iso_code` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `language_code` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `locale` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `date_format_lite` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `date_format_full` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `is_rtl` tinyint(4) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL,
  `migration` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_06_29_121826_acl_groups', 1),
(2, '2014_06_29_121910_acl_group_permissions', 1),
(3, '2014_06_29_121922_acl_group_roles', 1),
(4, '2014_06_29_121934_acl_permissions', 1),
(5, '2014_06_29_121944_acl_roles', 1),
(6, '2014_06_29_121955_acl_role_permissions', 1),
(7, '2014_06_29_122005_acl_user_permissions', 1),
(8, '2014_06_29_122014_acl_user_roles', 1),
(9, '2014_06_29_122019_acl_users', 1),
(10, '2014_10_12_000000_create_users_table', 1),
(11, '2014_10_12_100000_create_password_resets_table', 1),
(12, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(13, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(14, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(15, '2016_06_01_000004_create_oauth_clients_table', 1),
(16, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(17, '2017_03_24_081544_create_langs_table', 1),
(18, '2017_03_24_084132_create_categories_table', 1),
(19, '2017_03_24_090329_create_category_lang_table', 1),
(20, '2017_03_24_091529_create_posts_table', 1),
(21, '2017_03_24_091543_create_post_lang_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE IF NOT EXISTS `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `client_id` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE IF NOT EXISTS `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `scopes` text COLLATE utf8_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE IF NOT EXISTS `oauth_clients` (
  `id` int(10) unsigned NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `redirect` text COLLATE utf8_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE IF NOT EXISTS `oauth_personal_access_clients` (
  `id` int(10) unsigned NOT NULL,
  `client_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE IF NOT EXISTS `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE IF NOT EXISTS `post` (
  `id` int(10) unsigned NOT NULL,
  `author_id` int(10) unsigned DEFAULT NULL,
  `comment_count` int(11) NOT NULL DEFAULT '0',
  `comment_status` tinyint(4) NOT NULL DEFAULT '1',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `post_lang`
--

CREATE TABLE IF NOT EXISTS `post_lang` (
  `post_id` int(11) NOT NULL,
  `lang_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_title` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_keywords` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_description` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8_unicode_ci,
  `thumbnail` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acl_groups`
--
ALTER TABLE `acl_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `acl_group_permissions`
--
ALTER TABLE `acl_group_permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `acl_group_permissions_group_id_permission_id_unique` (`group_id`,`permission_id`);

--
-- Indexes for table `acl_group_roles`
--
ALTER TABLE `acl_group_roles`
  ADD PRIMARY KEY (`group_id`,`role_id`);

--
-- Indexes for table `acl_permissions`
--
ALTER TABLE `acl_permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `acl_permissions_area_permission_unique` (`area`,`permission`);

--
-- Indexes for table `acl_roles`
--
ALTER TABLE `acl_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `acl_role_permissions`
--
ALTER TABLE `acl_role_permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `acl_role_permissions_role_id_permission_id_unique` (`role_id`,`permission_id`);

--
-- Indexes for table `acl_users`
--
ALTER TABLE `acl_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `acl_users_email_unique` (`email`);

--
-- Indexes for table `acl_user_permissions`
--
ALTER TABLE `acl_user_permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `acl_user_permissions_user_id_permission_id_unique` (`user_id`,`permission_id`);

--
-- Indexes for table `acl_user_roles`
--
ALTER TABLE `acl_user_roles`
  ADD PRIMARY KEY (`user_id`,`role_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_parent_id_index` (`parent_id`),
  ADD KEY `category_lft_index` (`lft`),
  ADD KEY `category_rgt_index` (`rgt`);

--
-- Indexes for table `category_lang`
--
ALTER TABLE `category_lang`
  ADD PRIMARY KEY (`category_id`,`lang_id`);

--
-- Indexes for table `lang`
--
ALTER TABLE `lang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_personal_access_clients_client_id_index` (`client_id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_author_id_foreign` (`author_id`);

--
-- Indexes for table `post_lang`
--
ALTER TABLE `post_lang`
  ADD PRIMARY KEY (`post_id`,`lang_id`);

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
-- AUTO_INCREMENT for table `acl_groups`
--
ALTER TABLE `acl_groups`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `acl_group_permissions`
--
ALTER TABLE `acl_group_permissions`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `acl_permissions`
--
ALTER TABLE `acl_permissions`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `acl_roles`
--
ALTER TABLE `acl_roles`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `acl_role_permissions`
--
ALTER TABLE `acl_role_permissions`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `acl_users`
--
ALTER TABLE `acl_users`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=309;
--
-- AUTO_INCREMENT for table `acl_user_permissions`
--
ALTER TABLE `acl_user_permissions`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lang`
--
ALTER TABLE `lang`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `category_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `category` (`id`);

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `acl_users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
