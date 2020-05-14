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
            <dd class="col-lg-6">Pourcentage sur la note</dd>
            <dt class="col-lg-6">60%</dt>
        </dl>
        <dl class="row my-2">
            <dd class="col-lg-6">Note definitive</dd>
            <dt class="col-lg-6"><?= (0.6 * 12) . '/20'; ?></dt>
        </dl>
    </div>
    <div class="col-lg-6">
        <div class="accordion" id="accordionAllCC">
            <div class="card">
                <div class="card-header py-1 bg-secondary">
                    <h5 class="mb-0"><button class="btn btn-link btn-block" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true">
                        Session Normale
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

            <div class="card">
                <div class="card-header py-1 bg-secondary">
                    <h5 class="mb-0"><button class="btn btn-link btn-block" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true">
                        Session de rattrapage
                    </button></h5>
                </div>
                <div id="collapseTwo" class="collapse" data-parent="#accordionAllCC">
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

        </div>
    </div>
</div>
