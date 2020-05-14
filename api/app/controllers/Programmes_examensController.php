<?php

use dFramework\core\data\Request;

require_once __DIR__.DS.'__BaseController.php';

/* controlleur de la classe gérant les classes. toutes les methodes s'y trouvant sont destinées à l
la gestion des salles de classes. */
class Programmes_examensController extends __BaseController
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
        if(true !== $this->checker->inField('id_classe','id_examen','date_debut')) {
            $this->_return('Veuillez remplir tous les champs du formulaire prefixés de  * ', false);
        }

        //verification de l'idenntifiant de la filiere
        if(true === $this->model->exist('id_classe', (int)$data['id_classe'], 'Classes')) {
            $this->_return('cette classe n\'existe pas', false);
        }
        
        //verification de l'idenntifiant du centre
        if(true === $this->model->exist('id_examen', (int)$data['id_examen'], 'Examens')) {
            $this->_return('cet Examen n\'existe pas', false);
        }

        try
        {
            //conversion des données reçu par post
            $programme['id_examen'] = (int)$data['id_examen'];
            $programme['id_classe'] = (int)$data['id_classe'];
            $programme['date_debut'] = (string)$data['date_debut'];
            $programme['statut_existant'] = 1;

            //Aucune des informations n'existe deja en base de donnée
            $this->model->create($programme);
            $this->_return('examen programmé avec succès!!',true);          
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
            if (!empty($data['id_examen'])) {
                $results = $this->model->read_with_id_examen((int)$data['id_examen']);

                if (empty($results)) {
                    $this->_return('cet examen n\est pas programmer', false);
                }
                $this->_return('Informations sur l\'exament programmé ', true, $results);
            }

            //selection d'une classe en foction du code de la classe
            if (!empty($data['id_programme'])) {
                $results = $this->model->read_with_id_programme((int)$data['id_programme']);

                if (empty($results)) {
                    $this->_return('aucun examen n\'est programmer avec cet identifiant ', false);
                }
                $this->_return('Information sur l\'exament programmé ', true, $results);
            }
            
            //selection d'une classe en foction du nom de la classe
            if (!empty($data['id_classe'])) {
                $results = $this->model->read_with_id_classe((int)$data['id_classe']);

                if (empty($results)) {
                    $this->_return('Aucun examen n\'est programmé dans cette classe', false);
                }
                $this->_return('liste des examens programmés dans la classe', true, $results);
            }

            //selection de toutes les classes d'enseignement
            $results = $this->model->read_all();
            if (empty($results)) {
                $this->_return('aucun examen programmé.', false);
            }
            $this->_return('liste des examens programmés', true, $results);
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
        if(true !== $this->checker->inField('id_classe','id_programme','id_examen','date_debut')) {
            $this->_return('Veuillez remplir tous les champs du formulaire prefixés de  * ', false);
        }

        //verification de l'idenntifiant de la filiere
        if(true === $this->model->exist('id_classe', (int)$data['id_classe'], 'Classes')) {
            $this->_return('cette classe n\'existe pas', false);
        }
        
        //verification de l'idenntifiant du centre
        if(true === $this->model->exist('id_examen', (int)$data['id_examen'], 'Examens')) {
            $this->_return('cet Examen n\'existe pas', false);
        }

        try
        {
            //conversion des données reçu par post
            $programme['id_programme'] = (int)$data['id_programme'];
            $programme['id_examen'] = (int)$data['id_examen'];
            $programme['id_classe'] = (int)$data['id_classe'];
            $programme['date_debut'] = (string)$data['date_debut'];
            $programme['statut_existant'] = 1;

            //Aucune des informations n'existe deja en base de donnée
            $this->model->edit_with_id($programme['id_programme'], $programme);
            $this->_return('le  programme de l\'examen a été edité avec succès!!',true);          
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
        $id_programme = (int)$data['id_programme'] ?? null;
        if (empty($id_programme)) {
            $this->_return('Veillez spécifier l\'identifiant du programme d\'examen à supprimer', false);
        }

        try {
            $this->model->remove($id_programme);
            $this->_return('l\'examen programmé a été supprimée avec succès', true);
            //code...
        } 
        catch (Exception $e)
        {
            $this->_exception($e);
        }
    }


}