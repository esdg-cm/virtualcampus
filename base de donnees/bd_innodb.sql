-- --------------------------------------------------------
-- Hôte :                        localhost
-- Version du serveur:           10.4.11-MariaDB - mariadb.org binary distribution
-- SE du serveur:                Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Listage de la structure de la base pour elearning
DROP DATABASE IF EXISTS `elearning`;
CREATE DATABASE IF NOT EXISTS `elearning` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `elearning`;

-- Listage de la structure de la table elearning. affectations
DROP TABLE IF EXISTS `affectations`;
CREATE TABLE IF NOT EXISTS `affectations` (
  `id_affectation` int(11) NOT NULL AUTO_INCREMENT,
  `id_classe` int(11) NOT NULL,
  `id_matiere` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  PRIMARY KEY (`id_affectation`),
  KEY `id_utilisateur` (`id_utilisateur`),
  KEY `id_classe` (`id_classe`),
  KEY `id_matiere` (`id_matiere`),
  CONSTRAINT `affectations_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `professeurs` (`id_utilisateur`),
  CONSTRAINT `affectations_ibfk_2` FOREIGN KEY (`id_classe`) REFERENCES `classes` (`id_classe`),
  CONSTRAINT `affectations_ibfk_3` FOREIGN KEY (`id_matiere`) REFERENCES `matieres` (`id_matiere`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table elearning. billets_forum
DROP TABLE IF EXISTS `billets_forum`;
CREATE TABLE IF NOT EXISTS `billets_forum` (
  `id_billet` int(11) NOT NULL AUTO_INCREMENT,
  `id_filiere` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `sujet` varchar(254) NOT NULL,
  `contenu` text NOT NULL,
  `date_publication` datetime NOT NULL,
  `statut_existant` int(11) NOT NULL,
  PRIMARY KEY (`id_billet`),
  KEY `id_utilisateur` (`id_utilisateur`),
  KEY `id_filiere` (`id_filiere`),
  CONSTRAINT `billets_forum_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateurs` (`id_utilisateur`),
  CONSTRAINT `billets_forum_ibfk_2` FOREIGN KEY (`id_filiere`) REFERENCES `fillieres` (`id_filiere`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table elearning. centres
DROP TABLE IF EXISTS `centres`;
CREATE TABLE IF NOT EXISTS `centres` (
  `id_centre` int(11) NOT NULL AUTO_INCREMENT,
  `nom_centre` varchar(54) NOT NULL,
  `code_centre` varchar(10) NOT NULL,
  `tel_responsable` varchar(20) NOT NULL,
  `statut_existant` int(11) NOT NULL,
  PRIMARY KEY (`id_centre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table elearning. chapitres_cours
DROP TABLE IF EXISTS `chapitres_cours`;
CREATE TABLE IF NOT EXISTS `chapitres_cours` (
  `id_chapitre` int(11) NOT NULL AUTO_INCREMENT,
  `id_partie` int(11) NOT NULL,
  `titre_chap` varchar(128) NOT NULL,
  `num_chap` int(11) NOT NULL,
  `contenu` text DEFAULT NULL,
  `statut_existant` int(11) NOT NULL,
  PRIMARY KEY (`id_chapitre`),
  KEY `id_partie` (`id_partie`),
  CONSTRAINT `chapitres_cours_ibfk_1` FOREIGN KEY (`id_partie`) REFERENCES `parties_cours` (`id_partie`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table elearning. classes
DROP TABLE IF EXISTS `classes`;
CREATE TABLE IF NOT EXISTS `classes` (
  `id_classe` int(11) NOT NULL AUTO_INCREMENT,
  `id_centre` int(11) NOT NULL,
  `id_filiere` int(11) NOT NULL,
  `id_niveau` int(11) NOT NULL,
  `nom_classe` varchar(54) NOT NULL,
  `code_classe` varchar(10) NOT NULL,
  `statut_existant` int(11) NOT NULL,
  PRIMARY KEY (`id_classe`),
  KEY `id_filiere` (`id_filiere`),
  KEY `id_niveau` (`id_niveau`),
  KEY `id_centre` (`id_centre`),
  CONSTRAINT `classes_ibfk_1` FOREIGN KEY (`id_filiere`) REFERENCES `fillieres` (`id_filiere`),
  CONSTRAINT `classes_ibfk_2` FOREIGN KEY (`id_niveau`) REFERENCES `niveaux` (`id_niveau`),
  CONSTRAINT `classes_ibfk_3` FOREIGN KEY (`id_centre`) REFERENCES `centres` (`id_centre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table elearning. commentaires_forum
DROP TABLE IF EXISTS `commentaires_forum`;
CREATE TABLE IF NOT EXISTS `commentaires_forum` (
  `id_commentaire` int(11) NOT NULL AUTO_INCREMENT,
  `id_billet` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `date_commentaire` datetime NOT NULL,
  `contenu` text NOT NULL,
  `statut_existant` int(11) NOT NULL,
  PRIMARY KEY (`id_commentaire`),
  KEY `id_billet` (`id_billet`),
  KEY `id_utilisateur` (`id_utilisateur`),
  CONSTRAINT `commentaires_forum_ibfk_1` FOREIGN KEY (`id_billet`) REFERENCES `billets_forum` (`id_billet`),
  CONSTRAINT `commentaires_forum_ibfk_2` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateurs` (`id_utilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table elearning. etudiants
DROP TABLE IF EXISTS `etudiants`;
CREATE TABLE IF NOT EXISTS `etudiants` (
  `id_utilisateur` int(11) NOT NULL,
  `id_classe` int(11) NOT NULL,
  `matricule` varchar(254) NOT NULL,
  `date_naiss` datetime NOT NULL,
  `lieu_naiss` varchar(254) NOT NULL,
  PRIMARY KEY (`id_utilisateur`),
  KEY `id_classe` (`id_classe`),
  CONSTRAINT `etudiants_ibfk_1` FOREIGN KEY (`id_classe`) REFERENCES `classes` (`id_classe`),
  CONSTRAINT `etudiants_ibfk_2` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateurs` (`id_utilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table elearning. evaluations
DROP TABLE IF EXISTS `evaluations`;
CREATE TABLE IF NOT EXISTS `evaluations` (
  `id_utilisateur` int(11) NOT NULL,
  `id_examen` int(11) NOT NULL,
  `note` float DEFAULT NULL,
  PRIMARY KEY (`id_utilisateur`,`id_examen`),
  KEY `id_examen` (`id_examen`),
  CONSTRAINT `evaluations_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `etudiants` (`id_utilisateur`),
  CONSTRAINT `evaluations_ibfk_2` FOREIGN KEY (`id_examen`) REFERENCES `examens` (`id_examen`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table elearning. examens
DROP TABLE IF EXISTS `examens`;
CREATE TABLE IF NOT EXISTS `examens` (
  `id_examen` int(11) NOT NULL AUTO_INCREMENT,
  `id_type_examen` int(11) NOT NULL,
  `id_matiere` int(11) NOT NULL,
  `duree` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `pts_juste` int(11) DEFAULT NULL,
  `pts_faux` int(11) DEFAULT NULL,
  `pts_aucun` int(11) DEFAULT NULL,
  `statut_existant` int(11) NOT NULL,
  PRIMARY KEY (`id_examen`),
  KEY `id_type_examen` (`id_type_examen`),
  KEY `id_matiere` (`id_matiere`),
  CONSTRAINT `examens_ibfk_1` FOREIGN KEY (`id_type_examen`) REFERENCES `types_examens` (`id_type_examen`),
  CONSTRAINT `examens_ibfk_2` FOREIGN KEY (`id_matiere`) REFERENCES `matieres` (`id_matiere`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table elearning. fillieres
DROP TABLE IF EXISTS `fillieres`;
CREATE TABLE IF NOT EXISTS `fillieres` (
  `id_filiere` int(11) NOT NULL AUTO_INCREMENT,
  `nom_filiere` varchar(54) NOT NULL,
  `code_filiere` varchar(10) NOT NULL,
  `statut_existant` int(11) NOT NULL,
  PRIMARY KEY (`id_filiere`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table elearning. matieres
DROP TABLE IF EXISTS `matieres`;
CREATE TABLE IF NOT EXISTS `matieres` (
  `id_matiere` int(11) NOT NULL AUTO_INCREMENT,
  `id_ue` int(11) NOT NULL,
  `nom_matiere` varchar(54) DEFAULT NULL,
  `code_matiere` varchar(10) DEFAULT NULL,
  `coef` int(11) NOT NULL,
  `nbr_hr_tp` int(11) NOT NULL,
  `nbt_hr_td` int(11) NOT NULL,
  `nbr_hr_cm` int(11) NOT NULL,
  `statut_existant` int(11) NOT NULL,
  PRIMARY KEY (`id_matiere`),
  KEY `id_ue` (`id_ue`),
  CONSTRAINT `matieres_ibfk_1` FOREIGN KEY (`id_ue`) REFERENCES `ue` (`id_ue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table elearning. niveaux
DROP TABLE IF EXISTS `niveaux`;
CREATE TABLE IF NOT EXISTS `niveaux` (
  `id_niveau` int(11) NOT NULL AUTO_INCREMENT,
  `nom_niveau` varchar(54) NOT NULL,
  `code_niveau` varchar(10) NOT NULL,
  `statut_existant` int(11) NOT NULL,
  PRIMARY KEY (`id_niveau`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table elearning. parties_cours
DROP TABLE IF EXISTS `parties_cours`;
CREATE TABLE IF NOT EXISTS `parties_cours` (
  `id_partie` int(11) NOT NULL AUTO_INCREMENT,
  `id_matiere` int(11) NOT NULL,
  `titre_partie` varchar(128) NOT NULL,
  `num_partie` int(11) NOT NULL,
  `statut_existant` int(11) NOT NULL,
  PRIMARY KEY (`id_partie`),
  KEY `id_matiere` (`id_matiere`),
  CONSTRAINT `parties_cours_ibfk_1` FOREIGN KEY (`id_matiere`) REFERENCES `matieres` (`id_matiere`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table elearning. planing
DROP TABLE IF EXISTS `planing`;
CREATE TABLE IF NOT EXISTS `planing` (
  `id_planing` int(11) NOT NULL AUTO_INCREMENT,
  `id_matiere` int(11) NOT NULL,
  `id_tranche` int(11) NOT NULL,
  `id_classe` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `date_jour` date NOT NULL,
  PRIMARY KEY (`id_planing`),
  KEY `id_classe` (`id_classe`),
  KEY `id_utilisateur` (`id_utilisateur`),
  KEY `id_matiere` (`id_matiere`),
  KEY `id_tranche` (`id_tranche`),
  CONSTRAINT `planing_ibfk_1` FOREIGN KEY (`id_classe`) REFERENCES `classes` (`id_classe`),
  CONSTRAINT `planing_ibfk_2` FOREIGN KEY (`id_utilisateur`) REFERENCES `professeurs` (`id_utilisateur`),
  CONSTRAINT `planing_ibfk_3` FOREIGN KEY (`id_matiere`) REFERENCES `matieres` (`id_matiere`),
  CONSTRAINT `planing_ibfk_4` FOREIGN KEY (`id_tranche`) REFERENCES `tranches_horaires` (`id_tranche`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table elearning. presences
DROP TABLE IF EXISTS `presences`;
CREATE TABLE IF NOT EXISTS `presences` (
  `id_presence` int(11) NOT NULL AUTO_INCREMENT,
  `id_planing` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  PRIMARY KEY (`id_presence`),
  KEY `id_utilisateur` (`id_utilisateur`),
  KEY `id_planing` (`id_planing`),
  CONSTRAINT `presences_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateurs` (`id_utilisateur`),
  CONSTRAINT `presences_ibfk_2` FOREIGN KEY (`id_planing`) REFERENCES `planing` (`id_planing`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table elearning. professeurs
DROP TABLE IF EXISTS `professeurs`;
CREATE TABLE IF NOT EXISTS `professeurs` (
  `id_utilisateur` int(11) NOT NULL,
  `is_member_de` tinyint(1) NOT NULL,
  `specialite` varchar(128) NOT NULL,
  `titre` varchar(100) NOT NULL,
  PRIMARY KEY (`id_utilisateur`),
  CONSTRAINT `professeurs_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateurs` (`id_utilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table elearning. profils
DROP TABLE IF EXISTS `profils`;
CREATE TABLE IF NOT EXISTS `profils` (
  `id_utilisateur` int(11) NOT NULL,
  `nom` varchar(128) NOT NULL,
  `prenom` varchar(128) NOT NULL,
  `sexe` varchar(1) NOT NULL,
  `email` varchar(128) DEFAULT NULL,
  `tel` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id_utilisateur`),
  CONSTRAINT `profils_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateurs` (`id_utilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table elearning. programmes_examens
DROP TABLE IF EXISTS `programmes_examens`;
CREATE TABLE IF NOT EXISTS `programmes_examens` (
  `id_examen` int(11) NOT NULL,
  `id_classe` int(11) NOT NULL,
  `date_debut` datetime NOT NULL,
  PRIMARY KEY (`id_examen`,`id_classe`),
  KEY `id_classe` (`id_classe`),
  CONSTRAINT `programmes_examens_ibfk_1` FOREIGN KEY (`id_examen`) REFERENCES `examens` (`id_examen`),
  CONSTRAINT `programmes_examens_ibfk_2` FOREIGN KEY (`id_classe`) REFERENCES `classes` (`id_classe`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table elearning. propositions_reponses
DROP TABLE IF EXISTS `propositions_reponses`;
CREATE TABLE IF NOT EXISTS `propositions_reponses` (
  `id_proposition` int(11) NOT NULL,
  `id_quiz` int(11) NOT NULL,
  `proposition` text NOT NULL,
  `is_response` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_proposition`),
  KEY `id_quiz` (`id_quiz`),
  CONSTRAINT `propositions_reponses_ibfk_1` FOREIGN KEY (`id_quiz`) REFERENCES `quiz` (`id_quiz`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table elearning. quiz
DROP TABLE IF EXISTS `quiz`;
CREATE TABLE IF NOT EXISTS `quiz` (
  `id_quiz` int(11) NOT NULL AUTO_INCREMENT,
  `id_examen` int(11) NOT NULL,
  `question` int(11) NOT NULL,
  PRIMARY KEY (`id_quiz`),
  KEY `id_examen` (`id_examen`),
  CONSTRAINT `quiz_ibfk_1` FOREIGN KEY (`id_examen`) REFERENCES `examens` (`id_examen`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table elearning. ressources
DROP TABLE IF EXISTS `ressources`;
CREATE TABLE IF NOT EXISTS `ressources` (
  `id_ressource` int(11) NOT NULL AUTO_INCREMENT,
  `id_matiere` int(11) NOT NULL,
  `titre_ressource` varchar(254) NOT NULL,
  `type_ressource` varchar(25) NOT NULL,
  `statut_ressource` int(11) NOT NULL,
  PRIMARY KEY (`id_ressource`),
  KEY `id_matiere` (`id_matiere`),
  CONSTRAINT `ressources_ibfk_1` FOREIGN KEY (`id_matiere`) REFERENCES `matieres` (`id_matiere`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table elearning. tranches_horaires
DROP TABLE IF EXISTS `tranches_horaires`;
CREATE TABLE IF NOT EXISTS `tranches_horaires` (
  `id_tranche` int(11) NOT NULL AUTO_INCREMENT,
  `heure_debut` time NOT NULL,
  `heure_fin` time NOT NULL,
  PRIMARY KEY (`id_tranche`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table elearning. types_examens
DROP TABLE IF EXISTS `types_examens`;
CREATE TABLE IF NOT EXISTS `types_examens` (
  `id_type_examen` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(54) NOT NULL,
  `code` varchar(10) NOT NULL,
  `statut_examen` int(11) NOT NULL,
  PRIMARY KEY (`id_type_examen`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table elearning. ue
DROP TABLE IF EXISTS `ue`;
CREATE TABLE IF NOT EXISTS `ue` (
  `id_ue` int(11) NOT NULL AUTO_INCREMENT,
  `nom_ue` varchar(54) NOT NULL,
  `code_ue` varchar(10) NOT NULL,
  `credit` int(11) NOT NULL,
  `statut_existant` int(11) NOT NULL,
  PRIMARY KEY (`id_ue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table elearning. utilisateurs
DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id_utilisateur` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(54) NOT NULL,
  `mdp` varchar(128) NOT NULL,
  `statut_existant` int(11) NOT NULL,
  PRIMARY KEY (`id_utilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Les données exportées n'étaient pas sélectionnées.

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
