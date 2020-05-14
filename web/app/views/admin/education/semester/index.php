<div class="card shadow">
    <div class="card-header mb-1">
        <div class="mb-1 d-flex justify-content-between align-items-center">
            <h5 class="m-0 font-weight-bold text-primary">Liste des Semestre</h5>
        </div>
    </div>
    <div class="car-body mt-1 p-1">
        <div class="table-responsive">
            <table class="table table-hover table-of-data" width="100%" cellspacing="0">
                <thead class="table-info">
                <tr>
                	<th></th>
                	<th>Nom du semestre</th>
                    <th>Abreviation</th>
                    <th>Niveau du semestre</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    <?php if(empty($semestres)){
                    echo '<tr><td colspan="5">
                                <div class="alert alert-warning text-center">
                                    <i class="fa fa-exclamation-triangle fa-3x"></i>
                                    <br><br>
                                    Aucun semestre enrégistré
                                </div>
                            </td></tr>';
                  }else{
                    foreach ($semestres As $semestre): ?>
                    <tr class="tr-shadow">
                    	<td></td>
                        <td><?= $semestre->nom_semestre; ?></td>
                        <td><?= $semestre->abreviation; ?></td>
                        <td><?= $semestre->nom_niveau ?></td>
                        <td>
                        	<div class="btn-group">
                        		<button type="button" class="btn btn-primary btn-sm" onclick="editsemester(<?= $semestre->id_semestre ?>)" data-toggle="modal" data-target="#modal-semester" data-toggle="tooltip" title="Editer le semestre">
                                    <i class="fa fa-edit fa-sm"></i>
                                </button>
                                <!--<button type="button" class="btn btn-danger btn-sm" onclick="deletesemester();" data-toggle="modal" data-target="#modal-semester" data-toggle="tooltip" title="supprimer le semestre">
                                    <i class="fa fa-trash fa-sm"></i>
                                </button>-->
                                <button type="button" class="btn btn-info btn-sm" onclick="infosemester(<?= $semestre->id_semestre; ?>)" data-toggle="modal" data-toggle="tooltip" data-target="#modal-semester" title="Voir les details">
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
    <div class="modal" id="modal-semester">
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
    <div class="modal fade" id="modal-info_semester">
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