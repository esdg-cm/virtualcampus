<?php

use dFramework\core\data\Request;

require_once __DIR__.DS.'__BaseController.php';

/* controlleur de la classe gérant les classes. toutes les methodes s'y trouvant sont destinées à l
la gestion des salles de classes. */
class Propositions_reponsesController extends __BaseController
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
        if(true !== $this->checker->inField('id_quiz','proposition','is_response')) {
            $this->_return('Veuillez remplir tous les champs du formulaire prefixés de  * ', false);
        }
        
        //verification de l'idenntifiant du niveau
        if(true === $this->model->exist('id_quiz', (int)$data['id_quiz'], 'Quiz')) {
            $this->_return('cette question n\'existe pas', false);
        }

        try
        {
            //conversion des données reçu par post
            $reponse['id_quiz'] = (int)$data['id_quiz'];
            $reponse['proposition'] = (string)$data['proposition'];
            $reponse['is_response'] = (bool)$data['is_response'];

            //Aucune des informations n'existe deja en base de donnée
            $this->model->create($reponse);
            $this->_return('Réponse créee avec succès!!',true);          
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
            if (!empty($data['id_proposition'])) {
                $results = $this->model->read_with_id_proposition((int)$data['id_proposition']);

                if (empty($results)) {
                    $this->_return('cette proposition de réponse n\'existe pas', false);
                }
                $this->_return('Informations sur la réponse démandée', true, $results);
            }

            //selection d'une classe en foction du code de la classe
            if (!empty($data['id_quiz'])) {
                $results = $this->model->read_with_id_quiz((int)$data['id_quiz']);

                if (empty($results)) {
                    $this->_return('pas de proposition de réponse pour cette question', false);
                }
                $this->_return('liste des propositions de réponse pour la question', true, $results);
            }
 
            //selection de toutes les classes d'enseignement
            $results = $this->model->read_all();
            if (empty($results)) {
                $this->_return('aucune proposition de réponse en base de données', false);
            }
            $this->_return('liste des propositions de réponse disponibles dans la base de données', true, $results);
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
        if(true !== $this->checker->inField('id_quiz','id_proposition','proposition','is_response')) {
            $this->_return('Veuillez remplir tous les champs du formulaire prefixés de  * ', false);
        }
        
        //verification de l'idenntifiant du niveau
        if(true === $this->model->exist('id_quiz', (int)$data['id_quiz'], 'Quiz')) {
            $this->_return('cette question n\'existe pas', false);
        }
        //verification de l'idenntifiant du niveau
        if(true === $this->model->exist('id_proposition', (int)$data['id_proposition'], 'Propositions_reponses')) {
            $this->_return('cette réponse n\'existe pas', false);
        }

        try
        {
            //conversion des données reçu par post
            $reponse['id_quiz'] = (int)$data['id_quiz'];
            $reponse['id_proposition'] = (int)$data['id_proposition'];
            $reponse['proposition'] = (string)$data['proposition'];
            $reponse['is_response'] = (bool)$data['is_response'];

            //Aucune des informations n'existe deja en base de donnée
            $this->model->edit_with_id($reponse['id_proposition'], $reponse);
            $this->_return('Réponse editée avec succès!!',true);          
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
        $id_proposition = (int)$data['id_proposition'] ?? null;
        if (empty($id_proposition)) {
            $this->_return('Veillez spécifier l\'identifiant de la réponse à supprimer', false);
        }

        try {
            $this->model->remove($id_proposition);
            $this->_return('réponse supprimée avec succès', true);
            //code...
        } 
        catch (Exception $e)
        {
            $this->_exception($e);
        }
    }
}