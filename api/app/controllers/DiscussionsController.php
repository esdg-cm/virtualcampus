<?php

use dFramework\core\data\Request;

require_once __DIR__.DS.'__BaseController.php';

/* controlleur de la classe gérant les classes. toutes les methodes s'y trouvant sont destinées à l
la gestion des salles de classes. */
class DiscussionsController extends __BaseController
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

        //vérification des champs necessaires pour la création d'une discussion        
        if(true !== $this->checker->inField('id_utilisateur','id_matiere','id_classe','contenue')) {
            $this->_return('Veuillez remplir tous les champs du formulaire prefixés de  * ', false);
        }

        //verification de l'idenntifiant de la matiere
        if(true === $this->model->exist('id_matiere', 'id_matiere', 'Matieres')) {
            $this->_return('cette matiere n\'existe pas', false);
        }
        
        //verification de l'idenntifiant de l'utilisateur
        if(true === $this->model->exist('id_utilisateur', 'id_utilisateur', 'Utilisateurs')) {
            $this->_return('cette matière n\'existe pas', false);
        }
        
        //verification de l'idenntifiant du niveau
        if(true === $this->model->exist('id_classe', 'id_classe', 'Classes')) {
            $this->_return('cette classe n\'existe pas', false);
        }

        try
        {
            //conversion des données reçu par post
            $discussion['id_utilisateur'] = (int)$data['id_utilisateur'];
            $discussion['id_matiere'] = (int)$data['id_matiere'];
            $discussion['id_classe'] = (int)$data['id_classe'];
            $discussion['contenue'] = (string)$data['contenue'];
            $discussion['date_discussion'] = date('Y-m-d H:i:s');
            $discussion['statut_existant'] = 1;

            //Aucune des informations n'existe deja en base de donnée
            $this->model->create($discussion);
            $this->_return('commentaire ajouté avec succès!!',true);          
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
            //selection des discussions d'un utilisateur
            if (!empty($data['id_utilisateur'])) {
                $results = $this->model->read_with_id_utilisateur((int)$data['id_utilisateur']);

                if (empty($results)) {
                    $this->_return('cet utilisateur n\'a encore laisser aucun message', false);
                }
                $this->_return('tous les messages de l\'utilisateur ', true, $results);
            }

            //selection des discussions d'une classe
            if (!empty($data['id_classe'])) {
                $results = $this->model->read_with_id_classe((int)$data['id_classe']);

                if (empty($results)) {
                    $this->_return('pas encore de message pour cette classe', false);
                }
                $this->_return('tous les messages de la classe ', true, $results);
            }
            
            //selection des discussions pour une matiere
            if (!empty($data['id_matiere'])) {
                $results = $this->model->read_with_id_matiere((int)$data['id_matiere']);

                if (empty($results)) {
                    $this->_return('pas encore de message pour cette matière', false);
                }
                $this->_return('liste des messages de la matiere ', true, $results);
            }

            //selection d'une discussion en particulier
            if (!empty($data['id_discussion'])) {
                $results = $this->model->read_with_id_discussion((int)$data['id_discussion']);

                if (empty($results)) {
                    $this->_return('ce message n\'existe pas ', false);
                }
                $this->_return('contenue du message', true, $results);
            }

            //selection de toutes les classes d'enseignement
            $results = $this->model->read_all();
            if (empty($results)) {
                $this->_return('Vous n\'avez pas encore de message ', false);
            }
            $this->_return('tous les messages disponibles', true, $results);
        }
        catch(Exception $e)
        {
            $this->_exception($e);
        }
    }

    public function readDiscussionClasse()
    {
        //recupération des données en post
        $data = $this->request->data;

        //librerie de validation des champs
        $this->loadLibrary('checker');
        $this->checker->useInputField(true, $data);

        //vérification des champs necessaires pour la création de l'unité d'enseignement        
        if(true !== $this->checker->inField('id_matiere','id_classe')) {
            $this->_return('Veuillez spécifier la classe et la matiere pour avoir les discussions', false);
        }

        try
        {
            if (true !== $this->model->exist('id_matiere', (int)$data['id_matiere'], 'Matieres')) {
                $this->_return('la matière spécifié n\existe pas. ', false);
            } 
            if (true !== $this->model->exist('id_classe', (int)$data['id_classe'], 'Classes')) {
                $this->_return('la classe spécifié n\existe pas. ', false);
            } 

            $results = $this->model->read_all_discussion_classe_matiere((int)$data['id_matiere'], (int)$data['id_classe']);
            if (empty($results)) {
                $this->_return('Vous n\'avez pas encore de message pour cette classe concernant cette matière ', false);
            }
            $this->_return('tous les messages disponibles pour cette classe concernant cette matière ', true, $results);
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

        //vérification des champs necessaires pour la création d'une discussion        
        if(true !== $this->checker->inField('id_discussion','id_utilisateur','id_matiere','id_classe','contenue')) {
            $this->_return('Veuillez remplir tous les champs du formulaire prefixés de  * ', false);
        }

        //verification de l'idenntifiant de la matiere
        if(true === $this->model->exist('id_matiere', 'id_matiere', 'Matieres')) {
            $this->_return('cette matiere n\'existe pas', false);
        }        
        //verification de l'idenntifiant de la matiere
        if(true === $this->model->exist('id_discussion', 'id_discussion', 'Utilisateurs')) {
            $this->_return('ce message n\'existe pas', false);
        }
        //verification de l'idenntifiant de l'utilisateur
        if(true === $this->model->exist('id_utilisateur', 'id_utilisateur', 'Utilisateurs')) {
            $this->_return('cette matière n\'existe pas', false);
        }
        
        //verification de l'idenntifiant de la classe
        if(true === $this->model->exist('id_classe', 'id_classe', 'Classes')) {
            $this->_return('cette classe n\'existe pas', false);
        }

        try
        {
            //conversion des données reçu par post
            $discussion['id_discussion'] = (int)$data['id_discussion'];
            $discussion['id_utilisateur'] = (int)$data['id_utilisateur'];
            $discussion['id_matiere'] = (int)$data['id_matiere'];
            $discussion['id_classe'] = (int)$data['id_classe'];
            $discussion['contenue'] = (string)$data['contenue'];
            $discussion['date_discussion'] = date('Y-m-d H:i:s');
            $discussion['statut_existant'] = 1;

            //Aucune des informations n'existe deja en base de donnée
            $this->model->edit_with_id($discussion['id_discussion'], $discussion);
            $this->_return('commentaire modifié avec succès!!',true);          
        }
        catch(Exception $e)
        {
            $this->_exception($e);
        }
    }

    /* suppression d'un message de discussion */
    public function delete()
    {
        //recuperation des informations pour la suppression d'une filiére
        $data = $this->request->data;
        $id_discussion = (int)$data['id_discussion'] ?? null;
        if (empty($id_discussion)) {
            $this->_return('Veillez spécifier l\'identifiant du message à supprimer', false);
        }

        try {
            $this->model->remove($id_discussion);
            $this->_return('message supprimée avec succès', true);
            //code...
        } 
        catch (Exception $e)
        {
            $this->_exception($e);
        }
    }


}