SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;


CREATE TABLE IF NOT EXISTS `food` (
`id` int(11) NOT NULL,
  `name` text NOT NULL,
  `type` int(11) NOT NULL,
  `calories` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `rate_cnt` int(11) NOT NULL,
  `rate_sum` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=123 DEFAULT CHARSET=utf8;

INSERT INTO `food` (`id`, `name`, `type`, `calories`, `price`, `rate_cnt`, `rate_sum`) VALUES
(1, 'Ciorbă ardelenească', 0, 465, 5, 10, 50),
(2, 'Ciorbă de cartofi cu ciuperci', 0, 280, 6, 14, 54),
(3, 'Ciorbă de tarhon', 0, 406, 5, 2, 8),
(4, 'Ciorbă fasole boabe cu afumatură', 0, 391, 6, 4, 20),
(5, 'Ciorbă fasole verde', 0, 236, 7, 3, 9),
(6, 'Ciorbă porc a la grec', 0, 408, 5, 2, 8),
(7, 'Ciorbă țărănească de porc', 0, 233, 8, 12, 40),
(8, 'Ciorbă țărănească de pui', 0, 339, 5, 5, 15),
(9, 'Ciorbă țărănească de vită', 0, 497, 6, 2, 8),
(10, 'Ciorbă varză cu carne porc', 0, 368, 5, 6, 18),
(11, 'Cremă de cartofi', 0, 450, 6, 4, 20),
(12, 'Cremă de ciuperci', 0, 344, 7, 3, 9),
(13, 'Cremă de legume', 0, 470, 7, 9, 36),
(14, 'Cremă de spanac', 0, 220, 6, 7, 28),
(15, 'Cremă de telina', 0, 391, 6, 6, 30),
(16, 'Supă conopida', 0, 494, 6, 9, 45),
(17, 'Supă cu fidea', 0, 497, 6, 8, 24),
(18, 'Supă cu ouă', 0, 202, 5, 1, 4),
(19, 'Supă cu usturoi', 0, 221, 8, 1, 5),
(20, 'Supă de cartofi cu afumatură', 0, 298, 7, 9, 36),
(21, 'Supă de chimion cu crutoane', 0, 325, 5, 7, 21),
(22, 'Supă de ciuperci cu galuște de casă', 0, 234, 6, 5, 15),
(23, 'Supă de ciuperci cu galuște de casă ', 0, 295, 5, 2, 8),
(24, 'Supă de fasole italiană', 0, 271, 6, 3, 9),
(25, 'Supă de fasole verde', 0, 269, 7, 10, 40),
(26, 'Supă de legume', 0, 332, 6, 2, 10),
(27, 'Supă de legume cu galuște din griș', 0, 356, 6, 6, 18),
(28, 'Supă de legume proaspete', 0, 282, 8, 4, 16),
(29, 'Supă de roșii cu fidea', 0, 441, 6, 4, 16),
(30, 'Supă de roșii cu orez', 0, 259, 6, 4, 16),
(31, 'Supă de zarzavat', 0, 374, 7, 7, 21),
(32, 'Supă dulce cu fidea', 0, 291, 8, 7, 21),
(33, 'Supă gradinarului', 0, 434, 8, 10, 40),
(34, 'Supă gulaș', 0, 496, 7, 10, 30),
(35, 'Cartofi grătinați cu brânză burduf', 1, 730, 7, 9, 27),
(36, 'Cașcaval pane, cartofi natur, orez, morcovi', 1, 726, 7, 3, 15),
(37, 'Ceafă porc la cuptor, cartofi piure, orez, mazare', 1, 642, 6, 3, 9),
(38, 'Ceafă porc la grătar, cartofi la cuptor, orez, porumb', 1, 529, 6, 5, 25),
(39, 'Ceafă porc natur, cartofi țărănești, orez, porumb, castraveți proaspeți ', 1, 521, 7, 6, 24),
(40, 'Ciuperci pane, cartofi la cuptor, orez, porumb', 1, 519, 6, 5, 25),
(41, 'Cordon Bleu din piept de pui, cartofi aurii, orez', 1, 530, 7, 5, 15),
(42, 'Cotlet ardelenesc cu galuște de casă', 1, 593, 8, 1, 5),
(43, 'Cotlet Ovary, cartofi la cuptor', 1, 575, 7, 7, 28),
(44, 'Cotlet porc pane, cartofi aurii, orez, mexicană', 1, 597, 7, 6, 18),
(45, 'Dovlecei pane, cartofi țărănești, orez, porumb', 1, 760, 6, 7, 35),
(46, 'Fasole bătută cu cârnaț', 1, 607, 7, 7, 21),
(47, 'Fasole bătută cu chifteluțe de cartofi', 1, 557, 7, 2, 8),
(48, 'Felii de porc in sos vânătoresc, paste, orez, mazăre', 1, 761, 7, 7, 35),
(49, 'Ficat pui, cartofi piure, orez, mazăre', 1, 738, 6, 3, 12),
(50, 'Friptură porc cu sos de ciuperci, cartofi natur, orez, morcovi', 1, 605, 7, 8, 32),
(51, 'Gulaș secuiesc', 1, 609, 7, 3, 9),
(52, 'Gyros piept pui, cartofi pai, garnitură de legume, sos tzatziki', 1, 732, 7, 10, 40),
(53, 'Iahnie de cartofi cu cârnaț', 1, 734, 8, 3, 15),
(54, 'Iahnie de fasole cu cârnaț, salată varză', 1, 674, 6, 9, 27),
(55, 'Iahnie de fasole cu chifteluțe de cartofi', 1, 665, 7, 1, 4),
(56, 'Kievskaia de pui, cartofi aurii, mexicană', 1, 506, 7, 4, 20),
(57, 'Mămăligă cu brânză', 1, 634, 6, 6, 24),
(58, 'Mâncare de mazăre cu ochiuri', 1, 550, 6, 7, 28),
(59, 'Medalion porc cu sos de piper verde, cartofi piure, orez, varză calita', 1, 651, 6, 10, 30),
(60, 'Musaca de cartofi', 1, 502, 6, 7, 28),
(61, 'Palermo piept pui, cubulețe de cartofi, orez, mexicană', 1, 658, 7, 4, 20),
(62, 'Papricaș de porc cu mămăligă', 1, 682, 6, 6, 24),
(63, 'Papricaș de pui cu mămăligă', 1, 639, 6, 8, 40),
(64, 'Pește pane, cartofi la cuptor, orez, sote de legume', 1, 649, 8, 3, 9),
(65, 'Piept de pui la grătar, cartofi natur, orez', 1, 526, 7, 8, 24),
(66, 'Piept de pui la grătar, cartofi natur, orez, morcovi', 1, 785, 7, 3, 15),
(67, 'Piept de pui la grătar, cubulețe de cartofi, orez, mexicană', 1, 647, 7, 7, 35),
(68, 'Pui picant în sos cu usturoi, cu cartodi auriu', 1, 678, 6, 6, 18),
(69, 'Pulpă pui cu sos din hrean, cartofi la cuptor, orez, sote de legume', 1, 651, 7, 8, 40),
(70, 'Pulpă pui cu sos mexican, cartofi țărănești, orez, porumb', 1, 720, 6, 6, 24),
(71, 'Pulpă pui la cuptor, cartofi natur, orez, mazăre', 1, 548, 6, 1, 5),
(72, 'Pulpă pui natur, cartofi piure, orez, mazăre ', 1, 679, 7, 8, 32),
(73, 'Pulpă pui pane, cartofi natur, orez, morcovi', 1, 652, 7, 5, 20),
(74, 'Pulpă pui pane, cartofi țărănești, orez', 1, 722, 7, 3, 12),
(75, 'Pulpă pui, cartofi piure, orez, varză calita', 1, 556, 7, 9, 45),
(76, 'Ruladă carne tocată cu sos de ciuperci, cartofi țărănești, orez, porumb', 1, 711, 7, 5, 25),
(77, 'Ruladă carne tocată cu sos tomat, cartofi piure', 1, 788, 6, 8, 32),
(78, 'Salată de vinete cu roșii si ardei', 1, 706, 7, 7, 35),
(79, 'Salată grecească cu telemea', 1, 666, 8, 9, 45),
(80, 'Salată orientală cu ouă', 1, 712, 6, 6, 24),
(81, 'Șnitel parizian pui, cartofi țărănești, orez, mazare', 1, 763, 8, 1, 4),
(82, 'Șnitel porc cu susan, cubulețe de cartofi, orez, mexicană', 1, 579, 6, 6, 24),
(83, 'Șnitel porc parizian, cartofi țărănești, orez', 1, 707, 6, 6, 18),
(84, 'Șnitel umplut cu ciuperci, salată orientală', 1, 698, 6, 2, 8),
(85, 'Spanac cu ochiuri', 1, 567, 7, 8, 40),
(86, 'Tăiței cu varza calita', 1, 541, 7, 8, 40),
(87, 'Tocană de porc cu mămăligă', 1, 507, 7, 6, 30),
(88, 'Tocană de pui cu mămăligă', 1, 708, 7, 6, 30),
(89, 'Tocană piperată de vită, cus-cus', 1, 623, 7, 1, 3),
(90, 'Tocană vânătoreasca cu melcișori', 1, 788, 6, 4, 12),
(91, 'Tocăniță de ciuperci cu mămăligă', 1, 673, 7, 7, 28),
(92, 'Tochitură Brașoveană, cubulețe de cartofi, orez, mexicană', 1, 799, 8, 5, 20),
(93, 'Tocăniţă de vităr, orez, paste', 1, 578, 7, 3, 15),
(94, 'Varză a la Cluj', 1, 593, 7, 9, 27),
(95, 'Vinete pane, cubulețe de cartofi, orez, mexicană', 1, 729, 7, 6, 18),
(96, 'Albinuș', 2, 134, 1, 4, 16),
(97, 'Banană', 2, 108, 1, 5, 15),
(98, 'Budincă', 2, 138, 2, 3, 9),
(99, 'Chec cu cacao', 2, 165, 1, 7, 35),
(100, 'Cheesecake', 2, 113, 1, 8, 40),
(101, 'Cireșe', 2, 169, 2, 8, 32),
(102, 'Clătite cu gem', 2, 108, 1, 7, 28),
(103, 'Clementine', 2, 129, 1, 9, 27),
(104, 'Cornulețe cu gem', 2, 125, 2, 6, 18),
(105, 'Cornulețe cu nucă', 2, 136, 2, 9, 36),
(106, 'Cornulețe cu rahat', 2, 106, 2, 12, 48),
(107, 'Cozonac', 2, 122, 1, 7, 28),
(108, 'Gogoși simpli', 2, 191, 2, 9, 36),
(109, 'Grepfruit', 2, 191, 1, 5, 15),
(110, 'Kiwi', 2, 180, 2, 6, 18),
(111, 'Mandarină', 2, 126, 2, 3, 12),
(112, 'Mere', 2, 191, 2, 7, 35),
(113, 'Pandispan cu vișine', 2, 175, 1, 8, 24),
(114, 'Pere', 2, 105, 2, 9, 45),
(115, 'Piersici', 2, 197, 1, 1, 5),
(116, 'Portocale', 2, 173, 1, 6, 24),
(117, 'Prăjitură cu caramel', 2, 173, 2, 8, 40),
(118, 'Prăjitură cu mere', 2, 148, 1, 9, 36),
(119, 'Prăjitură Lajcsi', 2, 118, 1, 4, 12),
(120, 'Rumba cu cocos', 2, 148, 1, 8, 40),
(121, 'Struguri', 2, 184, 2, 2, 8),
(122, 'Vargabéles', 2, 178, 1, 3, 12);

CREATE TABLE IF NOT EXISTS `menu` (
`id` int(11) NOT NULL,
  `date` date NOT NULL,
  `food_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8;

INSERT INTO `menu` (`id`, `date`, `food_id`) VALUES
(7, '2015-06-19', 1),
(8, '2015-06-19', 6),
(9, '2015-06-19', 49),
(10, '2015-06-19', 68),
(11, '2015-06-19', 104),
(12, '2015-06-19', 116),
(13, '2015-06-18', 2),
(14, '2015-06-18', 7),
(15, '2015-06-18', 50),
(16, '2015-06-18', 69),
(17, '2015-06-20', 105),
(18, '2015-06-18', 117),
(19, '2015-06-22', 2),
(20, '2015-06-22', 7),
(21, '2015-06-22', 50),
(22, '2015-06-22', 69),
(23, '2015-06-22', 105),
(24, '2015-06-22', 117),
(25, '2015-06-23', 3),
(26, '2015-06-23', 8),
(27, '2015-06-23', 51),
(28, '2015-06-23', 70),
(29, '2015-06-23', 106),
(30, '2015-06-23', 118),
(31, '2015-06-24', 4),
(32, '2015-06-24', 9),
(33, '2015-06-24', 52),
(34, '2015-06-24', 71),
(35, '2015-06-24', 107),
(36, '2015-06-24', 119),
(37, '2015-06-25', 5),
(38, '2015-06-25', 10),
(39, '2015-06-25', 53),
(40, '2015-06-25', 72),
(41, '2015-06-25', 108),
(42, '2015-06-25', 120),
(43, '2015-06-26', 6),
(44, '2015-06-26', 11),
(45, '2015-06-26', 54),
(46, '2015-06-26', 73),
(47, '2015-06-26', 109),
(48, '2015-06-26', 121),
(49, '2015-06-18', 106),
(50, '2015-06-15', 2),
(51, '2015-06-15', 7),
(52, '2015-06-15', 50),
(53, '2015-06-15', 69),
(54, '2015-06-15', 105),
(55, '2015-06-15', 117),
(56, '2015-06-16', 3),
(57, '2015-06-16', 8),
(58, '2015-06-16', 51),
(59, '2015-06-16', 70),
(60, '2015-06-16', 106),
(61, '2015-06-16', 118),
(62, '2015-06-17', 4),
(63, '2015-06-17', 9),
(64, '2015-06-17', 52),
(65, '2015-06-17', 71),
(66, '2015-06-17', 107),
(67, '2015-06-17', 119);

CREATE TABLE IF NOT EXISTS `order` (
`id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `pass_id` int(11) NOT NULL,
  `gateway` int(11) NOT NULL,
  `txn_id` text NOT NULL,
  `sum` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

INSERT INTO `order` (`id`, `date`, `user_id`, `pass_id`, `gateway`, `txn_id`, `sum`) VALUES
(4, '2015-06-18 20:07:03', 1, 2, 0, 'ch_6S3Oq2ruwHu8MI', 220);

CREATE TABLE IF NOT EXISTS `pass` (
`id` int(11) NOT NULL,
  `name` text NOT NULL,
  `meals` int(11) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO `pass` (`id`, `name`, `meals`, `price`) VALUES
(1, 'Weekly', 5, 60),
(2, 'Monthly', 22, 220);

CREATE TABLE IF NOT EXISTS `reserve` (
`id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=utf8;

INSERT INTO `reserve` (`id`, `date`, `user_id`, `menu_id`) VALUES
(76, '2015-06-18 21:40:19', 1, 50),
(77, '2015-06-18 21:40:19', 1, 52),
(78, '2015-06-18 21:40:19', 1, 54),
(79, '2015-06-18 21:40:19', 1, 57),
(80, '2015-06-18 21:40:19', 1, 59),
(81, '2015-06-18 21:40:19', 1, 61),
(82, '2015-06-18 21:40:19', 1, 62),
(83, '2015-06-18 21:40:19', 1, 65),
(84, '2015-06-18 21:40:19', 1, 66),
(85, '2015-06-18 21:40:19', 1, 14),
(86, '2015-06-18 21:40:19', 1, 15),
(87, '2015-06-18 21:40:19', 1, 18),
(88, '2015-06-18 21:40:19', 1, 8),
(89, '2015-06-18 21:40:19', 1, 10),
(90, '2015-06-18 21:40:19', 1, 12);

CREATE TABLE IF NOT EXISTS `user` (
`id` int(11) NOT NULL,
  `name` text NOT NULL,
  `password` text NOT NULL,
  `email` text NOT NULL,
  `type` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=106 DEFAULT CHARSET=utf8;

INSERT INTO `user` (`id`, `name`, `password`, `email`, `type`) VALUES
(1, 'RoliSoft', 'fObQZGYG6DzXibaLmhnCSuQb0ItkI/.rYThP3r7SPhvvQdtckKY36', 'root@rolisoft.net', 0);


ALTER TABLE `food`
 ADD PRIMARY KEY (`id`);

ALTER TABLE `menu`
 ADD PRIMARY KEY (`id`), ADD KEY `food_id` (`food_id`);

ALTER TABLE `order`
 ADD PRIMARY KEY (`id`), ADD KEY `user_id` (`user_id`), ADD KEY `pass_id` (`pass_id`);

ALTER TABLE `pass`
 ADD PRIMARY KEY (`id`);

ALTER TABLE `reserve`
 ADD PRIMARY KEY (`id`), ADD KEY `user_id` (`user_id`), ADD KEY `menu_id` (`menu_id`);

ALTER TABLE `user`
 ADD PRIMARY KEY (`id`);


ALTER TABLE `food`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=123;
ALTER TABLE `menu`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=68;
ALTER TABLE `order`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
ALTER TABLE `pass`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
ALTER TABLE `reserve`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=91;
ALTER TABLE `user`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=106;

ALTER TABLE `menu`
ADD CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`food_id`) REFERENCES `food` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `order`
ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `order_ibfk_2` FOREIGN KEY (`pass_id`) REFERENCES `pass` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `reserve`
ADD CONSTRAINT `reserve_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `reserve_ibfk_2` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
