<div class="card shadow">
    <div class="card-header mb-1">
        <div class="mb-1 d-flex justify-content-between align-items-center">
            <h5 class="m-0 font-weight-bold text-primary">Liste des Professeurs</h5>
        </div>
        <div class="col-lg-4 offset-8">
        	<a href="<?= site_url('/admin/teacher/add') ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Enregistrer un nouveau professeur </a>
        </div>
    </div>
    <div class="car-body mt-1 p-1">
        <div class="table-responsive">
            <table class="table table-hover table-of-data" width="100%" cellspacing="0">
                <thead class="table-info">
                <tr>
                	<th></th>
                	<th>Login</th>
                    <th>Nom</th>
                    <th>Prenom</th>
                    <th>Sexe</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                	<?php foreach ($users As $user): ?>
                    <tr class="tr-shadow">
                    	<td><img src="<?= img_url('avatars/default.png'); ?>"></td>
                        <td><?= $user->login ?></td>
                        <td><?= $user->nom ?></td>
                        <td><?= $user->prenom ?></td>
                        <td><?= $user->sexe?></td>
                        <td>
                        	<div class="btn-group">
                        		<button type="button" class="btn btn-primary btn-sm" onclick="edit(<?= $user->id_utilisateur ?>)" data-toggle="tooltip" title="Editer le professeur">
                                    <i class="fa fa-user-edit fa-sm"></i>
                                </button>
                                <!--<button type="button" class="btn btn-danger btn-sm" onclick="" data-toggle="tooltip" title="Supprimer le professeur" disabled>
                                    <i class="fa fa-trash fa-sm"></i>
                                </button>-->
                                <button onclick="info(<?= $user->id_utilisateur ?>)" class="btn btn-info" data-toggle="modal" data-target="#modal-info"
                                       style="font-size: 0.7em;" title="Information supplementaires">
                                        <i class="fa fa-info"></i>
                                    </button>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
                </table>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="col-lg-12">
    <div class="modal fade" id="modal-info">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body col-lg-12">

                </div>
                <div class="modal-footer">
                    <div class="float-right">
                        <button type="button" class="btn btn-info" data-dismiss="modal">Fermer</button>
                    </div>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>