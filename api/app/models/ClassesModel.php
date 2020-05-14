<?php

/* classe classe pour accèss à la classe classe de la base de données */
class ClassesModel extends dFramework\core\Model
{
    /* Constructeur de la classe */
    public function __construct()
    {
        parent::__construct();
    }

    /* retourne les informations d'une filiere de formation */
    public function read_all_info_id (int $id_classe)
    {
        $this->free_db()
        ->select('Centres.id_centre, Centres.nom_centre, Filieres.id_filiere, Filieres.nom_filiere,
                  Niveaux.id_niveau, Niveaux.nom_niveau, Classes.nom_classe, Classes.code_classe,
                  Classes.id_classe, Classes.statut_existant')
        ->from(['Classes', 'Centres', 'Niveaux', 'Filieres'])
        ->where('Classes.id_niveau = Niveaux.id_niveau')
        ->where('Classes.id_centre = Centres.id_centre')
        ->where('Classes.id_filiere = Filieres.id_filiere')
        ->where('id_classe = ?')->params([$id_classe])
        ->where('Classes.statut_existant != 0')
        ->order('Classes.nom_classe', 'ASC');
        return $this->first();
    }

    /* retourne les informations d'une filiere de formation */
    public function read_all_info_classe ()
    {
        $this->free_db()
        ->select('Centres.id_centre, Centres.nom_centre, Filieres.id_filiere, Filieres.nom_filiere,
                  Niveaux.id_niveau, Niveaux.nom_niveau, Classes.nom_classe, Classes.code_classe,
                  Classes.id_classe, Classes.statut_existant')
        ->from(['Classes', 'Centres', 'Niveaux', 'Filieres'])
        ->where('Classes.id_niveau = Niveaux.id_niveau')
        ->where('Classes.id_centre = Centres.id_centre')
        ->where('Classes.id_filiere = Filieres.id_filiere')
        ->where('Classes.statut_existant != 0')
        ->order('Classes.nom_classe', 'ASC');
        return $this->result();
    }

    /* retourne les informations d'une filiere de formation */
    public function read_with_id_classe (int $id_classe)
    {
        $this->free_db()
        ->select()
        ->from('Classes')
        ->order('nom_classe', 'ASC')
        ->where('statut_existant != 0')
        ->where('id_classe = ?')->params([$id_classe]);
        return $this->first();
    }

    /* retourne les informations d'une filiere de formation en fonction du code */
    public function read_with_id_centre (int $id_centre)
    {
        $this->free_db()
        ->select()
        ->from('Classes')
        ->order('nom_classe', 'ASC')
        ->where('statut_existant != 0')
        ->where('id_centre = ?')->params([$id_centre]);
        return $this->result();
    }
    
    /* retourne les informations d'une filierede formation en fonction du nom */
    public function read_with_id_filiere (int $id_filiere)
    {
        $this->free_db()
        ->select()
        ->from('Classes')
        ->order('nom_classe', 'ASC')
        ->where('statut_existant != 0')
        ->where('id_filiere = ?')->params([$id_filiere]);
        return $this->result();
    }

    /* retourne les informations d'une filierede formation en fonction du code */
    public function read_with_code_classe (string $code_classe)
    {
        $this->free_db()
        ->select()
        ->from('Classes')
        ->order('nom_classe', 'ASC')
        ->where('statut_existant != 0')
        ->where('code_classe = ?')->params([$code_classe]);
        return $this->first();
    }

    /* retourne les informations d'une filierede formation en fonction du nom */
    public function read_with_nom_classe (string $nom_classe)
    {
        $this->free_db()
        ->select()
        ->from('Classes')
        ->order('nom_classe', 'ASC')
        ->where('statut_existant != 0')
        ->where('nom_classe = ?')->params([$nom_classe]);
        return $this->first();
    }
    
    /* retourne les informations d'une filierede formation en fonction du nom */
    public function read_with_id_niveau (int $id_niveau)
    {
        $this->free_db()
        ->select()
        ->from('Classes')
        ->order('nom_classe', 'ASC')
        ->where('statut_existant != 0')
        ->where('id_niveau = ?')->params([$id_niveau]);
        return $this->result();
    }
    /* selection des informations de toutes les classes de formation */
    public function read_all()
    {
        $this->free_db()
        ->select()
        ->from('Classes')
        ->where('statut_existant != 0')
        ->order('nom_classe', 'ASC');
        return $this->result();        
    }

    /* insertion d'une nouvelle salle de classe dans la base de données */
    public function create(array $classes)
    {
       return $this->free_db()
        ->insert($classes)
        ->into('Classes');
    }

    /* mise à jours des informations d'une salle de classe */
    public function edit_with_id_classe(int $id_classe, $classes)
    {
       return $this->free_db()
        ->where('id_classe = ?')->params([$id_classe])
        ->update('Classes', $classes);
    }

    /* desactivation d'une salle de classe: la salle de classe n'est pas supprimer definitivement de la base de donnée */
    public function remove(int $id_classe)
    {
       return $this->free_db()
        ->where('id_classe = ?')->params([$id_classe])        
        ->set('statut_existant', '0')
        ->update('Classes');        
    }
}
?>