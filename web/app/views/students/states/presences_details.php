<!-- Page Title Header Starts-->
<div class="row page-title-header">
    <div class="col-12 py-0 m-0">
        <div class="page-header d-flex py-0 my-0 justify-content-between">
            <h4 class="page-title"> <i class="fa fa-file"></i> Feuilles de presences</h4>
            <nav aria-label="breadcrumb" class="d-none d-md-block m-0">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a onclick="loadMainPage('<?= site_url('students'); ?>'); return false" href="<?= site_url('students'); ?>">Accueil</a></li>
                <li class="breadcrumb-item"><a onclick="loadMainPage('<?= site_url('students/states/presences'); ?>'); return false" href="<?= site_url('students/states/presences'); ?>">Feuilles de presences</a></li>
                <li class="breadcrumb-item active" aria-current="page">Janvier 2020</li>
              </ol>
            </nav>
        </div>
    </div>
</div>
<!-- Page Title Header Ends-->

<div class="card mb-3">
    <div class="card-body d-flex justify-content-between align-items-center">
        Etat de presence du mois de Janvier 2020
        <a target="_blank" class="btn btn-primary" href="<?= site_url('students/actions/getpdf/presences/?p=01-2019'); ?>"><i class="fa fa-file-pdf"></i> Obtenir le pdf</a>
    </div>
</div>

<div class="card">
    <div class="card-body px-2 px-md-4">
        <div class="table-responsive">
            <table class="table table-bordered table-striped" style="vertical-align: middle; text-align: center;">
                <thead class="table-primary">
                    <tr>
                        <th>Date & heure</th>
                        <th>Duree</th>
                        <th>Matiere</th>
                        <th>Statut</th>
                        <th>Etat</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>03/01 <br><br> 07h30 - 09h30</td>
                        <td>2h</td>
                        <td>Chinois <br><br> Mme. Lui Tong</td>
                        <td><span class="badge badge-danger">Absent</span></td>
                        <td><span class="badge badge-danger">Non justifiée</span></td>
                    </tr>
                    <tr>
                        <td>03/01 <br><br> 09h30 - 11h30</td>
                        <td>2h</td>
                        <td>Plateforme et outils de developpement <br><br> M. Njomo</td>
                        <td><span class="badge badge-success">Present</span></td>
                        <td>/</td>
                    </tr>
                    <tr>
                        <td>03/01 <br><br> 12h45 - 14h45</td>
                        <td>2h</td>
                        <td>Systemes d'Information Geographique <br><br> M. Manga</td>
                        <td><span class="badge badge-success">Present</span></td>
                        <td>/</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="mt-5">
            <h4 class="border-bottom text-muted pb-2">Recapitulatif</h4>

            <div class="row">
                <div class="col-lg-6">
                    <dl class="row my-1">
                        <dd class="col-7">Nombre d'absences</dd>
                        <dt class="col-5">1 --- 2h</dt>
                    </dl>
                    <dl class="row my-1">
                        <dd class="col-7">Nombre de presences</dd>
                        <dt class="col-5">2 --- 4h</dt>
                    </dl>
                    <dl class="row my-1">
                        <dd class="col-7">Nombre d'absences justifiées</dd>
                        <dt class="col-5">0 --- 0h</dt>
                    </dl>
                </div>
                <div class="col-lg-6">
                    <dl class="row my-1">
                        <dd class="col-6">Nombre d'absences total</dd>
                        <dt class="col-6">1 --- 2h</dt>
                    </dl>
                    <dl class="row my-1">
                        <dd class="col-6">Pourcentage d'absence</dd>
                        <dt class="col-6"><?= number_format(((1/3) * 100), 2) .' %'; ?></dt>
                    </dl>
                    <dl class="row my-1">
                        <dd class="col-6">Risque encouru</dd>
                        <dt class="col-6"><span class="text-danger">Avertissement</span></dt>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>

