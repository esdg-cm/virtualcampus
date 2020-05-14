<?php

/* classe matiere pour accèss à la classe matiere de la base de données */
class MatieresModel extends dFramework\core\Model
{
    /* Constructeur de la classe */
    public function __construct()
    {
        parent::__construct();
    }

    /* retourne les informations d'une filiere de formation */
    public function read_all_info_id (int $id_matiere)
    {
        $this->free_db()
        ->select('Matieres.*, Ue.nom_ue')
        ->from(['Matieres', 'Ue'])
        ->where('Matieres.id_ue = Ue.id_ue')
        ->where('Matieres.statut_existant != 0')
        ->order('Matieres.nom_matiere', 'ASC')
        ->where('Matieres.id_matiere = ?')->params([$id_matiere]);
        return $this->first();
    }

    /* retourne les informations d'une filiere de formation */
    public function read_all_info_id_ue(int $id_ue)
    {
        $this->free_db()
        ->select('Matieres.*, Ue.nom_ue')
        ->from(['Matieres', 'Ue'])
        ->where('Matieres.id_ue = Ue.id_ue')
        ->where('Matieres.statut_existant != 0')
        ->order('Matieres.nom_matiere', 'ASC')
        ->where('Matieres.id_ue = ?')->params([$id_ue]);
        return $this->result();
    }

    /* retourne les informations d'une filiere de formation */
    public function read_all_info_matiere ()
    {
        $this->free_db()
        ->select('Matieres.*, Ue.nom_ue')
        ->from(['Matieres', 'Ue'])
        ->where('Matieres.id_ue = Ue.id_ue')
        ->where('Matieres.statut_existant != 0')
        ->order('Matieres.nom_matiere', 'ASC');
        return $this->result();
    }
    
    /* selection de toutes les matieres */
    public function read_all()
    {
        $this->free_db()
        ->select()
        ->from('Matieres')
        ->where('statut_existant != 0')
        ->order('nom_matiere', 'ASC');
        return $this->result();        
    }
    
    /* selection d'une matieres a partir de l'id */
    public function read_with_id(int $id_matiere)
    {
        $this->free_db()
        ->select()
        ->from('Matieres')
        ->where('statut_existant != 0')
        ->where('id_matiere = ?')->params([$id_matiere])
        ->order('nom_matiere', 'ASC');
        return $this->first();        
    }

    /* selection desmatieres de l'UE */
    public function read_matiere_ue_id(int $id_ue)
    {
        $this->free_db()
        ->select()
        ->from('Matieres')
        ->where('statut_existant != 0')
        ->where('id_ue = ?')->params([$id_ue])
        ->order('nom_matiere', 'ASC');
        return $this->result();        
    }

    /* selection de la matiere a partir de la reference */
    public function read_with_ref(string $ref_matiere)
    {
        $this->free_db()
        ->select()
        ->from('Matieres')
        ->where('statut_existant != 0')
        ->where('ref_matiere = ?')->params([$ref_matiere])
        ->order('nom_matiere', 'ASC');
        return $this->first();        
    }

    /* selection de la matiere a partir de la reference */
    public function read_with_nom(string $nom_matiere)
    {
        $this->free_db()
        ->select()
        ->from('Matieres')
        ->where('statut_existant != 0')
        ->where('nom_matiere = ?')->params([$nom_matiere])
        ->order('nom_matiere', 'ASC');
        return $this->first();        
    }

    /* insertion d'une nouvelle Matiere dans la base de données */
    public function create(array $matieres)
    {
       return $this->free_db()
        ->insert($matieres)
        ->into('Matieres');
    }

    /* ajout d'une matiere */
    public function edit_with_id(int $id_matiere, array $matieres)
    {
       return $this->free_db()
        ->where('id_matiere = ?')->params([$id_matiere])
        ->update('Matieres', $matieres);
    }

    /* ajout d'une matiere */
    public function edit_with_nom(int $non_matiere, array $matieres)
    {
       return $this->free_db()
        ->where('non_matiere = ?')->params([$non_matiere])
        ->update('Matieres', $matieres);
    }

    /* ajout d'une matiere */
    public function edit_with_ref(string $ref_matiere, array $matieres)
    {
       return $this->free_db()
        ->where('ref_matiere = ?')->params([$ref_matiere])
        ->update('Matieres', $matieres);
    }

    /* desactivation d'une matiere: la matiere n'est pas supprimer definitivement de la base de donnée */
    public function remove(int $id_matiere)
    {
       return $this->free_db()
        ->where('id_matiere = ?')->params([$id_matiere])        
        ->set('statut_existant', '0')
        ->update('Matieres');        
    }
}
?>