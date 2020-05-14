<?php

/* classe Types_examens pour accèss à la classe Types_examens de la base de données */
class Types_examensModel extends dFramework\core\Model
{
    /* Constructeur de la classe */
    public function __construct()
    {
        parent::__construct();
    }
    
    public function read_with_id(int $id_type_examen)
    {
        $this->free_db()
        ->select()
        ->from('Types_examens')
        ->where('statut_examen != 0')
        ->order('libelle', 'ASC')
        ->where('id_type_examen = ?')->params([$id_type_examen]);
        return $this->first();
    }
    
    public function read_with_code(string $code)
    {
        $this->free_db()
        ->select()
        ->from('Types_examens')
        ->order('libelle', 'ASC')
        ->where('statut_examen != 0')
        ->where('code = ?')->params([$code]);
        return $this->first();
    }
    
    public function read_with_lib(string $libelle)
    {
        $this->free_db()
        ->select()
        ->from('Types_examens')
        ->order('libelle', 'ASC')
        ->where('statut_examen != 0')
        ->where('libelle = ?')->params([$libelle]);
        return $this->first();
    }
    
    public function read_all()
    {
        $this->free_db()
        ->select()
        ->from('Types_examens')
        ->order('libelle', 'ASC')
        ->where('statut_examen != 0');
        return $this->result();
    }

    /* insertion d'un nouveau Types_examens dans la base de données */
    public function create(array $types)
    {
       return $this->free_db()
        ->insert($types)
        ->into('Types_examens');
    }

    /* mise à jours des informations d'un Types_examens */
    public function edit_with_id(int $id_type_examen, $types)
    {
       return $this->free_db()
        ->where('id_type_examen = ?')->params([$id_type_examen])
        ->update('Types_examens', $types);
    }

    /* desactivation d'un Types_examens : le Types_examens n'est pas supprimer definitivement de la base de donnée */
    public function remove(int $id_type_examen)
    {
       return $this->free_db()
        ->where('id_type_examen = ?')->params([$id_type_examen])
        ->delete('Types_examens');        
    }
}
?>