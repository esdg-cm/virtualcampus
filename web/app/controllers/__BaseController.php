<?php

class __BaseController extends dFramework\core\Controller
{

    protected $baseApi ='http://192.168.8.104:8080/api/';

    public function __construct()
    {
        parent::__construct();
        $this->loadLibrary('Api');
        $this->api->baseUrl($this->baseApi);

        if(!preg_match('#log(in|out)/?#i', current_url())) {
            $this->_checkauth();
        }
    }
    public function index() {}


    private function _checkauth()
    {
        $auth = $this->data->session('auth');
        if(empty($auth) OR !is_array($auth)) {
            redirect('account/logout/');
            exit;
        }
        extract($auth);

        if(empty($id_utilisateur) OR empty($mdp)) {
            redirect('account/logout/');
        }
        if(empty($ip) OR $ip != $this->request->clientIp()) {
            redirect('account/logout/');
        }


        $request = $this->api->post('account/checkconnected', null, [
            'id_utilisateur' => $id_utilisateur,
            'ip' => $ip ?? null,
            'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? ''
        ]);
        $request = json_decode($request);
        if(!isset($request->success) OR true !== $request->success) {
            redirect('account/logout/');
        }
    }

}
