<?php
require_once __DIR__.'/__StudentsController.php';

class StatesController extends __StudentsController
{
    public function planing()
    {
        $this->layout
            ->add('planing')
            ->launch();
    }


    public function presences()
    {
        $period = $this->data->get('p');

        $this->layout
            ->add(empty($period) ? 'presences' : 'presences_details')
            ->launch();
    }
}
