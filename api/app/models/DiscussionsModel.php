<?php

/* classe discussion pour accèss à la classe discussion de la base de données */
class DiscussionsModel extends dFramework\core\Model
{
    /* Constructeur de la classe */
    public function __construct()
    {
        parent::__construct();
    }


    /* retourne les discussions sur une matiere */
    public function read_with_id_matiere (int $id_matiere)
    {
        $this->free_db()
        ->select()
        ->from('Discussions')
        ->order('date_discussion', 'ASC')
        ->where('statut_existant != 0')
        ->where('id_matiere = ?')->params([$id_matiere]);
        return $this->result();
    }

    /* retourne les discussion d'une salle de classe */
    public function read_with_id_classe (int $id_classe)
    {
        $this->free_db()
        ->select()
        ->from('Discussions')
        ->order('date_discussion', 'DESC')
        ->where('statut_existant != 0')
        ->where('id_classe = ?')->params([$id_classe]);
        return $this->result();
    }
    
    /*retourne les discussions d'un utilisateur */
    public function read_with_id_utilisateur (int $id_utilisateur)
    {
        $this->free_db()
        ->select()
        ->from('Discussions')
        ->order('date_discussion', 'DESC')
        ->where('statut_existant != 0')
        ->where('id_utilisateur = ?')->params([$id_utilisateur]);
        return $this->result();
    }

    /* retourne une discussion spécifique */
    public function read_with_id_discussion (int $id_discussion)
    {
        $this->free_db()
        ->select()
        ->from('Discussions')
        ->order('date_discussion', 'DESC')
        ->where('statut_existant != 0')
        ->where('id_discussion = ?')->params([$id_discussion]);
        return $this->first();
    }

    /* retourne une discussion spécifique */
    public function read_all_discussion_classe_matiere (int $id_matiere, int $id_classe)
    {
        $this->free_db()
        ->select()
        ->from('Discussions')
        ->order('date_discussion', 'ASC')
        ->where('statut_existant != 0')
        ->where('id_matiere = ?')->params([$id_matiere])
        ->where('id_classe = ?')->params([$id_classe]);
        return $this->result();
    }

    /* selection des informations de toutes les classes de formation */
    public function read_all()
    {
        $this->free_db()
        ->select()
        ->from('Discussions')
        ->where('statut_existant != 0')
        ->order('date_discussion', 'DESC');
        return $this->result();        
    }

    /* insertion d'une nouvelle discussion dans la base de données */
    public function create(array $discussions)
    {
       return $this->free_db()
        ->insert($discussions)
        ->into('Discussions');
    }

    /* mise à jours des informations d'une discussion */
    public function edit_with_id(int $id_discussion, $discussions)
    {
       return $this->free_db()
        ->where('id_discussion = ?')->params([$id_discussion])
        ->update('Discussions', $discussions);
    }

    /* desactivation d'une discussion: la discussion n'est pas supprimer definitivement de la base de donnée */
    public function remove(int $id_discussion)
    {
       return $this->free_db()
        ->where('id_discussion = ?')->params([$id_discussion])        
        ->set('statut_existant', '0')
        ->update('Discussions');        
    }
}
?>