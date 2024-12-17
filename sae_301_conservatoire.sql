-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 17 déc. 2024 à 14:38
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `sae_301_conservatoire`
--

-- --------------------------------------------------------

--
-- Structure de la table `avis`
--

CREATE TABLE `avis` (
  `id_avis` int(11) NOT NULL,
  `description` text NOT NULL,
  `date_creation` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_events` int(11) NOT NULL,
  `id_users` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `avis`
--

INSERT INTO `avis` (`id_avis`, `description`, `date_creation`, `id_events`, `id_users`) VALUES
(1, 'Vous êtes bon. J\'avoue', '2024-12-14 23:33:19', 1, 46),
(2, 'bb', '2024-12-16 18:06:33', 1, 47),
(3, 'cc', '2024-12-16 18:17:11', 4, 47),
(4, 'cc', '2024-12-16 18:17:16', 4, 47),
(5, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it', '2024-12-16 18:18:19', 4, 47),
(6, 'dfdfdf', '2024-12-16 18:40:03', 4, 47),
(7, 'rr', '2024-12-17 11:04:58', 4, 47),
(8, 'eee', '2024-12-17 13:37:33', 4, 46),
(9, 'fddfd', '2024-12-17 13:37:35', 4, 46);

-- --------------------------------------------------------

--
-- Structure de la table `cat_events`
--

CREATE TABLE `cat_events` (
  `id_cat_events` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `cat_events`
--

INSERT INTO `cat_events` (`id_cat_events`, `nom`) VALUES
(1, 'Musique'),
(2, 'Théâtre'),
(3, 'Danse');

-- --------------------------------------------------------

--
-- Structure de la table `events`
--

CREATE TABLE `events` (
  `id_events` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `date_events` datetime NOT NULL,
  `description` text NOT NULL,
  `prix` varchar(255) NOT NULL,
  `alt_img` varchar(255) NOT NULL,
  `url_img` varchar(255) NOT NULL,
  `nb_places_prevues` int(11) NOT NULL,
  `nb_places_reservees` int(11) NOT NULL,
  `date_creation` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_lieux` int(11) NOT NULL,
  `id_cat_events` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `events`
--

INSERT INTO `events` (`id_events`, `nom`, `date_events`, `description`, `prix`, `alt_img`, `url_img`, `nb_places_prevues`, `nb_places_reservees`, `date_creation`, `id_lieux`, `id_cat_events`) VALUES
(1, 'Concert Rock', '2024-12-15 00:00:00', 'Un concert de rock avec des groupes locaux.', 'gratuit', 'credit-Charlyne-Azzalin4-compresse-298x346.jpg', 'credit-Charlyne-Azzalin4-compresse-298x346.jpg', 100, 0, '2024-12-14 22:41:57', 1, 1),
(2, 'Exposition Art Contemporain', '2024-12-20 00:00:00', 'Exposition des œuvres d\'art contemporain.', 'gratuit', 'credit-Charlyne-Azzalin4-compresse-298x346.jpg', 'credit-Charlyne-Azzalin4-compresse-298x346.jpg', 50, 0, '2024-12-14 22:42:02', 2, 2),
(3, 'Atelier Cuisine', '2024-12-25 00:00:00', 'Un atelier de cuisine pour apprendre des recettes de Noël.', 'gratuit', 'credit-Charlyne-Azzalin4-compresse-298x346.jpg', 'credit-Charlyne-Azzalin4-compresse-298x346.jpg', 20, 0, '2024-12-14 22:42:09', 3, 3),
(4, 'Conférence Technologie', '2025-01-05 00:00:00', 'Une conférence sur les dernières tendances en matière de technologie.', 'gratuit', 'credit-Charlyne-Azzalin4-compresse-298x346.jpg', 'credit-Charlyne-Azzalin4-compresse-298x346.jpg', 200, 0, '2024-12-14 22:42:13', 4, 1),
(5, 'Festival de Musique', '2025-02-10 00:00:00', 'Festival avec plusieurs concerts et activités musicales.', 'gratuit', 'credit-Charlyne-Azzalin4-compresse-298x346.jpg', 'credit-Charlyne-Azzalin4-compresse-298x346.jpg', 500, 0, '2024-12-14 22:42:17', 2, 2);

-- --------------------------------------------------------

--
-- Structure de la table `lieux`
--

CREATE TABLE `lieux` (
  `id_lieux` int(11) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `nb_places_max` int(11) NOT NULL,
  `longitude` varchar(255) NOT NULL,
  `latitude` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `lieux`
--

INSERT INTO `lieux` (`id_lieux`, `adresse`, `nom`, `description`, `nb_places_max`, `longitude`, `latitude`) VALUES
(1, '13 Rue de la République, 43000 Le Puy-en-Velay', 'Le Théâtre Le Puy-en-Velay', 'Ce théâtre accueille des spectacles de danse, de musique et des concerts variés.', 700, '3.8872', '45.0437'),
(2, '6 Avenue de l\'Aérodrome, 43000 Le Puy-en-Velay', 'Le Zénith d\'Auvergne', 'Grande salle polyvalente pour concerts et événements de grande envergure.', 4500, '3.8740', '45.0430'),
(3, '3 Rue du Foyer, 43000 Le Puy-en-Velay', 'Le Centre Culturel Le Foyer', 'Lieu de concert et d\'événements culturels, avec une programmation variée.', 350, '3.8826', '45.0415'),
(4, '7 Rue des Casernes, 43000 Le Puy-en-Velay', 'La Maison de la Musique', 'Lieu de musique et de danse, propose des concerts intimistes et des performances locales.', 200, '3.8839', '45.0433'),
(5, 'Place de la Mairie, 43000 Le Puy-en-Velay', 'La Salle des Fêtes de la Ville', 'Salle polyvalente idéale pour des concerts, des spectacles de danse et des événements divers.', 50, '3.8875', '45.0439');

-- --------------------------------------------------------

--
-- Structure de la table `permissions`
--

CREATE TABLE `permissions` (
  `id_permissions` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `permissions`
--

INSERT INTO `permissions` (`id_permissions`, `nom`, `description`) VALUES
(1, 'updateInfosUsersEvents', 'Il peut modifier les informations d\'un utilisateur.'),
(2, 'supprimerUnAvis', 'Il a le droit de supprimer un avis'),
(3, 'creerEvents', 'Il peut créer un Évènement.'),
(4, 'supprimerUnCompte', 'Il a le droit de supprimer le compte d\'un utilisateur'),
(5, 'creerUser', 'Il peut créer un compte utilisateur'),
(6, 'creerAdmin', 'Il peut créer un administrateur'),
(7, 'attribuerPermissions', 'Il peut attribuer des permissions');

-- --------------------------------------------------------

--
-- Structure de la table `permission_roles`
--

CREATE TABLE `permission_roles` (
  `id_permission_roles` int(11) NOT NULL,
  `id_permissions` int(11) NOT NULL,
  `id_roles` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `permission_roles`
--

INSERT INTO `permission_roles` (`id_permission_roles`, `id_permissions`, `id_roles`) VALUES
(1, 1, 3),
(2, 2, 3),
(3, 3, 3),
(4, 4, 3),
(5, 5, 3),
(6, 6, 3),
(7, 7, 3),
(12, 1, 2),
(13, 2, 2),
(14, 3, 2),
(15, 5, 2);

-- --------------------------------------------------------

--
-- Structure de la table `reservations`
--

CREATE TABLE `reservations` (
  `id_reservations` int(11) NOT NULL,
  `id_events` int(11) NOT NULL,
  `id_users` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

CREATE TABLE `roles` (
  `id_roles` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`id_roles`, `nom`) VALUES
(1, 'user'),
(2, 'admin'),
(3, 'superAdmin');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id_users` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `date_naissance` date NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `statut_compte` varchar(255) NOT NULL DEFAULT 'inactif',
  `code_verification` varchar(255) NOT NULL,
  `telephone` varchar(255) NOT NULL,
  `id_roles` int(11) NOT NULL DEFAULT 1,
  `p_conn` tinyint(1) NOT NULL,
  `d_conn` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id_users`, `nom`, `prenom`, `date_naissance`, `mdp`, `mail`, `statut_compte`, `code_verification`, `telephone`, `id_roles`, `p_conn`, `d_conn`) VALUES
(46, 'NathanRR', 'Essai', '2024-12-20', '$2y$10$VT/Hx05pkXdzdDG05Vjp8.EC.3kUetoSzI0E.Vwnsq3KWW30gbtdW', 'Essai7@gmail.com', 'actif', 'sans code', '0745229722', 1, 0, '2024-12-17 08:40:43'),
(47, 'Admin', 'admin', '2024-12-11', '$2y$10$kmyy0oX.lI64kYfE6KJuAODW9bdeX7hlVAOVD.IhoOdgWi5nPqqD.', 'Admin33@gmail.com', 'actif', 'sans code', '0745229722', 3, 0, '2024-12-16 12:02:04'),
(50, 'Nom550', 'Prenom118', '1970-06-20', '$2y$10$tXzTiqWHDgPPCO9wtH4O2OSpRu6amQBb8laTHCuJbzJ85u7BRq1hO', 'prenom118.nom55088@example.com', 'inactif', '92530', '0648858304', 1, 0, '2024-12-16 22:28:10'),
(51, 'Nom956', 'Prenom297', '1995-02-12', '$2y$10$UHO2x6YMNx0Crr8y6lYYvevCQ39kWArNfv/ZtoKpdx624cyhyklNu', 'prenom297.nom95644@example.com', 'inactif', '50120', '0651939793', 1, 0, '2024-12-16 22:28:10'),
(52, 'Nom636', 'Prenom476', '1961-01-09', '$2y$10$4b9cuJ.HqLRCntbAPJVDZ.spyLIY8capb2CCcH1xhIQaFXZtp.brW', 'prenom476.nom63627@example.com', 'inactif', '83857', '0662750620', 1, 0, '2024-12-16 22:28:10'),
(53, 'Nom209', 'Prenom789', '1993-01-22', '$2y$10$mL8y4.0D9Vv46b0IPVkL.eZ2S9WV4VpWqsa0vOcUE1oe/mO4P9jH2', 'prenom789.nom20963@example.com', 'inactif', '12773', '0627746144', 1, 0, '2024-12-16 22:28:10'),
(54, 'Nom383', 'Prenom961', '1982-05-18', '$2y$10$SiK0UT4fMbpcxjRbxz4UhOaz3JMVLcRkWtN8BlOqvNOIrOohP69ui', 'prenom961.nom38385@example.com', 'inactif', '43212', '0661258147', 1, 0, '2024-12-16 22:28:10'),
(55, 'Nom660', 'Prenom976', '1983-08-11', '$2y$10$GsfY105781PTGGCe.D2BSeeTe9D5IMJ/nrutBvrxRlufBcrPk3whS', 'prenom976.nom66072@example.com', 'inactif', '25201', '0626025441', 1, 0, '2024-12-16 22:28:10'),
(56, 'Nom484', 'Prenom40', '1968-12-04', '$2y$10$Ht9FEED12Ll8mTqdN7kOPuK3dB5vFnbyu/K/VxEzEmofuhP3ieK9G', 'prenom40.nom48416@example.com', 'inactif', '78203', '0650333345', 1, 0, '2024-12-16 22:28:11'),
(57, 'Nom882', 'Prenom446', '1964-02-17', '$2y$10$4CGyzs2X/L3v2ga/dLuC7uBOGRNQVRpWPq/18iQF1tfYDsukFy99G', 'prenom446.nom88218@example.com', 'inactif', '89195', '0612863045', 1, 0, '2024-12-16 22:28:11'),
(58, 'Nom677', 'Prenom27', '1983-07-04', '$2y$10$mGe52PRwYhgSfNUn.IvLmeXRlLToK.VeVUxfiWmWy3rCZmAuLIPdG', 'prenom27.nom67778@example.com', 'inactif', '36097', '0681468590', 1, 0, '2024-12-16 22:28:11'),
(59, 'Nom547', 'Prenom902', '1980-02-21', '$2y$10$5L7n7svvyII7t5Rj.hZB5e2/JBBoHfm8/c14j6SSxpVa9x44vww3i', 'prenom902.nom54789@example.com', 'inactif', '31571', '0670868892', 1, 0, '2024-12-16 22:28:11'),
(60, 'Nom162', 'Prenom438', '1993-08-04', '$2y$10$ywkYdExNTFuKYGI5O.bUSu5EXItq7naOcPeBaeDNQ.l/G2gFdwOBi', 'prenom438.nom16234@example.com', 'inactif', '37539', '0610675190', 1, 0, '2024-12-16 22:28:11'),
(61, 'Nom817', 'Prenom977', '1992-02-24', '$2y$10$sGd3j22lthqw5tUWcb.qCelPH4L4wqIZ.wsJOAIEBiiEMkGgz6IH6', 'prenom977.nom81729@example.com', 'inactif', '85764', '0649902763', 1, 0, '2024-12-16 22:28:11'),
(62, 'Nom399', 'Prenom793', '1999-07-24', '$2y$10$utlrbfpqPLrd09a/TSguEefz7NcIUgN6w9O/HVgdqJC4wCFPGqFy6', 'prenom793.nom39914@example.com', 'inactif', '62298', '0612951143', 1, 0, '2024-12-16 22:28:11'),
(63, 'Nom67', 'Prenom19', '1982-08-17', '$2y$10$lBsCuGsOVP.SLid9kLbT4e/XOQthw2lssPIQYS/0ED45KXIXbxaUi', 'prenom19.nom6772@example.com', 'inactif', '90978', '0670663484', 1, 0, '2024-12-16 22:28:11'),
(64, 'Nom343', 'Prenom145', '1965-05-19', '$2y$10$4widL/BpNbnPIAX8YpYA5uisdpdthKXhcgDyBbWGgZdW3viW2IrkK', 'prenom145.nom34369@example.com', 'inactif', '71602', '0654791937', 1, 0, '2024-12-16 22:28:11'),
(65, 'Nom596', 'Prenom917', '1969-06-07', '$2y$10$GKdfMA88k.Z2UIJEAwxndeGjtaqiu.795uiJHlQ4pIZ4zBa3oafvu', 'prenom917.nom5966@example.com', 'inactif', '18287', '0643631867', 1, 0, '2024-12-16 22:28:11'),
(66, 'Nom341', 'Prenom191', '1992-06-25', '$2y$10$KwpPvpQuR0ZyDOmOILiv7uvdVIm5E.dW56Uq/RVmqRqi/Hab0RqVu', 'prenom191.nom34122@example.com', 'inactif', '42565', '0627613111', 1, 0, '2024-12-16 22:28:11'),
(67, 'Nom580', 'Prenom215', '1985-05-16', '$2y$10$7z1wSq7tkWcdbigzGt69R.GtHtmUyVVV4UtONBtCXU2ytfkJum0cO', 'prenom215.nom58038@example.com', 'inactif', '21200', '0697685700', 1, 0, '2024-12-16 22:28:11'),
(68, 'Nom56', 'Prenom80', '1996-08-24', '$2y$10$XjCWYnEg5nE/thAcSNjWSe2/uXgGz8P/1yqW0gfxpUPgxweiyJnSu', 'prenom80.nom5694@example.com', 'inactif', '63171', '0679739946', 1, 0, '2024-12-16 22:28:11'),
(69, 'vital', 'Prenom897', '1979-06-22', '$2y$10$bNUU7bIw4A7HToDeakUQc.hp77fHvOyRU5m//ZNLgENOIxrvNGQg6', 'prenom897.nom12299@example.com', 'inactif', '96295', '0683628744', 1, 0, '2024-12-17 09:17:03'),
(70, 'Nom461', 'Prenom853', '1994-11-13', '$2y$10$.i8UBuTs6Bac7JhPYt5Ufeh4VtJQjlzNld7v2ZfL1fRQ1Ee10QMxm', 'prenom853.nom46170@example.com', 'inactif', '13410', '0639503442', 1, 0, '2024-12-16 22:28:12'),
(71, 'Nom271', 'Prenom912', '1972-12-26', '$2y$10$Jlsp5G7leN6rTiBssaCXHOf68fXCyqVt9AK3Xdqd3yVoybz4ExaP2', 'prenom912.nom27193@example.com', 'inactif', '13811', '0682062650', 1, 0, '2024-12-16 22:28:12'),
(72, 'Nom825', 'Prenom761', '1970-03-14', '$2y$10$14WOKBaJE4.ia4bq/7M7QesSq5mA58siphqmshWq12JBboTlczm/S', 'prenom761.nom82584@example.com', 'inactif', '31049', '0681425681', 1, 0, '2024-12-16 22:28:12'),
(73, 'Nom264', 'Prenom971', '1983-07-20', '$2y$10$z018lavKHkFhCzikbWxwcutTA5mnG8VODOjrILoxc.oer6f84ICWq', 'prenom971.nom26425@example.com', 'inactif', '71754', '0621485494', 1, 0, '2024-12-16 22:28:12'),
(74, 'Nom631', 'Prenom446', '1969-08-05', '$2y$10$IVlrFy9kP/EUr1ivZDJfCe9XfgNfIUTKsIAmUW2JQD6NEBW9Ze1iG', 'prenom446.nom63163@example.com', 'inactif', '87801', '0626133022', 1, 0, '2024-12-16 22:28:12'),
(75, 'Nom592', 'Prenom490', '1962-10-26', '$2y$10$dTiEVwa/Gsik0hjjD68d8ebmP5sHmCNcaL8uB3j7JbnziNtccr7ja', 'prenom490.nom59233@example.com', 'inactif', '90545', '0648541335', 1, 0, '2024-12-16 22:28:12'),
(76, 'Nom541', 'Prenom875', '1974-07-22', '$2y$10$8jl4qn/V9zkPTB7VYQqf3uj4C0PLcLNjlKVKitDwasR8GiqG7Dkxe', 'prenom875.nom54163@example.com', 'inactif', '49335', '0600809566', 1, 0, '2024-12-16 22:28:12'),
(77, 'Nom736', 'Prenom763', '1977-12-11', '$2y$10$PfSsZDAPgD2P0hXUy17DEuy/xHKJYXK1nE7pr3zLDU7Wj9ogumkzK', 'prenom763.nom73686@example.com', 'inactif', '50060', '0626630388', 1, 0, '2024-12-16 22:28:12'),
(78, 'Nom40', 'Prenom286', '1991-03-17', '$2y$10$eWgGPshyVEJLPHYwkStqtexkdGZ8I1uvOQKSrC514fV.mlGQ/0xay', 'prenom286.nom4016@example.com', 'inactif', '66285', '0617024957', 1, 0, '2024-12-16 22:28:12'),
(79, 'Nom214', 'Prenom390', '1973-08-22', '$2y$10$t89YQHKzyf6eifZ4qfWO4eQIdjCaCGt9lfD2UXlPLxCvYQ.ofjYXW', 'prenom390.nom21465@example.com', 'inactif', '33499', '0676359874', 1, 0, '2024-12-16 22:28:12'),
(80, 'Nom826', 'Prenom267', '1970-10-04', '$2y$10$ug76pgbvbfz6aljjc6ayxuKjl1ThoYsQ4mqIGu1lvHm7JymaMshHi', 'prenom267.nom82615@example.com', 'inactif', '25811', '0661935755', 1, 0, '2024-12-16 22:28:12'),
(81, 'Nom612', 'Prenom855', '1985-09-21', '$2y$10$kEfcU/r8wXHUQrNNDIO1ze4WkTexVxQmtJ1.ofbD5HKOLISg0mw6O', 'prenom855.nom61297@example.com', 'inactif', '17614', '0657617738', 1, 0, '2024-12-16 22:28:12'),
(82, 'Nom924', 'Prenom280', '1998-04-02', '$2y$10$AgkZKBSmfOt713ivUCkrf.5RKGWQmQf8IWlSZhhnS/G5B.mYIKMIG', 'prenom280.nom92469@example.com', 'inactif', '91509', '0609208818', 1, 0, '2024-12-16 22:28:12'),
(83, 'Nom329', 'Prenom186', '1974-09-25', '$2y$10$1J2wIb9U1j.sCjrQeUh3z.gYTdSmrzYf5SHjE21/ApU8YR6ST1Ebm', 'prenom186.nom32943@example.com', 'inactif', '89102', '0625790690', 1, 0, '2024-12-16 22:28:13'),
(84, 'Nom299', 'Prenom325', '1964-12-13', '$2y$10$ZJ6cxThV9m9q5ggahj0ttumyOanivGGFfkr3sh7dyZtWQ2ZmxfnYq', 'prenom325.nom29954@example.com', 'inactif', '52045', '0644636365', 1, 0, '2024-12-16 22:28:13'),
(85, 'Nom427', 'Prenom505', '1961-08-22', '$2y$10$0Pccjg.3okvYfj2eJTMHxeLKGhRwZdutqczCNQX79JlPajEhd665y', 'prenom505.nom42794@example.com', 'inactif', '13646', '0618141322', 1, 0, '2024-12-16 22:28:13'),
(86, 'Nom722', 'Prenom751', '1964-11-06', '$2y$10$nE7txs3F1vpby8CmeCjToesZMgaTwj7YCjtPHAhsBEVggEFHrKFUW', 'prenom751.nom72258@example.com', 'inactif', '45612', '0685569920', 1, 0, '2024-12-16 22:28:13'),
(87, 'Nom660', 'Prenom706', '1974-02-14', '$2y$10$gPigGSPQZLBYpefaGGk5Ae5qjtcs3wafebVP9zHf6iOpdK/EbOQ0y', 'prenom706.nom66043@example.com', 'inactif', '25516', '0629003059', 1, 0, '2024-12-16 22:28:13'),
(88, 'Nom370', 'Prenom538', '1974-03-05', '$2y$10$MbDb7l2ntV3qurDnj0r6ruBC6Qkyz1dn8AjgLf1RkOQq2NxgG0mdW', 'prenom538.nom3707@example.com', 'inactif', '39527', '0661715760', 1, 0, '2024-12-16 22:28:13'),
(89, 'Nom209', 'Prenom668', '1991-05-05', '$2y$10$aWJhJ6AnUurOweeMk/qjWuUc1LO7Ktx8EogAcAtCJmOFg9n/Ro23u', 'prenom668.nom20978@example.com', 'inactif', '23592', '0629985189', 1, 0, '2024-12-16 22:28:13'),
(90, 'Nom349', 'Prenom393', '1967-06-28', '$2y$10$wOC/zS7.GVO4fJ5tkwyI1O1laMgBt8zb5nuXzxPVMrYRWXnghtyT6', 'prenom393.nom34993@example.com', 'inactif', '79182', '0649217215', 1, 0, '2024-12-16 22:28:13'),
(91, 'Nom48', 'Prenom156', '1982-05-17', '$2y$10$XXfyI/41Tg8jH36apd5TTOu6gmtxjdanNiym.QYw86QKMwh/M7Kdu', 'prenom156.nom4828@example.com', 'inactif', '23637', '0604050353', 1, 0, '2024-12-16 22:28:13'),
(92, 'Nom613', 'Prenom749', '1962-03-14', '$2y$10$puTshzrey/4FAjJpmkP.0eVm8XH7n53G0JF2DISAjmbwi0AGnAb0S', 'prenom749.nom6134@example.com', 'inactif', '13026', '0635067131', 1, 0, '2024-12-16 22:28:13'),
(93, 'Nom434', 'Prenom571', '1989-10-02', '$2y$10$DSJiExcxqfatfXJCQtO1A.GNm2.MzecWanrgau3BpMOiwt.kFPMMO', 'prenom571.nom43496@example.com', 'inactif', '61519', '0624482077', 1, 0, '2024-12-16 22:28:13'),
(94, 'Nom248', 'Prenom606', '1970-06-08', '$2y$10$XVyO.hua.ILWy57CJmU3ueTzmfyrGSRuj9Ra0MSP3sHs2uRjAKLCq', 'prenom606.nom24876@example.com', 'inactif', '43700', '0644582642', 1, 0, '2024-12-16 22:28:13'),
(95, 'Nom537', 'Prenom75', '1977-12-01', '$2y$10$oVCYyRKUN2jLdEza3SbI7u2FVWzWVhd1RBfdr3cWE7IOzW49eN7ey', 'prenom75.nom53778@example.com', 'inactif', '53224', '0617109067', 1, 0, '2024-12-16 22:28:13'),
(96, 'Nom584', 'Prenom180', '1979-04-23', '$2y$10$hZKls4kRvrAqc4ZpBsPfre75nz6uLmH8pbCI.KB7djNkVHnqDw/Uy', 'prenom180.nom58411@example.com', 'inactif', '29893', '0632754369', 1, 0, '2024-12-16 22:28:14'),
(97, 'Nom292', 'Prenom214', '1960-02-05', '$2y$10$Wg5ixVX.9MzJgoHwNPLDBeKdFrgT5.M0OE3MMeYcQRIAQqZgbz6n.', 'prenom214.nom29235@example.com', 'inactif', '56494', '0619370892', 1, 0, '2024-12-16 22:28:14'),
(98, 'Nom454', 'Prenom343', '1962-01-05', '$2y$10$l4u9MU9SSkcDCMQNLjvIFu2noe/NgYzwhtqISuKiFzz38zWeg3ebC', 'prenom343.nom45461@example.com', 'inactif', '16407', '0603032365', 1, 0, '2024-12-16 22:28:14'),
(99, 'Marinedd', 'Prenom74dd', '1966-05-12', '$2y$10$ANheuqr.WAEAP2ZdS4gLK.MC.mP2r7SKIWvzIE.qpDm9m6pretn6i', 'prenom3d43.nom45461@example.com', 'inactif', '47322', '0670570103', 1, 0, '2024-12-17 13:30:49');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `avis`
--
ALTER TABLE `avis`
  ADD PRIMARY KEY (`id_avis`),
  ADD KEY `id_events` (`id_events`),
  ADD KEY `id_users` (`id_users`);

--
-- Index pour la table `cat_events`
--
ALTER TABLE `cat_events`
  ADD PRIMARY KEY (`id_cat_events`);

--
-- Index pour la table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id_events`),
  ADD KEY `events_ibfk_1` (`id_cat_events`),
  ADD KEY `id_lieux` (`id_lieux`);

--
-- Index pour la table `lieux`
--
ALTER TABLE `lieux`
  ADD PRIMARY KEY (`id_lieux`);

--
-- Index pour la table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id_permissions`);

--
-- Index pour la table `permission_roles`
--
ALTER TABLE `permission_roles`
  ADD PRIMARY KEY (`id_permission_roles`),
  ADD KEY `id_permissions` (`id_permissions`),
  ADD KEY `id_roles` (`id_roles`);

--
-- Index pour la table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id_reservations`),
  ADD KEY `id_events` (`id_events`),
  ADD KEY `id_users` (`id_users`);

--
-- Index pour la table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_roles`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_users`),
  ADD KEY `id_roles` (`id_roles`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `avis`
--
ALTER TABLE `avis`
  MODIFY `id_avis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `cat_events`
--
ALTER TABLE `cat_events`
  MODIFY `id_cat_events` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `events`
--
ALTER TABLE `events`
  MODIFY `id_events` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `lieux`
--
ALTER TABLE `lieux`
  MODIFY `id_lieux` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id_permissions` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `permission_roles`
--
ALTER TABLE `permission_roles`
  MODIFY `id_permission_roles` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id_reservations` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `roles`
--
ALTER TABLE `roles`
  MODIFY `id_roles` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `avis`
--
ALTER TABLE `avis`
  ADD CONSTRAINT `avis_ibfk_1` FOREIGN KEY (`id_events`) REFERENCES `events` (`id_events`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `avis_ibfk_2` FOREIGN KEY (`id_users`) REFERENCES `users` (`id_users`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`id_cat_events`) REFERENCES `cat_events` (`id_cat_events`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `events_ibfk_2` FOREIGN KEY (`id_lieux`) REFERENCES `lieux` (`id_lieux`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `permission_roles`
--
ALTER TABLE `permission_roles`
  ADD CONSTRAINT `permission_roles_ibfk_1` FOREIGN KEY (`id_permissions`) REFERENCES `permissions` (`id_permissions`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permission_roles_ibfk_2` FOREIGN KEY (`id_roles`) REFERENCES `roles` (`id_roles`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`id_events`) REFERENCES `events` (`id_events`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservations_ibfk_2` FOREIGN KEY (`id_users`) REFERENCES `users` (`id_users`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_roles`) REFERENCES `roles` (`id_roles`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
