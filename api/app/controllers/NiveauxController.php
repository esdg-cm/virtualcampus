<?php

use dFramework\core\data\Request;

require_once __DIR__.DS.'__BaseController.php';

/* controlleur de la classe gérant les niveaux. toutes les methodes s'y trouvant sont destinées à l
la gestion des niveaux. */
class NiveauxController extends __BaseController
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

        //vérification des champs necessaires pour la création d'un niveau        
        if(true !== $this->checker->inField('nom_niveau','code_niveau')) {
            $this->_return('Veuillez remplir tous les champs du formulaire prefixés de  * ', false);
        }

        //Vérification de la longeur du code du centre
        if(true !== $this->checker->min_length('code_niveau', 1)) {
            $this->_return('Le code du Niveau doit avoir au moins 1 caracteres', false);
        } 

        try
        {
            //conversion des données reçu par post
            $niveaux['nom_niveau'] = (string)$data['nom_niveau'];
            $niveaux['code_niveau'] = (string)$data['code_niveau'];
            $niveaux['statut_existant'] = 1;

            $can_create_code = false;
            $can_create_nom = false;
            $can_create_id = 0;

            //si le code du niveau existe déja en base de donnée
            if(true === $this->model->exist('code_niveau', $niveaux['code_niveau'], 'Niveaux')) {
                $results = $this->model->read_with_code_niveau($niveaux['code_niveau']);
                if (!empty($results)) {
                    $this->_return('Un niveau possede déja ce code', false);
                } 
                $can_create_id = $results->id_niveau;
                $can_create_code = true;            
            }
            //si le nom du niveau existe déja en base de donnée
            if(true === $this->model->exist('nom_niveau', $niveaux['nom_niveau'], 'Niveaux')) {
                $results = $this->model->read_with_nom_niveau($niveaux['nom_niveau']);
                if (!empty($results)) {
                    $this->_return('Un niveau possede déja ce nom', false);
                }
                $can_create_id = $results->id_niveau;
                $can_create_nom = true;            
            }

            if($can_create_nom)
            {
                $this->model->edit_with_id_niveau($can_create_id, $niveaux);
                $this->_return('unité d\'enseignement créer avec succès!!',true);
            }
            if($can_create_code)
            {
                $this->model->edit_with_id_niveau($can_create_id, $niveaux);
                $this->_return('unité d\'enseignement créer avec succès!!',true);
            }

            //Aucune des informations n'existe deja en base de donnée
            $this->model->create($niveaux);
            $this->_return('niveau crée avec succès!!',true);          
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
            //selection d'un niveau en foction de l'identifiant
            if (!empty($data['id_niveau'])) {
                $results = $this->model->read_with_id_niveau((int)$data['id_niveau']);

                if (empty($results)) {
                    $this->_return('Le  niveau demandé n\'existe pas dans la base de donnée', false);
                }
                $this->_return('Informations sur le niveau  '.$results->nom_niveau.' ', true, $results);
            }

            //selection d'un niveau en foction du code du niveau
            if (!empty($data['code_niveau'])) {
                $results = $this->model->read_with_code_niveau((int)$data['code_niveau']);

                if (empty($results)) {
                    $this->_return('Le niveau demandé n\'existe pas dans la base de donnée', false);
                }
                $this->_return('Informations sur le centre  '.$results->nom_niveau.' ', true, $results);
            }
            
            //selection d'un niveau en foction du code du niveau
            if (!empty($data['nom_niveau'])) {
                $results = $this->model->read_with_nom_niveau((int)$data['nom_niveau']);

                if (empty($results)) {
                    $this->_return('Le niveau demandé n\'existe pas dans la base de donnée', false);
                }
                $this->_return('Informations sur le niveau  '.$results->nom_niveau.' ', true, $results);
            }

            //selection de tous les niveau d'enseignement
            $results = $this->model->read_all();
            if (empty($results)) {
                $this->_return('Vous n\'avez pas encore de niveau en base de données', false);
            }
            $this->_return('liste des niveaux disponibles dans la base de données', true, $results);
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
        if(true !== $this->checker->inField('id_niveau','nom_niveau','code_niveau')) {
            $this->_return('Veuillez remplir tous les champs du formulaire prefixés de  * ', false);
        }
        //vérification de la longeur du code du centre
        if(true !== $this->checker->min_length('code_niveau', 1)) {
            $this->_return('Le code du niveau doit avoir au moins 1 caracteres', false);
        } 

        try
        {
            //conversion des données reçu par post
            $niveaux['nom_niveau'] = (string)$data['nom_niveau'];
            $niveaux['code_niveau'] = (string)$data['code_niveau'];
            $niveaux['id_niveau'] = (int)$data['id_niveau'];

            //si le code du niveau existe déja en base de donnée
            if(true === $this->model->exist('code_niveau', $niveaux['code_niveau'], 'Niveaux')) {
                $results = $this->model->read_with_code_niveau($niveaux['code_niveau']);
                if (!empty($results) && ($results->id_niveau != $niveaux['id_niveau'])) {
                    $this->_return('Un niveau possede déja ce code', false);
                }             
            }
            //si le nom du centre existe déja en base de donnée
            if(true === $this->model->exist('nom_niveau', $niveaux['nom_niveau'], 'Niveaux')) {
                $results = $this->model->read_with_nom_niveau($niveaux['nom_niveau']);
                if (!empty($results) && ($results->id_niveau != $niveaux['id_niveau'])) {
                    $this->_return('Un niveau possede déja ce nom', false);
                }           
            }

            //Aucune des informations n'existe deja en base de donnée
            $this->model->edit_with_id_niveau($niveaux['id_niveau'], $niveaux);
            $this->_return('niveau modifié avec succès!!',true);
        }
        catch(Exception $e)
        {
            $this->_exception($e);
        }
    }

    /* suppression d'un niveau */
    public function delete()
    {
        //recuperation des informations pour la suppression d'un niveau
        $data = $this->request->data;
        $id_niveau = (int)$data['id_niveau'] ?? null;
        if (empty($id_niveau)) {
            $this->_return('Veillez spécifier l\'identifiant du niveau à supprimer', false);
        }

        if (true !== $this->model->exist('id_niveau', (int)$data['id_niveau'], 'Classes')) {
            $this->_return('impossible de supprimer ce niveau car il comporte encore des classes ', false);
        }
        if (true !== $this->model->exist('id_niveau', (int)$data['id_niveau'], 'Semestres')) {
            $this->_return('impossible de supprimer ce niveau car il comorte encore des semestres ', false);
        }

        try {
            $this->model->remove($id_niveau);
            $this->_return('niveau supprimé avec succès', true);
            //code...
        } 
        catch (Exception $e)
        {
            $this->_exception($e);
        }
    }


}