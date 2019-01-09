-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.33-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for taxi
CREATE DATABASE IF NOT EXISTS `taxi` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `taxi`;

-- Dumping structure for table taxi.articles
CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `dateAdded` datetime NOT NULL,
  `authorId` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `viewCount` int(11) NOT NULL,
  `likesCount` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `dislikesCount` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_BFDD3168A196F9FD` (`authorId`),
  KEY `IDX_BFDD316812469DE2` (`category_id`),
  CONSTRAINT `FK_BFDD316812469DE2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  CONSTRAINT `FK_BFDD3168A196F9FD` FOREIGN KEY (`authorId`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table taxi.articles: ~6 rows (approximately)
/*!40000 ALTER TABLE `articles` DISABLE KEYS */;
INSERT INTO `articles` (`id`, `title`, `content`, `dateAdded`, `authorId`, `image`, `viewCount`, `likesCount`, `category_id`, `dislikesCount`) VALUES
	(2, 'Lorem Ipsum', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec rhoncus vestibulum quam, in molestie neque vulputate eu. Nunc maximus felis vitae justo laoreet, vitae tristique turpis pretium. Integer eu mauris eget lectus iaculis vehicula a sit amet ipsum. Nam tortor turpis, pellentesque sodales accumsan et, congue sit amet est. Pellentesque eu lectus congue, accumsan diam eget, tempus orci. Praesent lacinia magna ornare condimentum sodales. Sed ac pretium quam. Morbi in nisi vel neque aliquet blandit vitae sit amet mi. Nullam tincidunt eleifend justo vel accumsan.\r\n\r\nAenean vel nibh eget eros tincidunt vestibulum quis eget ligula. Suspendisse venenatis nisl odio, quis tempus tellus faucibus in. Proin vitae massa nec nulla cursus semper sed non dui. Fusce et aliquam elit, et mattis nulla. Nulla gravida lobortis pretium. Suspendisse at pharetra ipsum. Nulla tincidunt facilisis velit nec vestibulum. Sed tristique aliquet elit, vel blandit dui congue sit amet. Praesent lobortis est non nulla varius fermentum. Phasellus id venenatis dui. Vivamus eros tortor, dictum ut sapien non, maximus ullamcorper justo. Vestibulum in tortor lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Pellentesque semper, quam in rhoncus pulvinar, nibh nulla consequat justo, quis facilisis orci arcu ut urna. Nam eget lacus pulvinar nisl imperdiet suscipit.', '2019-01-09 19:08:05', 5, '82d39c46af81da146d1417235a402acf.jpeg', 1, 0, 2, 0),
	(4, 'Lorem Ipsum', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec rhoncus vestibulum quam, in molestie neque vulputate eu. Nunc maximus felis vitae justo laoreet, vitae tristique turpis pretium. Integer eu mauris eget lectus iaculis vehicula a sit amet ipsum. Nam tortor turpis, pellentesque sodales accumsan et, congue sit amet est. Pellentesque eu lectus congue, accumsan diam eget, tempus orci. Praesent lacinia magna ornare condimentum sodales. Sed ac pretium quam. Morbi in nisi vel neque aliquet blandit vitae sit amet mi. Nullam tincidunt eleifend justo vel accumsan.\r\n\r\nAenean vel nibh eget eros tincidunt vestibulum quis eget ligula. Suspendisse venenatis nisl odio, quis tempus tellus faucibus in. Proin vitae massa nec nulla cursus semper sed non dui. Fusce et aliquam elit, et mattis nulla. Nulla gravida lobortis pretium. Suspendisse at pharetra ipsum. Nulla tincidunt facilisis velit nec vestibulum. Sed tristique aliquet elit, vel blandit dui congue sit amet. Praesent lobortis est non nulla varius fermentum. Phasellus id venenatis dui. Vivamus eros tortor, dictum ut sapien non, maximus ullamcorper justo. Vestibulum in tortor lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Pellentesque semper, quam in rhoncus pulvinar, nibh nulla consequat justo, quis facilisis orci arcu ut urna. Nam eget lacus pulvinar nisl imperdiet suscipit.', '2019-01-09 19:06:28', 5, '1182f1c93fb6b9d2f14a6f3ccb29817e.jpeg', 2, 1, 4, 0),
	(5, 'Lorem Ipsum', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec rhoncus vestibulum quam, in molestie neque vulputate eu. Nunc maximus felis vitae justo laoreet, vitae tristique turpis pretium. Integer eu mauris eget lectus iaculis vehicula a sit amet ipsum. Nam tortor turpis, pellentesque sodales accumsan et, congue sit amet est. Pellentesque eu lectus congue, accumsan diam eget, tempus orci. Praesent lacinia magna ornare condimentum sodales. Sed ac pretium quam. Morbi in nisi vel neque aliquet blandit vitae sit amet mi. Nullam tincidunt eleifend justo vel accumsan.\r\n\r\nAenean vel nibh eget eros tincidunt vestibulum quis eget ligula. Suspendisse venenatis nisl odio, quis tempus tellus faucibus in. Proin vitae massa nec nulla cursus semper sed non dui. Fusce et aliquam elit, et mattis nulla. Nulla gravida lobortis pretium. Suspendisse at pharetra ipsum. Nulla tincidunt facilisis velit nec vestibulum. Sed tristique aliquet elit, vel blandit dui congue sit amet. Praesent lobortis est non nulla varius fermentum. Phasellus id venenatis dui. Vivamus eros tortor, dictum ut sapien non, maximus ullamcorper justo. Vestibulum in tortor lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Pellentesque semper, quam in rhoncus pulvinar, nibh nulla consequat justo, quis facilisis orci arcu ut urna. Nam eget lacus pulvinar nisl imperdiet suscipit.', '2019-01-09 19:07:35', 5, 'dcbe386f42d0c867965d8e27858182ca.jpeg', 0, 0, 5, 0),
	(6, 'Lorem Ipsum', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec rhoncus vestibulum quam, in molestie neque vulputate eu. Nunc maximus felis vitae justo laoreet, vitae tristique turpis pretium. Integer eu mauris eget lectus iaculis vehicula a sit amet ipsum. Nam tortor turpis, pellentesque sodales accumsan et, congue sit amet est. Pellentesque eu lectus congue, accumsan diam eget, tempus orci. Praesent lacinia magna ornare condimentum sodales. Sed ac pretium quam. Morbi in nisi vel neque aliquet blandit vitae sit amet mi. Nullam tincidunt eleifend justo vel accumsan.\r\n\r\nAenean vel nibh eget eros tincidunt vestibulum quis eget ligula. Suspendisse venenatis nisl odio, quis tempus tellus faucibus in. Proin vitae massa nec nulla cursus semper sed non dui. Fusce et aliquam elit, et mattis nulla. Nulla gravida lobortis pretium. Suspendisse at pharetra ipsum. Nulla tincidunt facilisis velit nec vestibulum. Sed tristique aliquet elit, vel blandit dui congue sit amet. Praesent lobortis est non nulla varius fermentum. Phasellus id venenatis dui. Vivamus eros tortor, dictum ut sapien non, maximus ullamcorper justo. Vestibulum in tortor lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Pellentesque semper, quam in rhoncus pulvinar, nibh nulla consequat justo, quis facilisis orci arcu ut urna. Nam eget lacus pulvinar nisl imperdiet suscipit.', '2019-01-09 19:08:25', 5, '8b39bfc639adba5ff963e02a2fd8db88.jpeg', 2, 0, 6, 1),
	(7, 'Lorem Ipsum', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec rhoncus vestibulum quam, in molestie neque vulputate eu. Nunc maximus felis vitae justo laoreet, vitae tristique turpis pretium. Integer eu mauris eget lectus iaculis vehicula a sit amet ipsum. Nam tortor turpis, pellentesque sodales accumsan et, congue sit amet est. Pellentesque eu lectus congue, accumsan diam eget, tempus orci. Praesent lacinia magna ornare condimentum sodales. Sed ac pretium quam. Morbi in nisi vel neque aliquet blandit vitae sit amet mi. Nullam tincidunt eleifend justo vel accumsan.\r\n\r\nAenean vel nibh eget eros tincidunt vestibulum quis eget ligula. Suspendisse venenatis nisl odio, quis tempus tellus faucibus in. Proin vitae massa nec nulla cursus semper sed non dui. Fusce et aliquam elit, et mattis nulla. Nulla gravida lobortis pretium. Suspendisse at pharetra ipsum. Nulla tincidunt facilisis velit nec vestibulum. Sed tristique aliquet elit, vel blandit dui congue sit amet. Praesent lobortis est non nulla varius fermentum. Phasellus id venenatis dui. Vivamus eros tortor, dictum ut sapien non, maximus ullamcorper justo. Vestibulum in tortor lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Pellentesque semper, quam in rhoncus pulvinar, nibh nulla consequat justo, quis facilisis orci arcu ut urna. Nam eget lacus pulvinar nisl imperdiet suscipit.', '2019-01-09 19:08:49', 5, '623d5575fc5b4225a7af326fcdb60f5c.jpeg', 0, 0, 7, 0),
	(8, 'Lorem Ipsum', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec rhoncus vestibulum quam, in molestie neque vulputate eu. Nunc maximus felis vitae justo laoreet, vitae tristique turpis pretium. Integer eu mauris eget lectus iaculis vehicula a sit amet ipsum. Nam tortor turpis, pellentesque sodales accumsan et, congue sit amet est. Pellentesque eu lectus congue, accumsan diam eget, tempus orci. Praesent lacinia magna ornare condimentum sodales. Sed ac pretium quam. Morbi in nisi vel neque aliquet blandit vitae sit amet mi. Nullam tincidunt eleifend justo vel accumsan.\r\n\r\nAenean vel nibh eget eros tincidunt vestibulum quis eget ligula. Suspendisse venenatis nisl odio, quis tempus tellus faucibus in. Proin vitae massa nec nulla cursus semper sed non dui. Fusce et aliquam elit, et mattis nulla. Nulla gravida lobortis pretium. Suspendisse at pharetra ipsum. Nulla tincidunt facilisis velit nec vestibulum. Sed tristique aliquet elit, vel blandit dui congue sit amet. Praesent lobortis est non nulla varius fermentum. Phasellus id venenatis dui. Vivamus eros tortor, dictum ut sapien non, maximus ullamcorper justo. Vestibulum in tortor lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Pellentesque semper, quam in rhoncus pulvinar, nibh nulla consequat justo, quis facilisis orci arcu ut urna. Nam eget lacus pulvinar nisl imperdiet suscipit.', '2019-01-09 19:09:15', 5, 'ebcd17e8726708d3cdba47d3cf75d2f7.jpeg', 6, 1, 3, 0);
/*!40000 ALTER TABLE `articles` ENABLE KEYS */;

-- Dumping structure for table taxi.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table taxi.categories: ~6 rows (approximately)
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` (`id`, `name`) VALUES
	(2, 'Трафик'),
	(3, 'Пътна обстановка'),
	(4, 'Обяви'),
	(5, 'Новини'),
	(6, 'Интересно'),
	(7, 'Други');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;

-- Dumping structure for table taxi.comments
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `article_id` int(11) DEFAULT NULL,
  `author_id` int(11) DEFAULT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `dateAdded` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_5F9E962A7294869C` (`article_id`),
  KEY `IDX_5F9E962AF675F31B` (`author_id`),
  CONSTRAINT `FK_5F9E962A7294869C` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_5F9E962AF675F31B` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table taxi.comments: ~3 rows (approximately)
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` (`id`, `article_id`, `author_id`, `content`, `dateAdded`) VALUES
	(3, 8, 5, 'comment', '2019-01-09 19:09:51'),
	(4, 6, 5, 'wow', '2019-01-09 19:10:59'),
	(5, 4, 5, 'искам', '2019-01-09 19:13:05');
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;

-- Dumping structure for table taxi.drivers
CREATE TABLE IF NOT EXISTS `drivers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fullName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `age` int(11) NOT NULL,
  `quote` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ratingsCount` int(11) NOT NULL,
  `ratingsSum` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table taxi.drivers: ~3 rows (approximately)
/*!40000 ALTER TABLE `drivers` DISABLE KEYS */;
INSERT INTO `drivers` (`id`, `fullName`, `age`, `quote`, `image`, `ratingsCount`, `ratingsSum`) VALUES
	(7, 'Stavri Petrov', 59, 'Neque porro quisquam est qui dolorem', '3fcbe4b5876c393c70045c51a42423e2.jpeg', 4, 27),
	(8, 'Maria Ivanova', 30, 'Neque porro quisquam est qui dolorem', 'aefe5a7931938af1b5b4e043011e952f.jpeg', 2, 16),
	(9, 'Shisho', 58, 'Neque porro quisquam est qui dolorem', 'c7fbe0cb9e3bba5177937ac78c4b58f0.jpeg', 3, 9);
/*!40000 ALTER TABLE `drivers` ENABLE KEYS */;

-- Dumping structure for table taxi.ratings
CREATE TABLE IF NOT EXISTS `ratings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `driver_id` int(11) DEFAULT NULL,
  `author_id` int(11) DEFAULT NULL,
  `grade` int(11) NOT NULL,
  `comment` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dateAdded` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_CEB607C9C3423909` (`driver_id`),
  KEY `IDX_CEB607C9F675F31B` (`author_id`),
  CONSTRAINT `FK_CEB607C9C3423909` FOREIGN KEY (`driver_id`) REFERENCES `drivers` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_CEB607C9F675F31B` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table taxi.ratings: ~9 rows (approximately)
/*!40000 ALTER TABLE `ratings` DISABLE KEYS */;
INSERT INTO `ratings` (`id`, `driver_id`, `author_id`, `grade`, `comment`, `dateAdded`) VALUES
	(8, 7, 5, 8, 'Добро пътуване', '2019-01-09 18:48:12'),
	(9, 7, 5, 7, 'Доволен съм', '2019-01-09 18:48:30'),
	(10, 7, 5, 2, 'Не става', '2019-01-09 18:48:44'),
	(11, 8, 5, 9, 'Най-добрата', '2019-01-09 18:49:00'),
	(12, 8, 5, 7, 'Спокойно пътуване', '2019-01-09 18:51:03'),
	(13, 9, 5, 2, 'не', '2019-01-09 18:51:26'),
	(14, 9, 5, 3, '.......', '2019-01-09 18:51:38'),
	(16, 7, 4, 10, 'топ', '2019-01-09 19:17:49'),
	(17, 9, 4, 4, '...', '2019-01-09 19:18:19');
/*!40000 ALTER TABLE `ratings` ENABLE KEYS */;

-- Dumping structure for table taxi.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_B63E2EC75E237E06` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table taxi.roles: ~2 rows (approximately)
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`id`, `name`) VALUES
	(2, 'ROLE_ADMIN'),
	(1, 'ROLE_USER');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;

-- Dumping structure for table taxi.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fullName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_1483A5E9E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table taxi.users: ~1 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `email`, `fullName`, `password`) VALUES
	(4, 'gosho@abv.bg', 'Gosho', '$2y$13$QCASr95VI2kgYkMH5Yd98OOJEeYg0azZfGHSlEFrwpDMZ67FgNk6m'),
	(5, 'niki.marchin@gmail.com', 'Nikolay Marchin', '$2y$13$7hXyoy0a3vKfnXmCFaebS.vP9.UtmV4wsO38GtmR.9AmrYxSPzpbC'),
	(6, 'maria@abv.bg', 'Jon Snow', '$2y$13$hldz1ZuB460FM8ZbuKLo5uGRQEAV7v/rDYpk7tFp1ziyEtjoQ2aSW');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Dumping structure for table taxi.users_dislikes
CREATE TABLE IF NOT EXISTS `users_dislikes` (
  `user_id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`article_id`),
  KEY `IDX_56B295CBA76ED395` (`user_id`),
  KEY `IDX_56B295CB7294869C` (`article_id`),
  CONSTRAINT `FK_56B295CB7294869C` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_56B295CBA76ED395` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table taxi.users_dislikes: ~1 rows (approximately)
/*!40000 ALTER TABLE `users_dislikes` DISABLE KEYS */;
INSERT INTO `users_dislikes` (`user_id`, `article_id`) VALUES
	(5, 6);
/*!40000 ALTER TABLE `users_dislikes` ENABLE KEYS */;

-- Dumping structure for table taxi.users_likes
CREATE TABLE IF NOT EXISTS `users_likes` (
  `user_id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`article_id`),
  KEY `IDX_AEBDEA34A76ED395` (`user_id`),
  KEY `IDX_AEBDEA347294869C` (`article_id`),
  CONSTRAINT `FK_AEBDEA347294869C` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_AEBDEA34A76ED395` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table taxi.users_likes: ~2 rows (approximately)
/*!40000 ALTER TABLE `users_likes` DISABLE KEYS */;
INSERT INTO `users_likes` (`user_id`, `article_id`) VALUES
	(5, 4),
	(5, 8);
/*!40000 ALTER TABLE `users_likes` ENABLE KEYS */;

-- Dumping structure for table taxi.users_roles
CREATE TABLE IF NOT EXISTS `users_roles` (
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `IDX_51498A8EA76ED395` (`user_id`),
  KEY `IDX_51498A8ED60322AC` (`role_id`),
  CONSTRAINT `FK_51498A8EA76ED395` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `FK_51498A8ED60322AC` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table taxi.users_roles: ~3 rows (approximately)
/*!40000 ALTER TABLE `users_roles` DISABLE KEYS */;
INSERT INTO `users_roles` (`user_id`, `role_id`) VALUES
	(4, 1),
	(4, 2),
	(5, 1),
	(5, 2),
	(6, 1);
/*!40000 ALTER TABLE `users_roles` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
