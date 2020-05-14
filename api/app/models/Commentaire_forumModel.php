<?php

/* classe Commentaire_forumModel pour accèss à la classe Commentaire_forum de la base de données */
class Commentaire_forumModel extends dFramework\core\Model
{
    /* Constructeur de la classe */
    public function __construct()
    {
        parent::__construct();
    }
    
    /* retourne l'ensemble des commentaires de la bd */
    public function read_all_comment()
    {
        $this->free_db()
        ->select()
        ->from('Commentaires_forum')
        ->where('statut_existant != 0')
        ->order('date_commentaire', 'ASC');
        return $this->result();
    }

    /* retourne un commentaire de la bd */
    public function read_comment_with_id(int $id_commentaire)
    {
        $this->free_db()
        ->select()
        ->from('Commentaires_forum')
        ->where('statut_existant != 0')
        ->order('date_commentaire', 'ASC')
        ->where('id_commentaire = ?')->params([$id_commentaire]);
        return $this->first();
    }

    /* retourne l'ensemble des commentaires d'un billet de la bd */
    public function read_all_comment_billet_id(int $id_billet)
    {
        $this->free_db()
        ->select()
        ->from('Commentaires_forum')
        ->where('statut_existant != 0')
        ->where('id_billet = ?')->params([$id_billet])
        ->order('date_commentaire', 'ASC');
        return $this->result();
    }

    /* retourne l'ensemble des commentaires d'un utilisateur de la bd */
    public function read_all_comment_user_id(int $id_utilisateur)
    {
        $this->free_db()
        ->select()
        ->from('Commentaires_forum')
        ->where('statut_existant != 0')
        ->where('id_utilisateur = ?')->params([$id_utilisateur])
        ->order('date_commentaire', 'ASC');
        return $this->result();
    }

    /* retourne l'ensemble des commentaires d'un utilisateur de la bd */
    public function read_all_comment_user_billet(int $id_utilisateur, int $id_billet)
    {
        $this->free_db()
        ->select()
        ->from('Commentaires_forum')
        ->where('statut_existant != 0')
        ->where('id_utilisateur = ?')->params([$id_utilisateur])
        ->where('id_billet = ?')->params([$id_billet])
        ->order('date_commentaire', 'ASC');
        return $this->result();
    }

    /* insertion d'un nouveau commentaire dans la base de données */
    public function create(array $commentaires)
    {
       return $this->free_db()
        ->insert($commentaires)
        ->into('Commentaires_forum');
    }

    /* mise à jours des informations d'un commentaire */
    public function edit_with_id(int $id_commentaire, $commentaires)
    {
       return $this->free_db()
        ->where('id_commentaire = ?')->params([$id_commentaire])
        ->update('Commentaires_forum', $commentaires);
    }

    /* desactivation d'un commentaire : le commentaire n'est pas supprimer definitivement de la base de donnée */
    public function remove(int $id_commentaire)
    {
       return $this->free_db()
        ->where('id_commentaire = ?')->params([$id_commentaire])        
        ->set('statut_existant', '0')
        ->update('Commentaires_forum');        
    }
}
?>