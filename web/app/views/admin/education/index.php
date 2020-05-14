<div class="card-columns">
	<div class="card">
		<div class="card-body text-center bg-primary">
			<a href="<?= site_url('admin/ue') ?>" style="cursor: pointer;color:#fff;text-decoration: none;">Unité d'enseignement</a>
		</div>
		<div class="card-footer">
			<button onclick="addue();" class="btn btn-primary" data-toggle="modal" data-target="#modal-education">
				<i class="fa fa-plus text-secondary"> Ajouter</i>
			</button>
			<button class="btn btn-success">
				<a href="<?= site_url('admin/ue') ?>" style="cursor: pointer;color:#fff;text-decoration: none;">
					<i class="fa fa-list text-secondary"></i>Plus Action</a>
			</button>
		</div>
	</div>
	<div class="card">
		<div class="card-body text-center bg-primary text-secondary">
			Matières
		</div>
		<div class="card-footer">
			<button onclick="addsubject();" class="btn btn-primary" data-toggle="modal" data-target="#modal-education">
				<i class="fa fa-plus text-secondary"> Ajouter</i>
			</button>
			<button class="btn btn-success">
				<a href="<?= site_url('admin/subject') ?>" style="cursor: pointer;color:#fff;text-decoration: none;"><i class="fa fa-list text-secondary"></i>Plus Action</a>
			</button>
		</div>
	</div>
	<div class="card">
		<div class="card-body text-center bg-primary text-secondary">
			Planinng
		</div>
		<div class="card-footer">
			<button class="btn btn-primary">
				<a href="<?= site_url('admin/planning/add') ?>" style="cursor: pointer;color:#fff;text-decoration: none;"><i class="fa fa-plus text-secondary"></i>Ajouter</a>
			</button>
			<button class="btn btn-info">
				<a href="<?= site_url('admin/planning') ?>" style="cursor: pointer;color:#fff;text-decoration: none;"><i class="fa fa-eye"></i>Visualiser</a>
			</button>
			<button class="btn btn-success">
				<a href="<?= site_url('admin/hourly'); ?>" style="cursor: pointer;color:#fff;text-decoration: none;"><i class="fa fa-list"></i>Tranche horaire</a>
			</button>
		</div>
	</div>
</div>
	<div class="card-columns">
		<div class="card">
			<div class="card-body text-center bg-primary text-secondary">
				Semestre
			</div>
			<div class="card-footer">
				<button onclick="addsemester();" class="btn btn-primary" data-toggle="modal" data-target="#modal-education">
					<i class="fa fa-plus text-secondary"> Ajouter</i>
				</button>
				<button class="btn btn-success">
					<a href="<?= site_url('admin/semester'); ?>" style="cursor: pointer;color:#fff;text-decoration: none;"><i class="fa fa-list text-secondary"></i>Plus Action</a>
				</button>
			</div>
		</div>
	</div>
</div>

<div class="col-lg-12">
    <div class="modal" id="modal-education">
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