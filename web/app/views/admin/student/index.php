<!-- BREADCRUMB-->
<?php $membres = ['matricule'=>'gl3c1021','nom'=>'abdel jafar gyress','prenom'=>'pountouginigni mfogham','sexe'=>'masculin','classe'=>'gl3c','id_membre'=>1];
       ?>


<div class="card shadow">
    <div class="card-header mb-1">
        <div class="mb-1 d-flex justify-content-between align-items-center">
            <h5 class="m-0 font-weight-bold text-primary">Liste des Etudiants</h5>
        </div>
    </div>
    <div class="car-body mt-1 p-1">
        <div class="table-responsive">
            <table class="table table-hover table-of-data" width="100%" cellspacing="0">
                <thead class="table-info">
                <tr>
                	<th></th>
                	<th>Matricule</th>
                    <th>Nom</th>
                    <th>Prenom</th>
                    <th>Sexe</th>
                    <th>Statut</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                	<?php //foreach ($membres As $membre): ?>
                    <tr class="tr-shadow">
                    	<td><img src="<?= img_url('avatars/default.png'); ?>"></td>
                        <td><?= $membres['matricule']; ?></td>
                        <td><?= $membres['nom']; ?></td>
                        <td><?= $membres['prenom']; ?></td>
                        <td><?= $membres['sexe']; ?></td>
                        <td><?= $membres['classe'];?></td>
                        <td>
                        	<div class="btn-group">
                        		<button type="button" class="btn btn-primary btn-sm" onclick="" data-toggle="tooltip" title="Editer le statut">
                                    <i class="fa fa-user-edit fa-sm"></i>
                                </button>
                                <button type="button" class="btn btn-warning btn-sm" onclick="" data-toggle="tooltip" title="Editer l'étudiant">
                                    <i class="fa fa-exchange-alt fa-sm"></i>
                                </button>
                                <!--<button type="button" class="btn btn-danger btn-sm" onclick="" data-toggle="tooltip" title="Supprimer l'étudiant">
                                    <i class="fa fa-user-minus fa-sm"></i>
                                </button>-->
                                <button type="button" class="btn btn-info btn-sm" onclick="showuser()" data-toggle="tooltip" title="Voir les details">
                                    <i class="fa fa-info"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                <?php //endforeach; ?>
                </tbody>
                </table>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="modalDetailsEtudiant" tabindex="-1" role="dialog" aria-labelledby="modalDetailsFormation" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Informations de l'étudiant</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body"></div>
        </div>
    </div>
</div>