<?php

/* classe quiz pour accèss à la classe quiz de la base de données */
class QuizModel extends dFramework\core\Model
{
    /* Constructeur de la classe */
    public function __construct()
    {
        parent::__construct();
    }
    
    public function read_with_id_quiz(int $id_quiz)
    {
        $this->free_db()
        ->select()
        ->from('Quiz')
        ->order('question', 'ASC')
        ->where('id_quiz = ?')->params([$id_quiz]);
        return $this->first();      
    }
    
    public function read_with_id_examen(int $id_examen)
    {
        $this->free_db()
        ->select()
        ->from('Quiz')
        ->order('question', 'ASC')
        ->where('id_examen = ?')->params([$id_examen]);
        return $this->result();      
    }
    
    public function read_all()
    {
        $this->free_db()
        ->select()
        ->from('Quiz')
        ->order('question', 'ASC');
        return $this->result();      
    }

    /* insertion d'un nouveau quiz dans la base de données */
    public function create(array $quiz)
    {
       return $this->free_db()
        ->insert($quiz)
        ->into('Quiz');
    }

    /* mise à jours des informations d'un quiz */
    public function edit_with_id(int $id_quiz, $quiz)
    {
       return $this->free_db()
        ->where('id_quiz = ?')->params([$id_quiz])
        ->update('Quiz', $quiz);
    }

    /* desactivation d'un quiz : le quiz n'est pas supprimer definitivement de la base de donnée */
    public function remove(int $id_quiz)
    {
       return $this->free_db()
        ->where('id_quiz = ?')->params([$id_quiz])
        ->delete('Quiz');        
    }
}
?>