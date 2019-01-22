-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  mar. 22 jan. 2019 à 16:01
-- Version du serveur :  10.1.32-MariaDB
-- Version de PHP :  7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `dragandlearn`
--

-- --------------------------------------------------------

--
-- Structure de la table `exercice`
--

CREATE TABLE `exercice` (
  `id` int(11) NOT NULL,
  `libelle` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `help` longtext COLLATE utf8mb4_unicode_ci,
  `solution` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level_id` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `instruction` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `lesson` longtext COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `exercice`
--

INSERT INTO `exercice` (`id`, `libelle`, `help`, `solution`, `slug`, `level_id`, `number`, `instruction`, `lesson`) VALUES
(394, 'html exercice1', '<p>Placer les Div l\'une sous l\'autre les Span côte à côte</p>', 'solution1', 'html-exercice1', 49, 0, '<p>Insérer les élément pour observer le placement de ceux ci</p>', '<ul class=\"text-white\">\r\n        <br>\r\n        <li>Pour commencer, il faut préciser le doctype du document, pour démarrer une page html, il faut donc entrer &lt;!DOCTYPE html&gt; au début de la page.</li>\r\n        <br>\r\n        <li>Ensuite, notre page doit être incluse entre deux balises :  une balise ouvrante <span class=\"balise\">&lt;html&gt;</span> en début de page et une balise fermante <span class=\"balise\">&lt;/html&gt;</span> en bas de page.</li>\r\n        <br>\r\n        <li>Dans l\'élément html, il faut indiquer deux autres éléments: \r\n            <p>- l\'élément <span class=\"balise\">&lt;head&gt;</span>qui va contenir les informations générales relatives à la page,  comme le titre ou l\'encodage utilisé</p>\r\n            <p>- l\'élément <span class=\"balise\">&lt;body&gt;</span>qui va contenir le texte, les images ou encore les liens qui seront  affichés sur la page.</p>\r\n        </li>\r\n        <br> \r\n        <li>L\'élément HTML <span class=\"balise\">&lt;div&gt;</span> a une fonction de conteneur, souvent utilisé afin de grouper d\'autres éléments au sein de celle-ci. </li>\r\n        <br> \r\n        <li>L\'élément HTML <span class=\"balise\">&lt;span&gt;</span>  sert principalement à insérér du contenu de type texte, il peut être utilisé pour cibler une portion de texte à l\'intérieur d\'un élément.\r\n        </li>\r\n        <br> \r\n        <li>L\'élément HTML <span class=\"balise\">&lt;p&gt;</span> représente un paragraphe de texte, un retour est à la ligne est créé automatiquement à chaque nouveau paragraphe.</li>\r\n        <br>\r\n    </p>'),
(395, 'html exercice2', '<p>Sauter une ligne avec &lt;br&gt; et un trait avec &lt;hr&gt;</p>', 'solution2', 'html-exercice2', 49, 1, '<p>Insérer 3 titres dans leur ordre d\'importance, sauter une ligne en le titre 1 et 2 et tirer un trait sous le titre 3.</p>', '<ul class=\"text-white\">\r\n    <br>\r\n        <li>Il existe six niveaux de titres dans une page HTML, de <span class=\"balise\">&lt;h1&gt;</span> à <span class=\"balise\">&lt;h6&gt;</span>, du plus important <span class=\"balise\">(&lt;h1&gt;)</span> au moins important<span class=\"balise\">(&lt;h6&gt;)</span>.\r\n        </li>\r\n    <br>\r\n        <li>L\'élément <span class=\"balise\">&lt;br&gt;</span> permet le retour à la ligne, il  peut être utilisé autant de fois que l\'on souhaite. Il s\'utilise seul, il n\'est pas nécessaire de fermer la balise.\r\n        </li>\r\n    <br>\r\n        <li>L\'élément <span class=\"balise\">&lt;hr&gt;</span>, est une balise unique orpheline comme <span class=\"balise\">&lt;br&gt;</span>, elle permet de définir un changement de thématique avec un retour à la ligne.\r\n        </li>\r\n    </ul>'),
(396, 'html exercice3', 'help3', 'solution3', 'html-exercice3', 49, 2, 'instruction3', NULL),
(397, 'html exercice4', 'help4', 'solution4', 'html-exercice4', 49, 3, 'instruction4', NULL),
(398, 'html exercice5', 'help5', 'solution5', 'html-exercice5', 49, 4, 'instruction5', NULL),
(399, 'html exercice6', 'help6', 'solution6', 'html-exercice6', 49, 5, 'instruction6', NULL),
(400, 'html exercice7', '<p>\r\n        les <span class=\"balise\">&lt;input&gt;</span> sont toujours lié à leur <span class=\"balise\">&lt;label&gt;</span> grâce au \"for\" et au \"name\".\r\n        <br>\r\n        Les attributs sont toujours en anglais.\r\n        <br>\r\n        Consultez la documentation si besoin : <a href=\"https://developer.mozilla.org/fr/docs/Web/HTML/Element/Input\">Ici</a>\r\n    </p>', 'solution7', 'html-exercice7', 49, 6, '<p>Dans cette exercice vous allez devoir placer les balises ‘input’ correspondante au label.</p>', '<div>\r\n        <ul class=\"text-white\">\r\n            <br>\r\n            <li>Les formulaires vont nous permettre de recueillir des informations envoyées par nos utilisateurs. Nous allons par exemple utiliser des formulaires HTML pour créer des formulaires d’inscription, des formulaires de contact, etc.</li>\r\n            <br>\r\n            <li>Un formulaire se place entre les deux balises <span class=\"balise\">&lt;form&gt;&lt;/form&gt;</span></li>\r\n            <br>\r\n            <li>Les formulaires vont être l’occasion pour nous d’aborder de nombreux éléments html.\r\n            <br>\r\n             Voici la liste des types d’input que nous allons aborder dans la partie suivante :</li>\r\n            <br>\r\n            <li><span class=\"balise\">&lt;input</span>  <span class=\"baliseCss\"> name</span>=<span class=\"baliseTxt\">\"*correspond au label*\"</span> <span class=\"baliseCss\">type</span>=<span class=\"baliseTxt\">\"*correspond au type d’input*\"</span><span class=\"balise\">&gt;</span></li>\r\n            <br>\r\n            <li><span class=\"baliseCss\">type</span>=<span class=\"baliseTxt\">\"Password\"</span> -> Definit un champ pour un mot de passe</li>           \r\n            <br>\r\n            <li><span class=\"baliseCss\">type</span>=<span class=\"baliseTxt\">\"checkbox\"</span> -> Definit une case a choix multiple</li>\r\n            <br>\r\n            <li><span class=\"baliseCss\">type</span>=<span class=\"baliseTxt\">\"text\"</span> -> Definit un champ de texte</li>\r\n            <br>\r\n            <li><span class=\"baliseCss\">type</span>=<span class=\"baliseTxt\">\"radio\"</span> -> Definit une case a choix unique</li>\r\n            <br>\r\n            <li><span class=\"baliseCss\">type</span>=<span class=\"baliseTxt\">\"email\"</span> -> Definit un champ d’e-mail</li>\r\n            <br>\r\n            <li><span class=\"baliseCss\">type</span>=<span class=\"baliseTxt\">\"date\"</span> -> Definit un champ pour choisir une date</li>\r\n            <br>\r\n            <li><span class=\"balise\">&lt;textarea&gt;</span> Permet de créer une zone de texte plus grande (la taille de la boite de texte peut etre modifiée avec la souris)</li>\r\n            <br>\r\n            <li>\r\n                <span class=\"balise\">&lt;select&gt;</span><br>\r\n                    <span class=\"balise ml-4\">&lt;option&gt;</span> option n°1<span class=\"balise\">&lt;/option&gt;</span><br>\r\n                    <span class=\"balise ml-4\">&lt;option&gt;</span> option n°2<span class=\"balise\">&lt;/option&gt;</span><br>\r\n                    <span class=\"balise ml-4\">&lt;option&gt;</span> option n°3<span class=\"balise\">&lt;/option&gt;</span><br>\r\n                <span class=\"balise\">&lt;/select&gt;</span><br><br>\r\n                <span class=\"balise\">&lt;select&gt;</span> Permet la création d\'une liste déroulante avec différentes options determinées par la balise <span class=\"balise\">&lt;option&gt;</span>\r\n            </li>\r\n            <br>\r\n            <li>La liste complète des types d\'input <a target=\"_blank\" href=\"https://developer.mozilla.org/fr/docs/Web/HTML/Element/Input#Les_diff%C3%A9rents_types_de_champs_%3Cinput%3E\">ici </a> </li>\r\n        </ul>\r\n    </div>'),
(401, 'html exercice8', 'help8', 'solution8', 'html-exercice8', 49, 7, 'instruction8', NULL),
(402, 'html exercice9', 'help9', 'solution9', 'html-exercice9', 49, 8, 'instruction9', NULL),
(403, 'html exercice10', '<p>\r\n Les Etudes et Formations sont sous forme de liste non ordonnées\r\n    <br>\r\n Respectez le format d\'un CV, les dates sont en ordre decroissantes, sautez des ligne entre chaque !\r\n    <br>\r\n    Mettez les titres en bleu 1d8dc0 !\r\n</p>', 'solution10', 'html-exercice10', 49, 9, '<p>Dans cet exercice vous allez devoir mettre en application TOUTES les compétences acquises dans les exercices HTML précédents</p>', '<div>\r\n     <ul class=\"text-white\">\r\n        <br>\r\n         <li>Dans cet exercice vous pouvez constater une nouveauté, l\'attribut <span class=\"baliseCss\">style</span> qui permet d\'ajouter du CSS \'inline\'. Cependant cette methode est a proscrire et se fera le plus souvent dans une feuille de style a part , vous aborderez ce sujet lors du prochain niveau. </li>\r\n         <br>\r\n         <li>La syntaxe de l\'attribut <span class=\"baliseCss\">style</span> est similaire à celle que vous retrouverez dans une feuille CSS. </li>\r\n         <br>\r\n         \r\n     </ul>\r\n </div>'),
(404, 'html/css exercice1', 'help1', 'solution1', 'html-css-exercice1', 50, 0, 'instruction1', NULL),
(405, 'html/css exercice2', 'help2', 'solution2', 'html-css-exercice2', 50, 1, 'instruction2', NULL),
(406, 'html/css exercice3', 'help3', 'solution3', 'html-css-exercice3', 50, 2, 'instruction3', NULL),
(407, 'html/css exercice4', 'help4', 'solution4', 'html-css-exercice4', 50, 3, 'instruction4', NULL),
(408, 'html/css exercice5', 'help5', 'solution5', 'html-css-exercice5', 50, 4, 'instruction5', NULL),
(409, 'html/css exercice6', 'help6', 'solution6', 'html-css-exercice6', 50, 5, 'instruction6', NULL),
(410, 'html/css exercice7', 'help7', 'solution7', 'html-css-exercice7', 50, 6, 'instruction7', NULL),
(411, 'html/css exercice8', 'help8', 'solution8', 'html-css-exercice8', 50, 7, 'instruction8', NULL),
(412, 'html/css exercice9', '<p> N\'oubliez pas qu\'un élément en position absolu se place par rapport à son premier parent relatif</p>\r\n    <p>Consultez la documentation : <a href=\"https://developer.mozilla.org/fr/docs/Web/CSS/position\">Ici</a></p>', 'solution9', 'html-css-exercice9', 50, 8, '<p>A l\'aide des propriétés position et float, tentez de reproduire la fameuse souris si chère à Walt Disney.</p>', '<ul class=\"text-white\">\r\n    <br>\r\n        <li>La propriété <span class=\"propCss\">position</span> définit la façon dont un élément est positionné dans un document. Elle comprend quatre valeurs différentes :\r\n            <br>\r\n            - static\r\n            <br>\r\n            - relative\r\n            <br>\r\n            - fixed\r\n            <br>\r\n            - absolute\r\n            <br>\r\n        </li>\r\n        <br>\r\n        <li>La propriété CSS <span class=\"propCss\">float</span> permet de spécifier qu\'un élément flotte à gauche, à droite ou pas du tout au sein de son élément conteneur. \r\n        </li>\r\n      \r\n    </ul>'),
(413, 'html/css exercice10', '<p>\r\n        Vous êtes assez grand maintenant pour chercher les réponses vous même ,c\'est le coeur du metier de developpeur web !\r\n        il existe notamment deux gros sites :<br>\r\n        <a href=\"https://www.w3schools.com/\">W3C</a>, en Anglais mais la W3corporation repertorie les normes et conventions du html et sert donc de référent.\r\n        <br>\r\n        <a href=\"https://developer.mozilla.org/fr/\">MDN</a> en grande partie en Français.\r\n    </p>', 'solution10', 'html-css-exercice10', 50, 9, '<p>Dans cette exercice vous allez devoir mettre vos conpetences en application pour realiser le CV d\'un super hero</p>', '<div>\r\n     <ul class=\"text-white\">\r\n         <li>Vous etes grand maintenant !</li>\r\n         <br>\r\n         <li>Nous avons inclus dans cet exercice du JAVASCRIPT , il sert notamment a dynamiser un site web. </li>\r\n         <br>\r\n         <li>Ici le Javascript rend dynamique la gestion des statistiques de votre heros , jouez avec différentes valeurs et regardez ce qu\'il se passe !</li>\r\n         <br>\r\n     </ul>\r\n </div>'),
(414, 'html/css/js exercice', 'help1', 'solution1', 'html-css-js-exercice1', 51, 0, 'instruction1', NULL),
(415, 'html/css/js exercice', 'help2', 'solution2', 'html-css-js-exercice2', 51, 1, 'instruction2', NULL),
(416, 'html/css/js exercice', 'help3', 'solution3', 'html-css-js-exercice3', 51, 2, 'instruction3', NULL),
(417, 'html/css/js exercice', 'help4', 'solution4', 'html-css-js-exercice4', 51, 3, 'instruction4', NULL),
(418, 'html/css/js exercice', 'help5', 'solution5', 'html-css-js-exercice5', 51, 4, 'instruction5', NULL),
(419, 'html/css/js exercice', 'help6', 'solution6', 'html-css-js-exercice6', 51, 5, 'instruction6', NULL),
(420, 'html/css/js exercice', 'help7', 'solution7', 'html-css-js-exercice7', 51, 6, 'instruction7', NULL),
(421, 'html/css/js exercice', 'help8', 'solution8', 'html-css-js-exercice8', 51, 7, 'instruction8', NULL),
(422, 'html/css/js exercice', 'help9', 'solution9', 'html-css-js-exercice9', 51, 8, 'instruction9', NULL),
(423, 'html/css/js exercice', 'help10', 'solution10', 'html-css-js-exercice10', 51, 9, 'instruction10', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `level`
--

CREATE TABLE `level` (
  `id` int(11) NOT NULL,
  `number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `level`
--

INSERT INTO `level` (`id`, `number`) VALUES
(49, 1),
(50, 2),
(51, 3);

-- --------------------------------------------------------

--
-- Structure de la table `migration_versions`
--

CREATE TABLE `migration_versions` (
  `version` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `migration_versions`
--

INSERT INTO `migration_versions` (`version`) VALUES
('20190110165035'),
('20190110170906'),
('20190110182412'),
('20190114073021'),
('20190114120158'),
('20190117171307'),
('20190118083954'),
('20190121082427');

-- --------------------------------------------------------

--
-- Structure de la table `theme`
--

CREATE TABLE `theme` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `theme`
--

INSERT INTO `theme` (`id`, `name`, `color`) VALUES
(67, 'Defaut', 'dark'),
(68, 'Vert', 'success'),
(69, 'Noir', 'dark'),
(70, 'Bleu', 'primary'),
(71, 'Rouge', 'danger'),
(72, 'Gris', 'secondary'),
(73, 'Jaune', 'warning'),
(74, 'Turquoise', 'info');

-- --------------------------------------------------------

--
-- Structure de la table `trophy`
--

CREATE TABLE `trophy` (
  `id` int(11) NOT NULL,
  `libelle` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icone` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hidden` tinyint(1) NOT NULL,
  `non_obtain_icone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `trophy`
--

INSERT INTO `trophy` (`id`, `libelle`, `icone`, `hidden`, `non_obtain_icone`) VALUES
(28, 'Niveau 1', 'trophy_one.png', 0, 'trophy_one_non_obtain.png'),
(29, 'Niveau 2', 'trophy_two.png', 0, 'trophy_two_non_obtain.png'),
(30, 'F12', 'trophy_three.png', 1, 'trophy_hidden.png'),
(31, 'Niveau 4', 'trophy_hidden.png', 0, 'trophy_hidden.png'),
(32, 'Niveau 5', 'trophy_hidden.png', 0, 'trophy_hidden.png'),
(33, 'Niveau 6', 'trophy_hidden.png', 0, 'trophy_hidden.png');

-- --------------------------------------------------------

--
-- Structure de la table `trophy_user`
--

CREATE TABLE `trophy_user` (
  `trophy_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `trophy_user`
--

INSERT INTO `trophy_user` (`trophy_id`, `user_id`) VALUES
(30, 37);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `theme_id` int(11) DEFAULT NULL,
  `username` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reset_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `theme_id`, `username`, `roles`, `password`, `email`, `avatar`, `reset_token`) VALUES
(34, 67, 'Learner', 'a:1:{i:0;s:10:\"ROLE_ADMIN\";}', '$2y$13$eIcF.WVB6Yr8kfRPoq4ApOxKM8Ilkeu2J9HRZyxqv5.RLhsUF.rNS', 'learner0@admin.com', 'default.png', NULL),
(35, 67, 'Learner9', 'a:1:{i:0;s:10:\"ROLE_ADMIN\";}', '$2y$13$8dQ99QzBI3YGPjoNwHbNa.nTIjc0b.hUsLfDueBUEu90YEIH0Gj5i', 'learner1@admin.com', 'default.png', NULL),
(36, 72, 'Learner2', 'a:1:{i:0;s:10:\"ROLE_ADMIN\";}', '$2y$13$Oi2qi40lytJu6AlED6plhOjHFLl67z45K8lB9FRl582Z3buUMGJL.', 'learner2@admin.com', '50cd76de01c636c5737bdce27c143ab3.png', NULL),
(37, 67, 'Learner3', 'a:1:{i:0;s:10:\"ROLE_ADMIN\";}', '$2y$13$LAf6PTqo8mgc0tmHxRtK1.sRIy9xeXqzuuyVxzBFDinVgzi/HXk2u', 'learner3@admin.com', 'default.png', NULL),
(38, 67, 'Learner4', 'a:1:{i:0;s:10:\"ROLE_ADMIN\";}', '$2y$13$yTJCW04F2HSlp.bzeOsi9uw4kzaPnrlTs.60c.jkicw4HKAlK1Lfe', 'learner4@admin.com', 'default.png', NULL),
(39, 67, 'NewLearner', 'a:1:{i:0;s:9:\"ROLE_USER\";}', '$2y$13$H9r58NqyyKVUGdalC7QDcOta97/TLedHdu0nlg4X/GThpNcNrHGKu', 'new@kiki.com', 'default.png', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `user_has_exercices`
--

CREATE TABLE `user_has_exercices` (
  `id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `exercices_id` int(11) NOT NULL,
  `time` time NOT NULL,
  `finish` tinyint(1) DEFAULT NULL,
  `value` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user_has_exercices`
--

INSERT INTO `user_has_exercices` (`id`, `users_id`, `exercices_id`, `time`, `finish`, `value`) VALUES
(513, 34, 394, '00:34:07', 1, '10'),
(514, 34, 395, '00:14:24', 1, '11'),
(515, 34, 396, '00:48:09', 1, '12'),
(516, 34, 397, '00:05:12', 1, '13'),
(517, 34, 398, '00:02:56', 1, '14'),
(518, 34, 399, '00:26:53', 1, '15'),
(519, 34, 400, '00:23:48', 1, '16'),
(520, 34, 401, '00:01:06', 1, '17'),
(521, 34, 402, '00:46:19', 1, '18'),
(522, 34, 403, '00:45:16', 1, '19'),
(523, 34, 404, '00:03:26', 1, '20'),
(524, 34, 405, '00:09:14', 1, '21'),
(525, 34, 406, '00:26:49', 1, '22'),
(526, 34, 407, '00:27:51', 1, '23'),
(527, 34, 408, '00:37:08', 1, '24'),
(528, 34, 409, '00:20:10', 1, '25'),
(529, 34, 410, '00:21:26', 1, '26'),
(530, 34, 411, '00:38:19', 1, '27'),
(531, 34, 412, '00:20:30', 1, '28'),
(532, 34, 413, '00:17:51', 1, '29'),
(533, 35, 394, '00:24:42', 1, '10'),
(534, 35, 395, '00:48:44', 1, '11'),
(535, 35, 396, '00:42:05', 1, '12'),
(536, 35, 397, '00:37:46', 1, '13'),
(537, 35, 398, '00:12:43', 1, '14'),
(538, 35, 399, '00:04:24', 1, '15'),
(539, 35, 400, '00:06:33', 1, '16'),
(540, 35, 401, '00:06:33', 1, '17'),
(541, 35, 402, '00:26:04', 1, '18'),
(542, 35, 403, '00:11:52', 1, '19'),
(543, 35, 404, '00:00:06', 1, '20'),
(544, 35, 405, '00:21:29', 1, '21'),
(545, 35, 406, '00:39:44', 1, '22'),
(546, 35, 407, '00:20:02', 1, '23'),
(547, 35, 408, '00:32:51', 1, '24'),
(548, 35, 409, '00:17:24', 1, '25'),
(549, 35, 410, '00:46:33', 1, '26'),
(550, 35, 411, '00:39:55', 1, '27'),
(551, 35, 412, '00:30:32', 1, '28'),
(552, 35, 413, '00:47:56', 1, '29'),
(553, 36, 394, '00:00:00', 1, '10'),
(554, 36, 395, '00:00:00', 1, '11'),
(555, 36, 396, '00:00:00', 1, '12'),
(556, 36, 397, '00:02:42', 1, '13'),
(557, 36, 398, '00:40:07', 1, '14'),
(558, 36, 399, '00:13:09', 1, '15'),
(559, 36, 400, '00:00:00', 1, '16'),
(560, 36, 401, '00:48:15', 1, '17'),
(561, 36, 402, '00:23:21', 1, '18'),
(562, 36, 403, '00:00:00', 1, '19'),
(563, 36, 404, '00:07:42', 1, '20'),
(564, 36, 405, '00:39:51', 1, '21'),
(565, 36, 406, '00:20:41', 1, '22'),
(566, 36, 407, '00:23:43', 1, '23'),
(567, 36, 408, '00:40:18', 1, '24'),
(568, 36, 409, '00:06:37', 1, '25'),
(569, 36, 410, '00:29:18', 1, '26'),
(570, 36, 411, '00:05:23', 1, '27'),
(571, 36, 412, '00:13:04', 1, '28'),
(572, 36, 413, '00:25:58', 1, '29'),
(573, 37, 394, '00:00:00', 1, '10'),
(574, 37, 395, '00:47:09', 1, '11'),
(575, 37, 396, '00:22:34', 1, '12'),
(576, 37, 397, '00:27:13', 1, '13'),
(577, 37, 398, '00:41:44', 1, '14'),
(578, 37, 399, '00:12:31', 1, '15'),
(579, 37, 400, '00:18:18', 1, '16'),
(580, 37, 401, '00:06:38', 1, '17'),
(581, 37, 402, '00:30:44', 1, '18'),
(582, 37, 403, '00:00:00', 1, '19'),
(583, 37, 404, '00:07:54', 1, '20'),
(584, 37, 405, '00:05:12', 1, '21'),
(585, 37, 406, '00:09:18', 1, '22'),
(586, 37, 407, '00:18:43', 1, '23'),
(587, 37, 408, '00:04:42', 1, '24'),
(588, 37, 409, '00:43:33', 1, '25'),
(589, 37, 410, '00:45:40', 1, '26'),
(590, 37, 411, '00:09:38', 1, '27'),
(591, 37, 412, '00:14:54', 1, '28'),
(592, 37, 413, '00:01:26', 1, '29'),
(593, 38, 394, '00:27:03', 1, '10'),
(594, 38, 395, '00:00:23', 1, '11'),
(595, 38, 396, '00:48:12', 1, '12'),
(596, 38, 397, '00:38:51', 1, '13'),
(597, 38, 398, '00:50:47', 1, '14'),
(598, 38, 399, '00:20:43', 1, '15'),
(599, 38, 400, '00:36:38', 1, '16'),
(600, 38, 401, '00:46:18', 1, '17'),
(601, 38, 402, '00:19:55', 1, '18'),
(602, 38, 403, '00:50:33', 1, '19'),
(603, 38, 404, '00:19:21', 1, '20'),
(604, 38, 405, '00:38:59', 1, '21'),
(605, 38, 406, '00:42:26', 1, '22'),
(606, 38, 407, '00:12:50', 1, '23'),
(607, 38, 408, '00:26:52', 1, '24'),
(608, 38, 409, '00:08:23', 1, '25'),
(609, 38, 410, '00:48:20', 1, '26'),
(610, 38, 411, '00:03:48', 1, '27'),
(611, 38, 412, '00:25:42', 1, '28'),
(612, 38, 413, '00:11:06', 1, '29'),
(613, 39, 394, '00:00:00', 0, '10');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `exercice`
--
ALTER TABLE `exercice`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_E418C74D989D9B62` (`slug`),
  ADD KEY `IDX_E418C74D5FB14BA7` (`level_id`);

--
-- Index pour la table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `migration_versions`
--
ALTER TABLE `migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `theme`
--
ALTER TABLE `theme`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `trophy`
--
ALTER TABLE `trophy`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `trophy_user`
--
ALTER TABLE `trophy_user`
  ADD PRIMARY KEY (`trophy_id`,`user_id`),
  ADD KEY `IDX_7AAA1519F59AEEEF` (`trophy_id`),
  ADD KEY `IDX_7AAA1519A76ED395` (`user_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649F85E0677` (`username`),
  ADD KEY `IDX_8D93D64959027487` (`theme_id`);

--
-- Index pour la table `user_has_exercices`
--
ALTER TABLE `user_has_exercices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_DCACD5FE67B3B43D` (`users_id`),
  ADD KEY `IDX_DCACD5FE192C7251` (`exercices_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `exercice`
--
ALTER TABLE `exercice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=424;

--
-- AUTO_INCREMENT pour la table `level`
--
ALTER TABLE `level`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT pour la table `theme`
--
ALTER TABLE `theme`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT pour la table `trophy`
--
ALTER TABLE `trophy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT pour la table `user_has_exercices`
--
ALTER TABLE `user_has_exercices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=614;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `exercice`
--
ALTER TABLE `exercice`
  ADD CONSTRAINT `FK_E418C74D5FB14BA7` FOREIGN KEY (`level_id`) REFERENCES `level` (`id`);

--
-- Contraintes pour la table `trophy_user`
--
ALTER TABLE `trophy_user`
  ADD CONSTRAINT `FK_7AAA1519A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_7AAA1519F59AEEEF` FOREIGN KEY (`trophy_id`) REFERENCES `trophy` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_8D93D64959027487` FOREIGN KEY (`theme_id`) REFERENCES `theme` (`id`);

--
-- Contraintes pour la table `user_has_exercices`
--
ALTER TABLE `user_has_exercices`
  ADD CONSTRAINT `FK_DCACD5FE192C7251` FOREIGN KEY (`exercices_id`) REFERENCES `exercice` (`id`),
  ADD CONSTRAINT `FK_DCACD5FE67B3B43D` FOREIGN KEY (`users_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
