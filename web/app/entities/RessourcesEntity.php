<?php

class RessourcesEntity
{
    private $_api;

    function __construct($ressource = null, $api = null)
    {
        if(!empty($ressource)) {
            foreach ($ressource As $key => $value) {
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

    public function is($type)
    {
        return strtolower($type) === strtolower($this->type_ressource);
    }

    public function url()
    {
        if($this->is('pdf')) {
            return files_url('pdf/'.md5($this->id_ressource).'.pdf');
        }
        return files_url('videos/'.md5($this->id_ressource).'.mp4');
    }
}
