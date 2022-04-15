-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 15, 2022 at 07:00 AM
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
-- Database: `jamboree`
--

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

DROP TABLE IF EXISTS `task`;
CREATE TABLE IF NOT EXISTS `task` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `description` longtext,
  `completed` tinyint(1) NOT NULL,
  `due_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`id`, `title`, `description`, `completed`, `due_date`, `created_at`, `updated_at`, `user_id`) VALUES
(3, 'sldfjlskdjflskd jflskdjf', 'lsjdflksjd lfksjdlkf jslk', 0, '2022-04-24', '2022-04-14 19:24:54', '2022-04-14 19:24:54', 1),
(2, 'ldjfslkdjflskdj', 'lsjdflksdjflskdjfl', 0, '2022-04-16', '2022-04-14 19:24:22', '2022-04-14 19:24:22', 1),
(4, 'sldfjlskdjflskd jflskdjf', 'lsjdflksjd lfksjdlkf jslk', 1, '2022-04-24', '2022-04-14 19:24:57', '2022-04-14 20:16:04', 1),
(5, 'test', 'sldfjsdk', 1, '2022-04-30', '2022-04-14 19:34:32', '2022-04-14 20:15:03', 1),
(9, '.kdfsjlk', 'lkjsdlkfj', 0, '2022-04-23', '2022-04-14 20:28:50', '2022-04-14 20:28:50', 6);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `full_name`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'tilak', 'tilak@gmail.com', '$2y$10$KJnSI302.wvdG9jLA99ZMOUzqNerorQ2JGroCA/vOO7ndBQkjpfNW', '2022-04-14 00:30:06', '2022-04-14 00:30:06'),
(2, 'tilak', 'tilak444@gmail.com', '$2y$10$aXAZwQRWV22sDZHbuHOhEeIg2sPBFBLifXjFiNehG7tX6iQnA57ru', '2022-04-14 00:37:46', '2022-04-14 00:37:46'),
(3, 'Meera', 'test@gmail.com', '$2y$10$9JQyd9U0nLM2Uk3jKYziJe.W/997rPKuKSEr2nQd60I4QQTOSJ8gO', '2022-04-14 00:38:49', '2022-04-14 00:38:49'),
(4, 'tilak', 'tilak334@gmail.com', '$2y$10$tqsyoPXHxVapkJ6gqXrv8e3i0pJb2qzb55WzsQ8PUG7oFxNCDS1F.', '2022-04-14 00:40:57', '2022-04-14 00:40:57'),
(5, 'sdfkhsk', 'tilak@sdfsdfsd.com', '$2y$10$db2AB9dQBJfiZ3RV/bDGVu1c2hzzoTx1IWSxG4ni35XsA0TlRYnBG', '2022-04-14 20:28:12', '2022-04-14 20:28:12'),
(6, 'poo', 'poo@gmail.com', '$2y$10$S9vkcCwtGmMqzX.3.wP8tuRrw0bs7qFkhXuRLkMH5MaLvh/YWu8Pa', '2022-04-14 20:28:31', '2022-04-14 20:28:31');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
