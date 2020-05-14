<form  id="createue" class="form-horizontal" method="post" action="<?= site_url('/admin/ue/add');?>">
	<div class="form-group row">
        <label for="inputEmail3" class="col-sm-4 offset-1 control-label"  style="float: right;color:lightblue;"><b>Création de l'UE</b></label>
        <label class="col-sm-7 control-label" style="color:red;font-size: 15px;float: right;">(Les champs avec * sont obligatoires)
        </label>
    </div><hr>
    <div class="form-group row">
        <label for="inputEmail3" class="col-sm-4 control-label">Nom de L'UE (<span style="color:red">*</span>)</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="inputEmail3" placeholder="Exemple :Mathématique" name="nom_ue" required="required">
        </div>
    </div>
    <div class="form-group row">
        <label for="inputEmail3" class="col-sm-4 control-label">Code de l'UE (<span style="color:red">*</span>)</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="inputEmail3" placeholder="Exemple :maths" name="code_ue" required="required">
        </div>
    </div>
    <div class="form-group row">
        <label for="inputEmail3" class="col-sm-4 control-label">Nombre crédit (<span style="color:red">*</span>)</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="inputEmail3" placeholder="Exemple :maths" name="credit" required="required">
        </div>
    </div>
    <div class="form-group row">
        <label for="inputEmail3" class="col-sm-4 control-label">Nom du semestre (<span style="color:red">*</span>)</label>
        <div class="input-group col-sm-8">
        	<select class="form-control" name="id_semestre">
        		<option disabled selected>veuillez selectionnez le semestre</option>
        		<?php foreach($semestres as $semestre):?>
                	<option value="<?= $semestre->id_semestre;?>"><?= $semestre->nom_semestre?></option>
                <?php endforeach;?>
            </select>
        </div>
    </div>
    <!--<div class="form-group row">
        <label for="inputEmail3" class="col-sm-4 control-label">Nom de la filière (<span style="color:red">*</span>)</label>
        <div class="input-group col-sm-8">
            <select class="form-control" name="id_filiere">
                <option disabled selected>veuillez selectionnez la filière</option>
                <?php foreach($filieres as $filiere):?>
                    <option value="<?= $filiere->id_filiere;?>"><?= $filiere->nom_filiere?></option>
                <?php endforeach;?>
            </select>
        </div>
    </div>-->
    <div class="form-group row">
        <button type="submit" class="btn btn-success col-3 offset-3">Créer</button>
        <button type="reset" class="btn btn-danger col-3 offset-1">Annuler</button>
    </div>
</form>