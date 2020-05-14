<?php
require_once __DIR__.'/../__StudentsController.php';

/**
 * @author Dimitri Sitchet
 */
class Exams extends __StudentsController
{

    /**
     * @param  int $filtre
     */
    public function _cc($filter)
    {
        $params = func_get_args();
        $filter = array_shift($params);

        $this->view('/students/exams/ajax/cc.'.$filter)->render();
    }

    /**
     * @param  int $filtre
     */
    public function _sn($filter)
    {
        $params = func_get_args();
        $filter = array_shift($params);

        $this->view('/students/exams/ajax/sn.'.$filter)->render();
    }
}
