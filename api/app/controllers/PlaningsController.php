<?php

use dFramework\core\data\Request;

require_once __DIR__.DS.'__BaseController.php';

/* controlleur de la classe gérant les planings d'enseignement. toutes les methodes s'y trouvant sont destinées à l
la gestion des emploi de temps. */
class PlaningsController extends __BaseController
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

    /* fonction de creation d'un planing  */
    public function create()
    {
        //recupération des données en post
        $data = $this->request->data;

        //librerie de validation des champs
        $this->loadLibrary('checker');
        $this->checker->useInputField(true, $data);

        //vérification des champs necessaires pour la création de l'unité d'enseignement        
        if(true !== $this->checker->inField('id_matiere','id_tranche','id_classe','id_utilisateur', 'date_jour')) {
            $this->_return('Veuillez remplir tous les champs du formulaire prefixés de  * ', false);
        }

        try {

            if (true !== $this->model->exist('id_utilisateur', (int)$data['id_utilisateur'], 'Utilisateurs')) {
                $this->_return('l\'utilisateur spécifié n\existe pas. ', false);
            }
            if (true !== $this->model->exist('id_utilisateur', (int)$data['id_utilisateur'], 'Professeurs')) {
                $this->_return('l\'utilisateur spécifié n\'est pas un professeur', false);
            }
            if (true !== $this->model->exist('id_classe', (int)$data['id_classe'], 'Classes')) {
                $this->_return('la classe spécifiée n\existe pas. ', false);
            }
            if (true !== $this->model->exist('id_matiere', (int)$data['id_matiere'], 'Matieres')) {
                $this->_return('la matière spécifiée n\existe pas. ', false);
            }
            if (true !== $this->model->exist('id_tranche', (int)$data['id_tranche'], 'Tranches_horaires')) {
                $this->_return('la tranche horaire spécifiée n\existe pas. ', false);
            }

           //conversion des données reçu par post
           $planing['id_matiere'] = (int)$data['id_matiere'];
           $planing['id_tranche'] = (int)$data['id_tranche'];
           $planing['id_classe'] = (int)$data['id_classe'];
           $planing['id_utilisateur'] = (int)$data['id_utilisateur'];
           $planing['date_jour'] = (string)$data['date_jour'];
           $planing['statut_existant'] = 1;  
           
           if(true === $this->model->exist_classe_tranche($planing['id_classe'], $planing['id_tranche'], $planing['date_jour']))
           {
                 $this->_return('cette classe a déja un cours programmer à cette heure', false);
           }

           if(true === $this->model->exist_professeurs_tranche($planing['id_utilisateur'], $planing['id_tranche'], $planing['date_jour']))
           {
                 $this->_return('ce professeur a déja été programmer a cette heure dans une autre salle de classe', false);
           }

            //Aucune des informations n'existe deja en base de donnée
            $this->model->create($planing);
            $this->_return('Cours programmé avec succès!!',true);
           
            //code...
        } catch (Exception $e) {
            $this->_exception($e);
        }
    }

    /* retourne toutes les information avec precision sur une UE ou sur toutes les UE */
    public function readAllInfo()
    {
        //recupération des données en post
        $data = $this->request->data;
        try
        {
            //selection d'une UE en foction de l'identifiant
            if (!empty($data['id_matiere'])) {
                $results = $this->model->read_all_info_id((int)$data['id_matiere']);

                if (empty($results)) {
                    $this->_return('la matière demandée n\'existe pas dans la base de donnée', false);
                }
                $this->_return('Informations sur la matière  '.$results->nom_matiere.' ', true, $results);
            }
            //selection de toutes les UE d'enseignement
            $results = $this->model->read_all_info_matiere();
            if (empty($results)) {
                $this->_return('Vous n\'avez pas encore de matière en base de données', false);
            }
            $this->_return('liste des matières disponibles dans la base de données', true, $results);
        }
        catch(Exception $e)
        {
            $this->_exception($e);
        }
    }

    /* fonction de selection des informations concernant une ou plusieurs matieres
    la selection peut se faire en fonction du nom, de la matiere, de la reference ou de l'identifiant de la matiere */
    public function read()
    {
        //recupération des données en post
        $data = $this->request->data;
        
        try {

            //selection d'une matiere à partir de son identifiant
            if (!empty($data['id_planing'])) {
                $results = $this->model->read_with_id((int)$data['id_planing']);

                if (empty($results)) {
                    $this->_return('Le planing demandé n\'existe pas dans la base de donnée', false);
                }
                $this->_return('Informations sur le planing ', true, $results);
            }

             //selection d'une matiere à partir du nom
            if (!empty($data['id_matiere'])) {
                $results = $this->model->read_with_id_matiere((int)$data['id_matiere']);

                if (empty($results)) {
                    $this->_return('aucun planing ne correspond a cette matière', false);
                }
                $this->_return('planing de la matière', true, $results);
            }

            //selection d'une matiere à partir de sa réference
            if (!empty($data['id_tranche'])) {
                $results = $this->model->read_with_id_tranche((int)$data['id_tranche']);

                if (empty($results)) {
                    $this->_return('pas de planing pour cette tranche horaire', false);
                }
                $this->_return('liste des planings pour cette tranche horaire ', true, $results);
            }

            //selection des matieres d'une unité d'enseignement
            if (!empty($data['id_classe'])) {
                $results = $this->model->read_with_id_classe((int)$data['id_classe']);

                if (empty($results)) {
                    $this->_return('pas de planing pour cette classe actuellement', false);
                }
                $this->_return('programme de la classe ', true, $results);
            }

            //selection des matieres d'une unité d'enseignement
            if (!empty($data['id_utilisateur'])) {
                $results = $this->model->read_with_id_utilisateur((int)$data['id_utilisateur']);

                if (empty($results)) {
                    $this->_return('cet utilisateur n\'est pas programmer', false);
                }
                $this->_return('programme du professeur', true, $results);
            }

            //selection des matieres d'une unité d'enseignement
            if (!empty($data['date_jour'])) {
                $results = $this->model->read_with_date_jour((string)$data['date_jour']);

                if (empty($results)) {
                    $this->_return('rien n\'est prevu pour cette journée', false);
                }
                $this->_return('programme de la journée', true, $results);
            }

            //selection de toutes les matieres
            $results = $this->model->read_all();
            if (empty($results)) {
                $this->_return('rien n\'est prevu pour le moment', false);
            }
            $this->_return('programme actuel', true, $results);
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
        if(true !== $this->checker->inField('id_matiere','id_tranche','id_classe','id_utilisateur', 'date_jour')) {
            $this->_return('Veuillez remplir tous les champs du formulaire prefixés de  * ', false);
        }

        try {

            if (true !== $this->model->exist('id_utilisateur', (int)$data['id_utilisateur'], 'Utilisateurs')) {
                $this->_return('l\'utilisateur spécifié n\existe pas. ', false);
            }
            if (true !== $this->model->exist('id_utilisateur', (int)$data['id_utilisateur'], 'Professeurs')) {
                $this->_return('l\'utilisateur spécifié n\'est pas un professeur', false);
            }
            if (true !== $this->model->exist('id_planing', (int)$data['id_planing'], 'Planings')) {
                $this->_return('la classe spécifiée n\existe pas. ', false);
            }
            if (true !== $this->model->exist('id_classe', (int)$data['id_classe'], 'Classes')) {
                $this->_return('la classe spécifiée n\existe pas. ', false);
            }
            if (true !== $this->model->exist('id_matiere', (int)$data['id_matiere'], 'Matieres')) {
                $this->_return('la matière spécifiée n\existe pas. ', false);
            }
            if (true !== $this->model->exist('id_tranche', (int)$data['id_tranche'], 'Tranches_horaires')) {
                $this->_return('la tranche horaire spécifiée n\existe pas. ', false);
            }

           //conversion des données reçu par post
           $planing['id_planing'] = (int)$data['id_planing'];
           $planing['id_matiere'] = (int)$data['id_matiere'];
           $planing['id_tranche'] = (int)$data['id_tranche'];
           $planing['id_classe'] = (int)$data['id_classe'];
           $planing['id_utilisateur'] = (int)$data['id_utilisateur'];
           $planing['date_jour'] = (string)$data['date_jour'];
           $planing['statut_existant'] = 1;  
           
           if(true === $this->model->exist_classe_tranche($planing['id_classe'], $planing['id_tranche'], $planing['date_jour']))
           {
                 $this->_return('cette classe a déja un cours programmer à cette heure', false);
           }

           if(true === $this->model->exist_professeurs_tranche($planing['id_utilisateur'], $planing['id_tranche'], $planing['date_jour']))
           {
                 $this->_return('ce professeur a déja été programmer a cette heure dans une autre salle de classe', false);
           }

            //Aucune des informations n'existe deja en base de donnée
            $this->model->edit_with_id($planing['id_planing'], $planing);
            $this->_return('Cours programmé avec succès!!',true);
           
            //code...
        } catch (Exception $e) {
            $this->_exception($e);
        }
    }

    /* suppression d'une matiere 
    le parametre necessaire est l'identifiant du planing */
    public function delete()
    {
        //recuperation des informations pour la suppression d'une matière
        $data = $this->request->data;
        $id_planing = (int)$data['id_planing'] ?? null;
        
        if (empty($id_planing)) {
            $this->_return('Veillez spécifier l\'identifiant du programme à supprimer', false);
        }

        if (true === $this->model->exist('id_planing', (int)$data['id_planing'], 'Presences')) {
            $this->_return('impossible de supprimer ce planing car il comporte encore des presences ', false);
        }

        try {
            $this->model->remove($id_planing);
            $this->_return('La matière a étè supprimer avec succès', true);
            //code...
        } catch (Exception $e) {
            $this->_exception($e);
        }
    }
}