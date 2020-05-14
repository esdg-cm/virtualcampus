<div class="card shadow">
    <div class="card-header mb-1">
        <div class="mb-1 d-flex justify-content-between align-items-center">
            <h5 class="m-0 font-weight-bold text-primary">Liste des Centres</h5>
        </div>
    </div>
    <div class="car-body mt-1 p-1">
        <div class="table-responsive">
            <table class="table table-hover table-of-data" width="100%" cellspacing="0">
                <thead class="table-info">
                <tr>
                	<th class="text-center">-</th>
                	<th>Nom du Centre</th>
                    <th>Code du centre</th>
                    <th>Telephone responsable</th>
                    <th>Localisation</th>
                    <th>Opération</th>
                </tr>
                </thead>
                <tbody><?php if(empty($centres)){
                    echo '<tr><td colspan="6">
                                <div class="alert alert-warning text-center">
                                    <i class="fa fa-exclamation-triangle fa-3x"></i>
                                    <br><br>
                                    Aucun centre enrégistré
                                </div>
                            </td></tr>';
                  }else{
                    foreach ($centres As $centre): ?>
                    <tr class="tr-shadow">
                    	<td><img src="<?= img_url('logos/center.jpg')?>"></td>
                        <td><?= $centre->nom_centre; ?></td>
                        <td><?= $centre->code_centre ?></td>
                        <td><?= $centre->tel_responsable ?></td>
                        <td><?= $centre->localisation.' '.$centre->id_centre ?></td>
                        <td>
                        	<div class="btn-group">
                        		<button type="button" class="btn btn-primary btn-sm" onclick="editcenter(<?= $centre->id_centre;?>);" data-toggle="modal" data-target="#modal-center" data-toggle="tooltip" title="Editer le centre">
                                    <i class="fa fa-edit"></i>
                                </button>
                                <!--<button type="button" class="btn btn-danger btn-sm" onclick="deletecenter(<?= $centre->id_centre;?>)" data-toggle="modal" data-target="#modal-center" data-toggle="tooltip" title="supprimer le centre">
                                    <i class="fa fa-trash fa-sm"></i>
                                </button>-->
                                <button type="button" class="btn btn-info btn-sm" onclick="infocenter($centre->id_centre)" data-toggle="modal" data-target="#modal-info_center" data-toggle="tooltip" title="Editer le centre">
                                    <i class="fa fa-info"></i>
                                </button>
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
    <div class="modal" id="modal-center">
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
<div class="col-lg-12">
    <div class="modal fade" id="modal-info_center">
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