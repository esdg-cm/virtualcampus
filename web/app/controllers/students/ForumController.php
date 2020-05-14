<?php
require_once __DIR__.'/__StudentsController.php';
require_once ENTITY_DIR.'BilletsEntity.php';
require_once ENTITY_DIR.'CommentairesBilletsEntity.php';

/**
 * Controlleur du forum des etudiants
 *
 * @author Dimitri Sitchet
 */
class ForumController extends __StudentsController
{
    /**
     * Index du forum
     */
    public function index()
    {
        $request = $this->api->get('filieres/read');
        $data['filieres'] = json_decode($request)->results ?? null;

        $this->layout
            ->add('index', $data)
            ->setPageTitle('Forum communautaire')
            ->putCss('students/forum')
            ->launch();
    }

    /**
     * Affichage de la liste des billets d'une categorie
     *
     * @param   $id_filiere
     */
    public function category($id_filiere)
    {
        $id_filiere = explode('-', $id_filiere)[0];
        $request = $this->api->post('filieres/read', null, compact('id_filiere'));
        $data['filiere'] = json_decode($request)->results ?? null;
        if(empty($data['filiere'])) {
            redirect('students/forum');
        }

        $this->layout
            ->add('billets', $data)
            ->setPageTitle('Liste des preoccupations')
            ->putCss('students/forum')
            ->launch();
    }

    /**
     * Affiche le contenu d'un billet de forum (sujet)
     *
     * @param  $id_billet
     */
    public function topic($id_billet)
    {
        if($this->request->is('post')) {
            $post = $this->request->data;
            if(!empty($post['contenu'])) {
                $request = $this->api->post('commentaire_forum/create', null, [
                    'contenu' => $post['contenu'],
                    'id_utilisateur' => $this->_user->id_utilisateur,
                    'id_billet' => $id_billet,
                    'resolu' => $post['resolu'] ?? false,
                ]);
                $response = json_decode($request);
                if(!$response->success) {
                    echo '<error>';
                }
                else {
                    echo '<ok>';
                }
                exit($response->message);
            }
        }
        $request = $this->api->post('billets_forum/read', null, compact('id_billet'));
        $data['billet'] = json_decode($request)->results ?? null;
        if(empty($data['billet'])) {
            redirect('students/forum');
        }
        $data['billet'] = new BilletsEntity($data['billet'], $this->api);
        

        $this->addFroalaScript();
        $this->layout
            ->add('read', $data)
            ->setPageTitle($data['billet']->getSubject().' | Forum '.$data['billet']->filiere('nom_filiere'))
            ->putCss('students/forum', 'froala.editor')
            ->putJs('students/forum', 'froala.editor')
            ->launch();
    }


    /**
     * Cree un nouveau sujet de discussion
     *
     */
    public function new()
    {
        if($this->request->is('post')) {
            $post = $this->request->data;
            if(!empty($post['contenu'])) {
                $request = $this->api->post('billets_forum/create', null, [
                    'id_utilisateur' => $this->_user->id_utilisateur,
                    'id_filiere' => $post['id_filiere'] ?? null,
                    'contenu' => $post['contenu'],
                    'sujet' => $post['sujet']
                ]);
                $response = json_decode($request);
                if(!$response->success) {
                    echo '<error>';
                }
                else {
                    echo '<ok>'.$response->results;
                }
                exit($response->message);
            }
            exit;
        }

        $this->addFroalaScript();

        $request = $this->api->get('filieres/read');
        $data['filieres'] = json_decode($request)->results ?? null;
        $data['id_filiere'] = $this->data->get('cat');

        $this->layout
            ->add('new', $data)
            ->setPageTitle('Nouvelle preoccupation')
            ->putCss('froala.editor')
            ->putJs('students/forum', 'froala.editor')
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
        if(!preg_match('#^ajax#i', $method)) {
            if($method == 'c') {
                $method = 'category';
            }
            if($method == 't') {
                $method = 'topic';
            }

            if (method_exists($this, $method)) {
                return call_user_func_array([$this, $method], $params);
            }
            die('404 - Not found');
        }
        if (!$this->request->is('ajax')) {
            die('403 - Forbidden');
        }
        require_once __DIR__.'/ajax/Forum.php';

        $forum = new Forum;
        $method = str_replace('ajax', '', $method);
        $method = strtolower('_'.$method);

        if (!method_exists($forum, $method)) {
            die('404');
        }
        return call_user_func_array([$forum, $method], $params);
    }



    private function addFroalaScript()
    {
        $this->layout
            ->putLibCss(
                'froala/css/froala_editor',
                'froala/css/froala_style',
                'froala/css/plugins/code_view',
                'froala/css/plugins/colors',
                'froala/css/plugins/emoticons',
                'froala/css/plugins/image_manager',
                'froala/css/plugins/image',
                'froala/css/plugins/line_breaker',
                'froala/css/plugins/table',
                'froala/css/plugins/char_counter',
                'froala/css/plugins/video',
                'froala/css/plugins/fullscreen',
                'froala/css/plugins/file',
                'froala/css/plugins/quick_insert',
                'https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/codemirror.min.css'
            )
            ->putLibJs(
                'https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/codemirror.min.js',
                'https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/mode/xml/xml.min.js',
                'froala/js/froala_editor.min',
                'froala/js/plugins/align.min',
                'froala/js/plugins/char_counter.min',
                'froala/js/plugins/code_beautifier.min',
                'froala/js/plugins/code_view.min',
                'froala/js/plugins/colors.min',
                'froala/js/plugins/draggable.min',
                'froala/js/plugins/emoticons.min',
                'froala/js/plugins/entities.min',
                'froala/js/plugins/file.min',
                'froala/js/plugins/font_size.min',
                'froala/js/plugins/font_family.min',
                'froala/js/plugins/fullscreen.min',
                'froala/js/plugins/image.min',
                'froala/js/plugins/image_manager.min',
                'froala/js/plugins/line_breaker.min',
                'froala/js/plugins/inline_style.min',
                'froala/js/plugins/link.min',
                'froala/js/plugins/lists.min',
                'froala/js/plugins/paragraph_format.min',
                'froala/js/plugins/paragraph_style.min',
                'froala/js/plugins/quick_insert.min',
                'froala/js/plugins/quote.min',
                'froala/js/plugins/table.min',
                'froala/js/plugins/save.min',
                'froala/js/plugins/video.min',
                'froala/js/plugins/url.min'
            );
    }
}
