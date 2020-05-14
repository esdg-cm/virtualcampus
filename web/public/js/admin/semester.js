function editsemester(id_semester){
	$('#modal-semester .modal-body').load('/web/admin/semester/edit/'+id_semester, function() {
		$('#editsemester button[type="reset"]').click(function (e) {
        	window.location.href='/web/admin/semester';
    	});
    	$('#editsemester').submit(function (e) {
        	e.preventDefault();
        	$t = $(this);
        	$.post($t.attr('action'), $t.serialize(), function (data) {
        		console.log(data);
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
                                	window.location.href='/web/admin/semester';
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

function deletesemester(){
	alert('en cours......');
}


function infosemester(id_semester){
        $('#modal-info_semester .modal-body').load('/web/admin/semester/detail/'+id_semester);
}