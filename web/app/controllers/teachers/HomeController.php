<?php
require __DIR__.DS.'__TeachersController.php';

class HomeController extends __TeachersController
{
    /**
     * Page d'accueil de la plateforme
     *
     * @author Dimitri Sitchet
     */
    public function index()
    {
        $this->layout
            ->add('../teachers/home/index')
            ->launch();
    }

}
