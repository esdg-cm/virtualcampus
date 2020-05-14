<?php
require __DIR__.'/../__BaseController.php';

require_once ENTITY_DIR.'StudentsEntity.php';


class __StudentsController extends __BaseController
{
    protected $_user;

    public function __construct() {

        parent::__construct();

        $auth = $this->data->session('auth');

        if(!empty($auth['is_prof']) AND $auth['is_prof'] === true) {
            redirect('teachers');
        }

        $request  = $this->api->post('user/read', null, [
            'id_utilisateur' => $auth['id_utilisateur']
        ]);
        $request = json_decode($request);
        $user = $request->results;

        $this->_hydrateUser(array_merge($auth, (array) $user));

        $this->layout->setLayout('students')->putVar(['User' => $this->_user]);
    }
    public function index(){}



    private function _hydrateUser($user_infos)
    {
        $this->_user = new StudentsEntity($user_infos, $this->api);
    }
}
