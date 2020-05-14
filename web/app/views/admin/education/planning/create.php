<div class="card">
    <div class="card-body px-1 px-md-3">
        <div class="table-responsive">
            <table class="table table-bordered text-center">
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

                <tbody>
                    <tr>
                        <th class="table-primary">
                            <select class="mdb-select md-form"><?php
                                foreach($tranches_horaires as $horaire):?>
                                    <option><?= $horaire->heure_debut. " - ".$horaire->heure_fin;  ?></option>
                                <?php endforeach;?>
                            </select>
                        </th>
                        <td style="word-wrap: break-word;">
                            
                            <select><?php
                            foreach($matieres as $matiere):?>
                                    <option><?= $matiere->nom_matiere;?></option>
                            <?php endforeach;?>
                            </select>
                            <select><?php
                            foreach($teachers as $teacher):?>
                                    <option><?= $teacher->nom;?></option>
                            <?php endforeach;?>
                            </select>
                        </td>
                        <td style="word-wrap: break-word;">
                            
                            <select><?php
                            foreach($matieres as $matiere):?>
                                    <option><?= $matiere->nom_matiere;?></option>
                            <?php endforeach;?>
                            </select>
                            <select><?php
                            foreach($teachers as $teacher):?>
                                    <option><?= $teacher->nom;?></option>
                            <?php endforeach;?>
                            </select>
                        </td>
                        <td style="word-wrap: break-word;">
                            
                            <select><?php
                            foreach($matieres as $matiere):?>
                                    <option><?= $matiere->nom_matiere;?></option>
                            <?php endforeach;?>
                            </select>
                            <select><?php
                            foreach($teachers as $teacher):?>
                                    <option><?= $teacher->nom;?></option>
                            <?php endforeach;?>
                            </select>
                        </td>
                        <td style="word-wrap: break-word;">
                            
                            <select><?php
                            foreach($matieres as $matiere):?>
                                    <option><?= $matiere->nom_matiere;?></option>
                            <?php endforeach;?>
                            </select>
                            <select><?php
                            foreach($teachers as $teacher):?>
                                    <option><?= $teacher->nom;?></option>
                            <?php endforeach;?>
                            </select>
                        </td>
                        <td style="word-wrap: break-word;">
                            <select><?php
                            foreach($matieres as $matiere):?>
                                    <option><?= $matiere->nom_matiere;?></option>
                            <?php endforeach;?>
                            </select>
                            <select><?php
                            foreach($teachers as $teacher):?>
                                    <option><?= $teacher->nom;?></option>
                            <?php endforeach;?>
                            </select>
                        </td>
                        <td style="word-wrap: break-word;">
                            
                            <select><?php
                            foreach($matieres as $matiere):?>
                                    <option><?= $matiere->nom_matiere;?></option>
                            <?php endforeach;?>
                            </select>
                            <select><?php
                            foreach($teachers as $teacher):?>
                                    <option><?= $teacher->nom;?></option>
                            <?php endforeach;?>
                            </select>
                        </td>
                    </tr>
                    <br><br>
                </tbody>
            </table>
        </div>
    </div>
</div>
