<?php

/* classe Affection pour accèss à la classe affection de la base de données */
class AffectationsModel extends dFramework\core\Model
{
    /* Constructeur de la classe */
    public function __construct()
    {
        parent::__construct();
    }
    
    /* selection des informations des Affectation */
    public function read_all()
    {
        $this->free_db()
        ->select()
        ->from('Affectations')
        ->where('statut_existant != 0')
        ->order('date_affectation', 'DESC');
        return $this->result(); 
    }
    
    /* selection des informations d'une Affectation */
    public function read_with_id(int $id_affectation)
    {
        $this->free_db()
        ->select()
        ->from('Affectations')
        ->where('statut_existant != 0')
        ->where('id_affectation = ?')->params([$id_affectation])
        ->order('date_affectation', 'DESC');
        return $this->first(); 
    }
    
    /* selection dess affectations d'un utilisateur */
    public function read_with_id_utilisateur(int $id_utilisateur)
    {
        $this->free_db()
        ->select()
        ->from('Affectations')
        ->where('statut_existant != 0')
        ->where('id_utilisateur = ?')->params([$id_utilisateur])
        ->order('date_affectation', 'DESC');
        return $this->result(); 
    }
    
    /* selection dess affectations d'une classe */
    public function read_with_id_classe(int $id_classe)
    {
        $this->free_db()
        ->select()
        ->from('Affectations')
        ->where('statut_existant != 0')
        ->where('id_classe = ?')->params([$id_classe])
        ->order('date_affectation', 'DESC');
        return $this->result(); 
    }
    
    /* selection dess affectations d'une matiere */
    public function read_with_id_matiere(int $id_matiere)
    {
        $this->free_db()
        ->select()
        ->from('Affectations')
        ->where('statut_existant != 0')
        ->where('id_matiere = ?')->params([$id_matiere])
        ->order('date_affectation', 'DESC');
        return $this->result(); 
    }
    
    /* selection dess affectations d'une matiere */
    public function read_with_id_matiere_classe(int $id_matiere, int $id_classe)
    {
        $this->free_db()
        ->select('a.*, p.*')
        ->from(['Affectations as a','Profils as p'])
        ->where('a.statut_existant != 0')
        ->where('p.id_utilisateur = a.id_utilisateur')
        ->where('id_matiere = ?')->params([$id_matiere])
        ->where('id_classe = ?')->params([$id_classe]);
        return $this->first(); 
    }


    /* insertion d'une nouvelle affectation dans la base de données */
    public function create(array $affectations)
    {
       return $this->free_db()
        ->insert($affectations)
        ->into('Affectations');
    }

    /* mise à jours des informations d'une affectation */
    public function edit_with_id(int $id_affectation, $affectations)
    {
       return $this->free_db()
        ->where('id_affectation = ?')->params([$id_affectation])
        ->update('Affectations', $affectations);
    }

    /* desactivation d'une affectation : l'affectation n'est pas supprimer definitivement de la base de donnée */
    public function remove(int $id_affectation)
    {
       return $this->free_db()
        ->where('id_affectation = ?')->params([$id_affectation])        
        ->set('statut_existant', '0')
        ->update('Affectations');        
    }
}
?>