<?php

/* classe glossaire pour accèss à la classe glossaire de la base de données */
class GlossairesModel extends dFramework\core\Model
{
    /* Constructeur de la classe */
    public function __construct()
    {
        parent::__construct();
    }

    /* selection des terme d'une matiere */
    public function read_with_id_matiere(int $id_matiere)
    {
        $this->free_db()
        ->select()
        ->from('Glossaires')
        ->where('statut_existant != 0')
        ->where('id_matiere = ?')->params([$id_matiere])
        ->order('terme', 'ASC');
        return $this->result();        
    }

    /* selection des termes d'un utilisateur */
    public function read_with_id_utilisateur(int $id_utilisateur)
    {
        $this->free_db()
        ->select()
        ->from('Glossaires')
        ->where('statut_existant != 0')
        ->where('id_utilisateur = ?')->params([$id_utilisateur])
        ->order('terme', 'ASC');
        return $this->result();        
    }

    /* selection d'un terme du glossaire' */
    public function read_with_id(int $id_glossaire)
    {
        $this->free_db()
        ->select()
        ->from('Glossaires')
        ->where('statut_existant != 0')
        ->where('id_glossaire = ?')->params([$id_glossaire])
        ->order('terme', 'ASC');
        return $this->first();        
    }

    /* selection de tous les termes d'un du glossaire */
    public function read_all()
    {
        $this->free_db()
        ->select()
        ->from('Glossaires')
        ->where('statut_existant != 0')
        ->order('terme', 'ASC');
        return $this->result();        
    }

    /* insertion d'un nouveau terme du glossaire dans la base de données */
    public function create(array $glossaires)
    {
       return $this->free_db()
        ->insert($glossaires)
        ->into('Glossaires');
    }

    /* mise à jours des informations d'un glossaire */
    public function edit_with_id(int $id_glossaire, array $glossaires)
    {
       return $this->free_db()
        ->where('id_glossaire = ?')->params([$id_glossaire])
        ->update('Glossaires', $glossaires);
    }

    /* desactivation d'un glossaire: le glossaire n'est pas supprimer definitivement de la base de donnée */
    public function remove(int $id_glossaire)
    {
       return $this->free_db()
        ->where('id_glossaire = ?')->params([$id_glossaire])        
        ->set('statut_existant', '0')
        ->update('Glossaires');        
    }
}
?>