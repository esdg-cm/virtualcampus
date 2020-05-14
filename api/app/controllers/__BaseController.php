<?php

class __BaseController extends \dFramework\core\Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->useObject(self::REQUEST_OBJECT, self::RESPONSE_OBJECT);
    }

    /* methode par defaut */
    protected function index()
    {
        // TODO: Implement index() method.
    }

    /* methode pour la gestion des exceptions */
    protected function _exception(Exception $e)
    {
        $this->_return('Une erreur s\'est produite. Veuillez reessayer - ['.$e->getMessage().' | '.$e->getFile().' | '.$e->getLine().']', false);
    }

    /* methode pour le retour des resultats */
    protected function _return(string $message, bool $success, $results = null, ?int $status = 200)
    {
        $this->response->statusCode($status);
        $this->response->body(json_encode(compact('message', 'success', 'results')));
        $this->response->send();
        exit;
    }    
}