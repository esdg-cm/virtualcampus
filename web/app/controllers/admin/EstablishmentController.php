<?php
require __DIR__.DS.'__AdminController.php';

class EstablishmentController extends __AdminController
{
    /**
     * Gestion du module enseignement
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
            'js' => js_url('admin/establishment'),
            'content' => $content
        ]));
    }

}