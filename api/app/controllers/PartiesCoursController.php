<?php

use dFramework\core\data\Request;

require_once __DIR__.DS.'__BaseController.php';

/* controlleur de la classe gérant les parties du cours . toutes les methodes s'y trouvant sont destinées à l
la gestion des parties du cours. */
class PartiesCoursController extends __BaseController
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
        if(true !== $this->checker->inField('id_matiere','titre_partie','num_partie')) {
            $this->_return('Veuillez remplir tous les champs du formulaire prefixés de  * ', false);
        }

        if (true !== $this->model->exist('id_matiere', (int)$data['id_matiere'], 'Matieres')) {
            $this->_return('la matière spécifiée n\existe pas. ', false);
        }

        try
        {
            //conversion des données reçu par post
            $partie['id_matiere'] = (int)$data['id_matiere'];
            $partie['titre_partie'] = (string)$data['titre_partie'];
            $partie['num_partie'] = (int)$data['num_partie'];
            $partie['statut_existant'] = 1;

            if(true === $this->model->exist_titre_partie($partie['id_matiere'], $partie['titre_partie']))
            {
                $this->_return('Une partie de cours possede déja ce titre ', false);
            }

            if(true === $this->model->exist_num_partie($partie['id_matiere'], $partie['num_partie']))
            {
                $this->_return('Une partie de cours possede déja ce numero ', false);
            }

            //Aucune des informations n'existe deja en base de donnée
            $this->model->create($partie);
            $this->_return('partie créee avec succès!!',true);
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
            if (!empty($data['id_partie'])) {
                $results = $this->model->read_with_id_partie((int)$data['id_partie']);

                if (empty($results)) {
                    $this->_return('La partie demandée n\'existe pas dans la base de donnée', false);
                }
                $this->_return('Informations sur la partie ', true, $results);
            }

            //selection d'une filiere en foction du nom de la filiere
            if (!empty($data['id_matiere'])) {
                $results = $this->model->read_with_id_matiere((int)$data['id_matiere']);

                if (empty($results)) {
                    $this->_return('ce cours n\'a pas de encore de partie', false);
                }
                $this->_return('liste des parties de la matière ', true, $results);
            }

            //selection de toutes les filieres d'enseignement
            $results = $this->model->read_all();
            if (empty($results)) {
                $this->_return('Vous n\'avez pas encore de partie de cours en base de données', false);
            }
            $this->_return('liste des parties disponibles dans la base de données', true, $results);
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
        if(true !== $this->checker->inField('id_partie','id_matiere','titre_partie','num_partie')) {
            $this->_return('Veuillez remplir tous les champs du formulaire prefixés de  * ', false);
        }

        if (true !== $this->model->exist('id_matiere', (int)$data['id_matiere'], 'Matieres')) {
            $this->_return('la matière spécifiée n\existe pas. ', false);
        }
        if (true !== $this->model->exist('id_partie', (int)$data['id_partie'], 'Parties_cours')) {
            $this->_return('la partie spécifiée n\existe pas. ', false);
        }

        try
        {
            //conversion des données reçu par post
            $partie['id_partie'] = (int)$data['id_partie'];
            $partie['id_matiere'] = (int)$data['id_matiere'];
            $partie['titre_partie'] = (string)$data['titre_partie'];
            $partie['num_partie'] = (int)$data['num_partie'];
            $partie['statut_existant'] = 1;

            if(true === $this->model->exist_titre_partie($partie['id_matiere'], $partie['titre_partie']))
            {
                $this->_return('Une partie de cours possede déja ce titre ', false);
            }

            if(true === $this->model->exist_titre_partie($partie['id_matiere'], $partie['num_partie']))
            {
                $this->_return('Une partie de cours possede déja ce numero ', false);
            }

            //Aucune des informations n'existe deja en base de donnée
            $this->model->edit_with_id($partie);
            $this->_return('partie editée avec succès!!',true);
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
        $id_partie = (int)$data['id_partie'] ?? null;
        if (empty($id_partie)) {
            $this->_return('Veillez spécifier l\'identifiant de la partie à supprimer', false);
        }

        if (true !== $this->model->exist('id_partie', (int)$data['id_partie'], 'id_partie')) {
            $this->_return('Impossible de supprimer la partie car elle comporte encore des chapitres. ', false);
        }

        try {
            $this->model->remove($id_partie);
            $this->_return('partie supprimée avec succès', true);
            //code...
        }
        catch (Exception $e)
        {
            $this->_exception($e);
        }
    }


}
