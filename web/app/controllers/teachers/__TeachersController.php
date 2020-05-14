<?php

require __DIR__.'/../__BaseController.php';

require_once ENTITY_DIR.'TeachersEntity.php';

class __TeachersController extends __BaseController
{
    protected $_user;

    public function __construct() {

        parent::__construct();

        $auth = $this->data->session('auth');

        if(empty($auth['is_prof']) OR $auth['is_prof'] !== true) {
            redirect('students');
        }

        $request  = $this->api->post('user/read', null, [
            'id_utilisateur' => $auth['id_utilisateur']
        ]);
        $request = json_decode($request);
        $user = $request->results;

        $this->_hydrateUser(array_merge($auth, (array) $user));

        $this->layout->setLayout('teachers')->putVar(['User' => $this->_user]);
    }
    public function index(){}



    private function _hydrateUser($user_infos)
    {
        $this->_user = new TeachersEntity($user_infos, $this->api);
    }
}
