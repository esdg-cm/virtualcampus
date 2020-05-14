function editcenter(id_center) {
   $('#modal-center .modal-body').load('/web/admin/center/edit/'+id_center, function() {
        $('#editcenter button[type="reset"]').click(function (e) {
            window.location.href='/web/admin/center';
        });
        $('#editcenter').submit(function (e) {
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
                                    window.location.href='/web/admin/center';
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
function deletecenter(id_center) {
   $('#modal-center .modal-body').load('/web/admin/center/delete');
}

function infocenter(id_center) {
   $('#modal-center .modal-body').load('/web/admin/center/detail');
}