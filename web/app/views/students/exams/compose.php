<!-- Page Title Header Starts-->
<div class="row page-title-header">
    <div class="col-12 py-0 m-0">
        <div class="page-header d-flex py-0 my-0 justify-content-between">
            <h4 class="page-title"> <i class="fa fa-pen-alt"></i> Composition</h4>
            <nav aria-label="breadcrumb" class="d-none d-md-block m-0">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= site_url('students'); ?>">Accueil</a></li>
                <li class="breadcrumb-item active" aria-current="page">Composition</li>
              </ol>
            </nav>
        </div>
    </div>
</div>
<!-- Page Title Header Ends-->


<form method="post" action="<?= site_url('students/exams/compose'); ?>" id="examForm" role="form" class="card">
    <div class="card-header py-2">
        <h4 class="d-flex justify-content-between align-items-center">
            <span class="text-primary">Evaluation de &laquo; Initiation a l'algorithmique &raquo;</span>
            <ul class="row m-0" style="list-style: none">
                <li class="col-auto">Session normale</li>
                <li class="col-auto">60%</li>
                <li class="col-auto">Coef 3</li>
                <li class="col-auto">2H</li>
            </ul>
        </h4>
        <div class="progress mt-3" style="height:17px">
            <div class="progress-bar bg-success progress-bar-striped progress-bar-animated" style="height:17px;width:25%">- 01h30m</div>
        </div>
        <div class="d-flex justify-content-between align-items-center">
            <h6 class="small text-muted">Heure de debut: 07h30</h6>
            <h6 class="small text-muted">Heure de fin: 09h30</h6>
        </div>
    </div>

    <div class="card-body px-1 px-md-4">
        <!-- Set up your HTML -->
        <div class="owl-carousel" id="questions-slides">
            <div class="card border-0">
                <div class="card-body px-5 w-100">
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                    </p>
                    <br>
                    <div>
                        <div class="my-1 custom-control custom-radio">
                            <input type="radio" id="response_1_1" name="response_1" class="custom-control-input" value="vrai" />
                            <label class="custom-control-label" for="response_1_1">Vrai</label>
                        </div>
                        <div class="my-1 custom-control custom-radio">
                            <input type="radio" id="response_1_2" name="response_1" class="custom-control-input" value="faux" />
                            <label class="custom-control-label" for="response_1_2">Faux</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card-footer">
        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-success">Valider les reponses</button>
        </div>
    </div>
</form>
