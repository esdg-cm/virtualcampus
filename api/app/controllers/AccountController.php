<?php

require_once '__BaseController.php';

class AccountController extends __BaseController
{
    private $auth;

    public function __construct()
    {
        parent::__construct();

        $this->response->type('application/json; charset=UTF-8');
    }

    public function index()
    {
        $this->_return('Forbidden', false, null, 403);
    }


    public function login()
    {
        if(true !== $this->request->is('post')) {
            $this->index();
        }
        $post = $this->request->data;

        if(!$this->model->exist('login', $post['login'], 'utilisateurs')) {
            $err['errMsg'] = 'Utilisateur innexistant. Veuillez contactez l\'administrateur.';
            return $this->_return('Echec de connexion', false, $err);
        }
        $user = $this->model->read_utilisateur_with_login($post['login']);
        if(empty($user)) {
            $err['errMsg'] = 'Utilisateur desactivé. Veuillez contacter l\'administrateur';
            return $this->_return('Echec de connexion', false, $err);
        }
        if(!dFramework\core\utilities\Utils::passcompare($post['mdp'], $user->mdp)) {
             $err['errMsg'] = 'Le mot de passe que vous avez entrer est incorrect';
            return $this->_return('Echec de connexion', false, $err);
        }
        $user->is_prof = $this->model->exist('id_utilisateur', $user->id_utilisateur, 'professeurs');

        $ip = $post['ip'] ?? $this->request->clientIp();
        $user_agent = $post['user_agent'] ?? ($_SERVER['HTTP_USER_AGENT'] ?? '');
        $this->model->login($user->id_utilisateur, $ip, $user_agent);

        return $this->_return('Connexion reussie', true, $user);
    }

    public function logout()
    {
        if(true !== $this->request->is('post')) {
            $this->index();
        }
        $post = $this->request->data;
        if(!empty($post['id_tilisateur'])) {
            $this->model->logout($post['id_utilisateur']);
        }
        $this->auth->logout();

        return $this->_return('Deconnexion reussie', true, []);
    }


    public function checkconnected()
    {
        if(true !== $this->request->is('post')) {
            $this->index();
        }
        $post = $this->request->data;
        extract($post);

        if(empty($id_utilisateur)) {

            $this->_return('Utilisateur non reconnue', false);
        }
        if(empty($ip)) {
            $ip = $this->request->clientIp();
        }
        if(empty($user_agent)) {
            $user_agent = $_SERVER['HTTP_USER_AGENT'] ?? '';
        }

        $is_connected = $this->model->checkconnected($id_utilisateur, $ip, $user_agent);
        $this->_return('', $is_connected);
    }


}
