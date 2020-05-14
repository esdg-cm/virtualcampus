<?php

use dFramework\core\utilities\Utils;

require_once __DIR__.DS.'__BaseController.php';

class UserController extends __BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->response->type('application/json; charset=UTF-8');
    }

    /**
     * @param null $id_utilisateur
     * @return mixed
     * @throws ReflectionException
     * @throws \dFramework\core\exception\Exception
     * @throws \dFramework\core\exception\LoadException
     */
    public function index($id_utilisateur = null)
    {
        switch (strtolower($this->request->method())) {
            case 'post' : $this->create(); break;
            case 'put' : $this->put(); break;
            case 'delete': $this->delete($id_utilisateur); break;
            default: $this->read($id_utilisateur); break;
        }
    }

    /* retourne la liste des étudiants avec toutes les informations */
    public function readStudent()
    {
        //recupération des données en post
        $data = $this->request->data;
        try {

            if(!empty($data['id_utilisateur']))
            {            
                if(true !== $this->model->exist('id_utilisateur', $data['id_utilisateur'], 'Utilisateurs')) {
                    $this->_return('cet utilisateur n\'existe pas', false);
                }

                if(true === $this->model->exist('id_utilisateur', $data['id_utilisateur'], 'Etudiants')) {
                    $results = $this->model->read_all_information_etudiant_with_id($data['id_utilisateur']);
                    if (empty($results)) {
                        $this->_return('cet etudiant n\'existe pas', false);
                    }
                    $this->_return('information de l\'etudiant', true, $results);
                }

                if(true === $this->model->exist('id_utilisateur', $data['id_utilisateur'], 'Professeurs')) {
                    $this->_return('cet identifiant ne correspond pas à celui d\'un Etudiant.', false);
                }
            }

            $results = $this->model->read_all_information_etudiant();
            if (empty($results)) {
                $this->_return('vous n\'avez pas d\'étudiant en base de données', false);
            }

            $this->_return('liste des étudiants', true, $results);
        } catch (Exception $e) {
            $this->_exception($e);
        }
    }

    /* retourne la liste des professeurs avec toutes les informations */
    public function readTeacher()
    {
        //recupération des données en post
        $data = $this->request->data;

        try
        {

            if(!empty($data['id_utilisateur']))
            {  
                if(true !== $this->model->exist('id_utilisateur', $data['id_utilisateur'], 'Utilisateurs')) {
                    $this->_return('cet utilisateur n\'existe pas', false);
                }

                if(true === $this->model->exist('id_utilisateur', $data['id_utilisateur'], 'Professeurs')) {
                    $results = $this->model->read_all_information_professeur_with_id($data['id_utilisateur']);
                    if (empty($results)) {
                        $this->_return('ce professeur n\'existe pas', false);
                    }
                    $this->_return('information sur le professseur', true, $results);
                }

                if(true === $this->model->exist('id_utilisateur', $data['id_utilisateur'], 'Etudiants')) {
                    $this->_return('cet identifiant ne correspond pas à celui d\'un professeur.', false);
                }
            }

            $results = $this->model->read_all_information_professeur();
            if (empty($results)) {
                $this->_return('vous n\'avez pas de professeur en base de données', false);
            }

            $this->_return('liste des professeurs', true, $results);

        } catch (Exception $e) {
            $this->_exception($e);
        }
    }

    public function readUserProfils()
    {
        //recupération des données en post
        $data = $this->request->data;

        try {

            if(true !== $this->model->exist('id_utilisateur', $data['id_utilisateur'], 'Utilisateurs')) {
                $this->_return('cet utilisateur n\'existe pas', false);
            }

            if(!empty($data['id_utilisateur']))
            {
                $results = $this->model->read_profils_with_id($data['id_utilisateur']);
                if (empty($results)) {
                    $this->_return('ce profils n\'existe pas', false);
                }
                $this->_return('information sur le profils', true, $results);
            }

            $results = $this->model->read_profils();
            $this->_return('information sur les profils disponibles', true, $results);

        } catch (Exception $e) {
            $this->_exception($e);
        }
    }

    /* retourne toutes les innformations soit de l'etudiant soit du professeur */
    public function read()
    {
        //recupération des données en post
        $data = $this->request->data;

        if(empty($data['id_utilisateur'])){
            $this->_return('l\'identifiant de l\'utilisteur est obligatoire', false);
        }

        try
        {
            if(true !== $this->model->exist('id_utilisateur', $data['id_utilisateur'], 'Utilisateurs')) {
                $this->_return('cet utilisateur n\'existe pas', false);
            }
                if(true === $this->model->exist('id_utilisateur', $data['id_utilisateur'], 'Etudiants')) {
                    $results = $this->model->read_all_information_etudiant_with_id($data['id_utilisateur']);
                    if (empty($results)) {
                        $this->_return('cet etudiant n\'existe pas', false);
                    }
                    $this->_return('information de l\'etudiant', true, $results);
                }

                if(true === $this->model->exist('id_utilisateur', $data['id_utilisateur'], 'Professeurs')) {
                    $results = $this->model->read_all_information_professeur_with_id($data['id_utilisateur']);
                    if (empty($results)) {
                        $this->_return('ce professeur n\'existe pas', false);
                    }
                    $this->_return('information sur le professseur', true, $results);
                }

            $this->_return('cet identifiant ne correspond ni à celui d\'un étudiant ni à celui d\'un professeur ', false);

        }
        catch(Exception $e)
        {
            $this->_exception($e);
        }
    }

    public function create()
    {
        //recupération des données en post
        $data = $this->request->data;

        //librerie de validation des champs
        $this->loadLibrary('checker');
        $this->checker->useInputField(true, $data);

        //vérification des champs necessaires pour la création d'un utilisateur
        if(true !== $this->checker->inField('login','mdp','nom','prenom','sexe','type_utilisateur')) {
            $this->_return('Veuillez remplir tous les champs du formulaire prefixés de  * ', false);
        }

        try
        {
            //conversion des données reçu par post
            $user['login'] = (string)$data['login'];
            $user['mdp'] = (string) Utils::hashpass($data['mdp']);
            $profils['nom'] = (string)$data['nom'];
            $profils['prenom'] = (string)$data['prenom'];
            $profils['sexe'] = (string)$data['sexe'];
            $profils['tel'] = (string) ($data['tel'] ?? null);
            $profils['email'] = (string) ($data['email'] ?? null);
            $user['statut_existant'] = 1;

            if (!empty($profils['tel'])) {
                //Vérification du numero de telephone
                if(true !== $this->checker->is_tel('tel')) {
                    $this->_return('ce numero de téléphone n\'est pas valide', false);
                }
            }

            //si le login existe déja en base de donnée
            if(true === $this->model->exist('login', $user['login'], 'Utilisateurs')) {
                $results = $this->model->read_utilisateur_with_login($user['login']);
                if (!empty($results)) {
                    $this->_return('ce login existe déja', false);
                }
            }

            if($data['type_utilisateur'] == "professeur")
            {
                //vérification des champs necessaires pour la création d'un professeur
                if(true !== $this->checker->inField('is_member_de','specialite','titre')) {
                    $this->_return('Veuillez remplir tous les champs du formulaire prefixés de ( * ) , pour un professeur', false);
                }

                $professeur['id_utilisateur'] = (int)$this->model->create_utilisateur($user);
                if($data['is_member_de'] == "oui"){$professeur['is_member_de'] = 1;}else{$professeur['is_member_de'] = 0;}
                $professeur['specialite'] = (string)$data['specialite'];
                $profils['id_utilisateur'] = $professeur['id_utilisateur'];
                $professeur['titre'] = (string)$data['titre'];
                $this->model->create_professeur($professeur);
                $this->model->create_profils($profils);
                $this->_return('votre professeur à étè crée avec succès!!',true);
            }

            if($data['type_utilisateur'] == "etudiant")
            {
                //vérification des champs necessaires pour la création d'un professeur
                if(true !== $this->checker->inField('date_naiss','matricule','lieu_naiss','id_classe')) {
                    $this->_return('Veuillez remplir tous les champs du formulaire prefixés de ( * ) , pour un étudiant', false);
                }

                if(true !== $this->model->exist('id_classe', $data['id_classe'], 'Classes')) {
                    $this->_return('la classe spécifiée pour cet étudiant n\'existe pas', false);
                }

                $etudiant['id_utilisateur'] = (int)$this->model->create_utilisateur($user);
                $profils['id_utilisateur'] = $etudiant['id_utilisateur'];
                $etudiant['date_naiss'] = (string)$data['date_naiss'];
                $etudiant['matricule'] = (string)$data['matricule'];
                $etudiant['lieu_naiss'] = (string)$data['lieu_naiss'];
                $etudiant['id_classe'] = (int)$data['id_classe'];
                $this->model->create_etudiant($etudiant);
                $this->model->create_profils($profils);
                $this->_return('votre étudiant à étè crée avec succès!!',true);
            }

            //Aucune type d'utilisateur ne correspond
            $this->_return('le type d\'utilisateur que vous souhaitez créer n\'est pas reconnu!!',false);
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

        //vérification des champs necessaires pour la création d'un utilisateur
        if(true !== $this->checker->inField('id_utilisateur','login','nom','prenom','sexe','type_utilisateur')) {
            $this->_return('Veuillez remplir tous les champs du formulaire prefixés de  * ', false);
        }

        try
        {
            //conversion des données reçu par post
            $user['login'] = (string)$data['login'];
            $user['id_utilisateur'] = (int)$data['id_utilisateur'];
            $profils['nom'] = (string)$data['nom'];
            $profils['id_utilisateur'] = (int)$data['id_utilisateur'];
            $profils['prenom'] = (string)$data['prenom'];
            $profils['sexe'] = (string)$data['sexe'];
            $profils['tel'] = (string)($data['tel'] ?? null);
            $profils['email'] = (string)($data['email'] ?? null);
            $user['statut_existant'] = 1;
            $resetmdp = " ";            

            if (!empty($profils['tel'])) {
                //Vérification du numero de telephone
                if(true !== $this->checker->is_tel('tel')) {
                    $this->_return('ce numero de téléphone n\'est pas valide', false);
                }
            }

            //si le login existe déja en base de donnée
            if(true === $this->model->exist('login', $user['login'], 'Utilisateurs')) {
                $results = $this->model->read_utilisateur_with_login($user['login']);
                if (!empty($results) && ($results->id_utilisateur != $user['id_utilisateur'])) {
                    $this->_return('ce login existe déja', false);
                }
            }

            //gestion du mot de passe 
            if((!empty($data['ancien_mdp'])) || !empty($data['nouveau_mdp']))
            {
                //vérification des champs necessaires pour la modification d'un utilisateur
                if(true !== $this->checker->inField('nouveau_mdp','ancien_mdp')) {
                    $this->_return('Veuillez spécifier le nouveau mot de passe ', false);
                }

                $results = $this->model->read_utilisateur_with_id($user['id_utilisateur']);
                if (empty($results)) {
                    $this->_return('utilisateur inexistant!! ', false);
                }

                if(Utils::hashpass($data['ancien_mdp']) != $results->mdp)
                {
                    $this->_return('l\'ancien mot de passe renseigné n\'est pas correct', false);
                }
                $user['mdp'] = (string) Utils::hashpass($data['nouveau_mdp']);
            }

            if(!empty($data['reset']) && $data['reset'] == 1)
            {
                $resetmdp = Utils::randomPass(4);
                $user['mdp'] = (string) Utils::hashpass($resetmdp);
            }


            if($data['type_utilisateur'] == "professeur")
            {
                //vérification des champs necessaires pour la création d'un professeur
                if(true !== $this->checker->inField('is_member_de','specialite','titre')) {
                    $this->_return('Veuillez remplir tous les champs du formulaire prefixés de ( * ) , pour un professeur', false);
                }

                if(true !== $this->model->exist('id_utilisateur', $data['id_utilisateur'], 'professeurs')) {
                    $this->_return('cet identifiant ne correspond pas à celui d\'un professeur.', false);
                }

                $professeur['id_utilisateur'] = (int)$data['id_utilisateur'];
                if($data['is_member_de'] == "oui"){$professeur['is_member_de'] = 1;}else{$professeur['is_member_de'] = 0;}
                $professeur['specialite'] = (string)$data['specialite'];
                $professeur['titre'] = (string)$data['titre'];
                $this->model->edit_professeur($professeur['id_utilisateur'], $professeur);
                $this->model->edit_profils($profils['id_utilisateur'], $profils);
                $this->model->edit_utilisateur($user['id_utilisateur'], $user);
                $this->_return('Informations editées avec succès!! '.$resetmdp,true);
            }

            if($data['type_utilisateur'] == "etudiant")
            {
                //vérification des champs necessaires pour la création d'un professeur
                if(true !== $this->checker->inField('date_naiss','matricule','lieu_naiss','id_classe')) {
                    $this->_return('Veuillez remplir tous les champs du formulaire prefixés de ( * ) , pour un étudiant', false);
                }

                if(true !== $this->model->exist('id_utilisateur', $data['id_utilisateur'], 'Etudiants')) {
                    $this->_return('cet identifiant ne correspond pas à celui d\'un Etudiant.', false);
                }

                if(true !== $this->model->exist('id_classe', $data['id_classe'], 'Classes')) {
                    $this->_return('la classe spécifiée pour cet étudiant n\'existe pas', false);
                }

                $etudiant['id_utilisateur'] = (int)$data['id_utilisateur'];
                $etudiant['date_naiss'] = (string)$data['date_naiss'];
                $etudiant['matricule'] = (string)$data['matricule'];
                $etudiant['lieu_naiss'] = (string)$data['lieu_naiss'];
                $etudiant['id_classe'] = (int)$data['id_classe'];
                $this->model->edit_etudiant($etudiant['id_utilisateur'], $etudiant);
                $this->model->edit_profils($etudiant['id_utilisateur'], $profils);
                $this->model->edit_utilisateur($etudiant['id_utilisateur'], $user);
                $this->_return('Informations editées avec succès!! '.$resetmdp,true);
            }

            //Aucune type d'utilisateur ne correspond
            $this->_return('le type d\'utilisateur que vous souhaitez éditer n\'est pas reconnu!!',false);
        }
        catch(Exception $e)
        {
            $this->_exception($e);
        }
    }

    /* suppression d'un utilisateru */
    public function delete()
    {
        //recuperation des informations pour la suppression d'une filiére
        $data = $this->request->data;
        $id_utilisateur = (int)$data['id_utilisateur'] ?? null;
        if (empty($id_utilisateur)) {
            $this->_return('Veillez spécifier l\'identifiant de l\utilisateur à supprimer', false);
        }

        try {
            $this->model->remove_utilisateur($id_utilisateur);
            $this->_return('utilisateur supprimée avec succès', true);
            //code...
        }
        catch (Exception $e)
        {
            $this->_exception($e);
        }
    }

}
