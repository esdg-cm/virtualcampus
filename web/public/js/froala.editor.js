 (function ($) {
    const editorInstance = new FroalaEditor('#froalaedit', {
        enter: FroalaEditor.ENTER_P,
        imageManagerLoadURL: App.cpr+'/ajax/froalaloadimage',
        placeholderText: null,
        events: {
            initialized: function () {
                const editor = this

                this.el.closest('form').addEventListener('submit', function (e) {
                    postForum();
                    // editor.$oel.val();
                    e.preventDefault()
                });

                $('#froalaedit').parent().find('.second-toolbar').remove();
            }
        }
    })
})(jQuery)

