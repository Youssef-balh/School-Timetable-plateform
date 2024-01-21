-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 11 jan. 2023 à 22:46
-- Version du serveur : 10.4.25-MariaDB
-- Version de PHP : 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `projet`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `password` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id_admin`, `id_utilisateur`, `password`) VALUES
(1, 2, '$2y$10$U1pK/8fq83iyHBUfr1WSy.7crPaaXr3LqGvfx1Ttx6D6HDSQj02Pi');

-- --------------------------------------------------------

--
-- Structure de la table `batiment`
--

CREATE TABLE `batiment` (
  `id_batiment` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `batiment`
--

INSERT INTO `batiment` (`id_batiment`) VALUES
('A');

-- --------------------------------------------------------

--
-- Structure de la table `enseignant`
--

CREATE TABLE `enseignant` (
  `id_enseignant` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `enseignant`
--

INSERT INTO `enseignant` (`id_enseignant`, `id_utilisateur`, `nom`, `prenom`) VALUES
(1, 1, 'balhaddade', 'youssef'),
(2, 3, 'boumazzou', 'ibrahim'),
(3, 4, 'aboutafail', 'moulayothman'),
(4, 5, 'Mharzi', 'hassan'),
(5, 6, 'belghiti', 'moulaytaib');

-- --------------------------------------------------------

--
-- Structure de la table `filiere`
--

CREATE TABLE `filiere` (
  `id_filiere` int(11) NOT NULL,
  `id_semestre` int(11) NOT NULL,
  `nom_filiere` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `filiere`
--

INSERT INTO `filiere` (`id_filiere`, `id_semestre`, `nom_filiere`) VALUES
(1, 1, 'cp1'),
(2, 2, 'cp1'),
(3, 3, 'cp2'),
(4, 4, 'cp2'),
(5, 5, 'info'),
(6, 6, 'info'),
(7, 5, 'indus'),
(8, 6, 'indus'),
(9, 5, 'electrique'),
(10, 6, 'electrique'),
(11, 5, 'mecatronique'),
(12, 6, 'mecatronique'),
(13, 5, 'civil'),
(14, 6, 'civil'),
(15, 5, 'reseau'),
(16, 6, 'reseau'),
(17, 7, 'info'),
(18, 8, 'info'),
(19, 7, 'indus'),
(20, 8, 'indus');

-- --------------------------------------------------------

--
-- Structure de la table `groupe`
--

CREATE TABLE `groupe` (
  `id_groupe` int(11) NOT NULL,
  `id_filiere` int(11) NOT NULL,
  `id_semestre` int(11) NOT NULL,
  `type` enum('tp','td','cours') NOT NULL,
  `effectif` int(11) NOT NULL,
  `section` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `groupe`
--

INSERT INTO `groupe` (`id_groupe`, `id_filiere`, `id_semestre`, `type`, `effectif`, `section`) VALUES
(7, 1, 1, 'cours', 120, 'A'),
(8, 1, 1, 'cours', 120, 'A'),
(9, 4, 4, 'cours', 100, 'A'),
(10, 3, 3, 'cours', 100, 'A'),
(11, 5, 5, 'cours', 120, ''),
(12, 6, 6, 'cours', 120, '');

-- --------------------------------------------------------

--
-- Structure de la table `module`
--

CREATE TABLE `module` (
  `id_module` int(11) NOT NULL,
  `id_enseignant` int(11) NOT NULL,
  `id_semestre` int(11) NOT NULL,
  `nom_module` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `module`
--

INSERT INTO `module` (`id_module`, `id_enseignant`, `id_semestre`, `nom_module`) VALUES
(4, 1, 1, 'Analyse'),
(5, 1, 2, 'Mecanique');

-- --------------------------------------------------------

--
-- Structure de la table `module_filiere`
--

CREATE TABLE `module_filiere` (
  `id_module` int(11) NOT NULL,
  `id_filiere` int(11) NOT NULL,
  `id_semestre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `module_filiere`
--

INSERT INTO `module_filiere` (`id_module`, `id_filiere`, `id_semestre`) VALUES
(4, 1, 1),
(5, 2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `notifs`
--

CREATE TABLE `notifs` (
  `id_notifs` int(11) NOT NULL,
  `type` enum('add','remove') NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` varchar(256) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `salle`
--

CREATE TABLE `salle` (
  `id_salle` int(11) NOT NULL,
  `id_batiment` varchar(10) NOT NULL,
  `Capacité` int(11) NOT NULL,
  `type_salle` enum('salle','amphi','Salle Tp','Salle Td') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `salle`
--

INSERT INTO `salle` (`id_salle`, `id_batiment`, `Capacité`, `type_salle`) VALUES
(1, 'A', 100, 'salle'),
(2, 'A', 110, 'salle'),
(3, 'A', 40, 'Salle Tp'),
(4, 'A', 220, 'amphi'),
(15, 'A', 50, 'Salle Tp');

-- --------------------------------------------------------

--
-- Structure de la table `seance`
--

CREATE TABLE `seance` (
  `id_seance` int(11) NOT NULL,
  `id_salle` int(11) NOT NULL,
  `id_groupe` int(11) NOT NULL,
  `id_module` int(11) NOT NULL,
  `id_batiment` varchar(10) NOT NULL,
  `heure_deb` time NOT NULL,
  `heure_fin` time NOT NULL,
  `Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `seance`
--

INSERT INTO `seance` (`id_seance`, `id_salle`, `id_groupe`, `id_module`, `id_batiment`, `heure_deb`, `heure_fin`, `Date`) VALUES
(1, 2, 7, 4, 'A', '14:00:00', '16:00:00', '2023-01-12'),
(2, 4, 8, 5, 'A', '08:30:00', '10:30:00', '2023-01-12');

-- --------------------------------------------------------

--
-- Structure de la table `semestre`
--

CREATE TABLE `semestre` (
  `id_semestre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `semestre`
--

INSERT INTO `semestre` (`id_semestre`) VALUES
(1),
(2),
(3),
(4),
(5),
(6),
(7),
(8),
(9),
(10);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(11) NOT NULL,
  `login` varchar(256) NOT NULL,
  `type` enum('admin','enseignant') NOT NULL,
  `photo` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `login`, `type`, `photo`) VALUES
(1, 'youssef.balhaddade@uit.ac.ma', 'enseignant', '1.png'),
(2, 'admin', 'admin', '2.png'),
(3, 'ibrahim.boumazzou@uit.ac.ma', 'enseignant', '3.png'),
(4, 'moulayothman.aboutafail@uit.ac.ma', 'enseignant', '4.png'),
(5, 'h.mharzi@uit.ac.ma', 'enseignant', '5.png'),
(6, 'moulaytaib.belghiti@uit.ac.ma', 'enseignant', '6.png');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD KEY `id_utilisateur` (`id_utilisateur`);

--
-- Index pour la table `batiment`
--
ALTER TABLE `batiment`
  ADD PRIMARY KEY (`id_batiment`),
  ADD UNIQUE KEY `id_batiment` (`id_batiment`);

--
-- Index pour la table `enseignant`
--
ALTER TABLE `enseignant`
  ADD PRIMARY KEY (`id_enseignant`),
  ADD KEY `id_utilisateur` (`id_utilisateur`);

--
-- Index pour la table `filiere`
--
ALTER TABLE `filiere`
  ADD PRIMARY KEY (`id_filiere`,`id_semestre`),
  ADD KEY `id_semestre` (`id_semestre`);

--
-- Index pour la table `groupe`
--
ALTER TABLE `groupe`
  ADD PRIMARY KEY (`id_groupe`),
  ADD KEY `id_filiere` (`id_filiere`),
  ADD KEY `id_semestre` (`id_semestre`);

--
-- Index pour la table `module`
--
ALTER TABLE `module`
  ADD PRIMARY KEY (`id_module`),
  ADD KEY `id_enseignant` (`id_enseignant`),
  ADD KEY `id_semestre` (`id_semestre`);

--
-- Index pour la table `module_filiere`
--
ALTER TABLE `module_filiere`
  ADD PRIMARY KEY (`id_module`,`id_filiere`,`id_semestre`),
  ADD KEY `id_module` (`id_module`,`id_filiere`),
  ADD KEY `id_semestre` (`id_semestre`),
  ADD KEY `module_filiere_ibfk_2` (`id_filiere`);

--
-- Index pour la table `notifs`
--
ALTER TABLE `notifs`
  ADD PRIMARY KEY (`id_notifs`);

--
-- Index pour la table `salle`
--
ALTER TABLE `salle`
  ADD PRIMARY KEY (`id_salle`,`id_batiment`),
  ADD KEY `id_batiment` (`id_batiment`);

--
-- Index pour la table `seance`
--
ALTER TABLE `seance`
  ADD PRIMARY KEY (`id_seance`),
  ADD KEY `id_salle` (`id_salle`,`id_groupe`),
  ADD KEY `id_groupe` (`id_groupe`),
  ADD KEY `id_batiment` (`id_batiment`),
  ADD KEY `id_module` (`id_module`);

--
-- Index pour la table `semestre`
--
ALTER TABLE `semestre`
  ADD PRIMARY KEY (`id_semestre`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `enseignant`
--
ALTER TABLE `enseignant`
  MODIFY `id_enseignant` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `filiere`
--
ALTER TABLE `filiere`
  MODIFY `id_filiere` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `groupe`
--
ALTER TABLE `groupe`
  MODIFY `id_groupe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `module`
--
ALTER TABLE `module`
  MODIFY `id_module` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `notifs`
--
ALTER TABLE `notifs`
  MODIFY `id_notifs` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `seance`
--
ALTER TABLE `seance`
  MODIFY `id_seance` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `enseignant`
--
ALTER TABLE `enseignant`
  ADD CONSTRAINT `enseignant_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `filiere`
--
ALTER TABLE `filiere`
  ADD CONSTRAINT `filiere_ibfk_2` FOREIGN KEY (`id_semestre`) REFERENCES `semestre` (`id_semestre`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `groupe`
--
ALTER TABLE `groupe`
  ADD CONSTRAINT `groupe_ibfk_1` FOREIGN KEY (`id_filiere`) REFERENCES `filiere` (`id_filiere`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `groupe_ibfk_2` FOREIGN KEY (`id_semestre`) REFERENCES `semestre` (`id_semestre`);

--
-- Contraintes pour la table `module`
--
ALTER TABLE `module`
  ADD CONSTRAINT `module_ibfk_1` FOREIGN KEY (`id_enseignant`) REFERENCES `enseignant` (`id_enseignant`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `module_ibfk_2` FOREIGN KEY (`id_semestre`) REFERENCES `semestre` (`id_semestre`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `module_filiere`
--
ALTER TABLE `module_filiere`
  ADD CONSTRAINT `module_filiere_ibfk_1` FOREIGN KEY (`id_module`) REFERENCES `module` (`id_module`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `module_filiere_ibfk_2` FOREIGN KEY (`id_filiere`) REFERENCES `filiere` (`id_filiere`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `module_filiere_ibfk_3` FOREIGN KEY (`id_semestre`) REFERENCES `semestre` (`id_semestre`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `salle`
--
ALTER TABLE `salle`
  ADD CONSTRAINT `salle_ibfk_1` FOREIGN KEY (`id_batiment`) REFERENCES `batiment` (`id_batiment`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `seance`
--
ALTER TABLE `seance`
  ADD CONSTRAINT `seance_ibfk_1` FOREIGN KEY (`id_groupe`) REFERENCES `groupe` (`id_groupe`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `seance_ibfk_3` FOREIGN KEY (`id_salle`) REFERENCES `salle` (`id_salle`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `seance_ibfk_4` FOREIGN KEY (`id_batiment`) REFERENCES `batiment` (`id_batiment`),
  ADD CONSTRAINT `seance_ibfk_5` FOREIGN KEY (`id_module`) REFERENCES `module` (`id_module`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
