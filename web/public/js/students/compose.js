 $(document).ready(function() {
	$("#questions-slides").owlCarousel({
		loop: false,
		margin: 0,
		nav: true,
		items: 1,
		navText: ['<i class="fa fa-chevron-left"></i>','<i class="fa fa-chevron-right"></i>'],
	});

	$('form#examForm').submit(function(e) {
		e.preventDefault();
		var form = $(this);

		App.confirm('Assuerz vous d\'avoir verifier vos reponses car une fois avoir valider, vous ne pourriez plus revenir sur cette epreuve', {
			yes: {
				text: 'Valider',
				action: function() { sendResponse(form); }
			}
		});
	});
});


function sendResponse(form)
{
	$.post(form.attr('action'), form.serialize(), function(result) {
		App.result({
			content: result
		});
	});
}




/**
 * $('form#examForm').submit(function(e) {
		e.preventDefault();

	 	let myformData = new FormData($(this)[0]);
        $.ajax({
            type : 'POST',
            enctype: 'multipart/form-data',
            url : 'traitement/ajax_envoi_demande.php',
            data : myformData,
            processData : false,
            contentType : false ,
            cache : false,
            success:function(data){
                Placeholder();
                $('#info').html("SUCCESS : " + data);//Insertion des infos de retour dans la div info
            }
        });

		alert(a);
	});
 */
