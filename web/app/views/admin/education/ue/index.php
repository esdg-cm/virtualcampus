<div class="card shadow">
    <div class="card-header mb-1">
        <div class="mb-1 d-flex justify-content-between align-items-center">
            <h5 class="m-0 font-weight-bold text-primary">Liste des Unités d'enseignements</h5>
        </div>
    </div>
    <div class="car-body mt-1 p-1">
        <div class="table-responsive">
            <table class="table table-hover table-of-data" width="100%" cellspacing="0">
                <thead class="table-info">
                <tr>
                    <th></th>
                    <th>Nom UE</th>
                    <th>code UE</th>
                    <th>credit UE</th>
                    <th>Semestre UE</th>
                    <th>Statut Semestre</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody><?php if(empty($ue)){
                    echo '<tr><td colspan="7">
                                <div class="alert alert-warning text-center">
                                    <i class="fa fa-exclamation-triangle fa-3x"></i>
                                    <br><br>
                                    Aucune unité d\'enseignement enrégistrée
                                </div>
                            </td></tr>';
                  }else{
                    foreach ($ue as $ue):?>
                    <tr>
                        <td><img src="<?=img_url('logos/ue.jpg');?>"></td>
                        <td><?= $ue->nom_ue;?></td>
                        <td><?= $ue->code_ue;?></td>   
                        <td><?= $ue->credit;?></td>  
                        <td><?= $ue->nom_semestre;?></td>  
                        <td><?= (true === (bool) $ue->statut_existant) ? '<span class="badge badge-success">Actif</span>' : '<span class="badge badge-danger">Inactif</span>'; ?>
                        </td>   
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary btn-sm" onclick="editue(<?= $ue->id_ue;?>);" data-toggle="modal" data-target="#modal-ue" data-toggle="tooltip" title="Editer l'UE">
                                    <i class="fa fa-edit"></i>
                                </button>
                                <!--<button type="button" class="btn btn-danger btn-sm" onclick="deleteue(<?= $ue->id_ue;?>)" data-toggle="modal" data-target="#modal-ue" data-toggle="tooltip" title="supprimer l'UE">
                                    <i class="fa fa-trash fa-sm"></i>
                                </button>-->
                                <button type="button" class="btn btn-info btn-sm" onclick="infoue(<?= $ue->id_ue;?>)" data-toggle="modal" data-target="#modal-info_ue" data-toggle="tooltip" title="<infos l'UE">
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
    <div class="modal" id="modal-ue">
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
    <div class="modal fade" id="modal-info_ue">
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