<?php

use dFramework\core\data\Request;

require_once __DIR__.DS.'__BaseController.php';

/* controlleur de la classe gérant les filieres. toutes les methodes s'y trouvant sont destinées à l
la gestion des filieres. */
class FilieresController extends __BaseController
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
        if(true !== $this->checker->inField('nom_filiere','code_filiere')) {
            $this->_return('Veuillez remplir tous les champs du formulaire prefixés de  * ', false);
        }

        //Vérification de la longeur du code de la filiere
        if(true !== $this->checker->min_length('code_filiere', 2)) {
            $this->_return('Le code de la filière doit avoir au moins 2 caracteres', false);
        } 

        try
        {
            //conversion des données reçu par post
            $filieres['nom_filiere'] = (string)$data['nom_filiere'];
            $filieres['code_filiere'] = (string)$data['code_filiere'];
            $filieres['statut_existant'] = 1;

            $can_create_code = false;
            $can_create_nom = false;
            $can_create_id = 0;

            //si le code de la filiere existe déja en base de donnée
            if(true === $this->model->exist('code_filiere', $filieres['code_filiere'], 'Filieres')) {
                $results = $this->model->read_with_code_filiere($filieres['code_filiere']);
                if (!empty($results)) {
                    $this->_return('Une filière possede déja ce code', false);
                }               
                $can_create_code = true;       
            }
            //si le nom dela filiere existe déja en base de donnée
            if(true === $this->model->exist('nom_filiere', $filieres['nom_filiere'], 'Filieres')) {
                $results = $this->model->read_with_nom_filiere($filieres['nom_filiere']);
                if (!empty($results)) {
                    $this->_return('Une filière possede déja ce nom', false);
                }
                $can_create_id = $results->id_filiere;
                $can_create_nom = true;            
            }

            if($can_create_nom && $can_create_code)
            {
                $this->model->edit_with_id_filiere($can_create_id, $filieres);
                $this->_return('Filière créer avec succès!!',true);
            }

            //Aucune des informations n'existe deja en base de donnée
            $this->model->create($filieres);
            $this->_return('Filière créee avec succès!!',true);          
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
            //selection d'une filiere en foction de l'identifiant
            if (!empty($data['id_filiere'])) {
                $results = $this->model->read_with_id_filiere((int)$data['id_filiere']);

                if (empty($results)) {
                    $this->_return('La filière demandé n\'existe pas dans la base de donnée', false);
                }
                $this->_return('Informations sur la filiere  '.$results->nom_filiere.' ', true, $results);
            }

            //selection d'une filiere en foction du code de la filiere
            if (!empty($data['code_filiere'])) {
                $results = $this->model->read_with_code_filiere((string)$data['code_filiere']);

                if (empty($results)) {
                    $this->_return('La filière demandé n\'existe pas dans la base de donnée', false);
                }
                $this->_return('Informations sur la filiére  '.$results->nom_filiere.' ', true, $results);
            }
            
            //selection d'une filiere en foction du nom de la filiere
            if (!empty($data['nom_filiere'])) {
                $results = $this->model->read_with_nom_filiere((int)$data['nom_filiere']);

                if (empty($results)) {
                    $this->_return('La filière demandé n\'existe pas dans la base de donnée', false);
                }
                $this->_return('Informations sur la filiere  '.$results->nom_filiere.' ', true, $results);
            }

            //selection de toutes les filieres d'enseignement
            $results = $this->model->read_all();
            if (empty($results)) {
                $this->_return('Vous n\'avez pas encore de filiére en base de données', false);
            }
            $this->_return('liste des filières disponibles dans la base de données', true, $results);
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
        if(true !== $this->checker->inField('id_filiere','nom_filiere','code_filiere')) {
            $this->_return('Veuillez remplir tous les champs du formulaire prefixés de  * ', false);
        }
        //vérification de la longeur du code du centre
        if(true !== $this->checker->min_length('code_filiere', 2)) {
            $this->_return('Le code de la filière doit avoir au moins 2 caracteres', false);
        }  

        try
        {
            //conversion des données reçu par post
            $filieres['id_filiere'] = (int)$data['id_filiere'];
            $filieres['nom_filiere'] = (string)$data['nom_filiere'];
            $filieres['code_filiere'] = (string)$data['code_filiere'];

            //si le code de la filiere existe déja en base de donnée
            if(true === $this->model->exist('code_filiere', $filieres['code_filiere'], 'Filieres')) {
                $results = $this->model->read_with_code_filiere($filieres['code_filiere']);
                if (!empty($results) && ($results->id_filiere != $filieres['id_filiere'])) {
                    $this->_return('Une filière possede déja ce code', false);
                }             
            }
            //si le nom de la filiere existe déja en base de donnée
            if(true === $this->model->exist('nom_filiere', $filieres['nom_filiere'], 'Filieres')) {
                $results = $this->model->read_with_nom_filiere($filieres['nom_filiere']);
                if (!empty($results) && ($results->id_filiere != $filieres['id_filiere'])) {
                    $this->_return('Une filière possede déja ce nom', false);
                }           
            }

            //Aucune des informations n'existe deja en base de donnée
            $this->model->edit_with_id_filiere($filieres['id_filiere'], $filieres);
            $this->_return('filière modifiée avec succès!!',true);
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
        $id_filiere = (int)$data['id_filiere'] ?? null;
        if (empty($id_filiere)) {
            $this->_return('Veillez spécifier l\'identifiant de la filière à supprimer', false);
        }

        try {
            $this->model->remove($id_filiere);
            $this->_return('filière supprimée avec succès', true);
            //code...
        } 
        catch (Exception $e)
        {
            $this->_exception($e);
        }
    }


}