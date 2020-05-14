<?php

use dFramework\core\data\Request;

require_once __DIR__.DS.'__BaseController.php';

/* controlleur de la classe gérant les centres. toutes les methodes s'y trouvant sont destinées à l
la gestion des centres. */
class ChapitresController extends __BaseController
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
        if(true !== $this->checker->inField('id_partie','titre_chap','num_chap','contenu')) {
            $this->_return('Veuillez remplir tous les champs du formulaire prefixés de  * ', false);
        }

        //verification de l'idenntifiant du niveau
        if(true === $this->model->exist('id_partie', (int)$data['id_partie'], 'Parties_cours')) {
            $this->_return('ce niveau n\'existe pas', false);
        }

        try
        {
            //conversion des données reçu par post
            $chapitre['id_partie'] = (int)$data['id_partie'];
            $chapitre['titre_chap'] = (string)$data['titre_chap'];
            $chapitre['num_chap'] = (string)$data['num_chap'];
            $chapitre['contenu'] = (string)$data['contenu'];
            $chapitre['statut_existant'] = 1;

            if(true === $this->model->exist_titre_chapitre($chapitre['id_partie'], $chapitre['titre_chap']))
            {
                $this->_return('Un chapitre de cours possede déja ce titre ', false);
            }

            if(true === $this->model->exist_num_chapitre($chapitre['id_partie'], $chapitre['num_chap']))
            {
                $this->_return('Un chapitre de cours possede déja ce numero ', false);
            }

            //Aucune des informations n'existe deja en base de donnée
            $this->model->create($chapitre);
            $this->_return('chapitre crée avec succès!!',true);
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
            /**
             * @author Dimitri
             * @var bool
             * Specifie si on veut recuperer aussi le contenu du chapitre ou pas.
             *  Dans le sommaire, le contenu du chapitre n'a pas d'importance donc
             *  recuperer tous le contenu des chapitres (pour ne pas les afficher) sera
             *  couteux en memoire
             */
            $without_content = (bool) ($data['without_content'] ?? false);

            //selection d'un centre en foction de l'identifiant
            if (!empty($data['id_chapitre'])) {
                $results = $this->model->read_with_id((int)$data['id_chapitre'], $without_content);

                if (empty($results)) {
                    $this->_return('Le chapitre demandé n\'existe pas dans la base de donnée', false);
                }
                $this->_return('Informations sur le chapitre  '.$results->titre_chap.' ', true, $results);
            }

            //selection d'un centre en fonction de la partie
            if (!empty($data['id_partie'])) {
                $results = $this->model->read_with_id_partie((int)$data['id_partie'], $without_content);

                if (empty($results)) {
                    $this->_return('cette partie n\'a pas encore de chapitre', false);
                }
                $this->_return('liste des chapitres de la partie ', true, $results);
            }

            /**
             * @author Dimitri Sitchet
             * Pour la lecture du chapitre en fonction de la matiere
             */
            if(!empty($data['id_matiere'])) {
                $id_matiere = $data['id_matiere'];
                $id_chapitre = $data['id_chapitre'] ?? null;

                $results = $this->model->read_with_matiere_and_chapitre($id_matiere, $id_chapitre);
                if(empty($results)) {
                    $this->_return('Cette matiere ne possede pas ce chapitre', false);
                }
                $this->_return('Chapitre demandé', true, $results);
            }

            //selection de tous les centres d'enseignement
            $results = $this->model->read_all($without_content);
            if (empty($results)) {
                $this->_return('Vous n\'avez pas encore de chapitre en base de données', false);
            }
            $this->_return('liste des chapitres disponible dans la base de données', true, $results);
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
        if(true !== $this->checker->inField('id_chapitre','id_partie','titre_chap','num_chap','contenu')) {
            $this->_return('Veuillez remplir tous les champs du formulaire prefixés de  * ', false);
        }

        //verification de l'idenntifiant du niveau
        if(true === $this->model->exist('id_partie', (int)$data['id_partie'], 'Parties_cours')) {
            $this->_return('ce niveau n\'existe pas', false);
        }

        try
        {
            //conversion des données reçu par post
            $chapitre['id_chapitre'] = (int)$data['id_chapitre'];
            $chapitre['id_partie'] = (int)$data['id_partie'];
            $chapitre['titre_chap'] = (string)$data['titre_chap'];
            $chapitre['num_chap'] = (string)$data['num_chap'];
            $chapitre['contenu'] = (string)$data['contenu'];
            $chapitre['statut_existant'] = 1;

            if(true === $this->model->exist_titre_chapitre($chapitre['id_partie'], $chapitre['titre_chap']))
            {
                $this->_return('Un chapitre de cours possede déja ce titre ', false);
            }

            if(true === $this->model->exist_num_chapitre($chapitre['id_partie'], $chapitre['num_chap']))
            {
                $this->_return('Un chapitre de cours possede déja ce numero ', false);
            }

            //Aucune des informations n'existe deja en base de donnée
            $this->model->edit_with_id($chapitre['id_chapitre'], $chapitre);
            $this->_return('chapitre edité avec succès!!',true);
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
        $id_chapitre = (int)$data['id_chapitre'] ?? null;
        if (empty($id_chapitre)) {
            $this->_return('Veillez spécifier l\'identifiant du chapitre à supprimer', false);
        }

        try {
            $this->model->remove($id_chapitre);
            $this->_return('chapitre supprimé avec succès', true);
            //code...
        }
        catch (Exception $e)
        {
            $this->_exception($e);
        }
    }


}
