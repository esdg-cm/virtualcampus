<?php
require_once __DIR__.'/../__StudentsController.php';
require_once ENTITY_DIR.'PartiesEntity.php';
require_once ENTITY_DIR.'DiscussionsEntity.php';


class Courses extends __StudentsController
{

    /**
     * Affiche le sommaire d'une matiere
     *
     * @author Dimitri
     * @param  int $id_matiere
     */
    public function _sommaire($id_matiere)
    {
        $request = $this->api->post('partiescours/read', null, compact('id_matiere'));
        $data['parties'] = json_decode($request)->results ?? null;
        if(!empty($data['parties'])) {
            foreach ($data['parties'] As $key => $value) {
                $data['parties'][$key] = new PartiesEntity($value, $this->api);
            }
        }

        return $this->view('/students/courses/ajax/sommary', $data)->render();
    }

    /**
     * Affiche le glossaire d'une matiere
     *
     * @param  $id_matiere
     */
    public function _glossary($id_matiere)
    {
        $data = [];

        $request = $this->api->post('glossaires/read', null, compact('id_matiere'));
        $data['glossaires'] = json_decode($request)->results ?? null;
        if(!empty($data['glossaires'])) {
            foreach ($data['glossaires'] As $key => $value) {
                $data['glossaires'][$key] = new GlossairesEntity($value, $this->api);
            }
        }
        $this->loadLibrary('Parser', null, $data['parser']);

        $data['id_matiere'] = $id_matiere;

        return $this->view('/students/courses/ajax/glossary', $data)->render();
    }


    /**
     * Affiche le glossaire d'une matiere
     *
     * @param  $id_matiere
     */
    public function _resources($id_matiere)
    {
        $query = $this->request->query;

        $data = [];
        $data['id_matiere'] = $id_matiere;

        if(!empty($query['display']) AND in_array($query['display'], ['videos', 'pdf'])) {
            $request = $this->api->post('ressources/read', null, [
                'id_matiere' => $id_matiere,
                'type_ressource' => $query['display']
            ]);
        }
        else {
            $request = $this->api->post('ressources/read', null, compact('id_matiere'));
        }
        $data['ressources'] = json_decode($request)->results ?? null;
        if(!empty($data['ressources'])) {
            foreach ($data['ressources'] As $key => $value) {
                $data['ressources'][$key] = new RessourcesEntity($value, $this->api);
            }
        }

        if(!empty($query['rid'])) {
            $request = $this->api->post('ressources/read', null, [
                'id_ressource' => $query['rid']
            ]);
            $data['ressource'] = json_decode($request)->results ?? null;
            if(!empty($data['ressource'])) {
                $data['ressource'] = new RessourcesEntity($data['ressource'], $this->api);

                if(!$data['ressource']->is($query['display'])) {
                    die('La ressource que vous avez demandé ne correspond pas au type de ressource spécifié. Utilsez les liens visuels pour votre navigation');
                }
            }
            else {
                die('La ressource que vous avez demandé est indisponible');
            }
        }

        $view = '/students/courses/ajax/resources'; // La vue a afficher

        if(!empty($query['display']) AND in_array(strtolower($query['display']), ['videos', 'pdf'])) {
            $view .= '.'.strtolower($query['display']);
        }
        return $this->view($view, $data)->render();

    }


    /**
     * Affiche le glossaire d'une matiere
     *
     * @param  $id_matiere
     */
    public function _discussions($id_matiere)
    {
        $query = $this->request->query;
        $data = [];
        $data['id_matiere'] = $id_matiere;
        $data['User'] = $this->_user;

        if($this->request->is('post')) {
            $post = $this->request->data;
            if(!empty($post['message'])) {
                $request = $this->api->post('discussions/create', null, [
                    'id_matiere' => $id_matiere,
                    'id_classe' => $this->_user->id_classe,
                    'id_utilisateur' => $this->_user->id_utilisateur,
                    'contenue' => $post['message'],
                ]);
                $response = json_decode($request);
                if(!$response->success) {
                    echo '<error>';
                    exit($response->message);
                }
            }
            exit;
        }

        if(!empty($query['action']) AND $query['action'] == 'show_msg') {
            $request = $this->api->post('discussions/readDiscussionClasse', null, [
                'id_matiere' => $id_matiere,
                'id_classe' => $this->_user->id_classe,
            ]);
            $data['messages'] = json_decode($request)->results ?? null;
            if(!empty($data['messages'])) {
                foreach ($data['messages'] as $key => $value) {
                    $data['messages'][$key] = new DiscussionsEntity($value, $this->api);
                }
            }
           return $this->view('/students/courses/ajax/discussions.msg', $data)->render();
        }
        else {
            return $this->view('/students/courses/ajax/discussions', $data)->render();
        }

    }



}
