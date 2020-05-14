<?php
require __DIR__.'/__StudentsController.php';

require_once ENTITY_DIR.'UeEntity.php';
require_once ENTITY_DIR.'MatieresEntity.php';
require_once ENTITY_DIR.'GlossairesEntity.php';
require_once ENTITY_DIR.'RessourcesEntity.php';

class CoursesController extends __StudentsController
{

    /**
     * Index des cours
     *
     * @author Dimitri Sitchet
     */
    public function index()
    {
        // Recuperation des ue de l'etudiant
        $request = $this->api->post('ue/readUeFiliereNiveau', null, [
            'id_filiere' => $this->_user->getClasse('id_filiere'),
            'id_niveau'  => $this->_user->getClasse('id_niveau'),
        ]);
        $data['ues'] = json_decode($request)->results;

        foreach ($data['ues'] As $key => $value) {
           $data['ues'][$key] = new UeEntity($value, $this->api);
        }

        $this->layout
            ->add('index', $data)
            ->launch();
    }

    /**
     * Lecture du cours
     */
    public function read($id_matiere, $id_chapitre = null)
    {
        $data = [];

        $this->_hydrateMatiereAndCheckAutorize($data, $id_matiere);
        $data['prof'] = $data['matiere']->prof($this->_user->id_classe);

        if(empty($data['prof']) OR empty($data['prof']->nom)) {
           redirect('students/courses');
        }
        $request = $this->api->post('chapitres/read', null, compact('id_matiere', 'id_chapitre'));
        $data['chapitre'] = json_decode($request)->results ?? null;

        if(empty($data['chapitre'])) {
            if(null === $id_chapitre) {
                redirect('students/courses');
            }
            else {
                redirect('students/courses/'.scl_moveSpecialChar($id_matiere.'-'.$data['matiere']->nom_matiere));
            }
        }
        $this->layout
            ->setPageTitle(($data['chapitre']->titre_chap ?? null).' | '.$data['matiere']->nom_matiere)
            ->add('read', $data)
            ->putCss('students/courses')
            ->putJs('students/courses')
            ->launch();
    }


    public function glossary($id_matiere)
    {
        if($this->request->is('post')) {
            $post = $this->request->data;
            if(empty($post['terme']) OR empty($post['contenue'])) {
                exit('<error>Veuillez remplir tous les champs');
            }
            if(strlen($post['terme']) < 2) {
                exit('<error>Le terme doit avoir au moins 2 caracteres');
            }
            if(strlen($post['contenue']) < 10) {
                exit('<error>Le terme doit avoir au moins 10 caracteres');
            }
            $request = $this->api->post('glossaires/create', null, [
                'terme' => $post['terme'],
                'contenue' => $post['contenue'],
                'id_matiere' => $id_matiere,
                'id_utilisateur' => $this->_user->id_utilisateur
            ]);
            $request = json_decode($request);
            if(!$request->success) {
                echo '<error>';
            }
            else {
                echo '<ok>';
            }
            exit($request->message);
        }

        $data = [];

        $this->_hydrateMatiereAndCheckAutorize($data, $id_matiere);

        $request = $this->api->post('glossaires/read', null, compact('id_matiere'));
        $data['glossaires'] = json_decode($request)->results ?? null;
        if(!empty($data['glossaires'])) {
            foreach ($data['glossaires'] As $key => $value) {
                $data['glossaires'][$key] = new GlossairesEntity($value, $this->api);
            }
        }

        $this->loadLibrary('Parser', null, $data['parser']);

        $this->layout
            ->add('glossary', $data)
            ->launch();
    }
    public function discussions($id_matiere)
    {

    }
    public function resources($id_matiere)
    {
        $data = [];

        $this->_hydrateMatiereAndCheckAutorize($data, $id_matiere);
        $data['query'] = $this->request->query;

        $request = $this->api->post('ressources/read', null, compact('id_matiere'));
        $data['ressources'] = json_decode($request)->results ?? null;
        if(empty($data['ressources'])) {
           redirect($_SERVER['HTTP_REFERER']);
        }
        $this->layout
            ->putLibCss('video-js/vjs')
            ->putLibJs('video-js/vjs-ie8.min', 'video-js/vjs')
            ->add('resources', $data)
            ->launch();
    }




    /**
     * Remappage des methodes (Redirection interne)
     *
     * @author  Dimitri Sitchet
     * @param  string $method Methode appelée
     * @param  array  $params Arguments passes en parametres
     */
    public function _remap($method, $params = [])
    {
        $params  = (array) $params;

        if (!preg_match('#^ajax#i', $method)) {
            if (method_exists($this, $method)) {
                return call_user_func_array([$this, $method], $params);
            }
            die('404 - Not found');
        }
        if (!$this->request->is('ajax')) {
            die('403 - Forbidden');
        }
        require_once __DIR__.'/ajax/Courses.php';

        $courses = new Courses;
        $method = str_replace('ajax', '', $method);
        $method = strtolower('_'.$method);

        if (!method_exists($courses, $method)) {
            die('404');
        }
        return call_user_func_array([$courses, $method], $params);
    }



    private function _hydrateMatiereAndCheckAutorize(&$data, $id_matiere)
    {
        $request = $this->api->post('matieres/read', null, compact('id_matiere'));
        $data['matiere'] = json_decode($request)->results ?? null;
        if(empty($data['matiere'])) {
            redirect('students/courses');
        }
        $data['matiere'] = new MatieresEntity(json_decode($request)->results, $this->api);
        if(! $data['matiere']->autoriser($this->_user->id_classe)) {
            redirect('students/courses');
        }
    }
}
