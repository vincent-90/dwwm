-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:3306
-- Généré le :  Lun 04 Mars 2019 à 15:29
-- Version du serveur :  5.7.25-0ubuntu0.18.04.2
-- Version de PHP :  7.2.15-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `dwwm`
--

-- --------------------------------------------------------

--
-- Structure de la table `dwwm_comments`
--

CREATE TABLE `dwwm_comments` (
  `id` int(11) NOT NULL,
  `text` text NOT NULL,
  `dateHour` datetime NOT NULL,
  `id_dwwm_users` int(11) NOT NULL,
  `id_dwwm_games` int(11) DEFAULT NULL,
  `id_dwwm_consoles` int(11) DEFAULT NULL,
  `id_dwwm_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `dwwm_comments`
--

INSERT INTO `dwwm_comments` (`id`, `text`, `dateHour`, `id_dwwm_users`, `id_dwwm_games`, `id_dwwm_consoles`, `id_dwwm_status`) VALUES
(1, 'Commentaire n°1 !', '2019-03-03 22:38:10', 10, NULL, 5, 1),
(3, 'Mon premier jeu !', '2019-03-03 22:55:21', 10, 3, NULL, 1);

-- --------------------------------------------------------

--
-- Structure de la table `dwwm_consoles`
--

CREATE TABLE `dwwm_consoles` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `image` varchar(255) NOT NULL,
  `summary` text NOT NULL,
  `date` date NOT NULL,
  `id_dwwm_status` int(11) NOT NULL,
  `id_dwwm_users` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `dwwm_consoles`
--

INSERT INTO `dwwm_consoles` (`id`, `name`, `image`, `summary`, `date`, `id_dwwm_status`, `id_dwwm_users`) VALUES
(4, 'Nintendo Game Boy', 'Nintendo Game Boy.jpg', 'Le (ou la) Game Boy est une console portable de jeu vidéo 8-bits de quatrième génération développée et fabriquée par Nintendo. Mise en vente au Japon le 21 avril 1989, puis en Amérique du Nord en octobre 1989, et enfin en Europe le 28 septembre 1990, elle est la première console portable de la gamme des Game Boy. Elle fut conçue par Gunpei Yokoi et Nintendo Research &amp; Development — la même équipe ayant conçu la série des Game and Watch ainsi que de nombreux jeux à succès sur Nintendo Entertainment System. ', '1990-09-28', 1, 8),
(5, 'Nintendo DS', 'Nintendo DS.png', 'La Nintendo DS (DS pour Dual Screen, Double Screen au Japon), est une console portable créée par Nintendo, sortie fin 2004 au Japon et en Amérique du Nord et en 2005 en Europe.\r\n\r\nElle est équipée de plusieurs fonctions auparavant rares, voire inédites dans le domaine du jeu vidéo portable, telles que deux écrans rétro-éclairés simultanément dont un écran tactile, un microphone, deux ports cartouche (un pour les jeux Nintendo DS, un autre pour les cartouches de jeu Game Boy Advance et les accessoires), deux haut-parleurs compatibles surround (virtuel), ou encore le Wi-Fi intégré, d\'une portée de 10 à 30 mètres en LAN, permettant de connecter seize consoles entre elles, et de se connecter au Nintendo Wi-Fi Connection pour jouer en ligne. ', '2005-03-11', 1, 8),
(7, 'Nintendo DS lite', 'Nintendo DS lite.jpg', 'La Nintendo DS Lite est la version redessinée de la Nintendo DS.\r\n\r\nLes modifications par rapport à la DS sont :\r\n\r\n    41 % plus petite et 21 % plus légère que la DS originale\r\n    Deux écrans beaucoup plus lumineux et contrastés (éclairage réglable selon 4 niveaux de luminosité, permettant une visibilité agréable dans un environnement lumineux)\r\n    Croix directionnelle réduite de 16 % par rapport à la DS originale ; en revanche les boutons A/B/X/Y gardent les mêmes dimensions que sur la première version de DS. Les boutons Start et Select se retrouvent désormais sous les boutons A/B/X/Y.\r\n    Stylet d\'un diamètre supérieur d\'1 mm et plus long d\'1 cm par rapport au stylet d\'origine. Il se range latéralement.\r\n    Durée de la batterie : 15-19 heures de jeu avec la luminosité la moins forte, 5 heures de jeu avec la luminosité la plus forte.\r\n    Port Game Boy Advance moins profond : les cartouches GBA dépassent de 1,2 cm. De plus le port est comblé par une cartouche vierge ce qui permet d\'éviter la détérioration et permet de compléter le design de la console (l\'emplacement des cartouches Game Boy Advance peut être utilisé pour y placer une cartouche vibrante).\r\n    La dragonne n\'est plus fournie.\r\n    Design proche de celui de la Nintendo Wii, croix directionnelle identique à celle de la Game Boy Micro.\r\n    Microphone déplacé entre les deux écrans.\r\n    Bouton Power, avec système à glissière, placé sur le côté droit de la console.\r\n    Le réglage du volume est plus précis\r\n    8 coloris sont disponibles en Europe : Blanc, Noir, Rose, Argent, ainsi que Rouge et Bleu, Vert et Turquoise', '2006-06-23', 1, 7),
(8, 'Sony Playstation 4', 'Sony Playstation 4.jpg', 'La PlayStation 4 (abrégée officiellement PS4) est une console de jeux vidéo de salon de huitième génération développée par Sony Computer Entertainment. Présentée le 20 février 2013, elle succède à la PlayStation 3 et se place en concurrence avec la Xbox One de Microsoft et la Wii U puis la Switch de Nintendo, consoles concurrentes de huitième génération. ', '2013-11-29', 1, 11);

-- --------------------------------------------------------

--
-- Structure de la table `dwwm_games`
--

CREATE TABLE `dwwm_games` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `title` varchar(100) NOT NULL,
  `summary` text NOT NULL,
  `date` date NOT NULL,
  `id_dwwm_users` int(11) NOT NULL,
  `id_dwwm_consoles` int(11) NOT NULL,
  `id_dwwm_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `dwwm_games`
--

INSERT INTO `dwwm_games` (`id`, `image`, `title`, `summary`, `date`, `id_dwwm_users`, `id_dwwm_consoles`, `id_dwwm_status`) VALUES
(3, 'Donkey Kong.jpg', 'Donkey Kong', 'Donkey Kong est un jeu de plates-formes/puzzle qui met en scène non pas le célèbre primate mais Mario. Donkey Kong a capturé Pauline et le plombier se met en devoir de sauver la belle. Ce jeu est le successeur spirituel du Donkey Kong sorti en arcade en 1981, les quatre premiers niveaux reprenant ceux du jeu original. Dans le jeu d\'arcade, Mario ne portait pas encore ce patronyme et s\'appelait Jumpman. ', '1994-09-26', 8, 4, 1),
(6, 'Professeur Layton et la Boîte de Pandore.jpg', 'Professeur Layton et la Boîte de Pandore', 'Les évènements de ce jeu se déroulent un an après Professeur Layton et l\'étrange village.\r\n\r\nLe professeur Hershel Layton et son apprenti, Luke, reçoivent une lettre d\'Andrew Schrader, savant respecté, mentor et ami du professeur, qui contient des informations sur le coffret céleste qui est communément appelé la &quot;Boîte de Pandore&quot;. Inquiets, Layton et Luke décident d\'aller voir Andrew mais une fois sur place ils le trouvent mort et le coffret a disparu. Dans le bureau du défunt, Layton et Luke trouvent un ticket pour le Molentary Express et une photo déchirée. Sur ce, ils décident de le prendre pour retrouver la Boîte de Pandore. Une fois rendus a Dropstone les deux héros découvrent une destination mystère du molentary express : Folsense, une ville fantôme ', '2009-09-25', 7, 5, 1),
(7, 'Professeur Layton et l\'Étrange Village.jpg', 'Professeur Layton et l\'Étrange Village', 'L\'aventure suit l\'histoire du professeur Hershel Layton et de son assistant, Luke, à la recherche de la solution au mystère de la Pomme d\'Or. La Pomme d\'Or a été cachée dans le village de Saint-Mystère par le baron Reinhold qui a promis dans son testament à celui qui la retrouverait son trésor le plus cher. ', '2008-11-07', 7, 5, 1),
(8, 'Uncharted 4.jpg', 'Uncharted 4: A Thief\'s End', 'Nathan Drake, un explorateur, mène une vie paisible avec son épouse Elena. Mais alors que tout allait au mieux, un événement va tout faire basculer. Samuel Drake, son frère aîné présumé mort refait surface quinze ans après les évènements. Samuel explique à son frère qu\'il se trouvait en prison avec comme compagnon de cellule le célèbre narco-traficant Alcazar, et que celui-ci pouvait le faire sortir de prison s\'il trouvait le trésor du capitaine pirate Henry Avery, dont la valeur atteindrait 400 000 000 dollars.\r\n\r\nEndetté d\'une promesse faite à Alcazar, et le tout dans un délai de trois mois, Samuel est plus déterminé que jamais à trouver ce trésor. Nathan, Samuel ainsi que Victor Sullivan, le meilleur ami de Nathan, prennent alors part à une immense chasse au trésor. Mais Rafe, ancien ami des deux frères, part aussi à la recherche du trésor accompagné d\'un grand groupe de mercenaires : Shoreline. ', '2016-05-10', 11, 8, 1),
(9, 'Uncharted: The Lost Legacy.jpg', 'Uncharted: The Lost Legacy', 'L\'histoire narre une aventure associant Nadine Ross et Chloé Frazer et se rendant en Inde afin de trouver la défense brisée de Ganesh. ', '2017-08-23', 11, 8, 1);

-- --------------------------------------------------------

--
-- Structure de la table `dwwm_grades`
--

CREATE TABLE `dwwm_grades` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `dwwm_grades`
--

INSERT INTO `dwwm_grades` (`id`, `name`) VALUES
(57, 'admin'),
(58, 'user');

-- --------------------------------------------------------

--
-- Structure de la table `dwwm_status`
--

CREATE TABLE `dwwm_status` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `dwwm_status`
--

INSERT INTO `dwwm_status` (`id`, `name`) VALUES
(1, 'en attente'),
(2, 'validé'),
(3, 'refusé');

-- --------------------------------------------------------

--
-- Structure de la table `dwwm_users`
--

CREATE TABLE `dwwm_users` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `mail` varchar(100) NOT NULL,
  `password` char(100) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `id_dwwm_grades` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `dwwm_users`
--

INSERT INTO `dwwm_users` (`id`, `username`, `mail`, `password`, `avatar`, `id_dwwm_grades`) VALUES
(7, 'Mario', 'mario@user.fr', '$2y$10$uSpAqqqcuBxQ8w4X0xmUTOilgqIILMhxvVpPdhblkJKVriaIAvIgK', '7.jpg', 58),
(9, 'Vincent', 'test@admin.fr', '$2y$10$gx7j6tScKgeRM5YpRaSuVOgOv2pKTxryvD7OxQ7quHsCKggBckyti', '9.jpg', 57),
(10, 'Toad', 'toad@user.fr', '$2y$10$nuV/7EJLtUMZIFe6Pm80t.mtBhJzdTkKrLGw5TWLg4yZnDZuQhOB6', '10.jpg', 58),
(11, 'Luigi', 'luigi@user.fr', '$2y$10$sDcsLUfKArTL.e.xp935quiz0mMrBuj7Y7bqCdf9INWvHKArRb5cS', '11.jpg', 58);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `dwwm_comments`
--
ALTER TABLE `dwwm_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dwwm_comments_dwwm_status2_FK` (`id_dwwm_status`),
  ADD KEY `dwwm_comments_dwwm_consoles1_FK` (`id_dwwm_consoles`),
  ADD KEY `dwwm_comments_dwwm_games0_FK` (`id_dwwm_games`),
  ADD KEY `dwwm_comments_dwwm_users_FK` (`id_dwwm_users`);

--
-- Index pour la table `dwwm_consoles`
--
ALTER TABLE `dwwm_consoles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dwwm_consoles_dwwm_status_FK` (`id_dwwm_status`),
  ADD KEY `dwwm_consoles_dwwm_users0_FK` (`id_dwwm_users`);

--
-- Index pour la table `dwwm_games`
--
ALTER TABLE `dwwm_games`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dwwm_games_dwwm_status1_FK` (`id_dwwm_status`),
  ADD KEY `dwwm_games_dwwm_consoles0_FK` (`id_dwwm_consoles`),
  ADD KEY `dwwm_games_dwwm_users_FK` (`id_dwwm_users`);

--
-- Index pour la table `dwwm_grades`
--
ALTER TABLE `dwwm_grades`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `dwwm_status`
--
ALTER TABLE `dwwm_status`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `dwwm_users`
--
ALTER TABLE `dwwm_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dwwm_users_dwwm_grades_FK` (`id_dwwm_grades`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `dwwm_comments`
--
ALTER TABLE `dwwm_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `dwwm_consoles`
--
ALTER TABLE `dwwm_consoles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `dwwm_games`
--
ALTER TABLE `dwwm_games`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT pour la table `dwwm_grades`
--
ALTER TABLE `dwwm_grades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;
--
-- AUTO_INCREMENT pour la table `dwwm_status`
--
ALTER TABLE `dwwm_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `dwwm_users`
--
ALTER TABLE `dwwm_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `dwwm_comments`
--
ALTER TABLE `dwwm_comments`
  ADD CONSTRAINT `dwwm_comments_dwwm_consoles1_FK` FOREIGN KEY (`id_dwwm_consoles`) REFERENCES `dwwm_consoles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `dwwm_comments_dwwm_games0_FK` FOREIGN KEY (`id_dwwm_games`) REFERENCES `dwwm_games` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `dwwm_comments_dwwm_status2_FK` FOREIGN KEY (`id_dwwm_status`) REFERENCES `dwwm_status` (`id`),
  ADD CONSTRAINT `dwwm_comments_dwwm_users_FK` FOREIGN KEY (`id_dwwm_users`) REFERENCES `dwwm_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `dwwm_consoles`
--
ALTER TABLE `dwwm_consoles`
  ADD CONSTRAINT `dwwm_consoles_dwwm_status_FK` FOREIGN KEY (`id_dwwm_status`) REFERENCES `dwwm_status` (`id`);

--
-- Contraintes pour la table `dwwm_games`
--
ALTER TABLE `dwwm_games`
  ADD CONSTRAINT `dwwm_games_dwwm_consoles0_FK` FOREIGN KEY (`id_dwwm_consoles`) REFERENCES `dwwm_consoles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `dwwm_games_dwwm_status1_FK` FOREIGN KEY (`id_dwwm_status`) REFERENCES `dwwm_status` (`id`);

--
-- Contraintes pour la table `dwwm_users`
--
ALTER TABLE `dwwm_users`
  ADD CONSTRAINT `dwwm_users_dwwm_grades_FK` FOREIGN KEY (`id_dwwm_grades`) REFERENCES `dwwm_grades` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
