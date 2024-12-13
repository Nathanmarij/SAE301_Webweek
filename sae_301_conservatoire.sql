-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 13 déc. 2024 à 10:19
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
  `description` int(11) NOT NULL,
  `date_creation` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_events` int(11) NOT NULL,
  `id_users` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(1, 'Concert Rock', '2024-12-15 00:00:00', 'Un concert de rock avec des groupes locaux.', 'gratuit', 'concert_rock', 'concert_rock.jpg', 100, 0, '2024-12-12 09:13:31', 1, 1),
(2, 'Exposition Art Contemporain', '2024-12-20 00:00:00', 'Exposition des œuvres d\'art contemporain.', 'gratuit', 'exposition_art', 'exposition_art.jpg', 50, 0, '2024-12-12 09:13:37', 2, 2),
(3, 'Atelier Cuisine', '2024-12-25 00:00:00', 'Un atelier de cuisine pour apprendre des recettes de Noël.', 'gratuit', 'atelier_cuisine', 'atelier_cuisine.jpg', 20, 0, '2024-12-12 09:13:48', 3, 3),
(4, 'Conférence Technologie', '2025-01-05 00:00:00', 'Une conférence sur les dernières tendances en matière de technologie.', 'gratuit', 'conference_tech', 'conference_tech.jpg', 200, 0, '2024-12-12 09:13:44', 4, 1),
(5, 'Festival de Musique', '2025-02-10 00:00:00', 'Festival avec plusieurs concerts et activités musicales.', 'gratuit', 'festival_musique', 'festival_musique.jpg', 500, 0, '2024-12-12 09:13:41', 2, 2);

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
  `p_conn` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `d_conn` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id_users`, `nom`, `prenom`, `date_naissance`, `mdp`, `mail`, `statut_compte`, `code_verification`, `telephone`, `id_roles`, `p_conn`, `d_conn`) VALUES
(37, 'DASSi', 'Vital', '2025-01-01', '$2y$10$SsTo9Lb6Gjr4jJMGy36BWuhmzLc0VDVQQeL2rF0vL14hwcod7sayi', 'dassivital@gmail.com', 'actif', '11111', '0745229722', 1, '2024-12-13 01:07:58', '2024-12-13 01:07:58'),
(38, 'Nathan', 'Nathan7@.nath', '2024-12-26', '$2y$10$4ncp1r8PRhXsiZOgkIvH8eMO4PTS8bg0WZFA4eYhiQPcXcZJXjJ8G', 'nathan@gmail.com', 'actif', '11111', '07070707', 1, '2024-12-13 08:23:49', '2024-12-13 08:23:49'),
(39, 'vv', 'vvv', '2024-12-12', '$2y$10$UE4qyvNrX63aXybn.ojCA.cJ1uudy93GnRoev7nK6AAJWhkpHiXvK', 'fdfdf@dfdf.df', 'inactif', '97366', '0102010202', 1, '2024-12-13 08:34:46', '2024-12-13 08:34:46'),
(40, 'Nathan7@.nath', 'Nathan7@.nath', '2024-12-21', '$2y$10$CvW5pSr3/RWh6JM/Ykz65efBzq4YreV6d52UXisbN2/ofFvFCNpKG', 'dddf@ffd.fd', 'inactif', '57623', '85858585', 1, '2024-12-13 08:37:48', '2024-12-13 08:37:48'),
(41, 'Nathan7@.nath', 'Nathan7@.nath', '2025-01-04', '$2y$10$YVwW5B/35OeXIDm1Or./tuaGajFaPPXYB3e5ndIaXMekyBhNFtmxi', 'Nathan7@dffddf.df', 'actif', '11111', '547545454', 1, '2024-12-13 08:39:42', '2024-12-13 08:39:42');

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
  MODIFY `id_avis` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

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
