<?php

/* classe Professeur pour accèss à la classe Professeur de la base de données */
class professeursModel extends UtilisateursModel
{
    /* Constructeur de la classe */
    public function __construct()
    {
        parent::__construct();
    }
    
    /* selection des informations de l'etudiant */
    public function read_professeur()
    {
        $this->free_db()
        ->select()
        ->from('Professeurs');
        return $this->result();        
    }

    /* insertion d'un professeurs dans la base de données */
    public function create_professeur(array $professeurs)
    {
       return $this->free_db()
        ->insert($professeurs)
        ->into('Professeurs');
    }

    /* mise à jours des informations d'un professeur */
    public function edit_professeur(int $id_utilisateur, $professeurs)
    {
       return $this->free_db()
        ->where('id_utilisateur = ?')->params([$id_utilisateur])
        ->update('Professeurs', $professeurs);
    }
}
?>