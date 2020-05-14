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
            <h5 class="m-0 font-weight-bold text-primary">Liste des filières</h5>
        </div>
    </div>
    <div class="car-body mt-1 p-1">
        <div class="table-responsive">
            <table class="table table-hover table-of-data" width="100%" cellspacing="0">
                <thead class="table-info">
                <tr>
                	<th class="text-center">-</th>
                	<th>Nom de la filière</th>
                    <th>Code de la filière</th>
                    <th>Statut</th>
                    <th>Opération</th>
                </tr>
                </thead>
                <tbody><?php if(empty($filieres)){
                    echo '<tr><td colspan="5">
                                <div class="alert alert-warning text-center">
                                    <i class="fa fa-exclamation-triangle fa-3x"></i>
                                    <br>
                                    Aucune filière enrégistrée
                                </div>
                            </td></tr>';
                  }else{
                    foreach ($filieres As $filiere): ?>
                    <tr class="tr-shadow">
                    	<td><img src="<?= img_url('logos/faculty.jpg')?>"></td>
                        <td><?= $filiere->nom_filiere; ?></td>
                        <td><?= $filiere->code_filiere ?></td>
                        <td><?= (true === (bool) $filiere->statut_existant) ? '<span class="badge badge-success">Actif</span>' : '<span class="badge badge-danger">Inactif</span>'; ?></td>
                        <td>
                        	<div class="btn-group">
                        		<button type="button" class="btn btn-primary btn-sm" onclick="editfaculty(<?= $filiere->id_filiere;?>);" data-toggle="modal" data-target="#modal-faculty" data-toggle="tooltip" title="Editer la filière">
                                    <i class="fa fa-edit"></i>
                                </button>
                                <!--<button type="button" class="btn btn-danger btn-sm" onclick="deletefaculty(<?= $filiere->id_filiere;?>)" data-toggle="modal" data-target="#modal-faculty" data-toggle="tooltip" title="supprimer la filière">
                                    <i class="fa fa-trash fa-sm"></i>
                                </button>-->
                                <button type="button" class="btn btn-info btn-sm" onclick="infofaculty(<?= $filiere->id_filiere;?>);" data-toggle="modal" data-target="#modal-info_faculty" data-toggle="tooltip" title="Info sur la filière">
                                    <i class="fa fa-info"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                <?php endforeach;} ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<div class="col-lg-12">
    <div class="modal" id="modal-faculty">
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
    <div class="modal fade" id="modal-info_faculty">
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