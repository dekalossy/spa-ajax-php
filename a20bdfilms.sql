-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3308
-- Généré le :  Dim 14 mars 2021 à 21:44
-- Version du serveur :  8.0.18
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `a20bdfilms`
--

-- --------------------------------------------------------

--
-- Structure de la table `films`
--

DROP TABLE IF EXISTS `films`;
CREATE TABLE IF NOT EXISTS `films` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categorie` varchar(255) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `realisateur` varchar(255) NOT NULL,
  `duree` varchar(10) NOT NULL,
  `dateFilm` date NOT NULL,
  `pochette` varchar(55) NOT NULL,
  `url` varchar(255) NOT NULL,
  `synopsys` text NOT NULL,
  `prix` decimal(10,0) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `films`
--

INSERT INTO `films` (`id`, `categorie`, `titre`, `realisateur`, `duree`, `dateFilm`, `pochette`, `url`, `synopsys`, `prix`) VALUES
(6, 'SUSPENSE', 'SEIGNEUR DES ANNEAUX, les deux tours', 'Disney', '1H30', '2020-12-11', 'a8.jpg', 'c9blKqmyeV4', 'Après les aventures de Jango et Boba Fett, un nouveau héros émerge dans l\'univers Star Wars.  										  L\'intrigue, située entre la chute de l\'Empire et l\'émergence du Premier Ordre, suit les  										  voyages d\'un chasseur de primes solitaire dans les contrées les plus éloignées de la Galaxie,  loin de l’autorité de la Nouvelle République.', '8'),
(9, 'DRAME', 'N\'ECOUTE PAS', 'Chanel 88', '1H23', '2018-02-07', 'h5am.jpg', 'PYCjssAhB2c', 'Daniel et Sara ont un fils de 9 ans, Eric, et ils viennent de déménager dans une nouvelle maison  sans savoir que les voisins l\'appellent \"la maison des voix\". Eric est le premier à remarquer les bruits étranges derrière chaque porte.', '12'),
(10, 'DRAME', 'HOBBIT, un voyage innattendu', 'Seagal Charles', '2H05', '2019-02-19', 'h10am.jpg', 'tiy7peMH3g8', 'Dans \"Un voyage inattendu\", Bilbon Sacquet cherche à reprendre le Royaume perdu des Nains d\'Erebor,  										  conquis par le redoutable dragon Smaug. Alors qu\'il croise par hasard la route du magicien Gandalf le Gris,  Bilbon rejoint une bande de 13 nains dont le chef n\'est autre que le légendaire guerrier Thorin Écu-de-Chêne. Leur périple les conduit au cœur du Pays Sauvage, où ils devront affronter des Gobelins, des Orques, des Ouargues meurtriers, des Araignées géantes, des Métamorphes et des Sorciers…', '4'),
(13, 'ROMANTIQUE', 'NOEL DE RÊVE', 'Disney', '2H20', '2019-12-25', 'h7am.jpg', 'vF0ppR5fMPw', 'L\'histoire réconfortante d\'une petite fille déterminée qui entreprend de réunir sa famille à temps pour Noël.', '3'),
(16, 'ACTION', 'AVA', 'Tate Taylor', '1H37', '2020-10-10', 'h6am.jpg', 'HIVDW4CREik', 'Une femme assassin du nom de Eve travaille pour une importante organisation secrète. Elle parcourt le monde. Une de ses missions se passe mal, elle va être contrainte de lutter pour sa propre survie.', '7'),
(18, 'SUSPENSE', 'SEIGNEUR DES ANNEAUX, La communauté de l\'agneau', ' Peter Jackson', '2H05', '2003-11-30', 'h1am.jpg', 'nalLU8i4zgs', 'trois. Perdus dans les collines d\'Emyn Muil, Frodon et Sam découvrent qu\'ils sont suivis par Gollum,une créature versatile corrompue par l\'Anneau. Celui-ci promet de conduire les Hobbits jusqu\'à la Porte Noire du Mordor. À travers la Terre du Milieu, Aragorn, Legolas et Gimli font route vers le Rohan, le royaume assiégé de Theoden. Cet ancien grand roi, manipulé par l\'espion de Saroumane, le sinistre Langue de Serpent, est désormais tombé sous la coupe du malfaisant Magicien.Eowyn, la nièce du Roi, reconnaît en Aragorn un meneur d\'hommes. Entretemps, les Hobbits Merry et Pippin, prisonniers des Uruk-hai, se sont échappés et ont découvert dans la mystérieuse Forêt de Fangorn un allié inattendu : Sylvebarbe, gardien des arbres, représentant d\'un ancien peuple végétal dont Saroumane a décimé la forêt...', '8'),
(19, 'ROMANTIQUE', 'LES CHRONIQUES DE NOEL 2', 'Chris Columbus', '1h42', '2020-11-18', 'h8am.jpg', '8qYiBDVTEtI', 'Désormais ado et cynique, Kate Pierce fait une nouvelle fois équipe avec le père Noël quand un mystérieux fauteur de troubles menace de supprimer Noël... pour toujours.', '6'),
(20, 'ACTION', 'ALIEN3', 'David Fincher', '2h25', '1992-05-22', 'h2am.jpg', 'qL-NR79zS7A', 'Fiorina 161 est une planète morte, qui ne sert plus qu\'à abriter une poignée de détenus de droits communs très dangereux. C\'est la qu\'échoue Ripley, unique survivante d\'un carnage provoqué par les Aliens sur une lointaine planète. Rongée par l\'angoisse de voir le danger réapparaitre, elle ignore encore que l\'Alien est en elle...', '5'),
(21, 'DRAME', 'The Mandalorian', 'Jon Favreau', '2H15', '2019-10-31', 'h4am.jpg', 'aOC8E8z_ifw', 'Un tireur solitaire voyage dans les contrées les plus reculées de la galaxie, loin du joug de la Nouvelle République.', '7'),
(22, 'SUSPENSE', 'SEIGNEUR DES ANNEAUX, Le retour du roi', 'Peter Jackson', '3H20', '2003-11-30', 'h9am.jpg', 'RCuDRcK0BBM', 'Les armées de Sauron ont attaqué `Minas Tirith\', la capitale de `Gondor\'. Jamais ce royaume autrefois puissant n\'a eu autant besoin de son roi. Cependant, Aragorn trouvera-t-il en lui la volonté d\'accomplir sa destinée ? Tandis que Gandalf s\'efforce de soutenir les forces brisées de Gondor, Théoden …', '8'),
(23, 'ACTION', 'BREACH', 'John Suits', '1H32', '2020-12-17', 'breach.jpg', 'OR_ce_9NRks', 'Tandis qu\'il s\'apprête à devenir père, un jeune mécanicien travaillant sur une navette spatiale destinée à trouver une nouvelle Terre se retrouve à déjouer une force cosmique malveillante. Doué de métamorphose, l\'extraterrestre sème le chaos sur la navette spatiale afin de détruire ce qu\'il reste de l\'humanité.', '9'),
(24, 'ROMANTIQUE', 'FREAKY', '	Christopher Landon', '1H41', '2020-11-17', 'Freaky.jpg', 'IE0GZdt5tss', 'Millie Kessler, une lycéenne de dix-sept ans, est loin d\'être populaire ou à la pointe de la mode. Les autres élèves du lycée Blissfield High se font un malin plaisir à se moquer d\'elle. Un soir de match où elle officie en tant mascotte, elle devient la cible de Barney Garris, alias le « Boucher », un tueur en série qui sévit dans sa ville. Néanmoins, la dague ancienne qu\'utilise ce dernier déclenche quelque chose de surnaturel et les fait échanger de corps.', '8'),
(25, 'ROMANTIQUE', 'LA VIE EST BELLE', 'Warner Chappell', '2H35', '2011-06-17', 'laVieEstBelle.jpg', 'D3-KV8pyLQg', 'Nous entendons tout d\'abord, le thème de la vie puis, quand Dora tombe du poulailler, le thème de l\'amour.', '5'),
(26, 'DRAME', 'FOREST GUMP', 'Robert Zemeckis', '2H22', '1994-08-17', 'ForrestGump.jpg', 'uPIEn0M8su0', 'Le film relate la vie mouvementée de Forrest Gump, un « simple d\'esprit » originaire de l\'Alabama qui se retrouve impliqué — le plus souvent involontairement — dans les principaux événements qui marquent l\'histoire des États-Unis d\'Amérique entre les années 1950 et les années 1980, en étant même parfois l\'initiateur.', '3'),
(27, 'ACTION', 'TENET', 'Christopher Nolan', '2H30', '2020-12-02', 'Tenet.jpg', 'L3pk_TBkihU', 'Un agent de la CIA, le « protagoniste » (John David Washington), s\'infiltre au sein d\'une opération clandestine russe : le vol d\'un objet mystérieux durant une prise d\'otages dans un opéra à Kiev. En plein danger, il est sauvé par une « balle inversée » tirée par un agent masqué, ayant comme signe distinctif une lanière rouge sur son sac à dos. Le protagoniste rejoint les agents russes, qui — ayant réalisé le but réel du protagoniste — le torturent.', '8'),
(28, 'SUSPENSE', 'UN VOISIN TROP PARFAIT', 'Rob Cohen', '1H31', '2015-06-16', 'UnVoisinTrop.jpg', 'NdRyerT6AcQ', 'À Los Angeles, Claire Peterson (Jennifer Lopez), une professeure divorcée, a une aventure avec son nouveau voisin Noah Sandborn (Ryan Guzman), âgé de 19 ans, un élève du lycée où elle travaille. Lorsque celle-ci décide de cesser de le voir, ses ennuis vont commencer, car Noah n\'a pas l\'intention de la laisser lui échapper...', '3');

-- --------------------------------------------------------

--
-- Structure de la table `membres`
--

DROP TABLE IF EXISTS `membres`;
CREATE TABLE IF NOT EXISTS `membres` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(55) NOT NULL,
  `prenom` varchar(55) NOT NULL,
  `courriel` varchar(255) NOT NULL,
  `codePostal` varchar(55) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `motDePasse` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `avatar` varchar(55) NOT NULL,
  `confirmkey` varchar(255) NOT NULL,
  `confirme` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `membres`
--

INSERT INTO `membres` (`id`, `nom`, `prenom`, `courriel`, `codePostal`, `motDePasse`, `avatar`, `confirmkey`, `confirme`) VALUES
(7, 'admin', 'admin', 'admin@amtfilm.ca', 'H8ST9', 'a642a77abd7d4f51bf9226ceaf891fcbb5b299b8', 'default.jpg', '2456238977', 1),
(14, 'tal', 'dibilan', 'd.kalossy@gmail.com', 'h8s 3n1', '74a871acbf060dda5fc7260d05a5924a34e4c0e7', 'tal.jpg', '4273080244', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
