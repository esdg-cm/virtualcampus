<div class="mb-1 d-flex justify-content-between align-items-center">
    <h5 class="m-0 font-weight-bold text-primary">Liste des matières de l'UE</h5>
</div>
<hr>
<div class="table-responsive">
    <table class="table table-hover table-of-data" width="100%" cellspacing="0">
        <thead class="table-info">
        <tr>
            <td></td>
            <th>Nom UE</th>
            <th>Nom matière</th>
            <th>Reference matière</th>
            <th>Coeficient</th>
        </tr>
        </thead>
        <tbody>
        	<?php if(empty($ue)){
        			echo '<tr><td colspan="5">
                                <div class="alert alert-warning text-center">
                                    <i class="fa fa-exclamation-triangle fa-3x"></i>
                                    <br>
                                    Aucune matière enrégistrée pour cette Unité d\'enseignement
                                </div>
                            </td></tr>';
        		  }else{
        		  	    foreach($ue as $ue): ?>
        			<tr class="tr-shadow">
            			<td><img src="<?= img_url('logos/subject.jpg');?>"></td>
            			<td><?= $ue->nom_ue; ?></td>
            			<td><?= $ue->nom_matiere; ?></td>
            			<td><?= $ue->ref_matiere; ?></td>
            			<td><?= $ue->coef; ?></td>
        			</tr>
        			<?php endforeach;
        		  }
        	?>
        </tbody>
    </table>
</div>