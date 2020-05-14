<!-- Page Title Header Starts-->
<div class="row page-title-header">
    <div class="col-12 py-0 m-0">
        <div class="page-header d-flex py-0 my-0 justify-content-between">
            <h4 class="page-title"> <i class="fa fa-file"></i> Feuilles de presences</h4>
            <nav aria-label="breadcrumb" class="d-none d-md-block m-0">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a onclick="loadMainPage('<?= site_url('students'); ?>'); return false" href="<?= site_url('students'); ?>">Accueil</a></li>
                <li class="breadcrumb-item active" aria-current="page">Feuilles de presences</li>
              </ol>
            </nav>
        </div>
    </div>
</div>
<!-- Page Title Header Ends-->

<div class="card mb-3">
    <div class="card-body">
        Choisissez un mois pour y voir votre etat de presence
    </div>
</div>

<div class="row">
    <?php for($i = 0; $i < 10; $i++) : ?>
    <div class="col-12 col-sm-4 col-md-4 col-lg-3 my-1 mb-sm-4">
        <div class="card w-100">
            <div class="card-body">
                <div class="d-flex justify-content-center align-items-center flex-column text-muted">
                    <i class="far fa-calendar fa-3x"></i>
                    <h4 class="font-weight-bold">Janvier</h4>
                </div>

                <ul class="my-2 list-arrow">
                    <li class="py-1">18 Presences</li>
                    <li class="py-1">5 Absences</li>
                    <li class="py-1">2 Justifiées</li>
                    <li class="py-1">6h d'abscences au total</li>
                </ul>
                <a onclick="loadMainPage('<?= site_url('students/states/presences/?p=01-2019'); ?>'); return false;" href="<?= site_url('students/states/presences/?p=01-2019'); ?>" class="btn btn-block btn-primary">Plus de details <i class="fa fa-plus"></i></a>
            </div>
        </div>
    </div>
<?php endfor; ?>
</div>
