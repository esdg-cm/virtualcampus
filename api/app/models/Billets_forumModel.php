<?php

/* classe Biellets_forumModel pour accèss à la classe Biellets_forum de la base de données */
class Billets_forumModel extends dFramework\core\Model
{
    /* Constructeur de la classe */
    public function __construct()
    {
        parent::__construct();
    }

    /* retourne l'ensemble des billets de la base de données */
    public function read_all_billet()
    {
        $this->free_db()
        ->select()
        ->from('Billets_forum')
        ->where('statut_existant != 0')
        ->order('sujet', 'ASC');
        return $this->result();
    }
    
    /* retourne un billet specifique de la base de données */
    public function read_billet_id(int $id_billet)
    {
        $this->free_db()
        ->select()
        ->from('Billets_forum')
        ->where('statut_existant != 0')
        ->where('id_billet = ?')->params([$id_billet])
        ->order('sujet', 'ASC');
        return $this->first();
    }

    /* retourne un billet specifique de la base de données */
    public function read_billet_sujet(string $sujet)
    {
        $this->free_db()
        ->select()
        ->from('Billets_forum')
        ->where('statut_existant != 0')
        ->where('sujet = ?')->params([$sujet])
        ->order('sujet', 'ASC');
        return $this->first();
    }

    /* retourne l'ensemble des billets de la base de données */
    public function read_billet_filiere_id(int $id_filiere)
    {
        $this->free_db()
        ->select()
        ->from('Billets_forum')
        ->where('statut_existant != 0')
        ->where('id_filiere = ?')->params([$id_filiere])
        ->order('sujet', 'ASC');
        return $this->result();
    }

    /* retourne l'ensemble des billets d'un utilisateur de la base de données */
    public function read_billet_utilisateur_id(int $id_utilisateur)
    {
        $this->free_db()
        ->select()
        ->from('Billets_forum')
        ->where('statut_existant != 0')
        ->where('id_utilisateur = ?')->params([$id_utilisateur])
        ->order('sujet', 'ASC');
        return $this->result();
    }

    /* insertion d'un nouveau billet dans la base de données */
    public function create(array $billet)
    {
       $this->free_db()
        ->insert($billet)
        ->into('Billets_forum');

        return $this->lastId('Billets_forum');
    }

    /* mise à jours des informations d'un billet */
    public function edit_billet(int $id_billet, $billet)
    {
       return $this->free_db()
        ->where('id_billet = ?')->params([$id_billet])
        ->update('Billets_forum', $billet);
    }

    /* desactivation d'un billet: le centre n'est pas supprimer definitivement de la base de donnée */
    public function remove(int $id_billet)
    {
       return $this->free_db()
        ->where('id_billet = ?')->params([$id_billet])        
        ->set('statut_existant', '0')
        ->update('Billets_forum');        
    }


    /**
     * Compte le nombre de commentaire d'un billet de forum
     * 
     * @param int $id_billet
     */
    public function nbrcommentaire($id_billet)
    {
        return $this->free_db()
            ->where('id_billet = ?')->params([$id_billet])
            ->from('Commentaires_forum')
            ->count();
    }
}
