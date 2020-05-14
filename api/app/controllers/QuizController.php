<?php

use dFramework\core\data\Request;

require_once __DIR__ . DS . '__BaseController.php';

/* controlleur de la classe gérant les centres. toutes les methodes s'y trouvant sont destinées à l
la gestion des Quiz. */
class QuizController extends __BaseController
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
        if (true !== $this->checker->inField('id_examen', 'question')) {
            $this->_return('Veuillez remplir tous les champs du formulaire prefixés de  * ', false);
        }

        try {

            if (true !== $this->model->exist('id_examen', (int)$data['id_examen'], 'Examens')) {
                $this->_return('l\'examen spécifié n\'existe pas ', false);
            }
    
            //conversion des données reçu par post
            $quiz['id_examen'] = (int)$data['id_examen'];
            $quiz['question'] = (string)$data['question'];

            //Aucune des informations n'existe deja en base de donnée
            $this->model->create($quiz);
            $this->_return('Question ajoutée avec succès!!', true);
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
            if (!empty($data['id_quiz'])) {
                $results = $this->model->read_with_id_quiz((int)$data['id_quiz']);

                if (empty($results)) {
                    $this->_return('La question demandé n\'existe pas dans la base de donnée', false);
                }
                $this->_return('Informations sur la question ', true, $results);
            }

            //selection d'un centre en foction du code du centre
            if (!empty($data['id_examen'])) {
                $results = $this->model->read_with_id_examen((int)$data['id_examen']);

                if (empty($results)) {
                    $this->_return('il y a aucune question pour cet examen', false);
                }
                $this->_return('liste des questions de l\'examen ', true, $results);
            }

            //selection de tous les centres d'enseignement
            $results = $this->model->read_all();
            if (empty($results)) {
                $this->_return('Vous n\'avez pas encore de question en base de données', false);
            }
            $this->_return('liste des questions disponibles dans la base de données', true, $results);
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
        if (true !== $this->checker->inField('id_examen', 'question','id_quiz')) {
            $this->_return('Veuillez remplir tous les champs du formulaire prefixés de  * ', false);
        }

        try {
            
            if (true !== $this->model->exist('id_examen', (int)$data['id_examen'], 'Examens')) {
                $this->_return('l\'examen spécifié n\'existe pas ', false);
            }
            if (true !== $this->model->exist('id_quiz', (int)$data['id_quiz'], 'Quiz')) {
                $this->_return('la question spécifié n\'existe pas ', false);
            }

            //conversion des données reçu par post
            $quiz['id_quiz'] = (int)$data['id_quiz'];
            $quiz['id_examen'] = (int)$data['id_examen'];
            $quiz['question'] = (string)$data['question'];

            //Aucune des informations n'existe deja en base de donnée
            $this->model->edit_with_id($quiz['id_quiz'], $quiz);
            $this->_return('Question Editée avec succès!!', true);
        } catch (Exception $e) {
            $this->_exception($e);
        }
    }

    /* suppression d'un centre */
    public function delete()
    {
        //recuperation des informations pour la suppression d'un centre
        $data = $this->request->data;
        $id_quiz = (int)$data['id_quiz'] ?? null;
        if (empty($id_quiz)) {
            $this->_return('Veillez spécifier l\'identifiant de la question à supprimer', false);
        }

        if (true === $this->model->exist('id_quiz', (int)$data['id_quiz'], 'Propositions_reponses')) {
            $this->_return('Impossible de supprimer la question car des proposition de réponse à cette question existe encore ', false);
        }

        try {
            $this->model->remove($id_quiz);
            $this->_return('Question supprimé avec succès', true);
            //code...
        } catch (Exception $e) {
            $this->_exception($e);
        }
    }
}