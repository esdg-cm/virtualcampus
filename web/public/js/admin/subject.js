function editsubject(id_subject){
	$('#modal-subject .modal-body').load('/web/admin/subject/edit/'+id_subject, function() {
		$('#editsubject button[type="reset"]').click(function (e) {
        	window.location.href='/web/admin/subject';
    	});
    	$('#editsubject').submit(function (e) {
        	e.preventDefault();
        	$t = $(this);
        	$.post($t.attr('action'), $t.serialize(), function (data) {
            	if(/<ok>/.test(data)) {
                	$.confirm({
                    	icon: 'fa fa-check',
                    	title:! 'Success',
                    	type: 'green',
                    	theme: 'modern',
                    	content: data.replace('<ok>', ''),
                    	buttons : {
                        	ok: {
                            	text: 'Terminer',
                            	action: function () {
                                	window.location.href='/web/admin/subject';
                            	}
                        	}
                        }
                	});
            	}
            	if(/<error>/.test(data)) {
                	$.alert({
                    	icon: 'fa fa-times',
                    	title: 'Erreur',
                    	type: 'red',
                    	theme: 'modern',
                    	content: data.replace('<error>', '')
                	});
            	}
        	});
    	});
	});
}

function deletesubject(){
	alert('en cours');
}


function infosubject(id_subject){
	$('#modal-info_subject .modal-body').load('/web/admin/subject/detail/'+id_subject);
}