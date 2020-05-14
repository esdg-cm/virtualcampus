<?php

/* classe Centres_FilieresModel pour accèss à la classe Centres_FilieresModel de la base de données */
class Centres_FilieresModel extends dFramework\core\Model
{
    /* Constructeur de la classe */
    public function __construct()
    {
        parent::__construct();
    }

    /* insertion d'une nouvelle corespondance centre-filiere dans la base de données */
    public function create(array $centres_filieres)
    {
       return $this->free_db()
        ->insert($centres_filieres)
        ->into('Centres_Filieres');
    }
}