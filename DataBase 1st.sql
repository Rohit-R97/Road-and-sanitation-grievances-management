-- Adminer 4.3.1 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP DATABASE IF EXISTS `rsgms`;
CREATE DATABASE `rsgms` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;
USE `rsgms`;

DROP TABLE IF EXISTS `authority`;
CREATE TABLE `authority` (
  `a_id` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `total_post` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `completed_posts` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `img_path` text COLLATE utf8_unicode_ci NOT NULL,
  `ranking` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `locality` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`a_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `authority` (`a_id`, `name`, `email`, `total_post`, `completed_posts`, `img_path`, `ranking`, `locality`) VALUES
('106805342237819741258',	'Rohit Rayte',	'rohit.rayte9@gmail.com',	1,	0,	'https://lh5.googleusercontent.com/-MG4VtBYb4K4/AAAAAAAAAAI/AAAAAAAAAAA/ACnBePbhnpogmzllkC5oiiA3ORnFMZce_A/s96-c/photo.jpg',	0,	'Sion')
ON DUPLICATE KEY UPDATE `a_id` = VALUES(`a_id`), `name` = VALUES(`name`), `email` = VALUES(`email`), `total_post` = VALUES(`total_post`), `completed_posts` = VALUES(`completed_posts`), `img_path` = VALUES(`img_path`), `ranking` = VALUES(`ranking`), `locality` = VALUES(`locality`);

DROP TABLE IF EXISTS `citizen`;
CREATE TABLE `citizen` (
  `c_id` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `img_path` text COLLATE utf8_unicode_ci NOT NULL,
  `past_posts` int(10) unsigned DEFAULT '0',
  PRIMARY KEY (`c_id`),
  KEY `past_posts` (`past_posts`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `citizen` (`c_id`, `name`, `email`, `img_path`, `past_posts`) VALUES
('107233120903234616385',	'ronak rayte',	'ronakinfo7@gmail.com',	'https://lh4.googleusercontent.com/-g0p6vZ1XrME/AAAAAAAAAAI/AAAAAAAAAo0/IJJK_XXlUM4/s96-c/photo.jpg',	NULL),
('108932407023627614302',	'ROHIT RAYTE',	'rohit.rayte@somaiya.edu',	'https://lh3.googleusercontent.com/-d_AEqND2G3I/AAAAAAAAAAI/AAAAAAAAAAA/ACnBePZX6EF6Qe4v1dJ5m64uTZzkDX8gXQ/s96-c/photo.jpg',	1)
ON DUPLICATE KEY UPDATE `c_id` = VALUES(`c_id`), `name` = VALUES(`name`), `email` = VALUES(`email`), `img_path` = VALUES(`img_path`), `past_posts` = VALUES(`past_posts`);

DROP TABLE IF EXISTS `citizen_post`;
CREATE TABLE `citizen_post` (
  `c_id` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `post_id` int(10) unsigned NOT NULL,
  `type` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`c_id`,`post_id`),
  KEY `post_id` (`post_id`),
  CONSTRAINT `citizen_post_ibfk_5` FOREIGN KEY (`post_id`) REFERENCES `post` (`post_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `citizen_post_ibfk_6` FOREIGN KEY (`c_id`) REFERENCES `citizen` (`c_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `citizen_post` (`c_id`, `post_id`, `type`) VALUES
('107233120903234616385',	1,	'U'),
('107233120903234616385',	3,	'U'),
('108932407023627614302',	1,	'U'),
('108932407023627614302',	2,	'U'),
('108932407023627614302',	3,	'U')
ON DUPLICATE KEY UPDATE `c_id` = VALUES(`c_id`), `post_id` = VALUES(`post_id`), `type` = VALUES(`type`);

DROP TABLE IF EXISTS `post`;
CREATE TABLE `post` (
  `post_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `img_url` text COLLATE utf8_unicode_ci NOT NULL,
  `geo_lat` double NOT NULL,
  `geo_long` double NOT NULL,
  `upvotes` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `notice` text COLLATE utf8_unicode_ci,
  `deadline` date DEFAULT NULL,
  `status` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `description` mediumtext COLLATE utf8_unicode_ci,
  `locality` tinytext COLLATE utf8_unicode_ci,
  PRIMARY KEY (`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `post` (`post_id`, `img_url`, `geo_lat`, `geo_long`, `upvotes`, `notice`, `deadline`, `status`, `description`, `locality`) VALUES
(1,	'http://www.aacounty.org/sebin/f/j/pothole.jpeg',	10,	10,	2,	' We will work over it soon.',	NULL,	'C',	' Pothole issue 1',	NULL),
(2,	'http://i4.mirror.co.uk/incoming/article6777683.ece/ALTERNATES/s615b/Potholes-in-Paisley.jpg',	10,	10,	4,	'   Clearing it up.',	NULL,	'C',	' Pothole issue 2',	'Andheri'),
(3,	'http://adigaskell.org/wp-content/uploads/2015/06/potholes.jpg',	10,	10,	9,	'',	'2017-10-15',	'P',	' Pothole issue 3 Hello MOM',	NULL),
(4,	'https://media1.fdncms.com/chicago/imager/a-stretch-of-potholes-along-wacker/u/original/14594787/potholes-magnum.jpg',	10,	10,	2,	NULL,	'2017-10-27',	'P',	' Pothole issue 4',	NULL),
(5,	'uploads/background2.jpg',	10,	10,	0,	NULL,	'2017-10-24',	'P',	'Demo',	NULL),
(6,	'uploads/img.jpg',	19.046844583333,	72.875086277778,	0,	NULL,	'2017-11-06',	'P',	'Geo-Tag Demo.',	'Sion')
ON DUPLICATE KEY UPDATE `post_id` = VALUES(`post_id`), `img_url` = VALUES(`img_url`), `geo_lat` = VALUES(`geo_lat`), `geo_long` = VALUES(`geo_long`), `upvotes` = VALUES(`upvotes`), `notice` = VALUES(`notice`), `deadline` = VALUES(`deadline`), `status` = VALUES(`status`), `description` = VALUES(`description`), `locality` = VALUES(`locality`);

DROP TABLE IF EXISTS `resolved_post`;
CREATE TABLE `resolved_post` (
  `resolved_id` int(10) unsigned NOT NULL,
  `img_url` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `resolved_post` (`resolved_id`, `img_url`) VALUES
(1,	'uploads/resolved/background2 (2).jpg'),
(2,	'uploads/resolved/road repaired 1.jpg')
ON DUPLICATE KEY UPDATE `resolved_id` = VALUES(`resolved_id`), `img_url` = VALUES(`img_url`);

-- 2017-10-21 14:06:52