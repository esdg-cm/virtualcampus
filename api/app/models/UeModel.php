<?php

/* classe UE pour accèss à la classe UE de la base de données */
class UeModel extends dFramework\core\Model
{
    /* Constructeur de la classe */
    public function __construct()
    {
        parent::__construct();
    }


    /* retourne les informations d'une filiere de formation */
    public function read_all_info_id (int $id_ue)
    {
        $this->free_db()
        ->select('Ue.*, Semestres.nom_semestre')
        ->from(['Semestres', 'Ue'])
        ->where('Semestres.id_semestre = Ue.id_semestre')
        ->where('Ue.statut_existant != 0')
        ->order('Ue.nom_ue', 'ASC')
        ->where('Ue.id_ue = ?')->params([$id_ue]);
        return $this->first();
    }

    /* retourne les informations d'une filiere de formation */
    public function read_all_info_ue ()
    {
        $this->free_db()
        ->select('Ue.*, Semestres.nom_semestre')
        ->from(['Semestres', 'Ue'])
        ->where('Semestres.id_semestre = Ue.id_semestre')
        ->where('Ue.statut_existant != 0')
        ->order('Ue.nom_ue', 'ASC');
        return $this->result();
    }

    /* selection en fonction de l'identifiant */
    public function read_with_id_ue(int $id_ue)
    {
        $this->free_db()
        ->select()
        ->from('Ue')
        ->order('nom_ue', 'ASC')
        ->where('statut_existant != 0')
        ->where('id_ue = ?')->params([$id_ue]);
        return $this->first();
    }

    /* selection en fonction du code de l'unité d'enseignement */
    public function read_with_code_ue(string $code_ue)
    {
        $this->free_db()
        ->select()
        ->from('Ue')
        ->order('nom_ue', 'ASC')
        ->where('code_ue = ?')->params([$code_ue])
        ->where('statut_existant != 0');
        return $this->first();
    }

    /* selection en fonction du nom de l'unité d'enseignement */
    public function read_with_nom_ue(string $nom_ue)
    {
        $this->free_db()
        ->select()
        ->from('Ue')
        ->order('nom_ue', 'ASC')
        ->where('statut_existant != 0')
        ->where('nom_ue = ?')->params([$nom_ue]);
        return $this->first();
    }

    /* selection en fonction du semestre de l'unité d'enseignement */
    public function read_with_id_semestre(int $id_semestre)
    {
        $this->free_db()
        ->select()
        ->from('Ue')
        ->where('statut_existant != 0')
        ->order('nom_ue', 'ASC')        
        ->where('id_semestre = ?')->params([$id_semestre])->result();
    }

    /* selection en fonction du semestre de l'unité d'enseignement */
    public function read_with_id_filiere(int $id_filiere)
    {
        $this->free_db()
        ->select()
        ->from('Ue')
        ->where('statut_existant != 0')
        ->order('nom_ue', 'ASC')        
        ->where('id_filiere = ?')->params([$id_filiere])->result();
    }

    /* selection en fonction du semestre de l'unité d'enseignement */
    public function read_ue_filiere_niveau(int $id_filiere, int $id_niveau)
    {
        $this->free_db()
        ->select('u.*, s.id_semestre, s.nom_semestre, n.id_niveau, n.nom_niveau, f.id_filiere, f.nom_filiere ')
        ->from(['Ue as u',' Semestres as s', 'Niveaux as n','Filieres as f','Ue_Filieres as uf'])
        ->where('u.statut_existant != 0')
        ->where('u.id_semestre = s.id_semestre')
        ->where('s.id_niveau = n.id_niveau')
        ->where('uf.id_filiere = f.id_filiere')
        ->where('uf.id_ue = u.id_ue')
        ->where('f.id_filiere = ?')->params([$id_filiere])
        ->where('n.id_niveau = ?')->params([$id_niveau])
        ->order('u.nom_ue', 'ASC');   
        return $this->result();
    }

    /* selection de tous les unités d'enseignement */
    public function read_all()
    {
        return $this->free_db()
        ->select()
        ->from('Ue')
        ->where('statut_existant != 0')
        ->order('nom_ue', 'ASC')
        ->result();
    }

    /* Association UE Filiere */
    public function create_eu_filiere(array $ueFiliere)
    {
       return $this->free_db()
        ->insert($ueFiliere)
        ->into('ue_filieres');
    }

    /* insertion d'un nouveau terme du UE dans la base de données */
    public function create(array $ue)
    {
       return $this->free_db()
        ->insert($ue)
        ->into('Ue');
    }


    /* edition en fonction de l'identifiant */
    public function edit_with_id_ue(int $id_ue, array $ue)
    {
       return $this->free_db()
        ->where('id_ue = ?')->params([$id_ue])
        ->update('Ue', $ue);
    }

    /* edition en fonction du code de l'unité d'enseignement */
    public function edit_with_code_ue(string $code_ue, array $ue)
    {
        return $this->free_db()
        ->where('code_ue = ?')->params([$code_ue])
        ->update('Ue', $ue);
    }

    /* edition en fonction du nom de l'unité d'enseignement */
    public function edit_with_nom_ue(string $nom_ue, array $ue)
    {
        $this->free_db()
        ->where('nom_ue = ?')->params([$nom_ue])
        ->update('Ue', $ue);
    }

    /* desactivation d'un UE: le UE n'est pas supprimer definitivement de la base de donnée */
    public function remove(int $id_ue)
    {
       return $this->free_db()
        ->where('id_ue = ?')->params([$id_ue])        
        ->set('statut_existant', '0')
        ->update('Ue');        
    }
}
?>