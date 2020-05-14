<div class="card shadow">
    <div class="card-header mb-1">
        <div class="mb-1 d-flex justify-content-between align-items-center">
            <h5 class="m-0 font-weight-bold text-primary">Liste des matières</h5>
        </div>
    </div>
    <div class="car-body mt-1 p-1">
        <div class="table-responsive">
            <table class="table table-hover table-of-data" width="100%" cellspacing="0">
                <thead class="table-info">
                <tr>
                    <th></th>
                    <th>Nom matière</th>
                    <th>Nom UE</th>
                    <th>Référence matière</th>
                    <th>Coef</th>
                    <th>Operation</th>
                </tr>
                </thead>
                <tbody>
                    <?php if(empty($matieres)){
                    echo '<tr><td colspan="6">
                                <div class="alert alert-warning text-center">
                                    <i class="fa fa-exclamation-triangle fa-3x"></i>
                                    <br><br>
                                    Aucune matière enrégistrée
                                </div>
                            </td></tr>';
                  }else{
                    foreach ($matieres As $matiere): ?>
                    <tr class="tr-shadow">
                        <td><img src="<?= img_url('logos/subject.jpg');?>"></td>
                        <td><?= $matiere->nom_matiere; ?></td>
                        <td><?= $matiere->nom_ue; ?></td>
                        <td><?= $matiere->ref_matiere; ?></td>
                        <td><?= $matiere->coef; ?></td>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary btn-sm" onclick="editsubject(<?= $matiere->id_matiere; ?>);" data-toggle="modal" data-target="#modal-subject" data-toggle="tooltip" title="Editer la matière">
                                    <i class="fa fa-edit fa-sm"></i>
                                </button>
                                <!--<button type="button" class="btn btn-danger btn-sm" onclick="deletesubject(<?= $matiere->id_matiere; ?>);" data-toggle="modal" data-target="#modal-subject" data-toggle="tooltip" title="supprimer la matière">
                                    <i class="fa fa-trash fa-sm"></i>
                                </button>-->
                                <button type="button" class="btn btn-info btn-sm" onclick="infosubject(<?= $matiere->id_matiere; ?>)" data-toggle="modal" data-toggle="tooltip" data-target="#modal-info_subject" title="Voir les details">
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
    <div class="modal" id="modal-subject">
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
    <div class="modal fade" id="modal-info_subject">
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