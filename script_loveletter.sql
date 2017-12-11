-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 11 déc. 2017 à 10:46
-- Version du serveur :  5.7.19
-- Version de PHP :  5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `symfony2`
--
CREATE DATABASE IF NOT EXISTS `symfony2` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `symfony2`;

-- --------------------------------------------------------

--
-- Structure de la table `carte`
--

DROP TABLE IF EXISTS `carte`;
CREATE TABLE IF NOT EXISTS `carte` (
  `id` int(11) NOT NULL,
  `nom` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `effet` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `carte`
--

INSERT INTO `carte` (`id`, `nom`, `effet`, `image`, `type`) VALUES
(1, 'garde', 'effet1', 'bundles/webloveletter/img/cartes/garde.png', 1),
(2, 'prêtre', 'effet2', 'bundles/webloveletter/img/cartes/prêtre.png', 2),
(3, 'baron', 'effet3', 'bundles/webloveletter/img/cartes/baron.png', 3),
(4, 'servante', 'effet4', 'bundles/webloveletter/img/cartes/servante.png', 4),
(5, 'prince', 'effet5', 'bundles/webloveletter/img/cartes/prince.png', 5),
(6, 'roi', 'effet6', 'bundles/webloveletter/img/cartes/roi.png', 6),
(7, 'comtesse', 'effet7', 'bundles/webloveletter/img/cartes/comtesse.png', 7),
(8, 'princesse', 'effet8', 'bundles/webloveletter/img/cartes/princesse.png', 8),
(9, 'prince', 'effet5', 'bundles/webloveletter/img/cartes/prince.png', 5),
(10, 'servante', 'effet4', 'bundles/webloveletter/img/cartes/servante.png', 4),
(11, 'baron', 'effet3', 'bundles/webloveletter/img/cartes/baron.png', 3),
(12, 'prêtre', 'effet2', 'bundles/webloveletter/img/cartes/prêtre.png', 2),
(13, 'garde', 'effet1', 'bundles/webloveletter/img/cartes/garde.png', 1),
(14, 'garde', 'effet1', 'bundles/webloveletter/img/cartes/garde.png', 1),
(15, 'garde', 'effet1', 'bundles/webloveletter/img/cartes/garde.png', 1),
(16, 'garde', 'effet1', 'bundles/webloveletter/img/cartes/garde.png', 1),
(99, 'pioche', 'rien', 'bundles/webloveletter/img/cartes/pioche.png', 99);

-- --------------------------------------------------------

--
-- Structure de la table `defausse`
--

DROP TABLE IF EXISTS `defausse`;
CREATE TABLE IF NOT EXISTS `defausse` (
  `id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_A16E9995BF396750` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `defausse`
--

INSERT INTO `defausse` (`id`) VALUES
(1);

-- --------------------------------------------------------

--
-- Structure de la table `defausse_carte`
--

DROP TABLE IF EXISTS `defausse_carte`;
CREATE TABLE IF NOT EXISTS `defausse_carte` (
  `defausse_id` int(11) NOT NULL,
  `carte_id` int(11) NOT NULL,
  PRIMARY KEY (`defausse_id`,`carte_id`),
  KEY `IDX_A21266979710C286` (`defausse_id`),
  KEY `IDX_A2126697C9C7CEB6` (`carte_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `defausse_carte`
--

INSERT INTO `defausse_carte` (`defausse_id`, `carte_id`) VALUES
(1, 1),
(1, 2),
(1, 8),
(1, 10),
(1, 16);

-- --------------------------------------------------------

--
-- Structure de la table `main`
--

DROP TABLE IF EXISTS `main`;
CREATE TABLE IF NOT EXISTS `main` (
  `id` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `visible` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `main`
--

INSERT INTO `main` (`id`, `visible`) VALUES
('admin', 0),
('admin2', 0),
('anonymous', NULL),
('JulienElBoss', 0),
('test', NULL),
('User', 0),
('username54', 0),
('XxXLeDarkZouaveDu54XxX', 0);

-- --------------------------------------------------------

--
-- Structure de la table `main_carte`
--

DROP TABLE IF EXISTS `main_carte`;
CREATE TABLE IF NOT EXISTS `main_carte` (
  `main_id` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `carte_id` int(11) NOT NULL,
  PRIMARY KEY (`main_id`,`carte_id`),
  KEY `IDX_19884CBB627EA78A` (`main_id`),
  KEY `IDX_19884CBBC9C7CEB6` (`carte_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `main_carte`
--

INSERT INTO `main_carte` (`main_id`, `carte_id`) VALUES
('username54', 4),
('JulienElBoss', 6),
('User', 7),
('XxXLeDarkZouaveDu54XxX', 11),
('admin2', 15),
('admin', 16);

-- --------------------------------------------------------

--
-- Structure de la table `manche`
--

DROP TABLE IF EXISTS `manche`;
CREATE TABLE IF NOT EXISTS `manche` (
  `id` int(11) NOT NULL,
  `defausse_id` int(11) DEFAULT NULL,
  `pioche_id` int(11) DEFAULT NULL,
  `gagnant` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `tour` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `end` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_A06E62EB9710C286` (`defausse_id`),
  UNIQUE KEY `UNIQ_A06E62EB162A0A8C` (`pioche_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `manche`
--

INSERT INTO `manche` (`id`, `defausse_id`, `pioche_id`, `gagnant`, `tour`, `end`) VALUES
(10, 1, 1, 'bob', 'XxXLeDarkZouaveDu54XxX', 0),
(11, NULL, NULL, 'bob', NULL, NULL),
(12, NULL, NULL, 'bob', NULL, NULL),
(13, NULL, NULL, 'bob', NULL, NULL),
(14, NULL, NULL, 'bob', NULL, NULL),
(15, NULL, NULL, 'bob', NULL, NULL),
(16, NULL, NULL, 'bob', NULL, NULL),
(17, NULL, NULL, 'bob', NULL, NULL),
(18, NULL, NULL, 'bob', NULL, NULL),
(19, NULL, NULL, 'bob', NULL, NULL),
(20, NULL, NULL, 'bob', NULL, NULL),
(21, NULL, NULL, 'bob', NULL, NULL),
(22, NULL, NULL, 'bob', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `manche_utilisateur`
--

DROP TABLE IF EXISTS `manche_utilisateur`;
CREATE TABLE IF NOT EXISTS `manche_utilisateur` (
  `manche_id` int(11) NOT NULL,
  `utilisateur_id` int(11) NOT NULL,
  PRIMARY KEY (`manche_id`,`utilisateur_id`),
  KEY `IDX_5994EF7D3E37BFAB` (`manche_id`),
  KEY `IDX_5994EF7DFB88E14F` (`utilisateur_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `manche_utilisateur`
--

INSERT INTO `manche_utilisateur` (`manche_id`, `utilisateur_id`) VALUES
(10, 9),
(10, 10);

-- --------------------------------------------------------

--
-- Structure de la table `partie`
--

DROP TABLE IF EXISTS `partie`;
CREATE TABLE IF NOT EXISTS `partie` (
  `id` int(11) NOT NULL,
  `nb_joueurs` int(11) NOT NULL,
  `nb_manches` int(11) NOT NULL,
  `gagnant` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_59B1F3D53D089C` (`gagnant`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `partie`
--

INSERT INTO `partie` (`id`, `nb_joueurs`, `nb_manches`, `gagnant`) VALUES
(1, 2, 13, 'boby');

-- --------------------------------------------------------

--
-- Structure de la table `partie_manche`
--

DROP TABLE IF EXISTS `partie_manche`;
CREATE TABLE IF NOT EXISTS `partie_manche` (
  `partie_id` int(11) NOT NULL,
  `manche_id` int(11) NOT NULL,
  PRIMARY KEY (`partie_id`,`manche_id`),
  KEY `IDX_F3611787E075F7A4` (`partie_id`),
  KEY `IDX_F36117873E37BFAB` (`manche_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `partie_manche`
--

INSERT INTO `partie_manche` (`partie_id`, `manche_id`) VALUES
(1, 10),
(1, 11),
(1, 12),
(1, 13),
(1, 14),
(1, 15),
(1, 16),
(1, 17),
(1, 18),
(1, 19),
(1, 20),
(1, 21),
(1, 22);

-- --------------------------------------------------------

--
-- Structure de la table `pioche`
--

DROP TABLE IF EXISTS `pioche`;
CREATE TABLE IF NOT EXISTS `pioche` (
  `id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_97EA5F0ABF396750` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `pioche`
--

INSERT INTO `pioche` (`id`) VALUES
(1);

-- --------------------------------------------------------

--
-- Structure de la table `pioche_carte`
--

DROP TABLE IF EXISTS `pioche_carte`;
CREATE TABLE IF NOT EXISTS `pioche_carte` (
  `pioche_id` int(11) NOT NULL,
  `carte_id` int(11) NOT NULL,
  PRIMARY KEY (`pioche_id`,`carte_id`),
  KEY `IDX_6AAA6734162A0A8C` (`pioche_id`),
  KEY `IDX_6AAA6734C9C7CEB6` (`carte_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `pioche_carte`
--

INSERT INTO `pioche_carte` (`pioche_id`, `carte_id`) VALUES
(1, 3),
(1, 4),
(1, 5),
(1, 7),
(1, 12),
(1, 14);

-- --------------------------------------------------------

--
-- Structure de la table `plateau`
--

DROP TABLE IF EXISTS `plateau`;
CREATE TABLE IF NOT EXISTS `plateau` (
  `id` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `plateau`
--

INSERT INTO `plateau` (`id`) VALUES
('admin'),
('admin2'),
('JulienElBoss'),
('User'),
('username54'),
('XxXLeDarkZouaveDu54XxX');

-- --------------------------------------------------------

--
-- Structure de la table `plateau_carte`
--

DROP TABLE IF EXISTS `plateau_carte`;
CREATE TABLE IF NOT EXISTS `plateau_carte` (
  `plateau_id` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `carte_id` int(11) NOT NULL,
  PRIMARY KEY (`plateau_id`,`carte_id`),
  KEY `IDX_C3EB5E15927847DB` (`plateau_id`),
  KEY `IDX_C3EB5E15C9C7CEB6` (`carte_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `plateau_carte`
--

INSERT INTO `plateau_carte` (`plateau_id`, `carte_id`) VALUES
('JulienElBoss', 9),
('JulienElBoss', 13),
('XxXLeDarkZouaveDu54XxX', 15);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `main_id` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `confirmation_token` varchar(180) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `nb_win` int(11) DEFAULT NULL,
  `victoire` int(11) DEFAULT NULL,
  `point` int(11) DEFAULT NULL,
  `plateau_id` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `immunite` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_1D1C63B392FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_1D1C63B3A0D96FBF` (`email_canonical`),
  UNIQUE KEY `UNIQ_1D1C63B3C05FB297` (`confirmation_token`),
  UNIQUE KEY `UNIQ_1D1C63B3627EA78A` (`main_id`),
  UNIQUE KEY `UNIQ_1D1C63B3927847DB` (`plateau_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `main_id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `confirmation_token`, `password_requested_at`, `roles`, `nb_win`, `victoire`, `point`, `plateau_id`, `immunite`) VALUES
(1, 'admin', 'admin', 'admin', 'admin@loveletter.com', 'admin@loveletter.com', 1, 'dfigk.6GziwYlgpeh1krtqY9vcGR733KPDWPk8bi8Jo', 'jFaehg+a6GKWQUeNLJrBmLgF5O1RCfORiyXym+V7KimlaWaY/+QR9FO+ognx1CWDFympLBz8YGSqSxqqweccFQ==', '2017-12-11 09:14:52', NULL, NULL, 'a:0:{}', NULL, 1, 0, 'admin', 2),
(2, 'admin2', 'admin2', 'admin2', 'admin2@loveletter.com', 'admin2@loveletter.com', 1, 'vNkf9HUwqLoUv/QR0VCTHdujvR/KCwdlCS3MV1N60EM', 'likicWvtFdrh2SwdTcu/YlKCyAmBuT0woWfnDPlgZKa/EDoU0E2dLGb2Ax9Y0AlWzyibvi9ghe0if5jEyiIpXw==', '2017-12-11 08:34:45', NULL, NULL, 'a:0:{}', NULL, 1, 0, 'admin2', 2),
(3, NULL, 'Sypherz', 'sypherz', 'sypherz@gmail.com', 'sypherz@gmail.com', 1, 'KgwrYtPJ.Xaro8S/CWt9CFMpaHwz9F3dXNKwfSz6Us0', 'dnJgn9AivbnuA/fbbIwvqqzhUO6mz/MIoIXiMKZraIUdttYGNDpuMnn3RFM8RQ/6LLnJThnRoWO3fm52/dZhYQ==', '2017-12-10 16:55:48', NULL, NULL, 'a:0:{}', NULL, NULL, NULL, NULL, NULL),
(4, 'username54', 'username54', 'username54', 'email@email.com', 'email@email.com', 1, 'uzFT8Ig2NI3p2m11yO0XNM7KXAzBTzBdxJJLS2zXZnc', 'AlFK1p++nB483XCV2P8652egoF8KalegK5x5ApFwH6OHcIHUwVCnpeq5I1zachNNE1e5wi5/FMyJQjLzjXgFCQ==', '2017-12-10 20:32:10', NULL, NULL, 'a:0:{}', NULL, 1, 0, 'username54', 2),
(5, 'User', 'User', 'user', 'email@email.fr', 'email@email.fr', 1, '3LXHia9Kwy71qUBWTV8QziW6Q2YSan/OFI/zedA3EtA', '3VWzW1CoUhOahLB1yyu/72qDKiXPs1+BNTBhvDY0WiZdQ1hXz5Dz++s1+X/LmOrelA9ygWEAeiya0x/idqvtaw==', '2017-12-10 20:32:16', NULL, NULL, 'a:0:{}', NULL, 1, 0, 'User', 2),
(6, NULL, 'testuser', 'testuser', 'testmail@test.com', 'testmail@test.com', 1, 'yv/IkQTZjsQIzE05JMtSbVgonLH/bkno36y06/YqQL8', '69/VCtTvPsKFYsj1vUhHbDd3tBlTZ9ZGdqR1QZibDe2qSZub39LejT0jLLB9xN3c7wUHX08509PrJfk6Rvq4QA==', '2017-12-10 21:00:24', NULL, NULL, 'a:0:{}', NULL, NULL, NULL, NULL, NULL),
(7, NULL, 'testuser2', 'testuser2', 'testmail@testzazaa.com', 'testmail@testzazaa.com', 1, 'OflcuYlu4/HLUB4lrCcpMLW0FBIx1.a7ArYbIcS7Ys0', 'Mi0uodLEUP7QxyUa+OjTERuqnZ9coUUrPw4lwLrMmaL/FKADV7l1BZcroTKWCxrVzPoQqp1StHaKvD0OtDvWHg==', '2017-12-10 21:02:04', NULL, NULL, 'a:0:{}', NULL, NULL, NULL, NULL, NULL),
(8, NULL, 'test2', 'test2', 'mail@mail.fr', 'mail@mail.fr', 1, 'L3FOBQn3zgwZgb96O1rbG.t6wreI2gbOPIcuAHx3LKU', '6vCZvwJXwZpcJ8xKLFpW1o62ahCKGWVhfGAWB63E2xdpvvNJoXmC//RNkJao55w/t6yYbwQQMkNlUnJ+34ro7g==', '2017-12-10 21:02:58', NULL, NULL, 'a:0:{}', NULL, NULL, NULL, NULL, NULL),
(9, 'JulienElBoss', 'JulienElBoss', 'julienelboss', 'j.micheletti@hotmail.fr', 'j.micheletti@hotmail.fr', 1, 'jmu8FbRZ2UxipiCIgW7mTvj6n.a62NZj2kCTZQIUmQQ', 'UoreoW5qUzlG3scoYqIUIzqdPUoHCwUOwwVMfovXe0juHCRvr5MTgoGVEMbB3extPHCWnFFq4YLOBZfrs1dA7A==', '2017-12-11 10:44:29', NULL, NULL, 'a:0:{}', NULL, 1, 0, 'JulienElBoss', 4),
(10, 'XxXLeDarkZouaveDu54XxX', 'XxXLeDarkZouaveDu54XxX', 'xxxledarkzouavedu54xxx', 'LeZou@gmail.com', 'lezou@gmail.com', 1, 'BW0Sk7U4E5vahKkJCH5a.fk4cRytHcc/TUZLmBSZSHA', '6t+jhE3MtvaLmnDqr8gvBnxuQt9BbjqU7cYVEuLgUsF0uPSi7+gYqIOdXPMaHQFO3e1VNSqQMvsGtxC2JhWfXQ==', '2017-12-11 10:39:34', NULL, NULL, 'a:0:{}', NULL, 1, 0, 'XxXLeDarkZouaveDu54XxX', 3);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `defausse_carte`
--
ALTER TABLE `defausse_carte`
  ADD CONSTRAINT `FK_A21266979710C286` FOREIGN KEY (`defausse_id`) REFERENCES `defausse` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_A2126697C9C7CEB6` FOREIGN KEY (`carte_id`) REFERENCES `carte` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `main_carte`
--
ALTER TABLE `main_carte`
  ADD CONSTRAINT `FK_19884CBB627EA78A` FOREIGN KEY (`main_id`) REFERENCES `main` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_19884CBBC9C7CEB6` FOREIGN KEY (`carte_id`) REFERENCES `carte` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `manche`
--
ALTER TABLE `manche`
  ADD CONSTRAINT `FK_A06E62EB162A0A8C` FOREIGN KEY (`pioche_id`) REFERENCES `pioche` (`id`),
  ADD CONSTRAINT `FK_A06E62EB9710C286` FOREIGN KEY (`defausse_id`) REFERENCES `defausse` (`id`);

--
-- Contraintes pour la table `manche_utilisateur`
--
ALTER TABLE `manche_utilisateur`
  ADD CONSTRAINT `FK_5994EF7D3E37BFAB` FOREIGN KEY (`manche_id`) REFERENCES `manche` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_5994EF7DFB88E14F` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateur` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `partie_manche`
--
ALTER TABLE `partie_manche`
  ADD CONSTRAINT `FK_F36117873E37BFAB` FOREIGN KEY (`manche_id`) REFERENCES `manche` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_F3611787E075F7A4` FOREIGN KEY (`partie_id`) REFERENCES `partie` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `pioche_carte`
--
ALTER TABLE `pioche_carte`
  ADD CONSTRAINT `FK_6AAA6734162A0A8C` FOREIGN KEY (`pioche_id`) REFERENCES `pioche` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_6AAA6734C9C7CEB6` FOREIGN KEY (`carte_id`) REFERENCES `carte` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `plateau_carte`
--
ALTER TABLE `plateau_carte`
  ADD CONSTRAINT `FK_C3EB5E15927847DB` FOREIGN KEY (`plateau_id`) REFERENCES `plateau` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_C3EB5E15C9C7CEB6` FOREIGN KEY (`carte_id`) REFERENCES `carte` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `FK_1D1C63B3627EA78A` FOREIGN KEY (`main_id`) REFERENCES `main` (`id`),
  ADD CONSTRAINT `FK_1D1C63B3927847DB` FOREIGN KEY (`plateau_id`) REFERENCES `plateau` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
