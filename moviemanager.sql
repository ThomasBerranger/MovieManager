-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  jeu. 30 nov. 2017 à 15:16
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
-- Base de données :  `moviemanager`
--

-- --------------------------------------------------------

--
-- Structure de la table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_A2E0150FF85E0677` (`username`),
  UNIQUE KEY `UNIQ_A2E0150FE7927C74` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

DROP TABLE IF EXISTS `article`;
CREATE TABLE IF NOT EXISTS `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `cover` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `article_date` date NOT NULL,
  `synopsis` longtext COLLATE utf8_unicode_ci,
  `author` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `article_update` date DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `note` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_23A0E66A76ED395` (`user_id`),
  KEY `IDX_23A0E6612469DE2` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id`, `user_id`, `name`, `date`, `cover`, `article_date`, `synopsis`, `author`, `article_update`, `category_id`, `note`) VALUES
(1, 1, 'Thor Ragnarock', '2017-10-25', 'a18b2146e5002d56881c3460b190f133.jpeg', '2017-11-15', 'Privé de son puissant marteau, Thor est retenu prisonnier sur une lointaine planète aux confins de l’univers. Pour sauver Asgard, il va devoir lutter contre le temps afin d’empêcher l’impitoyable Hela d’accomplir le Ragnarök – la destruction de son monde et la fin de la civilisation asgardienne. Mais pour y parvenir, il va d’abord devoir mener un combat titanesque de gladiateurs contre celui qui était autrefois son allié au sein des Avengers : l’incroyable Hulk…', 'Taika Waititi', '2017-11-30', 1, NULL),
(2, 1, 'Wonder Woman', '2017-06-07', '1344274edbeada404eb998f8b3dc41c5.jpeg', '2017-10-19', 'C\'était avant qu\'elle ne devienne Wonder Woman, à l\'époque où elle était encore Diana, princesse des Amazones et combattante invincible. Un jour, un pilote américain s\'écrase sur l\'île paradisiaque où elle vit, à l\'abri des fracas du monde. Lorsqu\'il lui raconte qu\'une guerre terrible fait rage à l\'autre bout de la planète, Diana quitte son havre de paix, convaincue qu\'elle doit enrayer la menace. En s\'alliant aux hommes dans un combat destiné à mettre fin à la guerre, Diana découvrira toute l\'étendue de ses pouvoirs… et son véritable destin.', 'Patty Jenkins', '2017-11-22', 1, NULL),
(3, 1, 'Deadpool', '2016-02-10', '9b91a7715ddaf4b6363acbdacfe1b354.jpeg', '2016-11-17', 'Deadpool, est l\'anti-héros le plus atypique de l\'univers Marvel. A l\'origine, il s\'appelle Wade Wilson : un ancien militaire des Forces Spéciales devenu mercenaire. Après avoir subi une expérimentation hors norme qui va accélérer ses pouvoirs de guérison, il va devenir Deadpool. Armé de ses nouvelles capacités et d\'un humour noir survolté, Deadpool va traquer l\'homme qui a bien failli anéantir sa vie.', 'Tim Miller', '2017-11-23', 1, NULL),
(4, 1, 'Blade Runner', '2017-10-04', '29ff3628fa46b5f1a3aa2fc4d85e574a.jpeg', '2017-11-17', 'En 2049, la société est fragilisée par les nombreuses tensions entre les humains et leurs esclaves créés par bioingénierie. L’officier K est un Blade Runner : il fait partie d’une force d’intervention d’élite chargée de trouver et d’éliminer ceux qui n’obéissent pas aux ordres des humains. Lorsqu’il découvre un secret enfoui depuis longtemps et capable de changer le monde, les plus hautes instances décident que c’est à son tour d’être traqué et éliminé. Son seul espoir est de retrouver Rick Deckard, un ancien Blade Runner qui a disparu depuis des décennies...', 'Denis Villeneuve', NULL, 2, NULL),
(5, 1, 'La La Land', '2016-11-11', 'f09ddc3e2d5643e37425c2a081a75495.jpeg', '2017-11-17', 'Au cœur de Los Angeles, une actrice en devenir prénommée Mia sert des cafés entre deux auditions. De son côté, Sebastian, passionné de jazz, joue du piano dans des clubs miteux pour assurer sa subsistance. Tous deux sont bien loin de la vie rêvée à laquelle ils aspirent… Le destin va réunir ces doux rêveurs, mais leur coup de foudre résistera-t-il aux tentations, aux déceptions, et à la vie trépidante d’Hollywood ?', 'Damien Chazelle', '2017-11-23', 5, NULL),
(6, 1, 'Cloud Atlas', '2013-03-13', '96e6324aea28d8dd85f1d8f9145be4a6.jpeg', '2015-11-17', 'À travers une histoire qui se déroule sur cinq siècles dans plusieurs espaces temps, des êtres se croisent et se retrouvent d’une vie à l’autre, naissant et renaissant successivement… Tandis que leurs décisions ont des conséquences sur leur parcours, dans le passé, le présent et l’avenir lointain, un tueur devient un héros et un seul acte de générosité suffit à entraîner des répercussions pendant plusieurs siècles et à provoquer une révolution. Tout, absolument tout, est lié.', 'Lana Wachowski', NULL, 2, NULL),
(7, 1, 'Star Wars : Les Derniers Jedi', '2017-12-13', 'c14ae26147e759be4f01cff2f9fce439.jpeg', '2017-11-16', 'Les héros du Réveil de la force rejoignent les figures légendaires de la galaxie dans une aventure épique qui révèle des secrets ancestraux sur la Force et entraîne de surprenantes révélations sur le passé…', 'Rian Johnson', '2017-11-30', 2, NULL),
(8, 1, 'Seul Sur Mars', '2015-10-21', '3b117904b92381a785ce6c122603797f.jpeg', '2017-11-17', 'Lors d’une expédition sur Mars, l’astronaute Mark Watney (Matt Damon) est laissé pour mort par ses coéquipiers, une tempête les ayant obligés à décoller en urgence. Mais Mark a survécu et il est désormais seul, sans moyen de repartir, sur une planète hostile. Il va devoir faire appel à son intelligence et son ingéniosité pour tenter de survivre et trouver un moyen de contacter la Terre. A 225 millions de kilomètres, la NASA et des scientifiques du monde entier travaillent sans relâche pour le sauver, pendant que ses coéquipiers tentent d’organiser une mission pour le récupérer au péril de leurs vies.', 'Ridley Scott', NULL, 2, NULL),
(9, 1, 'Baywatch', '2017-06-21', 'aef8e08ac60c49332016ab459f4e8701.jpeg', '2017-11-23', 'Le légendaire sauveteur Mitch Buchannon  est contraint de s’associer à une nouvelle recrue, Matt Brody, aussi ambitieux que tête brûlée ! Ensemble, ils vont tenter de déjouer un complot criminel qui menace l\'avenir de la Baie…', 'Seth Gordon', '2017-11-30', 4, '6'),
(10, 1, 'Split', '2017-02-22', '4baeb3184f7c46da46807903f35af9e6.jpeg', '2017-11-23', 'Kevin a déjà révélé 23 personnalités, avec des attributs physiques différents pour chacune, à sa psychiatre dévouée, la docteure Fletcher, mais l’une d’elles reste enfouie au plus profond de lui. Elle va bientôt se manifester et prendre le pas sur toutes les autres. Poussé à kidnapper trois adolescentes, dont la jeune Casey, aussi déterminée que perspicace, Kevin devient dans son âme et sa chair, le foyer d’une guerre que se livrent ses multiples personnalités, alors que les divisions qui régnaient jusqu’alors dans son subconscient volent en éclats.', 'M. Night Shyamalan', NULL, 3, NULL),
(11, 1, 'Ça', '2017-09-20', '385a79ccc0397ac95f5e76b7af802adc.jpeg', '2017-11-24', 'À Derry, dans le Maine, sept gamins ayant du mal à s\'intégrer se sont regroupés au sein du \"Club des Ratés\". Rejetés par leurs camarades, ils sont les cibles favorites des gros durs de l\'école. Ils ont aussi en commun d\'avoir éprouvé leur plus grande terreur face à un terrible prédateur métamorphe qu\'ils appellent \"Ça\"… \r\nCar depuis toujours, Derry est en proie à une créature qui émerge des égouts tous les 27 ans pour se nourrir des terreurs de ses victimes de choix : les enfants. Bien décidés à rester soudés, les Ratés tentent de surmonter leurs peurs pour enrayer un nouveau cycle meurtrier. Un cycle qui a commencé un jour de pluie lorsqu\'un petit garçon poursuivant son bateau en papier s\'est retrouvé face-à-face avec le Clown Grippe-Sou …', 'Andy Muschietti', NULL, 3, NULL),
(12, 1, 'Mad Max : Fury Road', '2015-05-14', '33c91fd91b21e7b55da08e9d9e2a10e5.jpeg', '2017-11-29', 'Hanté par un lourd passé, Mad Max estime que le meilleur moyen de survivre est de rester seul. Cependant, il se retrouve embarqué par une bande qui parcourt la Désolation à bord d\'un véhicule militaire piloté par l\'Imperator Furiosa. Ils fuient la Citadelle où sévit le terrible Immortan Joe qui s\'est fait voler un objet irremplaçable. Enragé, ce Seigneur de guerre envoie ses hommes pour traquer les rebelles impitoyablement…', 'George Miller', NULL, 1, NULL),
(13, 1, 'Inception', '2010-07-21', '3824e61331abe726370d2b2eddc8a13a.jpeg', '2017-11-30', 'Dom Cobb est un voleur, le meilleur qui soit dans l’art périlleux de l’extraction : sa spécialité consiste à s’approprier les secrets les plus précieux d’un individu, enfouis au plus profond de son subconscient, pendant qu’il rêve et que son esprit est particulièrement vulnérable. Très recherché pour ses talents dans l’univers trouble de l’espionnage industriel, Cobb est aussi devenu un fugitif traqué dans le monde entier qui a perdu tout ce qui lui est cher. Mais une ultime mission pourrait lui permettre de retrouver sa vie d’avant - à condition qu’il puisse accomplir l’impossible : l’inception. Au lieu de subtiliser un rêve, Cobb et son équipe doivent faire l’inverse : implanter une idée dans l’esprit d’un individu. S’ils y parviennent, il pourrait s’agir du crime parfait. Et pourtant, aussi méthodiques et doués soient-ils, rien n’aurait pu préparer Cobb et ses partenaires à un ennemi redoutable qui semble avoir systématiquement un coup d’avance sur eux. Un ennemi dont seul Cobb aurait pu soupçonner l’existence.', 'Christopher Nolan', '2017-11-30', 2, '9'),
(14, 1, 'Django Unchained', '2013-01-16', '6f96eff2f287e0545aca1d2b3642ffba.jpeg', '2017-11-30', 'Dans le sud des États-Unis, deux ans avant la guerre de Sécession, le Dr King Schultz, un chasseur de primes allemand, fait l’acquisition de Django, un esclave qui peut l’aider à traquer les frères Brittle, les meurtriers qu’il recherche. Schultz promet à Django de lui rendre sa liberté lorsqu’il aura capturé les Brittle – morts ou vifs.\r\nAlors que les deux hommes pistent les dangereux criminels, Django n’oublie pas que son seul but est de retrouver Broomhilda, sa femme, dont il fut séparé à cause du commerce des esclaves…\r\nLorsque Django et Schultz arrivent dans l’immense plantation du puissant Calvin Candie, ils éveillent les soupçons de Stephen, un esclave qui sert Candie et a toute sa confiance. Le moindre de leurs mouvements est désormais épié par une dangereuse organisation de plus en plus proche… Si Django et Schultz veulent espérer s’enfuir avec Broomhilda, ils vont devoir choisir entre l’indépendance et la solidarité, entre le sacrifice et la survie…', 'Quentin Tarantino', NULL, 1, '9');

-- --------------------------------------------------------

--
-- Structure de la table `article_like`
--

DROP TABLE IF EXISTS `article_like`;
CREATE TABLE IF NOT EXISTS `article_like` (
  `user_id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`article_id`),
  KEY `IDX_1C21C7B2A76ED395` (`user_id`),
  KEY `IDX_1C21C7B27294869C` (`article_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `article_like`
--

INSERT INTO `article_like` (`user_id`, `article_id`) VALUES
(1, 8),
(1, 10),
(6, 1),
(6, 2),
(7, 6),
(7, 8),
(8, 5),
(8, 9),
(9, 5),
(9, 8),
(10, 4),
(10, 8),
(13, 1),
(13, 3),
(13, 4),
(13, 6),
(13, 8),
(13, 9),
(13, 10);

-- --------------------------------------------------------

--
-- Structure de la table `article_tag`
--

DROP TABLE IF EXISTS `article_tag`;
CREATE TABLE IF NOT EXISTS `article_tag` (
  `article_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  PRIMARY KEY (`article_id`,`tag_id`),
  KEY `IDX_919694F97294869C` (`article_id`),
  KEY `IDX_919694F9BAD26311` (`tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `article_tag`
--

INSERT INTO `article_tag` (`article_id`, `tag_id`) VALUES
(1, 8),
(1, 10),
(1, 12),
(7, 19),
(9, 22),
(13, 17),
(13, 18),
(14, 20),
(14, 21);

-- --------------------------------------------------------

--
-- Structure de la table `article_watch`
--

DROP TABLE IF EXISTS `article_watch`;
CREATE TABLE IF NOT EXISTS `article_watch` (
  `user_id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`article_id`),
  KEY `IDX_27BC3837A76ED395` (`user_id`),
  KEY `IDX_27BC38377294869C` (`article_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `article_watch`
--

INSERT INTO `article_watch` (`user_id`, `article_id`) VALUES
(1, 2),
(1, 3),
(1, 5),
(1, 6),
(1, 8),
(1, 9),
(1, 10),
(13, 1),
(13, 2),
(13, 4),
(13, 5),
(13, 6),
(13, 8),
(13, 9),
(13, 10),
(13, 11);

-- --------------------------------------------------------

--
-- Structure de la table `article_wish`
--

DROP TABLE IF EXISTS `article_wish`;
CREATE TABLE IF NOT EXISTS `article_wish` (
  `user_id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`article_id`),
  KEY `IDX_6793F3C8A76ED395` (`user_id`),
  KEY `IDX_6793F3C87294869C` (`article_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `article_wish`
--

INSERT INTO `article_wish` (`user_id`, `article_id`) VALUES
(1, 1),
(1, 4),
(1, 7),
(8, 1),
(8, 7),
(9, 7),
(10, 1),
(10, 4),
(10, 7),
(13, 7);

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_64C19C15E237E06` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Action'),
(4, 'Comedy'),
(3, 'Horror'),
(5, 'Romance'),
(2, 'Science Fiction'),
(6, 'Westren');

-- --------------------------------------------------------

--
-- Structure de la table `category_like`
--

DROP TABLE IF EXISTS `category_like`;
CREATE TABLE IF NOT EXISTS `category_like` (
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`category_id`),
  KEY `IDX_27F83AF4A76ED395` (`user_id`),
  KEY `IDX_27F83AF412469DE2` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `category_like`
--

INSERT INTO `category_like` (`user_id`, `category_id`) VALUES
(1, 2),
(1, 3),
(6, 3),
(7, 1),
(8, 2),
(8, 4),
(8, 5),
(9, 3),
(10, 1),
(13, 1),
(13, 2);

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `content` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `createdAt` datetime NOT NULL,
  `color` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_9474526CA76ED395` (`user_id`),
  KEY `IDX_9474526C7294869C` (`article_id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `comment`
--

INSERT INTO `comment` (`id`, `user_id`, `article_id`, `content`, `createdAt`, `color`) VALUES
(6, 1, 1, 'Merci de ne pas soiler ;)', '2017-11-17 15:49:02', 'blue lighten-4'),
(7, 1, 7, 'Impatient !!', '2017-11-17 17:00:24', 'red lighten-4'),
(11, 8, 7, 'Idem :)', '2017-11-22 15:20:38', 'blue lighten-4'),
(12, 6, 7, 'J\'aime pas', '2017-11-22 15:22:40', 'green lighten-4'),
(14, 10, 7, ':0 Tu me déçois.', '2017-11-22 15:24:15', 'grey lighten-4'),
(15, 7, 8, 'Super sympa :)', '2017-11-22 15:27:16', 'grey lighten-4'),
(16, 6, 8, 'Ouiiiiiiiiiiiiiiii', '2017-11-22 16:10:37', 'red lighten-4'),
(17, 9, 5, 'La fin est triste :c', '2017-11-23 08:50:34', 'red lighten-4'),
(18, 1, 5, 'Encore un spoil et c\'est le ban.', '2017-11-23 09:01:42', 'grey lighten-4'),
(19, 8, 2, 'Elle est trop belle :p', '2017-11-23 09:03:12', 'green lighten-4'),
(20, 1, 3, 'Je vous le conseille', '2017-11-23 14:50:37', 'green lighten-4'),
(21, 6, 9, 'Sympa de l\'avoir ajouté :D', '2017-11-23 15:50:37', 'red lighten-4'),
(23, 6, 3, 'L\'admin est un con !', '2017-11-23 16:37:25', 'red lighten-4'),
(24, 1, 3, 'Désormais tu es mute..', '2017-11-23 16:38:33', 'grey lighten-4'),
(25, 10, 10, 'Wouhaaa :o', '2017-11-23 16:53:37', 'green lighten-4'),
(28, 1, 10, 'Tout pareil !! ahah', '2017-11-24 13:16:38', 'deep-purple lighten-4'),
(29, 1, 8, 'Tout à fait d\'accord', '2017-11-29 08:42:10', 'deep-purple lighten-4');

-- --------------------------------------------------------

--
-- Structure de la table `tag`
--

DROP TABLE IF EXISTS `tag`;
CREATE TABLE IF NOT EXISTS `tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `tag`
--

INSERT INTO `tag` (`id`, `name`) VALUES
(8, 'Vikings'),
(9, 'Marvel'),
(10, 'Thor'),
(11, 'Combat'),
(12, 'Combats'),
(17, 'Leonardo DiCaprio'),
(18, 'Rêves'),
(19, 'Jedi'),
(20, 'Sang'),
(21, 'Cowboy'),
(22, 'Dwayne');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `picture` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime DEFAULT NULL,
  `role` int(11) NOT NULL,
  `mute` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_1483A5E9F85E0677` (`username`),
  UNIQUE KEY `UNIQ_1483A5E9E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `is_active`, `picture`, `createdAt`, `updatedAt`, `role`, `mute`) VALUES
(1, 'Admin', '$2a$08$jHZj/wJfcVKlIwr5AvR78euJxYK7Ku5kURNhNx.7.CSIJ3Pq6LEPC', 'admin@gmail.com', 1, '0c3822aa07d39e10575ae9d9d769f998.png', '2017-11-17 15:14:01', '2017-11-17 15:49:18', 2, 0),
(6, 'Toto', '$2y$13$KTxc7ZdIfTz7DsPFzXQ8xO8DukSkwwlSCpKwJc4K334wRUFW63KxG', 'toto@gmail.com', 1, '6a471acecf4c2e1547f1d83fc69ead17.png', '2017-11-22 15:16:24', '2017-11-22 16:09:42', 1, 1),
(7, 'Titi', '$2y$13$271LYDE2JMhuJAvaDDbjNulDr8ZIbgD3CLdkkr42VwRwlCmzjTba6', 'titi@gmail.com', 1, 'bd5aacceec166e204ecc468e1b72c5fd.png', '2017-11-22 15:17:02', '2017-11-22 15:26:46', 1, 0),
(8, 'Tata', '$2y$13$QjjWGoYPeLaLrwnd7HKxruKMtSNJJym1MJQf8o3ejruMsiksHVCQG', 'tata@gmail.com', 1, 'fa77c9fe5cf34850d275acb9d59cfb6f.png', '2017-11-22 15:17:34', NULL, 1, 0),
(9, 'Tutu', '$2y$13$0QdrXnmwrimrvB3N3CSpBeaWwwewUeASeLMRoULF53b/qhCl19qI6', 'tutu@gmail.com', 1, '4a60e3ed6cc5f1e2c24797f8739fd234.png', '2017-11-22 15:18:18', '2017-11-23 08:51:05', 1, 0),
(10, 'Tyty', '$2y$13$W.S2M7ADjQQGM1ApyIdsOe6juR18/XPv46VKmI41KG.cEzrWUAlr.', 'tyty@gmail.com', 1, 'ab9b0e6498c8adcb99904dd5cecac5fe.png', '2017-11-22 15:19:04', '2017-11-22 15:24:52', 1, 0),
(13, 'Benjamin', '$2y$13$BG0p.rM9MrAaj/zFesceNeCRqDhgWRxK1kWsHK3ztVTTtl5tsqa1K', 'bn@gmail.com', 1, '3dbfe1b1a319b521b6794fac6ac3c0b5.png', '2017-11-24 08:51:41', NULL, 1, 0);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `FK_23A0E6612469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  ADD CONSTRAINT `FK_23A0E66A76ED395` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `article_like`
--
ALTER TABLE `article_like`
  ADD CONSTRAINT `FK_1C21C7B27294869C` FOREIGN KEY (`article_id`) REFERENCES `article` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_1C21C7B2A76ED395` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `article_tag`
--
ALTER TABLE `article_tag`
  ADD CONSTRAINT `FK_919694F97294869C` FOREIGN KEY (`article_id`) REFERENCES `article` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_919694F9BAD26311` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `article_watch`
--
ALTER TABLE `article_watch`
  ADD CONSTRAINT `FK_27BC38377294869C` FOREIGN KEY (`article_id`) REFERENCES `article` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_27BC3837A76ED395` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `article_wish`
--
ALTER TABLE `article_wish`
  ADD CONSTRAINT `FK_6793F3C87294869C` FOREIGN KEY (`article_id`) REFERENCES `article` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_6793F3C8A76ED395` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `category_like`
--
ALTER TABLE `category_like`
  ADD CONSTRAINT `FK_27F83AF412469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_27F83AF4A76ED395` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `FK_9474526C7294869C` FOREIGN KEY (`article_id`) REFERENCES `article` (`id`),
  ADD CONSTRAINT `FK_9474526CA76ED395` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
