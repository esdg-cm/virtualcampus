<?php

class MatieresEntity
{
    private $_api;

    private $_parties;

    private $_prof;


    function __construct($matiere = null, $api = null)
    {
        if(!empty($matiere)) {
            foreach ($matiere As $key => $value) {
                $this->{$key} = $value;
            }
        }
        if(null !== $api) {
            $this->initApi($api);
        }
    }
    public function initApi($api)
    {
        $this->_api = $api;
    }

    public function nbr_hr()
    {
        return ($this->nbr_hr_tp + $this->nbr_hr_td + $this->nbr_hr_cm);
    }


    /**
     * Verifie si la matiere est autoriser a etre lue dans unw classe
     *
     * @author Dimitri Sitchet
     * @param  int $id_classe
     * @return bool
     */
    public function autoriser($id_classe)
    {
        $prof = $this->prof($id_classe);
        return !empty($prof);
    }

    /**
     * Recupere le prof qui donne une matiere dans la classe
     *
     * @param  int $id_classe
     * @return stdClass
     */
    public function prof($id_classe)
    {
        if(empty($this->_prof)) {
            $request = $this->_api->post('affectations/readAffectationClasseMatiere', null, [
                'id_matiere'  => $this->id_matiere,
                'id_classe' => $id_classe
            ]);
           $this->_prof = json_decode($request)->results;
        }
        return $this->_prof;
    }



    public function parties()
    {
        if(empty($this->_parties)) {
            $request = $this->_api->post('matieres/read', null, [
                'id_matiere'  => $this->id_matiere,
            ]);
           $this->_parties = json_decode($request)->results;
        }
        return $this->_parties;
    }
}
