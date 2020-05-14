<?php

/* classe evaluation pour accèss à la classe evaluation de la base de données */
class EvaluationsModel extends dFramework\core\Model
{
    /* Constructeur de la classe */
    public function __construct()
    {
        parent::__construct();
    }
    
    public function read_with_id_evaluation(int $id_evaluation)
    {
        $this->free_db()
        ->select()
        ->from('Evaluations')
        ->order('id_evaluation', 'ASC')
        ->where('id_evaluation = ?')->params([$id_evaluation]);
        return $this->first();      
    }
    
    public function read_with_id_examen(int $id_examen)
    {
        $this->free_db()
        ->select()
        ->from('Evaluations')
        ->order('id_evaluation', 'ASC')
        ->where('id_examen = ?')->params([$id_examen]);
        return $this->result();      
    }
    
    public function read_with_id_utilisateur(int $id_utilisateur)
    {
        $this->free_db()
        ->select()
        ->from('Evaluations')
        ->order('id_evaluation', 'ASC')
        ->where('id_utilisateur = ?')->params([$id_utilisateur]);
        return $this->result();      
    }
    
    public function read_all()
    {
        $this->free_db()
        ->select()
        ->from('Evaluations')
        ->order('id_evaluation', 'ASC');
        return $this->result();      
    }

    /* insertion d'une nouvelle evaluation dans la base de données */
    public function create(array $evaluations)
    {
       return $this->free_db()
        ->insert($evaluations)
        ->into('Evaluations');
    }

    /* mise à jours des informations d'une evaluation */
    public function edit_with_id(int $id_evaluation, $evaluations)
    {
       return $this->free_db()
        ->where('id_evaluation = ?')->params([$id_evaluation])
        ->update('Evaluations', $evaluations);
    }

    /* desactivation d'une evaluation: l'evaluation n'est pas supprimer definitivement de la base de donnée */
    public function remove(int $id_evaluation)
    {
       return $this->free_db()
        ->where('id_evaluation = ?')->params([$id_evaluation])
        ->delete('Evaluations');        
    } 
}
?>