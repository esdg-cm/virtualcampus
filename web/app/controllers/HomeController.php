<?php
class HomeController extends dFramework\core\Controller
{
    function __construct() {

    }
    function index() {
        redirect('students');
    }
}
