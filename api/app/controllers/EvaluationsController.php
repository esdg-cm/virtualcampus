<?php

use dFramework\core\data\Request;

require_once __DIR__.DS.'__BaseController.php';

/* controlleur de la classe gérant les classes. toutes les methodes s'y trouvant sont destinées à l
la gestion des salles de classes. */
class EvaluationsController extends __BaseController
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

        //vérification des champs necessaires pour la création d'une classe        
        if(true !== $this->checker->inField('id_utilisateur','id_examen','note')) {
            $this->_return('Veuillez remplir tous les champs du formulaire prefixés de  * ', false);
        }

        //verification de l'idenntifiant de la filiere
        if(true === $this->model->exist('id_utilisateur', (int)$data['id_utilisateur'], 'Etudiants')) {
            $this->_return('cet etudiant n\'existe pas', false);
        }
        
        //verification de l'idenntifiant du centre
        if(true === $this->model->exist('id_examen', (int)$data['id_examen'], 'Examens')) {
            $this->_return('cet Examen n\'existe pas', false);
        }

        try
        {
            //conversion des données reçu par post
            $evaluation['id_examen'] = (int)$data['id_examen'];
            $evaluation['id_utilisateur'] = (int)$data['id_utilisateur'];
            $evaluation['note'] = (float)$data['note'];

            //Aucune des informations n'existe deja en base de donnée
            $this->model->create($evaluation);
            $this->_return('evaluation Ajoutée avec succès!!',true);          
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
            if (!empty($data['id_evaluation'])) {
                $results = $this->model->read_with_id_evaluation((int)$data['id_evaluation']);

                if (empty($results)) {
                    $this->_return('cet exament n\'existe pas', false);
                }
                $this->_return('Informations sur l\'exament ', true, $results);
            }

            //selection d'une classe en foction du code de la classe
            if (!empty($data['id_examen'])) {
                $results = $this->model->read_with_id_examen((int)$data['id_examen']);

                if (empty($results)) {
                    $this->_return('aucun etudiant n\'a passé cet examen', false);
                }
                $this->_return('liste des evaluations concernant cet examen ', true, $results);
            }
            
            //selection d'une classe en foction du nom de la classe
            if (!empty($data['id_utilisateur'])) {
                $results = $this->model->read_with_id_utilisateur((int)$data['id_utilisateur']);

                if (empty($results)) {
                    $this->_return('cet etudiant n\'a pas encore passer de test', false);
                }
                $this->_return('liste des test passés par l\'etudiant ', true, $results);
            }

            //selection de toutes les classes d'enseignement
            $results = $this->model->read_all();
            if (empty($results)) {
                $this->_return('Vous n\'avez pas encore d\'evaluation en base de données', false);
            }
            $this->_return('liste des Evaluations disponibles dans la base de données', true, $results);
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

        //vérification des champs necessaires pour la création d'une classe        
        if(true !== $this->checker->inField('id_utilisateur','id_examen','note')) {
            $this->_return('Veuillez remplir tous les champs du formulaire prefixés de  * ', false);
        }

        //verification de l'idenntifiant de la filiere
        if(true === $this->model->exist('id_utilisateur', (int)$data['id_utilisateur'], 'Etudiants')) {
            $this->_return('cet etudiant n\'existe pas', false);
        }
        //verification de l'idenntifiant du centre
        if(true === $this->model->exist('id_examen', (int)$data['id_examen'], 'Examens')) {
            $this->_return('cet Examen n\'existe pas', false);
        }
        //verification de l'idenntifiant du centre
        if(true === $this->model->exist('id_evaluation', (int)$data['id_evaluation'], 'Evaluations')) {
            $this->_return('cette evaluation n\'existe pas', false);
        }

        try
        {
            //conversion des données reçu par post
            $evaluation['id_evaluation'] = (int)$data['id_evaluation'];
            $evaluation['id_examen'] = (int)$data['id_examen'];
            $evaluation['id_utilisateur'] = (int)$data['id_utilisateur'];
            $evaluation['note'] = (float)$data['note'];

            //Aucune des informations n'existe deja en base de donnée
            $this->model->edit_with_id($evaluation['id_evaluation'], $evaluation);
            $this->_return('evaluation editée avec succès!!',true);          
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
        $id_evaluation = (int)$data['id_evaluation'] ?? null;
        if (empty($id_evaluation)) {
            $this->_return('Veillez spécifier l\'identifiant de l\'evaluation à supprimer', false);
        }

        try {
            $this->model->remove($id_evaluation);
            $this->_return('Evaluation supprimée avec succès', true);
            //code...
        } 
        catch (Exception $e)
        {
            $this->_exception($e);
        }
    }


}