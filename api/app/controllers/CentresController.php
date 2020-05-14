<?php

use dFramework\core\data\Request;

require_once __DIR__ . DS . '__BaseController.php';

/* controlleur de la classe gérant les centres. toutes les methodes s'y trouvant sont destinées à l
la gestion des centres. */
class CentresController extends __BaseController
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
            case 'post' :
                $this->create();
                break;
            case 'delete':
                $this->delete($id_ue);
                break;
            case 'put':
                $this->put();
                break;
            default:
                $this->read($id_ue);
        }
    }

    public function create()
    {
        //recupération des données en post
        $data = $this->request->data;
        //librerie de validation des champs
        $this->loadLibrary('checker');
        $this->checker->useInputField(true, $data);

        //vérification des champs necessaires pour la création d'un centre        
        if (true !== $this->checker->inField('nom_centre', 'code_centre', 'tel_responsable')) {
            $this->_return('Veuillez remplir tous les champs du formulaire prefixés de  * ', false);
        }

        //Vérification de la longeur du code du centre
        if (true !== $this->checker->min_length('code_centre', 3)) {
            $this->_return('Le code du centre doit avoir au moins 3 caracteres', false);
        }

        //verification de la conformité du numero de téléphone
        if (true !== $this->checker->is_tel('tel_responsable')) {
            $this->_return('ce numéro n\'est pas valide!!', false);
        }

        try {
            //conversion des données reçu par post
            $centres['nom_centre'] = (string)$data['nom_centre'];
            $centres['code_centre'] = (string)$data['code_centre'];
            $centres['tel_responsable'] = (string)$data['tel_responsable'];
            $centres['localisation'] = (string)$data['localisation'];
            $centres['statut_existant'] = 1;

            $can_create_code = false;
            $can_create_nom = false;
            $can_create_tel = false;
            $can_create_id = 0;
            $can_create_localisation = false;

            //si le code du centre existe déja en base de donnée
            if (true === $this->model->exist('code_centre', $centres['code_centre'], 'Centres')) {
                $results = $this->model->read_with_code_centre($centres['code_centre']);
                if (!empty($results)) {
                    $this->_return('Un centre possede déja ce code', false);
                }
                $can_create_code = true;
            }
            //si le nom du centre existe déja en base de donnée
            if (true === $this->model->exist('nom_centre', $centres['nom_centre'], 'Centres')) {
                $results = $this->model->read_with_nom_centre($centres['nom_centre']);
                if (!empty($results)) {
                    $this->_return('Un centre possede déja ce nom', false);
                }
                $can_create_id = $results->id_centre;
                $can_create_tel = $centres['tel_responsable'] == $results->tel_responsable;
                $can_create_localisation = $centres['localisation'] == $results->localisation;
                $can_create_nom = true;
            }

            if ($can_create_nom && $can_create_code) {
                if ($can_create_tel && $can_create_localisation) {
                    $this->model->edit_with_id_centre($can_create_id, $centres);
                    $this->_return('centre crée avec succès!!', true);
                }
            }

            //Aucune des informations n'existe deja en base de donnée
            $this->model->create($centres);
            $this->_return('centre crée avec succès!!', true);
        } catch (Exception $e) {
            $this->_exception($e);
        }
    }

    public function read()
    {
        //recupération des données en post
        $data = $this->request->data;
        try {
            //selection d'un centre en foction de l'identifiant
            if (!empty($data['id_centre'])) {
                $results = $this->model->read_with_id_centre((int)$data['id_centre']);

                if (empty($results)) {
                    $this->_return('Le centre demandé n\'existe pas dans la base de donnée', false);
                }
                $this->_return('Informations sur le centre  ' . $results->nom_centre . ' ', true, $results);
            }

            //selection d'un centre en foction du code du centre
            if (!empty($data['code_centre'])) {
                $results = $this->model->read_with_code_centre((int)$data['code_centre']);

                if (empty($results)) {
                    $this->_return('Le centre demandé n\'existe pas dans la base de donnée', false);
                }
                $this->_return('Informations sur le centre  ' . $results->nom_centre . ' ', true, $results);
            }

            //selection d'un centre en foction du code du centre
            if (!empty($data['nom_centre'])) {
                $results = $this->model->read_with_nom_centre((int)$data['nom_centre']);

                if (empty($results)) {
                    $this->_return('Le centre demandé n\'existe pas dans la base de donnée', false);
                }
                $this->_return('Informations sur le centre  ' . $results->nom_centre . ' ', true, $results);
            }

            //selection de tous les centres d'enseignement
            $results = $this->model->read_all();
            if (empty($results)) {
                $this->_return('Vous n\'avez pas encore de centre en base de données', false);
            }
            $this->_return('liste des centres disponibles dans la base de données', true, $results);
        } catch (Exception $e) {
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
        if (true !== $this->checker->inField('id_centre', 'nom_centre', 'code_centre', 'tel_responsable')) {
            $this->_return('Veuillez remplir tous les champs du formulaire prefixés de  * ', false);
        }
        //vérification de la longeur du code du centre
        if (true !== $this->checker->min_length('code_centre', 3)) {
            $this->_return('Le code du centre doit avoir au moins 3 caracteres', false);
        }
        //verification de la conformité du numero de téléphone 
        if (true !== $this->checker->is_tel('tel_responsable')) {
            $this->_return('ce numéro n\'est pas valide!!', false);
        }

        try {
            //conversion des données reçu par post
            $centres['nom_centre'] = (string)$data['nom_centre'];
            $centres['code_centre'] = (string)$data['code_centre'];
            $centres['tel_responsable'] = (string)$data['tel_responsable'];
            $centres['localisation'] = (string)$data['localisation'];
            $centres['id_centre'] = (int)$data['id_centre'];

            //si le code du centre existe déja en base de donnée
            if (true === $this->model->exist('code_centre', $centres['code_centre'], 'Centres')) {
                $results = $this->model->read_with_code_centre($centres['code_centre']);
                if (!empty($results) && ($results->id_centre != $centres['id_centre'])) {
                    $this->_return('Un centre possede déja ce code', false);
                }
            }
            //si le nom du centre existe déja en base de donnée
            if (true === $this->model->exist('nom_centre', $centres['nom_centre'], 'Centres')) {
                $results = $this->model->read_with_nom_centre($centres['nom_centre']);
                if (!empty($results) && ($results->id_centre != $centres['id_centre'])) {
                    $this->_return('Un centre possede déja ce nom', false);
                }
            }

            //Aucune des informations n'existe deja en base de donnée
            $this->model->edit_with_id_centre($centres['id_centre'], $centres);
            $this->_return('centre modifié avec succès!!', true);
        } catch (Exception $e) {
            $this->_exception($e);
        }
    }

    /* suppression d'un centre */
    public function delete()
    {
        //recuperation des informations pour la suppression d'un centre
        $data = $this->request->data;
        $id_centre = (int)$data['id_centre'] ?? null;
        if (empty($id_centre)) {
            $this->_return('Veillez spécifier l\'identifiant du centre à supprimer', false);
        }

        try {
            $this->model->remove($id_centre);
            $this->_return('centre supprimé avec succès', true);
            //code...
        } catch (Exception $e) {
            $this->_exception($e);
        }
    }
}