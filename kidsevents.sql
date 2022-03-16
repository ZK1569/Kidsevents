-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 16 mars 2022 à 14:22
-- Version du serveur : 10.4.21-MariaDB
-- Version de PHP : 8.0.10

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
('DoctrineMigrations\\Version20220301125813', '2022-03-01 13:58:29', 423),
('DoctrineMigrations\\Version20220314123200', '2022-03-14 13:39:03', 58),
('DoctrineMigrations\\Version20220316085142', '2022-03-16 09:52:19', 83);

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
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `themes`
--

INSERT INTO `themes` (`id`, `intitule`, `descriptif`, `duree`, `prix`, `age_min`, `age_max`, `nbenfant_min`, `nbenfant_max`, `image`, `slug`) VALUES
(141, 'chevalier', 'Le chevalier est un combattant à cheval. Le titre de chevalier est un titre honorifique militaire donné par un monarque ou un autre chef politique. Historiquement, en Europe, la chevalerie était constituée de guerriers à cheval et de chevaleresses. Au cours du Haut Moyen Âge, la chevalerie était considérée comme une classe de noblesse inférieure. À la fin du Moyen Âge, le rang est associé aux idéaux de la chevalerie. Ces idéaux constituent alors un code de conduite pour le parfait guerrier chrétien courtois. Souvent, le chevalier était un vassal qui servait de combattant pour un suzerain, avec un paiement sous forme de propriétés foncières.', 5, 1500, 5, 18, 3, 8, 'chevalier.jpeg', 'chevalier'),
(142, 'cowboy', 'Le cow-boy ou cowboy, de l\'anglais cow, « vache », et boy, « garçon »), qui signifie « vacher » ou « bouvier » en français, est un garçon de ferme s\'occupant du bétail bovin dans les pays anglo-saxons de grands espaces comme le Far West américain et l\'Outback australien.', 4, 1600, 2, 16, 2, 5, 'cowboy.jpg', 'cowboy'),
(143, 'pirate', 'La piraterie est une forme de banditisme pratiquée sur mer par des marins appelés pirates. Cependant, les pirates ne se limitent pas aux pillages de navire, mais attaquent parfois de petites villes côtières.', 8, 1800, 6, 21, 3, 10, 'pirate.jpg', 'pirate'),
(144, 'princesse', 'Princesse est un titre attribué soit à l\'épouse d\'un prince, soit à la fille d\'un roi ou d\'un autre souverain régnant, soit à une femme souveraine d\'une principauté. Il s\'agit de l\'équivalent féminin de prince (venant du latin princeps, signifiant « premier »)', 6, 1500, 2, 25, 2, 10, 'princesse.jpeg', 'princesse'),
(145, 'viking', 'Les Vikings (en vieux norrois : víkingr, au pluriel víkingar) sont des explorateurs, commerçants, pillards mais aussi pirates scandinaves au cours d’une période s’étendant du viiie au xie siècle, communément nommée « âge des Vikings ». Par extension, on emploie le terme en français pour désigner la civilisation scandinave de l\'âge du fer tardif, c\'est-à-dire à partir de la fin du iie siècle à l\'âge du fer romain (en). Ils sont souvent appelés Normands, c\'est-à-dire étymologiquement « hommes du Nord », dans la bibliographie ancienne', 9, 2000, 7, 25, 3, 10, 'viking.jpg', 'viking'),
(146, 'star wars', 'Star Wars ([stɑɹ wɔɹz]; à l\'origine nommée sous son titre français, La Guerre des étoiles) est un univers de science-fiction créé par George Lucas. D\'abord conçue comme une trilogie cinématographique sortie entre 1977 et 1983, la saga s\'accroît ensuite, entre 1999 et 2005, de trois nouveaux films, qui racontent des événements antérieurs à la première trilogie. Cette dernière (épisodes IV, V et VI) ainsi que la deuxième trilogie dite « Prélogie » (épisodes I, II et III) connaissent un immense succès commercial et un accueil critique généralement positif. Dans un souci de cohérence, et pour atteindre un résultat qu\'il n\'avait pas pu obtenir dès le départ, le créateur de la saga retravaille également les films de sa première trilogie, ressortis en 1997 et 2004 dans de nouvelles versions.', 2, 150, 2, 5, 2, 5, 'star.jpg', 'star_wars'),
(187, 'Pokemon', 'Pokémon Wiki est originellement une création de FPU. À l\'image de Bulbapedia, qui est un sous-projet de Bulbagarden, Pokémon Wiki est tout d\'abord d\'une extension du site Pokémon Republic, et était alors connu comme le Pokémon Republic Wiki. Cependant, il finit par gagner son indépendance, son nom se transformant en Pokémon Wiki.', 4, 160, 2, 3, 2, 5, 'pokemon.jpg', 'pokemon');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `first_name`, `last_name`, `phone`, `address`) VALUES
(7, 'admin@gmail.com', '[\"ROLE_ADMIN\"]', '$2y$13$T9z1tT0lDB48LJMkWqIjjeP44IqX3OycYYXzxhD8YTqUIgPl2OVNm', 'admin', 'nimda', '0666006600', 'EveryWere'),
(8, 'cristian.ursu.2001@gmail.com', '[]', '$2y$13$QZDOaPD5vnjYZRmfukM7wOvy81GoXDtm2pJ4w15ZDrsbg7D2RM6iu', 'Cristian', 'URSU', '0695332229', '33 rue des lilas 95150');

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
-- Index pour la table `themes`
--
ALTER TABLE `themes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `themes`
--
ALTER TABLE `themes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=188;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
