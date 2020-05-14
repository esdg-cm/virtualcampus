<?php

use dFramework\core\data\Request;

require_once __DIR__.DS.'__BaseController.php';

/* controlleur de la classe gérant les types d'examen. toutes les methodes s'y trouvant sont destinées à l
la gestion des type d'examen. */
class Types_examensController extends __BaseController
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
        if(true !== $this->checker->inField('libelle','code')) {
            $this->_return('Veuillez remplir tous les champs du formulaire prefixés de  * ', false);
        }

        //Vérification de la longeur du code du centre
        if(true !== $this->checker->min_length('code_centre', 2)) {
            $this->_return('Le code de l\'examen doit avoir au moins 2 caracteres', false);
        } 

        try
        {
            //conversion des données reçu par post
            $type['libelle'] = (string)$data['libelle'];
            $type['code'] = (string)$data['code'];
            $type['statut_examen'] = 1;

            $can_create_lib = false;
            $can_create_code = false;
            $can_create_id = 0;

            //si le code du centre existe déja en base de donnée
            if(true === $this->model->exist('code', $type['code'], 'Types_examens')) {
                $results = $this->model->read_with_code($type['code']);
                if (!empty($results)) {
                    $this->_return('Un type d\'examen possede déja ce code', false);
                } 
                $can_create_code = true;            
            }
            //si le nom du centre existe déja en base de donnée
            if(true === $this->model->exist('libelle', $type['libelle'], 'Types_examens')) {
                $results = $this->model->read_with_lib($type['libelle']);
                if (!empty($results)) {
                    $this->_return('Un type d\'examen  possede déja ce nom', false);
                }
                $can_create_id = $results->id_centre;
                $can_create_lib = true;            
            }

            if($can_create_lib && $can_create_code)
            {
                $this->model->edit_with_id($can_create_id, $type);
                $this->_return('type d\'examen crée avec succès!!',true);
            }

            //Aucune des informations n'existe deja en base de donnée
            $this->model->create($type);
            $this->_return('type d\'examen crée avec succès!!',true);          
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
            //selection d'un centre en foction de l'identifiant
            if (!empty($data['id_type_examen'])) {
                $results = $this->model->read_with_id((int)$data['id_type_examen']);

                if (empty($results)) {
                    $this->_return('Le type d\'examen demandé n\'existe pas dans la base de donnée', false);
                }
                $this->_return('Informations sur le type d\'examen  '.$results->libelle.' ', true, $results);
            }

            //selection d'un centre en foction du code 
            if (!empty($data['code'])) {
                $results = $this->model->read_with_code((string)$data['code']);

                if (empty($results)) {
                    $this->_return('Le type d\'examen  demandé n\'existe pas dans la base de donnée', false);
                }
                $this->_return('Informations sur le type d\'examen   '.$results->libelle.' ', true, $results);
            }
            
            //selection d'un centre en foction du code du centre
            if (!empty($data['libelle'])) {
                $results = $this->model->read_with_lib((string)$data['libelle']);

                if (empty($results)) {
                    $this->_return('Le type d\'examen demandé n\'existe pas dans la base de donnée', false);
                }
                $this->_return('Informations sur le type d\'examen  '.$results->libelle.' ', true, $results);
            }

            //selection de tous les centres d'enseignement
            $results = $this->model->read_all();
            if (empty($results)) {
                $this->_return('Vous n\'avez pas encore de type d\'examen en base de données', false);
            }
            $this->_return('liste des types d\'examens disponible dans la base de données', true, $results);
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

        //vérification des champs necessaires pour la création d'un type examen        
        if(true !== $this->checker->inField('id_type_examen','libelle','code')) {
            $this->_return('Veuillez remplir tous les champs du formulaire prefixés de  * ', false);
        }
        //vérification de la longeur du code d'un type examen
        if(true !== $this->checker->min_length('code', 3)) {
            $this->_return('Le code du type d\'examen doit avoir au moins 3 caracteres', false);
        } 

        try
        {
            //conversion des données reçu par post
            $type['id_type_examen'] = (int)$data['id_type_examen'];
            $type['libelle'] = (string)$data['libelle'];
            $type['code'] = (string)$data['code'];
            $type['statut_examen'] = 1;

            //si le code du type examen existe déja en base de donnée
            if(true === $this->model->exist('code', $type['code'], 'Types_examens')) {
                $results = $this->model->read_with_code($type['code']);
                if (!empty($results) && ($results->id_type_examen != $type['id_type_examen'])) {
                    $this->_return('Un type d\'examen possede déja ce code', false);
                }             
            }
            //si le nom du type examen existe déja en base de donnée
            if(true === $this->model->exist('libelle', $type['libelle'], 'Types_examens')) {
                $results = $this->model->read_with_lib($type['libelle']);
                if (!empty($results) && ($results->id_type_examen != $type['id_type_examen'])) {
                    $this->_return('Un type d\'examen possede déja ce nom', false);
                }           
            }

            //Aucune des informations n'existe deja en base de donnée
            $this->model->edit_with_id($type['id_type_examen'], $type);
            $this->_return('type d\'examen modifié avec succès!!',true);
        }
        catch(Exception $e)
        {
            $this->_exception($e);
        }
    }

    /* suppression d'un centre */
    public function delete()
    {
        //recuperation des informations pour la suppression d'un centre
        $data = $this->request->data;
        $id_type_examen = (int)$data['id_type_examen'] ?? null;
        if (empty($id_type_examen)) {
            $this->_return('Veillez spécifier l\'identifiant du type d\'examen à supprimer', false);
        }

        if (true === $this->model->exist('id_type_examen', (int)$data['id_type_examen'], 'Examens')) {
            $this->_return('impossible de supprimer ce type d\'examen car il comporte encore des presences ', false);
        }

        try {
            $this->model->remove($id_type_examen);
            $this->_return('type d\'examen supprimé avec succès', true);
            //code...
        } 
        catch (Exception $e)
        {
            $this->_exception($e);
        }
    }


}