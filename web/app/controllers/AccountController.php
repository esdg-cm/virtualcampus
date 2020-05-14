<?php

/**
 * Classe du compte d'utilisateur
 */

require_once '__BaseController.php';

class AccountController extends __BaseController
{
    function index() {}

    /**
     * Connexion de l'utilisateur
     *
     * @return [type] [description]
     */
    function login()
    {
        $auth = $this->data->session('auth');

        if(!empty($auth['id_utilisateur']) AND !empty($auth['mdp'])) {
            if($auth['is_prof'] === true) {
                redirect('teachers/');
            }
            redirect('students/');
        }

        $data= [];
        if($this->request->is('post'))
        {
            // On charge la librairie de validation
            $this->loadLibrary('Validator', 'v');
            // Lorsqu'on precise le deuxieme parametre (v) c'est un alias pour utiliser $this->v au lieu de $this->validator

            // On initialise le validateur
            $this->v->init();

            // On defini les regles de validation
            // Pour plus d'info sur les regles dispo vas dans /system/librairies/Validator.php
            $this->v->labels(['mdp'=>'Le mot de passe']);
            $this->v->labels(['login'=>'Le login']);
            $this->v->required(['login', 'mdp']);

            // On demarre la validation
            if(! $this->v->validate()) {
                // En cas d'erreur on les recuperes
                $errors = $this->v->errors();
                foreach ($errors as $key => $value) {
                    $errors[$key] = $value[0];
                }
                $data['errors'] = (object) [
                    'errors' => (object) $errors
                ];
            }
            else {
                $post=$this->request->data;
                extract($post);
                $user = $this->api->post('account/login', null, [
                    'login'      => $login,
                    'mdp'        => $mdp,
                    'ip'         => $this->request->clientIp(),
                    'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? ''
                ]);

                $user = json_decode($user);
                if(!isset($user->success) OR true !== $user->success) {
                    $data['errors'] = $user->results;
                }
                else {
                    $this->data->session('auth', [
                        'id_utilisateur' => $user->results->id_utilisateur ?? null,
                        'login'          => $user->results->login ?? null,
                        'mdp'            => $user->results->mdp ?? null,
                        'is_prof'        => $user->results->is_prof ?? false,
                        'ip'         => $this->request->clientIp()
                    ]);
                    if($user->results->is_prof) {
                        redirect('teachers/');
                    }
                    else {
                        redirect('students/');
                    }
                }
            }
        }

        $this->view('login', $data)->render();
    }

    public function logout()
    {
        $id_utilisateur = $this->data->session('auth')['id_utilisateur'] ?? null;

        $this->api->post('account/logout', null, compact('id_utilisateur'));
        $this->data->free_session('auth');
        redirect('account/login');
    }
}
