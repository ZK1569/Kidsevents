-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 07 mars 2022 à 12:12
-- Version du serveur : 10.4.22-MariaDB
-- Version de PHP : 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `kidsevents`
--

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20220207134500', '2022-02-09 09:55:49', 1007),
('DoctrineMigrations\\Version20220301125813', '2022-03-01 13:58:29', 423);

-- --------------------------------------------------------

--
-- Structure de la table `options`
--

CREATE TABLE `options` (
  `id` int(11) NOT NULL,
  `intitule` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descriptif` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `prix` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `options`
--

INSERT INTO `options` (`id`, `intitule`, `descriptif`, `prix`) VALUES
(1, 'bite', 'remplissage/20', 15),
(2, 'Ski', 'Descente de pistes nu(e) ou en tenue licorne arc-en-ciel (cherche pas y\'a pas le choix)', 0.99),
(3, 'machin2', 'remplissage/18', 17),
(4, 'machin3', 'remplissage/17', 18),
(5, 'machin4', 'remplissage/16', 19),
(6, 'machin5', 'remplissage/15', 20),
(7, 'machin6', 'remplissage/14', 21),
(8, 'machin7', 'remplissage/13', 22),
(9, 'machin8', 'remplissage/12', 23),
(10, 'machin9', 'remplissage/11', 24),
(11, 'machin10', 'remplissage/10', 25),
(12, 'machin11', 'remplissage/9', 26),
(13, 'machin12', 'remplissage/8', 27),
(14, 'machin13', 'remplissage/7', 28),
(15, 'machin14', 'remplissage/6', 29),
(16, 'machin15', 'remplissage/5', 30),
(17, 'machin16', 'remplissage/4', 31),
(18, 'machin17', 'remplissage/3', 32),
(19, 'machin18', 'remplissage/2', 33),
(20, 'machin19', 'remplissage/1', 34),
(21, 'machin20', 'remplissage/0', 35),
(22, 'roule le dragon', 'assaut d\'un anniversaire de princesse où l\'on peut allégrement casser la gueule des gamines', 7);

-- --------------------------------------------------------

--
-- Structure de la table `reservations`
--

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
  `theme_id` int(11) NOT NULL,
  `nbenfants` int(11) NOT NULL,
  `date` date NOT NULL,
  `prix` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `reservations_options`
--

CREATE TABLE `reservations_options` (
  `reservations_id` int(11) NOT NULL,
  `options_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `reservations_users`
--

CREATE TABLE `reservations_users` (
  `reservations_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `themes`
--

CREATE TABLE `themes` (
  `id` int(11) NOT NULL,
  `intitule` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descriptif` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `duree` int(11) NOT NULL,
  `prix` double NOT NULL,
  `age_min` int(11) NOT NULL,
  `age_max` int(11) NOT NULL,
  `nbenfant_min` int(11) NOT NULL,
  `nbenfant_max` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `themes`
--

INSERT INTO `themes` (`id`, `intitule`, `descriptif`, `duree`, `prix`, `age_min`, `age_max`, `nbenfant_min`, `nbenfant_max`, `image`) VALUES
(1, 'les pokomons là', 'Un jour je serai le meilleur dresseur\nJe me battrai sans répit\nJe ferai tout pour être vainqueur\nEt gagner les défis\nJe parcourrai la terre entière\nTraquant avec espoir\nLes Pokémon et leurs mystères\nLe secret de leurs pouvoirUn jour je serai le meilleur dresseur\nJe me battrai sans répit\nJe ferai tout pour être vainqueur\nEt gagner les défis\nJe parcourrai la terre entière\nTraquant avec espoir\nLes Pokémon et leurs mystères\nLe secret de leurs pouvoirs', 22300, 69.99, 7, 77, 1, 6, 'pokemon.jpg'),
(2, 'chevalier', 'L\'histoire est racontée dans un style anachronique avec de nombreuses références modernes. On y suit un paysan qui se fait passer pour un noble chevalier et devient un champion de joute, montrant comment un individu d\'extraction modeste peut être anobli pour son courage et sa générosité.\n\nLe film tire son titre original du Conte du chevalier, faisait partie du recueil Les Contes de Canterbury de Geoffrey Chaucer, écrivain et poète des années 1340 que l\'on retrouve parmi les personnages du film. L\'intrigue du film est cependant différente.\n\n', 2, 13, 8, 12, 12, 27, 'chevalier.jpeg'),
(3, 'lucky luke', 'La série met en scène Lucky Luke, cow-boy solitaire au Far West, connu pour être « L\'homme qui tire plus vite que son ombre », accompagné par son cheval Jolly Jumper et de temps en temps par le chien Rantanplan. Lors de ses aventures, il doit rétablir la justice dans le Far West en pourchassant des bandits dont les plus connus sont les frères Dalton. La série est truffée d\'éléments humoristiques qui parodient les œuvres de western.\n\n', 81, 71, 9, 13, 13, 28, 'cowboy.jpg'),
(4, 'tipiak', 'La piraterie est une forme de banditisme pratiquée sur mer par des marins appelés pirates. Cependant, les pirates ne se limitent pas aux pillages de navire, mais attaquent parfois de petites villes côtières.\n\n', 5, 72, 10, 14, 14, 29, 'pirate.jpg'),
(5, 'disney', 'blablabla5', 6, 73, 11, 15, 15, 30, 'princesse.jpeg'),
(6, 'starwars', 'blablabla6', 7, 74, 12, 16, 16, 31, 'star.jpg'),
(7, 'pirates froids', 'Valhalla vient du vieux norrois Valhǫll composé de valr, désignant les guerriers morts sur le champ de bataille, et hǫll, la halle 1. Toujours selon les notes de l\'Edda de Snorri, ce dernier mot peut également désigner « le palais » ou un grand bâtiment d\'une seule pièce où se tenait la cour de Norvège (voir ainsi la Håkonshalle, « halle de Håkon », à Bergen). Valhalle en est la forme francisée.\n\n', 8, 75, 13, 17, 17, 32, 'viking.jpg'),
(8, 'truc8', 'blablabla8', 9, 76, 14, 18, 18, 33, '8.png'),
(9, 'truc9', 'blablabla9', 10, 77, 15, 19, 19, 34, '9.png'),
(10, 'truc10', 'blablabla10', 11, 78, 16, 20, 20, 35, '10.png'),
(11, 'truc11', 'blablabla11', 12, 79, 17, 21, 21, 36, '11.png'),
(12, 'truc12', 'blablabla12', 13, 80, 18, 22, 22, 37, '12.png'),
(13, 'truc13', 'blablabla13', 14, 81, 19, 23, 23, 38, '13.png'),
(14, 'truc14', 'blablabla14', 15, 82, 20, 24, 24, 39, '14.png'),
(15, 'truc15', 'blablabla15', 16, 83, 21, 25, 25, 40, '15.png'),
(16, 'truc16', 'blablabla16', 17, 84, 22, 26, 26, 41, '16.png'),
(17, 'truc17', 'blablabla17', 18, 85, 23, 27, 27, 42, '17.png'),
(18, 'truc18', 'blablabla18', 19, 86, 24, 28, 28, 43, '18.png'),
(19, 'truc19', 'blablabla19', 20, 87, 25, 29, 29, 44, '19.png'),
(20, 'truc20', 'blablabla20', 21, 88, 26, 30, 30, 45, '20.png');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `motdepasse` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `identifiant` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(14) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `interet` tinyint(1) NOT NULL,
  `admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `nom`, `prenom`, `motdepasse`, `identifiant`, `adresse`, `telephone`, `mail`, `interet`, `admin`) VALUES
(1, 'françois', 'france', 'Vivelarépublik', '#Zemmour', 'FRANCE', '06 00 00 00 00', 'email0@email.fr', 1, 0),
(2, 'Wolfeschlegelsteinhausenbergerdorff', 'Hubert Blaine', 'mdp1', 'HBWolfeschlegelsteinhausenbergerdorff', 'allemagne', '', 'email1@email.com', 0, 1),
(3, 'nom2', 'prenom2', 'mdp2', 'identifiant2', '2 rue', '06 00 00 00 02', 'email2@email.com', 1, 0),
(4, 'nom3', 'prenom3', 'mdp3', 'identifiant3', '3 rue', '06 00 00 00 03', 'email3@email.com', 0, 0),
(5, 'nom4', 'prenom4', 'mdp4', 'identifiant4', '4 rue', '06 00 00 00 04', 'email4@email.com', 0, 0),
(6, 'nom5', 'prenom5', 'mdp5', 'identifiant5', '5 rue', '06 00 00 00 05', 'email5@email.com', 0, 0),
(7, 'nom6', 'prenom6', 'mdp6', 'identifiant6', '6 rue', '06 00 00 00 06', 'email6@email.com', 0, 0),
(8, 'nom7', 'prenom7', 'mdp7', 'identifiant7', '7 rue', '06 00 00 00 07', 'email7@email.com', 0, 0),
(9, 'nom8', 'prenom8', 'mdp8', 'identifiant8', '8 rue', '06 00 00 00 08', 'email8@email.com', 0, 0),
(10, 'nom9', 'prenom9', 'mdp9', 'identifiant9', '9 rue', '06 00 00 00 09', 'email9@email.com', 0, 0),
(11, 'nom10', 'prenom10', 'mdp10', 'identifiant10', '10 rue', '06 00 00 00 10', 'email10@email.com', 0, 0),
(12, 'nom11', 'prenom11', 'mdp11', 'identifiant11', '11 rue', '06 00 00 00 11', 'email11@email.com', 0, 0),
(13, 'nom12', 'prenom12', 'mdp12', 'identifiant12', '12 rue', '06 00 00 00 12', 'email12@email.com', 0, 0),
(14, 'nom13', 'prenom13', 'mdp13', 'identifiant13', '13 rue', '06 00 00 00 13', 'email13@email.com', 0, 0),
(15, 'nom14', 'prenom14', 'mdp14', 'identifiant14', '14 rue', '06 00 00 00 14', 'email14@email.com', 0, 0),
(16, 'nom15', 'prenom15', 'mdp15', 'identifiant15', '15 rue', '06 00 00 00 15', 'email15@email.com', 0, 0),
(17, 'nom16', 'prenom16', 'mdp16', 'identifiant16', '16 rue', '06 00 00 00 16', 'email16@email.com', 0, 0),
(18, 'nom17', 'prenom17', 'mdp17', 'identifiant17', '17 rue', '06 00 00 00 17', 'email17@email.com', 0, 0),
(19, 'nom18', 'prenom18', 'mdp18', 'identifiant18', '18 rue', '06 00 00 00 18', 'email18@email.com', 0, 0),
(20, 'nom19', 'prenom19', 'mdp19', 'identifiant19', '19 rue', '06 00 00 00 19', 'email19@email.com', 0, 0),
(21, 'nom20', 'prenom20', 'mdp20', 'identifiant20', '20 rue', '06 00 00 00 20', 'email20@email.com', 0, 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_4DA23959027487` (`theme_id`);

--
-- Index pour la table `reservations_options`
--
ALTER TABLE `reservations_options`
  ADD PRIMARY KEY (`reservations_id`,`options_id`),
  ADD KEY `IDX_5D0D8859D9A7F869` (`reservations_id`),
  ADD KEY `IDX_5D0D88593ADB05F1` (`options_id`);

--
-- Index pour la table `reservations_users`
--
ALTER TABLE `reservations_users`
  ADD PRIMARY KEY (`reservations_id`,`users_id`),
  ADD KEY `IDX_DE575306D9A7F869` (`reservations_id`),
  ADD KEY `IDX_DE57530667B3B43D` (`users_id`);

--
-- Index pour la table `themes`
--
ALTER TABLE `themes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_1483A5E95126AC48` (`mail`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `options`
--
ALTER TABLE `options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT pour la table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `themes`
--
ALTER TABLE `themes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `FK_4DA23959027487` FOREIGN KEY (`theme_id`) REFERENCES `themes` (`id`);

--
-- Contraintes pour la table `reservations_options`
--
ALTER TABLE `reservations_options`
  ADD CONSTRAINT `FK_5D0D88593ADB05F1` FOREIGN KEY (`options_id`) REFERENCES `options` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_5D0D8859D9A7F869` FOREIGN KEY (`reservations_id`) REFERENCES `reservations` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `reservations_users`
--
ALTER TABLE `reservations_users`
  ADD CONSTRAINT `FK_DE57530667B3B43D` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_DE575306D9A7F869` FOREIGN KEY (`reservations_id`) REFERENCES `reservations` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
