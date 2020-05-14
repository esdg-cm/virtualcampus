<?php

use dFramework\core\data\Request;

require_once __DIR__.DS.'__BaseController.php';

/* controlleur de la classe gérant le glossaire. toutes les methodes s'y trouvant sont destinées à l
la gestion des glossaire. */
class GlossairesController extends __BaseController
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
        if(true !== $this->checker->inField('id_utilisateur','id_matiere','terme','contenue')) {
            $this->_return('Veuillez remplir tous les champs du formulaire prefixés de  * ', false);
        }

        try
        {
            //conversion des données reçu par post
            $glossaire['id_utilisateur'] = (int)$data['id_utilisateur'];
            $glossaire['id_matiere'] = (int)$data['id_matiere'];
            $glossaire['terme'] = (string)$data['terme'];
            $glossaire['contenue'] = (string)$data['contenue'];
            $glossaire['statut_existant'] = 1;

            if(true !== $this->model->exist('id_utilisateur', $data['id_utilisateur'], 'Utilisateurs')) {
                $this->_return('cet utilisateur n\'existe pas', false);
            }

            if(true !== $this->model->exist('id_matiere', $data['id_matiere'], 'Matieres')) {
                $this->_return('cette matière n\'existe pas', false);
            }

            //Aucune des informations n'existe deja en base de donnée
            $this->model->create($glossaire);
            $this->_return('terme ajouté avec succès!!',true);          
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
            //selection d'un terme en foction de l'identifiant
            if (!empty($data['id_glossaire'])) {
                $results = $this->model->read_with_id((int)$data['id_glossaire']);

                if (empty($results)) {
                    $this->_return('Le terme demandé n\'existe pas dans la base de donnée', false);
                }
                $this->_return('Informations sur le terme  '.$results->terme.' ', true, $results);
            }

            //selection des termes d'une matiere
            if (!empty($data['id_matiere'])) {
                $results = $this->model->read_with_id_matiere((int)$data['id_matiere']);

                if (empty($results)) {
                    $this->_return('pas encore de terme dans le glossaire', false);
                }
                $this->_return('glossaire de la matière ', true, $results);
            }
            
            //selection d'un centre en foction du code du centre
            if (!empty($data['id_utilisateur'])) {
                $results = $this->model->read_with_id_utilisateur((int)$data['id_utilisateur']);

                if (empty($results)) {
                    $this->_return('cet utilisateur n\'a encore ajouter aucun terme', false);
                }
                $this->_return('liste des termes ajoutés par l\'utilisateur ', true, $results);
            }

            //selection de tous les centres d'enseignement
            $results = $this->model->read_all();
            if (empty($results)) {
                $this->_return('Vous n\'avez pas encore de termes en base de données', false);
            }
            $this->_return('liste des termes disponibles dans la base de données', true, $results);
        }
        catch(Exception $e)
        {
            $this->_exception($e);
        }
    }

    public function put()
    {        //recupération des données en post
        $data = $this->request->data;

        //librerie de validation des champs
        $this->loadLibrary('checker');
        $this->checker->useInputField(true, $data);  

        //vérification des champs necessaires pour la création d'un centre        
        if(true !== $this->checker->inField('id_glossaire','id_utilisateur','id_matiere','terme','contenue')) {
            $this->_return('Veuillez remplir tous les champs du formulaire prefixés de  * ', false);
        }

        try
        {
            //conversion des données reçu par post
            $glossaire['id_glossaire'] = (int)$data['id_glossaire'];
            $glossaire['id_utilisateur'] = (int)$data['id_utilisateur'];
            $glossaire['id_matiere'] = (int)$data['id_matiere'];
            $glossaire['terme'] = (string)$data['terme'];
            $glossaire['contenue'] = (string)$data['contenue'];
            $glossaire['statut_existant'] = 1;

            if(true !== $this->model->exist('id_utilisateur', $data['id_utilisateur'], 'Utilisateurs')) {
                $this->_return('cet utilisateur n\'existe pas', false);
            }

            if(true !== $this->model->exist('id_glossaire', $data['id_glossaire'], 'Glossaires')) {
                $this->_return('cet utilisateur n\'existe pas', false);
            }

            if(true !== $this->model->exist('id_matiere', $data['id_matiere'], 'Matieres')) {
                $this->_return('cette matière n\'existe pas', false);
            }

            //Aucune des informations n'existe deja en base de donnée
            $this->model->edit_with_id($glossaire['id_glossaire'], $glossaire);
            $this->_return('terme modifié avec succès!!',true);          
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
        $id_glossaire = (int)$data['id_glossaire'] ?? null;
        if (empty($id_glossaire)) {
            $this->_return('Veillez spécifier l\'identifiant du terme à supprimer', false);
        }

        try {
            $this->model->remove($id_glossaire);
            $this->_return('terme supprimé avec succès', true);
            //code...
        } 
        catch (Exception $e)
        {
            $this->_exception($e);
        }
    }


}