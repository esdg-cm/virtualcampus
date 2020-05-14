<div class="mb-1 d-flex justify-content-between align-items-center">
    <h5 class="m-0 font-weight-bold text-primary">Detail de la matière</h5>
</div>
<hr>
<div class="table-responsive">
    <table class="table table-hover table-of-data" width="100%" cellspacing="0">
        <thead class="table-info">
        <tr>
            <td></td>
            <th>Nom matière</th>
            <th>Reference matière</th>
            <th>Nom UE</th>
            <th>nbre heure tp</th>
            <th>nbre heure td</th>
            <th>nbre heure cm</th>
        </tr>
        </thead>
        <tbody>
        <tr class="tr-shadow">
            <td><img src="<?= img_url('logos/subject.jpg');?>"></td>
            <td><?= $matieres->nom_matiere; ?></td>
            <td><?= $matieres->ref_matiere; ?></td>
            <td><?= $matieres->nom_ue; ?></td>
            <td><?= $matieres->nbr_hr_tp; ?></td>
            <td><?= $matieres->nbr_hr_td; ?></td>
            <td><?= $matieres->nbr_hr_cm; ?></td>
        </tr>
        </tbody>
    </table>
</div>