<?php

use dFramework\core\data\Request;

require_once __DIR__.DS.'__BaseController.php';

/* controlleur de la classe gérant les unités d'enseignement. toutes les methodes s'y trouvant sont destinées à l
la gestion des unites d'enseignement. */
class MatieresController extends __BaseController
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

    /* fonction de creation d'une matiere  */
    public function create()
    {
        //recupération des données en post
        $data = $this->request->data;

        //librerie de validation des champs
        $this->loadLibrary('checker');
        $this->checker->useInputField(true, $data);

        //vérification des champs necessaires pour la création de l'unité d'enseignement        
        if(true !== $this->checker->inField('nom_matiere','id_ue','ref_matiere','coef', 'nbr_hr_tp', 'nbr_hr_td', 'nbr_hr_cm')) {
            $this->_return('Veuillez remplir tous les champs du formulaire prefixés de  * ', false);
        }
        if(true !== $this->checker->min_length('ref_matiere', 3)) {
            $this->_return('La réference de la matière doit avoir au moins 3 caracteres', false);
        }

        try {
           //conversion des données reçu par post
           $matieres['id_ue'] = (int)$data['id_ue'];
           $matieres['nom_matiere'] = (string)$data['nom_matiere'];
           $matieres['ref_matiere'] = (string)$data['ref_matiere'];
           $matieres['coef'] = (int)$data['coef'];
           $matieres['nbr_hr_tp'] = (int)$data['nbr_hr_tp'];
           $matieres['nbr_hr_td'] = (int)$data['nbr_hr_td'];
           $matieres['nbr_hr_cm'] = (int)$data['nbr_hr_cm'];
           $matieres['statut_existant'] = 1; 

           $can_create_nom =false;
           $can_create_ref =false;           
           
        //si le nom de la matiere existe déja en base de donnée
           if(true === $this->model->exist('ref_matiere', $matieres['ref_matiere'], 'Matieres')) {
            $results = $this->model->read_with_ref($matieres['ref_matiere']);
            if (!empty($results)) {
                $this->_return('cette reférence existe déja', false);
            }  
           $can_create_ref =true;
        }

           //si la réference de la matière existe déja en base de donnée
           if(true === $this->model->exist('nom_matiere', $matieres['nom_matiere'], 'Matieres')) {
            $results = $this->model->read_with_nom($matieres['nom_matiere']);
            if (!empty($results)) {
                $this->_return('ce nom existe déja', false);
            }  
           $can_create_nom =true;
        }

            //si le nom existe deja on on active a partir du nom
            if ($can_create_nom) {
                $this->model->edit_with_nom($matieres['nom_matiere'], $matieres);
                $this->_return('matière créee avec succès!!',true);
            }

            //si le nom existe deja on on active a partir du nom
            if ($can_create_ref) {
                $this->model->edit_with_ref($matieres['ref_matiere'], $matieres);
                $this->_return('matière créee avec succès!!',true);
            }

            //Aucune des informations n'existe deja en base de donnée
            $this->model->create($matieres);
            $this->_return('matière créee avec succès!!',true);
           
            //code...
        } catch (Exception $e) {
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
            if (!empty($data['id_matiere'])) {
                $results = $this->model->read_all_info_id((int)$data['id_matiere']);

                if (empty($results)) {
                    $this->_return('la matière demandée n\'existe pas dans la base de donnée', false);
                }
                $this->_return('Informations sur la matière  '.$results->nom_matiere.' ', true, $results);
            }

            //selection d'une matiere en foction de l'identifiant de l'ue
            if (!empty($data['id_ue'])) {
                $results = $this->model->read_all_info_id_ue((int)$data['id_ue']);

                if (empty($results)) {
                    $this->_return('pas de matière pour cette ue dans la base de donnée', false);
                }
                $this->_return('liste des matières de l\'ue ', true, $results);
            }

            //selection de toutes les UE d'enseignement
            $results = $this->model->read_all_info_matiere();
            if (empty($results)) {
                $this->_return('Vous n\'avez pas encore de matière en base de données', false);
            }
            $this->_return('liste des matières disponibles dans la base de données', true, $results);
        }
        catch(Exception $e)
        {
            $this->_exception($e);
        }
    }

    /* fonction de selection des informations concernant une ou plusieurs matieres
    la selection peut se faire en fonction du nom, de la matiere, de la reference ou de l'identifiant de la matiere */
    public function read()
    {
        //recupération des données en post
        $data = $this->request->data;
        
        try {

            //selection d'une matiere à partir de son identifiant
            if (!empty($data['id_matiere'])) {
                $results = $this->model->read_with_id((int)$data['id_matiere']);

                if (empty($results)) {
                    $this->_return('La matière demandé n\'existe pas dans la base de donnée', false);
                }
                $this->_return('Informations sur la matière '.$results->nom_matiere.' ', true, $results);
            }

             //selection d'une matiere à partir du nom
            if (!empty($data['nom_matiere'])) {
                $results = $this->model->read_with_nom((string)$data['nom_matiere']);

                if (empty($results)) {
                    $this->_return('La matiere demandé n\'existe pas dans la base de donnée', false);
                }
                $this->_return('Informations sur la matiere '.$results->nom_matiere.' ', true, $results);
            }

            //selection d'une matiere à partir de sa réference
            if (!empty($data['ref_matiere'])) {
                $results = $this->model->read_with_ref((string)$data['ref_matiere']);

                if (empty($results)) {
                    $this->_return('La matiere demandé n\'existe pas dans la base de donnée', false);
                }
                $this->_return('Informations sur la matiere '.$results->nom_matiere.' ', true, $results);
            }

            //selection des matieres d'une unité d'enseignement
            if (!empty($data['id_ue'])) {
                $results = $this->model->read_matiere_ue_id((string)$data['id_ue']);

                if (empty($results)) {
                    $this->_return('pas de matière pour cette unité d\'enseignement', false);
                }
                $this->_return('liste des matières de l\'unité d\'enseignement ', true, $results);
            }

            //selection de toutes les matieres
            $results = $this->model->read_all();
            if (empty($results)) {
                $this->_return('Vous n\'avez pas encore de matière en base de données', false);
            }
            $this->_return('liste des matières disponible dans la base de données', true, $results);
            //code...
        } catch (Exception $e) {
            $this->_exception($e);
        }
    }

    /* mise à jour des information d'une matière */
    public function put()
    {
        //recupération des données en post
        $data = $this->request->data;
        //librerie de validation des champs
        $this->loadLibrary('checker');
        $this->checker->useInputField(true, $data);

        //vérification des champs necessaires pour la création de la matiere        
        if(true !== $this->checker->inField('id_matiere','id_ue','nom_matiere','ref_matiere', 'coef','nbr_hr_tp','nbr_hr_td','nbr_hr_cm')) {
            $this->_return('Veuillez remplir tous les champs du formulaire prefixés de  * ', false);
        }
        if(true !== $this->checker->min_length('ref_matiere', 3)) {
            $this->_return('La reference de la matiere doit avoir au moins 3 caracteres', false);
        }
        try
        {
           //conversion des données reçu par post
           $matieres['id_matiere'] = (int)$data['id_matiere'];
           $matieres['id_ue'] = (int)$data['id_ue'];
           $matieres['nom_matiere'] = (string)$data['nom_matiere'];
           $matieres['ref_matiere'] = (string)$data['ref_matiere'];
           $matieres['coef'] = (int)$data['coef'];
           $matieres['nbr_hr_tp'] = (int)$data['nbr_hr_tp'];
           $matieres['nbr_hr_td'] = (int)$data['nbr_hr_td'];
           $matieres['nbr_hr_cm'] = (int)$data['nbr_hr_cm'];
           $matieres['statut_existant'] = 1;

        //si le nom de la matiere existe déja en base de donnée
        if(true === $this->model->exist('ref_matiere', $matieres['ref_matiere'], 'Matieres')) {
            $results = $this->model->read_with_ref($matieres['ref_matiere']);
            if (!empty($results) && $results->id_matiere != $matieres['id_matiere']) {
                $this->_return('cette réference existe déja', false);
            }  
        }

           //si la réference de la matière existe déja en base de donnée
           if(true === $this->model->exist('nom_matiere', $matieres['nom_matiere'], 'Matieres')) {
            $results = $this->model->read_with_nom($matieres['nom_matiere']);
            if (!empty($results) && $results->id_matiere != $matieres['id_matiere']) {
                $this->_return('ce nom existe déja', false);
            }  
        }

           $this->model->edit_with_id($matieres['id_matiere'], $matieres);
           $this->_return('la matiere a étè modifier avec succès', true);

        } 
        catch (Exception $e) {
            $this->_exception($e);
        }
    }

    /* suppression d'une matiere 
    le parametre necessaire est l'identifiant de la matière */
    public function delete()
    {
        //recuperation des informations pour la suppression d'une matière
        $data = $this->request->data;
        $id_matiere = (int)$data['id_matiere'] ?? null;
        
        if (empty($id_matiere)) {
            $this->_return('Veillez spécifier l\'identifiant de la matière à supprimer', false);
        }

        if (true === $this->model->exist('id_matiere', (int)$data['id_matiere'], 'Affectations')) {
            $this->_return('impossible de supprimer cette matiere car il comporte encore des affectation ', false);
        }
        if (true === $this->model->exist('id_matiere', (int)$data['id_matiere'], 'Parties_cours')) {
            $this->_return('impossible de supprimer cette matiere car il comorte encore des cours ', false);
        }
        if (true === $this->model->exist('id_matiere', (int)$data['id_matiere'], 'Glossaires')) {
            $this->_return('impossible de supprimer cette matiere car il comporte encore des glossaires ', false);
        }
        if (true === $this->model->exist('id_matiere', (int)$data['id_matiere'], 'Planing')) {
            $this->_return('impossible de supprimer cette matiere car il comorte encore des planing ', false);
        }
        if (true === $this->model->exist('id_matiere', (int)$data['id_matiere'], 'Discussions')) {
            $this->_return('impossible de supprimer cette matiere car il comorte encore des discussions ', false);
        }
        if (true === $this->model->exist('id_matiere', (int)$data['id_matiere'], 'Examens')) {
            $this->_return('impossible de supprimer cette matiere car il comorte encore des examens ', false);
        }
        if (true === $this->model->exist('id_matiere', (int)$data['id_matiere'], 'Ressources')) {
            $this->_return('impossible de supprimer cette matiere car il comorte encore des ressources ', false);
        }

        try {
            $this->model->remove($id_matiere);
            $this->_return('La matière a étè supprimer avec succès', true);
            //code...
        } catch (Exception $e) {
            $this->_exception($e);
        }
    }
}