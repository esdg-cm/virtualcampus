<?php use dFramework\core\output\Layout; ?>

<!-- Page Title Header Starts-->
<div class="row page-title-header pb-0">
    <div class="col-12">
        <div class="page-header pb-0 mb-0 d-flex justify-content-between">
            <h4 class="page-title"> <i class="fa fa-cube"></i> Ressources du cours</h4>
            <nav aria-label="breadcrumb" class="d-none d-md-block  mb-0 pb-0">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= site_url(); ?>">Accueil</a></li>
                <li class="breadcrumb-item"><a href="<?= site_url('students/courses'); ?>">Cours</a></li>
                <li class="breadcrumb-item notranslate" translate="no"><a href="<?= site_url('students/courses/'.scl_moveSpecialChar($matiere->id_matiere.'-'.$matiere->nom_matiere)); ?>"><?= ucfirst($matiere->nom_matiere); ?></a></li>
                <li class="breadcrumb-item active" aria-current="page">Ressources</li>
              </ol>
            </nav>
        </div>
    </div>
</div>
<!-- Page Title Header Ends-->

<?php
$active_video = $active_pdf = $rid = '';

if(!empty($query['prid'])) {
    $active_pdf = 'active';
    $rid = $query['prid'];
}
else {
    $active_video = 'active';
    $rid = $query['vrid'] ?? '';
}
?>


<div class="card">
    <div class="card-body px-3">
        <nav class="w-100 d-flex justify-content-between border-bottom">
            <h4 class="text-primary notranslate" translate="no"><?= ucfirst($matiere->nom_matiere); ?></h4>
            <div class="nav nav-tabs border-0" id="nav-tab" role="tablist">
                <a class="nav-item nav-link <?= $active_video; ?>" data-toggle="tab" href="<?= site_url('students/courses/ajax_resources/'.$matiere->id_matiere.'/?display=videos'); ?>" role="tab" aria-selected="true" data-dan-target="resources-box" data-dan-animation="facebook"
                >
                    <i class="fa fa-lg fa-video"></i>
                    <span>Videos</span>
                </a>
                <a class="nav-item nav-link <?= $active_pdf; ?>" data-toggle="tab" href="<?= site_url('students/courses/ajax_resources/'.$matiere->id_matiere.'/?display=pdf'); ?>" role="tab" aria-selected="false" data-dan-target="resources-box" data-dan-animation="facebook">
                    <i class="fa fa-lg fa-file-pdf"></i>
                    <span>PDF</span>
                </a>
            </div>
        </nav>

        <div class="mt-3" data-dan-box="resources-box">
            <input type="hidden" value="<?= $rid; ?>">
        </div>
    </div>
</div>


<?php Layout::block('js'); ?>
    $(document).ready(function(){
        var url = $('a.active[data-dan-target="resources-box"]').attr('href'),
            rid = $('div[data-dan-box="resources-box"] input:hidden').val();
        if(rid != '') {
            url += '&rid='+rid;
        }
        $(window).dAN({
            target: 'resources-box',
            animation: 'facebook',
            url: url
        });
        $('a[data-dan-target="resources-box"]').click(function(){
            var current_url = window.location.href.split('?');
            current_url.pop();
            window.history.pushState({}, '', current_url.join(''));
        });
    });
<?php Layout::end(); ?>
