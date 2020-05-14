<?php
use dFramework\core\output\Layout;

$current_section = trim(str_replace(trim(site_url(), '/'), '', current_url()), '/');

?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $df_pageTitle; ?></title>
    <link rel="icon" href="<?= img_url('logos/logo-iai.jpg'); ?>" />

    <!--<link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">-->
    <?php styles('template/staradminbootstrap.bundlecore'); ?>
    <?php Layout::stylesBundle(); ?>
    <link rel="stylesheet" type="text/css" href="" id="page-style" />


</head>

<body>
<div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center" style="font-family: 'Righteous', cursive;">
            <a class="navbar-brand brand-logo notranslate" href="<?= site_url(); ?>" style=" color: #fff !important; font-size: 1.75em" translate="no" > IAI Virtual Campus </a>
            <a class="navbar-brand brand-logo-mini" href="<?= site_url(); ?>"> IVC </a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-center">
            <ul class="navbar-nav d-none d-md-inline-flex">
                <li class="nav-item">
                    <a href="<?= site_url('help'); ?>" class="nav-link">Centre d'aide</a>
                </li>
                <li class="nav-item">
                    <a href="<?= site_url('about'); ?>" class="nav-link">A propos</a>
                </li>
                <!-- <li class="nav-item font-weight-semibold d-none d-lg-block">Help : +050 2992 709</li>
                <li class="nav-item dropdown language-dropdown">
                    <a class="nav-link dropdown-toggle px-2 d-flex align-items-center" id="LanguageDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                        <div class="d-inline-flex mr-0 mr-md-3">
                            <div class="flag-icon-holder">
                                <i class="flag-icon flag-icon-fr"></i>
                            </div>
                        </div>
                        <span class="profile-text font-weight-medium d-none d-md-block">Français</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-left navbar-dropdown py-2" aria-labelledby="LanguageDropdown">
                        <a class="dropdown-item" href="#">
                            <div class="flag-icon-holder">
                                <i class="flag-icon flag-icon-gb"></i>
                            </div>English
                        </a>
                        <a class="dropdown-item" href="#">
                            <div class="flag-icon-holder">
                                <i class="flag-icon flag-icon-fr"></i>
                            </div>Français
                        </a>
                    </div>
                </li>-->
            </ul>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown d-none d-md-inline-block">
                    <a class="nav-link count-indicator" id="notificationDropdown" href="#" data-toggle="dropdown">
                        <i class="mdi mdi-bell-outline"></i>
                        <span class="count bg-danger">3</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0" aria-labelledby="notificationDropdown">
                        <a class="dropdown-item py-3 border-bottom">
                            <p class="mb-0 font-weight-medium float-left">You have 4 new notifications </p>
                            <span class="badge badge-pill badge-primary float-right">View all</span>
                        </a>
                        <a class="dropdown-item preview-item py-3">
                            <div class="preview-thumbnail">
                                <i class="mdi mdi-alert m-auto text-primary"></i>
                            </div>
                            <div class="preview-item-content">
                                <h6 class="preview-subject font-weight-normal text-dark mb-1">Application Error</h6>
                                <p class="font-weight-light small-text mb-0"> Just now </p>
                            </div>
                        </a>
                        <a class="dropdown-item preview-item py-3">
                            <div class="preview-thumbnail">
                                <i class="mdi mdi-settings m-auto text-primary"></i>
                            </div>
                            <div class="preview-item-content">
                                <h6 class="preview-subject font-weight-normal text-dark mb-1">Settings</h6>
                                <p class="font-weight-light small-text mb-0"> Private message </p>
                            </div>
                        </a>
                        <a class="dropdown-item preview-item py-3">
                            <div class="preview-thumbnail">
                                <i class="mdi mdi-airballoon m-auto text-primary"></i>
                            </div>
                            <div class="preview-item-content">
                                <h6 class="preview-subject font-weight-normal text-dark mb-1">New user registration</h6>
                                <p class="font-weight-light small-text mb-0"> 2 days ago </p>
                            </div>
                        </a>
                    </div>
                </li>

                <li class="nav-item dropdown user-dropdown">
                    <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                        <img class="img-xs rounded-circle" src="<?= $User->getAvatar(); ?>" alt="<?= $User->getProfil(); ?>"> </a>
                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                        <div class="dropdown-header text-center">
                            <img class="img-md rounded-circle" src="<?= $User->getAvatar(); ?>" alt="<?= $User->getProfil(); ?>">
                            <p class="mb-1 mt-3 font-weight-semibold"><?= $User->getProfil(); ?></p>
                            <p class="font-weight-light text-muted mb-0"><?= $User->getClasse('code_classe'); ?></p>
                        </div>
                        <a class="dropdown-item" href="<?= site_url('profil'); ?>">Profil</a>
                        <a class="dropdown-item" href="<?= site_url('logout'); ?>">Déconnexion</a>
                    </div>
                </li>
            </ul>

            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                <span class="mdi mdi-menu"></span>
            </button>
        </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <ul class="nav">
                <li class="nav-item nav-profile my-3 my-lg-1 mb-1">
                    <div class="d-flex justify-content-center align-items-center flex-column">
                        <img class="img-lg img-thumbnail rounded-circle" src="<?= $User->getAvatar(); ?>" alt="<?= $User->getProfil(); ?>">
                        <div class="text-wrapper mt-3">
                            <p class="profile-name text-white"><strong><?= $User->getProfil(); ?></strong></p>
                            <p class="designation text-center text-white"><?= $User->getClasse('code_classe'); ?></p>
                        </div>
                    </div>
                </li>
                <!--<li class="nav-item nav-category">Main Menu</li> -->
                <li class="nav-item">
                    <a class="nav-link" href="<?= site_url('students'); ?>">
                        <i class="menu-icon typcn typcn-document-text"></i>
                        <span class="menu-title">Tableau de bord</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= site_url('students/courses'); ?>">
                        <i class="menu-icon typcn typcn-document-text"></i>
                        <span class="menu-title">Cours</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= site_url('students/forum'); ?>">
                        <i class="menu-icon typcn typcn-document-text"></i>
                        <span class="menu-title">Forum</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#examens" aria-expanded="false" aria-controls="ui-basic">
                        <i class="menu-icon typcn typcn-coffee"></i>
                        <span class="menu-title">Examens</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="examens">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item">
                                <a class="nav-link" href="<?= site_url('students/exams/cc'); ?>">Contrôles continus</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= site_url('students/exams/sn'); ?>">Sessions normales</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#etats" aria-expanded="false" aria-controls="ui-basic">
                        <i class="menu-icon typcn typcn-coffee"></i>
                        <span class="menu-title">Etats</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="etats">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item">
                                <a class="nav-link" href="<?= site_url('students/states/planing'); ?>">Emploi de temps</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= site_url('students/states/presences'); ?>">Feuille de presence</a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- partial -->

        <div class="main-panel">
            <div class="content-wrapper px-2 px-md-4" data-dan-box="main_box" data-dan-main="true">
                <?php Layout::renderView(); ?>
            </div>
            <!-- content-wrapper ends -->
            <!-- partial:partials/_footer.html -->
            <footer class="footer">
                <div class="container-fluid clearfix">
                    <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © 2020 <a target="_blank" href="https://iaicameroun.com" style="color:inherit!important;font-weight:bold">IAI Cameroun</a>. Tous droits réservés.</span>
                    <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Powered by <a href="https://www.facebook.com/esdg.officiel" target="_blank">ESDG</a>
              </span>
                </div>
            </footer>
            <!-- partial -->
        </div>
        <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->


<?php Layout::scriptsBundle(); ?>
<script>
    (function($){
        $('[data-toggle="offcanvas"]').on("click", function () {
            $('.sidebar-offcanvas').toggleClass('active')});
    })(jQuery);
</script>

</body>
</html>
