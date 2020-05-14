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
            <h5 class="m-0 font-weight-bold text-primary">Liste des classes</h5>
        </div>
    </div>
    <div class="car-body mt-1 p-1">
        <div class="table-responsive">
            <table class="table table-hover table-of-data" width="100%" cellspacing="0">
                <thead class="table-info">
                <tr>
                	<th class="text-center">-</th>
                	<th>Nom de la classe</th>
                    <th>Code de la classe</th>
                    <th>Nom du centre</th>
                    <th>Nom de la filiere</th>
                    <th>Niveau</th>
                    <th>Opération</th>
                </tr>
                </thead>
                <tbody><?php if(empty($classes)){
                    echo '<tr><td colspan="7">
                                <div class="alert alert-warning text-center">
                                    <i class="fa fa-exclamation-triangle fa-3x"></i>
                                    <br>
                                    Aucune classe enrégistrée
                                </div>
                            </td></tr>';
                  }else{
                    foreach ($classes As $classe): ?>
                    <tr class="tr-shadow">
                    	<td><img src="<?= img_url('logos/class.jpg');?>"></td>
                        <td><?= $classe->nom_classe; ?></td>
                        <td><?= $classe->code_classe; ?></td>
                        <td><?= $classe->nom_centre; ?></td>
                        <td><?= $classe->nom_filiere ?></td>
                        <td><?= $classe->nom_niveau ?></td>
                        <td>
                        	<div class="btn-group">
                        		<button type="button" class="btn btn-primary btn-sm" onclick="editclass(<?= $classe->id_classe;?>);" data-toggle="modal" data-target="#modal-class" data-toggle="tooltip" title="Editer la classe">
                                    <i class="fa fa-edit"></i>
                                </button>
                                <!--<button type="button" class="btn btn-danger btn-sm" onclick="deleteclass(<?= $classe->id_classe?>)" data-toggle="modal" data-target="#modal-center" data-toggle="tooltip" title="supprimer la classe">
                                    <i class="fa fa-trash fa-sm"></i>
                                </button>-->
                                <button type="button" class="btn btn-info btn-sm" onclick="infoclass(<?= $classe->id_classe;?>);" data-toggle="modal" data-target="#modal-info_class" data-toggle="tooltip" title="info sur la classe">
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
    <div class="modal" id="modal-class">
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
    <div class="modal fade" id="modal-info_class">
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