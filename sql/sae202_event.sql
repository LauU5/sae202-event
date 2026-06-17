-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : lun. 15 juin 2026 à 22:26
-- Version du serveur : 10.11.14-MariaDB-0+deb12u2
-- Version de PHP : 8.2.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `sae202_event`
--

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

CREATE TABLE `commentaires` (
  `id_commentaire` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `contenu` text NOT NULL,
  `statut` enum('en_attente','approuve','refuse') DEFAULT 'en_attente',
  `date_publication` datetime DEFAULT current_timestamp(),
  `note` int(11) NOT NULL DEFAULT 5
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `commentaires`
--

INSERT INTO `commentaires` (`id_commentaire`, `id_utilisateur`, `contenu`, `statut`, `date_publication`, `note`) VALUES
(1, 1, 'bhfsdrfdghlfvdgqhgfgsdhilfgvdsqbhk', 'approuve', '2026-06-10 20:45:24', 2),
(2, 3, 'jdsjsvbvsjvsiu', 'approuve', '2026-06-14 10:07:17', 5),
(3, 4, 'C&#039;était génial et c&#039;est nous qui l&#039;avons fait !', 'approuve', '2026-06-14 19:27:58', 5),
(4, 4, 'Testtesttesttest', 'approuve', '2026-06-14 19:28:49', 5),
(5, 4, 'testtesttesttesttesttesttestest', 'approuve', '2026-06-14 19:29:02', 5),
(6, 4, 'dhfdqzwsuifqevwyuhj', 'approuve', '2026-06-15 13:16:08', 5),
(7, 4, 'dhfdqzwsuifqevwyuhj', 'approuve', '2026-06-15 13:23:43', 5),
(8, 4, 'J&#039;aime bien mais le site est pas fini :(', 'approuve', '2026-06-15 13:25:38', 3);

-- --------------------------------------------------------

--
-- Structure de la table `equipes`
--

CREATE TABLE `equipes` (
  `id_equipe` int(11) NOT NULL,
  `nom_equipe` varchar(100) NOT NULL,
  `date_creation` datetime DEFAULT current_timestamp(),
  `nb_participants` int(11) NOT NULL DEFAULT 1,
  `type_menu` varchar(50) NOT NULL DEFAULT 'Menu classique',
  `options_accessibilite` text DEFAULT NULL,
  `id_session` int(11) DEFAULT NULL,
  `score_obtenu` int(11) DEFAULT NULL,
  `score` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `equipes`
--

INSERT INTO `equipes` (`id_equipe`, `nom_equipe`, `date_creation`, `nb_participants`, `type_menu`, `options_accessibilite`, `id_session`, `score_obtenu`, `score`) VALUES
(1, 'slay', '2026-06-10 20:41:25', 4, 'Menu Framed', 'hahaha', 1, 500, 0),
(2, 'jhuyhdfdgfd', '2026-06-11 20:25:46', 2, 'Menu Framed', 'fdfgdsf', 2, NULL, 0),
(3, 'jjfd', '2026-06-12 10:13:36', 2, 'Menu Framed', ':kjgfyg', 1, NULL, 0),
(4, 'kklkkkdk', '2026-06-12 10:17:45', 3, 'Menu Végétarien', 'vnhsdvds', 2, NULL, 0),
(5, 'Okapi', '2026-06-14 19:25:22', 5, 'Menu classique', '', 2, 240, 0),
(6, 'Nice team', '2026-06-15 09:10:55', 2, 'Menu Framed', 'Halal', 3, NULL, 0),
(7, 'HDUZ', '2026-06-15 10:04:37', 1, 'Menu classique', 'JOIZD', 3, 280, 0);

-- --------------------------------------------------------

--
-- Structure de la table `membres_equipe`
--

CREATE TABLE `membres_equipe` (
  `id_membre` int(11) NOT NULL,
  `id_equipe` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `pseudo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `membres_equipe`
--

INSERT INTO `membres_equipe` (`id_membre`, `id_equipe`, `nom`, `prenom`, `pseudo`) VALUES
(1, 1, 'tom', 'tom', 'tim'),
(2, 1, 'tim', 'tim', 'tom'),
(3, 1, 'tam', 'tam', 'tem'),
(4, 4, 'nfnf', 'nbcbbv', 'dhdhd'),
(5, 5, '2', 'poil caca', '2'),
(6, 5, '2', '2', '2'),
(7, 5, '2', '2', '2'),
(8, 5, '2', '2', '2'),
(9, 6, 'Hanouna', 'Cyril', 'Snuss');

-- --------------------------------------------------------

--
-- Structure de la table `messages_admin`
--

CREATE TABLE `messages_admin` (
  `id_message` int(11) NOT NULL,
  `sujet` varchar(255) NOT NULL,
  `contenu` text NOT NULL,
  `date_envoi` datetime DEFAULT current_timestamp(),
  `est_lu` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `sessions`
--

CREATE TABLE `sessions` (
  `id_session` int(11) NOT NULL,
  `date_session` datetime NOT NULL,
  `est_complete` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `sessions`
--

INSERT INTO `sessions` (`id_session`, `date_session`, `est_complete`) VALUES
(1, '2026-07-04 19:30:00', 0),
(2, '2026-07-11 19:30:00', 0),
(3, '2026-07-18 19:30:00', 0),
(4, '2026-07-25 19:30:00', 1);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id_utilisateur` int(11) NOT NULL,
  `id_equipe` int(11) NOT NULL,
  `pseudo` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `telephone` varchar(15) DEFAULT NULL,
  `role` enum('participant','admin') DEFAULT 'participant',
  `nom` varchar(50) DEFAULT NULL,
  `prenom` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id_utilisateur`, `id_equipe`, `pseudo`, `email`, `mot_de_passe`, `telephone`, `role`, `nom`, `prenom`) VALUES
(1, 1, 'lulalua', 'laulau@gmail.com', '$2y$10$osokfL0bgMTc2RY0GYzUr.vFqtLVenjxEBtY3Pk0EKYi/yN8Hw2Ia', '02136457789', 'participant', 'kjfdblvfd', 'dfgfdgd'),
(3, 4, 'lkggugu', 'lala@gmail.com', '$2y$10$cChkDLjN.DqJKZCXACGw0.TqcW280Fm.rPtgcFZfK4A.MF7TWDF.C', '031625425', 'participant', 'dvkdsvd', 'sdvsd'),
(4, 5, 'Okapi', 'framedtroyes@gmail.com', '$2y$10$/E1Jl45RSvdUt1maHQcv.uJDXCafpC6zGFgza0z4tTmO67qnoC1t2', '8490184903', 'participant', 'Okapi', 'Okapi mais prénom'),
(5, 6, 'Le Fabito', 'fabrice.eboue@gmail.com', '$2y$10$0.eQM/3NE4WtYNdWXJmWLeb3D01vXHLOxcDLjWIU7GlOZ76RyFGgu', '8904328990', 'participant', 'Eboué', 'Fabrice'),
(6, 7, 'dz', 'zdz', '$2y$10$J8zfX757ZWPNPKukCbffQO6jxWBqcOr84uNdAuvXT3H0/ZabQvGn6', 'd', 'participant', 'dzdz', 'dzdz');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD PRIMARY KEY (`id_commentaire`),
  ADD KEY `id_utilisateur` (`id_utilisateur`);

--
-- Index pour la table `equipes`
--
ALTER TABLE `equipes`
  ADD PRIMARY KEY (`id_equipe`),
  ADD UNIQUE KEY `nom_equipe` (`nom_equipe`),
  ADD KEY `equipes_ibfk_1` (`id_session`);

--
-- Index pour la table `membres_equipe`
--
ALTER TABLE `membres_equipe`
  ADD PRIMARY KEY (`id_membre`),
  ADD KEY `id_equipe` (`id_equipe`);

--
-- Index pour la table `messages_admin`
--
ALTER TABLE `messages_admin`
  ADD PRIMARY KEY (`id_message`);

--
-- Index pour la table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id_session`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id_utilisateur`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `id_equipe` (`id_equipe`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `commentaires`
--
ALTER TABLE `commentaires`
  MODIFY `id_commentaire` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `equipes`
--
ALTER TABLE `equipes`
  MODIFY `id_equipe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `membres_equipe`
--
ALTER TABLE `membres_equipe`
  MODIFY `id_membre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `messages_admin`
--
ALTER TABLE `messages_admin`
  MODIFY `id_message` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `id_session` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id_utilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD CONSTRAINT `commentaires_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateurs` (`id_utilisateur`) ON DELETE CASCADE;

--
-- Contraintes pour la table `equipes`
--
ALTER TABLE `equipes`
  ADD CONSTRAINT `equipes_ibfk_1` FOREIGN KEY (`id_session`) REFERENCES `sessions` (`id_session`) ON DELETE SET NULL;

--
-- Contraintes pour la table `membres_equipe`
--
ALTER TABLE `membres_equipe`
  ADD CONSTRAINT `membres_equipe_ibfk_1` FOREIGN KEY (`id_equipe`) REFERENCES `equipes` (`id_equipe`) ON DELETE CASCADE;

--
-- Contraintes pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD CONSTRAINT `utilisateurs_ibfk_1` FOREIGN KEY (`id_equipe`) REFERENCES `equipes` (`id_equipe`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
