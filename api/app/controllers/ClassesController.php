<?php

use dFramework\core\data\Request;

require_once __DIR__.DS.'__BaseController.php';

/* controlleur de la classe gérant les classes. toutes les methodes s'y trouvant sont destinées à l
la gestion des salles de classes. */
class ClassesController extends __BaseController
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
        if(true !== $this->checker->inField('id_centre','id_filiere','id_niveau','nom_classe','code_classe')) {
            $this->_return('Veuillez remplir tous les champs du formulaire prefixés de  * ', false);
        }

        //Vérification de la longeur du code de la filiere
        if(true !== $this->checker->min_length('code_classe', 2)) {
            $this->_return('Le code de la classe doit avoir au moins 2 caracteres', false);
        }

        //verification de l'idenntifiant de la filiere
        if(true === $this->model->exist('id_filiere', (int)$data['id_filiere'], 'Filieres')) {
            $this->_return('cette filiere n\'existe pas', false);
        }
        
        //verification de l'idenntifiant du centre
        if(true === $this->model->exist('id_centre', (int)$data['id_centre'], 'Centres')) {
            $this->_return('ce centre n\'existe pas', false);
        }
        
        //verification de l'idenntifiant du niveau
        if(true === $this->model->exist('id_niveau', (int)$data['id_niveau'], 'Niveaux')) {
            $this->_return('ce niveau n\'existe pas', false);
        }

        try
        {
            //conversion des données reçu par post
            $classes['id_niveau'] = (int)$data['id_niveau'];
            $classes['id_centre'] = (int)$data['id_centre'];
            $classes['id_filiere'] = (int)$data['id_filiere'];
            $classes['nom_classe'] = (string)$data['nom_classe'];
            $classes['code_classe'] = (string)$data['code_classe'];
            $classes['statut_existant'] = 1;

            $can_create_id_niveau = false;
            $can_create_id_centre = false;
            $can_create_id_filiere = false;
            $can_create_code = false;
            $can_create_nom = false;
            $can_create_id = 0;

            //si le code de la classe existe déja en base de donnée
            if(true === $this->model->exist('code_classe', $classes['code_classe'], 'Classes')) {
                $results = $this->model->read_with_code_classe($classes['code_classe']);
                if (!empty($results)) {
                    $this->_return('Une classe possede déja ce code', false);
                }               
                $can_create_code = true;       
            }
            //si le nom dela classe existe déja en base de donnée
            if(true === $this->model->exist('nom_classe', $classes['nom_classe'], 'Classes')) {
                $results = $this->model->read_with_nom_classe($classes['nom_classe']);
                if (!empty($results)) {
                    $this->_return('Une classe possede déja ce nom', false);
                }
                $can_create_id_niveau = $results->id_niveau == $classes['id_niveau'];
                $can_create_id_centre = $results->id_centre == $classes['id_centre'];
                $can_create_id_filiere = $results->id_filiere == $classes['id_filiere'];
                $can_create_id = $results->id_classe;
                $can_create_nom = true;            
            }

            if($can_create_nom && $can_create_code && $can_create_id_niveau && $can_create_id_centre && $can_create_id_filiere)
            {
                $this->model->edit_with_id_classe($can_create_id, $classes);
                $this->_return('classe créee avec succès!!',true);
            }

            //Aucune des informations n'existe deja en base de donnée
            $this->model->create($classes);
            $this->_return('classe créee avec succès!!',true);          
        }
        catch(Exception $e)
        {
            $this->_exception($e);
        }
    }

    /* retourne toutes les information avec precision sur une classe ou sur toutes les classes */
    public function readAllInfo()
    {
        //recupération des données en post
        $data = $this->request->data;
        try
        {
            //selection d'une filiere en foction de l'identifiant
            if (!empty($data['id_classe'])) {
                $results = $this->model->read_all_info_id((int)$data['id_classe']);

                if (empty($results)) {
                    $this->_return('La classe demandé n\'existe pas dans la base de donnée', false);
                }
                $this->_return('Informations sur la classe  '.$results->nom_classe.' ', true, $results);
            }
            //selection de toutes les classes d'enseignement
            $results = $this->model->read_all_info_classe();
            if (empty($results)) {
                $this->_return('Vous n\'avez pas encore de classe en base de données', false);
            }
            $this->_return('liste des classes disponibles dans la base de données', true, $results);
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
            if (!empty($data['id_classe'])) {
                $results = $this->model->read_with_id_classe((int)$data['id_classe']);

                if (empty($results)) {
                    $this->_return('La classe demandé n\'existe pas dans la base de donnée', false);
                }
                $this->_return('Informations sur la classe  '.$results->nom_classe.' ', true, $results);
            }

            //selection d'une classe en foction du code de la classe
            if (!empty($data['code_classe'])) {
                $results = $this->model->read_with_code_classe((string)$data['code_classe']);

                if (empty($results)) {
                    $this->_return('La classe demandé n\'existe pas dans la base de donnée', false);
                }
                $this->_return('Informations sur la classe  '.$results->nom_classe.' ', true, $results);
            }
            
            //selection d'une classe en foction du nom de la classe
            if (!empty($data['nom_classe'])) {
                $results = $this->model->read_with_nom_classe((int)$data['nom_classe']);

                if (empty($results)) {
                    $this->_return('La classe demandé n\'existe pas dans la base de donnée', false);
                }
                $this->_return('Informations sur la classe  '.$results->nom_classe.' ', true, $results);
            }

            //selection d'une classe en d'un centre
            if (!empty($data['id_centre'])) {
                $results = $this->model->read_with_id_centre((int)$data['id_centre']);

                if (empty($results)) {
                    $this->_return('pas de classe dans la base de donnée pour ce centre', false);
                }
                $this->_return('liste des classe du centre', true, $results);
            }

            //selection d'une classe d'une filiere
            if (!empty($data['id_filiere'])) {
                $results = $this->model->read_with_id_filiere((int)$data['id_filiere']);

                if (empty($results)) {
                    $this->_return('pas de classe dans la base de donnée pour cette filiere', false);
                }
                $this->_return('liste des classe de la filiere ', true, $results);
            }

            //selection d'une classe d'un niveau
            if (!empty($data['id_niveau'])) {
                $results = $this->model->read_with_id_niveau((int)$data['id_niveau']);

                if (empty($results)) {
                    $this->_return('La classe demandé n\'existe pas dans la base de donnée', false);
                }
                $this->_return('liste des classe du niveau ', true, $results);
            }
            //selection de toutes les classes d'enseignement
            $results = $this->model->read_all();
            if (empty($results)) {
                $this->_return('Vous n\'avez pas encore de classe en base de données', false);
            }
            $this->_return('liste des classes disponibles dans la base de données', true, $results);
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
        if(true !== $this->checker->inField('id_classe','id_centre','id_filiere','id_niveau','nom_classe','code_classe')) {
            $this->_return('Veuillez remplir tous les champs du formulaire prefixés de  * ', false);
        }

        //Vérification de la longeur du code de la classe
        if(true !== $this->checker->min_length('code_classe', 2)) {
            $this->_return('Le code de la classe doit avoir au moins 2 caracteres', false);
        }

        //verification de l'idenntifiant de la filiere
        if(true === $this->model->exist('id_filiere', (int)$data['id_filiere'], 'Filieres')) {
            $this->_return('cette filiere n\'existe pas', false);
        }
        
        //verification de l'idenntifiant du centre
        if(true === $this->model->exist('id_centre', (int)$data['id_centre'], 'Centres')) {
            $this->_return('ce centre n\'existe pas', false);
        }
        
        //verification de l'idenntifiant du niveau
        if(true === $this->model->exist('id_niveau', (int)$data['id_niveau'], 'Niveaux')) {
            $this->_return('ce niveau n\'existe pas', false);
        }

        //verification de l'idenntifiant du niveau
        if(true === $this->model->exist('id_classe', (int)$data['id_classe'], 'Classes')) {
            $this->_return('ce niveau n\'existe pas', false);
        }

        try
        {
            //conversion des données reçu par post
            $classes['id_classe'] = (int)$data['id_classe'];
            $classes['id_niveau'] = (int)$data['id_niveau'];
            $classes['id_centre'] = (int)$data['id_centre'];
            $classes['id_filiere'] = (int)$data['id_filiere'];
            $classes['nom_classe'] = (string)$data['nom_classe'];
            $classes['code_classe'] = (string)$data['code_classe'];
            $classes['statut_existant'] = 1;

            //si le code de la filiere existe déja en base de donnée
            if(true === $this->model->exist('code_classe', $classes['code_classe'], 'Classes')) {
                $results = $this->model->read_with_code_classe($classes['code_classe']);
                if (!empty($results) && ($results->id_classe != $classes['id_classe'])) {
                    $this->_return('Une classe possede déja ce code', false);
                }             
            }
            //si le nom de la filiere existe déja en base de donnée
            if(true === $this->model->exist('nom_classe', $classes['nom_classe'], 'Classes')) {
                $results = $this->model->read_with_nom_classe($classes['nom_classe']);
                if (!empty($results) && ($results->id_classe != $classes['id_classe'])) {
                    $this->_return('Une classe possede déja ce nom', false);
                }           
            }

            //Aucune des informations n'existe deja en base de donnée
            $this->model->edit_with_id_classe($classes['id_classe'], $classes);
            $this->_return('classe modifiée avec succès!!',true);
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
        $id_classe = (int)$data['id_classe'] ?? null;
        if (empty($id_classe)) {
            $this->_return('Veillez spécifier l\'identifiant de la classe à supprimer', false);
        }

        try {
            $this->model->remove($id_classe);
            $this->_return('classe supprimée avec succès', true);
            //code...
        } 
        catch (Exception $e)
        {
            $this->_exception($e);
        }
    }


}