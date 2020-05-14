<?php

/*
| -------------------------------------------------------------------
| ROUTE SETTINGS OF APPLICATION
| -------------------------------------------------------------------
| This file will contain the routing settings of your application.
|
| For complete instructions please consult the 'Route Configuration' in User Guide.
|
| -------------------------------------------------------------------
| EXPLANATION OF VARIABLES
| -------------------------------------------------------------------
|
|	['default_controller']
|       This route indicates which controller class should be loaded if the
|       URI contains no data. In the above example, the "Home" class would be loaded.
|
*/


$route['default_controller'] = 'Home';

//Page de connexion
$route['/login'] = 'Account::login';
// Page de deconnexion
$route['/logout'] = 'Account::logout';

// Page de planing
$route['/planing'] = 'students/States::planing';

// Page de la feuille de presence


// Visualisation d'un cours par l'etudiant
$route['/students/courses/([0-9]+)-(?:[a-z0-9-]+)/?$'] = 'students/Courses::read';

$route['/students/courses/([0-9]+)(?:-(?:[a-z0-9-]+))?/([0-9]+)-(?:[a-z0-9-]+)/?$'] = 'students/Courses::read';

// Glossaire du cours en mode fuul
$route['/students/courses/([0-9]+)(?:-(?:[a-z0-9-]+))?/glossary/?$'] = 'students/Courses::glossary';

// Discussions du cours en mode full
$route['/students/courses/([0-9]+)-(?:[a-z0-9-]+)/discussions/?$'] = 'students/Courses::::discussions';

// Ressources du cours en mode full
$route['/students/courses/([0-9]+)(?:-(?:[a-z0-9-]+))?/resources/?$'] = 'students/Courses::resources';



/*
$route['/works/([a-z-]+)/?$'] = 'Works::work';

$route['/posts']['GET'] = function () {
    echo 'dimitri ';
};

$route['/posts/([0-9]+)-([a-z\-0-9]+)'] = function ($a, $b) {
    echo "Article $a : $b";
};*/


/**
 * DON'T TOUCH THIS LINE. IT'S USING BY CONFIG CLASS
 */
return compact('route');
