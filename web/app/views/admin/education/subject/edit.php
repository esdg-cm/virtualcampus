<form  id="editsubject" class="form-horizontal" method="post" action="<?= site_url('/admin/subject/edit/'.$matieres->id_matiere);?>">
	<div class="form-group row">
        <label for="inputEmail3" class="col-sm-4 control-label"  style="float: right;color:lightblue;"><b>Modification de la Matière</b></label>
        <label class="col-sm-7 offset-1 control-label" style="color:red;font-size: 15px;float: right;">(Les champs avec * sont obligatoires)
        </label>
    </div><hr>
    <div class="form-group row">
        <label for="inputEmail3" class="col-sm-4 control-label">Nom Matière (<span style="color:red">*</span>)</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="inputEmail3" placeholder="Exemple :Mathématique" name="nom_matiere" required="required" value="<?= $matieres->nom_matiere;?>">
        </div>
    </div>
    <div class="form-group row">
        <label for="inputEmail3" class="col-sm-4 control-label">reférence Matière(<span style="color:red">*</span>)</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="inputEmail3" placeholder="Exemple :maths" name="ref_matiere" required="required" value="<?= $matieres->ref_matiere;?>">
        </div>
    </div>
    <div class="form-group row">
        <label for="inputEmail3" class="col-sm-4 control-label">Coeficient (<span style="color:red">*</span>)</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="inputEmail3" placeholder="Exemple : 4" name="coef" required="required" value="<?= $matieres->coef;?>">
        </div>
    </div>
    <div class="form-group row">
        <label for="inputEmail3" class="col-sm-4 control-label">Nbre heure TP (<span style="color:red">*</span>)</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="inputEmail3" placeholder="Exemple : 10" name="nbr_hr_tp" required="required" value="<?= $matieres->nbr_hr_tp;?>">
        </div>
    </div>
    <div class="form-group row">
        <label for="inputEmail3" class="col-sm-4 control-label">Nbre heure TD (<span style="color:red">*</span>)</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="inputEmail3" placeholder="Exemple : 15" name="nbr_hr_td" required="required" value="<?= $matieres->nbr_hr_td;?>">
        </div>
    </div>
    <div class="form-group row">
        <label for="inputEmail3" class="col-sm-4 control-label">Nbre heure CM (<span style="color:red">*</span>)</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="inputEmail3" placeholder="Exemple : 25" name="nbr_hr_cm" required="required" value="<?= $matieres->nbr_hr_cm;?>">
        </div>
    </div>
    <div class="form-group row">
        <label for="inputEmail3" class="col-sm-4 control-label">Nom de l'UE (<span style="color:red">*</span>)</label>
        <div class="input-group col-sm-8">
        	<select class="form-control" name="id_ue">
        		<?php foreach($ue as $ue):
        			$selected=($ue->id_ue == $matieres->id_ue) ? 'selected' : '';?>
                	<option value="<?= $ue->id_ue;?>" <?= $selected;?> ><?= $ue->nom_ue;?></option>
                <?php endforeach;?>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <button type="submit" class="btn btn-success col-3 offset-3">Modifier</button>
        <button type="reset" class="btn btn-danger col-3 offset-1">Annuler</button>
    </div>
</form>