<?php


$layout['default'] = [
    // fichiers de style des plugins
    'lib_styles' => [
        'animate-css/animate.min',
        'loaders-css/loaders.min',
        'ionicons/css/ionicons.min',
        'font-awesome/v5.2/css/all.min',
        'mdi/css/materialdesignicons.min',
        'modal-effects/modal-effects',
        'jquery-confirm/jquery-confirm',
        'dAN-0.1.9/dan.min',
        'timepicker/jquery.timepicker',
        'timepicker/jquery.timepicker.min',
    ],
    // fichiers de script des plugins
    'lib_scripts' => [
        '../js/template/staradminbootstrap.bundlecore',
        '../js/template/staradminbootstrap.vendorbundleaddons',
        'dAN-0.1.9/dan.min',
        'jquery-confirm/jquery-confirm',
        'timepicker/jquery.timepicker',
        'timepicker/jquery.timepicker.min',
    ],
    // fichiers de style de l'application
    'styles' => [
        'template/default'
    ],
    // fichiers de script de l'application
    'scripts' => [

    ],
];



$layout['students'] = [
    // fichiers de style des plugins
    'lib_styles' => array_merge($layout['default']['lib_styles'], [

    ]),
    // fichiers de script des plugins
    'lib_scripts' => array_merge($layout['default']['lib_scripts'], [

    ]),
    // fichiers de style de l'application
    'styles' => array_merge($layout['default']['styles'], [

    ]),
    // fichiers de script de l'application
    'scripts' => array_merge($layout['default']['scripts'], [
        'app',
        'students/staradminbootstrap.misc',
    ]),
];



$layout['teachers'] = [
    // fichiers de style des plugins
    'lib_styles' => array_merge($layout['default']['lib_styles'], [

    ]),
    // fichiers de script des plugins
    'lib_scripts' => array_merge($layout['default']['lib_scripts'], [

    ]),
    // fichiers de style de l'application
    'styles' => array_merge($layout['default']['styles'], [

    ]),
    // fichiers de script de l'application
    'scripts' => array_merge($layout['default']['scripts'], [
        'app',
        'students/staradminbootstrap.misc',
    ]),
];


/**
 * DON'T TOUCH THIS LINE. IT'S USING BY CONFIG CLASS
 */
return compact('layout');
