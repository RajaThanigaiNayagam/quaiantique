-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 22 mars 2023 à 21:04
-- Version du serveur : 10.4.24-MariaDB
-- Version de PHP : 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `quaiantique`
--

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

CREATE TABLE `category` (
  `Id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `creationdate` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`Id`, `name`, `creationdate`) VALUES
(1, 'Entrées', '2023-03-13 06:42:58'),
(2, 'Burgers', '2023-01-28 06:43:18'),
(3, 'Plats', '2023-03-13 06:44:03'),
(4, 'Desserts', '2023-01-28 06:45:18'),
(7, 'Boisson', '2023-03-20 07:31:40');

-- --------------------------------------------------------

--
-- Structure de la table `foods`
--

CREATE TABLE `foods` (
  `Id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `creationdate` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `image` varchar(200) NOT NULL,
  `signature` tinyint(1) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `foods`
--

INSERT INTO `foods` (`Id`, `name`, `price`, `creationdate`, `image`, `signature`, `category_id`) VALUES
(4, 'Steak tender', '18.85', '2023-03-21 14:51:17', 'img/4.jpg', 1, 3),
(6, 'plat Double rosti burger', '9.99', '2023-03-20 16:02:20', 'img/plat Double rosti burger.jpg', 1, 2),
(8, 'Veggieburger plat', '7.99', '2023-03-20 16:02:30', 'img/plat Veggieburger plat9.99.jpg', 1, 2),
(9, 'Grande assiette de legumes', '6.99', '2023-03-20 15:22:57', 'img/plat Grande assiette de legumes 6.99.jpg', 1, 3),
(10, 'Coca', '2.00', '2023-03-20 08:15:47', 'img/Boisson coca 2.00.jpg', NULL, 7),
(11, 'fanta', '2.00', '2023-03-20 08:16:58', 'img/Boisson fanta 2.00.jpg', NULL, 7),
(13, 'Pepsi', '2.00', '2023-03-20 08:18:51', 'img\\Boisson pepsi 2.00.jpg', NULL, 7),
(14, 'Piece du boucher marinee', '11.99', '2023-03-20 15:23:34', 'img/plat Piece du boucher marinee 11.99.jpg', 1, 3),
(15, 'Quart poulet roti', '8.99', '2023-03-20 15:23:20', 'img/plat Quart poulet roti 8.99.jpg', 1, 3),
(16, 'Steak-haché façon bouchère viande bovine française', '7.99', '2023-03-20 08:36:38', 'img\\plat Steak-haché façon bouchère viande bovine française 7.99.jpg', 0, 3),
(17, 'Assiette de crostinis', '3.65', '2023-03-21 21:46:26', 'img/6.jpg', 1, 1),
(18, 'Frite', '2.90', '2023-03-20 14:18:32', 'img/Entrer frites 2.99.jpg', 1, 1),
(19, 'Filet de poisson pané sauce tartare', '7.95', '2023-03-20 14:17:43', 'img/plat Filet de poisson pané sauce tartare entrer 7.95.jpg', 1, 3),
(20, 'Pancakes fourrés au caramel', '4.50', '2023-03-20 16:35:18', 'img/dessert5 Pancakes fourrés au caramel.jpeg', 1, 4),
(21, 'pancakes au miel', '4.50', '2023-03-20 15:00:26', 'img/dessert6 pancakes au miel.jpeg', 1, 4),
(22, 'Poireaux vinaigrette', '8.90', '2023-03-22 15:54:35', 'img/plat Poireaux vinaigrette.jpg', 1, 3);

-- --------------------------------------------------------

--
-- Structure de la table `menu`
--

CREATE TABLE `menu` (
  `Id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `creationdate` timestamp NULL DEFAULT NULL,
  `image` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Menu de Restaurant';

--
-- Déchargement des données de la table `menu`
--

INSERT INTO `menu` (`Id`, `name`, `price`, `creationdate`, `image`) VALUES
(8, 'Burger', '13.90', NULL, 'img/plat Double rosti burger.jpg..'),
(9, 'Menu Beauf', '18.90', NULL, 'img\\10.jpg'),
(10, 'Menu fruit de mer', '18.90', NULL, 'img\\7.jpg'),
(11, 'Menu Végétarien', '12.90', NULL, 'plat Poireaux vinaigrette.jpg'),
(12, 'tessgft', '25.00', NULL, 'img/plat Double rosti burger.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `menu_foods`
--

CREATE TABLE `menu_foods` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `food_id` int(11) DEFAULT NULL,
  `creationdate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `menu_foods`
--

INSERT INTO `menu_foods` (`id`, `menu_id`, `food_id`, `creationdate`) VALUES
(47, 9, 4, '2023-03-21 14:02:25'),
(48, 9, 10, '2023-03-21 14:02:25'),
(49, 9, 11, '2023-03-21 14:02:25'),
(50, 9, 13, '2023-03-21 14:02:25'),
(51, 9, 14, '2023-03-21 14:02:25'),
(52, 9, 16, '2023-03-21 14:02:25'),
(53, 9, 17, '2023-03-21 14:02:25'),
(54, 9, 18, '2023-03-21 14:02:25'),
(55, 9, 20, '2023-03-21 14:02:25'),
(56, 9, 21, '2023-03-21 14:02:25'),
(57, 10, 10, '2023-03-21 18:46:28'),
(58, 10, 11, '2023-03-21 18:46:28'),
(59, 10, 13, '2023-03-21 18:46:28'),
(60, 10, 17, '2023-03-21 18:46:28'),
(61, 10, 18, '2023-03-21 18:46:28'),
(62, 10, 19, '2023-03-21 18:46:28'),
(63, 10, 20, '2023-03-21 18:46:28'),
(64, 10, 21, '2023-03-21 18:46:28');

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

CREATE TABLE `reservation` (
  `reserv_id` int(11) NOT NULL,
  `num_guests` int(11) NOT NULL,
  `num_tables` int(11) NOT NULL,
  `rdate` date NOT NULL,
  `time_zone` text NOT NULL,
  `comment` mediumtext NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(30) NOT NULL,
  `user_fk` int(11) NOT NULL,
  `res_time_slot_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `reservation`
--

INSERT INTO `reservation` (`reserv_id`, `num_guests`, `num_tables`, `rdate`, `time_zone`, `comment`, `reg_date`, `status`, `user_fk`, `res_time_slot_id`) VALUES
(78, 8, 4, '2023-03-30', '19:15;00', '', '2023-03-16 21:29:14', '', 35, 9),
(79, 5, 2, '2023-03-24', '19:15:00', '', '2023-03-17 06:01:01', 'Annulée', 38, 9),
(80, 5, 2, '2023-03-24', '12:15:00', '', '2023-03-17 06:01:27', 'Annulée', 38, 2),
(81, 5, 2, '2023-03-24', '12:15:00', '', '2023-03-17 06:06:56', 'Annulée', 38, 2),
(82, 2, 1, '2023-04-09', '12:30:00', '', '2023-03-17 09:57:08', 'Approuvée', 26, 3),
(83, 4, 1, '2023-03-17', '20:15:00', '', '2023-03-17 15:37:36', 'Approuvée', 39, 13),
(85, 5, 2, '2023-04-03', '19:30:00', '', '2023-03-17 19:42:37', 'Approuvée', 40, 10),
(86, 4, 1, '2023-04-03', '20:15:00', '', '2023-03-17 19:43:01', 'Approuvée', 40, 13);

-- --------------------------------------------------------

--
-- Structure de la table `reservation_time_slot`
--

CREATE TABLE `reservation_time_slot` (
  `Id` int(11) NOT NULL,
  `time_slot` time NOT NULL,
  `midi` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `reservation_time_slot`
--

INSERT INTO `reservation_time_slot` (`Id`, `time_slot`, `midi`) VALUES
(1, '12:00:00', 1),
(2, '12:15:00', 1),
(3, '12:30:00', 1),
(4, '12:45:00', 1),
(5, '13:00:00', 1),
(6, '13:15:00', 1),
(7, '13:30:00', 1),
(8, '19:00:00', NULL),
(9, '19:15:00', NULL),
(10, '19:30:00', NULL),
(11, '19:45:00', NULL),
(12, '20:00:00', NULL),
(13, '20:15:00', NULL),
(14, '20:30:00', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

CREATE TABLE `role` (
  `role_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`role_id`) VALUES
(1),
(2),
(3);

-- --------------------------------------------------------

--
-- Structure de la table `schedule`
--

CREATE TABLE `schedule` (
  `schedule_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `open_time` time NOT NULL DEFAULT '12:00:00',
  `close_time` time NOT NULL DEFAULT '00:00:00',
  `day` varchar(10) NOT NULL,
  `eveningopentime` time NOT NULL,
  `eveningclosetime` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `schedule`
--

INSERT INTO `schedule` (`schedule_id`, `date`, `open_time`, `close_time`, `day`, `eveningopentime`, `eveningclosetime`) VALUES
(1, '0000-00-00', '12:00:00', '14:00:00', 'lundi', '19:00:00', '22:00:00'),
(2, '2019-05-15', '12:00:00', '14:00:00', 'mardi', '19:00:00', '22:00:00'),
(3, '2019-05-16', '00:00:00', '00:00:00', 'mercredi', '00:00:00', '00:00:00'),
(4, '2019-05-18', '12:00:00', '14:00:00', 'jeudi', '19:00:00', '22:00:00'),
(5, '0000-00-00', '12:00:00', '14:00:00', 'vendredi', '19:00:00', '22:00:00'),
(6, '0000-00-00', '00:00:00', '00:00:00', 'samedi', '19:00:00', '23:00:00'),
(7, '0000-00-00', '12:00:00', '14:00:00', 'dimanche', '00:00:00', '00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `tables`
--

CREATE TABLE `tables` (
  `tables_id` int(11) NOT NULL,
  `t_date` date NOT NULL,
  `t_tables` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `tables`
--

INSERT INTO `tables` (`tables_id`, `t_date`, `t_tables`) VALUES
(6, '2019-05-17', 5),
(7, '2019-05-15', 10),
(8, '2019-05-10', 2),
(9, '2023-03-14', 8),
(10, '2023-02-16', 1),
(11, '2023-02-16', 1),
(12, '2023-02-17', 1),
(13, '2023-02-17', 1),
(14, '2023-02-17', 1),
(15, '2023-02-17', 1),
(16, '2023-02-18', 1),
(17, '2023-02-18', 1),
(18, '2023-02-18', 1),
(19, '2023-02-18', 1),
(20, '2023-02-20', 1),
(21, '2023-03-20', 1),
(22, '2023-02-20', 1),
(23, '2023-03-20', 1),
(24, '2023-03-21', 1),
(25, '2023-03-21', 1);

-- --------------------------------------------------------

--
-- Structure de la table `tables_timeslot`
--

CREATE TABLE `tables_timeslot` (
  `Id` int(11) NOT NULL,
  `time_slot_id` int(11) NOT NULL,
  `tables_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `f_name` text NOT NULL,
  `l_name` text NOT NULL,
  `uidUsers` tinytext NOT NULL,
  `emailUsers` tinytext NOT NULL,
  `pwdUsers` longtext NOT NULL,
  `telephone` text NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `role_id` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`user_id`, `f_name`, `l_name`, `uidUsers`, `emailUsers`, `pwdUsers`, `telephone`, `reg_date`, `role_id`) VALUES
(26, '', '', 'admin', 'admin@in.com', '$2y$10$HblSqojYA9mVV4olpgMty.sP7GeqD4.9n4MeSvLtugukGTkhVAQWW', '', '2019-04-30 19:51:07', 2),
(27, '', '', 'kappa1', 'ka11pa@in.com', '$2y$10$/VK5CmjZavvC4gdv3WFk5u.Th5luQTfpzigiYPSryoVdULSE57A.a', '', '2019-04-30 20:18:57', 1),
(28, '', '', 'kappa2', 'kappa2@hotmail.com', '$2y$10$jfiG7gFvyQo..Cx1ZwktaOcs.83Zhsn0fkvq.9CvQCRA4Ognb/cBK', '', '2019-04-30 20:46:20', 2),
(29, '', '', 'ddsa', 'kapa@in.comq', '$2y$10$sH8sr2sI//qD5bg/D/sGeuDYb3COyUEwvNCKTLBfWUitVi2s/Z0ZG', '', '2019-05-01 00:25:37', 1),
(30, '', '', 'kappakeepo', '1kapa@in.com', '$2y$10$ONn5KIyEJ.iyFKQIZVHjiurhibs/udkh6W8BLqz1Anj/z9j2VbL6y', '', '2019-05-01 00:37:43', 1),
(31, '', '', 'kappakeepo12', 'kap11a@in.com', '$2y$10$WZjlyFoTvyAy/loojjLiE.0Ekka5nwcfAUnwIGM2FaR0g11ieVjeq', '', '2019-05-02 21:54:09', 1),
(32, '', '', 'fwtis', 'kappa1@in.gr', '$2y$10$3rZoKKI5idzOeRK.YUfcwe/7bL66dkU0o54w2uQ/PWpFPYR7T/Zk2', '', '2019-05-03 01:11:03', 1),
(33, '', '', 'kopelitsoua', 'effgfdgfdg@hotmail.com', '$2y$10$Ha0vNgl399uQveyAsp.MyuKteq9ZXZRH1yZ7XY2KZXU1O0HiQ0.CK', '', '2019-05-03 18:05:05', 1),
(34, '', '', 'lolas', 'lolas@in.gr', '$2y$10$Fgzedyphz9nYpLkXaGOc2u.K2SZby5m5t23Uo/3u/4kC8a6Uf9xTe', '', '2019-05-05 00:59:10', 1),
(35, '', '', 'raja', 'test@test.com', '$2y$10$HblSqojYA9mVV4olpgMty.sP7GeqD4.9n4MeSvLtugukGTkhVAQWW', '', '2023-03-06 18:30:11', 2),
(36, '', '', 'thanigai', 'thanigainayagam@yahoo.fr', '$2y$10$HblSqojYA9mVV4olpgMty.sP7GeqD4.9n4MeSvLtugukGTkhVAQWW', '', '2023-03-09 17:35:59', 2),
(37, 'Thanigai', 'Raja', 'test', 'test1@test.com', '$2y$10$G4l/yOULwzgR7eIiSgos5.lyAgNTU9xPv/jmJqAuM3GvLIu7YCxmW', '', '2023-03-13 21:13:47', 1),
(38, 'Joseph', 'Ruben', 'ruben', 'ruben@test.com', '$2y$10$KDTjr93Hfd.kppCT8pRIlORP7GYgn8SiKFvAmIKLM/s9s38w7y8.6', '', '2023-03-14 06:11:48', 1),
(39, 'Martin', 'Lucie', 'martin', 'lucie.martin@grouph.fr', '$2y$10$k7TKAJ6/VQL9lKBQchwxe.B9ghnIIRnjPnES2km/cHOZqWhS.Syj6', '', '2023-03-17 15:36:50', 1),
(40, 'Xavier', 'saga', 'saga', 'xsaga@test.com', '$2y$10$zYdBnFeGumJb4gs2Ouk2guRXrzsCdbZaGCqpyn3rolJSVKX7/EZ1G', '1234567890', '2023-03-17 18:10:08', 1),
(41, 'Raoul', 'Raja', 'RRR1006', 'test@gmail.com', '$2y$10$79IaU07z6cxfUHr1RLDLoO.7ihsXopOTZIStc.J9kmxf4iFqZx1Ca', '1234567890', '2023-03-17 19:37:01', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`Id`);

--
-- Index pour la table `foods`
--
ALTER TABLE `foods`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `category_id` (`category_id`);

--
-- Index pour la table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`Id`);

--
-- Index pour la table `menu_foods`
--
ALTER TABLE `menu_foods`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`reserv_id`),
  ADD KEY `users_fk` (`user_fk`),
  ADD KEY `res_time_slot_id` (`res_time_slot_id`);

--
-- Index pour la table `reservation_time_slot`
--
ALTER TABLE `reservation_time_slot`
  ADD PRIMARY KEY (`Id`);

--
-- Index pour la table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`),
  ADD KEY `role_id` (`role_id`);

--
-- Index pour la table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`schedule_id`);

--
-- Index pour la table `tables`
--
ALTER TABLE `tables`
  ADD PRIMARY KEY (`tables_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `category`
--
ALTER TABLE `category`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `foods`
--
ALTER TABLE `foods`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT pour la table `menu`
--
ALTER TABLE `menu`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `menu_foods`
--
ALTER TABLE `menu_foods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT pour la table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `reserv_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT pour la table `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `schedule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT pour la table `tables`
--
ALTER TABLE `tables`
  MODIFY `tables_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `foods`
--
ALTER TABLE `foods`
  ADD CONSTRAINT `foreignkey` FOREIGN KEY (`category_id`) REFERENCES `category` (`Id`);

--
-- Contraintes pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `idusers` FOREIGN KEY (`user_fk`) REFERENCES `users` (`user_id`);

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`) ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
