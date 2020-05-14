<?php

/* classe tranches_horaires pour accèss à la classe tranches_horaires de la base de données */
class Tranches_horairesModel extends dFramework\core\Model
{
    /* Constructeur de la classe */
    public function __construct()
    {
        parent::__construct();
    }
    
    /* determine pour une partie d'un cours donner si le numero existe deja */
    public function exist_tranche(string $heure_debut, string $heure_fin)
    {
        return $this->free_db()
        ->from('Tranches_horaires')
        ->where('heure_debut = ? ')->params([$heure_debut])
        ->where('heure_fin = ? ')->params([$heure_fin])
        ->count() > 0;
    }


    /* selection des informations d'une tranches_horaires */
    public function read_all()
    {
        $this->free_db()
        ->select()  
        ->from('Tranches_horaires')
        ->order('heure_debut', 'ASC');
        return $this->result();
    }

    /* selection des informations d'une tranches_horaires */
    public function read_with_id(int $id_tranche)
    {
        $this->free_db()
        ->select()  
        ->from('Tranches_horaires')
        ->where('id_tranche = ?')->params([$id_tranche])
        ->order('heure_debut', 'ASC');
        return $this->first();

    }

    /* insertion d'une nouvelle tranches_horaires dans la base de données */
    public function create(array $tranches)
    {
       return $this->free_db()
        ->insert($tranches)
        ->into('Tranches_horaires');
    }

    /* mise à jours des informations d'une tranches_horaires */
    public function edit_with_id(int $id_tranche, $tranches)
    {
       return $this->free_db()
        ->where('id_tranche = ?')->params([$id_tranche])
        ->update('Tranches_horaires', $tranches);
    }

    /* desactivation d'une tranches_horaires: la tranches_horaires n'est pas supprimer definitivement de la base de donnée */
    public function remove(int $id_tranche)
    {
       return $this->free_db()
        ->where('id_tranche = ?')->params([$id_tranche])
        ->delete('Tranches_horaires');        
    }
}
?>