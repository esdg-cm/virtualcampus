<?php use dFramework\core\output\Layout; ?>

<!-- Page Title Header Starts-->
<div class="row page-title-header pb-0">
    <div class="col-12">
        <div class="page-header pb-0 mb-0 d-flex justify-content-between">
            <h4 class="page-title"> <i class="fa fa-book-reader"></i> Lecture du cours</h4>
            <nav aria-label="breadcrumb" class="d-none d-md-block  mb-0 pb-0">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= site_url(); ?>">Accueil</a></li>
                <li class="breadcrumb-item"><a href="<?= site_url('students/courses'); ?>">Cours</a></li>
                <li class="breadcrumb-item active notranslate" translate="no" aria-current="page"><?= ucfirst($matiere->nom_matiere); ?></li>
              </ol>
            </nav>
        </div>
    </div>
</div>
<!-- Page Title Header Ends-->

<div>
    <h2 class="text-muted notranslate" translate="no"><?= ucfirst($matiere->nom_matiere); ?></h2>
    <ul class="list row" style="list-style: none">
        <li class="col-auto"><i class="fa mx-1 fa-user-tie"></i> Dispensé par : <b><?= ucwords($prof->nom.' '.$prof->prenom); ?></b></li>
        <li class="col-auto"><i class="fa mx-1 fa-clock"></i> Duree : <b><?= $matiere->nbr_hr(). ' h'; ?></b></li>
        <li class="col-auto"><i class="fa mx-1 fa-star"></i> Coeff : <b><?= $matiere->coef; ?></b></li>
        <li class="col-auto"><a href="<?= site_url('students/actions/getpdf'); ?>" target="_blank" class="btn btn-primary"><i class="fa fa-file-pdf"></i> Recuperer en PDF</a></li>
    </ul>
</div>

<div class="card">
    <div class="card-body">
        <h4 class="mb-4 pb-2 border-bottom text-primary"><?= ucfirst($chapitre->titre_chap); ?></h4>

        <div><?= $chapitre->contenu; ?></div>
    </div>
</div>





<div class="fixed-plugin">
    <a href="#" class="toggle text-center"><i class="fa fa-cog fa-2x fa-spin icon"></i></a>
    <div class="fixed-content">
        <div class="fixed-header mb-3 d-flex justify-content-between align-items-center">
            <h5>Parametres du cours</h5>
            <a href="#" class="toggle text-black"><i class="fa fa-times-circle"></i></a>
        </div>
        <div class="fixed-body">
            <ul class="nav nav-tabs" role="tablist">
              <li class="nav-item">
                <a role="tab" data-toggle="tab" class="nav-link" href="<?= site_url('students/courses/ajax_sommaire/'.$matiere->id_matiere); ?>"
                    data-dan-target="courses-params"
                    data-dan-animation="facebook"
                      >
                    <i class="fa fa-lg fa-list"></i>
                    <span class="d-none d-md-inline-block">Sommaire</span>
                </a>
              </li>
              <li class="nav-item">
                <a role="tab" data-toggle="tab" class="nav-link" href="<?= site_url('students/courses/ajax_glossary/'.$matiere->id_matiere); ?>"
                    data-dan-target="courses-params"
                    data-dan-animation="facebook"
                      >
                    <i class="fa fa-lg fa-atlas"></i>
                    <span class="d-none d-md-inline-block">Glossaire</span>
                </a>
              </li>
              <li class="nav-item">
                <a role="tab" data-toggle="tab" class="nav-link" href="<?= site_url('students/courses/ajax_discussions/'.$matiere->id_matiere); ?>"
                    data-dan-target="courses-params"
                    data-dan-animation="facebook"
                      >
                    <i class="fa fa-lg fa-comments"></i>
                    <span class="d-none d-md-inline-block">Discussions</span>
                </a>
              </li>
              <li class="nav-item">
                <a role="tab" data-toggle="tab" class="nav-link" href="<?= site_url('students/courses/ajax_resources/'.$matiere->id_matiere); ?>"
                    data-dan-target="courses-params"
                    data-dan-animation="facebook"
                      >
                      <i class="fa fa-lg fa-cube"></i>
                    <span class="d-none d-md-inline-block">Ressources</span>
                </a>
              </li>
            </ul>
            <div class="tab-content mt-3">
                <div class="w-100" role="tabpanel" data-dan-box="courses-params">
                    <p class="alert alert-info text-center">
                        <i class="fa fa-exclamation-triangle fa-2x"></i> <br>
                        Veuillez choisir une option pour plus de details
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<button data-toggle="tooltip" class="disabled btn btn-success btn-lg rounded-circle position-fixed" style="bottom: 70px; right: 10px; width:3em; height:3em; padding: 1em !important; box-shadow: 2px 2px 2px gray;" data-placement="left" title="Repondre a l'appel">
    <i class="fa fa-phone fa-2x"></i>
</button>

<?php Layout::block('js'); ?>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    })
<?php Layout::end(); ?>
