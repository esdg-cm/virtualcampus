<?php use dFramework\core\output\Layout; ?>

<!-- Page Title Header Starts-->
<div class="row page-title-header">
    <div class="col-12 py-0 m-0">
        <div class="page-header d-flex py-0 my-0 justify-content-between">
            <h4 class="page-title"> <i class="fa fa-comments"></i> Forum</h4>
            <nav aria-label="breadcrumb" class="d-none d-md-block m-0">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= site_url('students'); ?>">Accueil</a></li>
                <li class="breadcrumb-item"><a href="<?= site_url('students/forum'); ?>">Forum</a></li>
                <li class="breadcrumb-item"><a href="<?= site_url('students/forum/c/'.scl_moveSpecialChar($billet->filiere('id_filiere').'-'.$billet->filiere('nom_filiere'))); ?>"><?= $billet->filiere('nom_filiere'); ?></a></li>
                <li class="breadcrumb-item active" aria-current="page">Lecture</li>
              </ol>
            </nav>
        </div>
    </div>
</div>
<!-- Page Title Header Ends-->


<h3 class="text-muted"><?= $billet->getSubject(); ?></h3>

<div class="card mt-4 mb-2">
    <div class="card-body bg-light row">
        <div class="col-12 col-md-2 d-flex flex-column justify-content-center align-items-center">
            <img src="<?= $billet->auteur()->getAvatar(); ?>" alt="<?= $billet->auteur()->getProfil(); ?>" style="height:5em; width: 5em" class="img-fluid img-thumbnail rounded-circle" />
            <h4 class="text-primary my-1"><?= $billet->auteur()->getProfil(); ?></h4>
            <h6 class="text-muted"><?= $billet->auteur()->getClasse('code_classe'); ?></h6>
        </div>
        <div class="col-12 col-md-10">
            <span class="float-right text-muted small font-italic"><?= $billet->getDate(); ?></span>
            <div class="clearfix mt-5"><?= $billet->getContent(); ?></div>
            <div class="d-flex justify-content-between mt-4">
                <span></span>
                <ul class="d-inline-flex justify-content-between align-items-center" style="list-style: none">
                    <?php if($billet->id_utilisateur == $User->id_utilisateur) : ?>
                    <li class="small text-muted">
                        <a class="btn btn-sm btn-link px-1" href="">
                            <i class="fa fa-sm fa-edit"></i>
                            <span class="d-none d-md-inline-block">Editer</span>
                        </a>
                    </li>
                    <?php endif; ?>
                    <li class="small text-muted">
                        <a class="btn btn-sm btn-link px-1" href="">
                            <i class="fa fa-sm fa-quote-left"></i>
                            <span class="d-none d-md-inline-block">Citer</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>



<?php $commentaires = $billet->commentaires(); ?>
<?php if(!empty($commentaires)): echo '<br><br>'; foreach ($commentaires As $commentaire) : ?>
    <div class="card my-2">
        <div class="card-body bg-light row">
            <div class="col-12 col-md-2 d-flex flex-column justify-content-center align-items-center">
                <img src="<?= $commentaire->auteur()->getAvatar(); ?>" alt="<?= $commentaire->auteur()->getProfil(); ?>" style="height:5em; width: 5em" class="img-fluid img-thumbnail rounded-circle" />
                <h4 class="text-primary my-1"><?= $commentaire->auteur()->getProfil(); ?></h4>
                <h6 class="text-muted"><?= $commentaire->auteur()->getClasse('code_classe'); ?></h6>
            </div>
            <div class="col-12 col-md-10">
                <span class="float-right text-muted small font-italic"><?= $commentaire->getDate(); ?></span>
                <div class="clearfix mt-5"><?= $commentaire->getContent(); ?></div>
                <div class="d-flex justify-content-between mt-4">
                    <?php if($billet->id_utilisateur == $User->id_utilisateur) : ?>
                        <span><a class="btn btn-sm btn-link px-1" href="">
                            <i class="fa fa-sm fa-check"></i>
                            <span class="d-none d-md-inline-block">Marquer comme meilleure solution</span>
                        </a></span>
                    <?php endif; ?>
                    <ul class="d-inline-flex justify-content-between align-items-center" style="list-style: none">
                        <?php if($commentaire->id_utilisateur == $User->id_utilisateur) : ?>
                        <li class="small text-muted">
                            <a class="btn btn-sm btn-link px-1" href="">
                                <i class="fa fa-sm fa-edit"></i>
                                <span class="d-none d-md-inline-block">Editer</span>
                            </a>
                        </li>
                        <?php endif; ?>
                        <li class="small text-muted">
                            <a class="btn btn-sm btn-link px-1" href="#" onclick="citer();">
                                <i class="fa fa-sm fa-quote-left"></i>
                                <span class="d-none d-md-inline-block">Citer</span>
                            </a>
                        </li>
                        <li class="mx-2">|</li>
                        <li class="small text-muted">
                            <a class="btn btn-sm btn-link px-1" href="">
                                <i class="far fa-sm fa-thumbs-up"></i>
                                <span class="d-none d-md-inline-block">Apprecier</span>
                            </a>
                        </li>
                        <li class="small text-muted">
                            <a class="btn btn-sm btn-link px-1" href="">
                                <i class="far fa-sm fa-thumbs-down"></i>
                                <span class="d-none d-md-inline-block">Deprecier</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; endif; ?>


<br>

<form class="card mt-3 px-0" action="<?= site_url('students/forum/topic/'.$billet->id_billet); ?>">
    <div class="card-body">
        <h3 class="mb-4">Repondre au sujet</h3>
        <div class="form-group" id="editor">
            <label>Message</label>
          <textarea id='froalaedit' name="contenu" style="margin-top: 30px;" placeholder="Dites nous ce que vous en pensez par rapport a ce sujet"></textarea>
        </div>
        
        <label class="result text-danger"></label>
        <div class="mt-3 d-flex justify-content-between align-items-center">
            <?php if($billet->id_utilisateur == $User->id_utilisateur) : ?>
                <label>
                    <input type="checkbox" name="resolu">
                    <span class="d-inline-block ml-2">Marquer comme resolu</span>
                </label>
            <?php endif; ?>
            <button type="submit" class="btn btn-primary btn-lg">
                Publier
            </button>
        </div>
    </div>
</form>
