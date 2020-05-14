<div class="d-flex justify-content-end mb-2">
    <a href="<?= site_url('students/courses/'.$id_matiere.'/glossary'); ?>" class="btn btn-secondary">
        <i class="fa fa-expand"></i>
        Afficher dans une page entiere
    </a>
</div>

<div class="row" id="accordion_glossaire">
    <?php if(empty($glossaires)) : ?>
        <div class="alert alert-info text-center">
            <i class="fa fa-exclamation-triangle fa-2x"></i><br>
            Aucun terme enregistré pour cette matiere
        </div>
    <?php else: foreach ($glossaires As $glossaire) : ?>
        <div class="accordion my-2 col-12">
            <div class="card">
                <div style="cursor: pointer" class="card-header bg-primary py-3" data-toggle="collapse" data-target="#terme_<?= $glossaire->id_glossaire; ?>">
                    <h5 class="card-title d-flex justify-content-between text-white">
                        <span><?= ucfirst($glossaire->terme); ?></span>
                        <i class="fa fa-chevron-down"></i>
                    </h5>
                </div>
                <div id="terme_<?= $glossaire->id_glossaire; ?>" class="collapse" data-parent="#accordion_glossaire">
                  <div class="card-body">
                    <p><?= ucfirst($parser->markdown($glossaire->contenue)); ?></p>
                  </div>
                </div>
            </div>
        </div>
    <?php endforeach; endif; ?>
</div>
