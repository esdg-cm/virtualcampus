<?php

/* classe Programmes_examens pour accèss à la classe Programmes_examens de la base de données */
class Programmes_examensModel extends dFramework\core\Model
{
    /* Constructeur de la classe */
    public function __construct()
    {
        parent::__construct();
    }
    
    public function read_with_id_programme(int $id_programme)
    {
        $this->free_db()
        ->select()
        ->from('Programmes_examens')
        ->where('statut_existant != 0')
        ->where('id_programme = ?')->params([$id_programme])
        ->order('date_debut', 'ASC');
        return $this->first();
    }
    
    public function read_with_id_examen(int $id_examen)
    {
        $this->free_db()
        ->select()
        ->from('Programmes_examens')
        ->where('statut_existant != 0')
        ->where('id_examen = ?')->params([$id_examen])
        ->order('date_debut', 'ASC');
        return $this->result();
    }
    
    public function read_with_id_classe(int $id_classe)
    {
        $this->free_db()
        ->select()
        ->from('Programmes_examens')
        ->where('statut_existant != 0')
        ->where('id_classe = ?')->params([$id_classe])
        ->order('date_debut', 'ASC');
        return $this->result();
    }
    
    public function read_all()
    {
        $this->free_db()
        ->select()
        ->from('Programmes_examens')
        ->where('statut_existant != 0')
        ->order('date_debut', 'ASC');
        return $this->first();
    }

    /* insertion d'un nouveau Programmes_examens dans la base de données */
    public function create(array $programmes)
    {
       return $this->free_db()
        ->insert($programmes)
        ->into('Programmes_examens');
    }

    /* mise à jours des informations d'un Programmes_examens */
    public function edit_with_id(int $id_programme, $programmes)
    {
       return $this->free_db()
        ->where('id_programme = ?')->params([$id_programme])
        ->update('Programmes_examens', $programmes);
    }

    /* desactivation d'un Programmes_examens : le Programmes_examens n'est pas supprimer definitivement de la base de donnée */
    public function remove(int $id_programme)
    {
       return $this->free_db()
        ->where('id_programme = ?')->params([$id_programme])        
        ->set('statut_existant', '0')
        ->update('Programmes_examens');        
    }
}
?>