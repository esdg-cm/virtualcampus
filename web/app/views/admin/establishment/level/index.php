<section class="au-breadcrumb m-t-75 m-b-30">
    <div class="section__content  section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="au-breadcrumb-content">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END BREADCRUMB-->

<div class="card shadow">
    <div class="card-header mb-1">
        <div class="mb-1 d-flex justify-content-between align-items-center">
            <h5 class="m-0 font-weight-bold text-primary">Liste des niveaux</h5>
        </div>
    </div>
    <div class="car-body mt-1 p-1">
        <div class="table-responsive">
            <table class="table table-hover table-of-data" width="100%" cellspacing="0">
                <thead class="table-info">
                <tr>
                	<th class="text-center">-</th>
                	<th>Nom du niveau</th>
                    <th>Code du niveau</th>
                    <th>Statut</th>
                    <th>Opération</th>
                </tr>
                </thead>
                <tbody><?php if(empty($niveaux)){
                    echo '<tr><td colspan="5">
                                <div class="alert alert-warning text-center">
                                    <i class="fa fa-exclamation-triangle fa-3x"></i>
                                    <br><br>
                                    Aucun niveau enrégistré
                                </div>
                            </td></tr>';
                  }else{
                    foreach ($niveaux As $niveau): ?>
                    <tr class="tr-shadow">
                    	<td><img src="<?= img_url('logos/level.jpg')?>"></td>
                        <td><?= $niveau->nom_niveau; ?></td>
                        <td><?= $niveau->code_niveau ?></td>
                        <td><?= (true === (bool) $niveau->statut_existant) ? '<span class="badge badge-success">Actif</span>' : '<span class="badge badge-danger">Inactif</span>'; ?></td>
                        <td>
                        	<div class="btn-group">
                        		<button type="button" class="btn btn-primary btn-sm" onclick="editlevel(<?= $niveau->id_niveau;?>);" data-toggle="modal" data-target="#modal-level" data-toggle="tooltip" title="Editer le niveau">
                                    <i class="fa fa-edit"></i>
                                </button>
                                <!--<button type="button" class="btn btn-danger btn-sm" onclick="deletelevel(<?= $niveau->id_niveau;?>)" data-toggle="modal" data-target="#modal-center" data-toggle="tooltip" title="supprimer du niveau">
                                    <i class="fa fa-trash fa-sm"></i>
                                </button>-->
                                <button type="button" class="btn btn-info btn-sm" onclick="infolevel(<?= $niveau->id_niveau;?>);" data-toggle="modal" data-target="#modal-info_level" data-toggle="tooltip" title="Editer le niveau">
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
    <div class="modal" id="modal-level">
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
    <div class="modal fade" id="modal-info_level">
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