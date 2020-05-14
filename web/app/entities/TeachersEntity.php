<?php

class TeachersEntity
{
    private $_api;

    private $_classe;


    function __construct($user = null, $api = null)
    {
        if(!empty($user)) {
            foreach ($user As $key => $value) {
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


    function getProfil()
    {
        return ucwords($this->prenom.' '.$this->nom);
    }
    function getAvatar()
    {
        $avatar = md5($this->id_utilisateur).'.jpg';
        if(file_exists(WEBROOT.'img/avatars/'.$avatar)) {
            return img_url('avatars/'.$avatar);
        }
        return img_url('avatars/default.png');
    }

    public function getClasse($key = 'nom_classe')
    {
        if(empty($this->_classe))
        {
            $request = $this->_api->post('classes/read', null, [
                'id_classe' => $this->id_classe
            ]);
            $request = json_decode($request);
            $this->_classe = $request->results;
        }
        if(null === $key) {
            return $this->_classe;
        }
        return ucfirst($this->_classe->{$key});
    }

    public function isFiliere($id_filiere)
    {
        return $this->getClasse('id_filiere') == $id_filiere;
    }
}
