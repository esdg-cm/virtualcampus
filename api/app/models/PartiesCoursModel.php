<?php

/* classe Parties_coursModel pour accèss à la classe Parties_cours de la base de données */
class PartiesCoursModel extends dFramework\core\Model
{
    /* Constructeur de la classe */
    public function __construct()
    {
        parent::__construct();
    }

    /* determine pour un cours donneer si ce nom de partie existe deja */
    public function exist_titre_partie(int $id_matiere, string $titre_partie)
    {
        return $this->free_db()
        ->from('Parties_cours')
        ->where('statut_existant != 0')
        ->where('id_matiere = ? ')->params([$id_matiere])
        ->where('titre_partie = ? ')->params([$titre_partie])
        ->count() > 0;
    }

    /* determine pour une partie d'un cours donner si le numero existe deja */
    public function exist_num_partie(int $id_matiere, int $num_partie)
    {
        return $this->free_db()
        ->from('Parties_cours')
        ->where('statut_existant != 0')
        ->where('id_matiere = ? ')->params([$id_matiere])
        ->where('num_partie = ? ')->params([$num_partie])
        ->count() > 0;
    }

    /* selection des informations d'une partie du cours de formation */
    public function read_with_id_partie(int $id_partie)
    {
        $this->free_db()
        ->select()
        ->from('Parties_cours')
        ->where('statut_existant != 0')
        ->where('id_partie = ?')->params([$id_partie])
        ->order('num_partie', 'ASC');
        return $this->result();
    }

    /* selection des informations d'une partie du cours de formation */
    public function read_with_id_matiere(int $id_matiere)
    {
        $this->free_db()
        ->select()
        ->from('Parties_cours')
        ->where('statut_existant != 0')
        ->where('id_matiere = ?')->params([$id_matiere])
        ->order('num_partie', 'ASC');
        return $this->result();
    }

    /* selection des informations d'une partie du cours de formation */
    public function read_all()
    {
        $this->free_db()
        ->select()
        ->from('Parties_cours')
        ->where('statut_existant != 0')
        ->order('num_partie', 'ASC');
        return $this->result();
    }

    /* insertion d'une nouvelle partie du cours dans la base de données */
    public function create(array $parties)
    {
       return $this->free_db()
        ->insert($parties)
        ->into('Parties_cours');
    }

    /* mise à jours des informations d'une partie du cours */
    public function edit_with_id(int $id_partie, $parties)
    {
       return $this->free_db()
        ->where('id_partie = ?')->params([$id_partie])
        ->update('Parties_cours', $parties);
    }

    /* desactivation d'une partie du cours: la partie du cours n'est pas supprimer definitivement de la base de donnée */
    public function remove(int $id_partie)
    {
       return $this->free_db()
        ->where('id_partie = ?')->params([$id_partie])
        ->set('statut_existant', '0')
        ->update('Parties_cours');
    }
}
?>
