<div class="card-columns">
	<div class="card">
		<div class="card-body text-center text-secondary bg-primary">
			Niveau
		</div>
		<div class="card-footer">
			<button onclick="addlevel();" class="btn btn-primary" data-toggle="modal" data-target="#modal-establishment">
				<i class="fa fa-plus text-secondary"> Ajouter</i>
			</button>
			<button class="btn btn-success">
				<a href="<?= site_url('/admin/level')?>" style="cursor: pointer;color:#fff;text-decoration: none;">
					<i class="fa fa-list text-secondary"></i>
				Plus d'Action</a>
			</button>
		</div>
	</div>
	<div class="card">
		<div class="card-body text-center text-secondary bg-primary">
			Classe
		</div>
		<div class="card-footer">
			<button onclick="addclass();" class="btn btn-primary" data-toggle="modal" data-target="#modal-establishment">
				<i class="fa fa-plus text-secondary"> Ajouter</i>
			</button>
			<button class="btn btn-success">
				<a href="<?= site_url('/admin/class')?>" style="cursor: pointer;color:#fff;text-decoration: none;">
					<i class="fa fa-list text-secondary"></i>
				Plus d'Action</a>
			</button>
		</div>
	</div>
	<div class="card">
		<div class="card-body text-center text-secondary bg-primary">
			Filières
		</div>
		<div class="card-footer">
			<button onclick="addfaculty();" class="btn btn-primary" data-toggle="modal" data-target="#modal-establishment">
				<i class="fa fa-plus text-secondary"> Ajouter</i>
			</button>
			<button class="btn btn-success">
				<a href="<?= site_url('/admin/faculty')?>" style="cursor: pointer;color:#fff;text-decoration: none;">
					<i class="fa fa-list text-secondary"></i>
				Plus d'Action</a>
			</button>
		</div>
	</div>
</div>
<div class="card-columns">
	<div class="card">
		<div class="card-body text-center text-secondary bg-primary">
			Centre
		</div>
		<div class="card-footer">
			<button onclick="addcenter();" class="btn btn-primary" data-toggle="modal" data-target="#modal-establishment">
				<i class="fa fa-plus text-secondary"> Ajouter</i>
			</button>
			<button class="btn btn-success">
				<a href="<?= site_url('/admin/center')?>" style="cursor: pointer;color:#fff;text-decoration: none;"><i class="fa fa-list text-secondary"></i>Plus d'Action</a>
			</button>
		</div>
	</div>
</div>


<!-- modal  la classe-->

<div class="col-lg-12">
    <div class="modal" id="modal-establishment">
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

<!--fin modal de la classe-->