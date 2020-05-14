$('#createteacher input[type="reset"]').click(function (e) {
        	window.location.href='/web/admin/teacher';
});
$('#createteacher').submit(function (e) {
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
                            window.location.href='/web/admin/teacher';
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


$('#editteacher input[type="reset"]').click(function (e) {
            window.location.href='/web/admin/teacher';
});
$('#editteacher').submit(function (e) {
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
                            window.location.href='/web/admin/teacher';
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


function edit(id_utilisateur){
    window.location.href='/web/admin/teacher/editAdmin/'+id_utilisateur;
}

function info(id_utilisateur){
    $('#modal-info .modal-body').load('/web/admin/teacher/detail/'+id_utilisateur);
}