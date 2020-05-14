<?php

use dFramework\core\data\Request;

require_once __DIR__ . DS . '__BaseController.php';

/* controlleur de la classe gérant les centres. toutes les methodes s'y trouvant sont destinées à l
la gestion des centres. */
class ExamensContoller extends __BaseController
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
        if (true !== $this->checker->inField('duree', 'description','id_type_examen','id_utilisateur','id_matiere')) {
            $this->_return('Veuillez remplir tous les champs du formulaire prefixés de  * ', false);
        }

        if (true !== $this->model->exist('id_type_examen', (int)$data['id_type_examen'], 'Types_examens')) {
            $this->_return('Le type d\'examen spécifié n\'existe pas  ', false);
        }
        if (true !== $this->model->exist('id_matiere', (int)$data['id_matiere'], 'Matieres')) {
            $this->_return('la matière spécifiée n\'existe pas ', false);
        }
        if (true !== $this->model->exist('id_utilisateur', (int)$data['id_utilisateur'], 'Professeurs')) {
            $this->_return('le professeur spécifié n\'existe pas ', false);
        }

        try {
            //conversion des données reçu par post
            $examens['id_type_examen'] = (int)$data['id_type_examen'];
            $examens['id_utilisateur'] = (int)$data['id_utilisateur'];
            $examens['id_matiere'] = (int)$data['id_matiere'];
            $examens['duree'] = (int)$data['duree'];
            $examens['pts_juste'] = (int)$data['pts_juste'];
            $examens['pts_faux'] = (int)$data['pts_faux'];
            $examens['pts_aucun'] = (int)$data['pts_aucun'];
            $examens['description'] = (string)$data['description'];
            $examens['statut_existant'] = 1;

            //Aucune des informations n'existe deja en base de donnée
            $this->model->create($examens);
            $this->_return('Examen crée avec succès!!', true);
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
            if (!empty($data['id_examen'])) {
                $results = $this->model->read_with_id_examen((int)$data['id_examen']);

                if (empty($results)) {
                    $this->_return('L\'examen demandé n\'existe pas dans la base de donnée', false);
                }
                $this->_return('Informations sur l\'examen ', true, $results);
            }

            //selection d'un centre en foction du code du centre
            if (!empty($data['id_type_examen'])) {
                $results = $this->model->read_with_id_type_examen((int)$data['id_type_examen']);

                if (empty($results)) {
                    $this->_return('Aucun examen pour ce type d\'examen en base de données', false);
                }
                $this->_return('liste des examens du type spécifié ', true, $results);
            }

            //selection d'un centre en foction du code du centre
            if (!empty($data['id_matiere'])) {
                $results = $this->model->read_with_id_matiere((int)$data['id_matiere']);

                if (empty($results)) {
                    $this->_return('pas encore d\'examen pour cette matière', false);
                }
                $this->_return('liste des examens de la matière ', true, $results);
            }

            //selection d'un centre en foction du code du centre
            if (!empty($data['id_utilisateur'])) {
                $results = $this->model->read_with_id_utilisateur((int)$data['id_utilisateur']);

                if (empty($results)) {
                    $this->_return('Ce professeur n\'a encore créer aucun examen', false);
                }
                $this->_return('liste des examens du professeur ', true, $results);
            }

            //selection de tous les centres d'enseignement
            $results = $this->model->read_all();
            if (empty($results)) {
                $this->_return('Vous n\'avez pas encore d\'examen en base de données', false);
            }
            $this->_return('liste des examens disponibles dans la base de données', true, $results);
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
        if (true !== $this->checker->inField('id_type_examen','id_matiere','id_utilisateur','duree', 'description','id_examen')) {
            $this->_return('Veuillez remplir tous les champs du formulaire prefixés de  * ', false);
        }

        if (true !== $this->model->exist('id_type_examen', (int)$data['id_type_examen'], 'Types_examens')) {
            $this->_return('Le type d\'examen spécifié n\'existe pas  ', false);
        }
        if (true !== $this->model->exist('id_matiere', (int)$data['id_matiere'], 'Matieres')) {
            $this->_return('la matière spécifiée n\'existe pas ', false);
        }
        if (true !== $this->model->exist('id_utilisateur', (int)$data['id_utilisateur'], 'Professeurs')) {
            $this->_return('le professeur spécifié n\'existe pas ', false);
        }
        if (true !== $this->model->exist('id_examen', (int)$data['id_examen'], 'Examens')) {
            $this->_return('l\'examen spécifié n\'existe pas ', false);
        }

        try {
            //conversion des données reçu par post
            $examens['id_examen'] = (int)$data['id_examen'];
            $examens['id_type_examen'] = (int)$data['id_type_examen'];
            $examens['id_utilisateur'] = (int)$data['id_utilisateur'];
            $examens['id_matiere'] = (int)$data['id_matiere'];
            $examens['duree'] = (int)$data['duree'];
            $examens['pts_juste'] = (int)$data['pts_juste'];
            $examens['pts_faux'] = (int)$data['pts_faux'];
            $examens['pts_aucun'] = (int)$data['pts_aucun'];
            $examens['description'] = (string)$data['description'];
            $examens['statut_existant'] = 1;

            //Aucune des informations n'existe deja en base de donnée
            $this->model->edit_with_id($examens['id_examen'], $examens);
            $this->_return('Examen edité avec succès!!', true);
        } catch (Exception $e) {
            $this->_exception($e);
        }
    }

    /* suppression d'un centre */
    public function delete()
    {
        //recuperation des informations pour la suppression d'un centre
        $data = $this->request->data;
        $id_examen = (int)$data['id_examen'] ?? null;

        if (empty($id_examen)) {
            $this->_return('Veillez spécifier l\'identifiant de l\'examen à supprimer', false);
        }
        
        if (true === $this->model->exist('id_examen', (int)$data['id_examen'], 'Evaluations')) {
            $this->_return('impossible de supprimer cet examen car il est encore associé à une evaluation  ', false);
        }
        if (true === $this->model->exist('id_examen', (int)$data['id_examen'], 'Quiz')) {
            $this->_return('impossible de supprimer cet examen car il est encore associé à un quiz ', false);
        }
        if (true === $this->model->exist('id_examen', (int)$data['id_examen'], 'Programmes_examens')) {
            $this->_return('impossible de supprimer cet examen car il est encore programmé  ', false);
        }

        try {
            $this->model->remove($id_examen);
            $this->_return('Examen supprimé avec succès', true);
            //code...
        } catch (Exception $e) {
            $this->_exception($e);
        }
    }
}