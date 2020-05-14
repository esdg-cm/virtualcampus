
/** gestion des classes**/
function addclass() {
   $('#modal-establishment .modal-body').load('/web/admin/class/add', function() {
		$('#createclass button[type="reset"]').click(function (e) {
        	window.location.href='/web/admin/establishment';
    	});
    	$('#createclass').submit(function (e) {
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
                                	window.location.href='/web/admin/establishment';
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


/** gestion des niveaux**/

function addlevel() {
   $('#modal-establishment .modal-body').load('/web/admin/level/add', function() {
		$('#createlevel button[type="reset"]').click(function (e) {
        	window.location.href='/web/admin/establishment';
    	});
    	$('#createlevel').submit(function (e) {
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
                                	window.location.href='/web/admin/establishment';
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



/** gestion des filières**/

function addfaculty() {
   $('#modal-establishment .modal-body').load('/web/admin/faculty/add', function() {
        $('#createfaculty button[type="reset"]').click(function (e) {
            window.location.href='/web/admin/establishment';
        });
        $('#createfaculty').submit(function (e) {
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
                                    window.location.href='/web/admin/establishment';
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

/** gestion des centres**/

function addcenter() {
   $('#modal-establishment .modal-body').load('/web/admin/center/add', function() {
        $('#createcenter button[type="reset"]').click(function (e) {
            window.location.href='/web/admin/establishment';
        });
        $('#createcenter').submit(function (e) {
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
                                    window.location.href='/web/admin/establishment';
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