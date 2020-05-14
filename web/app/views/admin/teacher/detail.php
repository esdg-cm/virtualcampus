
            <h5 class="m-0 font-weight-bold text-primary">Informations supplémentaires</h5>
            <hr>
    <div class="car-body mt-1 p-1">
        <div class="table-responsive">
            <table class="table table-hover table-of-data" width="100%" cellspacing="0">
                <thead class="table-info">
                <tr>
                	<th>Login</th>
                	<th>Nom</th>
                    <th>email</th>
                    <th>telephone</th>
                    <th>specialite</th>
                    <th>titre</th>
                    <th>Sexe</th>
                    <th>Membre de la DE</th>
                </tr>
                </thead>
                <tbody>
                    <tr class="tr-shadow">
                        <td><?= $users->login; ?></td>
                        <td><?= $users->nom; ?></td>
                        <td><?php if(empty($users->email)){
                        	echo '/';}
                        	else{echo $users->email;} ?></td>
                        <td><?php if(empty($users->tel)){
                        	echo '/';}
                        	else{ echo $users->tel;}?></td>
                        <td><?= $users->specialite ?></td>
                        <td><?= $users->titre ?></td>
                        <td><?= $users->sexe?></td>
                        <td>
                        	<?php if($users->is_member_de){
                        	   echo '<span class="badge badge-success">oui</span>';}
                        	else{ 
                                echo '<span class="badge badge-danger">non</span>';}
                            ?>		
                        </td>
                    </tr>
                </tbody>
                </table>
        </div>
    </div>