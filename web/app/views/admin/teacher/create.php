<div class="container register">
	<label class="control-label text-primary">Enregistrement d'un professeur <span style="color:red">( Les champs avec * sont obligatoires)</span></label><hr>
    <div class="row">
    	<div class="col-md-10 register-right offset-1 pt-1">
    	<form id="createteacher" name="" method="post" action="">
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="row register-form">
                        <div class="col-md-6" style="border-right: 1px solid lightblue;">
                            <div class="col-md-10">
                            	<label class="control-label">Profil du professeur</label><hr>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control col-md-10" placeholder="nom Professeur" name="nom"/>
                                <label class="col-md-1"><span style="color:red">*</span></label>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control col-md-10"  placeholder="prenom professeur" name="prenom"/>
                                <label class="col-md-1"><span style="color:red">*</span></label>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control col-md-10"  placeholder="email professeur" name="mdp"/>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control col-md-10" name="tel"  placeholder="Telephone professeur"/>
                            </div>
                            <div class="form-group">
                                <div class="maxl">
                                	<label class="control-label">Sexe du professeur</label>&nbsp
                                    <label class="radio inline offset-1">
                                        <input type="radio" name="sexe" value="masculin" checked>
                                        <span> Masculin </span>
                                    </label>
                                    <label class="radio inline">
                                        <input type="radio" name="sexe" value="feminin">
                                        <span>Feminin </span>
                                    </label>
                                    <label class="col-md-1 offset-1"><span style="color:red">*</span></label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                        	<div class="col-md-10">	
                        		<label class="control-label">Informations de Connexion</label><hr>
                        	</div>
                            <div class="form-group">
                                <input type="text" class="form-control col-md-10" placeholder="Login"name="login" />
                                <label class="col-md-1"><span style="color:red">*</span></label>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control col-md-10" placeholder="Mot de passe" name="mdp"/>
                                <label class="col-md-1"><span style="color:red">*</span></label>
                            </div>
                        	<div class="col-md-10">
                        		<label class="control-label">Informations Supplementaires</label><hr>
                        	</div>
                            <div class="form-group">
                                <input type="text" class="form-control col-md-10" name="specialite" placeholder="specialite du professeur" />
                                <label class="col-md-1"><span style="color:red">*</span></label>
                            </div>
                            <div class="form-group">
                                <input type="text" name="titre" class="form-control col-md-10" placeholder="titre du professeur" />
                                <label class="col-md-1"><span style="color:red">*</span></label>
                            </div>
                            <div class="form-group">
                                <div class="maxl">
                                	<label class="control-label offset-1">Membre de la DE</label>&nbsp
                                    <label class="radio inline offset-1">
                                        <input type="radio" name="is_member_de" value="oui">
                                        <span> oui </span>
                                    </label>&nbsp
                                    <label class="radio inline">
                                        <input type="radio" name="is_member_de" value="non" checked>
                                        <span> non </span>
                                    </label>
                                    <label class="col-md-1 offset-2"><span style="color:red">&nbsp*</span></label>
                                </div>
                            </div>
                            <div class="form-group offset-2 pt-2">
                                <input type="submit" class="btn btn-success"  value="Enregistrer"/>
                            	<input type="reset" class="btn btn-danger offset-1"  value="annuler"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        </div>
    </div>

</div>