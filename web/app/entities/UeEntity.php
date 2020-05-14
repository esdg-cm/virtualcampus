<?php

class UeEntity
{
    private $_api;

    private $_matieres;


    function __construct($ue = null, $api = null)
    {
        if(!empty($ue)) {
            foreach ($ue As $key => $value) {
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



    public function getMatieres()
    {
        if(empty($this->_matieres)) {
            $request = $this->_api->post('matieres/read', null, [
                'id_ue'  => $this->id_ue,
            ]);
           $this->_matieres = json_decode($request)->results;
        }
        return $this->_matieres;
    }
}
