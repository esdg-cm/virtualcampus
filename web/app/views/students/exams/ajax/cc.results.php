<div class="row">
    <?php for($i = 0 ; $i < 8; $i++) : ?>
    <div class="col-lg-3 my-2">
        <div class="card">
            <div class="card-body">
                <h4 class="text-primary text-center">Initiation a l'algorithmique</h4>
                <p class="mt-3">
                    <span class="text-info">Composé</span> :
                    <?php if($i % 3 != 0) : ?>
                        <span class="text-danger font-weight-bold"><?php
                            $n = 15 / ($i % 3 * rand(1, 4));
                            echo $n.'/20';
                        ?></span>
                    <?php else : ?>
                        <span class="text-success font-weight-bold">15/20</span>
                    <?php endif; ?>

                </p>
                <button class="btn btn-primary btn-block" onclick="showExamsDetails(1);">Voir les details</button>
            </div>
        </div>
    </div>
    <?php endfor; ?>
</div>

<!-- Modal -->
<div class="modal fade" id="evaluationDetailsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Details de l'evaluation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" data-dan-box="evaluation-details"></div>
    </div>
  </div>
</div>

<script type="text/javascript">
    function showExamsDetails(id_exam)
    {
        $('#evaluationDetailsModal .modal-body').empty();
        $('#evaluationDetailsModal').modal();
        $(window).dAN({
            target: 'evaluation-details',
            url: App.cpr+'/students/exams/ajax_cc/details/'+id_exam,
            animation: 'facebook',
        });
    }
</script>
