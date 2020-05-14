<?php

use dFramework\core\data\Request;
use dump_r\Node\String0;

require_once __DIR__.DS.'__BaseController.php';

/* controlleur de la classe gérant les tranches horaire du cours . toutes les methodes s'y trouvant sont destinées à l
la gestion des tranches horaire du cours. */
class Tranches_horairesController extends __BaseController
{
    /* constructeur de la classe */
    public function __construct()
    {
        parent::__construct();
        $this->response->type('application/json; charset=UTF-8');
    }

    /* fonction par defaut du controlleur. en fonction du type d'appelle (verbe HTTP utilisé) une fonction sera executer. */
    public function index($id_ue = null)
    {
        switch (strtolower($this->request->method())) {
            case 'post' : $this->create(); break;
            case 'delete': $this->delete($id_ue); break;
            case 'put': $this->put(); break;
            default: $this->read($id_ue);
        }
    }

    public function create ()
    {
        //recupération des données en post
        $data = $this->request->data;

        //librerie de validation des champs
        $this->loadLibrary('checker');
        $this->checker->useInputField(true, $data);  

        //vérification des champs necessaires pour la création d'un centre        
        if(true !== $this->checker->inField('heure_debut','heure_fin')) {
            $this->_return('Veuillez remplir tous les champs du formulaire prefixés de  * ', false);
        } 

        try
        {
            //conversion des données reçu par post
            $tranche['heure_debut'] = (string)$data['heure_debut'];
            $tranche['heure_fin'] = (string)$data['heure_fin'];

            if($tranche['heure_debut'] >=  $tranche['heure_fin'])
            {
                $this->_return('cette tranche horaire est invalide : l\'heure de debut ne peut pas être superieure ou égale à l\'heure de fin ', false);
            }

            if(true === $this->model->exist_tranche($tranche['heure_debut'], $tranche['heure_fin']))
            {
                $this->_return('cette tranche horaire existe déja', false);
            }

            //Aucune des informations n'existe deja en base de donnée
            $this->model->create($tranche);
            $this->_return('tranche horaire créee avec succès!!',true);          
        }
        catch(Exception $e)
        {
            $this->_exception($e);
        }
    }

    public function read()
    {
        //recupération des données en post
        $data = $this->request->data;
        try
        {
            //selection d'une tranche horaire en foction de l'identifiant
            if (!empty($data['id_tranche'])) {
                $results = $this->model->read_with_id((int)$data['id_tranche']);

                if (empty($results)) {
                    $this->_return('La tranche horaire demandée n\'existe pas dans la base de donnée', false);
                }
                $this->_return('Informations sur la tranche horaire ', true, $results);
            }

            //selection de toutes les horaires d'enseignement
            $results = $this->model->read_all();
            if (empty($results)) {
                $this->_return('Vous n\'avez pas encore de tranche horaire en base de données', false);
            }
            $this->_return('liste des tranches horaires disponibles dans la base de données', true, $results);
        }
        catch(Exception $e)
        {
            $this->_exception($e);
        }
    }

    public function put()
    {
        //recupération des données en post
        $data = $this->request->data;

        //librerie de validation des champs
        $this->loadLibrary('checker');
        $this->checker->useInputField(true, $data);  

        //vérification des champs necessaires pour la création d'un centre        
        if(true !== $this->checker->inField('id_tranche', 'heure_debut','heure_fin')) {
            $this->_return('Veuillez remplir tous les champs du formulaire prefixés de  * ', false);
        } 

        try
        {
            if (true !== $this->model->exist('id_tranche', (int)$data['id_tranche'], 'Tranches_horaires')) {
                $this->_return('la tranche horaire spécifiée n\existe pas. ', false);
            }

            //conversion des données reçu par post
            $tranche['id_tranche'] = (String)$data['id_tranche'];
            $tranche['heure_debut'] = (String)$data['heure_debut'];
            $tranche['heure_fin'] = (string)$data['heure_fin'];

            if($tranche['heure_debut'] >=  $tranche['heure_fin'])
            {
                $this->_return('cette tranche horaire est invalide : l\'heure de debut ne peut pas être superieure ou égale à l\'heure de fin ', false);
            }

            if(true === $this->model->exist_tranche($tranche['heure_debut'], $tranche['heure_fin']))
            {
                $this->_return('cette tranche horaire existe déja', false);
            }

            //Aucune des informations n'existe deja en base de donnée
            $this->model->edit_with_id($tranche['id_tranche'], $tranche);
            $this->_return('tranche horaire editée avec succès!!',true);          
        }
        catch(Exception $e)
        {
            $this->_exception($e);
        }
    }

    /* suppression d'une filiére */
    public function delete()
    {
        //recuperation des informations pour la suppression d'une filiére
        $data = $this->request->data;
        $id_tranche = (int)$data['id_tranche'] ?? null;
        if (empty($id_tranche)) {
            $this->_return('Veillez spécifier l\'identifiant de la partie à supprimer', false);
        }
        if (true !== $this->model->exist('id_tranche', (int)$data['id_tranche'], 'Tranches_horaires')) {
            $this->_return('la tranche horaire spécifiée n\'existe pas. ', false);
        }

        if (true === $this->model->exist('id_tranche', (int)$data['id_tranche'], 'Planings')) {
            $this->_return('cette tranche horaire ne peux pas encore être supprimer car il figure encore dans un planing. ', false);
        }       

        try {
            $this->model->remove($id_tranche);
            $this->_return('tranche horaire supprimée avec succès', true);
            //code...
        } 
        catch (Exception $e)
        {
            $this->_exception($e);
        }
    }


}