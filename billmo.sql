-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 07 août 2024 à 10:49
-- Version du serveur : 8.2.0
-- Version de PHP : 8.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `billmo`
--

-- --------------------------------------------------------

--
-- Structure de la table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `customer`
--

INSERT INTO `customer` (`id`, `name`) VALUES
(8, 'BillMo'),
(9, 'Client 1'),
(10, 'Client 2'),
(11, 'Client 3');

-- --------------------------------------------------------

--
-- Structure de la table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `id` int NOT NULL AUTO_INCREMENT,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `updated_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `price` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=108 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `product`
--

INSERT INTO `product` (`id`, `created_at`, `updated_at`, `name`, `description`, `price`) VALUES
(88, '2024-07-26 15:11:31', '2024-07-26 15:11:31', 'BiPhone 1', 'Ceci est le téléphone mobile n°1 de l\'entreprise BillMo.', 133.27),
(89, '2024-07-26 15:11:31', '2024-07-26 15:11:31', 'BiPhone 2', 'Ceci est le téléphone mobile n°2 de l\'entreprise BillMo.', 157.9),
(90, '2024-07-26 15:11:31', '2024-07-26 15:11:31', 'BiPhone 3', 'Ceci est le téléphone mobile n°3 de l\'entreprise BillMo.', 597.05),
(91, '2024-07-26 15:11:31', '2024-07-26 15:11:31', 'BiPhone 4', 'Ceci est le téléphone mobile n°4 de l\'entreprise BillMo.', 563.89),
(92, '2024-07-26 15:11:31', '2024-07-26 15:11:31', 'BiPhone 5', 'Ceci est le téléphone mobile n°5 de l\'entreprise BillMo.', 255.08),
(93, '2024-07-26 15:11:31', '2024-07-26 15:11:31', 'BiPhone 6', 'Ceci est le téléphone mobile n°6 de l\'entreprise BillMo.', 493.31),
(94, '2024-07-26 15:11:31', '2024-07-26 15:11:31', 'BiPhone 7', 'Ceci est le téléphone mobile n°7 de l\'entreprise BillMo.', 446.61),
(95, '2024-07-26 15:11:31', '2024-07-26 15:11:31', 'BiPhone 8', 'Ceci est le téléphone mobile n°8 de l\'entreprise BillMo.', 747.74),
(96, '2024-07-26 15:11:31', '2024-07-26 15:11:31', 'BiPhone 9', 'Ceci est le téléphone mobile n°9 de l\'entreprise BillMo.', 347.9),
(97, '2024-07-26 15:11:31', '2024-07-26 15:11:31', 'BiPhone 10', 'Ceci est le téléphone mobile n°10 de l\'entreprise BillMo.', 594.41),
(98, '2024-07-26 15:11:31', '2024-07-26 15:11:31', 'BiPhone 11', 'Ceci est le téléphone mobile n°11 de l\'entreprise BillMo.', 893.32),
(99, '2024-07-26 15:11:31', '2024-07-26 15:11:31', 'BiPhone 12', 'Ceci est le téléphone mobile n°12 de l\'entreprise BillMo.', 857.11),
(100, '2024-07-26 15:11:31', '2024-07-26 15:11:31', 'BiPhone 13', 'Ceci est le téléphone mobile n°13 de l\'entreprise BillMo.', 104.82),
(101, '2024-07-26 15:11:31', '2024-07-26 15:11:31', 'BiPhone 14', 'Ceci est le téléphone mobile n°14 de l\'entreprise BillMo.', 160.57),
(102, '2024-07-26 15:11:31', '2024-07-26 15:11:31', 'BiPhone 15', 'Ceci est le téléphone mobile n°15 de l\'entreprise BillMo.', 763.49),
(103, '2024-07-26 15:11:31', '2024-07-26 15:11:31', 'BiPhone 16', 'Ceci est le téléphone mobile n°16 de l\'entreprise BillMo.', 297.86),
(104, '2024-07-26 15:11:31', '2024-07-26 15:11:31', 'BiPhone 17', 'Ceci est le téléphone mobile n°17 de l\'entreprise BillMo.', 176.43),
(105, '2024-07-26 15:11:31', '2024-07-26 15:11:31', 'BiPhone 18', 'Ceci est le téléphone mobile n°18 de l\'entreprise BillMo.', 922.23),
(106, '2024-07-26 15:11:31', '2024-07-26 15:11:31', 'BiPhone 19', 'Ceci est le téléphone mobile n°19 de l\'entreprise BillMo.', 132.03),
(107, '2024-07-26 15:11:31', '2024-07-26 15:11:31', 'BiPhone 20', 'Ceci est le téléphone mobile n°20 de l\'entreprise BillMo.', 947.71);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `customer_id` int NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_IDENTIFIER_EMAIL` (`email`),
  KEY `IDX_8D93D6499395C3F3` (`customer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `customer_id`, `email`, `roles`, `password`) VALUES
(28, 8, 'admin@billmoapi.com', '[\"ROLE_ADMIN\"]', '$2y$13$04tWHkeietdOTlqVLN7.Su59RMDSRsKEdOocFKl5BMy4sHMhjKlZy'),
(29, 9, 'user1.customer1@billmoapi.com', '[\"ROLE_USER\"]', '$2y$13$k/JK4vv2I503GVywecjxI.C2s4jQ4dCTbvSkYqNcMJEJUUrLSfUl6'),
(30, 9, 'user2.customer1@billmoapi.com', '[\"ROLE_USER\"]', '$2y$13$7t1wQZoDTnzpJn4R8oQwXOEaPvI9ToCSQeh4H.f1WvNv2TaabxCnS'),
(31, 9, 'user3.customer1@billmoapi.com', '[\"ROLE_USER\"]', '$2y$13$50dMEVFGAnmKcfsC491A3Ofdr7aQlDYps0fBo8CxJfcdiiWU4Ynwa'),
(32, 9, 'user4.customer1@billmoapi.com', '[\"ROLE_USER\"]', '$2y$13$RIMy4CXggYphfH5MmUrlTOhwNR5N/DeD/RUDGicK.xxk1dVrt87my'),
(33, 9, 'user5.customer1@billmoapi.com', '[\"ROLE_USER\"]', '$2y$13$Oqq0OrleFUO9Cjq0uzDwg.fetvGerVaIzjhfEFF9oGDYV8ufwg2/C'),
(34, 10, 'user1.customer2@billmoapi.com', '[\"ROLE_USER\"]', '$2y$13$YQanFHqW8gHkhYcFdUoLCeWv1OfCnUnNFtRT3fxZEPCzoZkVH3ieS'),
(35, 10, 'user2.customer2@billmoapi.com', '[\"ROLE_USER\"]', '$2y$13$NT/I5rruDRrfQxWBXr8pP.S3nwYktw6eOHnFDKCg5E4v7bwOB3gBG'),
(36, 10, 'user3.customer2@billmoapi.com', '[\"ROLE_USER\"]', '$2y$13$A0A14PrmTk12jXkvpiWpz.4qGNPPBiofcw1P1pcKKPCpAFOq2/y8K'),
(37, 10, 'user4.customer2@billmoapi.com', '[\"ROLE_USER\"]', '$2y$13$pDRecFZIYfH5pW.2Dr/pReT/TuYRqqv2xVSO04YRkoHIZvMgCJpH6'),
(38, 10, 'user5.customer2@billmoapi.com', '[\"ROLE_USER\"]', '$2y$13$RBY0GJzP97vQe317fn6KWO5XENUjM2Pt/vPax.wW2GLDiqRlBhtJy'),
(39, 11, 'user1.customer3@billmoapi.com', '[\"ROLE_USER\"]', '$2y$13$iGebntudK/KDq3Ofa00aIO3FogCETVnP4a0nuPIvO.o1qeQ1Kb.xK'),
(40, 11, 'user2.customer3@billmoapi.com', '[\"ROLE_USER\"]', '$2y$13$DvcxJyXfqkyURif5TVjCU.CWqKjd2Aiac9/v10n467yRWXv3mW4aq'),
(41, 11, 'user3.customer3@billmoapi.com', '[\"ROLE_USER\"]', '$2y$13$8HgvdBiVxFalDKM7Zbi6C.sEG2s7.iyb5wuMgk/XdwfxqyUrTmbOm'),
(42, 11, 'user4.customer3@billmoapi.com', '[\"ROLE_USER\"]', '$2y$13$JXP/fUwLhZu.rNj2Y7P8X.CX/yvAlgfCMP40PpKmPSirS1rH0fRcm'),
(43, 11, 'user5.customer3@billmoapi.com', '[\"ROLE_USER\"]', '$2y$13$kuCV7gb7ux84KrgJ1UN1heW8oFHVNYNxF2zyaXFEZ2I9H4yeVq4Me'),
(45, 8, 'test2@billmoapi.com', '[\"ROLE_USER\"]', '$2y$13$CEfFDPFtNd32Evfsxx49aOl8X1xZSVOTC9NYoRV6lKjibZWXL0hH2'),
(46, 8, 'test3@billmoapi.com', '[\"ROLE_USER\"]', '$2y$13$alJpNCs8ez3q.NDyMaUFF.8DcNQ1HnJB2fCEYKo1NQR2BCJEp14yG'),
(47, 8, 'test4@billmoapi.com', '[\"ROLE_USER\"]', '$2y$13$QPz92Sjqblq3gdVmeAbmZuE7XcWCua50mt9IQDj49J.BLXb.gASJy'),
(48, 8, 'test5@billmoapi.com', '[\"ROLE_USER\"]', '$2y$13$VmpddzG7rWoxcDBUpZhDuO4m5KPiObW//4ReiA.tnydGPCfhXysHm'),
(49, 8, 'test6@billmoapi.com', '[\"ROLE_USER\"]', '$2y$13$lBriNv5MAAGf47oiq7qfmuwV/aVSU989ttP4dErz2yoK/fP5.rNRu');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_8D93D6499395C3F3` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
