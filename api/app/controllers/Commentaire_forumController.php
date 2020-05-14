<?php

use dFramework\core\data\Request;

require_once __DIR__.DS.'__BaseController.php';

/* controlleur de la classe gérant les commentaires. toutes les methodes s'y trouvant sont destinées à l
la gestion des commentaires de discution. */
class Commentaire_forumController extends __BaseController
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
        if(true !== $this->checker->inField('id_utilisateur','id_billet','contenu')) {
            $this->_return('Veuillez remplir tous les champs du formulaire prefixés de  * ', false);
        }

        try
        {
            if(true !== $this->model->exist('id_utilisateur', (int) $data['id_utilisateur'], 'Utilisateurs')) {
                $this->_return('Utilisateur non reconnu', false);
            }
            if(true !== $this->model->exist('id_billet', (int) $data['id_billet'], 'Billets_forum')) {
                $this->_return('sujet non reconnu', false);
            }

            //conversion des données reçu par post
            $commentaires['id_utilisateur'] = (int)$data['id_utilisateur'];
            $commentaires['id_billet'] = (int)$data['id_billet'];
            $commentaires['contenu'] = (string)$data['contenu'];
            $commentaires['date_commentaire'] = date('Y-m-d H:i:s');
            $commentaires['statut_existant'] = 1;

            //Ajout du commentaire en base de données en base de donnée
            $this->model->create($commentaires);
            $this->_return('votre commentaire a été ajouter avec succès!!',true);          
        }
        catch(Exception $e)
        {
            $this->_exception($e);
        }
    }

    /* retourne les commentaires */
    public function read()
    {
        //recupération des données en post
        $data = $this->request->data;
        try
        {
            //selection d'un commentaire en foction de l'identifiant
            if (!empty($data['id_commentaire'])) {
                $results = $this->model->read_comment_with_id((int)$data['id_commentaire']);

                if (empty($results)) {
                    $this->_return('Le commentaire demandé n\'existe pas dans la base de donnée', false);
                }
                $this->_return('Informations sur le commentaire ', true, $results);
            }

            //selection d'un commentaire en foction du sujet
            if (!empty($data['id_billet'])) {
                $results = $this->model->read_all_comment_billet_id((int)$data['id_billet']);

                if (empty($results)) {
                    $this->_return('Aucun commentaire pour ce sujet', false);
                }
                $this->_return('liste des commentaire sur le sujet spécifié', true, $results);
            }

            //selection de tous les centres d'enseignement
            $results = $this->model->read_all();
            if (empty($results)) {
                $this->_return('pas de commentaire en base de données', false);
            }
            $this->_return('tous les commentaires en base de donnée', true, $results);
        }
        catch(Exception $e)
        {
            $this->_exception($e);
        }
    }

    /* retourne les commentaire d'un utilisateur par rapport a un sujet */
    public function readCommentUser()
    {
        //recupération des données en post
        $data = $this->request->data;
        try
        {
            if(true !== $this->model->exist('id_utilisateur', (int) $data['id_utilisateur'], 'Utilisateurs')) {
                $this->_return('Utilisateur non reconnu', false);
            }
            if(true !== $this->model->exist('id_billet', (int) $data['id_billet'], 'Billets_forum')) {
                $this->_return('sujet non reconnu', false);
            }

            $results = $this->model->read_all_comment_user_billet((int)$data['id_utilisateur'], (int)$data['id_billet']);
            if (empty($results)) {
                $this->_return('cet utilisateur n\'a pas de commentaire concernant ce sujet', false);
            }
            $this->_return('commentaires de l\'utilisateur sur le sujet ', true, $results);
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
        if(true !== $this->checker->inField('id_commentaire','id_utilisateur','id_billet','contenu')) {
            $this->_return('Veuillez remplir tous les champs du formulaire prefixés de  * ', false);
        }

        try
        {
            if(true !== $this->model->exist('id_utilisateur', (int) $data['id_utilisateur'], 'Utilisateurs')) {
                $this->_return('Utilisateur non reconnu', false);
            }
            if(true !== $this->model->exist('id_billet', (int) $data['id_billet'], 'Billets_forum')) {
                $this->_return('sujet non reconnu', false);
            }
            if(true !== $this->model->exist('id_commentaire', (int) $data['id_commentaire'], 'Commentaires_forum')) {
                $this->_return('ce commentaire n\'existe pas', false);
            }

            //conversion des données reçu par post
            $commentaires['id_commentaire'] = (int)$data['id_commentaire'];
            $commentaires['id_utilisateur'] = (int)$data['id_utilisateur'];
            $commentaires['id_billet'] = (int)$data['id_billet'];
            $commentaires['contenu'] = (string)$data['contenu'];
            $commentaires['date_commentaire'] = date('Y-m-d H:i:s');
            $commentaires['statut_existant'] = 1;

            //Ajout du commentaire en base de données en base de donnée
            $this->model->edit_with_id($commentaires['id_commentaire'], $commentaires);
            $this->_return('votre commentaire a été modifié avec succès!!',true);          
        }
        catch(Exception $e)
        {
            $this->_exception($e);
        }
    }

    /* suppression d'un commentaire */
    public function delete()
    {
        //recuperation des informations pour la suppression d'un commentaire
        $data = $this->request->data;
        $id_commentaire = (int)$data['id_commentaire'] ?? null;
        if (empty($id_commentaire)) {
            $this->_return('Veillez spécifier l\'identifiant du commentaire à supprimer', false);
        }

        try {
            $this->model->remove($id_commentaire);
            $this->_return('commentaire supprimé avec succès', true);
            //code...
        } 
        catch (Exception $e)
        {
            $this->_exception($e);
        }
    }


}