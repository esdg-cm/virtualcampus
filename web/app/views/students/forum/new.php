<!-- Page Title Header Starts-->
<div class="row page-title-header">
    <div class="col-12 py-0 m-0">
        <div class="page-header d-flex py-0 my-0 justify-content-between">
            <h4 class="page-title"> <i class="fa fa-comment-dots"></i> Forum</h4>
            <nav aria-label="breadcrumb" class="d-none d-md-block m-0">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= site_url('students'); ?>">Accueil</a></li>
                <li class="breadcrumb-item"><a href="<?= site_url('students/forum'); ?>">Forum</a></li>
                <li class="breadcrumb-item active" aria-current="page">Nouveau sujet</li>
              </ol>
            </nav>
        </div>
    </div>
</div>
<!-- Page Title Header Ends-->

<h4 class="">Creer un nouveau sujet</h4>

<form method="post" class="card mt-4 mb-2" action="<?= site_url('students/forum/new/?cat='.$id_filiere); ?>">
    <div class="card-body">
        <div class="row">
            <div class="col-12 col-lg-6">
                <div class="form-group">
                    <label>Filiere</label>
                    <select name="id_filiere" class="form-control">
                        <option disabled>--- Selectionner la categorie correspondante a votre sujet ---</option>
                        <?php if(!empty($filieres)): foreach($filieres As $filiere) : ?>
                            <?php $selected = ($filiere->id_filiere == $id_filiere) ? 'selected="selected"' : ''; ?>
                            <option value="<?= $filiere->id_filiere; ?>" <?= $selected; ?>><?= ucfirst($filiere->nom_filiere); ?></option>
                        <?php endforeach; endif; ?>
                        <option value="null">Campus</option>
                    </select>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="form-group">
                    <label>Sujet</label>
                    <input type="text" name="sujet" class="form-control" placeholder="Entrer l'objet de votre preoccupation" />
                </div>
            </div>
        </div>

        <div class="form-group" id="editor">
            <label class="">Message</label>
            <textarea id='froalaedit' name="contenu" style="margin-top: 30px;" placeholder="Decrivez nous votre probleme. Peut etre un ami vous aidera a trouver une solution"></textarea>
        </div>

        <div class="mt-3 d-flex justify-content-between align-items-center">
            <label class="response text-danger"></label>
            <button type="submit" class="btn btn-primary btn-lg">
                Publier
            </button>
        </div>
    </div>
</form>
