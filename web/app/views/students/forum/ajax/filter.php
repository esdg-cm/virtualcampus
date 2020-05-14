<div class="table-responsive">
    <?php if(empty($billets)) : ?>
        <div class="alert alert-info text-center">
            <i class="fa fa-exclamation-triangle fa-3x"></i><br>
            Aucune preoccupation trouvée pour ce filtre
        </div>
    <?php else : ?>
    <table class="table table-striped">
        <tbody>
        <?php foreach ($billets As $billet) : ?>
        <tr>
            <td style="width:15%" class="py-1"><img class="img-sm" src="<?= $billet->auteur()->getAvatar(); ?>" alt="image"> </td>
            <td style="width:70%; word-break: break-word !important;">
                <h5 style="word-break: break-word !important;">
                    <?php if(2 === $billet->statut_existant) : ?>
                        <i class="far fa-check-square text-success"></i>
                    <?php endif; ?>
                    <a style="word-break: break-word !important;" class="ml-1" href="<?= site_url('students/forum/t/'.scl_moveSpecialChar($billet->id_billet.'-'.$billet->sujet)); ?>"><?= ucfirst($billet->sujet); ?></a>
          </h5> 
          <h6 class="text-muted">Par <?= $billet->auteur()->getProfil(); ?></h6>
        </td>
        <td style="width:15%"><i class="far fa-comment"></i> <?= $billet->nbrcommentaire(); ?></td>
    </tr>
    <?php endforeach; ?>
        </tbody>
    </table>
    <?php endif; ?>
</div>
