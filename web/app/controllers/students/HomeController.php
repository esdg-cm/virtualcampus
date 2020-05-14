<?php
require __DIR__.DS.'__StudentsController.php';

class HomeController extends __StudentsController
{
    /**
     * Page d'accueil de la plateforme
     *
     * @author Dimitri Sitchet
     */
    public function index()
    {
        $this->layout
            ->add('../students/home/index')
            ->launch();
    }

}
