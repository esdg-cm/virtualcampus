<form  id="createclass" class="form-horizontal" method="post" action="<?= site_url('/admin/class/add')?>">
    <div class="form-group row">
        <label for="inputEmail3" class="col-sm-5 control-label"  style="float: right;color:lightblue;"><b>Création de la classe</b></label>
        <label class="col-sm-7 control-label" style="color:red;font-size: 15px;float: right;">(Les champs avec * sont obligatoires)
        </label>
    </div><hr>
    <div class="form-group row">
        <label for="inputEmail3" class="col-sm-4 control-label">Nom de la classe (<span style="color:red">*</span>)</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="inputEmail3" placeholder="Exemple :Genie logiciel 3 C" name="nom_classe" required="required">
        </div>
    </div>
    <div class="form-group row">
        <label for="inputPassword3" class="col-sm-4 control-label">Code de la classe (<span style="color:red">*</span>)</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="inputPassword3" placeholder="Exemple : GL3C " name="code_classe" required="required">
            </div>
    </div>
    <div class="form-group row">
        <label for="inputPassword3" class="col-sm-4 control-label">Nom du centre (<span style="color:red">*</span>)</label>
        <div class="input-group col-sm-8">
        	<select class="form-control" name="id_centre">
        		<option disabled selected>veuillez selectionnez le centre</option>
        		<?php foreach($centres as $centre):?>
                	<option value="<?= $centre->id_centre;?>"><?= $centre->nom_centre?></option>
                <?php endforeach;?>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label for="inputPassword3" class="col-sm-4 control-label">Nom du niveau (<span style="color:red">*</span>)</label>
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
        <label for="inputPassword3" class="col-sm-4 control-label">Nom de la filière (<span style="color:red">*</span>)</label>
        <div class="input-group col-sm-8">
        	<select class="form-control" name="id_filiere">
        		<option disabled selected>veuillez selectionnez la filiere</option>
        		<?php foreach($filieres as $filiere):?>
                	<option value="<?= $filiere->id_filiere;?>"><?= $filiere->nom_filiere?></option>
                <?php endforeach;?>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <button type="submit" class="btn btn-success col-3 offset-3">Créer</button>
        <button type="reset" class="btn btn-danger col-3 offset-1">Annuler</button>
    </div>
</form>