<?php if(empty($ressources)) : ?>
<div class="alert alert-info text-center">
    <i class="fa fa-exclamation-triangle fa-3x"></i> <br>
    Aucune ressources disponible pour ce cours actuellement
</div>
<?php else : ?>

<div class="d-flex justify-content-end mb-2">
    <a href="<?= site_url('students/courses/'.$id_matiere.'/resources'); ?>" class="btn btn-secondary">
        <i class="fa fa-expand"></i>
        Afficher dans une page entiere
    </a>
</div>


<div class="row" id="accordion_resources">
    <div class="accordion my-2 col-12">
        <div class="card">
            <div style="cursor: pointer" class="card-header bg-primary py-3" data-toggle="collapse" data-target="#videos">
                <h5 class="card-title d-flex justify-content-between text-white">
                    <span><i class="fa fa-video"></i> Videos</span>
                    <i class="fa fa-chevron-down"></i>
                </h5>
            </div>
            <div id="videos" class="collapse" data-parent="#accordion_resources">
                <div class="card-body py-0">
                    <ul class="m-0 list-arrow">
                        <?php foreach ($ressources As $ressource) : ?>
                            <?php if(!$ressource->is('videos')) { continue; } ?>
                            <li class="my-2" style="font-size: 1.25em">
                                <a href="<?= site_url('students/courses/'.$id_matiere.'/resources/?vrid='.$ressource->id_ressource); ?>"><?= ucfirst($ressource->titre_ressource); ?></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="accordion my-2 col-12">
        <div class="card">
            <div style="cursor: pointer" class="card-header bg-primary py-3" data-toggle="collapse" data-target="#pdf">
                <h5 class="card-title d-flex justify-content-between text-white">
                    <span><i class="fa fa-file-pdf"></i> PDF</span>
                    <i class="fa fa-chevron-down"></i>
                </h5>
            </div>
            <div id="pdf" class="collapse" data-parent="#accordion_resources">
                <div class="card-body py-0">
                    <ul class="m-0 list-arrow">
                        <?php foreach ($ressources As $ressource) : ?>
                            <?php if(!$ressource->is('pdf')) { continue; } ?>
                            <li class="my-2" style="font-size: 1.25em">
                                <a href="<?= site_url('students/courses/'.$id_matiere.'/resources/?prid='.$ressource->id_ressource); ?>"><?= ucfirst($ressource->titre_ressource); ?></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<?php endif; ?>
