<?php use dFramework\core\output\Layout; ?>


<!-- Page Title Header Starts-->
<div class="row page-title-header pb-0">
    <div class="col-12">
        <div class="page-header pb-0 mb-0 d-flex justify-content-between">
            <h4 class="page-title"> <i class="fa fa-atlas"></i> Glossaire du cours</h4>
            <nav aria-label="breadcrumb" class="d-none d-md-block  mb-0 pb-0">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= site_url(); ?>">Accueil</a></li>
                <li class="breadcrumb-item"><a href="<?= site_url('students/courses'); ?>">Cours</a></li>
                <li class="breadcrumb-item notranslate" translate="no"><a href="<?= site_url('students/courses/'.scl_moveSpecialChar($matiere->id_matiere.'-'.$matiere->nom_matiere)); ?>"><?= ucfirst($matiere->nom_matiere); ?></a></li>
                <li class="breadcrumb-item active" aria-current="page">Glossaire</li>
              </ol>
            </nav>
        </div>
    </div>
</div>
<!-- Page Title Header Ends-->

<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
            <h4 class="text-primary notranslate" translate="no"><?= ucfirst($matiere->nom_matiere); ?></h4>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addDefinitionModal"><i class="fa fa-plus-circle"></i> Ajouter une definition</button>
        </div>
        <div><?php
            if(empty($glossaires)) : ?>
                <div class="alert alert-info text-center">
                    <i class="fa fa-exclamation-triangle fa-2x"></i><br>
                    Aucun terme enregistré pour cette matiere
                </div>
            <?php else: ?>
                <dl><?php foreach ($glossaires As $glossaire) : ?>
                    <dt>
                        <span class="fa-lg"><?= ucfirst($glossaire->terme); ?></span>
                        <span class="float-right small text-muted">Ajouté par <?= $glossaire->auteur('nom').' '.$glossaire->auteur('prenom'); ?></span>
                    </dt>
                    <dd class="mb-4"><?= ucfirst($parser->markdown($glossaire->contenue)); ?></dd>
                <?php endforeach; ?></dl>
            <?php endif;
        ?></div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="addDefinitionModal" tabindex="-1" role="dialog" aria-hidden="true">
    <form action="<?= site_url('students/courses/glossary/'.$matiere->id_matiere); ?>" class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ajouter une definition au glossaire</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label" for="terme">Terme</label>
                    <input type="text" id="terme" name="terme" placeholder="Entrer le terme a definir" class="form-control" />
                </div>
                <div class="form-group">
                    <label class="form-label" for="contenue">Definition</label>
                    <textarea id="contenue" name="contenue" placeholder="Entrer la definition de votre terme" class="form-control" style="height:20em"></textarea>
                    <p class="text-info small">Vous pouvez utiliser du <a target="_blank" href="https://openclassrooms.com/fr/courses/1304236-redigez-en-markdown">Markdown code</a> pour formater votre definition</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Ajouter</button>
            </div>
        </div>
    </form>
</div>

<?php Layout::block('js'); ?>
    $(document).ready(function(){
        $('#addDefinitionModal form').submit(function(e) {
            e.preventDefault();
            var form = $(this);
            $.post(form.attr('action'), form.serialize(), function(result){
                if(/<error>/.test(result)) {
                    App.result({
                        icon : 'fa fa-times',
                        title : 'Error',
                        type : 'red',
                        content : result.replace('<error>', '')
                    });
                }
                else {
                    App.result({
                        content : result.replace('<ok>', ''),
                        buttons : {
                            ok: {
                                text: 'Ok', btnClass: 'btn-blue',
                                action: function() {window.location.reload();}
                            }
                        }
                    });
                }
            });
        });
    });
<?php Layout::end(); ?>
