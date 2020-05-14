<?php

/* classe filieres pour accèss à la classe filieres de la base de données */
class FilieresModel extends dFramework\core\Model
{
    /* Constructeur de la classe */
    public function __construct()
    {
        parent::__construct();
    }
    

    /* retourne les informations d'une filiere de formation */
    public function read_with_id_filiere (int $id_filiere)
    {
        $this->free_db()
        ->select()
        ->from('Filieres')
        ->order('nom_filiere', 'ASC')
        ->where('statut_existant != 0')
        ->where('id_filiere = ?')->params([$id_filiere]);
        return $this->first();
    }

    /* retourne les informations d'une filiere de formation en fonction du code */
    public function read_with_nom_filiere (string $nom_filiere)
    {
        $this->free_db()
        ->select()
        ->from('Filieres')
        ->order('nom_filiere', 'ASC')
        ->where('statut_existant != 0')
        ->where('nom_filiere = ?')->params([$nom_filiere]);
        return $this->first();
    }
    
    /* retourne les informations d'une filierede formation en fonction du nom */
    public function read_with_code_filiere (string $code_filiere)
    {
        $this->free_db()
        ->select()
        ->from('Filieres')
        ->order('nom_filiere', 'ASC')
        ->where('statut_existant != 0')
        ->where('code_filiere = ?')->params([$code_filiere]);
        return $this->first();
    }
    
    /* selection des informations de tous les filieres de formation */
    public function read_all()
    {
        $this->free_db()
        ->select()
        ->from('Filieres')
        ->where('statut_existant != 0')
        ->order('nom_filiere', 'ASC');
        return $this->result();        
    }

    /* insertion d'une nouvelle filiere dans la base de données */
    public function create(array $filieres)
    {
        return $this->free_db()
        ->insert($filieres)
        ->into('Filieres');
    }

    /* mise à jours des informations d'une filiere */
    public function edit_with_id_filiere(int $id_filiere, $filieres)
    {
       return $this->free_db()
        ->where('id_filiere = ?')->params([$id_filiere])
        ->update('Filieres', $filieres);
    }

    /* desactivation d'une filiere: la filiere n'est pas supprimer definitivement de la base de donnée */
    public function remove(int $id_filiere)
    {
       return $this->free_db()
        ->where('id_filiere = ?')->params([$id_filiere])        
        ->set('statut_existant', '0')
        ->update('Filieres');        
    }
}
?>