<?php
require __DIR__.DS.'__AdminController.php';

class EducationController extends __AdminController
{
    /**
     * Gestion des enseignements
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
            'js' => js_url('admin/education'),
            'content' => $content
        ]));
    }

}