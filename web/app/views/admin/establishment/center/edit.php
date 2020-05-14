 <form  id="editcenter" class="form-horizontal" method="post" action="<?= site_url('/admin/center/edit/'.$centres->id_centre)?>">
    <div class="form-group row">
        <label for="inputEmail3" class="col-sm-5 control-label"  style="float: right;color:lightblue;"><b>Modification du centre</b></label>
        <label class="col-sm-7 control-label" style="color:red;font-size: 15px;float: right;">(Les champs avec * sont obligatoires)
        </label>
    </div><hr>
    <div class="form-group row">
        <label for="inputEmail3" class="col-sm-4 control-label">Nom du Centre (<span style="color:red">*</span>)</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="inputEmail3" value="<?= $centres->nom_centre?>" placeholder="Exemple :IAI Yaoundé" name="nom_centre" required="required">
        </div>
    </div>
    <div class="form-group row">
        <label for="inputPassword3" class="col-sm-4 control-label">Code du centre (<span style="color:red">*</span>)</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="inputPassword3" value="<?= $centres->code_centre?>" placeholder="Exemple : IAI-Yde " name="code_centre" required="required">
            </div>
    </div>
    <div class="form-group row">
        <label for="inputPassword3" class="col-sm-4 control-label">Telephone Responsable (<span style="color:red">*</span>)</label>
        <div class="input-group col-sm-8">
            <input type="text" name="tel_responsable" class="form-control" value="<?= $centres->tel_responsable?>" placeholder="691 88 95 87">
        </div>
    </div>
    <div class="form-group row">
        <label for="inputPassword3" class="col-sm-4 control-label">Localisation (<span style="color:red">*</span>)</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="inputPassword3" value="<?= $centres->localisation?>" placeholder="Exemple : Awae Nkol-anga " name="localisation" required="required">
            </div>
    </div>
    <div class="form-group row">
        <button type="submit" class="btn btn-success col-3 offset-3">Modifier</button>
        <button type="reset" class="btn btn-danger col-3 offset-1">Annuler</button>
    </div>
</form>