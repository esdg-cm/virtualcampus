<?php use dFramework\core\output\Layout; ?>

<!-- Page Title Header Starts-->
<div class="row page-title-header">
    <div class="col-12 py-0 m-0">
        <div class="page-header d-flex py-0 my-0 justify-content-between">
            <h4 class="page-title"> <i class="fa fa-chalkboard-teacher"></i> Contrôles continus</h4>
            <nav aria-label="breadcrumb" class="d-none d-md-block m-0">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= site_url('students'); ?>">Accueil</a></li>
                <li class="breadcrumb-item active" aria-current="page">Contrôles continus</li>
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
                <a role="tab" data-toggle="tab" class="nav-link active" href="<?= site_url('students/exams/ajax_cc/results'); ?>"
                    data-dan-target="list-cc"
                    data-dan-animation="facebook"
                      >
                    <i class="fa fa-lg fa-list-alt"></i>
                    <span class="d-none d-md-inline-block">Vos resultats</span>
                </a>
              </li>
              <li class="nav-item">
                <a role="tab" data-toggle="tab" class="nav-link" href="<?= site_url('students/exams/ajax_cc/programmated'); ?>"
                    data-dan-target="list-cc"
                    data-dan-animation="facebook"
                      >
                    <i class="fa fa-lg fa-clock"></i>
                    <span class="d-none d-md-inline-block">Devoirs programmés</span>
                </a>
              </li>
            <li class="nav-item ml-2">
                <a class="btn btn-primary" href="<?= site_url('students/exams/compose'); ?>">
                    <i class="fa fa-lg fa-pen-alt"></i>
                    <span class="">Composer</span>
                </a>
            </li>
        </ul>
    </div>
    <div class="card-body px-1 px-md-4">
        <div class="tab-content mt-3">
            <div class="w-100" role="tabpanel" data-dan-box="list-cc"></div>
        </div>
    </div>
</div>





<?php Layout::block('js'); ?>
    $(document).ready(function() {
        $(window).dAN({
            target: 'list-cc',
            animation: 'facebook',
            url: $('a.active[data-dan-target]').attr('href')
        });
    });
<?php Layout::end(); ?>
