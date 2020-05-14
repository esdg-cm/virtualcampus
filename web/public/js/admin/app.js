const  App = {
    cpr: '/lab/ivc/web'
};

$(document).ready(function(){
    /**
     * On demarre le chargement de la page courante
     */
    loadMainPage(window.location.href);
});

/**
 * Chargement du contenu de la page en ajax via le plugin dAN
 *
 * @author Dimitri Sitchet
 * @param  {String} url L'url a charger
 * @return void
 */
function loadMainPage(url) {
    $(window).dAN({
        url,
        target: 'main_box',
        render: false,
        animation: 'progress',
        success(response) {
            try {
                response = JSON.parse(response);
                if(response.css) {
                    $('link#page-style').attr('href', response.css);
                }
                if(response.content) {
                    $('div[data-dan-box="main_box"]').html(response.content);
                    $('#sidebar.sidebar-offcanvas').removeClass('active');
                }
                if(response.js) {
                    $.getScript(response.js);
                }
                if(response.title) {
                    $('title').html(response.title);
                }
                 $.dAN.init();
            }
            catch(error) {

            }
        }
    });
}
