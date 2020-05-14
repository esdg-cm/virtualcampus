function editlevel(id_level) {
   $('#modal-level .modal-body').load('/web/admin/level/edit/'+id_level, function() {
		$('#editlevel button[type="reset"]').click(function (e) {
        	window.location.href='/web/admin/level';
    	});
    	$('#editlevel').submit(function (e) {
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
                                	window.location.href='/web/admin/level';
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
function deletelevel(id_level) {
   $('#modal-level .modal-body').load('/web/admin/level/delete/'+id_level);
}

function infolevel(id_level) {
   $('#modal-level .modal-body').load('/web/admin/level/detail/'+id_level);
}