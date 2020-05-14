create database ELearning character set "UtF8";

use ELearning;

create table Utilisateurs
(
   id_utilisateur       int not null auto_increment,
   login                varchar(54) not null,
   mdp                  VARCHAR(128) not null,
   statut_existant      int not null,
   primary key (id_utilisateur)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

create table Professeurs
(
   id_utilisateur       int not null,
   is_member_de         boolean not null,
   specialite           VARCHAR(128) not null,
   titre                VARCHAR(100) not null,
   primary key (id_utilisateur),
   foreign key (id_utilisateur)
      references Utilisateurs (id_utilisateur) on delete restrict on update restrict
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

create table Filieres
(
   id_filiere           int not null auto_increment,
   nom_filiere          varchar(54) not null,
   code_filiere         VARCHAR(10) not null,
   statut_existant      int not null,
   primary key (id_filiere)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

create table Niveaux
(
   id_niveau           int not null auto_increment,
   nom_niveau           varchar(54) not null,
   code_niveau          VARCHAR(10) not null,
   statut_existant      int not null,
   primary key (id_niveau)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

create table Centres
(
   id_centre            int not null auto_increment,
   nom_centre           varchar(54) not null,
   code_centre          VARCHAR(10) not null,
   tel_responsable      VARCHAR(20) not null,
   localisation         VARCHAR(50) not null,
   statut_existant      int not null,
   primary key (id_centre)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

create table Centres_Filieres
(
   id_centre_filiere    int not null auto_increment,
   id_centre            int not null,
   id_filiere           int not null,
   primary key (id_centre_filiere),
	foreign key (id_filiere)
      references Filieres (id_filiere) on delete restrict on update restrict,
   foreign key (id_centre)
      references Centres (id_centre) on delete restrict on update restrict
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

create table Classes
(
   id_classe            int not null auto_increment,
   id_centre            int not null,
   id_filiere           int not null,
   id_niveau            int not null,
   nom_classe           varchar(54) not null,
   code_classe          VARCHAR(10) not null,
   statut_existant      int not null,
   primary key (id_classe),
	foreign key (id_filiere)
      references Filieres (id_filiere) on delete restrict on update restrict,
   foreign key (id_niveau)
      references Niveaux (id_niveau) on delete restrict on update restrict,
   foreign key (id_centre)
      references Centres (id_centre) on delete restrict on update restrict
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

create table Semestres
(
   id_semestre          int not null AUTO_INCREMENT,
   id_niveau            int not null,
   nom_semestre         varchar(54) unique not null,
   abreviation          varchar(10) unique not null,
   statut_existant      int not null,
   primary key (id_semestre),
   foreign key (id_niveau)
      references Niveaux (id_niveau) on delete restrict on update restrict
)ENGINE=InnoDB DEFAULT CHARSET=UTF8;

create table UE
(
   id_ue                int not null auto_increment,
   id_semestre          int not null,
   nom_ue               varchar(54) unique not null,
   code_ue              VARCHAR(10) unique not null,
   credit               int not null,
   statut_existant      int not null,
   primary key (id_ue),
   foreign key (id_semestre)
      references Semestres (id_semestre) on delete restrict on update restrict
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

create table Matieres
(
   id_matiere           int not null auto_increment,
   id_ue                int not null,
   nom_matiere          varchar(54) unique,
   ref_matiere          VARCHAR(10) unique,
   coef                 int not null,
   nbr_hr_tp            int not null,
   nbr_hr_td            int not null,
   nbr_hr_cm            int not null,
   statut_existant      int not null,
   primary key (id_matiere),
   foreign key (id_ue)
      references UE (id_ue) on delete restrict on update restrict
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

create table Affectations
(
   id_affectation       int not null auto_increment,
   id_classe            int not null,
   id_matiere           int not null,
   id_utilisateur       int not null,
   statut_existant      int not null,
   date_affectation    DATETIME NOT NULL,
   primary key (id_affectation),
   foreign key (id_utilisateur)
      references Professeurs (id_utilisateur) on delete restrict on update restrict,
   foreign key (id_classe)
      references Classes (id_classe) on delete restrict on update restrict,
   foreign key (id_matiere)
      references Matieres (id_matiere) on delete restrict on update restrict
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

create table Billets_forum
(
   id_billet            int not null auto_increment,
   id_filiere           int not null,
   id_utilisateur       int not null,
   sujet                varchar(254) not null,
   contenu              text not null,
   date_publication     datetime not null,
   statut_existant      int not null,
   primary key (id_billet),
   foreign key (id_utilisateur)
      references Utilisateurs (id_utilisateur) on delete restrict on update restrict,
   foreign key (id_filiere)
      references Fillieres (id_filiere) on delete restrict on update restrict
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

create table Parties_cours
(
   id_partie            int not null auto_increment,
   id_matiere           int not null,
   titre_partie         VARCHAR(128) not null,
   num_partie           int not null,
   statut_existant      int not null,
   primary key (id_partie),
   foreign key (id_matiere)
      references Matieres (id_matiere) on delete restrict on update restrict
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

create table Ue_Filieres
(
   id_ue_filiere        int not null auto_increment,
   id_ue                int not null,
   id_filiere           int not null,
   primary key (id_ue_filiere),
   foreign key (id_ue)
      references Ue (id_ue) on delete restrict on update restrict,
   foreign key (id_filiere)
      references Filieres (id_filiere) on delete restrict on update restrict
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

create table Chapitres
(
   id_chapitre          int not null auto_increment,
   id_partie            int not null,
   titre_chap           VARCHAR(128) not null,
   num_chap             int not null,
   contenu              text ,
   statut_existant      int not null,
   primary key (id_chapitre),
   foreign key (id_partie)
      references Parties_cours (id_partie) on delete restrict on update restrict
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

create table Commentaires_forum
(
   id_commentaire       int not null auto_increment,
   id_billet            int not null,
   id_utilisateur       int not null,
   date_commentaire     datetime not null,
   contenu              text not null,
   statut_existant      int not null,
   primary key (id_commentaire),
   foreign key (id_billet)
      references Billets_forum (id_billet) on delete restrict on update restrict,
   foreign key (id_utilisateur)
      references Utilisateurs (id_utilisateur) on delete restrict on update restrict
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

create table Etudiants
(
   id_utilisateur       int not null,
   id_classe            int not null,
   matricule            varchar(254) not null,
   date_naiss           date not null,
   lieu_naiss           varchar(254) not null,
   primary key (id_utilisateur),
   foreign key (id_classe)
      references Classes (id_classe) on delete restrict on update restrict,
   foreign key (id_utilisateur)
      references Utilisateurs (id_utilisateur) on delete restrict on update restrict
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

create table Types_examens
(
   id_type_examen       int not null auto_increment,
   libelle              varchar(54) not null,
   code                 VARCHAR(10) not null,
   statut_examen        int not null,
   primary key (id_type_examen)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

create table Examens
(
   id_examen            int not null auto_increment,
   id_type_examen       int not null,
   id_matiere           int not null,
   id_utilisateur       int not null,
   duree                int not null,
   description          text,
   pts_juste            int,
   pts_faux             int,
   pts_aucun            int,
   statut_existant      int not null,
   primary key (id_examen),
   foreign key (id_type_examen)
      references Types_examens (id_type_examen) on delete restrict on update restrict,
   foreign key (id_matiere)
      references Matieres (id_matiere) on delete restrict on update restrict,
   foreign key (id_utilisateur)
      references Professeurs (id_utilisateur) on delete restrict on update restrict
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

create table Evaluations
(
   id_evaluation        int not null auto_increment,
   id_utilisateur       int not null,
   id_examen            int not null,
   note                 float,
   primary key (id_evaluation),
   foreign key (id_utilisateur)
      references Etudiants (id_utilisateur) on delete restrict on update restrict,
   foreign key (id_examen)
      references Examens (id_examen) on delete restrict on update restrict
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

create table Tranches_horaires
(
   id_tranche           int not null auto_increment,
   heure_debut          time not null,
   heure_fin            time not null,
   primary key (id_tranche)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

create table Planings
(
   id_planing           int not null auto_increment,
   id_matiere           int not null,
   id_tranche           int not null,
   id_classe            int not null,
   id_utilisateur       int not null,
   date_jour            date not null,
   statut_existant      int not null,
   primary key (id_planing),
   foreign key (id_classe)
      references Classes (id_classe) on delete restrict on update restrict,
   foreign key (id_utilisateur)
      references Professeurs (id_utilisateur) on delete restrict on update restrict,
   foreign key (id_matiere)
      references Matieres (id_matiere) on delete restrict on update restrict,
   foreign key (id_tranche)
      references Tranches_horaires (id_tranche) on delete restrict on update restrict
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

create table Presences
(
   id_presence          int not null auto_increment,
   id_planing           int not null,
   id_utilisateur       int not null,
   date_presence        datetime  not null,
   primary key (id_presence),
   foreign key (id_utilisateur)
      references Utilisateurs (id_utilisateur) on delete restrict on update restrict,
   foreign key (id_planing)
      references Planings (id_planing) on delete restrict on update restrict
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

create table Profils
(
   id_utilisateur       int not null,
   nom                  VARCHAR(128) not null,
   prenom               VARCHAR(128) not null,
   sexe                 VARCHAR(10) not null,
   email                VARCHAR(128),
   tel                  varchar(25),
   primary key (id_utilisateur),
   foreign key (id_utilisateur)
      references Utilisateurs (id_utilisateur) on delete restrict on update restrict
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

create table Programmes_examens
(
   id_programme         int not NULL AUTO_INCREMENT,
   id_examen            int not null,
   id_classe            int not null,
   date_debut           datetime not null,
   statut_existant      int not null,
   primary key (id_programme),
   foreign key (id_examen)
      references Examens (id_examen) on delete restrict on update restrict,
   foreign key (id_classe)
      references Classes (id_classe) on delete restrict on update restrict
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

create table Quiz
(
   id_quiz              int not null auto_increment,
   id_examen            int not null,
   question             text not null,
   primary key (id_quiz),
   foreign key (id_examen)
      references Examens (id_examen) on delete restrict on update restrict
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

create table Propositions_reponses
(
   id_proposition       int not null,
   id_quiz              int not null,
   proposition          text not null,
   is_response          boolean not null,
   primary key (id_proposition),
   foreign key (id_quiz)
      references Quiz (id_quiz) on delete restrict on update restrict
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

create table Ressources
(
   id_ressource         int not null auto_increment,
   id_matiere           int not null,
   titre_ressource      varchar(254) not null,
   type_ressource       varchar(25) not null,
   description          text  not null,
   statut_existant      int not null,
   primary key (id_ressource),
   foreign key (id_matiere)
      references Matieres (id_matiere) on delete restrict on update restrict
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

create table Glossaires
(
   id_glossaire       int not null auto_increment,
   id_utilisateur     int not null,
   id_matiere         int not null,
   terme              varchar(254) not null,
   contenue           text not null,
   statut_existant    int not null,
   primary key (id_glossaire),
   foreign key (id_utilisateur)
      references Utilisateurs (id_utilisateur) on delete restrict on update restrict,
   foreign key (id_matiere)
      references Matieres (id_matiere) on delete restrict on update restrict
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

create table Discussions
(
   id_discussion      int not null auto_increment,
   id_utilisateur     int not null,
   id_matiere         int not null,
   id_classe          int not null,
   contenue           text not null,
   statut_existant    int not null,
   date_discussion    datetime not null,
   primary key (id_discussion),
   foreign key (id_classe)
      references Classes (id_classe) on delete restrict on update restrict,
   foreign key (id_utilisateur)
      references Utilisateurs (id_utilisateur) on delete restrict on update restrict,
   foreign key (id_matiere)
      references Matieres (id_matiere) on delete restrict on update restrict
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

