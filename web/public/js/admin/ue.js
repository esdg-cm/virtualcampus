function editue(id_ue) {
   $('#modal-ue .modal-body').load('/web/admin/ue/edit/'+id_ue , function() {
		$('#editue button[type="reset"]').click(function (e) {
        	window.location.href='/web/admin/ue';
    	});
    	$('#editue').submit(function (e) {
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
                                	window.location.href='/web/admin/ue';
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
function deleteue(id_ue) {
   $('#modal-ue .modal-body').load('/web/admin/ue/delete/'+id_ue);
}

function infoue(id_ue){
        $('#modal-info_ue .modal-body').load('/web/admin/ue/detail/'+id_ue);
}