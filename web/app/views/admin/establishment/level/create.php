<form  id="createlevel" class="form-horizontal" method="post" action="<?= site_url('/admin/level/add')?>">
    <div class="form-group row">
        <label for="inputEmail3" class="col-sm-5 control-label"  style="float: right;color:lightblue;"><b>Création d'une filière</b></label>
        <label class="col-sm-7 control-label" style="color:red;font-size: 15px;float: right;">(Les champs avec * sont obligatoires)
        </label>
    </div><hr>
    <div class="form-group row">
        <label for="inputEmail3" class="col-sm-4 control-label">Nom du Niveau (<span style="color:red">*</span>)</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="inputEmail3" placeholder="Exemple :Niveau 1" name="nom_niveau" required="required">
        </div>
    </div>
    <div class="form-group row">
        <label for="inputPassword3" class="col-sm-4 control-label">Code du Niveau (<span style="color:red">*</span>)</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="inputPassword3" placeholder="Exemple : Niv1 " name="code_niveau" required="required">
            </div>
    </div>
    <div class="form-group row">
        <button type="submit" class="btn btn-success col-3 offset-3">Créer</button>
        <button type="reset" class="btn btn-danger col-3 offset-1">Annuler</button>
    </div>
</form>