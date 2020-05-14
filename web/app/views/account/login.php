<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <title>Connexion | IAI Virtual Campus</title>
    <link rel="icon" type="image/png" href="<?= img_url('logos/logo-iai.jpg'); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--<link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">-->
    <?php styles('template/staradminbootstrap.bundlecore'); ?>
    <?php dFramework\core\output\Layout::stylesBundle('default'); ?>

    <style>
        header {
            margin-bottom: 1.5em !important;
        } header img {
            width: 7em;
            height: 5em;
        } header h3 {
            color: #17a2b8
        }
        label p{
            font-size: .8em !important;
            color: crimson !important;
        }
    </style>
</head>
<body>
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth auth-bg-1 theme-one" style="background-image: url(<?= img_url('backgrounds/bg_1.jpg'); ?>);">
            <div class="row w-100">
                <div class="col-lg-4 mx-auto">
                    <div class="auto-form-wrapper">
                        <form action="" method="post">
                            <header class="text-center">
                                <a href="<?= site_url(); ?>" class="d-flex justify-content-center align-items-center">
                                    <img class="img-fluid img-thumbnail" src="<?= img_url('logos/logo-iai.jpg'); ?>" alt="IAI Virtual Campus">
                                </a>
                                <h3 style="font-family: 'Righteous', cursive;">IAI Virtual Campus</h3>
                                <h4>Connexion</h4>
                            </header>
                            <div class="form-group">
                                <label class="label">Nom d'utilisateur</label>
                                <div class="input-group">
                                    <input type="text" name="login" value="<?= $_POST['login'] ?? null; ?>" class="form-control" placeholder="Entrez votre nom d'utilisateur">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="far fa-user-circle"></i></span>
                                    </div>
                                </div>
                                <label class="m-1 mt-2"><p class="m-0 p-0"><?= $errors->errors->login ?? ''; ?></p></label>
                            </div>
                            <div class="form-group">
                                <label class="label">Mot de passe</label>
                                <div class="input-group">
                                    <input type="password" name="mdp" class="form-control" placeholder="Entrez votre mot de passe">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fa fa-lock"></i></span>
                                    </div>
                                </div>
                                <label class="m-1 mt-2"><p class="m-0 p-0"><?= $errors->errors->mdp ?? ''; ?></p></label>
                            </div>
                            <?php if(!empty($errors->errMsg)) : ?>
                                <div class="small alert alert-danger text-center"><?= $errors->errMsg; ?></div>
                            <?php endif; ?>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary submit-btn btn-block">Se connecter</button>
                            </div>
                            <div class="form-group d-flex justify-content-between">
                                <a href="#" class="text-small forgot-password text-black">Mot de passe oublié</a>
                            </div>
                        </form>
                    </div>
                    <p class="footer-text mt-3 text-center">
                      Copyright © 2020 IAI Cameroun | Powered by <a href="https://www.facebook.com/esdg.officiel" target="_blank">ESDG</a>
                    </p>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>


</body>
</html>
