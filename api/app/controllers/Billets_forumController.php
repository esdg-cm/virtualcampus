<?php

use dFramework\core\data\Request;

require_once __DIR__.DS.'__BaseController.php';

/* controlleur de la classe gérant les biellets de forum. toutes les methodes s'y trouvant sont destinées à l
la gestion des billets du forum. */
class Billets_forumController extends __BaseController
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

        //vérification des champs necessaires pour la création d'un billet        
        if(true !== $this->checker->inField('id_filiere','id_utilisateur','sujet','contenu')) {
            $this->_return('Veuillez remplir tous les champs du formulaire prefixés de  * ', false);
        }

        try
        {
            //conversion des données reçu par post
            $billet['id_filiere'] = (int)$data['id_filiere'];
            $billet['id_utilisateur'] = (int)$data['id_utilisateur'];
            $billet['sujet'] = (string)$data['sujet'];
            $billet['contenu'] = (string)$data['contenu'];
            $billet['date_publication'] = date('Y-m-d H:i:s');
            $billet['statut_existant'] = 1;

            if(true !== $this->model->exist('id_utilisateur', $data['id_utilisateur'], 'Utilisateurs')) {
                $this->_return('l\'utilisateur spécifié pour ce billet n\'existe pas', false);
            }

            if(true !== $this->model->exist('id_filiere', $data['id_filiere'], 'Filieres')) {
                $this->_return('la filière spécifiée pour ce billet n\'existe pas', false);
            }

            //si le sujet du billet existe déja en base de donnée
            if(true === $this->model->exist('sujet', $billet['sujet'], 'Billets_forum')) {
                $results = $this->model->read_billet_sujet($billet['sujet']);
                if (!empty($results)) {
                    $this->_return('ce sujet existe déja, veillez changer l\'intituler du sujet', false);
                }           
            }

            $id_billet = $this->model->create($billet);
            $this->_return('sujet crée avec succès!!',true, $id_billet);          
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
            //selection d'un billet en foction de l'identifiant
            if (!empty($data['id_billet'])) {
                $results = $this->model->read_billet_id((int)$data['id_billet']);

                if (empty($results)) {
                    $this->_return('Le billet demandé n\'existe pas dans la base de donnée', false);
                }
                $this->_return('Informations sur le billet ', true, $results);
            }

            //selection d'un billet en foction de l'identifiant de la filiere
            if (!empty($data['id_filiere'])) {
                $results = $this->model->read_billet_filiere_id((int)$data['id_filiere']);

                if (empty($results)) {
                    $this->_return('pas de billet pour cette filière dans la base de donnée', false);
                }
                $this->_return('Informations sur le billet ', true, $results);
            }

            //selection d'un billet en foction du sujet du centre
            if (!empty($data['sujet'])) {
                $results = $this->model->read_billet_sujet((string)$data['sujet']);

                if (empty($results)) {
                    $this->_return('Le billet demandé n\'existe pas dans la base de donnée', false);
                }
                $this->_return('Informations sur le billet  ', true, $results);
            }
            
            //selection d'un billet en foction de l'utilisateur du centre
            if (!empty($data['id_utilisateur'])) {
                $results = $this->model->read_billet_utilisateur_id((int)$data['id_utilisateur']);

                if (empty($results)) {
                    $this->_return('cet utilisateur n\'a pas de billet dans la base de donnée', false);
                }
                $this->_return('liste des billets de l\'utilisateur', true, $results);
            }

            //selection de tous les centres d'enseignement
            $results = $this->model->read_all_billet();
            if (empty($results)) {
                $this->_return('Vous n\'avez pas encore de billet en base de données', false);
            }
            $this->_return('liste des billets disponible dans la base de données', true, $results);
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

        //vérification des champs necessaires pour la création d'un billet        
        if(true !== $this->checker->inField('id_billet','id_filiere','id_utilisateur','sujet','contenu','date_publication')) {
            $this->_return('Veuillez remplir tous les champs du formulaire prefixés de  * ', false);
        }

        try
        {
            //conversion des données reçu par post
            $billet['id_billet'] = (int)$data['id_billet'];
            $billet['id_filiere'] = (int)$data['id_filiere'];
            $billet['id_utilisateur'] = (int)$data['id_utilisateur'];
            $billet['sujet'] = (string)$data['sujet'];
            $billet['contenu'] = (string)$data['contenu'];
            $billet['date_publication'] = (string)$data['date_publication'];
            $billet['statut_existant'] = 1;

            if(true !== $this->model->exist('id_utilisateur', $data['id_utilisateur'], 'Utilisateurs')) {
                $this->_return('l\'utilisateur spécifié pour ce billet n\'existe pas', false);
            }

            if(true !== $this->model->exist('id_filiere', $data['id_filiere'], 'Filieres')) {
                $this->_return('la filière spécifiée pour ce billet n\'existe pas', false);
            }

            //si le sujet du billet existe déja en base de donnée
            if(true === $this->model->exist('sujet', $billet['sujet'], 'Billets_forum')) {
                $results = $this->model->read_billet_sujet($billet['sujet']);
                if (!empty($results) && $results->id_billet != $billet['id_billet']) {
                    $this->_return('ce sujet existe déja, veillez changer l\'intituler du sujet', false);
                }           
            }

            $this->model->edit_billet($billet['id_billet'], $billet);
            $this->_return('sujet édité avec succès!!',true);          
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
        $id_billet = (int)$data['id_billet'] ?? null;

        if (empty($id_billet)) {
            $this->_return('Veillez spécifier l\'identifiant du billet à supprimer', false);
        }

        try {
            $this->model->remove($id_billet);
            $this->_return('billet supprimé avec succès', true);
            //code...
        } 
        catch (Exception $e)
        {
            $this->_exception($e);
        }
    }


    /**
     * Renvoi le nombre de commentaire d'un billet
     * 
     * @param int $id_billet
     * @author Dimitri
     */
    public function nbrcommentaire($id_billet)
    {
        $nbr = $this->model->nbrcommentaire($id_billet);
        $this->_return('', true, $nbr);
    }

}