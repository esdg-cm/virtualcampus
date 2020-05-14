function addhourly(){
    $('#modal-hourly .modal-body').load('/web/admin/hourly/add', function() {
        $('#createhourly button[type="reset"]').click(function (e) {
            window.location.href='/web/admin/planning/hourly';
        });
        $('#createhourly').submit(function (e) {
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
                                    window.location.href='/web/admin/planning/hourly';
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


function edithourly(id_hourly) {
   $('#modal-hourly .modal-body').load('/web/admin/hourly/edit/'+id_hourly, function() {
        $('#edithourly button[type="reset"]').click(function (e) {
            window.location.href='/web/admin/hourly';
        });
        $('#edithourly').submit(function (e) {
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
                                    window.location.href='/web/admin/hourly';
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