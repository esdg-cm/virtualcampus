<?php

class PartiesEntity
{
    private $_api;

    private $_chapitres;

    function __construct($partie = null, $api = null)
    {
        if(!empty($partie)) {
            foreach ($partie As $key => $value) {
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

    /**
     * Recupere les chapitres d'une partie
     *
     * @return stdClass[]
     */
    public function chapitres()
    {
        if(empty($this->_chapitres)) {
            $request = $this->_api->post('chapitres/read', null, [
                'id_partie'  => $this->id_partie,
                'without_content' => true
            ]);
           $this->_chapitres = json_decode($request)->results;
        }
        return $this->_chapitres;
    }
}
