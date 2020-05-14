function editclass(id_class) {
   $('#modal-class .modal-body').load('/web/admin/class/edit/'+id_class, function() {
		$('#editclass button[type="reset"]').click(function (e) {
        	window.location.href='/web/admin/class';
    	});
    	$('#editclass').submit(function (e) {
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
                                	window.location.href='/web/admin/class';
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
function deleteclass(id_class) {
   $('#modal-class .modal-body').load('/web/admin/class/delete/'+id_class);
}

function infoclass(id_class) {
   $('#modal-class .modal-body').load('/web/admin/class/detail/'+id_class);
}