-- Adminer 4.7.6 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP DATABASE IF EXISTS `sapes`;
CREATE DATABASE `sapes` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `sapes`;

DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `updated_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `category` (`id`, `name`, `picture`, `created_at`, `updated_at`, `description`, `slug`) VALUES
(1,	'jackets',	'https://images.pexels.com/photos/6995704/pexels-photo-6995704.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2',	'2023-04-27 17:54:18',	NULL,	'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eveniet, quod blanditiis quasi ut officiis ipsa vero.',	'jackets'),
(2,	'pants',	'https://images.pexels.com/photos/15778292/pexels-photo-15778292.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2',	'2023-04-27 17:54:18',	NULL,	'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eveniet, quod blanditiis quasi ut officiis ipsa vero.',	'pants'),
(5,	'hoodies',	'https://images.pexels.com/photos/5465247/pexels-photo-5465247.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2',	'2023-04-27 17:54:18',	NULL,	'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eveniet, quod blanditiis quasi ut officiis ipsa vero.',	'hoodies'),
(6,	'bags',	'https://images.pexels.com/photos/3731256/pexels-photo-3731256.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2',	'2023-04-27 17:54:18',	NULL,	'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eveniet, quod blanditiis quasi ut officiis ipsa vero.',	'bags'),
(7,	'hats',	'https://images.pexels.com/photos/5251390/pexels-photo-5251390.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2',	'2023-04-27 17:54:18',	NULL,	'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eveniet, quod blanditiis quasi ut officiis ipsa vero.',	'hats'),
(8,	't-shirts',	'https://images.pexels.com/photos/14711712/pexels-photo-14711712.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2',	'2023-04-27 17:54:18',	NULL,	'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eveniet, quod blanditiis quasi ut officiis ipsa vero.',	't-shirts'),
(10,	'sweatshirts',	'https://images.pexels.com/photos/9461759/pexels-photo-9461759.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2',	'2023-04-27 17:54:18',	NULL,	'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eveniet, quod blanditiis quasi ut officiis ipsa vero.',	'sweatshirts');

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20230425110023',	'2023-04-25 13:36:39',	388);

DROP TABLE IF EXISTS `inventory`;
CREATE TABLE `inventory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `size` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stock` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_B12D4A364584665A` (`product_id`),
  CONSTRAINT `FK_B12D4A364584665A` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=106 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `inventory` (`id`, `product_id`, `size`, `stock`) VALUES
(1,	1,	'L',	14),
(2,	1,	'M',	3),
(3,	1,	'S',	38),
(4,	1,	'XL',	51),
(5,	1,	'XS',	28),
(6,	2,	'L',	80),
(7,	2,	'M',	-1),
(8,	2,	'S',	7),
(9,	2,	'XL',	99),
(10,	2,	'XS',	12),
(11,	3,	'L',	18),
(12,	3,	'M',	84),
(13,	3,	'S',	68),
(14,	3,	'XL',	36),
(15,	3,	'XS',	53),
(16,	4,	'L',	53),
(17,	4,	'M',	100),
(18,	4,	'S',	15),
(19,	4,	'XL',	65),
(20,	4,	'XS',	25),
(21,	5,	'L',	33),
(22,	5,	'M',	66),
(23,	5,	'S',	33),
(24,	5,	'XL',	64),
(25,	5,	'XS',	66),
(26,	6,	'L',	11),
(27,	6,	'M',	89),
(28,	6,	'S',	10),
(29,	6,	'XL',	99),
(30,	6,	'XS',	20),
(31,	7,	'L',	63),
(32,	7,	'M',	19),
(33,	7,	'S',	77),
(34,	7,	'XL',	60),
(35,	7,	'XS',	55),
(36,	8,	'L',	85),
(37,	8,	'M',	20),
(38,	8,	'S',	70),
(39,	8,	'XL',	76),
(40,	8,	'XS',	10),
(41,	9,	'L',	74),
(42,	9,	'M',	97),
(43,	9,	'S',	72),
(44,	9,	'XL',	75),
(45,	9,	'XS',	20),
(46,	10,	'L',	50),
(47,	10,	'M',	56),
(48,	10,	'S',	44),
(49,	10,	'XL',	81),
(50,	10,	'XS',	54),
(51,	11,	'L',	25),
(52,	11,	'M',	6),
(53,	11,	'S',	35),
(54,	11,	'XL',	8),
(55,	11,	'XS',	56),
(56,	12,	'L',	90),
(57,	12,	'M',	50),
(58,	12,	'S',	88),
(59,	12,	'XL',	8),
(60,	12,	'XS',	62),
(61,	13,	'L',	47),
(62,	13,	'M',	17),
(63,	13,	'S',	79),
(64,	13,	'XL',	84),
(65,	13,	'XS',	61),
(66,	14,	'L',	14),
(67,	14,	'M',	98),
(68,	14,	'S',	25),
(69,	14,	'XL',	77),
(70,	14,	'XS',	75),
(71,	15,	'L',	91),
(72,	15,	'M',	65),
(73,	15,	'S',	78),
(74,	15,	'XL',	59),
(75,	15,	'XS',	42),
(76,	16,	'L',	59),
(77,	16,	'M',	37),
(78,	16,	'S',	42),
(79,	16,	'XL',	83),
(80,	16,	'XS',	24),
(81,	17,	'L',	82),
(82,	17,	'M',	55),
(83,	17,	'S',	33),
(84,	17,	'XL',	40),
(85,	17,	'XS',	36),
(86,	18,	'L',	70),
(87,	18,	'M',	6),
(88,	18,	'S',	55),
(89,	18,	'XL',	29),
(90,	18,	'XS',	55),
(91,	19,	'L',	93),
(92,	19,	'M',	84),
(93,	19,	'S',	77),
(94,	19,	'XL',	10),
(95,	19,	'XS',	33),
(96,	20,	'L',	85),
(97,	20,	'M',	12),
(98,	20,	'S',	25),
(99,	20,	'XL',	86),
(100,	20,	'XS',	71),
(101,	21,	'L',	17),
(102,	21,	'M',	76),
(103,	21,	'S',	21),
(104,	21,	'XL',	65),
(105,	21,	'XS',	76);

DROP TABLE IF EXISTS `messenger_messages`;
CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  KEY `IDX_75EA56E016BA31DB` (`delivered_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `order`;
CREATE TABLE `order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `delivery_adress` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `updated_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_F5299398A76ED395` (`user_id`),
  CONSTRAINT `FK_F5299398A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12988950 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `order` (`id`, `user_id`, `delivery_adress`, `created_at`, `updated_at`) VALUES
(12988942,	115,	NULL,	'2023-05-04 00:01:32',	NULL),
(12988943,	115,	NULL,	'2023-05-04 00:10:23',	NULL),
(12988944,	115,	NULL,	'2023-05-04 00:20:03',	NULL),
(12988945,	115,	NULL,	'2023-05-04 09:05:23',	NULL),
(12988946,	115,	NULL,	'2023-05-04 10:06:45',	NULL),
(12988947,	115,	NULL,	'2023-05-04 13:39:29',	NULL),
(12988948,	115,	NULL,	'2023-05-04 14:31:46',	NULL),
(12988949,	116,	NULL,	'2023-05-04 14:57:12',	NULL);

DROP TABLE IF EXISTS `order_details`;
CREATE TABLE `order_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `my_order_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `size` varchar(4) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_845CA2C14584665A` (`product_id`),
  KEY `IDX_845CA2C1BFCDF877` (`my_order_id`),
  CONSTRAINT `FK_845CA2C14584665A` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  CONSTRAINT `FK_845CA2C1BFCDF877` FOREIGN KEY (`my_order_id`) REFERENCES `order` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `order_details` (`id`, `product_id`, `my_order_id`, `quantity`, `size`) VALUES
(2,	17,	12988942,	1,	'M'),
(3,	12,	12988942,	2,	'L'),
(4,	8,	12988943,	1,	'L'),
(5,	13,	12988943,	1,	'M'),
(6,	3,	12988944,	1,	'M'),
(7,	21,	12988944,	2,	'L'),
(8,	18,	12988944,	1,	'M'),
(9,	9,	12988945,	1,	'M'),
(10,	19,	12988945,	1,	'M'),
(11,	15,	12988946,	1,	'XL'),
(12,	6,	12988946,	1,	'L'),
(13,	8,	12988947,	1,	'L'),
(14,	2,	12988947,	2,	'M'),
(15,	12,	12988948,	1,	'M'),
(16,	3,	12988948,	1,	'S'),
(17,	6,	12988948,	1,	'L'),
(18,	1,	12988949,	1,	'M'),
(19,	13,	12988949,	1,	'S');

DROP TABLE IF EXISTS `product`;
CREATE TABLE `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL,
  `name` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rate` double DEFAULT NULL,
  `price` float NOT NULL,
  `best_sellers_order` smallint(6) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp() COMMENT '(DC2Type:datetime_immutable)',
  `updated_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  `slug` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_D34A04AD12469DE2` (`category_id`),
  CONSTRAINT `FK_D34A04AD12469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `product` (`id`, `category_id`, `name`, `description`, `gender`, `color`, `rate`, `price`, `best_sellers_order`, `created_at`, `updated_at`, `slug`, `picture`) VALUES
(1,	8,	'Disobey t-shirt - Black',	'Express yourself with this rebellious black t-shirt featuring a bold \"Disobey\" graphic on the front.',	'Unisex',	'Black',	3.5,	2500,	2,	'2023-05-03 11:31:15',	NULL,	'disobey-t-shirt-black',	'https://images.pexels.com/photos/14230590/pexels-photo-14230590.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'),
(2,	8,	'I don\'t smoke t-shirt - White',	'Make a statement with this white tee featuring \'I Don\'t smoke\' in bold blue letters. Perfect for those who want to stand out and send a message.',	'Unisex',	'White',	4,	2200,	NULL,	'2023-05-03 22:20:11',	NULL,	'i-don-t-smoke-t-shirt-white',	'https://images.pexels.com/photos/14711712/pexels-photo-14711712.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'),
(3,	8,	'Skull t-shirt - Black',	'A classic black t-shirt featuring a bold black skull graphic on the front, perfect for adding a touch of edge to any outfit.',	'Unisex',	'White',	4.5,	2700,	NULL,	'2023-05-03 22:21:06',	NULL,	'skull-t-shirt-black',	'https://images.pexels.com/photos/15937632/pexels-photo-15937632.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'),
(4,	7,	'Bucket hat - Vivid Auburn',	'Stay cool under the sun with this classic and versatile bucket hat. With no imprints, this accessory is perfect for any outfit and occasion.',	'Unisex',	'Vivid Auburn',	5,	1500,	NULL,	'2023-05-03 22:21:06',	NULL,	'bucket-hat-vivid-auburn',	'https://images.pexels.com/photos/5592264/pexels-photo-5592264.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'),
(5,	7,	'Cap - Black',	'Add a touch of sleek style to your look with this black cap. With its minimalist design and classic color, it\'s a versatile accessory that can easily complement any outfit.',	'Unisex',	'Black',	3.5,	1000,	NULL,	'2023-05-03 22:21:06',	NULL,	'cap-black',	'https://images.pexels.com/photos/5251390/pexels-photo-5251390.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'),
(6,	1,	'Velvet Jacket - Bubblegum Pink',	'Make a statement with this unique velvet jacket featuring a bold \'Retired from Society\' graphic on the back. The rich texture of the velvet adds an extra touch of sophistication to your look.',	'Man',	'Bubblegum Pink',	4,	11000,	NULL,	'2023-05-03 22:21:06',	NULL,	'velvet-jacket-bubblegum-pink',	'https://images.pexels.com/photos/10365584/pexels-photo-10365584.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'),
(7,	1,	'University Elite Jacket -  Black',	'Upgrade your style with this sleek bomber jacket. The classic design is perfect for any occasion, and the durable material ensures long-lasting wear. With a comfortable fit and stylish look, this jacket is a must-have for any fashion-forward individual.',	'Woman',	'Black',	4.5,	8500,	NULL,	'2023-05-03 22:21:06',	NULL,	'university-elite-jacket-black',	'https://images.pexels.com/photos/14565976/pexels-photo-14565976.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'),
(8,	1,	'Bombers - Ebony',	'A black university jacket is the perfect way to show off your personal stye. This type of jacket is inspired by vintage varsity jacket, with a modern twist that makes it is a great addtion to any streetwear outfit.',	'Man',	'Ebony',	5,	9800,	NULL,	'2023-05-03 22:21:06',	NULL,	'bombers-ebony',	'https://images.pexels.com/photos/5592271/pexels-photo-5592271.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'),
(9,	1,	'Winter Jacket - Gray',	'This jacket provides warmth and protection from the elements, whiles also keeping you stylish and comfortable.',	'Woman',	'Gray',	3.5,	7200,	NULL,	'2023-05-03 22:21:06',	NULL,	'winter-jacket-gray',	'https://images.unsplash.com/photo-1561916618-dc74b38b787d?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1664&q=80'),
(10,	6,	'Urban Explorer Bag - Black',	'This type of bag is designed for everyday wear, and features a spacious interior with multiple pockets and compartements for easy organization.',	'Unisex',	'Black',	4,	4000,	NULL,	'2023-05-03 22:21:06',	NULL,	'urban-explorer-bag-black',	'https://images.pexels.com/photos/3731256/pexels-photo-3731256.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'),
(11,	6,	'Midnight Run - Black',	'Made from high-quality leather. The black color gives the bag a sleek and modern that can easily be dresses up or down to match any occasion.',	'Unisex',	'Black',	5,	5500,	NULL,	'2023-05-03 22:21:06',	NULL,	'midnight-run-black',	'https://images.pexels.com/photos/1231059/pexels-photo-1231059.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'),
(12,	5,	'Oversize hoodie - Black',	'This simple black hoodie is a versatile addition to any wardrobe, great for layering or wearing on its own.',	'Unisex',	'Black',	4.5,	4000,	2,	'2023-05-03 22:21:06',	NULL,	'oversize-hoodie-black',	'https://images.pexels.com/photos/5465247/pexels-photo-5465247.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'),
(13,	5,	'Slim hoodie - Yellow',	'he slim-fit design of the hoodie is tailored to fit close to the body, providing a flattering silhouette while still allowing for comfortable movement.',	'Unisex',	'Yellow',	5,	3800,	NULL,	'2023-05-03 22:21:06',	NULL,	'slim-hoodie-yellow',	'https://images.pexels.com/photos/1183266/pexels-photo-1183266.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'),
(14,	5,	'Army hoodie - Green',	'Stay casual and stylish with this comfortable green hoodie, featuring a subtle chest detail that adds a touch of individuality to your look.',	'Unisex',	'Green',	3.5,	5000,	NULL,	'2023-05-03 22:21:06',	NULL,	'army-hoodie-green',	'https://images.pexels.com/photos/3768207/pexels-photo-3768207.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'),
(15,	5,	'Broken Heart Hoodie - Black',	'This is a hoodie with a printed graphic on the front. The graphic hoodie is typically made from soft and comfortable fabric.',	'Unisex',	'Black',	4,	6200,	NULL,	'2023-05-03 22:21:06',	NULL,	'broken-heart-hoodie-black',	'https://images.pexels.com/photos/2932748/pexels-photo-2932748.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'),
(16,	10,	'Sweatshirt - Blue gray',	'This sweatshirt is typically made from soft and warm material such as cotton.',	'Woman',	'Blue Gray',	5,	3200,	NULL,	'2023-05-03 22:21:06',	NULL,	'sweatshirt-blue-gray',	'https://images.pexels.com/photos/6995704/pexels-photo-6995704.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'),
(17,	2,	'Cargo pants - Tan',	'Stay comfortable in style with our tan cargo pants. With their loose fit and functional pockets, they\'re perfect for everyday wear.',	'Unisex',	'Tan',	3.5,	4000,	NULL,	'2023-05-03 22:21:06',	NULL,	'cargo-pants-tan',	'https://images.pexels.com/photos/15778292/pexels-photo-15778292.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'),
(18,	2,	'Jogging with white stripes - Yellow',	'Get a stylish and comfortable look with these slim-fit yellow jogging pants featuring white stripes, perfect for your active lifestyle.',	'Unisex',	'Yellow',	4,	2500,	NULL,	'2023-05-03 22:21:06',	NULL,	'jogging-with-white-stripes-yellow',	'https://images.pexels.com/photos/5325887/pexels-photo-5325887.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'),
(19,	2,	'Oversize cargo pants - Black',	'Oversized black cargo pants with a unique raw-edge finish. These pants feature no imprints and offer a casual yet stylish look.',	'Unisex',	'Black',	4.5,	4000,	NULL,	'2023-05-03 22:21:06',	NULL,	'oversize-cargo-pants-black',	'https://images.pexels.com/photos/15883360/pexels-photo-15883360.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'),
(20,	8,	'T-shirt with black stripes - Queen Pink',	'Add a pop of color to your wardrobe with this pink t-shirt featuring bold black stripes. With its clean design and comfortable fit, this shirt is perfect for any casual occasion.',	'Unisex',	'Queen Pink',	5,	2000,	NULL,	'2023-05-03 22:21:06',	NULL,	't-shirt-with-black-stripes-queen-pink',	'https://images.pexels.com/photos/15883360/pexels-photo-15883360.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'),
(21,	10,	'Sweatshirt - Rifle green',	'Stay cozy and stylish with this basic rifle green sweatshirt. No fuss, no frills - just comfortable simplicity.',	'Man',	'Rifle Green',	5,	3000,	NULL,	'2023-05-03 22:21:06',	NULL,	'sweatshirt-rifle-green',	'https://images.pexels.com/photos/9461759/pexels-photo-9461759.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2');

DROP TABLE IF EXISTS `refresh_tokens`;
CREATE TABLE `refresh_tokens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `refresh_token` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `valid` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_9BACE7E1C74F2195` (`refresh_token`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `refresh_tokens` (`id`, `refresh_token`, `username`, `valid`) VALUES
(37,	'c1ca8c517cd41a50b1d5ee8e1541a1146e2a1e00d3d92022d4fe7b9b430110252ea148c8754ebb7313c3bb2972f1d29d57556da5d263742a90f94fee8861df07',	'john.doe@gmail.com',	'2023-06-03 01:20:18'),
(38,	'0020df0d1b9cc2103eb2a31d3e23d2bd3734db3dee9428f3fbd0dc9b750abdbaafface80045946a6bede64c14fd487392ccb028dc4370322144f14d48d5242da',	'john.doe@gmail.com',	'2023-06-03 01:27:50'),
(39,	'75f5c3c82b7135360b09a43c4e8d8cdca25ad04319e15fd9e7418e3f923f5b5acbb5063121b7f25ec4db422101123bd317b6084df79b49da3ad261a027a19f31',	'john.doe@gmail.com',	'2023-06-03 09:02:51'),
(40,	'4bf411964ad13d78ddeea0a932dc94a84fc14ebd016ffb9a6b9bf7e00be58e30b71c5217c437670656dfe60d3e1e1e6a877adc9c4e81abacb26b51b7e600a003',	'john.doe@gmail.com',	'2023-06-03 10:04:58'),
(41,	'903e635c0d6dd528fc7530f9a677dafa960467c5a85530dbf66fc955f7ea52b4fce8958816fc3f45cb6428e7323b7ee03725606ec064e2d6874036401512ef0f',	'john.doe@gmail.com',	'2023-06-03 13:47:20'),
(42,	'92dd4e0b82123b30e50e5510b94c899d618407ef0b41f5715e4fa10e416b008b2c1b5e27ffad06074644c98c976cfc87508cdbf21b98be8b41b71f7d962c7b4b',	'john.doe@gmail.com',	'2023-06-03 13:55:49'),
(43,	'7f6d3bd563840d21227b42a79008b7b5039b24c8c94529bcff2fd1c34681206d849d68ca1e60866c641b6bccfd1aa3568d933a9127664854db94625de79b3136',	'john.doe@gmail.com',	'2023-06-03 14:18:51'),
(44,	'99f16b912a3c579df84cea73beea1441cebbfdd4ad6bc127e43872fdb8fb600b6f3a8f3f55c8dffcebbd68d267288708c7cb40a99a24e83653331fdcaaffd15b',	'john.doe@gmail.com',	'2023-06-03 14:20:45'),
(45,	'f86fc53f7b8b6a8b8e9546c8833474b3979a24d38930e15c8c23691d4e32551dfacf167babba0d37b97ab3712e4941be70f2d590eb65538c0bf4f2cac9c93555',	'john.doe@gmail.com',	'2023-06-03 14:30:26'),
(46,	'2231dd86f04be451ce8ef764822cf5bd759ef5fee8bd44418e894dd413ee88bfd1422c1583a243b7d15c950142859d52d88e462544770fe1b33ef64598005c4f',	'john.doe@gmail.com',	'2023-06-03 14:34:38'),
(47,	'9e7132d7c4d5d36642734def0f76e6d0828b25bc282b472a9f14ad4bda3e0bd0f765d16ec38c7fd076f7e424a6ac025ed52b0d67b3129631f515e12ab1f019c1',	'jean.dupont@gmail.com',	'2023-06-03 14:52:40');

DROP TABLE IF EXISTS `temporary_cart`;
CREATE TABLE `temporary_cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `size` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `updated_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_5CFD95F04584665A` (`product_id`),
  KEY `IDX_5CFD95F0A76ED395` (`user_id`),
  CONSTRAINT `FK_5CFD95F04584665A` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  CONSTRAINT `FK_5CFD95F0A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `temporary_cart` (`id`, `product_id`, `user_id`, `quantity`, `size`, `created_at`, `updated_at`) VALUES
(37,	18,	116,	1,	'M',	'2023-05-04 15:45:12',	NULL);

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postal_code` varchar(16) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `newsletter` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `updated_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=117 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `firstname`, `lastname`, `address`, `postal_code`, `city`, `phone_number`, `newsletter`, `created_at`, `updated_at`) VALUES
(1,	'wlelievre@hernandez.org',	'[\"ROLE_USER\"]',	'admin',	'Benoît',	'Hebert',	'8, place de Noel',	'50105',	'Berger-sur-Becker',	'+33730666751',	0,	'2023-04-25 13:47:30',	NULL),
(2,	'robert44@yahoo.fr',	'[\"ROLE_USER\"]',	'admin',	'André',	'Fischer',	'rue Sophie Maury',	'58 025',	'Da Costanec',	'+33078146850',	1,	'2023-04-25 13:47:30',	NULL),
(3,	'bouvier.xavier@moulin.fr',	'[\"ROLE_USER\"]',	'admin',	'Laurent',	'Roussel',	'82, rue Zacharie Alves',	'34 312',	'Rocher-sur-Mer',	'+33180706929',	0,	'2023-04-25 13:47:30',	NULL),
(4,	'eturpin@colin.org',	'[\"ROLE_USER\"]',	'admin',	'Caroline',	'Marion',	'939, impasse Caron',	'26 323',	'Berthelot',	'+33227671635',	1,	'2023-04-25 13:47:30',	NULL),
(5,	'barbier.augustin@fischer.org',	'[\"ROLE_USER\"]',	'admin',	'Franck',	'Giraud',	'893, rue Cordier',	'04 122',	'Pascal-sur-Benard',	'+33911641121',	0,	'2023-04-25 13:47:30',	NULL),
(6,	'aime49@fournier.net',	'[\"ROLE_USER\"]',	'admin',	'Julien',	'Couturier',	'boulevard Patrick Arnaud',	'15 998',	'Turpin-sur-Voisin',	'+33273814421',	1,	'2023-04-25 13:47:30',	NULL),
(7,	'leroux.corinne@laposte.net',	'[\"ROLE_USER\"]',	'admin',	'Mathilde',	'Martineau',	'72, avenue de Fleury',	'81831',	'Loiseau',	'+33527029091',	1,	'2023-04-25 13:47:30',	NULL),
(8,	'imarin@noos.fr',	'[\"ROLE_USER\"]',	'admin',	'Julie',	'Lacroix',	'84, impasse Eugène Morel',	'90748',	'Buisson',	'+33220463536',	0,	'2023-04-25 13:47:30',	NULL),
(9,	'morin.olivie@dbmail.com',	'[\"ROLE_USER\"]',	'admin',	'Anouk',	'Labbe',	'53, rue Gonzalez',	'80 636',	'Leveque',	'+33418918602',	0,	'2023-04-25 13:47:30',	NULL),
(10,	'boutin.gabrielle@durand.fr',	'[\"ROLE_USER\"]',	'admin',	'Rémy',	'Roux',	'15, avenue Jacquet',	'12 973',	'Leblanc',	'+33291094535',	1,	'2023-04-25 13:47:30',	NULL),
(11,	'seguin.marie@orange.fr',	'[\"ROLE_USER\"]',	'admin',	'René',	'Dias',	'6, impasse de Camus',	'60409',	'Pons',	'+33952981595',	1,	'2023-04-25 13:47:30',	NULL),
(12,	'nphilippe@tele2.fr',	'[\"ROLE_USER\"]',	'admin',	'Lucas',	'Launay',	'chemin Luce Tanguy',	'87 302',	'Brunel',	'+33666934416',	1,	'2023-04-25 13:47:30',	NULL),
(13,	'bertin.josephine@hoareau.fr',	'[\"ROLE_USER\"]',	'admin',	'Michèle',	'Ledoux',	'43, place de Benard',	'78190',	'Daniel',	'+33959630781',	1,	'2023-04-25 13:47:30',	NULL),
(14,	'marcelle29@chartier.com',	'[\"ROLE_USER\"]',	'admin',	'Gilles',	'Pereira',	'33, rue de Munoz',	'48235',	'Carpentier-les-Bains',	'+33223251413',	0,	'2023-04-25 13:47:30',	NULL),
(15,	'dossantos.noel@free.fr',	'[\"ROLE_USER\"]',	'admin',	'Margot',	'Ollivier',	'26, rue de Coste',	'03 483',	'Vaillant',	'+33533948769',	0,	'2023-04-25 13:47:30',	NULL),
(16,	'leroux.monique@arnaud.com',	'[\"ROLE_USER\"]',	'admin',	'Gilbert',	'Roger',	'97, rue de Guillaume',	'28090',	'Georges-la-Forêt',	'+33094888825',	1,	'2023-04-25 13:47:30',	NULL),
(17,	'marie41@club-internet.fr',	'[\"ROLE_USER\"]',	'admin',	'Luce',	'Salmon',	'76, chemin Deschamps',	'38031',	'Guillon-sur-Launay',	'+33908446978',	1,	'2023-04-25 13:47:30',	NULL),
(18,	'munoz.jacques@andre.com',	'[\"ROLE_USER\"]',	'admin',	'Brigitte',	'Mallet',	'73, rue Gilbert Camus',	'11913',	'Lesage',	'+33323618947',	0,	'2023-04-25 13:47:30',	NULL),
(19,	'martel.sabine@sfr.fr',	'[\"ROLE_USER\"]',	'admin',	'Tristan',	'Carpentier',	'61, rue Clement',	'19 776',	'Maurynec',	'+33238489707',	1,	'2023-04-25 13:47:30',	NULL),
(20,	'letellier.georges@orange.fr',	'[\"ROLE_USER\"]',	'admin',	'Manon',	'Mary',	'30, rue Anastasie Rousseau',	'27397',	'Mallet-sur-Lemoine',	'+33675723727',	1,	'2023-04-25 13:47:30',	NULL),
(21,	'fernandes.michel@live.com',	'[\"ROLE_USER\"]',	'admin',	'Eugène',	'Rocher',	'71, chemin de Normand',	'38666',	'Guillou',	'+33131380927',	1,	'2023-04-25 13:47:30',	NULL),
(22,	'buisson.therese@boucher.com',	'[\"ROLE_USER\"]',	'admin',	'Christiane',	'Tanguy',	'9, avenue Schneider',	'30650',	'Dias',	'+33904257323',	0,	'2023-04-25 13:47:30',	NULL),
(23,	'lefevre.andree@orange.fr',	'[\"ROLE_USER\"]',	'admin',	'Stéphane',	'Breton',	'6, rue de Guyot',	'79 034',	'Collet-sur-Pineau',	'+33217783552',	1,	'2023-04-25 13:47:30',	NULL),
(24,	'luc06@dupuis.fr',	'[\"ROLE_USER\"]',	'admin',	'Richard',	'Gregoire',	'31, boulevard Margaud Bousquet',	'01 230',	'Leduc',	'+33346038091',	0,	'2023-04-25 13:47:30',	NULL),
(25,	'edouard19@valentin.fr',	'[\"ROLE_USER\"]',	'admin',	'Gérard',	'Jacquot',	'73, chemin Lucie De Sousa',	'93295',	'Blot',	'+33632836834',	0,	'2023-04-25 13:47:30',	NULL),
(26,	'smasson@club-internet.fr',	'[\"ROLE_USER\"]',	'admin',	'Théodore',	'Petitjean',	'92, impasse de Remy',	'21 813',	'Louis',	'+33711232315',	1,	'2023-04-25 13:47:30',	NULL),
(27,	'louise.fontaine@hotmail.fr',	'[\"ROLE_USER\"]',	'admin',	'Anne',	'Raynaud',	'841, rue Sabine Lopez',	'02825',	'Diasboeuf',	'+33771635706',	1,	'2023-04-25 13:47:30',	NULL),
(28,	'zvallee@dbmail.com',	'[\"ROLE_USER\"]',	'admin',	'Philippe',	'Hamon',	'41, rue Édouard Duval',	'82 108',	'Alves-sur-Mer',	'+33830799964',	1,	'2023-04-25 13:47:30',	NULL),
(29,	'hmarin@wanadoo.fr',	'[\"ROLE_USER\"]',	'admin',	'Adrienne',	'Marie',	'359, impasse Mendes',	'00893',	'FerreiraVille',	'+33663356486',	1,	'2023-04-25 13:47:30',	NULL),
(30,	'ybonnet@sfr.fr',	'[\"ROLE_USER\"]',	'admin',	'Marie',	'Voisin',	'57, rue Gillet',	'48058',	'Martineau',	'+33055626055',	1,	'2023-04-25 13:47:30',	NULL),
(31,	'laure.leconte@lopes.com',	'[\"ROLE_USER\"]',	'admin',	'Philippe',	'Herve',	'rue de Le Goff',	'51738',	'Philippe-sur-Morin',	'+33790316815',	0,	'2023-04-25 13:47:30',	NULL),
(32,	'fcaron@live.com',	'[\"ROLE_USER\"]',	'admin',	'Andrée',	'Vincent',	'45, impasse de Masse',	'59282',	'Lopez',	'+33214470583',	0,	'2023-04-25 13:47:30',	NULL),
(33,	'aimee.munoz@tele2.fr',	'[\"ROLE_USER\"]',	'admin',	'Antoine',	'Pottier',	'22, impasse Guichard',	'58250',	'Bodin',	'+33101383951',	0,	'2023-04-25 13:47:30',	NULL),
(34,	'charles73@barthelemy.fr',	'[\"ROLE_USER\"]',	'admin',	'Camille',	'Weber',	'impasse de Lopes',	'47 256',	'Coulon-sur-Leroy',	'+33644914713',	1,	'2023-04-25 13:47:30',	NULL),
(35,	'celine41@monnier.fr',	'[\"ROLE_USER\"]',	'admin',	'Jules',	'Wagner',	'99, place de Schneider',	'71 391',	'Blin',	'+33233596146',	1,	'2023-04-25 13:47:30',	NULL),
(36,	'chauvin.colette@martineau.com',	'[\"ROLE_USER\"]',	'admin',	'Maggie',	'Gomez',	'48, rue Moreno',	'45 991',	'Pereiradan',	'+33436579067',	0,	'2023-04-25 13:47:30',	NULL),
(37,	'hlaunay@hotmail.fr',	'[\"ROLE_USER\"]',	'admin',	'Catherine',	'Gautier',	'avenue Sébastien Faure',	'41913',	'Marchal',	'+33657973407',	1,	'2023-04-25 13:47:30',	NULL),
(38,	'marcel.rodriguez@rousseau.fr',	'[\"ROLE_USER\"]',	'admin',	'Michelle',	'Ramos',	'20, place Morel',	'75298',	'Bailly',	'+33927554024',	1,	'2023-04-25 13:47:30',	NULL),
(39,	'emilie.hoareau@michaud.org',	'[\"ROLE_USER\"]',	'admin',	'Margaud',	'Pruvost',	'8, impasse Weber',	'91 130',	'Macedan',	'+33183668384',	1,	'2023-04-25 13:47:30',	NULL),
(40,	'fabre.josette@jacquet.com',	'[\"ROLE_USER\"]',	'admin',	'Victor',	'Poulain',	'58, rue Paul Evrard',	'92273',	'Louis-sur-Rey',	'+33189492130',	1,	'2023-04-25 13:47:30',	NULL),
(41,	'ugauthier@laposte.net',	'[\"ROLE_USER\"]',	'admin',	'Joséphine',	'Maury',	'36, avenue de Alexandre',	'92 550',	'Dupre',	'+33151930384',	1,	'2023-04-25 13:47:30',	NULL),
(42,	'michel.chauveau@alexandre.fr',	'[\"ROLE_USER\"]',	'admin',	'Claudine',	'Raymond',	'69, rue Albert',	'02442',	'Jean',	'+33955278988',	1,	'2023-04-25 13:47:30',	NULL),
(43,	'blanchet.marie@dossantos.fr',	'[\"ROLE_USER\"]',	'admin',	'Dorothée',	'Boulanger',	'46, place Bodin',	'18301',	'LeblancVille',	'+33388178297',	1,	'2023-04-25 13:47:30',	NULL),
(44,	'vasseur.michel@hubert.net',	'[\"ROLE_USER\"]',	'admin',	'Victoire',	'Guerin',	'rue Hugues Klein',	'44563',	'Prevost',	'+33993544554',	1,	'2023-04-25 13:47:30',	NULL),
(45,	'marcel20@tele2.fr',	'[\"ROLE_USER\"]',	'admin',	'Colette',	'Fabre',	'12, boulevard de Laine',	'26723',	'Payetboeuf',	'+33156196154',	1,	'2023-04-25 13:47:30',	NULL),
(46,	'monique23@free.fr',	'[\"ROLE_USER\"]',	'admin',	'Christophe',	'Brunet',	'impasse de Gosselin',	'86 744',	'Guillet',	'+33853021654',	1,	'2023-04-25 13:47:30',	NULL),
(47,	'sraymond@durand.com',	'[\"ROLE_USER\"]',	'admin',	'Antoinette',	'Hebert',	'163, boulevard Maggie Valette',	'37225',	'Fischer',	'+33698745385',	0,	'2023-04-25 13:47:30',	NULL),
(48,	'roger.victor@dbmail.com',	'[\"ROLE_USER\"]',	'admin',	'Jules',	'Camus',	'41, impasse Émilie Lebrun',	'60479',	'Dubois',	'+33205536483',	1,	'2023-04-25 13:47:30',	NULL),
(49,	'alexandria.desousa@hotmail.fr',	'[\"ROLE_USER\"]',	'admin',	'David',	'Blanchard',	'39, rue de Meunier',	'94355',	'Weber-la-Forêt',	'+33496790648',	1,	'2023-04-25 13:47:30',	NULL),
(50,	'olivier16@hoareau.fr',	'[\"ROLE_USER\"]',	'admin',	'Nathalie',	'Giraud',	'place de Collet',	'84 494',	'Augerboeuf',	'+33825896273',	0,	'2023-04-25 13:47:30',	NULL),
(51,	'madeleine.laine@remy.com',	'[\"ROLE_USER\"]',	'admin',	'Timothée',	'Meunier',	'46, rue Sophie Hebert',	'18 861',	'Fernandes',	'+33521604594',	1,	'2023-04-25 13:47:30',	NULL),
(52,	'wberthelot@gautier.fr',	'[\"ROLE_USER\"]',	'admin',	'Yves',	'Delmas',	'43, rue Nicolas Martin',	'74 886',	'Bourdon',	'+33198579982',	1,	'2023-04-25 13:47:30',	NULL),
(53,	'joseph.lebrun@wanadoo.fr',	'[\"ROLE_USER\"]',	'admin',	'Isabelle',	'Renault',	'67, chemin Maryse Wagner',	'33799',	'Laporte-la-Forêt',	'+33043840452',	1,	'2023-04-25 13:47:30',	NULL),
(54,	'aubert.monique@lebon.fr',	'[\"ROLE_USER\"]',	'admin',	'Isabelle',	'Renault',	'75, rue Pelletier',	'34 336',	'Gautier',	'+33338214981',	0,	'2023-04-25 13:47:30',	NULL),
(55,	'claudine.hernandez@noos.fr',	'[\"ROLE_USER\"]',	'admin',	'Adélaïde',	'Thierry',	'rue de Renaud',	'93091',	'Lefortnec',	'+33716290927',	1,	'2023-04-25 13:47:30',	NULL),
(56,	'grondin.caroline@fouquet.fr',	'[\"ROLE_USER\"]',	'admin',	'Guy',	'Mercier',	'32, avenue de Mercier',	'04 414',	'Coulon',	'+33800933899',	0,	'2023-04-25 13:47:30',	NULL),
(57,	'laurence15@pierre.fr',	'[\"ROLE_USER\"]',	'admin',	'Pierre',	'Dupre',	'19, place Langlois',	'44917',	'Bourgeois-sur-Fontaine',	'+33588286753',	1,	'2023-04-25 13:47:30',	NULL),
(58,	'frederic75@simon.net',	'[\"ROLE_USER\"]',	'admin',	'Nicolas',	'Evrard',	'19, rue Blot',	'03 910',	'Goncalves-sur-Launay',	'+33240650352',	0,	'2023-04-25 13:47:30',	NULL),
(59,	'texier.hortense@rolland.com',	'[\"ROLE_USER\"]',	'admin',	'Patricia',	'Ferrand',	'50, impasse Pelletier',	'12 064',	'Lemonnier-sur-Delaunay',	'+33634510207',	0,	'2023-04-25 13:47:30',	NULL),
(60,	'astrid.alves@thierry.fr',	'[\"ROLE_USER\"]',	'admin',	'Éric',	'Munoz',	'13, boulevard Simon',	'27308',	'Blot',	'+33760323691',	0,	'2023-04-25 13:47:30',	NULL),
(61,	'denis78@mendes.fr',	'[\"ROLE_USER\"]',	'admin',	'Diane',	'Thibault',	'28, rue Morin',	'52031',	'LacombeBourg',	'+33790008751',	1,	'2023-04-25 13:47:30',	NULL),
(62,	'gbouvet@valentin.fr',	'[\"ROLE_USER\"]',	'admin',	'Rémy',	'Charrier',	'250, rue Michaud',	'67372',	'Nguyennec',	'+33868675845',	0,	'2023-04-25 13:47:30',	NULL),
(63,	'capucine.legendre@orange.fr',	'[\"ROLE_USER\"]',	'admin',	'Laurent',	'Rolland',	'59, rue Patricia Leduc',	'42 569',	'Renault',	'+33527100675',	1,	'2023-04-25 13:47:30',	NULL),
(64,	'alphonse11@dupuy.com',	'[\"ROLE_USER\"]',	'admin',	'Céline',	'Bouvier',	'812, rue Fabre',	'08198',	'Baron-la-Forêt',	'+33284238157',	1,	'2023-04-25 13:47:30',	NULL),
(65,	'laurent.martine@auger.fr',	'[\"ROLE_USER\"]',	'admin',	'Zacharie',	'Techer',	'896, avenue de Pottier',	'76854',	'Vincent-sur-Boulanger',	'+33745448772',	0,	'2023-04-25 13:47:30',	NULL),
(66,	'lacombe.patrick@noos.fr',	'[\"ROLE_USER\"]',	'admin',	'Victoire',	'Jacquet',	'45, chemin de Seguin',	'67078',	'Diallo',	'+33393212035',	0,	'2023-04-25 13:47:30',	NULL),
(67,	'alex.guillet@sfr.fr',	'[\"ROLE_USER\"]',	'admin',	'Sébastien',	'Philippe',	'place Texier',	'02 911',	'Albert',	'+33663227015',	1,	'2023-04-25 13:47:30',	NULL),
(68,	'julien.leveque@yahoo.fr',	'[\"ROLE_USER\"]',	'admin',	'Mathilde',	'Gerard',	'74, avenue Lagarde',	'00741',	'Lemairenec',	'+33704698841',	0,	'2023-04-25 13:47:30',	NULL),
(69,	'tristan53@club-internet.fr',	'[\"ROLE_USER\"]',	'admin',	'Denis',	'Fischer',	'14, avenue de Lemoine',	'53026',	'Marechal',	'+33113679610',	0,	'2023-04-25 13:47:30',	NULL),
(70,	'letellier.dorothee@sfr.fr',	'[\"ROLE_USER\"]',	'admin',	'Marc',	'Da Silva',	'77, avenue de Boulay',	'02 280',	'TraoreBourg',	'+33130402615',	1,	'2023-04-25 13:47:30',	NULL),
(71,	'ojean@charrier.com',	'[\"ROLE_USER\"]',	'admin',	'Alice',	'Gaillard',	'669, boulevard Wagner',	'04744',	'Olivier',	'+33465846144',	1,	'2023-04-25 13:47:30',	NULL),
(72,	'baudry.stephanie@laposte.net',	'[\"ROLE_USER\"]',	'admin',	'Valentine',	'Chauvet',	'54, avenue Marine Berger',	'67099',	'Brunet-les-Bains',	'+33121746113',	1,	'2023-04-25 13:47:30',	NULL),
(73,	'juliette62@duval.net',	'[\"ROLE_USER\"]',	'admin',	'Arthur',	'Da Costa',	'7, boulevard Denis Guyot',	'43 290',	'Le Goff-la-Forêt',	'+33835948598',	1,	'2023-04-25 13:47:30',	NULL),
(74,	'thibaut.brunel@teixeira.com',	'[\"ROLE_USER\"]',	'admin',	'Victoire',	'Normand',	'3, chemin de Langlois',	'08475',	'Clementboeuf',	'+33362258649',	0,	'2023-04-25 13:47:30',	NULL),
(75,	'maurice.launay@sfr.fr',	'[\"ROLE_USER\"]',	'admin',	'Valentine',	'Girard',	'chemin de Arnaud',	'44 785',	'Herve',	'+33717965223',	0,	'2023-04-25 13:47:30',	NULL),
(76,	'remy.thibault@guillot.fr',	'[\"ROLE_USER\"]',	'admin',	'René',	'Lucas',	'rue Dominique Maillot',	'58 134',	'Lebon',	'+33721839742',	1,	'2023-04-25 13:47:30',	NULL),
(77,	'tleger@club-internet.fr',	'[\"ROLE_USER\"]',	'admin',	'Virginie',	'Raymond',	'chemin de Guibert',	'79 227',	'Delaunay-la-Forêt',	'+33004747607',	1,	'2023-04-25 13:47:30',	NULL),
(78,	'jlelievre@bernard.com',	'[\"ROLE_USER\"]',	'admin',	'Noémi',	'Moreau',	'73, impasse de Besnard',	'55393',	'Louis',	'+33020744041',	0,	'2023-04-25 13:47:30',	NULL),
(79,	'mbaron@bernier.net',	'[\"ROLE_USER\"]',	'admin',	'Antoinette',	'Carpentier',	'758, rue Charles Dumas',	'90673',	'Allard',	'+33576487113',	0,	'2023-04-25 13:47:30',	NULL),
(80,	'lrey@dbmail.com',	'[\"ROLE_USER\"]',	'admin',	'Léon',	'Dupuy',	'71, rue Pelletier',	'82 179',	'Millet',	'+33646980287',	1,	'2023-04-25 13:47:30',	NULL),
(81,	'lmartineau@laposte.net',	'[\"ROLE_USER\"]',	'admin',	'Michèle',	'Guillaume',	'797, chemin Reynaud',	'79 285',	'PiresVille',	'+33984746170',	0,	'2023-04-25 13:47:30',	NULL),
(82,	'caroline.aubry@hotmail.fr',	'[\"ROLE_USER\"]',	'admin',	'Tristan',	'Leroy',	'76, rue de Grondin',	'60993',	'Briand',	'+33585963020',	1,	'2023-04-25 13:47:30',	NULL),
(83,	'lebreton.gabriel@laposte.net',	'[\"ROLE_USER\"]',	'admin',	'Marguerite',	'Fleury',	'875, boulevard Lucy Chauveau',	'38 334',	'Guillouboeuf',	'+33390648030',	0,	'2023-04-25 13:47:30',	NULL),
(84,	'bigot.pauline@lebreton.fr',	'[\"ROLE_USER\"]',	'admin',	'Théophile',	'Laroche',	'29, avenue de Blanchet',	'02814',	'Bigotboeuf',	'+33417296653',	1,	'2023-04-25 13:47:30',	NULL),
(85,	'emilie.bouchet@schmitt.fr',	'[\"ROLE_USER\"]',	'admin',	'Aurore',	'Clement',	'30, chemin Pascal',	'40 707',	'Mahe-sur-Ferrand',	'+33845836176',	0,	'2023-04-25 13:47:30',	NULL),
(86,	'sebastien69@chauveau.com',	'[\"ROLE_USER\"]',	'admin',	'Paul',	'Gilbert',	'boulevard Zacharie Leconte',	'14508',	'Valette',	'+33692181296',	0,	'2023-04-25 13:47:30',	NULL),
(87,	'carre.elisabeth@duval.fr',	'[\"ROLE_USER\"]',	'admin',	'Édouard',	'Pierre',	'41, boulevard Gomez',	'52875',	'Becker',	'+33277265082',	1,	'2023-04-25 13:47:30',	NULL),
(88,	'gabriel07@michel.com',	'[\"ROLE_USER\"]',	'admin',	'Olivie',	'Maurice',	'15, chemin Laure Neveu',	'64161',	'Alves',	'+33357470158',	0,	'2023-04-25 13:47:30',	NULL),
(89,	'vmartel@nguyen.net',	'[\"ROLE_USER\"]',	'admin',	'Maryse',	'Rossi',	'74, rue Alexandria Grondin',	'56 679',	'Maillot',	'+33220159747',	0,	'2023-04-25 13:47:30',	NULL),
(90,	'danielle.lebreton@remy.com',	'[\"ROLE_USER\"]',	'admin',	'Roland',	'Roy',	'578, rue Luc Chretien',	'68443',	'Garnierdan',	'+33318983061',	0,	'2023-04-25 13:47:30',	NULL),
(91,	'alix.morel@tele2.fr',	'[\"ROLE_USER\"]',	'admin',	'Bernadette',	'Marin',	'73, boulevard Lorraine Bernard',	'22 281',	'Marion',	'+33985484241',	0,	'2023-04-25 13:47:30',	NULL),
(92,	'emmanuel.alves@moulin.net',	'[\"ROLE_USER\"]',	'admin',	'Marianne',	'Turpin',	'649, boulevard Suzanne Tessier',	'92091',	'Lecomte',	'+33949387712',	0,	'2023-04-25 13:47:30',	NULL),
(93,	'qsanchez@brunet.fr',	'[\"ROLE_USER\"]',	'admin',	'Audrey',	'Blanc',	'63, rue Audrey Charpentier',	'74 273',	'Pelletierboeuf',	'+33010343359',	1,	'2023-04-25 13:47:30',	NULL),
(94,	'dufour.zoe@dbmail.com',	'[\"ROLE_USER\"]',	'admin',	'Luc',	'Joseph',	'278, avenue Odette Normand',	'69 670',	'Buissondan',	'+33058607026',	0,	'2023-04-25 13:47:30',	NULL),
(95,	'gregoire20@tanguy.com',	'[\"ROLE_USER\"]',	'admin',	'Agnès',	'Gonzalez',	'634, rue Laure Guillou',	'27772',	'Morvan-sur-Muller',	'+33401003414',	0,	'2023-04-25 13:47:30',	NULL),
(96,	'emile61@lemoine.com',	'[\"ROLE_USER\"]',	'admin',	'Adélaïde',	'Costa',	'44, boulevard Alfred Gaillard',	'95 109',	'Moreno-sur-Mer',	'+33725293045',	0,	'2023-04-25 13:47:30',	NULL),
(97,	'rpages@hotmail.fr',	'[\"ROLE_USER\"]',	'admin',	'Aimé',	'Labbe',	'27, place de Gomez',	'08 085',	'Gillet',	'+33672652424',	0,	'2023-04-25 13:47:30',	NULL),
(98,	'mchartier@robert.fr',	'[\"ROLE_USER\"]',	'admin',	'Nicole',	'Potier',	'place de Chauveau',	'91 589',	'Pasquier-les-Bains',	'+33404494885',	0,	'2023-04-25 13:47:30',	NULL),
(99,	'eleonore.bouchet@dbmail.com',	'[\"ROLE_USER\"]',	'admin',	'Célina',	'Etienne',	'6, boulevard Édith Tanguy',	'04893',	'Weissdan',	'+33484997305',	1,	'2023-04-25 13:47:30',	NULL),
(100,	'maggie74@delorme.net',	'[\"ROLE_USER\"]',	'admin',	'Richard',	'Voisin',	'4, rue Bouvet',	'41164',	'Lopezdan',	'+33689114309',	1,	'2023-04-25 13:47:30',	NULL),
(101,	'admin@sapes.com',	'[\"ROLE_ADMIN\"]',	'$2y$13$.PJiDK3kq2C4owW5RW6Z3ukzRc14TJZRPcMfXcCy9AyhhA9OMK3Li',	'Charles',	'Lucas',	NULL,	NULL,	NULL,	NULL,	0,	'2023-04-25 13:47:30',	NULL),
(102,	'manager@sapes.com',	'[\"ROLE_MANAGER\"]',	'$2y$10$DzEIx1tLEuDBH28lUg2UNOMeB4yHe2nlkt1D.I7raPKU/vfBkSHo6',	'Charles',	'Briand',	NULL,	NULL,	NULL,	NULL,	0,	'2023-04-25 13:47:30',	NULL),
(103,	'mathieu@gmail.com',	'[\"ROLE_USER\"]',	'$2y$13$8uwhg6.787HcexB7mB8LEOM5y1Qr.KzKJs60/xVbXOaA8uIkNVGr.',	'Math',	'ros',	NULL,	NULL,	NULL,	NULL,	0,	'2023-04-26 21:48:05',	NULL),
(104,	'test@test.com',	'[\"ROLE_USER\"]',	'$2y$13$qNA1b2V3tegLoHQ/W3MyROorDcFoP/RyssrYcDMl.SjUbEojvEmNy',	'test',	'test',	NULL,	NULL,	NULL,	NULL,	0,	'2023-04-27 09:41:47',	NULL),
(105,	'hiro@hotmail.com',	'[\"ROLE_USER\"]',	'$2y$13$0FHpuiRsXVtz4Nlm5xI10.UR2vQXUGJhJpo9nG705Wtbo9y6WJpjm',	'hiro',	'hiroko',	NULL,	NULL,	NULL,	NULL,	0,	'2023-04-27 09:42:57',	NULL),
(106,	'math@gmail.com',	'[\"ROLE_USER\"]',	'$2y$13$WB2NUpBblwj78.CskHlI.uz3DqnbIWw7Nh0vrH7Zv52kQNeY7gcz2',	'test',	'test',	NULL,	NULL,	NULL,	NULL,	0,	'2023-04-27 11:19:40',	NULL),
(108,	'hiro@test.com',	'[\"ROLE_USER\"]',	'$2y$13$hgtumM7782Ncxa4yZbRMjunfOikeNDYc8Q3IKorM9xtsjIzsAERmC',	'hirotest',	'hirotest',	NULL,	NULL,	NULL,	NULL,	0,	'2023-04-27 11:39:55',	NULL),
(109,	'hiro2@test.com',	'[\"ROLE_USER\"]',	'$2y$13$2NvCz/Mxh1yJHeXAV59gDuCdeUUS0AFSf3oWl3CCD.mLug/qGr5Oi',	'hiro2',	'hiro2',	NULL,	NULL,	NULL,	NULL,	0,	'2023-04-27 11:52:11',	NULL),
(111,	'math@mate2.com',	'[\"ROLE_USER\"]',	'$2y$13$NKbk1xUneoQjj8NelWjlNuzt.DkKpBqR4Xjp7i7bLqzGqlQ5jxdKy',	'test',	'test',	'tata!',	NULL,	NULL,	NULL,	1,	'2023-04-27 12:18:40',	NULL),
(115,	'john.doe@gmail.com',	'[\"ROLE_USER\"]',	'$2y$13$/yN3vgz42mWLAbL3Rhwlz.XQ.Za78X.btg9U1b8XwkSGzA5wDhUni',	'John',	'Doe',	'32 W 83rd St Apt 10',	'NY 10024',	'New york',	NULL,	0,	'2023-05-03 14:46:37',	NULL),
(116,	'jean.dupont@gmail.com',	'[\"ROLE_USER\"]',	'$2y$13$PowTzThd5JlYUlrk0jx9DeP4PSoI4IHANzwHsePa695CsIosbYIXO',	'Jean',	'Dupont',	NULL,	'13421',	NULL,	NULL,	0,	'2023-05-04 14:52:20',	NULL);
