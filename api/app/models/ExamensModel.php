<?php

/* classe examen pour accèss à la classe examen de la base de données */
class ExamensModel extends dFramework\core\Model
{
    /* Constructeur de la classe */
    public function __construct()
    {
        parent::__construct();
    }

    public function read_with_id_examen(int $id_examen)
    {
        $this->free_db()
        ->select()
        ->from('Examens')
        ->where('statut_existant != 0')
        ->where('id_examen = ?')->params([$id_examen])
        ->order('description', 'DESC');
        return $this->first();
    }

    public function read_with_id_type_examen(int $id_type_examen)
    {
        $this->free_db()
        ->select()
        ->from('Examens')
        ->where('statut_existant != 0')
        ->where('id_type_examen = ?')->params([$id_type_examen])
        ->order('description', 'DESC');
        return $this->result();
    }

    public function read_with_id_matiere(int $id_matiere)
    {
        $this->free_db()
        ->select()
        ->from('Examens')
        ->where('statut_existant != 0')
        ->where('id_matiere = ?')->params([$id_matiere])
        ->order('description', 'DESC');
        return $this->result();
    }

    public function read_with_id_utilisateur(int $id_utilisateur)
    {
        $this->free_db()
        ->select()
        ->from('Examens')
        ->where('statut_existant != 0')
        ->where('id_utilisateur = ?')->params([$id_utilisateur])
        ->order('description', 'DESC');
        return $this->result();
    }

    public function read_all()
    {
        $this->free_db()
        ->select()
        ->from('Examens')
        ->where('statut_existant != 0')
        ->order('description', 'DESC');
        return $this->result();
    }

    /* insertion d'un nouveau examen dans la base de données */
    public function create(array $examens)
    {
       return $this->free_db()
        ->insert($examens)
        ->into('Examens');
    }

    /* mise à jours des informations d'un examen */
    public function edit_with_id(int $id_examen, $examens)
    {
       return $this->free_db()
        ->where('id_examen = ?')->params([$id_examen])
        ->update('Examens', $examens);
    }

    /* desactivation d'un examen: l'examen n'est pas supprimer definitivement de la base de donnée */
    public function remove(int $id_examen)
    {
       return $this->free_db()
        ->where('id_examen = ?')->params([$id_examen])        
        ->set('statut_existant', '0')
        ->update('Examens');        
    }
}
?>