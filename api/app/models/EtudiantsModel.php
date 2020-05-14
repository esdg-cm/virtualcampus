<?php

/* classe etudiant pour accèss à la classe etudiant de la base de données */
class EtudiantsModel extends UtilisateursModel
{
    /* Constructeur de la classe */
    public function __construct()
    {
        parent::__construct();
    }
    
    /* selection des informations de l'etudiant */
    public function read()
    {
        $this->free_db()
        ->select()
        ->from('Etudiants')
        ->order('matricule', 'ASC');
        return $this->result();        
    }

    /* insertion d'un etudiant dans la base de données */
    public function create(array $etudiants)
    {
       return $this->free_db()
        ->insert($etudiants)
        ->into('Etudiants');
    }

    /* mise à jours des informations d'un etudiant */
    public function edit(int $id_utilisateur, $etudiants)
    {
       return $this->free_db()
        ->where('id_utilisateur = ?')->params([$id_utilisateur])
        ->update('Etudiants', $etudiants);
    }
}
?>