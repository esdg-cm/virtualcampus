<?php

use dFramework\core\data\Request;

require_once __DIR__.DS.'__BaseController.php';

/* controlleur de la classe gérant ressources toutes les methodes s'y trouvant sont destinées à l
la gestion des ressources. */
class RessourcesController extends __BaseController
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
        if(true !== $this->checker->inField('id_matiere','titre_ressource','type_ressource','description')) {
            $this->_return('Veuillez remplir tous les champs du formulaire prefixés de  * ', false);
        }

        try {
           //conversion des données reçu par post
           $ressource['id_matiere'] = (int)$data['id_matiere'];
           $ressource['titre_ressource'] = (string)$data['titre_ressource'];
           $ressource['type_ressource'] = (string)$data['type_ressource'];
           $ressource['description'] = (string)$data['description'];
           $ressource['statut_existant'] = 1;

        //si le titre de la ressource existe déja en base de donnée
           if(true === $this->model->exist('titre_ressource', $ressource['titre_ressource'], 'Ressources')) {
            $results = $this->model->read_ressource_titre($ressource['titre_ressource']);
            if (!empty($results)) {
                $this->_return('ce titre existe déja', false);
            }
        }

            //Aucune des informations n'existe deja en base de donnée
            $this->model->create($ressource);
            $this->_return('ressource créee avec succès!!',true);

            //code...
        } catch (Exception $e) {
            $this->_exception($e);
        }
    }

    /* fonction de selection des informations concernant une ou plusieurs ressources
    la selection peut se faire en fonction du tire de la ressource, de l'identifiant ou de l'identifiant de la matiere */
    public function read()
    {
        //recupération des données en post
        $data = $this->request->data;

        try {

            //selection d'une ressource à partir de son identifiant
            if (!empty($data['id_ressource'])) {
                $results = $this->model->read_ressource_id((int)$data['id_ressource']);

                if (empty($results)) {
                    $this->_return('La ressource demandé n\'existe pas dans la base de donnée', false);
                }
                $this->_return('Informations sur la ressource '.$results->titre_ressource.' ', true, $results);
            }

             //selection d'une matiere à partir du titre
            if (!empty($data['titre_ressource'])) {
                $results = $this->model->read_ressource_titre((string)$data['titre_ressource']);

                if (empty($results)) {
                    $this->_return('La ressource demandé n\'existe pas dans la base de donnée', false);
                }
                $this->_return('Informations sur la ressource '.$results->titre_ressource.' ', true, $results);
            }

            //selection d'une matiere à partir de sa réference
            if (!empty($data['id_matiere'])) {
                $results = $this->model->read_with_id_matiere((string)$data['id_matiere']);

                if (empty($results)) {
                    $this->_return('pas de ressouce pour cette matière dans la base de donnée', false);
                }
                $this->_return('liste des ressources de la matiere ', true, $results);
            }

            //selection de toutes les matieres
            $results = $this->model->read_all();
            if (empty($results)) {
                $this->_return('Vous n\'avez pas encore de ressource en base de données', false);
            }
            $this->_return('liste des ressources disponibles dans la base de données', true, $results);
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

        //vérification des champs necessaires pour la création de l'unité d'enseignement
        if(true !== $this->checker->inField('id_matiere','titre_ressource','type_ressource','description')) {
            $this->_return('Veuillez remplir tous les champs du formulaire prefixés de  * ', false);
        }

        try {
           //conversion des données reçu par post
           $ressource['id_matiere'] = (int)$data['id_matiere'];
           $ressource['id_ressource'] = (int)$data['id_ressource'];
           $ressource['titre_ressource'] = (string)$data['titre_ressource'];
           $ressource['type_ressource'] = (string)$data['type_ressource'];
           $ressource['description'] = (string)$data['description'];
           $ressource['statut_existant'] = 1;

        //si le titre de la ressource existe déja en base de donnée
           if(true === $this->model->exist('titre_ressource', $ressource['titre_ressource'], 'Ressources')) {
            $results = $this->model->read_ressource_titre($ressource['titre_ressource']);
            if (!empty($results)) {
                $this->_return('ce titre existe déja', false);
            }
        }

            //Aucune des informations n'existe deja en base de donnée
            $this->model->edit_with_id($ressource['id_ressource'], $ressource);
            $this->_return('ressource editée avec succès!!',true);

            //code...
        } catch (Exception $e) {
            $this->_exception($e);
        }
    }

    /* suppression d'une ressouce
    le parametre necessaire est l'identifiant de la ressource */
    public function delete()
    {
        //recuperation des informations pour la suppression d'une ressource
        $data = $this->Request->data;
        $id_ressource = (int)$data['id_ressource'] ?? null;

        if (empty($id_ressource)) {
            $this->_return('Veillez spécifier l\'identifiant de la ressource à supprimer', false);
        }

        try {
            $this->model->remove($id_ressource);
            $this->_return('La matière à étè supprimé avec succès', true);
            //code...
        } catch (Exception $e) {
            $this->_exception($e);
        }
    }
}
