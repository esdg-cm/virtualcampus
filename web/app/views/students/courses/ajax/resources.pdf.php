<div class="row flex-row-reverse">
    <div class="col-lg-4 mb-1">
        <div class="w-100 accordion">
            <div class="card">
                <div style="cursor: pointer" class="card-header bg-primary py-3" data-toggle="collapse" data-target="#list_pdf">
                    <h5 class="card-title d-flex justify-content-between text-white">
                        <span>PDF disponible</span>
                        <i class="fa fa-chevron-down"></i>
                    </h5>
                </div>
                <div id="list_pdf" class="collapse">
                    <div class="card-body p-2">
                        <ul class="m-0 list-arrow">
                            <?php foreach ($ressources As $res) : ?>
                                <?php if(!$res->is('pdf')) { continue; } ?>
                                <li class="my-2" style="font-size: 1.25em">
                                    <a href="?prid=<?= $res->id_ressource; ?>"><?= ucfirst($res->titre_ressource); ?></a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <?php if(empty($ressource)) : ?>
            <div class="alert alert-info text-center">
                <i class="fa fa-exclamation-triangle fa-3x"></i><br>
                Veuillez selectionner un pdf dans la liste des ressouces pour l'afficher
            </div>
        <?php else : ?>
            <object
                class="w-100"
                type=""
                style="height:30em"
                data="<?= $ressource->url(); ?>">
            </object>
        <?php endif; ?>
    </div>
</div>
