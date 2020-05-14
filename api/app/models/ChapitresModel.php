<?php

/* classe chapitre pour accèss à la classe chapitre de la base de données */
class ChapitresModel extends dFramework\core\Model
{
    /* Constructeur de la classe */
    public function __construct()
    {
        parent::__construct();
    }


    /* determine pour un cours donneer si ce nom de partie existe deja */
    public function exist_titre_chapitre(int $id_partie, string $titre_chap)
    {
        return $this->free_db()
        ->from('Chapitres')
        ->where('statut_existant != 0')
        ->where('id_partie = ? ')->params([$id_partie])
        ->where('titre_chap = ? ')->params([$titre_chap])
        ->count() > 0;
    }

    /* determine pour une partie d'un cours donner si le numero existe deja */
    public function exist_num_chapitre(int $id_partie, int $num_chap)
    {
        return $this->free_db()
        ->from('Chapitres')
        ->where('statut_existant != 0')
        ->where('id_partie = ? ')->params([$id_partie])
        ->where('num_chap = ? ')->params([$num_chap])
        ->count() > 0;
    }

      /* selection des informations d'un chapitre avec id */
      public function read_with_id(int $id_chapitre, $without_content = false)
      {
          $this->free_db()
            ->from('Chapitres')
            ->where('statut_existant != 0')
            ->where('id_chapitre = ?')->params([$id_chapitre])
            ->order('num_chap', 'ASC');
          if(false === $without_content) {
            $this->select();
          }
          else {
            $this->select('id_chapitre','id_partie','titre_chap','num_chap','statut_existant');
          }
          return $this->first();
      }

      /* selection des informations d'un chapitre avec id */
      public function read_with_id_partie(int $id_partie, $without_content = false)
      {
          $this->free_db()
            ->from('Chapitres')
            ->where('statut_existant != 0')
            ->where('id_partie = ?')->params([$id_partie])
            ->order('num_chap', 'ASC');
          if(false === $without_content) {
            $this->select();
          }
          else {
            $this->select('id_chapitre','id_partie','titre_chap','num_chap','statut_existant');
          }
          return $this->result();
      }

    /* selection des informations d'un chapitre */
    public function read_all($without_content)
    {
        $this->free_db()
        ->from('Chapitres')
        ->where('statut_existant != 0')
        ->order('num_chap', 'ASC');
        /**
         * @author Dimitri Sitchet
         * @see  ChapitresController on line 83 for more explanation
         */
        if(false === $without_content) {
            $this->select();
          }
          else {
            $this->select('id_chapitre','id_partie','titre_chap','num_chap','statut_existant');
          }
        return $this->result();
    }

    /**
     * Pour la lecture d'un chapitre precis d'un cours
     * @author Dimitri Sitchet
     * @param  int $id_matiere
     * @param  int|null $id_chapitre
     * @return object
     */
    public function read_with_matiere_and_chapitre($id_matiere, $id_chapitre = null)
    {
        $this->free_db()
          ->select('c.*')
          ->from('Chapitres', 'c')
          ->order('c.num_chap', 'ASC')
          ->limit(1);
        if(null !== $id_chapitre) {
          $this->where('id_chapitre = ?')->params([$id_chapitre]);
        }
        else {
          $this
            ->join('parties_cours As p', 'c.id_partie = p.id_partie', 'inner')
            ->join('matieres As m', 'p.id_matiere = m.id_matiere')
            ->where('m.id_matiere = ?')->params([$id_matiere]);
        }
        return $this->first();
    }


    /* insertion d'un nouveau chapitre dans la base de données */
    public function create(array $chapitres)
    {
       return $this->free_db()
        ->insert($chapitres)
        ->into('Chapitres');
    }

    /* mise à jours des informations d'un chapitre */
    public function edit_with_id(int $id_chapitre, $chapitres)
    {
       return $this->free_db()
        ->where('id_chapitre = ?')->params([$id_chapitre])
        ->update('Chapitres', $chapitres);
    }

    /* desactivation d'un chapitre : le chapitre n'est pas supprimer definitivement de la base de donnée */
    public function remove(int $id_chapitre)
    {
       return $this->free_db()
        ->where('id_chapitre = ?')->params([$id_chapitre])
        ->set('statut_existant', '0')
        ->update('Chapitres');
    }
}
?>
