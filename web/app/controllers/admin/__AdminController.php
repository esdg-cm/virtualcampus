<?php
require __DIR__.'/../__BaseController.php';

class __AdminController extends __BaseController
{
    public function __construct() {
        parent::__construct();

        $this->layout->setLayout('admin');
    }
    public function index(){}
}
