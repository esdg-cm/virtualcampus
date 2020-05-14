<?php

use dFramework\core\data\Request;

require_once __DIR__.DS.'__BaseController.php';

/* controlleur de la classe gérant les unités d'enseignement. toutes les methodes s'y trouvant sont destinées à l
la gestion des unites d'enseignement. */
class UeController extends __BaseController
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

    /* création d'une nouvelle unité d'enseignement*/
    public function create()
    {
        //recupération des données en post
        $data = $this->request->data;

        //librerie de validation des champs
        $this->loadLibrary('checker');
        $this->checker->useInputField(true, $data);

        //vérification des champs necessaires pour la création de l'unité d'enseignement        
        if(true !== $this->checker->inField('id_semestre','code_ue','nom_ue', 'credit')) {
            $this->_return('Veuillez remplir tous les champs du formulaire prefixés de  * ', false);
        }
        if(true !== $this->checker->min_length('code_ue', 3)) {
            $this->_return('Le code de l\unité d\'enseignement doit avoir au moins 3 caracteres', false);
        }

        try
        {   
            if (true !== $this->model->exist('id_semestre', (int)$data['id_semestre'], 'Semestres')) {
                $this->_return('le semestre spécifié n\existe pas. ', false);
            } 
            //conversion des données reçu par post
            $unite['nom_ue'] = (string)$data['nom_ue'];
            $unite['code_ue'] = (string)$data['code_ue'];
            $unite['credit'] = (int)$data['credit'];
            $unite['id_semestre'] = (int)$data['id_semestre'];
            $unite['statut_existant'] = 1;

            $can_create_code = false;
            $can_create_nom = false;
            $can_create_id = 0;

            //si le code de l'unité d'enseignement existe déja en base de donnée
            if(true === $this->model->exist('code_ue', $unite['code_ue'], 'Ue')) {
                $results = $this->model->read_with_code_ue($unite['code_ue']);
                if (!empty($results)) {
                    $this->_return('ce code existe déja', false);
                }
                $can_create_id = $results->id_ue;
                $can_create_code = true;                    
            }

            //si le nom de l'unité d'enseignement existe déja en base de donnée
            if(true === $this->model->exist('nom_ue', $unite['nom_ue'], 'Ue')) {
                $results = $this->model->read_with_nom_ue($unite['nom_ue']);
                if (!empty($results)) {
                    $this->_return('ce nom existe déja', false);
                }
                $can_create_nom = true; 
                $can_create_id = $results->id_ue;               
            }
            
            if ($can_create_code) {
                $this->model->edit_with_id_ue($can_create_id, $unite);
                $this->_return('unité d\'enseignement créée avec succès!!',true);
            }

            if ($can_create_nom) {
                $this->model->edit_with_id_ue($can_create_id, $unite);
                $this->_return('unité d\'enseignement créée avec succès!!',true);
            }

            //Aucune des informations n'existe deja en base de donnée
            $this->model->create($unite);
            $this->_return('unité d\'enseignement créée avec succès!!',true);
        }
        catch(Exception $e)
        {
            $this->_exception($e);
        }
    }

    /* selection d'un ou de plusieurs unité d'enseignement dans la base de données
    la selection peut se faire soit à partir de l'identifiant soit a partire de nom ou alors à partir du code */
    public function read()
    {
        //recuperation des données en post
        $data = $this->request->data;

        try
        {
            //selection d'une unité d'enseignement en foction de l'identifiant
            if (!empty($data['id_ue'])) {
                $results = $this->model->read_with_id_ue((int)$data['id_ue']);

                if (empty($results)) {
                    $this->_return('L\'unité d\'enseignement demandée n\'existe pas dans la base de donnée', false);
                }
                $this->_return('Informations sur l\'unité d\'enseignement '.$results->nom_ue.' ', true, $results);
            }

            //selection d'une unité d'enseignement en foction du nom
            if (!empty($data['nom_ue'])) {
                $results = $this->model->read_with_nom_ue((string)$data['nom_ue']);

                if (empty($results)) {
                    $this->_return('L\'unité d\'enseignement demandé n\'existe pas dans la base de donnée', false);
                }
                $this->_return('Informations sur l\'unité d\'enseignement '.$results->nom_ue.' ', true, $results);
            }

            //selection d'une unité d'enseignement en foction du code
            if (!empty($data['code_ue'])) {
                $results = $this->model->read_with_code_ue((string)$data['code_ue']);

                if (empty($results)) {
                    $this->_return('L\'unité d\'enseignement demandée n\'existe pas dans la base de donnée', false);
                }
                $this->_return('Informations sur l\'unité d\'enseignement '.$results->nom_ue.' ', true, $results);
            }

            //selection d'une unité d'enseignement en foction du semestre
            if (!empty($data['id_semestre'])) { 
                $results = $this->model->read_with_id_semestre( (string)$data['id_semestre']);

                if (empty($results)) {
                    $this->_return('nous n\'avons pas d\'unité d\'enseignement pour ce semestre dans la base de donnée', false);
                }
                $this->_return('Informations sur les unités d\'enseignements du semestre ', true, $results);
            }

            //selection de tous les unités d'enseignement
            $results = $this->model->read_all();
            if (empty($results)) {
                $this->_return('Vous n\'avez pas encore d\'unité d\'enseignement en base de données', false);
            }
            $this->_return('liste des unités d\'enseignements disponibles dans la base de données', true, $results);
        }
        catch(Exception $e)
        {
            $this->_exception($e);
        }
    }

    /* retourne la liste des unités d'enseignement d'un niveau en fonction de la filiere */
    public function readUeFiliereNiveau()
    {
        //recuperation des données en post
        $data = $this->request->data;

        //librerie de validation des champs
        $this->loadLibrary('checker');
        $this->checker->useInputField(true, $data);

        //vérification des champs necessaires pour la création de l'unité d'enseignement        
        if(true !== $this->checker->inField('id_filiere','id_niveau')) {
            $this->_return('Veuillez spécifier tous les champs necessaires pour avoir les informations: filière et niveau ', false);
        }

        try
        {
            if (true !== $this->model->exist('id_niveau', (int)$data['id_niveau'], 'Niveaux')) {
                $this->_return('le semestre spécifié n\existe pas. ', false);
            }  

            if (true !== $this->model->exist('id_filiere', (int)$data['id_filiere'], 'Filieres')) {
                $this->_return('la filière spécifiée n\existe pas. ', false);
            }
            
            //selection de tous les unités d'enseignement
            $results = $this->model->read_ue_filiere_niveau((int)$data['id_filiere'], (int)$data['id_niveau']);
            if (empty($results)) {
                $this->_return('Vous n\'avez pas encore d\'unité d\'enseignement pour cette filière et ce niveau en base de données', false);
            }
            $this->_return('liste des unités d\'enseignements disponibles dans la base de données', true, $results);

        }
        catch(Exception $e)
        {
            $this->_exception($e);
        }
    }

    /* retourne toutes les information avec precision sur une UE ou sur toutes les UE */
    public function readAllInfo()
    {
        //recupération des données en post
        $data = $this->request->data;
        try
        {
            //selection d'une UE en foction de l'identifiant
            if (!empty($data['id_ue'])) {
                $results = $this->model->read_all_info_id((int)$data['id_ue']);

                if (empty($results)) {
                    $this->_return('l\'UE demandée n\'existe pas dans la base de donnée', false);
                }
                $this->_return('Informations sur l\'UE  '.$results->nom_ue.' ', true, $results);
            }
            //selection de toutes les UE d'enseignement
            $results = $this->model->read_all_info_ue();
            if (empty($results)) {
                $this->_return('Vous n\'avez pas encore d\'EU en base de données', false);
            }
            $this->_return('liste des UE disponibles dans la base de données', true, $results);
        }
        catch(Exception $e)
        {
            $this->_exception($e);
        }
    }

    /* Mise à jour des informationd'une unité d'enseignement. */
    public function put()
    {
        //recupération des données en post
        $data = $this->request->data;

        //librerie de validation des champs
        $this->loadLibrary('checker');
        $this->checker->useInputField(true, $data);

        //vérification des champs necessaires pour la création de l'unité d'enseignement        
        if(true !== $this->checker->inField('id_semestre','id_ue','code_ue','nom_ue', 'credit')) {
            $this->_return('Veuillez remplir tous les champs du formulaire prefixés de  * ', false);
        }
        if(true !== $this->checker->min_length('code_ue', 3)) {
            $this->_return('Le code de l\unité d\'enseignement doit avoir au moins 3 caracteres', false);
        }
        try
        {
            if (true !== $this->model->exist('id_ue', (int)$data['id_ue'], 'Ue')) {
                $this->_return('l\'unité d\'enseignement spécifiée n\existe pas. ', false);
            } 
            if (true !== $this->model->exist('id_semestre', (int)$data['id_semestre'], 'Semestres')) {
                $this->_return('le semestre spécifié n\existe pas. ', false);
            }  

            //conversion des données reçu par post
            $unite['nom_ue'] = (string)$data['nom_ue'];
            $unite['code_ue'] = (string)$data['code_ue'];
            $unite['credit'] = (int)$data['credit'];
            $unite['id_ue'] = (int)$data['id_ue'];
            $unite['id_semestre'] = (int)$data['id_semestre'];
            $unite['statut_existant'] = 1;

            //si le code de l'unité d'enseignement existe déja en base de donnée
            if(true === $this->model->exist('code_ue', $unite['code_ue'], 'Ue')) {
                $results = $this->model->read_with_code_ue($unite['code_ue']);
                if (!empty($results) && $results->id_ue != $unite['id_ue']) {
                    $this->_return('ce code existe déja', false);
                }                    
            }

            //si le nom de l'unité d'enseignement existe déja en base de donnée
            if(true === $this->model->exist('nom_ue', $unite['nom_ue'], 'Ue')) {
                $results = $this->model->read_with_nom_ue($unite['nom_ue']);
                if (!empty($results) && $results->id_ue != $unite['id_ue']) {
                    $this->_return('ce nom existe déja', false);
                }                   
            }

            //Aucune des informations n'existe deja en base de donnée
            $this->model->edit_with_id_ue($unite['id_ue'], $unite);
            $this->_return('unité d\'enseignement modifiée avec succès!!',true);
        }
        catch (Exception $e)
        {
            $this->_exception($e);
        }
    }

    /* suppressiond'une unité d'enseignement */
    public function delete()
    {
        //recuperation des informations pour la suppression d'une unité d'enseignement
        $data = $this->request->data;
        $id_ue = (int)$data['id_ue'] ?? null;
        if (empty($id_ue)) {
            $this->_return('Veillez spécifier l\'identifiant du l\'unité d\'enseignement à supprimer', false);
        }

        if (true !== $this->model->exist('id_ue', (int)$data['id_ue'], 'Ue_Filieres')) {
            $this->_return('impossible de supprimer cette unité d\'enseignement car elle est encore associée à une filiére ', false);
        } 
        if (true !== $this->model->exist('id_ue', (int)$data['id_ue'], 'Matieres')) {
            $this->_return('impossible de supprimer cette unité d\'enseignement car elle est encore associée à une Matiere ', false);
        } 

        try {
            $this->model->remove($id_ue);
            $this->_return('Unité d\'enseignement supprimée avec succès', true);
            //code...
        } 
        catch (Exception $e)
        {
            $this->_exception($e);
        }
    }
}