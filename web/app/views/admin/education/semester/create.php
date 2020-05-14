<form  id="createsemester" class="form-horizontal" method="post" action="<?= site_url('/admin/semester/add');?>">
	<div class="form-group row">
        <label for="inputEmail3" class="col-sm-4 offset-1 control-label"  style="float: right;color:lightblue;"><b>Création du semestre</b></label>
        <label class="col-sm-7 control-label" style="color:red;font-size: 15px;float: right;">(Les champs avec * sont obligatoires)
        </label>
    </div><hr>
    <div class="form-group row">
        <label for="inputEmail3" class="col-sm-4 control-label">Nom du semestre (<span style="color:red">*</span>)</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="inputEmail3" placeholder="Exemple :IAI Yaoundé" name="nom_semestre" required="required">
        </div>
    </div>
    <div class="form-group row">
        <label for="inputEmail3" class="col-sm-4 control-label">Abréviation (<span style="color:red">*</span>)</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="inputEmail3" placeholder="Exemple :IAI Yaoundé" name="abreviation" required="required">
        </div>
    </div>
    <div class="form-group row">
        <label for="inputEmail3" class="col-sm-4 control-label">Nom du niveau (<span style="color:red">*</span>)</label>
        <div class="input-group col-sm-8">
            <select class="form-control" name="id_niveau">
                <option disabled selected>veuillez selectionnez le niveau</option>
                <?php foreach($niveaux as $niveau):?>
                    <option value="<?= $niveau->id_niveau;?>"><?= $niveau->nom_niveau?></option>
                <?php endforeach;?>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <button type="submit" class="btn btn-success col-3 offset-3">Créer</button>
        <button type="reset" class="btn btn-danger col-3 offset-1">Annuler</button>
    </div>
</form>