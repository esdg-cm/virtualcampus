<div class="row" id="accordion_part_of_course">
  <?php if(empty($parties)) : ?>
    <div class="alert alert-info text-center">
      <i class="fa fa-exclamation-triangle fa-2x"></i><br>
      Ce cours n'a aucune partie
    </div>
  <?php else : foreach($parties As $partie) : ?>
      <div class="accordion my-2 col-12">
          <div class="card">
              <div style="cursor: pointer" class="card-header bg-primary py-3" data-toggle="collapse" data-target="#p_<?= $partie->id_partie; ?>">
                  <h5 class="d-flex justify-content-between text-white">
                      <span style="text-transform: normal !important"><?= ucfirst($partie->titre_partie);  ?></span>
                      <i class="fa fa-chevron-down"></i>
                  </h5>
              </div>
              <div id="p_<?= $partie->id_partie; ?>" class="collapse" data-parent="#accordion_part_of_course">
                <div class="card-body px-0"><?php
                  $chapitres = $partie->chapitres();
                  if(empty($chapitres)) : ?>
                    <div class="alert alert-info text-center mx-3">
                      <i class="fa fa-exclamation-triangle fa-2x"></i><br>
                      Aucun chapitre n'a été defini pour cette partie
                    </div>
                  <?php else : ?>
                    <ul class="m-0" style="list-style: none;"><?php foreach ($chapitres As $chapitre) : ?>
                      <li class="mb-3" style="font-size: 1.25em">
                        <?php if($chapitre->statut_existant == 2) : ?>
                          <i class="fa-sm fa-star fas text-success"></i>
                        <?php else : ?>
                          <i class="fa-sm fa-star far text-muted"></i>
                        <?php endif; ?>
                        <a href="<?= site_url('students/courses/'.$partie->id_matiere.'/'.scl_moveSpecialChar($chapitre->id_chapitre.'-'.$chapitre->titre_chap)); ?>"><?= ucfirst($chapitre->titre_chap); ?></a>
                      </li>
                    <?php endforeach; ?></ul>
                  <?php endif;
                ?></div>
              </div>
          </div>
      </div>
  <?php endforeach; endif; ?>
</div>
