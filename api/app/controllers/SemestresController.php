<?php

use dFramework\core\data\Request;

require_once __DIR__.DS.'__BaseController.php';

/* controlleur de la classe gérant les unités d'enseignement. toutes les methodes s'y trouvant sont destinées à l
la gestion des unites d'enseignement. */
class SemestresController extends __BaseController
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

    /* fonction de création d'un nouveau semestre */
    public function create()
    {
        //recupération des données en post
        $data = $this->request->data;

        //librerie de validation des champs
        $this->loadLibrary('Checker');
        $this->checker->useInputField(true, $data);

        //vérification des champs necessaires pour la création de l'unité d'enseignement        
        if(true !== $this->checker->inField('id_niveau','nom_semestre','abreviation')) {
            $this->_return('Veuillez remplir tous les champs du formulaire prefixés de  * ', false);
        }
        if(true !== $this->checker->min_length('abreviation', 2)) {
            $this->_return('L\'abreviation doit avoir au moins 2 caracteres', false);
        }

        try {

            //conversion des données reçu par post
            $semestres['id_niveau'] = (int)$data['id_niveau'];
            $semestres['nom_semestre'] = (string)$data['nom_semestre'];
            $semestres['abreviation'] = (string)$data['abreviation'];
            $semestres['statut_existant'] = 1;  
    
            if(true !== $this->model->exist('id_niveau', $semestres['id_niveau'], 'Niveaux')) {
                $this->_return('ce semestre n\'existe pas', false);
            }
            
            $can_create_nom =false;
            $can_create_id =false;
            $can_create_abv =false;

           //si le nom du semestre existe déja en base de donnée
           if(true === $this->model->exist('nom_semestre', $semestres['nom_semestre'], 'Semestres')) {
            $results = $this->model->read_with_nom($semestres['nom_semestre']);
            if (!empty($results)) {
                $this->_return('Un semestre possede déja ce nom', false);
            }
             $can_create_nom =true;
        }

           //si l'abreviation du semestre existe déja en base de donnée
           if(true === $this->model->exist('abreviation', $semestres['abreviation'], 'Semestres')) {
            $results = $this->model->read_with_abv($semestres['abreviation']);
            if (!empty($results)) {
                $this->_return('Un semestre possede déja cette abreviation', false);
            }
            $can_create_abv = true;
            $can_create_id = $results->id_niveau == $semestres['id_niveau'];
        } 

            //si le nom existe deja on on active a partir du nom
            if ($can_create_nom && $can_create_abv && $can_create_id) {
                $this->model->edit_with_nom($semestres['nom_semestre'], $semestres);
                $this->_return('Semestre crée avec succès!!',true);
            }

            //Aucune des informations n'existe deja en base de donnée
            $this->model->create($semestres);
            $this->_return('semestre crée avec succès!!',true);
 
            //code...
        } catch (Exception $e) {
            $this->_exception($e);
        }
    }

    /* retourne toute les information du semestre */
    public function readAllInfo()
    {
        //recuperation des donnees en post
        $data = $this->request->data;

        try {

             //selection d'un semestre à partir de son identifiant
            if (!empty($data['id_semestre'])) {
                $results = $this->model->read_all_info_with_id((int)$data['id_semestre']);

                if (empty($results)) {
                    $this->_return('Le semestre demandé n\'existe pas dans la base de donnée', false);
                }
                $this->_return('Informations sur le semestre '.$results->nom_semestre.' ', true, $results);
            }

            //selection de tous les semestres
            $results = $this->model->read_all_info();
            if (empty($results)) {
                $this->_return('Vous n\'avez pas encore de semestre en base de données', false);
            }
            $this->_return('liste des semestres disponible dans la base de données', true, $results);
            
        } catch (Exception $e) {
            $this->_exception($e);
        }
    }

    /* fonction de selection des informations concernant un ou plusieurs semestre
    la selection peut se faire en fonction du nom ou de l'abreviation */
    public function read()
    {
        //recupération des données en post
        $data = $this->request->data;
        
        try {

            //selection d'un semestre à partir de son identifiant
            if (!empty($data['id_semestre'])) {
                $results = $this->model->read_with_id((int)$data['id_semestre']);

                if (empty($results)) {
                    $this->_return('Le semestre demandé n\'existe pas dans la base de donnée', false);
                }
                $this->_return('Informations sur le semestre '.$results->nom_semestre.' ', true, $results);
            }

            //selection d'un semestre à partir de son identifiant
            if (!empty($data['id_niveau'])) {
                $results = $this->model->read_with_id_niveau((int)$data['id_niveau']);

                if (empty($results)) {
                    $this->_return('pas de semestre enregistré pour ce niveau dans la base de donnée', false);
                }
                $this->_return('liste des semestres du niveau ', true, $results);
            }

             //selection d'un semestre à partir du nom
            if (!empty($data['nom_semestre'])) {
                $results = $this->model->read_with_nom($data['nom_semestre']);

                if (empty($results)) {
                    $this->_return('Le semestre demandé n\'existe pas dans la base de donnée', false);
                }
                $this->_return('Informations sur la semestre '.$results->nom_semestre.' ', true, $results);
            }

            //selection d'un semestre à partir de son abreviation
            if (!empty($data['abreviation'])) {
                $results = $this->model->read_with_abv((string)$data['abreviation']);

                if (empty($results)) {
                    $this->_return('Le semestre demandé n\'existe pas dans la base de donnée', false);
                }
                $this->_return('Informations sur le semestre '.$results->nom_semestre.' ', true, $results);
            }

            //selection de tous les semestres
            $results = $this->model->read_all();
            if (empty($results)) {
                $this->_return('Vous n\'avez pas encore de semestre en base de données', false);
            }
            $this->_return('liste des semestres disponible dans la base de données', true, $results);
            //code...
        } catch (Exception $e) {
            $this->_exception($e);
        }
    }

    /* mise à jour des information d'un semestre */
    public function put()
    {
        //recupération des données en post
        $data = $this->request->data;

        //librerie de validation des champs
        $this->loadLibrary('checker');
        $this->checker->useInputField(true, $data);

        //vérification des champs necessaires pour la mise à jours        
        if(true !== $this->checker->inField('id_semestre','nom_semestre','abreviation')) {
            $this->_return('Veuillez remplir tous les champs du formulaire prefixés de  * ', false);
        }
        if(true !== $this->checker->min_length('abreviation', 2)) {
            $this->_return('L\'abreviationn du semestre doit avoir au moins 3 caracteres', false);
        }
        try
        {
           //conversion des données reçu par post
           $semestres['id_niveau'] = (int)$data['id_niveau'];
           $semestres['id_semestre'] = (int)$data['id_semestre'];
           $semestres['nom_semestre'] = (string)$data['nom_semestre'];
           $semestres['abreviation'] = (string)$data['abreviation'];
           $semestres['statut_existant'] = 1;

           if(true !== $this->model->exist('id_semestre', $semestres['id_semestre'], 'Semestres')) {
            $this->_return('ce niveau n\'existe pas', false);
        }

        if(true !== $this->model->exist('id_niveau', $semestres['id_niveau'], 'Niveaux')) {
            $this->_return('ce semestre n\'existe pas', false);
        }

           //si le nom du semestre existe déja en base de donnée
           if(true === $this->model->exist('nom_semestre', $semestres['nom_semestre'], 'Semestres')) {
            $results = $this->model->read_with_nom($semestres['nom_semestre']);
            if (!empty($results) && ($results->id_semestre != $semestres['id_semestre'])) {
                $this->_return('Un semestre possede déja ce nom', false);
            }
        } 

           //si l'abreviation du semestre existe déja en base de donnée
           if(true === $this->model->exist('abreviation', $semestres['abreviation'], 'Semestres')) {
            $results = $this->model->read_with_abv($semestres['abreviation']);
            if (!empty($results) && ($results->id_semestre != $semestres['id_semestre'])) {
                $this->_return('Un semestre possede déja cette abreviation', false);
            }
        }    

           $this->model->edit_with_id( $semestres['id_semestre'], $semestres);
           $this->_return('le semestre a étè modifié avec succès', true);

        } 
        catch (Exception $e) {
            $this->_exception($e);
        }
    }

    /* suppression d'un semestre 
    le parametre necessaire est l'identifiant du semestre */
    public function delete()
    {
        //recuperation des informations pour la suppression du semestre
        $data = $this->request->data;
        $id_semestre = (int)$data['id_semestre'] ?? null;
        
        if (empty($id_semestre)) {
            $this->_return('Veillez spécifier l\'identifiant du semestre à supprimer', false);
        }

        try {
            $this->model->remove($id_semestre);
            $this->_return('Le semestre a étè supprimer avec succès', true);
            //code...
        } catch (Exception $e) {
            $this->_exception($e);
        }
    }
}