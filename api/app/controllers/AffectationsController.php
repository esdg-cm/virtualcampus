<?php

use dFramework\core\data\Request;

require_once __DIR__ . DS . '__BaseController.php';

/* controlleur de la classe gérant les centres. toutes les methodes s'y trouvant sont destinées à l
la gestion des centres. */

class AffectationsController extends __BaseController
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
        if (true !== $this->checker->inField('id_classe', 'id_matiere', 'id_utilisateur')) {
            $this->_return('Veuillez remplir tous les champs du formulaire prefixés de  * ', false);
        }

        try {
            //conversion des données reçu par post
            $affectation['id_classe'] = (int)$data['id_classe'];
            $affectation['id_matiere'] = (int)$data['id_matiere'];
            $affectation['id_utilisateur'] = (int)$data['id_utilisateur'];
            $affectation['date_affectation'] = date('Y-m-d H:i;s');
            $affectation['statut_existant'] = 1;

            //si le nom du centre existe déja en base de donnée
            if (true !== $this->model->exist('id_classe', $affectation['id_classe'], 'Classes')) {
                $this->_return('cette classe n\{existe pas', false);
            }
            //si le nom du centre existe déja en base de donnée
            if (true !== $this->model->exist('id_matiere', $affectation['id_matiere'], 'Matieres')) {
                $this->_return('cette matière n\{existe pas', false);
            }
            //si le nom du centre existe déja en base de donnée
            if (true !== $this->model->exist('id_utilisateur', $affectation['id_utilisateur'], 'Utilisateurs')) {
                $this->_return('cet utilisateur n\{existe pas', false);
            }

            $results = $this->model->read_with_id_matiere_classe($affectation['id_matiere'], $affectation['id_classe']);
            if (!empty($results)) {
                $this->_return('pour cette matiere nous avons deja une affectation dans la classe spécifiée', false);
            }
            //Aucune des informations n'existe deja en base de donnée
            $this->model->create($affectation);
            $this->_return('Affectation créée avec succès!!', true);
        } catch (Exception $e) {
            $this->_exception($e);
        }
    }


    public function readAffectationClasseMatiere()
    {
        //recupération des données en post
        $data = $this->request->data;

        //librerie de validation des champs
        $this->loadLibrary('checker');
        $this->checker->useInputField(true, $data);

        //vérification des champs necessaires pour la création d'un centre        
        if (true !== $this->checker->inField('id_classe', 'id_matiere')) {
            $this->_return('la matiere et la classe sont obligatoires pour cette fonction * ', false);
        }

        try {
            //si le nom du centre existe déja en base de donnée
            if (true !== $this->model->exist('id_classe', $data['id_classe'], 'Classes')) {
                $this->_return('cette classe n\'existe pas', false);
            }
            //si le nom du centre existe déja en base de donnée
            if (true !== $this->model->exist('id_matiere', $data['id_matiere'], 'Matieres')) {
                $this->_return('cette matière n\{existe pas', false);
            }

            $results = $this->model->read_with_id_matiere_classe($data['id_matiere'], $data['id_classe']);

            if (empty($results)) {
                $this->_return('pas d\'affectation dans cette classe concernant cette matière', false);
            }
            $this->_return('information sur l\'affectations', true, $results);
        } catch (Exception $e) {
            $this->_exception($e);
        }
    }

    /* retoune les affectations */
    public function read()
    {
        //recupération des données en post
        $data = $this->request->data;
        try {
            //selection d'un centre en foction de l'identifiant
            if (!empty($data['id_affectation'])) {
                $results = $this->model->read_with_id((int)$data['id_affectation']);

                if (empty($results)) {
                    $this->_return('cette affectation n\'existe', false);
                }
                $this->_return('liste des affectations', true, $results);
            }

            //selection d'un centre en foction de l'identifiant
            if (!empty($data['id_classe'])) {
                $results = $this->model->read_with_id_classe((int)$data['id_classe']);

                if (empty($results)) {
                    $this->_return('pas d\'affectation pour cette classe', false);
                }
                $this->_return('liste des affectations de la classe ', true, $results);
            }

            //selection d'un centre en foction du code du centre
            if (!empty($data['id_matiere'])) {
                $results = $this->model->read_with_id_matiere((int)$data['id_matiere']);

                if (empty($results)) {
                    $this->_return('pas d\'affecctation pour cette matière', false);
                }
                $this->_return('liste des affectations pour la matière ', true, $results);
            }

            //selection d'un centre en foction du code du centre
            if (!empty($data['id_utilisateur'])) {
                $results = $this->model->read_with_id_utilisateur((int)$data['id_utilisateur']);

                if (empty($results)) {
                    $this->_return('pas d\'affectation pour cet utilisateur', false);
                }
                $this->_return('liste des affectation de l\'utilisateur ', true, $results);
            }

            //selection de tous les centres d'enseignement
            $results = $this->model->read_all();
            if (empty($results)) {
                $this->_return('pas d\'affectation en base de données', false);
            }
            $this->_return('liste des affectations disponibles', true, $results);
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
        if (true !== $this->checker->inField('id_affectation', 'id_classe', 'id_matiere', 'id_utilisateur')) {
            $this->_return('Veuillez remplir tous les champs du formulaire prefixés de  * ', false);
        }

        try {
            //conversion des données reçu par post
            $affectation['id_classe'] = (int)$data['id_classe'];
            $affectation['id_affectation'] = (int)$data['id_affectation'];
            $affectation['id_matiere'] = (int)$data['id_matiere'];
            $affectation['date_affectation'] = date('Y-m-d H:i;s');
            $affectation['id_utilisateur'] = (int)$data['id_utilisateur'];
            $affectation['statut_existant'] = 1;

            //si le nom du centre existe déja en base de donnée
            if (true !== $this->model->exist('id_classe', $affectation['id_classe'], 'Classes')) {
                $this->_return('cette classe n\{existe pas', false);
            }
            //si le nom du centre existe déja en base de donnée
            if (true !== $this->model->exist('id_matiere', $affectation['id_matiere'], 'Matieres')) {
                $this->_return('cette matière n\{existe pas', false);
            }
            //si le nom du centre existe déja en base de donnée
            if (true !== $this->model->exist('id_utilisateur', $affectation['id_utilisateur'], 'Utilisateurs')) {
                $this->_return('cet utilisateur n\{existe pas', false);
            }

            //Aucune des informations n'existe deja en base de donnée
            $this->model->edit_with_id($affectation['id_affectation'], $affectation);
            $this->_return('Affectation éditée avec succès!!', true);
        } catch (Exception $e) {
            $this->_exception($e);
        }
    }

    /* suppression d'un centre */
    public function delete()
    {
        //recuperation des informations pour la suppression d'un centre
        $data = $this->request->data;
        $id_affectation = (int)$data['id_affectation'] ?? null;
        if (empty($id_affectation)) {
            $this->_return('Veillez spécifier l\'identifiant de l\'affectation à supprimer', false);
        }

        try {
            $this->model->remove($id_affectation);
            $this->_return('affectation supprimée avec succès', true);
            //code...
        } catch (Exception $e) {
            $this->_exception($e);
        }
    }


}