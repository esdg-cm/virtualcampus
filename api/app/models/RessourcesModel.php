<?php

/* classe ressources pour accèss à la classe ressources de la base de données */
class RessourcesModel extends dFramework\core\Model
{
    /* Constructeur de la classe */
    public function __construct()
    {
        parent::__construct();
    }

    
    /* selection de toutes les Ressources */
    public function read_all()
    {
        $this->free_db()
        ->select()
        ->from('Ressources')
        ->where('statut_existant != 0')
        ->order('titre_ressource', 'ASC');
        return $this->result();        
    }
    
    /* selection d'une ressource a partir de l'id  de la matiére*/
    public function read_with_id_matiere(int $id_matiere)
    {
        $this->free_db()
        ->select()
        ->from('Ressources')
        ->where('statut_existant != 0')
        ->where('id_matiere = ?')->params([$id_matiere])
        ->order('titre_ressource', 'ASC');
        return $this->result();        
    }

    /* selection desmatieres de l'UE */
    public function read_ressource_id(int $id_ressource)
    {
        $this->free_db()
        ->select()
        ->from('Ressources')
        ->where('statut_existant != 0')
        ->where('id_ressource = ?')->params([$id_ressource])
        ->order('titre_ressource', 'ASC');
        return $this->first();        
    }

    /* selection desmatieres de l'UE */
    public function read_ressource_titre(string $titre_ressource)
    {
        $this->free_db()
        ->select()
        ->from('Ressources')
        ->where('statut_existant != 0')
        ->where('titre_ressource = ?')->params([$titre_ressource])
        ->order('titre_ressource', 'ASC');
        return $this->first();        
    }

    /* insertion d'une nouvelle ressources dans la base de données */
    public function create(array $ressources)
    {
       return $this->free_db()
        ->insert($ressources)
        ->into('Ressources');
    }

    /* mise à jours des informations d'une ressources */
    public function edit_with_id(int $id_ressource, $ressources)
    {
       return $this->free_db()
        ->where('id_ressource = ?')->params([$id_ressource])
        ->update('Ressources', $ressources);
    }

    /* desactivation d'une ressources: la ressources n'est pas supprimer definitivement de la base de donnée */
    public function remove(int $id_ressource)
    {
       return $this->free_db()
        ->where('id_ressource = ?')->params([$id_ressource])
        ->update('Ressources');        
    }
}
?>