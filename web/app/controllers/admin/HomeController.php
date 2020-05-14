<?php
require __DIR__.DS.'__AdminController.php';

class HomeController extends __AdminController
{
    /**
     * Page d'accueil de la plateforme
     *
     * @author ESDG
     */
    public function index()
    {
        if(! $this->request->is('ajax')) {
            return $this->layout->launch();
        }

        $content = $this->view('index')->get();

        exit(json_encode([
            'content' => $content
        ]));
    }

}
