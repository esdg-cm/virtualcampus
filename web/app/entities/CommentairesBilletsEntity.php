<?php

class CommentairesBilletsEntity
{
    private $_api;

    function __construct($commentaire = null, $api = null)
    {
        if(!empty($commentaire)) {
            foreach ($commentaire As $key => $value) {
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

    public function getDate()
    {
        return scl_translate_date(scl_date($this->date_commentaire), 'fr');
    }
    public function getContent() {
        return ucfirst($this->contenu);
    }

    private $_auteur;

    public function auteur($key = null)
    {
        if(null === $this->_auteur) {
            $request = $this->_api->post('user/read', null, [
                'id_utilisateur' => $this->id_utilisateur
            ]);
            $this->_auteur = json_decode($request)->results;
        }
        if(null === $key) {
            return new StudentsEntity($this->_auteur, $this->_api);
        }
        return ucfirst($this->_auteur->{$key} ?? '');
    }
}
