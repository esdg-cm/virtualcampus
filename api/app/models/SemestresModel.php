<?php

/* classe semestre pour accèss à la classe semestre de la base de données */
class SemestresModel extends dFramework\core\Model
{
    /* Constructeur de la classe */
    public function __construct()
    {
        parent::__construct();
    }
    
    /* selection de tous les semestres */
    public function read_all()
    {
        $this->free_db()
        ->select()
        ->from('Semestres')
        ->where('statut_existant != 0')
        ->order('nom_semestre', 'ASC');    
        return $this->result();        
    } 
    
    /* selection d'un semestres par id*/
    public function read_with_id(int $id_semestre)
    {
        $this->free_db()
        ->select()
        ->from('Semestres')
        ->where('statut_existant != 0')
        ->where('id_semestre = ?')->params([$id_semestre])
        ->order('nom_semestre', 'ASC');    
        return $this->first();        
    }  
    
    /* selection d'un semestres par id*/
    public function read_all_info_with_id(int $id_semestre)
    {
        $this->free_db()
        ->select('Semestres.*, Niveaux.nom_niveau, Niveaux.id_niveau')
        ->from(['Semestres','Niveaux'])
        ->where('Semestres.statut_existant != 0')
        ->where('Semestres.id_niveau = Niveaux.id_niveau')
        ->where('Semestres.id_semestre = ?')->params([$id_semestre])
        ->order('Semestres.nom_semestre', 'ASC');    
        return $this->first();        
    }  
    
    /* selection d'un semestres par id*/
    public function read_all_info()
    {
        $this->free_db()
        ->select('Semestres.*, Niveaux.nom_niveau, Niveaux.id_niveau')
        ->from(['Semestres','Niveaux'])
        ->where('Semestres.statut_existant != 0')
        ->where('Semestres.id_niveau = Niveaux.id_niveau')
        ->order('Semestres.nom_semestre', 'ASC');    
        return $this->result();        
    } 
    
    /* selection d'un semestres par le nom*/
    public function read_with_nom(string $nom_semestre)
    {
        $this->free_db()
        ->select()
        ->from('Semestres')
        ->where('statut_existant != 0')
        ->where('nom_semestre = ?')->params([$nom_semestre])
        ->order('nom_semestre', 'ASC');    
        return $this->first();        
    } 
    
    /* selection d'un semestres par l'abreviation*/
    public function read_with_abv(string $abreviation)
    {
        $this->free_db()
        ->select()
        ->from('Semestres')
        ->where('statut_existant != 0')
        ->where('abreviation = ?')->params([$abreviation])
        ->order('nom_semestre', 'ASC');    
        return $this->first();        
    }
    
    /* selection des semestres d'un niveau*/
    public function read_with_id_niveau(int $id_niveau)
    {
        $this->free_db()
        ->select()
        ->from('Semestres')
        ->where('statut_existant != 0')
        ->where('id_niveau = ?')->params([$id_niveau])
        ->order('nom_semestre', 'ASC');    
        return $this->result();        
    }

    /* insertion d'un nouveau semestre dans la base de données */
    public function create(array $semestres)
    {
       return $this->free_db()
        ->insert($semestres)
        ->into('Semestres');
    }

    /* Edition a partir de l'identification */
    public function edit_with_id(int $id_semestre, array $semestres)
    {
        return $this->free_db()
        ->where('id_semestre = ?')->params([$id_semestre])
        ->update('Semestres', $semestres); 
    }
    /* edition a partir de l'abreviation */
    public function edit_with_abv(string $abreviation, array $semestres)
    {
        $this->free_db()
        ->where('abreviation = ?')->params([$abreviation])
        ->update('Semestres', $semestres); 
    }
    /* edition a partir du non  */
    public function edit_with_nom(string $nom_semestre, array $semestres)
    {
        $this->free_db()
        ->where('nom_semestre = ?')->params([$nom_semestre])
        ->update('Semestres', $semestres); 
    }

    /* desactivation d'un semestre: le semestre n'est pas supprimer definitivement de la base de donnée */
    public function remove(int $id_semestre)
    {
       return $this->free_db()
        ->where('id_semestre = ?')->params([$id_semestre])        
        ->set('statut_existant', '0')
        ->update('Semestres');        
    }
}
?>