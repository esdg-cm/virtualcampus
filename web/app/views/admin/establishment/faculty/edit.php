<form  id="editfaculty" class="form-horizontal" method="post" action="<?= site_url('/admin/faculty/edit/'.$filieres->id_filiere);?>">
    <div class="form-group row">
        <label for="inputEmail3" class="col-sm-5 control-label"  style="float: right;color:lightblue;"><b>Modification d'une filière</b></label>
        <label class="col-sm-7 control-label" style="color:red;font-size: 15px;float: right;">(Les champs avec * sont obligatoires)
        </label>
    </div><hr>
    <div class="form-group row">
        <label for="inputEmail3" class="col-sm-4 control-label">Nom de la filière (<span style="color:red">*</span>)</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="inputEmail3" placeholder="Exemple :Genie Logiciel" name="nom_filiere" required="required" value="<?= $filieres->nom_filiere;?>">
        </div>
    </div>
    <div class="form-group row">
        <label for="inputPassword3" class="col-sm-4 control-label">Code de la filière (<span style="color:red">*</span>)</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="inputPassword3" placeholder="Exemple : GL " name="code_filiere" required="required" value="<?= $filieres->code_filiere?>">
            </div>
    </div>
    <div class="form-group row">
        <button type="submit" class="btn btn-success col-3 offset-3">Modifier</button>
        <button type="reset" class="btn btn-danger col-3 offset-1">Annuler</button>
    </div>
</form>