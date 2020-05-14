<?php
require __DIR__.DS.'__TeachersController.php';

class CoursesController extends __TeachersController
{
    public function index()
    {
        $this->layout
            ->add('index')
            ->launch();
    }

}
