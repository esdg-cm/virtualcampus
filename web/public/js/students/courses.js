$(document).ready(function(){
    /**
     * Ouverture et fermeture du menu du
     */
    $('.fixed-plugin a.toggle').click(function(e) {
        e.preventDefault();
        $('.fixed-plugin .fixed-content').toggleClass('show');
    });
});
