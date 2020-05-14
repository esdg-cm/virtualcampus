<div class="row">
    <div class="col-lg-6">
        <h4 class="text-primary">Initiation a l'algorithmique</h4>
        <dl class="row my-2">
            <dd class="col-lg-6">Unite d'enseignement</dd>
            <dt class="col-lg-6">Algorithme et programmation</dt>
        </dl>
        <dl class="row my-2">
            <dd class="col-lg-6">Coefficient</dd>
            <dt class="col-lg-6">4</dt>
        </dl>
        <dl class="row my-2">
            <dd class="col-lg-6">Professeur</dd>
            <dt class="col-lg-6">Mbang David</dt>
        </dl>
        <hr>
        <dl class="row my-2">
            <dd class="col-lg-6">Note total</dd>
            <dt class="col-lg-6">12/20</dt>
        </dl>
        <dl class="row my-2">
            <dd class="col-lg-6">Note total</dd>
            <dt class="col-lg-6">40%</dt>
        </dl>
        <dl class="row my-2">
            <dd class="col-lg-6">Note definitive</dd>
            <dt class="col-lg-6"><?= (0.4 * 12) . '/20'; ?></dt>
        </dl>
    </div>
    <div class="col-lg-6">
        <div class="accordion" id="accordionAllCC">
            <div class="card">
                <div class="card-header py-1 bg-secondary">
                    <h5 class="mb-0"><button class="btn btn-link btn-block" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true">
                        Controle continu #1
                    </button></h5>
                </div>
                <div id="collapseOne" class="collapse show" data-parent="#accordionAllCC">
                    <div class="card-body">
                        <dl class="row my-2">
                            <dd class="col-lg-6">Date d'examination</dd>
                            <dt class="col-lg-6">02 avril 2020</dt>
                        </dl>
                        <dl class="row my-2">
                            <dd class="col-lg-6">Forme d'examination</dd>
                            <dt class="col-lg-6">Quiz</dt>
                        </dl>
                        <dl class="row my-2">
                            <dd class="col-lg-6">Note obtnue</dd>
                            <dt class="col-lg-6">12/20</dt>
                        </dl>
                        <a target="_blank" href="<?= site_url('students/actions/getpdf/exams/1'); ?>">Recuperer le PDF</a>
                    </div>
                </div>
            </div>
        <?php for($i=1; $i < 3; $i++) : ?>
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><button class="btn btn-link btn-block collapsed" type="button" data-toggle="collapse" data-target="#collapse<?= $i; ?>" aria-expanded="false">
                        Collapsible Group Item #2
                    </button></h5>
                </div>
                <div id="collapse<?= $i; ?>" class="collapse" data-parent="#accordionAllCC">
                    <div class="card-body">
                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus
                        terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                    </div>
                </div>
            </div>
        <?php endfor; ?>
        </div>
    </div>
</div>
