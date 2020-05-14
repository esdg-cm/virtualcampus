$(document).ready(function () {
	/*ajout de l'ue*/


});
function addue(){
	$('#modal-education .modal-body').load('/web/admin/ue/add', function() {
		$('#createue button[type="reset"]').click(function (e) {
        	window.location.href='/web/admin/education';
    	});
    	$('#createue').submit(function (e) {
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
                                	window.location.href='/web/admin/education';
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


/*ajout des matières*/

function addsubject(){
	$('#modal-education .modal-body').load('/web/admin/subject/add', function() {
		$('#createsubject button[type="reset"]').click(function (e) {
        	window.location.href='/web/admin/education';
    	});
    	$('#createsubject').submit(function (e) {
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
                                	window.location.href='/web/admin/education';
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
	});;
}

/*Ajout du du planning*/

function addplanning(){
	$('#modal-education .modal-body').load('/web/admin/planning/add');
}

/*Ajout du semestre*/

function addsemester(){
	$('#modal-education .modal-body').load('/web/admin/semester/add', function() {
        $('#createsemester button[type="reset"]').click(function (e) {
            window.location.href='/web/admin/education';
        });
        $('#createsemester').submit(function (e) {
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
                                    window.location.href='/web/admin/education';
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


function hourly(){
        alert('oki');
    }