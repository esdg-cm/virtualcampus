<!-- Page Title Header Starts-->
<div class="row page-title-header">
    <div class="col-12 py-0 m-0">
        <div class="page-header d-flex py-0 my-0 justify-content-between">
            <h4 class="page-title"> <i class="far fa-calendar"></i> Planing</h4>
            <nav aria-label="breadcrumb" class="d-none d-md-block m-0">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a onclick="loadMainPage('<?= site_url('students'); ?>'); return false" href="<?= site_url('students'); ?>">Accueil</a></li>
                <li class="breadcrumb-item active" aria-current="page">Planing</li>
              </ol>
            </nav>
        </div>
    </div>
</div>
<!-- Page Title Header Ends-->

<div class="card">
    <div class="card-header pb-2 d-flex justify-content-between align-items-center">
        <h4>Semaine du 03 septembre 2020 au 08 septembre 2020</h4>
        <a href="?action=getpdf" class="btn btn-primary" target="_blank">
            <i class="fa fa-print"></i>
            <span class="ml-1">Obtenir le pdf</span>
        </a>
    </div>
    <div class="card-body px-1 px-md-3">
        <div class="table-responsive">
            <table class="table table-striped table-bordered text-center">
                <thead class="table-primary">
                    <tr style="vertical-align: middle;">
                        <th style="width: 14%; vertical-align: middle;">Horaires</th>
                        <th style="width:16%">Lundi <br><br> 03/09</th>
                        <th style="width:16%">Mardi <br><br> 04/09</th>
                        <th style="width:16%">Mercredi <br><br> 05/09</th>
                        <th style="width:16%">Jeudi <br><br> 06/09</th>
                        <th style="width:16%">Vendredi <br><br> 07/09</th>
                        <th style="width:16%">Samedi <br><br> 08/09</th>
                    </tr>
                </thead>
                <tbody><?php for ($i = 0; $i < 4; $i++) : ?>
                    <tr>
                        <th class="table-primary">07h30 - 09h30</th>
                        <td style="word-wrap: break-word;">Administration des bd Sql Server <br><br> Mme Belinga</td>
                        <td style="word-wrap: break-word;">Administration des bd Sql Server <br><br> Mme Belinga</td>
                        <td style="word-wrap: break-word;">Administration des bd Sql Server <br><br> Mme Belinga</td>
                        <td style="word-wrap: break-word;">Administration des bd Sql Server <br><br> Mme Belinga</td>
                        <td style="word-wrap: break-word;">Administration des bd Sql Server <br><br> Mme Belinga</td>
                        <td style="word-wrap: break-word;">Administration des bd Sql Server <br><br> Mme Belinga</td>
                    </tr>
                <?php endfor; ?></tbody>
            </table>
        </div>
    </div>
</div>
