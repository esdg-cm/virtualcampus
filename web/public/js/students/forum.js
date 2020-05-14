$(document).ready(function() {
    });

function postForum()
{
    var donnees = {},
        form = $('form');
    form.serializeArray().forEach(function(elt) {
        donnees[elt.name] = elt.value;
    });
    donnees.contenu = donnees.contenu.replace('<p data-f-id="pbf" style="text-align: center; font-size: 14px; margin-top: 30px; opacity: 0.65; font-family: sans-serif;">Powered by <a href="https://www.froala.com/wysiwyg-editor?pb=1" title="Froala Editor">Froala Editor</a></p>', '');
    
    $.post(form.attr('action'), donnees, function(response) {
        if(/<error>/.test(response)) {
            form.find('.response').html(response.replace('<error>', ''));
        }
        else if(/<ok>/.test(response)) {
            var id_billet = response.replace('<ok>', '');
            if(/new/.test(form.attr('action'))) {
                window.location.href = App.cpr+'/students/forum/topic/'+id_billet;
            }
            else {
                window.location.reload();
            }
        }
    });
}