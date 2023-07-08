-- phpMyAdmin SQL Dump
-- version 5.2.1deb1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : sam. 08 juil. 2023 à 20:40
-- Version du serveur : 8.0.33
-- Version de PHP : 8.1.12-1ubuntu4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `antse_cool`
--

-- --------------------------------------------------------

--
-- Structure de la table `Admin`
--

CREATE TABLE `Admin` (
  `id` int NOT NULL,
  `role` varchar(250) NOT NULL,
  `password` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `Admin`
--

INSERT INTO `Admin` (`id`, `role`, `password`) VALUES
(1, 'Admin', 'admin');

-- --------------------------------------------------------

--
-- Structure de la table `grades`
--

CREATE TABLE `grades` (
  `id` int NOT NULL,
  `student_id` varchar(128) NOT NULL,
  `module_id` varchar(128) NOT NULL,
  `grade` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `grades`
--

INSERT INTO `grades` (`id`, `student_id`, `module_id`, `grade`) VALUES
(4, 'FI2301-200', 'INFO_160', NULL),
(5, 'FI2301-200', 'INFO_240', NULL),
(6, 'FI2301-200', 'INFO_242', NULL),
(7, 'FI2301-200', 'INFO_250', 14),
(8, 'FI2301-200', 'INFO_253', NULL),
(9, 'FI2301-200', 'INFO_263', NULL),
(10, 'FI2301-200', 'MATH_210', NULL),
(11, 'FI2301-200', 'MATH_220', NULL),
(12, 'FI2301-200', 'ENTR_210', NULL),
(13, 'FI2301-182', 'INFO_160', NULL),
(14, 'FI2301-182', 'INFO_240', NULL),
(15, 'FI2301-182', 'INFO_242', NULL),
(16, 'FI2301-182', 'INFO_250', 10),
(17, 'FI2301-182', 'INFO_253', NULL),
(18, 'FI2301-182', 'INFO_263', NULL),
(19, 'FI2301-182', 'MATH_210', NULL),
(20, 'FI2301-182', 'MATH_220', NULL),
(21, 'FI2301-182', 'ENTR_210', NULL),
(22, 'FI2301-176', 'INFO_160', NULL),
(23, 'FI2301-176', 'INFO_240', NULL),
(24, 'FI2301-176', 'INFO_242', NULL),
(25, 'FI2301-176', 'INFO_250', 10),
(26, 'FI2301-176', 'INFO_253', NULL),
(27, 'FI2301-176', 'INFO_263', NULL),
(28, 'FI2301-176', 'MATH_210', NULL),
(29, 'FI2301-176', 'MATH_220', NULL),
(30, 'FI2301-176', 'ENTR_210', NULL),
(31, 'FI2301-169', 'INFO_160', NULL),
(32, 'FI2301-169', 'INFO_240', NULL),
(33, 'FI2301-169', 'INFO_242', NULL),
(34, 'FI2301-169', 'INFO_250', 12),
(35, 'FI2301-169', 'INFO_253', NULL),
(36, 'FI2301-169', 'INFO_263', NULL),
(37, 'FI2301-169', 'MATH_210', NULL),
(38, 'FI2301-169', 'MATH_220', NULL),
(39, 'FI2301-169', 'ENTR_210', NULL),
(40, 'FI2301-148', 'INFO_160', NULL),
(41, 'FI2301-148', 'INFO_240', NULL),
(42, 'FI2301-148', 'INFO_242', NULL),
(43, 'FI2301-148', 'INFO_250', 10),
(44, 'FI2301-148', 'INFO_253', NULL),
(45, 'FI2301-148', 'INFO_263', NULL),
(46, 'FI2301-148', 'MATH_210', NULL),
(47, 'FI2301-148', 'MATH_220', NULL),
(48, 'FI2301-148', 'ENTR_210', NULL),
(49, 'FI2301-145', 'INFO_160', NULL),
(50, 'FI2301-145', 'INFO_240', NULL),
(51, 'FI2301-145', 'INFO_242', NULL),
(52, 'FI2301-145', 'INFO_250', 16),
(53, 'FI2301-145', 'INFO_253', NULL),
(54, 'FI2301-145', 'INFO_263', NULL),
(55, 'FI2301-145', 'MATH_210', NULL),
(56, 'FI2301-145', 'MATH_220', NULL),
(57, 'FI2301-145', 'ENTR_210', NULL),
(58, 'FI2301-141', 'INFO_160', NULL),
(59, 'FI2301-141', 'INFO_240', NULL),
(60, 'FI2301-141', 'INFO_242', NULL),
(61, 'FI2301-141', 'INFO_250', 15),
(62, 'FI2301-141', 'INFO_253', NULL),
(63, 'FI2301-141', 'INFO_263', NULL),
(64, 'FI2301-141', 'MATH_210', NULL),
(65, 'FI2301-141', 'MATH_220', NULL),
(66, 'FI2301-141', 'ENTR_210', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `groups`
--

CREATE TABLE `groups` (
  `id` int NOT NULL,
  `name` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `groups`
--

INSERT INTO `groups` (`id`, `name`) VALUES
(1, 'L1G1'),
(2, 'L1G2'),
(3, 'RSI L2'),
(4, 'RSI L3'),
(5, 'IDEV L2'),
(6, 'IDEV L3');

-- --------------------------------------------------------

--
-- Structure de la table `modules`
--

CREATE TABLE `modules` (
  `id` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `name` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `state` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `modules`
--

INSERT INTO `modules` (`id`, `name`, `state`) VALUES
('DB', 'Blabla', 1),
('ENTR_210', 'Communication et leadership', 1),
('INFO_160', 'Algorithmes fondamentaux', 1),
('INFO_240', 'Logique binaire et bas niveau : programmation en Assembleur', 1),
('INFO_242', 'Python : Prise en main et Framework Flask', 1),
('INFO_250', 'Bases de données relationnelles : conception et modélisation', 1),
('INFO_253', 'Web Dynamique : Programmation', 1),
('INFO_263', 'Documentation logicielle et initiation aux outils de versioning', 1),
('MATH_210', 'Analyse et Algèbre II', 1),
('MATH_220', 'Calcul Numérique', 1);

-- --------------------------------------------------------

--
-- Structure de la table `passwords`
--

CREATE TABLE `passwords` (
  `id` int NOT NULL,
  `password` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `passwords`
--

INSERT INTO `passwords` (`id`, `password`) VALUES
(1, 'Malcovys'),
(3, 'jean'),
(8, 'dina'),
(9, 'ndrina'),
(10, 'aimé'),
(11, 'rochel'),
(12, 'hasimbola'),
(13, 'andry'),
(20, 'njarasoa'),
(21, 'Vonjeoaho'),
(27, 'koto2023'),
(36, 'mamy'),
(37, 'yoann'),
(38, 'franchyah'),
(52, 'aimer'),
(53, 'aimer'),
(54, 'njarasoa'),
(55, 'Franchyah'),
(56, 'Malcovys'),
(57, 'jean'),
(58, 'yoann'),
(59, 'mamy'),
(60, 'mamy'),
(61, 'Vonjeoaho'),
(62, 'Koto2023'),
(63, 'Koto2023'),
(64, '1233'),
(65, '1233'),
(66, '1233');

-- --------------------------------------------------------

--
-- Structure de la table `scheldules`
--

CREATE TABLE `scheldules` (
  `id` int NOT NULL,
  `module_id` varchar(128) NOT NULL,
  `group_id` int NOT NULL,
  `date` date NOT NULL,
  `begin_at` time NOT NULL,
  `end_at` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `students`
--

CREATE TABLE `students` (
  `id` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `firstName` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `lastName` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `group_id` int NOT NULL,
  `promotion` varchar(128) NOT NULL,
  `state` int NOT NULL DEFAULT '1',
  `password_id` int NOT NULL,
  `photo_dir` varchar(3000) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'templates/assets/images/profiles/default.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `students`
--

INSERT INTO `students` (`id`, `firstName`, `lastName`, `email`, `group_id`, `promotion`, `state`, `password_id`, `photo_dir`) VALUES
('FI-2301-113', 'Randrianary', 'Koto Beloha', 'kotobeloha@mail.com', 1, '2023', 1, 27, 'templates/assets/images/profiles/default.jpg'),
('FI2301-141', 'RABEHAJA HERIJAONA', 'Rindra Kiady Vanontsoa', 'rindra.kiady.rabehajaherijaona@esti.mg', 2, '2023', 1, 21, 'templates/assets/images/profiles/default.jpg'),
('FI2301-145', 'Mamy', 'Razafindrakoto', 'razafindrakoto.mamy@esti.mg', 2, '2023', 1, 36, 'templates/assets/images/profiles/default.jpg'),
('FI2301-148', 'ANDRIARIZAKA', 'Yoann', 'andriarizaka.yoann@esti.mg', 2, '2023', 1, 37, 'templates/assets/images/profiles/default.jpg'),
('FI2301-160', 'Jean', 'Marc', 'jean.marc@gmail.com', 1, '2023', 1, 3, 'templates/assets/images/profiles/default.jpg'),
('FI2301-169', 'BEANJARA', 'Malcovys Bonely', 'malcovys@gmail.com', 2, '2023', 1, 1, 'templates/assets/images/profiles/default.jpg'),
('FI2301-176', 'NOMENAHASINORO', 'Dera Franchyah', 'dera.nomenahasinoro@esti.mg', 2, '2023', 1, 38, 'templates/assets/images/profiles/default.jpg'),
('FI2301-182', 'Njarasoa Fandresena', 'RAMINOSON', 'njarasoa.fandresena.raminoson@esti.mg', 2, '2023', 1, 20, 'templates/assets/images/profiles/default.jpg'),
('FI2301-200', 'RABE', 'Jean Aimé', 'jean.aime@esti.mg', 2, '2023', 1, 52, 'templates/assets/images/profiles/default.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `teachers`
--

CREATE TABLE `teachers` (
  `id` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `firstName` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `lastName` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `promotion` varchar(128) NOT NULL,
  `state` int NOT NULL DEFAULT '1',
  `password_id` int NOT NULL,
  `photo_dir` varchar(3000) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'templates/assets/images/profiles/default1.jpeg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `teachers`
--

INSERT INTO `teachers` (`id`, `firstName`, `lastName`, `email`, `promotion`, `state`, `password_id`, `photo_dir`) VALUES
('0001', 'Mr', 'Dina', 'dina@esti.mg', '2020', 1, 8, 'templates/assets/images/profiles/default1.jpeg'),
('0002', 'Mr', 'Ndrina', 'ndrina@esti.mg', '2021', 1, 9, 'templates/assets/images/profiles/default1.jpeg'),
('0003', 'Mr', 'Aimé', 'aime@esti.mg', '2020', 1, 10, 'templates/assets/images/profiles/default1.jpeg'),
('0004', 'Mr', 'Rochel', 'rochel@esti.mg', '2021', 1, 11, 'templates/assets/images/profiles/default1.jpeg'),
('0005', 'Mr', 'Hasimbola', 'hasimbola@esti.mg', '2021', 1, 12, 'templates/assets/images/profiles/default1.jpeg'),
('0006', 'Mr', 'Andry', 'andry@esti.mg', '2023', 1, 13, 'templates/assets/images/profiles/default1.jpeg');

-- --------------------------------------------------------

--
-- Structure de la table `teacher_modules`
--

CREATE TABLE `teacher_modules` (
  `id` int NOT NULL,
  `module_id` varchar(128) NOT NULL,
  `teacher_id` varchar(128) NOT NULL,
  `group_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `teacher_modules`
--

INSERT INTO `teacher_modules` (`id`, `module_id`, `teacher_id`, `group_id`) VALUES
(1, 'INFO_160', '0002', 2),
(2, 'INFO_240', '0003', 2),
(3, 'INFO_242', '0004', 2),
(4, 'INFO_250', '0001', 2),
(5, 'INFO_253', '0001', 2),
(6, 'INFO_263', '0001', 2),
(7, 'MATH_210', '0005', 2),
(8, 'MATH_220', '0006', 2),
(9, 'ENTR_210', '0002', 2),
(11, 'INFO_253', '0001', 6),
(13, 'DB', '0002', 6);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Admin`
--
ALTER TABLE `Admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `password` (`password`);

--
-- Index pour la table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `module_id` (`module_id`);

--
-- Index pour la table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `passwords`
--
ALTER TABLE `passwords`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `scheldules`
--
ALTER TABLE `scheldules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `module_id` (`module_id`),
  ADD KEY `group_id` (`group_id`);

--
-- Index pour la table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `group_id` (`group_id`),
  ADD KEY `password_id` (`password_id`);

--
-- Index pour la table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `password_id` (`password_id`);

--
-- Index pour la table `teacher_modules`
--
ALTER TABLE `teacher_modules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `module_id` (`module_id`),
  ADD KEY `teacher_id` (`teacher_id`),
  ADD KEY `group_id` (`group_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Admin`
--
ALTER TABLE `Admin`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `grades`
--
ALTER TABLE `grades`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT pour la table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `passwords`
--
ALTER TABLE `passwords`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT pour la table `scheldules`
--
ALTER TABLE `scheldules`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `teacher_modules`
--
ALTER TABLE `teacher_modules`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `grades`
--
ALTER TABLE `grades`
  ADD CONSTRAINT `grades_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`),
  ADD CONSTRAINT `grades_ibfk_2` FOREIGN KEY (`module_id`) REFERENCES `modules` (`id`);

--
-- Contraintes pour la table `scheldules`
--
ALTER TABLE `scheldules`
  ADD CONSTRAINT `scheldules_ibfk_1` FOREIGN KEY (`module_id`) REFERENCES `modules` (`id`),
  ADD CONSTRAINT `scheldules_ibfk_2` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`);

--
-- Contraintes pour la table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`),
  ADD CONSTRAINT `students_ibfk_2` FOREIGN KEY (`password_id`) REFERENCES `passwords` (`id`);

--
-- Contraintes pour la table `teachers`
--
ALTER TABLE `teachers`
  ADD CONSTRAINT `teachers_ibfk_1` FOREIGN KEY (`password_id`) REFERENCES `passwords` (`id`);

--
-- Contraintes pour la table `teacher_modules`
--
ALTER TABLE `teacher_modules`
  ADD CONSTRAINT `teacher_modules_ibfk_1` FOREIGN KEY (`module_id`) REFERENCES `modules` (`id`),
  ADD CONSTRAINT `teacher_modules_ibfk_2` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`),
  ADD CONSTRAINT `teacher_modules_ibfk_3` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
