<?php

/* classe centre pour accèss à la classe centre de la base de données */
class CentresModel extends dFramework\core\Model
{
    /* Constructeur de la classe */
    public function __construct()
    {
        parent::__construct();
    }

    /* retourne les informations d'un centre de formation */
    public function read_with_id_centre (int $id_centre)
    {
        $this->free_db()
        ->select()
        ->from('Centres')
        ->order('nom_centre', 'ASC')
        ->where('statut_existant != 0')
        ->where('id_centre = ?')->params([$id_centre]);
        return $this->first();
    }

    /* retourne les informations d'un centre de formation en fonction du code */
    public function read_with_code_centre (string $code_centre)
    {
        $this->free_db()
        ->select()
        ->from('Centres')
        ->order('nom_centre', 'ASC')
        ->where('statut_existant != 0')
        ->where('code_centre = ?')->params([$code_centre]);
        return $this->first();
    }
    
    /* retourne les informations d'un centre de formation en fonction du nom */
    public function read_with_nom_centre (string $nom_centre)
    {
        $this->free_db()
        ->select()
        ->from('Centres')
        ->order('nom_centre', 'ASC')
        ->where('statut_existant != 0')
        ->where('nom_centre = ?')->params([$nom_centre]);
        return $this->first();
    }
    
    /* selection des informations de tous les centres de formation */
    public function read_all( )
    {
        $this->free_db()
        ->select()
        ->from('Centres')
        ->where('statut_existant != 0')
        ->order('nom_centre', 'ASC');
        return $this->result();        
    }

    /* insertion d'un nouveau centre dans la base de données */
    public function create(array $centres)
    {
       return $this->free_db()
        ->insert($centres)
        ->into('Centres');
    }

    /* mise à jours des informations d'un etudiant */
    public function edit_with_id_centre(int $id_centre, $centres)
    {
       return $this->free_db()
        ->where('id_centre = ?')->params([$id_centre])
        ->update('Centres', $centres);
    }

    /* desactivation d'un centre: le centre n'est pas supprimer definitivement de la base de donnée */
    public function remove(int $id_centre)
    {
       return $this->free_db()
        ->where('id_centre = ?')->params([$id_centre])        
        ->set('statut_existant', '0')
        ->update('Centres');        
    }
}
?>