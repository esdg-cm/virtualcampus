<?php

/* classe planing pour accèss à la classe planing de la base de données */
class PlaningsModel extends dFramework\core\Model
{
    /* Constructeur de la classe */
    public function __construct()
    {
        parent::__construct();
    }

    /* utiliser pour savoir si pour une classe et une tranche horaire donnée un cours est déja programmer */
    public function exist_classe_tranche(int $id_classe, int $id_tranche, string $date_jour)
    {
       return $this->free_db()
        ->select()
        ->from('Planings')
        ->where('statut_existant = 1')
        ->where('date_jour = ?')->params([$date_jour])
        ->where('id_classe = ?')->params([$id_classe])
        ->where('id_tranche = ?')->params([$id_tranche])
        ->count() > 0;
    }

    /* utiliser pour determiner si pour une tranche horaire donner un professeur a déja ete programmer */
    public function exist_professeurs_tranche(int $id_utilisateur, int $id_tranche, string $date_jour)
    {
       return $this->free_db()
        ->select()
        ->from('Planings')
        ->where('statut_existant = 1')
        ->where('date_jour = ?')->params([$date_jour])
        ->where('id_utilisateur = ?')->params([$id_utilisateur])
        ->where('id_tranche = ?')->params([$id_tranche])
        ->count() > 0;
    }

    public function read_with_id(int $id_planing)
    {
        $this->free_db()
        ->select()
        ->from('Planings')
        ->where('statut_existant = 1')
        ->where('id_planing = ?')->params([$id_planing])
        ->order('date_jour', 'DESC');
        return $this->first();
    }

    public function read_with_id_matiere(int $id_matiere)
    {
        $this->free_db()
        ->select()
        ->from('Planings')
        ->where('statut_existant = 1')
        ->where('id_matiere = ?')->params([$id_matiere])
        ->order('date_jour', 'DESC');
        return $this->result();
    }

    public function read_with_id_tranche(int $id_tranche)
    {
        $this->free_db()
        ->select()
        ->from('Planings')
        ->where('statut_existant = 1')
        ->where('id_tranche = ?')->params([$id_tranche])
        ->order('date_jour', 'DESC');
        return $this->result();
    }

    public function read_with_id_classe(int $id_classe)
    {
        $this->free_db()
        ->select()
        ->from('Planings')
        ->where('statut_existant = 1')
        ->where('id_classe = ?')->params([$id_classe])
        ->order('date_jour', 'DESC');
        return $this->result();
    }

    public function read_with_id_utilisateur(int $id_utilisateur)
    {
        $this->free_db()
        ->select()
        ->from('Planings')
        ->where('statut_existant = 1')
        ->where('id_utilisateur = ?')->params([$id_utilisateur])
        ->order('date_jour', 'DESC');
        return $this->result();
    }

    public function read_with_date_jour(string $date_jour)
    {
        $this->free_db()
        ->select()
        ->from('Planings')
        ->where('statut_existant = 1')
        ->where('date_jour = ?')->params([$date_jour])
        ->order('date_jour', 'DESC');
        return $this->result();
    }

    public function read_all()
    {
        $this->free_db()
        ->select()
        ->from('Planings')
        ->where('statut_existant = 1')
        ->order('date_jour', 'DESC');
        return $this->result();
    }

    /* insertion d'un nouveau planing dans la base de données */
    public function create(array $planings)
    {
       return $this->free_db()
        ->insert($planings)
        ->into('Planings');
    }

    /* mise à jours des informations d'un planing */
    public function edit_with_id(int $id_planing, $planings)
    {
       return $this->free_db()
        ->where('id_planing = ?')->params([$id_planing])
        ->update('Planings', $planings);
    }

    /* desactivation d'un planing : le planing n'est pas supprimer definitivement de la base de donnée */
    public function remove(int $id_planing)
    {
       return $this->free_db()
        ->where('id_planing = ?')->params([$id_planing])        
        ->set('statut_existant', '0')
        ->update('Planings');        
    }
}
?>