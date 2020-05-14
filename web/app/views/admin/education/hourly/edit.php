<form  id="edithourly" class="form-horizontal" method="post" action="<?= site_url('/admin/hourly/edit/'.$hourlies->id_tranche);?>">
    <div class="form-group row">
        <label for="inputEmail3" class="col-sm-4 offset-1 control-label"  style="float: right;color:lightblue;"><b>Edition d'une tranche horaire</b></label>
        <label class="col-sm-7 control-label" style="color:red;font-size: 15px;float: right;">(Les champs avec * sont obligatoires)
        </label>
    </div><hr>
    
    <div class="form-group row">
        <label for="inputEmail3" class="col-sm-4 control-label">Heure de debut (<span style="color:red">*</span>)</label>
        <div class="md-form md-outline col-sm-8 control-label">
            <input type="time" id="default-picker" name="heure_debut" class="form-control" value="<?= $hourlies->heure_debut ?>" placeholder="Select time">
        </div>
    </div>

    <div class="form-group row">
        <label for="inputEmail3" class="col-sm-4 control-label">Heure de fin (<span style="color:red">*</span>)</label>
        <div class="md-form md-outline col-sm-8 control-label">
            <input type="time" id="default-picker" name="heure_fin" class="form-control" value="<?= $hourlies->heure_fin ?>" placeholder="Select time">
        </div>
    </div>
    
    <div class="form-group row">
        <button type="submit" class="btn btn-success col-3 offset-3">Modifier</button>
        <button type="reset" class="btn btn-danger col-3 offset-1">Annuler</button>
    </div>
</form>