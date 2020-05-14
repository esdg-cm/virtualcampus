<form  id="createcenter" class="form-horizontal" method="post" action="<?= site_url('/admin/center/add');?>">
    <div class="form-group row">
        <label for="inputEmail3" class="col-sm-5 control-label"  style="float: right;color:lightblue;"><b>Création d'un centre</b></label>
        <label class="col-sm-7 control-label" style="color:red;font-size: 15px;float: right;">(Les champs avec * sont obligatoires)
        </label>
    </div><hr>
    <div class="form-group row">
        <label for="inputEmail3" class="col-sm-4 control-label">Nom du Centre (<span style="color:red">*</span>)</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="inputEmail3" placeholder="Exemple :IAI Yaoundé" name="nom_centre" required="required">
        </div>
    </div>
    <div class="form-group row">
        <label for="inputPassword3" class="col-sm-4 control-label">Code du centre (<span style="color:red">*</span>)</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="inputPassword3" placeholder="Exemple : IAI-Yde " name="code_centre" required="required">
            </div>
    </div>
    <div class="form-group row">
        <label for="inputPassword3" class="col-sm-4 control-label">Telephone Responsable (<span style="color:red">*</span>)</label>
        <div class="input-group col-sm-8">
            <select class="form-control col-sm-3" name="indicatif">
                <option value="+244">+244</option>
                <option value="+237">+237</option>
                <option value="+236">+236</option>
                <option value="+242">+242</option>
                <option value="+243">+243</option>
                <option value="+241">+241</option>
                <option value="+240">+240</option>
                <option value="+239">+239</option>
                <option value="+235">+235</option>
            </select>
            <input type="text" name="tel_responsable" class="form-control col-sm-9" placeholder="691 88 95 87">
        </div>
    </div>
    <div class="form-group row">
        <label for="inputPassword3" class="col-sm-4 control-label">Localisation (<span style="color:red">*</span>)</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="inputPassword3" placeholder="Exemple : Awae Nkol-anga " name="localisation" required="required">
            </div>
    </div>
    <div class="form-group row">
        <button type="submit" class="btn btn-success col-3 offset-3">Créer</button>
        <button type="reset" class="btn btn-danger col-3 offset-1">Annuler</button>
    </div>
</form>