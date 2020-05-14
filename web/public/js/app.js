const  App = {
    cpr: '/web'
};

App.error = function (content, title)
{
    title = (!title || typeof title == 'undefined') ? 'Error !' : title;
    $.alert({
        title,
        content,
        type : 'red'
    });
};

App.result = function (options)
{
    var parameters = $.extend({
        icon : 'fa fa-check',
        title : 'Success',
        type : 'green',
        content : '',
        callback : function () {},
        buttons: {
            ok: {
                text: 'Ok',
                btnClass: 'btn-blue',
                action: function () { parameters.callback(); }
            },
        },
    }, options);

    $.confirm({
        icon: parameters.icon,
        theme: 'modern',
        closeIcon: false,
        animation: 'scale',
        type: parameters.type,
        title: parameters.title,
        content : parameters.content,
        buttons: parameters.buttons
    });
};

App.confirm = function(content, options)
{
    var parameters = $.extend({
        yes: {
            text: 'Ok',
            action: function () {}
        },
        no: {
            text: 'Annuler',
            action: function () {}
        }
    }, options);

    $.confirm({
        title: 'Confirmation !',
        content,
        buttons: {
            ok: {
                btnClass: 'btn-blue',
                keys: ['enter'],
                text: parameters.yes.text,
                action: function () {
                    parameters.yes.action();
                }
            },
            nok: {
                btnClass: 'btn-red',
                keys: ['esc'],
                text: parameters.no.text,
                action: function() {
                    parameters.no.action();
                }
            }
        }
    });
}


$(document).ready(function() {

    /**
     * Mini plugin jQuery pour scroller vers le bas
     */
    $.extend($.fn, {
        scrollBottom: function()
        {
            return this.each(function(){
                var box = $(this).get(0);
                setTimeout(function(){
                    box.scrollTop = box.scrollHeight;
                }, 1200);
            });
        }
    });
});
