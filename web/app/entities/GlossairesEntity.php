<?php

class GlossairesEntity
{
    private $_api;

    function __construct($glossaire = null, $api = null)
    {
        if(!empty($glossaire)) {
            foreach ($glossaire As $key => $value) {
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

    private $_matiere;

    public function matiere()
    {
        if(null === $this->_matiere) {
            $request = $this->_api->post('matieres/read', null, [
                'id_matiere' => $this->id_matiere
            ]);
            $this->_matiere = json_decode($request)->results;
        }
        return $this->_matiere;
    }


    private $_auteur;

    public function auteur($key = 'nom')
    {
        if(null === $this->_auteur) {
            $request = $this->_api->post('user/read', null, [
                'id_utilisateur' => $this->id_utilisateur
            ]);
            $this->_auteur = json_decode($request)->results;
        }
        if(null === $key) {
            return $this->_auteur;
        }
        return ucfirst($this->_auteur->{$key} ?? '');
    }
}
