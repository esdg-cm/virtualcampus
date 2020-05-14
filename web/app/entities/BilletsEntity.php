<?php

class BilletsEntity
{
    private $_api;

    function __construct($billet = null, $api = null)
    {
        if(!empty($billet)) {
            foreach ($billet As $key => $value) {
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
        return scl_translate_date(scl_date($this->date_publication), 'fr');
    }
    public function getContent() {
        return ucfirst($this->contenu);
    }
    public function getSubject() {
        return ucfirst($this->sujet);
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

    
    private $_filiere;

    public function filiere($key = null)
    {
        if(null === $this->_filiere) {
            $request = $this->_api->post('filieres/read', null, [
                'id_filiere' => $this->id_filiere
            ]);
            $this->_filiere = json_decode($request)->results ?? null;
        }
        if(null === $key) {
            return $this->_filiere;
        }
        return ucfirst($this->_filiere->{$key} ?? '');
    }

    public function nbrCommentaire() 
    {
        $request = $this->_api->get('billets_forum/nbrcommentaire/'.$this->id_billet);
        return json_decode($request)->results ?? 0;
    }

    public function commentaires() 
    {
        $request = $this->_api->post('commentaire_forum/read/', null, [
            'id_billet' => $this->id_billet
        ]);
        $commentaires = json_decode($request)->results;
        if(!empty($commentaires)) {
            foreach ($commentaires As $key => $value) {
                $commentaires[$key] = new CommentairesBilletsEntity($value, $this->_api);
            }
        }
        return $commentaires;
    }
}
