<div class="container register">
	<label class="control-label text-primary">Modification d'un Etudiant <span style="color:red">( Les champs avec * sont obligatoires)</span></label><hr>
    <div class="row">
    	<div class="col-md-10 register-right offset-1 pt-1">
    	<form id="editstudent" name="" method="post" action="">
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="row register-form">
                        <div class="col-md-6" style="border-right: 1px solid lightblue;">
                            <div class="col-md-10">
                            	<label class="control-label">Profil de l'étudiant</label><hr>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control col-md-10" value="<?= $users->nom ?>"  disabled/>
                                <input type="hidden" class="form-control col-md-10" name="nom" value="<?= $users->nom ?>"/>
                                <label class="col-md-1"><span style="color:red">*</span></label>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control col-md-10" value="<?= $users->prenom ?>" disabled/>
                                <input type="hidden" class="form-control col-md-10" name="prenom" value="<?= $users->prenom ?>"/>
                                <label class="col-md-1"><span style="color:red">*</span></label>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control col-md-10"  placeholder="email l'étudiant" name="email"  value="<?= $users->email ?>"/>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control col-md-10" name="tel"  placeholder="Telephone professeur"/>
                            </div>
                            <div class="form-group">
                                <div class="maxl">
                                    <label class="control-label">Sexe du l'étudiant</label>&nbsp
                                    <label class="radio inline offset-1">
                                        <input type="radio" name="sexe" value="masculin" <?php if($users->sexe == "masculin"): ?> checked <?php endif; ?> disabled>
                                        <input type="hidden" name="sexe" value="feminin" <?php if($users->sexe == "feminin"):?> checked <?php endif; ?> >
                                        <span> Masculin </span>
                                    </label>
                                    <label class="radio inline">
                                        <input type="radio" name="sexe" value="feminin" <?php if($users->sexe == "feminin"):?> checked <?php endif; ?> disabled>
                                        <input type="hidden" name="sexe" value="feminin" <?php if($users->sexe == "feminin"):?> checked <?php endif; ?> >
                                        <span>Feminin </span>
                                    </label>
                                    <label class="col-md-1 offset-1"><span style="color:red">*</span></label>
                                </div>
                            </div>
                            <div class="col-md-10"> 
                                <label class="control-label">Informations de Connexion</label><hr>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control col-md-10" placeholder="Login"name="login"  value="<?= $users->login ?>"/>
                                <label class="col-md-1"><span style="color:red">*</span></label>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control col-md-10" placeholder="Ancien mot de passe" name="ancien_mdp"/>
                                <label class="col-md-1"><span style="color:red">*</span></label>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control col-md-10" placeholder="Nouveau mot de passe" name="nouveau_mdp"/>
                                <label class="col-md-1"><span style="color:red">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-6">
                        	<div class="col-md-10">
                                <label class="control-label">Informations Supplementaires</label><hr>
                        	</div>
                            <div class="form-group">
                                <input type="text" class="form-control col-md-10" value="<?= $users->matricule ?>" disabled/>
                                <input type="hidden" class="form-control col-md-10" name="matricule" value="<?= $users->matricule ?>"/>
                                <label class="col-md-1"><span style="color:red">*</span></label>
                            </div>
                            <div class="form-group">
                                <input type="date" class="form-control col-md-10" value="<?= $users->date_naiss ?>" disabled/>
                                <input type="hidden" class="form-control col-md-10" name="date_naiss" value="<?= $users->date_naiss ?>"/>
                                <label class="col-md-1"><span style="color:red">*</span></label>
                            </div>
                            <div class="form-group">
                                <input type="text" name="lieu_naiss" class="form-control col-md-10" placeholder="lieu de naissance de l'étudiant"   value="<?= $users->lieu_naiss ?>" disabled/>
                                <input type="hidden" class="form-control col-md-10" name="lieu_naiss" value="<?= $users->lieu_naiss ?>"/>
                                <label class="col-md-1"><span style="color:red">*</span></label>
                            </div>
                            <div class="form-group">
                                <select class="form-control col-md-10" name="id_classe">
                                        <?php
                                        foreach ($classes As $classe) {
                                            $selected=($classe->id_classe == $users->id_classe) ? 'selected' : '';
                                            echo '<option value="'.$classe->id_classe.'" '.$selected.'>'.$classe->nom_classe.'</option>';
                                        }
                                        ?>
                                    </select>
                                <label class="col-md-1"><span style="color:red">*</span></label>
                            </div>
                            <div class="form-group offset-2 pt-2">
                                <input type="submit" class="btn btn-success" value="Enregistrer"/>
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