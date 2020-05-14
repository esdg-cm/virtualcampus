<?php

/* classe Propositions_reponsesModel pour accèss à la classe Propositions_reponsesModel de la base de données */
class Propositions_reponsesModel extends dFramework\core\Model
{
    /* Constructeur de la classe */
    public function __construct()
    {
        parent::__construct();
    }

    public function read_with_id_proposition(int $id_proposition)
    {
        $this->free_db()
        ->select()  
        ->from('Propositions_reponses')
        ->where('id_proposition = ?')->params([$id_proposition])
        ->order('proposition', 'ASC');
        return $this->first();
    }

    public function read_with_id_quiz(int $id_quiz)
    {
        $this->free_db()
        ->select()  
        ->from('Propositions_reponses')
        ->where('id_quiz = ?')->params([$id_quiz])
        ->order('proposition', 'ASC');
        return $this->result();
    }

    public function read_all()
    {
        $this->free_db()
        ->select()  
        ->from('Propositions_reponses')
        ->order('proposition', 'ASC');
        return $this->result();
    }

    /* insertion d'une nouvelle Propositions_reponses dans la base de données */
    public function create(array $propositions)
    {
       return $this->free_db()
        ->insert($propositions)
        ->into('Propositions_reponses');
    }

    /* mise à jours des informations d'une Propositions_reponses */
    public function edit_with_id(int $id_proposition, $propositions)
    {
       return $this->free_db()
        ->where('id_proposition = ?')->params([$id_proposition])
        ->update('Propositions_reponses', $propositions);
    }

    /* desactivation d'une Propositions_reponses: la Propositions_reponses n'est pas supprimer definitivement de la base de donnée */
    public function remove(int $id_proposition)
    {
       return $this->free_db()
        ->where('id_proposition = ?')->params([$id_proposition])
        ->delete('Propositions_reponses');        
    }
}
?>