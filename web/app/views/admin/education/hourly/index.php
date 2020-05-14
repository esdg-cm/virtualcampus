<div class="card shadow">
    <div class="card-header mb-1">
        <div class="mb-1 d-flex justify-content-between align-items-center">
            <h5 class="m-0 font-weight-bold text-primary">Liste des tranches horaires</h5>
        	<button type="button" class="btn btn-primary btn-sm pull-right" onclick="addhourly()" data-toggle="modal" data-target="#modal-hourly" data-toggle="tooltip" title="ajouter une tranche horaire">
                <i class="fa fa-plus fa-sm"></i>Ajouter une tranche horaire
            </button>
        </div>
    </div>
    <div class="car-body mt-1 p-1">
        <div class="table-responsive">
            <table class="table table-hover table-of-data" width="100%" cellspacing="0">
                <thead class="table-info">
                <tr>
                	<th class="text-center">-</th>
                	<th>Heure de debut</th>
                    <th>Heure de fin</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    <?php if(empty($hourlies)){
                    echo '<tr><td colspan="5">
                                <div class="alert alert-warning text-center">
                                    <i class="fa fa-exclamation-triangle fa-3x"></i>
                                    <br><br>
                                    Aucune tranche horaire enrégistrée
                                </div>
                            </td></tr>';
                  }else{
                    foreach ($hourlies As $hourly): ?>
                    <tr class="tr-shadow">
                    	<td><img src="<?= img_url('logos/hourly.jpg');?>"></td>
                        <td><?= $hourly->heure_debut; ?></td>
                        <td><?= $hourly->heure_fin; ?></td>
                        <td>
                        	<div class="btn-group">
                        		<button type="button" class="btn btn-primary btn-sm" onclick="edithourly(<?= $hourly->id_tranche; ?>)" data-toggle="modal" data-target="#modal-hourly" data-toggle="tooltip" title="Editer la tranche horaire">
                                    <i class="fa fa-edit fa-sm"></i>
                                </button>
                                <!--<button type="button" class="btn btn-danger btn-sm" onclick="deletehourly();" data-toggle="modal" data-target="#modal-hourly" data-toggle="tooltip" title="supprimer la tranche">
                                    <i class="fa fa-trash fa-sm"></i>
                                </button>-->
                            </div>
                        </td>
                    </tr>
                <?php endforeach; }?>
                </tbody>
                </table>
        </div>
    </div>
</div>


<div class="col-lg-12">
    <div class="modal" id="modal-hourly">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body col-lg-12">

                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>