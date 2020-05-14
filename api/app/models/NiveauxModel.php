<?php

/* classe niveau pour accèss à la classe Niveau de la base de données */
class NiveauxModel extends dFramework\core\Model
{
    /* Constructeur de la classe */
    public function __construct()
    {
        parent::__construct();
    }

    /* retourne les informations d'un centre de formation */
    public function read_with_id_niveau (int $id_niveau)
    {
        $this->free_db()
        ->select()
        ->from('Niveaux')
        ->order('nom_niveau', 'ASC')
        ->where('statut_existant != 0')
        ->where('id_niveau = ?')->params([$id_niveau]);
        return $this->first();
    }

    /* retourne les informations d'un centre de formation en fonction du code */
    public function read_with_nom_niveau (string $nom_niveau)
    {
        $this->free_db()
        ->select()
        ->from('Niveaux')
        ->order('nom_niveau', 'ASC')
        ->where('statut_existant != 0')
        ->where('nom_niveau = ?')->params([$nom_niveau]);
        return $this->first();
    }
    
    /* retourne les informations d'un centre de formation en fonction du nom */
    public function read_with_code_niveau (string $code_niveau)
    {
        $this->free_db()
        ->select()
        ->from('Niveaux')
        ->order('nom_niveau', 'ASC')
        ->where('statut_existant != 0')
        ->where('code_niveau = ?')->params([$code_niveau]);
        return $this->first();
    }
    
    /* selection des informations de tous les centres de formation */
    public function read_all()
    {
        $this->free_db()
        ->select()
        ->from('Niveaux')
        ->where('statut_existant != 0')
        ->order('nom_niveau', 'ASC');
        return $this->result();        
    }


    /* insertion d'une nouveau niveau dans la base de données */
    public function create(array $niveaux)
    {
       return $this->free_db()
        ->insert($niveaux)
        ->into('Niveaux');
    }

    /* mise à jours des informations d'un niveau */
    public function edit_with_id_niveau(int $id_niveau, $niveaux)
    {
       return $this->free_db()
        ->where('id_niveau = ?')->params([$id_niveau])
        ->update('Niveaux', $niveaux);
    }

    /* desactivation d'un noveau: le niveau n'est pas supprimer definitivement de la base de donnée */
    public function remove(int $id_niveau)
    {
       return $this->free_db()
        ->where('id_niveau = ?')->params([$id_niveau])        
        ->set('statut_existant', '0')
        ->update('Niveaux');        
    }
 
}
?>