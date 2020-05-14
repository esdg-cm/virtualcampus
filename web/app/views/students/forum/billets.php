<?php use dFramework\core\output\Layout; ?>

<!-- Page Title Header Starts-->
<div class="row page-title-header">
    <div class="col-12 py-0 m-0">
        <div class="page-header d-flex py-0 my-0 justify-content-between">
            <h4 class="page-title"> <i class="fa fa-comment-dots"></i> Forum</h4>
            <nav aria-label="breadcrumb" class="d-none d-md-block m-0">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= site_url('students'); ?>">Accueil</a></li>
                <li class="breadcrumb-item"><a href="<?= site_url('students/forum'); ?>">Forum</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?= ucfirst($filiere->nom_filiere); ?></li>
              </ol>
            </nav>
        </div>
    </div>
</div>
<!-- Page Title Header Ends-->

<div class="card">
    <div class="card-header pb-0 border-0">
        <ul class="nav nav-tabs" role="tablist">
              <li class="nav-item">
                <a role="tab" data-toggle="tab" class="nav-link active" href="<?= site_url('students/forum/ajax_filter/'.$filiere->id_filiere.'/lasted'); ?>"
                    data-dan-target="list-bills"
                    data-dan-animation="facebook"
                      >
                    <i class="fa fa-lg fa-clock"></i>
                    <span class="d-none d-md-inline-block">Sujets rescents</span>
                </a>
              </li>
              <li class="nav-item">
                <a role="tab" data-toggle="tab" class="nav-link" href="<?= site_url('students/forum/ajax_filter/'.$filiere->id_filiere.'/resolved'); ?>"
                    data-dan-target="list-bills"
                    data-dan-animation="facebook"
                      >
                    <i class="fa fa-lg fa-check"></i>
                    <span class="d-none d-md-inline-block">Sujets resolus</span>
                </a>
              </li>
              <li class="nav-item">
                <a role="tab" data-toggle="tab" class="nav-link" href="<?= site_url('students/forum/ajax_filter/'.$filiere->id_filiere.'/own'); ?>"
                    data-dan-target="list-bills"
                    data-dan-animation="facebook"
                      >
                    <i class="fa fa-lg fa-user"></i>
                    <span class="d-none d-md-inline-block">Sujets auquels vous avez participer</span>
                </a>
              </li>
              <li class="nav-item">
                <a role="tab" class="btn btn-primary ml-2" href="<?= site_url('students/forum/new/?cat='.$filiere->id_filiere); ?>"
                      >
                      <i class="fa fa-lg fa-plus"></i>
                    <span class="d-none d-md-inline-block">Nouveau sujet</span>
                </a>
              </li>
        </ul>
    </div>
    <div class="card-body px-1 px-md-4">
        <div class="tab-content mt-3">
            <div class="w-100" role="tabpanel" data-dan-box="list-bills"></div>
        </div>
    </div>
</div>


<?php Layout::block('js'); ?>
    $(document).ready(function() {
        $(window).dAN({
            target: 'list-bills',
            animation: 'facebook',
            url: $('a.active[data-dan-target]').attr('href')
        });
    });
<?php Layout::end(); ?>
