$('#createstudent input[type="reset"]').click(function (e) {
        	window.location.href='/web/admin/student';
});
$('#createstudent').submit(function (e) {
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
                            window.location.href='/web/admin/student';
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

$('#editstudent input[type="reset"]').click(function (e) {
           window.location.href='/web/admin/student';
});
$('#editstudent').submit(function (e) {
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
                            window.location.href='/web/admin/student';
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