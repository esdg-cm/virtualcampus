<?php

/* classe presence pour accèss à la classe presence de la base de données */
class PresencesModel extends dFramework\core\Model
{
    /* Constructeur de la classe */
    public function __construct()
    {
        parent::__construct();
    }
    
    /* selection des informations d'une presence */
    public function read(?int $id_presence = null, ?int $id_planing = null, ?int $id_utilisateur = null)
    {
        $this->free_db()
        ->select()
        ->from('Presences')
        ->order('date_presence', 'DESC');
        
        //selection en fonction de l'identifiant de la Presences.
        if ($id_presence != null) {
            $this->where('id_presence = ?')->params([$id_presence]);    
        }
        //selection en fonction du planing
        if ($id_planing != null) {
            $this->where('id_planing = ?')->params([$id_planing]);
        }
        //selection en fonction de l'utilisateur 
        if ($id_utilisateur != null) {
            $this->where('id_utilisateur = ?')->params([$id_utilisateur]);
        }

        if($id_presence != null) {
            return $this->first();
        }

        return $this->result();        
    }

    /* insertion d'une nouvelle Presences dans la base de données */
    public function create(array $presences)
    {
       return $this->free_db()
        ->insert($presences)
        ->into('Presences');
    }

    /* mise à jours des informations d'une Presences */
    public function edit(int $id_presence, $presences)
    {
       return $this->free_db()
        ->where('id_presence = ?')->params([$id_presence])
        ->update('Presences', $presences);
    }

    /* desactivation d'une Presences: la Presences n'est pas supprimer definitivement de la base de donnée */
    public function remove(int $id_presence)
    {
       return $this->free_db()
        ->where('id_presence = ?')->params([$id_presence])
        ->update('Presences');        
    }
}
?>