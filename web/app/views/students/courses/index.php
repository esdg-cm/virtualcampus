<!-- Page Title Header Starts-->
<div class="row page-title-header">
    <div class="col-12 py-0 m-0">
        <div class="page-header d-flex py-0 my-0 justify-content-between">
            <h4 class="page-title"> <i class="fa fa-book"></i> Liste des cours</h4>
            <nav aria-label="breadcrumb" class="d-none d-md-block m-0">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= site_url('students'); ?>">Accueil</a></li>
                <li class="breadcrumb-item active" aria-current="page">Cours</li>
              </ol>
            </nav>
        </div>
    </div>
</div>
<!-- Page Title Header Ends-->

<div class="card"><div class="card-body px-3 p-md-2">
    <div class="row" id="accordionEx">
    <?php if(empty($ues)) : ?>
        <div class="alert alert-info text-center">
            <i class="fa fa-exclamation-triangle fa-2x"></i> <br>
            Aucune unité d'enseignement enregistrée pour votre classe
        </div>
    <?php else : foreach($ues As $ue) : ?>
        <div class="col-12 accordion my-2">
        <div class="card">
            <div style="cursor: pointer" class="card-header bg-primary py-3" data-toggle="collapse" data-target="#ue_<?= $ue->id_ue; ?>">
                <h5 class="card-title d-flex justify-content-between text-white">
                    <span><i class="fa fa-graduation-cap"></i> <?= ucfirst($ue->nom_ue); ?></span>
                    <i class="fa fa-chevron-down"></i>
                </h5>
            </div>
            <div id="ue_<?= $ue->id_ue; ?>" class="collapse" data-parent="#accordionEx">
              <div class="card-body">
                <div class="row flex-column-reverse flex-md-row-reverse">
                    <div class="col-lg-8 mt-3 mt-md-0"><?php
                        $matieres = $ue->getMatieres();
                        $total_heures = 0;
                        if(empty($matieres)) : ?>
                            <div class="alert alert-info text-center">
                                Aucune matiere enregistrée pour cette unité d'enseignement
                            </div>
                        <?php else : ?><ul class="list-arrow"><?php
                            foreach ($matieres As $matiere) : ?>
                                <li class="fa-lg pt-2 pb-3">
                                    <a href="<?= site_url('students/courses/'.scl_moveSpecialChar($matiere->id_matiere.'-'.$matiere->nom_matiere)); ?>"><?= ucfirst($matiere->nom_matiere); ?></a>
                                </li>
                                <?php $total_heures += ($matiere->nbr_hr_tp + $matiere->nbr_hr_td + $matiere->nbr_hr_cm); ?>
                            <?php endforeach;
                        ?></ul><?php endif; ?>
                    </div>
                    <div class="col-lg-4">
                        <dl class="row mb-2">
                            <dt class="col-8">Code</dt>
                            <dd class="col-4"><?= strtoupper($ue->code_ue); ?></dd>
                        </dl>
                        <dl class="row mb-2">
                            <dt class="col-8">Nombre de credit</dt>
                            <dd class="col-4"><?= $ue->credit; ?></dd>
                        </dl>
                        <dl class="row mb-2">
                            <dt class="col-8">Volume horaire total</dt>
                            <dd class="col-4"><?= $total_heures.' h'; ?></dd>
                        </dl>
                    </div>
                </div>
              </div>
            </div>
        </div>
        </div>
    <?php endforeach; endif; ?>
    </div>
</div></div>
