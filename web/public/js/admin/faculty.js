function editfaculty(id_faculty) {
   $('#modal-faculty .modal-body').load('/web/admin/faculty/edit/'+id_faculty, function() {
        $('#editfaculty button[type="reset"]').click(function (e) {
            window.location.href='/web/admin/faculty';
        });
        $('#editfaculty').submit(function (e) {
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
                                    window.location.href='/web/admin/faculty';
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
function deletefaculty(id_faculty) {
   $('#modal-faculty .modal-body').load('/web/admin/faculty/delete/'+id_faculty);
}

function infofaculty(id_faculty) {
   $('#modal-faculty .modal-body').load('/web/admin/faculty/detail/'+id_faculty);
}