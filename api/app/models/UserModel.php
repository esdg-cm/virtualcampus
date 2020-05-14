<?php


/* classe UserModel pour l'accèss aux classes prof, etudiant profils et utilisateur*/
class UserModel extends \dFramework\core\Model
{
    /* Constructeur de la classe */
    public function __construct()
    {
        parent::__construct();
    }

    /* selection des informations de l'etudiant */
    public function read_etudiant()
    {
        $this->free_db()
        ->select()
        ->from('Etudiants')
        ->order('matricule', 'ASC');
        return $this->result();
    }

    /* selection des informations d'un etudiant */
    public function read_etudiant_with_id(int $id_utilisateur)
    {
        $this->free_db()
        ->select()
        ->from('Etudiants')
        ->where('id_utilisateur = ?')->params([$id_utilisateur]);
        return $this->first();
    }

    /* insertion d'un etudiant dans la base de données */
    public function create_etudiant(array $etudiants)
    {
       return $this->free_db()
        ->insert($etudiants)
        ->into('Etudiants');
    }

    /* mise à jours des informations d'un etudiant */
    public function edit_etudiant(int $id_utilisateur, $etudiants)
    {
       return $this->free_db()
        ->where('id_utilisateur = ?')->params([$id_utilisateur])
        ->update('Etudiants', $etudiants);
    }

    /* selection des informations du professeur */
    public function read_professeur()
    {
        $this->free_db()
        ->select()
        ->from('Professeurs');
        return $this->result();
    }

    /* selection des informations d'un professeur */
    public function read_professeur_with_id(int $id_utilisateur)
    {
        $this->free_db()
        ->select()
        ->from('Professeurs')
        ->where('id_utilisateur = ?')->params([$id_utilisateur]);
        return $this->first();
    }

    /* insertion d'un professeurs dans la base de données */
    public function create_professeur(array $professeurs)
    {
       return $this->free_db()
        ->insert($professeurs)
        ->into('Professeurs');
    }

    /* mise à jours des informations d'un professeur */
    public function edit_professeur(int $id_utilisateur, $professeurs)
    {
       return $this->free_db()
        ->where('id_utilisateur = ?')->params([$id_utilisateur])
        ->update('Professeurs', $professeurs);
    }

    /* selection des informations d'un utilisateur */
    public function read_utilisateur()
    {
        $this->free_db()
        ->select()
        ->from('Utilisateurs')
        ->where('statut_existant != 0')
        ->order('login', 'ASC');
        return $this->result();
    }

    /* selection des informations d'un utilisateur */
    public function read_utilisateur_with_id(int $id_utilisateur)
    {
        $this->free_db()
        ->select()
        ->from('Utilisateurs')
        ->where('statut_existant != 0')
        ->where('id_utilisateur = ?')->params([$id_utilisateur])
        ->order('login', 'ASC');
        return $this->first();
    }

    /* selection des informations d'un utilisateur a partir du login*/
    public function read_utilisateur_with_login(string $login)
    {
        $this->free_db()
        ->select()
        ->from('Utilisateurs')
        ->where('statut_existant != 0')
        ->where('login = ?')->params([$login]);
        return $this->first();
    }

    /* mise à jours des informations d'un utilisateur */
    public function edit_utilisateur(int $id_utilisateur, $utilisateur)
    {
       return $this->free_db()
        ->where('id_utilisateur = ?')->params([$id_utilisateur])
        ->update('Utilisateurs', $utilisateur);
    }

    /* insertion d'un utilisateur dans la base de données */
    public function create_utilisateur(array $utilisateur)
    {
        $this->free_db()
        ->insert($utilisateur)
        ->into('Utilisateurs');
        return $this->lastId();
    }

    /* desactivation d'un utilisateur: l'utilisateur n'est pas supprimer definitivement de la base de donnée */
    public function remove_utilisateur(int $id_utilisateur)
    {
       return $this->free_db()
        ->where('id_utilisateur = ?')->params([$id_utilisateur])
        ->set('statut_existant', '0')
        ->update('Utilisateurs');
    }

    /* activation des utilisateur a partir de l'id */
    public function activer_utilisateur_id(int $id_utilisateur)
    {
        return $this->free_db()
        ->set('statut_existant', '1')
        ->where('id_utilisateur = ?')->params([$id_utilisateur])
        ->update('Utilisateurs');
    }

    /* activation des utilisateur a partir du login */
    public function activer_utilisateur_login(string $login)
    {
        return $this->free_db()
        ->set('statut_existant', '1')
        ->where('login = ?')->params([$login])
        ->update('Utilisateurs');
    }

    /* selection des informations de profils d'un utilisateur a partir de l'id */
    public function read_profils_with_id(int $id_utilisateur)
    {
        $this->free_db()
        ->select()
        ->from('Utilisateurs as u')
        ->where('u.statut_existant != 0')
        ->join('Profils as p', 'u.id_utilisateur = p.id_utilisateur', 'inner')
        ->order('p.nom', 'ASC')
        ->where('id_utilisateur = ?')->params([$id_utilisateur]);
        return $this->first();
    }

    /* selection des informations de profils d'un utilisateur a partir de l'id */
    public function read_profils()
    {
        $this->free_db()
        ->select()
        ->from('Utilisateurs as u')
        ->where('u.statut_existant = 1')
        ->join('Profils as p', 'u.id_utilisateur = p.id_utilisateur', 'inner')
        ->order('p.nom', 'ASC');
        return $this->result();
    }

    /* selection des informations de profils d'un utilisateur a partir du mail */
    public function read_profils_with_email(string $email)
    {
        $this->free_db()
        ->select()
        ->from('Utilisateurs as u')
        ->where('u.statut_existant != 0')
        ->join('Profils as p', 'u.id_utilisateur = p.id_utilisateur', 'inner')
        ->order('p.nom', 'ASC')
        ->where('email = ?')->params([$email]);
        return $this->first();
    }

    /* selection des informations de profils d'un utilisateur a partir du telephone */
    public function read_profils_with_tel(string $tel)
    {
        $this->free_db()
        ->select()
        ->from('Utilisateurs as u')
        ->where('u.statut_existant != 0')
        ->join('Profils as p', 'u.id_utilisateur = p.id_utilisateur', 'inner')
        ->order('p.nom', 'ASC')
        ->where('tel = ?')->params([$tel]);
        return $this->first();
    }

    /* insertion des informations du profils dans la base de données */
    public function create_profils(array $profils)
    {
        return $this->free_db()
        ->insert($profils)
        ->into('Profils');
    }

    /* mise à jours des informations du profils */
    public function edit_profils(int $id_utilisateur, $profils)
    {
       return $this->free_db()
        ->where('id_utilisateur = ?')->params([$id_utilisateur])
        ->update('Profils', $profils);
    }

    /* recupere pour tous les etudiants donner toutes les information  */
    public function read_all_information_etudiant()
    {
        $this->free_db()
        ->select()
        ->from('Utilisateurs As u')
        ->where('u.statut_existant = 1')
        ->join('Profils as p', 'u.id_utilisateur = p.id_utilisateur', 'inner')
        ->join('Etudiants as e', 'u.id_utilisateur = e.id_utilisateur', 'inner')
        ->order('p.nom', 'ASC');
        return $this->result();
    }

    /* recupere pour un etudiant donner toutes les information  */
    public function read_all_information_etudiant_with_id (int $id_utilisateur)
    {
        $this->free_db()
        ->select()
        ->from('Utilisateurs As u')
        ->where('u.statut_existant = 1')
        ->where('u.id_utilisateur = ?')->params([$id_utilisateur])
        ->join('Profils as p', 'u.id_utilisateur = p.id_utilisateur', 'inner')
        ->join('Etudiants as e', 'u.id_utilisateur = e.id_utilisateur', 'inner')
        ->order('p.nom', 'ASC');
        return $this->first();
    }

    /* recupere pour tous les professeur toutes les information  */
    public function read_all_information_professeur()
    {
        $this->free_db()
        ->select()
        ->from('Utilisateurs As u')
        ->where('u.statut_existant = 1')
        ->join('Profils as p', 'u.id_utilisateur = p.id_utilisateur', 'inner')
        ->join('Professeurs as pf', 'u.id_utilisateur = pf.id_utilisateur', 'inner')
        ->order('p.nom', 'ASC');
        return $this->result();
    }

    /* recupere pour un professeur donner toutes les information  */
    public function read_all_information_professeur_with_id (int $id_utilisateur)
    {
        $this->free_db()
        ->select()
        ->from('Utilisateurs As u')
        ->where('u.statut_existant = 1')
        ->where('u.id_utilisateur = ?')->params([$id_utilisateur])
        ->join('Profils as p', 'u.id_utilisateur = p.id_utilisateur', 'inner')
        ->join('Professeurs as pf', 'u.id_utilisateur = pf.id_utilisateur', 'inner')
        ->order('p.nom', 'ASC');
        return $this->first();
    }
}
?>
