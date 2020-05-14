<?php use dFramework\core\output\Layout;
?>
<!-- Page Title Header Starts-->
<div class="row page-title-header">
    <div class="col-12 py-0 m-0">
        <div class="page-header d-flex py-0 my-0 justify-content-between">
            <h4 class="page-title"> <i class="fa fa-comment-dots"></i> Forum</h4>
            <nav aria-label="breadcrumb" class="d-none d-md-block m-0">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= site_url('students'); ?>">Accueil</a></li>
                <li class="breadcrumb-item active" aria-current="page">Forum</li>
              </ol>
            </nav>
        </div>
    </div>
</div>
<!-- Page Title Header Ends-->

<div class="card mb-3">
    <div class="card-body">
        Choisissez une categorie afin d'acceder aux discussions
    </div>
</div>
<div class="row forum_categories">
    <?php foreach ($filieres As $filiere) : ?>
    <div class="col-12 col-sm-4 col-md-4 col-lg-3 d-flex mb-sm-4">
        <div class="category bg-white">
            <div class="img mb-4"
                style="background-image: url('<?= img_url('illustrations/filiere-'.scl_moveSpecialChar($filiere->nom_filiere).'.jpg'); ?>');"></div>
            <div class="info text-center">
                <h3><a  href="<?= site_url('students/forum/c/'.scl_moveSpecialChar($filiere->id_filiere.'-'.$filiere->nom_filiere)); ?>"><?= ucwords($filiere->nom_filiere); ?></a></h3>
                <div class="text"><p>Forum dedié aux etudiants de <?= ucwords($filiere->code_filiere); ?></p></div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
    <div class="col-12 col-sm-4 col-md-4 col-lg-3 d-flex mb-sm-4">
        <div class="category bg-white">
            <div class="img mb-4"
                 style="background-image: url('<?= img_url('illustrations/intercultural_communication_challenges-1024x840.jpg'); ?>');"></div>
            <div class="info text-center">
                <h3><a href="<?= site_url('students/forum/c/0-campus'); ?>">Notre campus</a></h3>
                <div class="text"><p>Forum dedié a toute la communauté estudiantine</p></div>
            </div>
        </div>
    </div>
</div>
